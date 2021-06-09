<?php
namespace Oa\Controller ;

class AuthController extends \Think\Controller {

    public function __construct(){
        parent::__construct();
        //验证登录信息
        if(!$_SESSION['user']){
            $this->ajaxReturn([
                'error'=>1,
                'message'=>'未登录',
                'data' =>[]
            ]);
        }
    }
}