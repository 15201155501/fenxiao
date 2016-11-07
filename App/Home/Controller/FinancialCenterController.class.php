<?php
namespace Home\Controller;
use Think\Controller;
class FinancialCenterController extends CommonController {
    public function Verification(){
        $lefts = A('Home/Public');
        $left=$lefts->left();
        $this->assign('userinfo',$left);
        $this->display('passtwo');
    }

    public function Password_Verification(){
        $hypassword2= I('password2');

        $Model = M("hyclub");
        $hynumber =session('hynumber');
        $UserModel=$Model->where("HyNumber='$hynumber'")->field('hypassword2')->find();

        if($hypassword2==$UserModel['hypassword2']){
            session('pvercation',$UserModel['hypassword2']);
            $this->redirect("FinancialCenter/external_transfer");
        }else{
            echo '密码错误';
        }


    }



    public function external_transfer(){
        $lefts = A('Home/Public');
        $left=$lefts->left();
        $this->assign('userinfo',$left);
        $Model=M('hytranslog');
        $UserModel=M('hyclub');
        $hynumber =session('hynumber');
       $userinfo = $UserModel->field('BUsedPoints,StockNum,eWallet1,eWallet2,baodanfei')->where("HyNumber='$hynumber'")->select();


        $count      = $Model->where("(TransType =25 or  TransType =26 or  TransType =27 or  TransType =28 or  TransType =229 or  TransType =30) and (HyNumberFrom ='$hynumber'  or  HyNumberto ='$hynumber')")->count();// 查询满足要求的总记录数
        $Page =$this->getpage($count,2);
        $show       = $Page->show();// 分页显示输出
        $list = $Model->where("(TransType =25 or TransType =26 or TransType =27 or TransType =28 or TransType =229 or TransType =30) and (HyNumberFrom ='$hynumber'  or  HyNumberto ='$hynumber')")->order('TransDate desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出*/

        $this->display();
    }
}