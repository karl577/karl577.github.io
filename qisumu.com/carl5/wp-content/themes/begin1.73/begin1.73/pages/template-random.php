<?php
/*
Template Name: 随机文章
*/
?>
<?php get_header(); ?>

<style type="text/css">
.random-page li {
	line-height: 280%;
	margin: 0 -20px;
	padding: 0 20px;
	border-bottom: 1px solid #dadada;
}
.random-inf {
	float: right;
	color: #999;
}
</style>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<ul class="random-page">
					<?php query_posts( array ( 'orderby' => 'rand', 'showposts' => 50, 'ignore_sticky_posts' => 1 ) ); while ( have_posts() ) : the_post(); ?>
						<li>
							<a href="<?php the_permalink() ?>" rel="bookmark"><i class="icon-li"></i><?php the_title(); ?></a>
							<span class="random-inf">
								<?php the_time( 'Y/m/d' ) ?>
								<?php if( function_exists( 'the_views' ) ) { print '<span class="views"> 阅读 '; the_views(); print '</span>';  } ?>
							</span>
						</li>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
				</ul>
			</article>
		</main><!-- .site-main -->

	</section><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>