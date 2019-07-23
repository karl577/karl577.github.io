<?php

/**
 * Add menu to Appearance screen
 *
 * @since SG Circus 1.0
 */
function sgcircus_admin_page() {
	add_theme_page( __( 'About theme', 'sgcircus' ), __( 'About SG Circus', 'sgcircus' ), 'edit_theme_options', 'sgcircus-page', 'sgcircus_about_page');
}
add_action( 'admin_menu', 'sgcircus_admin_page' );
 
 /**
 * Add css styles for admin page
 *
 * @since SG Circus 1.0.1
 */
function sgcircus_admim_style( $hook ) {
	if ( 'appearance_page_sgcircus-page' != $hook ) {
		return;
	}
	wp_enqueue_style( 'sgcircus-admin-page-style', get_stylesheet_directory_uri() . '/inc/css/admin-page.css', array(), null );
	wp_enqueue_style( 'sgcircus-admin-fonts', '//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038', array(), null );
	
}
add_action( 'admin_enqueue_scripts', 'sgcircus_admim_style' );

/**
 * About theme page
 *
 * @since SG Circus 1.0
 */
function sgcircus_about_page() {
?>
	<div class="main-wrapper">
		<p class="sg-header"><?php esc_html_e( 'Main Info', 'sgcircus' ); ?></p>
		<ul class="sg-buttons">
			<li><a href="<?php echo home_url() . esc_url( '/wp-admin/customize.php' ); ?>"><?php esc_html_e( 'Theme Options', 'sgcircus' ); ?></a></li>
			<li><a href="<?php echo home_url() . esc_html( '/wp-admin/customize.php?autofocus[panel]=widgets' ); ?>"><?php esc_html_e( 'Widgets', 'sgcircus' ); ?></a></li>
			<li><a href="<?php echo __( 'http://wpblogs.ru/themes/how-to-video-sg-window-theme/', 'sgcircus' ); ?>"><?php esc_html_e( 'How to use a theme (Video)', 'sgcircus' ); ?></a></li>
			<li><a href="<?php echo esc_url( 'https://wordpress.org/support/theme/sgcircus' ); ?>"><?php esc_html_e( 'Support forum', 'sgcircus' ); ?></a></li>
			<li><a href="<?php echo esc_url( 'https://wordpress.org/support/view/theme-reviews/sgcircus#postform' ); ?>"><?php esc_html_e( 'Rate on WordPress.org', 'sgcircus' ); ?></a></li>
			<?php if ( ! defined ( 'sgcircus' ) ) : ?>
			<li class="pro"><a href="<?php echo esc_url( 'http://wpblogs.ru/themes/sg-window-pro/' ); ?>"><?php esc_html_e( 'Update to Pro', 'sgcircus' ); ?></a></li>
			<?php endif; ?>
			</li>
		</ul>
		<div class="info-wrapper">
			<div class="icon-image">
				<img src="<?php echo get_stylesheet_directory_uri() . '/screenshot.png'; ?>"/>
			</div><!-- .icon-image -->
			<div class="info">
			<?php if ( ! defined ( 'sgcircus' ) ) : ?>
				<p><?php esc_html_e( 'You are using light version of SG Circus. Update to Pro to have even more features. For Example:', 'sgcircus' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'Custom colors;', 'sgcircus' ); ?></li>
					<li><?php esc_html_e( 'Site/content width;', 'sgcircus' ); ?></li>
					<li><?php esc_html_e( 'Boxed/Full width layout;', 'sgcircus' ); ?></li>
					<li><?php esc_html_e( 'WooCommerce layouts;', 'sgcircus' ); ?></li>
					<li><?php esc_html_e( 'Footer text options.', 'sgcircus' ); ?></li>
				</ul>
			<?php else: 
			
				do_action( 'sgwindow_pro_version' );
	
			endif; ?>

			</div><!-- .info -->
			
		</div><!-- .info-wrapper -->
		<div class="more-info">
			<a href="<?php echo esc_url( 'http://wpblogs.ru/themes/sg-window-pro/' ); ?>"><?php esc_html_e( 'More Info', 'sgcircus' ); ?></a>
		</div><!-- .more-info -->
		
		<a alt="" href="http://wpblogs.ru/themes/blog/theme/sg-window/"><p class="parent-text"><?php esc_html_e( 'Parent theme', 'sgcircus' ); ?></p></a>
		<a  class="parent-img" alt="" href="http://wpblogs.ru/themes/blog/theme/sg-window/"><img src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>"/></a>

	</div><!-- .main-wrapper -->
<?php
}