<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$sql = "DROP TABLE IF EXISTS `".DB::table('wxconnect_member')."`";
runquery($sql);
$sql = "DROP TABLE IF EXISTS `".DB::table('wxconnect_login_qrcode')."`";
runquery($sql);
$finish = TRUE;
?>