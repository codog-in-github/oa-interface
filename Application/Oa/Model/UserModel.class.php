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
                'user.id',
                'user.name',
                'tag',
                'role_id',
                'index',
            ])
            ->join('config_role ON role_id = config_role.id')
            ->where([
                'username'=>$username,
                'password'=>$password,
            ])->find();
    }
}