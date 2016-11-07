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
        if(empty(I('post.password2')) && empty(I('p'))){
            $this->display('passtwo');
        }else{
            //获取提交的表单数据
            $pwd = I('post.password2');
            //获取登录的用户id
            $map['HyNumber'] = session('hynumber');
            $res = M('hyclub')->where($map)->find();

            if($res && $res['hypassword2']==$pwd || !empty(I('p'))){
                //设置查询条件
                $map['HyNumber'] = session('hynumber');
                $User = M('hymoneydailylog'); // 实例化User对象
                $count      = $User->where($map)->count();// 查询满足要求的总记录数
                $Page       = $this->getpage($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
                $show       = $Page->show();// 分页显示输出
                // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
                $sql = "SELECT `ID`,`HyNumber`,`Bonus1`,`Bonus2`,`Bonus3`,`Bonus4`,`Bonus5`,`Bonus6`,`Bonus7`,`Bonus8`,`Bonus9`,`Bonus10`,`Bonus11`,`Bonus12`,`Bonus13`,`Bonus14`,`Bonus15`,`BonusAmount`,`SendBonusAmount`,`Times`,`ComputeTime`,`SendTime`,`Memo`,`IsApproved`,(`SendBonusAmount`*0.1-`Bonus10`*0.1) as `shuizafei`,(`SendBonusAmount`*0.9+`Bonus10`*0.1) as `SendBonusAmount2` FROM `hymoneydailylog` WHERE `HyNumber` = '$map[HyNumber]' ORDER BY ID LIMIT $Page->firstRow,$Page->listRows";
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
     * 左侧公共信息页面
     */
    public function userinfo(){
        $lefts = A('Home/Public');
        $left=$lefts->left();
        $this->assign('userinfo',$left);
    }
}