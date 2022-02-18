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
                            <th>项目</th>
                            <th>名称</th>
                            <th>规格</th>
							<th>单位</th>
                            <th>单价</th>
							<th>单位</th>
							<th>用量</th>
							<th>单位</th>
							<th>金额</th>
							<th>单位</th>
							<th>起订量</th>
							<th>备注</th>
						<tr>
                        </thead>
                        <tbody>
							<tr id="div1">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd1" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(2,1)"></i>
								</td>
								<td><input name="xiangmu[]" id="val1" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" id="val11" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val111" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val1111" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" id="val11111" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" id="val111111" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" id="val1111111" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" id="val11111111" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" id="val111111111" readonly autocomplete="off" onclick="return jisuan1('val111111111','val11111','val1111111')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" id="val1111111111" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" id="val11111111111" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val111111111111" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div2" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd2" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(3,2)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(2,1)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" id="val2" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" id="val22" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val2222" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" id="val22222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" id="val222222" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" id="val2222222" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" id="val22222222" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" id="val222222222" readonly autocomplete="off" onclick="return jisuan1('val222222222','val22222','val2222222')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" id="val2222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" id="val22222222222" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val222222222222" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div3" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd3" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(4,3)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(3,2)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" id="val3" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" id="val33" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val3333" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" id="val33333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" id="val333333" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" id="val3333333" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" id="val33333333" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" id="val333333333" readonly autocomplete="off" onclick="return jisuan1('val333333333','val33333','val3333333')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" id="val3333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" id="val33333333333" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val333333333333" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div4" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd4" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(5,4)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(4,3)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" id="val4" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" id="val44" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val4444" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" id="val44444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" id="val444444" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" id="val4444444" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" id="val44444444" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" id="val444444444" readonly autocomplete="off" onclick="return jisuan1('val444444444','val44444','val4444444')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" id="val4444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" id="val44444444444" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val444444444444" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div5" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd5" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(6,5)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(5,4)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" id="val5" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" id="val55" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val5555" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" id="val55555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" id="val555555" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" id="val5555555" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" id="val55555555" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" id="val555555555" readonly autocomplete="off" onclick="return jisuan1('val555555555','val55555','val5555555')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" id="val5555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" id="val55555555555" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val555555555555" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div6" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd6" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(7,6)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(6,5)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" id="val6" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" id="val66" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val6666" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" id="val66666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" id="val666666" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" id="val6666666" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" id="val66666666" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" id="val666666666" readonly autocomplete="off" onclick="return jisuan1('val666666666','val66666','val6666666')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" id="val6666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" id="val66666666666" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val666666666666" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div7" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd7" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(8,7)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(7,6)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" id="val7" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" id="val77" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val7777" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" id="val77777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" id="val777777" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" id="val7777777" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" id="val77777777" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" id="val777777777" readonly autocomplete="off" onclick="return jisuan1('val777777777','val77777','val7777777')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" id="val7777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" id="val77777777777" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val777777777777" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div8" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd8" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(9,8)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(8,7)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" id="val8" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" id="val88" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val8888" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" id="val88888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" id="val888888" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" id="val8888888" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" id="val88888888" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" id="val888888888" readonly autocomplete="off" onclick="return jisuan1('val888888888','val88888','val8888888')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" id="val8888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" id="val88888888888" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val888888888888" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div9" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd9" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(10,9)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(9,8)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" id="val9" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" id="val99" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val9999" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" id="val99999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" id="val999999" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" id="val9999999" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" id="val99999999" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" id="val999999999" readonly autocomplete="off" onclick="return jisuan1('val999999999','val99999','val9999999')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" id="val9999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" id="val99999999999" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val999999999999" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="div10" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="divadd10" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return addnow(11,10)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return dellete(10,9)">&#xe6fe;</i>
								</td>
								<td><input name="xiangmu[]" id="val10" autocomplete="off" class="layui-input"></td>
								<td><input name="mingcheng[]" id="val1010" autocomplete="off" class="layui-input"></td>
								<td><input name="guige[]" id="val101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei[]" id="val10101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danjia[]" id="val1010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei1[]" id="val101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="yongliang[]" id="val10101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="danwei2[]" id="val1010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="jine[]" id="val101010101010101010" readonly autocomplete="off" onclick="return jisuan1('val101010101010101010','val1010101010','val10101010101010')"  placeholder="计算" class="layui-input"></td>
								<td><input name="danwei3[]" id="val10101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="qidingliang[]" id="val1010101010101010101010" autocomplete="off" class="layui-input"></td>
								<td><input name="beizhu[]" id="val101010101010101010101010" autocomplete="off" class="layui-input"></td>
							</tr>
							<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
							<input type="hidden" id="btype" name="btype" value="<?php echo $btype ?>">
							<input type="hidden" id="status" name="status">
							<input type="hidden" id="state" name="state">
                        </tbody>
                    </table>
                      <br><br><br>
						<table class="layui-table layui-form">
							<thead>
							<tr>
								<th>操作</th>
								<th>名称</th>
								<th>单价</th>
								<th>用量</th>
								<th>金额</th>
							<tr>
							</thead>
							<tbody>
							<tr id="tr1">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="tradd1" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return traddnow(2,1)"></i>
								</td>
								<td><input name="name1" id="trval1" autocomplete="off" class="layui-input"></td>
								<td><input name="jiagongfeidanjia" id="trval11" autocomplete="off" class="layui-input"></td>
								<td><input name="jiagongfeiyongliang" id="trval111" autocomplete="off" class="layui-input"></td>
								<td><input name="jiagongfeijine" id="trval1111" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="tr2" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="tradd2" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return traddnow(3,2)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return trdellete(2,1)">&#xe6fe;</i>
								</td>
								<td><input name="name2" id="trval2" autocomplete="off" class="layui-input"></td>
								<td><input name="ercijiagongfeidanjia" id="trval22" autocomplete="off" class="layui-input"></td>
								<td><input name="ercijiagongfeiyongliang" id="trval222" autocomplete="off" class="layui-input"></td>
								<td><input name="ercijiagongfeijine" id="trval2222" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="tr3" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="tradd3" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return traddnow(4,3)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return trdellete(3,2)">&#xe6fe;</i>
								</td>
								<td><input name="name3" id="trval3" autocomplete="off" class="layui-input"></td>
								<td><input name="jianpinfeidanjia" id="trval33" autocomplete="off" class="layui-input"></td>
								<td><input name="jianpinfeiyongliang" id="trval333" autocomplete="off" class="layui-input"></td>
								<td><input name="jianpinfeijine" id="trval3333" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="tr4" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="tradd4" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return traddnow(5,4)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return trdellete(4,3)">&#xe6fe;</i>
								</td>
								<td><input name="name4" id="trval4" autocomplete="off" class="layui-input"></td>
								<td><input name="tongguanfeidanjia" id="trval44" autocomplete="off" class="layui-input"></td>
								<td><input name="tongguanfeiyongliang" id="trval444" autocomplete="off" class="layui-input"></td>
								<td><input name="tongguanfeijine" id="trval4444" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="tr5" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="tradd5" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return traddnow(6,5)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return trdellete(5,4)">&#xe6fe;</i>
								</td>
								<td><input name="name5" id="trval5" autocomplete="off" class="layui-input"></td>
								<td><input name="mianliaojiancedanjia" id="trval55" autocomplete="off" class="layui-input"></td>
								<td><input name="mianliaojianceyongliang" id="trval555" autocomplete="off" class="layui-input"></td>
								<td><input name="mianliaojiancejine" id="trval5555" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="tr6" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="tradd6" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return traddnow(7,6)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return trdellete(6,5)">&#xe6fe;</i>
								</td>
								<td><input name="name6" id="trval6" autocomplete="off" class="layui-input"></td>
								<td><input name="yunfeidanjia" id="trval66" autocomplete="off" class="layui-input"></td>
								<td><input name="yunfeiyongliang" id="trval666" autocomplete="off" class="layui-input"></td>
								<td><input name="yunfeijine" id="trval6666" autocomplete="off" class="layui-input"></td>
							</tr>
							<tr id="tr7" style="display: none;">
								<td style="min-width: 80px;">
									<i class="layui-icon" id="tradd7" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return traddnow(8,7)"></i>
									<i class="iconfont" style="cursor: pointer;font-size: 25px;margin-left: 10px;"
									   onclick="return trdellete(7,6)">&#xe6fe;</i>
								</td>
								<td><input name="name7" id="trval7" autocomplete="off" class="layui-input"></td>
								<td><input name="qitadanjia" id="trval77" autocomplete="off" class="layui-input"></td>
								<td><input name="qitayongliang" id="trval777" autocomplete="off" class="layui-input"></td>
								<td><input name="qitajine" id="trval7777" autocomplete="off" class="layui-input"></td>
							</tr>
							</tbody>
						</table>
					<div class="layui-form-item" style="margin-top: 15px;">
						<label for="L_repass" class="layui-form-label" style="width: 80%;">
						</label>
						<button class="layui-btn layui-btn-normal" lay-filter="add" type="submit" onclick="return submitgo('1')">
							提交保存
						</button>
						<button class="layui-btn" lay-filter="add" type="submit" onclick="return submitgo('2')">
							提交审核
						</button>
					</div>
					</form>
				</div>
            </div>
        </div>
    </div>
