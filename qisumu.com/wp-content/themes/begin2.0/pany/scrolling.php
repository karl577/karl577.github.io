<div id="cat-a">
	<h3 class="col-cat-title"><?php echo zm_get_option('cat_b_w'); ?></h3>
	<div class="cat-more"><a href="<?php echo  zm_get_option('catb_url'); ?>" rel="bookmark">更多</a></div>
</div>
<div class="clear"></div>
<ul id="flexisel">
	<?php 
		$loop = new WP_Query( array( 'showposts' => zm_get_option('cat_b_n'), 'cat' => zm_get_option('cat_b_id'), 'post__not_in' => get_option( 'sticky_posts') ) );
		while ( $loop->have_posts() ) : $loop->the_post();
	?>
    <li>
    	<?php zm_thumbnail(); ?>
    	<?php the_title( sprintf( '<h3 class="flexisel-h-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
    </li>
    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
</ul>
<div class="clear"></div>