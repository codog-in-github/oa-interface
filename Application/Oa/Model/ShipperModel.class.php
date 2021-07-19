<?php
namespace Oa\Model;

use Think\Model;

class ShipperModel extends Model {
    public function saveData($shipper,$bkgid){
        $this->where([
            'id'=>$bkgid,
        ]);
        $shipper['id'] = $bkgid;
        if($this->count() == 0){
            $this->add($shipper);
        }else{
            $this->save($shipper);
        }
    }
}