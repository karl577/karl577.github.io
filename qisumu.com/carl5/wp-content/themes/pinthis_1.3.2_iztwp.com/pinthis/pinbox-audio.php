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
		<div class="preview">
			<p class="thumb">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php if (has_post_thumbnail()) { ?>
						<?php  
						$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
						$params = array('width' => 236);
						$img = bfi_thumb($large_image_url[0], $params);
						$parsed_url = parse_url($img, PHP_URL_PATH);
						if ($img) {
							list($width, $height) = getimagesize($_SERVER['DOCUMENT_ROOT'] . $parsed_url);
						?>
							<img src="<?php echo $img; ?>" width="236" height="<?php echo $height; ?>" alt="<?php the_title(); ?>">
						<?php
						} else {
							the_post_thumbnail('medium');	
						}
					?>
					<?php } else { ?>
						<img src="<?php echo pinthis_get_skin_src(); ?>/images/no-image.png" width="236" height="236" alt="<?php the_title(); ?>">
					<?php } ?>
				</a>
			</p>
		</div>
		<?php
			$pinthis_audio_url = get_post_meta($post->ID, 'audio_url', true);
		?>
		<?php if ($pinthis_audio_url) { ?>
		<div class="audio-bar">
			<?php
				// check audio format
					$pinthis_audio_extension = substr($pinthis_audio_url, strrpos($pinthis_audio_url, '.') + 1);
					$pinthis_audio_format = strtolower($pinthis_audio_extension);
					$pinthis_supported_audio_formats = array('mp3', 'm4a', 'ogg', 'wav', 'wma');
					if (in_array($pinthis_audio_format, $pinthis_supported_audio_formats)) {
						echo do_shortcode('[audio src="' . $pinthis_audio_url . '"][/audio]');
					}
			?>	
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