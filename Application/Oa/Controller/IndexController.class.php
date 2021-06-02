<?php
namespace Oa\Controller ;

class IndexController extends \Think\Controller
{
    function index(){
        // phpinfo();
        $data = M('user')->select();
        // print_r($data);
        $this->ajaxReturn($_SESSION['userInfo']);
    }
    
    public function login(){
        $map['username'] = $_GET['username'];
        $map['password'] = $_GET['password'];
        $res = M('user')
            ->where($map)
            ->find();
        $returnData = [
            'state' => $res?'200':'500',
            'message' => $res?'success':'failt',
            'data' => $res,
        ];
        if($res) $_SESSION['userInfo'] = $res;
        $this->ajaxReturn($returnData);
    }
}
