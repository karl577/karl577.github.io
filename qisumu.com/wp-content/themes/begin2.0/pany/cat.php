<div class="section-box">
	<div id="cat-a">
		<h3 class="col-cat-title"><?php echo zm_get_option('cat_a_w'); ?></h3>
		<div class="cat-more"><a href="<?php echo  zm_get_option('cata_url'); ?>" rel="bookmark">更多</a></div>
	</div>
	<?php query_posts('showposts='.zm_get_option('cat_a_n').'&cat='.zm_get_option('cat_a_id')); while (have_posts()) : the_post(); ?>
	<div class="g4">
		<div class="box-4">
			<figure class="section-thumbnail">
				<?php if (zm_get_option('lazy_s')) { zm_thumbnail_h(); } else { zm_thumbnail(); } ?>
			</figure>
			<?php the_title( sprintf( '<h3 class="g4-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
		</div>
	</div>
	<?php endwhile; ?>
	<?php wp_reset_query(); ?>
	<div class="clear"></div>
</div>