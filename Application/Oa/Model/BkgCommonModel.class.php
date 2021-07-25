<?php
namespace Oa\Model;

use Think\Model;

class BkgCommonModel extends Model {
    public function saveData($bkg,$bkgid){
        $this->where([
            'id'=>$bkgid,
        ]);
        $bkg['id'] = $bkgid;
        if($this->count() == 0){
            $this->add($bkg);
        }else{
            $this->save($bkg);
        }
    }
    public function getData($bkg_id){
        if($this->_fields){
            $this->field($this->_fields);
        }
        return $this->find($bkg_id);
    }
}