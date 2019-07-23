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
	$form_settings = array();
	$form_id = isset($_REQUEST["form_id"]) ? intval($_REQUEST["form_id"]) : 0;
	$count_forms = $wpdb->get_var
	(
		"SELECT count(form_id) FROM ". contact_bank_contact_form()
	);

	if($count_forms < 2)
	{
			$last_form_id = $wpdb->get_var
			(
				$wpdb->prepare
				(
					"SELECT form_id FROM " .contact_bank_contact_form(). " where form_id= %d",
					$form_id
				)
			);
			if(count($last_form_id) == 0)
			{
				$wpdb->query
				(
					$wpdb->prepare
					(
						"INSERT INTO ".contact_bank_contact_form()."(form_id,form_name) VALUES(%d,%s)",
						$form_id,
						"Untitled Form"
					)
				);
				$wpdb->query
				(
					$wpdb->prepare
					(
						"INSERT INTO ". contact_bank_form_settings_Table() ."(form_id,form_message_key,form_message_value)VALUES(%d, %s, %s)",
						$form_id,
						"redirect",
						"0"
					)
				);
				$wpdb->query
				(
					$wpdb->prepare
					(
						"INSERT INTO ". contact_bank_form_settings_Table() ."(form_id,form_message_key,form_message_value)VALUES(%d, %s, %s)",
						$form_id,
						"redirect_url",
						""
					)
				);
				$wpdb->query
				(
					$wpdb->prepare
					(
						"INSERT INTO ". contact_bank_form_settings_Table() ."(form_id,form_message_key,form_message_value)VALUES(%d, %s, %s)",
						$form_id,
						"success_message",
						"Your Message has been successfully sent."
					)
				);
				$wpdb->query
				(
					$wpdb->prepare
					(
						"INSERT INTO ". contact_bank_form_settings_Table() ."(form_id,form_message_key,form_message_value)VALUES(%d, %s, %s)",
						$form_id,
						"blank_field_message",
						"Required field must not be blank"
					)
				);
				$wpdb->query
				(
					$wpdb->prepare
					(
						"INSERT INTO ". contact_bank_form_settings_Table() ."(form_id,form_message_key,form_message_value)VALUES(%d, %s, %s)",
						$form_id,
						"incorrect_email_message",
						"Please enter a valid e-mail address"
					)
				);
				$wpdb->query
				(
					$wpdb->prepare
					(
						"INSERT INTO ". contact_bank_form_settings_Table() ."(form_id,form_message_key,form_message_value)VALUES(%d, %s, %s)",
						$form_id,
						"form_description",
						""
					)
				);
				$settings = array();
				$settings["label_setting_font_family"] = "inherit";
				$settings["label_setting_font_color"] = "#000000";
				$settings["label_setting_font_style"] =  "normal";
				$settings["label_setting_font_size"] = "16";
				$settings["label_setting_font_align_left"] = "0";
				$settings["label_setting_label_position"] = "top";
				$settings["label_setting_field_size"] = "11";
				$settings["label_setting_field_align"] = "left";
				$settings["label_setting_hide_label"] = "0";
				$settings["label_setting_text_direction"] = "inherit";

				$settings["input_field_font_family"] = "inherit";
				$settings["input_field_font_color"] = "#000000";
				$settings["input_field_font_style"] = "normal";
				$settings["input_field_font_size"] = "14";
				$settings["input_field_border_radius"] = "0";
				$settings["input_field_border_color"] = "#e5e5e5";
				$settings["input_field_border_size"] = "1";
				$settings["input_field_border_style"] = "solid";
				$settings["input_field_clr_bg_color"] = "#ffffff";
				$settings["input_field_rdl_multiple_row"] = "1";
				$settings["input_field_rdl_text_align"] = "0";
				$settings["input_field_text_direction"] = "inherit";
				$settings["input_field_input_size"] = "layout-span10";

				$settings["submit_button_font_family"] = "inherit";
				$settings["submit_button_text"] = "Submit ";
				$settings["submit_button_font_style"] = "normal";
				$settings["submit_button_font_size"] = "12";
				$settings["submit_button_button_width"] = "110";
				$settings["submit_button_bg_color"] =  "#B8B8B8";
				$settings["submit_button_hover_bg_color"] = "#e5e5e5";
				$settings["submit_button_text_color"] =  "#000000";
				$settings["submit_button_border_color"] = "#B8B8B8";
				$settings["submit_button_border_size"] = "1";
				$settings["submit_button_border_radius"] = "2";
				$settings["submit_button_rdl_text_align"] = "0";
				$settings["submit_button_text_direction"] = "inherit";

				$settings["success_msg_font_family"] = "inherit";
				$settings["success_msg_font_size"] = "12";
				$settings["success_msg_bg_color"] = "#e5ffd5";
				$settings["success_msg_border_color"] =  "#e5ffd5";
				$settings["success_msg_text_color"] =  "#6aa500";
				$settings["success_msg_rdl_text_align"] = "0";
				$settings["success_msg_text_direction"] = "inherit";

				$settings["error_msg_font_family"] =  "inherit";
				$settings["error_msg_font_size"] = "12";
				$settings["error_msg_bg_color"] = "#ffcaca";
				$settings["error_msg_border_color"] = "#ffcaca";
				$settings["error_msg_text_color"] = "#ff2c38";
				$settings["error_msg_rdl_text_align"] = "0";
				$settings["error_msg_text_direction"] = "inherit";
				foreach($settings as $key => $value)
				{
					$sql[] = '('.$form_id.',"'.$key.'", "'.$value.'")';
				}
				$wpdb->query
				(
					 "INSERT INTO " . contact_bank_layout_settings_Table() . "(form_id,form_settings_key,form_settings_value) VALUES ".implode(',', $sql)
				);
				$email_name = "Admin Notification";
				$send_to = get_option('admin_email');
				$email_address = get_option('admin_email');
				$email_from_name = "Site Administration";
				$email_from_email = get_option('admin_email');
				$email_subject  = "New Contact recieved from Website";
				$uxDescription_email = "Hello Admin,<br><br>
				A new user has visited your website.<br><br>
				Here are the details :<br><br>
				<br>Thanks,<br><br>
				<strong>Technical Support Team</strong>";
				$wpdb->query
				(
					$wpdb->prepare
					(
						"INSERT INTO " . contact_bank_email_template_admin(). " (email_to,email_from,body_content,subject,form_id,from_name,name,send_to) VALUES(%s,%s,%s,%s,%d,%s,%s,%d)",
						$email_address,
						$email_from_email,
						$uxDescription_email,
						$email_subject,
						$form_id,
						$email_from_name,
						$email_name,
						$send_to
					)
				);
				$email_name_client = "Client Notification";
				$email_subject_client  = "Thanks for visiting our website";
				$email_from_name = "Site Administration";
				$email_from_email = get_option('admin_email');
				$uxDescription_email_client = "Hi,<br><br>
				Thanks for visiting our website. We will Contact you within next 24 hours.<br><br>
				<br>Thanks,<br><br>
				<strong>Support Team</strong>
				";
				$wpdb->query
				(
					$wpdb->prepare
					(
					"INSERT INTO " . contact_bank_email_template_admin(). " (email_to,email_from,body_content,subject,form_id,from_name,name,send_to) VALUES(%s,%s,%s,%s,%d,%s,%s,%d)",
					"",
					$email_from_email,
					$uxDescription_email_client,
					$email_subject_client,
					$form_id,
					$email_from_name,
					$email_name_client,
					""
					)
				);
				}
			}
		$form_data = $wpdb->get_results
		(
			$wpdb->prepare
			(
				"SELECT * FROM " .contact_bank_form_settings_Table(). " where form_id = %d",
				$form_id
			)
		);
		for($flag = 0; $flag<count($form_data);$flag++)
		{
			$form_settings[$form_id][$form_data[$flag]->form_message_key] = esc_html($form_data[$flag]->form_message_value);
		}
		$form_name = $wpdb->get_var
		(
			$wpdb->prepare
			(
				"SELECT form_name FROM " .contact_bank_contact_form(). " where form_id = %d",
				$form_id
			)
		);
