<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function left(){
    	//echo 1321221211;
    	$Model = M("hyclub");// 实例化hyclub对象
    	$userinfo=$Model->query("select HyNumber,StockLockedMoney,StockBurse,hylevel1,HyName,chijiang1,  (ALeftPoints+AUsedPoints) as aall, (BLeftPoints+BUsedPoints) as ball,chijiang2, HyJoinInvest1,ALeftPersonNums,bLeftPersonNums,iswuliu,BUsedPoints,hytjnumber,CUsedPoints,ALeftPoints,bLeftPoints,AUsedPoints,baodanfei,StockLockedMoney,StockNum ,aixinjijin,chijiang3, ApprovedTime,chongxiao,ewallet3,HyJoinInvest,qixian,lastqixian,fenhong,zongjiangjin,chijiang2,ewallet3, eWallet1,hylevel2,eWallet2,HyNumber from HyClub  where  id = 7");
		return $userinfo[0];
    }
}
?>