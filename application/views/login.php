<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>我的管理后台-如邮快送</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="<?= STA ?>/css/font.css">
    <link rel="stylesheet" href="<?= STA ?>/css/login.css">
    <link rel="stylesheet" href="<?= STA ?>/css/xadmin.css">
    <script type="text/javascript" src="<?= STA ?>/js/jquery.min.js"></script>
    <script src="<?= STA ?>/lib/layui/layui.js" charset="utf-8"></script>
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-bg">

<div class="login layui-anim layui-anim-up">
    <div class="message">我的管理后台-如邮快送</div>
    <div id="darkbannerwrap"></div>

    <form method="post" class="layui-form" action="<?= RUN ?>/login/login">
        <input name="username" placeholder="账号" type="text" lay-verify="required" class="layui-input">
        <hr class="hr15">
        <input name="password" lay-verify="required" placeholder="密码" type="password" class="layui-input">
        <hr class="hr15">
        <input value="确认登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
        <hr class="hr20">
    </form>
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
