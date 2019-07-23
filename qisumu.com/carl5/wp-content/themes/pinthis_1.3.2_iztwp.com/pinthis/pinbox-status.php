<?php
	// get options
	$pinthis_pinbox_soc_icons = get_option('pbpanel_pinbox_soc_icons');
	$pinthis_pinbox_show_comments = get_option('pbpanel_pinbox_show_comments');
	$pinthis_pinbox_show_postdate = get_option('pbpanel_pinbox_show_postdate');
?>

<article class="pinbox">
	<div <?php post_class(); ?>>
		<?php if (is_sticky()) { ?>
		<span class="ribbon"><?php echo __('Sticky', 'pinthis'); ?></span>
		<?php } ?>
		<?php if ($pinthis_pinbox_soc_icons == 1) { ?>
		<div class="top-bar">
			<ul class="social-media-icons clearfix">
				<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" class="border-color-3 icon-facebook tooltip" title="<?php echo __('Share on Facebook', 'pinthis'); ?>" target="_blank"><?php echo __('Facebook', 'pinthis'); ?></a></li>
				<li><a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" class="border-color-1 icon-gplus tooltip" title="<?php echo __('Share on Google+', 'pinthis'); ?>" target="_blank"><?php echo __('Google+', 'pinthis'); ?></a></li>
				<li><a href="https://twitter.com/share?url=<?php echo get_permalink(); ?>" class="border-color-4 icon-twitter tooltip" title="<?php echo __('Share on Twitter', 'pinthis'); ?>" target="_blank"><?php echo __('Twitter', 'pinthis'); ?></a></li>
			</ul>
		</div>
		<?php } ?>
		<div class="excerpt">
			<a href="<?php the_permalink(); ?>"><?php pinthis_excerpt(); ?></a>
		</div>
		<div class="meta-data">
			<ul class="clearfix">
				<?php if ($pinthis_pinbox_show_comments == 1 || $pinthis_pinbox_show_postdate == 1) { ?> 
					<?php if ($pinthis_pinbox_show_comments == 1) { ?>
					<li class="border-color-1 tooltip <?php if ($pinthis_pinbox_show_postdate != 1) { ?>full<?php } ?>" title="<?php echo __('Total comments', 'pinthis'); ?>">
						<?php if ($pinthis_pinbox_show_comments == 1) { ?>
							<span class="icon-total-comments"><?php comments_number('0', '1', '%'); ?></span>
						<?php } ?>
					</li>
					<?php } ?>
					<?php if ($pinthis_pinbox_show_postdate == 1) { ?>
					<li class="border-color-2 tooltip <?php if ($pinthis_pinbox_show_comments != 1) { ?>full<?php } ?>" title="<?php echo __('Post date', 'pinthis'); ?>">
						<?php if ($pinthis_pinbox_show_postdate == 1) { ?>
							<span class="icon-post-date"><?php echo get_the_date('d.m.y'); ?></span>
						<?php } ?>
					</li>
					<?php } ?>
				<?php } else { ?>
				<li class="border-color-1 empty">&nbsp;</li>
				<li class="border-color-2 empty">&nbsp;</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</article>