<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

				<?php if (zm_get_option('copyright')) { ?>
					<?php get_template_part( 'inc/copyright' ); ?>
				<?php } ?>

				<?php if (zm_get_option('single_tao')) { ?>
					<?php get_template_part( 'inc/single-tao' ); ?>
				<?php } ?>

				<?php if (zm_get_option('related_img')) { ?>
					<?php get_template_part( 'inc/related-img' ); ?>
				<?php } ?>

				<div id="single-widget">
					<?php dynamic_sidebar( 'sidebar-e' ); ?>
					<div class="clear"></div>
				</div>

				<?php get_template_part('ad/ads', 'comments'); ?>

				<nav class="nav-single">
					<?php
						if (get_previous_post( TRUE )) { previous_post_link( '%link','<span class="meta-nav"><span class="post-nav"><i class="fa fa-angle-left"></i> 上一篇</span><br/>%title</span>', TRUE ); } else { echo "<span class='meta-nav'><span class='post-nav'>没有了<br/></span>已是最后文章</span>"; }
						if (get_next_post( TRUE )) { next_post_link( '%link', '<span class="meta-nav"><span class="post-nav">下一篇 <i class="fa fa-angle-right"></i></span><br/>%title</span>', TRUE ); } else { echo "<span class='meta-nav'><span class='post-nav'>没有了<br/></span>已是最新文章</span>"; }
					?>
					<div class="clear"></div>
				</nav>
				<nav class="nav-single-c">
					<?php
						the_post_navigation( array(
							'next_text' => '<span class="meta-nav-l" aria-hidden="true"><i class="fa fa-angle-right"></i></span> ',
							'prev_text' => '<span class="meta-nav-r" aria-hidden="true"><i class="fa fa-angle-left"></i></span> ',
						) );
					?>
				</nav>
				<?php if ( comments_open() || get_comments_number() ) : ?>
					<?php comments_template( '', true ); ?>
				<?php endif; ?>

			<?php endwhile; ?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>