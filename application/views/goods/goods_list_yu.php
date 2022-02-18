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
					<form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/goods/goods_list_yu' ?>">
						<div class="layui-inline layui-show-xs-block">
							<input type="text" name="gname" id="gname" value="<?php echo $gname ?>"
								   placeholder="合同款号" autocomplete="off" class="layui-input">
						</div>
						<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
						<input type="hidden" id="btype" name="btype" value="<?php echo $btype ?>">
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
							<th>客户名</th>
							<th>报价日期</th>
							<th>生产数量</th>
							<th>费用合计</th>
							<th>状态</th>
							<th>操作</th>
						</thead>
						<tbody>
						<?php if (isset($list) && !empty($list)) { ?>
							<?php foreach ($list as $num => $once): ?>
								<tr id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>">
									<td><?= $once['bianhao'] ?></td>
									<td><?= $once['kuanhao'] ?></td>
									<td><?= $once['kehuming'] ?></td>
									<?php if (empty($once['addtime'])){ ?>
									<td>暂无数据</td>
									<?php }else{ ?>
									<td><?= date('Y-m-d H:i:s', $once['addtime']) ?></td>
									<?php } ?>
									<td><?= $once['shengcanshuliang'] ?></td>
									<td><?= $once['feiyong'] ?></td>
									<?php if ($once['openflg']>=1 && $once['openflg1']>=1){ ?>
										<?php if ($once['state2']==3){ ?>
											<td style="color: red;">审核驳回</td>
										<?php } ?>
										<?php if ($once['state2']==2){ ?>
											<td style="color: green;">审核通过</td>
										<?php } ?>
										<?php if ($once['state2']==1){ ?>
											<td style="color: #FFB800;">正在审核</td>
										<?php } ?>
										<?php if ($once['state2']==4){ ?>
											<td style="color: purple;">已填写</td>
										<?php } ?>
										<?php if ($once['state2']==5){ ?>
											<td style="color: green;">完成</td>
										<?php } ?>
									<?php }else{ ?>
										<td style="color: #0000FF;">未填写</td>
									<?php } ?>
									<td class="td-manage">
										<?php if ($btype==1){ ?>
											<?php if ($once['openflg1']>=1){ ?>
												<?php if ($once['status2']==1 || $once['state2']==3){ ?>
													<button class="layui-btn layui-btn-normal"
															onclick="xadmin.open('编辑','<?= RUN . '/goods/goods_edit_jichu?btype=1&id=' ?>'+'<?= $once['id'] ?>')">
														<i class="layui-icon">&#xe642;</i>编辑
													</button>
												<?php }else{ ?>
												    <?php if ($once['status2']==2 && $once['state2']==1){ ?>
<!--														<button class="layui-btn layui-btn-danger">-->
<!--															请联系管理员进行审核处理-->
<!--														</button>-->
													<?php } ?>
												<?php } ?>
											<?php }else{ ?>
												<button class="layui-btn"
														onclick="xadmin.open('添加','<?= RUN . '/goods/goods_add_jichu?btype=1&id=' ?>'+'<?= $once['id'] ?>')">
													<i class="layui-icon">&#xe642;</i>添加
												</button>
											<?php } ?>
											<?php if ($once['openflg1']>=1 && $once['openflg']>=1 && $once['status2']==2 && $once['state2']==2 || $once['state2']==5){ ?>
												<button class="layui-btn layui-btn-normal"
														onclick="xadmin.open('详情','<?= RUN . '/goods/goods_edit_jichu?btype=1&id=' ?>'+'<?= $once['id'] ?>')">
													<i class="layui-icon">&#xe642;</i>详情
												</button>
												<a style="margin-left: 10px;" href="<?= RUN. '/goods/goods_csv_baojiadan?btype=1&id='.$once['id'] ?>">
													<button class="layui-btn layui-btn-normal">
														<i class="iconfont">&#xe74a;</i>  导出
													</button>
												</a>
											<?php }else{ ?>
										    <?php if ($once['openflg1']<1){ ?>
										    <a style="margin-left: 10px;" href="#">
											<?php }else{ ?>
											<a href="#">
												<?php } ?>
													<button class="layui-btn layui-btn-normal" style="background-color: #C2C2C2;">
														<i class="iconfont">&#xe74a;</i>  导出
													</button>
												</a>
											<?php } ?>

												<?php if ($once['openflg1']>=1 && $once['openflg']>=1 && $once['status2']==2 && $once['state2']==2){ ?>
													<button style="margin-left: 10px;" class="layui-btn layui-btn-danger"
															onclick="label_delete('<?= $once['id'] ?>',1)"><i class="iconfont">&#xe74a;</i> 费用确认
													</button>
												<?php }else{ ?>
													<a style="margin-left: 10px;" href="#">
														<button class="layui-btn layui-btn-normal" style="background-color: #C2C2C2;">
															<i class="iconfont">&#xe74a;</i>  费用确认
														</button>
													</a>
												<?php } ?>
										<?php }else{ ?>

											<?php if ($once['openflg1']>=1){ ?>
												<?php if ($once['status2']==1 || $once['state2']==3){ ?>
													<button class="layui-btn layui-btn-normal"
															onclick="xadmin.open('编辑','<?= RUN . '/goods/goods_edit_jichu?btype=2&id=' ?>'+'<?= $once['id'] ?>')">
														<i class="layui-icon">&#xe642;</i>编辑
													</button>
												<?php }else{ ?>
												    <?php if ($once['status2']==2 && $once['state2']==1){ ?>
<!--														<button class="layui-btn layui-btn-danger">-->
<!--															请联系管理员进行审核处理-->
<!--														</button>-->
													<?php } ?>
												<?php } ?>
											<?php }else{ ?>
												<button class="layui-btn"
														onclick="xadmin.open('添加','<?= RUN . '/goods/goods_add_jichu?btype=2&id=' ?>'+'<?= $once['id'] ?>')">
													<i class="layui-icon">&#xe642;</i>添加
												</button>
											<?php } ?>
											<?php if ($once['openflg1']>=1 && $once['openflg']>=1 && $once['status2']==2 && $once['state2']==2 || $once['state2']==5){ ?>
												<button class="layui-btn layui-btn-normal"
														onclick="xadmin.open('详情','<?= RUN . '/goods/goods_edit_jichu?btype=2&id=' ?>'+'<?= $once['id'] ?>')">
													<i class="layui-icon">&#xe642;</i>详情
												</button>
												<?php if ($once['duibiflg'] == 1){ ?>
													<button class="layui-btn layui-btn-normal"
															onclick="xadmin.open('对比','<?= RUN . '/goods/goods_list_bao_duibi_details?id=' ?>'+'<?= $once['id'] ?>')">
														<i class="iconfont">&#xe74a;</i> 对比
													</button>
												<?php } ?>
												<a style="margin-left: 10px;" href="<?= RUN. '/goods/goods_csv_baojiadan?btype=2&id='.$once['id'] ?>">
													<button class="layui-btn layui-btn-normal">
														<i class="iconfont">&#xe74a;</i>  导出
													</button>
												</a>
											<?php }else{ ?>
												<?php if ($once['openflg1']<1){ ?>
										            <a style="margin-left: 10px;" href="#">
												<?php }else{ ?>
													<a href="#">
												<?php } ?>
													<button class="layui-btn layui-btn-normal" style="background-color: #C2C2C2;">
														<i class="iconfont">&#xe74a;</i>  导出
													</button>
												</a>
											<?php } ?>

											<?php if ($once['openflg1']>=1 && $once['openflg']>=1 && $once['status2']==2 && $once['state2']==2){ ?>
												<button style="margin-left: 10px;" class="layui-btn layui-btn-danger"
														onclick="label_delete('<?= $once['id'] ?>',2)"><i class="iconfont">&#xe74a;</i> 费用确认
												</button>
											<?php }else{ ?>
											    <a style="margin-left: 10px;" href="#">
													<button class="layui-btn layui-btn-normal" style="background-color: #C2C2C2;">
														<i class="iconfont">&#xe74a;</i>  费用确认
													</button>
												</a>
											<?php } ?>

										<?php } ?>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php } else { ?>
							<tr>
								<td colspan="3" style="text-align: center;">暂无数据</td>
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
<script>
	function label_delete(id,btype) {
		layer.confirm('您是否确认费用？', {
					title: '温馨提示',
					btn: ['确认', '取消']
					// 按钮
				},
				function (index) {
					$.ajax({
						type: "post",
						data: {"id": id,"btype": btype},
						dataType: "json",
						url: "<?= RUN . '/goods/goodsup' ?>",
						success: function (data) {
							if (data.success) {
								layer.alert(data.msg, {
											title: '温馨提示',
											icon: 6,
											btn: ['确认']
										},
								);
								window.location.reload();
							} else {
								layer.alert(data.msg, {
											title: '温馨提示',
											icon: 5,
											btn: ['确认']
										},
								);
							}
						},
					});
				});
	}
</script>
</body>
</html>
