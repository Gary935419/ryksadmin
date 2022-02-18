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
                            <th>品番</th>
                            <th>裁断数量</th>
							<th>指示数量</th>
						<tr>
                        </thead>
                        <tbody>

							<tr id="div1">
								<td>
									<i class="layui-icon" id="divadd1" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(2,1)"></i>
								</td>
								<td><input name="sehao[]" id="val1" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val11" autocomplete="off" class="layui-input"></td>
								<td><input name="caiduanshu[]" id="val111" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val1111" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div2" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd2" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(3,2)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(2,1)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val2" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val22" autocomplete="off" class="layui-input"></td>
								<td><input name="caiduanshu[]" id="val222" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val2222" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div3" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd3" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(4,3)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(3,2)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val3" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val33" autocomplete="off" class="layui-input"></td>
								<td><input name="caiduanshu[]" id="val333" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val3333" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div4" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd4" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(5,4)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(4,3)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val4" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val44" autocomplete="off" class="layui-input"></td>
								<td><input name="caiduanshu[]" id="val444" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val4444" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div5" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd5" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(6,5)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(5,4)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val5" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val55" autocomplete="off" class="layui-input"></td>
								<td><input name="caiduanshu[]" id="val555" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val5555" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div6" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd6" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(7,6)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(6,5)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val6" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val66" autocomplete="off" class="layui-input"></td>
								<td><input name="caiduanshu[]" id="val666" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val6666" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div7" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd7" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(8,7)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(7,6)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val7" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val77" autocomplete="off" class="layui-input"></td>
								<td><input name="caiduanshu[]" id="val777" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val7777" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div8" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd8" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(9,8)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(8,7)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val8" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val88" autocomplete="off" class="layui-input"></td>
								<td><input name="caiduanshu[]" id="val888" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val8888" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div9" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd9" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(10,9)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(9,8)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val9" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val99" autocomplete="off" class="layui-input"></td>
								<td><input name="caiduanshu[]" id="val999" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val9999" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div10" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd10" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(11,10)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(10,9)">&#xe6fe;</i>
								</td>
								<td><input name="sehao[]" id="val10" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val1010" autocomplete="off" class="layui-input"></td>
								<td><input name="caiduanshu[]" id="val101010" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishishu[]" id="val10101010" autocomplete="off" class="layui-input"></td>
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
		$("#div" + id).show()
		$("#divadd" + idd).hide();
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
							url: "<?= RUN . '/goods/goods_save2_caij' ?>",
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
