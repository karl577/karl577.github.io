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
		<?php
			$pinthis_video_url = get_post_meta($post->ID, 'video_url', true);
			$pinthis_video_aspect_ratio = get_post_meta($post->ID, 'video_aspect_ratio', true);
			$pinthis_video_width = 236;
			$pinthis_video_height = '';
		?>
		<?php if ($pinthis_video_url) { ?>
		<div class="preview">
			<div class="thumb
			<?php 
				if ($pinthis_video_aspect_ratio == '16:9') {
					$pinthis_video_height = 133;
					echo ' ar-16-9';
				} elseif ($pinthis_video_aspect_ratio == '4:3') {
					echo ' ar-4-3';
					$pinthis_video_height = 177;	
				}
			?>
			<?php
				if (strpos($pinthis_video_url, 'youtube') > 0 || strpos($pinthis_video_url, 'vimeo') > 0) {
					echo ' remote-video';
				}
			?>
			">
			<?php
				if (strpos($pinthis_video_url, 'youtube') > 0) {
					echo wp_oembed_get($pinthis_video_url, array('width' => $pinthis_video_width, 'rel' => 0, 'showinfo' => 0, 'wmode' => 'opaque'));
				} elseif (strpos($pinthis_video_url, 'vimeo') > 0) {
					echo wp_oembed_get($pinthis_video_url, array('width' => $pinthis_video_width));
				} else {
					// get poster
					$img = '';
					if (has_post_thumbnail()) { 
						$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
						$params = array('width' => $pinthis_video_width);
						$img = bfi_thumb($large_image_url[0], $params);
					}
					if ($img) {
						$pinthis_video_poster = $img;
					} else {
						$pinthis_video_poster = '';	
					}
					// check video format
					$pinthis_video_extension = substr($pinthis_video_url, strrpos($pinthis_video_url, '.') + 1);
					$pinthis_video_format = strtolower($pinthis_video_extension);
					$pinthis_supported_video_formats = array('mp4', 'm4v', 'webm', 'ogv', 'wmv', 'flv');
					if (in_array($pinthis_video_format, $pinthis_supported_video_formats)) {
						echo do_shortcode('[video width="' . $pinthis_video_width . '" height="' . $pinthis_video_height . '" src="' . $pinthis_video_url . '" poster="' . $pinthis_video_poster . '"][/video]');
					} else { ?>
						<img src="<?php echo pinthis_get_skin_src(); ?>/images/no-video.png" width="236" height="236" alt="<?php the_title(); ?>">	
					<?php }
				}
			?>	
			</div>
		</div>
		<?php } ?>
		<div class="title">
			<h2 class="title-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</div>
		<div class="excerpt">
			<?php pinthis_excerpt(20); ?>
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