?>
<form id="ux_dynamic_form_submit" class="layout-form">
	<div id="poststuff" style="width: 99% !important;">
		<div id="post-body" class="metabox-holder">
			<div id="postbox-container" class="postbox-container">
				<div id="advanced" class="meta-box-sortables">
					<div id="contact_bank_get_started" class="postbox" >
						<div class="handlediv" data-target="#ux_form_entries_div" title="Click to toggle" data-toggle="collapse"><br></div>
						<h3 class="hndle"><span><?php _e("Add New Form", "contact-bank"); ?></span></h3>
						<div class="inside">
							<div id="ux_form_entries_div" class="contact_bank_layout">
								<a class="btn btn-info" href="admin.php?page=contact_dashboard"><?php _e("Back to Dashboard", "contact-bank"); ?></a>
								<input class="btn btn-info layout-span2" style="float: right;" type="submit" id="submit_button"
									name="submit_button"
									value="<?php _e("Save Form", "contact-bank"); ?>"/>
								<div class="separator-doubled" style="margin-bottom: 5px;"></div>
								<a rel="prettyPhoto[contact]"  href="<?php echo plugins_url("/assets/images/how-to-setup-short-code-cb.png" , dirname(__FILE__));?>">How to setup Short-Codes for Contact Bank into your WordPress Page/Post?</a>
								<div id="form_success_message" class="custom-message green" style="display: none;">
									<span>
										<strong><?php _e("Form Submitted. Kindly wait for the redirect.", "contact-bank"); ?></strong>
									</span>
								</div>
								<div class="fluid-layout">
									<div class="layout-span12">
										<div class="fluid-layout">
											<div class="layout-span8">
												<div class="widget-layout">
													<div class="widget-layout-title">
														<h4><?php _e("Form Settings", "contact-bank"); ?></h4>
													</div>
													<div class="widget-layout-body">
														<div class="layout-control-group div_border" id="div_100">
															<label class="layout-control-label"><?php _e("Form Name :", "contact-bank"); ?>
																<span class="error_field">*</span>
															</label>
															<div class="layout-controls">
																<input type="text" name="ux_txt_form_name" class="layout-span7" id="ux_txt_form_name"
																	value="<?php echo isset($form_name) ? esc_attr($form_name) : ""; ?>"
																	placeholder="<?php _e("Enter Form Name", "contact-bank"); ?>"/>
															</div>
														</div>
														<div class="layout-control-group div_border">
															<label class="layout-control-label"><?php _e("Form Description :", "contact-bank"); ?></label>
															<div class="layout-controls">
																<textarea type="textarea" rows="5" name="ux_txt_form_description" class="layout-span7" id="ux_txt_form_description" placeholder="<?php _e("Enter Form Description", "contact-bank"); ?>"><?php echo isset($form_settings[$form_id]["form_description"])? $form_settings[$form_id]["form_description"] : "" ;?></textarea>
															</div>
														</div>
														<div class="layout-control-group div_border">
															<label class="layout-control-label"><?php _e("Blank Field Message:", "contact-bank"); ?>
																<span class="error_field">*</span>
															</label>
															<div class="layout-controls">
																<input type="text" name="ux_txt_blank_message" class="layout-span7"
																	value="<?php echo isset($form_settings[$form_id]["blank_field_message"])? esc_attr($form_settings[$form_id]["blank_field_message"])
																	: _e("Required field must not be blank", "contact-bank"); ?>"
																	id="ux_txt_blank_message"
																	placeholder="<?php _e("Enter Blank Field Message", "contact-bank"); ?>"/>
															</div>
														</div>
														<div class="layout-control-group div_border">
															<label class="layout-control-label"><?php _e("Incorrect Email Message:", "contact-bank"); ?>
																<span class="error_field">*</span>
															</label>
															<div class="layout-controls ">
															<input type="text" name="ux_txt_incorrect_email_message" class="layout-span7"
																value="<?php echo isset($form_settings[$form_id]["incorrect_email_message"])? esc_attr($form_settings[$form_id]["incorrect_email_message"])
																	: _e("Please enter a valid email address", "contact-bank"); ?>"
																id="ux_txt_incorrect_email_message"
																placeholder="<?php _e("Enter Incorrect Email Message", "contact-bank"); ?>"/>
															</div>
														</div>
														<div class="layout-control-group div_border">
															<label class="layout-control-label"><?php _e("Success Message :", "contact-bank"); ?>
																<span class="error_field">*</span>
															</label>
															<div class="layout-controls">
																<textarea type="textarea" name="ux_txt_success_message" class="layout-span7" id="ux_txt_success_message" placeholder="<?php _e("Enter Success Message", "contact-bank"); ?>"><?php echo isset($form_settings[$form_id]["success_message"])? $form_settings[$form_id]["success_message"] : "" ;?></textarea>
															</div>
														</div>
														<div class="layout-control-group div_border">
															<label class="layout-control-label"><?php _e("Redirect :", "contact-bank"); ?>
																<span class="error_field">*</span>
															</label>
															<div class="layout-controls" style=" padding-top: 7px; ">
															<?php
																if(isset($form_settings[$form_id]["redirect"]))
																{
																	if(esc_attr($form_settings[$form_id]["redirect"]) == "0")
																	{
																	?>
																	<input type="radio" id="ux_rdl_page" checked="checked" name="ux_rdl_redirect"
																		onclick="show_url_control();"
																		value="0"/><label style="vertical-align: text-bottom;"><?php _e("Page", "contact-bank"); ?></label>
																	<input type="radio" id="ux_rdl_redirect_url" name="ux_rdl_redirect"
																		onclick="show_url_control();"
																		value="1"/><label style="vertical-align: text-bottom;"><?php _e("URL", "contact-bank"); ?></label>
																	<?php
																	}
																	else
																	{
																		?>
																		 <input type="radio" id="ux_rdl_page" name="ux_rdl_redirect"
																			onclick="show_url_control();"
																			value="0"/><label style="vertical-align: text-bottom;"><?php _e("Page", "contact-bank"); ?></label>
																		<input type="radio" id="ux_rdl_redirect_url" checked="checked"name="ux_rdl_redirect"
																			onclick="show_url_control();"
																			value="1"/><label style="vertical-align: text-bottom;"><?php _e("URL", "contact-bank"); ?></label>
																		<?php
																	}
																}
																else
																{
																	?>
																	<input type="radio" id="ux_rdl_page" name="ux_rdl_redirect" checked="checked"
																		onclick="show_url_control();"
																		value="0"/><label style="vertical-align: text-bottom;"><?php _e("Page", "contact-bank"); ?></label>
																	<input type="radio" id="ux_rdl_redirect_url" name="ux_rdl_redirect"
																			onclick="show_url_control();"
																			value="1"/><label style="vertical-align: text-bottom;"><?php _e("URL", "contact-bank"); ?></label>
																	<?php
																}
																?>
															</div>
														</div>
														<div class="layout-control-group div_border" id="div_page">
															<label class="layout-control-label"><?php _e("Page :", "contact-bank"); ?>
																<span class="error_field">*</span>
															</label>
															<div class="layout-controls">
															<?php
																$publish_pages = $wpdb->get_results
																(
																	"SELECT ID,post_name FROM " . $wpdb->posts . " WHERE (post_type = \"page\" OR post_type=\"post\") AND post_status = \"publish\""
																);
																?>
																<select class="layout-span7" id="ux_ddl_page_url" name="ux_ddl_page_url">
																<?php
																for($flag=0;$flag<count($publish_pages);$flag++)
																{
																	if(isset($form_settings[$form_id]["redirect_url"]))
																	{
																		$permalink = get_permalink( $publish_pages[$flag]->ID);
																		if($permalink == esc_attr($form_settings[$form_id]["redirect_url"]))
																		{
																			?>
																			<option selected="selected" value="<?php echo $permalink ; ?>"><?php echo $publish_pages[$flag]->post_name; ?></option>
																			<?php
																		}
																		else
																		{
																			?>
																			<option value="<?php echo $permalink ; ?>"><?php echo esc_attr($publish_pages[$flag]->post_name); ?></option>
																			<?php
																		}
																	}
																	else
																	{
																		$permalink = get_permalink( $publish_pages[$flag]->ID);
																		?>
																		<option value="<?php echo $permalink ; ?>"><?php echo esc_attr($publish_pages[$flag]->post_name); ?></option>
																		<?php
																	}
																}
																?>
																</select>
															</div>
														</div>
														<div class="layout-control-group div_border" id="div_url">
															<label class="layout-control-label"><?php _e("URL :", "contact-bank"); ?>
																<span class="error_field">*</span>
															</label>
															<div class="layout-controls">
																<input type="text" name="ux_txt_redirect_url" class="layout-span7" id="ux_txt_redirect_url"
																value="<?php echo isset($form_settings[$form_id]["redirect_url"])? esc_attr($form_settings[$form_id]["redirect_url"])
																: ""; ?>"
																placeholder="<?php _e("Enter Redirect URL", "contact-bank"); ?>"/>
															</div>
														</div>
													</div>
												</div>
												<div class="widget-layout">
													<div class="widget-layout-title">
														<h4><?php _e("Form Layout Preview", "contact-bank"); ?></h4>
													</div>
													<div class="widget-layout-body">
														<?php include_once CONTACT_BK_PLUGIN_DIR . "/views/contact_controls_files.php"; ?>
														<div id="left_block"></div>
													</div>
												</div>
											</div>
									<div class="layout-span4">
										<div class="widget-layout" style="margin-top: 4px;">
											<div class="widget-layout-title">
												<h4><?php _e("Standard Fields", "contact-bank"); ?></h4>
											</div>
											<div class="widget-layout-body">
												<p class="howto"><?php _e("Click on a field to use into your form.", "contact-bank"); ?></p>
												<div class="layout-control-group">
													<button type="button" class="btn btn-info button_space" onclick="create_control(1);">
														<i class="icon-custom-grid"></i> <?php _e("Single Line Text", "contact-bank"); ?>
													</button>
													<button type="button" class="btn btn-info button_space" onclick="create_control(2);">
														<i class="icon-custom-list"></i> <?php _e("Paragraph Text", "contact-bank"); ?>
													</button>
												</div>
												<div class="layout-control-group">
													<button type="button" class="btn btn-info button_space" onclick="create_control(3);">
														<i class="icon-custom-envelope"></i> <?php _e("Email Address", "contact-bank"); ?>
													</button>
													<button type="button" class="btn btn-info button_space" onclick="create_control(4);">
														<i class="icon-custom-arrow-down"></i> <?php _e("Select Box", "contact-bank"); ?>
													</button>
												</div>
												<div class="layout-control-group">
													<button type="button" class="btn btn-info button_space" onclick="create_control(5);">
														<i class="icon-custom-check"></i> <?php _e("Checkboxes", "contact-bank"); ?>
													</button>
													<button type="button" class="btn btn-info button_space" onclick="create_control(6);">
														<i class="icon-custom-control-play"></i> <?php _e("Radio Buttons", "contact-bank"); ?>
													</button>
												</div>
												<input type="hidden" id="hidden_dynamic_id" name="hidden_dynamic_id"/>
												<input type="hidden" id="hidden_div_id" name="hidden_div_id"/>
											</div>
										</div>
										<div class="widget-layout">
											<div class="widget-layout-title">
												<h4><?php _e("Advanced Fields", "contact-bank"); ?>
													<i class="widget_premium_feature_contact"><?php _e(" (Available in Premium Editions)", "contact-bank"); ?></i>
												</h4>
											</div>
											<div class="widget-layout-body">
												<p class="howto"><?php _e("Click on a field to use into your form.", "contact-bank"); ?></p>
												<div class="layout-control-group">
													<button type="button" class="btn btn-info button_space" onclick="create_control(8);">
														<i class="icon-custom-user"></i> <?php _e("Name", "contact-bank"); ?>
													</button>
													<button type="button" class="btn btn-info button_space" onclick="create_control(16);">
														<i class="icon-custom-globe"></i> <?php _e("Website / URL", "contact-bank"); ?>
													</button>
												</div>
												<div class="layout-control-group">
													<button type="button" class="btn btn-info button_space" onclick="create_control(10);">
														<i class="icon-custom-layers"></i> <?php _e("Phone", "contact-bank"); ?>
													</button>
													<button type="button" class="btn btn-info button_space" onclick="create_control(11);">
														<i class="icon-custom-pointer"></i> <?php _e("Address", "contact-bank"); ?>
													</button>
												</div>
												<div class="layout-control-group">
													<button type="button" class="btn btn-info button_space" onclick="create_control(7);">
														<i class=" icon-custom-list"></i> <?php _e("Number", "contact-bank"); ?>
													</button>
													<button type="button" class="btn btn-info button_space" onclick="create_control(9);">
														<i class="icon-custom-arrow-up"></i> <?php _e("File Upload", "contact-bank"); ?>
													</button>
												</div>
												<div class="layout-control-group">
													<button type="button" class="btn btn-info button_space" onclick="create_control(12);">
														<i class="icon-custom-calendar"></i> <?php _e("Date", "contact-bank"); ?>
													</button>
													<button type="button" class="btn btn-info button_space" onclick="create_control(13);">
														<i class="icon-custom-clock"></i> <?php _e("Time", "contact-bank"); ?>
													</button>
												</div>
												<div class="layout-control-group">
													<button type="button" class="btn btn-info button_space" onclick="create_control(15);">
														<i class="icon-custom-lock"></i> <?php _e("Password", "contact-bank"); ?>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
									<input type="hidden" id="hidden_file_upload_count" name="hidden_file_upload_count" value="0" />
									<div class="separator-doubled"></div>
									<input class="btn btn-info layout-span2" type="submit" id="submit_button" name="submit_button"
									style="margin-bottom: 10px;margin-top: 10px;" value="<?php _e("Save Form", "contact-bank"); ?>"/>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
