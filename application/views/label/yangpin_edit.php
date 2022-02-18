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
</head>
<body>
<div class="layui-fluid">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-body ">
					<form method="post" class="layui-form" style="margin-top: 15px" action="" name="basic_validate" id="tab">
						<table class="layui-table layui-form">
							<thead>
							<tr>
								<th>客户名称</th>
								<th>担当者</th>
								<th>款号</th>
								<th>款式</th>
								<th>样品性质</th>
								<th>数量</th>
								<th>样品单价</th>
								<th>收到日期</th>
								<th>发出日期</th>
								<th>制作者</th>
							<tr>
							</thead>
							<tbody>
							<tr id="div1">
								<td><input name="kuhumingcheng" id="kuhumingcheng" value="<?php echo $kuhumingcheng ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="dandangzhe" id="dandangzhe" value="<?php echo $dandangzhe ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanhao" id="kuanhao" value="<?php echo $kuanhao ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanshi" id="kuanshi" value="<?php echo $kuanshi ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpinxingzhi" id="yangpinxingzhi" value="<?php echo $yangpinxingzhi ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="shuliang" id="shuliang" value="<?php echo $shuliang ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpindanjia" id="yangpindanjia" value="<?php echo $yangpindanjia ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="shoudaoriqi" id="shoudaoriqi" value="<?php echo date('Y-m-d H:i:s', $shoudaoriqi) ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="fachuriqi" id="fachuriqi" value="<?php echo date('Y-m-d H:i:s', $fachuriqi) ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhizuozhe" id="zhizuozhe" value="<?php echo $zhizuozhe ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
							</tbody>
						</table>
						<div class="layui-form-item" style="margin-top: 15px;">
							<label for="L_repass" class="layui-form-label" style="width: 80%;">
							</label>
							<button class="layui-btn layui-btn-normal" lay-filter="add" type="submit">
								确认提交
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>layui.use(['laydate', 'form'],
			function() {
				var laydate = layui.laydate;
				//执行一个laydate实例
				laydate.render({
					elem: '#shoudaoriqi' //指定元素
				});
				laydate.render({
					elem: '#fachuriqi' //指定元素
				});
			});
</script>
<script>
	layui.use(['form', 'layedit', 'layer'],
			function () {
				var form = layui.form,
						layer = layui.layer;
				$("#tab").validate({
					submitHandler: function (form) {
						$.ajax({
							cache: true,
							type: "POST",
							url: "<?= RUN . '/goods/yangpin_save_edit' ?>",
							data: $('#tab').serialize(),
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
