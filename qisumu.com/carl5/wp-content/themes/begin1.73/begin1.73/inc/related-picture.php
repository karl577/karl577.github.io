<div id="related-img">
	<?php 
		$loop = new WP_Query( array( 'post_type' => 'picture', 'posts_per_page' => 4 ) );
		while ( $loop->have_posts() ) : $loop->the_post();
	?>
	<div class="r4">
		<div class="related-site">
			<figure class="related-site-img">
				<?php 
					if (zm_get_option('lazy_s')) {
					zm_the_thumbnail_h();
					} else {
					zm_the_thumbnail();
					}
				 ?>
			 </figure>
			<div class="related-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
		</div>
	</div>
	<?php endwhile; ?>
	<?php wp_reset_query(); ?>
	<div class="clear"></div>
</div>