</div>
<script>
	function submitgo(type){
		if(type < 2){
			//保存
			$("#status").val(1);
			$("#state").val(4);
		}else{
			//提交
			$("#status").val(2);
			$("#state").val(1);
		}
	}
	function jisuan1(a,b,c){
		var num = (Number($("#"+b).val())*Number($("#"+c).val())).toFixed(2);
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

	function traddnow(id, idd) {
		$("#tr" + id).show()
		$("#tradd" + idd).hide();
	}

	function trdellete(id, idd) {
		$("#trdiv" + id).hide();
		$("#trval" + id).val("");
		$("#trval" + id + id).val("");
		$("#trval" + id + id + id).val("");
		$("#trval" + id + id + id + id).val("");
		$("#trval" + id + id + id + id + id).val("");
		$("#trval" + id + id + id + id + id + id).val("");
		$("#trval" + id + id + id + id + id + id + id).val("");
		$("#trval" + id + id + id + id + id + id + id + id).val("");
		$("#trval" + id + id + id + id + id + id + id + id + id).val("");
		$("#trval" + id + id + id + id + id + id + id + id + id + id).val("");
		$("#trval" + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#trval" + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#trval" + id + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#trval" + id + id + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#trval" + id + id + id + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#trval" + id + id + id + id + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#tradd" + idd).show();
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
							url: "<?= RUN . '/goods/goods_save_jichu' ?>",
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
