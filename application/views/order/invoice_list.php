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
              <cite>发票列表</cite></a>
          </span>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/order/invoice_list' ?>">
                        <div class="layui-input-inline layui-show-xs-block">
                            <input class="layui-input" placeholder="开始日期" value="<?php echo $start ?>" name="start" id="start"></div>
                        <div class="layui-input-inline layui-show-xs-block">
                            <input class="layui-input" placeholder="截止日期" value="<?php echo $end ?>" name="end" id="end"></div>
						<div class="layui-inline layui-show-xs-block">
							<input type="text" name="account" id="account" value="<?php echo $account ?>"
								   placeholder="发票姓名、发票电话" autocomplete="off" class="layui-input">
						</div>
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
                            <th>订单类型</th>
                            <th>订单价格</th>
							<th>用户姓名</th>
							<th>用户手机号</th>
							<th>发票类型</th>
							<th>抬头类型</th>
                            <th>抬头名称</th>
                            <th>纳税人识别号</th>
                            <th>发票内容</th>
                            <th>发票姓名</th>
							<th>备注信息</th>
							<th>发票电话</th>
							<th>发票邮箱</th>
							<th>发票地址</th>
                            <th>申请时间</th>
                        </thead>
                        <tbody>
                        <?php if (isset($list) && !empty($list)) { ?>
                            <?php foreach ($list as $num => $once): ?>
                                <tr id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>">
									<?php if ($once['intype']==1){ ?>
										<td>专车送</td>
									<?php }elseif ($once['intype']==2){ ?>
										<td>顺路送</td>
									<?php }elseif ($once['intype']==3){ ?>
										<td>代买</td>
									<?php }elseif ($once['intype']==4){ ?>
										<td>代驾</td>
									<?php }else{ ?>
										<td>数据错误</td>
									<?php } ?>
									<td><?= $once['price'] ?>元</td>
									<td><?= $once['name'] ?></td>
									<td><?= $once['account'] ?></td>
									<?php if ($once['tabChooseValue']==1){ ?>
										<td>电子</td>
									<?php }elseif ($once['tabChooseValue']==2){ ?>
										<td>纸质</td>
									<?php }else{ ?>
										<td>数据错误</td>
									<?php } ?>
									<?php if ($once['tabChooseTypeValue']==1){ ?>
										<td>单位</td>
									<?php }elseif ($once['tabChooseTypeValue']==2){ ?>
										<td>个人</td>
									<?php }else{ ?>
										<td>数据错误</td>
									<?php } ?>
                                    <td><?= $once['tabChangeNameValue'] ?></td>
									<td><?= $once['tabChangeNumberValue'] ?></td>
									<td><?= $once['tabChangeContentValue'] ?></td>
									<td><?= $once['tabChangePnameValue'] ?></td>
									<td><?= $once['tabChangeMarksValue'] ?></td>
									<td><?= $once['tabChangePtelValue'] ?></td>
									<td><?= $once['tabChangePemailValue'] ?></td>
									<td><?= $once['tabChangePaddressValue'] ?></td>
                                    <td><?= date('Y-m-d H:i:s', $once['add_time']) ?></td>
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
</script>
</html>
