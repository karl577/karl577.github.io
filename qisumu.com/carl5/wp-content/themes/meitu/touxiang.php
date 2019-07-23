<?php
require('../../../wp-config.php');
if( isset($_POST['tougao_form2']) && $_POST['tougao_form2'] == 'send')
{
    $fmimg = isset( $_POST['tougao_fmimg'] ) ? trim($_POST['tougao_fmimg']) : '';
    $user_id = wt_get_user_id();
	update_user_meta($user_id, 'touxiang', $fmimg);
	wp_update_user( array ('ID' => $user_id, 'touxiang' => $fmimg) ) ;
	$url = get_option('mao10_account');
    Header("Location:$url");
}
?>