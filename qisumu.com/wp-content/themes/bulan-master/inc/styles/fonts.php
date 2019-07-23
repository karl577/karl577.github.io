<?php
/**
 * Fonts
 *
 * @package    Bulan
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015 - 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'bulan_customizer_fonts' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0
 */
function bulan_customizer_fonts() {

	// Theme prefix
	$prefix = 'bulan-';

	// Text font
	$text  = bulan_mod( $prefix . 'text-font' );
	$stack = customizer_library_get_font_stack( $text );

	if ( $text !== customizer_library_get_default( $prefix . 'text-font' ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'body'
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );
	}

	// Heading font
	$heading = bulan_mod( $prefix . 'heading-font' );
	$stack   = customizer_library_get_font_stack( $heading );

	if ( $heading !== customizer_library_get_default( $prefix . 'heading-font' ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );
	}

}
endif;
add_action( 'bulan_customizer_library_styles', 'bulan_customizer_fonts' );

if ( ! function_exists( 'bulan_enqueue_fonts' ) ) :
/**
 * Enqueue Google Fonts
 *
 * @since  1.0.0
 */
function bulan_enqueue_fonts() {

	// Theme prefix
	$prefix = 'bulan-';

	// Font options
	$fonts = array(
		bulan_mod( $prefix . 'text-font' ),
		bulan_mod( $prefix . 'heading-font' )
	);

	$font_uri = customizer_library_get_google_font_uri( $fonts );

	// Load Google Fonts
	wp_enqueue_style( 'bulan-custom-fonts', $font_uri, array(), null );

}
endif;
add_action( 'wp_enqueue_scripts', 'bulan_enqueue_fonts' );
