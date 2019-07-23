<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<header class="search-header">
				<h2 class="search-title"><?php printf( __( 'Search Results: %s', 'shaped-blog' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
			</header><!-- .page-header --><div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content' ); ?>

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

				</main><!-- /.site-main -->
			</div><!-- /.content-area -->
		</div> <!-- /.col -->

		<!-- Blogsidebar -->			
		<?php get_sidebar(); ?>
		
	</div> <!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
