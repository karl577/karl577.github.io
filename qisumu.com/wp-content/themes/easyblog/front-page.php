<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package EasyBlog
 */

get_header(); ?>

<div class="container">
	<div class="row">
		<?php
		if ( is_active_sidebar( 'dt-front-page-before-content' ) ) : ?>
		<div class="col-lg-12 col-md-12">
			<div class="dt-front-sidebar-wrap">
				<?php dynamic_sidebar( 'dt-front-page-before-content' ); ?>
			</div><!-- .dt-front-sidebar-wrap -->
		</div><!-- .col-lg-12 -->
		<?php endif; ?>

		<div class="col-lg-8 col-md-8">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<?php if ( have_posts() ) :

						while ( have_posts() ) : the_post();
							if ( 'page' == get_option( 'show_on_front' ) ) { ?>

								<div class="dt-content-area">
									<?php

									get_template_part( 'template-parts/content', 'page' );

									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;

									?>
								</div>

							<?php } else { ?>

								<div class="dt-archive-posts">

									<div class="dt-archive-post">

										<?php if ( has_post_thumbnail() ) : ?>

										<figure>
											<?php the_post_thumbnail( 'easyblog-blog-img' ); ?>
										</figure>

										<?php endif; ?>

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

								</div><!-- .dt-category-posts -->

							<?php } ?>

						<?php endwhile; ?>

						<?php wp_reset_postdata(); ?>

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
			</div><!-- dt-sidebar -->
		</aside><!-- .col-lg-4 -->

		<?php if ( is_active_sidebar( 'dt-front-page-after-content' ) ) : ?>
			<div class="col-lg-12 col-md-12">
				<div class="dt-front-sidebar-wrap">
					<?php dynamic_sidebar( 'dt-front-page-after-content' ); ?>
				</div><!-- .dt-front-sidebar-wrap -->
			</div><!-- .col-lg-12 -->
		<?php endif; ?>
	</div><!-- .row -->
</div><!-- .container -->

<?php
get_footer();
