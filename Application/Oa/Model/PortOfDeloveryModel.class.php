<?php
namespace Oa\Model;

use Think\Model;

class PortOfDeloveryModel extends Model {
    public function saveData($delovery,$bkgid){
        $this->where([
            'id'=>$bkgid,
        ]);
        $delovery['id'] = $bkgid;
        if($this->count() == 0){
            $this->add($delovery);
        }else{
            $this->save($delovery);
        }
    }
}