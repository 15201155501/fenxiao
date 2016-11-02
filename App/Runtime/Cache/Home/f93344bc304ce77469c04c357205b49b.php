<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>首页-详情</title>
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
						<a href="javascript:;">会员激活</a>
					</li>
					<li>
						<a href="javascript:;">营销关系</a>
					</li>
					<li>
						<a href="javascript:;">申请服务中</a>
					</li>
				</ul>
			</li>
			<li class="nLi on">
				<h3><a href="javascript:;" target="_blank">财务中心<span></span></a></h3>
				<ul class="sub">
					<li>
						<a href="javascript:;">新闻首页</a>
					</li>
					<li>
						<a href="javascript:;">新闻人物</a>
					</li>
					<li>
						<a href="javascript:;">新闻电视</a>
					</li>
					<li>
						<a href="javascript:;">新闻图片</a>
					</li>
					<li>
						<a href="javascript:;">新闻视频</a>
					</li>
					<li>
						<a href="javascript:; ">新闻专题</a>
					</li>
				</ul>
			</li>
			<li class="nLi ">
				<h3><a href="javascript:;" target="_blank">奖金管理<span></span></a></h3>
				<ul class="sub">
					<li>
						<a href="javascript:;">新闻首页</a>
					</li>
					<li>
						<a href="javascript:;">新闻人物</a>
					</li>
					<li>
						<a href="javascript:;">新闻电视</a>
					</li>
					<li>
						<a href="javascript:;">新闻图片</a>
					</li>
					<li>
						<a href="javascript:;">新闻视频</a>
					</li>
					<li>
						<a href="javascript:; ">新闻专题</a>
					</li>
				</ul>
			</li>
			<li class="nLi">
				<h3><a href="javascript:;" target="_blank">信息安全<span></span></a></h3>
				<ul class="sub">
					<li>
						<a href="javascript:;">新闻首页</a>
					</li>
					<li>
						<a href="javascript:;">新闻人物</a>
					</li>
				
				</ul>
			</li>
			<li class="nLi">
				<h3><a href="javascript:;" target="_blank">服务台<span></span></a></h3>
				<ul class="sub">
					<li>
						<a href="javascript:;">新闻首页</a>
					</li>
					<li>
						<a href="javascript:;">新闻人物</a>
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
					<div class="L_new_mess L_detail_mess">
						<!-- 首页详情 -->
						<div class="L_detail">
							<h3><?php echo ($notice["ntitle"]); ?><em>(<?php echo ($notice["ndate"]); ?>)</em></h3>
							<div class="L_detail_con">
								<?php echo ($notice["ncontent"]); ?>
							</div>
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