<?php
namespace Home\Controller;
use Think\Controller;
class InfoSafetyController extends CommonController {
    /**
     * 修改个人资料
     */
    public function info_upd(){
        //判断是否输入过三级密码
        if(empty(I('post.password3'))){
            $this->display('passthree');
        }else{
            //获取提交的表单数据
            $pwd = I('post.password3');
            //获取登录的用户id
            $map['HyNumber'] = session('hynumber');
            $res = M('hyclub')->where($map)->find();

            if($res && $res['hypassword3']==$pwd){
                $this->assign('userinfo',$res);

                //渲染模板
                $this->display();
            }else{
                $this->error('密码输入错误');
            }
        }
    }

    /**
     * 修改个人资料-修改
     */
    public function info_upd_pro(){
        // 获取要修改的用户数据
        $data = I('post.');
        // print_r($data);die;

        $res = M('hyclub')->where('ID='.$data['id'])->save($data);
        // print_r($res);die;
        if($res){
            $this->redirect('InfoSafety/info_upd');
        }
    }
}