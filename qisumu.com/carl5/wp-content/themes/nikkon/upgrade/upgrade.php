<?php
/**
 * Functions for users wanting to upgrade to premium
 *
 * @package Nikkon
 */

/**
 * Display the upgrade to Premium page & load styles.
 */
function nikkon_premium_admin_menu() {
    global $nikkon_upgrade_page;
    $nikkon_upgrade_page = add_theme_page( __( 'About Nikkon', 'nikkon' ), '<span class="premium-link">' . __( 'About Nikkon', 'nikkon' ) . '</span>', 'edit_theme_options', 'theme_info', 'nikkon_render_upgrade_page' );
}
add_action( 'admin_menu', 'nikkon_premium_admin_menu' );

/**
 * Enqueue admin stylesheet only on upgrade page.
 */
function nikkon_load_upgrade_page_scripts() {
    global $pagenow;
	if ( $pagenow == 'themes.php' ) {
		wp_enqueue_style( 'nikkon-upgrade-css', get_template_directory_uri() . '/upgrade/css/upgrade-admin.css' );
	    wp_enqueue_script( 'caroufredsel', get_template_directory_uri() . '/js/caroufredsel/jquery.carouFredSel-6.2.1-packed.js', array( 'jquery' ), NIKKON_THEME_VERSION, true );
	    wp_enqueue_script( 'nikkon-upgrade-js', get_template_directory_uri() . '/upgrade/js/upgrade-custom.js', array( 'jquery' ), NIKKON_THEME_VERSION, true );
	}
}
add_action( 'admin_enqueue_scripts', 'nikkon_load_upgrade_page_scripts' );

/**
 * Render the premium page to download premium upgrade plugin
 */
function nikkon_render_upgrade_page() {
	get_template_part( 'upgrade/tpl/upgrade-page' );
}
