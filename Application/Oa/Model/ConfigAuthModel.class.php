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
        $this->_roleAuth = new ConfigRoleAuthModel($this->_role);
    }

    private function _init(){
        return $this
            ->alias('parent')
            ->join('config_auth AS child ON  parent.id = child.pid AND parent.type = child.type')
            ->where([
                'parent.delete_at' => ['exp', 'IS NULL'],
                'child.delete_at' => ['exp', 'IS NULL'],
            ]);
    }
    
    public function getMethodRole(){
        return $this
            ->_init()
            ->where([
                'child.type' => 1,
                'parent.enable' => 1,
                'child.enable' => 1,
                'parent.id' => ['in', $this->_role->getAllAuthId()],
                'child.id' => ['in', $this->_role->getAllAuthId()],
                'parent.target' => CONTROLLER_NAME,
                'child.target' => ACTION_NAME,
            ])
            ->select();
    }
    public function getMenu() {
        return $this
            ->_init()
            ->field([
                'parent.id',
                'parent.target',
                'parent.extra',
                'child.id AS c_id',
                'child.target AS c_target',
                'child.extra AS c_extra'
            ])
            ->where([
                'child.type' => 0,
                'parent.enable' => 1,
                'child.enable' => 1,
                'parent.id' => ['in', $this->_role->getAllAuthId()],
                'child.id' => ['in', $this->_role->getAllAuthId()],
            ])
            ->select();
    }

    public function getAllMenu(){
        return $this
            ->_init()
            ->field([
                'parent.id',
                'parent.target',
                'parent.extra',
                'child.id AS c_id',
                'child.target AS c_target',
                'child.extra AS c_extra'
            ])
            ->where([
                'child.type' => 0,
            ])
            ->select();
    }

    public function getAllMethod(){
        return $this
            ->_init()
            ->field([
                'parent.id',
                'parent.target',
                'parent.extra',
                'child.id AS c_id',
                'child.target AS c_target',
                'child.extra AS c_extra'
            ])
            ->where([
                'child.type' => 1,
            ])
            ->select();
    }

    public function getAuthIds(){
        return $this->_role->getAllAuthId();
    }
    
    public function getParentAuth($type){
        return $this->where([
            'pid'=>0,
            'type'=>$type
        ])
        ->select();
    }

    public function changeAuth($ids){
        $this->_roleAuth->deleteAllAuth();
        $this->_roleAuth->addAuth($ids);
    }

}