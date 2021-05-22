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
					物品名称
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交物品名称" id="goods_name" name="goods_name" class="layui-textarea"
							  lay-verify="goods_name"><?= $goods_name ?></textarea>
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
					取件时间
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交取件时间" id="takegoods_time" name="takegoods_time" class="layui-textarea"
							  lay-verify="takegoods_time"><?= empty($takegoods_time)?'暂无数据':date('Y-m-d H:i:s', $takegoods_time) ?></textarea>
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
					物品备注
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交物品备注" id="goods_remarks" name="goods_remarks" class="layui-textarea"
							  lay-verify="goods_remarks"><?php echo $goods_remarks ?></textarea>
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
					保价金额
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交保价金额" id="protect_price" name="protect_price" class="layui-textarea"
							  lay-verify="protect_price"><?php echo $protect_price ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					订单评价
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交订单评价" id="evaluate" name="evaluate" class="layui-textarea"
							  lay-verify="evaluate"><?php echo $evaluate ?></textarea>
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
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					收货人姓名
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交收货人姓名" id="name" name="name" class="layui-textarea"
							  lay-verify="name"><?php echo $name ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					收货人电话
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交收货人电话" id="tel" name="tel" class="layui-textarea"
							  lay-verify="tel"><?php echo $tel ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					平台抽成费用
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交平台抽成费用" id="cost_price" name="cost_price" class="layui-textarea"
							  lay-verify="cost_price"><?php echo $cost_price ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					司机费用
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交司机费用" id="order_driver_price" name="order_driver_price" class="layui-textarea"
							  lay-verify="order_driver_price"><?php echo $order_driver_price ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					抽成比例
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交抽成比例" id="cost_num" name="cost_num" class="layui-textarea"
							  lay-verify="cost_num"><?php echo $cost_num ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					取货码
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交取货码" id="pick_up_code" name="pick_up_code" class="layui-textarea"
							  lay-verify="pick_up_code"><?php echo $pick_up_code ?></textarea>
				</div>
			</div>
			<?php if (!empty($img1) && !empty($img2) && !empty($img3)){ ?>
				<div class="layui-form-item layui-form-text">
					<label for="desc" class="layui-form-label">
						物品照片
					</label>
					<div class="layui-input-block">
						<img src="https://ryks.dltqwy.com/<?php echo $img1 ?>" style="width: 282px;height: 282px;">
						<img src="https://ryks.dltqwy.com/<?php echo $img2 ?>" style="width: 282px;height: 282px;">
						<img src="https://ryks.dltqwy.com/<?php echo $img3 ?>" style="width: 282px;height: 282px;">
					</div>
				</div>
			<?php } ?>
        </form>
    </div>
</div>
</body>
</html>
