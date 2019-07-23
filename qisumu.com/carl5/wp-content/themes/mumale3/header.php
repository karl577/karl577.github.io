<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<?php include('includes/seo.php'); ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="<?php bloginfo('url');?>/favicon.ico" type="image/x-icon" />
<?php if(get_option('mumale_lib')!="") : ?>
<script type="text/javascript" src="http://lib.sinaapp.com/js/jquery/1.4.4/jquery.min.js"></script>
<?php else : ?>	
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/jquery.min.js"></script>
<?php endif; ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/all.js"></script>
<?php if (is_home() || is_archive() || is_page('likes') || is_page('views')) { ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/jquery.waterfall.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/index.js"></script>
<?php } elseif (is_singular()){ ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/comments-ajax.js"></script>
<?php if(get_option('mumale_phzoom')=="") : ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/phzoom.js"></script>
<?php endif; ?>
<?php }?>
<?php wp_head(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/base.js" ></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/a.js" ></script>
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
		<div id="header-box" class="clearfix">
			<div id="logo"><a href="<?php bloginfo('url'); ?>" hidefocus="true" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="logo" /></a></div>
			<div id="navdv" class="navdv">
					<ul>
						<li>
							<a href="<?php bloginfo('url'); ?>">
								首页
							</a>
						</li>
						<li id="menucat">
							<div> 
							<a class="mtop mtopall" href="/page/1">全部<b></b></a>
							<?php 
							 $menu_one = get_option('mumale_menu_one');
							 $cats = $wpdb->get_results("SELECT {$wpdb->prefix}terms.term_id, name
                            FROM {$wpdb->prefix}term_taxonomy, {$wpdb->prefix}terms
                            WHERE {$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id
                            AND taxonomy = 'category' AND {$wpdb->prefix}terms.term_id IN ($menu_one)");
                           foreach($cats as $cat) {
							?>
								<a class="mtop" href="<?php echo get_category_link($cat->term_id);?>">
									<?php echo $cat->name;?>
								</a>
							<?php }?>
								<p class="sep clr">
								</p>
						    <?php 
							 $menu_two = get_option('mumale_menu_two');
							 $catstwo = $wpdb->get_results("SELECT {$wpdb->prefix}terms.term_id, name
                            FROM {$wpdb->prefix}term_taxonomy, {$wpdb->prefix}terms
                            WHERE {$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id
                            AND taxonomy = 'category' AND {$wpdb->prefix}terms.term_id IN ($menu_two)");
                           foreach($catstwo as $cattwo) {
							?>
								<a href="<?php echo get_category_link($cattwo->term_id);?>">
									<?php echo $cattwo->name;?>
								</a>
							<?php }?>
							<span class="listad">
							<a href="#"><img src="<?php bloginfo('template_url'); ?>/images/20120323142151_Eresc.jpeg"/></a>
							</span>
							</div>
							<a id="topics" href="javascript:;">
								推荐
								<u>
								</u>
							</a>
						</li>
						<li>
							<a href="/post">
								投稿
							</a>
						</li>

					</ul>
					<form action="<?php bloginfo('url'); ?>" id="searchform" method="get">
					    <fieldset>
                         <input type="text" value="搜索" onblur="if(this.value=='') this.value='搜索';" onfocus="if(this.value=='搜索') this.value='';" name="s">
                         <button type="submit"></button>
                        </fieldset>
					</form>
				</div>
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
							<input type="hidden" name="redirect_to" value="<?php bloginfo('url'); ?>" />
						</div>
					</form>
					<?php if( function_exists('wp_connect')) wp_connect();?>
				</div>
			<?php } else { ?>
				<div id="logined">
					<a href="#" id="info" title="info"><?php global $current_user;get_currentuserinfo();echo get_avatar( $current_user->user_email, 36);echo '<span>';echo $current_user->user_login;echo '</span>';?></a>
					<div id="info-content" class="hidden">
						<a id="info-post" href="<?php $page = get_page_by_title( 'post' );$page_id = $page->ID;if ($page_id!=""){ ?><?php echo get_page_link( $page_id );?><?php }?>" title="<?php _e('Post','mumale'); ?>"><?php _e('Post','mumale'); ?></a><a id="info-quit" href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>" title="<?php _e('Logout','mumale'); ?>"><?php _e('Logout','mumale'); ?></a>
					</div>
				</div>
			<?php }?>
		</div>
	</div>
	<div id="wrapper" class="clearfix">