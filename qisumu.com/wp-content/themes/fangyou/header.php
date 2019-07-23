<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php if(is_home()){ ?><title><?php bloginfo('name'); ?><?php if(get_option('blog_title_suffix')!=""){ ?>_<?php echo get_option('blog_title_suffix'); ?><?php } ?></title><?php } ?>
<?php if(is_search()){ ?><title><?php echo trim(wp_title("",0)); ?>_<?php bloginfo('name'); ?></title><?php } ?>
<?php if(is_single()){ ?><title><?php echo trim(wp_title("",0)); ?>_<?php bloginfo('name'); ?></title><?php } ?>
<?php if(is_page()){ ?><title><?php echo trim(wp_title("",0)); ?>_<?php bloginfo('name'); ?></title><?php } ?>
<?php if(is_category()){ ?><title><?php single_cat_title(); ?>_<?php bloginfo('name'); ?></title><?php } ?>
<?php if(is_tag()){ ?><title><?php single_tag_title("",true); ?>_<?php bloginfo('name'); ?></title><?php } ?>
<?php if(is_year()){ ?><title><?php the_time("Y年"); ?>发布的<?php if(get_option('blog_article_nickname')!=""){echo get_option('blog_article_nickname');}else{ ?>内容<?php } ?>_<?php bloginfo('name'); ?></title><?php } ?>
<?php if(is_month()){ ?><title><?php the_time("Y年m月"); ?>发布的<?php if(get_option('blog_article_nickname')!=""){echo get_option('blog_article_nickname');}else{ ?>内容<?php } ?>_<?php bloginfo('name'); ?></title><?php } ?>
<?php if(is_day()){ ?><title><?php the_time("Y年m月d日"); ?>发布的<?php if(get_option('blog_article_nickname')!=""){echo get_option('blog_article_nickname');}else{ ?>内容<?php } ?>_<?php bloginfo('name'); ?></title><?php } ?>
<?php if(is_author()){ ?><title><?php the_author(); ?>发布的<?php if(get_option('blog_article_nickname')!=""){echo get_option('blog_article_nickname');}else{ ?>内容<?php } ?>_<?php bloginfo('name'); ?></title><?php } ?>
<?php if(is_404()){ ?><title>404错误_<?php bloginfo('name'); ?></title><?php } ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if(is_home()){
$description=get_option('blog_description');
$keywords=get_option('blog_keywords');}
elseif(is_page()){
$description=wp_title("",false);
$keywords=wp_title("",false);}
elseif(is_search()){
$description=wp_title("",false);
$keywords=wp_title("",false);}
elseif(is_tag()){
$description=wp_title("",false);
$keywords=wp_title("",false);}
elseif(is_year()){
$description=wp_title("",false);
$keywords=wp_title("",false);}
elseif(is_month()){
$description=wp_title("",false);
$keywords=wp_title("",false);}
elseif(is_day()){
$description=wp_title("",false);
$keywords=wp_title("",false);}
elseif(is_author()){
$description=wp_title("",false);
$keywords=wp_title("",false);}
elseif(is_404()){
$description="找不到相关页面";
$keywords="404错误";}
elseif
(is_single()){
if($post->post_excerpt){$description=$post->post_excerpt;}
elseif(function_exists('wp_thumbnails_excerpt')){
$description=wp_thumbnails_excerpt($post->post_content, true);}
else{$description=$post->post_title;}
foreach((get_the_category()) as $category){
$keywords=$category->cat_name;}
$tags=wp_get_post_tags($post->ID);
foreach($tags as $tag){
$keywords=$keywords.",".$tag->name;}}
elseif(is_category()){
$description=category_description();
$description=strip_tags($description);
$description=trim($description);
$keywords=single_cat_title("",false);
}
echo"<meta name=\"keywords\" content=\"$keywords\" />
<meta name=\"description\" content=\"$description\" />";
?>

<meta name="author" content="http://www.tdec.cn"  />
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php if(get_option('blog_logo_ico')!=""){echo get_option('blog_logo_ico');}else{bloginfo('template_url'); ?>/images/link.ico<?php } ?>" type="image/x-icon" />
<link rel="bookmark" href="<?php if(get_option('blog_logo_ico')!=""){echo get_option('blog_logo_ico');}else{bloginfo('template_url'); ?>/images/link.ico<?php } ?>" type="image/x-icon" />
<link rel="icon" href="<?php if(get_option('blog_logo_ico')!=""){echo get_option('blog_logo_ico');}else{bloginfo('template_url'); ?>/images/link.ico<?php } ?>" type="image/x-icon" />



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
<div class="header">
  <div class="common">
      <div class="logo">
	    <a href="<?php echo esc_url(home_url('')); ?>" title="<?php bloginfo('name'); ?>" <?php if(get_option('blog_logo_png')!=""){ ?>style="width:<?php echo get_option('blog_logo_width'); ?>px;height:<?php echo get_option('blog_logo_height'); ?>px;background:url(<?php echo get_option('blog_logo_png'); ?>) no-repeat;_background:url(<?php echo get_option('blog_logo_gif'); ?>) no-repeat;"<?php }else{ ?>style="width:186px;height:38px;background:url(<?php bloginfo('template_url'); ?>/images/logo.png)  no-repeat;"<?php } ?>></a>
	   </div>
	   <div id="submenu" class="nav">
        <ul>
<li<?php if(is_home()){echo' class="current-menu-item"';} ?>><a href="<?php echo esc_url(home_url('')); ?>">首页</a></li>
<?php if(function_exists('wp_nav_menu')) wp_nav_menu(array('container'=>false,'items_wrap'=>'%3$s','theme_location'=>'mainmenu')); ?>
        </ul>
       </div>
	   <div class="reg">
	      <a href="<?php echo esc_url(home_url('')); ?>/wp-login.php?action=register" target="_blank">注册</a>
	   </div>
	   <div class="login">
	      <a href="<?php echo esc_url(home_url('')); ?>/wp-login.php" target="_blank">登录</a>
	   </div>
	 </div> 
</div>
<div class="clear"></div>