jQuery(document).ready(function()
{
	jQuery("a[rel^=\"prettyPhoto\"]").prettyPhoto
	({
		animation_speed: 1000,
		slideshow: 4000,
		autoplay_slideshow: false,
		opacity: 0.80,
		show_title: false,
		allow_resize: true
	});
});

function base64_encode_contact_bank(data)
{
        var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
        var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
        ac = 0,
        enc = '',
        tmp_arr = [];
        if (!data)
        {
                return data;
        }
        do
        {
                o1 = data.charCodeAt(i++);
                o2 = data.charCodeAt(i++);
                o3 = data.charCodeAt(i++);
                bits = o1 << 16 | o2 << 8 | o3;
                h1 = bits >> 18 & 0x3f;
                h2 = bits >> 12 & 0x3f;
                h3 = bits >> 6 & 0x3f;
                h4 = bits & 0x3f;
                tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
        }
        while (i < data.length);
        enc = tmp_arr.join('');
        var r = data.length % 3;
        return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
 }
	
jQuery("#ux_dynamic_form_submit").validate
({
	rules:
	{
		ux_txt_form_name: "required",
		ux_txt_success_message: "required",
		ux_txt_blank_message: "required",
		ux_txt_incorrect_email_message: "required",
		ux_txt_redirect_url:
		{
			url: true,
			required: function()
			{
				return jQuery("#ux_rdl_redirect_url").prop("checked");
			}
		}
	},
	submitHandler: function(form)
	{
		jQuery("#form_success_message").css("display","block");
		jQuery("body,html").animate({
		scrollTop: jQuery("body,html").position().top}, "slow");
		var form_id = "<?php echo $form_id; ?>";
		jQuery.post(ajaxurl,
		{
			form_settings: base64_encode_contact_bank(jQuery("#ux_dynamic_form_submit").serialize()),
			form_id: form_id,
			array_delete_form_controls: JSON.stringify(array_delete_form_controls),
			param: "submit_form_messages_settings",
			action: "add_contact_form_library",
		},
		function(data)
		{
			setTimeout(function()
			{
				jQuery("#form_success_message").css("display","none");
				window.location.href = "admin.php?page=contact_dashboard";
		 }, 3000);
		});
	}
});
</script>
<?php
}
?>
