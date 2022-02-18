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
					<form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/goods/goods_list_yangpin' ?>">
						<div class="layui-inline layui-show-xs-block">
							<input type="text" name="gname" id="gname" value="<?php echo $gname ?>"
								   placeholder="合同款号" autocomplete="off" class="layui-input">
						</div>
						<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
						<input type="hidden" id="zid" name="zid" value="<?php echo $zid ?>">
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
							<th>操作</th>
						</thead>
						<tbody>
						<?php if (isset($list) && !empty($list)) { ?>
							<?php foreach ($list as $num => $once): ?>
								<tr id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>">
									<td><?= $once['bianhao'] ?></td>
									<td><?= $once['kuanhao'] ?></td>
									<td class="td-manage">
										<button class="layui-btn"
												onclick="xadmin.open('预算报价单添加','<?= RUN . '/goods/goods_add_jichu?btype=1&id=' ?>'+'<?= $once['id'] ?>')">
											<i class="layui-icon">&#xe642;</i>预算报价单添加
										</button>
										<button class="layui-btn layui-btn-normal"
												onclick="xadmin.open('预算报价单编辑','<?= RUN . '/goods/goods_edit_jichu?btype=1&id=' ?>'+'<?= $once['id'] ?>')">
											<i class="layui-icon">&#xe642;</i>预算报价单编辑
										</button>
										<?php if ($btype==1){ ?>
											<?php if ($once['openflg1']>=1){ ?>
												<?php if ($once['status2']==1 || $once['state2']==3){ ?>

												<?php }else{ ?>
												    <?php if ($once['status2']==2 && $once['state2']==1){ ?>
														<button class="layui-btn layui-btn-danger">
															请联系管理员进行审核处理
														</button>
													<?php } ?>
												<?php } ?>
											<?php }else{ ?>

											<?php } ?>
											<?php if ($once['openflg1']>=1 && $once['openflg']>=1 && $once['status2']==2 && $once['state2']==2){ ?>
												<button class="layui-btn layui-btn-normal"
														onclick="xadmin.open('报价单查看详情','<?= RUN . '/goods/goods_edit_jichu?btype=1&id=' ?>'+'<?= $once['id'] ?>')">
													<i class="layui-icon">&#xe642;</i>报价单查看详情
												</button>
												<?php if ($once['duibiflg'] == 1){ ?>
													<button class="layui-btn layui-btn-normal"
															onclick="xadmin.open('数据对比','<?= RUN . '/goods/goods_list_bao_duibi_details?id=' ?>'+'<?= $once['id'] ?>')">
														<i class="iconfont">&#xe74a;</i>数据对比
													</button>
												<?php } ?>
												<a style="margin-left: 10px;" href="<?= RUN. '/goods/goods_csv_baojiadan?btype=1&id='.$once['id'] ?>">
													<button class="layui-btn layui-btn-normal">
														<i class="iconfont">&#xe74a;</i>  数据导出
													</button>
												</a>
											<?php } ?>
										
										<?php }else{ ?>

											<?php if ($once['openflg1']>=1){ ?>
												<?php if ($once['status2']==1 || $once['state2']==3){ ?>
													<button class="layui-btn layui-btn-normal"
															onclick="xadmin.open('决算报价单编辑','<?= RUN . '/goods/goods_edit_jichu?btype=2&id=' ?>'+'<?= $once['id'] ?>')">
														<i class="layui-icon">&#xe642;</i>决算报价单编辑
													</button>
												<?php }else{ ?>
												    <?php if ($once['status2']==2 && $once['state2']==1){ ?>
														<button class="layui-btn layui-btn-danger">
															请联系管理员进行审核处理
														</button>
													<?php } ?>
												<?php } ?>
											<?php }else{ ?>
												<button class="layui-btn"
														onclick="xadmin.open('决算报价单添加','<?= RUN . '/goods/goods_add_jichu?btype=2&id=' ?>'+'<?= $once['id'] ?>')">
													<i class="layui-icon">&#xe642;</i>决算报价单添加
												</button>
											<?php } ?>
											<?php if ($once['openflg1']>=1 && $once['openflg']>=1 && $once['status2']==2 && $once['state2']==2){ ?>
												<button class="layui-btn layui-btn-normal"
														onclick="xadmin.open('报价单查看详情','<?= RUN . '/goods/goods_edit_jichu?btype=2&id=' ?>'+'<?= $once['id'] ?>')">
													<i class="layui-icon">&#xe642;</i>报价单查看详情
												</button>
												<?php if ($once['duibiflg'] == 1){ ?>
													<button class="layui-btn layui-btn-normal"
															onclick="xadmin.open('数据对比','<?= RUN . '/goods/goods_list_bao_duibi_details?id=' ?>'+'<?= $once['id'] ?>')">
														<i class="iconfont">&#xe74a;</i>数据对比
													</button>
												<?php } ?>
												<a style="margin-left: 10px;" href="<?= RUN. '/goods/goods_csv_baojiadan?btype=2&id='.$once['id'] ?>">
													<button class="layui-btn layui-btn-normal">
														<i class="iconfont">&#xe74a;</i>  数据导出
													</button>
												</a>
											<?php } ?>
										<?php } ?>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php } else { ?>
							<tr>
								<td colspan="11" style="text-align: center;">暂无数据</td>
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
