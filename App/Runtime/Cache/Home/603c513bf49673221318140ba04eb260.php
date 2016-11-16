<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>业务查询</title>
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


		<div class="L_person_know" class="L_box" style="display: none;background:#fff;margin-left:270px;position:absolute;z-index:10000;top:140px;">
			<div class="L_person_know_heit">
				<h3>用户须知</h3>
				<p>用户使用全网信通平台视为同意并遵守以下条款：</p>
				<div class="L_person_know1">
					<p>一、根据《互联网信息服务管理办法》不准利用本平台制作、复制、发布、传播含有下列内容的信息：</p>
					<div class="L_person_know1_con">
						<p>（一）反对宪法所确定的基本原则的；</p>
						<p>（二）危害国家安全，泄露国家秘密，颠覆国家政 权，破坏国家统一的；</p>
						<p>（三）损坏国家荣誉和利益的；</p>
						<p>（四）煽动民族仇恨、民族歧视，破坏民族团结的；</p>
						<p>（五）破坏国家民族宗教政策，宣扬邪教和封建迷信的；</p>
						<p>（六）散布谣言，扰乱社会秩序，破坏社会稳定的；</p>
						<p>（七）散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的；</p>
						<p>（八）侮辱或者诽谤他人，侵害他人合法权益的；</p>
						<p>（九）含有法律、行政法规禁止的其他内容的。</p>
					</div>
				</div>
				<div class="L_person_know1">
					<p>二、根据《中华人民共和国广告法》第七条规定，信息发布者不得制作、复制、发布、传播含有下列内容的信息：</p>
					<div class="L_person_know1_con">
						<p>（一）使用中华人民共和国国旗、国徽、国歌；</p>
						<p>（二）使用国家机关和国家机关工作人员的名义；</p>
						<p>（三）使用国家级、最高级、最佳等用语；</p>
						<p>（四）妨碍社会安定和危害人身、财产安全，损害社会公共利益；</p>
						<p>（五）妨碍社会公共秩序和违背社会良好风尚；</p>
						<p>（六）含有淫秽、迷信、恐怖、暴力、丑恶的内容；</p>
						<p>（七）含有民族、种族、宗教、性别歧视的内容；</p>
						<p>（八）妨碍环境和自然资源保护；</p>
						<p>（九）法律、行政法规规定禁止的其他情形。</p>
					</div>
				</div>
			</div>
			<!-- 协议定义 -->
			<div class="L_person_gd">
				<div class="L_person_ty">
					<a class="clearfix" id="know">
						<em class="select"></em>
						<span>我已阅读</span>
					</a>
				</div>
				<div class="L_person_bnt">
					<a href="/index.php/Home/ManagementTeam/Agent"><button id="bnts">确定</button></a>
				</div>
			</div>
		</div>

		<!-- 右侧部分 -->
		<div class="n_cmtrtbox">
			<div class="L_all">
				<!-- 留言反馈 -->
				<div class="L_person">
					<div class="L_person_tit">
						<span>业务查询</span>
						<!-- 用户须知 -->
					</div>
					<!--业务查询  -->
					<div class="L_querys">
						<div class="L_querys_search clearfix">
							<form action="/index.php/Home/ManagementTeam/select"  method="post" style="float: left;">
							<input placeholder="账户:" type="text" name="ParentNumber" id="Unam" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')">
							<a>
								<button type="submit" class="parentid" id="Usea">搜所</button>
							</a>
							</form>
							<em  style="float: left;">
								<button class="needknow">申请成为报单中心</button>
							</em>

						</div>
						<div class="L_querys_search clearfix">
							<button type="button" style="background: blue; color: white;width: 80px;height: 40px;" onclick="history.go(-1);">返回</button>
						</div>
						<div class="L_querys_con">
							<div class="L_querys_con1">
								<p>
									编号:<span><?php echo ($UserMember["hynumber"]); ?></span>
								</p>
								<p>
									姓名:<span><?php echo ($UserMember["hyname"]); ?></span>
								</p>
								<p>
									消费额度:<span><?php echo ($UserMember["hyjoininvest"]); ?></span>
								</p>
								<p>
									A市场业绩:<span><?php echo ($UserMember["aleftpoints"]); ?></span>
								</p>
								<p>
									B市场业绩:<span><?php echo ($UserMember["bleftpoints"]); ?></span>
								</p>
							</div>
							<div class="L_querys_conm clearfix">
								<?php if(is_array($UserModel)): $i = 0; $__LIST__ = $UserModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['hynumber'] !='' && $vo['hylocation']==1 && $vo['isapproved']==1){ ?>
									<form name="myForm" action="/index.php/Home/ManagementTeam/select"  method="post">
										<input type="hidden" name="ParentNumber" value="<?php echo ($vo["hynumber"]); ?>">
										<a href="javascript:document.myForm.submit();" >
										<div class="L_querys_con1 fl">
											<h3>A点</h3>
											<p>
												编号:<span><?php echo ($vo["hynumber"]); ?></span>
											</p>
											<p>
												姓名:<span><?php echo ($vo["hyname"]); ?></span>
											</p>
										</div>
										</a>
									</form>
									<?php }else if($vo['hynumber'] !='' && $vo['isapproved']==0 && $vo['hylocation']==1){ ?>
									<div class="L_querys_con1 fl">
										<h3>A点</h3>
										<p>
											编号:<span><?php echo ($vo["hynumber"]); ?></span>
										</p>
										<p>
											姓名:<span><?php echo ($vo["hyname"]); ?></span>
										</p>
									</div>
									<?php }else{ ?>

									<div class="L_querys_con1 L_querys_con2 fr">
										<h3>A点</h3>
										<p>空市场</p>
									</div>
									<?php  } ?>

									<?php  if($vo['hynumber'] !='' && $vo['hylocation']==2 && $vo['isapproved']==1){ ?>
									<form name="myForm" action="/index.php/Home/ManagementTeam/select"  method="post">
										<input type="hidden" name="ParentNumber" value="<?php echo ($vo["hynumber"]); ?>">
										<a href="javascript:document.myForm.submit();" >
										<div class="L_querys_con1 L_querys_con2 fr">
												<h3>B点</h3>
												<p>
													编号:<span><?php echo ($vo["hynumber"]); ?></span>
												</p>
												<p>
													姓名:<span><?php echo ($vo["hyname"]); ?></span>
												</p>
											</div>
										</a>
									</form>
									<?php }else if($vo['hynumber'] !='' && $vo['hylocation']==2 && $vo['isapproved']==0){ ?>
										<div class="L_querys_con1 L_querys_con2 fr">
											<h3>B点</h3>
											<p>
												编号:<span><?php echo ($vo["hynumber"]); ?></span>
											</p>
											<p>
												姓名:<span><?php echo ($vo["hyname"]); ?></span>
											</p>
										</div>
									<?php  }else{ ?>
											<div class="L_querys_con1 L_querys_con2 fr">
												<h3>B点</h3>
												<p>空市场</p>
											</div>
									<?php  } endforeach; endif; else: echo "" ;endif; ?>

									<!--<div class="L_querys_con1 L_querys_con2 fr">
									<h3>B点</h3>
									<p>空市场</p>
								</div>-->
							<!--	<div class="L_querys_con1 L_querys_con2 fr">
									<h3>B点</h3>
									<p>
										编号:<span>gs0003</span>
									</p>
									<p>
										姓名:<span>张三</span>
									</p>
								</div>-->

							</div>
							<!--<?php if(is_array($UserModel)): $i = 0; $__LIST__ = $UserModel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; endforeach; endif; else: echo "" ;endif; ?>-->
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
<script>
	$(document).ready(function() {
	var Usea=$('#Usea');
	var Unam=$('#Unam');
	Usea.click(function() {
		if (Unam.val()=='') {
			alert('搜索内容不能为空');
			return false;
		}
	});
		$(".needknow").click(function(){
			$(".L_person_know").show();
		});

/*	$('.parentid').click(function(){
		var Unam=$("#Unam").val();
		$.post("/index.php/Home/ManagementTeam/select",{ParentNumber:Unam},function(result) {
			alert(result);
			if(result ==0){
				alert('没有改账号');
				return false;
			}


		});

	});*/




});

</script>
</html>