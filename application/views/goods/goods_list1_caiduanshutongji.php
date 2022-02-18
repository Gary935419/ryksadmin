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
					<form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/goods/goods_list1_caiduanshutongji' ?>">
						<div class="layui-inline layui-show-xs-block">
							<input type="text" name="gname" id="gname" value="<?php echo $gname ?>"
								   placeholder="合同款号" autocomplete="off" class="layui-input">
						</div>
						<div class="layui-inline layui-show-xs-block">
							<button class="layui-btn" lay-submit="" lay-filter="sreach"><i
										class="layui-icon">&#xe615;</i></button>
						</div>
					</form>
				</div>
				<div class="layui-card-body ">
					<table class="layui-table layui-form">
						<thead>
						<tr>
							<th>合同编号</th>
							<th>合同款号</th>
							<th>客户名称</th>
							<th>日期</th>
							<th>品类</th>
							<th>合计数量</th>
							<th>操作</th>
						</thead>
						<tbody>
						<?php if (isset($list) && !empty($list)) { ?>
							<?php foreach ($list as $num => $once): ?>
						        <?php if ($once['openflg2']>=1){ ?>
									<tr id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>">
										<td><?= $once['bianhao'] ?></td>
										<td><?= $once['kuanhao'] ?></td>
										<td><?= $once['mingcheng'] ?></td>
										<td><?= date('Y-m-d', $once['qianding']) ?></td>
										<td><?= $once['pinlei'] ?></td>
										<td><?= $once['heji'] ?></td>
										<td class="td-manage">
											<button class="layui-btn layui-btn-normal"
													onclick="xadmin.open('编辑','<?= RUN . '/goods/goods_edit_new22_caitongji?id=' ?>'+'<?= $once['id'] ?>')">
												<i class="layui-icon">&#xe642;</i>编辑
											</button>
										</td>
									</tr>
								<?php } ?>
							<?php endforeach; ?>
						<?php } else { ?>
							<tr>
								<td colspan="24" style="text-align: center;">暂无数据</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="layui-card-body ">
					<div class="page">
						<?= $pagehtml ?>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
</body>
</html>
