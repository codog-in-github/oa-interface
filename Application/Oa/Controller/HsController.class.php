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
                die('文件类型错误'); // 报错信息
                break;
        }
        $excel = PHPExcel_IOFactory::createReader($IOFactoryType)->load($file);
        if($_POST['config']) {
            $config = json_decode($_POST['config']);
            $map = [];
            foreach( M('hs')->select() as $row) {
                $map[$row['description']] = $row['hs'];
            }
            foreach($config->sheets as $index) {
                $this->fillSheet($excel, $index, $map, $config->emptyOnly === 1);
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
            for($i = 1; $i < count($sheetArray); $i++) {
                if(
                    $sheetArray[$i][$desIndex] && $map[$sheetArray[$i][$desIndex]] && (
                        !$sheetArray[$i][$hsIndex] || !$emptyOnly
                    )) {
                        $sheet->setCellValue($colName . $i, $map[$sheetArray[$i][$desIndex]]);
                    }
            }
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