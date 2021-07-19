<?php
namespace Oa\Model;

use Think\Model;

class ContainerDetailModel extends Model {
    public function saveData($detail,$bkgid){
        $this->where([
            'id'=>$detail['id'],
        ]);
        $detail['bkg_id'] = $bkgid;
        if($this->count() == 0){
            $this->add($detail);
        }else{
            $this->save($detail);
        }
    }
}