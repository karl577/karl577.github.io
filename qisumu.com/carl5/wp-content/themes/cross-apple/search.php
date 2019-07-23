<?php
/*
* ----------------------------------------------------------------------------------------------------
* Search
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

$args = array( 
		'post_type' => array('page', 'post', 'portfolio', 'product'),
		'posts_per_page' => 12,
		'paged' => $paged 
);
//End Query String
global $query_string; 
parse_str($query_string, $qstring_array);
$query_args = array_merge($args,$qstring_array);
query_posts($query_args);
?>

<?php if (have_posts()): ?>

<ul class="search-lists">

<?php while (have_posts()) : the_post(); ?>
<li>
<div class="post-entry clearfix">
<p class="post-meta"><h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2></p>
<p class="post-excerpt"><?php theme_description(300); ?></p>
<p class="post-more"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e('更多','dotheme'); ?></a></p>
</div>
</li>

<?php endwhile; ?>

</ul>

<?php theme_pagination(); ?>

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

<?php theme_search_sidebar(); ?> 

</div>
</div>
<!--End Container-->
<?php get_footer(); ?>