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
			<div class="layui-form-item">
				<label for="name" class="layui-form-label">
					<span class="x-red">*</span>角色名称
				</label>
				<div class="layui-input-inline">
					<input type="text" id="rname" name="rname" required="" lay-verify="rname"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label class="layui-form-label">
					拥有模块权限
				</label>
				<table class="layui-table layui-input-block">
					<tbody>
					<tr>
						<td>
							<input type="checkbox" name="menu[]" value="1" lay-skin="primary" lay-filter="father"
								   lay-verify="check" title="管理员管理模块">
						</td>
						<td>
							<input name="menu[]" lay-skin="primary" type="checkbox" value="2" title="用户管理模块"
								   lay-verify="check" lay-filter="father">
						</td>
						<td>
							<input name="menu[]" lay-skin="primary" type="checkbox" value="3" title="监控管理模块"
								   lay-verify="check" lay-filter="father">
						</td>
					</tr>
					<tr>
						<td>
							<input name="menu[]" lay-skin="primary" type="checkbox" value="4" title="推广管理模块"
								   lay-verify="check" lay-filter="father">
						</td>
						<td>
							<input name="menu[]" lay-skin="primary" type="checkbox" value="5" title="订单管理模块"
								   lay-verify="check" lay-filter="father">
						</td>
						<td>
							<input name="menu[]" lay-skin="primary" type="checkbox" value="6" title="财务管理模块"
								   lay-verify="check" lay-filter="father">
						</td>
					</tr>
					<tr>
						<td>
							<input name="menu[]" lay-skin="primary" type="checkbox" value="7" title="消息管理模块"
								   lay-verify="check" lay-filter="father">
						</td>
						<td>
							<input name="menu[]" lay-skin="primary" type="checkbox" value="8" title="设置管理模块"
								   lay-verify="check" lay-filter="father">
						</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					描述内容
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="请输入内容" id="rdetails" name="rdetails" class="layui-textarea"
							  lay-verify="rdetails"></textarea>
				</div>
			</div>
			<div class="layui-form-item">
				<button class="layui-btn" lay-submit="" lay-filter="add">确认操作</button>
			</div>
		</form>
	</div>
</div>
<script>
	layui.use(['form', 'layer'],
			function () {
				var form = layui.form,
						layer = layui.layer;
				// form.on('checkbox(father)', function(data){
				// 	if(data.elem.checked){
				// 		$(data.elem).parent().siblings('td').find('input').prop("checked", true);
				// 		form.render();
				// 	}else{
				// 		$(data.elem).parent().siblings('td').find('input').prop("checked", false);
				// 		form.render();
				// 	}
				// });
				//自定义验证规则
				form.verify({
					rname: function (value) {
						if ($('#rname').val() == "") {
							return '请输入角色名称。';
						}
					},
					rdetails: function (value) {
						if ($('#rdetails').val() == "") {
							return '请输入描述内容。';
						}
					},
					check: function () {
						var checked = $("input[type='checkbox']:checked").length;
						if (checked < 1) {
							return '请勾选权限。';
						}
					}
				});

				$("#tab").validate({
					submitHandler: function (form) {
						$.ajax({
							cache: true,
							type: "POST",
							url: "<?= RUN . '/role/role_save' ?>",
							data: $('#tab').serialize(),//
							async: false,
							error: function (request) {
								alert("error");
							},
							success: function (data) {
								var data = eval("(" + data + ")");
								if (data.success) {
									layer.msg(data.msg);
									setTimeout(function () {
										cancel();
									}, 2000);
								} else {
									layer.msg(data.msg);
								}
							}
						});
					}
				});
			});

	function cancel() {
		//关闭当前frame
		xadmin.close();
	}
</script>

</body>

</html>
