<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Nikkon
 */
?>
		<div class="clearboth"></div>
	</div><!-- #content -->
	
	<?php if ( get_theme_mod( 'nikkon-footer-layout', false ) == 'nikkon-footer-layout-social' ) : ?>

	    <?php get_template_part( '/templates/footers/footer-social' ); ?>
	    
	<?php elseif ( get_theme_mod( 'nikkon-footer-layout', false ) == 'nikkon-footer-layout-none' ) : ?>

	    <?php get_template_part( '/templates/footers/footer-none' ); ?>
	    
	<?php else : ?>
		
		<?php get_template_part( '/templates/footers/footer-standard' ); ?>
	    
	<?php endif; ?>
	
<?php echo ( get_theme_mod( 'nikkon-site-layout' ) == 'nikkon-site-boxed' ) ? '</div>' : ''; ?>
	
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
