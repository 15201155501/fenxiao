<?php
namespace Home\Controller;
use Think\Controller;
class ManagementTeamController extends CommonController {
    public function select(){
        $this->display();
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
     * @param $count
     * @param int $pagesize
     * @return \Think\Page 分页样式
     */
    public function getpage($count, $pagesize = 10) {
        $p = new \Think\Page($count, $pagesize);
        $p->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $p->setConfig('prev', '上一页');
        $p->setConfig('next', '下一页');
        $p->setConfig('last', '末页');
        $p->setConfig('first', '首页');
        $p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $p->lastSuffix = false;//最后一页不显示为总页数
        return $p;
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

        $data['IsApproved'] = '1';
        $data['ApprovedTime'] = date("Y-m-d H:i:s");
        $immediately=$Model->where('ID='.$ID)->save($data);

        if($immediately){
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

    public function Marketing(){
        $lefts = A('Home/Public');
        $left=$lefts->left();
        $this->assign('userinfo',$left);
        $hypassword2 =session('hypassword2'); //验证密码是否填写
        $Model = M("hyclub");
        $hynumber =session('hynumber');
        $list = $Model->query("select HyClub.ID,HyClub.HyJoinInvest as hytotal, HyClub.ApprovedTime,HyClub.HyAmountInvest1,   case   HyClub.HyJoinInvest when '5000' then '1' when '10000'  then '2' when '15000'  then '3' end HyJoinInvest  ,HyClub.RegisterTime,case HyClub.BUsedPoints when '1' then 'vip2' else 'vip1' end BUsedPoints,HyClub.HyNumber,HyClub.HyTjNumber,HyClub.IsApproved,HyClub.HyParentNumber,HyClub.HyName,grid.gname from grid,HyClub  where HyClub.HyParentNumber='gs0003' and grid.gid=HyClub.HyLevel2");
        $this->assign('list',$list);
        echo "<pre>";
        print_r($list);
        echo "</pre>";
        $this->display();

    }
}