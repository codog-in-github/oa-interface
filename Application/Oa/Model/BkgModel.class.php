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
        'CONCAT(`month`,`month_no`,`tag`)' =>'dg'
    ];
    public function saveData($bkg,$bkgid){
        $this->where([
            'id'=>$bkgid,
        ]);
        $bkg['id'] = $bkgid;
        if($this->count() == 0){
            $month = date('Ym');
            $last = $this->where([
                'month' => $month,
            ])
            ->order('month_no desc')
            ->find()['month_no'];
            $current = 100;
            if($last){
                $current = nextOrderNo($last);
            }
            $bkg['month'] = $month;
            $bkg['month_no'] = $current;
            $bkg['tag'] = $_SESSION['userInfo']['tag'];
            $this->add($bkg);
        }else{
            $this->save($bkg);
        }
    }
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