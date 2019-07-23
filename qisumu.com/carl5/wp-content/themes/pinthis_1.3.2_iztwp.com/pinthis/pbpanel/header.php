<div class="pbpanel-container">
	<div class="pbpanel-column pbpanel-column-sticky">
		<div class="pbpanel-box">
			<div class="pbpanel-logo"><a onclick="window.open('http://pixelbeautify.com');return false;" href="http://pixelbeautify.com"><img src="<?php echo get_template_directory_uri(); ?>/pbpanel/images/logo.png" alt="<?php echo __('PB Panel', 'pbpanel'); ?>" /></a></div>
			<nav class="pbpanel-navigation">
				<ul>
					<li><a href="<?php echo admin_url('admin.php?page=pbpanel-main'); ?>" class="pbpanel-icon-nav-1 <?php if ($_REQUEST['page'] == 'pbpanel-main'): echo 'active'; endif; ?>"><?php echo __('Main', 'pbpanel'); ?></a></li>
					<li><a href="<?php echo admin_url('admin.php?page=pbpanel-branding'); ?>" class="pbpanel-icon-nav-2 <?php if ($_REQUEST['page'] == 'pbpanel-branding'): echo 'active'; endif; ?>"><?php echo __('Branding', 'pbpanel'); ?></a></li>
					<li><a href="<?php echo admin_url('admin.php?page=pbpanel-slider'); ?>" class="pbpanel-icon-nav-6 <?php if ($_REQUEST['page'] == 'pbpanel-slider'): echo 'active'; endif; ?>"><?php echo __('Slider', 'pbpanel'); ?></a></li>
					<li><a href="<?php echo admin_url('admin.php?page=pbpanel-seo'); ?>" class="pbpanel-icon-nav-3 <?php if ($_REQUEST['page'] == 'pbpanel-seo'): echo 'active'; endif; ?>"><?php echo __('SEO', 'pbpanel'); ?></a></li>
					<li><a href="<?php echo admin_url('admin.php?page=pbpanel-socialnetworks'); ?>" class="pbpanel-icon-nav-4 <?php if ($_REQUEST['page'] == 'pbpanel-socialnetworks'): echo 'active'; endif; ?>"><?php echo __('Social Networks', 'pbpanel'); ?></a></li>
					<li><a href="<?php echo admin_url('admin.php?page=pbpanel-reset'); ?>" class="pbpanel-icon-nav-5 <?php if ($_REQUEST['page'] == 'pbpanel-reset'): echo 'active'; endif; ?>"><?php echo __('Reset', 'pbpanel'); ?></a></li>
				</ul>	
			</nav>
		</div>
	</div>