<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html dir="ltr" lang="en-US">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>登录</title>

	<!--- CSS --->
	<base href="/Public/" />
	<link rel="stylesheet" href="css/styles.css" type="text/css" />


	<!--- Javascript libraries (jQuery and Selectivizr) used for the custom checkbox --->

	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/selectivizr.js"></script>
		<noscript><link rel="stylesheet" href="js/fallback.css" /></noscript>
	<![endif]-->

	</head>

	<body>
		<div id="container">
			<form action="/index.php/Home/Login/Login" method="post">
				<div class="login">LOGIN</div>
				<div class="username-text">用户名:</div>
				<div class="password-text">密码:</div>
				<div class="username-field">
					<input type="text" name="HyNumber" value="" />
				</div>
				<div class="password-field">
					<input type="password" name="HyPassword" value="" />
				</div>
				<p>
					<div class="username-field" style="display: inline">
						<input class="" type="text" name="code" value="" placeholder="请输入验证码" />
					</div>

					<img class="username-field" src="/index.php/Home/Login/verify" onclick="this.src='/index.php/Home/Login/verify/'+Math.random()" width="150" height="50" style="display: inline" />

				</p>
				<input type="submit" name="submit" value="GO" />

			</form>
		</div>
		<div id="footer">
		</div>
	</body>
</html>