<div id="slideshow"  class="wow fadeInUp" data-wow-delay="0.3s">
	<ul class="rslides" id="slider">
		<?php
			$args = array(
				'posts_per_page' => zm_get_option('slider_n'),
				'meta_key' => 'show',
				'ignore_sticky_posts' => 1
			);
			query_posts($args);
		?>
		<?php while (have_posts()) : the_post();$do_not_duplicate[] = $post->ID; ?>
		<?php $image = get_post_meta($post->ID, 'show', true); ?>
		<?php $go_url = get_post_meta($post->ID, 'show_url', true); ?>
			<li>
				<?php if ( get_post_meta($post->ID, 'show_url', true) ) : ?>
				<a href="<?php echo $go_url; ?>" target="_blank" rel="bookmark"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" /></a>
				<?php else: ?>
				<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" /></a>
				<?php endif; ?>
				<p class="slider-caption"><?php the_title(); ?></p>
			</li>
				<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</ul>
</div>