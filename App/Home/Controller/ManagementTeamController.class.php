<?php
namespace Home\Controller;
use Think\Controller;
class ManagementTeamController extends CommonController {
    public function select(){
        $lefts = A('Home/Public');
        $left=$lefts->left();
        $this->assign('userinfo',$left);
        $Model = M("hyclub");
        $hynumber =session('hynumber');
        $ParentNumber =I('ParentNumber');
        if(!empty($ParentNumber)){
             $vartionum=$Model->where("HyNumber='$ParentNumber'")->field('HyNumber')->find();

             if(empty($vartionum)){
                 echo "<script language='javascript' type='text/javascript'>alert('该用户不存在')</script>";
                 $wheres =$hynumber;
             }else{
                 $wheres =$ParentNumber;
             }

        }else{
            $wheres = $hynumber;
        }

        $UserMember=$Model->where("HyNumber='$wheres'")->field("HyJoinInvest,ALeftPoints,BLeftPoints,ALeftPersonNums,BLeftPersonNums,CLeftPoints,AUsedPoints,BUsedPoints,CUsedPoints,HyName, HyNumber, HyparentNumber, jiedianyejiall")->find();
        $this->assign('UserMember',$UserMember);

        $UserModel=$Model->where("HyParentNumber='$wheres'")->field("ID,IsApproved,HyNumber,HyName,HyLocation")->select();

            $this->assign('UserModel',$UserModel);
        $numarray = $this->MemberSystem();
       /* $wall2 ='5000';
        $getwall2 =($wall2*0.35)*0.9;
        $hyparentnumber= $numarray[0]['hyparentnumber'];
        $ewallet2 =$Model->where("HyNumber='$hyparentnumber'")->setInc('eWallet2',$getwall2);*/
        //获取顶层会员信息
        $count =count($numarray)-1;
        $top = $numarray[$count];
        $pnumber =$top['hynumber']; //获取
        $newdata=  $this->PcSystem($pnumber,$count);
       // print_r($top);
        $a = array();
        $b = array();
        for($i=0;$i<count($newdata);$i++){
            for($j=$i+1;$j<count($newdata);$j++){
                if($newdata[$i]['level'] == $newdata[$j]['level']){
                    $a[] = $newdata[$i];
                    $b[] = $newdata[$j];
                }
            }
        }
       /* echo "<pre>";
        print_r($newdata);
        echo "</pre>";exit;

        echo "<pre>";
        print_r(array_merge($a,$b));
        echo "</pre>";

exit;*/

        $this->display();
    }

    public function MemberSystem(){
        $Model = M("hyclub");
        $number ='534415';
        $arr = $Model->field("HyNumber,HyParentNumber,HyTjNumber,IsApproved,HyLocation")->select();
        return $this->_tree($arr,$hyparent=$number,$leve=0);
    }
    //递归 用户信息
    public function _tree($arr,$hyparent,$level=0){
        static $data = array();
        foreach ($arr as $k => $v) {
            if($v['hynumber']==$hyparent){
                $v['level'] = $level;
                $data[] = $v;
                $data = $this->_tree($arr,$v['hyparentnumber'],$level+1);
            }
        }
        return $data;
    }

    public function PcSystem($number,$count){
        $Model = M("hyclub");
        $arr = $Model->field("HyNumber,HyParentNumber,HyTjNumber,IsApproved,HyLocation")->select();
        return $this->_number($arr,$hyparent=$number,$count,$leve=0);
    }

    public function _number($arr,$hyparent,$count,$level=0){
        static $data = array();
        foreach ($arr as $k => $v) {
            if ($level >$count){
                break;
            }
            if($v['hyparentnumber']==$hyparent){
                $v['level'] = $level;
                $data[] = $v;

                $data = $this->_number($arr,$v['hynumber'],$count,$level+1);
            }
        }
        return $data;

    }



    /***
     *  报单显示页面
     */
    public function Declaration(){
        $lefts = A('Home/Public');
        $left=$lefts->left();
        $location =I('location'); //A B
        $this->assign('userinfo',$left);
        $this->assign('location',$location);

        $this->display();
    }

