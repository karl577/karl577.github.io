//Set Bookmark
jQuery.fn.addFavorite = function(l, h) {
 return this.click(function() {
 var t = jQuery(this);
 if(jQuery.browser.msie) {
 window.external.addFavorite(h, l);
 } else if (jQuery.browser.mozilla || jQuery.browser.opera) {
 t.attr("rel", "sidebar");
 t.attr("title", l);
 t.attr("href", h);
 } else {
 alert("请使用Ctrl+D将本页加入收藏夹！");
 }
 });
};
$(function(){
 $('#fav').addFavorite(document.title,location.href);
});
//Menu
$(function(){
	if( $(window).width() > 768 ){
		$(".navi li").hover(function(){
			$(this).find('ul:first').slideDown("fast").css({display:"block"});
		},function(){
			$(this).find('ul:first').slideUp("fast").css({display:"none"});
		});
		$(window).scroll(function(){
			if($(window).scrollTop() >= 130){
				$(".navbar").addClass("pinned");
			}else{
				$(".navbar").removeClass("pinned");
			}
		});
	}
	
});
// MobileMenu
$(function(){
	$('.mobile-menu').click( function(){
			$(".main-menu").slideToggle("fast");
			$(this).toggleClass('active');
			$(".search-box").css({display:"none"});
			$(".btn-search").removeClass('active');
		}
	);
});
// SearchForm
$(function(){
	$(".btn-search").click(function(){
			$(".search-box").slideToggle("fast");
			$(this).toggleClass('active');
			if( $(window).width() < 768 ){
				$(".main-menu").css({display:"none"});
			}
			$('.mobile-menu').removeClass('active');
		}
	);
});
// Menu First
$(function(){
	$(".news .col-box-list ul li:first").addClass("highlight");
	$(".postlist li:last").addClass("nb");
	$(".foot-rt img").addClass("fadeInLeft wow animated");
});
// Slideshow
$(function(){
	$("#slidebanner").hover(function(){
		$("#slidebanner .bx-prev").fadeIn();
		$("#slidebanner .bx-next").fadeIn();
	},function(){
		$("#slidebanner .bx-prev").fadeOut();
		$("#slidebanner .bx-next").fadeOut();
	});
	$('#slideshow').bxSlider({
		mode: 'fade', /*'horizontal', 'vertical'*/
		controls: true, 
		prevText: '上一张',
		nextText: '下一张',
		auto: true,
		speed: 500,
		pause: 5000,
		pager: true
	});
});
//NewsSlider
$(function(){
	$("#news-slider").hover(function(){
		$("#news-slider .bx-prev").fadeIn();
		$("#news-slider .bx-next").fadeIn();
	},function(){
		$("#news-slider .bx-prev").fadeOut();
		$("#news-slider .bx-next").fadeOut();
	});
  	$('#news-slider ul').bxSlider({
		mode: 'horizontal', /*'fade', 'horizontal', 'vertical'*/
		captions: true,
		controls: true, 
		prevText: '上一张',
		nextText: '下一张',
		auto: true,
		speed: 500,
		pause: 4000,
		pager: true
	});
});
// TickerSlider
$(function(){
	var ratio = 0.70;
	var liWidth = $('.pic-scroll-list .slide').width();
	var liHeight = liWidth * ratio;
    $('.pic-scroll-list .slide img').width( liWidth );
    $('.pic-scroll-list .slide img').height( liHeight );
	if( $(window).width() > 960 ){
		$('#ticker').bxSlider({
			wrapperClass: 'ticker-wrapper',
			slideWidth: 5000,
			pager: false,
			auto: true,
			minSlides: 4,
			maxSlides: 4,
			pause: 4000,
			speed: 800,
			slideMargin: 15
		});
	} else if( $(window).width() <= 960 && $(window).width() >= 768 ){
		$('#ticker').bxSlider({
			wrapperClass: 'ticker-wrapper',
			slideWidth: 5000,
			pager: false,
			auto: true,
			minSlides: 2,
			maxSlides: 2,
			pause: 4000,
			speed: 800,
			slideMargin: 15
		});
	} else if( $(window).width() < 768 ){
		$('#ticker').bxSlider({
			wrapperClass: 'ticker-wrapper',
			slideWidth: 5000,
			pager: false,
			auto: true,
			minSlides: 1,
			maxSlides: 1,
			pause: 4000,
			speed: 800,
			slideMargin: 0
		});
	}
});
//Piclist-ImageResponsive
$(function(){
	var ratio = 0.70;
	var liWidth = $('.piclist li').width();
	var liHeight = liWidth * ratio;
    $('.piclist li img').width( liWidth );
    $('.piclist li img').height( liHeight );
	
});
//Weixin
$(function(){
	$("#s_weixin").hover(function(){
		$("#weixin").slideDown("fast").css({display:"block"});
	},function(){
		$("#weixin").slideUp("fast").css({display:"none"});
	});
});
//BackTop
$(function(){
	var $backToTopTxt = "", $backToTopEle = $('<a class="backToTop" title="返回顶部"></a>').appendTo($("body"))
		.text($backToTopTxt).attr("title", $backToTopTxt).click(function() {
			$("html, body").animate({ scrollTop: 0 }, 120);
	}), $backToTopFun = function() {
		var st = $(document).scrollTop(), winh = $(window).height();
		(st > 0)? $backToTopEle.fadeIn(): $backToTopEle.fadeOut();
		if (!window.XMLHttpRequest) {
			$backToTopEle.css("top", st + winh - 166);	
		}
	};
	$(window).bind("scroll", $backToTopFun);
	$(function() { $backToTopFun(); });
});