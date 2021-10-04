<?php
namespace Oa\Controller ;

use Oa\Controller\AuthController;
use Oa\Model\UserModel;
use Oa\Model\ConfigAuthModel;

class IndexController extends AuthController
{
    function index(){
        if($_SESSION['user_info']){
            
            $this->ajaxReturn([
                'error' => parent::SUCCESS,
                'message' =>'hello',
                'data'  => $_SESSION['user_info'],
            ]);
        }else{
            $this->ajaxReturn([
                'error' => parent::WITHOUT_LOGIN,
                'message' =>'hello',
                'data'  => $_SESSION['user_info'],
            ]);
        }
        // print_r($data);
        
    }
    function needClear(){
        $this->ajaxSuccess(M('cash')->find(1)['value']);
    }
    
    public function login(){
        $map['username'] = $_POST['username'];
        $map['password'] = $_POST['password'];
        $code = $_REQUEST['verify'];
        $verify = new \Think\Verify();
        $isVerifyTrue =  $verify->check($code, '');
        if(!$isVerifyTrue && C('mode') !== 'development'){
            $this->ajaxReturn([
                'error' => parent::PASSWORD_ERROR,
                'message' => 'verify is error',
                'data' => null,
            ]);
        }
        $res = (new UserModel())->getLoginUser($_POST['username'],$_POST['password']);
        $returnData = [
            'error' => $res? parent::SUCCESS : parent::PASSWORD_ERROR,
            'message' => $res ? 'success':'USERNAME/PASSWORD ERROR',
            'data' => $res,
        ];
        if($res) $_SESSION['user_info'] = $res;
        $this->ajaxReturn($returnData);
    }
    public function getMenu(){
        $auth = new ConfigAuthModel($_SESSION['user_info']);
        $menus = $auth->getMenu();
        $group = [];
        foreach($menus as $menu){
            $group[$menu['id']][] = $menu;
        }
        $this->ajaxSuccess($group);
    }
    public function verify(){
        $Verify = new \Think\Verify([
            'expire' => 60*2,
        ]);
        $Verify->fontSize = 30;
        $Verify->length   = 4;
        $Verify->useNoise = false;
        $Verify->entry();
    }
    public function logout()
    {
        unset($_SESSION['user_info']);
        $this->ajaxReturn([
            'error' => parent::WITHOUT_LOGIN,
            'message' => 'WITHOUT_LOGIN',
            'data' => [],
        ]);
    }
}
