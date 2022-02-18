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
						<p style="font-size: 25px;font-weight: bold;margin-bottom: 15px;margin-top: 15px;">预算工作信息</p>
						<table class="layui-table layui-form">
							<thead>
							<tr>
								<th>1号</th>
								<th>2号</th>
								<th>3号</th>
								<th>4号</th>
								<th>5号</th>
								<th>6号</th>
								<th>7号</th>
								<th>8号</th>
								<th>9号</th>
								<th>10号</th>
								<th>11号</th>
								<th>12号</th>
								<th>13号</th>
								<th>14号</th>
								<th>15号</th>
								<th>16号</th>
							<tr>
							</thead>
							<tbody>
							<tr>
								<td>
									<input name="y1" value="" autocomplete="off" class="layui-input">
									<input name="y1" value="<?php echo $y1 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y2" value="<?php echo $y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y2" value="<?php echo $y2 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y3" value="<?php echo $y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y3" value="<?php echo $y3 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y4" value="<?php echo $y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y4" value="<?php echo $y4 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y5" value="<?php echo $y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y5" value="<?php echo $y5 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y6" value="<?php echo $y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y6" value="<?php echo $y6 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y7" value="<?php echo $y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y7" value="<?php echo $y7 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y8" value="<?php echo $y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y8" value="<?php echo $y8 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y9" value="<?php echo $y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y9" value="<?php echo $y9 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y10" value="<?php echo $y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y10" value="<?php echo $y10 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y11" value="<?php echo $y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y11" value="<?php echo $y11 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y12" value="<?php echo $y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y12" value="<?php echo $y12 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y13" value="<?php echo $y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y13" value="<?php echo $y13 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y14" value="<?php echo $y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y14" value="<?php echo $y14 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y15" value="<?php echo $y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y15" value="<?php echo $y15 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y16" value="<?php echo $y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y16" value="<?php echo $y16 ?>" autocomplete="off" class="layui-input">
								</td>
							</tr>
							</tbody>
						</table>
						<table class="layui-table layui-form">
							<thead>
							<tr>

								<th>17号</th>
								<th>18号</th>
								<th>19号</th>
								<th>20号</th>
								<th>21号</th>
								<th>22号</th>
								<th>23号</th>
								<th>24号</th>
								<th>25号</th>
								<th>26号</th>
								<th>27号</th>
								<th>28号</th>
								<th>29号</th>
								<th>30号</th>
								<th>31号</th>
							<tr>
							</thead>
							<tbody>
							<tr>
								<td>
									<input name="y17" value="<?php echo $y17+$y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y17" value="<?php echo $y17 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y18" value="<?php echo $y18+$y17+$y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y18" value="<?php echo $y18 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y19" value="<?php echo $y19+$y18+$y17+$y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y19" value="<?php echo $y19 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y20" value="<?php echo $y20+$y19+$y18+$y17+$y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y20" value="<?php echo $y20 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y21" value="<?php echo $y21+$y20+$y19+$y18+$y17+$y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y21" value="<?php echo $y21 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y22" value="<?php echo $y22+$y21+$y20+$y19+$y18+$y17+$y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y22" value="<?php echo $y22 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y23" value="<?php echo $y23+$y22+$y21+$y20+$y19+$y18+$y17+$y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y23" value="<?php echo $y23 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y24" value="<?php echo $y24+$y23+$y22+$y21+$y20+$y19+$y18+$y17+$y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y24" value="<?php echo $y24 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y25" value="<?php echo $y25+$y24+$y23+$y22+$y21+$y20+$y19+$y18+$y17+$y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y25" value="<?php echo $y25 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y26" value="<?php echo $y26+$y25+$y24+$y23+$y22+$y21+$y20+$y19+$y18+$y17+$y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y26" value="<?php echo $y26 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y27" value="<?php echo $y27+$y26+$y25+$y24+$y23+$y22+$y21+$y20+$y19+$y18+$y17+$y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y27" value="<?php echo $y27 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y28" value="<?php echo $y28+$y27+$y26+$y25+$y24+$y23+$y22+$y21+$y20+$y19+$y18+$y17+$y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y28" value="<?php echo $y28 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y29" value="<?php echo $y29+$y28+$y27+$y26+$y25+$y24+$y23+$y22+$y21+$y20+$y19+$y18+$y17+$y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y29" value="<?php echo $y29 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y30" value="<?php echo $y30+$y29+$y28+$y27+$y26+$y25+$y24+$y23+$y22+$y21+$y20+$y19+$y18+$y17+$y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y30" value="<?php echo $y30 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="y31" value="<?php echo $y31+$y30+$y29+$y28+$y27+$y26+$y25+$y24+$y23+$y22+$y21+$y20+$y19+$y18+$y17+$y16+$y15+$y14+$y13+$y12+$y11+$y10+$y9+$y8+$y7+$y6+$y5+$y4+$y3+$y2+$y1 ?>" autocomplete="off" class="layui-input">
									<input name="y31" value="<?php echo $y31 ?>" autocomplete="off" class="layui-input">
								</td>
							</tr>
							</tbody>
						</table>
						<div class="layui-form-item" style="margin-top: 15px;">
							<label for="L_repass" class="layui-form-label" style="width: 100%;">
							</label>
							<button class="layui-btn" lay-filter="add" type="submit" onclick="return submitgo()">
								返回上一页
							</button>
						</div>
						<br><br>
						<p style="font-size: 25px;font-weight: bold;margin-bottom: 15px;margin-top: 15px;">决算工作信息</p>
						<table class="layui-table layui-form">
							<thead>
							<tr>
								<th>1号</th>
								<th>2号</th>
								<th>3号</th>
								<th>4号</th>
								<th>5号</th>
								<th>6号</th>
								<th>7号</th>
								<th>8号</th>
								<th>9号</th>
								<th>10号</th>
								<th>11号</th>
								<th>12号</th>
								<th>13号</th>
								<th>14号</th>
								<th>15号</th>
								<th>16号</th>
							<tr>
							</thead>
							<tbody>
							<tr>
								<td>
									<input name="j1" autocomplete="off" class="layui-input">
									<input name="j1" value="<?php echo $j1 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j2" value="<?php echo $j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j2" value="<?php echo $j2 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j3" value="<?php echo $j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j3" value="<?php echo $j3 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j4" value="<?php echo $j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j4" value="<?php echo $j4 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j5" value="<?php echo $j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j5" value="<?php echo $j5 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j6" value="<?php echo $j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j6" value="<?php echo $j6 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j7" value="<?php echo $j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j7" value="<?php echo $j7 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j8" value="<?php echo $j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j8" value="<?php echo $j8 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j9" value="<?php echo $j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j9" value="<?php echo $j9 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j10" value="<?php echo $j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j10" value="<?php echo $j10 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j11" value="<?php echo $j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j11" value="<?php echo $j11 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j12" value="<?php echo $j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j12" value="<?php echo $j12 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j13" value="<?php echo $j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j13" value="<?php echo $j13 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j14" value="<?php echo $j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j14" value="<?php echo $j14 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j15" value="<?php echo $j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j15" value="<?php echo $j15 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j16" value="<?php echo $j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j16" value="<?php echo $j16 ?>" autocomplete="off" class="layui-input">
								</td>
							</tr>
							</tbody>
						</table>
						<table class="layui-table layui-form">
							<thead>
							<tr>
								<th>17号</th>
								<th>18号</th>
								<th>19号</th>
								<th>20号</th>
								<th>21号</th>
								<th>22号</th>
								<th>23号</th>
								<th>24号</th>
								<th>25号</th>
								<th>26号</th>
								<th>27号</th>
								<th>28号</th>
								<th>29号</th>
								<th>30号</th>
								<th>31号</th>
							<tr>
							</thead>
							<tbody>
							<tr>
								<td>
									<input name="j17" value="<?php echo $j17+$j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j17" value="<?php echo $j17 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j18" value="<?php echo $j18+$j17+$j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j18" value="<?php echo $j18 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j19" value="<?php echo $j19+$j18+$j17+$j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j19" value="<?php echo $j19 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j20" value="<?php echo $j20+$j19+$j18+$j17+$j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j20" value="<?php echo $j20 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j21" value="<?php echo $j21+$j20+$j19+$j18+$j17+$j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j21" value="<?php echo $j21 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j22" value="<?php echo $j22+$j21+$j20+$j19+$j18+$j17+$j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j22" value="<?php echo $j22 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j23" value="<?php echo $j23+$j22+$j21+$j20+$j19+$j18+$j17+$j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j23" value="<?php echo $j23 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j24" value="<?php echo $j24+$j23+$j22+$j21+$j20+$j19+$j18+$j17+$j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j24" value="<?php echo $j24 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j25" value="<?php echo $j25+$j24+$j23+$j22+$j21+$j20+$j19+$j18+$j17+$j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j25" value="<?php echo $j25 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j26" value="<?php echo $j26+$j25+$j24+$j23+$j22+$j21+$j20+$j19+$j18+$j17+$j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j26" value="<?php echo $j26 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j27" value="<?php echo $j27+$j26+$j25+$j24+$j23+$j22+$j21+$j20+$j19+$j18+$j17+$j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j27" value="<?php echo $j27 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j28" value="<?php echo $j28+$j27+$j26+$j25+$j24+$j23+$j22+$j21+$j20+$j19+$j18+$j17+$j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j28" value="<?php echo $j28 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j29" value="<?php echo $j29+$j28+$j27+$j26+$j25+$j24+$j23+$j22+$j21+$j20+$j19+$j18+$j17+$j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j29" value="<?php echo $j29 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j30" value="<?php echo $j30+$j29+$j28+$j27+$j26+$j25+$j24+$j23+$j22+$j21+$j20+$j19+$j18+$j17+$j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j30" value="<?php echo $j30 ?>" autocomplete="off" class="layui-input">
								</td>
								<td>
									<input name="j31" value="<?php echo $j31+$j30+$j29+$j28+$j27+$j26+$j25+$j24+$j23+$j22+$j21+$j20+$j19+$j18+$j17+$j16+$j15+$j14+$j13+$j12+$j11+$j10+$j9+$j8+$j7+$j6+$j5+$j4+$j3+$j2+$j1 ?>" autocomplete="off" class="layui-input">
									<input name="j31" value="<?php echo $j31 ?>" autocomplete="off" class="layui-input">
								</td>
							</tr>
							</tbody>
						</table>
						<div class="layui-form-item" style="margin-top: 15px;">
							<label for="L_repass" class="layui-form-label" style="width: 100%;">
							</label>
							<button class="layui-btn" lay-filter="add" type="submit" onclick="return submitgo()">
								返回上一页
							</button>
						</div>
					</form>
				</div>
            </div>
        </div>
    </div>
</div>
<script>
	function submitgo(){
		//关闭当前frame
		xadmin.close();
	}
</script>
</body>
</html>
