<?php
/*
Template Name: views
*/
?>
<?php get_header(); ?>
<div id="cate" data-type="meta" data-name="views"></div>
<div id="container" class="clearfix">
	<?php if(have_posts()):
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$paged = $paged*4-3;
		$prePage = get_option('posts_per_page')/4;
		$args = array(
			'meta_key' => 'views',
			'orderby'   => 'meta_value_num',
			'showposts'=> $prePage,
			'paged' => $paged,
			'order' => DESC
		);
		query_posts($args);
		while (have_posts()) : the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
	<?php endwhile; endif; ?>
</div>
<div id="pagenavi">
	<?php pagenavi();?>
</div>
<?php get_footer(); ?>