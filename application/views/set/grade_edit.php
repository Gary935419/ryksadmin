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
                    <span class="x-red">*</span>等级名称
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="text" id="gname" name="gname" lay-verify="gname"
                           autocomplete="off" value="<?php echo $gname ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>增幅比例
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="text" id="commission_rate" name="commission_rate" lay-verify="commission_rate"
                           autocomplete="off" value="<?php echo $commission_rate ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>推荐次数
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="text" id="recommend" name="recommend" lay-verify="recommend"
                           autocomplete="off" value="<?php echo $recommend ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>完成次数
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="text" id="completion" name="completion" lay-verify="completion"
                           autocomplete="off" value="<?php echo $completion ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>等级介绍
                </label>
                <div class="layui-input-inline" style="width: 500px;">
                    <textarea id="gcontent" name="gcontent" placeholder="请输入内容" lay-verify="gcontent" class="layui-textarea"><?php echo $gcontent ?></textarea>
                </div>
            </div>
            <input type="hidden" name="gid" id="gid" value="<?php echo $gid ?>">
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
            var editIndex1 = layedit.build('gcontent', {
                height: 300,
            });
            //自定义验证规则
            form.verify({
                gname: function (value) {
                    if ($('#gname').val() == "") {
                        return '请输入等级名称。';
                    }
                },
                commission_rate: function (value) {
                    if ($('#commission_rate').val() == "") {
                        return '请输入增幅比例。';
                    }
                },
                recommend: function (value) {
                    if ($('#recommend').val() == "") {
                        return '请输入推荐次数。';
                    }
                },
                completion: function (value) {
                    if ($('#completion').val() == "") {
                        return '请输入完成次数。';
                    }
                },
                gcontent: function(value) {
                    // 将富文本编辑器的值同步到之前的textarea中
                    layedit.sync(editIndex1);
                    if ($('#gcontent').val() == "") {
                        return '请输入等级介绍。';
                    }
                },
            });

            $("#tab").validate({

                submitHandler: function (form) {
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url: "<?= RUN . '/set/grade_save_edit' ?>",
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
