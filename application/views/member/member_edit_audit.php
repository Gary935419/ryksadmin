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
					<span class="x-red">*</span>姓名
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="name" name="name" lay-verify="name"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>性别
				</label>
				<div class="layui-input-inline" style="width: 500px;">
					<input type="radio" name="sex" lay-skin="primary" title="男" value="1" checked>
					<input type="radio" name="sex" lay-skin="primary" title="女" value="2">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>身份证号
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="cards" name="cards" lay-verify="cards"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>领证日期
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="times" name="times" lay-verify="times"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<?php if ($utype != 2){ ?>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>车辆品牌
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="brand" name="brand" lay-verify="brand"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>车牌号
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="car_number" name="car_number" lay-verify="car_number"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>车辆颜色
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="attribute" name="attribute" lay-verify="attribute"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>车辆型号
				</label>
				<div class="layui-input-inline layui-show-xs-block">
					<div style="width: 300px" class="layui-input-inline layui-show-xs-block">
						<select name="car_type_id" id="car_type_id" lay-verify="car_type_id">
							<?php if (isset($tidlist) && !empty($tidlist)) { ?>
								<option value="">请选择</option>
								<?php foreach ($tidlist as $k => $v) : ?>
									<option value="<?= $v['id'] ?>"><?= $v['name'] ?></option>
								<?php endforeach; ?>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<?php } ?>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>身份证正面
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<button type="button" class="layui-btn" id="upload1">
						上传图片
					</button>
					<div class="layui-upload-list">
						<input type="hidden" name="img_cards_face" id="img_cards_face" lay-verify="img_cards_face" autocomplete="off"
							   class="layui-input">
						<img class="layui-upload-img" style="width: 100px;height: 100px;display: none;" id="img_cards_faceimg" name="img_cards_faceimg">
						<p id="demoText"></p>
					</div>
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>身份证背面
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<button type="button" class="layui-btn" id="upload2">
						上传图片
					</button>
					<div class="layui-upload-list">
						<input type="hidden" name="img_cards_side" id="img_cards_side" lay-verify="img_cards_side" autocomplete="off"
							   class="layui-input">
						<img class="layui-upload-img" style="width: 100px;height: 100px;display: none;" id="img_cards_sideimg" name="img_cards_sideimg">
						<p id="demoText"></p>
					</div>
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>驾驶证
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<button type="button" class="layui-btn" id="upload3">
						上传图片
					</button>
					<div class="layui-upload-list">
						<input type="hidden" name="img_drivers" id="img_drivers" lay-verify="img_drivers" autocomplete="off"
							   class="layui-input">
						<img class="layui-upload-img" style="width: 100px;height: 100px;display: none;" id="img_driversimg" name="img_driversimg">
						<p id="demoText"></p>
					</div>
				</div>
			</div>
			<?php if ($utype != 2){ ?>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>行驶证
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<button type="button" class="layui-btn" id="upload4">
						上传图片
					</button>
					<div class="layui-upload-list">
						<input type="hidden" name="img_vehicle" id="img_vehicle" lay-verify="img_vehicle" autocomplete="off"
							   class="layui-input">
						<img class="layui-upload-img" style="width: 100px;height: 100px;display: none;" id="img_vehicleimg" name="img_vehicleimg">
						<p id="demoText"></p>
					</div>
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>人车合影
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<button type="button" class="layui-btn" id="upload5">
						上传图片
					</button>
					<div class="layui-upload-list">
						<input type="hidden" name="img_car_user" id="img_car_user" lay-verify="img_car_user" autocomplete="off"
							   class="layui-input">
						<img class="layui-upload-img" style="width: 100px;height: 100px;display: none;" id="img_car_userimg" name="img_car_userimg">
						<p id="demoText"></p>
					</div>
				</div>
			</div>
			<?php } ?>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>工作照
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<button type="button" class="layui-btn" id="upload6">
						上传图片
					</button>
					<div class="layui-upload-list">
						<input type="hidden" name="img_worker" id="img_worker" lay-verify="img_worker" autocomplete="off"
							   class="layui-input">
						<img class="layui-upload-img" style="width: 100px;height: 100px;display: none;" id="img_workerimg" name="img_workerimg">
						<p id="demoText"></p>
					</div>
				</div>
			</div>
            <input type="hidden" name="mid" id="mid" value="<?php echo $mid ?>">
			<input type="hidden" name="utype" id="utype" value="<?php echo $utype ?>">
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 30%;">
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <span class="x-red">※</span>请确认输入的数据是否正确。<br>
					<span class="x-red">※</span>请确认每一项是否全部录入。
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
	layui.use(['laydate', 'form'],
			function() {
				var laydate = layui.laydate;
				//执行一个laydate实例
				laydate.render({
					elem: '#times' //指定元素
				});
			});
</script>
<script>
	layui.use('upload', function(){
		var $ = layui.jquery
				,upload = layui.upload;

		upload.render({
			elem: '#upload1'
			,url: '<?= RUN . '/upload/pushFIle' ?>'
			,before: function(obj){
				//预读本地文件示例，不支持ie8
				obj.preview(function(index, file, result){
					$('#img_cards_faceimg').attr('src', result); //图片链接（base64）
					var img = document.getElementById("img_cards_faceimg");
					img.style.display="block";
				});
			}
			,done: function(res){
				if(res.code == 200){
					$('#img_cards_face').val(res.src); //图片链接（base64）
				}else {
				}
			}
		});
		upload.render({
			elem: '#upload2'
			,url: '<?= RUN . '/upload/pushFIle' ?>'
			,before: function(obj){
				//预读本地文件示例，不支持ie8
				obj.preview(function(index, file, result){
					$('#img_cards_sideimg').attr('src', result); //图片链接（base64）
					var img = document.getElementById("img_cards_sideimg");
					img.style.display="block";
				});
			}
			,done: function(res){
				if(res.code == 200){
					$('#img_cards_side').val(res.src); //图片链接（base64）
				}else {
				}
			}
		});
		upload.render({
			elem: '#upload3'
			,url: '<?= RUN . '/upload/pushFIle' ?>'
			,before: function(obj){
				//预读本地文件示例，不支持ie8
				obj.preview(function(index, file, result){
					$('#img_driversimg').attr('src', result); //图片链接（base64）
					var img = document.getElementById("img_driversimg");
					img.style.display="block";
				});
			}
			,done: function(res){
				if(res.code == 200){
					$('#img_drivers').val(res.src); //图片链接（base64）
				}else {
				}
			}
		});
		upload.render({
			elem: '#upload4'
			,url: '<?= RUN . '/upload/pushFIle' ?>'
			,before: function(obj){
				//预读本地文件示例，不支持ie8
				obj.preview(function(index, file, result){
					$('#img_vehicleimg').attr('src', result); //图片链接（base64）
					var img = document.getElementById("img_vehicleimg");
					img.style.display="block";
				});
			}
			,done: function(res){
				if(res.code == 200){
					$('#img_vehicle').val(res.src); //图片链接（base64）
				}else {
				}
			}
		});
		upload.render({
			elem: '#upload5'
			,url: '<?= RUN . '/upload/pushFIle' ?>'
			,before: function(obj){
				//预读本地文件示例，不支持ie8
				obj.preview(function(index, file, result){
					$('#img_car_userimg').attr('src', result); //图片链接（base64）
					var img = document.getElementById("img_car_userimg");
					img.style.display="block";
				});
			}
			,done: function(res){
				if(res.code == 200){
					$('#img_car_user').val(res.src); //图片链接（base64）
				}else {
				}
			}
		});
		upload.render({
			elem: '#upload6'
			,url: '<?= RUN . '/upload/pushFIle' ?>'
			,before: function(obj){
				//预读本地文件示例，不支持ie8
				obj.preview(function(index, file, result){
					$('#img_workerimg').attr('src', result); //图片链接（base64）
					var img = document.getElementById("img_workerimg");
					img.style.display="block";
				});
			}
			,done: function(res){
				if(res.code == 200){
					$('#img_worker').val(res.src); //图片链接（base64）
				}else {
				}
			}
		});
	});
</script>
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
                        url: "<?= RUN . '/member/member_save_edit_audit' ?>",
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
