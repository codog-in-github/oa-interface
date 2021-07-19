<?php
namespace Oa\Model;

use Think\Model;

class PortOfLoadingModel extends Model {
    public function saveData($loading,$bkgid){
        $before = $this->where([
            'id'=>$bkgid,
        ]);
        $loading['id'] = $bkgid;
        if($before->count() == 0){
            $before->add($loading);
        }else{
            $before->save($loading);
        }
    }
}