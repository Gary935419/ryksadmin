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
                <label for="L_pass" class="layui-form-label" style="width: 20%;">
                    <span class="x-red">*</span>合同编号
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <input type="text" id="bianhao" name="bianhao" lay-verify="bianhao"
                           autocomplete="off" class="layui-input">
                </div>
				<label for="L_pass" class="layui-form-label" style="width: 10%;">
					<span class="x-red">*</span>甲方名称
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="mingcheng" name="mingcheng" lay-verify="mingcheng"
						   autocomplete="off" class="layui-input">
				</div>
            </div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>签订时间
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input id="qianding" name="qianding" lay-verify="qianding"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 10%;">
					<span class="x-red">*</span>交货时间
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input id="jiaohuoqi" name="jiaohuoqi" lay-verify="jiaohuoqi"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>项目负责人
				</label>
				<div class="layui-input-inline" style="width: 66%;">
					<?php if (isset($tidlist) && !empty($tidlist)) { ?>
						<?php foreach ($tidlist as $k => $v) : ?>
							<input type="checkbox" name="menu[]" value="<?= $v['id'] ?>" lay-skin="primary" lay-filter="father"
								   lay-verify="check" title="<?= $v['username'] ?>">
						<?php endforeach; ?>
					<?php } ?>
				</div>
			</div>

			<div class="layui-form-item" id="div1">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>合同款号
				</label>
				<i class="layui-icon" id="divadd1" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return addnow(2,1)"></i>
				<div class="layui-input-inline" style="width: 300px;">
					<input name="kuanhao[]" lay-verify="kuanhao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div2" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>合同款号
				</label>
				<i class="layui-icon" id="divadd2" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return addnow(3,2)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return dellete(2,1)">&#xe6fe;</i>
				<div class="layui-input-inline" style="width: 300px;">
					<input name="kuanhao[]" id="val2" lay-verify="kuanhao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div3" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>合同款号
				</label>
				<i class="layui-icon" id="divadd3" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return addnow(4,3)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return dellete(3,2)">&#xe6fe;</i>
				<div class="layui-input-inline" style="width: 300px;">
					<input name="kuanhao[]" id="val3" lay-verify="kuanhao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div4" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>合同款号
				</label>
				<i class="layui-icon" id="divadd4" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return addnow(5,4)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return dellete(4,3)">&#xe6fe;</i>
				<div class="layui-input-inline" style="width: 300px;">
					<input name="kuanhao[]" id="val4" lay-verify="kuanhao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div5" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>合同款号
				</label>
				<i class="layui-icon" id="divadd5" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return addnow(6,5)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return dellete(5,4)">&#xe6fe;</i>
				<div class="layui-input-inline" style="width: 300px;">
					<input name="kuanhao[]" id="val5" lay-verify="kuanhao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div6" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>合同款号
				</label>
				<i class="layui-icon" id="divadd6" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return addnow(7,6)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return dellete(6,5)">&#xe6fe;</i>
				<div class="layui-input-inline" id="val6" style="width: 300px;">
					<input name="kuanhao[]" id="val6" lay-verify="kuanhao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div7" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>合同款号
				</label>
				<i class="layui-icon" id="divadd7" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return addnow(8,7)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return dellete(7,6)">&#xe6fe;</i>
				<div class="layui-input-inline" style="width: 300px;">
					<input name="kuanhao[]" id="val7" lay-verify="kuanhao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div8" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>合同款号
				</label>
				<i class="layui-icon" id="divadd8" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return addnow(9,8)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return dellete(8,7)">&#xe6fe;</i>
				<div class="layui-input-inline" style="width: 300px;">
					<input name="kuanhao[]" id="val8" lay-verify="kuanhao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div9" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>合同款号
				</label>
				<i class="layui-icon" id="divadd9" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return addnow(10,9)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return dellete(9,8)">&#xe6fe;</i>
				<div class="layui-input-inline" style="width: 300px;">
					<input name="kuanhao[]" id="val9" lay-verify="kuanhao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div10" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 20%;">
					<span class="x-red">*</span>合同款号
				</label>
				<i class="layui-icon" id="divadd10" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return addnow(11,10)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;" onclick="return dellete(10,9)">&#xe6fe;</i>
				<div class="layui-input-inline" style="width: 300px;">
					<input name="kuanhao[]" id="val10" lay-verify="kuanhao"
						   autocomplete="off" class="layui-input">
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
	function addnow(id,idd){
		$("#div"+id).show();
		$("#divadd"+idd).hide();
	}
	function dellete(id,idd){
		$("#div"+id).hide();
		$("#val"+id).val("");
		$("#divadd"+idd).show();
	}
</script>
<script>layui.use(['laydate', 'form'],
			function() {
				var laydate = layui.laydate;
				//执行一个laydate实例
				laydate.render({
					elem: '#qianding' //指定元素
				});
				laydate.render({
					elem: '#jiaohuoqi' //指定元素
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
            // var editIndex1 = layedit.build('gcontent', {
            //     height: 300,
            // });
            //自定义验证规则
            form.verify({
				bianhao: function (value) {
                    if ($('#bianhao').val() == "") {
                        return '请输入合同编号。';
                    }
                },
				mingcheng: function (value) {
                    if ($('#mingcheng').val() == "") {
                        return '请输入甲方名称。';
                    }
                },
                // tid: function (value) {
                //     if ($("#tid option:selected").val() == "") {
                //         return '请选择商家类型。';
                //     }
                // },
				qianding: function (value) {
                    if ($('#qianding').val() == "") {
                        return '请输入签订时间。';
                    }
                },
				jiaohuoqi: function (value) {
					if ($('#jiaohuoqi').val() == "") {
						return '请输入交货时间。';
					}
				},
				check: function () {
					var checked = $("input[type='checkbox']:checked").length;
					if (checked < 1) {
						return '请勾选负责人。';
					}
				}
                // gcontent: function(value) {
                //     // 将富文本编辑器的值同步到之前的textarea中
                //     layedit.sync(editIndex1);
                //     if ($('#gcontent').val() == "") {
                //         return '请输入商家简介。';
                //     }
                // },
            });

            $("#tab").validate({
                submitHandler: function (form) {
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url: "<?= RUN . '/goods/goods_save' ?>",
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
