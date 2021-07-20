<?php
namespace Oa\Model;

use Think\Model;

class BkgModel extends BkgCommonModel {
    protected $_fields =  [
        'id',
        'bkg_date',
        'bkg_no',
        'bl_no',
        'bkg_type',
        'incoterms',
        'bkg_staff',
        'in_sales',
    ];
    public function getList($query){
        $info = [];
        $this->field($this->_fields)->where($query);
        $info['total'] = $this->count();
        $info['list'] = $this->select();
        return $info;
    }
}