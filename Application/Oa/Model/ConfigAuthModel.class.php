<?php
namespace Oa\Model;

use Think\Model;

class ConfigAuthModel extends Model {
    private $_user_info;
    private $_role;
    
    public function __construct($user_info){
        parent::__construct();
        $this->_user_info = $user_info;
        $this->_role = new ConfigRoleModel($this->_user_info);

    }

    private function _init(){
        return $this
            ->alias('parent')
            ->join('config_auth AS child ON  parent.id = child.pid AND parent.type = child.type ')
            ->where([
                'parent.delete_at' => ['exp', 'IS NULL'],
                'child.delete_at' => ['exp', 'IS NULL'],
                'parent.enable' => 1,
                'child.enable' => 1,
            ]);
    }

    public function getMethodRole(){
        return $this
            ->_init()
            ->where([
                'child.type' => 1,
                'parent.id' => ['in', $this->_role->getAllAuthId()],
                'child.id' => ['in', $this->_role->getAllAuthId()],
                'parent.target' => CONTROLLER_NAME,
                'child.target' => ACTION_NAME,
            ])
            ->select();
    }
}