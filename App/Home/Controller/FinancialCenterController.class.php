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
    /**
     * 验证转账账号
     */
    public function VerificationAccount(){
        $hynumberto =I('hynumberto'); //接受账号
        $Model = M("hyclub");
        $hynuber=$Model->where("HyNumber='$hynumberto' AND IsApproved='1'")->field('HyNumber')->find();
        if(!empty($hynuber)){
            echo 1;
        }else{
            echo 0;
        }

    }

    /***
     * 提交转账
     */
    public function llreflec(){
        $hynumber =session('hynumber');
        $moneycount = I('moneycount');
        $hynumberto =I('hynumberto'); //接受账号
        $memo = I('memo');
        $passwd2 = I('passwd2');
        $data['ewallet1'] = I('ewallet1');
        $data['ewallet2'] = I('ewallet2');
        $TransDate = date("Y-m-d H:i:s");

        $Model = M("hyclub");
        $Hytranslog = M("hytranslog");
        $hynuber=$Model->where("HyNumber='$hynumberto' AND IsApproved='1'")->field('HyNumber')->find();
        if(empty($hynuber)){
            echo 4;
            return;
        }
        $hypassword2=$Model->where("HyNumber='$hynumber'")->field('HyPassword2')->find();

        if($hypassword2['hypassword2']!=$passwd2){
            echo '二级密码错误';
        }
        if($memo==25){
           // 实例化User对象

            $res= $Model->where("HyNumber='$hynumber'")->setDec('eWallet1',$moneycount);
            $rs= $Model->where("HyNumber='$hynumberto'")->setInc('eWallet1',$moneycount);
            $FromMoney=$Model->where("HyNumber='$hynumber'")->field('eWallet1,eWallet2')->find();
            $HyNumberFromMoney =$FromMoney['ewallet2'];
            $HyNumberTomoney =$FromMoney['ewallet1'];

           $log= $Hytranslog->execute("insert into hytranslog(HyNumberFrom,HyNumberTo,TransDate,TransType,Memo,HyNumberFromMoney,HyNumberTomoney,MoneyCount) VALUES('$hynumber','$hynumberto','$TransDate',$memo,'注册币转注册币',$HyNumberFromMoney,$HyNumberTomoney,$moneycount)");

            if($res && $rs && $log){
                echo 1;
            }else{
                echo 0;
            }
        }else if($memo==26){
          /*  $eWallet2=$Model->where("HyNumber='$hynumber'")->field('eWallet2')->find();
            if($moneycount > $eWallet2){
                echo "金币不够";
            }*/
            $res= $Model->where("HyNumber='$hynumber'")->setDec('eWallet2',$moneycount);
            $rs= $Model->where("HyNumber='$hynumberto'")->setInc('eWallet2',$moneycount);
            $FromMoney=$Model->where("HyNumber='$hynumber'")->field('eWallet1,eWallet2')->find();
            $HyNumberFromMoney =$FromMoney['ewallet2'];
            $HyNumberTomoney =$FromMoney['ewallet1'];
            $log= $Hytranslog->execute("insert into hytranslog(HyNumberFrom,HyNumberTo,TransDate,TransType,Memo,HyNumberFromMoney,HyNumberTomoney,MoneyCount) VALUES('$hynumber','$hynumberto','$TransDate',$memo,'奖金币转奖金币',$HyNumberFromMoney,$HyNumberTomoney,$moneycount)");
            if($res && $rs && $log){
                echo 2;
            }else{
                echo 3;
            }
        }
    }

    /***
     *  提现 展示
     */
    public function  Withdraw(){
        $UserModel=M('hyclub');
        $lefts = A('Home/Public');
        $left=$lefts->left();
        $this->assign('userinfo',$left);
        $hynumber =session('hynumber');
        $Model =M('getmoney1');



        $userinfo_num=$UserModel->where("HyNumber='$hynumber'")->field('eWallet1,eWallet2')->find();


        $count  = $Model->where("gmncikname='$hynumber'")->count();// 查询满足要求的总记录数
        $Page =$this->getpage($count,2);
        $show       = $Page->show();// 分页显示输出
        $list = $Model->where("gmncikname='$hynumber'")->order('gdate desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('userinfo_num',$userinfo_num);
        $this->assign('list',$list);
        $this->assign('hynumber',$hynumber);
        $this->assign('page',$show);// 赋值分页输出*/

        $this->display('withdraw');
    }
    /**
     * 申请提现
     */
    public function Application(){
        $hynumber =session('hynumber');

        $passwd2 = I('passwd2');
        $amountmoney= I('amountmoney');
        $ewallet2= I('ewallet2');
        $TransDate = date("Y-m-d H:i:s");
        $Model = M("hyclub");
        $Hytranslog =M("getmoney1");
        $hypassword2=$Model->where("HyNumber='$hynumber'")->field('HyPassword2')->find();
        if($hypassword2['hypassword2']!=$passwd2){
            echo '二级密码错误';
        }
        $res= $Model->where("HyNumber='$hynumber'")->setDec('eWallet2',$amountmoney);
        $log= $Hytranslog->execute("insert into getmoney1(gmncikname,grename,gsxf,gsgin,gdate,glx,gmoney) VALUES('$hynumber','$hynumber',0,0,'$TransDate','奖金币提现',$amountmoney)");

        if($res && $log){
            echo 1;
        }else{
            echo 0;
        }


    }





}