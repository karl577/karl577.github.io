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
		$form_id = isset($_REQUEST["form_id"]) ? intval($_REQUEST["form_id"]) : 0;
		isset($_REQUEST["email_id"]) ? $email_id = intval($_REQUEST["email_id"]) : $email_id = "";
		$fields_email = $wpdb->get_results
		(
			$wpdb->prepare
			(
				"SELECT * FROM " .create_control_Table()."  WHERE form_id = %d and field_id = %d ORDER BY " .create_control_Table().".sorting_order",
				$form_id,
				3
			)
		);
		$email_data = $wpdb->get_row
		(
			$wpdb->prepare
			(
				"SELECT * FROM " .contact_bank_email_template_admin(). " where form_id= %d and email_id = %d",
				$form_id,
				$email_id
			)
		);
		$fields_controls = $wpdb->get_results
		(
			$wpdb->prepare
			(
				"SELECT dynamicId, dynamic_settings_value FROM ". contact_bank_dynamic_settings_form(). " JOIN " . create_control_Table(). " ON " . contact_bank_dynamic_settings_form().". dynamicId  = ". create_control_Table(). ".control_id WHERE `dynamic_settings_key` = 'cb_admin_label' and form_id = %d and " . create_control_Table(). ".field_id != %d and " . create_control_Table(). ".field_id != %d Order By ".create_control_Table().".sorting_order",
				$form_id,
				9,
				17
			)
		);
		$fields_email_controls = $wpdb->get_results
		(
			$wpdb->prepare
			(
				"SELECT dynamicId, dynamic_settings_value FROM ". contact_bank_dynamic_settings_form(). " JOIN " . create_control_Table(). " ON " . contact_bank_dynamic_settings_form().". dynamicId  = ". create_control_Table(). ".control_id WHERE `dynamic_settings_key` = 'cb_admin_label' and field_id = 3 and form_id = %d",
				$form_id
			)
		);
	?>
	<form id="ux_frm_add_email" class="layout-form">
		<div id="poststuff" style="width: 99% !important;">
			<div id="post-body" class="metabox-holder">
				<div id="postbox-container" class="postbox-container">
					<div id="advanced" class="meta-box-sortables">
						<div id="contact_bank_get_started" class="postbox" >
							<div class="handlediv" data-target="#ux_form_email_div" title="Click to toggle" data-toggle="collapse"><br></div>
							<h3 class="hndle"><span><?php _e( "Email Confirmation", "contact-bank" ); ?></span></h3>
							<div class="inside">
								<div id="ux_form_email_div" class="contact_bank_layout">
									<a class="btn btn-info" href="admin.php?page=contact_email"><?php _e("Back to Email Settings", "contact-bank");?></a>
									<input  class="btn btn-info layout-span1" type="submit" id="submit_button" name="submit_button" style="float: right;"  value="<?php _e("Save", "contact-bank"); ?>" />
									<div class="separator-doubled"></div>
									<div id="email_success_message" class="custom-message green" style="display: none;">
										<span>
											<strong><?php _e("Email Settings Saved. Kindly wait for the redirect.", "contact-bank"); ?></strong>
										</span>
									</div>
									<div class="fluid-layout">
										<div class="layout-span12">
											<div class="widget-layout">
												<div class="widget-layout-title">
													<h4><?php _e( "Email", "contact-bank"); ?></h4>
												</div>
												<div class="widget-layout-body">
													<div class="layout-control-group">
														<label class="layout-control-label"><?php _e( "Name", "contact-bank" ); ?> :
															<span class="error_field">*</span>
														</label>
														<div class="layout-controls">
															<input type="text" class="layout-span12" id="ux_txt_name" name="ux_txt_name" value="<?php echo isset($email_data->name)  ? esc_attr($email_data->name) : ""; ?>" placeholder="<?php _e( "Enter Name", "contact-bank" ); ?>"/>
														</div>
													</div>
												</div>
												<div class="widget-layout-body">
													<div class="layout-control-group">
														<label class="layout-control-label"><?php _e( "Send To", "contact-bank" ); ?> :</label>
														<?php
														if(isset($email_data->send_to))
														{
															if(esc_attr($email_data->send_to) == "0")
															{
																?>
																<div class="layout-controls" style="padding-top:5px;">
																	<input type="radio" name="ux_rdl_send_to" id="ux_rdl_email" value="0" checked="checked" onclick="show_send_to_div();">
																	<label class="rdl"><?php _e( "Enter Email", "contact-bank" ); ?></label>
																	<input type="radio" name="ux_rdl_send_to" id="ux_rdl_field" value="1" onclick="show_send_to_div(); ">
																	<label class="rdl"><?php _e( "Select a Field", "contact-bank" ); ?></label>
																</div>
																<?php
															}
															else
															{
																?>
																<div class="layout-controls" style="padding-top:5px;">
																	<input type="radio" name="ux_rdl_send_to" id="ux_rdl_email" value="0"  onclick="show_send_to_div();">
																	<label class="rdl"><?php _e( "Enter Email", "contact-bank" ); ?></label>
																	<input type="radio" name="ux_rdl_send_to" id="ux_rdl_field" value="1" checked="checked" onclick="show_send_to_div(); ">
																	<label class="rdl"><?php _e( "Select a Field", "contact-bank" ); ?></label>
																</div>
																<?php
															}
														}
														else
														{
															?>
															<div class="layout-controls" style="padding-top:5px;">
																<input type="radio" name="ux_rdl_send_to" id="ux_rdl_email" value="0" checked="checked" onclick="show_send_to_div();">
																<label class="rdl"><?php _e( "Enter Email", "contact-bank" ); ?></label>
																<input type="radio" name="ux_rdl_send_to" id="ux_rdl_field" value="1" onclick="show_send_to_div(); ">
																<label class="rdl"><?php _e( "Select a Field", "contact-bank" ); ?></label>
															</div>
															<?php
														}
														?>
													</div>
												</div>
												<div class="widget-layout-body">
													<div class="layout-control-group" id="div_email" style="display: none;">
														<label class="layout-control-label"><?php _e( "Email", "contact-bank" ); ?> :
															<span class="error_field">*</span>
														</label>
														<div class="layout-controls">
															<input type="text" class="layout-span12" id="ux_txt_email" name="ux_txt_email" value="<?php echo isset($email_data->email_to) ? esc_attr($email_data->email_to) : ""; ?>" placeholder="<?php _e( "Enter Email ", "contact-bank" ); ?>"/>
														</div>
													</div>
													<div class="layout-control-group" id="div_field" style="display: none;">
														<label class="layout-control-label"><?php _e( "Send To Field", "contact-bank" ); ?> :
															<span class="error_field">*</span>
														</label>
														<div class="layout-controls">
															<input type="text" class="layout-span8" id="ux_txt_send_to_field" name="ux_txt_send_to_field" value="<?php echo isset($email_data->email_to) ? esc_attr($email_data->email_to) : ""; ?>" placeholder="<?php _e( "Enter Field ", "contact-bank" ); ?>"/>
															<select class="layout-span4" id="ux_ddl_send_to_field" name="ux_ddl_send_to_field" style="float: right;" onchange="append_control_shortcode('ux_ddl_send_to_field','ux_txt_send_to_field');">
																<option value=""><?php _e("Select a field", "contact-bank");?></option>
																<?php
																for($flag = 0; $flag < count($fields_controls); $flag++)
																{
																	$show_in_email = $wpdb->get_var
																	(
																		$wpdb->prepare
																		(
																			"SELECT dynamic_settings_value FROM ". contact_bank_dynamic_settings_form(). " WHERE `dynamic_settings_key` = 'cb_show_email' and dynamicId = %d",
																			intval($fields_controls[$flag]->dynamicId)
																		)
																	);
																	if($show_in_email == "0")
																	{
																		$option_values = htmlspecialchars_decode($fields_controls[$flag]->dynamic_settings_value);
																		?>
																			<option value="<?php echo intval($fields_controls[$flag]->dynamicId);?>"><?php echo $option_values;?></option>
																		<?php
																	}
																}
																?>
															</select>
														</div>
													</div>
												</div>
												<div class="widget-layout-body">
													<div class="layout-control-group">
														<label class="layout-control-label"><?php _e( "From Name", "contact-bank" ); ?> :
															<span class="error_field">*</span>
														</label>
														<div class="layout-controls">
															<input type="text" class="layout-span8" id="ux_txt_from_name" name="ux_txt_from_name" value="<?php echo isset($email_data->from_name) ? esc_attr($email_data->from_name) : ""; ?>" placeholder="<?php _e( "Enter from name ", "contact-bank" ); ?>"/>
															<select class="layout-span4" id="ux_ddl_from_name" name="ux_ddl_from_name" style=" float: right; " onchange="append_control_shortcode('ux_ddl_from_name','ux_txt_from_name');">
																<option value=""><?php _e("Select a field", "contact-bank");?></option>
																<?php
																for($flag = 0; $flag < count($fields_controls); $flag++)
																{
																	$show_in_email = $wpdb->get_var
																	(
																		$wpdb->prepare
																		(
																			"SELECT dynamic_settings_value FROM ". contact_bank_dynamic_settings_form(). " WHERE `dynamic_settings_key` = 'cb_show_email' and dynamicId = %d",
																			intval($fields_controls[$flag]->dynamicId)
																		)
																	);
																	if($show_in_email == "0")
																	{
																		$option_values = htmlspecialchars_decode($fields_controls[$flag]->dynamic_settings_value);
																		?>
																			<option value="<?php echo intval($fields_controls[$flag]->dynamicId);?>"><?php echo $option_values;?></option>
																		<?php
																	}
																}
																?>
															</select>
														</div>
													</div>
												</div>
												<div class="widget-layout-body">
													<div class="layout-control-group">
														<label class="layout-control-label"><?php _e( "From Email", "contact-bank" ); ?> :
															<span class="error_field" >*</span>
														</label>
														<div class="layout-controls">
															<input type="text" class="layout-span8" id="ux_txt_from_email" name="ux_txt_from_email" value="<?php echo isset($email_data->email_from) ? esc_attr($email_data->email_from) : ""; ?>" placeholder="<?php _e( "Enter from email", "contact-bank" ); ?>"/>
															<select class="layout-span4" id="ux_ddl_from_email" name="ux_ddl_from_email" style=" float: right;" onchange="append_control_shortcode(this.id,'ux_txt_from_email');">
																<option value=""><?php _e("Select a field", "contact-bank");?></option>
																<?php
																for($flag = 0; $flag < count($fields_email_controls); $flag++)
																{
																	$show_in_email = $wpdb->get_var
																	(
																		$wpdb->prepare
																		(
																			"SELECT dynamic_settings_value FROM ". contact_bank_dynamic_settings_form(). " WHERE `dynamic_settings_key` = 'cb_show_email' and dynamicId = %d",
																			intval($fields_email_controls[$flag]->dynamicId)
																		)
																	);
																	if($show_in_email == "0")
																	{
																		$option_values = htmlspecialchars_decode($fields_email_controls[$flag]->dynamic_settings_value);
																		?>
																			<option value="<?php echo intval($fields_email_controls[$flag]->dynamicId);?>"><?php echo $option_values;?></option>
																		<?php
																	}
																}
																?>
															</select>
														</div>
													</div>
												</div>
												<div class="widget-layout-body">
													<div class="layout-control-group">
														<label class="layout-control-label"><?php _e( "Reply To", "contact-bank" ); ?> :</label>
														<div class="layout-controls">
															<input type="text" class="layout-span8" id="ux_txt_reply_to" name="ux_txt_reply_to" value="<?php echo isset($email_data->reply_to) ? esc_attr($email_data->reply_to) : ""; ?>" placeholder="<?php _e( "Enter Email", "contact-bank" ); ?>"/>
															<select class="layout-span4" id="ux_ddl_reply_to" name="ux_ddl_reply_to" style=" float: right;" onchange="append_control_shortcode('ux_ddl_reply_to','ux_txt_reply_to');">
																<option value=""><?php _e("Select a field", "contact-bank");?></option>
																<?php
																for($flag = 0; $flag < count($fields_email_controls); $flag++)
																{
																	$show_in_email = $wpdb->get_var
																	(
																		$wpdb->prepare
																		(
																			"SELECT dynamic_settings_value FROM ". contact_bank_dynamic_settings_form(). " WHERE `dynamic_settings_key` = 'cb_show_email' and dynamicId = %d",
																			intval($fields_email_controls[$flag]->dynamicId)
																		)
																	);
																	if($show_in_email == "0")
																	{
																		$option_values = htmlspecialchars_decode($fields_email_controls[$flag]->dynamic_settings_value);
																		?>
																			<option value="<?php echo intval($fields_email_controls[$flag]->dynamicId);?>"><?php echo $option_values;?></option>
																		<?php
																	}
																}
																?>
															</select>
														</div>
													</div>
												</div>
												<div class="widget-layout-body">
													<div class="layout-control-group">
														<label class="layout-control-label"><?php _e( "CC", "contact-bank" ); ?> :</label>
														<div class="layout-controls">
															<input type="text" class="layout-span8" id="ux_txt_cc" name="ux_txt_cc" value="<?php echo isset($email_data->cc) ? esc_attr($email_data->cc) : ""; ?>" placeholder="<?php _e( "Enter CC Email ", "contact-bank" ); ?>"/>
															<select class="layout-span4" id="ux_ddl_cc" name="ux_ddl_cc" style=" float: right;" onchange="append_control_shortcode('ux_ddl_cc','ux_txt_cc');">
																<option value=""><?php _e("Select a field", "contact-bank");?></option>
																<?php
																for($flag = 0; $flag < count($fields_email_controls); $flag++)
																{
																	$show_in_email = $wpdb->get_var
																	(
																		$wpdb->prepare
																		(
																			"SELECT dynamic_settings_value FROM ". contact_bank_dynamic_settings_form(). " WHERE `dynamic_settings_key` = 'cb_show_email' and dynamicId = %d",
																			intval($fields_email_controls[$flag]->dynamicId)
																		)
																	);
																	if($show_in_email == "0")
																	{
																		$option_values = htmlspecialchars_decode($fields_email_controls[$flag]->dynamic_settings_value);
																		?>
																			<option value="<?php echo intval($fields_email_controls[$flag]->dynamicId);?>"><?php echo $option_values;?></option>
																		<?php
																	}
																}
																?>
															</select>
														</div>
													</div>
												</div>
												<div class="widget-layout-body">
													<div class="layout-control-group">
														<label class="layout-control-label"><?php _e( "BCC", "contact-bank" ); ?> :</label>
														<div class="layout-controls">
															<input type="text" class="layout-span8" id="ux_txt_bcc" name="ux_txt_bcc" value="<?php echo isset($email_data->bcc) ? esc_attr($email_data->bcc) : ""; ?>" placeholder="<?php _e( "Enter Bcc Email", "contact-bank" ); ?>"/>
															<select class="layout-span4" id="ux_ddl_bcc" name="ux_ddl_bcc" style=" float: right;" onchange="append_control_shortcode('ux_ddl_bcc','ux_txt_bcc');">
																<option value=""><?php _e("Select a field", "contact-bank");?></option>
																<?php
																for($flag = 0; $flag < count($fields_email_controls); $flag++)
																{
																	$show_in_email = $wpdb->get_var
																	(
																		$wpdb->prepare
																		(
																			"SELECT dynamic_settings_value FROM ". contact_bank_dynamic_settings_form(). " WHERE `dynamic_settings_key` = 'cb_show_email' and dynamicId = %d",
																			intval($fields_email_controls[$flag]->dynamicId)
																		)
																	);
																	if($show_in_email == "0")
																	{
																		$option_values = htmlspecialchars_decode($fields_email_controls[$flag]->dynamic_settings_value);
																		?>
																			<option value="<?php echo intval($fields_email_controls[$flag]->dynamicId);?>"><?php echo $option_values;?></option>
																		<?php
																	}
																}
																?>
															</select>
														</div>
													</div>
												</div>
												<div class="widget-layout-body">
													<div class="layout-control-group">
														<label class="layout-control-label"><?php _e( "Subject", "contact-bank" ); ?> :
															<span class="error_field">*</span>
														</label>
														<div class="layout-controls">
															<input type="text" class="layout-span8" id="ux_txt_subject" name="ux_txt_subject" value="<?php echo isset($email_data->subject) ? esc_attr($email_data->subject) : ""; ?>" placeholder="<?php _e( "Enter Subject", "contact-bank" ); ?>"/>
															<select class="layout-span4" id="ux_ddl_subject" name="ux_ddl_subject" style=" float: right;" onchange="append_control_shortcode('ux_ddl_subject','ux_txt_subject');">
																<option value=""><?php _e("Select a field", "contact-bank");?></option>
																<?php
																for($flag = 0; $flag < count($fields_controls); $flag++)
																{
																	$show_in_email = $wpdb->get_var
																	(
																		$wpdb->prepare
																		(
																			"SELECT dynamic_settings_value FROM ". contact_bank_dynamic_settings_form(). " WHERE `dynamic_settings_key` = 'cb_show_email' and dynamicId = %d",
																			intval($fields_controls[$flag]->dynamicId)
																		)
																	);
																	if($show_in_email == "0")
																	{
																		$option_values = htmlspecialchars_decode($fields_controls[$flag]->dynamic_settings_value);
																		?>
																			<option value="<?php echo intval($fields_controls[$flag]->dynamicId);?>"><?php echo $option_values;?></option>
																		<?php
																	}
																}
																?>
															</select>
														</div>
													</div>
												</div>
												<div class="widget-layout-body">
													<div class="layout-control-group">
														<label class="layout-control-label"><?php _e( "Message", "contact-bank" ); ?> :</label>
														<div class="layout-controls">
															<div class="layout-span8">
															<?php
																$distribution = isset($email_data->body_content) ? htmlspecialchars_decode($email_data->body_content) : "";
																wp_editor( $distribution, $id ="uxEmailTemplate", array("media_buttons" => true, "textarea_rows" => 8, "tabindex" => 4 ) );
																?>
																<textarea style="display:none;" id="uxEmailTemplate_hidden" name="uxEmailTemplate_hidden" ><?php echo $distribution;?></textarea>
															</div>
															<div class="layout-span4">
																<select class="layout-span12" id="ux_ddl_message" name="ux_ddl_message" style=" float: right;" onchange="append_add_control_shortcode('ux_ddl_message');">
																	<option value=""><?php _e("Insert a Field into Your Form Message", "contact-bank");?></option>
																	<?php
																	for($flag = 0; $flag < count($fields_controls); $flag++)
																	{
																		$show_in_email = $wpdb->get_var
																		(
																			$wpdb->prepare
																			(
																				"SELECT dynamic_settings_value FROM ". contact_bank_dynamic_settings_form(). " WHERE `dynamic_settings_key` = 'cb_show_email' and dynamicId = %d",
																				intval($fields_controls[$flag]->dynamicId)
																			)
																		);
																		if($show_in_email == "0")
																		{
																			$option_values = htmlspecialchars_decode($fields_controls[$flag]->dynamic_settings_value);
																			?>
																				<option value="<?php echo intval($fields_controls[$flag]->dynamicId);?>"><?php echo $option_values;?></option>
																			<?php
																		}
																	}
																	?>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="separator-doubled"></div>
										<input style="margin-bottom: 10px;" class="btn btn-info layout-span1" type="submit" id="submit_button" name="submit_button" value="<?php _e("Save", "contact-bank"); ?>" />
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
	
	jQuery("#ux_frm_add_email").validate
	({
		rules:
		{
			ux_txt_name :
			{
				required : true
			},
			ux_txt_email :
			{
				required : true,
				email : true
			},
			ux_txt_send_to_field :
			{
				required : true
			},
			ux_txt_from_name :
			{
				required : true
			},
			ux_txt_from_email :
			{
				required : true
			},
			ux_txt_subject :
			{
				required : true
			}
		},
		errorPlacement: function(error, element)
		{
			if(jQuery(element).attr("id") == "ux_txt_email" || jQuery(element).attr("id") == "ux_txt_name")
			{
				error.insertAfter(element);
			}
			else
			{
				var ctrl = element.next();
				if(ctrl != undefined)
				error.insertAfter(ctrl);
				jQuery(".error_field").css("float","left");
				jQuery(".error_field").css("position","static");
			}
		},
		submitHandler: function(form)
		{
			var form_id = "<?php echo $form_id;?>";
			var email_id = "<?php echo $email_id; ?>";
			jQuery("#email_success_message").css("display","block");
			jQuery("body,html").animate({
			scrollTop: jQuery("body,html").position().top}, "slow");
			if (jQuery("#wp-uxEmailTemplate-wrap").hasClass("tmce-active"))
			{
				jQuery("#uxEmailTemplate_hidden").val(tinyMCE.get("uxEmailTemplate").getContent());
			}
			else
			{
				jQuery("#uxEmailTemplate_hidden").val(jQuery("#uxEmailTemplate").val());
			}
			jQuery.post(ajaxurl,
			{
				data: base64_encode_contact_bank(jQuery(form).serialize()),
				email_id: email_id,
				form_id: form_id,
				param: "insert_email_controls",
				action: "email_contact_form_library"
			},
			function(data)
			{
				setTimeout(function()
				{
					jQuery("#email_success_message").css("display","none");
					window.location.href = "admin.php?page=contact_dashboard";
				}, 2000);
			});
		}
	});
	
        function show_send_to_div()
        {
                var ux_rdl_email = jQuery("#ux_rdl_email").prop("checked");
                if(ux_rdl_email == true)
                {
                        jQuery("#div_field").css("display","none");
                        jQuery("#div_email").css("display","block");
                }
                else
                {
                        jQuery("#div_email").css("display","none");
                        jQuery("#div_field").css("display","block");
                }
        }

        function append_control_shortcode(ddl_id,input_id)
        {
                var dynamicId = jQuery("#"+ddl_id).val();
                var label = jQuery("#"+ddl_id+" option:selected").text();
                if(dynamicId != "")
                {
                        var selected_fields = jQuery("#"+input_id).val();
                        var fields_shortCodes = selected_fields +"[control_"+dynamicId+"]";
                        jQuery("#"+input_id).val(fields_shortCodes);
                        jQuery("#"+ddl_id).val("");
                }
        }

        function append_add_control_shortcode(ddl_id)
        {
                var dynamicId = jQuery("#"+ddl_id).val();
                var label = jQuery("#"+ddl_id+" option:selected").text();
                if(dynamicId != "")
                {
                        if (jQuery("#wp-uxEmailTemplate-wrap").hasClass("tmce-active"))
                        {
                                var selected_fields  = tinyMCE.get("uxEmailTemplate").getContent();
                                var fields_shortCodes = "<strong>"+selected_fields+label +"</strong> : [control_"+dynamicId+"]<br />";
                                tinyMCE.get("uxEmailTemplate").setContent(fields_shortCodes);
                        }
                        else
                        {
                                var selected_fields  = jQuery("#uxEmailTemplate").val();
                                var fields_shortCodes = selected_fields+label +" : [control_"+dynamicId+"]<br />";
                                jQuery("#uxEmailTemplate").val(fields_shortCodes);
                        }
                        jQuery("#"+ddl_id).val("");
                }
        }
	
	jQuery(document).ready(function()
	{
		show_send_to_div();
	});
	</script>
<?php
}
?>
