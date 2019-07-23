<div id="sidebar">
	<div id="sidebar-inner">
		<div id="navigation" class="widget clearfix">
			<div class="prev">
			<?php if(get_next_post()) {next_post_link('%link'); } else { echo '<span class="disabled"></span>'; }; ?>
			</div>
			<div class="next">
			<?php if(get_previous_post()) {previous_post_link('%link');_e('下一页','mumale');} else{ echo '<span class="disabled"></span>'; }; ?>
			</div>
		</div>
		<div id="popular" class="widget stationary">
				<?php _e('<h2>Popular</h2>','mumale');?>
				<ul class="clearfix">
				<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
					'meta_key' => 'views',
					'orderby'   => 'meta_value_num',
					'paged' => $paged,
					'order' => DESC,
					'showposts' => '7',
				);
				query_posts($args);
					while (have_posts()) : the_post();
					$output = preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $imgs); 
					$cnt = count($imgs);
				?>
				<li>
				<?php if ( $cnt > 0 ) {  ?>
				<a class="same_cat_posts_img" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo '<img src="'.get_bloginfo('template_url').'/timthumb.php?src='.$imgs[1].'&amp;w=60&amp;h=60&amp;zc=1" />';?></a>
				<?php } else {  ?>
				<a class="same_cat_posts_img" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img alt="<?php the_title(); ?>" src="<?php bloginfo('template_url'); ?>/timthumb.php?src=<?php bloginfo('template_url'); ?>/images/default.jpg&amp;w=60&amp;h=60&amp;zc=1" /></a>
				<?php } ?>
				</li>
				<?php endwhile; wp_reset_query(); ?>
				</ul>
		</div>
		<div id="related" class="widget stationary">
			<?php _e('<h2>Related</h2>','mumale');?>
			<ul class="clearfix">
				<?php
					foreach(get_the_category() as $category){
					$cat = $category->cat_ID;
					}
					query_posts('cat=' . $cat . '&orderby=rand&showposts=9');
					while (have_posts()) : the_post();
					$output = preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches); 
					$imgnum = count($matches);
				?>
				<li>
				<?php if ( $imgnum > 0 ) {  ?>
				<a class="same_cat_posts_img" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo '<img src="'.get_bloginfo('template_url').'/timthumb.php?src='.$matches[1].'&amp;w=80&amp;h=60&amp;zc=1" />';?></a>
				<?php } else {  ?>
				<a class="same_cat_posts_img" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img alt="<?php the_title(); ?>" src="<?php bloginfo('template_url'); ?>/timthumb.php?src=<?php bloginfo('template_url'); ?>/images/default.jpg&amp;w=80&amp;h=60&amp;zc=1" /></a>
				<?php } ?>
				</li>
				<?php endwhile; wp_reset_query(); ?>
			</ul>
		</div>
		<?php if (get_option('mumale_Ap1')!="") {?>
			<div id="iphotoAp2" class="widget>
				<?php echo stripslashes(get_option('mumale_Ap2')); ?>
			</div>
		<?php }?>
		<?php if ( !dynamic_sidebar('primary-widget-area') ) : ?>
		<?php endif; ?>
		<div class="clear"></div>
	</div>
</div>