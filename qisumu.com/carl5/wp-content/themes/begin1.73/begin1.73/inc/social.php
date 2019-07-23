<div class="clear"></div>
<div id="social">
	<div class="social-main">
		<span class="like">
	         <a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" title="我赞" class="favorite<?php if(isset($_COOKIE['zm_like_'.$post->ID])) echo ' done';?>"><i class="fa fa-thumbs-up"></i>赞 <i class="count">
	            <?php if( get_post_meta($post->ID,'zm_like',true) ){
					echo get_post_meta($post->ID,'zm_like',true);
				} else {
					echo '0';
				}?></i>
	        </a>
		</span>
		<span class="shang-p"><a href="#shang" id="shang-main-p" title="<?php echo zm_get_option('alipay_t'); ?>"><?php echo zm_get_option('alipay_name'); ?></a></span>
		<span class="share-s"><a href="#share" id="share-main-s" title="分享"><i class="fa fa-share-alt"></i>分享</a></span>
		<div class="clear"></div>
	</div>
	<?php get_template_part( 'inc/share' ); ?>

	<div id="shang">
		<div class="shang-main">
			<?php if ( zm_get_option('alipay_h') == '' ) { ?><?php } else { ?><h4><?php echo zm_get_option('alipay_h'); ?></h4><?php } ?>
			<?php if ( zm_get_option('alipay_id') == '' ) { ?>
			<?php } else { ?>
				<form accept-charset="GBK" action="https://shenghuo.alipay.com/send/payment/fill.htm" method="POST" target="_blank"><input name="optEmail" type="hidden" value="<?php echo zm_get_option('alipay_id'); ?>" />
					<input name="payAmount" type="hidden" value="0" />
					<input id="title" name="title" type="hidden" value="<?php echo zm_get_option('reason'); ?>" />
					<input name="memo" type="hidden" value="<?php echo zm_get_option('comments_area'); ?>" />
					<input title="赞助本站" name="pay" src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/alipay.png" type="image" value="赞助本站" />
				</form>
				<h4>支付宝转账赞助</h4>
			<?php } ?>

			<?php if ( zm_get_option('qr_a') == '' ) { ?>
			<?php } else { ?>
				<img title="<?php echo zm_get_option('alipay_z'); ?>" src="<?php echo zm_get_option('qr_a'); ?>" />
				<?php if ( zm_get_option('alipay_z') == '' ) { ?><?php } else { ?><h4><?php echo zm_get_option('alipay_z'); ?></h4><?php } ?>
			<?php } ?>

			<?php if ( zm_get_option('qr_b') == '' ) { ?>
			<?php } else { ?>
				<img title="<?php echo zm_get_option('alipay_z'); ?>" src="<?php echo zm_get_option('qr_b'); ?>" />
				<?php if ( zm_get_option('alipay_w') == '' ) { ?><?php } else { ?><h4><?php echo zm_get_option('alipay_w'); ?></h4><?php } ?>
			<?php } ?>
		</div>
	</div>
</div>