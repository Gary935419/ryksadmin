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
	<script type="text/javascript" src="<?= STA ?>/lib/layui/layui.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?= STA ?>/js/xadmin.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/upload/jquery_form.js"></script>
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body" style="overflow-x: auto; overflow-y: auto; width:95%;">
					<form method="post" class="layui-form" style="margin-top: 15px" action="" name="basic_validate" id="tab">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
							<th>规格\色号</th>
							<?php foreach ($list as $k=>$v){ ?>
								<th><?= $v ?></th>
							<?php } ?>
							<th>合计</th>
                        </thead>
                        <tbody>
						<?php foreach ($list1 as $k=>$v){ ?>
							<tr id="div1">
								<td>
									<span><?= $v['sehao'] ?></span>
								</td>
								<td>
									<span><?= empty($v['shuzhi0'])?"":$v['shuzhi0'] ?></span>
								</td>
								<td>
									<span><?= empty($v['shuzhi1'])?"":$v['shuzhi1'] ?></span>
								</td>
								<td>
									<span><?= empty($v['shuzhi2'])?"":$v['shuzhi2'] ?></span>
								</td>
								<td>
									<span><?= empty($v['shuzhi3'])?"":$v['shuzhi3'] ?></span>
								</td>
								<td>
									<span><?= empty($v['shuzhi4'])?"":$v['shuzhi4'] ?></span>
								</td>
								<td>
									<span><?= empty($v['shuzhi5'])?"":$v['shuzhi5'] ?></span>
								</td>
								<td>
									<span><?= empty($v['shuzhi6'])?"":$v['shuzhi6'] ?></span>
								</td>
								<td>
									<span><?= empty($v['shuzhi7'])?"":$v['shuzhi7'] ?></span>
								</td>
								<td>
									<span><?= empty($v['shuzhi8'])?"":$v['shuzhi8'] ?></span>
								</td>
								<td>
									<span><?= empty($v['shuzhi9'])?"":$v['shuzhi9'] ?></span>
								</td>
								<td>
									<span><?= empty($v['shuzhi10'])?"":$v['shuzhi10'] ?></span>
								</td>
								<td>
									<span><?= empty($v['shuzhi11'])?"":$v['shuzhi11'] ?></span>
								</td>
								<td>
									<span><?= $v['heji'] ?></span>
								</td>
							</tr>
						<?php } ?>
						<tr id="div1">
							<td>
								<span>合计</span>
							</td>
							<td>
								<span><?php echo empty($shuzhi0)?0:$shuzhi0 ?></span>
							</td>
							<td>
								<span><?php echo empty($shuzhi1)?0:$shuzhi1 ?></span>
							</td>
							<td>
								<span><?php echo empty($shuzhi2)?0:$shuzhi2 ?></span>
							</td>
							<td>
								<span><?php echo empty($shuzhi3)?0:$shuzhi3 ?></span>
							</td>
							<td>
								<span><?php echo empty($shuzhi4)?0:$shuzhi4 ?></span>
							</td>
							<td>
								<span><?php echo empty($shuzhi5)?0:$shuzhi5 ?></span>
							</td>
							<td>
								<span><?php echo empty($shuzhi6)?0:$shuzhi6 ?></span>
							</td>
							<td>
								<span><?php echo empty($shuzhi7)?0:$shuzhi7 ?></span>
							</td>
							<td>
								<span><?php echo empty($shuzhi8)?0:$shuzhi8 ?></span>
							</td>
							<td>
								<span><?php echo empty($shuzhi9)?0:$shuzhi9 ?></span>
							</td>
							<td>
								<span><?php echo empty($shuzhi10)?0:$shuzhi10 ?></span>
							</td>
							<td>
								<span><?php echo empty($shuzhi11)?0:$shuzhi11 ?></span>
							</td>
							<td>
								<span><?php echo empty($shuzhi12)?0:$shuzhi12 ?></span>
							</td>
						</tr>
                        </tbody>
                    </table>
					</form>
				</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
