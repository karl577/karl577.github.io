/* 二级导航 */
$(document).ready(function(){
	$("#nav li").hover(function(){
		$('ul',this).css('display','block');
	}, function() {
		$('ul',this).css('display','none');
	});
	$(".box").hover(function(){
		$('.box-btn',this).css('display','block');
	}, function() {
		$('.box-btn',this).css('display','none');
	});
});

//图片放大
/*
$(function(){
	var x = 10;
	var y = 20;
	$("#meituimg").mouseover(function(e){
		var src = $(this).attr('src');
		var tooltip = "<div id='tooltip'><img src='"+ src +"'><\/div>"; //创建 div 元素
		$("body").append(tooltip);	//把它追加到文档中						 
		$("#tooltip")
			.css({
				"top": (e.pageY+y) + "px",
				"left":  (e.pageX+x)  + "px"
			}).show("fast");	  //设置x坐标和y坐标，并且显示
    }).mouseout(function(){
		$("#tooltip").remove();	 //移除 
    }).mousemove(function(e){
		$("#tooltip")
			.css({
				"top": (e.pageY+y) + "px",
				"left":  (e.pageX+x)  + "px"
			});
	});
});
*/

//图片缩放
$(window).bind("load", function() {
    // IMAGE RESIZE
    $('#author-post img').each(function() {
        var maxWidth = 78;
        var maxHeight = 78;
        var ratio = 0;
        var width = $(this).width();
        var height = $(this).height();
     
        if(width > height){
            $(this).css("height", maxHeight);
            var width = $(this).width();
            var left = (maxWidth-width)/2;
            $(this).css("left", left);
        } else {
	        $(this).css("width", maxWidth);
        }
    });
    //$("#contentpage img").show();
    // IMAGE RESIZE
});
$(window).bind("load", function() {
    // IMAGE RESIZE
    $('.guanzhu-new-img img').each(function() {
        var maxWidth = 74;
        var maxHeight = 74;
        var ratio = 0;
        var width = $(this).width();
        var height = $(this).height();
     
        if(width > height){
            $(this).css("height", maxHeight);
            var width = $(this).width();
            var left = (maxWidth-width)/2;
            $(this).css("left", left);
        } else {
	        $(this).css("width", maxWidth);
        }
    });
    //$("#contentpage img").show();
    // IMAGE RESIZE
});