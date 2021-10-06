<?php
namespace Oa\Controller;

use Oa\Model\ConfigRoleModel as Role;
use Oa\Model\ConfigAuthModel as Auth;

class SystemController extends AuthController{
    public function getRoleList(){
        $role = new Role($_SESSION['user_info']);
        $this->ajaxSuccess($role->getRoleList());
    }

    public function getAuthList(){
        $auth = new Auth($_SESSION['user_info']);
        $this->ajaxSuccess([
            'menu_list' => array_group('id', $auth->getAllMenu()),
            'method_list' => array_group('id', $auth->getAllMethod()),
        ]);
    }

    public function getRoleAuthList(){
        $this->_checkParams(['role_id']);
        $role_id = $_REQUEST['role_id'];
        $auth = new Auth(['role_id'=>$role_id]);
        $authIds = $auth->getAuthIds();
        $this->ajaxSuccess($authIds);
    }

    public function getParentAuth(){
        $auth = new Auth($_SESSION['user_info']);
        $this->_checkParams(
            ['type'],
            'GET',
            [
                function ($type){
                    return $type === '1' || $type === '0';
                },
            ]
        );
        $this->ajaxSuccess($auth->getParentAuth($_GET['type']));
    }
}