<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
loadcache('nc_cache', true);
C::import('oculuslib', 'plugin/oculus/lib');
if(! Oculus::isPop()) {
	global $_G;
	$afs_key = $_G['cache']['nc_cache']['afs_key'];
	if(! isset($afs_key) || $afs_key == '') {
		C::import("install_src", 'plugin/oculus');
	}
}
