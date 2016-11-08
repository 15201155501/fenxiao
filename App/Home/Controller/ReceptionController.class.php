<?php
namespace Home\Controller;
use Think\Controller;
class ReceptionController extends CommonController {
    /**
     * 商城首页
     * @author  spc <15201155501@163.com>
     * @version 1.0
     * @param list 商品信息
     */
    public function index(){
        //左侧公共部分
        $this->userinfo();
        //获取登录的会员编号
        $hynumber = session('hynumber');

        //查询商品信息
        $User = M('xnproc'); // 实例化User对象
        $count      = $User->count();// 查询满足要求的总记录数

        $Page       = $this->getpage($count,6);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->limit($Page->firstRow.','.$Page->listRows)->select();

        // print_r($User->getLastSql());
        // echo "<pre>";
        // print_r($list);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出

        $this->display();
    }

    /**
     * 商品详情
     * @author  spc <15201155501@163.com>
     * @version 1.0
     * @param arr 商品详情信息
     */
    public function goods_info(){

    }

    /**
     * 订单详情
     * @author  spc <15201155501@163.com>
     * @version 1.0
     * @param arr 订单详情信息
     */
    public function order_info(){

    }

    /**
     * 订单查询
     * @author  spc <15201155501@163.com>
     * @version 1.0
     * @param list 订单信息
     */
    public function order(){
        //左侧公共部分
        $this->userinfo();
        $hynumber = session('hynumber');

        //获取登录人的主键ID
        $user = M('hyclub')->where("HyNumber = '$hynumber'")->find();
        // print_r($user);die;

        //设置查询条件
        $map['dfstate']=1;
        $map['dmid']=$user['id'];

        //根据订单号查询
        if(I('post.did') != null){
            $map['dId'] = empty(I('post.did')) ? '' : I('post.did');
            $this->assign('did',$map['dId']);
        }

        //根据日期查询
        $s_time = empty(I('post.s_time')) ? '' : I('post.s_time');
        $e_time = empty(I('post.e_time')) ? '' : I('post.e_time');

        if($s_time != null && $e_time != null){
            $where = "ddate > '$s_time' AND ddate < '$e_time'";
        }else{
            $where = '1';
        }

        // print_r($where);
        //查询
        $User = M('ddgldl'); // 实例化User对象
        $count      = $User->where($map)->where($where)->count();// 查询满足要求的总记录数
        // print_r($User->getLastSql());
        // echo $count;
        $Page       = $this->getpage($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->table("ddgldl a")
            ->where($map)
            ->where($where)
            ->join("hyclub b on a.dmid = b.ID")
            ->order('did','desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->field("a.dId,a.ddetails,a.dfstate,a.wlzt, b.HyName,b.HyMobile,b.hyzipcode,b.hymail,b.hymemo,b.HyAddress,a.ddate,b.iswuliu,b.HyNumber")
            ->select();

        // print_r($User->getLastSql());
        // echo "<pre>";
        // print_r($list);die;
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        //渲染模板
        $this->display();
    }

    /**
     * 左侧公共信息页面
     */
    public function userinfo(){
        $lefts = A('Home/Public');
        $left=$lefts->left();
        $this->assign('userinfo',$left);
    }
}