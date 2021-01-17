<!doctype html>
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
    <script type="text/javascript" src="<?= STA ?>/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?= STA ?>/js/xadmin.js"></script>
    <script type="text/javascript" src="<?= STA ?>/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="<?= STA ?>/js/jquery.validate.js"></script>
    <script type="text/javascript" src="<?= STA ?>/js/upload/jquery_form.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form method="post" class="layui-form layui-form-pane" id="tab">
            <div class="layui-form-item layui-form-text">
                <label for="desc" class="layui-form-label">
                    支付单号
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="暂无提交支付单号" id="number" name="number" class="layui-textarea"
                              lay-verify="number"><?php echo $number ?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label for="desc" class="layui-form-label">
                    订单金额
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="暂无提交订单金额" id="price" name="price" class="layui-textarea"
                              lay-verify="price"><?= $price ?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label for="desc" class="layui-form-label">
                    优惠券金额
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="暂无提交优惠券金额" id="preferential_price" name="preferential_price" class="layui-textarea"
                              lay-verify="preferential_price"><?php echo $preferential_price ?></textarea>
                </div>
            </div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					预约时间
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交预约时间" id="appointment_time" name="appointment_time" class="layui-textarea"
							  lay-verify="appointment_time"><?= date('Y-m-d H:i:s', $appointment_time) ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					接单时间
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交接单时间" id="getorder_time" name="getorder_time" class="layui-textarea"
							  lay-verify="getorder_time"><?= empty($getorder_time)?'暂无数据':date('Y-m-d H:i:s', $getorder_time) ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					上车时间
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交上车时间" id="takeup_time" name="takeup_time" class="layui-textarea"
							  lay-verify="takeup_time"><?= empty($takeup_time)?'暂无数据':date('Y-m-d H:i:s', $takeup_time) ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					完成时间
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交完成时间" id="complete_time" name="complete_time" class="layui-textarea"
							  lay-verify="complete_time"><?= empty($complete_time)?'暂无数据':date('Y-m-d H:i:s', $complete_time) ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					订单备注
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交订单备注" id="remarks" name="remarks" class="layui-textarea"
							  lay-verify="remarks"><?php echo $remarks ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					总公里
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交总公里" id="distribution_km" name="distribution_km" class="layui-textarea"
							  lay-verify="distribution_km"><?php echo $distribution_km ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					小费金额
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交小费金额" id="tip_price" name="tip_price" class="layui-textarea"
							  lay-verify="tip_price"><?php echo $tip_price ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					订单评价
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交订单评价" id="order_evaluation" name="order_evaluation" class="layui-textarea"
							  lay-verify="order_evaluation"><?php echo $order_evaluation ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					出发地址
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交出发地址" id="address1" name="address1" class="layui-textarea"
							  lay-verify="address1"><?php echo $address1 ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					目的地址
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交目的地址" id="address2" name="address2" class="layui-textarea"
							  lay-verify="address2"><?php echo $address2 ?></textarea>
				</div>
			</div>
<!--            <div class="layui-form-item layui-form-text">-->
<!--                <label for="desc" class="layui-form-label">-->
<!--                    完成截图-->
<!--                </label>-->
<!--                <div class="layui-input-block">-->
<!--					<img src="http://ryks.ychlkj.cn/--><?//= $img_cards_face ?><!--" style="width: 282px;height: 282px;">-->
<!--					<img src="http://ryks.ychlkj.cn/--><?//= $img_cards_side ?><!--" style="width: 282px;height: 282px;">-->
<!--					<img src="http://ryks.ychlkj.cn/--><?//= $img_drivers ?><!--" style="width: 282px;height: 282px;">-->
<!--					<img src="http://ryks.ychlkj.cn/--><?//= $img_vehicle ?><!--" style="width: 282px;height: 282px;">-->
<!--                </div>-->
<!--            </div>-->
        </form>
    </div>
</div>
</body>
</html>
