<?php
/*header头部*/

?>
<!DOCTYPE html>
<html>
<head>
<title><?php wp_title('-', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/genericons/genericons.css" />
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
<body>
<header id="top-header">
	<!--此处为网站标题及描述-->
   	<!-- <div class="logo">
   	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><h1><?php bloginfo( 'name' ); ?></h1></a>
    <span><?php bloginfo( 'description' ); ?></span>
	</div> -->
	
	<div class="logo">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png"></a>
	</div>
<nav>
    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id'=>'nav','container'=>'ul' ) ); ?>

</nav>



</header>