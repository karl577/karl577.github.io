<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require_once dirname(__FILE__)."/class/env.class.php";
$mod = isset($_GET['mod']) ? $_GET['mod'] : 'wxlogin';
$siteurl=wxconnect_env::get_siteurl();
$plugin_path=wxconnect_env::get_plugin_path();
$template_path=$plugin_path."/template";
$ajaxapi = $plugin_path."/index.php?version=4&module=";
if ($mod=='wxlogin') {
	
	if ($_G['uid']!=0) {
		header("Location: $siteurl");
		exit();
	}
	
	$qrid = C::t('#wxconnect#wxconnect_login_qrcode')->genQrCodeId();
	$qrurl=$siteurl."/plugin.php?id=wxconnect:wxlogin&qrid=".$qrid;
	
    $lang = array (
        'title' => lang('plugin/wxconnect', 'wxlogin'), 
        'tip'   => lang('plugin/wxconnect', 'wxlogin_tip').'<br>'.$_G["setting"]["bbname"],
    );
}
include template("wxconnect:wxlogin");