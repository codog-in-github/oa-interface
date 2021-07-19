<?php
namespace Oa\Model;

use Think\Model;

class UserModel extends Model {

   
    public function getSelectUser(){
        $fields = [
            'id',
            '`name` as `label`',
            '`name` as `value`',
        ];
        return  $this -> field($fields)
            -> where('`enable` = 1')
            -> select();
    }
}