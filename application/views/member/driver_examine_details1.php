<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>我的管理后台-ERP</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="<?= STA ?>/css/font.css">
    <link rel="stylesheet" href="<?= STA ?>/css/xadmin.css">
    <script type="text/javascript" src="<?= STA ?>/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?= STA ?>/js/xadmin.js"></script>
    <script type="text/javascript" src="<?= STA ?>/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="<?= STA ?>/js/jquery.validate.js"></script>
    <script type="text/javascript" src="<?= STA ?>/js/upload/jquery_form.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form method="post" class="layui-form layui-form-pane" id="tab">
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					司机姓名
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交司机姓名" id="name" name="name" class="layui-textarea"
							  lay-verify="name"><?php echo $name ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					司机手机号
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交司机手机号" id="account" name="account" class="layui-textarea"
							  lay-verify="account"><?php echo $account ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					司机性别
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交司机性别" id="sex" name="sex" class="layui-textarea"
							  lay-verify="sex"><?php echo $sex ?></textarea>
				</div>
			</div>
            <div class="layui-form-item layui-form-text">
                <label for="desc" class="layui-form-label">
                    身份证号
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="暂无提交身份证号" id="driving_cards" name="driving_cards" class="layui-textarea"
                              lay-verify="driving_cards"><?php echo $driving_cards ?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label for="desc" class="layui-form-label">
                    领证时间
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="暂无提交领证时间" id="driving_times" name="driving_times" class="layui-textarea"
                              lay-verify="driving_times"><?= $driving_times ?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label for="desc" class="layui-form-label">
					认证资料图片
                </label>
                <div class="layui-input-block">
					<img src="<?= $driving_img_cards_face ?>" style="width: 282px;height: 282px;">
					<img src="<?= $driving_img_cards_side ?>" style="width: 282px;height: 282px;">
					<img src="<?= $driving_img_drivers ?>" style="width: 282px;height: 282px;">
					<img src="<?= $driving_img_worker ?>" style="width: 282px;height: 282px;">
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
