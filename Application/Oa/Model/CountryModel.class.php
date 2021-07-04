<?php
namespace Oa\Model;

use Think\Model;

class CountryModel extends Model {

    public function getAll(){
        $fields = [
            'id',
            'pid',
            'label',
            'code',
        ];
        return  $this -> field($fields)
            -> select();
    }
}