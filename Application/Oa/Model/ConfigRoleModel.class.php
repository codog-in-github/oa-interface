<?php
namespace Oa\Model;

use Think\Model;

class ConfigRoleModel extends Model{
    private $_user_info;
    private $_role_data;
    
    public function __construct($user_info){
        parent::__construct();
        $this->_user_info = $user_info;
    }
    public function getUserRole(){
        $this->_role_data = $this
            ->where([
                'user_id' => $this->_user_info['id'],
            ])
            ->find();
        return $this->_role_data;
    }
    public function getAllAuthId(){
        return array_column(
            $this
            ->alias('r')
            ->field('ra.auth_id')
            ->where([
                'r.id' => $this->_user_info['role_id'],
            ])
            ->join('config_role_auth AS ra ON r.id = ra.role_id')
            ->select(),
            'auth_id'
        );
            
    }
}