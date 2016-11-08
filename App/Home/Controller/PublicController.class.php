<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends CommonController {
    public function left(){
        $Model = M("hyclub");// 实例化hyclub对象
        $hynumber =session('hynumber');

        $userinfo=$Model->query("select ID,HyNumber,StockLockedMoney,StockBurse,hylevel1,HyName,chijiang1,  (ALeftPoints+AUsedPoints) as aall, (BLeftPoints+BUsedPoints) as ball,chijiang2, HyJoinInvest1,ALeftPersonNums,bLeftPersonNums,iswuliu,BUsedPoints,hytjnumber,CUsedPoints,ALeftPoints,bLeftPoints,AUsedPoints,baodanfei,StockLockedMoney,StockNum ,aixinjijin,chijiang3, ApprovedTime,chongxiao,ewallet3,HyJoinInvest,qixian,lastqixian,fenhong,zongjiangjin,chijiang2,ewallet3, eWallet1,hylevel2,eWallet2,HyNumber from HyClub  where  HyNumber = '$hynumber'");
        return $userinfo[0];
    }
}
?>