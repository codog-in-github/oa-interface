<?php
namespace Oa\Controller ;

class AuthController extends \Think\Controller
{

    const NO_LOGIN_METHOD =[
        'login',
    ];
    const SUCCESS = 0;
    const WITHOUT_LOGIN = 1;
    const PASSWORD_ERROR = 2;

    
    const WITHOUT_TABLEID = 3;
    const CANNOT_FIND_RESULT = 4;

    public function __construct(){
        parent::__construct();
        //验证登录信息
        if( !(in_array(ACTION_NAME,self::NO_LOGIN_METHOD) || $_SESSION['userInfo']) ){
            $this->ajaxReturn([
                'error'   =>  self::WITHOUT_LOGIN,
                'message' => 'WITHOUT_LOGIN',
                'data'    => []
            ]);
        }
    }

    protected function  sqlResultAjaxReturn($model){
        if($model->dataRow > 0){
            $this->ajaxReturn([
                'error'=>self::SUCCESS,
                'message'=>'success',
                'data'=>$model->data,
            ]);
        } else {
            $this->ajaxReturn([
                'error'=>self::CANNOT_FIND_RESULT,
                'message'=>'CANNOT_FIND_RESULT',
                'data'=>[],
            ]);
        }
    }
}