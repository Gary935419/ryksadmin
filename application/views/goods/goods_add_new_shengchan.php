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
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a>
              <cite>生产计划添加</cite></a>
          </span>
</div>
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
											<div class="layui-form-item">
												<label for="L_pass" class="layui-form-label" style="width: 10%;">
													<span class="x-red">*</span>组别信息
												</label>
												<div class="layui-input-inline" style="width: 100px;">
													<select name="zuname" id="zuname" lay-verify="zuname">
														<?php if (isset($tidlist) && !empty($tidlist)) { ?>
															<option value="">请选择</option>
															<?php foreach ($tidlist as $k => $v) : ?>
																<option value="<?= $v['lname'] ?>"><?= $v['lname'] ?></option>
															<?php endforeach; ?>
														<?php } ?>
													</select>
												</div>
												<label for="L_pass" class="layui-form-label" style="width: 10%;">
													<span class="x-red">*</span>制品番号
												</label>
												<div class="layui-input-inline" style="width: 100px;">
													<input type="text" id="zhipinfanhao" name="zhipinfanhao" lay-verify="zhipinfanhao"
														   autocomplete="off" class="layui-input">
												</div>
												<label for="L_pass" class="layui-form-label" style="width: 10%;">
													<span class="x-red">*</span>品名
												</label>
												<div class="layui-input-inline" style="width: 100px;">
													<input type="text" id="pinming" name="pinming" lay-verify="pinming"
														   autocomplete="off" class="layui-input">
												</div>
												<label for="L_pass" class="layui-form-label" style="width: 10%;">
													<span class="x-red">*</span>企划数
												</label>
												<div class="layui-input-inline" style="width: 100px;">
													<input type="text" id="qihuashu" name="qihuashu" lay-verify="qihuashu"
														   autocomplete="off" class="layui-input">
												</div>
											</div>
											<div class="layui-form-item">
											    <label for="L_pass" class="layui-form-label" style="width: 10%;">
													<span class="x-red">*</span>上月数
												</label>
												<div class="layui-input-inline" style="width: 100px;">
													<input type="text" id="shangyue" name="shangyue" lay-verify="shangyue"
														   autocomplete="off" class="layui-input">
												</div>
												<label for="L_pass" class="layui-form-label" style="width: 10%;">
													<span class="x-red">*</span>纳期
												</label>
												<div class="layui-input-inline" style="width: 100px;">
													<input id="naqi" name="naqi" lay-verify="naqi"
														   autocomplete="off" class="layui-input">
												</div>
												<label for="L_pass" class="layui-form-label" style="width: 10%;">
													<span class="x-red">*</span>计划时间
												</label>
												<div class="layui-input-inline" style="width: 100px;">
													<input id="jihuariqi" name="jihuariqi" lay-verify="jihuariqi"
														   autocomplete="off" class="layui-input">
												</div>
											</div>
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

<script>layui.use(['laydate', 'form'],
			function() {
				var laydate = layui.laydate;
				//执行一个laydate实例
				laydate.render({
					elem: '#naqi' //指定元素
				});
				laydate.render({
					elem: '#jihuariqi', //指定元素
					format: 'yyyy-MM',
					type: 'month',
				});
			});
</script>
<script>
	layui.use(['form','layedit', 'layer'],
			function () {
				var form = layui.form,
						layer = layui.layer;
				//自定义验证规则
				form.verify({
					zuname: function (value) {
						if ($("#zuname option:selected").val() == "") {
							return '请选择选择组别信息。';
						}
					},
					zhipinfanhao: function (value) {
						if ($('#zhipinfanhao').val() == "") {
							return '请输入制品番号。';
						}
					},
					pinming: function (value) {
						if ($('#pinming').val() == "") {
							return '请输入品名。';
						}
					},
					qihuashu: function (value) {
						if ($('#qihuashu').val() == "") {
							return '请输入企划数。';
						}
					},
					naqi: function (value) {
						if ($('#naqi').val() == "") {
							return '请输入纳期。';
						}
					},
					jihuariqi: function (value) {
						if ($('#jihuariqi').val() == "") {
							return '请输入计划日期。';
						}
					},
				});

				$("#tab").validate({
					submitHandler: function (form) {
						$.ajax({
							cache: true,
							type: "POST",
							url: "<?= RUN . '/goods/goods_save_jihua' ?>",
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
