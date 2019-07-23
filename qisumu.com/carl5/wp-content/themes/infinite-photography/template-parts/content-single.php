<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Infinite Photography
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php infinite_photography_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<!--post thumbnal options-->
	<div class="single-feat clearfix">
		<figure class="single-thumb single-thumb-full">
			<?php
			$thumbnail = 'full';
			$no_image = get_template_directory_uri().'/assets/img/no-image-840-480.jpg';
			if( has_post_thumbnail() ):
				the_post_thumbnail( $thumbnail );
			else:
				$img_url[0] = $no_image;
				?>
				<img src="<?php echo esc_url( $img_url[0] ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
				<?php
			endif;
			?>
		</figure>
	</div><!-- .single-feat-->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'infinite-photography' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php infinite_photography_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

