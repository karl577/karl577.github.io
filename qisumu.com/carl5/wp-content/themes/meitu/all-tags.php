<?php
/*
Template Name: 全部标签
*/
?>
<?php get_header(); ?>
<div class="w960">
	<h1 id="page-title" style="margin:0 0 10px;">全部标签</h1>
	<div id="content-post">
		<div id="all-tags">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('tags') ) : ?><?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>