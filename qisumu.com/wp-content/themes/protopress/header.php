<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package protopress
 */
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
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'protopress' ); ?></a>
	<div id="jumbosearch">
		<span class="fa fa-remove closeicon"></span>
		<div class="form">
			<?php get_search_form(); ?>
		</div>
	</div>	
	
	<div id="top-bar">
		<div class="container">
			<div id="top-menu">
				<?php wp_nav_menu( array( 'theme_location' => 'top' ) ); ?>
			</div>
			<div class="social-icons">
			<?php get_template_part('social', 'fa'); ?>
			<a id="searchicon">
				<span class="fa fa-search"></span>
			</a>	 
			</div>
		</div>
	</div>
	
	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="site-branding">
				<?php if ( get_theme_mod('protopress_logo') != "" ) : ?>
				<div id="site-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_theme_mod('protopress_logo'); ?>"></a>
				</div>
				<?php endif; ?>
				<div id="text-title-desc">
				<h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div>
			</div>	
		</div>	
		
		<div id="slickmenu"></div>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="container">
				<?php
					// Get the Appropriate Walker First.
					 if (has_nav_menu(  'primary' ) && !get_theme_mod('protopress_disable_nav_desc') ) :
							$walker = new Protopress_Menu_With_Description;
						else : 
							$walker = new Protopress_Menu_With_Icon;
					  endif;
					  //Display the Menu.							
					  wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => $walker ) ); ?>
			</div>
		</nav><!-- #site-navigation -->
		
	</header><!-- #masthead -->
	
	<div class="mega-container">
	
		<?php get_template_part('slider', 'nivo' ); ?>
		
		<?php get_template_part('featured', 'content2'); ?>
		<?php get_template_part('featured', 'content1'); ?>
	
		<div id="content" class="site-content container">