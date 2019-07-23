<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<!--你看的不是源代码，看的是寂寞。-->
<meta charset="UTF-8">
<?php $options = get_option('Newer_options'); ?>
<title>
<?php
        /*
       * Print the <title> tag based on what is being viewed.
       */
        global $page, $paged;

        wp_title('|', true, 'right');

        // Add the blog name.
        bloginfo('name');

       
        
       

        // Add a page number if necessary:
        if ($paged >= 2 || $page >= 2)
            echo ' | ' . sprintf(__('Page %s', 'android'), max($paged, $page));

        ?>
</title>
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - All Posts" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - All Comments" href="<?php bloginfo('comments_rss2_url'); ?>" />
<link rel="Shortcut Icon" href="<?php bloginfo('template_directory');?>/images/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="<?php bloginfo('template_directory');?>/images/apple-touch-icon.png">
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery-1.7.2.min.js"></script>
<!--[if IE 6]>
<html id="ie6" class="is_ie" <?php language_attributes(); ?>>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>	
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="is_ie" <?php language_attributes(); ?>>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/hack/ie7.css" type="text/css" media="all" />
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>	
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="is_ie" <?php language_attributes(); ?>>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>	
<![endif]-->
<!--[if IE 9]>
<html id="ie9" class="is_ie" <?php language_attributes(); ?>>
<![endif]-->
<?php wp_head(); ?>
<?php if ( is_singular() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<?php } ?>



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
<header>
  <nav> <a class="homedrop" href="<?php bloginfo('url');?>" title="fatesinger"></a>
    <div class="navdrop">导航
      <?php wp_nav_menu( array( 'theme_location' => 'header-menu','menu_id'=>'nav','container'=>'ul')); ?>
    </div>
    <div class="searchdrop">搜索
      <div class="seacrhgood">
        <form class="search-form" action="<?php bloginfo('url');?>" method="get">
          <input class="search-input" type="text"  placeholder="输入要搜索的内容" name="s">
          <input class="search-submit" type="submit" value="">
        </form>
      </div>
    </div>
    <div class="followdrop">订阅
      <div class="followgood">
        <h4>Follow me</h4>
        <div class="follows">
          <div id="widget_icon_rss"> <a href="<?php bloginfo( 'rss2_url' ); ?>" target="_blank" title="RSS2.0订阅"></a> </div>
        </div>
        <div class="followdis"><?php echo dopt('d_rss_des'); ?></div>
      </div>
    </div>
	<div class="sharedrop">管理
	<div class="sharecontent">
	<?php
				global $current_user;
				get_currentuserinfo();
				$cur_id    = $current_user->ID;
				$user_info = get_userdata($cur_id);
				$u_login   = $user_info->user_login;
				$u_mail    = $user_info->user_email;
				$u_time    = $user_info->user_registered;
				$u_name    = get_user_meta($cur_id,'nickname',true);

				if( !is_user_logged_in() ) { ?>
	<div class="popup-layer">
					<div class="popup">
						<form class="popup-signin" name="loginform" action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
							<h4>用户名：</h4>
							<input class="ipt" type="text" name="log" value="" size="20">
							<h4>密码：</h4>
							<input class="ipt" type="password" name="pwd" value="" size="20">
							<input class="btn btn-primary" type="submit" name="submit" value="立即登录">
							<p><a class="btn btn-mini" href="<?php echo get_option('home'); ?>/wp-login.php?action=register">注册</a><a class="btn btn-mini" href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword">找回密码</a></p>
		                    <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
		                </form>
	           		</div>
		<?php } else{ ?>
				
				<span class="popup-arrow"><i></i></span>
				<div class="popup-layer">
					<div class="popup">
						<div class="popup-profile">
							<img class="avatar" src="<?php echo bigfa_avatar_url($current_user->user_email) ?>" width="38" height="38">
							<span class="name"><?php echo $u_name ?></span>
							<span class="mail"><?php echo $u_mail ?></span>
							<a href="<?php echo get_option('home'); ?>/wp-admin/" class="btn btn-primary" aria-haspopup="true">进入控制面板</a>
						</div>
						<div class="popup-profile-ctrl">
							<a href="<?php echo get_option('home'); ?>/wp-admin/themes.php?page=themeset.php" class="btn btn-mini">主题设置</a>
							<a href="<?php echo get_option('home'); ?>/wp-admin/widgets.php" class="btn btn-mini">小工具</a>
							<a href="<?php echo get_option('home'); ?>/wp-login.php?action=logout" class="btn btn-mini">注销</a>
						</div>
					</div>
				</div>
				<?php } ?>			
           		</div>
	</div>
	</div>
  </nav>
 <div id="navbar-shadow"></div> 
</header>
<div id="mobileheader"><?php bloginfo('name');?></div>
<div id="logobar">
  <h1><a href="<?php bloginfo('url');?>" title="<?php bloginfo('name');?>" class="logo">
    <?php bloginfo('name');?>
    </a></h1>
  <div id="slogan"> <span class="quote-left">"</span> <span class="slogan">我觉得我是个优雅的人~ </span> <span class="quote-right">"</span> <span class="slogan-from"> ---- Bigfa</span> </div>
  <?php if( dopt('fate_adpost_01_b') ) echo '<div id="banner-ad">'.dopt('fate_adpost_01').'</div>'; ?>
  
</div>
<!--loding progress bar-->
