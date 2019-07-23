 <?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package EasyBlog
 */

get_header(); ?>

 <div class="container">
	 <div class="row">
		 <div class="col-lg-8 col-md-8">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

				<?php
				if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<div class="dt-archive-posts">
						<?php

						while ( have_posts() ) : the_post(); ?>

							<div class="dt-archive-post">
								<figure>
									<?php the_post_thumbnail( 'easyblog-blog-img' ); ?>
								</figure>

								<article>
									<header class="entry-header">
										<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
									</header><!-- .entry-header -->

									<div class="dt-archive-post-content">
										<?php the_excerpt(); ?>
									</div><!-- .dt-archive-post-content -->

									<div class="entry-footer">
										<a class="transition35" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e( 'Read more', 'easyblog' ); ?></a>
									</div><!-- .entry-footer -->
								</article>
							</div><!-- .dt-archive-post -->

						<?php endwhile; ?>

					</div><!-- .dt-category-posts -->

					<div class="clearfix"></div>

					<div class="dt-pagination-nav">
						<?php echo paginate_links(); ?>
					</div><!---- .dt-pagination-nav ---->

				<?php else : ?>

					<p><?php _e( 'Sorry, no posts matched your criteria.', 'easyblog' ); ?></p>

				<?php endif; ?>

				</main><!-- #main -->
			</div><!-- #primary -->
		 </div><!-- .col-lg-8 -->

		 <aside class="col-lg-4 col-md-4">
			 <div class="dt-sidebar">
				 <?php get_sidebar(); ?>
			 </div><!-- .dt-sidebar -->
		 </aside><!-- .col-lg-4 -->
	 </div><!-- .row -->
 </div><!-- .container -->

<?php
get_footer();
