<?php
/*
* ----------------------------------------------------------------------------------------------------
* Template Name: Full Width Page
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
get_header(); 
?>
<!--Begin Container-->
<div id="container" class="clearfix fullwidth">

<?php theme_page_banner(); ?>

<div id="container-wrap" class="col-width clearfix">

<!--Begin Content-->
<article id="content">
<?php if (have_posts()) : the_post(); ?>

<div class="post post-single" id="post-<?php the_ID(); ?>">

	<div class="post-content"><?php the_content(); ?></div>
	<!--end post content-->

	<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'HK' ), 'after' => '</div>' ) ); //end link page ?>

	<?php edit_post_link( __( '编辑', 'HK' ), '<div class="edit-link">', '</div>' ); //end edit link ?>

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