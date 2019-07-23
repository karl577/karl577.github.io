<?php
if(!defined("ABSPATH")) exit; //exit if accessed directly
global $wpdb;
if(isset($_REQUEST["param"]))
{
	if(esc_attr($_REQUEST["param"]) == "frontend_submit_controls")
	{
		$form_id = isset($_REQUEST["form_id"]) ? intval($_REQUEST["form_id"]) : 0;
		$rand = isset($_REQUEST["rand"]) ? intval($_REQUEST["rand"]) : 0;
		parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "",$frontend_form_submit_data);

		$fields = $wpdb->get_results
		(
			$wpdb->prepare
			(
				"SELECT field_id,column_dynamicId,control_id FROM " .create_control_Table()."  WHERE form_id = %d",
				$form_id
			)
		);
		$wpdb->query
		(
			$wpdb->prepare
			(
				"INSERT INTO " . contact_bank_frontend_forms_Table(). " (form_id) VALUES(%d)",
				$form_id
			)
		);
		echo $form_submit_id = $wpdb->insert_id;
		$wpdb->query
		(
			$wpdb->prepare
			(
				"UPDATE " . contact_bank_frontend_forms_Table(). " SET submit_id = %d WHERE id = %d",
				$form_submit_id,
				$form_submit_id
			)
		);
		for($flag = 0;$flag<count($fields);$flag++)
		{
			$field_id = intval($fields[$flag]->field_id);
			$dynamicId = intval($fields[$flag]->column_dynamicId);
			$control_dynamicId = intval($fields[$flag]->control_id);
			switch($field_id)
			{
				case 1:
					$ux_txt = esc_html($frontend_form_submit_data["ux_txt_control_".$dynamicId."_".$rand]);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_txt,
							$form_submit_id
						)
					);
				break;
				case 2:
					$ux_textarea = esc_html($frontend_form_submit_data["ux_textarea_control_".$dynamicId."_".$rand]);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_textarea,
							$form_submit_id
						)
					);
				break;
				case 3:
					$ux_email = esc_html($frontend_form_submit_data["ux_txt_email_".$dynamicId."_".$rand]);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_email,
							$form_submit_id
						)
					);
				break;
				case 4:

					if(esc_attr($frontend_form_submit_data["ux_select_default_".$dynamicId."_".$rand]) == " ")
					{
						$ux_dropdown =  "";
					}
					else
					{
						$ux_dropdown = esc_html($frontend_form_submit_data["ux_select_default_".$dynamicId."_".$rand]);
					}
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_dropdown,
							$form_submit_id
						)
					);
				break;
				case 5:

				if(isset($frontend_form_submit_data[$dynamicId."_".$rand."_chk"]))
				{

					$ux_checkbox = $frontend_form_submit_data[$dynamicId ."_".$rand."_chk"];
					$checkbox_options = "";
					for($flag1 =0;$flag1<count($ux_checkbox);$flag1++)
					{
						$checkbox_options .= esc_html($ux_checkbox[$flag1]);
						if($flag1 < count($ux_checkbox)-1)
						{
						$checkbox_options .= "-";
						}
					}
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$checkbox_options,
							$form_submit_id
						)
					);
				}
				else
				{
					$checkbox_options = "";
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$checkbox_options,
							$form_submit_id
						)
					);
				}
				break;
				case 6:

				$ux_multiple = isset($frontend_form_submit_data[$dynamicId ."_".$rand."_rdl"]) ? esc_html($frontend_form_submit_data[$dynamicId ."_".$rand."_rdl"]) : "Untitled";
				$wpdb->query
				(
					$wpdb->prepare
					(
						"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
						$form_id,
						$field_id,
						$control_dynamicId,
						$ux_multiple,
						$form_submit_id
					)
				);
				break;
			}
		}
		die();
	}
}
?>
