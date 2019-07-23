<?php
/**
 * Custom function to display data set in customizer.
 *
 * @package    Bulan
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015 - 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Loads custom style set in customizer
 */
require trailingslashit( get_template_directory() ) . 'inc/styles/global.php';
require trailingslashit( get_template_directory() ) . 'inc/styles/search.php';
require trailingslashit( get_template_directory() ) . 'inc/styles/header.php';
require trailingslashit( get_template_directory() ) . 'inc/styles/menu.php';
require trailingslashit( get_template_directory() ) . 'inc/styles/post.php';
require trailingslashit( get_template_directory() ) . 'inc/styles/page.php';
require trailingslashit( get_template_directory() ) . 'inc/styles/widget.php';
require trailingslashit( get_template_directory() ) . 'inc/styles/footer.php';
require trailingslashit( get_template_directory() ) . 'inc/styles/fonts.php';

if ( ! function_exists( 'bulan_customizer_styles' ) ) :
/**
 * Generates the style tag and CSS needed for the theme options.
 *
 * By using the "Customizer_Library_Styles" filter, different components can print CSS in the header.
 * It is organized this way to ensure there is only one "style" tag.
 *
 * @since  1.0.0
 */
function bulan_customizer_styles() {

	// Action to add the custom styles.
	do_action( 'bulan_customizer_library_styles' );

	// Echo the rules
	$css = Customizer_Library_Styles()->build();

	if ( ! empty( $css ) ) {
		echo "\n<!-- Begin Custom CSS -->\n<style type=\"text/css\" id=\"custom-css\">\n";
		echo $css;
		echo "\n</style>\n<!-- End Custom CSS -->\n";
	}

}
endif;
add_action( 'wp_head', 'bulan_customizer_styles', 11 );

if ( ! function_exists( 'bulan_custom_feed_url' ) ) :
/**
 * Custom RSS feed url.
 *
 * @since  1.0.0
 */
function bulan_custom_feed_url( $output, $feed ) {

	// Theme prefix
	$prefix = 'bulan-';

	// Get the custom rss feed url
	$url = bulan_mod( $prefix . 'custom-rss' );

	// Do not redirect comments feed
	if ( strpos( $output, 'comments' ) ) {
		return $output;
	}

	// Check the settings.
	if ( ! empty( $url ) ) {
		$output = esc_url( $url );
	}

	return $output;
}
endif;
add_filter( 'feed_link', 'bulan_custom_feed_url', 10, 2 );
