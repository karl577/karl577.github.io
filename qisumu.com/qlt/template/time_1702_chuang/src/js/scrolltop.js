/* 
   ------------------------

	   JS GLOBAL FUNCTON ADDED BY QQ179667784

   ------------------------
*/

jQuery.noConflict();
jQuery(function(jQuery) {
	/*返回到顶部*/
	if(jQuery('.js_scrolltop').length>0){
		jQuery(window).scroll(function(){
			showTopLink();
			flytop(jQuery('.js_scrolltop'));
		});

		showTopLink();
		flytop(jQuery('.js_scrolltop'));
		var t;
		jQuery('.js_scrolltop').bind('mouseover',function(){
			timedCount();
		}).bind('mouseout',function(){
			stopCount();
			jQuery(this).children().children('.scrolltopb').children('img').stop().animate({'height':'14px'},0);
		}).bind('click',function(){
			jQuery('html, body').animate({scrollTop:0},'500');
			jQuery(this).animate({'bottom':jQuery(this).innerHeight()+jQuery(window).innerHeight()+20,'opacity':'0'},500,function(){
				jQuery(this).css('bottom','-100px');
			});
		});

	}
});

//返回顶部显示或出现
function flytop(operationObj){
	if(jQuery(window).scrollTop()>100){
		if( operationObj.css('bottom')==="-100px"){
			operationObj.animate({'bottom':'100px','opacity':'1'},100);	
		}
	}else{
		operationObj.animate({'bottom':'-100px','opacity':'0'},100);
	}
}
//返回顶部鼠标放上火箭动画效果
var t;
function timedCount(){
	var thisobj=jQuery('.js_scrolltop');
	thisobj.children().children('.scrolltopb').children('img').animate({'height':'21px'},200,function(){
			jQuery(this).animate({'height':'14px'},300,function(){
				jQuery(this).animate({'height':'21px'},200,function(){
					jQuery(this).animate({'height':'28px'},100,function(){
						jQuery(this).animate({'height':'21px'},200,function(){
							jQuery(this).animate({'height':'14px'},300);
						});
					});
				});
			});
		});
	t=setTimeout("timedCount()",1500);
}
function stopCount(){
	clearTimeout(t);
}