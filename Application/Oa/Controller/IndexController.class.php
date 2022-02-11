<?php
namespace Oa\Controller ;

use Oa\Controller\AuthController;
use Oa\Model\UserModel;
use Oa\Model\ConfigAuthModel;
use Think\Verify;

class IndexController extends AuthController
{
    function checkLoginStatus(){
        if($_SESSION['userInfo']){
            $this->ajaxSuccess($_SESSION['userInfo']);
        }else{
            $this->ajaxError(parent::WITHOUT_LOGIN,'WITHOUT_LOGIN');
        }
    }

    function needClear(){
        $this->ajaxSuccess(M('cash')->find(1)['value']);
    }
    
    public function login(){
        $map['username'] = $_POST['username'];
        $map['password'] = $_POST['password'];
        $res = (new UserModel())->getLoginUser($_POST['username'],$_POST['password']);
        if($res){
            $_SESSION['userInfo'] = $res;
            $this->ajaxSuccess($res);
        }else{
            $this->ajaxError(parent::PASSWORD_ERROR, 'USERNAME/PASSWORD ERROR');
        }
    }

    public function getMenu(){
        $auth = new ConfigAuthModel($_SESSION['userInfo']);
        $menus = $auth->getMenu();
        $group = [];
        foreach($menus as $menu){
            $group[$menu['id']][] = $menu;
        }
        $this->ajaxSuccess($group);
    }
    public function verify(){
        $Verify = new Verify([
            'expire' => 60*2,
        ]);
        $Verify->fontSize = 30;
        $Verify->length   = 4;
        $Verify->useNoise = false;
        $Verify->entry();
    }
    public function logout()
    {
        unset($_SESSION['userInfo']);
        $this->ajaxReturn([
            'error' => parent::WITHOUT_LOGIN,
            'message' => 'WITHOUT_LOGIN',
            'data' => [],
        ]);
    }
}
