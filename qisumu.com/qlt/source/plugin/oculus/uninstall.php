<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
loadcache('nc_cache', true);
C::import("TopSdk", "plugin/oculus/top");
date_default_timezone_set("UTC");
C::import('oculuslib', 'plugin/oculus/lib');

do {
	global $_G;
	if(Oculus::isPop()) {
		break;
	}
	$account_id = $_G['cache']['nc_cache']['account_id'];
	if(! isset($account_id) || $account_id == '') {
		break;
	}
	$top_client = new TopClient();
	$top_client->appkey = $_G['cache']['nc_cache']['top_appkey'];
	$top_client->secretKey = $_G['cache']['nc_cache']['top_secret'];
	$req = new AlibabaSecurityTuringPlatformAccessUserDeleteRequest();
	$platform_user_info = new PlatformUserInfo();
	$platform_user_info->account_id = $account_id;
	$platform_user_info->user_type = "10";
	$req->setPlatformUserInfo(json_encode($platform_user_info));
	$resp = $top_client->execute($req);
} while(false);
$finish = TRUE;