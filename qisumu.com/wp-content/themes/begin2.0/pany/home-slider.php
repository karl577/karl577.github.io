<div id="slideshow">
	<script type="text/javascript">
		$(document).ready(function(){
			$("#slider-home").responsiveSlides({
				auto: true,
				pager: true,
				speed: 1400,
				maxwidth: 1920
			});
		});
	</script>
	<ul class="rslides" id="slider-home">
		<?php
			$args = array(
				'posts_per_page' => zm_get_option('slider_n'),
				'meta_key' => 'guide_img',
				'ignore_sticky_posts' => 1
			);
			query_posts($args);
		?>
		<?php while (have_posts()) : the_post(); ?>
		<?php $image = get_post_meta($post->ID, 'guide_img', true); ?>
			<li>
				<?php if (zm_get_option('home_slider_url')) { ?>
					<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" /></a>
				<?php } else { ?>
					<img src="<?php echo $image; ?>" />
				<?php } ?>
			</li>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</ul>
</div>