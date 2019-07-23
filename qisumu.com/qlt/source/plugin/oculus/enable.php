<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
C::import("upgrade_src", 'plugin/oculus');
$finish = TRUE;