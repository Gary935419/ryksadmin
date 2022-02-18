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
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>5公里以内（专车送 起步价）
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="number" id="price1" name="price1" lay-verify="price1"
                           autocomplete="off" value="<?php echo $price1 ?>" class="layui-input">
                </div>
            </div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>5-30公里（专车送 里程费）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price2" name="price2" lay-verify="price2"
						   autocomplete="off" value="<?php echo $price2 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>30公里后（专车送 里程费）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price3" name="price3" lay-verify="price3"
						   autocomplete="off" value="<?php echo $price3 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>5公里以内（顺路送 起步价）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price4" name="price4" lay-verify="price4"
						   autocomplete="off" value="<?php echo $price4 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>5-30公里（顺路送 里程费）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price5" name="price5" lay-verify="price5"
						   autocomplete="off" value="<?php echo $price5 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>30-50公里（顺路送 里程费）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price6" name="price6" lay-verify="price6"
						   autocomplete="off" value="<?php echo $price6 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>50-100公里（顺路送 里程费）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price7" name="price7" lay-verify="price7"
						   autocomplete="off" value="<?php echo $price7 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>100-200公里（顺路送 里程费）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price8" name="price8" lay-verify="price8"
						   autocomplete="off" value="<?php echo $price8 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>200公里后（顺路送 里程费）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price9" name="price9" lay-verify="price9"
						   autocomplete="off" value="<?php echo $price9 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>3公里以内（代买 指定地址 起步价）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price10" name="price10" lay-verify="price10"
						   autocomplete="off" value="<?php echo $price10 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>3公里之后（代买 指定地址 里程费）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price11" name="price11" lay-verify="price11"
						   autocomplete="off" value="<?php echo $price11 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>3公里以内（代买 附近代买 起步价）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price12" name="price12" lay-verify="price12"
						   autocomplete="off" value="<?php echo $price12 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>8公里以内（代驾 白天 起步价）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price13" name="price13" lay-verify="price13"
						   autocomplete="off" value="<?php echo $price13 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>8公里之后（代驾 白天 里程费）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price14" name="price14" lay-verify="price14"
						   autocomplete="off" value="<?php echo $price14 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>8公里以内（代驾 夜间 起步价）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price15" name="price15" lay-verify="price15"
						   autocomplete="off" value="<?php echo $price15 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>8公里之后（代驾 夜间 里程费）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price16" name="price16" lay-verify="price16"
						   autocomplete="off" value="<?php echo $price16 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>保价百分比数额（单位：%）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price17" name="price17" lay-verify="price17"
						   autocomplete="off" value="<?php echo $price17 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>抽成百分比数额（单位：%）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price18" name="price18" lay-verify="price18"
						   autocomplete="off" value="<?php echo $price18 ?>" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>顺路送和代买每天总最大接单量（单位：次）
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="price19" name="price19" lay-verify="price19"
						   autocomplete="off" value="<?php echo $price19 ?>" class="layui-input">
				</div>
			</div>

			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>公告
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<textarea placeholder="暂无提交公告" id="content1" name="content1" class="layui-textarea"
							  lay-verify="content1"><?php echo $content1 ?></textarea>
				</div>
			</div>

            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 30%;">
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <span class="x-red">※</span>请确认输入的数据是否正确。
                </div>
            </div>
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
    layui.use(['form','layedit', 'layer'],
        function () {
            var form = layui.form,
                layer = layui.layer;
            var layedit = layui.layedit;

            //自定义验证规则
            form.verify({
				price1: function (value) {
                    if ($('#price1').val() == "") {
                        return '请输入5公里以内（专车送 起步价）。';
                    }
                },
				price2: function (value) {
					if ($('#price2').val() == "") {
						return '请输入5-30公里（专车送 里程费）。';
					}
				},
				price3: function (value) {
					if ($('#price3').val() == "") {
						return '请输入30公里后（专车送 里程费）。';
					}
				},
				price4: function (value) {
					if ($('#price4').val() == "") {
						return '请输入5公里以内（顺路送 起步价）。';
					}
				},
				price5: function (value) {
					if ($('#price5').val() == "") {
						return '请输入5-30公里（顺路送 里程费）。';
					}
				},
				price6: function (value) {
					if ($('#price6').val() == "") {
						return '请输入30-50公里（顺路送 里程费）。';
					}
				},
				price7: function (value) {
					if ($('#price7').val() == "") {
						return '请输入50-100公里（顺路送 里程费）。';
					}
				},
				price8: function (value) {
					if ($('#price8').val() == "") {
						return '请输入100-200公里（顺路送 里程费）。';
					}
				},
				price9: function (value) {
					if ($('#price9').val() == "") {
						return '请输入200公里后（顺路送 里程费）。';
					}
				},
				price10: function (value) {
					if ($('#price10').val() == "") {
						return '请输入3公里以内（代买 指定地址 起步价）。';
					}
				},
				price11: function (value) {
					if ($('#price11').val() == "") {
						return '请输入3公里之后（代买 指定地址 里程费）。';
					}
				},
				price12: function (value) {
					if ($('#price12').val() == "") {
						return '请输入3公里以内（代买 附近代买 起步价）。';
					}
				},
				price13: function (value) {
					if ($('#price13').val() == "") {
						return '请输入8公里以内（代驾 白天 起步价）。';
					}
				},
				price14: function (value) {
					if ($('#price14').val() == "") {
						return '请输入8公里之后（代驾 白天 里程费）。';
					}
				},
				price15: function (value) {
					if ($('#price15').val() == "") {
						return '请输入8公里以内（代驾 夜间 起步价）。';
					}
				},
				price16: function (value) {
					if ($('#price16').val() == "") {
						return '请输入8公里之后（代驾 夜间 里程费）。';
					}
				},
				price17: function (value) {
					if ($('#price17').val() == "") {
						return '请输入保价百分比数额（单位：%）。';
					}
				},
				price18: function (value) {
					if ($('#price18').val() == "") {
						return '请输入抽成百分比数额（单位：%）。';
					}
				},
				price19: function (value) {
					if ($('#price19').val() == "") {
						return '请输入每天最大接单量（单位：个）。';
					}
				},
            });

            $("#tab").validate({
                submitHandler: function (form) {
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url: "<?= RUN . '/set/set_save_edit' ?>",
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
