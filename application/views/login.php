<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
	<meta name="renderer" content="webkit" />
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=1300, maximum-scale=1.0, user-scalable=yes" />
	<meta name="description" content="Free HTML5 Website Template" />
	<title>盛辉服装ERP系统</title>
	<meta name="keywords" content="盛辉服装ERP系统" />
	<meta name="description" content="盛辉服装ERP系统" />
	<link rel="stylesheet" type="text/css" href="<?= STA ?>/css/StyleSheet.css" />
	<link rel="stylesheet" type="text/css" href="<?= STA ?>/css/index.css" />
	<script type="text/javascript" src="<?= STA ?>/js/jquery.min.js"></script>
	<script src="<?= STA ?>/lib/layui/layui.js" charset="utf-8"></script>
	<script src="<?= STA ?>/js/jquery-1.11.1.min.js"></script>
	<script src="<?= STA ?>/js/index.js"></script>
	<script src="<?= STA ?>/js/height_line.js"></script>
	<script src="<?= STA ?>/js/heightLineTab.js"></script>
</head>
<body>
<div class="max">
	<div class="login">
		<div class="login_section">
			<span class="login_title">盛辉服装ERP系统</span>
			<form method="post" class="layui-form" action="<?= RUN ?>/login/login">
				<div class="login_box">
					<img src="<?= STA ?>/images/ico1.png" alt="" />
					<input type="text" name="username" placeholder="请输入用户名" />
				</div>
				<div class="login_box">
					<img src="<?= STA ?>/images/ico2.png" alt="" />
					<input type="text" name="password" placeholder="请输入密码" />
				</div>
				<input type="submit" value="确认登录" lay-submit lay-filter="login" class="login_btu" />
			</form>
		</div>
	</div>
</div>
<script>
	$(function () {
		layui.use('form', function () {
			//加载层
			var index = layer.load(2, {shade: false, time: 600}); //0代表加载的风格，支持0-2
			var para = GetUrlPara();
			if (para === 'err=2') {
				layer.msg('抱歉!该账号已经被禁止登录。');
			} else if (para === 'err=1') {
				layer.msg('抱歉!你输入的账号或密码错误，请重新输入。');
			} else {

			}
		});

	})

	function GetUrlPara() {
		var url = document.location.toString();
		var arrUrl = url.split("?");
		var para = arrUrl[1];
		return para;
	}
</script>
</body>
</html>
