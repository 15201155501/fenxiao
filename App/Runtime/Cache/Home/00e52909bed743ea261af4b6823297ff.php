<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>留言反馈</title>
	<base href="/Public/" />
	<link rel="stylesheet" href="css/nsty.css" />
	<link rel="stylesheet" href="css/public.css" />
	<link rel="stylesheet" href="css/style.css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.SuperSlide.2.1.1.js"></script>
</head>
<body>
<div class="nbodybg"></div>
<div class="ncmtbox clearfix">
	<!-- 导航部分 -->
	<div class="nnavtop">
		<a href="javascript:;"class="nlogo"><img src="images/nlogo.png"></a>
		<ul id="nav" class="nav clearfix">
			<li class="nLi">
				<h3><a href="/index.php/Home">首页</a></h3>
			</li>
			<li class="nLi">
				<h3><a href="javascript:;" >管理团队<span></span></a></h3>
				<ul class="sub">
					<li>
						<a href="/index.php/Home/ManagementTeam/select">业绩查询</a>
					</li>
					<li>
						<a href="/index.php/Home/ManagementTeam/passthree">会员激活</a>
					</li>
					<li>
						<a href="/index.php/Home/ManagementTeam/PassTwo">营销关系</a>
					</li>
					<li>
						<a href="/index.php/Home/ManagementTeam/agent">申请服务中</a>
					</li>
				</ul>
			</li>
			<li class="nLi on">
				<h3><a href="javascript:;" target="_blank">财务中心<span></span></a></h3>
				<ul class="sub">
					<li>
						<a href="/index.php/Home/FinancialCenter/Verification">外部转币</a>
					</li>
					<li>
						<a href="/index.php/Home/FinancialCenter/Withdraw">申请提现</a>
					</li>
				</ul>
			</li>
			<li class="nLi ">
				<h3><a href="javascript:;" target="_blank">奖金管理<span></span></a></h3>
				<ul class="sub">
					<li>
						<a href="/index.php/Home/BonusManagement/bonus">每日奖金</a>
					</li>
					<li>
						<a href="/index.php/Home/BonusManagement/bonus_info">奖金明细</a>
					</li>
					<li>
						<a href="/index.php/Home/BonusManagement/account_details">账目明细</a>
					</li>
					<li>
						<a href="/index.php/Home/BonusManagement/shareholder_add">申请股东</a>
					</li>
				</ul>
			</li>
			<li class="nLi">
				<h3><a href="javascript:;" target="_blank">信息安全<span></span></a></h3>
				<ul class="sub">
					<li>
						<a href="/index.php/Home/InfoSafety/info_upd">个人资料</a>
					</li>
					<li>
						<a href="/index.php/Home/InfoSafety/pwd_upd">修改密码</a>
					</li>
				
				</ul>
			</li>
			<li class="nLi">
				<h3><a href="javascript:;" target="_blank">服务台<span></span></a></h3>
				<ul class="sub">
					<li>
						<a href="/index.php/Home/Reception/order">订单查询</a>
					</li>
					<li>
						<a href="/index.php/Home/Reception/index">在线商城</a>
					</li>
					<li>
						<a href="/index.php/Home/Reception/message">留言反馈</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>

	<div class="n_conmentbox">
		<!-- 左侧部分 -->
		<div class="n_cmtltbox">
			<a href="javascript:;"class="nphoto"><img src="images/npic1.png"></a>
			<dl>
				<dt>会员编号：</dt>
				<dd><?php echo ($userinfo['hynumber']); ?></dd>
			</dl>
			<dl>
				<dt>会员姓名：</dt>
				<dd><?php echo ($userinfo['hyname']); ?></dd>
			</dl>
			<dl>
				<dt>会员系统：</dt>
				<dd><?php echo ($userinfo['stocklockedmoney']); ?>元</dd>
			</dl>
			<dl>
				<dt>股东系统：</dt>
				<dd><?php echo ($userinfo['stockburse']); ?>元</dd>
			</dl>
			<dl>
				<dt>养老系统：</dt>
				<dd><?php echo ($userinfo['fenhong']); ?>元</dd>
			</dl>
			<dl>
				<dt>注册币：</dt>
				<dd><?php echo ($userinfo['ewallet1']); ?>元</dd>
			</dl>
			<dl>
				<dt>购物币：</dt>
				<dd><?php echo ($userinfo['hyjoininvest1']); ?>元</dd>
			</dl>
			<dl>
				<dt>奖金币：</dt>
				<dd><?php echo ($userinfo['ewallet2']); ?>元</dd>
			</dl>
			<dl>
				<dt>已购物：</dt>
				<dd><?php echo ($userinfo['chijiang2']); ?>元</dd>
			</dl>
			<dl>
				<dt>A市场：</dt>
				<dd><?php echo ($userinfo['aall']); ?>人</dd>
			</dl>
			<dl>
				<dt>B市场：</dt>
				<dd><?php echo ($userinfo['ball']); ?>人</dd>
			</dl>
		</div>
		
		<!-- 右侧部分 -->
		<div class="n_cmtrtbox">
			<div class="L_all">
				<!-- 留言反馈 -->
				<div class="L_person">
					<div class="L_person_tit">
						<span>最新公告</span>
					</div>
					<!--  -->
					<div class="L_new_mess">
						<ul>
							<?php if(is_array($notice)): $i = 0; $__LIST__ = $notice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
									<div class="L_new_mess1 clearfix">
										<span class="select">［最新公告］</span>
										<em><a href="/index.php/Home/Index/index_info?nid=<?php echo ($v["nid"]); ?>"><?php echo ($v["ntitle"]); ?></a></em>
										<b>
											<?php echo ($v["ndate"]); ?>
										</b>
									</div>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
					<div class="npage">
						<a href="javascript:;">上一页</a>
						<a href="javascript:;"class="pageon">1</a>
						<a href="javascript:;">2</a>
						<a href="javascript:;">3</a>
						<a href="javascript:;">下一页</a>
						<a href="javascript:;">共3页</a>
					</div>
				</div>
				<!-- 底部 -->
				<div class="L_footer">
					<p>提示:禁区(内容最多不要涉及到灰色区域)灰色区域开发时不显示</p>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery("#nav").slide({
		type: "menu", // 效果类型，针对菜单/导航而引入的参数（默认slide）
		titCell: ".nLi", //鼠标触发对象
		targetCell: ".sub", //titCell里面包含的要显示/消失的对象
		effect: "slideDown", //targetCell下拉效果
		delayTime: 300, //效果时间
		triggerTime: 0, //鼠标延迟触发时间（默认150）
		returnDefault: true //鼠标移走后返回默认状态，例如默认频道是“预告片”，鼠标移走后会返回“预告片”（默认false）
	});
</script>
</body>
</html>