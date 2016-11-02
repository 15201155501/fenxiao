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
        $lefts = A('Home/Common');
        $left=$lefts->left();
        $this->assign('userinfo',$left);
        $this->display('passthree');
    }
    /***
     *  会员激活
     */
    public function activation(){
        $lefts = A('Home/Common');
        $left=$lefts->left();
        $this->assign('userinfo',$left);
        $this->display();
    }
}