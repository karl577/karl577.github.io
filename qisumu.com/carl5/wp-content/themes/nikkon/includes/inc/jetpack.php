<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Nikkon
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function nikkon_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'nikkon_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function nikkon_jetpack_setup
add_action( 'after_setup_theme', 'nikkon_jetpack_setup' );

function nikkon_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'templates/contents/content', get_post_format() );
	}
} // end function nikkon_infinite_scroll_render