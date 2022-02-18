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
							<th>色号</th>
							<th>规格</th>
							<th style="display: none">裁断数量</th>
							<th>指示数量</th>
                        </thead>
                        <tbody>
							<tr id="div1">
								<td style="min-width: 80px">
									<?php if (!empty($sehao1) && empty($sehao2)) { ?>
										<i class="layui-icon" id="divadd1"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(2,1)"></i>
									<?php } else { ?>
										<i class="layui-icon" id="divadd1"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(2,1)"></i>
									<?php } ?>
								</td>
								<td><input name="sehao[]" id="val1" value="<?php echo $sehao1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val11" value="<?php echo $pinfan1 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val111" value="<?php echo $caiduanshu1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val1111" value="<?php echo $zhishishu1 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($sehao2)){ ?>
							<tr id="div2" style="display: none;">
							<?php }else{ ?>
							<tr id="div2">
							<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($sehao2) && empty($sehao3)) { ?>
										<i class="layui-icon" id="divadd2"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(3,2)"></i>
									<?php } else { ?>
										<i class="layui-icon" id="divadd2"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(3,2)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(2,1)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val2" value="<?php echo $sehao2 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val22" value="<?php echo $pinfan2 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val222" value="<?php echo $caiduanshu2 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val2222" value="<?php echo $zhishishu2 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($sehao3)){ ?>
							<tr id="div3" style="display: none;">
							<?php }else{ ?>
							<tr id="div3">
							<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($sehao3) && empty($sehao4)) { ?>
										<i class="layui-icon"
										   id="divadd3"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(4,3)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd3"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(4,3)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(3,2)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val3" value="<?php echo $sehao3 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val33" value="<?php echo $pinfan3 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val333" value="<?php echo $caiduanshu3 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val3333" value="<?php echo $zhishishu3 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($sehao4)){ ?>
							<tr id="div4" style="display: none;">
								<?php }else{ ?>
							<tr id="div4">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($sehao4) && empty($sehao5)) { ?>
										<i class="layui-icon"
										   id="divadd4"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(5,4)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd4"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(5,4)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(4,3)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val4" value="<?php echo $sehao4 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val44" value="<?php echo $pinfan4 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val444" value="<?php echo $caiduanshu4 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val4444" value="<?php echo $zhishishu4 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($sehao5)){ ?>
							<tr id="div5" style="display: none;">
								<?php }else{ ?>
							<tr id="div5">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($sehao5) && empty($sehao6)) { ?>
										<i class="layui-icon"
										   id="divadd5"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(6,5)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd5"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(6,5)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(5,4)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val5" value="<?php echo $sehao5 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val55" value="<?php echo $pinfan5 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val555" value="<?php echo $caiduanshu5 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val5555" value="<?php echo $zhishishu5 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($sehao6)){ ?>
							<tr id="div6" style="display: none;">
								<?php }else{ ?>
							<tr id="div6">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($sehao6) && empty($sehao7)) { ?>
										<i class="layui-icon"
										   id="divadd6"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(7,6)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd6"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(7,6)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(6,5)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val6" value="<?php echo $sehao6 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val66" value="<?php echo $pinfan6 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val666" value="<?php echo $caiduanshu6 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val6666" value="<?php echo $zhishishu6 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($sehao7)){ ?>
							<tr id="div7" style="display: none;">
								<?php }else{ ?>
							<tr id="div7">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($sehao7) && empty($sehao8)) { ?>
										<i class="layui-icon"
										   id="divadd7"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(8,7)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd7"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(8,7)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(7,6)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val7" value="<?php echo $sehao7 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val77" value="<?php echo $pinfan7 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val777" value="<?php echo $caiduanshu7 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val7777" value="<?php echo $zhishishu7 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($sehao8)){ ?>
							<tr id="div8" style="display: none;">
								<?php }else{ ?>
							<tr id="div8">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($sehao8) && empty($sehao7)) { ?>
										<i class="layui-icon"
										   id="divadd8"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(9,8)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd8"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(9,8)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(8,7)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val8" value="<?php echo $sehao8 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val88" value="<?php echo $pinfan8 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val888" value="<?php echo $caiduanshu8 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val8888" value="<?php echo $zhishishu8 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($sehao9)){ ?>
							<tr id="div9" style="display: none;">
								<?php }else{ ?>
							<tr id="div9">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($sehao9) && empty($sehao10)) { ?>
										<i class="layui-icon"
										   id="divadd9"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(10,9)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd9"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(10,9)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(9,8)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val9" value="<?php echo $sehao9 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val99" value="<?php echo $pinfan9 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val999" value="<?php echo $caiduanshu9 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val9999" value="<?php echo $zhishishu9 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($sehao10)){ ?>
							<tr id="div10" style="display: none;">
								<?php }else{ ?>
							<tr id="div10">
								<?php } ?>
								<td style="min-width: 80px;">
									<?php if (!empty($sehao10)) { ?>
										<i class="layui-icon"
										   id="divadd10"
										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(11,10)"></i>
									<?php } else { ?>
										<i class="layui-icon"
										   id="divadd10"
										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
										   onclick="return addnow(11,10)"></i>
									<?php } ?>
									<i class="iconfont"
									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(10,9)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val10" value="<?php echo $sehao10 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val1010" value="<?php echo $pinfan10 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val101010" value="<?php echo $caiduanshu10 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val10101010" value="<?php echo $zhishishu10 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
                        </tbody>
                    </table>
					<div class="layui-form-item" style="margin-top: 15px;">
						<label for="L_repass" class="layui-form-label" style="width: 90%;">
						</label>
						<button class="layui-btn" lay-filter="add" lay-submit="">
							确认提交
						</button>
					</div>
					</form>
				</div>
            </div>
        </div>
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
		$("#val" + id + id + id + id).val("");
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
							url: "<?= RUN . '/goods/goods_save_edit2_cai' ?>",
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
