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
        $userin =isset($userinfo[0]) ? $userinfo[0] : '';
        $count  = $Model->where("(TransType =25 or  TransType =26 or  TransType =27 or  TransType =28 or  TransType =229 or  TransType =30) and (HyNumberFrom ='$hynumber'  or  HyNumberto ='$hynumber')")->count();// 查询满足要求的总记录数
        $Page =$this->getpage($count,2);
        $show       = $Page->show();// 分页显示输出
        $list = $Model->where("(TransType =25 or TransType =26 or TransType =27 or TransType =28 or TransType =229 or TransType =30) and (HyNumberFrom ='$hynumber'  or  HyNumberto ='$hynumber')")->order('TransDate desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('hynumber',$hynumber);
        $this->assign('page',$show);// 赋值分页输出*/
        $this->assign('userin',$userin);
        $this->display();
    }

    /***
     * 提交转账
     */
    public function llreflec(){
        $hynumber =session('hynumber');
        $moneycount = I('moneycount');
        $hynumberto =I('hynumberto'); //接受账号
        $memo = I('memo');
        $data['passwd2'] = I('passwd2');
        $data['ewallet1'] = I('ewallet1');
        $data['ewallet2'] = I('ewallet2');
        $Model = M("hyclub");
        $hypassword2=$Model->where("HyNumber='$hynumber'")->field('HyPassword2')->find();

        if($hypassword2['hypassword2']!=$data['passwd2']){
            echo '二级密码错误';
        }

        if($memo==25){
           // 实例化User对象
            $eWallet1=$Model->where("HyNumber='$hynumber'")->field('eWallet1')->find();
           if($moneycount > $eWallet1){
              echo "币不够";
           }
            $res= $Model->where("HyNumber='$hynumber'")->setDec('eWallet2',$moneycount);
            $rs= $Model->where("HyNumber='$hynumberto'")->setInc('eWallet2',$moneycount);

            if($res && $rs){
                echo 1;
            }else{
                echo 0;
            }


        }else if($memo==26){
            $eWallet2=$Model->where("HyNumber='$hynumber'")->field('eWallet2')->find();
            if($moneycount > $eWallet2){
                echo "金币不够";
            }
            $res= $Model->where("HyNumber='$hynumber'")->setDec('eWallet2',$moneycount);
            $rs= $Model->where("HyNumber='$hynumberto'")->setInc('eWallet2',$moneycount);

            if($res && $rs){
                echo 2;
            }else{
                echo 3;
            }
        }




    }





}