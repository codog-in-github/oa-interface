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
            ->field([
                'b.id',
                'CASE `doc_cut` WHEN "" THEN `cy_cut` ELSE `doc_cut` END AS show_cy_cut',
                'bkg_date',
                'booker',
                'UPPER(l.`port`) as lp',
                'UPPER(d.`port`) as dp',
                'bkg_no',
                'group_concat(quantity) as quantity',
                'group_concat(container_type) as container_type',
                'state',
            ])
            ->join('container_type AS ct ON b.id = bkg_id')
            ->group('b.id')
            ->limit($current * $size, $size)
            ->order('show_cy_cut')
            ->select();
        foreach($info['list'] as &$record){
            $lp = explode(' ',explode('(',$record['lp'])[0]);
            unset($lp[0]);
            $lp = implode(' ',$lp);

            $dp = explode(' ',explode('(',$record['dp'])[0]);
            unset($dp[0]);
            $dp = implode(' ',$dp);
            $record['ld'] = "$lp - $dp";
        }
        // echo $this->getLastSql();die;
        return $info;
    }
    public function deleteOrder($bkgid,$deleteValue){
        $this->where([
            'id'=>$bkgid,
        ])->save([
            'delete_at'=> $deleteValue,
        ]);
    }

    public function changeOrderStep($id, $step){
        return $this->save([
            'id'=>$id,
            'step'=>$step
            ]
        );
    }
    protected function _beforeQuery($query){
        return $this
            ->alias('b')
            ->join('port_of_loading AS l ON b.id = l.id')
            ->join('port_of_delovery AS d ON b.id = d.id')
            ->join('trader AS t ON b.id = t.id')
            ->join('container AS c ON b.id = c.id')
            ->where($query);
    }
}