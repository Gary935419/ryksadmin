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
							<th>色号</th>
							<th>规格</th>
							<th style="display: none">裁断数量</th>
							<th>指示数量</th>
							<th>标记</th>
							<th>备注</th>
							<th style="display: none">信息</th>
							<th style="display: none">箱数</th>
                        </thead>
                        <tbody>
							<tr id="div1">
								<td><input name="sehao[]" id="val1" value="<?php echo $sehao1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val11" value="<?php echo $pinfan1 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val111" value="<?php echo $caiduanshu1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val1111" value="<?php echo $zhishishu1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="biaoji[]" id="val11111" value="<?php echo $biaoji1 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val111111" value="<?php echo $beizhu1 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangxinxi[]" id="val1111111" value="<?php echo $zhuangxiangxinxi1 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangshuliang[]" id="val11111111" value="<?php echo $zhuangxiangshuliang1 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($sehao2)){ ?>
							<tr id="div2" style="display: none;">
							<?php }else{ ?>
							<tr id="div2">
							<?php } ?>
								<td><input name="sehao[]" id="val2" value="<?php echo $sehao2 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val22" value="<?php echo $pinfan2 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val222" value="<?php echo $caiduanshu2 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val2222" value="<?php echo $zhishishu2 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="biaoji[]" id="val22222" value="<?php echo $biaoji2 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val222222" value="<?php echo $beizhu2 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangxinxi[]" id="val2222222" value="<?php echo $zhuangxiangxinxi2 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangshuliang[]" id="val22222222" value="<?php echo $zhuangxiangshuliang2 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($sehao3)){ ?>
							<tr id="div3" style="display: none;">
							<?php }else{ ?>
							<tr id="div3">
							<?php } ?>
								<td><input name="sehao[]" id="val3" value="<?php echo $sehao3 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val33" value="<?php echo $pinfan3 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val333" value="<?php echo $caiduanshu3 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val3333" value="<?php echo $zhishishu3 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="biaoji[]" id="val33333" value="<?php echo $biaoji3 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val333333" value="<?php echo $beizhu3 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangxinxi[]" id="val3333333" value="<?php echo $zhuangxiangxinxi3 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangshuliang[]" id="val33333333" value="<?php echo $zhuangxiangshuliang3 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($sehao4)){ ?>
							<tr id="div4" style="display: none;">
								<?php }else{ ?>
							<tr id="div4">
								<?php } ?>
								<td><input name="sehao[]" id="val4" value="<?php echo $sehao4 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val44" value="<?php echo $pinfan4 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val444" value="<?php echo $caiduanshu4 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val4444" value="<?php echo $zhishishu4 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="biaoji[]" id="val44444" value="<?php echo $biaoji4 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val444444" value="<?php echo $beizhu4 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangxinxi[]" id="val4444444" value="<?php echo $zhuangxiangxinxi4 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangshuliang[]" id="val44444444" value="<?php echo $zhuangxiangshuliang4 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($sehao5)){ ?>
							<tr id="div5" style="display: none;">
								<?php }else{ ?>
							<tr id="div5">
								<?php } ?>
								<td><input name="sehao[]" id="val5" value="<?php echo $sehao5 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val55" value="<?php echo $pinfan5 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val555" value="<?php echo $caiduanshu5 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val5555" value="<?php echo $zhishishu5 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="biaoji[]" id="val55555" value="<?php echo $biaoji5 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val555555" value="<?php echo $beizhu5 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangxinxi[]" id="val5555555" value="<?php echo $zhuangxiangxinxi5 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangshuliang[]" id="val55555555" value="<?php echo $zhuangxiangshuliang5 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($sehao6)){ ?>
							<tr id="div6" style="display: none;">
								<?php }else{ ?>
							<tr id="div6">
								<?php } ?>
								<td><input name="sehao[]" id="val6" value="<?php echo $sehao6 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val66" value="<?php echo $pinfan6 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val666" value="<?php echo $caiduanshu6 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val6666" value="<?php echo $zhishishu6 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="biaoji[]" id="val66666" value="<?php echo $biaoji6 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val666666" value="<?php echo $beizhu6 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangxinxi[]" id="val6666666" value="<?php echo $zhuangxiangxinxi6 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangshuliang[]" id="val66666666" value="<?php echo $zhuangxiangshuliang6 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($sehao7)){ ?>
							<tr id="div7" style="display: none;">
								<?php }else{ ?>
							<tr id="div7">
								<?php } ?>
								<td><input name="sehao[]" id="val7" value="<?php echo $sehao7 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val77" value="<?php echo $pinfan7 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val777" value="<?php echo $caiduanshu7 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val7777" value="<?php echo $zhishishu7 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="biaoji[]" id="val77777" value="<?php echo $biaoji7 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val777777" value="<?php echo $beizhu7 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangxinxi[]" id="val7777777" value="<?php echo $zhuangxiangxinxi7 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangshuliang[]" id="val77777777" value="<?php echo $zhuangxiangshuliang7 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($sehao8)){ ?>
							<tr id="div8" style="display: none;">
								<?php }else{ ?>
							<tr id="div8">
								<?php } ?>
								<td><input name="sehao[]" id="val8" value="<?php echo $sehao8 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val88" value="<?php echo $pinfan8 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val888" value="<?php echo $caiduanshu8 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val8888" value="<?php echo $zhishishu8 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="biaoji[]" id="val88888" value="<?php echo $biaoji8 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val888888" value="<?php echo $beizhu8 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangxinxi[]" id="val8888888" value="<?php echo $zhuangxiangxinxi8 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangshuliang[]" id="val88888888" value="<?php echo $zhuangxiangshuliang8 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($sehao9)){ ?>
							<tr id="div9" style="display: none;">
								<?php }else{ ?>
							<tr id="div9">
								<?php } ?>
								<td><input name="sehao[]" id="val9" value="<?php echo $sehao9 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val99" value="<?php echo $pinfan9 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val999" value="<?php echo $caiduanshu9 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val9999" value="<?php echo $zhishishu9 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="biaoji[]" id="val99999" value="<?php echo $biaoji9 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val999999" value="<?php echo $beizhu9 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangxinxi[]" id="val9999999" value="<?php echo $zhuangxiangxinxi9 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangshuliang[]" id="val99999999" value="<?php echo $zhuangxiangshuliang9 ?>" autocomplete="off" class="layui-input"></td>
							</tr>
							    <?php if (empty($sehao10)){ ?>
							<tr id="div10" style="display: none;">
								<?php }else{ ?>
							<tr id="div10">
								<?php } ?>
								<td><input name="sehao[]" id="val10" value="<?php echo $sehao10 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val1010" value="<?php echo $pinfan10 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="caiduanshu[]" readonly id="val101010" value="<?php echo $caiduanshu10 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val10101010" value="<?php echo $zhishishu10 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="biaoji[]" id="val1010101010" value="<?php echo $biaoji10 ?>" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val101010101010" value="<?php echo $beizhu10 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangxinxi[]" id="val10101010101010" value="<?php echo $zhuangxiangxinxi10 ?>" autocomplete="off" class="layui-input"></td>
								<td style="display: none"><input name="zhuangxiangshuliang[]" id="val1010101010101010" value="<?php echo $zhuangxiangshuliang10 ?>" autocomplete="off" class="layui-input"></td>
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
		$("#val" + id + id + id + id).val("")
		$("#val" + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id).val("");
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
							url: "<?= RUN . '/goods/goods_save_edit2_caitongji' ?>",
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
