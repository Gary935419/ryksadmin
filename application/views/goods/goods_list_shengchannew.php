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
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a>
              <cite>生产计划</cite></a>
          </span>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
				<div class="layui-card-body ">
					<form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/goods/goods_list_shengchannew' ?>">
						<div class="layui-inline layui-show-xs-block">
							<input type="text" name="jihuariqi" id="jihuariqi" value="<?php echo $jihuariqi ?>"
								   placeholder="计划日期" autocomplete="off" class="layui-input">
						</div>
						<input type="hidden" name="zuname" id="zuname" value="<?php echo $zuname ?>">
						<div class="layui-inline layui-show-xs-block">
							<button class="layui-btn" lay-submit="" lay-filter="sreach"><i
										class="layui-icon">&#xe615;</i></button>
						</div>
					</form>
				</div>
				<button class="layui-btn layui-card-header" style="float: right;margin-top: -40px;margin-right: 20px;"
						onclick="xadmin.open('生产计划导入','<?= RUN . '/goods/goods_add_new_shengchan_excel?zuname=' ?>'+'<?php echo $zuname ?>',900,500)">
					<i class="iconfont">&#xe74a;</i> 导入
				</button>
                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>组名</th>
                            <th>日期</th>
                            <th>款号量</th>
                            <th>产量值</th>
							<th>项目负责人</th>
                            <th>操作</th>
                        </thead>
                        <tbody>
                        <?php if (isset($list) && !empty($list)) { ?>
                            <?php foreach ($list as $num => $once): ?>
                                <tr id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>">
                                    <td><?= $once['zuname'] ?></td>
									<td><?= $once['jihuariqi'] ?></td>
                                    <td><?= $once['kuanhaoliang'] ?></td>
									<td><?= $once['chanliangzhi'] ?></td>
									<td><?= empty($once['newren'])?'admin':$once['newren'] ?></td>
                                    <td class="td-manage">
										<button class="layui-btn layui-btn-normal"
												onclick="xadmin.open('查看','<?= RUN . '/goods/goods_list_shengchan?zuname=' ?>'+'<?= $once['zuname'] ?>'+'&jihuariqi='+'<?= $once['jihuariqi'] ?>')">
											<i class="layui-icon">&#xe642;</i>查看
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
</body>
<script>layui.use(['laydate', 'form'],
			function() {
				var laydate = layui.laydate;
				laydate.render({
					elem: '#jihuariqi', //指定元素
					format: 'yyyy-MM',
					type: 'month',
				});
			});
</script>
<script>
    function goods_delete(id) {
        layer.confirm('您是否确认删除？', {
                title: '温馨提示',
                btn: ['确认', '取消']
                // 按钮
            },
            function (index) {
                $.ajax({
                    type: "post",
                    data: {"id": id},
                    dataType: "json",
                    url: "<?= RUN . '/goods/goods_delete_shengchan' ?>",
                    success: function (data) {
                        if (data.success) {
                            $("#p" + id).remove();
                            layer.alert(data.msg, {
                                    title: '温馨提示',
                                    icon: 6,
                                    btn: ['确认']
                                },
                            );
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
</html>
