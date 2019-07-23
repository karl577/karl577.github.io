<?php
/*
Template Name: 我的收藏
*/
?>
<?php get_header(); ?>
<div class="w968">
	<h1 id="page-title">我的收藏</h1>
	<div id="container">
		<?php query_posts('meta_key=fav_user_value&meta_value='.wt_get_user_id().'&showposts=100'); ?>
			<?php get_template_part('loop'); ?>
		<?php endwhile; endif;wp_reset_query(); ?>
	</div>
</div>
<?php get_template_part('list-js'); ?>
<?php get_footer(); ?>