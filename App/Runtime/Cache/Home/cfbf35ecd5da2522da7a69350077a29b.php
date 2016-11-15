<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title></title>
		<base href="/Public/" />
		<link rel="stylesheet" href="css/nsty.css" />
		<link rel="stylesheet" href="css/public.css" />
		<link rel="stylesheet" href="css/style.css" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.SuperSlide.2.1.1.js"></script>
		<script type="text/javascript" src="js/nnavjs.js"></script>
		<script type="text/javascript" src="js/showdate.js"></script>
	</head>

	<body>
		<div class="nbodybg"></div>
		<div class="ncmtbox">
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
				<div class="n_cmtrtbox">
					<div class="L_all">
						<div class="L_person">
							<div class="L_person_tit">
								<span>三级密码验证</span>
							</div>
							<div class="L_person_con nsjmmbox">
								<form action="/index.php/Home/ManagementTeam/password_authentication"  method="post">
								<label for="sjmm"><span>请输入您的三级密码:</span></label>
								<input type="password" id="sjmm" name="password3" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')">
								<div class="clearfix">
									<button type="submit" class="nbtntij">提交</button>
								</div>
								</form>
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

	</body>

</html>