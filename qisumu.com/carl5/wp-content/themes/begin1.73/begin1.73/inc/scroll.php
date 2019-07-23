<ul id="scroll">
	<li><a class="scroll-t" title="返回顶部"><i class="fa fa-angle-up"></i></a></li>
	<?php if(is_single() || is_page()) { ?><li><a class="scroll-c" title="评论"><i class="fa fa-comment-o"></i></a></li><?php } ?>
	<li><a class="scroll-b" title="转到底部"><i class="fa fa-angle-down"></i></a></li>
	<?php if (zm_get_option('qr_img')) { ?><li><a class="qr" title="二维码"><i class="fa fa-qrcode"></i></a></li><?php } ?>
</ul>

<?php if (zm_get_option('qr_img')) { ?>
<span class="qr-img"><img src="http://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php the_permalink(); ?>" alt="<?php the_title(); ?>"/></span>
<?php } ?>