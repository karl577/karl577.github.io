<?php
/*
* ----------------------------------------------------------------------------------------------------
* Portfolio Single
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
get_header(); 
?>
<!--Begin Container-->
<div id="container" class="clearfix fullwidth">

<?php theme_page_banner(); ?>

<div id="container-wrap" class="col-width clearfix">

<nav class="single-page-navigation clearfix">
<?php previous_post_link( '%link', __( '<span class="nav-previous">上一页</span>', 'HK' ) ); ?>
<?php next_post_link( '%link', __( '<span class="nav-next">下一页</span>', 'HK' )); ?>
</nav>

<!--Begin Content-->
<article id="content">
<?php if (have_posts()) : the_post(); ?>

<div class="post post-single post-portfolio-single clearfix" id="post-<?php the_ID(); ?>">

	<div class="post-portfolio-content"<?php if ( !has_post_thumbnail() ) { echo ' style="clear: left; width: 100%;"'; }?>>

		<div class="post-entry">
			<h2><?php the_title(); ?></h2>
			<p class="post-meta">
			<?php esc_html_e('作者： ','HK'); the_author_posts_link(); ?><span>//</span>
			<?php printf( __('%1$s', 'HK'), get_the_time('F j, Y') ); ?><span>//</span>
			<?php echo get_the_term_list( $post->ID, 'portfolio-types', '', ', ', '' ); ?><span>//</span>
			<?php edit_post_link( __( '编辑', 'HK' ), '', '<span>//</span>' ); ?>
			</p>
		</div>

		<div class="post-content"><?php the_content(); ?></div>
		<!--end post content-->

		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'HK' ), 'after' => '</div>' ) ); //end link page ?>

	</div>
	<!--end post portfolio content-->

	<?php if ( has_post_thumbnail() ) : ?>
	<div class="post-thumb">
	<a href="<?php echo theme_large_image_uri(); ?>" title="<?php the_title_attribute(); ?>" class="image-link" data-id="fancybox">
	<?php the_post_thumbnail('460-320'); ?>
	</a>
	</div>
	<?php endif; ?>
	<!--end post portfolio thumb-->

</div>
<!--end post page-->

<div class="related-posts related-posts-portfolio">
<h3><?php esc_html_e('相关内容','HK'); ?></h3>
<?php theme_related_post('portfolio-types', $lightbox = 'yes'); ?>
</div>

<?php else : ?>

<!--Begin No Post-->
<div class="no-post">
	<h2><?php esc_html_e('没有找到', 'HK'); ?></h2>
	<p><?php esc_html_e("对不起，您搜素的东西在这儿没有找到", 'HK'); ?></p>
</div>
<!--End No Post-->

<?php endif; ?>
</article>
<!--End Content-->

</div>
</div>
<!--End Container-->
<?php get_footer(); ?>