<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include( 'inc/seo.php'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/bootstrap-responsive.min.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/flexslider.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/prettyPhoto.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css">
<noscript>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/no-js.css">
</noscript>
<!--[if lt IE 9]>
		<script src="<?php bloginfo('template_directory'); ?>/js/html5.js"></script>
	<![endif]-->
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico">
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.8.3.min.js"></script>
<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js'></script>
<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/jquery.easing.js'></script>
<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/jquery.flexslider-min.js'></script>
<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/jquery.jticker.js'></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/main.js"></script>
<?php echo get_option('headcode')?>
<style>
<?php echo get_option('csscode')?>
</style>
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
</head><body>
<div id="top-navigation">
  <div class="container">
    <ul class="nav-menu pull-left">
      <?php 
	  if(has_nav_menu('nav-menu')){
	  	wp_nav_menu(
		   array(
		    'theme_location'  => 'top-menu',
		    'container' => '',
			'menu_class' => 'nav-menu pull-left',
		   )
	  	);
	  }else{
	  		echo "<ul class='nav-menu pull-left'><li><a href='".get_bloginfo('url')."/wp-admin/nav-menus.php'>还没有设置导航菜单，请到后台 外观->菜单 设置一个导航菜单</a></li></ul>";
	  }
	 ?>
    </ul>
    <form name="form-search" method="post" action="<?php bloginfo('home'); ?>" class="form-search pull-right">
      <input name="s" id="s" type="text"  onblur="if(this.value=='') this.value='试试手气...';" onfocus="if(this.value=='试试手气...') this.value='';" class="input-icon input-icon-search" />
    </form>
  </div>
</div>
<div class="container">
<header id="header" class="clearfix">
  <div class="logo pull-left"> <a href="<?php bloginfo('url'); ?>"><img alt="logo" src="<?php echo get_option('logo')?>" /></a> </div>
  <?php
	 	 $ad1_close = get_option('ad1_close');
	 	 if ($ad1_close == 'open') {
	?>
  <div class="ads pull-right"> <?php echo get_option('ad1');?> </div>
  <?php } ?>
</header>
<nav id="main-navigation" class="clearfix">
  <?php 
	  if(has_nav_menu('nav-menu')){
	  	wp_nav_menu(
		   array(
		    'theme_location'  => 'nav-menu',
		    'container' => '',
			'menu_class' => 'nav',
		   )
	  	);
	  }else{
	  		echo "<ul class='nav'><li><a href='".get_bloginfo('url')."/wp-admin/nav-menus.php'>还没有设置导航菜单，请到后台 外观->菜单 设置一个导航菜单</a></li></ul>";
	  }
	 ?>
</nav>
<?php
	 	 $sign_close = get_option('sign_close');
	 	 if ($sign_close == 'open') {
	?>
<div class="headlines clearfix"> <span class="base">公告：</span>
  <div class="text-rotator">
    <div><?php echo get_option('sign');?></div>
  </div>
</div>
<?php } ?>
<div class="margin-bottom10"></div>
