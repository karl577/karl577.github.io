<?php if (zm_get_option('ad_a')) { ?>
	<?php if ($wp_query->current_post == 1) : ?>
		<?php if ( wp_is_mobile() ) { ?>
			 <?php if ( zm_get_option('ad_a_c_m') ) { ?><div class="ad-m ad-site"><?php echo stripslashes( zm_get_option('ad_a_c_m') ); ?></div><?php } ?>
		<?php } else { ?>
			 <?php if ( zm_get_option('ad_a_c') ) { ?><div class="ad-pc ad-site"><?php echo stripslashes( zm_get_option('ad_a_c') ); ?></div><?php } ?>
		<?php } ?>
	<?php endif; ?>
<?php } ?>