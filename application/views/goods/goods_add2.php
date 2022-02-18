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
			<div class="layui-form-item" id="div1">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品名
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinming[]" lay-verify="pinming"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品番
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinfan[]" lay-verify="pinfan"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>色号
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sehao[]" lay-verify="sehao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div11">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>规格
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="guige[]" lay-verify="guige"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>单位
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="danwei[]" lay-verify="danwei"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>提单数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="tidanshu[]" lay-verify="tidanshu"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div111">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>请点数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="qingdianshu[]" lay-verify="qingdianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>样指示
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="yangzhishi[]" lay-verify="yangzhishi"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>实际
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="shiji[]" lay-verify="shiji"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div1111">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>损耗
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhao[]" lay-verify="sunhao"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>件数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="jianshu[]" lay-verify="jianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>增减数量
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhaoyongliang[]" lay-verify="sunhaoyongliang"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div11111">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>到料日
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="daoliaori[]" lay-verify="daoliaori"
						   autocomplete="off" class="layui-input">
				</div>
				<i class="layui-icon" id="divadd1" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return addnow(2,1)"></i>
			</div>


			<div class="layui-form-item" id="div2" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品名
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinming[]" id="val2" lay-verify="pinming"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品番
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinfan[]" id="val22" lay-verify="pinfan"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>色号
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sehao[]" id="val222" lay-verify="sehao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div22" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>规格
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="guige[]" id="val2222" lay-verify="guige"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>单位
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="danwei[]" id="val22222" lay-verify="danwei"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>提单数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="tidanshu[]" id="val222222" lay-verify="tidanshu"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div222" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>请点数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="qingdianshu[]" id="val2222222" lay-verify="qingdianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>样指示
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="yangzhishi[]" id="val22222222" lay-verify="yangzhishi"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>实际
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="shiji[]" id="val222222222" lay-verify="shiji"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div2222" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>损耗
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhao[]" id="val2222222222" id="val2" lay-verify="sunhao"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>件数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="jianshu[]" id="val22222222222" lay-verify="jianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>增减数量
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhaoyongliang[]" id="val222222222222" lay-verify="sunhaoyongliang"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div22222" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>到料日
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="daoliaori[]" id="val2222222222222" lay-verify="daoliaori"
						   autocomplete="off" class="layui-input">
				</div>
				<i class="layui-icon" id="divadd2" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return addnow(3,2)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return dellete(2,1)">&#xe6fe;</i>
			</div>


			<div class="layui-form-item" id="div3" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品名
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinming[]" id="val3" lay-verify="pinming"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品番
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinfan[]" id="val33" lay-verify="pinfan"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>色号
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sehao[]" id="val333" lay-verify="sehao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div33" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>规格
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="guige[]" id="val3333" lay-verify="guige"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>单位
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="danwei[]" id="val33333" lay-verify="danwei"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>提单数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="tidanshu[]" id="val333333" lay-verify="tidanshu"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div333" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>请点数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="qingdianshu[]" id="val3333333" lay-verify="qingdianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>样指示
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="yangzhishi[]" id="val33333333" lay-verify="yangzhishi"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>实际
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="shiji[]" id="val333333333" lay-verify="shiji"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div3333" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>损耗
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhao[]" id="val3333333333" id="val2" lay-verify="sunhao"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>件数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="jianshu[]" id="val33333333333" lay-verify="jianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>增减数量
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhaoyongliang[]" id="val333333333333" lay-verify="sunhaoyongliang"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div33333" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>到料日
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="daoliaori[]" id="val3333333333333" lay-verify="daoliaori"
						   autocomplete="off" class="layui-input">
				</div>
				<i class="layui-icon" id="divadd3" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return addnow(4,3)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return dellete(3,2)">&#xe6fe;</i>
			</div>



			<div class="layui-form-item" id="div4" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品名
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinming[]" id="val4" lay-verify="pinming"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品番
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinfan[]" id="val44" lay-verify="pinfan"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>色号
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sehao[]" id="val444" lay-verify="sehao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div44" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>规格
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="guige[]" id="val4444" lay-verify="guige"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>单位
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="danwei[]" id="val44444" lay-verify="danwei"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>提单数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="tidanshu[]" id="val444444" lay-verify="tidanshu"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div444" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>请点数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="qingdianshu[]" id="val4444444" lay-verify="qingdianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>样指示
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="yangzhishi[]" id="val44444444" lay-verify="yangzhishi"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>实际
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="shiji[]" id="val444444444" lay-verify="shiji"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div4444" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>损耗
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhao[]" id="val4444444444" lay-verify="sunhao"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>件数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="jianshu[]" id="val44444444444" lay-verify="jianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>增减数量
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhaoyongliang[]" id="val444444444444" lay-verify="sunhaoyongliang"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div44444" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>到料日
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="daoliaori[]" id="val4444444444444" lay-verify="daoliaori"
						   autocomplete="off" class="layui-input">
				</div>
				<i class="layui-icon" id="divadd4" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return addnow(5,4)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return dellete(4,3)">&#xe6fe;</i>
			</div>



			<div class="layui-form-item" id="div5" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品名
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinming[]" id="val5" lay-verify="pinming"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品番
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinfan[]" id="val55" lay-verify="pinfan"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>色号
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sehao[]" id="val555" lay-verify="sehao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div55" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>规格
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="guige[]" id="val5555" lay-verify="guige"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>单位
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="danwei[]" id="val55555" lay-verify="danwei"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>提单数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="tidanshu[]" id="val555555" lay-verify="tidanshu"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div555" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>请点数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="qingdianshu[]" id="val5555555" lay-verify="qingdianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>样指示
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="yangzhishi[]" id="val55555555" lay-verify="yangzhishi"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>实际
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="shiji[]" id="val555555555" lay-verify="shiji"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div5555" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>损耗
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhao[]" id="val5555555555" lay-verify="sunhao"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>件数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="jianshu[]" id="val55555555555" lay-verify="jianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>增减数量
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhaoyongliang[]" id="val555555555555" lay-verify="sunhaoyongliang"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div55555" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>到料日
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="daoliaori[]" id="val5555555555555" lay-verify="daoliaori"
						   autocomplete="off" class="layui-input">
				</div>
				<i class="layui-icon" id="divadd5" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return addnow(6,5)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return dellete(5,4)">&#xe6fe;</i>
			</div>





			<div class="layui-form-item" id="div6" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品名
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinming[]" id="val6" lay-verify="pinming"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品番
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinfan[]" id="val66" lay-verify="pinfan"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>色号
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sehao[]" id="val666" lay-verify="sehao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div66" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>规格
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="guige[]" id="val6666" lay-verify="guige"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>单位
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="danwei[]" id="val66666" lay-verify="danwei"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>提单数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="tidanshu[]" id="val666666" lay-verify="tidanshu"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div666" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>请点数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="qingdianshu[]" id="val6666666" lay-verify="qingdianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>样指示
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="yangzhishi[]" id="val66666666" lay-verify="yangzhishi"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>实际
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="shiji[]" id="val666666666" lay-verify="shiji"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div6666" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>损耗
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhao[]" id="val6666666666" lay-verify="sunhao"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>件数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="jianshu[]" id="val66666666666" lay-verify="jianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>增减数量
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhaoyongliang[]" id="val666666666666" lay-verify="sunhaoyongliang"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div66666" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>到料日
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="daoliaori[]" id="val6666666666666" lay-verify="daoliaori"
						   autocomplete="off" class="layui-input">
				</div>
				<i class="layui-icon" id="divadd6" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return addnow(7,6)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return dellete(6,5)">&#xe6fe;</i>
			</div>




			<div class="layui-form-item" id="div7" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品名
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinming[]" id="val7" lay-verify="pinming"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品番
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinfan[]" id="val77" lay-verify="pinfan"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>色号
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sehao[]" id="val777" lay-verify="sehao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div77" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>规格
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="guige[]" id="val7777" lay-verify="guige"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>单位
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="danwei[]" id="val77777" lay-verify="danwei"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>提单数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="tidanshu[]" id="val777777" lay-verify="tidanshu"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div777" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>请点数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="qingdianshu[]" id="val7777777" lay-verify="qingdianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>样指示
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="yangzhishi[]" id="val77777777" lay-verify="yangzhishi"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>实际
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="shiji[]" id="val777777777" lay-verify="shiji"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div7777" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>损耗
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhao[]" id="val7777777777" lay-verify="sunhao"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>件数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="jianshu[]" id="val77777777777" lay-verify="jianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>增减数量
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhaoyongliang[]" id="val777777777777" lay-verify="sunhaoyongliang"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div77777" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>到料日
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="daoliaori[]" id="val7777777777777" lay-verify="daoliaori"
						   autocomplete="off" class="layui-input">
				</div>
				<i class="layui-icon" id="divadd7" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return addnow(8,7)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return dellete(7,6)">&#xe6fe;</i>
			</div>



			<div class="layui-form-item" id="div8" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品名
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinming[]" id="val8" lay-verify="pinming"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品番
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinfan[]" id="val88" lay-verify="pinfan"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>色号
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sehao[]" id="val888" lay-verify="sehao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div88" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>规格
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="guige[]" id="val8888" lay-verify="guige"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>单位
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="danwei[]" id="val88888" lay-verify="danwei"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>提单数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="tidanshu[]" id="val888888" lay-verify="tidanshu"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div888" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>请点数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="qingdianshu[]" id="val8888888" lay-verify="qingdianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>样指示
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="yangzhishi[]" id="val88888888" lay-verify="yangzhishi"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>实际
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="shiji[]" id="val888888888" lay-verify="shiji"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div8888" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>损耗
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhao[]" id="val8888888888" lay-verify="sunhao"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>件数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="jianshu[]" id="val88888888888" lay-verify="jianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>增减数量
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhaoyongliang[]" id="val888888888888" lay-verify="sunhaoyongliang"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div88888" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>到料日
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="daoliaori[]" id="val8888888888888" lay-verify="daoliaori"
						   autocomplete="off" class="layui-input">
				</div>
				<i class="layui-icon" id="divadd8" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return addnow(9,8)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return dellete(8,7)">&#xe6fe;</i>
			</div>



			<div class="layui-form-item" id="div9" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品名
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinming[]" id="val9" lay-verify="pinming"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品番
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinfan[]" id="val99" lay-verify="pinfan"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>色号
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sehao[]" id="val999" lay-verify="sehao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div99" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>规格
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="guige[]" id="val9999" lay-verify="guige"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>单位
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="danwei[]" id="val99999" lay-verify="danwei"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>提单数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="tidanshu[]" id="val999999" lay-verify="tidanshu"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div999" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>请点数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="qingdianshu[]" id="val9999999" lay-verify="qingdianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>样指示
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="yangzhishi[]" id="val99999999" lay-verify="yangzhishi"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>实际
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="shiji[]" id="val999999999" lay-verify="shiji"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div9999" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>损耗
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhao[]" id="val9999999999" lay-verify="sunhao"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>件数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="jianshu[]" id="val99999999999" lay-verify="jianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>增减数量
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhaoyongliang[]" id="val999999999999" lay-verify="sunhaoyongliang"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div99999" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>到料日
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="daoliaori[]" id="val9999999999999" lay-verify="daoliaori"
						   autocomplete="off" class="layui-input">
				</div>
				<i class="layui-icon" id="divadd9" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return addnow(10,9)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return dellete(9,8)">&#xe6fe;</i>
			</div>



			<div class="layui-form-item" id="div10" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品名
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinming[]" id="val10" lay-verify="pinming"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>品番
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="pinfan[]" id="val1010" lay-verify="pinfan"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>色号
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sehao[]" id="val101010" lay-verify="sehao"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div1010" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>规格
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="guige[]" id="val10101010" lay-verify="guige"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>单位
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="danwei[]" id="val1010101010" lay-verify="danwei"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>提单数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="tidanshu[]" id="val101010101010" lay-verify="tidanshu"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div101010" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>请点数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="qingdianshu[]" id="val10101010101010" lay-verify="qingdianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>样指示
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="yangzhishi[]" id="val1010101010101010" lay-verify="yangzhishi"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>实际
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="shiji[]" id="val101010101010101010" lay-verify="shiji"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div10101010" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>损耗
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhao[]" id="val10101010101010101010" lay-verify="sunhao"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>件数
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="jianshu[]" id="val1010101010101010101010" lay-verify="jianshu"
						   autocomplete="off" class="layui-input">
				</div>
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>增减数量
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="sunhaoyongliang[]" id="val101010101010101010101010" lay-verify="sunhaoyongliang"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item" id="div1010101010" style="display: none;">
				<label for="L_pass" class="layui-form-label" style="width: 8%;">
					<span class="x-red">*</span>到料日
				</label>
				<div class="layui-input-inline" style="width: 188px;">
					<input name="daoliaori[]" id="val10101010101010101010101010" lay-verify="daoliaori"
						   autocomplete="off" class="layui-input">
				</div>
				<i class="layui-icon" id="divadd10" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return addnow(11,10)"></i>
				<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
				   onclick="return dellete(10,9)">&#xe6fe;</i>
			</div>

			<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
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
	function addnow(id, idd) {
		$("#div" + id).show()
		$("#div" + id + id).show();
		$("#div" + id + id + id).show();
		$("#div" + id + id + id + id).show();
		$("#div" + id + id + id + id + id).show();
		$("#divadd" + idd).hide();
	}

	function dellete(id, idd) {
		$("#div" + id).hide();
		$("#div" + id + id).hide();
		$("#div" + id + id + id).hide();
		$("#div" + id + id + id + id).hide();
		$("#div" + id + id + id + id + id).hide();
		$("#val" + id).val("");
		$("#val" + id + id).val("");
		$("#val" + id + id + id).val("");
		$("#val" + id + id + id + id).val("");
		$("#val" + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id+ id + id).val("");
		$("#val" + id + id + id + id + id + id+ id + id + id).val("");
		$("#val" + id + id + id + id + id + id+ id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id+ id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id+ id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id+ id + id + id + id + id + id + id).val("");
		$("#divadd" + idd).show();
	}
</script>
<script>
	layui.use(['form', 'layedit', 'layer'],
			function () {
				var form = layui.form,
						layer = layui.layer;
				$("#tab").validate({
					submitHandler: function (form) {
						$.ajax({
							cache: true,
							type: "POST",
							url: "<?= RUN . '/goods/goods_save2' ?>",
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
