<?php
namespace Oa\Model;

use Think\Model;

class TableConfigDetailModel extends Model {
    private $_fields = [
        'id',
        'pid',
        'label'
    ];

    public function getOptionsByConfigId($configId){
        return $this
            ->field($this->_fields)
            ->where([
                'config_id' => $configId,
                'enable' => 1
            ])
            ->select();
    }

    // public function getOptionsByConfigIds($configIds){
        
    // }
}