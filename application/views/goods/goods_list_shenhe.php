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
					<form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/goods/goods_list_shenhe' ?>">
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
								<?php if ($once['openflg']>=1){ ?>
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
                                     				<?php }else{ ?>
                                     					<?php if ($once['status2']==2 && $once['state2']==1 && $shenheflg==1){ ?>
															<button class="layui-btn layui-btn-warm"
																	onclick="xadmin.open('审核','<?= RUN . '/goods/goods_edit_jichu?btype=3&id=' ?>'+'<?= $once['id'] ?>')">
																<i class="layui-icon">&#xe642;</i>审核
															</button>
                                     					<?php } ?>
														<?php if ($_SESSION['rid']==1 && $once['state2']!=5){ ?>
															<button class="layui-btn layui-btn-warm"
																	onclick="xadmin.open('审核(管理员)','<?= RUN . '/goods/goods_edit_jichu?btype=888&id=' ?>'+'<?= $once['id'] ?>')">
																<i class="layui-icon">&#xe642;</i>审核(管理员)
															</button>
														<?php } ?>
                                     				<?php } ?>
                                     			<?php } ?>
                                     				<?php if ($once['state2']==2 || $once['state2']==3 || $once['state2']==5){ ?>
                                     				<button class="layui-btn layui-btn-normal"
                                     						onclick="xadmin.open('详情','<?= RUN . '/goods/goods_edit_jichu?btype=1&id=' ?>'+'<?= $once['id'] ?>')">
                                     					<i class="layui-icon">&#xe642;</i>详情
                                     				</button>
                                     			    <?php } ?>
                                     		<?php }else{ ?>
                                     
                                     			<?php if ($once['openflg1']>=1){ ?>
                                     				<?php if ($once['status2']==1 || $once['state2']==3){ ?>
                                     				<?php }else{ ?>
                                     					<?php if ($once['status2']==2 && $once['state2']==1 && $shenheflg==1){ ?>
															<button class="layui-btn layui-btn-warm"
																	onclick="xadmin.open('审核','<?= RUN . '/goods/goods_edit_jichu?btype=4&id=' ?>'+'<?= $once['id'] ?>')">
																<i class="layui-icon">&#xe642;</i>审核
															</button>
                                     					<?php } ?>
														<?php if ($_SESSION['rid']==1 && $once['state2']!=5){ ?>
															<button class="layui-btn layui-btn-warm"
																	onclick="xadmin.open('审核(管理员)','<?= RUN . '/goods/goods_edit_jichu?btype=999&id=' ?>'+'<?= $once['id'] ?>')">
																<i class="layui-icon">&#xe642;</i>审核(管理员)
															</button>
														<?php } ?>
                                     				<?php } ?>
                                     			<?php } ?>
                                     			<?php if ($once['state2']==2 || $once['state2']==3 || $once['state2']==5){ ?>
                                     				<button class="layui-btn layui-btn-normal"
                                     						onclick="xadmin.open('详情','<?= RUN . '/goods/goods_edit_jichu?btype=2&id=' ?>'+'<?= $once['id'] ?>')">
                                     					<i class="layui-icon">&#xe642;</i>详情
                                     				</button>
                                     			<?php } ?>
                                     		<?php } ?>
                                     	</td>
                                     </tr>
								<?php } ?>
							<?php endforeach; ?>
						<?php } else { ?>
							<tr>
								<td colspan="4" style="text-align: center;">暂无数据</td>
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
