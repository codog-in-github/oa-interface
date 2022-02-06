<?php
namespace Oa\Controller ;

class AuthController extends \Think\Controller
{
    //不需要验证登录的接口
    const NO_LOGIN_METHOD =[
        'login',
        'needClear',
        'verify',
    ];
    //错误码
    const SUCCESS = 0;          #成功
    const WITHOUT_LOGIN = 1;    #未登录
    const PASSWORD_ERROR = 2;   #账号密码错误
    const PARAMS_ERROR = 3;     #参数错误


    public function __construct(){
        parent::__construct();
        //验证登录信息
        if( !(in_array(ACTION_NAME,self::NO_LOGIN_METHOD) 
            || $_SESSION['userInfo']) ){
            $this->ajaxError(
                self::WITHOUT_LOGIN,
                'WITHOUT_LOGIN'
            );
        }
    }

    protected function ajaxSuccess($data = 'SUCCESS'){
        $this->ajaxReturn([
            'error'    =>  self::SUCCESS,
            'message'  =>  'SUCCESS',
            'data'     =>  $data,
        ]);
    }
    protected function ajaxError($errorNo = 999, $message = 'error'){
        $this->ajaxReturn([
            'error'    =>  $errorNo,
            'message'  =>  $message,
            'data'     =>  '',
        ]);
    }
}