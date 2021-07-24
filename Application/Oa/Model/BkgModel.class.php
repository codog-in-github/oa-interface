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
    public function getList($query,$size=100,$current=0){
        $info['total'] = $this
            ->_beforeQuery($query)
            ->count();
        $info['list'] = $this
            ->_beforeQuery($query)
            ->limit($current * $size, $size)
            ->order('bkg_date desc')
            ->select();
        return $info;
    }
    public function deleteOrder($bkgid,$deleteValue){
        $this->where([
            'id'=>$bkgid,
        ])->save([
            'delete_at'=> $deleteValue,
        ]);
    }

    protected function _beforeQuery($query){
        return $this->field($this->_fields)->where($query);
    }
}