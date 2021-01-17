/* 异步上传图片函数, 依赖于 jquery_form.js, 必须指定展示的文件按钮的父元素id 为 file-block */
function upload(form, subbtn, fblock, bar, show_img){ /* 表单选择器, 提交按钮, 上传 token 值, 按钮的父元素id, 进度条对象, 展示缩略图区块id */
    subbtn.click(function(){
		form.attr('enctype', 'multipart/form-data');
		form.attr('method', 'post');
		bar.wrap("<div id='upload-dock' style='width:100%; height:20px; margin:0;padding:0;'></div>");
		bar.css({'background-color':'#00FF7F', 'width':'0%', 'height':'20px', 'border-radius':'5px', 'text-align':'center', 'color':'white'});
		
        form.ajaxSubmit({
			data: {
				'max_file_size':'500mb',
				'chunk_size':'500mb'
			},
            success:function(data){
                console.log(data);
				var fileblock = document.getElementById(fblock);
				var showimg = document.getElementById(show_img); // http://oi7nqmkj8.bkt.clouddn.com
				showimg.innerHTML = "<img src='http://ojly3kt7f.bkt.clouddn.com/"+ data.key +"?imageView2/1/w/200/h/200' />";
				showimg.innerHTML += "<input type='text' style='display:none;' name='xfile' value='"+ data.key +"' />";
				showimg.innerHTML += "<input type='text' style='display:none;' name='xpath' value='http://ojly3kt7f.bkt.clouddn.com/' />";
				showimg.innerHTML += "<br /><input type='button' class='cg' value='删除图片' />";
				$('.cg').click(function() {
					showimg.innerHTML = "";
					$('.bar').css('width', '0%');
					$('#upload-dock').css('background', '#fff');
				});
            },
            error:function(data){
				console.log(data);
				alert("上传失败");
            },
			uploadProgress: function(event, position, total, percentComplete) {
				var percentVal = percentComplete + '%';
				bar.width(percentVal);
				bar.text(percentVal);
				if (percentComplete == 100)
					bar.text('done');
			},
        });
    });
}

/* 异步上传视频函数, 依赖于 jquery_form.js, 必须指定展示的文件按钮的父元素id 为 file-block */
function uploadvideo(form, subbtn, token, fblock, bar, show_img){ /* 表单选择器, 提交按钮, 上传 token 值, 按钮的父元素id, 进度条对象, 展示缩略图区块id */
    subbtn.click(function(){
		form.attr('enctype', 'multipart/form-data');
		form.attr('method', 'post');
		bar.wrap("<div id='upload-dock' style='width:100%; background-color:#C0C0C0; height:20px; margin:0;padding:0;'></div>");
		bar.css({'background-color':'#00FF7F', 'width':'0%', 'height':'20px', 'border-radius':'5px', 'text-align':'center', 'color':'white'});
		
        form.ajaxSubmit({
			data: {
				'token':token,
				'max_file_size':'500mb',
				'chunk_size':'500mb'
			},
            success:function(data){
                console.log(data);
				var fileblock = document.getElementById(fblock);
				var showimg = document.getElementById(show_img);
				showimg.innerHTML = "<video src='http://ojly3kt7f.bkt.clouddn.com/"+ data.key + "' width='400' style='margin:0;'>视频格式不支持</video>";
				showimg.innerHTML += "<input type='text' style='display:none;' name='xfile' value='"+ data.key +"' />";
				showimg.innerHTML += "<input type='text' style='display:none;' name='xpath' value='http://ojly3kt7f.bkt.clouddn.com/' />";
            },
            error:function(data){
				alert("上传失败");
            },
			uploadProgress: function(event, position, total, percentComplete) {
				var percentVal = percentComplete + '%';
				bar.width(percentVal);
				bar.text(percentVal);
				if (percentComplete == 100)
					bar.text('done');
			},
        });
    });
}

function ueset(textarea, w, h) { /* textarea 的id, 宽度, 高度 */
	return UE.getEditor( textarea, {
		autoHeightEnabled: true,
		autoFloatEnabled: true,
		initialFrameWidth: w,
		initialFrameHeight:h
	});
}