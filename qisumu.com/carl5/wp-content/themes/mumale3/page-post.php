<?php
/*
Template Name: post
*/
?>
<?php ob_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<?php include('includes/seo.php'); ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/post.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="<?php bloginfo('url');?>/favicon.ico" type="image/x-icon" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/post.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/ajaxupload.js"></script>
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
<body <?php body_class(); ?>>
	<div id="header">
		<div id="header-box">
			<div id="logo"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="logo" /></a></div>
			<?php wp_nav_menu(array( 'theme_location'=>'primary','container_id' => 'nav')); ?>
			<?php if (!(current_user_can('level_0'))){ ?>
				<div id="login"><a href="#" title="<?php _e('Log in','mumale'); ?>"><?php _e('Log in','mumale'); ?></a></div>
				<div id="login-form">
					<form action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
						<div id="actions">
							<p><?php _e('Username','mumale'); ?></p>
							<input id="log" type="text" name="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="20" />
							<p><?php _e('Password','mumale'); ?><a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword"><?php _e('Forgot password ?','mumale'); ?></a></p>
							<input type="password" name="pwd" id="pwd" size="20"  />
							<div class="clear"></div>
							<input type="submit" name="submit" value="<?php _e('Log in','mumale'); ?>" class="button" />
							<input type="hidden" name="redirect_to" value="<?php bloginfo('url'); ?>/post" />
						</div>
					</form>
				</div>
			<?php } else { ?>
				<div id="logined">
					<a href="#" id="info" title="info"><?php global $current_user;get_currentuserinfo();echo get_avatar( $current_user->user_email, 36);echo '<span>';echo $current_user->user_login;echo '</span>';?></a>
				</div>
			<?php }?>
			<div class="clear"></div>
		</div>
	</div>
	<form method="post" action="">
	<div id="wrapper">
		<div id="single-content">
<?php 
	if(isset($_POST['new_post']) == '1') {
		$post_title = $_POST['post_title'];
		$post_category = $_POST['post_category'];
		$post_tags = preg_split('#\s+#',$_POST['post_tags']);
		$post_content = $_POST['post_content'];
		$new_post = array(
			'ID' => '',
			'post_author' => $user->ID, 
			'post_category' => $post_category,
			'tags_input' => $post_tags,
			'post_content' => $post_content, 
			'post_title' => $post_title,
			'post_status' => 'publish'
		);
		$post_id = wp_insert_post($new_post);
		$post = get_post($post_id);
		wp_redirect($post->guid);
	}
?>
				<div id="post-home">
				<?php if ( is_user_logged_in() ) : ?>
				<div id="new-post">
				<div id="new-info">
					<?php global $current_user;get_currentuserinfo();echo get_avatar( $current_user->user_email,64); ?>
					<p><?php echo $user_identity; ?> <?php _e('welcome back.','mumale'); ?></p>
					<p> <?php _e('You can post you\'r images here.','mumale'); ?></p>
					<div class="clear"></div>
				</div>
						<div id="new-title">
							<h3 id="title"><?php _e('Title','mumale'); ?></h3>
							<input type="text" name="post_title" size="50" id="input-title"/>
						</div>
						<div id="new-img">
							<a href="#" id="upload-button" data-url="<?php bloginfo('template_url'); ?>/timthumb.php">+ <?php _e('Add photos','mumale'); ?></a>  <?php _e('jpg,gif,png or bmp','mumale'); ?>
							<div id="upload-images" class="hidden">
								<span class="selected"><?php _e('Local photos','mumale'); ?></span><span class="right"><?php _e('Network photos','mumale'); ?></span>
								<div class="clear"></div>
								<ul>
								<li class="selected">
								<a href="#" class="ajaxupload_upload button" id="images"><?php _e('Add local photos','mumale'); ?></a>
								<textarea rows="5" name="post_content" cols="66" id="text-desc"></textarea>
								</li>
								<li class="next-way"><?php _e('Input address','mumale'); ?>: <input type="text" name="img_url" size="24" /><a href="#" class="url_button" id="images"><?php _e('Add','mumale'); ?></a><p><?php _e('Please input the address','mumale'); ?></p></li>
								</ul>
							</div>
						</div>
						<div id="img-preview"><ul></ul></div>
					<input id="newsubmit" class="subput round" type="submit" name="submit" value="<?php _e('Submit','mumale'); ?>" <?php if(!is_user_logged_in()) echo 'disabled="disabled"';?> />
					<input type="hidden" name="new_post" value="1"/> 
					<div class="clear"></div>
				<?php endif; ?>
				</div>
				</div>
			</div>
			<div id="sidebar">
				<div class="widget">
					<h2><?php _e('Add Categories','mumale'); ?></h2>
					<ul id="category-all">
					<?php
						$categories=get_categories();
						foreach($categories as $category) {
							echo "<li><label><input type='checkbox' name='post_category[]' value='$category->term_id' /> ";
							echo $category->cat_name;
							echo '</label></li>';
						}
					?>
					</ul>
				</div>
				<div class="widget">
					<h2><?php _e('Add tags','mumale'); ?></h2>
					<textarea rows="5" name="post_tags" cols="66"></textarea>
					<div id="tag-cloud"><?php wp_tag_cloud('unit=px&smallest=12&largest=12&number=20'); ?><div class="clear"></div></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</form>
	<div id="footer">
		<div class="realfoot">
	<div class="footct">
		<div class="frdlk">
		<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
		
		</div>
		<?php if(stripslashes(get_option('iphoto_copyright'))!=''){echo stripslashes(get_option('iphoto_copyright'));}else{echo 'Copyright &copy; '.date("Y").' '.'<a href="'.home_url( '/' ).'" title="'.esc_attr( get_bloginfo( 'name') ).'">'.esc_attr( get_bloginfo( 'name') ).'</a> All rights reserved';}?>
	</div>
	</div>
<?php wp_footer(); ?>
</body>
</html>