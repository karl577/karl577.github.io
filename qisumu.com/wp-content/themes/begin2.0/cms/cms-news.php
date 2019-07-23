<?php if (zm_get_option('cms_top')) { ?>
	<?php $recent = new WP_Query( array( 'posts_per_page' => zm_get_option('news_n'),'category__not_in' => explode(',', zm_get_option('not_news_n')),'meta_query' => array( array( 'key' => 'cms_top', 'compare' => 'NOT EXISTS'))));?>
<?php } else { ?>
	<?php $recent = new WP_Query( array( 'posts_per_page' => zm_get_option('news_n'), 'category__not_in' => explode(',',zm_get_option('not_news_n'))) ); ?>
<?php } ?>
<?php while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; ?>
	<div class="wow fadeInUp" data-wow-delay="0.3s"><?php get_template_part( 'template/content', get_post_format() ); ?></div>
<?php endwhile; ?>
<div class="clear"></div>