<?php
/**
 * Search color
 *
 * @package    Bulan
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015 - 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'bulan_customizer_search_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0
 */
function bulan_customizer_search_styles() {

	// Theme prefix
	$prefix = 'bulan-';

	// Search icon color
	$icon = bulan_mod( $prefix . 'search-icon-color' );

	if ( $icon !== customizer_library_get_default( $prefix . 'search-icon-color' ) ) {

		$color = sanitize_hex_color( $icon );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.search-toggle'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Search bg color
	$bg = bulan_mod( $prefix . 'search-bg-color' );

	if ( $bg !== customizer_library_get_default( $prefix . 'search-bg-color' ) ) {

		$color = sanitize_hex_color( $bg );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.search-toggle'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

}
endif;
add_action( 'bulan_customizer_library_styles', 'bulan_customizer_search_styles' );
