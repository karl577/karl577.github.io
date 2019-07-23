<?php query_posts( array ( 'meta_key' => zm_get_option('key_img_n'), 'showposts' => zm_get_option('post_img_n'), 'ignore_sticky_posts' => 1, 'post__not_in' => $do_not_duplicate ) ); while ( have_posts() ) : the_post(); ?>

<div class="xl4 xm4">
	<div class="picture-h">
		<figure class="picture-h-img">
			<?php if (zm_get_option('lazy_s')) { zm_thumbnail_h(); } else { zm_thumbnail(); } ?>
		</figure>
		<?php the_title( sprintf( '<h3 class="picture-h-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
	</div>
</div>

<?php endwhile; ?>
<?php wp_reset_query(); ?>
<div class="clear"></div>