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
                    <form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/member/member_list3' ?>">
                        <div class="layui-inline layui-show-xs-block">
                            <input type="text" name="account" id="account" value="<?php echo $account ?>"
                                   placeholder="司机电话" autocomplete="off" class="layui-input">
							<input type="hidden" name="id" id="id" value="<?php echo $order_id ?>"
								   autocomplete="off" class="layui-input">
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
							<th>司机昵称</th>
							<th>司机电话</th>
							<th>司机余额</th>
							<th>司机信誉分</th>
							<th>司机状态</th>
							<th>操作</th>
						</thead>
						<tbody>
						<?php if (isset($list) && !empty($list)) { ?>
							<?php foreach ($list as $num => $once): ?>
								<tr id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>">
									<td><?= $once['name'] ?></td>
									<td><?= empty($once['account']) ? '暂无数据' : $once['account'] ?></td>
									<td><?= $once['money'] ?>元</td>
									<td><?= $once['credit_points'] ?>分</td>
									<?php if ($once['is_logoff'] == 1) { ?>
										<td style="color: red">锁定</td>
									<?php } else { ?>
										<td style="color: green">开启</td>
									<?php } ?>
									<td class="td-manage">
										<button class="layui-btn layui-btn-danger"
												onclick="order_send('<?= $once['id'] ?>','<?= $once['order_id'] ?>',1)"><i class="layui-icon">&#xe60b;</i>派单
										</button>
									</td>
								</tr>
							<?php endforeach; ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="10" style="text-align: center;">暂无数据</td>
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
	layui.use(['laydate', 'form'],
			function() {
				var laydate = layui.laydate;
				//执行一个laydate实例
				laydate.render({
					elem: '#start' //指定元素
				});
				//执行一个laydate实例
				laydate.render({
					elem: '#end' //指定元素
				});
			});

	function order_send(id,order_id,type) {
		layer.confirm('您是否确认派单该司机？', {
					title: '温馨提示',
					btn: ['确认', '取消']
					// 按钮
				},
				function (index) {
					$.ajax({
						type: "post",
						data: {"id": id,"type": type,"order_id": order_id},
						dataType: "json",
						url: "<?= RUN . '/order/order_send' ?>",
						success: function (data) {
							layer.alert(data.msg, {
										title: '温馨提示',
										icon: 6,
										btn: ['确认']
									},
							);
						},
					});
				});
	}
</script>
</body>
</html>
