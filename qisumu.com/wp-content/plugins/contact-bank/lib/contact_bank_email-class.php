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
	if(isset($_REQUEST["param"]))
	{
		switch(esc_attr($_REQUEST["param"]))
		{
			case "email_settings":
				$form_id = isset($_REQUEST["form_id"]) ? intval($_REQUEST["form_id"]) : 0;
				$email_settings = $wpdb->get_results
				(
					$wpdb->prepare
					(
						"SELECT email_id,subject,name FROM ".contact_bank_email_template_admin()." WHERE form_id = %d",
						$form_id
					)
				);
				for($flag=0;$flag<count($email_settings);$flag++)
				{
				?>
					<tr>
						<td ><?php echo $email_settings[$flag]->name;?></td>
						<td ><?php echo $email_settings[$flag]->subject;?></td>
						<td>
							<?php
							switch($cb_role)
							{
								case "administrator":
									?>
									<a href="admin.php?page=add_contact_email_settings&email_id=<?php echo intval($email_settings[$flag]->email_id);?>&form_id=<?php echo $form_id ?>" class="btn hovertip" data-original-title="<?php _e("Edit Email Settings", "contact-bank")?>">
										<i class="icon-custom-pencil"></i>
									</a>
									<a herf="#" onclick="delete_email_settings(<?php echo intval($email_settings[$flag]->email_id);?>)" class="btn hovertip" data-original-title="<?php _e("Delete Email Settings", "contact-bank")?>">
										<i class="icon-custom-trash"></i>
									</a>
								<?php
								break;
								case "editor":
									?>
									<a href="admin.php?page=add_contact_email_settings&email_id=<?php echo intval($email_settings[$flag]->email_id);?>&form_id=<?php echo $form_id ?>" class="btn hovertip" data-original-title="<?php _e("Edit Email Settings", "contact-bank")?>">
										<i class="icon-custom-pencil"></i>
									</a>
									<a herf="#" onclick="delete_email_settings(<?php echo intval($email_settings[$flag]->email_id);?>)" class="btn hovertip" data-original-title="<?php _e("Delete Email Settings", "contact-bank")?>">
										<i class="icon-custom-trash"></i>
									</a>
								<?php
								break;
								case "author":
									?>
									<a href="admin.php?page=add_contact_email_settings&email_id=<?php echo intval($email_settings[$flag]->email_id);?>&form_id=<?php echo $form_id ?>" class="btn hovertip" data-original-title="<?php _e("Edit Email Settings", "contact-bank")?>">
										<i class="icon-custom-pencil"></i>
									</a>
									<a herf="#" onclick="delete_email_settings(<?php echo intval($email_settings[$flag]->email_id);?>)" class="btn hovertip" data-original-title="<?php _e("Delete Email Settings", "contact-bank")?>">
										<i class="icon-custom-trash"></i>
									</a>
								<?php
								break;
								case "contributor":
									break;

								case "subscriber":
									break;

							}
							?>

						</td>
					</tr>
					<?php
				}
				?>
				<script type="text/javascript">
					oTable = jQuery("#data-table-email-settings").dataTable
					({
						"bJQueryUI": false,
						"bAutoWidth": true,
						"sPaginationType": "full_numbers",
						"sDom": "<\"datatable-header\"fl>t<\"datatable-footer\"ip>",
						"oLanguage":
						{
							"sLengthMenu": "<span>Show entries:</span> _MENU_"
						},
						"aaSorting": [[ 0, "asc" ]]
					});
				</script>
				<?php

			break;
			case "insert_email_controls":
				$form_id = isset($_REQUEST["form_id"]) ? intval($_REQUEST["form_id"]) : 0;
				$email_id = isset($_REQUEST["email_id"]) ? intval($_REQUEST["email_id"]) : 0;
				parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "",$email_settings_data);
				$uxDescription_email = esc_html($email_settings_data["uxEmailTemplate_hidden"]);
				$email_name = esc_html($email_settings_data["ux_txt_name"]);
				$send_to = intval($email_settings_data["ux_rdl_send_to"]);
				if($send_to == 0)
				{
					$email_address = esc_html($email_settings_data["ux_txt_email"]);
				}
				else
				{
					$email_address = esc_html($email_settings_data["ux_txt_send_to_field"]);
				}
				$email_from_name = esc_html($email_settings_data["ux_txt_from_name"]);
				$email_from_email = esc_html($email_settings_data["ux_txt_from_email"]);
				$email_reply_to = esc_html($email_settings_data["ux_txt_reply_to"]);
				$email_cc = esc_html($email_settings_data["ux_txt_cc"]);
				$email_bcc  = esc_html($email_settings_data["ux_txt_bcc"]);
				$email_subject  = esc_html($email_settings_data["ux_txt_subject"]);

				$wpdb->query
				(
					$wpdb->prepare
					(
						"UPDATE " . contact_bank_email_template_admin(). " SET email_to = %s,email_from = %s,body_content = %s,subject = %s,form_id = %d,from_name = %s,reply_to = %s,cc = %s,bcc = %s,name = %s,send_to = %d WHERE email_id = %d",
						$email_address,
						$email_from_email,
						$uxDescription_email,
						$email_subject,
						$form_id,
						$email_from_name,
						$email_reply_to,
						$email_cc,
						$email_bcc,
						$email_name,
						$send_to,
						$email_id
					)
				);

			break;
			case "delete_email_settings":
				$email_id = isset($_REQUEST["email_id"]) ? intval($_REQUEST["email_id"]) : 0;
				$wpdb->query
				(
					$wpdb->prepare
					(
						"DELETE FROM " .contact_bank_email_template_admin()." WHERE email_id = %d ",
						$email_id
					)
				);

			break;
		}
		die();
	}
}
?>
