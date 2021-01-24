<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>我的管理后台-如邮快送</title>
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
			<?php if($user_type == 1){ ?>
				<div class="layui-form-item">
					<label for="L_pass" class="layui-form-label" style="width: 30%;">
						<span class="x-red">*</span>司机信誉分
					</label>
					<div class="layui-input-inline" style="width: 300px;">
						<input type="number" max="100" min="0" id="credit_points" name="credit_points"
							   autocomplete="off" value="<?php echo $credit_points ?>" class="layui-input">
					</div>
				</div>
			<?php } ?>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
					<?php if($user_type == 1){ ?>
						<span class="x-red">*</span>司机状态
					<?php }else{ ?>
						<span class="x-red">*</span>用户状态
					<?php } ?>
                </label>
                <div class="layui-input-inline" style="width: 500px;">
                    <input type="radio" name="is_logoff" lay-skin="primary" title="锁定"
                           value="1" <?php echo $is_logoff == 1 ? 'checked' : '' ?>>
                    <input type="radio" name="is_logoff" lay-skin="primary" title="正常"
                           value="0" <?php echo $is_logoff == 0 ? 'checked' : '' ?>>
                </div>
            </div>
            <input type="hidden" name="mid" id="mid" value="<?php echo $mid ?>">
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
    layui.use(['form', 'layer'],
        function () {
            var form = layui.form,
                layer = layui.layer;

            $("#tab").validate({
                submitHandler: function (form) {
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url: "<?= RUN . '/member/member_save_edit' ?>",
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
