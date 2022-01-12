<?php
namespace Demo\Controller ;

use Think\Controller ;

class TestController extends Controller
{
    public function index(){
        $this->_update('port_of_delovery');
        $this->_update('port_of_loading');
        echo 'complete';
    }
    private function _update($tableName){
        $data = M($tableName)->select();
        foreach($data as &$record){
            $match = [];
            // AI  THE ROAD(AIROA)
            $preg = '/^(.+)(\([A-Z]+) ([A-Z]+\))$/';
            preg_match_all($preg, $record['port'], $match);
            // print_r($match);
            echo $record['port'] = $match[0] ? $match[1][0].$match[2][0].$match[3][0] : $record['port'], "\n";
            // M($tableName)->save($record);
        }
    }
}