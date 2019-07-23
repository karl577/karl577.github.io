<?php
if(!defined("ABSPATH")) exit; //exit if accessed directly
global $wpdb;
if(isset($_REQUEST["param"]))
{
	if(esc_attr($_REQUEST["param"]) == "email_management")
	{
		$form_id = isset($_REQUEST["form_id"]) ? intval($_REQUEST["form_id"]) : 0;
		$form_submit_id = isset($_REQUEST["submit_id"]) ? intval($_REQUEST["submit_id"]) : 0;
		$file_uploaded_path_admin = "";
		$email_content = $wpdb->get_results
		(
			$wpdb->prepare
			(
				"SELECT * FROM " .contact_bank_email_template_admin()."  WHERE form_id = %d ",
				$form_id
			)
		);
		$frontend_control_value = $wpdb->get_results
		(
			$wpdb->prepare
			(
				"SELECT * FROM  " . contact_bank_frontend_forms_Table(). " JOIN  " . frontend_controls_data_Table(). " ON " . contact_bank_frontend_forms_Table(). ".submit_id = " . frontend_controls_data_Table(). ".form_submit_id  WHERE " . contact_bank_frontend_forms_Table(). ".submit_id = %d",
				$form_submit_id
			)
		);

		for($flag=0;$flag<count($email_content); $flag++)
		{
			$email_exits = "";
			$email_to = esc_html($email_content[$flag]->email_to);
			$email_from = htmlspecialchars_decode($email_content[$flag]->email_from);
			$messageTxt = htmlspecialchars_decode($email_content[$flag]->body_content);
			$email_subject = htmlspecialchars_decode($email_content[$flag]->subject, ENT_QUOTES);
			$email_from_name = htmlspecialchars_decode($email_content[$flag]->from_name, ENT_QUOTES);
			$email_reply_to = esc_html($email_content[$flag]->reply_to);
			$email_cc = esc_html($email_content[$flag]->cc);
			$email_bcc = esc_html($email_content[$flag]->bcc);
			for($flag1=0;$flag1<count($frontend_control_value);$flag1++)
			{
				$dynamicId = $frontend_control_value[$flag1]->dynamic_control_id;
				$email_to = str_replace("[control_".$dynamicId."]",esc_html($frontend_control_value[$flag1]->dynamic_frontend_value), $email_to);
				$email_from = str_replace("[control_".$dynamicId."]",esc_html($frontend_control_value[$flag1]->dynamic_frontend_value), $email_from);
				$email_subject = str_replace("[control_".$dynamicId."]",esc_html($frontend_control_value[$flag1]->dynamic_frontend_value), $email_subject);
				$email_from_name = str_replace("[control_".$dynamicId."]",esc_html($frontend_control_value[$flag1]->dynamic_frontend_value), $email_from_name);
				$email_reply_to = str_replace("[control_".$dynamicId."]",esc_html($frontend_control_value[$flag1]->dynamic_frontend_value), $email_reply_to);
				$email_cc  = str_replace("[control_".$dynamicId."]",esc_html($frontend_control_value[$flag1]->dynamic_frontend_value), $email_cc);
				$email_bcc = str_replace("[control_".$dynamicId."]",esc_html($frontend_control_value[$flag1]->dynamic_frontend_value), $email_bcc);
				if($frontend_control_value[$flag1]->field_Id == 5)
				{
					$chk_options =  str_replace("-",", ", esc_html($frontend_control_value[$flag1]->dynamic_frontend_value));
					$messageTxt = str_replace("[control_".$dynamicId."]",$chk_options, $messageTxt);
				}
				else
				{
					$messageTxt = str_replace("[control_".$dynamicId."]",esc_html($frontend_control_value[$flag1]->dynamic_frontend_value), $messageTxt);
				}
			}
			$body_content = "";
			$body_content .= "<div lang=\"ar\"> $messageTxt</div>";
			$headers = "";
			$headers .= "Content-Type: text/html; charset= utf-8". "\r\n";
			if($email_from_name != "" && $email_from != "")
			{
				$headers .= "From: " .$email_from_name. " <". $email_from . ">" ."\r\n";
			}
			if($email_reply_to != "")
			{
				$headers .= "Reply-To: ".$email_reply_to."\r\n";
			}
			if($email_cc != "")
			{
				$headers .= "Cc: " .$email_cc. "\r\n";
			}
			if($email_bcc != "")
			{
				$headers .= "Bcc: " .$email_bcc."\r\n";
			}
			get_option("blog_charset") . "\r\n";
			wp_mail($email_to, $email_subject, $body_content, $headers);
		}
	die();
	}
}
?>
