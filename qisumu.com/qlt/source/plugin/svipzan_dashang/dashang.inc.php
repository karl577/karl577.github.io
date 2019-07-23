<?php

/**

 * 	   QQ：1960024995

 *	   time：2016-10-25  16:46:48

 */


if(!defined('IN_DISCUZ')) {

   exit('Access Deined');

}
$root='source/plugin/svipzan_dashang/template/';
	global $_G;

	$return = "";

	$shang = $_G['cache']['plugin']['svipzan_dashang'];
	$alipayurl=$shang['alipay_url'];
	$wxpayurl=$shang['wxpay_url'];
	$logo=$shang['logoimg'];
	$top_txt=$shang['top_txt'];
	$but_txt=$shang['but_txt'];
	$bqxx_txt=$shang['bqxx_txt'];
	$smts_txt=$shang['smts_txt'];
include template('svipzan_dashang:dashang');
?>