<?php
/*
Template Name: 通栏专题
*/
?>
<?php get_header(); ?>

<style type="text/css">
#primary {
	width: 100%;
}
/** 幻灯 **/
#works-slideshow {
	position: relative;
	margin: 0 0 10px 0;
	border: 1px solid #ebebeb;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.03);
    border-radius: 2px;
}
.works-rslides {
	position: relative;
	overflow: hidden;
	width: 100%;
}
.works-rslides li {
	-webkit-backface-visibility: hidden;
	position: absolute;
	display: none;
	width: 100%;
	left: 0;
	top: 0;
}
.works-rslides li:first-child {
	position: relative;
	display: block;
	float: left;
}
.works-rslides img {
	display: block;
	height: auto;
	float: left;
	width: 100%;
	border-radius: 2px;
}
.works-rslides_tabs {
	position: absolute;
	bottom: 0px;
	margin: 0 auto;
	max-width: 100%;
	padding: 10px 0;
	text-align: center;
	width: 100%;
	z-index: 2;
	_display: none;
}
.works-rslides_tabs li {
	display: inline;
	float: none;
	margin-right: 5px;
}
.works-rslides_tabs a {
	background: #fff;
	width: auto;
	height: auto;
	color: #555;
	line-height: 15px;
	padding: 2px 8px;
	display: inline;
	border: 1px solid #fff;
	border-radius: 2px;
}
.page-template-template-column .entry-header h1 {
	background: #ebebeb;
	font-size: 16px;
	font-size: 1.6rem;
	line-height: 40px;
	text-align: center;
	margin: 10px -23px 20px -23px;
	padding: 0 20px;
	border-left: 3px solid #ccc;
	border-right: 3px solid #ccc;
}
.entry-header h1 {
	background: #fff !important;
	margin: 10px -20px 20px !important;
	border: none !important;
}
/** 目录 **/
#index {
	float: left;
	max-width: 100%;
    margin: 0 0 15px 2px;
    padding: 5px;
	border: 1px solid #ebebeb;
    border-radius: 2px;
}
#index-ul li {
	float: left;
	width: 16% ;
    margin-left: 20px;
}
.works-inf {
	float: right;
}
/** 等于或小于1005px **/
@media screen and (max-width: 800px) {
	#index-ul li {
	width: 40% ;
	}
}
</style>

<?php if ( get_post_meta($post->ID, 'page_slides', true) ) : ?>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() );?>/js/slides.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	 $("#works-slider").responsiveSlides({
	   auto: true,
	   pager: true,
	   speed: 800,
	   maxwidth: 1080
	 });

	});
</script>

<div id="works-slideshow">
	<ul class="works-rslides" id="works-slider">
		<?php
		$image = get_post_meta($post->ID, 'page_slides', true);
		$image=explode("\n",$image);
		foreach($image as $key=>$page_slides){ ?>
		<img src="<?php echo $page_slides;?>"/>
		<?php }?>
	</ul>
</div>
<?php endif; ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
			<div class="entry-content">
				<div class="single-content">
					<?php the_content(); ?>

					<?php get_template_part( 'inc/file' ); ?>

					<?php wp_link_pages(array('before' => '<div class="page-links">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '<span>上一页</span>', 'nextpagelink' => "")); ?>
					<?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
					<?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => "<span>下一页</span>")); ?>

					<div class="works-inf">
						<?php edit_post_link('编辑 | ', '<span class="edit-link">', '</span>' ); ?>
						<?php if( function_exists( 'the_views' ) ) { print '<span class="views">围观 '; the_views(); print ' 次</span>';  } ?>
					</div>
					<div class="clear"></div>
				</div> <!-- .single-content -->
			</div><!-- .entry-content -->
		</article><!-- #page -->
	<?php endwhile; ?>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>