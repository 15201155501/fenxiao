<?php
namespace Home\Controller;
use Think\Controller;
class InfoSafetyController extends CommonController {
    /**
     * 修改个人资料
     */
    public function info_upd(){
        //判断是否输入过三级密码
        $pwd3 = I('post.password3');
        if(empty($pwd3)){
            $lefts = A('Home/Public');
            $left=$lefts->left();
            $this->assign('userinfo',$left);
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

    /**
     * 修改密码
     */
    public function pwd_upd(){
        //左侧公共部分
        $lefts = A('Home/Public');
        $left=$lefts->left();
        $this->assign('userinfo',$left);
        //判断是否表单提交
        $data = I('post.');
        if(empty($data)){
            $this->display();
        }else{

            //获取登录的用户id
            $map['HyNumber'] = session('hynumber');
            $tb = M('hyclub');
            //判断是修改的几级密码
            $act = I('get.act');
            if(!empty($act) && $act=='pwd1'){
                $map['HyPassword'] = $data['HyPassword'];
                if($data['pwd'] == $data['qrpwd']){
                    $res = $tb->where($map)->find();
                    if($res){
                        $arr['HyPassword'] = $data['pwd'];
                        $tb->where('ID='.$res['id'])->save($arr);
                        session('hynumber',null);
                        $result['pwd_code'] = 1;
                        $result['pwd_info'] = '修改成功,请重新登录！';

                    }else{
                        $this->error('原密码有误');
                    }
                }else{
                    $this->error('两次密码不一致');
                }
            }
            if(!empty($act) && $act=='pwd2'){
                $map['HyPassword2'] = $data['HyPassword2'];
                if($data['pwd'] == $data['qrpwd']){
                    $res = $tb->where($map)->find();
                    if($res){
                        $arr['HyPassword2'] = $data['pwd'];
                        $tb->where('ID='.$res['id'])->save($arr);
                        $result['pwd_code'] = 2;
                        $result['pwd_info'] = '修改成功';
                    }else{
                        $this->error('原密码有误');
                    }
                }else{
                    $this->error('两次密码不一致');
                }
            }
            if(!empty($act) && $act=='pwd3'){
                $map['HyPassword3'] = $data['HyPassword3'];
                if($data['pwd'] == $data['qrpwd']){
                    $res = $tb->where($map)->find();
                    if($res){
                        $arr['HyPassword3'] = $data['pwd'];
                        $tb->where('ID='.$res['id'])->save($arr);
                        $result['pwd_code'] = 3;
                        $result['pwd_info'] = '修改成功';
                    }else{
                        $this->error('原密码有误');
                    }
                }else{
                    $this->error('两次密码不一致');
                }
            }

            $this->assign('result',$result);
            $this->display('pwd_suc');
        }
    }
}