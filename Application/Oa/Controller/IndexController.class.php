<?php
namespace Oa\Controller ;

use Oa\Controller\AuthController;
use Oa\Model\UserModel;

class IndexController extends AuthController
{
    function index(){
        if($_SESSION['userInfo']){
            
            $this->ajaxReturn([
                'error' => parent::SUCCESS,
                'message' =>'hello',
                'data'  => $_SESSION['userInfo'],
            ]);
        }else{
            $this->ajaxReturn([
                'error' => parent::WITHOUT_LOGIN,
                'message' =>'hello',
                'data'  => $_SESSION['userInfo'],
            ]);
        }
        // print_r($data);
        
    }
    function needClear(){
        $this->ajaxSuccess('2021-07-26.2');
    }
    
    public function login(){
        $map['username'] = $_POST['username'];
        $map['password'] = $_POST['password'];
        $code = $_REQUEST['verify'];
        $verify = new \Think\Verify();
        $isVerifyTrue =  $verify->check($code, '');
        if(!$isVerifyTrue){
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
        if($res) $_SESSION['userInfo'] = $res;
        $this->ajaxReturn($returnData);
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
        unset($_SESSION['userInfo']);
        $this->ajaxReturn([
            'error' => parent::WITHOUT_LOGIN,
            'message' => 'WITHOUT_LOGIN',
            'data' => [],
        ]);
    }
}
