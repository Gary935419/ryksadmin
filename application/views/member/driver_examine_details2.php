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
					内容1
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="内容7" id="tabChangeContentValue" name="tabChangeContentValue" class="layui-textarea"
							  lay-verify="tabChangeContentValue"><?php echo $tabChangeContentValue ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					内容2
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="内容7" id="tabChangePnameValue" name="tabChangePnameValue" class="layui-textarea"
							  lay-verify="tabChangePnameValue"><?php echo $tabChangePnameValue ?></textarea>
				</div>
			</div>
            <div class="layui-form-item layui-form-text">
                <label for="desc" class="layui-form-label">
					内容3
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="内容7" id="tabChangePtelValue" name="tabChangePtelValue" class="layui-textarea"
                              lay-verify="tabChangePtelValue"><?php echo $tabChangePtelValue ?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label for="desc" class="layui-form-label">
					内容四
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="内容7" id="tabChangePname1Value" name="tabChangePname1Value" class="layui-textarea"
                              lay-verify="tabChangePname1Value"><?= $tabChangePname1Value ?></textarea>
                </div>
            </div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					内容5
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="内容7" id="tabChangePtel1Value" name="tabChangePtel1Value" class="layui-textarea"
							  lay-verify="tabChangePtel1Value"><?= $tabChangePtel1Value ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					内容6
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="内容7" id="tabChangePcardValue" name="tabChangePcardValue" class="layui-textarea"
							  lay-verify="tabChangePcardValue"><?= $tabChangePcardValue ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					内容7
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="内容7" id="tabChangeNumber1Value" name="tabChangeNumber1Value" class="layui-textarea"
							  lay-verify="tabChangeNumber1Value"><?= $tabChangeNumber1Value ?></textarea>
				</div>
			</div>
<!--            <div class="layui-form-item layui-form-text">-->
<!--                <label for="desc" class="layui-form-label">-->
<!--					资料图片-->
<!--                </label>-->
<!--                <div class="layui-input-block">-->
<!--					--><?php //if (isset($imgs) && !empty($imgs)) { ?>
<!--						--><?php //foreach ($imgs as $num => $once): ?>
<!--					         <img src="--><?//= $once['path_server'] ?><!--" style="width: 282px;height: 282px;">-->
<!--						--><?php //endforeach; ?>
<!--					--><?php //} ?>
<!--                </div>-->
<!--            </div>-->
        </form>
    </div>
</div>
</body>
</html>
