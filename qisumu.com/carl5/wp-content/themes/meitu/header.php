<?php 
if (is_user_logged_in()) {
	if($_GET['fav']) { setFavCount($_GET['fav']);fav_user_update($_GET['fav']); };
	if($_GET['like']) { setLikeCount($_GET['like']);like_user_update($_GET['like']); };
	if($_GET['favx']) { fav_user_remove($_GET['favx']); };
};
?>
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
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/font-awesome.css" type="text/css" media="screen" />
<link href="<?php bloginfo('template_directory'); ?>/build/css/messenger.css" rel="stylesheet">
<link href="<?php bloginfo('template_directory'); ?>/build/css/messenger-theme-air.css" rel="stylesheet">
<!--[if IE 7]>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/font-awesome-ie7.min.css">
<![endif]-->
<script type="text/javascript" src="//upcdn.b0.upaiyun.com/libs/jquery/jquery-1.7.2.min.js"></script>
<script src="http://open.web.meitu.com/sources/xiuxiu.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#meitubtn").click(function(){   
		//var imgurl = jQuery(this).attr('imgurl'); 	
		xiuxiu.setLaunchVars ('nav', 'edit');
		xiuxiu.embedSWF("altContent",1,"100%","100%");
		/*第1个参数是加载编辑器div容器，第2个参数是编辑器类型，第3个参数是div容器宽，第4个参数是div容器高*/
		xiuxiu.setUploadURL("<?php bloginfo('template_directory'); ?>/upload/image_upload_streaming.php");//修改为上传接收图片程序地址
		xiuxiu.onInit = function () {
			//xiuxiu.loadPhoto(imgurl);
			//修改为要处理的图片url
		}
		xiuxiu.onUploadResponse = function (data) {
			if(isNaN(data)) {
				jQuery("#meituimg").val('<?php bloginfo('template_directory'); ?>/upload/'+data);
				jQuery("#meitu").css('display','none');  
				jQuery("#fabu").css('display','block');  
			} else {
				alert("上传响应：发生未知错误！");
			}
		}
		xiuxiu.onClose = function (id) {
			jQuery(".meitu").css('display','none');  
		}
		jQuery(".meitu").css('display','block'); 
    }); 
    jQuery("#meitubg").click(function(){   
    	jQuery(".meitu").css('display','none'); 
    	jQuery("#fabu").css('display','none'); 
    }); 
});
</script>
<script src="<?php bloginfo('template_directory'); ?>/js/cat.js"></script>
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
<div id="fabu">
	<form id="meituimgdiv" method="post" action="<?php bloginfo('template_directory'); ?>/publish.php">
		<h4>简单介绍您的美图</h4>
		<input value="" id="meituimg" name="tougao_fmimg" type="hidden">
		<textarea name="tougao_title"></textarea>
		<h4>标签 (多个标签以英文半角逗号隔开)</h4>
		<input class="input" type="text" value="" name="post_tags">
		<input type="submit" value="发布美图" id="meitu-submit">
		<input type="hidden" name="tougao_form" value="send">
	</form>
</div>
<div id="meitu" class="meitu">
	<div id="altContent"></div>
</div>
<div id="meitubg" class="meitu"></div>
<div id="header">
	<div class="w960">
		<h2 id="logo"><a href="<?php bloginfo('url'); ?>"><i class="icon-picture"></i> WP美图秀</a></h2>
		<div id="nav">
			<?php wp_nav_menu( array( 'theme_location' => 'header-menu','container' => '','menu_class' => 'nav_header','before' => '','after' => '') ); ?>
		</div>
		<?php if (is_user_logged_in()) { ?>
		<a href="javascript:;" id="meitubtn">分享美图</a>
		<div id="sign-in-btn">
			<a href="<?php echo get_option('mao10_account'); ?>">个人中心</a>
			<a href="<?php echo wp_logout_url( the_permalink() ); ?>">退出</a>
		</div>
		<?php } else { ?>
		<div id="sign-in-btn">
			<a href="<?php echo get_option('mao10_sign_in'); ?>">登陆</a>
			<a href="<?php echo get_option('mao10_sign_in'); ?>">注册</a>
		</div>
		<?php } ?>
	</div>
</div>