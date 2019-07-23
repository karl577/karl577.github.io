jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});

(function($) {
jQuery.fn.lavaLamp = function(o) {
	o = $.extend({
				'target': 'li', 
				'fx': 'easeOutQuint',
				'speed': 500, 
				'click': function(){return true}, 
				'startItem': '',
				'autoReturn': true,
				'returnDelay': 0,
				'setOnClick': true,
				'homeTop':0,
				'homeLeft':0,
				'homeWidth':0,
				'homeHeight':0,
				'returnHome':false,
				'autoResize':false
				}, 
			o || {});

	function getInt(arg) {
		var myint = parseInt(arg);
		return (isNaN(myint)? 0: myint);
	}

	if (o.autoResize)
		$(window).resize(function(){
			$(o.target+'.current-menu-item').trigger('mouseenter');
		});

	return this.each(function() {
		if ($(this).css('position')=='static')
			

		if (o.homeTop || o.homeLeft) { 
			var $home = $('<'+o.target+' class="homeLava"></'+o.target+'>').css({ 'left':o.homeLeft, 'top':o.homeTop, 'width':o.homeWidth, 'height':o.homeHeight, 'position':'absolute','display':'block' });
			$(this).prepend($home);
		}

		var path = location.pathname + location.search + location.hash, $selected, $back, $lt = $(o.target+'[class!=noLava]', this), delayTimer, bx=0, by=0;

		$selected = $(o.target+'.current-menu-item', this);
		
		if (o.startItem != '')
			$selected = $lt.eq(o.startItem);

	
		if ((o.homeTop || o.homeLeft) && $selected.length<1)
			$selected = $home;

	
		if ($selected.length<1) {
			var pathmatch_len=0, $pathel;
	
			$lt.each(function(){ 
				var thishref = $('a:first',this).attr('href');
	
				if (path.indexOf(thishref)>-1 && thishref.length > pathmatch_len )
				{
					$pathel = $(this);
					pathmatch_len = thishref.length;
				}
	
			});
			if (pathmatch_len>0) {

				$selected = $pathel;
			}

		}

		if ( $selected.length<1 )
			$selected = $lt.eq(0);
		$selected = $($selected.eq(0).addClass('current-menu-item'));
			
		$lt.bind('mouseenter', function() {

			if(delayTimer) {clearTimeout(delayTimer);delayTimer=null;}
			move($(this));
		}).click(function(e) {
			if (o.setOnClick) {
				$selected.removeClass('current-menu-item');
				$selected = $(this).addClass('current-menu-item');
			}
			return o.click.apply(this, [e, this]);
		});
		
		$back = $('<'+o.target+' class="backLava"></'+o.target+'>').css({'position':'absolute','display':'block'}).prependTo(this);

		bx = getInt($back.css('borderLeftWidth'))+getInt($back.css('borderRightWidth'))+getInt($back.css('paddingLeft'))+getInt($back.css('paddingRight'));
		by = getInt($back.css('borderTopWidth'))+getInt($back.css('borderBottomWidth'))+getInt($back.css('paddingTop'))+getInt($back.css('paddingBottom'));


		if (o.homeTop || o.homeLeft)
			$back.css({ 'left':o.homeLeft, 'top':o.homeTop, 'width':o.homeWidth, 'height':o.homeHeight });
		else
		{
			$back.css({ 'left': $selected.position().left, 'top': $selected.position().top, 'width': $selected.outerWidth()-bx, 'height': $selected.outerHeight()-by }); 
		}

		$(this).bind('mouseleave', function() {
			var $returnEl = null;
			if (o.returnHome)
				$returnEl = $home;
			else if (!o.autoReturn)
				return true;
		
			if (o.returnDelay) {
				if(delayTimer) clearTimeout(delayTimer);
				delayTimer = setTimeout(function(){move($returnEl);},o.returnDelay);
			}
			else {
				move($returnEl);
			}
			return true;
		});

		function move($el) {
			if (!$el) $el = $selected;

			$back.stop()
			.animate({
				'left': $el.position().left,
				'top': $el.position().top,
				'width': $el.outerWidth()-bx,
				'height': $el.outerHeight()-by
			}, o.speed, o.fx);
		};
	});
	
};
})(jQuery);
$(function() {
	$("article img, article a,header a,footer a, #logobar a,aside a").each(function(b) {
		if (this.title) {
			var c = this.title;
			var a = 30;
			$(this).mouseover(function(d) {
				this.title = "";
				$("body").append('<div id="tooltip">' + c + "</div>");
				$("#tooltip").css({
					left: (d.pageX + a) + "px",
					top: d.pageY + "px",
					opacity: "0.8"
				}).fadeIn(250)
			}).mouseout(function() {
				this.title = c;
				$("#tooltip").remove()
			}).mousemove(function(d) {
				$("#tooltip").css({
					left: (d.pageX + a) + "px",
					top: d.pageY + "px"
				})
			})
		}
	})
});
$(".link-back2top").hide();
$(window).scroll(function() {
	if ($(this).scrollTop() > 100) {
		$(".link-back2top").fadeIn();
	} else {
		$(".link-back2top").fadeOut();
	}
});
$(".link-back2top a").click(function() {
	$("body,html").animate({
		scrollTop: 0
	},
	800);
	return false;
});

 
$(".pingpart").click(function() {
	$(this).css({
		color: "#b3b3b3"
	});
	$(".commentshow").hide(400);
	$(".pingtlist").show(400);
	$(".commentpart").css({
		color: "#A0A0A0"
	})
});
$(".commentpart").click(function() {
	$(this).css({
		color: "#b3b3b3"
	});
	$(".pingtlist").hide(400);
	$(".commentshow").show(400);
	$(".pingpart").css({
		color: "#A0A0A0"
	})
});

