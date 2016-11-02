<?php
namespace Home\Controller;
use Think\Controller;
class ManagementTeamController extends Controller {
    public function select(){
    	$this->display();
    }

    /***
     * 会员激活 三级密码验证
     */
    public function passthree(){
        $lefts = A('Home/Public');
        $left=$lefts->left();
        $this->assign('userinfo',$left);
        $this->display('passthree');
    }
    /***
     *  填写密码验证
     */
    public function password_authentication(){
        $hypassword3= I('password3');
        $Model = M("hyclub");

        $UserModel=$Model->where("HyNumber='gs0003'")->field('hypassword3')->find();
        if($hypassword3==$UserModel['hypassword3']){

            $this->redirect("ManagementTeam/activation");
        }else{
            echo '密码错误';
        }


    }
    /***
     *  会员激活
     */
    public function activation(){
        
        $lefts = A('Home/Public');
        $left=$lefts->left();
        $this->assign('userinfo',$left);
        $this->display();
    }
}