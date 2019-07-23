<?php
/*
* ----------------------------------------------------------------------------------------------------
* Product Single
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
<?php 
if (have_posts()) : the_post(); 

$currency = theme_get_option('product','currency');
$original_price = get_meta_option('product_original_price');
$discount_price = get_meta_option('product_discount_price');
$external_link = get_meta_option('product_external_link');
$desc = get_the_excerpt();
?>

<div class="post post-single post-product-single" id="post-<?php the_ID(); ?>">


	<div class="post-product-wrap clearfix">
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="post-thumb">
	<a href="<?php echo theme_large_image_uri(); ?>" title="<?php the_title_attribute(); ?>" class="image-link" data-id="fancybox">
	<?php the_post_thumbnail('460-320'); ?>
	</a>
	</div>
	<?php endif; ?>
	<!--end post portfolio thumb-->
	<div class="post-product-content">
		<div class="post-entry">
		<h2><?php the_title(); ?></h2>
		<p class="post-price">
		<?php if($original_price) : ?><s><?php echo $currency.$original_price; ?> .00</s><?php endif; ?>
		<?php if($discount_price) : ?><span><?php echo $currency.$discount_price; ?> .00</span><?php endif; ?>
		</p>
		<?php if($desc) : ?><p class="post-excerpt"><?php theme_excerpt(300); ?></p><?php endif; ?>
		<?php if($external_link) : ?><p class="post-more"><a href="<?php echo $external_link; ?>" title=""><?php esc_html_e('购买','HK'); ?></a></p><?php endif; ?>
		</div>
	</div>
	<!--end post portfolio content-->
	</div>


	<div class="post-content"><?php the_content(); ?></div>
	<!--end post content-->

	<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'HK' ), 'after' => '</div>' ) ); //end link page ?>

</div>
<!--end post page-->

<div class="related-posts related-posts-product">
<h3><?php esc_html_e('猜你喜欢','HK'); ?></h3>
<?php theme_related_post('product-types', $lightbox = 'yes'); ?>
</div>

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