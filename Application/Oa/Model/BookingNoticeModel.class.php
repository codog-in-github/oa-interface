<?php
namespace Oa\Model;

use Think\Model;

class BookingNoticeModel extends Model {
    public function getRemarks($id){
        return $this->find($id)['remarks'] ?: '';
    }
    public function setRemarks($data){
        if($this->find($data['id'])){
            $this->save($data);
        }else{
            $this->add($data);
        }
    }
}