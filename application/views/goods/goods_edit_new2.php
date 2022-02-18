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
				<div class="layui-card-body ">
					<table class="layui-table layui-form">
						<thead>
						<tr>
							<th>
								<div class="layui-row">
									<form method="post" class="layui-form" style="margin-top: 15px" action=""
										  name="basic_validate" id="tab">
										<div class="layui-form-item" id="div1">
											<label for="L_pass" class="layui-form-label" style="width: 5%;">
												<span class="x-red">*</span>品名
											</label>
											<div class="layui-input-inline" style="width: 56px;">
												<input name="pinming[]" lay-verify="pinming"
													   value="<?php echo $pinming1 ?>"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 5%;">
												<span class="x-red">*</span>品番
											</label>
											<div class="layui-input-inline" style="width: 56px;">
												<input name="pinfan[]" lay-verify="pinfan"
													   value="<?php echo $pinfan1 ?>"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 5%;">
												<span class="x-red">*</span>色号
											</label>
											<div class="layui-input-inline" style="width: 56px;">
												<input name="sehao[]" lay-verify="sehao" value="<?php echo $sehao1 ?>"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 5%;">
												<span class="x-red">*</span>规格
											</label>
											<div class="layui-input-inline" style="width: 56px;">
												<input name="guige[]" lay-verify="guige" value="<?php echo $guige1 ?>"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 5%;">
												<span class="x-red">*</span>单位
											</label>
											<div class="layui-input-inline" style="width: 56px;">
												<input name="danwei[]" lay-verify="danwei"
													   value="<?php echo $danwei1 ?>"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 5%;">
												<span class="x-red">*</span>提单数
											</label>
											<div class="layui-input-inline" style="width: 56px;">
												<input name="tidanshu[]" lay-verify="tidanshu"
													   value="<?php echo $tidanshu1 ?>"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 5%;">
												<span class="x-red">*</span>请点数
											</label>
											<div class="layui-input-inline" style="width: 56px;">
												<input name="qingdianshu[]" lay-verify="qingdianshu"
													   value="<?php echo $qingdianshu1 ?>"
													   autocomplete="off" class="layui-input">
											</div>
										</div>
										<div class="layui-form-item" id="div11">
											<label for="L_pass" class="layui-form-label" style="width: 5%;">
												<span class="x-red">*</span>样指示
											</label>
											<div class="layui-input-inline" style="width: 56px;">
												<input name="yangzhishi[]" lay-verify="yangzhishi"
													   value="<?php echo $yangzhishi1 ?>"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 5%;">
												<span class="x-red">*</span>实际
											</label>
											<div class="layui-input-inline" style="width: 56px;">
												<input name="shiji[]" lay-verify="shiji" value="<?php echo $shiji1 ?>"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 5%;">
												<span class="x-red">*</span>损耗
											</label>
											<div class="layui-input-inline" style="width: 56px;">
												<input name="sunhao[]" lay-verify="sunhao"
													   value="<?php echo $sunhao1 ?>"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 5%;">
												<span class="x-red">*</span>件数
											</label>
											<div class="layui-input-inline" style="width: 56px;">
												<input name="jianshu[]" lay-verify="jianshu"
													   value="<?php echo $jianshu1 ?>"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 5%;">
												<span class="x-red">*</span>增减数量
											</label>
											<div class="layui-input-inline" style="width: 56px;">
												<input name="sunhaoyongliang[]" lay-verify="sunhaoyongliang"
													   value="<?php echo $sunhaoyongliang1 ?>"
													   autocomplete="off" class="layui-input">
											</div>
											<label for="L_pass" class="layui-form-label" style="width: 5%;">
												<span class="x-red">*</span>到料日
											</label>
											<div class="layui-input-inline" style="width: 56px;">
												<input name="daoliaori[]" lay-verify="daoliaori"
													   value="<?php echo $daoliaori1 ?>"
													   autocomplete="off" class="layui-input">
											</div>
											<?php if (!empty($guige1) && empty($guige2)) { ?>
												<i class="layui-icon" id="divadd1"
												   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
												   onclick="return addnow(2,1)"></i>
											<?php } else { ?>
												<i class="layui-icon" id="divadd1"
												   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
												   onclick="return addnow(2,1)"></i>
											<?php } ?>
										</div>

										<?php if (empty($guige2)){ ?>
										<div class="layui-form-item" id="div2" style="display: none;">
											<?php }else{ ?>
											<div class="layui-form-item" id="div2" style="display: block;">
												<?php } ?>
												<label for="L_pass" class="layui-form-label" style="width: 5%;">
													<span class="x-red">*</span>品名
												</label>
												<div class="layui-input-inline" style="width: 56px;">
													<input name="pinming[]" id="val2" lay-verify="pinming"
														   value="<?php echo $pinming2 ?>"
														   autocomplete="off" class="layui-input">
												</div>
												<label for="L_pass" class="layui-form-label" style="width: 5%;">
													<span class="x-red">*</span>品番
												</label>
												<div class="layui-input-inline" style="width: 56px;">
													<input name="pinfan[]" id="val22" lay-verify="pinfan"
														   value="<?php echo $pinfan2 ?>"
														   autocomplete="off" class="layui-input">
												</div>
												<label for="L_pass" class="layui-form-label" style="width: 5%;">
													<span class="x-red">*</span>色号
												</label>
												<div class="layui-input-inline" style="width: 56px;">
													<input name="sehao[]" id="val222" lay-verify="sehao"
														   value="<?php echo $sehao2 ?>"
														   autocomplete="off" class="layui-input">
												</div>
												<label for="L_pass" class="layui-form-label" style="width: 5%;">
													<span class="x-red">*</span>规格
												</label>
												<div class="layui-input-inline" style="width: 56px;">
													<input name="guige[]" id="val2222" lay-verify="guige"
														   value="<?php echo $guige2 ?>"
														   autocomplete="off" class="layui-input">
												</div>
												<label for="L_pass" class="layui-form-label" style="width: 5%;">
													<span class="x-red">*</span>单位
												</label>
												<div class="layui-input-inline" style="width: 56px;">
													<input name="danwei[]" id="val22222" lay-verify="danwei"
														   value="<?php echo $danwei2 ?>"
														   autocomplete="off" class="layui-input">
												</div>
												<label for="L_pass" class="layui-form-label" style="width: 5%;">
													<span class="x-red">*</span>提单数
												</label>
												<div class="layui-input-inline" style="width: 56px;">
													<input name="tidanshu[]" id="val222222" lay-verify="tidanshu"
														   value="<?php echo $tidanshu2 ?>"
														   autocomplete="off" class="layui-input">
												</div>
												<label for="L_pass" class="layui-form-label" style="width: 5%;">
													<span class="x-red">*</span>请点数
												</label>
												<div class="layui-input-inline" style="width: 56px;">
													<input name="qingdianshu[]" id="val2222222"
														   lay-verify="qingdianshu"
														   value="<?php echo $qingdianshu2 ?>"
														   autocomplete="off" class="layui-input">
												</div>
											</div>
											<?php if (empty($guige2)){ ?>
											<div class="layui-form-item" id="div22" style="display: none;">
												<?php }else{ ?>
												<div class="layui-form-item" id="div22" style="display: block;">
													<?php } ?>
													<label for="L_pass" class="layui-form-label" style="width: 5%;">
														<span class="x-red">*</span>样指示
													</label>
													<div class="layui-input-inline" style="width: 56px;">
														<input name="yangzhishi[]" id="val22222222"
															   lay-verify="yangzhishi"
															   value="<?php echo $yangzhishi2 ?>"
															   autocomplete="off" class="layui-input">
													</div>
													<label for="L_pass" class="layui-form-label" style="width: 5%;">
														<span class="x-red">*</span>实际
													</label>
													<div class="layui-input-inline" style="width: 56px;">
														<input name="shiji[]" id="val222222222" lay-verify="shiji"
															   value="<?php echo $shiji2 ?>"
															   autocomplete="off" class="layui-input">
													</div>
													<label for="L_pass" class="layui-form-label"
														   style="width: 5%;">
														<span class="x-red">*</span>损耗
													</label>
													<div class="layui-input-inline" style="width: 56px;">
														<input name="sunhao[]" id="val2222222222"
															   lay-verify="sunhao"
															   value="<?php echo $sunhao2 ?>"
															   autocomplete="off" class="layui-input">
													</div>
													<label for="L_pass" class="layui-form-label"
														   style="width: 5%;">
														<span class="x-red">*</span>件数
													</label>
													<div class="layui-input-inline" style="width: 56px;">
														<input name="jianshu[]" id="val22222222222"
															   lay-verify="jianshu"
															   value="<?php echo $jianshu2 ?>"
															   autocomplete="off" class="layui-input">
													</div>
													<label for="L_pass" class="layui-form-label"
														   style="width: 5%;">
														<span class="x-red">*</span>增减数量
													</label>
													<div class="layui-input-inline" style="width: 56px;">
														<input name="sunhaoyongliang[]" id="val222222222222"
															   lay-verify="sunhaoyongliang"
															   value="<?php echo $sunhaoyongliang2 ?>"
															   autocomplete="off" class="layui-input">
													</div>
													<label for="L_pass" class="layui-form-label"
														   style="width: 5%;">
														<span class="x-red">*</span>到料日
													</label>
													<div class="layui-input-inline" style="width: 56px;">
														<input name="daoliaori[]" id="val2222222222222"
															   lay-verify="daoliaori"
															   value="<?php echo $daoliaori2 ?>"
															   autocomplete="off" class="layui-input">
													</div>
													<?php if (!empty($guige2) && empty($guige3)) { ?>
														<i class="layui-icon" id="divadd2"
														   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
														   onclick="return addnow(3,2)"></i>
													<?php } else { ?>
														<i class="layui-icon" id="divadd2"
														   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
														   onclick="return addnow(3,2)"></i>
													<?php } ?>
													<i class="iconfont"
													   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
													   onclick="return dellete(2,1)">&#xe6fe;</i>
												</div>


												<?php if (empty($guige3)){ ?>
												<div class="layui-form-item" id="div3"
													 style="display: none;">
													<?php }else{ ?>
													<div class="layui-form-item" id="div3"
														 style="display: block;">
														<?php } ?>
														<label for="L_pass" class="layui-form-label"
															   style="width: 5%;">
															<span class="x-red">*</span>品名
														</label>
														<div class="layui-input-inline"
															 style="width: 56px;">
															<input name="pinming[]" id="val3"
																   lay-verify="pinming"
																   value="<?php echo $pinming3 ?>"
																   autocomplete="off" class="layui-input">
														</div>
														<label for="L_pass" class="layui-form-label"
															   style="width: 5%;">
															<span class="x-red">*</span>品番
														</label>
														<div class="layui-input-inline"
															 style="width: 56px;">
															<input name="pinfan[]" id="val33"
																   lay-verify="pinfan"
																   value="<?php echo $pinfan3 ?>"
																   autocomplete="off" class="layui-input">
														</div>
														<label for="L_pass" class="layui-form-label"
															   style="width: 5%;">
															<span class="x-red">*</span>色号
														</label>
														<div class="layui-input-inline"
															 style="width: 56px;">
															<input name="sehao[]" id="val333"
																   lay-verify="sehao"
																   value="<?php echo $sehao3 ?>"
																   autocomplete="off" class="layui-input">
														</div>
														<label for="L_pass" class="layui-form-label"
															   style="width: 5%;">
															<span class="x-red">*</span>规格
														</label>
														<div class="layui-input-inline"
															 style="width: 56px;">
															<input name="guige[]" id="val3333"
																   lay-verify="guige"
																   value="<?php echo $guige3 ?>"
																   autocomplete="off"
																   class="layui-input">
														</div>
														<label for="L_pass" class="layui-form-label"
															   style="width: 5%;">
															<span class="x-red">*</span>单位
														</label>
														<div class="layui-input-inline"
															 style="width: 56px;">
															<input name="danwei[]" id="val33333"
																   lay-verify="danwei"
																   value="<?php echo $danwei3 ?>"
																   autocomplete="off"
																   class="layui-input">
														</div>
														<label for="L_pass" class="layui-form-label"
															   style="width: 5%;">
															<span class="x-red">*</span>提单数
														</label>
														<div class="layui-input-inline"
															 style="width: 56px;">
															<input name="tidanshu[]" id="val333333"
																   lay-verify="tidanshu"
																   value="<?php echo $tidanshu3 ?>"
																   autocomplete="off"
																   class="layui-input">
														</div>
														<label for="L_pass" class="layui-form-label"
															   style="width: 5%;">
															<span class="x-red">*</span>请点数
														</label>
														<div class="layui-input-inline"
															 style="width: 56px;">
															<input name="qingdianshu[]"
																   id="val3333333"
																   lay-verify="qingdianshu"
																   value="<?php echo $qingdianshu3 ?>"
																   autocomplete="off"
																   class="layui-input">
														</div>
													</div>
													<?php if (empty($guige3)){ ?>
													<div class="layui-form-item" id="div33"
														 style="display: none;">
														<?php }else{ ?>
														<div class="layui-form-item" id="div33"
															 style="display: block;">
															<?php } ?>
															<label for="L_pass" class="layui-form-label"
																   style="width: 5%;">
																<span class="x-red">*</span>样指示
															</label>
															<div class="layui-input-inline"
																 style="width: 56px;">
																<input name="yangzhishi[]"
																	   id="val33333333"
																	   lay-verify="yangzhishi"
																	   value="<?php echo $yangzhishi3 ?>"
																	   autocomplete="off"
																	   class="layui-input">
															</div>
															<label for="L_pass" class="layui-form-label"
																   style="width: 5%;">
																<span class="x-red">*</span>实际
															</label>
															<div class="layui-input-inline"
																 style="width: 56px;">
																<input name="shiji[]" id="val333333333"
																	   lay-verify="shiji"
																	   value="<?php echo $shiji3 ?>"
																	   autocomplete="off"
																	   class="layui-input">
															</div>
															<label for="L_pass"
																   class="layui-form-label"
																   style="width: 5%;">
																<span class="x-red">*</span>损耗
															</label>
															<div class="layui-input-inline"
																 style="width: 56px;">
																<input name="sunhao[]"
																	   id="val3333333333"
																	   value="<?php echo $sunhao3 ?>"
																	   lay-verify="sunhao"
																	   autocomplete="off"
																	   class="layui-input">
															</div>
															<label for="L_pass"
																   class="layui-form-label"
																   style="width: 5%;">
																<span class="x-red">*</span>件数
															</label>
															<div class="layui-input-inline"
																 style="width: 56px;">
																<input name="jianshu[]"
																	   id="val33333333333"
																	   lay-verify="jianshu"
																	   value="<?php echo $jianshu3 ?>"
																	   autocomplete="off"
																	   class="layui-input">
															</div>
															<label for="L_pass"
																   class="layui-form-label"
																   style="width: 5%;">
																<span class="x-red">*</span>增减数量
															</label>
															<div class="layui-input-inline"
																 style="width: 56px;">
																<input name="sunhaoyongliang[]"
																	   id="val333333333333"
																	   value="<?php echo $sunhaoyongliang3 ?>"
																	   lay-verify="sunhaoyongliang"
																	   autocomplete="off"
																	   class="layui-input">
															</div>
															<label for="L_pass"
																   class="layui-form-label"
																   style="width: 5%;">
																<span class="x-red">*</span>到料日
															</label>
															<div class="layui-input-inline"
																 style="width: 56px;">
																<input name="daoliaori[]"
																	   id="val3333333333333"
																	   value="<?php echo $daoliaori3 ?>"
																	   lay-verify="daoliaori"
																	   autocomplete="off"
																	   class="layui-input">
															</div>
															<?php if (!empty($guige3) && empty($guige4)) { ?>
																<i class="layui-icon"
																   id="divadd3"
																   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
																   onclick="return addnow(4,3)"></i>
															<?php } else { ?>
																<i class="layui-icon"
																   id="divadd3"
																   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
																   onclick="return addnow(4,3)"></i>
															<?php } ?>
															<i class="iconfont"
															   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
															   onclick="return dellete(3,2)">&#xe6fe;</i>
														</div>


														<?php if (empty($guige4)){ ?>
														<div class="layui-form-item" id="div4"
															 style="display: none;">
															<?php }else{ ?>
															<div class="layui-form-item"
																 id="div4"
																 style="display: block;">
																<?php } ?>
																<label for="L_pass"
																	   class="layui-form-label"
																	   style="width: 5%;">
																	<span class="x-red">*</span>品名
																</label>
																<div class="layui-input-inline"
																	 style="width: 56px;">
																	<input name="pinming[]"
																		   id="val4"
																		   lay-verify="pinming"
																		   value="<?php echo $pinming4 ?>"
																		   autocomplete="off"
																		   class="layui-input">
																</div>
																<label for="L_pass"
																	   class="layui-form-label"
																	   style="width: 5%;">
																	<span class="x-red">*</span>品番
																</label>
																<div class="layui-input-inline"
																	 style="width: 56px;">
																	<input name="pinfan[]"
																		   id="val44"
																		   lay-verify="pinfan"
																		   value="<?php echo $pinfan4 ?>"
																		   autocomplete="off"
																		   class="layui-input">
																</div>
																<label for="L_pass"
																	   class="layui-form-label"
																	   style="width: 5%;">
																	<span class="x-red">*</span>色号
																</label>
																<div class="layui-input-inline"
																	 style="width: 56px;">
																	<input name="sehao[]"
																		   id="val444"
																		   lay-verify="sehao"
																		   value="<?php echo $sehao4 ?>"
																		   autocomplete="off"
																		   class="layui-input">
																</div>
																<label for="L_pass"
																	   class="layui-form-label"
																	   style="width: 5%;">
																	<span class="x-red">*</span>规格
																</label>
																<div class="layui-input-inline"
																	 style="width: 56px;">
																	<input name="guige[]"
																		   id="val4444"
																		   lay-verify="guige"
																		   value="<?php echo $guige4 ?>"
																		   autocomplete="off"
																		   class="layui-input">
																</div>
																<label for="L_pass"
																	   class="layui-form-label"
																	   style="width: 5%;">
																	<span class="x-red">*</span>单位
																</label>
																<div class="layui-input-inline"
																	 style="width: 56px;">
																	<input name="danwei[]"
																		   id="val44444"
																		   lay-verify="danwei"
																		   value="<?php echo $danwei4 ?>"
																		   autocomplete="off"
																		   class="layui-input">
																</div>
																<label for="L_pass"
																	   class="layui-form-label"
																	   style="width: 5%;">
																	<span class="x-red">*</span>提单数
																</label>
																<div class="layui-input-inline"
																	 style="width: 56px;">
																	<input name="tidanshu[]"
																		   id="val444444"
																		   value="<?php echo $tidanshu4 ?>"
																		   lay-verify="tidanshu"
																		   autocomplete="off"
																		   class="layui-input">
																</div>
																<label for="L_pass"
																	   class="layui-form-label"
																	   style="width: 5%;">
																	<span class="x-red">*</span>请点数
																</label>
																<div class="layui-input-inline"
																	 style="width: 56px;">
																	<input name="qingdianshu[]"
																		   id="val4444444"
																		   lay-verify="qingdianshu"
																		   value="<?php echo $qingdianshu4 ?>"
																		   autocomplete="off"
																		   class="layui-input">
																</div>
															</div>
															<?php if (empty($guige4)){ ?>
															<div class="layui-form-item"
																 id="div44"
																 style="display: none;">
																<?php }else{ ?>
																<div class="layui-form-item"
																	 id="div44"
																	 style="display: block;">
																	<?php } ?>
																	<label for="L_pass"
																		   class="layui-form-label"
																		   style="width: 5%;">
																		<span class="x-red">*</span>样指示
																	</label>
																	<div class="layui-input-inline"
																		 style="width: 56px;">
																		<input name="yangzhishi[]"
																			   id="val44444444"
																			   lay-verify="yangzhishi"
																			   value="<?php echo $yangzhishi4 ?>"
																			   autocomplete="off"
																			   class="layui-input">
																	</div>
																	<label for="L_pass"
																		   class="layui-form-label"
																		   style="width: 5%;">
																		<span class="x-red">*</span>实际
																	</label>
																	<div class="layui-input-inline"
																		 style="width: 56px;">
																		<input name="shiji[]"
																			   id="val444444444"
																			   lay-verify="shiji"
																			   value="<?php echo $shiji4 ?>"
																			   autocomplete="off"
																			   class="layui-input">
																	</div>
																	<label for="L_pass"
																		   class="layui-form-label"
																		   style="width: 5%;">
																		<span class="x-red">*</span>损耗
																	</label>
																	<div class="layui-input-inline"
																		 style="width: 56px;">
																		<input name="sunhao[]"
																			   id="val4444444444"
																			   lay-verify="sunhao"
																			   autocomplete="off"
																			   value="<?php echo $sunhao4 ?>"
																			   class="layui-input">
																	</div>
																	<label for="L_pass"
																		   class="layui-form-label"
																		   style="width: 5%;">
																		<span class="x-red">*</span>件数
																	</label>
																	<div class="layui-input-inline"
																		 style="width: 56px;">
																		<input name="jianshu[]"
																			   id="val44444444444"
																			   lay-verify="jianshu"
																			   value="<?php echo $jianshu4 ?>"
																			   autocomplete="off"
																			   class="layui-input">
																	</div>
																	<label for="L_pass"
																		   class="layui-form-label"
																		   style="width: 5%;">
																		<span class="x-red">*</span>增减数量
																	</label>
																	<div class="layui-input-inline"
																		 style="width: 56px;">
																		<input name="sunhaoyongliang[]"
																			   id="val444444444444"
																			   value="<?php echo $sunhaoyongliang4 ?>"
																			   lay-verify="sunhaoyongliang"
																			   autocomplete="off"
																			   class="layui-input">
																	</div>
																	<label for="L_pass"
																		   class="layui-form-label"
																		   style="width: 5%;">
																		<span class="x-red">*</span>到料日
																	</label>
																	<div class="layui-input-inline"
																		 style="width: 56px;">
																		<input name="daoliaori[]"
																			   id="val4444444444444"
																			   value="<?php echo $daoliaori4 ?>"
																			   lay-verify="daoliaori"
																			   autocomplete="off"
																			   class="layui-input">
																	</div>
																	<?php if (!empty($guige4) && empty($guige5)) { ?>
																		<i class="layui-icon"
																		   id="divadd4"
																		   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
																		   onclick="return addnow(5,4)"></i>
																	<?php } else { ?>
																		<i class="layui-icon"
																		   id="divadd4"
																		   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
																		   onclick="return addnow(5,4)"></i>
																	<?php } ?>
																	<i class="iconfont"
																	   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
																	   onclick="return dellete(4,3)">&#xe6fe;</i>
																</div>


																<?php if (empty($guige5)){ ?>
																<div class="layui-form-item"
																	 id="div5"
																	 style="display: none;">
																	<?php }else{ ?>
																	<div class="layui-form-item"
																		 id="div5"
																		 style="display: block;">
																		<?php } ?>
																		<label for="L_pass"
																			   class="layui-form-label"
																			   style="width: 5%;">
																			<span class="x-red">*</span>品名
																		</label>
																		<div class="layui-input-inline"
																			 style="width: 56px;">
																			<input name="pinming[]"
																				   id="val5"
																				   lay-verify="pinming"
																				   value="<?php echo $pinming5 ?>"
																				   autocomplete="off"
																				   class="layui-input">
																		</div>
																		<label for="L_pass"
																			   class="layui-form-label"
																			   style="width: 5%;">
																			<span class="x-red">*</span>品番
																		</label>
																		<div class="layui-input-inline"
																			 style="width: 56px;">
																			<input name="pinfan[]"
																				   id="val55"
																				   lay-verify="pinfan"
																				   value="<?php echo $pinfan5 ?>"
																				   autocomplete="off"
																				   class="layui-input">
																		</div>
																		<label for="L_pass"
																			   class="layui-form-label"
																			   style="width: 5%;">
																			<span class="x-red">*</span>色号
																		</label>
																		<div class="layui-input-inline"
																			 style="width: 56px;">
																			<input name="sehao[]"
																				   id="val555"
																				   lay-verify="sehao"
																				   value="<?php echo $sehao5 ?>"
																				   autocomplete="off"
																				   class="layui-input">
																		</div>
																		<label for="L_pass"
																			   class="layui-form-label"
																			   style="width: 5%;">
																			<span class="x-red">*</span>规格
																		</label>
																		<div class="layui-input-inline"
																			 style="width: 56px;">
																			<input name="guige[]"
																				   id="val5555"
																				   value="<?php echo $guige5 ?>"
																				   lay-verify="guige"
																				   autocomplete="off"
																				   class="layui-input">
																		</div>
																		<label for="L_pass"
																			   class="layui-form-label"
																			   style="width: 5%;">
																			<span class="x-red">*</span>单位
																		</label>
																		<div class="layui-input-inline"
																			 style="width: 56px;">
																			<input name="danwei[]"
																				   id="val55555"
																				   value="<?php echo $danwei5 ?>"
																				   lay-verify="danwei"
																				   autocomplete="off"
																				   class="layui-input">
																		</div>
																		<label for="L_pass"
																			   class="layui-form-label"
																			   style="width: 5%;">
																			<span class="x-red">*</span>提单数
																		</label>
																		<div class="layui-input-inline"
																			 style="width: 56px;">
																			<input name="tidanshu[]"
																				   value="<?php echo $tidanshu5 ?>"
																				   id="val555555"
																				   lay-verify="tidanshu"
																				   autocomplete="off"
																				   class="layui-input">
																		</div>
																		<label for="L_pass"
																			   class="layui-form-label"
																			   style="width: 5%;">
																			<span class="x-red">*</span>请点数
																		</label>
																		<div class="layui-input-inline"
																			 style="width: 56px;">
																			<input name="qingdianshu[]"
																				   id="val5555555"
																				   value="<?php echo $qingdianshu5 ?>"
																				   lay-verify="qingdianshu"
																				   autocomplete="off"
																				   class="layui-input">
																		</div>
																	</div>
																	<?php if (empty($guige5)){ ?>
																	<div class="layui-form-item"
																		 id="div55"
																		 style="display: none;">
																		<?php }else{ ?>
																		<div class="layui-form-item"
																			 id="div55"
																			 style="display: block;">
																			<?php } ?>
																			<label for="L_pass"
																				   class="layui-form-label"
																				   style="width: 5%;">
																				<span class="x-red">*</span>样指示
																			</label>
																			<div class="layui-input-inline"
																				 style="width: 56px;">
																				<input name="yangzhishi[]"
																					   id="val55555555"
																					   value="<?php echo $yangzhishi5 ?>"
																					   lay-verify="yangzhishi"
																					   autocomplete="off"
																					   class="layui-input">
																			</div>
																			<label for="L_pass"
																				   class="layui-form-label"
																				   style="width: 5%;">
																				<span class="x-red">*</span>实际
																			</label>
																			<div class="layui-input-inline"
																				 style="width: 56px;">
																				<input name="shiji[]"
																					   id="val555555555"
																					   value="<?php echo $shiji5 ?>"
																					   lay-verify="shiji"
																					   autocomplete="off"
																					   class="layui-input">
																			</div>
																			<label for="L_pass"
																				   class="layui-form-label"
																				   style="width: 5%;">
																				<span class="x-red">*</span>损耗
																			</label>
																			<div class="layui-input-inline"
																				 style="width: 56px;">
																				<input name="sunhao[]"
																					   id="val5555555555"
																					   value="<?php echo $sunhao5 ?>"
																					   lay-verify="sunhao"
																					   autocomplete="off"
																					   class="layui-input">
																			</div>
																			<label for="L_pass"
																				   class="layui-form-label"
																				   style="width: 5%;">
																				<span class="x-red">*</span>件数
																			</label>
																			<div class="layui-input-inline"
																				 style="width: 56px;">
																				<input name="jianshu[]"
																					   value="<?php echo $jianshu5 ?>"
																					   id="val55555555555"
																					   lay-verify="jianshu"
																					   autocomplete="off"
																					   class="layui-input">
																			</div>
																			<label for="L_pass"
																				   class="layui-form-label"
																				   style="width: 5%;">
																				<span class="x-red">*</span>增减数量
																			</label>
																			<div class="layui-input-inline"
																				 style="width: 56px;">
																				<input name="sunhaoyongliang[]"
																					   id="val555555555555"
																					   value="<?php echo $sunhaoyongliang5 ?>"
																					   lay-verify="sunhaoyongliang"
																					   autocomplete="off"
																					   class="layui-input">
																			</div>
																			<label for="L_pass"
																				   class="layui-form-label"
																				   style="width: 5%;">
																				<span class="x-red">*</span>到料日
																			</label>
																			<div class="layui-input-inline"
																				 style="width: 56px;">
																				<input name="daoliaori[]"
																					   id="val5555555555555"
																					   value="<?php echo $daoliaori5 ?>"
																					   lay-verify="daoliaori"
																					   autocomplete="off"
																					   class="layui-input">
																			</div>
																			<?php if (!empty($guige5) && empty($guige6)) { ?>
																				<i class="layui-icon"
																				   id="divadd5"
																				   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
																				   onclick="return addnow(6,5)"></i>
																			<?php } else { ?>
																				<i class="layui-icon"
																				   id="divadd5"
																				   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
																				   onclick="return addnow(6,5)"></i>
																			<?php } ?>
																			<i class="iconfont"
																			   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
																			   onclick="return dellete(5,4)">&#xe6fe;</i>
																		</div>


																		<?php if (empty($guige6)){ ?>
																		<div class="layui-form-item"
																			 id="div6"
																			 style="display: none;">
																			<?php }else{ ?>
																			<div class="layui-form-item"
																				 id="div6"
																				 style="display: block;">
																				<?php } ?>
																				<label for="L_pass"
																					   class="layui-form-label"
																					   style="width: 5%;">
																					<span class="x-red">*</span>品名
																				</label>
																				<div class="layui-input-inline"
																					 style="width: 56px;">
																					<input name="pinming[]"
																						   id="val6"
																						   value="<?php echo $pinming6 ?>"
																						   lay-verify="pinming"
																						   autocomplete="off"
																						   class="layui-input">
																				</div>
																				<label for="L_pass"
																					   class="layui-form-label"
																					   style="width: 5%;">
																					<span class="x-red">*</span>品番
																				</label>
																				<div class="layui-input-inline"
																					 style="width: 56px;">
																					<input name="pinfan[]"
																						   id="val66"
																						   value="<?php echo $pinfan6 ?>"
																						   lay-verify="pinfan"
																						   autocomplete="off"
																						   class="layui-input">
																				</div>
																				<label for="L_pass"
																					   class="layui-form-label"
																					   style="width: 5%;">
																					<span class="x-red">*</span>色号
																				</label>
																				<div class="layui-input-inline"
																					 style="width: 56px;">
																					<input name="sehao[]"
																						   value="<?php echo $sehao6 ?>"
																						   id="val666"
																						   lay-verify="sehao"
																						   autocomplete="off"
																						   class="layui-input">
																				</div>
																				<label for="L_pass"
																					   class="layui-form-label"
																					   style="width: 5%;">
																					<span class="x-red">*</span>规格
																				</label>
																				<div class="layui-input-inline"
																					 style="width: 56px;">
																					<input name="guige[]"
																						   id="val6666"
																						   value="<?php echo $guige6 ?>"
																						   lay-verify="guige"
																						   autocomplete="off"
																						   class="layui-input">
																				</div>
																				<label for="L_pass"
																					   class="layui-form-label"
																					   style="width: 5%;">
																					<span class="x-red">*</span>单位
																				</label>
																				<div class="layui-input-inline"
																					 style="width: 56px;">
																					<input name="danwei[]"
																						   value="<?php echo $danwei6 ?>"
																						   id="val66666"
																						   lay-verify="danwei"
																						   autocomplete="off"
																						   class="layui-input">
																				</div>
																				<label for="L_pass"
																					   class="layui-form-label"
																					   style="width: 5%;">
																					<span class="x-red">*</span>提单数
																				</label>
																				<div class="layui-input-inline"
																					 style="width: 56px;">
																					<input name="tidanshu[]"
																						   id="val666666"
																						   value="<?php echo $tidanshu6 ?>"
																						   lay-verify="tidanshu"
																						   autocomplete="off"
																						   class="layui-input">
																				</div>
																				<label for="L_pass"
																					   class="layui-form-label"
																					   style="width: 5%;">
																					<span class="x-red">*</span>请点数
																				</label>
																				<div class="layui-input-inline"
																					 style="width: 56px;">
																					<input name="qingdianshu[]"
																						   id="val6666666"
																						   value="<?php echo $qingdianshu6 ?>"
																						   lay-verify="qingdianshu"
																						   autocomplete="off"
																						   class="layui-input">
																				</div>
																			</div>
																			<?php if (empty($guige6)){ ?>
																			<div class="layui-form-item"
																				 id="div66"
																				 style="display: none;">
																				<?php }else{ ?>
																				<div class="layui-form-item"
																					 id="div66"
																					 style="display: block;">
																					<?php } ?>
																					<label for="L_pass"
																						   class="layui-form-label"
																						   style="width: 5%;">
																						<span class="x-red">*</span>样指示
																					</label>
																					<div class="layui-input-inline"
																						 style="width: 56px;">
																						<input name="yangzhishi[]"
																							   id="val66666666"
																							   value="<?php echo $yangzhishi6 ?>"
																							   lay-verify="yangzhishi"
																							   autocomplete="off"
																							   class="layui-input">
																					</div>
																					<label for="L_pass"
																						   class="layui-form-label"
																						   style="width: 5%;">
																						<span class="x-red">*</span>实际
																					</label>
																					<div class="layui-input-inline"
																						 style="width: 56px;">
																						<input name="shiji[]"
																							   id="val666666666"
																							   value="<?php echo $shiji6 ?>"
																							   lay-verify="shiji"
																							   autocomplete="off"
																							   class="layui-input">
																					</div>
																					<label for="L_pass"
																						   class="layui-form-label"
																						   style="width: 5%;">
																						<span class="x-red">*</span>损耗
																					</label>
																					<div class="layui-input-inline"
																						 style="width: 56px;">
																						<input name="sunhao[]"
																							   value="<?php echo $sunhao6 ?>"
																							   id="val6666666666"
																							   lay-verify="sunhao"
																							   autocomplete="off"
																							   class="layui-input">
																					</div>
																					<label for="L_pass"
																						   class="layui-form-label"
																						   style="width: 5%;">
																						<span class="x-red">*</span>件数
																					</label>
																					<div class="layui-input-inline"
																						 style="width: 56px;">
																						<input name="jianshu[]"
																							   id="val66666666666" value="<?php echo $jianshu6 ?>"
																							   lay-verify="jianshu"
																							   autocomplete="off"
																							   class="layui-input">
																					</div>
																					<label for="L_pass"
																						   class="layui-form-label"
																						   style="width: 5%;">
																						<span class="x-red">*</span>增减数量
																					</label>
																					<div class="layui-input-inline"
																						 style="width: 56px;">
																						<input name="sunhaoyongliang[]"
																							   id="val666666666666"
																							   value="<?php echo $sunhaoyongliang6 ?>"
																							   lay-verify="sunhaoyongliang"
																							   autocomplete="off"
																							   class="layui-input">
																					</div>
																					<label for="L_pass"
																						   class="layui-form-label"
																						   style="width: 5%;">
																						<span class="x-red">*</span>到料日
																					</label>
																					<div class="layui-input-inline"
																						 style="width: 56px;">
																						<input name="daoliaori[]"
																							   id="val6666666666666"
																							   value="<?php echo $daoliaori6 ?>"
																							   lay-verify="daoliaori"
																							   autocomplete="off"
																							   class="layui-input">
																					</div>
																					<?php if (!empty($guige6) && empty($guige7)) { ?>
																						<i class="layui-icon"
																						   id="divadd6"
																						   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
																						   onclick="return addnow(7,6)"></i>
																					<?php } else { ?>
																						<i class="layui-icon"
																						   id="divadd6"
																						   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
																						   onclick="return addnow(7,6)"></i>
																					<?php } ?>
																					<i class="iconfont"
																					   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
																					   onclick="return dellete(6,5)">&#xe6fe;</i>
																				</div>


																				<?php if (empty($guige7)){ ?>
																				<div class="layui-form-item"
																					 id="div7"
																					 style="display: none;">
																					<?php }else{ ?>
																					<div class="layui-form-item"
																						 id="div7"
																						 style="display: block;">
																						<?php } ?>
																						<label for="L_pass"
																							   class="layui-form-label"
																							   style="width: 5%;">
																							<span class="x-red">*</span>品名
																						</label>
																						<div class="layui-input-inline"
																							 style="width: 56px;">
																							<input name="pinming[]"
																								   id="val7"
																								   value="<?php echo $pinming7 ?>"
																								   lay-verify="pinming"
																								   autocomplete="off"
																								   class="layui-input">
																						</div>
																						<label for="L_pass"
																							   class="layui-form-label"
																							   style="width: 5%;">
																							<span class="x-red">*</span>品番
																						</label>
																						<div class="layui-input-inline"
																							 style="width: 56px;">
																							<input name="pinfan[]"
																								   id="val77"
																								   value="<?php echo $pinfan7 ?>"
																								   lay-verify="pinfan"
																								   autocomplete="off"
																								   class="layui-input">
																						</div>
																						<label for="L_pass"
																							   class="layui-form-label"
																							   style="width: 5%;">
																							<span class="x-red">*</span>色号
																						</label>
																						<div class="layui-input-inline"
																							 style="width: 56px;">
																							<input name="sehao[]"
																								   id="val777"
																								   value="<?php echo $sehao7 ?>"
																								   lay-verify="sehao"
																								   autocomplete="off"
																								   class="layui-input">
																						</div>
																						<label for="L_pass"
																							   class="layui-form-label"
																							   style="width: 5%;">
																							<span class="x-red">*</span>规格
																						</label>
																						<div class="layui-input-inline"
																							 style="width: 56px;">
																							<input name="guige[]"
																								   id="val7777"
																								   value="<?php echo $guige7 ?>"
																								   lay-verify="guige"
																								   autocomplete="off"
																								   class="layui-input">
																						</div>
																						<label for="L_pass"
																							   class="layui-form-label"
																							   style="width: 5%;">
																							<span class="x-red">*</span>单位
																						</label>
																						<div class="layui-input-inline"
																							 style="width: 56px;">
																							<input name="danwei[]"
																								   id="val77777"
																								   value="<?php echo $danwei7 ?>"
																								   lay-verify="danwei"
																								   autocomplete="off"
																								   class="layui-input">
																						</div>
																						<label for="L_pass"
																							   class="layui-form-label"
																							   style="width: 5%;">
																							<span class="x-red">*</span>提单数
																						</label>
																						<div class="layui-input-inline"
																							 style="width: 56px;">
																							<input name="tidanshu[]"
																								   value="<?php echo $tidanshu7 ?>"
																								   id="val777777"
																								   lay-verify="tidanshu"
																								   autocomplete="off"
																								   class="layui-input">
																						</div>
																						<label for="L_pass"
																							   class="layui-form-label"
																							   style="width: 5%;">
																							<span class="x-red">*</span>请点数
																						</label>
																						<div class="layui-input-inline"
																							 style="width: 56px;">
																							<input name="qingdianshu[]"
																								   id="val7777777"
																								   value="<?php echo $qingdianshu7 ?>"
																								   lay-verify="qingdianshu"
																								   autocomplete="off"
																								   class="layui-input">
																						</div>
																					</div>
																					<?php if (empty($guige7)){ ?>
																					<div class="layui-form-item"
																						 id="div77"
																						 style="display: none;">
																						<?php }else{ ?>
																						<div class="layui-form-item"
																							 id="div77"
																							 style="display: block;">
																							<?php } ?>
																							<label for="L_pass"
																								   class="layui-form-label"
																								   style="width: 5%;">
																								<span class="x-red">*</span>样指示
																							</label>
																							<div class="layui-input-inline"
																								 style="width: 56px;">
																								<input name="yangzhishi[]"
																									   id="val77777777"
																									   value="<?php echo $yangzhishi7 ?>"
																									   lay-verify="yangzhishi"
																									   autocomplete="off"
																									   class="layui-input">
																							</div>
																							<label for="L_pass"
																								   class="layui-form-label"
																								   style="width: 5%;">
																								<span class="x-red">*</span>实际
																							</label>
																							<div class="layui-input-inline"
																								 style="width: 56px;">
																								<input name="shiji[]"
																									   id="val777777777"
																									   value="<?php echo $shiji7 ?>"
																									   lay-verify="shiji"
																									   autocomplete="off"
																									   class="layui-input">
																							</div>
																							<label for="L_pass"
																								   class="layui-form-label"
																								   style="width: 5%;">
																								<span class="x-red">*</span>损耗
																							</label>
																							<div class="layui-input-inline"
																								 style="width: 56px;">
																								<input name="sunhao[]"
																									   id="val7777777777"
																									   value="<?php echo $sunhao7 ?>"
																									   lay-verify="sunhao"
																									   autocomplete="off"
																									   class="layui-input">
																							</div>
																							<label for="L_pass"
																								   class="layui-form-label"
																								   style="width: 5%;">
																								<span class="x-red">*</span>件数
																							</label>
																							<div class="layui-input-inline"
																								 style="width: 56px;">
																								<input name="jianshu[]"
																									   value="<?php echo $jianshu7 ?>"
																									   id="val77777777777"
																									   lay-verify="jianshu"
																									   autocomplete="off"
																									   class="layui-input">
																							</div>
																							<label for="L_pass"
																								   class="layui-form-label"
																								   style="width: 5%;">
																								<span class="x-red">*</span>增减数量
																							</label>
																							<div class="layui-input-inline"
																								 style="width: 56px;">
																								<input name="sunhaoyongliang[]"
																									   id="val777777777777"
																									   value="<?php echo $sunhaoyongliang7 ?>"
																									   lay-verify="sunhaoyongliang"
																									   autocomplete="off"
																									   class="layui-input">
																							</div>
																							<label for="L_pass"
																								   class="layui-form-label"
																								   style="width: 5%;">
																								<span class="x-red">*</span>到料日
																							</label>
																							<div class="layui-input-inline"
																								 style="width: 56px;">
																								<input name="daoliaori[]"
																									   id="val7777777777777"
																									   value="<?php echo $daoliaori7 ?>"
																									   lay-verify="daoliaori"
																									   autocomplete="off"
																									   class="layui-input">
																							</div>
																							<?php if (!empty($guige7) && empty($guige8)) { ?>
																								<i class="layui-icon"
																								   id="divadd7"
																								   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
																								   onclick="return addnow(8,7)"></i>
																							<?php } else { ?>
																								<i class="layui-icon"
																								   id="divadd7"
																								   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
																								   onclick="return addnow(8,7)"></i>
																							<?php } ?>
																							<i class="iconfont"
																							   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
																							   onclick="return dellete(7,6)">&#xe6fe;</i>
																						</div>


																						<?php if (empty($guige8)){ ?>
																						<div class="layui-form-item"
																							 id="div8"
																							 style="display: none;">
																							<?php }else{ ?>
																							<div class="layui-form-item"
																								 id="div8"
																								 style="display: block;">
																								<?php } ?>
																								<label for="L_pass"
																									   class="layui-form-label"
																									   style="width: 5%;">
																									<span class="x-red">*</span>品名
																								</label>
																								<div class="layui-input-inline"
																									 style="width: 56px;">
																									<input name="pinming[]"
																										   id="val8"
																										   value="<?php echo $pinming8 ?>"
																										   lay-verify="pinming"
																										   autocomplete="off"
																										   class="layui-input">
																								</div>
																								<label for="L_pass"
																									   class="layui-form-label"
																									   style="width: 5%;">
																									<span class="x-red">*</span>品番
																								</label>
																								<div class="layui-input-inline"
																									 style="width: 56px;">
																									<input name="pinfan[]"
																										   id="val88"
																										   lay-verify="pinfan"
																										   value="<?php echo $pinfan8 ?>"
																										   autocomplete="off"
																										   class="layui-input">
																								</div>
																								<label for="L_pass"
																									   class="layui-form-label"
																									   style="width: 5%;">
																									<span class="x-red">*</span>色号
																								</label>
																								<div class="layui-input-inline"
																									 style="width: 56px;">
																									<input name="sehao[]"
																										   value="<?php echo $sehao8 ?>"
																										   id="val888"
																										   lay-verify="sehao"
																										   autocomplete="off"
																										   class="layui-input">
																								</div>
																								<label for="L_pass"
																									   class="layui-form-label"
																									   style="width: 5%;">
																									<span class="x-red">*</span>规格
																								</label>
																								<div class="layui-input-inline"
																									 style="width: 56px;">
																									<input name="guige[]"
																										   id="val8888"
																										   lay-verify="guige"
																										   value="<?php echo $guige8 ?>"
																										   autocomplete="off"
																										   class="layui-input">
																								</div>
																								<label for="L_pass"
																									   class="layui-form-label"
																									   style="width: 5%;">
																									<span class="x-red">*</span>单位
																								</label>
																								<div class="layui-input-inline"
																									 style="width: 56px;">
																									<input name="danwei[]"
																										   id="val88888"
																										   value="<?php echo $danwei8 ?>"
																										   lay-verify="danwei"
																										   autocomplete="off"
																										   class="layui-input">
																								</div>
																								<label for="L_pass"
																									   class="layui-form-label"
																									   style="width: 5%;">
																									<span class="x-red">*</span>提单数
																								</label>
																								<div class="layui-input-inline"
																									 style="width: 56px;">
																									<input name="tidanshu[]"
																										   id="val888888"
																										   value="<?php echo $tidanshu8 ?>"
																										   lay-verify="tidanshu"
																										   autocomplete="off"
																										   class="layui-input">
																								</div>
																								<label for="L_pass"
																									   class="layui-form-label"
																									   style="width: 5%;">
																									<span class="x-red">*</span>请点数
																								</label>
																								<div class="layui-input-inline"
																									 style="width: 56px;">
																									<input name="qingdianshu[]"
																										   id="val8888888"
																										   value="<?php echo $qingdianshu8 ?>"
																										   lay-verify="qingdianshu"
																										   autocomplete="off"
																										   class="layui-input">
																								</div>
																							</div>
																							<?php if (empty($guige8)){ ?>
																							<div class="layui-form-item"
																								 id="div88"
																								 style="display: none;">
																								<?php }else{ ?>
																								<div class="layui-form-item"
																									 id="div88"
																									 style="display: block;">
																									<?php } ?>
																									<label for="L_pass"
																										   class="layui-form-label"
																										   style="width: 5%;">
																										<span class="x-red">*</span>样指示
																									</label>
																									<div class="layui-input-inline"
																										 style="width: 56px;">
																										<input name="yangzhishi[]"
																											   id="val88888888"
																											   value="<?php echo $yangzhishi8 ?>"
																											   lay-verify="yangzhishi"
																											   autocomplete="off"
																											   class="layui-input">
																									</div>
																									<label for="L_pass"
																										   class="layui-form-label"
																										   style="width: 5%;">
																										<span class="x-red">*</span>实际
																									</label>
																									<div class="layui-input-inline"
																										 style="width: 56px;">
																										<input name="shiji[]"
																											   value="<?php echo $shiji8 ?>"
																											   id="val888888888"
																											   lay-verify="shiji"
																											   autocomplete="off"
																											   class="layui-input">
																									</div>
																									<label for="L_pass"
																										   class="layui-form-label"
																										   style="width: 5%;">
																										<span class="x-red">*</span>损耗
																									</label>
																									<div class="layui-input-inline"
																										 style="width: 56px;">
																										<input name="sunhao[]"
																											   id="val8888888888"
																											   lay-verify="sunhao"
																											   value="<?php echo $sunhao8 ?>"
																											   autocomplete="off"
																											   class="layui-input">
																									</div>
																									<label for="L_pass"
																										   class="layui-form-label"
																										   style="width: 5%;">
																										<span class="x-red">*</span>件数
																									</label>
																									<div class="layui-input-inline"
																										 style="width: 56px;">
																										<input name="jianshu[]"
																											   id="val88888888888"
																											   lay-verify="jianshu"
																											   autocomplete="off"
																											   value="<?php echo $jianshu8 ?>"
																											   class="layui-input">
																									</div>
																									<label for="L_pass"
																										   class="layui-form-label"
																										   style="width: 5%;">
																										<span class="x-red">*</span>增减数量
																									</label>
																									<div class="layui-input-inline"
																										 style="width: 56px;">
																										<input name="sunhaoyongliang[]"
																											   id="val888888888888"
																											   value="<?php echo $sunhaoyongliang8 ?>"
																											   lay-verify="sunhaoyongliang"
																											   autocomplete="off"
																											   class="layui-input">
																									</div>
																									<label for="L_pass"
																										   class="layui-form-label"
																										   style="width: 5%;">
																										<span class="x-red">*</span>到料日
																									</label>
																									<div class="layui-input-inline"
																										 style="width: 56px;">
																										<input name="daoliaori[]"
																											   id="val8888888888888"
																											   value="<?php echo $daoliaori8 ?>"
																											   lay-verify="daoliaori"
																											   autocomplete="off"
																											   class="layui-input">
																									</div>
																									<?php if (!empty($guige8) && empty($guige9)) { ?>
																										<i class="layui-icon"
																										   id="divadd8"
																										   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
																										   onclick="return addnow(9,8)"></i>
																									<?php } else { ?>
																										<i class="layui-icon"
																										   id="divadd8"
																										   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
																										   onclick="return addnow(9,8)"></i>
																									<?php } ?>
																									<i class="iconfont"
																									   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
																									   onclick="return dellete(8,7)">&#xe6fe;</i>
																								</div>


																								<?php if (empty($guige9)){ ?>
																								<div class="layui-form-item"
																									 id="div9"
																									 style="display: none;">
																									<?php }else{ ?>
																									<div class="layui-form-item"
																										 id="div9"
																										 style="display: block;">
																										<?php } ?>
																										<label for="L_pass"
																											   class="layui-form-label"
																											   style="width: 5%;">
																											<span class="x-red">*</span>品名
																										</label>
																										<div class="layui-input-inline"
																											 style="width: 56px;">
																											<input name="pinming[]"
																												   id="val9"
																												   value="<?php echo $pinming9 ?>"
																												   lay-verify="pinming"
																												   autocomplete="off"
																												   class="layui-input">
																										</div>
																										<label for="L_pass"
																											   class="layui-form-label"
																											   style="width: 5%;">
																											<span class="x-red">*</span>品番
																										</label>
																										<div class="layui-input-inline"
																											 style="width: 56px;">
																											<input name="pinfan[]"
																												   id="val99"
																												   lay-verify="pinfan"
																												   value="<?php echo $pinfan9 ?>"
																												   autocomplete="off"
																												   class="layui-input">
																										</div>
																										<label for="L_pass"
																											   class="layui-form-label"
																											   style="width: 5%;">
																											<span class="x-red">*</span>色号
																										</label>
																										<div class="layui-input-inline"
																											 style="width: 56px;">
																											<input name="sehao[]"
																												   id="val999"
																												   value="<?php echo $sehao9 ?>"
																												   lay-verify="sehao"
																												   autocomplete="off"
																												   class="layui-input">
																										</div>
																										<label for="L_pass"
																											   class="layui-form-label"
																											   style="width: 5%;">
																											<span class="x-red">*</span>规格
																										</label>
																										<div class="layui-input-inline"
																											 style="width: 56px;">
																											<input name="guige[]"
																												   id="val9999"
																												   value="<?php echo $guige9 ?>"
																												   lay-verify="guige"
																												   autocomplete="off"
																												   class="layui-input">
																										</div>
																										<label for="L_pass"
																											   class="layui-form-label"
																											   style="width: 5%;">
																											<span class="x-red">*</span>单位
																										</label>
																										<div class="layui-input-inline"
																											 style="width: 56px;">
																											<input name="danwei[]"
																												   value="<?php echo $danwei9 ?>"
																												   id="val99999"
																												   lay-verify="danwei"
																												   autocomplete="off"
																												   class="layui-input">
																										</div>
																										<label for="L_pass"
																											   class="layui-form-label"
																											   style="width: 5%;">
																											<span class="x-red">*</span>提单数
																										</label>
																										<div class="layui-input-inline"
																											 style="width: 56px;">
																											<input name="tidanshu[]"
																												   value="<?php echo $tidanshu9 ?>"
																												   id="val999999"
																												   lay-verify="tidanshu"
																												   autocomplete="off"
																												   class="layui-input">
																										</div>
																										<label for="L_pass"
																											   class="layui-form-label"
																											   style="width: 5%;">
																											<span class="x-red">*</span>请点数
																										</label>
																										<div class="layui-input-inline"
																											 style="width: 56px;">
																											<input name="qingdianshu[]"
																												   value="<?php echo $qingdianshu9 ?>"
																												   id="val9999999"
																												   lay-verify="qingdianshu"
																												   autocomplete="off"
																												   class="layui-input">
																										</div>
																									</div>
																									<?php if (empty($guige9)){ ?>
																									<div class="layui-form-item"
																										 id="div99"
																										 style="display: none;">
																										<?php }else{ ?>
																										<div class="layui-form-item"
																											 id="div99"
																											 style="display: block;">
																											<?php } ?>
																											<label for="L_pass"
																												   class="layui-form-label"
																												   style="width: 5%;">
																												<span class="x-red">*</span>样指示
																											</label>
																											<div class="layui-input-inline"
																												 style="width: 56px;">
																												<input name="yangzhishi[]"
																													   id="val99999999"
																													   value="<?php echo $yangzhishi9 ?>"
																													   lay-verify="yangzhishi"
																													   autocomplete="off"
																													   class="layui-input">
																											</div>
																											<label for="L_pass"
																												   class="layui-form-label"
																												   style="width: 5%;">
																												<span class="x-red">*</span>实际
																											</label>
																											<div class="layui-input-inline"
																												 style="width: 56px;">
																												<input name="shiji[]"
																													   value="<?php echo $shiji9 ?>"
																													   id="val999999999"
																													   lay-verify="shiji"
																													   autocomplete="off"
																													   class="layui-input">
																											</div>
																											<label for="L_pass"
																												   class="layui-form-label"
																												   style="width: 5%;">
																												<span class="x-red">*</span>损耗
																											</label>
																											<div class="layui-input-inline"
																												 style="width: 56px;">
																												<input name="sunhao[]"
																													   id="val9999999999"
																													   value="<?php echo $sunhao9 ?>"
																													   lay-verify="sunhao"
																													   autocomplete="off"
																													   class="layui-input">
																											</div>
																											<label for="L_pass"
																												   class="layui-form-label"
																												   style="width: 5%;">
																												<span class="x-red">*</span>件数
																											</label>
																											<div class="layui-input-inline"
																												 style="width: 56px;">
																												<input name="jianshu[]"
																													   id="val99999999999"
																													   value="<?php echo $jianshu9 ?>"
																													   lay-verify="jianshu"
																													   autocomplete="off"
																													   class="layui-input">
																											</div>
																											<label for="L_pass"
																												   class="layui-form-label"
																												   style="width: 5%;">
																												<span class="x-red">*</span>增减数量
																											</label>
																											<div class="layui-input-inline"
																												 style="width: 56px;">
																												<input name="sunhaoyongliang[]"
																													   id="val999999999999"
																													   value="<?php echo $sunhaoyongliang9 ?>"
																													   lay-verify="sunhaoyongliang"
																													   autocomplete="off"
																													   class="layui-input">
																											</div>
																											<label for="L_pass"
																												   class="layui-form-label"
																												   style="width: 5%;">
																												<span class="x-red">*</span>到料日
																											</label>
																											<div class="layui-input-inline"
																												 style="width: 56px;">
																												<input name="daoliaori[]"
																													   id="val9999999999999"
																													   value="<?php echo $daoliaori9 ?>"
																													   lay-verify="daoliaori"
																													   autocomplete="off"
																													   class="layui-input">
																											</div>
																											<?php if (!empty($guige9) && empty($guige10)) { ?>
																												<i class="layui-icon"
																												   id="divadd9"
																												   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
																												   onclick="return addnow(10,9)"></i>
																											<?php } else { ?>
																												<i class="layui-icon"
																												   id="divadd9"
																												   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
																												   onclick="return addnow(10,9)"></i>
																											<?php } ?>
																											<i class="iconfont"
																											   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
																											   onclick="return dellete(9,8)">&#xe6fe;</i>
																										</div>


																										<?php if (empty($guige10)){ ?>
																										<div class="layui-form-item"
																											 id="div10"
																											 style="display: none;">
																											<?php }else{ ?>
																											<div class="layui-form-item"
																												 id="div10"
																												 style="display: block;">
																												<?php } ?>
																												<label for="L_pass"
																													   class="layui-form-label"
																													   style="width: 5%;">
																													<span class="x-red">*</span>品名
																												</label>
																												<div class="layui-input-inline"
																													 style="width: 56px;">
																													<input name="pinming[]"
																														   id="val10"
																														   value="<?php echo $pinming10 ?>"
																														   lay-verify="pinming"
																														   autocomplete="off"
																														   class="layui-input">
																												</div>
																												<label for="L_pass"
																													   class="layui-form-label"
																													   style="width: 5%;">
																													<span class="x-red">*</span>品番
																												</label>
																												<div class="layui-input-inline"
																													 style="width: 56px;">
																													<input name="pinfan[]"
																														   id="val1010"
																														   value="<?php echo $pinfan10 ?>"
																														   lay-verify="pinfan"
																														   autocomplete="off"
																														   class="layui-input">
																												</div>
																												<label for="L_pass"
																													   class="layui-form-label"
																													   style="width: 5%;">
																													<span class="x-red">*</span>色号
																												</label>
																												<div class="layui-input-inline"
																													 style="width: 56px;">
																													<input name="sehao[]"
																														   value="<?php echo $sehao10 ?>"
																														   id="val101010"
																														   lay-verify="sehao"
																														   autocomplete="off"
																														   class="layui-input">
																												</div>
																												<label for="L_pass"
																													   class="layui-form-label"
																													   style="width: 5%;">
																													<span class="x-red">*</span>规格
																												</label>
																												<div class="layui-input-inline"
																													 style="width: 56px;">
																													<input name="guige[]"
																														   value="<?php echo $guige10 ?>"
																														   id="val10101010"
																														   lay-verify="guige"
																														   autocomplete="off"
																														   class="layui-input">
																												</div>
																												<label for="L_pass"
																													   class="layui-form-label"
																													   style="width: 5%;">
																													<span class="x-red">*</span>单位
																												</label>
																												<div class="layui-input-inline"
																													 style="width: 56px;">
																													<input name="danwei[]"
																														   value="<?php echo $danwei10 ?>"
																														   id="val1010101010"
																														   lay-verify="danwei"
																														   autocomplete="off"
																														   class="layui-input">
																												</div>
																												<label for="L_pass"
																													   class="layui-form-label"
																													   style="width: 5%;">
																													<span class="x-red">*</span>提单数
																												</label>
																												<div class="layui-input-inline"
																													 style="width: 56px;">
																													<input name="tidanshu[]"
																														   value="<?php echo $tidanshu10 ?>"
																														   id="val101010101010"
																														   lay-verify="tidanshu"
																														   autocomplete="off"
																														   class="layui-input">
																												</div>
																												<label for="L_pass"
																													   class="layui-form-label"
																													   style="width: 5%;">
																													<span class="x-red">*</span>请点数
																												</label>
																												<div class="layui-input-inline"
																													 style="width: 56px;">
																													<input name="qingdianshu[]"
																														   value="<?php echo $qingdianshu10 ?>"
																														   id="val10101010101010"
																														   lay-verify="qingdianshu"
																														   autocomplete="off"
																														   class="layui-input">
																												</div>
																											</div>
																											<?php if (empty($guige10)){ ?>
																											<div class="layui-form-item"
																												 id="div1010"
																												 style="display: none;">
																												<?php }else{ ?>
																												<div class="layui-form-item"
																													 id="div1010"
																													 style="display: block;">
																													<?php } ?>
																													<label for="L_pass"
																														   class="layui-form-label"
																														   style="width: 5%;">
																														<span class="x-red">*</span>样指示
																													</label>
																													<div class="layui-input-inline"
																														 style="width: 56px;">
																														<input name="yangzhishi[]"
																															   value="<?php echo $yangzhishi10 ?>"
																															   id="val1010101010101010"
																															   lay-verify="yangzhishi"
																															   autocomplete="off"
																															   class="layui-input">
																													</div>
																													<label for="L_pass"
																														   class="layui-form-label"
																														   style="width: 5%;">
																														<span class="x-red">*</span>实际
																													</label>
																													<div class="layui-input-inline"
																														 style="width: 56px;">
																														<input name="shiji[]"
																															   id="val101010101010101010"
																															   lay-verify="shiji"
																															   value="<?php echo $shiji10 ?>"
																															   autocomplete="off"
																															   class="layui-input">
																													</div>
																													<label for="L_pass"
																														   class="layui-form-label"
																														   style="width: 5%;">
																														<span class="x-red">*</span>损耗
																													</label>
																													<div class="layui-input-inline"
																														 style="width: 56px;">
																														<input name="sunhao[]"
																															   value="<?php echo $sunhao10 ?>"
																															   id="val10101010101010101010"
																															   lay-verify="sunhao"
																															   autocomplete="off"
																															   class="layui-input">
																													</div>
																													<label for="L_pass"
																														   class="layui-form-label"
																														   style="width: 5%;">
																														<span class="x-red">*</span>件数
																													</label>
																													<div class="layui-input-inline"
																														 style="width: 56px;">
																														<input name="jianshu[]"
																															   id="val1010101010101010101010"
																															   lay-verify="jianshu"
																															   value="<?php echo $jianshu10 ?>"
																															   autocomplete="off"
																															   class="layui-input">
																													</div>
																													<label for="L_pass"
																														   class="layui-form-label"
																														   style="width: 5%;">
																														<span class="x-red">*</span>增减数量
																													</label>
																													<div class="layui-input-inline"
																														 style="width: 56px;">
																														<input name="sunhaoyongliang[]"
																															   id="val101010101010101010101010"
																															   value="<?php echo $sunhaoyongliang10 ?>"
																															   lay-verify="sunhaoyongliang"
																															   autocomplete="off"
																															   class="layui-input">
																													</div>
																													<label for="L_pass"
																														   class="layui-form-label"
																														   style="width: 5%;">
																														<span class="x-red">*</span>到料日
																													</label>
																													<div class="layui-input-inline"
																														 style="width: 56px;">
																														<input name="daoliaori[]"
																															   id="val10101010101010101010101010"
																															   value="<?php echo $daoliaori10 ?>"
																															   lay-verify="daoliaori"
																															   autocomplete="off"
																															   class="layui-input">
																													</div>
																													<?php if (!empty($shuzhi10)) { ?>
																														<i class="layui-icon"
																														   id="divadd10"
																														   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
																														   onclick="return addnow(11,10)"></i>
																													<?php } else { ?>
																														<i class="layui-icon"
																														   id="divadd10"
																														   style="cursor: pointer;display: none;font-size: 25px;margin-left: 10px;"
																														   onclick="return addnow(11,10)"></i>
																													<?php } ?>
																													<i class="iconfont"
																													   style="cursor: pointer;font-size: 25px;margin-left: 10px;"
																													   onclick="return dellete(10,9)">&#xe6fe;</i>
																												</div>

																												<input type="hidden"
																													   id="id"
																													   name="id"
																													   value="<?php echo $id ?>">
																												<div class="layui-form-item">
																													<label for="L_repass"
																														   class="layui-form-label"
																														   style="width: 90%;">
																													</label>
																													<button class="layui-btn"
																															lay-filter="add"
																															lay-submit="">
																														确认提交
																													</button>
																												</div>
									</form>
								</div>
							</th>
						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function addnow(id, idd) {
		$("#div" + id).show()
		$("#div" + id + id).show();
		$("#div" + id + id + id).show();
		$("#div" + id + id + id + id).show();
		$("#div" + id + id + id + id + id).show();
		$("#divadd" + idd).hide();
		if (id == 2) {
			$("#divadd2").show();
			$("#divadd3").show();
			$("#divadd4").show();
			$("#divadd5").show();
			$("#divadd6").show();
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 3) {
			$("#divadd3").show();
			$("#divadd4").show();
			$("#divadd5").show();
			$("#divadd6").show();
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 4) {
			$("#divadd4").show();
			$("#divadd5").show();
			$("#divadd6").show();
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 5) {
			$("#divadd5").show();
			$("#divadd6").show();
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 6) {
			$("#divadd6").show();
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 7) {
			$("#divadd7").show();
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 8) {
			$("#divadd8").show();
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 9) {
			$("#divadd9").show();
			$("#divadd10").show();
		}
		if (id == 10) {
			$("#divadd10").show();
		}
	}

	function dellete(id, idd) {
		$("#div" + id).hide();
		$("#div" + id + id).hide();
		$("#div" + id + id + id).hide();
		$("#div" + id + id + id + id).hide();
		$("#div" + id + id + id + id + id).hide();
		$("#val" + id).val("");
		$("#val" + id + id).val("");
		$("#val" + id + id + id).val("");
		$("#val" + id + id + id + id).val("");
		$("#val" + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#val" + id + id + id + id + id + id + id + id + id + id + id + id + id).val("");
		$("#divadd" + idd).show();
	}
</script>
<script>
	layui.use(['form', 'layedit', 'layer'],
			function () {
				var form = layui.form,
						layer = layui.layer;

				$("#tab").validate({
					submitHandler: function (form) {
						$.ajax({
							cache: true,
							type: "POST",
							url: "<?= RUN . '/goods/goods_save_edit2' ?>",
							data: $('#tab').serialize(),
							async: false,
							error: function (request) {
								alert("error");
							},
							success: function (data) {
								var data = eval("(" + data + ")");
								if (data.success) {
									layer.msg(data.msg);
									setTimeout(function () {
										cancel();
									}, 2000);
								} else {
									layer.msg(data.msg);
								}
							}
						});
					}
				});
			});

	function cancel() {
		//关闭当前frame
		xadmin.close();
	}
</script>
</body>
</html>
