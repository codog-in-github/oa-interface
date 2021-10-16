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
        $this->_checkParams(
            ['type'],
            'GET',
            [
                function ($type){
                    return $type === '1' || $type === '0';
                },
                ]
            );
        $auth = new Auth($_SESSION['user_info']);
        $this->ajaxSuccess($auth->getParentAuth($_GET['type']));
    }

    public function changeRoleAuth(){
        $this->_checkParams(
            ['role_id', 'ids'],
            'POST'
        );
        $auth = new Auth(['role_id'=>$_POST['role_id']]);
        $auth->changeAuth(explode(',',$_POST['ids']));
        $this->ajaxSuccess();
    }

    public function addMenu(){
        // var_dump($_POST);die;
        $this->_checkParams(
            ['type','parent','child'],
            'POST',
            [
                function ($type){
                    return in_array($type, ['0', '1']);
                },
                function ($parent){
                    return $parent['target'] && $parent['extra'] || $parent['id'];
                },
                function ($child){
                    return $child['target'] && $child['extra'];
                }
            ]
        );
        $auth = new Auth($_SESSION['user_info']);
        $auth->addMenu($_POST['type'], $_POST['parent'], $_POST['child']);
    }
}