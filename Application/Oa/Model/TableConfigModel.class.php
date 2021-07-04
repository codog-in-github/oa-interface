<?php
namespace Oa\Model;

use Think\Model;

class TableConfigModel extends Model {

    private $_fields = [
        'id',
        'pid',
        'table_name',
        'title',
        'col_name',
        'params_name',
        'type',
        'default',
        'enable',
    ];

    public function getAll($tableName){
        $sqlData =  $this
            ->field($this->$_fields)
            ->where([
                'enable' => 1,
                'table_name' => $tableName,
            ])
            ->order('pid,`order`')
            ->select();
        $configDataKeyById = [];
        // 将 数据 用 id 作为 键 
        // 含有pid的 的数据放入 父数据的 child 内部
        // 选项放入 detail
        foreach($sqlData as  $singleConf){
            if($singleConf['pid']){
                $configDataKeyById[$singleConf['pid']]['child'] = $singleConf;
                if($childDetail = $this->_getDetailByType($singleConf['type'], $singleConf['id'])){
                    $configDataKeyById[$singleConf['pid']]['detail'] = array_merge($configDataKeyById[$singleConf['pid']]['detail'],$childDetail);
                }
            }else{
                $configDataKeyById[$singleConf['id']] = $singleConf;
                if($detail = $this->_getDetailByType($singleConf['type'], $singleConf['id'])){
                    $configDataKeyById[$singleConf['id']]['detail'] = $detail;
                }
                
            }
        }
        return array_values($configDataKeyById);
    }

    private function _getDetailByType($type, $id){
        switch($type){
            case 'select': 
            case 'suggest': 
            case 'searchSelect':{
                $model = new TableConfigDetailModel();
                return $model -> getOptionsByConfigId($id);
            }
            case 'countrySelect':{
                $model = new CountryModel();
                return $model -> getAll();
            }
            case 'userSelect':{
                $model = new UserModel();
                return $model -> getSelectUser();
            }
            default:{
                return false;
            }
        }
    }
}