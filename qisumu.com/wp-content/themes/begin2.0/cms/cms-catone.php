<?php $display_categories =  explode(',',zm_get_option('cat_one_id') ); foreach ($display_categories as $category) { ?>
<?php query_posts( array( 'showposts' => 1, 'cat' => $category, 'post__not_in' => $do_not_duplicate ) ); ?>
	<div class="cat-box">
		<h3 class="cat-title"><a href="<?php echo get_category_link($category);?>" title="<?php echo strip_tags(category_description($category)); ?>"><i class="fa fa-bars"></i><?php single_cat_title(); ?></a></h3>
		<div class="clear"></div>
		<div class="cat-site">
			<?php while ( have_posts() ) : the_post(); ?>
				<figure class="line-one-thumbnail">
					<?php if (zm_get_option('lazy_s')) { zm_thumbnail_h(); } else { zm_thumbnail(); } ?>
				</figure>
			<?php endwhile; ?>

			<ul class="cat-one-list">
				<?php query_posts( array( 'showposts' => 5, 'cat' => $category, 'offset' => 0, 'post__not_in' => $do_not_duplicate ) ); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php if (zm_get_option('list_date')) { ?><span class="list-date"><?php the_time('m/d') ?></span><?php } ?>
					<?php the_title( sprintf( '<li class="list-title"><i class="fa fa-angle-right"></i><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
<?php } ?>