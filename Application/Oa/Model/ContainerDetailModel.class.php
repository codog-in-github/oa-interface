<?php
namespace Oa\Model;

use Think\Model;

class ContainerDetailModel extends BkgCommonModel {
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
    public function getData($bkg_id){
        return $this->where([
            'bkg_id' => $bkg_id,
        ])->select();
    }
}