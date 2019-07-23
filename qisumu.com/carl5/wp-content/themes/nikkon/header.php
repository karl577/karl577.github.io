<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Nikkon
 */
global $woocommerce;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<!-- qisumu.com Baidu tongji analytics -->
<script>
var _hmt = _hmt || [];
(function() {
var hm = document.createElement("script");
hm.src = "https://hm.baidu.com/hm.js?cd8191d648355b940efdb3f1ba7fb3a0";
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(hm, s);
})();
</script>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site <?php echo sanitize_html_class( get_theme_mod( 'nikkon-slider-type' ) ); ?>">
	
<?php echo ( get_theme_mod( 'nikkon-site-layout' ) == 'nikkon-site-boxed' ) ? '<div class="site-boxed">' : ''; ?>
	
	<?php if ( get_theme_mod( 'nikkon-header-layout' ) == 'nikkon-header-layout-three' ) : ?>
	
		<?php get_template_part( '/templates/header/header-layout-three' ); ?>
	
	<?php else : ?>
		
		<?php get_template_part( '/templates/header/header-layout-one' ); ?>
		
	<?php endif; ?>
	
	<?php if ( is_front_page() ) : ?>
		
		<?php get_template_part( '/templates/slider/homepage-slider' ); ?>
		
	<?php endif; ?>

	<div class="site-container <?php echo ( ! is_active_sidebar( 'sidebar-1' ) ) ? sanitize_html_class( 'content-no-sidebar' ) : sanitize_html_class( 'content-has-sidebar' ); ?>">
