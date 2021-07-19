<?php
namespace Oa\Model;

use Think\Model;

class BkgModel extends Model {
    public function saveData($bkg,$bkgid){
        $before = $this->where([
            'id'=>$bkgid,
        ]);
        if($before->count() == 0){
            $before->add($bkg);
        }else{
            $before->save($bkg);
        }
    }
}