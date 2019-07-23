<?php
if(! defined('IN_DISCUZ') || ! defined('IN_ADMINCP')) {
	exit('Access Denied');
}
C::import("TopSdk", "plugin/oculus/top");
date_default_timezone_set("UTC");

$site_settings = C::t('common_setting')->fetch_all(array (
		'siteurl',
		'sitename' 
));

$config = @include DISCUZ_ROOT . 'source/plugin/oculus/lib/config.php';
$nc_config = $config['nc_config'];

$top_client = new TopClient();
$top_client->format = 'json';
$top_client->appkey = $nc_config['top_appkey'];
$top_client->secretKey = $nc_config['top_secret'];
$top_url = $nc_config['top_url'];
if(isset($top_url) && $top_url != '') {
	$top_client->gatewayUrl = $nc_config['top_url'];
}
$account_id = uniqid();
$req = new AlibabaSecurityTuringPlatformAccessAddPlatformUserRequest();
$platform_user_info = new PlatformUserInfo();
$site_name = $site_settings['sitename'];
if(! isset($site_name) || $site_name == '') {
	$site_name = 'default_site_name';
}
$site_name = urlencode($site_name);
if(strlen($site_name) > 50) {
	$site_name = substr($site_name, 0, 50);
}
$platform_user_info->account_name = $site_name;
$platform_user_info->app_id = $site_name;
$platform_user_info->account_id = $account_id;
$site_url = $site_settings['siteurl'];
if(! isset($site_url) || $site_url == '') {
	$site_url = "default_url";
}
$site_url = urlencode($site_url);
// length of site_url cannot be greater than 100
if(strlen($site_url) > 100) {
	$site_url = substr($site_url, 0, 100);
}
$platform_user_info->company_name = $site_url;
$platform_user_info->user_type = "10";
$platform_user_info->web_type_list = array (
		2,
		4 
);
$req->setPlatformUserInfo(json_encode($platform_user_info));
$times = 0;
do {
	$resp = $top_client->execute($req);
	$times ++;
} while(! isset($resp->data) && $times <= 3);

$project_id = 0;
if(isset($resp->data)) {
	$project_id = intval($resp->data->turing_riskcontorl_project_id);
} else {
	throw new Exception("Create Account Error!" . json_encode($resp));
}

$fetchJsReq = new AlibabaSecurityTuringPlatformAccessJsFetchRequest();
$platform_js_param = new PlatformJsParam();
$platform_js_param->turing_riskcontrol_project_id = $project_id;
$fetchJsReq->setPlatformJsParam(json_encode($platform_js_param));
$fetchJsResp = $top_client->execute($fetchJsReq);
$afs_key = "";
if(isset($fetchJsResp->data)) {
	$afs_key = $fetchJsResp->data->afs_key;
}
if(isset($afs_key) && $afs_key != "") {
	$nc_config["account_id"] = $account_id;
	$nc_config["afs_key"] = $afs_key;
	savecache("nc_cache", $nc_config);
}
?>