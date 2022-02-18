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
<!--<div class="x-nav">-->
<!--          <span class="layui-breadcrumb">-->
<!--            <a>-->
<!--              <cite>生产计划导入</cite></a>-->
<!--          </span>-->
<!--</div>-->
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
										<form method="post" enctype="multipart/form-data" class="layui-form" style="margin-top: 15px" action="" name="basic_validate" id="tab">
											<div class="layui-form-item">
												<input type="hidden" id="kuanhao" name="kuanhao" lay-verify="kuanhao" value="<?php echo $kuanhao ?>">
												<label for="L_pass" class="layui-form-label" style="width: 10%;padding: 0px 15px;">
													<button type="button" class="layui-btn" id="upload1">导入文档</button>
												</label>
												<div class="layui-input-inline" style="width: 400px;">
														<input type="hidden" name="excelwendang" id="excelwendang" lay-verify="excelwendang" autocomplete="off"
															   class="layui-input">
														<input type="text" name="excelwendang1" id="excelwendang1" readonly lay-verify="excelwendang1" autocomplete="off"
															   class="layui-input">
												</div>
											</div>
											<div class="layui-form-item" style="margin-left: 100px;font-size: 13px;font-weight: bold;color: red;">
												温馨提示:导入时间会根据文件大小有区别，请耐心等候！当出现"处理完成"字样，就表示已经导入成功了。
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
<script>
	layui.use('upload', function(){
		var $ = layui.jquery
				,upload = layui.upload;
		upload.render({ //允许上传的文件后缀
			elem: '#upload1'
			,url: '<?= RUN . '/upload/pushFIle' ?>'
			,accept: 'file' //普通文件
			,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
				layer.load(); //上传loading
			}
			,done: function(res){
				layer.closeAll('loading'); //关闭loading
				console.log(res)
				if(res.code == 200){
					console.log(res.src)
					$('#excelwendang').val(res.src);
					$('#excelwendang1').val(res.src);
					return layer.msg('上传成功');
				}else {
					return layer.msg('上传失败');
				}
			}
		});
	});
</script>
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
					kuanhao: function (value) {
						// if ($("#zuname option:selected").val() == "") {
						// 	return '请选择选择组别信息。';
						// }
						if ($('#kuanhao').val() == "") {
							return '请录入款号信息。';
						}
					},
					excelwendang: function (value) {
						if ($('#excelwendang').val() == "") {
							return '请上传原辅料文档。';
						}
					},
				});

				$("#tab").validate({
					submitHandler: function (form) {
						$.ajax({
							cache: true,
							type: "POST",
							url: "<?= RUN . '/goods/goods_save_yuanfuliao_excel' ?>",
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
