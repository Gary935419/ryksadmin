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
								<th>客户名</th>
								<th>生产数量</th>
								<th>报价日期</th>
								<th>损耗</th>
								<th>小计</th>
								<th>加工费单价</th>
								<th>加工费用量</th>
								<th>二次加工费单价</th>
								<th>二次加工费用量</th>
								<th>检品费单价</th>
								<th>检品费用量</th>
								<th>通关费单价</th>
								<th>通关费用量</th>
							<tr>
							</thead>
							<tbody>
							<tr id="div1">
								<td><input name="kehuming" id="kehuming" autocomplete="off" class="layui-input"></td>
								<td><input name="shengcanshuliang" id="shengcanshuliang" autocomplete="off" class="layui-input"></td>
								<td><input name="riqi" id="riqi" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao" id="sunhao" autocomplete="off" class="layui-input"></td>
								<td><input name="xiaoji" id="xiaoji" autocomplete="off" class="layui-input"></td>
								<td><input name="jiagongfeidanjia" id="jiagongfeidanjia" autocomplete="off" class="layui-input"></td>
								<td><input name="jiagongfeiyongliang" id="jiagongfeiyongliang" autocomplete="off" class="layui-input"></td>
								<td><input name="ercijiagongfeidanjia" id="ercijiagongfeidanjia" autocomplete="off" class="layui-input"></td>
								<td><input name="ercijiagongfeiyongliang" id="ercijiagongfeiyongliang" autocomplete="off" class="layui-input"></td>
								<td><input name="jianpinfeidanjia" id="jianpinfeidanjia" autocomplete="off" class="layui-input"></td>
								<td><input name="jianpinfeiyongliang" id="jianpinfeiyongliang" autocomplete="off" class="layui-input"></td>
								<td><input name="tongguanfeidanjia" id="tongguanfeidanjia" autocomplete="off" class="layui-input"></td>
								<td><input name="tongguanfeiyongliang" id="tongguanfeiyongliang" autocomplete="off" class="layui-input"></td>
							</tr>
							</tbody>
							<thead>
							<tr>
								<th>面料检测单价</th>
								<th>面料检测用量</th>
								<th>运费单价</th>
								<th>运费用量</th>
								<th>其他单价</th>
								<th>其他用量</th>
							<tr>
							</thead>
							<tbody>
							<tr id="div1">
								<td><input name="mianliaojiancedanjia" id="mianliaojiancedanjia" autocomplete="off" class="layui-input"></td>
								<td><input name="mianliaojianceyongliang" id="mianliaojianceyongliang" autocomplete="off" class="layui-input"></td>
								<td><input name="yunfeidanjia" id="yunfeidanjia" autocomplete="off" class="layui-input"></td>
								<td><input name="yunfeiyongliang" id="yunfeiyongliang" autocomplete="off" class="layui-input"></td>
								<td><input name="qitadanjia" id="qitadanjia" autocomplete="off" class="layui-input"></td>
								<td><input name="qitayongliang" id="qitayongliang" autocomplete="off" class="layui-input"></td>
							</tr>
							<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
							<input type="hidden" id="btype" name="btype" value="<?php echo $btype ?>">
							<input type="hidden" id="status" name="status">
							<input type="hidden" id="state" name="state">
							</tbody>
						</table>
						<div class="layui-form-item" style="margin-top: 15px;">
							<label for="L_repass" class="layui-form-label" style="width: 80%;">
							</label>
							<button class="layui-btn layui-btn-normal" lay-filter="add" type="submit" onclick="return submitgo('1')">
								提交保存
							</button>
							<button class="layui-btn" lay-filter="add" type="submit" onclick="return submitgo('2')">
								提交审核
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function submitgo(type){
		if(type < 2){
			//保存
			$("#status").val(1);
			$("#state").val(4);
		}else{
			//提交
			$("#status").val(2);
			$("#state").val(1);
		}
	}
</script>
<script>layui.use(['laydate', 'form'],
			function() {
				var laydate = layui.laydate;
				//执行一个laydate实例
				laydate.render({
					elem: '#riqi' //指定元素
				});
			});
</script>
<script>
	layui.use(['form','layedit', 'layer'],
			function () {
				var form = layui.form,
						layer = layui.layer;
				var layedit = layui.layedit;
				layedit.set({
					uploadImage: {
						url: '<?= RUN . '/upload/pushFIletextarea' ?>',
						type: 'post',
					}
				});
				//自定义验证规则
				form.verify({
					kehuming: function (value) {
						if ($('#kehuming').val() == "") {
							return '请输入客户名。';
						}
					},
					riqi: function (value) {
						if ($('#riqi').val() == "") {
							return '请输入报价日期。';
						}
					},
					shengcanshuliang: function (value) {
						if ($('#shengcanshuliang').val() == "") {
							return '请输入生产数量。';
						}
					},
					sunhao: function (value) {
						if ($('#sunhao').val() == "") {
							return '请输入损耗。';
						}
					},
					xiaoji: function (value) {
						if ($('#xiaoji').val() == "") {
							return '请输入小计。';
						}
					},
					jiagongfeidanjia: function (value) {
						if ($('#jiagongfeidanjia').val() == "") {
							return '请输入加工费单价。';
						}
					},
					jiagongfeiyongliang: function (value) {
						if ($('#jiagongfeiyongliang').val() == "") {
							return '请输入加工费用量。';
						}
					},
					ercijiagongfeidanjia: function (value) {
						if ($('#jiagongfeidanjia').val() == "") {
							return '请输入二次加工费单价。';
						}
					},
					ercijiagongfeiyongliang: function (value) {
						if ($('#jiagongfeiyongliang').val() == "") {
							return '请输入二次加工费用量。';
						}
					},
					jianpinfeidanjia: function (value) {
						if ($('#jianpinfeidanjia').val() == "") {
							return '请输入检品费单价。';
						}
					},
					jianpinfeiyongliang: function (value) {
						if ($('#jianpinfeiyongliang').val() == "") {
							return '请输入检品费用量。';
						}
					},
					tongguanfeidanjia: function (value) {
						if ($('#tongguanfeidanjia').val() == "") {
							return '请输入通关费单价。';
						}
					},
					tongguanfeiyongliang: function (value) {
						if ($('#tongguanfeiyongliang').val() == "") {
							return '请输入通关费用量。';
						}
					},
					mianliaojiancedanjia: function (value) {
						if ($('#mianliaojiancedanjia').val() == "") {
							return '请输入面料检测费单价。';
						}
					},
					mianliaojianceyongliang: function (value) {
						if ($('#mianliaojianceyongliang').val() == "") {
							return '请输入面料检测费用量。';
						}
					},
					yunfeidanjia: function (value) {
						if ($('#yunfeidanjia').val() == "") {
							return '请输入运费单价。';
						}
					},
					yunfeiyongliang: function (value) {
						if ($('#yunfeiyongliang').val() == "") {
							return '请输入运费用量。';
						}
					},
					qitadanjia: function (value) {
						if ($('#qitadanjia').val() == "") {
							return '请输入其他单价。';
						}
					},
					qitayongliang: function (value) {
						if ($('#qitayongliang').val() == "") {
							return '请输入其他用量。';
						}
					},
				});

				$("#tab").validate({
					submitHandler: function (form) {
						$.ajax({
							cache: true,
							type: "POST",
							url: "<?= RUN . '/goods/goods_save_jichufei' ?>",
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
