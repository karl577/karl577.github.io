<?php
/*
* ----------------------------------------------------------------------------------------------------
* Template Name: Portfolio
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
get_header();

$list_style = theme_get_option('portfolio','list_style');
switch($list_style)
{
	case 1: $loop = '1'; break;
	case 2: $loop = '2'; break;
	case 3: $loop = '2'; break;
	case 4: $loop = '2'; break;
	case 5: $loop = '3'; break;
	case 6: $loop = '3'; break;
	case 7: $loop = '3'; break;
}
?>
<!--Begin Container-->
<div id="container" class="clearfix fullwidth">

<?php theme_page_banner(); ?>

<div id="container-wrap" class="col-width clearfix">

<!--Begin Content-->
<article id="content">
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
<!--End page content-->

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

$showposts = theme_get_option('portfolio','list_showposts');

$query_args = array( 
	'post_type' => 'portfolio',
	'posts_per_page' => $showposts,
	'paged' => $paged
);
//End Query String

query_posts($query_args);
?>

<?php if (have_posts()): ?>

<?php
	get_template_part('loops/loop', 'portfolio-'.$loop.'');	
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

</div>
</div>
<!--End Container-->
<?php get_footer(); ?>