<?php
if(!defined("ABSPATH")) exit; //exit if accessed directly
switch($cb_role)
{
	case "administrator":
		$cb_user_role_permission = "manage_options";
	break;
	case "editor":
		$cb_user_role_permission = "publish_pages";
	break;
	case "author":
		$cb_user_role_permission = "publish_posts";
	break;
}
if (!current_user_can($cb_user_role_permission))
{
	return;
}
else
{
	if(isset($_GET["page"]))
	{
		?>
		<script>
		jQuery(document).ready(function()
		{
			jQuery(".nav-tab-wrapper > a#<?php echo esc_attr($_GET["page"]);?>").addClass("nav-tab-active");
		});
		</script>
		<?php
	}
	?>
	<div id="welcome-panel" class="welcome-panel" style="padding:0px !important;background-color: #f9f9f9 !important">
		<div class="welcome-panel-content">
			<img src="<?php echo plugins_url("/assets/images/contact-bank.png" , dirname(__FILE__)); ?>" />
			<div class="welcome-panel-column-container">
				<div class="welcome-panel-column" style="width:240px !important;">
					<h4 class="welcome-screen-margin">
						<?php _e("Get Started", "contact-bank"); ?>
					</h4>
					<a class="button button-primary button-hero" target="_blank" href="http://vimeo.com/92488992">
						<?php _e("Watch Contact Video!", "contact-bank"); ?>
					</a>
					<p>or,
						<a target="_blank" href="http://tech-banker.com/products/wp-contact-bank/knowledge-base/">
							<?php _e("read documentation here", "contact-bank"); ?>
						</a>
					</p>
				</div>
				<div class="welcome-panel-column" style="width:250px !important;">
					<h4 class="welcome-screen-margin"><?php _e("Go Premium", "contact-bank"); ?></h4>
					<ul>
						<li>
							<a href="http://tech-banker.com/products/wp-contact-bank/" target="_blank" class="welcome-icon">
								<?php _e("Feature", "contact-bank"); ?>
							</a>
						</li>
						<li>
							<a href="http://tech-banker.com/products/wp-contact-bank/demo/" target="_blank" class="welcome-icon">
								<?php _e("Online Demos", "contact-bank"); ?>
							</a>
						</li>
						<li>
							<a href="http://tech-banker.com/products/wp-contact-bank/pricing/" target="_blank" class="welcome-icon">
								<?php _e("Pricing Plans", "contact-bank"); ?>
							</a>
						</li>
					</ul>
				</div>
				<div class="welcome-panel-column" style="width:240px !important;">
					<h4 class="welcome-screen-margin">
						<?php _e("Knowledge Base", "contact-bank"); ?>
					</h4>
					<ul>
						<li>
							<a href="http://tech-banker.com/forums/forum/contact-bank-support/" target="_blank" class="welcome-icon">
								<?php _e("Support Forum", "contact-bank"); ?>
							</a>
						</li>
						<li>
							<a href="http://tech-banker.com/products/wp-contact-bank/knowledge-base/" target="_blank" class="welcome-icon">
								<?php _e("FAQ's", "contact-bank"); ?>
							</a>
						</li>
						<li>
							<a href="http://tech-banker.com/products/renew-premium-support-wp-contact-bank/" target="_blank" class="welcome-icon">
								<?php _e("Renew Premium Support", "contact-bank"); ?>
							</a>
						</li>
					</ul>
				</div>
				<div class="welcome-panel-column welcome-panel-last" style="width:250px !important;">
					<h4 class="welcome-screen-margin"><?php _e("More Actions", "contact-bank"); ?></h4>
					<ul>
						<li>
							<a href="http://tech-banker.com/shop/plugin-customization/order-customization-wp-contact-bank/" target="_blank" class="welcome-icon">
								<?php _e("Plugin Customization", "contact-bank"); ?>
							</a>
						</li>
						<li>
							<a href="admin.php?page=contact_bank_recommended_plugins" class="welcome-icon">
								<?php _e("Recommendations", "contact-bank"); ?>
							</a>
						</li>
						<li>
							<a href="admin.php?page=contact_bank_other_services" class="welcome-icon">
								<?php _e("Our Other Services", "contact-bank"); ?>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php
	global $wpdb,$current_user;
	if (is_super_admin())
	{
		$cb_role = "administrator";
	}
	else
	{
		$cb_role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$cb_role);
		$cb_role = $current_user->role[0];
	}

	switch ($cb_role) {
		case "administrator":
			?>
			<h2 class="nav-tab-wrapper">
				<a class="nav-tab custom-nav-tab" id="contact_dashboard" href="admin.php?page=contact_dashboard"><?php _e("Dashboard", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_short_code" href="admin.php?page=contact_short_code"><?php _e("Short-Codes", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_frontend_data" href="admin.php?page=contact_frontend_data"><?php _e("Form Entries", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_email" href="admin.php?page=contact_email"><?php _e("Email Settings", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_layout_settings" href="admin.php?page=contact_layout_settings"><?php _e("Global Settings", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_bank_recommended_plugins" href="admin.php?page=contact_bank_recommended_plugins"><?php _e("Recommendations", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_pro_version" href="admin.php?page=contact_pro_version"><?php _e("Premium Editions", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_bank_other_services" href="admin.php?page=contact_bank_other_services"><?php _e("Our Other Services", "contact-bank") ;?></a>
			</h2>
			<?php
		break;
		case "editor":
			?>
			<h2 class="nav-tab-wrapper">
				<a class="nav-tab custom-nav-tab" id="contact_dashboard" href="admin.php?page=contact_dashboard"><?php _e("Dashboard", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_short_code" href="admin.php?page=contact_short_code"><?php _e("Short-Codes", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_frontend_data" href="admin.php?page=contact_frontend_data"><?php _e("Form Entries", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_email" href="admin.php?page=contact_email"><?php _e("Email Settings", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_layout_settings" href="admin.php?page=contact_layout_settings"><?php _e("Global Settings", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_bank_recommended_plugins" href="admin.php?page=contact_bank_recommended_plugins"><?php _e("Recommendations", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_pro_version" href="admin.php?page=contact_pro_version"><?php _e("Premium Editions", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_bank_other_services" href="admin.php?page=contact_bank_other_services"><?php _e("Our Other Services", "contact-bank") ;?></a>
			</h2>
			<?php
		break;
		case "author":
			?>
			<h2 class="nav-tab-wrapper">
				<a class="nav-tab custom-nav-tab" id="contact_dashboard" href="admin.php?page=contact_dashboard"><?php _e("Dashboard", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_short_code" href="admin.php?page=contact_short_code"><?php _e("Short-Codes", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_frontend_data" href="admin.php?page=contact_frontend_data"><?php _e("Form Entries", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_email" href="admin.php?page=contact_email"><?php _e("Email Settings", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_layout_settings" href="admin.php?page=contact_layout_settings"><?php _e("Global Settings", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_bank_recommended_plugins" href="admin.php?page=contact_bank_recommended_plugins"><?php _e("Recommendations", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_pro_version" href="admin.php?page=contact_pro_version"><?php _e("Premium Editions", "contact-bank") ;?></a>
				<a class="nav-tab custom-nav-tab" id="contact_bank_other_services" href="admin.php?page=contact_bank_other_services"><?php _e("Our Other Services", "contact-bank") ;?></a>
			</h2>
			<?php
		break;
	}
	if(isset($_GET["page"]) ? esc_attr($_GET["page"]) : "" != "contact_feature_request")
	{
		?>
		<div class="custom-message green" style="display: block;margin-top:30px">
			<div style="padding: 4px 0;">
				<p style="font:12px/1.0em Arial !important;font-weight:bold;">If you don't find any features you were looking for in this Plugin,
					please write us <a target="_self" href="admin.php?page=contact_feature_request">here</a> and we shall try to implement this for you as soon as possible! We are looking forward for your valuable <a target="_self" href="admin.php?page=contact_feature_request">Feedback</a></p>
			</div>
		</div>
		<?php
	}
}
?>
