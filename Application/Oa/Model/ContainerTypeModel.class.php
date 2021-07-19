<?php
namespace Oa\Model;

use Think\Model;

class ContainerTypeModel extends Model {
    public function saveData($delovery,$bkgid){
        $before = $this->where([
            'id'=>$bkgid,
        ]);
        $delovery['id'] = $bkgid;
        if($before->count() == 0){
            $before->add($delovery);
        }else{
            $before->save($delovery);
        }
    }
}