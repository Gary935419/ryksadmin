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
<!--<div class="x-nav">-->
<!--          <span class="layui-breadcrumb">-->
<!--            <a>-->
<!--              <cite>生产计划列表</cite></a>-->
<!--          </span>-->
<!--</div>-->
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
<!--                    <form class="layui-form layui-col-space5" method="get" action="--><?//= RUN, '/goods/goods_list_shengchan' ?><!--">-->
<!--                        <div class="layui-inline layui-show-xs-block">-->
<!--                            <input type="text" name="gname" id="gname" value="--><?php //echo $gname ?><!--"-->
<!--                                   placeholder="制品番号或者品名" autocomplete="off" class="layui-input">-->
<!--                        </div>-->
						<!--<div class="layui-inline layui-show-xs-block">-->
						<!--	<input type="text" name="jihuariqi" id="jihuariqi" value="<?php echo $jihuariqi ?>"-->
						<!--		   placeholder="计划日期" autocomplete="off" class="layui-input">-->
						<!--</div>-->
						<input type="hidden" name="zuname" id="zuname" value="<?php echo $zuname ?>">
                        <div class="layui-inline layui-show-xs-block">
							<a href="<?php echo $excelwendang ?>">
								<button class="layui-btn layui-card-header" style="float: right;margin-left: 20px;">
									<i class="iconfont">&#xe74a;</i> 下载
								</button>
							</a>
                        </div>
