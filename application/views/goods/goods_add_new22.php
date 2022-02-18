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
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
					<form method="post" class="layui-form" style="margin-top: 15px" action="" name="basic_validate" id="tab">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>操作</th>
                            <th>品名</th>
                            <th>品番</th>
                            <th>色号</th>
                            <th>规格</th>
							<th>单位</th>
                            <th>提单数</th>
							<th>清点数</th>
							<th>样指示</th>
							<th>实际</th>
							<th>损耗</th>
							<th>件数</th>
							<th>增减数量</th>
							<th>到料日</th>
							<th>指示用量</th>
							<th>实际用量</th>
							<th>剩余</th>
						<tr>
                        </thead>
                        <tbody>

							<tr id="div1">
								<td>
									<i class="layui-icon" id="divadd1" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(2,1)"></i>
								</td>
								<td><input name="pinming[]" id="val1" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val11" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" id="val111" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val1111" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val11111" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" id="val111111" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" id="val1111111" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" id="val11111111" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" id="val111111111" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" id="val1111111111" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" id="val11111111111" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" id="val111111111111" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" id="val1111111111111" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishiyongliang[]" id="val11111111111111" readonly autocomplete="off" onclick="return jisuan1('val11111111111111','val11111111','val11111111111')"  placeholder="计算" class="layui-input"></td>
								<td><input name="shijiyongliang[]" id="val111111111111111" readonly autocomplete="off" onclick="return jisuan2('val111111111111111','val111111111','val11111111111')" placeholder="计算" class="layui-input"></td>
								<td><input name="shengyu[]" id="val1111111111111111" readonly autocomplete="off" onclick="return jisuan3('val1111111111111111','val111111','val11111111111111')" placeholder="计算" class="layui-input"></td>
							</tr>
							<tr id="div2" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd2" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(3,2)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(2,1)">&#xe6fe;</i>
								</td>
								<td><input name="pinming[]" id="val2" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val22" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" id="val222" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val2222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val22222" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" id="val222222" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" id="val2222222" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" id="val22222222" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" id="val222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" id="val2222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" id="val22222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" id="val222222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" id="val2222222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishiyongliang[]" id="val22222222222222" readonly autocomplete="off" onclick="return jisuan1('val22222222222222','val22222222','val22222222222')"  placeholder="计算" class="layui-input"></td>
								<td><input name="shijiyongliang[]" id="val222222222222222" readonly autocomplete="off" onclick="return jisuan2('val222222222222222','val222222222','val22222222222')" placeholder="计算" class="layui-input"></td>
								<td><input name="shengyu[]" id="val2222222222222222" readonly autocomplete="off" onclick="return jisuan3('val2222222222222222','val222222','val22222222222222')" placeholder="计算" class="layui-input"></td>
							</tr>
							<tr id="div3" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd3" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(4,3)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(3,2)">&#xe6fe;</i>
								</td>
								<td><input name="pinming[]" id="val3" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val33" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" id="val333" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val3333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val33333" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" id="val333333" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" id="val3333333" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" id="val33333333" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" id="val333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" id="val3333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" id="val33333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" id="val333333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" id="val3333333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishiyongliang[]" id="val33333333333333" readonly autocomplete="off" onclick="return jisuan1('val33333333333333','val33333333','val33333333333')"  placeholder="计算" class="layui-input"></td>
								<td><input name="shijiyongliang[]" id="val333333333333333" readonly autocomplete="off" onclick="return jisuan2('val333333333333333','val333333333','val33333333333')" placeholder="计算" class="layui-input"></td>
								<td><input name="shengyu[]" id="val3333333333333333" readonly autocomplete="off" onclick="return jisuan3('val3333333333333333','val333333','val33333333333333')" placeholder="计算" class="layui-input"></td>
							</tr>
							<tr id="div4" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd4" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(5,4)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(4,3)">&#xe6fe;</i>
								</td>
								<td><input name="pinming[]" id="val4" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val44" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" id="val444" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val4444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val44444" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" id="val444444" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" id="val4444444" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" id="val44444444" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" id="val444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" id="val4444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" id="val44444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" id="val444444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" id="val4444444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishiyongliang[]" id="val44444444444444" readonly autocomplete="off" onclick="return jisuan1('val44444444444444','val44444444','val44444444444')"  placeholder="计算" class="layui-input"></td>
								<td><input name="shijiyongliang[]" id="val444444444444444" readonly autocomplete="off" onclick="return jisuan2('val444444444444444','val444444444','val44444444444')" placeholder="计算" class="layui-input"></td>
								<td><input name="shengyu[]" id="val4444444444444444" readonly autocomplete="off" onclick="return jisuan3('val4444444444444444','val444444','val44444444444444')" placeholder="计算" class="layui-input"></td>
							</tr>
							<tr id="div5" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd5" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(6,5)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(5,4)">&#xe6fe;</i>
								</td>
								<td><input name="pinming[]" id="val5" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val55" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" id="val555" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val5555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val55555" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" id="val555555" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" id="val5555555" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" id="val55555555" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" id="val555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" id="val5555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" id="val55555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" id="val555555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" id="val5555555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishiyongliang[]" id="val55555555555555" readonly autocomplete="off" onclick="return jisuan1('val55555555555555','val55555555','val55555555555')"  placeholder="计算" class="layui-input"></td>
								<td><input name="shijiyongliang[]" id="val555555555555555" readonly autocomplete="off" onclick="return jisuan2('val555555555555555','val555555555','val55555555555')" placeholder="计算" class="layui-input"></td>
								<td><input name="shengyu[]" id="val5555555555555555" readonly autocomplete="off" onclick="return jisuan3('val5555555555555555','val555555','val55555555555555')" placeholder="计算" class="layui-input"></td>
							</tr>
							<tr id="div6" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd6" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(7,6)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(6,5)">&#xe6fe;</i>
								</td>
								<td><input name="pinming[]" id="val6" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val66" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" id="val666" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val6666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val66666" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" id="val666666" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" id="val6666666" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" id="val66666666" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" id="val666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" id="val6666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" id="val66666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" id="val666666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" id="val6666666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishiyongliang[]" id="val66666666666666" readonly autocomplete="off" onclick="return jisuan1('val66666666666666','val66666666','val66666666666')"  placeholder="计算" class="layui-input"></td>
								<td><input name="shijiyongliang[]" id="val666666666666666" readonly autocomplete="off" onclick="return jisuan2('val666666666666666','val666666666','val66666666666')" placeholder="计算" class="layui-input"></td>
								<td><input name="shengyu[]" id="val6666666666666666" readonly autocomplete="off" onclick="return jisuan3('val6666666666666666','val666666','val66666666666666')" placeholder="计算" class="layui-input"></td>
							</tr>
							<tr id="div7" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd7" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(8,7)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(7,6)">&#xe6fe;</i>
								</td>
								<td><input name="pinming[]" id="val7" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val77" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" id="val777" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val7777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val77777" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" id="val777777" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" id="val7777777" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" id="val77777777" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" id="val777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" id="val7777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" id="val77777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" id="val777777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" id="val7777777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishiyongliang[]" id="val77777777777777" readonly autocomplete="off" onclick="return jisuan1('val77777777777777','val77777777','val77777777777')"  placeholder="计算" class="layui-input"></td>
								<td><input name="shijiyongliang[]" id="val777777777777777" readonly autocomplete="off" onclick="return jisuan2('val777777777777777','val777777777','val77777777777')" placeholder="计算" class="layui-input"></td>
								<td><input name="shengyu[]" id="val7777777777777777" readonly autocomplete="off" onclick="return jisuan3('val7777777777777777','val777777','val77777777777777')" placeholder="计算" class="layui-input"></td>
							</tr>
							<tr id="div8" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd8" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(9,8)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(8,7)">&#xe6fe;</i>
								</td>
								<td><input name="pinming[]" id="val8" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val88" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" id="val888" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val8888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val88888" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" id="val888888" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" id="val8888888" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" id="val88888888" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" id="val888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" id="val8888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" id="val88888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" id="val888888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" id="val8888888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishiyongliang[]" id="val88888888888888" readonly autocomplete="off" onclick="return jisuan1('val88888888888888','val88888888','val88888888888')"  placeholder="计算" class="layui-input"></td>
								<td><input name="shijiyongliang[]" id="val888888888888888" readonly autocomplete="off" onclick="return jisuan2('val888888888888888','val888888888','val88888888888')" placeholder="计算" class="layui-input"></td>
								<td><input name="shengyu[]" id="val8888888888888888" readonly autocomplete="off" onclick="return jisuan3('val8888888888888888','val888888','val88888888888888')" placeholder="计算" class="layui-input"></td>
							</tr>
							<tr id="div9" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd9" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(10,9)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(9,8)">&#xe6fe;</i>
								</td>
								<td><input name="pinming[]" id="val9" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val99" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" id="val999" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val9999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val99999" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" id="val999999" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" id="val9999999" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" id="val99999999" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" id="val999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" id="val9999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" id="val99999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" id="val999999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" id="val9999999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishiyongliang[]" id="val99999999999999" readonly autocomplete="off" onclick="return jisuan1('val99999999999999','val99999999','val99999999999')"  placeholder="计算" class="layui-input"></td>
								<td><input name="shijiyongliang[]" id="val999999999999999" readonly autocomplete="off" onclick="return jisuan2('val999999999999999','val999999999','val99999999999')" placeholder="计算" class="layui-input"></td>
								<td><input name="shengyu[]" id="val9999999999999999" readonly autocomplete="off" onclick="return jisuan3('val9999999999999999','val999999','val99999999999999')" placeholder="计算" class="layui-input"></td>
							</tr>
							<tr id="div10" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd10" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(11,10)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(10,9)">&#xe6fe;</i>
								</td>
								<td><input name="pinming[]" id="val10" autocomplete="off" class="layui-input"></td>
								<td><input name="pinfan[]" id="val1010" autocomplete="off" class="layui-input"></td>
								<td><input name="sehao[]" id="val101010" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val10101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val1010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="tidanshu[]" id="val101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="qingdianshu[]" id="val10101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="yangzhishi[]" id="val1010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="shiji[]" id="val101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhao[]" id="val10101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="jianshu[]" id="val1010101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="sunhaoyongliang[]" id="val101010101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="daoliaori[]" id="val10101010101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="zhishiyongliang[]" id="val1010101010101010101010101010" readonly autocomplete="off" onclick="return jisuan1('val1010101010101010101010101010','val1010101010101010','val1010101010101010101010')"  placeholder="计算" class="layui-input"></td>
								<td><input name="shijiyongliang[]" id="val101010101010101010101010101010" readonly autocomplete="off" onclick="return jisuan2('val101010101010101010101010101010','val101010101010101010','val1010101010101010101010')" placeholder="计算" class="layui-input"></td>
								<td><input name="shengyu[]" id="val10101010101010101010101010101010" readonly autocomplete="off" onclick="return jisuan3('val10101010101010101010101010101010','val101010101010','val1010101010101010101010101010')" placeholder="计算" class="layui-input"></td>
							</tr>
							<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
                        </tbody>
                    </table>
					<div class="layui-form-item" style="margin-top: 15px;">
						<label for="L_repass" class="layui-form-label" style="width: 90%;">
						</label>
						<button class="layui-btn" lay-filter="add" lay-submit="">
							确认提交
						</button>
					</div>
					</form>
				</div>
            </div>
        </div>
    </div>
</div>
<script>
	function jisuan1(a,b,c){
		var num = (Number($("#"+b).val())*Number($("#"+c).val())).toFixed(2);
		$("#"+a).val(num);
	}
	function jisuan2(a,b,c){
		var num = (Number($("#"+b).val())*Number($("#"+c).val())).toFixed(2);
		$("#"+a).val(num);
	}
	function jisuan3(a,b,c){
		var num = (Number($("#"+b).val())-Number($("#"+c).val())).toFixed(2);
		$("#"+a).val(num);
	}
	function addnow(id, idd) {
		$("#div" + id).show()
		$("#divadd" + idd).hide();
	}

	function dellete(id, idd) {
		$("#div" + id).hide();
		$("#val" + id).val("");
		$("#val" + id + id).val("");
		$("#val" + id + id + id).val("");
		$("#val" + id + id + id + id).val("");
		$("#val" + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id + id + id + id + id + id).val("");
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
