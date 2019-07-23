<?php
/*
Template Name: 资料设置
*/
$fb = $_GET["fb"];
				require_once( ABSPATH . WPINC . '/registration.php');
				if(!empty($_POST["action"])/* || !wp_verify_nonce($_POST['name_of_nonce_field'],'name_of_my_action')*/) {
					$user_id = wt_get_user_id(); 
					$display_name = $_POST["display_name"]; 
					$email = $_POST["email"]; 
					$youbian = $_POST["youbian"]; 
					$description = $_POST["description"]; 
					$dianhua = $_POST["dianhua"];
					$mobile = $_POST["mobile"];
					$user_pass = $_POST["user_pass"];
					$user_pass2 = $_POST["user_pass2"];
					$error = '';
					if($display_name == '') {
						$error .= '<div id="tishi">你没有填写用户名！</div>';
					}
					if($email == '') {
						$error .= '<div id="tishi">你没有填写邮箱！</div>';
					}
					if(!empty($user_pass)) {
						if(strlen($_POST['user_pass']) < 6) {
							$error .= '<div id="tishi">密码长度必须大于等于6位！</div>';
						} elseif($_POST['user_pass'] != $_POST['user_pass2']) {
							$error .= '<div id="tishi">两次输入的密码必须一致!</div>';
						} else {
							update_user_meta($user_id, 'user_pass', $user_pass);
							wp_update_user( array ('ID' => $user_id, 'user_pass' => $user_pass) ) ;
							$error1 .= '<div id="tishi2">密码修改成功！</div>';
						}
					}
					if($error == '') {
						update_user_meta($user_id, 'display_name', $display_name);
						update_user_meta($user_id, 'user_email', $email);
						update_user_meta($user_id, 'youbian', $youbian);
						update_user_meta($user_id, 'description', $description);
						update_user_meta($user_id, 'dianhua', $dianhua);
						update_user_meta($user_id, 'mobile', $mobile);
						wp_update_user( array ('ID' => $user_id, 'display_name' => $display_name, 'user_email' => $email, 'youbian' => $youbian, 'description' => $description, 'dianhua' => $dianhua, 'mobile' => $mobile) ) ;
						$error1 .= '<div id="tishi2">更新资料成功！</div>';
					}
				}
