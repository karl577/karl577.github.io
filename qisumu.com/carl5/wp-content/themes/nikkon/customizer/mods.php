<?php
/**
 * Functions used to implement options
 *
 * @package Customizer Library Nikkon
 */

/**
 * Enqueue Google Fonts Example
 */
function customizer_nikkon_fonts() {

	// Font options
	$fonts = array(
		get_theme_mod( 'nikkon-body-font', customizer_library_get_default( 'nikkon-body-font' ) ),
		get_theme_mod( 'nikkon-heading-font', customizer_library_get_default( 'nikkon-heading-font' ) )
	);

	$font_uri = customizer_library_get_google_font_uri( $fonts );

	// Load Google Fonts
	wp_enqueue_style( 'customizer_nikkon_fonts', $font_uri, array(), null, 'screen' );

}
add_action( 'wp_enqueue_scripts', 'customizer_nikkon_fonts' );
