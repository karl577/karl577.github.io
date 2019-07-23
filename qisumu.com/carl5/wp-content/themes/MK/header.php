<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>
<head profile="http://gmpg.org/xfn/11">

<?php include('seo.php'); ?> 
<link id="favicon" href="http://www.aimks.com/favicon.ico" rel="icon" type="image/x-icon" /> 
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
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?3dc477a5cf58fd981872baeebcd64cc7";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<?php wp_enqueue_script("jquery"); ?>	
<meta property="wb:webmaster" content="0100971403e48e42" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '-', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " - $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' - ' . sprintf( __( 'Page %s', 'black_with_orange'), max( $paged, $page ) );

	?></title>

	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
	<?php wp_head(); ?>
	<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/common.js"></script>
</head>
<body <?php body_class(); ?>>
	<div class="header">
		<div>
			<p class="title"><a href="<?php echo home_url(); ?>/" name="top"><?php bloginfo('name'); ?></a></p>
			<?php get_search_form(); ?>
			<p class="tagline"><span><?php bloginfo('description'); ?></span></p>

		</div>
	</div>
	<div class="nav">
		<div>
			<?php wp_nav_menu( array('fallback_cb' => 'black_with_orange_page_menu', 'depth' => '3', 'theme_location' => 'primary', 'link_before' => '', 'link_after' => '', 'container' => false) ); ?>
			<div class="clear"><!-- --></div>
		</div>
	</div>
	<div class="body">
		<div class="content">