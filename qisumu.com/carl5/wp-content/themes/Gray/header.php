<!DOCTYPE html>
<html>
<head>
<title><?php if (is_single() || is_page() || is_archive() || is_search()) { ?><?php wp_title('',true); ?> - <?php } bloginfo('name'); ?><?php if ( is_home() ){ ?> - <?php bloginfo('description'); ?><?php } ?><?php if ( is_paged() ){ ?> - <?php printf( __('Page %1$s of %2$s', ''), intval( get_query_var('paged')), $wp_query->max_num_pages); ?><?php } ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
if (is_home()){ 
	$description     = get_option('mao10_description');
	$keywords = get_option('mao10_keywords');
} elseif (is_single() || is_page()){    
	$description1 =  $post->post_excerpt ;
	$description2 = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200, "…");
	$description = $description1 ? $description1 : $description2;
	$keywords = get_post_meta($post->ID, "keywords_value", true);        
} elseif(is_category()){
	$description     = category_description();
	$current_category = single_cat_title("", false);
	$keywords =  $current_category;
}
?>
<meta name="keywords" content="<?php echo $keywords ?>" />
<meta name="description" content="<?php echo $description ?>" />
<!-- Bootstrap -->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.css">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link href="<?php bloginfo('template_directory'); ?>/css/media.css" rel="stylesheet">

<?php wp_deregister_script('jquery'); ?>
<!--[if lt IE 9]>
<script src="<?php bloginfo('template_directory'); ?>/js/html5shiv.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/respond.min.js"></script>
<![endif]-->
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
<div class="row">
<div class="container" style="margin-top:65px;">
	
<nav id="top-nav" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">
				Toggle navigation
			</span>
			<span class="icon-bar">
			</span>
			<span class="icon-bar">
			</span>
			<span class="icon-bar">
			</span>
		</button>
		<a class="navbar-brand" id="xpmlogo" href="<?php bloginfo('url'); ?>">
			<?php bloginfo('name'); ?>
		</a>
	</div>
	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<?php wp_nav_menu( array( 'theme_location'=> 'nav-menu','container' => '','menu_class' => 'nav navbar-nav tbbs','before'=> '','after' => '') ); ?>
		<form class="navbar-form navbar-right xpmys" role="search" id="search" action="<?php bloginfo('url'); ?>" method="get">
			<div class="input-group">
				<input type="text" name="s" class="form-control" placeholder="搜索本站...">
				<span class="input-group-addon" id="sytijiao">
					<i class="glyphicon glyphicon-search"></i>
				</span>
			</div>
		</form>

</nav>