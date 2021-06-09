<?php
namespace Oa\Controller ;

use Oa\Controller\AuthController;

class IndexController extends AuthController
{
    function index(){
        // phpinfo();
        $data = M('user')->select();
        // print_r($data);
        $this->ajaxReturn($_SESSION['userInfo']);
    }
    
    public function login(){
        $map['username'] = $_POST['username'];
        $map['password'] = $_POST['password'];
        $res = M('user')
            ->where($map)
            ->find();
        $returnData = [
            'state' => $res?$SUCCESS:$PASSWORD_ERROR,
            'message' => $res?'success':'failt',
            'data' => $res,
        ];
        if($res) $_SESSION['userInfo'] = $res;
        $this->ajaxReturn($returnData);
    }
}
