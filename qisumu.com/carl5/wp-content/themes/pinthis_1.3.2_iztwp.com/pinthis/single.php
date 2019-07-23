<?php get_header(); ?>

<?php
	// get options
	$pinthis_posts_in_same_cat = get_option('pbpanel_posts_in_same_cat');
?>

<section id="content">
	<div class="container clearfix">
		<div class="postWrap">
			<div <?php post_class(); ?>>
				<div class="contentbox">
					<?php while (have_posts()) { the_post(); ?>
					<?php 
						pinthis_setPostViews(get_the_ID()); 
						
						if ($pinthis_posts_in_same_cat == 1) {
							$pinthis_posts_in_same_cat_var = true;	
						} else {
							$pinthis_posts_in_same_cat_var = false;	
						}
					?>
					<div class="topbar">
						<ul class="navbtns">
							<li>
								<?php if (get_previous_post($pinthis_posts_in_same_cat_var)) {
									previous_post_link('%link', __('Previous post', 'pinthis'), $pinthis_posts_in_same_cat_var);
								} else {
									echo '<span class="no-link">' . __('Previous post', 'pinthis') . '</span>';	
								} ?>
							</li>
							<li>
								<?php if (get_next_post($pinthis_posts_in_same_cat_var)) { 
									next_post_link('%link', __('Next post', 'pinthis'), $pinthis_posts_in_same_cat_var); 
								} else {
									echo '<span class="no-link">' . __('Next post', 'pinthis') . '</span>';	
								} ?>
							</li>
						</ul>
						<p class="space border-color-5">&nbsp;</p>
					</div>
					<?php
						$pinthis_video_url = get_post_meta($post->ID, 'video_url', true);
						$pinthis_video_aspect_ratio = get_post_meta($post->ID, 'video_aspect_ratio', true);
						$pinthis_video_width = 1033;
					?>
					<?php if (has_post_format('video') && $pinthis_video_url != '') { ?>
					<div class="featured-video
					<?php 
						if ($pinthis_video_aspect_ratio == '16:9') {
							echo ' ar-16-9';
						} elseif ($pinthis_video_aspect_ratio == '4:3') {
							echo ' ar-4-3';	
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
								echo wp_oembed_get($pinthis_video_url, array('rel' => 0, 'showinfo' => 0));
							} elseif (strpos($pinthis_video_url, 'vimeo') > 0) {
								echo wp_oembed_get($pinthis_video_url);
							} else {
								// get poster
								$img = '';
								if (has_post_thumbnail()) { 
									$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
									$params = array('width' => 720);
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
									echo do_shortcode('[video width="' . $pinthis_video_width . '" src="' . $pinthis_video_url . '" poster="' . $pinthis_video_poster . '"][/video]');
								}
							}
						?>	
					</div>
					<?php } else { ?>
						<?php if (has_post_thumbnail()) { ?>
							<p class="featured-image">
								<?php 
									$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
									$params = array('width' => 720);
									$img = bfi_thumb($large_image_url[0], $params); 
								?>
								<?php if ($img) { ?>
								<img src="<?php echo $img; ?>" alt="<?php the_title(); ?>">
								<?php } else {
									the_post_thumbnail('full');	
								} ?>
							</p>
						<?php } ?>
					<?php } ?>
					<?php
						$pinthis_audio_url = get_post_meta($post->ID, 'audio_url', true);
					?>
					<?php if (has_post_format('audio') && $pinthis_audio_url != '') { ?>
					<div class="featured-audio">
						<?php
							// check video format
								$pinthis_audio_extension = substr($pinthis_audio_url, strrpos($pinthis_audio_url, '.') + 1);
								$pinthis_audio_format = strtolower($pinthis_audio_extension);
								$pinthis_supported_audio_formats = array('mp3', 'm4a', 'ogg', 'wav', 'wma');
								if (in_array($pinthis_audio_format, $pinthis_supported_audio_formats)) {
									echo do_shortcode('[audio src="' . $pinthis_audio_url . '"][/audio]');
								}
						?>
					</div>
					<?php } ?>
					<?php 
						$external_link = get_post_meta($post->ID, 'external_link', true); 
						$external_link_title = get_post_meta($post->ID, 'external_link_title', true);
						
						$pinthis_quote_text = get_post_meta($post->ID, 'quote_text', true);
						$pinthis_quote_author = get_post_meta($post->ID, 'quote_author', true); 
					?>
					<?php if (has_post_format('quote') && $pinthis_quote_text != '') { ?>
					<blockquote class="quote-block clearfix">
						<p class="quote-text"><?php echo $pinthis_quote_text; ?></p>
						<?php if ($pinthis_quote_author != '') { ?>
						<p class="quote-author"><?php echo $pinthis_quote_author; ?></p>
						<?php } ?>
					</blockquote>
					<?php } else { ?>
					<h3 class="title-3 <?php if ($external_link && '' != $external_link) { ?>have-button<?php } ?>">
						<?php if ($external_link && '' != $external_link) { ?>
							<a href="<?php echo pinthis_addScheme($external_link); ?>" class="button button-color-1 button-size-small fright" target="_blank">
								<?php 
									if ($external_link_title && '' != $external_link_title) {
										echo $external_link_title;
									} else {
										echo str_replace('http://', '', $external_link);		
									}
								?>
							</a>
						<?php } ?>
						<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<?php } ?>
					<div class="metabar data clearfix">
						<?php if (is_sticky()) { ?>
						<span class="ribbon"><?php echo __('Sticky', 'pinthis'); ?></span>
						<?php } ?>
						<ul class="postmetas">
							<li class="tooltip" title="<?php echo __('Post date', 'pinthis'); ?>"><span class="icon-post-date-2"><?php echo get_the_date('d.m.Y'); ?></span></li>
							<li><span class="icon-author"><?php the_author_posts_link(); ?></span></li>
							<li class="tooltip" title="<?php echo __('Total comments', 'pinthis'); ?>"><span class="icon-total-comments-2"><?php comments_number('0', '1', '%'); ?></span></li>
						</ul>
						<ul class="social-media-icons clearfix">
							<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" class="border-color-3 icon-facebook tooltip" title="<?php echo __('Share on Facebook', 'pinthis'); ?>" target="_blank"><?php echo __('Facebook', 'pinthis'); ?></a></li>
							<li><a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" class="border-color-1 icon-gplus tooltip" title="<?php echo __('Share on Google+', 'pinthis'); ?>" target="_blank"><?php echo __('Google+', 'pinthis'); ?></a></li>
							<li><a href="https://twitter.com/share?url=<?php echo get_permalink(); ?>" class="border-color-4 icon-twitter tooltip" title="<?php echo __('Share on Twitter', 'pinthis'); ?>" target="_blank"><?php echo __('Twitter', 'pinthis'); ?></a></li>
						</ul>
					</div>
					<?php if (strlen($post->post_content) > 0) { ?>
					<div class="textbox clearfix">
						<?php the_content(); ?>
					</div>
					<?php } ?>
					<?php wp_link_pages(array(
							'before' => '<div class="page-links">' . __('Pages:&nbsp;', 'pinthis' ), 
							'after' => '</div>',
							'link_before'      => '<span class="page-num">',
							'link_after'       => '</span>',
						)); 
					?>
					<?php if (has_category('', $post->ID)) { ?>
						<p class="categories"><?php echo __('Categories: &nbsp;', 'pinthis'); ?> <?php the_category(', '); ?></p>
					<?php } else { ?>
						<p class="categories"><?php echo __('No categories', 'pinthis'); ?></p>
					<?php } ?>
					<?php if (get_the_tags()) { ?>
					<div class="tags">
						<p><?php the_tags('Tags: &nbsp;', ', ', ''); ?> </p>
					</div>
					<?php } ?>
					<?php comments_template(); ?>
					<?php } ?>	
				</div>
			</div>
		</div>
		<aside class="sidebar">
			<?php if (is_active_sidebar('page-sidebar')) { ?>
				<?php dynamic_sidebar('page-sidebar'); ?>
			<?php } else { ?>
				<div class="contentbox">
					<h4 class="title-1 border-color-2"><?php echo __('Meta', 'pinthis'); ?></h4>			
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</div>
			<?php } ?>
		</aside>
	</div>
</section>

<?php get_footer(); ?>