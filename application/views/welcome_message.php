<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" href="<?= STA ?>/css/font.css">
	<link rel="stylesheet" href="<?= STA ?>/css/xadmin.css">
	<link type="text/css" href="<?= STA ?>/css/jquery-ui.css" rel="stylesheet"/>
	<script src="<?= STA ?>/lib/layui/layui.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?= STA ?>/js/jquery.mini.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/xadmin.js"></script>
</head>
<body>
<div class="layui-fluid">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-body ">
					<blockquote class="layui-elem-quote">欢迎登录后台管理系统
					</blockquote>
				</div>
			</div>
		</div>
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-header">数据统计</div>
				<div class="layui-card-body ">
					<ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>专车送总订单量</h3>
								<p>
									<cite><?php echo $ordercount1 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>顺风送总订单量</h3>
								<p>
									<cite><?php echo $ordercount2 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>代买总订单量</h3>
								<p>
									<cite><?php echo $ordercount3 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>代驾总订单量</h3>
								<p>
									<cite><?php echo $ordercount4 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>未支付总订单量(跑腿)</h3>
								<p>
									<cite><?php echo $ordercount5 ?></cite></p>
							</a>
						</li>
						<li class="layui-col-md2 layui-col-xs6">
							<a href="javascript:;" class="x-admin-backlog-body">
								<h3>未支付总订单量(代驾)</h3>
								<p>
									<cite><?php echo $ordercount6 ?></cite></p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-header">开发团队</div>
				<div class="layui-card-body ">
					<table class="layui-table">
						<tbody>
						<tr>
							<th>版权所有</th>
							<td>爱度网络信息科技（大连）有限公司</td>
						</tr>
						<tr>
							<th>联系地址</th>
							<td>大连市甘井子区姚胜街14号1-1-5</td>
						</tr>
						<tr>
							<th>开发者</th>
							<td>Gary(zhaoyeu_gary@163.com)</td></tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-header">企业Logo</div>
				<div class="layui-card-body ">
					<img src="http://ryksht.ychlkj.cn/static/images/icon-about_us.png">
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</body>
</html>
