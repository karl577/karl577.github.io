<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<title><?php if (is_single() || is_page() || is_archive() || is_search()) { ?><?php wp_title('',true); ?> - <?php } bloginfo('name'); ?><?php if ( is_home() ){ ?> - <?php bloginfo('description'); ?><?php } ?><?php if ( is_paged() ){ ?> - <?php printf( __('Page %1$s of %2$s', ''), intval( get_query_var('paged')), $wp_query->max_num_pages); ?><?php } ?></title>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<?php if(is_single()) { ?>
<style>#header{border-bottom: none;margin-bottom: 0;}#header .w990 {margin-bottom: 10px;}</style>
<?php } ?>
<?php wp_deregister_script('jquery'); ?>
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
<div class="pr" style="overflow: hidden">
<div id="header">
	<div class="w990">
		<div id="logo"><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/logo.png" /></a></div>
		<div id="nav">
			<?php wp_nav_menu( array( 'theme_location' => 'header-menu','container' => '','menu_class' => 'nav_header','before' => '','after' => '') ); ?>
		</div>
		<p>
			<a href="http://ecd.tencent.com/feed" title="订阅全文RSS" class="icon icon-rss"><i>订阅全文RSS</i></a>
			<a href="http://t.qq.com/tencent_ecd" title="ECD的腾讯微博" class="icon icon-t"><i>ECD的腾讯微博</i></a> 
			<a href="http://weibo.com/tencentecd" title="ECD的新浪微博" class="icon icon-weibo"><i>ECD的新浪微博</i></a> 
		</p>
	</div>
</div>
<div class="c"></div>