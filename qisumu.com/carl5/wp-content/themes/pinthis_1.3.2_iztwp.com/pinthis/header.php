<?php
	// get options
	$pinthis_meta_keywords = get_option('pbpanel_meta_keywords');
	$pinthis_meta_description = get_option('pbpanel_meta_description');
	$pinthis_meta_author = get_option('pbpanel_meta_author');
	$pinthis_title_separator = get_option('pbpanel_title_separator');
	$pinthis_header_code = get_option('pbpanel_header_code');
	$pinthis_google_code = get_option('pbpanel_google_code');
	$pinthis_site_bg = get_option('pbpanel_site_bg');
	$pinthis_slider_show = get_option('pbpanel_slider_show');
	
	if (has_nav_menu('pinthis-header-menu')) {
		$pinthis_header_nav_menu_class = 'with-header-nav-menu';	
	} else {
		$pinthis_header_nav_menu_class = '';	
	}
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title($pinthis_title_separator, true, 'right'); ?> <?php bloginfo('name'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<?php if (strlen($pinthis_meta_keywords) > 0) { ?>
<meta name="keywords" content="<?php echo html_entity_decode(stripslashes_deep($pinthis_meta_keywords), ENT_QUOTES); ?>">
<?php } ?>
<?php if (strlen($pinthis_meta_description) > 0) { ?>
<meta name="description" content="<?php echo html_entity_decode(stripslashes_deep($pinthis_meta_description), ENT_QUOTES); ?>">
<?php } ?>
<?php if (strlen($pinthis_meta_author) > 0) { ?>
<meta name="author" content="<?php echo html_entity_decode(stripslashes_deep($pinthis_meta_author), ENT_QUOTES); ?>">
<?php } ?>
<?php if (get_option('pbpanel_site_favicon')) { ?>
<link rel="icon" type="image/png" href="<?php echo get_option('pbpanel_site_favicon'); ?>">
<?php } else { ?>
<link rel="icon" type="image/png" href="<?php echo pinthis_get_skin_src(); ?>/images/favicon.png">
<?php } ?>
<?php 
	if (strlen($pinthis_header_code) > 0) {
		echo html_entity_decode(stripslashes_deep($pinthis_header_code), ENT_QUOTES);
	}
	if (strlen($pinthis_google_code) > 0) {
		echo html_entity_decode(stripslashes_deep($pinthis_google_code), ENT_QUOTES);
	}
?>
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

<body <?php body_class($pinthis_header_nav_menu_class); ?> id="totop" <?php if ($pinthis_site_bg == 1) { ?>style="background-image:url(<?php echo pinthis_get_skin_src(); ?>/images/bg.jpg);"<?php } ?>>
<header class="<?php if (is_admin_bar_showing()) { echo 'with-admin-bar '; } echo $pinthis_header_nav_menu_class; ?>">
	<div class="container clearfix">
		<div class="left-part">
			<nav class="menu-categories dropel">
				<a href="#" onclick="return false;" class="icon-menu-categories tooltip" title="<?php echo __('Categories', 'pinthis'); ?>"><?php echo __('Categories', 'pinthis'); ?></a>
				<div class="dropdown">
					<div class="dropdown-wrapper arrow-up-left">
						<ul class="categories-list">
							<?php wp_list_categories('title_li=&hide_empty=0'); ?>
						</ul>
					</div>
				</div>
			</nav>
			<div class="search-box clearfix dropel">
				<a href="#" onclick="return false;" class="icon-zoom"><?php echo __('Search', 'pinthis'); ?></a>
				<div class="dropdown">
					<div class="dropdown-wrapper arrow-up-left">
						<form action="<?php echo home_url(); ?>/" method="get">
							<input type="text" name="s" value="Search">
							<input type="submit" value="Search">
						</form>
					</div>
				</div>
			</div>
		</div>
		<h1 class="logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>">
				<?php if (get_option('pbpanel_site_logo')) { ?>
				<img src="<?php echo get_option('pbpanel_site_logo'); ?>" alt="<?php bloginfo('name'); ?>">
				<?php } else { ?>
				<img src="<?php echo pinthis_get_skin_src(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>">
				<?php } ?>
			</a>
		</h1>
		<div class="right-part">
			<?php $current_user = wp_get_current_user(); ?>
			<?php if ( is_user_logged_in() ) { ?>
				<div class="log-in-out">
					<a href="<?php echo wp_logout_url(home_url()); ?>" title="<?php echo __('Sign out', 'pinthis'); ?>" class="icon-login out tooltip"><?php echo __('Sign out', 'pinthis'); ?></a>
				</div>
				<nav class="member">
					<a href="<?php echo get_edit_user_link(); ?>" class="tooltip" title="<?php echo __('Edit profile', 'pinthis'); ?>">
						<span class="avatar">
							<?php if (strlen(get_avatar($current_user->ID, 40)) > 0) { ?>
								<?php echo get_avatar($current_user->ID, 40); ?>
							<?php } else { ?>
								<img src="<?php echo pinthis_get_skin_src(); ?>/images/default-avatar.png" alt="<?php echo $current_user->display_name; ?>">
							<?php } ?>
						</span>
						<?php echo $current_user->display_name; ?>
					</a>	
				</nav>
			<?php } else { ?>
				<div class="log-in-out dropel">
					<a href="#" onclick="return false;" title="<?php echo __('Sign In', 'pinthis'); ?>" class="icon-login tooltip"><?php echo __('Sign in', 'pinthis'); ?></a>
					<div class="dropdown">
						<div class="dropdown-wrapper arrow-up-right">
							<?php 
								$login_form_args = array (
									'form_id' => 'login-form',
									'label_log_in' => __('Login', 'pinthis'),
									'remember' => false
								); 
							?> 
							<?php wp_login_form($login_form_args); ?>
							<p class="login-links clearfix">
								<span class="fleft">
									<a href="<?php echo htmlspecialchars(wp_lostpassword_url(get_permalink()), ENT_QUOTES); ?>" title="<?php echo __('Lost password', 'pinthis'); ?>"><?php echo __('Lost your password?', 'pinthis'); ?></a>
								</span>
								<?php if (get_option('users_can_register')) { ?>
									<span class="fright"><?php wp_register('', ''); ?></span>
								<?php } ?>
							</p>
						</div>
					</div>
				</div>
			<?php } ?>	
		</div>
	</div>
	<?php if ($pinthis_header_nav_menu_class) { ?>
	<div class="container fluid clearfix">
		<a href="#" onclick="return false;" class="icon-nav-menu"><?php echo __('Menu', 'pinthis'); ?></a>
		<div class="header-menu">
			<?php wp_nav_menu(array('theme_location' => 'pinthis-header-menu', 'container' => 'div', 'container_class' => 'header-menu-wrapper arrow-up-right', 'menu_class' => 'header-menu-list', 'walker' => new pinthis_submenu_wrap())); ?>
		</div>
	</div>
	<?php } ?>
</header>
<?php if ($pinthis_slider_show != 1) { ?>
	<?php if ($pinthis_slider_show == 2 && is_front_page() || $pinthis_slider_show == 3) { ?>
	<section id="primary">
		<?php query_posts('post_type=pinthis_slider&orderby=menu_order&order=ASC') ?>
		<?php if (have_posts()) { ?>
		<div class="slider">
			<ul>
				<?php while (have_posts()) { the_post(); ?>
				<?php 
					$pinthis_slide_title = get_post_meta($post->ID, 'slide_title', true);
					$pinthis_slide_text = get_post_meta($post->ID, 'slide_text', true);
					$pinthis_slide_link = get_post_meta($post->ID, 'slide_link', true); 
				?>
				<li <?php post_class(); ?> <?php if ($pinthis_slide_link != '') { ?>data-rel="<?php echo pinthis_addScheme($pinthis_slide_link); ?>"<?php } ?> data-background="<?php if (has_post_thumbnail()) { $pinthis_slide_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full'); echo $pinthis_slide_src[0]; } else { echo pinthis_get_skin_src() . '/images/slide-empty.jpg'; } ?>">
					<?php if ($pinthis_slide_title != '') { ?>
						<div class="flick-title"><?php echo $pinthis_slide_title; ?></div>
					<?php } ?>
					<?php if ($pinthis_slide_text != '') { ?>
						<div class="flick-sub-text"><?php echo $pinthis_slide_text; ?></div>
					<?php } ?>
				</li>
				<?php } ?>
			</ul>
		</div>
		<?php } else { ?>
		<div class="slider-empty">&nbsp;</div>
		<?php } ?>
		<?php wp_reset_query(); ?> 
	</section>
	<?php } ?>
<?php } ?>