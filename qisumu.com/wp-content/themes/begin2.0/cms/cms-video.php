<?php 
	if (zm_get_option('rand_video')) {
		$args = array('tax_query' => array( array('taxonomy' => 'videos', 'field' => 'id', 'terms' => explode(',',zm_get_option('video_id') ))), 'orderby' => 'rand', 'posts_per_page' => zm_get_option('video_n'));
	} else {
		$args = array('tax_query' => array( array('taxonomy' => 'videos', 'field' => 'id', 'terms' => explode(',',zm_get_option('video_id') ))), 'posts_per_page' => zm_get_option('video_n'));
	}
	query_posts($args); while ( have_posts() ) : the_post();
?>
<div class="xl4 xm4">
	<div class="picture-h">
		<figure class="picture-h-img">
			<?php if (zm_get_option('lazy_s')) { videor_thumbnail_h(); } else { videor_thumbnail(); } ?>
		</figure>
		<?php the_title( sprintf( '<h3 class="picture-h-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
	</div>
</div>

<?php endwhile; ?>
<?php wp_reset_query(); ?>
<div class="clear"></div>