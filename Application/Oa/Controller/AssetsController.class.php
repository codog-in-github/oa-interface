<?php
namespace Oa\Controller;

use Think\Controller ;
use PHPExcel_IOFactory;

class AssetsController extends Controller {
    public static $basePath = ENTRY_PATH . '/tmp/';

    public function onceExcel () {
        $fileName = $_GET['name'];
        $fileFullName = AssetsController::$basePath . $fileName;
        if(preg_match('/^\d+\.xlsx?$/', $fileName) && file_exists($fileFullName)){
            $ext = explode('.', $fileName);
            $ext = $ext[count($ext) -1];
            if($ext === 'xls'){
                header('Content-Type: application/vnd.ms-excel'); //告诉浏览器将要输出excel03文件
            }else{
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//告诉浏览器数据excel07文件
            }
            header("Content-Disposition: attachment;filename=\"$fileName\"");  //告诉浏览器将输出文件的名称
            header('Cache-Control: max-age=0'); 
            $output = fopen("php://output", "w");
            fwrite($output, file_get_contents($fileFullName));
            fclose($output);
            unlink($fileFullName);
        } else {
            header('HTTP/1.1 404 Not Found');
            header("status: 404 Not Found");
        }
    }
}