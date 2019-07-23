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
	?>
	<form id="frm_other_settings" class="layout-form">
		<div id="poststuff" style="width: 99% !important;">
			<div id="post-body" class="metabox-holder">
				<div id="postbox-container-2" class="postbox-container">
					<div id="advanced" class="meta-box-sortables">
						<div id="contact_bank_get_started" class="postbox" >
							<h3 class="hndle"><span><?php _e("Other Settings", "contact-bank"); ?></span></h3>
							<div class="inside">
								<div id="ux_dashboard" class="contact_bank_layout">
									<div class="layout-control-group" style="margin: 10px 0 0 0 ;">
										<label class="layout-control-label" style="width: 170px !important;"><?php _e("Remove Tables at Uninstall", "contact-bank"); ?> :</label>
										<div class="layout-controls-radio">
											<?php $other_settings = get_option("contact-bank-remove-tables");?>
											<input type="radio" name="ux_contact_remove_tables" id="ux_enable_remove_tables" onclick="contact_bank_other_settings(this);" <?php echo $other_settings == "1" ? "checked=\"checked\"" : "";?> value="1"><label style="vertical-align: baseline;"><?php _e("Enable", "contact-bank"); ?></label>
											<input type="radio" name="ux_contact_remove_tables" id="ux_disable_remove_tables" onclick="contact_bank_other_settings(this);" <?php echo $other_settings == "0" ? "checked=\"checked\"" : "";?> style="margin-left: 10px;" value="0"><label style="vertical-align: baseline;"><?php _e("Disable", "contact-bank"); ?></label>
										</div>
									</div>
									<div class="layout-control-group" style="margin:10px 0 10px 0 ;">
										<strong><i>If you would like to remove tables during uninstallation of plugin then you would need to choose enable or vice versa</i></strong>
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
            function contact_bank_other_settings(control)
            {
                    var contact_remove_tables = jQuery(control).val();
                    jQuery.post(ajaxurl, "contact_remove_tables="+contact_remove_tables+"&param=contact_plugin_remove_tables&action=add_contact_form_library", function(data)
                    {
                    });
            }
	
	</script>
<?php
}
?>
