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
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>合同编号
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="bianhao" name="bianhao" lay-verify="bianhao"
						   autocomplete="off" value="<?php echo $bianhao ?>" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 10%;">
					<span class="x-red">*</span>甲方名称
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="mingcheng" name="mingcheng" lay-verify="mingcheng"
						   autocomplete="off" value="<?php echo $mingcheng ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>签订时间
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input id="qianding" name="qianding" lay-verify="qianding"
						   autocomplete="off" value="<?php echo date('Y-m-d', $qianding) ?>" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 10%;">
					<span class="x-red">*</span>交货时间
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input id="jiaohuoqi" name="jiaohuoqi" lay-verify="jiaohuoqi"
						   autocomplete="off" value="<?php echo date('Y-m-d', $jiaohuoqi) ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>项目负责人
				</label>
				<div class="layui-input-inline" style="width: 66%;">
					<?php if (isset($tidlist) && !empty($tidlist)) { ?>
						<?php foreach ($tidlist as $k => $v) : ?>
							<?php if (in_array($v['id'], $mefuze)) { ?>
								<input type="checkbox" name="menu[]" checked value="<?= $v['id'] ?>" lay-skin="primary"
									   lay-filter="father"
									   lay-verify="check" title="<?= $v['username'] ?>">
							<?php } else { ?>
								<input type="checkbox" name="menu[]" value="<?= $v['id'] ?>" lay-skin="primary"
									   lay-filter="father"
									   lay-verify="check" title="<?= $v['username'] ?>">
							<?php } ?>
						<?php endforeach; ?>
					<?php } ?>
				</div>
			</div>

			<div class="layui-form-item" id="div1">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>合同款号
				</label>
				<?php if (!empty($kuanhao1) && empty($kuanhao2)) { ?>
					<i class="layui-icon" id="divadd1" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
					   onclick="return addnow(2,1)"></i>
				<?php } else { ?>
					<i class="layui-icon" id="divadd1"
					   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
					   onclick="return addnow(2,1)"></i>
				<?php } ?>
				<div class="layui-input-inline" style="width: 300px;">
					<input name="kuanhao[]" lay-verify="kuanhao" value="<?php echo $kuanhao1 ?>"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<?php if (empty($kuanhao2)){ ?>
			<div class="layui-form-item" id="div2" style="display: none;">
				<?php }else{ ?>
				<div class="layui-form-item" id="div2" style="display: block;">
					<?php } ?>
					<label for="L_pass" class="layui-form-label" style="width: 20%;">
						<span class="x-red">*</span>合同款号
					</label>
					<?php if (!empty($kuanhao2) && empty($kuanhao3)) { ?>
						<i class="layui-icon" id="divadd2" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
						   onclick="return addnow(3,2)"></i>
					<?php } else { ?>
						<i class="layui-icon" id="divadd2"
						   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
						   onclick="return addnow(3,2)"></i>
					<?php } ?>

					<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
					   onclick="return dellete(2,1)">&#xe6fe;</i>
					<div class="layui-input-inline" style="width: 300px;">
						<input name="kuanhao[]" id="val2" lay-verify="kuanhao" value="<?php echo $kuanhao2 ?>"
							   autocomplete="off" class="layui-input">
					</div>
				</div>
				<?php if (empty($kuanhao3)){ ?>
				<div class="layui-form-item" id="div3" style="display: none;">
					<?php }else{ ?>
					<div class="layui-form-item" id="div3" style="display: block;">
						<?php } ?>
						<label for="L_pass" class="layui-form-label" style="width: 20%;">
							<span class="x-red">*</span>合同款号
						</label>
						<?php if (!empty($kuanhao3) && empty($kuanhao4)) { ?>
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
						<div class="layui-input-inline" style="width: 300px;">
							<input name="kuanhao[]" id="val3" lay-verify="kuanhao" value="<?php echo $kuanhao3 ?>"
								   autocomplete="off" class="layui-input">
						</div>
					</div>
					<?php if (empty($kuanhao4)){ ?>
					<div class="layui-form-item" id="div4" style="display: none;">
						<?php }else{ ?>
						<div class="layui-form-item" id="div4" style="display: block;">
							<?php } ?>
							<label for="L_pass" class="layui-form-label" style="width: 20%;">
								<span class="x-red">*</span>合同款号
							</label>
							<?php if (!empty($kuanhao4) && empty($kuanhao5)) { ?>
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
							<div class="layui-input-inline" style="width: 300px;">
								<input name="kuanhao[]" id="val4" lay-verify="kuanhao" value="<?php echo $kuanhao4 ?>"
									   autocomplete="off" class="layui-input">
							</div>
						</div>
						<?php if (empty($kuanhao5)){ ?>
						<div class="layui-form-item" id="div5" style="display: none;">
							<?php }else{ ?>
							<div class="layui-form-item" id="div5" style="display: block;">
								<?php } ?>
								<label for="L_pass" class="layui-form-label" style="width: 20%;">
									<span class="x-red">*</span>合同款号
								</label>
								<?php if (!empty($kuanhao5) && empty($kuanhao6)) { ?>
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
								<div class="layui-input-inline" style="width: 300px;">
									<input name="kuanhao[]" id="val5" lay-verify="kuanhao"
										   value="<?php echo $kuanhao5 ?>"
										   autocomplete="off" class="layui-input">
								</div>
							</div>
							<?php if (empty($kuanhao6)){ ?>
							<div class="layui-form-item" id="div6" style="display: none;">
								<?php }else{ ?>
								<div class="layui-form-item" id="div6" style="display: block;">
									<?php } ?>
									<label for="L_pass" class="layui-form-label" style="width: 20%;">
										<span class="x-red">*</span>合同款号
									</label>
									<?php if (!empty($kuanhao6) && empty($kuanhao7)) { ?>
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
									<div class="layui-input-inline" id="val6" style="width: 300px;">
										<input name="kuanhao[]" id="val6" lay-verify="kuanhao"
											   value="<?php echo $kuanhao6 ?>"
											   autocomplete="off" class="layui-input">
									</div>
								</div>
								<?php if (empty($kuanhao7)){ ?>
								<div class="layui-form-item" id="div7" style="display: none;">
									<?php }else{ ?>
									<div class="layui-form-item" id="div7" style="display: block;">
										<?php } ?>
										<label for="L_pass" class="layui-form-label" style="width: 20%;">
											<span class="x-red">*</span>合同款号
										</label>
										<?php if (!empty($kuanhao7) && empty($kuanhao8)) { ?>
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
										<div class="layui-input-inline" style="width: 300px;">
											<input name="kuanhao[]" id="val7" lay-verify="kuanhao"
												   value="<?php echo $kuanhao7 ?>"
												   autocomplete="off" class="layui-input">
										</div>
									</div>
									<?php if (empty($kuanhao8)){ ?>
									<div class="layui-form-item" id="div8" style="display: none;">
										<?php }else{ ?>
										<div class="layui-form-item" id="div8" style="display: block;">
											<?php } ?>
											<label for="L_pass" class="layui-form-label" style="width: 20%;">
												<span class="x-red">*</span>合同款号
											</label>
											<?php if (!empty($kuanhao8) && empty($kuanhao9)) { ?>
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
											<div class="layui-input-inline" style="width: 300px;">
												<input name="kuanhao[]" id="val8" lay-verify="kuanhao"
													   value="<?php echo $kuanhao8 ?>"
													   autocomplete="off" class="layui-input">
											</div>
										</div>
										<?php if (empty($kuanhao9)){ ?>
										<div class="layui-form-item" id="div9" style="display: none;">
											<?php }else{ ?>
											<div class="layui-form-item" id="div9" style="display: block;">
												<?php } ?>
												<label for="L_pass" class="layui-form-label" style="width: 20%;">
													<span class="x-red">*</span>合同款号
												</label>
												<?php if (!empty($kuanhao9) && empty($kuanhao10)) { ?>
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
												<div class="layui-input-inline" style="width: 300px;">
													<input name="kuanhao[]" id="val9" lay-verify="kuanhao"
														   value="<?php echo $kuanhao9 ?>"
														   autocomplete="off" class="layui-input">
												</div>
											</div>
											<?php if (empty($kuanhao10)){ ?>
											<div class="layui-form-item" id="div10" style="display: none;">
												<?php }else{ ?>
												<div class="layui-form-item" id="div10" style="display: block;">
													<?php } ?>
													<label for="L_pass" class="layui-form-label" style="width: 20%;">
														<span class="x-red">*</span>合同款号
													</label>
													<?php if (!empty($kuanhao10)) { ?>
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
													<div class="layui-input-inline" style="width: 300px;">
														<input name="kuanhao[]" id="val10" lay-verify="kuanhao"
															   value="<?php echo $kuanhao10 ?>"
															   autocomplete="off" class="layui-input">
													</div>
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
		$("#divadd" + idd).show();
	}
</script>
<script>layui.use(['laydate', 'form'],
			function () {
				var laydate = layui.laydate;
				//执行一个laydate实例
				laydate.render({
					elem: '#qianding' //指定元素
				});
				laydate.render({
					elem: '#jiaohuoqi' //指定元素
				});
			});
</script>
<script>
	layui.use(['form', 'layedit', 'layer'],
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
				var editIndex1 = layedit.build('gcontent', {
					height: 300,
				});
				//自定义验证规则
				form.verify({
					bianhao: function (value) {
						if ($('#bianhao').val() == "") {
							return '请输入合同编号。';
						}
					},
					mingcheng: function (value) {
						if ($('#mingcheng').val() == "") {
							return '请输入甲方名称。';
						}
					},
					qianding: function (value) {
						if ($('#qianding').val() == "") {
							return '请输入签订时间。';
						}
					},
					jiaohuoqi: function (value) {
						if ($('#jiaohuoqi').val() == "") {
							return '请输入交货时间。';
						}
					},
					check: function () {
						var checked = $("input[type='checkbox']:checked").length;
						if (checked < 1) {
							return '请勾选负责人。';
						}
					}
				});

				$("#tab").validate({
					submitHandler: function (form) {
						$.ajax({
							cache: true,
							type: "POST",
							url: "<?= RUN . '/goods/goods_save_edit' ?>",
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
