// JavaScript Document
$(function(){
    /**任务管理，本周任务 选择任务类型 */
    $(".task_right_box span").click(function(){
        $(this).addClass("task_right_on").siblings().removeClass("task_right_on");
    })
    /** 任务管理，本周任务 周一到周日切换*/
    $('.task_week_list').eq(0).show();
	$(".task_week_day").click(function(){
			$(this).addClass("task_week_on").siblings().removeClass("task_week_on");
			var i=$(this).index();
			$('.task_week_list').eq(i).show().siblings().hide();
	});
    /**我的客户添加标签 */
    $(".myclient_top_add").click(function(){
        $(".model").show();
        $(".myclient_biao_section").show();
        $(".model_section1").css("opacity",'34');
        $(".model_section1").css("z-index",'34');
    })
    $(".model_section_top img").click(function(){
        $(".model").hide();
        $(".model_section").hide();
        $(".model_section2").css("opacity",'0');
        $(".model_section2").css("z-index",'-1');
        $(".model_section1").css("opacity",'0');
        $(".model_section1").css("z-index",'-1');
        $(".model_section3").css("opacity",'0');
        $(".model_section3").css("z-index",'-1');

    })
    $(".myclient_biao_add").click(function(){
        $(".myclient_biao_section").hide();
        $(".myclient_biao_new").show();
    })
    $(".myclient_biao_true").click(function(){
        $(".model").hide();
        $(".model_section").hide();
    })
    /**本周任务操作删除 */
    $(".task_week_icon").click(function(){
        $(".model").show();
        $(".model_section").show();
    })
    $(".model_btu1").click(function(){
        $(".model").hide();
        $(".model_section").hide();
    })
    /**任务详情 标记完成 */
    $(".taskfiles_left_biao").click(function(){
        $(".model").show();
        $(".model_section").show();
    })
    /**个人中心，常用语回复修改 */
    $(".myreply_info img").click(function(){
        $(this).siblings("span").attr("contenteditable",'true');
    })
    $(".myreply_btu").click(function(){
        $(".model").show();
        $(".myclient_biao_new").show();
    })
    /**个人中心 发布通知 发送指定标签客户 */
    $(".mynotice_kehu_area span").click(function(){
        $(this).toggleClass("task_right_on")
    })
    /**健康档案图表 */
    $('.health_data_area').eq(0).show();
	$(".health_data_caption").click(function(){
			$(this).addClass("health_data_on").siblings().removeClass("health_data_on");
			var i=$(this).index();
			$('.health_data_area').eq(i).show().siblings().hide();
	});
    /**会话添加群聊 */
    $(".sessionper_model_true1").click(function(){
        $(".model").show();
        // $(".myclient_biao_new").show();
        $(".myclient_biao_section").hide();
        $(".model_section2").css("opacity",'34');
        $(".model_section2").css("z-index",'34');
    })
    $(".sessiongroup_family_jia").click(function(){
        $(".model").show();
        // $(".myclient_biao_new").show();
        $(".myclient_biao_section").show();
        $(".model_section1").css("opacity",'34');
        $(".model_section1").css("z-index",'34');
    })
    $(".sessiongroup_family_jian").click(function(){
        $(".model").show();
        // $(".myclient_biao_new").show();
        $(".sessionper_delete").css("opacity",'34');
        $(".sessionper_delete").css("z-index",'34');
    })
    $(".sessionper_model_qu").click(function(){
        $(".model").hide();
        $(".myclient_biao_new").hide();
        $(".model_section2").css("opacity",'0');
        $(".model_section2").css("z-index",'-1');
        $(".sessionper_delete").css("opacity",'0');
        $(".sessionper_delete").css("z-index",'-1');
        $(".myclient_biao_section").hide();
    })
    $(".session_model_chooseadd").click(function(){
        $(".model").show();
        $(".myclient_biao_new").show();
    })
    var num = $(".sessiongroup_family_item").length;
    $(".sessiongroup_family_item:lt(8)").show();
    $(".sessiongroup_family_look").click(function(){
        $(".sessiongroup_family_item").show();
        $(".sessiongroup_family_shou").show();
        $(".sessiongroup_family_look").hide();
    })
    $(".sessiongroup_family_shou").click(function(){
        $(".sessiongroup_family_item").hide();
        $(".sessiongroup_family_item:lt(8)").show();
        $(".sessiongroup_family_shou").hide();
        $(".sessiongroup_family_look").show();
    })
    

    $(".session_entry_info").click(function(){
        $(this).toggleClass("session_entry_infokai")
    })


	$('.top').click(function(){
	       $('html , body').animate({scrollTop: 0},'slow');
	  });

    

});

$(document).ready(function () {
   
    var height1 = $('.header').height();
    var zong1 = height1
    $(window).scroll(function () {

        if ($(window).scrollTop() > zong1) {
           
            $(".nav").addClass('nav_on');
        } else {
           
            $(".nav").removeClass('nav_on');
        }

    });


});










