<?php
namespace Oa\Model ;

use Think\Model ;

class ConfigRoleAuthModel extends Model
{
    protected $_role;

    public function __construct($role){
        parent::__construct();
        $this->_role = $role;
    }
    public function deleteAllAuth(){
        $id = $this->_role->role_id;
        $this->where([
            'role_id' => $id,
        ])->delete();
        return $this;
    }

    public function addAuth($ids){
        foreach($ids as $id){
            $this->add([
                'role_id' => $this->_role->role_id,
                'auth_id' => $id,
            ]);
        }
    }
}