<?php
namespace Oa\Controller;
use PHPExcel_IOFactory;

class HsController extends AuthController {
    public function upload() {
        ini_set('max_execution_time', 20000);
        $file = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $ext = explode('.', $fileName);
        $ext = $ext[count($ext) -1];
        $IOFactoryType;
        switch ($ext) {
            case 'xls':
                $IOFactoryType = 'Excel5';
                break;
            case 'xlsx':
                $IOFactoryType = 'Excel2007';
                break;
            default:
                $this->ajaxError();
                break;
        }
        $excel = PHPExcel_IOFactory::createReader($IOFactoryType)->load($file);
        if($_POST['config']) {
            $config = json_decode($_POST['config']);
            $needUpdate = $config->update === 1;
            $emptyOnly = $config->emptyOnly === 1;
            $map = [];
            $idMap = [];
            $updateData = [];
            $addData = [];
            foreach(M('hs')->select() as $row) {
                $map[$row['description']] = $row['hs'];
                $idMap[$row['description']] = $row['id'];
            }
            foreach($config->sheets as $index) {
                $data = $this->fillSheet($excel, $index, $map, $emptyOnly);
                if($needUpdate) {
                    foreach ($data as $description => $hs) {
                        if($idMap[$description]) {
                            $updateData[$description] = $hs;
                        }  else {
                            $addData[$description] = $hs;
                        }
                    }
                }
            }
            if($needUpdate) {
                $model = M('hs');
                if($updateData) {
                    $model->save([
                        'id' => $idMap[$description],
                        'description' => $description,
                        'hs' => $hs,
                    ]);
                }
                if($addData) {
                    $data = [];
                    foreach ($addData as $description => $hs) {
                        $data[] = [
                            'description' => $description,
                            'hs' => $hs,
                        ];
                    }
                    $model->addAll($data);
                }
            }
            $newFileName = time() . rand(1000, 9999) . '.' . $ext;
            PHPExcel_IOFactory::createWriter($excel, $IOFactoryType)->save(AssetsController::$basePath . $newFileName);
            $this->ajaxSuccess($newFileName);
        } else {
            $this->ajaxSuccess(
                $excel->getSheetNames()
            );
        }
    }

    private function fillSheet(&$excel, $index, &$map, $emptyOnly) {
        $sheetArray = $excel->getSheet($index)->toArray();
        $desIndex = $hsIndex = -1;
        for($i = 0; $i < count($sheetArray[0]); $i ++) {
            $name = strtolower(trim($sheetArray[0][$i]));
            if($name === 'hs') {
                $hsIndex = $i;
            } elseif($name === 'description') {
                $desIndex = $i;
            }
        }
        if($desIndex !== -1 && $hsIndex !== -1) {
            $sheet = $excel->setActiveSheetIndex($index);
            $colName = excelColumn($hsIndex);
            $update = [];
            for($i = 1; $i < count($sheetArray); $i++) {
                $description = descriptionFormat($sheetArray[$i][$desIndex]);
                $hs = $map[$description];
                $excelHs = $sheetArray[$i][$hsIndex];
                if($description) {
                    if($hs && (!$excelHs || !$emptyOnly)) {
                        $sheet->setCellValue($colName . ($i + 1), $hs);
                    }
                    if($excelHs && $emptyOnly) {
                        $update[$description] = $excelHs;
                    }
                }
            }
            return $update;
        }
    }

    private function browser_export($writer, $fileName){
        $ext = explode('.', $fileName);
        $ext = $ext[count($ext) -1];
        if($ext === 'xls'){
            header('Content-Type: application/vnd.ms-excel'); //告诉浏览器将要输出excel03文件
        }else{
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//告诉浏览器数据excel07文件
        }
        header("Content-Disposition: attachment;filename=\"$fileName\"");  //告诉浏览器将输出文件的名称
        header('Cache-Control: max-age=0'); 
    }

    public function add () {
        $description = descriptionFormat($_POST['description']);
        $hs = trim($_POST['hs']);
        $model = M('hs');
        if($description && $hs) {
            $where = ['description' => $description];
            if($model->where($where)->count()) {
                $model->where($where)->save(['hs'=>$hs]);
            } else {
                $model->add([
                    'description' => $description,
                    'hs' => $hs,
                ]);
            }
            $this->ajaxSuccess();
        } else {
            $this->ajaxError(998, 'Description and Hs are required. ');
        }
    }
}

// $excel->getSheetCount()