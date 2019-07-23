<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package EasyBlog
 */

?>

<footer class="dt-footer">
	<div class="dt-footer-bar">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="dt-copyright">

						<?php _e( 'Copyright &copy;', 'easyblog' ); ?> <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a><?php _e( '. All rights reserved.', 'easyblog' )?>

						<?php printf( esc_html__( 'Powered %1$s by %2$s', 'easyblog' ), '', '<a href="https://wordpress.org/" target="_blank">WordPress</a>' ); ?>
						<span class="sep"> &amp; </span>
						<?php _e( 'Designed by', 'easyblog' ); ?> <a href="<?php echo esc_url( 'http://daisythemes.com/'); ?>" target="_blank" rel="designer"><?php _e( 'Daisy Themes', 'easyblog' )?></a>

					</div><!-- .dt-copyright -->
				</div><!-- .col-lg-12 -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .dt-footer-bar -->
</footer><!-- .dt-footer -->

<a id="back-to-top" class="transition35"><i class="fa fa-angle-up"></i></a><!-- #back-to-top -->

<?php wp_footer(); ?>

</body>
</html>