?>
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
		xiuxiu.embedSWF("altContent",5,"100%","100%");
		/*第1个参数是加载编辑器div容器，第2个参数是编辑器类型，第3个参数是div容器宽，第4个参数是div容器高*/
		xiuxiu.setUploadURL("<?php bloginfo('template_directory'); ?>/avatar/image_upload_streaming.php");//修改为上传接收图片程序地址
		xiuxiu.onInit = function () {
			//xiuxiu.loadPhoto(imgurl);
			//修改为要处理的图片url
		}
		xiuxiu.onUploadResponse = function (data) {
			if(isNaN(data)) {
				jQuery("#meituimg2").attr('src','<?php bloginfo('template_directory'); ?>/avatar/'+data);
				jQuery("#meituimg").val('<?php bloginfo('template_directory'); ?>/avatar/'+data);
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
<style>
	#meitu {width: 959px; margin-left: -480px;}
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
<div id="fabu">
	<form id="meituimgdiv" method="post" action="<?php bloginfo('template_directory'); ?>/touxiang.php">
		<h4>您的上传头像</h4>
		<input value="" id="meituimg" name="tougao_fmimg" type="hidden">
		<img src="" id="meituimg2">
		<input type="submit" value="更新头像" id="meitu-submit">
		<input type="hidden" name="tougao_form2" value="send">
	</form>
</div>
<div id="meitu" class="meitu">
	<div id="altContent"></div>
</div>
<div id="meitubg" class="meitu"></div>
<div id="header">
	<div class="w960">
		<h2 id="logo"><a href="<?php bloginfo('url'); ?>"><i class="icon-picture"></i> WP美图秀</a></h2>
		<?php if (is_user_logged_in()) { ?>
		<div id="sign-in-btn">
			<a href="<?php bloginfo('url'); ?>">返回首页</a>
			<a href="<?php echo get_author_posts_url(wt_get_user_id()); ?>">我的分享</a>
			<a href="<?php echo get_option('mao10_guanzhu'); ?>">我的关注</a>
			<a href="<?php echo get_option('mao10_fav'); ?>">我的收藏</a>
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
<div class="w960">
	<div id="content">
		<?php if (is_user_logged_in()) { ?>
		<form id="your-profile" class="pr" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
		<?php wp_nonce_field('name_of_my_action','name_of_nonce_field'); ?>
		<div id="content-post" class="account">
			<div id="tishix">
				<?php if(!empty($error1)) { echo $error1; } elseif(!empty($error)) { echo $error; } ?>
				<?php if($fb) { ?><div id="tishi2">发布作品成功！</div><?php } ?>
			</div>
			<h1>资料设置<a href="javascript:;" id="meitubtn">更新头像</a></h1>
			<div id="grzlgl">
				<div class="authorinfo edit">
				<span class="description">用户名</span>
				<span class="description2"><?php the_author_meta('user_login',wt_get_user_id()); ?></span>
				</div>
				
				<h4>基本信息</h4><div class="c"></div>
				
				<div class="authorinfo edit">
				<span class="description">名字（必填）</span>
				<input type="text" name="display_name" id="display_name" value="<?php the_author_meta('display_name',wt_get_user_id()); ?>" class="regular-text">
				</div>
				
				<div class="authorinfo edit">
				<span class="description">你的邮箱（必填）</span>
				<input type="text" name="email" id="email" value="<?php the_author_meta('user_email',wt_get_user_id()); ?>" class="regular-text">
				</div>
				
				<h4>联系方式</h4><div class="c"></div>
				
				<div class="authorinfo edit">
				<span class="description">邮编</span>
				<input type="text" name="youbian" id="youbian" value="<?php the_author_meta('youbian',wt_get_user_id()); ?>" class="regular-text" />
				</div>
				
				<div class="authorinfo edit">
				<span class="description">固话</span>
				<input type="text" name="dianhua" id="dianhua" value="<?php the_author_meta('dianhua',wt_get_user_id()); ?>" class="regular-text" />
				</div>
				
				<div class="authorinfo edit">
				<span class="description">手机</span>
				<input type="text" name="mobile" id="mobile" value="<?php the_author_meta('mobile',wt_get_user_id()); ?>" class="regular-text" />
				</div>
				
				<div class="authorinfo edit description">
				<span class="description">地址</span>
				<textarea name="description" id="descriptiont" rows="5" cols="50"><?php the_author_meta('description',wt_get_user_id()); ?></textarea>
				</div>
				
				<h4>修改密码</h4><div class="c"></div>
				
				<div class="authorinfo edit">
				<span class="description">密码</span>
				<input type="password" name="user_pass" id="user_pass" value="" class="regular-text">
				</div>
				
				<div class="authorinfo edit">
				<span class="description">重复密码</span>
				<input type="password" name="user_pass2" id="user_pass2" value="" class="regular-text">
				</div>
				
				<input type="hidden" name="action" value="update">
				<div class="c"></div>
				
				<div class="submitcon">
				<input type="submit" name="submit" id="submitp" class="button button-primary" value="更新个人资料">
				<div class="c"></div>
				</div>
			</div>
		</div>
		</form>
	</div>
	<div id="sidebar">
		<?php get_template_part('author-side'); ?>
	</div>
		<?php } else { ?>
		<div id="tgne">
		您需要 <a id="tougaone" class="submit" href="<?php echo get_option('mao10_sign_in'); ?>">注册或登陆</a> 后才能访问此页面
		</div>
		<?php } ?>
	<div class="c"></div>
</div>
<?php get_footer(); ?>