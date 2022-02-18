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
<!--            <a href="--><? //= RUN . '/admin/index' ?><!--">最初のページ</a>-->
            <a>
              <cite>用户管理</cite></a>
          </span>
    <!--          <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="ページを更新">-->
    <!--            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>-->
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/member/member_list' ?>">
                        <div class="layui-inline layui-show-xs-block">
                            <input type="text" name="account" id="account" value="<?php echo $account ?>"
                                   placeholder="用户电话" autocomplete="off" class="layui-input">
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
                            <th>序号</th>
                            <th>用户昵称</th>
                            <th>用户电话</th>
							<th>用户状态</th>
                            <th>注册时间</th>
                            <th>操作</th>
                        </thead>
                        <tbody>
                        <?php if (isset($list) && !empty($list)) { ?>
                            <?php foreach ($list as $num => $once): ?>
                                <tr id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>">
                                    <td><?= $num + 1 ?></td>
                                    <td><?= $once['name'] ?></td>
                                    <td><?= empty($once['account']) ? '暂无数据' : $once['account'] ?></td>
<!--                                    <td>--><?//= $once['credit_points'] ?><!--分</td>-->
<!--                                    <td>--><?//= $once['integral'] ?><!--积分</td>-->
<!--                                    <td>--><?//= $once['cityname'] ?><!--</td>-->
                                    <?php if ($once['is_logoff'] == 1) { ?>
                                        <td style="color: red">锁定</td>
                                    <?php } else { ?>
                                        <td style="color: green">开启</td>
                                    <?php } ?>
<!--                                    <td>--><?//= empty($once['member_id']) ? '暂无推荐人' : $once['member_id'] ?><!--</td>-->
                                    <td><?= date('Y-m-d H:i:s', $once['add_time']) ?></td>
                                    <td class="td-manage">
                                        <button class="layui-btn layui-btn-normal"
                                                onclick="xadmin.open('编辑','<?= RUN . '/member/member_edit?id=' ?>'+<?= $once['id'] ?>,900,500)">
                                            <i class="layui-icon">&#xe642;</i>编辑
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
</html>
