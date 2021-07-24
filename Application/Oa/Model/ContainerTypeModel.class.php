<?php
namespace Oa\Model;

use Think\Model;

class ContainerTypeModel extends Model {
    public function saveData($containerType,$bkgid){
        $this->where([
            'bkg_id'=>$bkgid,
            'id'=>$containerType['id']
        ]);
        $containerType['bkg_id'] = $bkgid;
        if($this->count() == 0){
            $this->add($containerType);
        }else{
            $this->save($containerType);
        }
    }
    public function getData($bkg_id){
        return $this->where([
            'bkg_id' => $bkg_id,
        ])->select();
    }
}