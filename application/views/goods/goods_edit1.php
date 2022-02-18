<!DOCTYPE html>
<html class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>我的管理后台-ERP</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport"
		  content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
	<link rel="stylesheet" href="<?= STA ?>/css/font.css">
	<link rel="stylesheet" href="<?= STA ?>/css/xadmin.css">
	<script type="text/javascript" src="<?= STA ?>/lib/layui/layui.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?= STA ?>/js/xadmin.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/upload/jquery_form.js"></script>
</head>
<body>
<div class="layui-fluid" style="padding-top: 66px;">
	<div class="layui-row">
		<form method="post" class="layui-form" action="" name="basic_validate" id="tab">
			<div class="layui-form-item" id="div1">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>规格
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="guige[]" lay-verify="guige" value="<?php echo $guige1 ?>"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>色号
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sehao[]" lay-verify="sehao" value="<?php echo $sehao1 ?>"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>数值
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="shuzhi[]" lay-verify="shuzhi" value="<?php echo $shuzhi1 ?>"
						   autocomplete="off" class="layui-input">
				</div>
				<?php if (!empty($guige1) && empty($guige2)) { ?>
					<i class="layui-icon" id="divadd1" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
					   onclick="return addnow(2,1)"></i>
				<?php } else { ?>
					<i class="layui-icon" id="divadd1"
					   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
					   onclick="return addnow(2,1)"></i>
				<?php } ?>
			</div>
			<?php if (empty($guige2)){ ?>
			<div class="layui-form-item" id="div2" style="display: none;">
				<?php }else{ ?>
				<div class="layui-form-item" id="div2" style="display: block;">
					<?php } ?>
					<label for="L_pass" class="layui-form-label" style="width: 8%;">
						<span class="x-red">*</span>规格
					</label>
					<div class="layui-input-inline" style="width: 188px;">
						<input name="guige[]" id="val2" lay-verify="guige" value="<?php echo $guige2 ?>"
							   autocomplete="off" class="layui-input">
					</div>
					<label for="L_pass" class="layui-form-label" style="width: 8%;">
						<span class="x-red">*</span>色号
					</label>
					<div class="layui-input-inline" style="width: 188px;">
						<input name="sehao[]" id="val22" lay-verify="sehao" value="<?php echo $sehao2 ?>"
							   autocomplete="off" class="layui-input">
					</div>
					<label for="L_pass" class="layui-form-label" style="width: 8%;">
						<span class="x-red">*</span>数值
					</label>
					<div class="layui-input-inline" style="width: 188px;">
						<input name="shuzhi[]" id="val222" lay-verify="shuzhi" value="<?php echo $shuzhi2 ?>"
							   autocomplete="off" class="layui-input">
					</div>
					<?php if (!empty($guige2) && empty($guige3)) { ?>
						<i class="layui-icon" id="divadd2" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
						   onclick="return addnow(3,2)"></i>
					<?php } else { ?>
						<i class="layui-icon" id="divadd2"
						   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
						   onclick="return addnow(3,2)"></i>
					<?php } ?>
					<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
					   onclick="return dellete(2,1)">&#xe6fe;</i>
				</div>
				<?php if (empty($guige3)){ ?>
				<div class="layui-form-item" id="div3" style="display: none;">
					<?php }else{ ?>
					<div class="layui-form-item" id="div3" style="display: block;">
						<?php } ?>
						<label for="L_pass" class="layui-form-label" style="width: 8%;">
							<span class="x-red">*</span>规格
						</label>
						<div class="layui-input-inline" style="width: 188px;">
							<input name="guige[]" id="val3" lay-verify="guige" value="<?php echo $guige3 ?>"
								   autocomplete="off" class="layui-input">
						</div>
						<label for="L_pass" class="layui-form-label" style="width: 8%;">
							<span class="x-red">*</span>色号
						</label>
						<div class="layui-input-inline" style="width: 188px;">
							<input name="sehao[]" id="val33" lay-verify="sehao" value="<?php echo $sehao3 ?>"
								   autocomplete="off" class="layui-input">
						</div>
						<label for="L_pass" class="layui-form-label" style="width: 8%;">
							<span class="x-red">*</span>数值
						</label>
						<div class="layui-input-inline" style="width: 188px;">
							<input name="shuzhi[]" id="val333" lay-verify="shuzhi" value="<?php echo $shuzhi3 ?>"
								   autocomplete="off" class="layui-input">
						</div>
						<?php if (!empty($guige3) && empty($guige4)) { ?>
							<i class="layui-icon" id="divadd3"
							   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
							   onclick="return addnow(4,3)"></i>
						<?php } else { ?>
							<i class="layui-icon" id="divadd3"
							   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
							   onclick="return addnow(4,3)"></i>
						<?php } ?>
						<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
						   onclick="return dellete(3,2)">&#xe6fe;</i>
					</div>
					<?php if (empty($guige4)){ ?>
					<div class="layui-form-item" id="div4" style="display: none;">
						<?php }else{ ?>
						<div class="layui-form-item" id="div4" style="display: block;">
							<?php } ?>
							<label for="L_pass" class="layui-form-label" style="width: 8%;">
								<span class="x-red">*</span>规格
							</label>
							<div class="layui-input-inline" style="width: 188px;">
								<input name="guige[]" id="val4" lay-verify="guige" value="<?php echo $guige4 ?>"
									   autocomplete="off" class="layui-input">
							</div>
							<label for="L_pass" class="layui-form-label" style="width: 8%;">
								<span class="x-red">*</span>色号
							</label>
							<div class="layui-input-inline" style="width: 188px;">
								<input name="sehao[]" id="val44" lay-verify="sehao" value="<?php echo $sehao4 ?>"
									   autocomplete="off" class="layui-input">
							</div>
							<label for="L_pass" class="layui-form-label" style="width: 8%;">
								<span class="x-red">*</span>数值
							</label>
							<div class="layui-input-inline" style="width: 188px;">
								<input name="shuzhi[]" id="val444" lay-verify="shuzhi" value="<?php echo $shuzhi4 ?>"
									   autocomplete="off" class="layui-input">
							</div>
							<?php if (!empty($guige4) && empty($guige5)) { ?>
								<i class="layui-icon" id="divadd4"
								   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
								   onclick="return addnow(5,4)"></i>
							<?php } else { ?>
								<i class="layui-icon" id="divadd4"
								   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
								   onclick="return addnow(5,4)"></i>
							<?php } ?>
							<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
							   onclick="return dellete(4,3)">&#xe6fe;</i>
						</div>
						<?php if (empty($guige5)){ ?>
						<div class="layui-form-item" id="div5" style="display: none;">
							<?php }else{ ?>
							<div class="layui-form-item" id="div5" style="display: block;">
								<?php } ?>
								<label for="L_pass" class="layui-form-label" style="width: 8%;">
									<span class="x-red">*</span>规格
								</label>
								<div class="layui-input-inline" style="width: 188px;">
									<input name="guige[]" id="val5" lay-verify="guige" value="<?php echo $guige5 ?>"
										   autocomplete="off" class="layui-input">
								</div>
								<label for="L_pass" class="layui-form-label" style="width: 8%;">
									<span class="x-red">*</span>色号
								</label>
								<div class="layui-input-inline" style="width: 188px;">
									<input name="sehao[]" id="val55" lay-verify="sehao" value="<?php echo $sehao5 ?>"
										   autocomplete="off" class="layui-input">
								</div>
								<label for="L_pass" class="layui-form-label" style="width: 8%;">
									<span class="x-red">*</span>数值
								</label>
								<div class="layui-input-inline" style="width: 188px;">
									<input name="shuzhi[]" id="val555" lay-verify="shuzhi"
										   value="<?php echo $shuzhi5 ?>"
										   autocomplete="off" class="layui-input">
								</div>
								<?php if (!empty($guige5) && empty($guige6)) { ?>
									<i class="layui-icon" id="divadd5"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(6,5)"></i>
								<?php } else { ?>
									<i class="layui-icon" id="divadd5"
									   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(6,5)"></i>
								<?php } ?>
								<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
								   onclick="return dellete(5,4)">&#xe6fe;</i>
							</div>
							<?php if (empty($guige6)){ ?>
							<div class="layui-form-item" id="div6" style="display: none;">
								<?php }else{ ?>
								<div class="layui-form-item" id="div6" style="display: block;">
									<?php } ?>
									<label for="L_pass" class="layui-form-label" style="width: 8%;">
										<span class="x-red">*</span>规格
									</label>
									<div class="layui-input-inline" style="width: 188px;">
										<input name="guige[]" id="val6" lay-verify="guige" value="<?php echo $guige6 ?>"
											   autocomplete="off" class="layui-input">
									</div>
									<label for="L_pass" class="layui-form-label" style="width: 8%;">
										<span class="x-red">*</span>色号
									</label>
									<div class="layui-input-inline" style="width: 188px;">
										<input name="sehao[]" id="val66" lay-verify="sehao"
											   value="<?php echo $sehao6 ?>"
											   autocomplete="off" class="layui-input">
									</div>
									<label for="L_pass" class="layui-form-label" style="width: 8%;">
										<span class="x-red">*</span>数值
									</label>
									<div class="layui-input-inline" style="width: 188px;">
										<input name="shuzhi[]" id="val666" lay-verify="shuzhi"
											   value="<?php echo $shuzhi6 ?>"
											   autocomplete="off" class="layui-input">
									</div>
									<?php if (!empty($guige6) && empty($guige7)) { ?>
										<i class="layui-icon" id="divadd6"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(7,6)"></i>
									<?php } else { ?>
										<i class="layui-icon" id="divadd6"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(7,6)"></i>
									<?php } ?>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(6,5)">&#xe6fe;</i>
								</div>
								<?php if (empty($guige7)){ ?>
								<div class="layui-form-item" id="div7" style="display: none;">
									<?php }else{ ?>
									<div class="layui-form-item" id="div7" style="display: block;">
										<?php } ?>
										<label for="L_pass" class="layui-form-label" style="width: 8%;">
											<span class="x-red">*</span>规格
										</label>
										<div class="layui-input-inline" style="width: 188px;">
											<input name="guige[]" id="val7" lay-verify="guige"
												   value="<?php echo $guige7 ?>"
												   autocomplete="off" class="layui-input">
										</div>
										<label for="L_pass" class="layui-form-label" style="width: 8%;">
											<span class="x-red">*</span>色号
										</label>
										<div class="layui-input-inline" style="width: 188px;">
											<input name="sehao[]" id="val77" lay-verify="sehao"
												   value="<?php echo $sehao7 ?>"
												   autocomplete="off" class="layui-input">
										</div>
										<label for="L_pass" class="layui-form-label" style="width: 8%;">
											<span class="x-red">*</span>数值
										</label>
										<div class="layui-input-inline" style="width: 188px;">
											<input name="shuzhi[]" id="val777" lay-verify="shuzhi"
												   value="<?php echo $shuzhi7 ?>"
												   autocomplete="off" class="layui-input">
										</div>
										<?php if (!empty($guige7) && empty($guige8)) { ?>
											<i class="layui-icon" id="divadd7"
											   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return addnow(8,7)"></i>
										<?php } else { ?>
											<i class="layui-icon" id="divadd7"
											   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
											   onclick="return addnow(8,7)"></i>
										<?php } ?>
										<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return dellete(7,6)">&#xe6fe;</i>
									</div>
									<?php if (empty($guige8)){ ?>
									<div class="layui-form-item" id="div8" style="display: none;">
										<?php }else{ ?>
										<div class="layui-form-item" id="div8" style="display: block;">
											<?php } ?>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>规格
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="guige[]" id="val8" lay-verify="guige"
													   value="<?php echo $guige8 ?>"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>色号
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="sehao[]" id="val88" lay-verify="sehao"
													   value="<?php echo $sehao8 ?>"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 8%;">
												<span class="x-red">*</span>数值
											</label>
											<div class="layui-input-inline" style="width: 188px;">
												<input name="shuzhi[]" id="val888" lay-verify="shuzhi"
													   value="<?php echo $shuzhi8 ?>"
													   autocomplete="off" class="layui-input">
											</div>
											<?php if (!empty($guige8) && empty($guige9)) { ?>
												<i class="layui-icon" id="divadd8"
												   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
												   onclick="return addnow(9,8)"></i>
											<?php } else { ?>
												<i class="layui-icon" id="divadd8"
												   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
												   onclick="return addnow(9,8)"></i>
											<?php } ?>
											<i class="iconfont"
											   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
											   onclick="return dellete(8,7)">&#xe6fe;</i>
										</div>
										<?php if (empty($guige9)){ ?>
										<div class="layui-form-item" id="div9" style="display: none;">
											<?php }else{ ?>
											<div class="layui-form-item" id="div9" style="display: block;">
												<?php } ?>
												<label for="L_pass" class="layui-form-label" style="width: 8%;">
													<span class="x-red">*</span>规格
												</label>
												<div class="layui-input-inline" style="width: 188px;">
													<input name="guige[]" id="val9" lay-verify="guige"
														   value="<?php echo $guige9 ?>"
														   autocomplete="off" class="layui-input">
												</div>
												<label for="L_pass" class="layui-form-label" style="width: 8%;">
													<span class="x-red">*</span>色号
												</label>
												<div class="layui-input-inline" style="width: 188px;">
													<input name="sehao[]" id="val99" lay-verify="sehao"
														   value="<?php echo $sehao9 ?>"
														   autocomplete="off" class="layui-input">
												</div>
												<label for="L_pass" class="layui-form-label" style="width: 8%;">
													<span class="x-red">*</span>数值
												</label>
												<div class="layui-input-inline" style="width: 188px;">
													<input name="shuzhi[]" id="val999" lay-verify="shuzhi"
														   value="<?php echo $shuzhi9 ?>"
														   autocomplete="off" class="layui-input">
												</div>
												<?php if (!empty($guige9) && empty($guige10)) { ?>
													<i class="layui-icon" id="divadd9"
													   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
													   onclick="return addnow(10,9)"></i>
												<?php } else { ?>
													<i class="layui-icon" id="divadd9"
													   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
													   onclick="return addnow(10,9)"></i>
												<?php } ?>
												<i class="iconfont"
												   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
												   onclick="return dellete(9,8)">&#xe6fe;</i>
											</div>
											<?php if (empty($guige10)){ ?>
											<div class="layui-form-item" id="div10" style="display: none;">
												<?php }else{ ?>
												<div class="layui-form-item" id="div10" style="display: block;">
													<?php } ?>
													<label for="L_pass" class="layui-form-label" style="width: 8%;">
														<span class="x-red">*</span>规格
													</label>
													<div class="layui-input-inline" style="width: 188px;">
														<input name="guige[]" id="val10" lay-verify="guige"
															   value="<?php echo $guige10 ?>"
															   autocomplete="off" class="layui-input">
													</div>
													<label for="L_pass" class="layui-form-label" style="width: 8%;">
														<span class="x-red">*</span>色号
													</label>
													<div class="layui-input-inline" style="width: 188px;">
														<input name="sehao[]" id="val1010" lay-verify="sehao"
															   value="<?php echo $sehao10 ?>"
															   autocomplete="off" class="layui-input">
													</div>
													<label for="L_pass" class="layui-form-label" style="width: 8%;">
														<span class="x-red">*</span>数值
													</label>
													<div class="layui-input-inline" style="width: 188px;">
														<input name="shuzhi[]" id="val101010" lay-verify="shuzhi"
															   value="<?php echo $shuzhi10 ?>"
															   autocomplete="off" class="layui-input">
													</div>
													<?php if (!empty($shuzhi10)) { ?>
														<i class="layui-icon" id="divadd10"
														   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
														   onclick="return addnow(11,10)"></i>
													<?php } else { ?>
														<i class="layui-icon" id="divadd10"
														   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
														   onclick="return addnow(11,10)"></i>
													<?php } ?>
													<i class="iconfont"
													   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
													   onclick="return dellete(10,9)">&#xe6fe;</i>
												</div>
												<div class="layui-form-item">
													<label class="layui-form-label" style="width: 30%;">
													</label>
													<div class="layui-input-inline" style="width: 300px;">
														<span class="x-red">※</span>请确认输入的数据是否正确。
													</div>
												</div>
												<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
												<div class="layui-form-item">
													<label for="L_repass" class="layui-form-label" style="width: 30%;">
													</label>
													<button class="layui-btn" lay-filter="add" lay-submit="">
														确认提交
													</button>
												</div>
		</form>
	</div>
</div>
<script>
	function addnow(id, idd) {
		$("#div" + id).show();
		$("#divadd" + idd).hide();
		if (id == 2) {
			$("#divadd2").show();
			$("#divadd3").show();
			$("#divadd4").show();
			$("#divadd5").show();
			$("#divadd6").show();
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 3) {
			$("#divadd3").show();
			$("#divadd4").show();
			$("#divadd5").show();
			$("#divadd6").show();
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 4) {
			$("#divadd4").show();
			$("#divadd5").show();
			$("#divadd6").show();
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 5) {
			$("#divadd5").show();
			$("#divadd6").show();
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 6) {
			$("#divadd6").show();
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 7) {
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 8) {
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 9) {
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 10) {
			$("#divadd10").show();
		}
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
							url: "<?= RUN . '/goods/goods_save_edit1' ?>",
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
