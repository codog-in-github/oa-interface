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
            $preg = '/^[A-Z]+ (.+)\(([A-Z]+)\)$/';
            preg_match_all($preg, $record['port'], $match);
            // print_r($match);
            $record['port'] = $match[0] ? trim($match[1][0]).'('.$record['country'].' '.$match[2][0].')' : $record['port'];
            M($tableName)->save($record);
        }
    }
}