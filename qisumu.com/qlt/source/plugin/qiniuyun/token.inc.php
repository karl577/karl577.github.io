<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once(dirname(__FILE__)."/qiniu/rs.php");

$bucket = $_G['cache']['plugin']["qiniuyun"]['bucket'];

Qiniu_SetKeys($_G['cache']['plugin']["qiniuyun"]['accessKey'], $_G['cache']['plugin']["qiniuyun"]['secretKey']);
$putPolicy = new Qiniu_RS_PutPolicy($bucket);
//$putPolicy->ReturnUrl=$_G['siteurl'].'plugin.php?id=qiniuyun:upload';
$putPolicy->ReturnBody = '{
		  "name": $(fname),
		  "etag": $(etag),
		  "size": $(fsize),
		  "imageinfo":$(imageInfo),
		  "hash": $(etag),
		  "persistentId":$(persistentId),
		  "key":$(key),
		  "ext":$(ext)
		}';
$upToken = $putPolicy->Token(null);
$data = array('token'=>$upToken,'f'=>$_G['siteurl']);
echo json_encode($data);