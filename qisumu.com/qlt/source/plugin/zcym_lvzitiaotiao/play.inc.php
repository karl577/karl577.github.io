<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!$_G['uid']){
	header("Location: {$_G['siteurl']}forum.php");
	die;
}

$my_game_query = DB::query("select * from %t where g_uid=%d",array('zcym_lvzitiaotiao',$_G['uid']));
$my_game_history = DB::fetch($my_game_query);
$my_pm_query = DB::query("select count(id) as pm from %t where g_value>%d and g_uid>%d",array('zcym_lvzitiaotiao',$my_game_history['g_value'],$_G['uid']));
$my_pm = DB::fetch($my_pm_query);
$_cpm = $my_pm['pm']==0&&$my_game_history['g_value']==0 ? lang('plugin/zcym_lvzitiaotiao', 'noranking') : intval($my_pm['pm'])+1;
$my_game = empty($my_game_history) ? array('score'=>0,'paiming'=>lang('plugin/zcym_lvzitiaotiao', 'noranking')) : array('score'=>$my_game_history['g_value'],'paiming'=>$_cpm);

$game_advs_query = DB::query("select * from %t where id=1", array('zcym_lvzitiaotiao'));
$game_advs = DB::fetch($game_advs_query);

$adv_info = array(
		'title' => $_G['cache']['plugin']['zcym_lvzitiaotiao']['zcym_lztt_ext_title'],
		'info' => htmlspecialchars_decode($_G['cache']['plugin']['zcym_lvzitiaotiao']['zcym_lztt_ext_content'])
) ;

$phb_sql = "SELECT
				a.g_uid,
				m.username,
				a.g_value AS score
			FROM
				%t AS a,%t AS m
			WHERE
				m.uid=a.g_uid AND 
				a.g_value >%d
			GROUP BY a.g_uid
			ORDER BY
				a.g_value DESC
			LIMIT 0,
			 20";
$phb_arr = DB::fetch_all($phb_sql,array('zcym_lvzitiaotiao', 'common_member', 0));

foreach ($phb_arr as $k=>$v){
	$phb_arr[$k]['username'] = dstrlen($v['username'])<=8 ? $v['username'] : cutstr($v['username'], 8);
	$phb_arr[$k]['paiming'] = $k+1;
	$score = intval($v['score']);
	$phb_arr[$k]['score'] = $score>=10000 ? (floor($score/100)/100).lang('plugin/zcym_lvzitiaotiao', 'w') : $score;
}
$avatar = avatar($_G['uid'],'small',true);
include template('zcym_lvzitiaotiao:play');

