<?php
namespace Oa\Controller ;

use Think\Controller ;
use Oa\Model\ConfigAuthModel ;

class AuthController extends Controller
{
    //错误码
    const SUCCESS = 0;          # 成功
    const WITHOUT_LOGIN = 1;    # 未登录
    const PASSWORD_ERROR = 2;   # 账号密码错误
    const AUTH_ERROR = 3;       # 权限错误
    const ILLEGAL_PARAMS = 20;       # 参数不合法
    const UNKNOW_ERROR = 999;

    //不需要验证登录的方法
    const NO_LOGIN_METHOD = [
        'login',
        'needClear',
        'verify',
    ];
    //不需要验证权限的方法
    const NO_AUTH_METHOD = [
        'logout',
        'getMenu',
    ];

    public function __construct(){
        parent::__construct();
        // 验证登录信息
        if( !(in_array(ACTION_NAME, self::NO_LOGIN_METHOD) 
            || $_SESSION['user_info']) ){
            $this->ajaxError(
                self::WITHOUT_LOGIN,
                'WITHOUT_LOGIN'
            );
        }
        // 权限验证
        if( !in_array(ACTION_NAME, self::NO_LOGIN_METHOD) 
            && !in_array(ACTION_NAME, self::NO_AUTH_METHOD) 
            && !$this->_checkAuth() ){
            $this->ajaxError(
                self::AUTH_ERROR,
                'AUTH_ERROR'
            );
        }
    }

    protected function _checkAuth(){
        if(!isset($_SESSION['auth_info'][CONTROLLER_NAME  . '-' . ACTION_NAME])){
            $auth_model = new ConfigAuthModel($_SESSION['user_info']);
            $_SESSION['auth_info'][CONTROLLER_NAME  . '-' . ACTION_NAME] = boolval($auth_model->getMethodRole());
        }
        return $_SESSION['auth_info'][CONTROLLER_NAME  . '-' . ACTION_NAME];
    }

    protected function  ajaxSuccess($data = 'SUCCESS'){
        $this->ajaxReturn([
            'error'    =>  self::SUCCESS,
            'message'  =>  'success',
            'data'     =>  $data,
        ]);
    }

    protected function ajaxError($errorNo = self::UNKNOW_ERROR, $message = 'UNKNOW_ERROR'){
        $this->ajaxReturn([
            'error'    =>  $errorNo,
            'message'  =>  $message,
            'data'     =>  '',
        ]);
    }

    protected function _checkParams($params, $method = 'REQUEST', $check_function = []){
        $state = true;
        $target;
        switch($method){
            case 'REQUEST':{
                $target = $_REQUEST;
                break;
            }
            case 'GET':{
                $target = $_GET;
                break;
            }
            case 'POST':{
                $target = $_POST;
                break;
            }
        }
        for($i=0; $i<count($params); $i++){
            if( gettype($check_function[$i]) === 'object' || gettype($check_function[$i]) === 'string' ){
                if(!$check_function[$i]($target[$params[$i]])){
                    $state = false;
                    break;
                }
            } elseif (!boolval($target[$params[$i]])) {
                $state = false;
                break;
            }
        }
        if(!$state){
            $this->ajaxError(self::ILLEGAL_PARAMS, 'ILLEGAL_PARAMS');
        }
    }
}