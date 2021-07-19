<?php
namespace Oa\Model;

use Think\Model;

class PortOfLoadingModel extends Model {
    public function saveData($loading,$bkgid){
        $this->where([
            'id'=>$bkgid,
        ]);
        $loading['id'] = $bkgid;
        if($this->count() == 0){
            $this->add($loading);
        }else{
            $this->save($loading);
        }
    }
}