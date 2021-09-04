<?php
namespace Oa\Model;

use Think\Model;

class RequestbookModel extends Model {
    public function getRequestbookByBkgId($bkgid){
        return $this->where(['bkg_id' => $bkgid])->find();
    }
    public function updateBook($id, $bkg_id, $data){
        $isEdited = boolval($this->find($id));
        if($isEdited){
            $this->save($data);
        }else{
            $this->add($data);
        }
    }
}