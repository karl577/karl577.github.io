<?php 
	if (zm_get_option('rand_tao')) {
		$args = array('tax_query' => array( array('taxonomy' => 'taobao', 'field' => 'id', 'terms' => explode(',',zm_get_option('tao_h_id') ))), 'orderby' => 'rand', 'posts_per_page' => zm_get_option('tao_h_n'));
	} else {
		$args = array('tax_query' => array( array('taxonomy' => 'taobao', 'field' => 'id', 'terms' => explode(',',zm_get_option('tao_h_id') ))), 'posts_per_page' => zm_get_option('tao_h_n'));
	}
	query_posts($args); while ( have_posts() ) : the_post();
?>

<div class="xl4 xm4">
	<div class="tao-h">
		<figure class="tao-h-img">
			<?php if (zm_get_option('lazy_s')) { tao_thumbnail_h(); } else { tao_thumbnail(); } ?>
		</figure>
	</div>
</div>

<?php endwhile; ?>
<?php wp_reset_query(); ?>
<div class="clear"></div>