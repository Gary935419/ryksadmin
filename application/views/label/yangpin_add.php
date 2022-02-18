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
								<th>操作</th>
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
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd1" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(2,1)"></i>
								</td>
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
							<tr id="div2" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd2" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(3,2)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(2,1)">&#xe6fe;</i>
								</td>
								<td><input name="kuhumingcheng[]" id="val2" autocomplete="off" class="layui-input"></td>
								<td><input name="dandangzhe[]" id="val22" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanhao[]" id="val222" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanshi[]" id="val2222" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpinxingzhi[]" id="val22222" autocomplete="off" class="layui-input"></td>
								<td><input name="shuliang[]" id="val222222" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpindanjia[]" id="val2222222" autocomplete="off" class="layui-input"></td>
								<td><input name="shoudaoriqi[]" id="val22222222" autocomplete="off" class="layui-input"></td>
								<td><input name="fachuriqi[]" id="val222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="zhizuozhe[]" id="val2222222222" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div3" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd3" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(4,3)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(3,2)">&#xe6fe;</i>
								</td>
								<td><input name="kuhumingcheng[]" id="val3" autocomplete="off" class="layui-input"></td>
								<td><input name="dandangzhe[]" id="val33" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanhao[]" id="val333" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanshi[]" id="val3333" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpinxingzhi[]" id="val33333" autocomplete="off" class="layui-input"></td>
								<td><input name="shuliang[]" id="val333333" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpindanjia[]" id="val3333333" autocomplete="off" class="layui-input"></td>
								<td><input name="shoudaoriqi[]" id="val33333333" autocomplete="off" class="layui-input"></td>
								<td><input name="fachuriqi[]" id="val333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="zhizuozhe[]" id="val3333333333" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div4" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd4" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(5,4)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(4,3)">&#xe6fe;</i>
								</td>
								<td><input name="kuhumingcheng[]" id="val4" autocomplete="off" class="layui-input"></td>
								<td><input name="dandangzhe[]" id="val44" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanhao[]" id="val444" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanshi[]" id="val4444" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpinxingzhi[]" id="val44444" autocomplete="off" class="layui-input"></td>
								<td><input name="shuliang[]" id="val444444" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpindanjia[]" id="val4444444" autocomplete="off" class="layui-input"></td>
								<td><input name="shoudaoriqi[]" id="val44444444" autocomplete="off" class="layui-input"></td>
								<td><input name="fachuriqi[]" id="val444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="zhizuozhe[]" id="val4444444444" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div5" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd5" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(6,5)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(5,4)">&#xe6fe;</i>
								</td>
								<td><input name="kuhumingcheng[]" id="val5" autocomplete="off" class="layui-input"></td>
								<td><input name="dandangzhe[]" id="val55" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanhao[]" id="val555" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanshi[]" id="val5555" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpinxingzhi[]" id="val55555" autocomplete="off" class="layui-input"></td>
								<td><input name="shuliang[]" id="val555555" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpindanjia[]" id="val5555555" autocomplete="off" class="layui-input"></td>
								<td><input name="shoudaoriqi[]" id="val55555555" autocomplete="off" class="layui-input"></td>
								<td><input name="fachuriqi[]" id="val555555555"  autocomplete="off" class="layui-input"></td>
								<td><input name="zhizuozhe[]" id="val5555555555" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div6" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd6" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(7,6)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(6,5)">&#xe6fe;</i>
								</td>
								<td><input name="kuhumingcheng[]" id="val6" autocomplete="off" class="layui-input"></td>
								<td><input name="dandangzhe[]" id="val66" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanhao[]" id="val666" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanshi[]" id="val6666" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpinxingzhi[]" id="val66666" autocomplete="off" class="layui-input"></td>
								<td><input name="shuliang[]" id="val666666" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpindanjia[]" id="val6666666" autocomplete="off" class="layui-input"></td>
								<td><input name="shoudaoriqi[]" id="val66666666" autocomplete="off" class="layui-input"></td>
								<td><input name="fachuriqi[]" id="val666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="zhizuozhe[]" id="val6666666666" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div7" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd7" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(8,7)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(7,6)">&#xe6fe;</i>
								</td>
								<td><input name="kuhumingcheng[]" id="val7" autocomplete="off" class="layui-input"></td>
								<td><input name="dandangzhe[]" id="val77" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanhao[]" id="val777" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanshi[]" id="val7777" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpinxingzhi[]" id="val77777" autocomplete="off" class="layui-input"></td>
								<td><input name="shuliang[]" id="val777777" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpindanjia[]" id="val7777777" autocomplete="off" class="layui-input"></td>
								<td><input name="shoudaoriqi[]" id="val77777777" autocomplete="off" class="layui-input"></td>
								<td><input name="fachuriqi[]" id="val777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="zhizuozhe[]" id="val7777777777" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div8" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd8" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(9,8)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(8,7)">&#xe6fe;</i>
								</td>
								<td><input name="kuhumingcheng[]" id="val8" autocomplete="off" class="layui-input"></td>
								<td><input name="dandangzhe[]" id="val88" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanhao[]" id="val888" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanshi[]" id="val8888" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpinxingzhi[]" id="val88888" autocomplete="off" class="layui-input"></td>
								<td><input name="shuliang[]" id="val888888" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpindanjia[]" id="val8888888" autocomplete="off" class="layui-input"></td>
								<td><input name="shoudaoriqi[]" id="val88888888" autocomplete="off" class="layui-input"></td>
								<td><input name="fachuriqi[]" id="val888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="zhizuozhe[]" id="val8888888888" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div9" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd9" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(10,9)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(9,8)">&#xe6fe;</i>
								</td>
								<td><input name="kuhumingcheng[]" id="val9" autocomplete="off" class="layui-input"></td>
								<td><input name="dandangzhe[]" id="val99" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanhao[]" id="val999" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanshi[]" id="val9999" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpinxingzhi[]" id="val99999" autocomplete="off" class="layui-input"></td>
								<td><input name="shuliang[]" id="val999999" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpindanjia[]" id="val9999999" autocomplete="off" class="layui-input"></td>
								<td><input name="shoudaoriqi[]" id="val99999999" autocomplete="off" class="layui-input"></td>
								<td><input name="fachuriqi[]" id="val999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="zhizuozhe[]" id="val9999999999" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div10" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd10" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(11,10)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(10,9)">&#xe6fe;</i>
								</td>
								<td><input name="kuhumingcheng[]" id="val10" autocomplete="off" class="layui-input"></td>
								<td><input name="dandangzhe[]" id="val1010" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanhao[]" id="val101010" autocomplete="off" class="layui-input"></td>
								<td><input name="kuanshi[]" id="val10101010" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpinxingzhi[]" id="val1010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="shuliang[]" id="val101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="yangpindanjia[]" id="val10101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="shoudaoriqi[]" id="val1010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="fachuriqi[]" id="val101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="zhizuozhe[]" id="val10101010101010101010" autocomplete="off" class="layui-input"></td>
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
				laydate.render({
					elem: '#val22222222' //指定元素
				});
				laydate.render({
					elem: '#val222222222' //指定元素
				});
				laydate.render({
					elem: '#val33333333' //指定元素
				});
				laydate.render({
					elem: '#val333333333' //指定元素
				});
				laydate.render({
					elem: '#val44444444' //指定元素
				});
				laydate.render({
					elem: '#val444444444' //指定元素
				});
				laydate.render({
					elem: '#val55555555' //指定元素
				});
				laydate.render({
					elem: '#val555555555' //指定元素
				});
				//执行一个laydate实例
				laydate.render({
					elem: '#val66666666' //指定元素
				});
				//执行一个laydate实例
				laydate.render({
					elem: '#val666666666' //指定元素
				});
				//执行一个laydate实例
				laydate.render({
					elem: '#val77777777' //指定元素
				});
				//执行一个laydate实例
				laydate.render({
					elem: '#val777777777' //指定元素
				});
				//执行一个laydate实例
				laydate.render({
					elem: '#val88888888' //指定元素
				});
				//执行一个laydate实例
				laydate.render({
					elem: '#val888888888' //指定元素
				});
				//执行一个laydate实例
				laydate.render({
					elem: '#val99999999' //指定元素
				});
				//执行一个laydate实例
				laydate.render({
					elem: '#val999999999' //指定元素
				});
				//执行一个laydate实例
				laydate.render({
					elem: '#val1010101010101010' //指定元素
				});
				//执行一个laydate实例
				laydate.render({
					elem: '#val101010101010101010' //指定元素
				});
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