<!--                    </form>-->
                </div>
				<!--<button class="layui-btn layui-card-header" style="float: right;"-->
				<!--		onclick="xadmin.open('导出','<?= RUN . '/goods/shengchan_excel' ?>',900,500)">-->
				<!--	<i class="iconfont">&#xe74a;</i> 导出-->
				<!--</button>-->
                <div class="layui-card-body" style="overflow-x: auto; overflow-y: auto; width:93%;">
                    <table class="layui-table layui-form" style="text-align:center">
                        <thead style="text-align:center">
                        <tr>
                            <th style="min-width: 50px;text-align:center">时间</th>
                            <th style="min-width: 100px">款号</th>
                            <th style="min-width: 100px">客户</th>
                            <th style="min-width: 50px">数量</th>
							<th style="min-width: 80px">交期</th>
							<th>上月</th>
							<th>1</th>
							<th>2</th>
							<th>3</th>
							<th>4</th>
							<th>5</th>
							<th>6</th>
							<th>7</th>
							<th>8</th>
							<th>9</th>
							<th>10</th>
							<th>11</th>
							<th>12</th>
							<th>13</th>
							<th>14</th>
							<th>15</th>
							<th>16</th>
							<th>17</th>
							<th>18</th>
							<th>19</th>
							<th>20</th>
							<th>21</th>
							<th>22</th>
							<th>23</th>
							<th>24</th>
							<th>25</th>
							<th>26</th>
							<th>27</th>
							<th>28</th>
							<th>29</th>
							<th>30</th>
							<th>31</th>
							<th style="min-width: 50px">合计</th>
							<th style="min-width: 50px">增减</th>
							<th style="min-width: 50px">说明</th>
							<th style="min-width: 50px">单价</th>
                        </thead>
                        <tbody>
                            
                        <?php if (isset($list) && !empty($list)) { ?>
                            <?php 
                            
                            //print_r($list);
                            //exit();
                            foreach ($list as $num => $once): ?>
                                <tr id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>" >
									<?php if ($once['zhipinfanhao'] == "产值"){ ?>
										<td style="min-width: 50px"></td>
										<td style="min-width: 100px"><?= $once['zhipinfanhao'] ?></td>
										<td style="min-width: 100px"></td>
										<td style="min-width: 50px"></td>
										<td style="min-width: 80px"></td>
										<td></td>
										<?php $chazhis=0;for($ii=1;$ii<32;$ii++){ ?>
								             <td>
        								        <?php 
        								        $chazhi=getchanzhi('y'.$ii,$list);
            								    $chazhis=$chazhis+$chazhi;
            								    echo $chazhi;
        								        ?>
    								        </td> 
								        <?php }?>
    									<td><?php echo $chazhis; ?></td>
    									<td></td>
    									<td></td>
    									<td></td>
									<?php }else{ ?>
										<td style="min-width: 50px"><?= $once['jihuariqi'] ?></td>
										<td style="min-width: 100px"><?= $once['zhipinfanhao'] ?></td>
										<td style="min-width: 100px"><?= $once['pinming'] ?></td>
										<td style="min-width: 50px"><?= $once['qihuashu'] ?></td>
										<td style="min-width: 80px"><?= date('Y-m-d', $once['naqi']) ?></td>
										<td><?= $once['shangyue'] ?></td>
										<td><?= $once['y1'] ?></td>
									<td><?= $once['y2'] ?></td>
									<td><?= $once['y3'] ?></td>
									<td><?= $once['y4'] ?></td>
									<td><?= $once['y5'] ?></td>
									<td><?= $once['y6'] ?></td>
									<td><?= $once['y7'] ?></td>
									<td><?= $once['y8'] ?></td>
									<td><?= $once['y9'] ?></td>
									<td><?= $once['y10'] ?></td>
									<td><?= $once['y11'] ?></td>
									<td><?= $once['y12'] ?></td>
									<td><?= $once['y13'] ?></td>
									<td><?= $once['y14'] ?></td>
									<td><?= $once['y15'] ?></td>
									<td><?= $once['y16'] ?></td>
									<td><?= $once['y17'] ?></td>
									<td><?= $once['y18'] ?></td>
									<td><?= $once['y19'] ?></td>
									<td><?= $once['y20'] ?></td>
									<td><?= $once['y21'] ?></td>
									<td><?= $once['y22'] ?></td>
									<td><?= $once['y23'] ?></td>
									<td><?= $once['y24'] ?></td>
									<td><?= $once['y25'] ?></td>
									<td><?= $once['y26'] ?></td>
									<td><?= $once['y27'] ?></td>
									<td><?= $once['y28'] ?></td>
									<td><?= $once['y29'] ?></td>
									<td><?= $once['y30'] ?></td>
									<td><?= $once['y31'] ?></td>
									<td><?= $once['heji'] ?></td>
									<td><?= $once['zengjian'] ?></td>
									<td><?= $once['shuoming'] ?></td>
									<td><?= $once['danjia'] ?></td>
									<?php } ?>

									
          <!--                          <td class="td-manage">-->
          <!--                              <button class="layui-btn layui-btn-normal"-->
          <!--                                      onclick="xadmin.open('编辑','<?= RUN . '/goods/goods_edit_new_shengchan?id=' ?>'+'<?= $once['id'] ?>')">-->
          <!--                                  <i class="layui-icon">&#xe642;</i>编辑-->
          <!--                              </button>-->
          <!--                              <button class="layui-btn layui-btn-danger"-->
          <!--                                      onclick="goods_delete('<?= $once['id'] ?>')"><i class="layui-icon">&#xe640;</i>删除-->
          <!--                              </button>-->
										<!--<button class="layui-btn layui-btn-normal"-->
										<!--		onclick="xadmin.open('设定','<?= RUN . '/goods/goods_edit_jichu_shengchan?id=' ?>'+'<?= $once['id'] ?>')">-->
										<!--	<i class="layui-icon">&#xe642;</i>设定-->
										<!--</button>-->
										<!--<button class="layui-btn layui-btn-normal"-->
										<!--		onclick="xadmin.open('详情','<?= RUN . '/goods/goods_edit_jichu_shengchan_detail?id=' ?>'+'<?= $once['id'] ?>')">-->
										<!--	<i class="layui-icon">&#xe642;</i>详情-->
										<!--</button>-->
          <!--                          </td>-->
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
<?php 
function getchanzhi($id,$list){
    $onces=0;
    foreach ($list as $num => $once){
        if($once[$id]>0){
           $onces=$onces+$once[$id]*$once['danjia']; 
        }
    }
    return $onces;
}
?>
