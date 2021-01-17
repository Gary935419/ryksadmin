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
                    <span class="x-red">*</span>任务标题
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="text" id="tatitle" name="tatitle" lay-verify="tatitle"
                           autocomplete="off" value="<?php echo $tatitle ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>任务类型
                </label>
                <div class="layui-input-inline layui-show-xs-block">
                    <div style="width: 300px" class="layui-input-inline layui-show-xs-block">
                        <select name="tid" id="tid" lay-verify="tid">
                            <?php if (isset($tidlist) && !empty($tidlist)) { ?>
                                <option value="">请选择</option>
                                <?php foreach ($tidlist as $k => $v) : ?>
                                    <option value="<?= $v['tid'] ?>" <?php echo $tid == $v['tid'] ? 'selected' : '' ?>><?= $v['tname'] ?></option>
                                <?php endforeach; ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>任务名额
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="number" id="tanums" name="tanums" lay-verify="tanums"
                           autocomplete="off" value="<?php echo $tanums ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>任务佣金
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="number" id="tacommission" name="tacommission" lay-verify="tacommission"
                           autocomplete="off" value="<?php echo $tacommission ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>任务列表图
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <button type="button" class="layui-btn" id="upload1">上传图片</button>
                    <div class="layui-upload-list">
                        <input type="hidden" name="taimg" value="<?php echo $taimg ?>" id="taimg" lay-verify="taimg" autocomplete="off"
                               class="layui-input">
                        <img class="layui-upload-img" style="width: 100px;height: 100px;" src="<?php echo $taimg ?>" id="taimgimg" name="taimgimg">
                        <p id="demoText"></p>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>是否推荐
                </label>
                <div class="layui-input-inline" style="width: 500px;">
                    <input type="radio" name="if_recommend" <?php echo $if_recommend == 1 ? 'checked' : '' ?> lay-skin="if_recommend" title="推荐"
                           value="1">
                    <input type="radio" name="if_recommend" <?php echo $if_recommend == 2 ? 'checked' : '' ?> lay-skin="primary" title="不推荐"
                           value="2">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>链接地址
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="text" id="taurl" name="taurl" lay-verify="taurl"
                           autocomplete="off" value="<?php echo $taurl ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>每人限领次数
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="number" id="constraintdays" name="constraintdays" lay-verify="constraintdays"
                           autocomplete="off" value="<?php echo $constraintdays ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>期限天数
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="number" id="tadays" name="tadays" lay-verify="tadays"
                           autocomplete="off" value="<?php echo $tadays ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>审核天数
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="number" id="examinedays" name="examinedays" lay-verify="examinedays"
                           autocomplete="off" value="<?php echo $examinedays ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>任务押金
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="number" id="tadeposit" name="tadeposit" lay-verify="tadeposit"
                           autocomplete="off" value="<?php echo $tadeposit ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>任务积分
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="number" id="taintegral" name="taintegral" lay-verify="taintegral"
                           autocomplete="off" value="<?php echo $taintegral ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    任务标签
                </label>
                <div class="layui-input-block">
                    <?php if (isset($laidslist) && !empty($laidslist)) { ?>
                        <?php foreach ($laidslist as $k => $v) : ?>
                        <?php if (in_array($v['lid'],$laids)){ ?>
                            <input type="checkbox" checked name="laids[]" lay-verify="laids[]" lay-skin="primary" value="<?= $v['lid'] ?>" title="<?= $v['lname'] ?>">
                        <?php }else{ ?>
                            <input type="checkbox" name="laids[]" lay-verify="laids[]" lay-skin="primary" value="<?= $v['lid'] ?>" title="<?= $v['lname'] ?>">
                        <?php } ?>
                        <?php endforeach; ?>
                    <?php } ?>

                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>任务要求
                </label>
                <div class="layui-input-inline" style="width: 610px;">
                    <textarea id="requirement" name="requirement" placeholder="请输入内容" lay-verify="requirement" class="layui-textarea"><?php echo $requirement ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>任务提示
                </label>
                <div class="layui-input-inline" style="width: 610px;">
                    <textarea id="tatips" name="tatips" placeholder="请输入内容" lay-verify="tatips" class="layui-textarea"><?php echo $tatips ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>任务步骤
                </label>
                <div class="layui-input-inline" style="width: 610px;">
                    <textarea id="tacontents" name="tacontents" placeholder="请输入内容" lay-verify="tacontents" class="layui-textarea"><?php echo $tacontents ?></textarea>
                </div>
            </div>
            <input type="hidden" name="taid" id="taid" value="<?php echo $taid?>">
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
                    $('#taimgimg').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                if(res.code == 200){
                    $('#taimg').val(res.src); //图片链接（base64）
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
            var editIndex1 = layedit.build('requirement', {
                height: 300,
            });
            var editIndex2 = layedit.build('tatips', {
                height: 300,
            });
            var editIndex3 = layedit.build('tacontents', {
                height: 300,
            });
            //自定义验证规则
            form.verify({
                tatitle: function (value) {
                    if ($('#tatitle').val() == "") {
                        return '请输入任务标题。';
                    }
                },
                tid: function (value) {
                    if ($("#tid option:selected").val() == "") {
                        return '请选择任务类型。';
                    }
                },
                tanums: function (value) {
                    if ($('#tanums').val() == "") {
                        return '请输入任务名额。';
                    }
                },
                tacommission: function (value) {
                    if ($('#tacommission').val() == "") {
                        return '请输入任务佣金。';
                    }
                },
                taimg: function (value) {
                    if ($('#taimg').val() == "") {
                        return '请上传任务列表图。';
                    }
                },
                taurl: function (value) {
                    if ($('#taurl').val() == "") {
                        return '请输入链接地址。';
                    }
                },
                constraintdays: function (value) {
                    if ($('#constraintdays').val() == "") {
                        return '请输入每人限领次数。';
                    }
                },
                tadays: function (value) {
                    if ($('#tadays').val() == "") {
                        return '请输入期限天数。';
                    }
                },
                examinedays: function (value) {
                    if ($('#examinedays').val() == "") {
                        return '请输入审核天数。';
                    }
                },
                tadeposit: function (value) {
                    if ($('#tadeposit').val() == "") {
                        return '请输入任务押金。';
                    }
                },
                taintegral: function (value) {
                    if ($('#taintegral').val() == "") {
                        return '请输入任务积分。';
                    }
                },
                requirement: function(value) {
                    // 将富文本编辑器的值同步到之前的textarea中
                    layedit.sync(editIndex1);
                    if ($('#requirement').val() == "") {
                        return '请输入任务要求。';
                    }
                },
                tatips: function(value) {
                    // 将富文本编辑器的值同步到之前的textarea中
                    layedit.sync(editIndex2);
                    if ($('#tatips').val() == "") {
                        return '请输入任务提示。';
                    }
                },
                tacontents: function(value) {
                    // 将富文本编辑器的值同步到之前的textarea中
                    layedit.sync(editIndex3);
                    if ($('#tacontents').val() == "") {
                        return '请输入任务步骤。';
                    }
                }
            });

            $("#tab").validate({
                submitHandler: function (form) {
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url: "<?= RUN . '/task/task_save_edit' ?>",
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
