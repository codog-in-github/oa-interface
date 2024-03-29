<?php
namespace Oa\Model;

use Think\Model;

class ContainerDetailModel extends BkgCommonModel {
    public function saveData($detail,$bkgid){
        $this->where([
            'id'=>$detail['id'],
        ]);
        $detail['bkg_id'] = $bkgid;
        if($this->count() == 0){
            $this->add($detail);
        }else{
            $this->save($detail);
        }
    }
    public function getData($bkg_id){
        return $this->where([
            'bkg_id' => $bkg_id,
            'delete_at' => [
                [
                    'exp',
                    'IS NULL',
                ],
                '',
                'OR'
            ]
        ])->select();
        
    }
    
    public function getList($query,$size=100,$current=0){
        $info['total'] = $this
            ->_beforeQuery($query)
            ->count();
        $info['list'] = $this
            ->_beforeQuery($query)
            ->field([
                'c.id',              #id
                'c.bkg_id',            #主表id
                'vanning_date',      #バンニング日
                'booker',            #booker
                'booker_place',      #バンニング場所
                'transprotation',    #運送業 
                'cy_cut',            #CY CUT
                // 'bkg_date',          #BKG DATE
                'UPPER(l.`port`) as lp',
                'UPPER(d.`port`) as dp',
                                    #POL/POD
                'pick_order_request',
                'send_pick_order',
                'free_pick_day',
                'is_confirm',
                'bkg_no',            #BKG NO
            ])
            ->limit($current * $size, $size)
            ->order('cy_cut')
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
            // die($this->getLastSql());
        return $info;
    }
    protected function _beforeQuery($query){
        return $this
            ->alias('c')
            ->join('bkg AS b ON b.id = c.bkg_id')
            ->join('port_of_loading AS l ON l.id = c.bkg_id')
            ->join('port_of_delovery AS d ON d.id = c.bkg_id')
            ->join('container AS ct ON ct.id = c.bkg_id')
            ->join('container_type AS ct_t ON ct_t.bkg_id = c.bkg_id')
            ->join('trader AS t ON t.id = c.bkg_id')
            ->where([
                'b.delete_at' =>[
                    ['exp','IS NULL'],
                    '',
                    'or',
                ],
                'c.delete_at' => [
                    ['exp','IS NULL'],
                    '',
                    'or',
                ],
                'ct_t.delete_at' => [
                    ['exp','IS NULL'],
                    '',
                    'or',
                ],
                'vanning_date'=>[
                    // 'BETWEEN',
                    // [
                    //     date('Y-m-d 00:00:00',strtotime('-1 day')),
                    //     date('Y-m-d 23:59:59',strtotime('+2 day')),
                    // ]
                    ['exp', 'IS NOT NULL'],
                    ['neq', ''],
                    ['neq', '0000-00-00 00:00:00'],
                ]
            ])
            ->where($query);
    }

    public function confirm($id){
        $this->save([
            'id' =>$id,
            'is_confirm' => 1,
        ]);;
    }
}