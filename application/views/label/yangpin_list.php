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
              <cite>样品制作收发明细</cite></a>
          </span>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
					<form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/label/yangpin_list' ?>">
						<div class="layui-inline layui-show-xs-block">
							<input type="text" name="kuanhao" id="kuanhao" value="<?php echo $kuanhao ?>"
								   placeholder="款号" autocomplete="off" class="layui-input">
						</div>
						<div class="layui-input-inline layui-show-xs-block">
							<input class="layui-input" placeholder="开始日期" value="<?php echo $start ?>" name="start" id="start"></div>
						<div class="layui-input-inline layui-show-xs-block">
							<input class="layui-input" placeholder="截止日期" value="<?php echo $end ?>" name="end" id="end"></div>
						<div class="layui-input-inline layui-show-xs-block">
							<button class="layui-btn" lay-submit="" lay-filter="sreach">
								<i class="layui-icon">&#xe615;</i></button>
						</div>
						<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
					</form>
                </div>
				<a href="<?= RUN. '/goods/goods_yangpin_csv?start='.(isset($start)?$start:"")."&end=".(isset($end)?$end:"")."&kuanhao=".(isset($kuanhao)?$kuanhao:"")."&zid=".(isset($id)?$id:"") ?>">
					<button class="layui-btn layui-card-header" style="float: right;margin-top: -40px;margin-right: 120px;">
						<i class="iconfont">&#xe74a;</i>  导出
					</button>
				</a>
                <button class="layui-btn layui-card-header" style="float: right;margin-top: -40px;margin-right: 20px;"
                        onclick="xadmin.open('添加','<?= RUN . '/label/yangpin_add?zid='.$id ?>')"><i
                            class="layui-icon"></i>添加
                </button>
                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>客户名称</th>
                            <th>担当者</th>
							<th>项目负责人</th>
							<th>款号</th>
							<th>款式</th>
							<th>样品性质</th>
							<th>数量</th>
							<th>样品单价</th>
							<th>收到日期</th>
							<th>发出日期</th>
							<th>制作者</th>
							<th>创建日期</th>
                            <th>操作</th>
                        </thead>
                        <tbody>
                        <?php if (isset($list) && !empty($list)) { ?>
                            <?php foreach ($list as $num => $once): ?>
                                <tr id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>">
                                    <td><?= $once['kuhumingcheng'] ?></td>
									<td><?= $once['dandangzhe'] ?></td>
									<td><?= empty($once['newren'])?'admin':$once['newren'] ?></td>
									<td><?= $once['kuanhao'] ?></td>
									<td><?= $once['kuanshi'] ?></td>
									<td><?= $once['yangpinxingzhi'] ?></td>
									<td><?= $once['shuliang'] ?></td>
									<td><?= $once['yangpindanjia'] ?></td>
									<td><?= date('Y-m-d', $once['shoudaoriqi']) ?></td>
									<td><?= date('Y-m-d', $once['fachuriqi']) ?></td>
									<td><?= $once['zhizuozhe'] ?></td>
									<td><?= date('Y-m-d H:i:s', $once['addtime']) ?></td>
                                    <td class="td-manage">
                                        <button class="layui-btn layui-btn-normal"
                                                onclick="xadmin.open('编辑','<?= RUN . '/label/yangpin_edit?id=' ?>'+<?= $once['id'] ?>)">
                                            <i class="layui-icon">&#xe642;</i>编辑
                                        </button>
                                        <button class="layui-btn layui-btn-danger"
                                                onclick="label_delete('<?= $once['id'] ?>')"><i class="layui-icon">&#xe640;</i>删除
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="21" style="text-align: center;">暂无数据</td>
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
<script>
    function label_delete(id) {
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
                    url: "<?= RUN . '/label/yangpin_delete' ?>",
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
