<?php 
	if (zm_get_option('rand_img')) {
		$args = array('tax_query' => array( array('taxonomy' => 'gallery', 'field' => 'id', 'terms' => explode(',',zm_get_option('picture_id') ))), 'orderby' => 'rand', 'posts_per_page' => zm_get_option('picture_n'));
	} else {
		$args = array('tax_query' => array( array('taxonomy' => 'gallery', 'field' => 'id', 'terms' => explode(',',zm_get_option('picture_id') ))), 'posts_per_page' => zm_get_option('picture_n'));
	}
	query_posts($args); while ( have_posts() ) : the_post();
?>
<div class="xl4 xm4">
<div class="picture-h wow fadeInUp" data-wow-delay="0.3s">
		<figure class="picture-h-img">
			<?php if (zm_get_option('lazy_s')) { img_thumbnail_h(); } else { img_thumbnail(); } ?>
		<?php the_title( sprintf( '<h2 class="posting-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</figure>
	</div>
</div>

<?php endwhile; ?>
<?php wp_reset_query(); ?>
<div class="clear"></div>