$('.report, .report1').click(function() {
	$body.animate({
		scrollTop: $('#comment').offset().top
	},
	400)
});

jQuery(document).ready(function($) {
	$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');//commentnav ajax
	$('.commentnav a').live('click',function(e) {
		e.preventDefault();
		$.ajax({
			type: "GET",
			url: $(this).attr('href'),
			beforeSend: function() {
				$('.commentnav').remove();
				$('.commentlist').remove();
				$('#loading-comments').slideDown();
			},
			dataType: "html",
			success: function(out) {
				result = $(out).find('.commentlist');
				nextlink = $(out).find('.commentnav');
				$('#loading-comments').slideUp(550);
				$('#loading-comments').after(result.fadeIn(800));
				$('.commentlist').after(nextlink);
				$(".reply").ajaxReply();//绑定@事件
				$(".text p a").bigfaCom();
				$(".commentsgood").bigfaReply();
			}
		});
	});	
});
jQuery.fn.ajaxLoad = function(){
$('#content h2 a').click(function(e) {
		e.preventDefault();
		var htm = '假装异步加载ing',
		i = 9,
		t = $(this).html(htm).unbind('click'); (function ct() {
			i < 0 ? (i = 9, t.html(htm), ct()) : (t[0].innerHTML += '.', i--, setTimeout(ct, 200))
		})();
		window.location = this.href
	});
};
$("#content h2 a").ajaxLoad();	
jQuery.fn.ajaxReply = function(){$(this).click(//@ + username
	function(){	
    var atname = $(this).parent().find('.name').text();
$("#comment").attr("value","@" + atname + "：").focus();
});
$('.cancel_comment_reply a').click(function() {
$("#comment").attr("value",'');
	});
};
$(".reply").ajaxReply();
jQuery.fn.bigfaCom = function(){
var id = /^#comment-/;
var at = /^@/;
$(this).each(function() {
	if ($(this).attr('href').match(id) && $(this).text().match(at)) {
		$(this).addClass('atreply');
	}
});
$('.atreply').hover(function() {
	$($(this).attr('href')).find('div:first').clone().hide().insertAfter("body").attr('id', '').addClass('tip').fadeIn(200);
},
function() {
	$('.tip').fadeOut(400,
	function() {
		$(this).remove();
	});
});
$('.atreply').mousemove(function(e) {
	$('.tip').css({
		left: (e.pageX + 18),
		top: (e.pageY + 18)
	})
});
};
$(".text p a").bigfaCom();
jQuery.fn.bigfaReply = function(){
$(this).hover(function(){$(this).find(".reply").fadeIn(0);},function(){$(this).find(".reply").fadeOut(0);});
};
$(".commentsgood").bigfaReply();
$("aside ul.tworow li").hover(function(){$(this).find('ul:first').slideDown(200);},function(){$(this).find('ul:first').slideUp(200)});	
;$("aside ul .children li:last-child").css({border:'none'});
$(document).ready(function() {
var secondary_top, secondary_left, secondary_height, primary_height, colophon_height;
function init() {
secondary_top = $('#secondary').offset().top;
secondary_left = $('#secondary').offset().left;
secondary_height = $('#secondary').height();
article_left = $('article').offset().left;
primary_height = $('#primary').height();
colophon_height = $(document).height() - $('#colophon').height() - $('#colophon').offset().top;
}
init();
$(window).resize(function () {
	init();
});
$(document).scroll(function () {	
	if ($(this).scrollTop() + $(window).height() > secondary_top + secondary_height && secondary_height < primary_height) {
		$('#secondary').css({
			'position': 'fixed',
			'left': secondary_left,
			'top': $(window).height() - secondary_height - colophon_height,
		})
	} else {
		$('#secondary').css({
			'position': 'absolute',
			'left': secondary_left - article_left,
			'top': 0
		})
	}
});
});


$(window).scroll(function() {				
					var menuTop = $(window).scrollTop();
				
				if (menuTop > 120) {
                    $('header').addClass('headershadow');
				}else {
					$('header').removeClass('headershadow');
				}
				
			});


$("#nav ul").css({
		display: "none"
	});
$("#nav li").hover(function() {
		$(this).find('ul:first').css({
			display: "none"
		}).filter(":not(:animated)").animate({
			opacity: "show",
			height: "show"
		}, "fast ")
	}, function() {
		$(this).find('ul:first').animate({
			opacity: "hide",
			height: "hide"
		}, "100")
	});	
	
