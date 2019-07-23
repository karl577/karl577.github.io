<div id="footer">
	<div class="w990">
		<p>Copyright © <?php the_time('Y'); ?> <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>. All rights reserved.</p>
		<p id="links"><span>LINKS</span> <a href="<?php bloginfo('url'); ?>">猫猫建站</a> <a href="<?php bloginfo('url'); ?>">猫猫建站</a> <a href="<?php bloginfo('url'); ?>">猫猫建站</a> <a href="<?php bloginfo('url'); ?>">猫猫建站</a> <a href="<?php bloginfo('url'); ?>">猫猫建站</a> <a href="<?php bloginfo('url'); ?>">猫猫建站</a> <a href="<?php bloginfo('url'); ?>">猫猫建站</a> <a href="<?php bloginfo('url'); ?>">猫猫建站</a> </p>
	</div>
</div>
</div>
<div class="option">
<ul class="list-option">
					<li><a href="javascript:history.go(-1);" title="返回上一页" class="icon icon-back list-option-link"><i>返回上一页</i></a></li>
					<li id="icon-share">
						<a href="##" title="分享此文章" class="icon icon-share list-option-link"><i>分享此文章</i></a>
						<!-- <h6 class="list-share-tit" style="display:none;">分享到：</h6> -->
						<ul class="clear list-share" style="width: 0px; display: none; overflow: hidden; ">
							<li><a href="javascript:;" title="分享到新浪微博" target="_blank">新浪微博</a></li>
							<li><a href="javascript:;" title="分享到腾讯微博" id="share_btn_qq">腾讯微博</a></li>
							<li><a href="javascript:;" target="_blank">QQ空间</a></li>
							<li class="list-share-tit">关注我:</li>
						</ul>
					</li>
				</ul>
</div>
<p class="link-back2top" style="display: block; "><a href="#" title="Back to top">Back to top</a></p>
</body>
<?php wp_footer(); ?>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.masonry.min.js"></script>
<script>
var $container = $('#container');
$container.imagesLoaded(function(){
  $container.masonry({
    itemSelector : '.post',
    columnWidth : 250
  });
});
</script>
<script type="text/javascript">
$(function(){
    var mytop,getPosTop
    $(window).resize(function()
    {
        mytop = $(document).scrollTop();
        if($(document).scrollTop()>="1"){
        $("#header1").css({"top":mytop});
        };
    });

    $(window).scroll(function()
    {
        mytop = $(document).scrollTop();
        if($(document).scrollTop()>="1"){
        	$("#header1").css({"top":mytop});
        }else {
        	$("#header1").css({"top":0});
        };
    });
});
jQuery(document).ready(function(){
	jQuery(".post").hover(function(){    	
        jQuery(".piax",this).addClass('hvv'); 
    }, function(){    
        jQuery(".piax",this).removeClass('hvv');
    });    
});
jQuery(document).ready(function(){
	jQuery(".arcbox").hover(function(){    	
        jQuery(".piax",this).addClass('hvv'); 
    }, function(){    
        jQuery(".piax",this).removeClass('hvv');
    });    
    jQuery("#icon-share").hover(function(){    	
		        $('ul.list-share').animate({width:300}, 600);
		        $('ul.list-share').css('display','block');
		        $('.icon-share').addClass('hvv');
		        
		    }, function(){    
		       	$('ul.list-share').animate({width:0}, 1);
		       	$('ul.list-share').css('display','none');
		       	$('.icon-share').removeClass('hvv');
		    });
});
</script>
<script>
$(function(){
	$.fn.scrollToTop=function(){
		var scrollDiv=$(this);
		$(window).scroll(function(){
			if($(window).scrollTop()<"1"){
				$(scrollDiv).removeClass("fixednav")
			}else{
				$(scrollDiv).addClass("fixednav")
			}
		});
	}
});

$(function() {
	$("#header1").scrollToTop();
});
</script>
</html>