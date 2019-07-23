<?php
/*
* ----------------------------------------------------------------------------------------------------
* Template Name: Blog
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
get_header(); 
?>
<!--Begin Container-->
<div id="container" class="clearfix side-right">

<?php theme_page_banner(); ?>

<div id="container-wrap" class="col-width clearfix">

<!--Begin Content-->
<article id="content">

<?php if(is_page()) : ?>
<?php 
	if (have_posts()) : the_post();  
	$content = get_the_content(); 
?>
<?php if($content) : ?>
	<div class="post-content">
	<?php the_content(); ?>
	</div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

<?php
//Adhere To Paging Rules
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
} elseif ( get_query_var('page') ) { 
// applies when this page template is used as a static homepage in WP3+
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

$showposts = theme_get_option('blog','list_showposts');
		
$args = array( 
		'post_type' => 'post',
		'posts_per_page' => $showposts,
		'paged' => $paged 
);

#
#End Query String
#
if(is_page())
{
	query_posts($args);
}
else
{
	global $wp_query;
	$query_args = array_merge( $wp_query->query, $args );
	query_posts($query_args);
}
?>

<?php if (have_posts()): ?>

<?php 
	$list_style = theme_get_option('blog','list_style');
	get_template_part('loops/loop', 'blog-'.$list_style.''); 
	theme_pagination(); 
?>

<?php else : ?>

<!--Begin No Post-->
<div class="no-post">
	<h2><?php esc_html_e('Not Found', 'HK'); ?></h2>
	<p><?php esc_html_e("Sorry, but you are looking for something that isn't here.", 'HK'); ?></p>
</div>
<!--End No Post-->

<?php endif; ?>
</article>
<!--End Content-->

<?php theme_blog_sidebar(); ?> 

</div>
</div>
<!--End Container-->
<?php get_footer(); ?>