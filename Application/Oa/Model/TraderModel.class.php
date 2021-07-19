<?php
namespace Oa\Model;

use Think\Model;

class TraderModel extends Model {
    public function saveData($trander,$bkgid){
        $before = $this->where([
            'id'=>$bkgid,
        ]);
        $trander['id'] = $bkgid;
        if($before->count() == 0){
            $before->add($trander);
        }else{
            $before->save($trander);
        }
    }
}