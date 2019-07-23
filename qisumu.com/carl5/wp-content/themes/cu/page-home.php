<?php
/*
Template Name: Home逼格页
*/
?>
<!DOCTYPE html>
<html lang="zh-cn"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title><?php bloginfo('name'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<style>
*{margin:0;padding:0}body{font:400 16px/1.62 Georgia,"Xin Gothic","Hiragino Sans GB","Droid Sans Fallback","Microsoft YaHei",sans-serif;color:#535353;overflow:hidden}.willerce{text-align:center;margin:100px auto auto auto;max-width:500px;padding:0 20px}.willerce a{color:#535353;text-decoration:underline}.willerce a:link,.willerce a:visited{color:#535353;text-decoration:underline}h1{font-size:26px;color:#424242;margin-bottom:20px}.avatar{margin-bottom:35px;border-radius:64px;box-shadow:0 1px 2px rgba(0,0,0,0.5)}.nav a{padding:0 6px 0 6px}@keyframes fade-in{0%{opacity:0}40%{opacity:0}100%{opacity:1}}@-webkit-keyframes fade-in{0%{opacity:0}40%{opacity:0}100%{opacity:1}}.willerce{animation:fade-in;animation-duration:1s;-webkit-animation:fade-in 1s}
</style>
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
<div class="willerce">
  <img class="avatar" src="<?php bloginfo( 'template_url' ); ?>/images/avatar.png" alt="" width="128" height="128">
  <h1><?php bloginfo('name'); ?></h1>
  <p>Work @ Shanghai Pharmaceutical Group, Network programming team leader. More <a href="/about">About Me</a> </p>
  <p style="height: 24px; line-height: 24px; margin: 15px 0;">
    <img style="vertical-align: bottom; margin-right: 10px;" src="<?php bloginfo( 'template_url' ); ?>/images/address.png">
    ShangHai · China
  </p>
  <p class="nav">
	<?php   
	 $menuParameters = array(  
	 'container' => false,  
	 'echo' => false,  
	 'items_wrap' => '%3$s',  
	 'depth' => 0,  
	 'theme_location'=>'main',
	 );  
	 echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );  
	?> 
  </p>
</div>
</body></html>