    /**
     * 验证转账账号
     */
    public function VerificationAccount(){
        $hynumber =I('hynumber'); //接受账号
        $Model = M("hyclub");
        $hynuber=$Model->where("HyNumber='$hynumber'")->field('HyNumber')->find();

        if(empty($hynuber)){
            echo 1;
        }else{
            echo 0; //账号不存在，验证成功
        }

    }
    /**
     * 验证推荐人编号
     */
    public function HyTjNumber(){
        $HyTjNumber =I('HyTjNumber'); //接受账号
        $Model = M("hyclub");
        $hynumber =session('hynumber');
        $HyName=$Model->where("HyNumber='$HyTjNumber' AND IsApproved='1'")->field('HyName')->find();

        if(!empty($HyName)){
            echo json_encode(array(
                'hyname' => $HyName['hyname']
            ));

        }else{
            echo 0;
        }

    }
    /***
     *添加会员信息
     */
    public function adduserinfo(){

        $data['HyNumber'] = I('HyNumber');
        $Number =$data['HyNumber'];
        $Model =M('hyclub');
        $data['HyAddress'] = I('HyAddress');
        $data['HyName'] = I('HyName');
        $data['HyLevel1'] = I('HyLevel1');
        $hynumber =session('hynumber');

        $data['HyOpenBank'] = I('HyOpenBank');
        $data['HyCardNo'] = I('HyCardNo');
        $data['HyOpenBankNo'] = I('HyOpenBankNo');
        $data['HyMobile'] = I('HyMobile');
        $data['HyOpenBankName'] = I('HyOpenBankName');
        $data['HyQQMSN'] = I('HyQQMSN');
        $data['HyAddress'] = I('HyAddress');
        $data['HyMail'] = I('HyMail');
        $data['HyOpenBankAddress'] = I('HyOpenBankAddress');
        $data['HyTjNumber'] = I('HyTjNumber');
        $data['HyParentNumber'] = I('HyParentNumber');
        $data['eWallet1'] = 0;
        $data['eWallet2'] = 0;
        $data['eWallet3'] = 0;

         $data['HyLocation'] = I('HyLocation');
        $data['HySex'] = I('HySex');
         $data['daili'] = I('daili');
        $data['IsApproved'] = 0;

        $data['BelongWuliuNumber'] = $hynumber;



        $data['HyPassword'] = I('HyPassword');
        $data['HyPassword2'] = I('HyPassword2');
        $data['HyPassword3'] = I('HyPassword3');


        $res = $Model->where("HyNumber='$Number'")->add($data);

        $hynuber_id=$Model->where("HyNumber='$hynumber'")->field('ID')->find();

        $ddglModel =M('ddgl');

        if($res){
            echo $data['HyLevel1'];
            if($data['HyLevel1'] ==1){

            // $res= $Model->where("HyNumber='$hynumber'")->setDec('eWallet1',5000);
                $Model->where("HyNumber='$Number'")->setInc('eWallet2',5000);

            }elseif($data['HyLevel1'] ==2){
              //  $res= $Model->where("HyNumber='$hynumber'")->setDec('eWallet1',10000);
                $rs= $Model->where("HyNumber='$Number'")->setInc('eWallet2',10000);
            }
            $dat['wlmid']=$hynuber_id['id'];
            $ddgl =$ddglModel->add($dat);

            $result['addinfo'] = '添加个人信息成功';
        }else{
            $result['addinfo'] = '添加个人信息失败';
        }

        //$this->assign('result',$result);
       // $this->display('success');
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
        $hynumber =session('hynumber');
        $UserModel=$Model->where("HyNumber='$hynumber'")->field('hypassword3')->find();
        if($hypassword3==$UserModel['hypassword3']){
            session('hypassword3',$UserModel['hypassword3']);
            $this->redirect("ManagementTeam/activation");
        }else{
            echo '密码错误';
        }


    }


    /***
     *  会员激活
     */
    public function activation(){
        $hynum_search =I('hynumber');

        $hypassword3 =session('hypassword3'); //验证密码是否填写
        $Model = M("hyclub");
        $hynumber =session('hynumber');
        $UserModel=$Model->where("HyNumber='$hynumber'")->field('hypassword3')->find();
        if($hypassword3 !=$UserModel['hypassword3']){
            $this->redirect("ManagementTeam/password_authentication");
        }
        $lefts = A('Home/Public');
        $left=$lefts->left();
        $this->assign('userinfo',$left);

        $count      = $Model->where("BelongWuliuNumber='$hynumber'")->count();// 查询满足要求的总记录数
        $Page =$this->getpage($count,3);

        // $Page       = new \Think\Page($count,1);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        if(!empty($hynum_search)){


            $list=$Model->table('hyclub h')
                ->field('h.ID,h.HyJoinInvest,h.HyNumber,h.hyname,h.IsApproved,h.ApprovedTime,h.HyParentNumber,h.hytjnumber,h.RegisterTime,d.wlmid,d.dmeonty')
                ->join('LEFT JOIN ddgl d ON d.wlmid = h.ID')
                ->order('h.RegisterTime desc')
                ->where("h.hynumber='$hynum_search' AND h.IsApproved='1'")
                ->limit($Page->firstRow.",".$Page->listRows)
                ->select();
        }else{
            $list=$Model->table('hyclub h')
                ->field('h.ID,h.HyJoinInvest,h.HyNumber,h.hyname,h.IsApproved,h.ApprovedTime,h.HyParentNumber,h.hytjnumber,h.RegisterTime,d.wlmid,d.dmeonty')
                ->join('LEFT JOIN ddgl d ON d.wlmid = h.ID')
                ->order('h.RegisterTime desc')
                ->where("h.BelongWuliuNumber='$hynumber'")
                ->limit($Page->firstRow.",".$Page->listRows)
                ->select();
        }

