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
	$contact_bank_check_status = wp_create_nonce("contact_bank_check_status");
	?>
		<div class="page-container header-wizard">
			<div class="page-content">
				<div class="fluid-layout">
					<div class="layout-span6 center">
						<img src="<?php echo plugins_url("assets/images/contact-bank.png",dirname(__FILE__));?>">
					</div>
					<div class="layout-span1">
					</div>
				</div>
				<div class="fluid-layout">
					<div class="layout-span12 textalign">
							<p>Hi there!</p>
                                                        <p>Don't ever miss an opportunity to opt in for Email Notifications / Announcements about exciting New Features and Update Releases.</p>
                                                        <p>Contribute in helping us making our plugin compatible with most plugins and themes by allowing to share non-sensitive information about your website.</p>
                                                        <p>If you're not ready to Opt-In, that's ok too!</p>
                                                        <p><strong>Contact Bank will still work fine.</strong></p>
					</div>
				</div>
				<div class="fluid-layout">
					<div class="layout-span12">
						<a class="permissions" onclick="show_hide_details_contact_bank();">What permissions are being granted?</a>
					</div>
				</div>
				<div style="display:none;" id="ux_div_wizard_set_up">
					<div class="fluid-layout">
						<div class="layout-span6">
							<ul>
								<li>
									<i class="dashicons dashicons-admin-users"></i>
									<div class="admin">
											<span><strong>User Details</strong></span>
											<p>Name and Email Address</p>
									</div>
								</li>
							</ul>
						</div>
						<div class="layout-span6 align align2">
								<ul>
									<li>
										<i class="dashicons dashicons-admin-plugins"></i>
										<div class="admin-plugins">
											<span><strong>Current Plugin Status</strong></span>
											<p>Activation, Deactivation and Uninstall</p>
										</div>
									</li>
								</ul>
						</div>
					</div>
					<div class="fluid-layout">
						<div class="layout-span6">
								<ul>
									<li>
										<i class="dashicons dashicons-testimonial"></i>
										<div class="testimonial">
											<span><strong>Notifications</strong></span>
											<p>Updates &amp; Announcements</p>
										</div>
									</li>
								</ul>
						</div>
						<div class="layout-span6 align2">
								<ul>
										<li>
											<i class="dashicons dashicons-welcome-view-site"></i>
											<div class="settings">
												<span><strong>Website Overview</strong></span>
												<p>Site URL, WP Version, PHP Info, Plugins &amp; Themes Info</p>
											</div>
										</li>
								</ul>
						</div>
					</div>
				</div>
				<div class="fluid-layout">
					<div class="layout-span12 allow">
						<div class="tech-banker-actions">
							<a onclick="plugin_stats('opt_in');" class="button button-primary-wizard">
								<strong>Opt-In &amp; Continue </strong>
								<i class="dashicons dashicons-arrow-right-alt"></i>
							</a>
							<a onclick="plugin_stats('skip');" class="button button-secondary-wizard" tabindex="2">
								<strong>Skip &amp; Continue </strong>
								<i class="dashicons dashicons-arrow-right-alt"></i>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			
                    function show_hide_details_contact_bank()
                    {
                            if(jQuery("#ux_div_wizard_set_up").hasClass("wizard-set-up"))
                            {
                                    jQuery("#ux_div_wizard_set_up").css("display","none");
                                    jQuery("#ux_div_wizard_set_up").removeClass("wizard-set-up");
                            }
                            else
                            {
                                    jQuery("#ux_div_wizard_set_up").css("display","block");
                                    jQuery("#ux_div_wizard_set_up").addClass("wizard-set-up");
                            }
                    }

                    function plugin_stats(type)
                    {
                            jQuery.post(ajaxurl,
                            {
                                    type: type,
                                    param: "wizard_contact",
                                    action: "add_contact_form_library",
                                    _wp_nonce: "<?php echo $contact_bank_check_status; ?>"
                            },
                            function(data)
                            {
                                    window.location.href = "admin.php?page=contact_dashboard";
                            });
                    }
		</script>
	<?php
}
?>
