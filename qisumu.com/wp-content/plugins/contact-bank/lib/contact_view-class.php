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
if(!current_user_can($cb_user_role_permission))
{
	return;
}
else
{
	if(isset($_REQUEST["param"]))
	{
		
                class class_installed_plugin_info_contact_bank
                {
                        function get_plugin_info()
                        {
                                $active_plugins = (array)get_option("active_plugins", array());
                                if (is_multisite())
                                $active_plugins = array_merge($active_plugins, get_site_option("active_sitewide_plugins", array()));
                                $plugins = array();
                                if(count($active_plugins) > 0)
                                {
                                        $get_plugins = array();
                                        foreach ($active_plugins as $plugin)
                                        {
                                                $plugin_data = @get_plugin_data(WP_PLUGIN_DIR . "/" . $plugin);

                                                $get_plugins["plugin_name"] = strip_tags($plugin_data["Name"]);
                                                $get_plugins["plugin_author"] = strip_tags($plugin_data["Author"]);
                                                $get_plugins["plugin_version"] = strip_tags($plugin_data["Version"]);
                                                array_push($plugins,$get_plugins);
                                        }
                                        return $plugins;
                                }
                        }
                }
		
		switch(esc_attr($_REQUEST["param"]))
		{
			case "wizard_contact" :
				if(wp_verify_nonce((isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : ""), "contact_bank_check_status"))
				{
                                    $type = isset($_REQUEST["type"]) ? esc_attr($_REQUEST["type"]) : "";
					update_option("contact-bank-wizard", $type);
                                        if($type == "opt_in")
                                        {
                                                $class_installed_plugin_info_contact_bank = new class_installed_plugin_info_contact_bank();
                                                global $wp_version;
                                                
                                                $theme_details = array();
                                                if($wp_version >= 3.4)
                                                {
                                                        $active_theme = wp_get_theme();
                                                        $theme_details["theme_name"] = strip_tags($active_theme->Name);
                                                        $theme_details["theme_version"] = strip_tags($active_theme->Version);
                                                        $theme_details["author_url"] = strip_tags($active_theme->{"Author URI"});
                                                }
                                                $plugin_stat_data = array();
                                                $plugin_stat_data["plugin_slug"] = "contact-bank";
                                                $plugin_stat_data["type"] = "standard_edition";
                                                $plugin_stat_data["version_number"] = contact_bank_version_number;
                                                $plugin_stat_data["status"] = $type;
                                                $plugin_stat_data["event"] = "activate";
                                                $plugin_stat_data["domain_url"] = site_url();
                                                $plugin_stat_data["wp_language"] = defined("WPLANG") && WPLANG ? WPLANG : get_locale();
                                                $plugin_stat_data["email"] = get_option("admin_email");
                                                $plugin_stat_data["wp_version"] = $wp_version;
                                                $plugin_stat_data["php_version"] = esc_html(phpversion());
                                                $plugin_stat_data["mysql_version"] = $wpdb->db_version();
                                                $plugin_stat_data["max_input_vars"] = ini_get("max_input_vars");
                                                $plugin_stat_data["operating_system"] =  PHP_OS ."  (".PHP_INT_SIZE * 8 .") BIT";
                                                $plugin_stat_data["php_memory_limit"] = ini_get("memory_limit")  ? ini_get("memory_limit") : "N/A";
                                                $plugin_stat_data["extensions"] = get_loaded_extensions();
                                                $plugin_stat_data["plugins"] = $class_installed_plugin_info_contact_bank->get_plugin_info();
                                                $plugin_stat_data["themes"] = $theme_details;
                                                $url = tech_banker_stats_url. "/wp-admin/admin-ajax.php";
                                                $response = wp_safe_remote_post($url, array
                                                (
                                                        "method" => "POST",
                                                        "timeout" => 45,
                                                        "redirection" => 5,
                                                        "httpversion" => "1.0",
                                                        "blocking" => true,
                                                        "headers" => array(),
                                                        "body" => array( "data" => serialize($plugin_stat_data), "site_id" => get_option("contact_bank_site_id") != "" ? get_option("contact_bank_site_id") : "","action"=>"plugin_analysis_data")
                                                ));
                                               
                                                if(!is_wp_error($response))
                                                {
                                                    
                                                        $response["body"] != "" ? update_option("contact_bank_site_id", $response["body"]) : "";
                                                }
                                                
                                        }
				}
			break;

			case "add_settings_div":
				$dynamicId = isset($_REQUEST["dynamicId"]) ? intval($_REQUEST["dynamicId"]) : 0;
				$field_type = isset($_REQUEST["field_type"]) ? intval($_REQUEST["field_type"]) : 0;
				$form_id = isset($_REQUEST["form_id"]) ? intval($_REQUEST["form_id"]) : 0;
				switch($field_type)
				{
					case 1:
						include_once CONTACT_BK_PLUGIN_DIR ."/includes/cb_text.php";
					break;
					case 2:
						include_once CONTACT_BK_PLUGIN_DIR ."/includes/cb_textarea.php";
					break;
					case 3:
						include_once CONTACT_BK_PLUGIN_DIR ."/includes/cb_email.php";
					break;
					case 4:
						include_once CONTACT_BK_PLUGIN_DIR ."/includes/cb_dropdown.php";
					break;
					case 5:
						include_once CONTACT_BK_PLUGIN_DIR ."/includes/cb_checkbox.php";
					break;
					case 6:
						include_once CONTACT_BK_PLUGIN_DIR ."/includes/cb_multiple.php";
						break;
				}
			break;

			case "delete_form":
				$form_id = isset($_REQUEST["id"]) ? intval($_REQUEST["id"]) : 0;
				$control_id = $wpdb->get_results
				(
					$wpdb->prepare
					(
						"SELECT control_id FROM " .create_control_Table()." WHERE form_id = %d ",
						$form_id
					)
				);
				$sql = array();
				if(count($control_id) != 0)
				{
					for($flag =0;$flag<count($control_id);$flag++)
					{
						$dynamic_Id = intval($control_id[$flag]->control_id);
						$sql[] = $dynamic_Id;
					}
					$wpdb->query
					(
						$wpdb->prepare
						(
							"DELETE FROM " .contact_bank_dynamic_settings_form()." WHERE dynamicId IN (".implode(',', $sql).")",""
						)
					);
				}
				$wpdb->query
				(
					$wpdb->prepare
					(
						"DELETE FROM " .contact_bank_email_template_admin()." WHERE form_id = %d ",
						$form_id
					)
				);
				$wpdb->query
				(
					$wpdb->prepare
					(
						"DELETE FROM " .contact_bank_form_settings_Table()." WHERE form_id = %d ",
						$form_id
					)
				);
				$wpdb->query
				(
					$wpdb->prepare
					(
						"DELETE FROM " .frontend_controls_data_Table()." WHERE form_id = %d ",
						$form_id
					)
				);
				$wpdb->query
				(
					$wpdb->prepare
					(
						"DELETE FROM " .contact_bank_frontend_forms_Table()." WHERE form_id = %d ",
						$form_id
					)
				);
				$wpdb->query
				(
					$wpdb->prepare
					(
						"DELETE FROM " .contact_bank_layout_settings_Table()." WHERE form_id = %d ",
						$form_id
					)
				);
				$wpdb->query
				(
					$wpdb->prepare
					(
						"DELETE FROM " .create_control_Table()." WHERE form_id = %d ",
						$form_id
					)
				);
				$wpdb->query
				(
					$wpdb->prepare
					(
						"DELETE FROM " .contact_bank_contact_form()." WHERE form_id = %d ",
						$form_id
					)
				);

			break;

			case "delete_forms":

				global $wpdb;
				$wpdb->query
				(
					"TRUNCATE Table ".contact_bank_dynamic_settings_form()
				);
				$wpdb->query
				(
					"TRUNCATE Table ".contact_bank_email_template_admin()
				);
				$wpdb->query
				(
					"TRUNCATE Table ".contact_bank_form_settings_Table()
				);
				$wpdb->query
				(
					"TRUNCATE Table ".frontend_controls_data_Table()
				);
				$wpdb->query
				(
					"TRUNCATE Table ".contact_bank_frontend_forms_Table()
				);
				$wpdb->query
				(
					"TRUNCATE Table ".contact_bank_layout_settings_Table()
				);
				$wpdb->query
				(
					"TRUNCATE Table ".create_control_Table()
				);
				$wpdb->query
				(
					"TRUNCATE Table ".contact_bank_contact_form()
				);

			break;

			case "submit_form_messages_settings":

					$sql1 = array();
					$form_settings_data = array();
					$form_id = isset($_REQUEST["form_id"]) ? intval($_REQUEST["form_id"]) : 0;
					parse_str(isset($_REQUEST["form_settings"]) ? base64_decode($_REQUEST["form_settings"]) : "",$form_settings);
					$form_settings_data["blank_field_message"] = esc_html($form_settings["ux_txt_blank_message"]);
					$form_settings_data["incorrect_email_message"] = esc_html($form_settings["ux_txt_incorrect_email_message"]);
					$form_settings_data["success_message"] = esc_html($form_settings["ux_txt_success_message"]);
					$form_settings_data["form_description"] = esc_html($form_settings["ux_txt_form_description"]);
					$form_settings_data["redirect"] = esc_html($form_settings["ux_rdl_redirect"]);
					$form_settings_data["redirect_url"] = $form_settings["ux_rdl_redirect"] == "0" ? esc_html($form_settings["ux_ddl_page_url"]) : esc_html($form_settings["ux_txt_redirect_url"]);
					$form_settings_data["form_name"] = esc_html($form_settings["ux_txt_form_name"]);

					$array_delete_form_controls = json_decode(stripcslashes($_REQUEST["array_delete_form_controls"]),true);
					foreach($array_delete_form_controls as $element)
					{
						$sql1[] = $element;
					}
					if(count($sql1) > 0)
					{
						$wpdb->query
						(
							$wpdb->prepare
							(
								"Delete FROM " . contact_bank_dynamic_settings_form() . " where dynamicId in (".implode(',', $sql1).")",
								""
							)
						);
						$wpdb->query
						(
							$wpdb->prepare
							(
								"Delete FROM " . create_control_Table() . " where control_id in (".implode(',', $sql1).")",""
							)
						);
					}
					foreach($form_settings_data as $element => $value)
					{
						if($element == "form_name")
						{
							$wpdb->query
							(
								$wpdb->prepare
								(
									"UPDATE " . contact_bank_contact_form() . " SET `form_name` = %s where form_id = %d ",
									$value,
									$form_id
								)
							);
						}
						else
						{
							$wpdb->query
							(
								$wpdb->prepare
								(
									"UPDATE " . contact_bank_form_settings_Table() . " SET `form_message_value` = %s where form_message_key = %s and form_id = %d ",
									$value,
									$element,
									$form_id
								)
							);
						}
					}
					$fields_created = $wpdb->get_results
					(
						$wpdb->prepare
						(
							"SELECT dynamicId, dynamic_settings_value,field_id	FROM ". contact_bank_dynamic_settings_form(). " JOIN " . create_control_Table(). " ON " . contact_bank_dynamic_settings_form().". dynamicId  = ". create_control_Table(). ".control_id WHERE `dynamic_settings_key` = 'cb_admin_label' and form_id = %d and field_id != %d and field_id != %d Order By ".create_control_Table().".sorting_order",
							$form_id,
							9,
							17
						)
					);
					$controls = "";
					$email_dynamicId = "";
					for($flag=0;$flag<count($fields_created);$flag++)
					{
						$show_in_email = $wpdb->get_var
						(
							$wpdb->prepare
							(
								"SELECT dynamic_settings_value FROM ". contact_bank_dynamic_settings_form(). " WHERE `dynamic_settings_key` = 'cb_show_email' and dynamicId = %d",
								intval($fields_created[$flag]->dynamicId)
							)
						);
						if($show_in_email == "0")
						{
							$controls .= "<strong>".esc_attr($fields_created[$flag]->dynamic_settings_value) ."</strong>: ". "[control_".intval($fields_created[$flag]->dynamicId)."] <br>";
						}
						if($fields_created[$flag]->field_id == 3)
						{
							$email_dynamicId = intval($fields_created[$flag]->dynamicId);
						}
					}
					$body_message = "Hello Admin,<br><br>
					A new user visited your website.<br><br>
					Here are the details :<br><br>
					".$controls."
					<br>Thanks,<br><br>
					<strong>Technical Support Team</strong>";
					$wpdb->query
					(
						$wpdb->prepare
						(

							"UPDATE " . contact_bank_email_template_admin() . " SET `body_content` = %s where form_id = %d and name = %s",
							$body_message,
							$form_id,
							"Admin Notification"
						)
					);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"UPDATE " . contact_bank_email_template_admin() . " SET `email_to` = %s where form_id = %d and name = %s",
							"[control_".$email_dynamicId."]",
							$form_id,
							"Client Notification"
						)
					);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"UPDATE " . contact_bank_email_template_admin() . " SET `send_to` = %d where form_id = %d and name = %s",
							1,
							$form_id,
							"Client Notification"
						)
					);
			break;

			case "save_text_control":

					$form_id = isset($_REQUEST["form_id"]) ? intval($_REQUEST["form_id"]) : 0;
					$event = isset($_REQUEST["events"]) ? esc_attr($_REQUEST["events"]) : "";
					$controlId = isset($_REQUEST["controlId"]) ? intval($_REQUEST["controlId"]) : 0;
					if(isset($_REQUEST["data"]))
					{
						parse_str(base64_decode($_REQUEST["data"]),$form_settings_data);
						$dynamic_Id = intval($form_settings_data["ux_hd_textbox_dynamic_id"]);
					}
					else
					{
						$dynamic_Id = isset($_REQUEST["ux_hd_textbox_dynamic_id"]) ? intval($_REQUEST["ux_hd_textbox_dynamic_id"]) : 0;
					}
					$form_settings = isset($_REQUEST["form_settings"]) ? json_decode(stripcslashes($_REQUEST["form_settings"]),true) : array();
					$form_settings[$dynamic_Id]["dynamic_id"] = $dynamic_Id;
					$form_settings[$dynamic_Id]["control_type"] = "1";
					$form_settings[$dynamic_Id]["cb_label_value"] = isset($form_settings_data["ux_label_text_".$dynamic_Id]) ? esc_html($form_settings_data["ux_label_text_".$dynamic_Id]) : "Untitled";
					$form_settings[$dynamic_Id]["cb_description"] = isset($form_settings_data["ux_description_control_".$dynamic_Id]) ? esc_html($form_settings_data["ux_description_control_".$dynamic_Id]) : "";
					$form_settings[$dynamic_Id]["cb_control_required"] = isset($form_settings_data["ux_required_control_radio_".$dynamic_Id]) ? esc_html($form_settings_data["ux_required_control_radio_".$dynamic_Id]) : "0";
					$form_settings[$dynamic_Id]["cb_tooltip_txt"] = isset($form_settings_data["ux_tooltip_control_".$dynamic_Id]) ? esc_html($form_settings_data["ux_tooltip_control_".$dynamic_Id]) : "";
					$form_settings[$dynamic_Id]["cb_default_txt_val"] = isset($form_settings_data["ux_default_value_".$dynamic_Id]) ? esc_html($form_settings_data["ux_default_value_".$dynamic_Id]) : "";
					$form_settings[$dynamic_Id]["cb_admin_label"] = isset($form_settings_data["ux_admin_label_".$dynamic_Id]) ? esc_html($form_settings_data["ux_admin_label_".$dynamic_Id]) : "Untitled";
					$form_settings[$dynamic_Id]["cb_show_email"] = isset($form_settings_data["ux_show_email_".$dynamic_Id]) ? "1" : "0";
					$form_settings[$dynamic_Id]["cb_checkbox_alpha_filter"] = isset($form_settings_data["ux_checkbox_alpha_filter_".$dynamic_Id]) ? "1" : "0";
					$form_settings[$dynamic_Id]["cb_ux_checkbox_alpha_num_filter"] = isset($form_settings_data["ux_checkbox_alpha_num_filter_".$dynamic_Id]) ? "1" : "0";
					$form_settings[$dynamic_Id]["cb_checkbox_digit_filter"] = isset($form_settings_data["ux_checkbox_digit_filter_".$dynamic_Id]) ? "1" : "0";
					$form_settings[$dynamic_Id]["cb_checkbox_strip_tag_filter"] = isset($form_settings_data["ux_checkbox_strip_tag_filter_".$dynamic_Id]) ? "1" : "0";
					$form_settings[$dynamic_Id]["cb_checkbox_trim_filter"] = isset($form_settings_data["ux_checkbox_trim_filter_".$dynamic_Id]) ? "1" : "0";

					foreach($form_settings as $element)
					{
						$id = $element["dynamic_id"];
						$control_type = $element["control_type"];
						if($event == "add")
						{
							$wpdb->query
							(
								$wpdb->prepare
								(
									"INSERT INTO " . create_control_Table() . "(form_id,field_id,column_dynamicId) VALUES(%d,%d,%d)",
									$form_id,
									$control_type,
									$id
								)
							);
							echo $dynamic_control_id=$wpdb->insert_id;
							$wpdb->query
							(
								$wpdb->prepare
								(
									"UPDATE " . create_control_Table() . " SET `sorting_order` = %d where form_id = %d and field_id = %d and column_dynamicId = %d",
									$dynamic_control_id,
									$form_id,
									$control_type,
									$id
								)
							);
						}
						foreach($element as $key => $value)
						{
							if($key == "dynamic_id" || $key == "control_type")
							{
								continue;
							}
							else
							{
								if($event == "add")
								{
									$wpdb->query
									(
										$wpdb->prepare
										(
											"INSERT INTO " . contact_bank_dynamic_settings_form() . "(dynamicId,dynamic_settings_key,dynamic_settings_value) VALUES (%d,%s,%s)",
											$dynamic_control_id,
											$key,
											$value
										)
									);
								}
								else
								{
									$wpdb->query
		 							(
		 								$wpdb->prepare
	 									(
	 										"UPDATE " . contact_bank_dynamic_settings_form() . " SET `dynamic_settings_value` = %s where dynamic_settings_key = %s and dynamicId = %d ",
											$value,
											$key,
											$controlId
	 									)
		 							);
								}
							}
						}
					}
				break;

				case "save_textarea_control":

					$form_id = isset($_REQUEST["form_id"]) ? intval($_REQUEST["form_id"]) : 0;
					$event = isset($_REQUEST["events"]) ? esc_attr($_REQUEST["events"]) : "";
					$controlId = isset($_REQUEST["controlId"]) ? intval($_REQUEST["controlId"]) : 0;
					if(isset($_REQUEST["data"]))
					{
						parse_str(base64_decode($_REQUEST["data"]),$form_settings_data);
						$dynamic_Id = intval($form_settings_data["ux_hd_textbox_dynamic_id"]);
					}
					else
					{
						$dynamic_Id = isset($_REQUEST["ux_hd_textbox_dynamic_id"]) ? intval($_REQUEST["ux_hd_textbox_dynamic_id"]) : 0;
					}
					$form_settings = isset($_REQUEST["form_settings"]) ? json_decode(stripcslashes($_REQUEST["form_settings"]),true) : array();
					$form_settings[$dynamic_Id]["dynamic_id"] = $dynamic_Id;
					$form_settings[$dynamic_Id]["control_type"] = "2";
					$form_settings[$dynamic_Id]["cb_label_value"] = isset($form_settings_data["ux_label_text_".$dynamic_Id]) ? esc_html($form_settings_data["ux_label_text_".$dynamic_Id]) : "Untitled";
					$form_settings[$dynamic_Id]["cb_description"] = isset($form_settings_data["ux_description_control_".$dynamic_Id]) ? esc_html($form_settings_data["ux_description_control_".$dynamic_Id]) : "";
					$form_settings[$dynamic_Id]["cb_control_required"] = isset($form_settings_data["ux_required_control_radio_".$dynamic_Id]) ? esc_html($form_settings_data["ux_required_control_radio_".$dynamic_Id]) : "0";
					$form_settings[$dynamic_Id]["cb_tooltip_txt"] = isset($form_settings_data["ux_tooltip_control_".$dynamic_Id]) ? esc_html($form_settings_data["ux_tooltip_control_".$dynamic_Id]) : "";
					$form_settings[$dynamic_Id]["cb_default_txt_val"] = isset($form_settings_data["ux_default_value_".$dynamic_Id]) ? esc_html($form_settings_data["ux_default_value_".$dynamic_Id]) : "";
					$form_settings[$dynamic_Id]["cb_admin_label"] = isset($form_settings_data["ux_admin_label_".$dynamic_Id]) ? esc_html($form_settings_data["ux_admin_label_".$dynamic_Id]) : "Untitled";
					$form_settings[$dynamic_Id]["cb_show_email"] = isset($form_settings_data["ux_show_email_".$dynamic_Id]) ? "1" : "0";
					$form_settings[$dynamic_Id]["cb_checkbox_alpha_filter"] = isset($form_settings_data["ux_checkbox_alpha_filter_".$dynamic_Id]) ? "1" : "0";
					$form_settings[$dynamic_Id]["cb_ux_checkbox_alpha_num_filter"] = isset($form_settings_data["ux_checkbox_alpha_num_filter_".$dynamic_Id]) ? "1" : "0";
					$form_settings[$dynamic_Id]["cb_checkbox_digit_filter"] = isset($form_settings_data["ux_checkbox_digit_filter_".$dynamic_Id]) ? "1" : "0";
					$form_settings[$dynamic_Id]["cb_checkbox_strip_tag_filter"] = isset($form_settings_data["ux_checkbox_strip_tag_filter_".$dynamic_Id]) ? "1" : "0";
					$form_settings[$dynamic_Id]["cb_checkbox_trim_filter"] = isset($form_settings_data["ux_checkbox_trim_filter_".$dynamic_Id]) ? "1" : "0";

					foreach($form_settings as $element)
					{
						$id = $element["dynamic_id"];
						$control_type = $element["control_type"];
						if($event == "add")
						{
							$wpdb->query
							(
								$wpdb->prepare
								(
									"INSERT INTO " . create_control_Table() . "(form_id,field_id,column_dynamicId) VALUES(%d,%d,%d)",
									$form_id,
									$control_type,
									$id
								)
							);
							echo $dynamic_control_id=$wpdb->insert_id;
							$wpdb->query
							(
								$wpdb->prepare
								(
									"UPDATE " . create_control_Table() . " SET `sorting_order` = %d where form_id = %d and field_id = %d and column_dynamicId = %d",
									$dynamic_control_id,
									$form_id,
									$control_type,
									$id
								)
							);
						}
						foreach($element as $key => $value)
						{
							if($key == "dynamic_id" || $key == "control_type")
							{
								continue;
							}
							else
							{
								if($event == "add")
								{
									$wpdb->query
									(
										$wpdb->prepare
										(
											"INSERT INTO " . contact_bank_dynamic_settings_form() . "(dynamicId,dynamic_settings_key,dynamic_settings_value) VALUES (%d,%s,%s)",
											$dynamic_control_id,
											$key,
											$value
										)
									);
								}
								else
								{
									$wpdb->query
		 							(
		 								$wpdb->prepare
		 									(
		 										"UPDATE " . contact_bank_dynamic_settings_form() . " SET `dynamic_settings_value` = %s where dynamic_settings_key = %s and dynamicId = %d ",
												$value,
												$key,
												$controlId
		 									)
		 							);
								}
							}
						}
					}
				break;

				case "save_email_control":

					$form_id = isset($_REQUEST["form_id"]) ? intval($_REQUEST["form_id"]) : 0;
					$event = isset($_REQUEST["events"]) ? esc_attr($_REQUEST["events"]) : "";
					$controlId = isset($_REQUEST["controlId"]) ? intval($_REQUEST["controlId"]) : 0;
					if(isset($_REQUEST["data"]))
					{
						parse_str(base64_decode($_REQUEST["data"]),$form_settings_data);
						$dynamic_Id = intval($form_settings_data["ux_hd_textbox_dynamic_id"]);
					}
					else
					{
						$dynamic_Id = isset($_REQUEST["ux_hd_textbox_dynamic_id"]) ? intval($_REQUEST["ux_hd_textbox_dynamic_id"]) : 0;
					}
					$form_settings = isset($_REQUEST["form_settings"]) ? json_decode(stripcslashes($_REQUEST["form_settings"]),true) : array();
					$form_settings[$dynamic_Id]["dynamic_id"] = $dynamic_Id;
					$form_settings[$dynamic_Id]["control_type"] = "3";
					$form_settings[$dynamic_Id]["cb_label_value"] = isset($form_settings_data["ux_label_text_".$dynamic_Id]) ? esc_html($form_settings_data["ux_label_text_".$dynamic_Id]) : "Email";
					$form_settings[$dynamic_Id]["cb_description"] = isset($form_settings_data["ux_description_control_".$dynamic_Id]) ? esc_html($form_settings_data["ux_description_control_".$dynamic_Id]) : "";
					$form_settings[$dynamic_Id]["cb_control_required"] = isset($form_settings_data["ux_required_control_radio_".$dynamic_Id]) ? esc_html($form_settings_data["ux_required_control_radio_".$dynamic_Id]) : "1";
					$form_settings[$dynamic_Id]["cb_tooltip_txt"] = isset($form_settings_data["ux_tooltip_control_".$dynamic_Id]) ? esc_html($form_settings_data["ux_tooltip_control_".$dynamic_Id]) : "";
					$form_settings[$dynamic_Id]["cb_default_txt_val"] = isset($form_settings_data["ux_default_value_".$dynamic_Id]) ? esc_html($form_settings_data["ux_default_value_".$dynamic_Id]) : "";
					$form_settings[$dynamic_Id]["cb_admin_label"] = isset($form_settings_data["ux_default_value_".$dynamic_Id]) ? esc_html($form_settings_data["ux_admin_label_".$dynamic_Id]) : "Email";
					$form_settings[$dynamic_Id]["cb_show_email"] = isset($form_settings_data["ux_show_email_".$dynamic_Id]) ? "1" : "0";

					foreach($form_settings as $element)
					{
						$id = $element["dynamic_id"];
						$control_type = $element["control_type"];
						if($event == "add")
						{
						$wpdb->query
							(
								$wpdb->prepare
								(
									"INSERT INTO " . create_control_Table() . "(form_id,field_id,column_dynamicId) VALUES(%d,%d,%d)",
									$form_id,
									$control_type,
									$id
								)
							);
							echo $dynamic_control_id=$wpdb->insert_id;
							$wpdb->query
							(
								$wpdb->prepare
								(
									"UPDATE " . create_control_Table() . " SET `sorting_order` = %d where form_id = %d and field_id = %d and column_dynamicId = %d",
									$dynamic_control_id,
									$form_id,
									$control_type,
									$id
								)
							);
						}
						foreach($element as $key => $value)
						{
							if($key == "dynamic_id" || $key == "control_type")
							{
								continue;
							}
							else
							{
								if($event == "add")
								{
									$wpdb->query
									(
										$wpdb->prepare
										(
											"INSERT INTO " . contact_bank_dynamic_settings_form() . "(dynamicId,dynamic_settings_key,dynamic_settings_value) VALUES (%d,%s,%s)",
											$dynamic_control_id,
											$key,
											$value
										)
									);
								}
								else
								{
									$wpdb->query
		 							(
		 								$wpdb->prepare
		 									(
		 										"UPDATE " . contact_bank_dynamic_settings_form() . " SET `dynamic_settings_value` = %s where dynamic_settings_key = %s and dynamicId = %d ",
												$value,
												$key,
												$controlId
		 									)
		 							);
								}
							}
						}
					}
				break;

				case "save_drop_down_control":

					$form_id = isset($_REQUEST["form_id"]) ? intval($_REQUEST["form_id"]) : 0;
					$event = isset($_REQUEST["events"]) ? esc_attr($_REQUEST["events"]) : "";
					$controlId = isset($_REQUEST["controlId"]) ? intval($_REQUEST["controlId"]) : 0;
					if(isset($_REQUEST["data"]))
					{
						parse_str(base64_decode($_REQUEST["data"]),$form_settings_data);
						$dynamic_Id = intval($form_settings_data["ux_hd_textbox_dynamic_id"]);
					}
					else
					{
						$dynamic_Id = isset($_REQUEST["ux_hd_textbox_dynamic_id"]) ? intval($_REQUEST["ux_hd_textbox_dynamic_id"]) : 0;
					}

					$form_settings = isset($_REQUEST["form_settings"]) ? json_decode(stripcslashes($_REQUEST["form_settings"]),true) : array();
					$ddl_options_id = isset($_REQUEST["ddl_options_id"]) ? json_decode(stripcslashes($_REQUEST["ddl_options_id"]),true) : array();
					$options_value = isset($_REQUEST["options_value"]) ? json_decode(stripcslashes($_REQUEST["options_value"])) : array();

					$form_settings[$dynamic_Id]["dynamic_id"] = $dynamic_Id;
					$form_settings[$dynamic_Id]["control_type"] = "4";
					$form_settings[$dynamic_Id]["cb_label_value"] = isset($form_settings_data["ux_label_text_".$dynamic_Id]) ? esc_html($form_settings_data["ux_label_text_".$dynamic_Id]) :"Untitled";
					$form_settings[$dynamic_Id]["cb_control_required"] = isset($form_settings_data["ux_required_control_radio_".$dynamic_Id]) ? esc_html($form_settings_data["ux_required_control_radio_".$dynamic_Id]) : "0";
					$form_settings[$dynamic_Id]["cb_tooltip_txt"] = isset($form_settings_data["ux_tooltip_control_".$dynamic_Id]) ? esc_html($form_settings_data["ux_tooltip_control_".$dynamic_Id]) : "";
					$form_settings[$dynamic_Id]["cb_admin_label"] = isset($form_settings_data["ux_admin_label_".$dynamic_Id]) ? esc_html($form_settings_data["ux_admin_label_".$dynamic_Id]) : "Untitled";
					$form_settings[$dynamic_Id]["cb_show_email"] = isset($form_settings_data["ux_show_email_".$dynamic_Id]) ? "1" : "0";

					$form_settings[$dynamic_Id]["cb_dropdown_option_id"] = serialize($ddl_options_id);
					$form_settings[$dynamic_Id]["cb_dropdown_option_val"] = serialize($options_value);

					foreach($form_settings as $element)
					{
						$id = $element["dynamic_id"];
						$control_type = $element["control_type"];
						if($event == "add")
						{
							$wpdb->query
							(
								$wpdb->prepare
								(
									"INSERT INTO " . create_control_Table() . "(form_id,field_id,column_dynamicId) VALUES(%d,%d,%d)",
									$form_id,
									$control_type,
									$id
								)
							);
							echo $dynamic_control_id=$wpdb->insert_id;
							$wpdb->query
							(
								$wpdb->prepare
								(
									"UPDATE " . create_control_Table() . " SET `sorting_order` = %d where form_id = %d and field_id = %d and column_dynamicId = %d",
									$dynamic_control_id,
									$form_id,
									$control_type,
									$id
								)
							);
						}
						foreach($element as $key => $value)
						{
							if($key == "dynamic_id" || $key == "control_type")
							{
								continue;
							}
							else
							{
								if($event == "add")
								{
									$wpdb->query
									(
										$wpdb->prepare
										(
											"INSERT INTO " . contact_bank_dynamic_settings_form() . "(dynamicId,dynamic_settings_key,dynamic_settings_value) VALUES (%d,%s,%s)",
											$dynamic_control_id,
											$key,
											$value
										)
									);
								}
								else
								{
									$wpdb->query
		 							(
		 								$wpdb->prepare
		 									(
		 										"UPDATE " . contact_bank_dynamic_settings_form() . " SET `dynamic_settings_value` = %s where dynamic_settings_key = %s and dynamicId = %d ",
												$value,
												$key,
												$controlId
		 									)
		 							);
								}
							}
						}
					}

				break;

				case "save_check_box_control":

					$form_id = isset($_REQUEST["form_id"]) ? intval($_REQUEST["form_id"]) : 0;
					$event = isset($_REQUEST["events"]) ? esc_attr($_REQUEST["events"]) : "";
					$controlId = isset($_REQUEST["controlId"]) ? intval($_REQUEST["controlId"]) : 0;
					if(isset($_REQUEST["data"]))
					{
						parse_str(base64_decode($_REQUEST["data"]),$form_settings_data);
						$dynamic_Id = intval($form_settings_data["ux_hd_textbox_dynamic_id"]);
					}
					else
					{
						$dynamic_Id = isset($_REQUEST["ux_hd_textbox_dynamic_id"]) ? intval($_REQUEST["ux_hd_textbox_dynamic_id"]) : 0;
					}
					$form_settings = isset($_REQUEST["form_settings"]) ? json_decode(stripcslashes($_REQUEST["form_settings"]),true) : array();
					$ddl_options_id = isset($_REQUEST["ddl_options_id"]) ? json_decode(stripcslashes($_REQUEST["ddl_options_id"]),true) : array();
					$options_value = isset($_REQUEST["options_value"]) ? json_decode(stripcslashes($_REQUEST["options_value"]),true) : array();
					$form_settings[$dynamic_Id]["dynamic_id"] = $dynamic_Id;
					$form_settings[$dynamic_Id]["control_type"] = "5";
					$form_settings[$dynamic_Id]["cb_label_value"] = isset($form_settings_data["ux_label_text_".$dynamic_Id]) ? esc_html($form_settings_data["ux_label_text_".$dynamic_Id]) : "Untitled";
					$form_settings[$dynamic_Id]["cb_control_required"] = isset($form_settings_data["ux_required_control_radio_".$dynamic_Id]) ? esc_html($form_settings_data["ux_required_control_radio_".$dynamic_Id]) : "0";
					$form_settings[$dynamic_Id]["cb_tooltip_txt"] = isset($form_settings_data["ux_tooltip_control_".$dynamic_Id]) ? esc_html($form_settings_data["ux_tooltip_control_".$dynamic_Id]) : "";
					$form_settings[$dynamic_Id]["cb_admin_label"] = isset($form_settings_data["ux_admin_label_".$dynamic_Id]) ? esc_html($form_settings_data["ux_admin_label_".$dynamic_Id]) : "Untitled";
					$form_settings[$dynamic_Id]["cb_show_email"] = isset($form_settings_data["ux_show_email_".$dynamic_Id]) ? "1" : "0";

					$form_settings[$dynamic_Id]["cb_checkbox_option_id"] = serialize($ddl_options_id);
					$form_settings[$dynamic_Id]["cb_checkbox_option_val"] = serialize($options_value);

					foreach($form_settings as $element)
					{
						$id = $element["dynamic_id"];
						$control_type = $element["control_type"];
						if($event == "add")
						{
							$wpdb->query
							(
								$wpdb->prepare
								(
									"INSERT INTO " . create_control_Table() . "(form_id,field_id,column_dynamicId) VALUES(%d,%d,%d)",
									$form_id,
									$control_type,
									$id
								)
							);
							echo $dynamic_control_id=$wpdb->insert_id;
							$wpdb->query
							(
								$wpdb->prepare
								(
									"UPDATE " . create_control_Table() . " SET `sorting_order` = %d where form_id = %d and field_id = %d and column_dynamicId = %d",
									$dynamic_control_id,
									$form_id,
									$control_type,
									$id
								)
							);
						}

						foreach($element as $key => $value)
						{
							if($key == "dynamic_id" || $key == "control_type")
							{
								continue;
							}
							else
							{
								if($event == "add")
								{
									$wpdb->query
									(
										$wpdb->prepare
										(
											"INSERT INTO " . contact_bank_dynamic_settings_form() . "(dynamicId,dynamic_settings_key,dynamic_settings_value) VALUES (%d,%s,%s)",
											$dynamic_control_id,
											$key,
											$value
										)
									);
								}
								else
								{
									$wpdb->query
		 							(
		 								$wpdb->prepare
		 									(
		 										"UPDATE " . contact_bank_dynamic_settings_form() . " SET `dynamic_settings_value` = %s where dynamic_settings_key = %s and dynamicId = %d ",
												$value,
												$key,
												$controlId
		 									)
		 							);
								}
							}
						}
					}

				break;

				case "save_multiple_control":

					$form_id = isset($_REQUEST["form_id"]) ? intval($_REQUEST["form_id"]) : 0;
					$event = isset($_REQUEST["events"]) ? esc_attr($_REQUEST["events"]) : "";
					$controlId = isset($_REQUEST["controlId"]) ? intval($_REQUEST["controlId"]) : 0;
					if(isset($_REQUEST["data"]))
					{
						parse_str(base64_decode($_REQUEST["data"]),$form_settings_data);
						$dynamic_Id = intval($form_settings_data["ux_hd_textbox_dynamic_id"]);
					}
					else
					{
						$dynamic_Id = isset($_REQUEST["ux_hd_textbox_dynamic_id"]) ? intval($_REQUEST["ux_hd_textbox_dynamic_id"]) : 0;
					}
					$form_settings = isset($_REQUEST["form_settings"]) ? json_decode(stripcslashes($_REQUEST["form_settings"]),true) : array();
					$ddl_options_id = isset($_REQUEST["ddl_options_id"]) ? json_decode(stripcslashes($_REQUEST["ddl_options_id"]),true) : array();
					$options_value = isset($_REQUEST["options_value"]) ? json_decode(stripcslashes($_REQUEST["options_value"]),true) : array();
					$form_settings[$dynamic_Id]["dynamic_id"] = $dynamic_Id;
					$form_settings[$dynamic_Id]["control_type"] = "6";
					$form_settings[$dynamic_Id]["cb_label_value"] = isset($form_settings_data["ux_label_text_".$dynamic_Id]) ? esc_html($form_settings_data["ux_label_text_".$dynamic_Id]) : "Untitled";
					$form_settings[$dynamic_Id]["cb_control_required"] = isset($form_settings_data["ux_required_control_radio_".$dynamic_Id]) ? esc_html($form_settings_data["ux_required_control_radio_".$dynamic_Id]) : "0";
					$form_settings[$dynamic_Id]["cb_tooltip_txt"] = isset($form_settings_data["ux_tooltip_control_".$dynamic_Id]) ? esc_html($form_settings_data["ux_tooltip_control_".$dynamic_Id]) : "";
					$form_settings[$dynamic_Id]["cb_admin_label"] = isset($form_settings_data["ux_admin_label_".$dynamic_Id]) ? esc_html($form_settings_data["ux_admin_label_".$dynamic_Id]) : "Untitled";
					$form_settings[$dynamic_Id]["cb_show_email"] = isset($form_settings_data["ux_show_email_".$dynamic_Id]) ? "1" : "0";

					$form_settings[$dynamic_Id]["cb_radio_option_id"] = serialize($ddl_options_id);
					$form_settings[$dynamic_Id]["cb_radio_option_val"] = serialize($options_value);

					foreach($form_settings as $element)
					{
						$id = $element["dynamic_id"];
						$control_type = $element["control_type"];
						if($event == "add")
						{
							$wpdb->query
							(
								$wpdb->prepare
								(
									"INSERT INTO " . create_control_Table() . "(form_id,field_id,column_dynamicId) VALUES(%d,%d,%d)",
									$form_id,
									$control_type,
									$id
								)
							);
							echo $dynamic_control_id=$wpdb->insert_id;
							$wpdb->query
							(
								$wpdb->prepare
								(
									"UPDATE " . create_control_Table() . " SET `sorting_order` = %d where form_id = %d and field_id = %d and column_dynamicId = %d",
									$dynamic_control_id,
									$form_id,
									$control_type,
									$id
								)
							);
						}
						foreach($element as $key => $value)
						{
							if($key == "dynamic_id" || $key == "control_type")
							{
								continue;
						 	}
							else
							{
								if($event == "add")
								{
									$wpdb->query
									(
										$wpdb->prepare
										(
											"INSERT INTO " . contact_bank_dynamic_settings_form() . "(dynamicId,dynamic_settings_key,dynamic_settings_value) VALUES (%d,%s,%s)",
											$dynamic_control_id,
											$key,
											$value
										)
									);
								}
								else
								{
									$wpdb->query
		 							(
		 								$wpdb->prepare
		 									(
		 										"UPDATE " . contact_bank_dynamic_settings_form() . " SET `dynamic_settings_value` = %s where dynamic_settings_key = %s and dynamicId = %d ",
												$value,
												$key,
												$controlId
		 									)
		 							);
								}
							}
						}
					}
				break;

			case "update_option":

				update_option("contact-bank-info-popup", "no");

			break;

			case "form_fields_sorting_order":

				$form_id = isset($_REQUEST["form_id"]) ? intval($_REQUEST["form_id"]) : 0;
				$field_dynamic_id = isset($_REQUEST["field_dynamic_id"]) ? json_decode(stripcslashes($_REQUEST["field_dynamic_id"]),true) : array();
				$sql= "";
				foreach($field_dynamic_id as $key => $val)
				{
					$sql .= ' WHEN `column_dynamicId` = "'.$val.'" THEN "'.$key.'"';
				}
				$wpdb->query
				(
						$wpdb->prepare
						(
								"UPDATE " . create_control_Table() . " SET `sorting_order` = CASE " . $sql . " END where form_id = %d ",
								$form_id
						)
				);

			break;

			case "contact_plugin_remove_tables":
				$contact_remove_tables = isset($_REQUEST["contact_remove_tables"]) ? intval($_REQUEST["contact_remove_tables"]) : 0;
				update_option("contact-bank-remove-tables",$contact_remove_tables);

			break;
		}
		die();
	}
}
?>
