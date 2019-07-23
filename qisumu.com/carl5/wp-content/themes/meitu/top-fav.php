<?php
/*
Template Name: 最多收藏
*/
?>
<?php get_header(); ?>
<div class="w968">
	<h1 id="page-title">最多收藏</h1>
	<div id="container">
		<?php if (have_posts()) : ?>
						<?php 
						// Create a new filtering function that will add our where clause to the query
						function filter_where( $where = '' ) {
							// posts in the last 30 days
							$where .= " AND post_date > '" . date('Y-m-d', strtotime('-360 days')) . "'";
							return $where;
						};
						$args=array(
							'orderby' => 'meta_value_num','meta_key'=> 'fav_count_value','order' => 'DESC','showposts'=>'100','caller_get_posts' => 1
						);
						add_filter( 'posts_where', 'filter_where' );
						$my_query=new WP_Query(
							$args
						);
						remove_filter( 'posts_where', 'filter_where' );
						while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID;
						?>
			<?php get_template_part('loop'); ?>
		<?php endwhile; endif;wp_reset_query(); ?>
	</div>
</div>
<?php get_template_part('list-js'); ?>
<?php get_footer(); ?>