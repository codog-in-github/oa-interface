<?php
namespace Oa\Model;

use Think\Model;

class BkgModel extends Model {
    public function saveData($bkg){
        $before = $this->where([
            'id'=>$bkg['id'],
        ]);
        if($before->count() == 0){
            $before->add($bkg);
        }else{
            $before->save($bkg);
        }
    }
}