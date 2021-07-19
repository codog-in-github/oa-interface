<?php
namespace Oa\Model;

use Think\Model;

class ShipperModel extends Model {
    public function saveData($shipper,$bkgid){
        $before = $this->where([
            'id'=>$bkgid,
        ]);
        $shipper['id'] = $bkgid;
        if($before->count() == 0){
            $before->add($shipper);
        }else{
            $before->save($shipper);
        }
    }
}