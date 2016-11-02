<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    //登录
    public function login(){
        if(empty($_POST)){
           $this->display();
        }else{
            $code=I('post.code');
            $verify = new \Think\Verify();
            $res=$verify->check($code);
            if($res==false){
                $this->error('验证码有误，请重新输入');
            }
            //获取登录信息
            $map['HyNumber'] = I('HyNumber');
            $map['HyPassword'] = I('HyPassword');

            //判断是否是有效用户
            $res = M('hyclub')->where($map)->find();
            // print_r($res);die;
            if($res){
                session('hynumber',$res['hynumber']);
                // print_r(session('hynumber'));die;
                $this->redirect('Index/index');
            }else{
                $this->error('用户名或密码错误');
            }
        }
    }

    //生成验证码
    public function verify(){
        $Verify = new \Think\Verify();
        // 设置验证码字符为纯数字
        $Verify->codeSet = '0123456789';
        $Verify->entry();
    }
}