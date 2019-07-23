<?php
/*
Template Name: 引导页面
*/
?>
<?php get_header(); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#slider-home").responsiveSlides({
			auto: true,
			pager: true,
			speed: 1400,
			maxwidth: 1920
		});
	});
</script>

<style type="text/css">
body{
	background: #fff;
}
#content {
    width: 100%;
	background: #fff;
    margin: 0 auto 10px;
}
#primary {
	width: 100%;
	box-shadow: none;
}
#primary .page {
	background: transparent !important;
	padding: 0 !important;
	border: none !important;
	box-shadow: none !important;
}
.breadcrumb, #scroll {
	display: none;
}
#slideshow {
    margin: 0;
}
.home-content {
	width: 1080px;
	margin: 30px auto 20px;
}
.single-content {
	float: left;
	width: 60%;
	font-size: 15px;
	margin: 0;
	padding: 15px 30px 15px 15px;
	border-right: 1px dashed #ddd;
}
.page-home {
	width: 40%;
	font-size: 15px;
	float: right;
	padding: 15px 15px 15px 30px;
}
.page-home h2 {
	font-size: 15px;
	margin: 0 0 10px 0;
}
.page-home ul li {
	width: 99%;
	line-height: 190%;
	white-space: nowrap;
	word-wrap: normal;
	text-overflow: ellipsis;
	overflow: hidden;
}
@media screen and (max-width: 1080px) {
	.home-content {
		width: 100%;
	}
	.single-content {
		width: 100%;
		margin: 0 0 10px 0;
		border-right: none;
		border-bottom: 1px dashed #ddd;
	}
	.page-home {
		width: 100%;
		float: inherit;
	}
}
</style>

<div id="primary" class="content-reg">
	<main id="main" class="site-main" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div id="slideshow">
				<ul class="rslides" id="slider-home">
					<?php
						$args = array(
							'posts_per_page' => zm_get_option('slider_n'),
							'meta_key' => 'guide_img',
							'ignore_sticky_posts' => 1
						);
						query_posts($args);
					?>
					<?php while (have_posts()) : the_post(); ?>
					<?php $image = get_post_meta($post->ID, 'guide_img', true); ?>
						<li>
							<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" /></a>
						</li>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
				</ul>
			</div>

			<div class="home-content">
				<div class="entry-content">
					<?php while ( have_posts() ) : the_post(); ?>
					<div class="single-content">
						<?php the_content(); ?>
					</div> <!-- .single-content -->
				</div><!-- .entry-content -->

				<div class="page-home">
					<h2>最新文章</h2>
					<ul>
						<?php $i = 1; $rand_posts = get_posts('numberposts=8&category=&orderby=date');foreach($rand_posts as $post) : ?>
						<?php if($i < 4) { ?>
							<li><span class='li-number'><?php echo($i++); ?></span><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
						<?php } else { ?>
							<li><span class='li-numbers'><?php echo($i++); ?></span><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
						<?php } ?>
						<?php endforeach;?>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</article>
	<?php endwhile; ?>
	</main>
</div>

<?php get_footer(); ?> 