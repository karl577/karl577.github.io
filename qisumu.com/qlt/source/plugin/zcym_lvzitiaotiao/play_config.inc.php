<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if (!$_G['adminid']) {
	exit('Access Denied');
}
if (!empty($_POST) && $_POST['formhash'] != formhash()) {
	exit('Access Denied');
}

$psize = isset($_POST["psize"]) ? intval($_POST["psize"]) : 20;
$psize = $psize<=0 ? 20 : $psize;
$act = isset($_POST["act"]) ? intval($_POST["act"]) : 0;
$query_action = 'action='.dhtmlspecialchars($_GET['action']).
				'&operation='.dhtmlspecialchars($_GET['operation']).
				'&do='.dhtmlspecialchars($_GET['do']).
				'&identifier='.dhtmlspecialchars($_GET['identifier']).
				'&pmod='.dhtmlspecialchars($_GET['pmod']);
switch ($act){
	case 798;
		$ret = DB::query('UPDATE %t SET g_value=%d WHERE g_uid>%d', array('zcym_lvzitiaotiao', 0, 0));
		if($ret===false){
			cpmsg(lang('plugin/zcym_lvzitiaotiao', 'clear_error'), $query_action , 'error');
		}else{
			cpmsg(lang('plugin/zcym_lvzitiaotiao', 'clear_success'), $query_action , 'succeed');
		}
		break;
}

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
			 $psize";
$phb_datas = DB::fetch_all($phb_sql,array('zcym_lvzitiaotiao', 'common_member', 0));

include template('zcym_lvzitiaotiao:play_config');
