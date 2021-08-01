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
                'bkg_id',            #主表id
                'vanning_date',      #バンニング日
                'booker',            #booker
                'booker_place',      #バンニング場所
                'transprotation',    #運送業 
                'cy_cut',            #CY CUT
                'bkg_date',          #BKG DATE
                'CONCAT(l.`port`,"/",d.`port`) as ld',
                                     #POL/POD
                'bkg_no',            #BKG NO
            ])
            ->limit($current * $size, $size)
            ->order('vanning_date desc')
            ->select();
            // die($this->getLastSql());
        return $info;
    }
    protected function _beforeQuery($query){
        return $this
            ->alias('c')
            ->join('bkg AS b ON b.id = c.bkg_id')
            ->join('port_of_loading AS l ON l.id = c.bkg_id')
            ->join('port_of_delovery AS d ON d.id = c.bkg_id')
            ->join('trader AS t ON t.id = c.bkg_id')
            ->where([
                'b.delete_at' => ['exp','IS NULL'],
                'c.delete_at' => [
                    ['exp','IS NULL'],
                    '',
                    'or',
                ],
            ])
            ->where($query);
    }
}