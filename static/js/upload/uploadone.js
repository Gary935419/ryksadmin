


/* 异步上传图片函数, 依赖于 jquery_form.js, 必须指定展示的文件按钮的父元素id 为 file-block */
function upload(form, token, bar, show_img,imgname){ /* 表单选择器, 提交按钮, 上传 token 值, 按钮的父元素id, 进度条对象, 展示缩略图区块id */
        form.attr('enctype', 'multipart/form-data');
        form.attr('method', 'post');
        bar.wrap("<div id='upload-dock"+imgname+"' style='width:100%; height:20px; margin:0;padding:0;'></div>");
        bar.css({'background-color':'#00FF7F', 'width':'0%', 'height':'20px', 'border-radius':'5px', 'text-align':'center', 'color':'white'});

        form.ajaxSubmit({
            data: {
                'token':token,
                'max_file_size':'500mb',
                'chunk_size':'500mb'
            },
            success:function(data){
                console.log(data);
                var showimg = document.getElementById(show_img); // http://img.pgtl.com.cn
                showimg.innerHTML = "<img src='http://img.pgtl.com.cn/"+ data.key +"?imageView2/1/w/200/h/200' />";
                showimg.innerHTML += "<input type='text' style='display:none;' name='"+imgname+"' id='"+imgname+"'value='"+ "http://img.pgtl.com.cn/"+data.key +"' />";
                showimg.innerHTML += "<input type='text' style='display:none;' name='xpath' value='http://img.pgtl.com.cn/' />";
                showimg.innerHTML += "<br /><input type='button' class='cg"+imgname+"' value='删除图片' />";
                $('.cg'+imgname).click(function() {
                    showimg.innerHTML = "";
                    bar.css('width', '0%');
                    $('#upload-dock'+imgname).css('background', '#fff');
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
}



/* 异步上传图片函数, 依赖于 jquery_form.js, 必须指定展示的文件按钮的父元素id 为 file-block修改 */
function uploadb(form, token, bar, show_img,imgname,img){ /* 表单选择器, 提交按钮, 上传 token 值, 按钮的父元素id, 进度条对象, 展示缩略图区块id */
    form.attr('enctype', 'multipart/form-data');
    form.attr('method', 'post');
    bar.wrap("<div id='upload-dock"+imgname+"' style='width:100%; height:20px; margin:0;padding:0;'></div>");
    bar.css({'background-color':'#00FF7F', 'width':'0%', 'height':'20px', 'border-radius':'5px', 'text-align':'center', 'color':'white'});

    form.ajaxSubmit({
        data: {
            'token':token,
            'max_file_size':'500mb',
            'chunk_size':'500mb'
        },
        success:function(data){
            console.log(data);
            var showimg = document.getElementById(show_img); // http://oi7nqmkj8.bkt.clouddn.com
            showimg.innerHTML = "<img id='"+img+"' src='http://img.pgtl.com.cn/"+ data.key +"?imageView2/1/w/200/h/200' />";
            showimg.innerHTML += "<input type='text' style='display:none;' name='"+imgname+"' id='"+imgname+"'value='"+ "http://img.pgtl.com.cn/"+data.key +"' />";
            showimg.innerHTML += "<input type='text' style='display:none;' name='xpath' value='http://img.pgtl.com.cn/' />";
            showimg.innerHTML += "<br /><input type='button' class='cg"+imgname+"' value='删除图片' />";
            $('.cg'+imgname).click(function() {
                showimg.innerHTML = "";
                bar.css('width', '0%');
                $('#upload-dock'+imgname).css('background', '#fff');
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
}


/* 异步上传图片函数, 依赖于 jquery_form.js, 必须指定展示的文件按钮的父元素id 为 file-block */
function uploadlist(form, token, bar, show_img,imgname){ /* 表单选择器, 提交按钮, 上传 token 值, 按钮的父元素id, 进度条对象, 展示缩略图区块id */
        form.attr('enctype', 'multipart/form-data');
        form.attr('method', 'post');
        bar.wrap("<div id='upload-dock"+imgname+"' style='width:100%; height:20px; margin:0;padding:0;'></div>");
        bar.css({'background-color':'#00FF7F', 'width':'0%', 'height':'20px', 'border-radius':'5px', 'text-align':'center', 'color':'white'});

        form.ajaxSubmit({
            data: {
                'token':token,
                'max_file_size':'500mb',
                'chunk_size':'500mb'
            },
            success:function(data){
                console.log(data);
                var showimg = document.getElementById(show_img); // http://oi7nqmkj8.bkt.clouddn.com
                $("#"+show_img).append("<div id='aa'class='aa"+data.key+"'><img src='http://img.pgtl.com.cn/"+ data.key +"?imageView2/1/w/200/h/200' /><input type='text' style='display:none;' name='"+imgname+"[]' value='"+"http://img.pgtl.com.cn/"+ data.key +"' /><input type='text' style='display:none;' name='xpath' value='http://img.pgtl.com.cn/' /><br><input type='button' class='cg"+data.key+"' value='删除图片' /></div>");
                $('.aa'+data.key+' .cg'+data.key ).click(function() {
                    $(this).parent().remove();
                    bar.css('width', '0%');
                    $('#upload-dock'+imgname).css('background', '#fff');
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

}

function uploadbd(form, zst, logo, percent) { /* 表单选择器, 提交按钮, 上传 token 值, 按钮的父元素id, 进度条对象, 展示缩略图区块id */
       form.attr('enctype', 'multipart/form-data');
       form.attr('method', 'post');
       form.ajaxSubmit({
            data: {},
            success:function(data){
                console.log(data);
                var reqstr=eval("("+data+")");
                zst[0].src=reqstr.src;
                logo.val(reqstr.src);
            },
            error:function(data){
                console.log(data);
                alert("上传失败");
            },
            uploadProgress: function(event, position, total, percentComplete) {
                percent.val(percentComplete);
            },
        });

}

function uploadvideo(form, zst, logo, percent) { /* 表单选择器, 提交按钮, 上传 token 值, 按钮的父元素id, 进度条对象, 展示缩略图区块id */
       form.attr('enctype', 'multipart/form-data');
       form.attr('method', 'post');
       form.ajaxSubmit({
            data: {},
            success:function(data){
                console.log(data);
                var reqstr=eval("("+data+")");
                //alert(reqstr.src);
                logo.val(reqstr.src);
                zst.attr('src',reqstr.srcall);
                zst.show();
                alert("上传成功");
            },
            error:function(data){
                console.log(data);
                alert("上传失败");
            },
            uploadProgress: function(event, position, total, percentComplete) {
                percent.val(percentComplete);
            },
        });

}

function uploads(form, imgname,zst) { /* 表单选择器, 提交按钮, 上传 token 值, 按钮的父元素id, 进度条对象, 展示缩略图区块id */
       form.attr('enctype', 'multipart/form-data');
       form.attr('method', 'post');
       form.ajaxSubmit({
            data: {},
            success:function(data){
                console.log(data);
                var reqstr=eval("("+data+")");
                var html='';
                for (var i = 0; i <reqstr.src.length;i++) {
                    html+='<div class="controls di mr10">';
                    html+='<img style="height:100px; width:100px;color:gray;"  src="'+reqstr.src[i]+'">';
                    html+='<label for="" class="remove_img_btn"><i class="fa fa-close"></i></label>';
                    html+='<div class="img_btn_two"><span><i class="fa fa-caret-left"></i></span><span><i class="fa fa-caret-right"></i></span></div>';
                    html+='<input type="text" class="" name="'+imgname+'[]" style="display:none;" value="'+reqstr.src[i]+'">';
                    html+='</div>';
                }
                zst.parent().before(html);
                $(".remove_img_btn").click(function(){
                    $(this).parent().remove();
                });
                $(".img_btn_two span:first-child").click(function(event){
                    var prev=$(this).parent().parent().prev();
                    if(prev.attr("class")=="controls di mr10") {
                        prev.before($(this).parent().parent());
                    }
                    event.stopPropagation();
                });
                $(".img_btn_two span:last-child").click(function(event){
                    var next=$(this).parent().parent().next();
                    if(next.attr("class")=="controls di mr10") {
                        next.after($(this).parent().parent());
                    }
                    event.stopPropagation();
                });
            },
            error:function(data){
                console.log(data);
                alert("上传失败");
            },
            uploadProgress: function(event, position, total, percentComplete) {
                //percent.val(percentComplete);
            },
        });

}