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
		$control_id = $wpdb->get_var
		(
			$wpdb->prepare
			(
				"SELECT control_id FROM " .create_control_Table(). " where form_id= %d and field_id = %d and column_dynamicId = %d",
				$form_id,
				$field_type,
				$dynamicId
			)
		);
		if(count($control_id) != 0)
		{
			$form_data = $wpdb->get_results
			(
				$wpdb->prepare
				(
					"SELECT * FROM " .contact_bank_dynamic_settings_form(). " where dynamicId= %d",
					$control_id
				)
			);
			$form_settings[$dynamicId]["dynamic_id"] = $dynamicId;
			$form_settings[$dynamicId]["control_type"] = "1";
			for($flag = 0; $flag < count($form_data); $flag++)
			{
				$form_settings[$dynamicId][$form_data[$flag]->dynamic_settings_key] = esc_attr($form_data[$flag]->dynamic_settings_value);
			}
		}
		?>
		<form id="ux_frm_text_area_control" action="#" method="post" class="layout-form">
			<div class="fluid-layout">
				<div class="layout-span12">
					<div class="widget-layout">
						<div class="widget-layout-title">
							<h4><?php _e( "Paragraph Text", "contact-bank" ); ?></h4>
						</div>
						<div class="widget-layout-body">
							<div class="layout-control-group">
								<label class="layout-control-label"><?php _e( "Label", "contact-bank" ); ?> :</label>
								<div class="layout-controls">
								<input value="<?php echo isset($form_settings[$dynamicId]["cb_label_value"])  ? esc_attr($form_settings[$dynamicId]["cb_label_value"]) :  _e( "Untitled", "contact-bank" ); ?>"
									onkeyup="enter_admin_label(<?php echo $dynamicId; ?>);" placeholder="<?php _e( "Enter label", "contact-bank");?>"
									type="text" class="layout-span12" id="ux_label_text_<?php echo $dynamicId; ?>"   name="ux_label_text_<?php echo $dynamicId; ?>"  />
								</div>
							</div>
							<div class="layout-control-group">
								<label class="layout-control-label"><?php _e("Description", "contact-bank"); ?> :</label>
								<div class="layout-controls">
									<textarea placeholder="<?php _e( "Enter  Description", "contact-bank");?>"
										class="layout-span12" id="ux_description_control_<?php echo $dynamicId; ?>"
										name="ux_description_control_<?php echo $dynamicId; ?>"  ><?php echo isset($form_settings[$dynamicId]["cb_description"]) ? esc_attr($form_settings[$dynamicId]["cb_description"]) : ""; ?></textarea>
								</div>
							</div>
							<div class="layout-control-group">
								<label class="layout-control-label"><?php _e( "Required", "contact-bank" ); ?> :</label>
								<div class="layout-controls" style="margin-top:7px;">
									<?php
										if(isset($form_settings[$dynamicId]["cb_control_required"]))
										{
											if(esc_attr($form_settings[$dynamicId]["cb_control_required"]) == "1")
											{
											?>
												<input type="radio" id="ux_required_control_<?php echo $dynamicId; ?>"
													name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="1" checked="checked" />
												<label style="vertical-align: text-bottom;">
													<?php _e( "Required", "contact-bank" ); ?>
												</label>
												<input type="radio" id="ux_required_<?php echo $dynamicId; ?>"
													name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="0"/>
												<label style="vertical-align: text-bottom;">
													<?php _e( "Not Required", "contact-bank" ); ?>
												</label>
											<?php
											}
											else if(esc_attr($form_settings[$dynamicId]["cb_control_required"]) == "0")
											{
												?>
												<input type="radio" id="ux_required_control_<?php echo $dynamicId; ?>"
													name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="1" />
												<label style="vertical-align: text-bottom;">
													<?php _e( "Required", "contact-bank" ); ?>
												</label>
												<input type="radio" id="ux_required_<?php echo $dynamicId; ?>"
													name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="0" checked="checked" />
												<label style="vertical-align: text-bottom;">
													<?php _e( "Not Required", "contact-bank" ); ?>
												</label>
											<?php
											}
										}
										else
										{
											?>
												<input type="radio" id="ux_required_control_<?php echo $dynamicId; ?>"
													name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="1" />
												<label style="vertical-align: text-bottom;">
													<?php _e( "Required", "contact-bank" ); ?>
												</label>
												<input type="radio" id="ux_required_<?php echo $dynamicId; ?>"
													name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="0" checked="checked" />
												<label style="vertical-align: text-bottom;">
													<?php _e( "Not Required", "contact-bank" ); ?>
												</label>
											<?php
										}
									?>
								</div>
							</div>
							<div class="layout-control-group">
								<label  class="layout-control-label"><?php _e("Tooltip text", "contact-bank"); ?> :</label>
								<div class="layout-controls">
									<input placeholder="<?php _e( "This Feature is only available in Premium Editions!", "contact-bank" ); ?>" type="text"
										class="layout-span12" id="ux_tooltip_control_<?php echo $dynamicId; ?>"
										name="ux_tooltip_control_<?php echo $dynamicId; ?>"
										readonly="readonly"/>
								</div>
							</div>
							<div class="layout-control-group">
								<label class="layout-control-label"><?php _e( "Place Holder", "contact-bank" ); ?> :</label>
								<div class="layout-controls">
									<input placeholder="<?php _e( "Enter Place Holder", "contact-bank");?>" class="layout-span12"
										type="text" id="ux_default_value_<?php echo $dynamicId; ?>"  name="ux_default_value_<?php echo $dynamicId; ?>"
										value="<?php echo isset($form_settings[$dynamicId]["cb_default_txt_val"]) ? esc_attr($form_settings[$dynamicId]["cb_default_txt_val"]) : ""; ?>"/>
								</div>
							</div>
							<div class="layout-control-group">
								<label class="layout-control-label"><?php _e( "Admin Label", "contact-bank" ); ?> : </label>
								<div class="layout-controls">
									<input value="<?php echo isset($form_settings[$dynamicId]["cb_admin_label"])  ? esc_attr($form_settings[$dynamicId]["cb_admin_label"]) :  _e( "Untitled", "contact-bank" ); ?>"
										placeholder="<?php _e( "Enter Admin Label", "contact-bank");?>" class="layout-span12" type="text" id="ux_admin_label_<?php echo $dynamicId; ?>" name="ux_admin_label_<?php echo $dynamicId; ?>" />
								</div>
							</div>
							<div class="layout-control-group">
								<label class="layout-control-label"><?php _e( "Do not show in the email", "contact-bank" ); ?> : </label>
								<div class="layout-controls">
									<?php
									if(isset($form_settings[$dynamicId]["cb_show_email"]))
									{
										if(esc_attr($form_settings[$dynamicId]["cb_show_email"]) == "1")
										{
										?>
											<input type="checkbox" checked="checked"  id="ux_show_email_<?php echo $dynamicId; ?>"
												name="ux_show_email_<?php echo $dynamicId; ?>" style="margin-top: 10px;" value="1">
										<?php
										}
										else
										{
										?>
											<input type="checkbox" id="ux_show_email_<?php echo $dynamicId; ?>"
												name="ux_show_email_<?php echo $dynamicId; ?>" style="margin-top: 10px;" value="0">
										<?php
										}
									}
									else
									{
										?>
										<input type="checkbox" id="ux_show_email_<?php echo $dynamicId; ?>"
											name="ux_show_email_<?php echo $dynamicId; ?>" style="margin-top: 10px;" value="0">
									<?php
									}
									?>
								</div>
							</div>
							<div class="layout-control-group">
							<label class="layout-control-label" style="padding-top: 5px"><?php _e( "Add a filter", "contact-bank" ); ?> :</label>
							<div class="layout-controls" style="padding-top:5px;">
   								<input type="checkbox" value="0" id="ux_checkbox_alpha_filter" name="ux_checkbox_alpha_filter"/>
								<span class="rdl"><?php _e( "Alpha", "contact-bank" ); ?></span>

								<input type="checkbox"  id="ux_checkbox_alpha_num_filter" name="ux_checkbox_alpha_num_filter"  value="0" />
								<span class="rdl"><?php _e( "Alpha Numeric", "contact-bank" ); ?></span>

								<input type="checkbox"  value="0"  id="ux_checkbox_digit_filter" name="ux_checkbox_digit_filter"  value="Digits" />
								<span class="rdl"><?php _e( "Digits", "contact-bank" ); ?></span>

								<input type="checkbox" id="ux_checkbox_strip_tag_filter" name="ux_checkbox_strip_tag_filter"  value="0"  />
								<span class="rdl"><?php _e( "Strip Tags", "contact-bank" ); ?></span>

								<input type="checkbox" id="ux_checkbox_trim_filter" name="ux_checkbox_trim_filter"  value="0" />
								<span class="rdl"><?php _e( "Trim", "contact-bank" ); ?></span>
								<br>
								 <i class="widget_premium_feature_contact"><?php _e(" (Available in Premium Editions)", "contact-bank"); ?></i>
							</div>
						</div>
							<input type="hidden" id="ux_hd_textbox_dynamic_id" name="ux_hd_textbox_dynamic_id" value="<?php echo $dynamicId; ?>"/>
						</div>
					</div>
					<div class="layout-control-group">
						<input type="submit" class="btn btn-info layout-span3" value="<?php _e( "Save Settings", "contact-bank" ); ?>" />
					</div>
				</div>
			</div>
		</form>
		<a class="closeButtonLightbox" onclick="CloseLightbox();"></a>
		<script type="text/javascript">
			jQuery(".hovertip").tooltip_tip({placement: "left"});
			
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
			
			var dynamicId = "<?php echo $dynamicId; ?>";
			var controlId = "<?php echo $control_id; ?>";
			jQuery("#ux_frm_text_area_control").validate
			({
				submitHandler: function(form)
				{
					jQuery.post(ajaxurl,
					{
						data: base64_encode_contact_bank(jQuery(form).serialize()),
						controlId: controlId,
						form_id: form_id,
						form_settings: JSON.stringify(<?php echo json_encode($form_settings) ?>),
						events: "update",
						param: "save_textarea_control",
						action: "add_contact_form_library",
					},
					function(data)
					{
						jQuery("#control_label_"+dynamicId).html(jQuery("#ux_label_text_"+dynamicId).val()+" :");
						jQuery("#txt_description_"+dynamicId).html(jQuery("#ux_description_control_"+dynamicId).val());
						jQuery("#ux_textarea_control_"+dynamicId).attr("placeholder",jQuery("#ux_default_value_"+dynamicId).val());
						jQuery("#show_tooltip"+dynamicId).attr("data-original-title",jQuery("#ux_tooltip_control_"+dynamicId).val());
						if(jQuery("#ux_required_control_"+dynamicId).prop("checked") == true)
						{
							 jQuery("#control_label_"+dynamicId).append("<span class=\"error_field\">*</span>");
						}
						CloseLightbox();
					});
				}
			});
			jQuery("#ux_checkbox_alpha_filter").attr("disabled","disabled");
			jQuery("#ux_checkbox_alpha_num_filter").attr("disabled","disabled");
			jQuery("#ux_checkbox_digit_filter").attr("disabled","disabled");
			jQuery("#ux_checkbox_strip_tag_filter").attr("disabled","disabled");
			jQuery("#ux_checkbox_trim_filter").attr("disabled","disabled");
		</script>
<?php
}
?>
