<?php 
	if (zm_get_option('rand_img')) {
		$args = array('tax_query' => array( array('taxonomy' => 'gallery', 'field' => 'id', 'terms' => explode(',',zm_get_option('picture_id') ))), 'orderby' => 'rand', 'posts_per_page' => zm_get_option('picture_n'));
	} else {
		$args = array('tax_query' => array( array('taxonomy' => 'gallery', 'field' => 'id', 'terms' => explode(',',zm_get_option('picture_id') ))), 'posts_per_page' => zm_get_option('picture_n'));
	}
	query_posts($args); while ( have_posts() ) : the_post();
?>

<div class="xl4 xm4">
	<div class="picture-h">
		<figure class="picture-h-img">
			<?php 
				if (zm_get_option('lazy_s')) {
				zm_the_thumbnail_h();
				} else {
				zm_the_thumbnail();
				}
			 ?>
		</figure>
		<?php the_title( sprintf( '<h3 class="picture-h-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
	</div>
</div>

<?php endwhile; ?>
<?php wp_reset_query(); ?>
<div class="clear"></div>