<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<?php include('includes/seo.php'); ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/publish.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="<?php bloginfo('url');?>/favicon.ico" type="image/x-icon" />
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
<?php 
if (!isset($_SESSION)) 
{
  session_start();
  session_regenerate_id();
}

if(isset($_POST['new_post']) == '1') {
    $post_title = $_POST['post_title'];
    $post_category = $_POST['cat'];
	$post_tags = preg_split('#\s+#',$_POST['post_tags']);
    $post_content = $_POST['post_content'];
	//$post_content = save_post_pic($post_content);  // 如果需要将外站图片保存到本地, 请取消此行注释
    $new_post = array(
          'ID' => '',
          'post_author' => $user->ID, 
          'post_category' => array($post_category),
		'tags_input' => $post_tags,
          'post_content' => $post_content, 
          'post_title' => $post_title,
          'post_status' => 'publish'    //pending 为审核状态,  publish 为发布状态
        );
    $post_id = wp_insert_post($new_post);
	$post = get_post($post_id);
	$post_url =  $post->guid;
	$post_title = $post->post_title;
	$_SESSION["cpl_url"] = $post_url;
	$_SESSION["cpl_title"] = $post_title;
	$page = get_page_by_title( 'publish' );
	$page_id = $page->ID;
	$page_link = get_page_link( $page_id );
	$tmpArr = explode("?",$page_link);
    if(count($tmpArr)>1){
		$page_link .='&action=complete';
	}else{
		$page_link .='?action=complete';
	}
	wp_redirect($page_link);
}
function curPageURL() 
{
    $pageURL = 'http';

    if ($_SERVER["HTTPS"] == "on") 
    {
        $pageURL .= "s";
    }
    $pageURL .= "://";

    if ($_SERVER["SERVER_PORT"] != "80") 
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } 
    else 
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
?>
	<?php if( isset($_GET['action'])&& $_GET['action'] == 'new' && isset($_GET['src']) && isset($_GET['title']) ) :?>
		<?php if (is_user_logged_in()){ ?>
			<div id="new-post">
				<form method="post" action="">
					<div id="left">
						<div id="img-preview"><img src="<?php echo $_GET['src'];?>" /></div>
					</div>
					<div id="right">
						<h3><?php _e('Title','iphoto'); ?>&#58;<input type="text" name="post_title" size="50" id="input-title" value="<?php echo $_GET['title'];?>"/></h3>
						<h3><?php _e('Category','iphoto'); ?>&#58;<?php wp_dropdown_categories('orderby=name&hide_empty=0&hierarchical=1'); ?></h3>
						<h3><?php _e('Tags','iphoto'); ?>&#58;<input type="text" name="post_tags" size="45" id="input-tags"/></h3>
						<textarea hidden rows="5" name="post_content" cols="66" id="text-desc"><a href="<?php echo $_GET['src'];?>"><img src="<?php echo $_GET['src'];?>" /></a></textarea>
						<input id="newsubmit" class="subput round" type="submit" name="submit" value="<?php _e('Submit','iphoto'); ?>"/>
					</div>
					<input type="hidden" name="new_post" value="1"/> 
					<div class="clear"></div>
				</form>
			</div>
		<?php } else{ ?>
				<div id="login-form">
					<form action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
						<div id="actions">
							<p><?php _e('Username','iphoto'); ?></p>
							<input id="log" type="text" name="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="20" />
							<p><?php _e('Password','iphoto'); ?><a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword"><?php _e('Forgot password ?','iphoto'); ?></a></p>
							<input type="password" name="pwd" id="pwd" size="20"  />
							<div class="clear"></div>
							<input type="submit" name="submit" value="<?php _e('Log in','iphoto'); ?>" class="button" />
							<input type="hidden" name="redirect_to" value="<?php echo curPageURL();?>" />
						</div>
					</form>
				</div>
		<?php }?>
	<?php elseif( isset($_GET['action'])&& $_GET['action'] == 'complete' ) :?>
		<div id="new-post">
			<p>成功发布</p>
			<p>此页面将会在<span id="cplmes">5</span>秒后关闭</p>
			<p><a href="<?php echo $_SESSION["cpl_url"]?>" target="_blank"><?php echo $_SESSION["cpl_title"];?></a></p>
			<script type="text/javascript">
			var closeWindow = function(){
					var browserName = navigator.appName;
					if (browserName == "Netscape") {
						window.open('', '_parent', '');
						window.close();
					} else if (browserName == "Microsoft Internet Explorer") {
						window.opener = "whocares";
						window.close();
					}
				},
				i = 5,intervalid; 
				intervalid = setInterval("fun()", 1000);  
				function fun() { 
					document.getElementById("cplmes").innerHTML = i;  
					i--;   
				}
			setTimeout(closeWindow,5000)
			</script>
		</div>
	<?php else:?>
		<?php wp_redirect(get_option('home'));?>
	<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>