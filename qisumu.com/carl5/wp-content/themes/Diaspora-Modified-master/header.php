<!DOCTYPE html>
<html <?php language_attributes(); ?> class="loading" class="han-la">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="google" content="notranslate" />
<title><?php bloginfo('name'); ?> <?php wp_title( '|', true, 'left' ); ?></title>
<meta name="author" content="<?php echo diaspora_option('author'); ?>">
<?php 
	if (is_home()){
		$description =  diaspora_option('desc');
		$keywords =  diaspora_option('keywords');
	} elseif (is_single() || is_page()){    
		$description1 =  $post->post_excerpt ;
		$description2 = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200, "…");
		$description = $description1 ? $description1 : $description2;
		$keywords = "";        
		$tags = wp_get_post_tags($post->ID);
		foreach ($tags as $tag ) {
			$keywords = $keywords . $tag->name . ", ";
		}
	} elseif(is_category()){
		$description     = strip_tags(category_description());
		$current_category = single_cat_title("", false);
		$keywords =  $current_category;
	}
?>
<meta name="keywords" content="<?php echo $keywords ?>" />
<meta name="description" content="<?php echo $description ?>" />
<style>
/* http://lorem.in  @author LoeiFy@gmail.com */ 

body,div,h1,h2,h3,h4,h5,li,p,ul{margin:0;padding:0;font-weight:400;list-style:none}html{-webkit-text-size-adjust:100%}body,html{-webkit-tap-highlight-color:transparent;-webkit-font-smoothing:antialiased;background:#fff}body{position:relative;overflow-x:hidden}body:before{background:grey;position:absolute;content:'';width:14px;height:14px;left:50%;top:50%;margin-left:-7px;margin-top:-7px;border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-webkit-animation:loading 2s ease-out forwards infinite;-moz-animation:loading 2s ease-out forwards infinite;display:none}body.loading:before{display:block}@-webkit-keyframes loading{0%{-webkit-transform:scale(0.3)}50%{-webkit-transform:scale(1)}100%{-webkit-transform:scale(0.3)}}@-moz-keyframes loading{0%{-moz-transform:scale(0.3)}50%{-moz-transform:scale(1)}100%{-moz-transform:scale(0.3)}}body.loading #container,body.loading #single,body.loading .nav{opacity:0}body.loading,html.loading{height:100%;overflow:hidden}
.header-logo {
	<?php if (is_home()) { ?> background: url(<?php echo diaspora_option('uploadlogo-index'); ?>); <?php } ?>
	<?php if (!is_home()) { ?> background: url(<?php echo diaspora_option('uploadlogo'); ?>); <?php } ?>
}
</style>
<script>if(self!=top){top.location=self.location}if(location.href.indexOf('o.l')>-1||location.href.indexOf('ol')>-1){document.documentElement.style.display='block'}</script>
<script>var duoshuoQuery = {short_name:location.host.replace('.', '')};</script>
<script src="<?php echo get_template_directory_uri(); ?>/static/basket.js?000"></script>
<script>
	basket.require({ url: '<?php echo get_template_directory_uri(); ?>/dist/Diaspora.css', unique: 9,  execute: false })
	.then(function(responses) {
        _stylesheet.appendStyleSheet(responses[0], function() {});
		basket.require({ url: '<?php echo get_template_directory_uri(); ?>/static/jquery.min.js', unique: 4 })
		.then(function() {
			basket.require({ url: '<?php echo get_template_directory_uri(); ?>/dist/plugin.js', unique: 4 })
			.then(function() {
        		basket.require({ url: '<?php echo get_template_directory_uri(); ?>/dist/Diaspora.js', unique: 12 })
					.then(function() {
						basket.require({ url: '<?php echo get_template_directory_uri(); ?>/static/text-autospace.js', unique: 14 })
					})
			})
		})
	});
</script>
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
<body class="loading">
<div id="loader"></div>