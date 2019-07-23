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
		<div style="margin: 10px;text-align: center;"><img  src="<?php echo plugins_url("/assets/images/footer.png" , dirname(__FILE__));?>"/></div>
	<?php
}
?>
