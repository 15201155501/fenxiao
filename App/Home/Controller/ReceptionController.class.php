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
        //获取商品id
        $xnprocid = I('get.xnprocid');

        //获取商品数据
        $arr = M('xnproc')->where('xnprocid = '.$xnprocid)->find();
        $this->assign('arr',$arr);

        $this->display();
    }

    /**
     * 加入购物车
     * @author  spc <15201155501@163.com>
     * @version 1.0
     * @param res 返回的bool值
     */
    public function order_add(){
        //获取商品id
        $xnprocid = I('post.xnprocid');
        // print_r($xnprocid);die;

        //获取登录的会员编号
        $hynumber = session('hynumber');

        //根据商品id查询商品信息
        $goods = M('xnproc')->where("xnprocid='$xnprocid'")->find();
        //获取会员信息
        $user = M('hyclub')->where("hynumber='$hynumber'")->find();

        // echo "<pre>";
        // print_r($goods);
        // print_r($user);

        //处理要加入购物车的数据
        $arr = array(
            'dmid' => $user['id'], //下单人id
            'ddate' => date('Y-m-d H:i:s'), //下单时间
            'ddetails' => "$goods[xnprocname]*1=$goods[xnmemprice]<br/>", //商品描述
            'dstate' => 1, //状态 1开始 0关闭
            'dfstate' => 0, //状态 1成功 0失败
            'dmeonty' => $goods['xnmemprice'], //商品价钱
            'dpv' => 0,
            'ddgstate' => 2, //订单状态
            'dls' => null, //订单时间加描述
            'dzfdate' => null, //支付时间
            'jf' => $goods['xnjf'], //积分
            'wlzt'=> 0, //发货状态
        );

        //加入购物车
        $res = M('ddgldl')->add($arr);

        if($res){
            $this->assign('res',array('title'=>'商品下单','content'=>'下单成功'));
            $this->display('success');
        }else{
            $this->assign('res',array('title'=>'商品下单','content'=>'下单失败'));
            $this->display('error');
        }
    }

    /**
     * 支付商品
     * @author  spc <15201155501@163.com>
     * @version 1.0
     * @param 返回信息
     */
    public function zhifu(){
        //获取当前登录用户会员编号，获取用户信息
        $hynumber = session('hynumber');
        $user = M('hyclub')->where("hynumber='$hynumber'")->find();

        $map['dId'] = I('get.did');

        // 获取要支付的订单详情
        $order = M('ddgldl')->where($map)->find();

        if($order['dmeonty']>$user['hyjoininvest1']){
            $this->assign('res',array('title'=>'支付订单','content'=>'您的余额不足，请充值后再支付'));
            $this->display('error');
        }else{
            // 减掉用户的对应金额
            $result = M('hyclub')->where("hynumber='$hynumber'")->setDec('HyJoinInvest1',$order['dmeonty']);
            if($result){
                //修改订单状态
                $arr = array(
                    'dstate' => 1, //状态 1成功 0失败
                    'dfstate' => 1, //状态 1成功 0失败
                    'ddgstate' => 2, //订单状态
                    'dls' => date('Y-m-d H:i:s').'支付虚购订单费用', //订单时间加描述
                    'dzfdate' => date('Y-m-d H:i:s'), //支付时间
                    'wlzt'=> 0, //发货状态
                );
                $dd = M('ddgldl');
                $rs = $dd->where($map)->save($arr);
                // print_r($dd->getLastSql());die;
                if($rs){
                    $this->assign('res',array('title'=>'支付订单','content'=>'支付成功'));
                    $this->display('success');
                }else{
                    echo 1;die;
                }
            }
        }
    }

    /**
     * 订单详情
     * @author  spc <15201155501@163.com>
     * @version 1.0
     * @param arr 订单详情信息
     */
    public function order_info(){
        //获取当前登录用户的会员编号
        $hynumber = session('hynumber');

        //获取登录人的主键ID
        $user = M('hyclub')->where("HyNumber = '$hynumber'")->find();
        //设置查询条件
        $map['dmid']=$user['id'];

        //查询
        $User = M('ddgldl'); // 实例化User对象
        $count      = $User->where($map)->count();// 查询满足要求的总记录数
        // print_r($User->getLastSql());
        // echo $count;
        $Page       = $this->getpage($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->table("ddgldl a")
            ->where($map)
            ->join("hyclub b on a.dmid = b.ID")
            ->order('ddate','desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->field("a.*,b.HyNumber,b.HyTel,b.HyName,b.HyMobile,b.HyAddress")
            ->select();

        // print_r($User->getLastSql());
        // echo "<pre>";
        // print_r($list);die;
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
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
            ->order('did desc')
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
     * 留言反馈
     * @author  spc <15201155501@163.com>
     * @version 1.0
     * @param mes 留言数据
     */
    public function message(){
        //左侧公共部分
        $this->userinfo();
        $mes = I('post.mes');
        $hynumber = session('hynumber');

        if(empty($mes)){
            $User = M('message'); // 实例化User对象
            $count      = $User->where("mmid = '$hynumber' OR mtoid ='100001'")->count();// 查询满足要求的总记录数
            // print_r($User->getLastSql());
            // echo $count;
            $Page       = $this->getpage($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $show       = $Page->show();// 分页显示输出
            // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $list = $User->where("mmid = '$hynumber' OR mtoid ='100001'")
                ->order('mdate desc')
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();

            $this->assign('list',$list);// 赋值数据集
            $this->assign('page',$show);// 赋值分页输出

            $this->display();
        }else{
            $arr = array(
                'mmid' => $hynumber,
                'mtitle' => '用户留言',
                'mcontent' => $mes,
                'mdate' => date('Y-m-d H:i:s'),
            );
            $rs = M('message')->add($arr);
            if($rs){
                echo 1;
            }else{
                echo 0;
            }
        }
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