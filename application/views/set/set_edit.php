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
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>联系人
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="text" id="name" name="name" lay-verify="name"
                           autocomplete="off" value="<?php echo $name ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>联系邮箱
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="email" id="email" name="email" lay-verify="email"
                           autocomplete="off" value="<?php echo $email ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>联系地址
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="text" id="address" name="address" lay-verify="address"
                           autocomplete="off" value="<?php echo $address ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>详细说明
                </label>
                <div class="layui-input-inline" style="width: 610px;">
                    <textarea id="contentnew" name="contentnew" placeholder="请输入内容" lay-verify="contentnew" class="layui-textarea"><?php echo $contentnew ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>主营业务
                </label>
                <div class="layui-input-inline" style="width: 610px;">
                    <textarea id="contentagent" name="contentagent" placeholder="请输入内容" lay-verify="contentagent" class="layui-textarea"><?php echo $contentagent ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>客服二维码
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <button type="button" class="layui-btn" id="upload1">上传二维码</button>
                    <div class="layui-upload-list">
                        <input type="hidden" name="customercode" id="customercode" lay-verify="customercode" autocomplete="off"
                               class="layui-input" value="<?php echo $customercode ?>">
                        <img class="layui-upload-img" src="<?php echo $customercode ?>" style="width: 100px;height: 100px;" id="customercodeimg" name="customercodeimg">
                        <p id="demoText"></p>
                    </div>
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
    layui.use('upload', function(){
        var $ = layui.jquery
            ,upload = layui.upload;

        //普通图片上传
        var uploadInst = upload.render({
            elem: '#upload1'
            ,url: '<?= RUN . '/upload/pushFIle' ?>'
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#customercodeimg').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                if(res.code == 200){
                    $('#customercode').val(res.src); //图片链接（base64）
                    return layer.msg('上传成功');
                }else {
                    return layer.msg('上传失败');
                }

            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });
    });
</script>
<script>
    layui.use(['form','layedit', 'layer'],
        function () {
            var form = layui.form,
                layer = layui.layer;
            var layedit = layui.layedit;
            layedit.set({
                uploadImage: {
                    url: '<?= RUN . '/upload/pushFIletextarea' ?>',
                    type: 'post',
                }
            });
            var editIndex1 = layedit.build('contentnew', {
                height: 300,
            });
            var editIndex2 = layedit.build('contentagent', {
                height: 300,
            });
            //自定义验证规则
            form.verify({
                name: function (value) {
                    if ($('#name').val() == "") {
                        return '请输入联系人。';
                    }
                },
                email: function (value) {
                    if ($('#email').val() == "") {
                        return '请输入联系邮箱。';
                    }
                },
                address: function (value) {
                    if ($('#address').val() == "") {
                        return '请输入联系地址。';
                    }
                },
                contentnew: function(value) {
                    // 将富文本编辑器的值同步到之前的textarea中
                    layedit.sync(editIndex1);
                    if ($('#contentnew').val() == "") {
                        return '请输入详细说明。';
                    }
                },
                contentagent: function(value) {
                    // 将富文本编辑器的值同步到之前的textarea中
                    layedit.sync(editIndex2);
                    if ($('#contentagent').val() == "") {
                        return '请输入主营业务。';
                    }
                },
                customercode: function (value) {
                    if ($('#customercode').val() == "") {
                        return '请上传客服二维码。';
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
