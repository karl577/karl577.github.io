<?php
if(! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
include_once TOP_AUTOLOADER_PATH . '/top/TopClient.php';
include_once TOP_AUTOLOADER_PATH . '/top/TopLogger.php';
include_once TOP_AUTOLOADER_PATH . '/top/ApplicationVar.php';
include_once TOP_AUTOLOADER_PATH . '/top/ClusterTopClient.php';
include_once TOP_AUTOLOADER_PATH . '/top/HttpdnsGetRequest.php';
include_once TOP_AUTOLOADER_PATH . '/top/RequestCheckUtil.php';
include_once TOP_AUTOLOADER_PATH . '/top/ResultSet.php';
include_once TOP_AUTOLOADER_PATH . '/top/SpiUtils.php';
include_once TOP_AUTOLOADER_PATH . '/top/domain/PlatformJsInfo.php';
include_once TOP_AUTOLOADER_PATH . '/top/domain/PlatformJsParam.php';
include_once TOP_AUTOLOADER_PATH . '/top/domain/PlatformUserInfo.php';
include_once TOP_AUTOLOADER_PATH . '/top/request/AlibabaSecurityTuringPlatformAccessAddPlatformUserRequest.php';
include_once TOP_AUTOLOADER_PATH . '/top/request/AlibabaSecurityTuringPlatformAccessJsFetchRequest.php';
include_once TOP_AUTOLOADER_PATH . '/top/request/AlibabaSecurityTuringPlatformAccessUserDeleteRequest.php';
include_once TOP_AUTOLOADER_PATH . '/top/request/AlibabaSecurityJaqAfsCheckRequest.php';