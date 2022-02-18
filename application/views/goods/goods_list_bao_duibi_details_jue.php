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
						<p style="font-size: 25px;font-weight: bold;margin-bottom: 15px;margin-top: 15px;">预算裁断书信息</p>
						<table class="layui-table layui-form">
							<thead>
							<tr>
								<th>色号</th>
								<th>品番</th>
								<th>裁断数量</th>
								<th>指示数量</th>
							</thead>
							<tbody>
							<tr id="div1" <?php echo empty($yi_flg)?:'' ?>>
								<td><input name="xiangmu[]" value="<?php echo $sehao1 ?>" id="val1" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $pinfan1 ?>" id="val11" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $caiduanshu1 ?>" id="val111" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $zhishishu1 ?>" id="val1111" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($sehao2)){ ?>
							<tr id="div2" style="display: none;">
							<?php }else{ ?>
							<tr id="div2" <?php echo empty($er_flg)?:'' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $sehao2 ?>" id="val2" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $pinfan2 ?>" id="val22" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $caiduanshu2 ?>" id="val222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $zhishishu2 ?>" id="val2222" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($sehao3)){ ?>
							<tr id="div3" style="display: none;">
							<?php }else{ ?>
							<tr id="div3" <?php echo empty($san_flg)?:'' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $sehao3 ?>" id="val3" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $pinfan3 ?>" id="val33" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $caiduanshu3 ?>" id="val333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $zhishishu3 ?>" id="val3333" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($sehao4)){ ?>
							<tr id="div4" style="display: none;">
							<?php }else{ ?>
							<tr id="div4" <?php echo empty($si_flg)?:'' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $sehao4 ?>" id="val4" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $pinfan4 ?>" id="val44" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $caiduanshu4 ?>" id="val444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $zhishishu4 ?>" id="val4444" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($sehao5)){ ?>
							<tr id="div5" style="display: none;">
							<?php }else{ ?>
							<tr id="div5" <?php echo empty($wu_flg)?:'' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $sehao5 ?>" id="val5" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $pinfan5 ?>" id="val55" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $caiduanshu5 ?>" id="val555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $zhishishu5 ?>" id="val5555" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($sehao6)){ ?>
							<tr id="div6" style="display: none;">
							<?php }else{ ?>
							<tr id="div6" <?php echo empty($liu_flg)?:'' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $sehao6 ?>" id="val6" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $pinfan6 ?>" id="val66" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $caiduanshu6 ?>" id="val666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $zhishishu6 ?>" id="val6666" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($sehao7)){ ?>
							<tr id="div7" style="display: none;">
							<?php }else{ ?>
							<tr id="div7" <?php echo empty($qi_flg)?:'' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $sehao7 ?>" id="val7" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $pinfan7 ?>" id="val77" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $caiduanshu7 ?>" id="val777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $zhishishu7 ?>" id="val7777" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($sehao8)){ ?>
							<tr id="div8" style="display: none;">
							<?php }else{ ?>
							<tr id="div8" <?php echo empty($ba_flg)?:'' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $sehao8 ?>" id="val8" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $pinfan8 ?>" id="val88" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $caiduanshu8 ?>" id="val888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $zhishishu8 ?>" id="val8888" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($sehao9)){ ?>
							<tr id="div9" style="display: none;">
							<?php }else{ ?>
							<tr id="div9" <?php echo empty($jiu_flg)?:'' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $sehao9 ?>" id="val9" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $pinfan9 ?>" id="val99" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $caiduanshu9 ?>" id="val999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $zhishishu9 ?>" id="val9999" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($sehao10)){ ?>
							<tr id="div10" style="display: none;">
								<?php }else{ ?>
							<tr id="div10" <?php echo empty($shi_flg)?:'' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $sehao10 ?>" id="val10" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $pinfan10 ?>" id="val1010" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $caiduanshu10 ?>" id="val101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $zhishishu10 ?>" id="val10101010" autocomplete="off" class="layui-input"></td>
							</tr>
							</tbody>
						</table>
						<div class="layui-form-item" style="margin-top: 15px;">
							<label for="L_repass" class="layui-form-label" style="width: 100%;">
							</label>
								<button class="layui-btn" lay-filter="add" type="submit" onclick="return submitgo()">
									返回上一页
								</button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="layui-fluid">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-body ">
					<form method="post" class="layui-form" style="margin-top: 15px" action="" name="basic_validate" id="tab">
						<p style="font-size: 25px;font-weight: bold;margin-bottom: 15px;margin-top: 15px;">决算裁断书信息</p>
						<table class="layui-table layui-form">
							<thead>
							<tr>
								<th>色号</th>
								<th>品番</th>
								<th>裁断数量</th>
								<th>指示数量</th>
							</thead>
							<tbody>
							<tr id="div1" <?php echo empty($yi_flg)?:'style="border: 5px solid #F00;"' ?>>
								<td><input name="xiangmu[]" value="<?php echo $jsehao1 ?>" id="val1" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jpinfan1 ?>" id="val11" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jcaiduanshu1 ?>" id="val111" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jzhishishu1 ?>" id="val1111" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jsehao2)){ ?>
							<tr id="div2" style="display: none;">
							<?php }else{ ?>
							<tr id="div2" <?php echo empty($er_flg)?:'style="border: 5px solid #F00;"' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jsehao2 ?>" id="val2" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jpinfan2 ?>" id="val22" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jcaiduanshu2 ?>" id="val222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jzhishishu2 ?>" id="val2222" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jsehao3)){ ?>
							<tr id="div3" style="display: none;">
							<?php }else{ ?>
							<tr id="div3" <?php echo empty($san_flg)?:'style="border: 5px solid #F00;"' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jsehao3 ?>" id="val3" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jpinfan3 ?>" id="val33" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jcaiduanshu3 ?>" id="val333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jzhishishu3 ?>" id="val3333" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jsehao4)){ ?>
							<tr id="div4" style="display: none;">
							<?php }else{ ?>
							<tr id="div4" <?php echo empty($si_flg)?:'style="border: 5px solid #F00;"' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jsehao4 ?>" id="val4" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jpinfan4 ?>" id="val44" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jcaiduanshu4 ?>" id="val444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jzhishishu4 ?>" id="val4444" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jsehao5)){ ?>
							<tr id="div5" style="display: none;">
							<?php }else{ ?>
							<tr id="div5" <?php echo empty($wu_flg)?:'style="border: 5px solid #F00;"' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jsehao5 ?>" id="val5" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jpinfan5 ?>" id="val55" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jcaiduanshu5 ?>" id="val555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jzhishishu5 ?>" id="val5555" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jsehao6)){ ?>
							<tr id="div6" style="display: none;">
							<?php }else{ ?>
							<tr id="div6" <?php echo empty($liu_flg)?:'style="border: 5px solid #F00;"' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jsehao6 ?>" id="val6" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jpinfan6 ?>" id="val66" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jcaiduanshu6 ?>" id="val666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jzhishishu6 ?>" id="val6666" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jsehao7)){ ?>
							<tr id="div7" style="display: none;">
							<?php }else{ ?>
							<tr id="div7" <?php echo empty($qi_flg)?:'style="border: 5px solid #F00;"' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jsehao7 ?>" id="val7" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jpinfan7 ?>" id="val77" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jcaiduanshu7 ?>" id="val777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jzhishishu7 ?>" id="val7777" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jsehao8)){ ?>
							<tr id="div8" style="display: none;">
							<?php }else{ ?>
							<tr id="div8" <?php echo empty($ba_flg)?:'style="border: 5px solid #F00;"' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jsehao8 ?>" id="val8" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jpinfan8 ?>" id="val88" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jcaiduanshu8 ?>" id="val888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jzhishishu8 ?>" id="val8888" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jsehao9)){ ?>
							<tr id="div9" style="display: none;">
							<?php }else{ ?>
							<tr id="div9" <?php echo empty($jiu_flg)?:'style="border: 5px solid #F00;"' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jsehao9 ?>" id="val9" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jpinfan9 ?>" id="val99" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jcaiduanshu9 ?>" id="val999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jzhishishu9 ?>" id="val9999" autocomplete="off" class="layui-input"></td>
							</tr>
							<?php if (empty($jsehao10)){ ?>
							<tr id="div10" style="display: none;">
								<?php }else{ ?>
							<tr id="div10" <?php echo empty($shi_flg)?:'style="border: 5px solid #F00;"' ?>>
								<?php } ?>
								<td><input name="xiangmu[]" value="<?php echo $jsehao10 ?>" id="val10" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" value="<?php echo $jpinfan10 ?>" id="val1010" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" value="<?php echo $jcaiduanshu10 ?>" id="val101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" value="<?php echo $jzhishishu10 ?>" id="val10101010" autocomplete="off" class="layui-input"></td>
							</tr>
							</tbody>
						</table>
						<div class="layui-form-item" style="margin-top: 15px;">
							<label for="L_repass" class="layui-form-label" style="width: 100%;">
							</label>
							<button class="layui-btn" lay-filter="add" type="submit" onclick="return submitgo()">
								返回上一页
							</button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>
<script>
	function submitgo(){
		//关闭当前frame
		xadmin.close();
	}
</script>
</body>
</html>
