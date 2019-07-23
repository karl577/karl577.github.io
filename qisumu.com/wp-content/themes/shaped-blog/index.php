<?php get_header();?>

	<!-- Main content -->
	<div id="content" class="site-content">
		<div class="container">
			<div class="row">
				<div class="<?php echo esc_attr(get_theme_mod('shaped_blog_home_layout', 'col-md-8')); ?>">
					<div id="primary" class="content-area">
						<main id="main" class="site-main" role="main">

						<?php if ( have_posts() ) : ?>

							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>

								<?php get_template_part('content'); ?>

							<?php endwhile; ?>

							<?php
							 	// Posts Pagination
								if (get_theme_mod('shaped_blog_pagination') == 'navigation') {
									shaped_blog_posts_navigation();
								}
								else{
									shaped_blog_posts_pagination();
								}
							?>

						<?php else : ?>

							<?php get_template_part( 'content', 'none' ); ?>

						<?php endif; ?>

						</main><!-- #main -->
					</div><!-- #primary -->
				</div> <!-- /col -->
				<!-- Blogsidebar -->			
				<?php get_sidebar(); ?>
			</div> <!-- /.row -->
		</div>
	</div><!-- #content -->

<?php get_footer(); ?>