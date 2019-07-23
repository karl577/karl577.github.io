<?php
/*
* ----------------------------------------------------------------------------------------------------
* Template Name: Home
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
get_header(); 
?>
<!--Begin Container-->
<div id="container" class="clearfix fullwidth">

<?php
	$enable_slider = theme_get_option('slider', 'enable_slider');
	$slider_shortcode = stripslashes(theme_get_option('slider', 'shortcode'));
	if($enable_slider == 'yes') 
	{
		echo theme_remove_autop($slider_shortcode);
	}
?>

<div id="container-wrap" class="col-width clearfix">

<!--Begin Content-->
<article id="content">
<?php if (have_posts()) : the_post(); ?>

<div class="post post-single" id="post-<?php the_ID(); ?>">

	<div class="post-content"><?php the_content(); ?></div>
	<!--end post content-->

</div>
<!--end post page-->

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