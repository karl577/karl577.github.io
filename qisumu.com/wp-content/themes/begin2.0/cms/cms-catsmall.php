<?php $display_categories =  explode(',',zm_get_option('cat_small_id') ); foreach ($display_categories as $category) { ?>
<?php query_posts( array( 'showposts' => 1, 'cat' => $category, 'post__not_in' => $do_not_duplicate ) ); ?>
<div class="xl2 xm2">
	<div class="cat-box">
		<h3 class="cat-title"><a href="<?php echo get_category_link($category);?>" title="<?php echo strip_tags(category_description($category)); ?>"><i class="fa fa-bars"></i><?php single_cat_title(); ?></a></h3>
		<div class="clear"></div>
		<div class="cat-site">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if (zm_get_option('cat_small_z')) { ?>
						<figure class="small-thumbnail"><?php if (zm_get_option('lazy_s')) { zm_long_thumbnail_h(); } else { zm_long_thumbnail(); } ?></figure>
							<?php the_title( sprintf( '<h2 class="entry-small-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					<?php } else { ?>
						<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						<figure class="thumbnail"><?php if (zm_get_option('lazy_s')) { zm_thumbnail_h(); } else { zm_thumbnail(); } ?></figure>
					<?php } ?>
				<?php if (zm_get_option('cat_small_z')) { ?>
				<?php } else { ?>
					<div class="cat-main">
						<?php if (has_excerpt('')){ echo wp_trim_words( get_the_excerpt(), 42, '...' ); } else { echo wp_trim_words( get_the_content(), 45, '...' ); } ?>
					</div>
				<?php } ?>
			<?php endwhile; ?>

			<div class="clear"></div>
			<ul class="cat-list">
				<?php query_posts( array( 'showposts' => zm_get_option('cat_small_n'), 'cat' => $category, 'offset' => 1, 'post__not_in' => $do_not_duplicate ) ); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php if (zm_get_option('list_date')) { ?><span class="list-date"><?php the_time('m/d') ?></span><?php } ?>
					<?php the_title( sprintf( '<li class="list-title"><i class="fa fa-angle-right"></i><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
			</ul>
		</div>
	</div>
</div>
<?php } ?>
<div class="clear"></div>