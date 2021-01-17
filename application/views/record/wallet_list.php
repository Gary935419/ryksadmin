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
              <cite>钱包流水</cite></a>
          </span>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/record/wallet_list' ?>">
                        <div class="layui-input-inline layui-show-xs-block">
                            <input class="layui-input" placeholder="开始日期" value="<?php echo $start ?>" name="start" id="start"></div>
                        <div class="layui-input-inline layui-show-xs-block">
                            <input class="layui-input" placeholder="截止日期" value="<?php echo $end ?>" name="end" id="end"></div>
                        <div class="layui-input-inline layui-show-xs-block">
                            <select name="wtype" id="wtype">
                                <option value="">请选择</option>
                                <option value="1" <?php echo $wtype == 1 ? 'selected' : '' ?>>任务获得佣金</option>
                                <option value="2" <?php echo $wtype == 2 ? 'selected' : '' ?>>任务扣除押金</option>
                                <option value="3" <?php echo $wtype == 3 ? 'selected' : '' ?>>任务返还押金</option>
                                <option value="4" <?php echo $wtype == 4 ? 'selected' : '' ?>>钱包充值</option>
                                <option value="5" <?php echo $wtype == 5 ? 'selected' : '' ?>>押金提现扣款</option>
                                <option value="6" <?php echo $wtype == 6 ? 'selected' : '' ?>>押金提现驳回返款</option>
                                <option value="7" <?php echo $wtype == 7 ? 'selected' : '' ?>>佣金提现扣款</option>
                                <option value="8" <?php echo $wtype == 8 ? 'selected' : '' ?>>佣金提现驳回返款</option>
                                <option value="9" <?php echo $wtype == 9 ? 'selected' : '' ?>>任务获得佣金（代理）</option>
                            </select>
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
                            <th>序号</th>
                            <th>会员昵称</th>
                            <th>流水类型</th>
                            <th>流水金额</th>
                            <th>流水备注</th>
                            <th>添加时间</th>
                        </thead>
                        <tbody>
                        <?php if (isset($list) && !empty($list)) { ?>
                            <?php foreach ($list as $num => $once): ?>
                                <tr id="p<?= $once['wid'] ?>" sid="<?= $once['wid'] ?>">
                                    <td><?= $num + 1 ?></td>
                                    <td><?= $once['nickname'] ?></td>
                                    <?php if ($once['wtype'] == 1){ ?>
                                        <td style="color: green">任务获得佣金</td>
                                    <?php }elseif ($once['wtype'] == 2){ ?>
                                        <td style="color: red">任务扣除押金</td>
                                    <?php }elseif ($once['wtype'] == 3){ ?>
                                        <td style="color: #ff820b">任务返还押金</td>
                                    <?php }elseif ($once['wtype'] == 4){ ?>
                                        <td style="color: blue">钱包充值</td>
                                    <?php }elseif ($once['wtype'] == 5){ ?>
                                        <td style="color: #0fff28">押金提现扣款</td>
                                    <?php }elseif ($once['wtype'] == 6){ ?>
                                        <td style="color: #ff4610">押金提现驳回返款</td>
                                    <?php }elseif ($once['wtype'] == 7){ ?>
                                        <td style="color: #0fff28">佣金提现扣款</td>
                                    <?php }elseif ($once['wtype'] == 8){ ?>
                                        <td style="color: #ff4610">佣金提现驳回返款</td>
                                    <?php }elseif ($once['wtype'] == 9){ ?>
                                        <td style="color: #ff4610">任务获得佣金（代理）</td>
                                    <?php }else{ ?>
                                        <td style="color: black">数据错误</td>
                                    <?php } ?>
                                    <td>￥<?= $once['wprice'] ?></td>
                                    <td><?= $once['wremark'] ?></td>
                                    <td><?= date('Y-m-d H:i:s', $once['add_time']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="6" style="text-align: center;">暂无数据</td>
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
