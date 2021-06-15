<?php
namespace Oa\Model;

use Oa\Model\PublicModel;

class TableConfigDetailModel  extends PublicModel{

    public function getDetail($id){
        if(gettype($id) == 'array')
            return $this->getDetailMulti($id);
        
    }

    protected function getDetailMulti($ids){
        return $this
        ->where([
            'config_id'=>[
                'in',
                $ids
            ],
        ])
        ->field([
            'id',
            'opt',
            'config_id',
        ])
        ->getResult();
    }
}