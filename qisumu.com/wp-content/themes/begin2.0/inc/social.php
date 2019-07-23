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
		<span class="shang-p">
			<?php if ( zm_get_option('alipay_name') == '' ) { ?>
				<span class="shang-s"><a title="<?php echo zm_get_option('alipay_t'); ?>"><?php echo zm_get_option('alipay_name'); ?></a></span></span>
			<?php } else { ?>
				<span class="tipso_style" id="tip-p" data-tipso='
					<div id="shang">
						<div class="shang-main">
							<?php if ( zm_get_option('alipay_h') == '' ) { ?><?php } else { ?><h4><i class="fa fa-heart" aria-hidden="true"></i> <?php echo zm_get_option('alipay_h'); ?></h4><?php } ?>
							<?php if ( zm_get_option('qr_a') == '' ) { ?>
							<?php } else { ?>
								<div class="shang-img">
									<img src="<?php echo zm_get_option('qr_a'); ?>" />
									<?php if ( zm_get_option('alipay_z') == '' ) { ?><?php } else { ?><h4><?php echo zm_get_option('alipay_z'); ?></h4><?php } ?>
								</div>
							<?php } ?>

							<?php if ( zm_get_option('qr_b') == '' ) { ?>
							<?php } else { ?>
								<div class="shang-img">
									<img src="<?php echo zm_get_option('qr_b'); ?>" />
									<?php if ( zm_get_option('alipay_w') == '' ) { ?><?php } else { ?><h4><?php echo zm_get_option('alipay_w'); ?></h4><?php } ?>
								</div>
							<?php } ?>
							<div class="clear"></div>
						</div>
					</div>'>
				<span class="shang-s"><a title="<?php echo zm_get_option('alipay_t'); ?>"><?php echo zm_get_option('alipay_name'); ?></a></span></span>
			<?php } ?>
		</span>
		<span class="share-sd">
				<span class="share-s"><a href="javascript:void(0)" id="share-s" title="分享"><i class="fa fa-share-alt"></i>分享</a></span>
				<?php if (zm_get_option('share')) { ?><?php get_template_part( 'inc/share' ); ?><?php } ?>
		</span>
		<div class="clear"></div>
	</div>
</div>