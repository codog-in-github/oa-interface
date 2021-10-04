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
}