        // $Demo->join('RIGHT JOIN think_work ON think_artist.id = think_work.artist_id' );

        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出*/
        $this->display();
    }
    //激活用户
    public function Activate_immediately(){
        $Model = M("hyclub");
        $ID= I('id');
        $hyparent= I('hyparent');


        $data['IsApproved'] = '1';
        $data['ApprovedTime'] = date("Y-m-d H:i:s");
        $immediately=$Model->where('ID='.$ID)->save($data);

        if($immediately){
        $this->MemberSystem($hyparent);

            echo 1;
        }else{
            echo 0;
        }
    }



        //会员激活删除
    public function Activate_delete(){

    }
    /***
     *  营销关系 二级密码验证
     */
    public function PassTwo(){
        $lefts = A('Home/Public');
        $left=$lefts->left();
        $this->assign('userinfo',$left);
        $this->display('passtwo');
    }
    /***
     *  二级填写密码验证
     */
    public function Password_Verification(){
        $hypassword2= I('password2');

        $Model = M("hyclub");
        $hynumber =session('hynumber');
        $UserModel=$Model->where("HyNumber='$hynumber'")->field('hypassword2')->find();

        if($hypassword2==$UserModel['hypassword2']){
            session('hypassword2',$UserModel['hypassword2']);
            $this->redirect("ManagementTeam/Marketing");
        }else{
            echo '密码错误';
        }


    }
/*
 * 营销关系
 */
    public function Marketing(){
        $lefts = A('Home/Public');
        $left=$lefts->left();
        $this->assign('userinfo',$left);
       // $hypassword2 =session('hypassword2'); //验证密码是否填写
        $Model = M("hyclub");
        $hynum_search =I('hynumber');
        $hynumber =session('hynumber');
        if(empty($hynum_search)){
            $list = $Model->query("select HyClub.ID,HyClub.HyJoinInvest as hytotal, HyClub.ApprovedTime,HyClub.HyAmountInvest1,   case   HyClub.HyJoinInvest when '5000' then '1' when '10000'  then '2' when '15000'  then '3' end HyJoinInvest  ,HyClub.RegisterTime,case HyClub.BUsedPoints when '1' then 'vip2' else 'vip1' end BUsedPoints,HyClub.HyNumber,HyClub.HyTjNumber,HyClub.IsApproved,HyClub.HyParentNumber,HyClub.HyName,grid.gname from grid,HyClub  where HyClub.HyParentNumber='$hynumber' and grid.gid=HyClub.HyLevel2");
        }else{
            $list = $Model->query("select HyClub.ID,HyClub.HyJoinInvest as hytotal, HyClub.ApprovedTime,HyClub.HyAmountInvest1,   case   HyClub.HyJoinInvest when '5000' then '1' when '10000'  then '2' when '15000'  then '3' end HyJoinInvest  ,HyClub.RegisterTime,case HyClub.BUsedPoints when '1' then 'vip2' else 'vip1' end BUsedPoints,HyClub.HyNumber,HyClub.HyTjNumber,HyClub.IsApproved,HyClub.HyParentNumber,HyClub.HyName,grid.gname from grid,HyClub  where HyClub.HyParentNumber='$hynumber' and   grid.gid=HyClub.HyLevel2 and HyClub.HyNumber='$hynum_search'");
        }
       $this->assign('list',$list);
        $this->display();
    }

    /***
     * 申请代理
     */
    public function Agent(){
        $lefts = A('Home/Public');
        $left=$lefts->left();
        $this->assign('userinfo',$left);
        $hynumber =session('hynumber');
        $this->assign('hynumber',$hynumber);
        $this->display();
    }
    /***
     * 提交申请代理
     */
    public function Application_Agent(){
        $data['tmid'] =session('hynumber');

        $data['tsum'] =0;
        $data['tsign'] =0;
        $data['tlg'] =0;
        $data['tdate'] = I('tdate');
        $data['taddress'] = I('taddress');
        $data['tnote'] = I('tnote');
        $hynumber =session('hynumber');
        $Model = M("trueshop");
       $IsAgent= $Model->where("tmid='$hynumber'")->find();
       if(empty($IsAgent)){
           $Agent=$Model->add($data);
           if($Agent){
               $this->success('申请成功');
           }
       }else{
           $this->success('您已经提交过该申请','ManagementTeam/Agent');
       }


    }




}