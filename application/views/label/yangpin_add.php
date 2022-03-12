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
								<td><input name="kuhumingcheng[]" id="val1" autocomplete="off" class="layui-input"></td>
								<td><input name="dandangzhe[]" id="val11" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanhao[]" id="val111" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanshi[]" id="val1111" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpinxingzhi[]" id="val11111" autocomplete="off" class="layui-input"></td>
								<td><input name="shuliang[]" id="val111111" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpindanjia[]" id="val1111111" autocomplete="off" class="layui-input"></td>
								<td><input name="shoudaoriqi[]" id="val11111111" autocomplete="off" class="layui-input"></td>
								<td><input name="fachuriqi[]" id="val111111111" autocomplete="off" class="layui-input"></td>
								<td><input name="zhizuozhe[]" id="val1111111111" autocomplete="off" class="layui-input"></td>
							</tr>
							</tbody>
							<thead>
							<tr>
								<th>1号</th>
								<th>2号</th>
								<th>3号</th>
								<th>4号</th>
								<th>5号</th>
								<th>6号</th>
								<th>7号</th>
								<th>8号</th>
								<th>9号</th>
								<th>10号</th>
							<tr>
							</thead>
							<tbody>
							<tr id="div1">
								<td><input name="hao1" id="val1" autocomplete="off" class="layui-input"></td>
								<td><input name="hao2" id="val11" autocomplete="off" class="layui-input"></td>
								<td><input name="hao3" id="val111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao4" id="val1111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao5" id="val11111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao6" id="val111111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao7" id="val1111111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao8" id="val111121111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao9" id="val1111211111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao10" id="val1111111111" autocomplete="off" class="layui-input"></td>
							</tr>
							</tbody>
							<thead>
							<tr>
								<th>11号</th>
								<th>12号</th>
								<th>13号</th>
								<th>14号</th>
								<th>15号</th>
								<th>16号</th>
								<th>17号</th>
								<th>18号</th>
								<th>19号</th>
								<th>20号</th>
							<tr>
							</thead>
							<tbody>
							<tr id="div1">
								<td><input name="hao11" id="val1" autocomplete="off" class="layui-input"></td>
								<td><input name="hao12" id="val11" autocomplete="off" class="layui-input"></td>
								<td><input name="hao13" id="val111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao14" id="val1111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao15" id="val11111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao16" id="val111111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao17" id="val1111111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao18" id="val111121111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao19" id="val1111211111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao20" id="val1111111111" autocomplete="off" class="layui-input"></td>
							</tr>
							</tbody>
							<thead>
							<tr>
								<th>21号</th>
								<th>22号</th>
								<th>23号</th>
								<th>24号</th>
								<th>25号</th>
								<th>26号</th>
								<th>27号</th>
								<th>28号</th>
								<th>29号</th>
								<th>30号</th>
								<th>31号</th>
							<tr>
							</thead>
							<tbody>
							<tr id="div1">
								<td><input name="hao21" id="val1" autocomplete="off" class="layui-input"></td>
								<td><input name="hao22" id="val11" autocomplete="off" class="layui-input"></td>
								<td><input name="hao23" id="val111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao24" id="val1111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao25" id="val11111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao26" id="val111111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao27" id="val1111111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao28" id="val111112111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao29" id="val1111121111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao30" id="val11111121111" autocomplete="off" class="layui-input"></td>
								<td><input name="hao31" id="val1111111111" autocomplete="off" class="layui-input"></td>
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
					elem: '#val11111111' //指定元素
				});
				laydate.render({
					elem: '#val111111111' //指定元素
				});
				// laydate.render({
				// 	elem: '#val22222222' //指定元素
				// });
				// laydate.render({
				// 	elem: '#val222222222' //指定元素
				// });
				// laydate.render({
				// 	elem: '#val33333333' //指定元素
				// });
				// laydate.render({
				// 	elem: '#val333333333' //指定元素
				// });
				// laydate.render({
				// 	elem: '#val44444444' //指定元素
				// });
				// laydate.render({
				// 	elem: '#val444444444' //指定元素
				// });
				// laydate.render({
				// 	elem: '#val55555555' //指定元素
				// });
				// laydate.render({
				// 	elem: '#val555555555' //指定元素
				// });
				// //执行一个laydate实例
				// laydate.render({
				// 	elem: '#val66666666' //指定元素
				// });
				// //执行一个laydate实例
				// laydate.render({
				// 	elem: '#val666666666' //指定元素
				// });
				// //执行一个laydate实例
				// laydate.render({
				// 	elem: '#val77777777' //指定元素
				// });
				// //执行一个laydate实例
				// laydate.render({
				// 	elem: '#val777777777' //指定元素
				// });
				// //执行一个laydate实例
				// laydate.render({
				// 	elem: '#val88888888' //指定元素
				// });
				// //执行一个laydate实例
				// laydate.render({
				// 	elem: '#val888888888' //指定元素
				// });
				// //执行一个laydate实例
				// laydate.render({
				// 	elem: '#val99999999' //指定元素
				// });
				// //执行一个laydate实例
				// laydate.render({
				// 	elem: '#val999999999' //指定元素
				// });
				// //执行一个laydate实例
				// laydate.render({
				// 	elem: '#val1010101010101010' //指定元素
				// });
				// //执行一个laydate实例
				// laydate.render({
				// 	elem: '#val101010101010101010' //指定元素
				// });
			});
</script>
<script>
	function addnow(id, idd) {
		$("#div" + id).show()
		$("#divadd" + idd).hide();
	}

	function dellete(id, idd) {
		$("#div" + id).hide();
		$("#val" + id).val("");
		$("#val" + id + id).val("");
		$("#val" + id + id + id).val("");
		$("#val" + id + id + id + id).val("");
		$("#val" + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#divadd" + idd).show();
	}
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
							url: "<?= RUN . '/goods/yangpin_save' ?>",
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
