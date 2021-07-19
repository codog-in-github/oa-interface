<?php
namespace Oa\Model;

use Think\Model;

class TraderModel extends Model {
    public function saveData($trander,$bkgid){
        $this->where([
            'id'=>$bkgid,
        ]);
        $trander['id'] = $bkgid;
        if($this->count() == 0){
            $this->add($trander);
        }else{
            $this->save($trander);
        }
    }
}