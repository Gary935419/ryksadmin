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
                    <span class="x-red">*</span>账号
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="text" id="user_name" name="user_name" lay-verify="user_name"
                           autocomplete="off" value="<?php echo $user_namenew ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>密码
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="password" id="user_pass" name="user_pass" lay-verify="user_pass"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>权限
                </label>
                <div class="layui-input-inline layui-show-xs-block">
                    <div style="width: 300px" class="layui-input-inline layui-show-xs-block">
                        <select name="rid" id="rid" lay-verify="rid">
                            <?php if (isset($ridlist) && !empty($ridlist)) { ?>
                                <option value="">请选择</option>
                                <?php foreach ($ridlist as $k => $v) : ?>
                                    <option value="<?= $v['rid'] ?>" <?php echo $ridnew == $v['rid'] ? 'selected' : '' ?>><?= $v['rname'] ?></option>
                                <?php endforeach; ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>状態
                </label>
                <div class="layui-input-inline" style="width: 500px;">
                    <input type="radio" name="user_state" lay-skin="primary" title="正常"
                           value="1" <?php echo $user_statenew == 1 ? 'checked' : '' ?>>
                    <input type="radio" name="user_state" lay-skin="primary" title="禁止"
                           value="2" <?php echo $user_statenew == 2 ? 'checked' : '' ?>>
                </div>
            </div>
            <input type="hidden" name="uid" id="uid" value="<?php echo $uidnew ?>">
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
            //自定义验证规则
            form.verify({
                user_name: function (value) {
                    if ($('#user_name').val() == "") {
                        return '请输入账号。';
                    }
                },
				user_pass: function (value) {
					if ($('#user_pass').val() == "") {
						return '请输入账号密码。';
					}
				},
                rid: function (value) {
                    if ($("#rid option:selected").val() == "") {
                        return '请选择权限。';
                    }
                },
            });

            $("#tab").validate({

                submitHandler: function (form) {
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url: "<?= RUN . '/users/users_save_edit' ?>",
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
