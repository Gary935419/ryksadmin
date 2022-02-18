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
					<table class="layui-table layui-form">
						<thead>
						<tr>
							<th>
								<div class="layui-row">
									<form method="post" class="layui-form" style="margin-top: 15px" action="" name="basic_validate" id="tab">
										<div class="layui-form-item" id="div1">
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>规格
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="guige[]" lay-verify="guige"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>色号
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="sehao[]" lay-verify="sehao"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>数值
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="shuzhi[]" lay-verify="shuzhi"
													   autocomplete="off" class="layui-input">
											</div>
											<i class="layui-icon" id="divadd1" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return addnow(2,1)"></i>
										</div>
										<div class="layui-form-item" id="div2" style="display: none;">
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>规格
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="guige[]" id="val2" lay-verify="guige"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>色号
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="sehao[]" id="val22" lay-verify="sehao"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>数值
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="shuzhi[]" id="val222" lay-verify="shuzhi"
													   autocomplete="off" class="layui-input">
											</div>
											<i class="layui-icon" id="divadd2" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return addnow(3,2)"></i>
											<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return dellete(2,1)">&#xe6fe;</i>
										</div>
										<div class="layui-form-item" id="div3" style="display: none;">
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>规格
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="guige[]" id="val3" lay-verify="guige"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>色号
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="sehao[]" id="val33" lay-verify="sehao"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>数值
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="shuzhi[]" id="val333" lay-verify="shuzhi"
													   autocomplete="off" class="layui-input">
											</div>
											<i class="layui-icon" id="divadd3" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return addnow(4,3)"></i>
											<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return dellete(3,2)">&#xe6fe;</i>
										</div>
										<div class="layui-form-item" id="div4" style="display: none;">
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>规格
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="guige[]" id="val4" lay-verify="guige"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>色号
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="sehao[]" id="val44" lay-verify="sehao"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>数值
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="shuzhi[]" id="val444" lay-verify="shuzhi"
													   autocomplete="off" class="layui-input">
											</div>
											<i class="layui-icon" id="divadd4" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return addnow(5,4)"></i>
											<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return dellete(4,3)">&#xe6fe;</i>
										</div>
										<div class="layui-form-item" id="div5" style="display: none;">
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>规格
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="guige[]" id="val5" lay-verify="guige"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>色号
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="sehao[]" id="val55" lay-verify="sehao"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>数值
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="shuzhi[]" id="val555" lay-verify="shuzhi"
													   autocomplete="off" class="layui-input">
											</div>
											<i class="layui-icon" id="divadd5" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return addnow(6,5)"></i>
											<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return dellete(5,4)">&#xe6fe;</i>
										</div>
										<div class="layui-form-item" id="div6" style="display: none;">
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>规格
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="guige[]" id="val6" lay-verify="guige"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>色号
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="sehao[]" id="val66" lay-verify="sehao"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>数值
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="shuzhi[]" id="val666" lay-verify="shuzhi"
													   autocomplete="off" class="layui-input">
											</div>
											<i class="layui-icon" id="divadd6" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return addnow(7,6)"></i>
											<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return dellete(6,5)">&#xe6fe;</i>
										</div>
										<div class="layui-form-item" id="div7" style="display: none;">
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>规格
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="guige[]" id="val7" lay-verify="guige"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>色号
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="sehao[]" id="val77" lay-verify="sehao"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>数值
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="shuzhi[]" id="val777" lay-verify="shuzhi"
													   autocomplete="off" class="layui-input">
											</div>
											<i class="layui-icon" id="divadd7" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return addnow(8,7)"></i>
											<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return dellete(7,6)">&#xe6fe;</i>
										</div>
										<div class="layui-form-item" id="div8" style="display: none;">
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>规格
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="guige[]" lay-verify="guige"
													   autocomplete="off" id="val8" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>色号
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="sehao[]" id="val88" lay-verify="sehao"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>数值
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="shuzhi[]" id="val888" lay-verify="shuzhi"
													   autocomplete="off" class="layui-input">
											</div>
											<i class="layui-icon" id="divadd8" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return addnow(9,8)"></i>
											<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return dellete(8,7)">&#xe6fe;</i>
										</div>
										<div class="layui-form-item" id="div9" style="display: none;">
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>规格
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="guige[]" id="val9" lay-verify="guige"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>色号
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="sehao[]" id="val99" lay-verify="sehao"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>数值
											</label>
											<div class="layui-input-inline" id="val999" style="width: 188px;">
												<input name="shuzhi[]" lay-verify="shuzhi"
													   autocomplete="off" class="layui-input">
											</div>
											<i class="layui-icon" id="divadd9" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return addnow(10,9)"></i>
											<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return dellete(9,8)">&#xe6fe;</i>
										</div>
										<div class="layui-form-item" id="div10" style="display: none;">
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>规格
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="guige[]" id="val10" lay-verify="guige"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>色号
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="sehao[]" id="val1010" lay-verify="sehao"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>数值
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="shuzhi[]" id="val101010" lay-verify="shuzhi"
													   autocomplete="off" class="layui-input">
											</div>
											<i class="layui-icon" id="divadd10" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return addnow(11,10)"></i>
											<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return dellete(10,9)">&#xe6fe;</i>
										</div>
										<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
										<div class="layui-form-item">
											<label for="L_repass" class="layui-form-label" style="width: 90%;">
											</label>
											<button class="layui-btn" lay-filter="add" lay-submit="">
												确认提交
											</button>
										</div>
									</form>
								</div>
							</th>
						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function addnow(id, idd) {
		$("#div" + id).show();
		$("#divadd" + idd).hide();
	}

	function dellete(id, idd) {
		$("#div" + id).hide();
		$("#val" + id).val("");
		$("#val" + id + id).val("");
		$("#val" + id + id + id).val("");
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
							url: "<?= RUN . '/goods/goods_save1' ?>",
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
