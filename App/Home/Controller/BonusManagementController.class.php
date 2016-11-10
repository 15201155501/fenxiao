<?php
namespace Home\Controller;
use Think\Controller;
class BonusManagementController extends CommonController {
    /**
     * 每日奖金
     */
    public function bonus(){
        //左侧公共部分
        $this->userinfo();
        //判断用户是否输入过三级密码
        $p =I('p');
        $password2 =I('post.password2');
        if(empty($password2) && empty($p)){
            $this->display('passtwo');
        }else{
            //获取提交的表单数据
            $pwd = I('post.password2');
            //获取登录的用户id
            $map['HyNumber'] = session('hynumber');
            $res = M('hyclub')->where($map)->find();

            if($res && $res['hypassword2']==$pwd || !empty($p)){
                //设置查询条件
                $map['HyNumber'] = session('hynumber');
                $User = M('hymoneydailylog'); // 实例化User对象
                $count      = $User->where($map)->count();// 查询满足要求的总记录数
                $Page       = $this->getpage($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
                $show       = $Page->show();// 分页显示输出
                // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
                $sql = "SELECT `ID`,`HyNumber`,`Bonus1`,`Bonus2`,`Bonus3`,`Bonus4`,`Bonus5`,`Bonus6`,`Bonus7`,`Bonus8`,`Bonus9`,`Bonus10`,`Bonus11`,`Bonus12`,`Bonus13`,`Bonus14`,`Bonus15`,`BonusAmount`,`SendBonusAmount`,`Times`,`ComputeTime`,`SendTime`,`Memo`,`IsApproved`,(`SendBonusAmount`*0.1-`Bonus10`*0.1) as `shuizafei`,(`SendBonusAmount`*0.9+`Bonus10`*0.1) as `SendBonusAmount2` FROM `hymoneydailylog` WHERE `HyNumber` = '$map[HyNumber]' ORDER BY ID DESC LIMIT $Page->firstRow,$Page->listRows";
                $list = $User->query($sql);
                // print_r($User->getLastSql());
                // echo '<pre>';
                // print_r($list);die;
                $this->assign('list',$list);// 赋值数据集
                $this->assign('page',$show);// 赋值分页输出

                //渲染模板
                $this->display();
            }else{
                $this->error('密码输入错误');
            }
        }
    }

    /**
     * 奖金明细
     */
    public function bonus_info(){
        //左侧公共部分
        $this->userinfo();
        //设置查询条件
        $map['HyNumber'] = session('hynumber');
        $User = M('hybonusrecord'); // 实例化User对象
        $count      = $User->where($map)->count();// 查询满足要求的总记录数
        $Page       = $this->getpage($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->where($map)
            ->order('ID','desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();

        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出

        //渲染模板
        $this->display();
    }

    /**
     * 账目明细
     */
    public function account_details(){
        //左侧公共部分
        $this->userinfo();

        //获取当前登录用户
        $hynumber = session('hynumber');
        $User = M('hytranslog'); // 实例化User对象
        $count      = $User->where("HyNumberFrom='$hynumber' OR HyNumberTo = '$hynumber'")->count();// 查询满足要求的总记录数
        $Page       = $this->getpage($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->where("HyNumberFrom='$hynumber' OR HyNumberTo = '$hynumber'")
            ->order('ID','desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();

        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出

        //渲染模板
        $this->display();
    }

    /**
     * 申请股东
     */
    public function shareholder_add(){
        //左侧公共部分
        $this->userinfo();

        $hynumber = session('hynumber');
        //查询会员数据
        $data = M('hyclub') -> where("HyNumber='$hynumber'")->field('eWallet1,eWallet2,eWallet3,baodanfei')->find();
        // print_r($data);
        $this->assign('data',$data);

        //查询
        $User = M('afutou'); // 实例化User对象
        $count      = $User->where("applyhynumber='$hynumber' AND approvaltype = 'B'")->count();// 查询满足要求的总记录数
        $Page       = $this->getpage($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->query("select  approvalid,applyhynumber,applymoney,applydate,apphynumber,approvaldate,case approvaltype when 'B' then '复投' else '购买' end approvaltype,case approvalflag when 'Y' then '通过'when 'A' then'申请通过' when 'C' then'已取消' else '未通过' end approvalflag,BatchNo,remark from afutou where applyhynumber ='$hynumber' and   approvaltype='B' order by applydate desc LIMIT $Page->firstRow,$Page->listRows");
        // echo "<pre>";
        // print_r($count);die;
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        //渲染模板
        $this->display();
    }

    /**
     * 验证会员账号
     */
    public function VerificationAccount(){
        $hynumber =I('hynumber'); //接受账号
        $Model = M("hyclub");
        $hynuber=$Model->where("HyNumber='$hynumber' AND IsApproved='1'")->field('HyNumber')->find();
        if(!empty($hynuber)){
            echo 1;
        }else{
            echo 0;
        }

    }
    /***
     *  申请股东分红
     */
    public function AppayBonus(){
        $hynumber_session =session('hynumber');
        $approvaltype = I('approvaltype');
        $ewallet1 =I('ewallet1'); //接受账号
        $hynumber = I('hynumber');
        $hymumber_member = I('hymumber_member');
        $TransDate = date("Y-m-d H:i:s");
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