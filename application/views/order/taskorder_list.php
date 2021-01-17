<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>我的管理后台-如邮快送</title>
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
              <cite>订单列表(代驾)</cite></a>
          </span>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/order/taskorder_list' ?>">
                        <div class="layui-input-inline layui-show-xs-block">
                            <input class="layui-input" placeholder="开始日期" value="<?php echo $start ?>" name="start" id="start"></div>
                        <div class="layui-input-inline layui-show-xs-block">
                            <input class="layui-input" placeholder="截止日期" value="<?php echo $end ?>" name="end" id="end"></div>
                        <div class="layui-input-inline layui-show-xs-block">
                            <button class="layui-btn" lay-submit="" lay-filter="sreach">
                                <i class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>
                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>序号</th>
                            <th>乘客姓名</th>
							<th>乘客手机号</th>
                            <th>订单状态</th>
                            <th>出发地点</th>
                            <th>目的地点</th>
                            <th>订单价格</th>
                            <th>下单时间</th>
							<th>操作</th>
                        </thead>
                        <tbody>
                        <?php if (isset($list) && !empty($list)) { ?>
                            <?php foreach ($list as $num => $once): ?>
                                <tr id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>">
                                    <td><?= $num + 1 ?></td>
                                    <td><?= $once['name'] ?></td>
									<td><?= $once['account'] ?></td>
									<?php if ($once['status']==1){ ?>
										<td>待接单</td>
									<?php }elseif ($once['status']==2){ ?>
										<td>待接驾</td>
									<?php }elseif ($once['status']==3){ ?>
										<td>乘客上车</td>
									<?php }elseif ($once['status']==4){ ?>
										<td>已开始</td>
									<?php }elseif ($once['status']==6){ ?>
										<td>已完成</td>
									<?php }elseif ($once['status']==7){ ?>
										<td>已取消</td>
									<?php }else{ ?>
										<td>数据错误</td>
									<?php } ?>
                                    <td><?= $once['address1'] ?></td>
                                    <td><?= $once['address2'] ?></td>
                                    <td><?= $once['price'] ?>元</td>
                                    <td><?= date('Y-m-d H:i:s', $once['add_time']) ?></td>
									<td class="td-manage">
										<button class="layui-btn layui-btn-warm"
												onclick="xadmin.open('订单详情','<?= RUN . '/order/driver_examine_details?id=' ?>'+<?= $once['id'] ?>,900,500)">
											<i class="layui-icon">&#xe60b;</i>查看
										</button>
										<button class="layui-btn layui-btn-danger"
												onclick="order_send('<?= $once['id'] ?>')"><i class="layui-icon">&#xe640;</i>派单
										</button>
									</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="7" style="text-align: center;">暂无数据</td>
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
            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });
            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
            });
        });
</script>
</html>
