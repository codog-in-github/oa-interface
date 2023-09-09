<?php
namespace Oa\Controller ;

use Think\Controller ;
use Oa\Model\ConfigAuthModel ;

class AuthController extends Controller
{
    /**
     * 错误码
     * 0         成功
     * 1   ~ 99  系统级别错误
     * 100 ~ 999 操作错误
     */
    const SUCCESS        = 0;    # 成功
    const WITHOUT_LOGIN  = 1;    # 未登录
    const AUTH_ERROR     = 2;    # 权限错误
    const ILLEGAL_PARAMS = 3;    # 参数不合法
    const PASSWORD_ERROR = 101;  # 账号密码错误
    const OTHER          = 998;  # 其他
    const UNKNOW_ERROR   = 999;  # 未知

    //不需要验证登录的方法
    const NO_LOGIN_METHOD = [
        'login',
        'needClear',
        'clearCache',
        'verify',
    ];
    //错误码

    //不需要验证权限的方法
    const NO_AUTH_METHOD = [
        'logout',
        'getMenu',
        'checkLoginStatus',
    ] ;

    public function __construct(){
        parent::__construct();
        // 验证登录信息
        if( !(in_array(ACTION_NAME, self::NO_LOGIN_METHOD) 
            || $_SESSION['userInfo']) ){
            $this->ajaxError(
                self::WITHOUT_LOGIN,
                'WITHOUT_LOGIN'
            );
        }
    }

    protected function _checkAuth(){
        if(!isset($_SESSION['auth_info'][CONTROLLER_NAME  . '-' . ACTION_NAME])){
            $auth_model = new ConfigAuthModel($_SESSION['userInfo']);
            $_SESSION['auth_info'][CONTROLLER_NAME  . '-' . ACTION_NAME] = boolval($auth_model->getMethodRole());
        }
        return $_SESSION['auth_info'][CONTROLLER_NAME  . '-' . ACTION_NAME];
    }

    protected function ajaxSuccess($data = 'SUCCESS'){
        $this->ajaxReturn([
            'error'    =>  self::SUCCESS,
            'message'  =>  'SUCCESS',
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
        $target = null;
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
            if(gettype($check_function[$i]) === 'object' || gettype($check_function[$i]) === 'string'){
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