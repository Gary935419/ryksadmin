<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>我的管理后台-天桥伟业</title>
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
              <cite>会员管理</cite></a>
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
                            <input type="text" name="nickname" id="nickname" value="<?php echo $nickname ?>"
                                   placeholder="会员昵称" autocomplete="off" class="layui-input">
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
                            <th>会员昵称</th>
							<th>授权账号</th>
                            <th>会员头像</th>
<!--                            <th>会员电话</th>-->
<!--                            <th>会员性别</th>-->
                            <th>注册时间</th>
                        </thead>
                        <tbody>
                        <?php if (isset($list) && !empty($list)) { ?>
                            <?php foreach ($list as $num => $once): ?>
                                <tr style="<?php echo $num%2 != 0 ? 'background-color: #f8f8f8': '' ?>" id="p<?= $once['mid'] ?>" sid="<?= $once['mid'] ?>">
                                    <td><?= $num + 1 ?></td>
                                    <td><?= $once['nickname'] ?></td>
									<td><?= $once['truename'] ?></td>
                                    <td><img src="<?= $once['avater'] ?>" style="width: 50px;height: 50px;"></td>
<!--                                    <td>--><?//= empty($once['mobile']) ? '暂无数据' : $once['mobile'] ?><!--</td>-->
<!--                                    <td>--><?//= $once['sex'] == 1 ? '男' : '女' ?><!--</td>-->
                                    <td><?= date('Y-m-d H:i:s', $once['add_time']) ?></td>
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
