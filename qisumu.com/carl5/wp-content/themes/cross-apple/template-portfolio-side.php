<?php
/*
* ----------------------------------------------------------------------------------------------------
* Template Name: Portfolio With Sidebar
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
	if (have_posts()) : the_post();  
	$content = get_the_content(); 
?>

<?php if($content) : ?>

<div class="post-content"><?php the_content(); ?></div>

<?php else : ?>

<p><?php _e('<h5>Hey! Please add the portfolio category shortcode:</h5><h6>Enter the slug name of portfolio categories, separate categories with commas. If you want to display all the category, just let it blank.</h6>[portfolio_category_list title="You Title" category_slug_name="category slug name" show_posts="8" lightbox="no" fade="yes"]Your description text.[/portfolio_category_list]','HK'); ?></p>

<?php endif; ?>

<?php endif; ?>
<!--End page content-->

</article>
<!--End Content-->

<?php theme_portfolio_sidebar(); ?> 

</div>
</div>
<!--End Container-->
<?php get_footer(); ?>