$('#tab-author').click(function() {
		$('#author-info').hide();
		$('#comment-author-info').show();
		$('#author').focus();
		
	})
	
	$('#comment').focus(function(){
		$('.post-area').addClass('post-area-hover');
	})
	$('#comment').blur(function(){
		$('.post-area').removeClass('post-area-hover');
	})	
$(".navdrop").hover(function() {	
$("#nav,#navbar-shadow").show();
},function() {
$("#nav,#navbar-shadow").hide();
});	
$(".searchdrop").hover(function() {	
$(".seacrhgood,#navbar-shadow").show();
},function() {
$(".seacrhgood,#navbar-shadow").hide();
});	
$(".followdrop").hover(function() {	
$(".followgood,#navbar-shadow").show();
},function() {
$(".followgood,#navbar-shadow").hide();
});	
$(".sharedrop").hover(function() {	
$(".sharecontent,#navbar-shadow").show();
},function() {
$(".sharecontent,#navbar-shadow").hide();
});	
$('#comment-smiley').click(function(){
		$('#smileys').show();
	})
	
	$('#smileys a').click(function(){
		$(this).parent().hide();
	})
function addEditor(a, b, c) {
		if (document.selection) {
			a.focus();
			sel = document.selection.createRange();
			c ? sel.text = b + sel.text + c: sel.text = b;
			a.focus()
		} else if (a.selectionStart || a.selectionStart == '0') {
			var d = a.selectionStart;
			var e = a.selectionEnd;
			var f = e;
			c ? a.value = a.value.substring(0, d) + b + a.value.substring(d, e) + c + a.value.substring(e, a.value.length) : a.value = a.value.substring(0, d) + b + a.value.substring(e, a.value.length);
			c ? f += b.length + c.length: f += b.length - e + d;
			if (d == e && c) f -= c.length;
			a.focus();
			a.selectionStart = f;
			a.selectionEnd = f
		} else {
			a.value += b + c;
			a.focus()
		}
	}
var g = document.getElementById('comment') || 0;
var h = {
		strong: function() {
			addEditor(g, '<strong>', '</strong>')
		},
		em: function() {
			addEditor(g, '<em>', '</em>')
		},
		del: function() {
			addEditor(g, '<del>', '</del>')
		},
		underline: function() {
			addEditor(g, '<u>', '</u>')
		},
		quote: function() {
			addEditor(g, '<blockquote>', '</blockquote>')
		},
		ahref: function() {
			var a = prompt('请输入链接地址', 'http://');
			var b = prompt('请输入链接描述','');
			if (a) {
				addEditor(g, '<a target="_blank" href="' + a + '"rel="external">' + b + '</a>','')
			}
		},
		img: function() {
			var a = prompt('请输入图片地址', 'http://');
			if (a) {
				addEditor(g, '<img src="' + a + '" alt="" />','')
			}
		},
		code: function() {
			addEditor(g, '<pre>', '</pre>')
		}
	};
	window['SIMPALED'] = {};
	window['SIMPALED']['Editor'] = h
$("section .post:last-child").css({borderBottom:'1px #ccc dotted'})	
$(window).scroll(function(){if($(window).scrollTop()>100){$('#hellobaby').fadeOut(400);}else{}});
$('.tab-title li').click(function(){
 
	$(this).addClass("selected").siblings().removeClass();
 
	$(".tab-inner > ul").hide(400).eq($('.tab-title li').index(this)).show(400);
 
});
var recentComments = 0,
	commentChange = 46,
	isExpand = $('#recent-comments-expand').length;
	if (isExpand > 0) commentChange = 90;
	$('aside .old-comments').click(function() {
		if (recentComments < 0) {
			recentComments = recentComments + commentChange;
			$('aside .recentcomments').animate({
				top: recentComments
			},
			250)
		}
	});
	$('aside .new-comments').click(function() {
		if (recentComments > -230) {
			recentComments = recentComments - commentChange;
			$('aside .recentcomments').animate({
				top: recentComments
			},
			250)
		}
	});
	$('#sidebar .old-comments, #sidebar .new-comments').bind('selectstart',
	function() {
		return false
	});
$("#postloading").delay(1000).hide();
$(".Related_Posts").fadeIn(900);
$('.theme-tabs li').each(function(e){
$(this).click(function(){
$(this).addClass('active').siblings().removeClass('active');
$($('.theme-main')[e]).fadeIn(200).siblings('.theme-main').hide();
})
}) 


$(".poster").click(function() {

	$(this).next().show(400);
	
});
$(".aclist").click(function() {

	$(this).hide(400);
	
});

$('.post-tabs span').each(function(e){
$(this).click(function(){
$(this).addClass('active').siblings().removeClass('active');
$($('.tab-content')[e]).fadeIn(200).siblings('.tab-content').hide();
});
}); 
 $(document).ready(function(){
$('.subhero-box').hover(function(){
$(".sub-title", this).stop().animate({bottom:'7px'},{queue:false,duration:400});
}, function() {
$(".sub-title", this).stop().animate({bottom:'-26px'},{queue:false,duration:400});
});
}); 