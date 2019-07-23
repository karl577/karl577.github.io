<div class="section-box">
	<h3 class="col-title"><?php echo zm_get_option('pageid_w'); ?></h3>
		<?php $posts = get_posts( array( 'post_type' =>any,	'include' => zm_get_option( 'page_id' )	) ); if($posts) : foreach( $posts as $post ) : setup_postdata( $post ); ?>
		<div class="g4">
			<div class="box-4">
				<figure class="section-thumbnail">
					<?php if (zm_get_option('lazy_s')) { zm_thumbnail_h(); } else { zm_thumbnail(); } ?>
				</figure>
				<?php the_title( sprintf( '<h3 class="g4-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
			</div>
		</div>
		<?php endforeach; endif; ?>	
		<?php wp_reset_query(); ?>
	<div class="clear"></div>
</div>