<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    //首页
    public function index(){
        $lefts = A('Home/Common');
        $left=$lefts->left();

        //左侧会员信息
        $this->assign('userinfo',$left);
        //print_r($left);

        //最新公告
        $notice = M('notice')->select();
        //print_r($notice);die;
        $this->assign('notice',$notice);

    	$this->display();
    }

    //首页详情
    public function index_info(){
        $lefts = A('Home/Common');
        $left=$lefts->left();

        //左侧会员信息
        $this->assign('userinfo',$left);

        //获取要查询的数据id
        $map['nid'] = I('nid');

        //公告详情
        $notice = M('notice')->where($map)->find();
        //print_r($notice);die;

        $this->assign('notice',$notice);

        //渲染模板
        $this->display();

    }

}