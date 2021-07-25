<?php
namespace Oa\Model;

use Think\Model;

class UserModel extends Model {

   
    public function getSelectUser(){
        $fields = [
            'id',
            '`name` as `label`',
            '`name` as `value`',
            'tag',
        ];
        return  $this -> field($fields)
            -> where('`enable` = 1')
            -> select();
    }
    public function getLoginUser($username, $password){
        return $this
            ->field([
                'id',
                'name',
                'tag',
            ])
            ->where([
                'username'=>$username,
                'password'=>$password,
            ])->find();
    }
}