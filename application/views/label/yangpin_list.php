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
				<button class="layui-btn layui-card-header" style="float: right;margin-top: -40px;margin-right: 220px;"
						onclick="xadmin.open('上传导出表','<?= RUN . '/goods/goods_add_new_excel_yangpin?zid='.$id ?>',900,500)">
					<i class="iconfont">&#xe74a;</i>  上传
				</button>
                <button class="layui-btn layui-card-header" style="float: right;margin-top: -40px;margin-right: 20px;"
                        onclick="xadmin.open('添加','<?= RUN . '/label/yangpin_add?zid='.$id ?>')"><i
                            class="layui-icon"></i>添加
                </button>
				<div class="layui-card-body" style="overflow-x: auto; overflow-y: auto; width:93%;">
					<table class="layui-table layui-form" style="text-align:center">
                        <thead>
                        <tr>
                            <th style="min-width: 120px">客户名称</th>
                            <th style="min-width: 120px">担当者</th>
							<th style="min-width: 120px">项目负责人</th>
							<th style="min-width: 120px">款号</th>
							<th style="min-width: 120px">款式</th>
							<th style="min-width: 120px">样品性质</th>
							<th style="min-width: 120px">数量</th>
							<th style="min-width: 120px">样品单价</th>
							<th style="min-width: 120px">收到日期</th>
							<th style="min-width: 120px">发出日期</th>
							<th style="min-width: 120px">制作者</th>
							<th style="min-width: 120px">创建日期</th>
							<th style="min-width: 120px">1号</th>
							<th style="min-width: 120px">2号</th>
							<th style="min-width: 120px">3号</th>
							<th style="min-width: 120px">4号</th>
							<th style="min-width: 120px">5号</th>
							<th style="min-width: 120px">6号</th>
							<th style="min-width: 120px">7号</th>
							<th style="min-width: 120px">8号</th>
							<th style="min-width: 120px">9号</th>
							<th style="min-width: 120px">10号</th>
							<th style="min-width: 120px">11号</th>
							<th style="min-width: 120px">12号</th>
							<th style="min-width: 120px">13号</th>
							<th style="min-width: 120px">14号</th>
							<th style="min-width: 120px">15号</th>
							<th style="min-width: 120px">16号</th>
							<th style="min-width: 120px">17号</th>
							<th style="min-width: 120px">18号</th>
							<th style="min-width: 120px">19号</th>
							<th style="min-width: 120px">20号</th>
							<th style="min-width: 120px">21号</th>
							<th style="min-width: 120px">22号</th>
							<th style="min-width: 120px">23号</th>
							<th style="min-width: 120px">24号</th>
							<th style="min-width: 120px">25号</th>
							<th style="min-width: 120px">26号</th>
							<th style="min-width: 120px">27号</th>
							<th style="min-width: 120px">28号</th>
							<th style="min-width: 120px">29号</th>
							<th style="min-width: 120px">30号</th>
							<th style="min-width: 120px">31号</th>
                            <th style="min-width: 120px">操作</th>
                        </thead>
                        <tbody>
                        <?php if (isset($list) && !empty($list)) { ?>
                            <?php foreach ($list as $num => $once): ?>
                                <tr style="<?php echo $num%2 != 0 ? 'background-color: #f8f8f8': '' ?>" id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>">
                                    <td style="min-width: 120px"><?= $once['kuhumingcheng'] ?></td>
									<td style="min-width: 120px"><?= $once['dandangzhe'] ?></td>
									<td style="min-width: 120px"><?= empty($once['newren'])?'admin':$once['newren'] ?></td>
									<td style="min-width: 120px"><?= $once['kuanhao'] ?></td>
									<td style="min-width: 120px"><?= $once['kuanshi'] ?></td>
									<td style="min-width: 120px"><?= $once['yangpinxingzhi'] ?></td>
									<td style="min-width: 120px"><?= $once['shuliang'] ?></td>
									<td style="min-width: 120px"><?= $once['yangpindanjia'] ?></td>
									<td style="min-width: 120px"><?= date('Y-m-d', $once['shoudaoriqi']) ?></td>
									<td style="min-width: 120px"><?= date('Y-m-d', $once['fachuriqi']) ?></td>
									<td style="min-width: 120px"><?= $once['zhizuozhe'] ?></td>
									<td style="min-width: 120px"><?= date('Y-m-d H:i:s', $once['addtime']) ?></td>
									<td style="min-width: 120px"><?= $once['hao1'] ?></td>
									<td style="min-width: 120px"><?= $once['hao2'] ?></td>
									<td style="min-width: 120px"><?= $once['hao3'] ?></td>
									<td style="min-width: 120px"><?= $once['hao4'] ?></td>
									<td style="min-width: 120px"><?= $once['hao5'] ?></td>
									<td style="min-width: 120px"><?= $once['hao6'] ?></td>
									<td style="min-width: 120px"><?= $once['hao7'] ?></td>
									<td style="min-width: 120px"><?= $once['hao8'] ?></td>
									<td style="min-width: 120px"><?= $once['hao9'] ?></td>
									<td style="min-width: 120px"><?= $once['hao10'] ?></td>
									<td style="min-width: 120px"><?= $once['hao11'] ?></td>
									<td style="min-width: 120px"><?= $once['hao12'] ?></td>
									<td style="min-width: 120px"><?= $once['hao13'] ?></td>
									<td style="min-width: 120px"><?= $once['hao14'] ?></td>
									<td style="min-width: 120px"><?= $once['hao15'] ?></td>
									<td style="min-width: 120px"><?= $once['hao16'] ?></td>
									<td style="min-width: 120px"><?= $once['hao17'] ?></td>
									<td style="min-width: 120px"><?= $once['hao18'] ?></td>
									<td style="min-width: 120px"><?= $once['hao19'] ?></td>
									<td style="min-width: 120px"><?= $once['hao20'] ?></td>
									<td style="min-width: 120px"><?= $once['hao21'] ?></td>
									<td style="min-width: 120px"><?= $once['hao22'] ?></td>
									<td style="min-width: 120px"><?= $once['hao23'] ?></td>
									<td style="min-width: 120px"><?= $once['hao24'] ?></td>
									<td style="min-width: 120px"><?= $once['hao25'] ?></td>
									<td style="min-width: 120px"><?= $once['hao26'] ?></td>
									<td style="min-width: 120px"><?= $once['hao27'] ?></td>
									<td style="min-width: 120px"><?= $once['hao28'] ?></td>
									<td style="min-width: 120px"><?= $once['hao29'] ?></td>
									<td style="min-width: 120px"><?= $once['hao30'] ?></td>
									<td style="min-width: 120px"><?= $once['hao31'] ?></td>
                                    <td style="min-width: 120px" class="td-manage">
                                        <button class="layui-btn layui-btn-danger"
                                                onclick="label_delete('<?= $once['id'] ?>')"><i class="layui-icon">&#xe640;</i>删除
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="52" style="text-align: center;">暂无数据</td>
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
