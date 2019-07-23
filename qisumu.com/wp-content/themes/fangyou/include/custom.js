//下拉菜单
var nav={animateduration:{over:200,out:200},buildmenu:function(menuid,arrowsvar){jQuery(document).ready(function($){var $mainmenu=$("#"+menuid+">ul")
var $headers=$mainmenu.find("ul").parent()
$headers.each(function(i){var $curobj=$(this)
var $subul=$(this).find('ul:eq(0)')
this._dimensions={w:this.offsetWidth,h:this.offsetHeight,subulw:$subul.outerWidth(),subulh:$subul.outerHeight()}
this.istopheader=$curobj.parents("ul").length==1?true:false
$subul.css({top:this.istopheader?this._dimensions.h+"px":0})
$curobj.children("a:eq(0)").css(this.istopheader?{}:{}).append('')
$curobj.hover(function(e){var $targetul=$(this).children("ul:eq(0)")
this._offsets={left:$(this).offset().left,top:$(this).offset().top}
var menuleft=this.istopheader?0:this._dimensions.w
menuleft=(this._offsets.left+menuleft+this._dimensions.subulw>$(window).width())?(this.istopheader?-this._dimensions.subulw+this._dimensions.w:-this._dimensions.w):menuleft
if($targetul.queue().length<=1)
$targetul.css({left:menuleft+"px",width:this._dimensions.subulw+'px'}).slideDown(nav.animateduration.over)},function(e){var $targetul=$(this).children("ul:eq(0)")
$targetul.slideUp(nav.animateduration.out)})
$curobj.click(function(){$(this).children("ul:eq(0)").hide()})})
$mainmenu.find("ul").css({display:'none',visibility:'visible'})})}}
nav.buildmenu("submenu")
//微信二维码
jQuery(function(a){a(".social li").hover(function(){a(this).find(".weixinimg").slideDown(200)},function(){a(this).find(".weixinimg").hide(0)})});
//返回顶部
jQuery(function(e){var t=100;var n=e("a.backtop");var r=500;n.hide();e(window).scroll(function(){var r=e(document).scrollTop();if(r>t){e(n).stop().fadeTo(300,1)}else{e(n).stop().fadeTo(300,0)}});e(n).click(function(){e("html, body").animate({scrollTop:0},r);return false})});
//标签云显示文章数
jQuery(".tagcloud a").append("<span></span>");jQuery(".tagcloud a").find("span").html(function(){var s=$(this).parent().attr("title").replace(/[^0-9]/ig,"");return" ["+parseInt(s)+"]";});