<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' );?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="screen" type="text/css">
<link href="<?php bloginfo( 'template_url' ); ?>/images/favicon.ico" rel="icon">
<?php
	if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script( 'jquery' );
	wp_head();
?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script>
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
<header class="mod-head">
	<h1 class="mod-head__title"><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>
	<div class="mod-head__logo">
		<a href="<?php echo get_option('home'); ?>">
			<img class="avatar" src="<?php bloginfo( 'template_url' ); ?>/images/avatar.png" alt="" width="26" height="26">
		</a>
	</div>
	<nav class="mod-head__nav">
	<?php 
		$top_nav = wp_nav_menu( array( 'theme_location'=>'main', 'fallback_cb'=>'', 'container'=>'', 'menu_class'=>'mod-head__ul', 'echo'=>false, 'after'=>'<span>·</span>' ) );
		$top_nav = str_replace( "<span>·</span></li>\n</ul>", "</li>\n</ul>", $top_nav );
		echo $top_nav;
	?>
	</nav>
	<a id="right-panel-link" href="#right-panel"></a>
	<div id="right-panel" class="panel">
		<?php 
			$top_nav = wp_nav_menu( array( 'theme_location'=>'main', 'fallback_cb'=>'', 'container'=>'', 'menu_class'=>'ymod-head', 'echo'=>false, 'after'=>'' ) );
			$top_nav = str_replace( "</li>\n</ul>", "</li>\n</ul>", $top_nav );
			echo $top_nav;
		?>
	<button id="close-panel-bt">Close</button>
	</div>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/slider.js"></script>
	<script>$('#right-panel-link').panelslider({side: 'right', duration: 200 });$('#close-panel-bt').click(function() {$.panelslider.close();});</script>
</header>