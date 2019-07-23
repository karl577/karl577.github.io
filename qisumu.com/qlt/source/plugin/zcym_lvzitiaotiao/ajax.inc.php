<?php
if(!defined('IN_DISCUZ')||!$_G['uid']) {
	exit('Access Denied');
}

if (!empty($_GET) && $_GET['gamehash'] != formhash()) {
	exit('Access Denied');
}

if(isset($_GET['__jrefreshgametine__'])){
	$stime = getcookie('game_start_time');
	$sbase_scharv = dhtmlspecialchars($_GET['__jrefreshgametine__']);
	$sbase_scharv = daddslashes($sbase_scharv);
	$score = intval($sbase_scharv)/1024*2;
	$token = trim($_GET['rtjs_dgsdgsdj']);
	if($token!=md5(md5(getcookie('game_start_time').getcookie('pre_key')))){
		exit('null');
	}
	$time = time();
	$use_time = $time-$stime;
	if($score/$use_time>500){
		echo '0|'.lang('plugin/zcym_lvzitiaotiao', 'invalidscores');die;
	}
	$my_game_query = DB::query('select * from %t where g_uid=%d', array('zcym_lvzitiaotiao', $_G['uid']));
	$my_game_history = DB::fetch($my_game_query);
	if(empty($my_game_history)){
		$ret = DB::query('INSERT INTO %t (`g_uid`, `g_value`) VALUES (%d, %d)', array('zcym_lvzitiaotiao', $_G['uid'], $score));
	}else{
		$ret = DB::query('UPDATE %t SET g_value=%d WHERE g_uid=%d AND g_value<%d', array('zcym_lvzitiaotiao', $score, $_G['uid'], $score));
	}
	$my_pm_query = DB::query("select count(id) as pm from %t where g_value>%d and g_uid<>%d",array('zcym_lvzitiaotiao',$my_game_history['g_value'],$_G['uid']));
	$my_pm = DB::fetch($my_pm_query);
	$paiming = intval($my_pm['pm'])+1;	
	echo '1|'.$score.'|'.$paiming;die;
}
$game_credit = $_G['cache']['plugin']['zcym_lvzitiaotiao']['zcym_lztt_use_credit'];
$game_price = $_G['cache']['plugin']['zcym_lvzitiaotiao']['zcym_lztt_play_price'];
$c_field = empty($game_credit) ? 'free' : 'extcredits'.$game_credit;
$c_value = floor($game_price);
if($c_field!='free'){
	$_credits_config = $_G['setting']['extcredits'];
	$user_credits = getuserprofile($c_field);
	if($c_value>$user_credits){
		$lang_errms = lang('plugin/zcym_lvzitiaotiao', 'errms');
		$lang_g = lang('plugin/zcym_lvzitiaotiao', 'g');
		$_msg = $_credits_config[intval($game_credit)]['title'] . 
				$lang_errms .
				$c_value .
				$lang_g .
				$_credits_config[intval($game_credit)]['title'];
		echo '0|'.$_msg; die;
	}else{
		updatemembercount($_G['uid'],array($c_field=>0-$c_value));
	}
}

dsetcookie('game_start_time',time());
dsetcookie('pre_key',uniqid('zcyuamma..'));
echo '1|'.md5(md5(getcookie('game_start_time').getcookie('pre_key')));


