<ul id="scroll">
<div class="log log-no"><li><a class="log-button" title="文章目录"><i class="fa fa-bars"></i></a></li><div class="log-prompt"><div class="log-arrow">文章目录</div></div></div>
	<li><a class="scroll-h" title="返回顶部"><i class="fa fa-angle-up"></i></a></li>
	<?php if(is_single() || is_page()) { ?><li><a class="scroll-c" title="评论"><i class="fa fa-comment-o"></i></a></li><?php } ?>
	<li><a class="scroll-b" title="转到底部"><i class="fa fa-angle-down"></i></a></li>
	<?php if (zm_get_option('gb2')) { ?><li><a name="gb2big5" id="gb2big5"><span>繁</span></a></li><?php } ?>	
	<li class="qqonline">
	<div class="online"><a href="javascript:void(0)"><i class="fa fa-qq"></i></a></div>
	<div class="qqonline-box" style="display: none;">
	<div class="qqonline-main">
	<?php if ( zm_get_option('weixing_qr') == '' ) { ?>
		<?php } else { ?>
	<div class="nline-wiexin">
	<h4>微信</h4>
	<img title="微信" src="<?php echo zm_get_option('weixing_qr'); ?>"/>
	</div>
	<?php } ?>
	<div class="nline-qq">
	<a target=blank href=http://wpa.qq.com/msgrd?V=3&uin=<?php echo zm_get_option('qq_id'); ?>&Site=QQ&Menu=yes>
	<i class="fa fa-qq"></i><?php echo zm_get_option('qq_name'); ?></a>
	</div></div></div></li>
	<?php if (zm_get_option('qr_img')) { ?>
		<li><a href="javascript:void(0)" class="qr" title="二维码"><i class="fa fa-qrcode"></i><span class="qr-img"><div id="output"><img class="alignnone"src="<?php echo zm_get_option('qr_icon'); ?>" /></div></span></a></li>
		<script type="text/javascript">$(document).ready(function(){if(!+[1,]){present="table";} else {present="canvas";}$('#output').qrcode({render:present,text:window.location.href,width:"150",height:"150"});});</script>
	<?php } ?>
</ul>

