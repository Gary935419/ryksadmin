<!DOCTYPE html>
<html class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>我的管理后台-如邮快送</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport"
		  content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
	<link rel="stylesheet" href="<?= STA ?>/css/font.css">
	<link rel="stylesheet" href="<?= STA ?>/css/xadmin.css">
	<script type="text/javascript" src="<?= STA ?>/lib/layui/layui.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?= STA ?>/js/xadmin.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/upload/jquery_form.js"></script>
	<style type="text/css">
		#container {
			width: 100%;
			height: 90%;
		}

		/* marker跳动的动画 */
		.markerBounce {
			animation: bounce 0.5s infinite ease-in-out alternate;
		}

		/* marker飞入的动画 */
		.markerFlash {
			animation: flash 0.5s ease-in 1 normal forwards;
		}

		/* 跳动的动画 */
		@keyframes bounce {
			0% {
				transform: translate(0, 0);
			}

			100% {
				transform: translate(0, -50px);
			}
		}

		/* 飞入的动画 */
		@keyframes flash {
			0% {
				transform: translate(0, -200px);
			}

			100% {
				transform: translate(0, 0);
			}
		}
	</style>
</head>
<body onload="initMap()">
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a>
              <cite>司机在线人数：<?php echo $count1 ?>人</cite>
			</a>
            <a>
              <cite>司机离线人数：<?php echo $count2 ?>人</cite>
			</a>
          </span>
	<input type="hidden" name="str" id="str" value="<?php echo $str ?>">
	<input type="hidden" name="str_name" id="str_name" value="<?php echo $str_name ?>">
	<input type="hidden" name="str_account" id="str_account" value="<?php echo $str_account ?>">
	<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="ページを更新"><i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<script charset="utf-8" src="https://map.qq.com/api/gljs?v=1.exp&key=OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77"></script>
<div class="layui-fluid">
	<div class="layui-row">
		<div id="container"></div>

		<script>
			var map, markerBounce;
			function initMap() {
				//自定义DOM覆盖物 - 继承DOMOverlay
				function myMarker(options) {
					let mydom;
					TMap.DOMOverlay.call(this, options);
				}

				myMarker.prototype = new TMap.DOMOverlay();

				// 初始化
				myMarker.prototype.onInit = function (options) {
					this.position = options.position;
					this.type = options.type; // 当前marker的类型，是跳动或飞入
				}

				// 创建
				myMarker.prototype.createDOM = function () {
					mydom = document.createElement('img');  // 新建一个img的dom
					mydom.src = 'https://mapapi.qq.com/web/lbs/javascriptGL/demo/img/markerDefault.png';
					mydom.style.cssText = [
						'position: absolute;',
						'top:  0px;',
						'left: 0px;'
					].join('');
					switch (this.type) {
						case 'bounce':
							mydom.setAttribute('class', 'markerBounce');  // 给新建的dom添加marker类，添加跳动效果
							break;
						case 'flash':
							mydom.setAttribute('class', 'markerFlash');		// 给新建的dom添加marker类，添加飞入效果
							break;
					}
					return mydom;
				}

				// 更新DOM元素，在地图移动/缩放后执行
				myMarker.prototype.updateDOM = function () {
					if (!this.map) {
						return;
					}
					let pixel = this.map.projectToContainer(this.position); // 经纬度坐标转容器像素坐标
					let left = pixel.getX() - this.dom.clientWidth / 2 + 'px';
					let top = pixel.getY() + 'px';
					// 使用top/left将DOM元素定位到指定位置
					this.dom.style.top = top;
					this.dom.style.left = left;
				}

				// 初始化地图
				map = new TMap.Map("container", {
					zoom: 12, // 设置地图缩放级别
					center: new TMap.LatLng(38.9508,121.654542) // 设置地图中心点坐标
				});

				var str = $("#str").val();
				var arr = str.split(";");
				var str_name = $("#str_name").val();
				var str_name_arr = str_name.split(";");
				var str_account = $("#str_account").val();
				var str_account_arr = str_account.split(";");
				arr.forEach((item,index,array)=>{
					var arr1 = item.split(",");
					markerBounce = new TMap.InfoWindow({
						map,
						content:'姓名：' + str_name_arr[index] +'。<br>电话：' + str_account_arr[index] + '。',
						position: new TMap.LatLng(arr1[0],arr1[1]),
						offset: { x: 0, y: 0 } //设置信息窗相对position偏移像素，为了使其显示在Marker的上方
					});
					markerBounce = new myMarker({
						map,
						position: new TMap.LatLng(arr1[0],arr1[1]),
						type: 'bounce',
					});
				})
			}
		</script>

		<script>
			$(document).ready(function(){
				var time=86400;
				var timer=setInterval(function jump() {
					if (time > 0) {
						// if (time % 10 === 0){
							//$.ajax({
							//	type: "post",
							//	data: {"id": 1},
							//	dataType: "json",
							//	success: function (data) {
							//		$("#str").val(data.str);
							//		$("#str_name").val(data.str_name);
							//		$("#str_account").val(data.str_account);
							//		initMap();
							//	},
							//});
							window.location.reload();
						// }
						time--;
					} else {
						clearInterval(timer);
					}
				},30000);
			});
		</script>
	</div>
</div>
</body>
</html>
