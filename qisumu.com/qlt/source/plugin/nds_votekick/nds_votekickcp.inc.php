<?php
/*  nds_votekick Plugin FOR Discuz!  X2.5 X3 X3.2 
	 *	Copyright (c) 20015-2020 WWW.NWDS.CN | NDS.西域数码工作室
	 *  	$Id: nds_votekick.inc.php V3.02 20150207 by SINGCEE $
	 */

if (! defined ( 'IN_DISCUZ' )) {
	exit ( 'Access Denied' );
}
if (! $_G ['uid']) {
	showmessage ( 'nds_votekick:nologin', NULL );
}
$tid = intval ( $_GET ['tid'] );
$adminlock = $_G ['cache'] ['plugin'] ['nds_votekick'] ['adminunvote'];
$voteforums = unserialize ( $_G ['cache'] ['plugin'] ['nds_votekick'] ['voteforums'] );
$suspectedgroups = unserialize ( $_G ['cache'] ['plugin'] ['nds_votekick'] ['suspectedgroups'] );
$lvotes = $_G ['cache'] ['plugin'] ['nds_votekick'] ['lvotes'];
$vkscp = C::t ( '#nds_votekick#plugin_nds_votekick' )->fetch_by_tid ( $tid );
$vkusers = '';
$votes = '0';
$votesup = $vkscp ['tid'] ? 1 : 0;
$votes = 0;
$uidvote = 0;
if ($vkscp ['votes']) {
	$votes = $vkscp ['votes'];
	$vkuids = array ();
	$vkuids = explode ( "\t", $vkscp ['uids'] );
	foreach ( $vkuids as $vkuid ) {
		$vkuser = getuserbyuid ( $vkuid );
		$vkusers .= "<a href=\"home.php?mod=space&uid=$vkuid\" target=\"_blank\">" . $vkuser ['username'] . "</a>&nbsp;&nbsp;";
		$vkuid == $_G ['uid'] ? $uidvote = 1 : '';
	}
}
$vkthread = C::t ( 'forum_thread' )->fetch ( $tid );
$fid = $vkthread ['fid'];
$dbnmoderators = C::t ( '#nds_votekick#forum_forumfield_nds' )->fetch_by_fid ( $fid );
$nmoderators = explode ( "\t", $dbnmoderators ['moderators'] );
if ($vkscp ['islock'] && ! (in_array ( $_G ['adminid'], array (1, 2 ) )) && ! ($adminlock && in_array ( $_G ['username'], $nmoderators ))) {
	showmessage ( 'nds_votekick:vklock' );
}
$vtg = 0;
$votegroups = unserialize ( $_G ['cache'] ['plugin'] ['nds_votekick'] ['votegroups'] );
if (in_array ( $_G ['groupid'], $votegroups )) {
	$vtg = 1;
} else {
	$extgroupids = ! empty ( $_G ['member'] [extgroupids] ) ? explode ( "\t", $_G ['member'] [extgroupids] ) : '';
	foreach ( $extgroupids as $v ) {
		if (in_array ( $v, $votegroups ) and ! empty ( $extgroupids )) {
			$vtg = 1;
		}
	}
}
if ($vtg != 1) {
	showmessage ( 'nds_votekick:nopw' );
}
if ($uidvote && ! (in_array ( $_G [adminid], array (1, 2 ) )) && ! ($adminlock && in_array ( $_G ['username'], $nmoderators ))) {
	showmessage ( 'nds_votekick:norep' );
}
if ($_G ['cache'] ['plugin'] ['nds_votekick'] ['vtexpired'] > 0 && ($_G ['timestamp'] - $vkthread ['dateline']) > $_G ['cache'] ['plugin'] ['nds_votekick'] ['vtexpired'] * 24 * 60 * 60) {
	showmessage ( 'nds_votekick:vtexpired' );
}
if ($vkthread ['fid']) {
	if (in_array ( $vkthread ['fid'], $voteforums )) {
		showmessage ( 'nds_votekick:nofid' );
	}
} else {
	showmessage ( 'nds_votekick:notid' );
}
$vk2user = getuserbyuid ( $vkthread ['authorid'] );
if (! in_array ( $vk2user ['groupid'], $suspectedgroups )) {
	showmessage ( 'nds_votekick:nopw2' );
}
$vk2user = getuserbyuid ( $vkthread ['authorid'] );
if (! in_array ( $vk2user ['groupid'], $suspectedgroups )) {
	showmessage ( 'nds_votekick:nopw2' );
}
if ($votes >= $lvotes) {
	showmessage ( 'nds_votekick:vtout' );
}
if (submitcheck ( 'votekicksubmit' )) {
	$votelock = empty ( $_GET ['votelock'] ) ? 0 : 1;
	$unvotelock = empty ( $_GET ['unvotelock'] ) ? 0 : 1;
	if ($votelock && ((in_array ( $_G ['adminid'], array (1, 2 ) )) || ($adminlock && in_array ( $_G ['username'], $nmoderators )))) {
		if ($votesup) {
			$data = array ('islock' => 1, 'lockuid' => $_G ['uid'] );
			C::t ( '#nds_votekick#plugin_nds_votekick' )->update_by_tid ( $tid, $data );
		} else {
			$data = array ('tid' => $tid, 'votes' => 0, 'uids' => '', 'islock' => 1, 'lockuid' => $_G ['uid'] );
			C::t ( '#nds_votekick#plugin_nds_votekick' )->insert ( $data );
		}
		showmessage ( 'nds_votekick:vklockok', dreferer (), array (), array ('showdialog' => true, 'closetime' => true ) );
	} elseif ($unvotelock && ((in_array ( $_G ['adminid'], array (1, 2 ) )) || ($adminlock && in_array ( $_G ['username'], $nmoderators )))) {
		$data = array ('islock' => 0, 'lockuid' => $_G ['uid'] );
		C::t ( '#nds_votekick#plugin_nds_votekick' )->update_by_tid ( $tid, $data, 1 );
		showmessage ( 'nds_votekick:unvklockok', dreferer (), array (), array ('showdialog' => true, 'closetime' => true ) );
	} else {
		if ($uidvote) {
			showmessage ( 'nds_votekick:norep' );
		} elseif ($votesup) {
			$data = array ('votes' => $vkscp ['votes'] + 1, 'uids' => (empty ( $vkscp ['uids'] ) ? $_G ['uid'] : $vkscp ['uids'] . "\t" . $_G ['uid']), vtdate => (empty ( $vkscp ['vtdate'] ) ? TIMESTAMP : $vkscp ['vtdate'] . "\t" . TIMESTAMP) );
			C::t ( '#nds_votekick#plugin_nds_votekick' )->update_by_tid ( $tid, $data );
			$votes ++;
		} else {
			$data = array ('tid' => $tid, 'votes' => 1, 'uids' => $_G [uid], 'vtdate' => TIMESTAMP );
			C::t ( '#nds_votekick#plugin_nds_votekick' )->insert ( $data );
			$votes ++;
		}
		$reason = empty ( $_GET ['description'] ) ? lang ( 'plugin/nds_votekick', 'vtmemnu' ) : htmlspecialchars ( daddslashes ( cutstr ( trim ( $_GET ['description'] ), 20 ) ) );
		$notevars = array ('url1' => "forum.php?mod=viewthread&tid=" . $tid, 'subject1' => $vkthread ['subject'], 'vkuser' => '<a href=\"home.php?mod=space&uid=' . $_G ['uid'] . '"\>' . $_G ['member'] ['username'] . "</a>", 'reason' => $reason );
		$mistoadminid = $_G ['cache'] ['plugin'] ['nds_votekick'] ['votekickadminid'] > 1 ? $_G ['cache'] ['plugin'] ['nds_votekick'] ['votekickadminid'] : $_G ['config'] ['admincp'] ['founder'];
		if ($_G ['cache'] ['plugin'] ['nds_votekick'] ['votetoauthor']) {
			notification_add ( $vkthread ['authorid'], 'votekick', lang ( 'plugin/nds_votekick', 'notice1' ), $notevars, '', 1 );
		}
		if ($_G ['cache'] ['plugin'] ['nds_votekick'] ['votetoadmin']) {
			notification_add ( $mistoadminid, 'votekick', lang ( 'plugin/nds_votekick', 'notice2' ), $notevars, '', 1 );
		}
		if ($_G ['cache'] ['plugin'] ['nds_votekick'] ['votetobz']) {
			foreach ( $nmoderators as $uname ) {
				$bzuid = C::t ( '#nds_votekick#common_member_nds' )->fetch_by_username ( $uname, 0 );
				notification_add ( $bzuid, 'votekick', lang ( 'plugin/nds_votekick', 'notice2' ), $notevars, '', 1 );
			}
		}
		$treatmod = $_G ['cache'] ['plugin'] ['nds_votekick'] ['treatmod'];
		if ($votes >= $lvotes) {
			switch ($treatmod) {
				case 1 :
					C::t ( 'forum_thread' )->update_displayorder_by_tid_displayorder ( $tid, 0, - 2 );
					updatemoderate ( 'tid', $tid );
					$opmode = lang ( 'plugin/nds_votekick', 'vkop1' );
					break;
				case 2 :
					C::t ( 'forum_thread' )->update_displayorder_by_tid_displayorder ( $tid, 0, - 1 );
					$opmode = lang ( 'plugin/nds_votekick', 'vkop2' );
					break;
				case 3 :
					C::t ( 'forum_thread' )->update_displayorder_by_tid_displayorder ( $tid, 0, - 2 );
					updatemoderate ( 'tid', $tid );
					banuser ( $vkthread ['authorid'], 4, $_G ['cache'] ['plugin'] ['nds_votekick'] ['bantime'] );
					$opmode = lang ( 'plugin/nds_votekick', 'vkop3' );
					break;
				case 4 :
					C::t ( 'forum_thread' )->update_displayorder_by_tid_displayorder ( $tid, 0, - 1 );
					banuser ( $vkthread ['authorid'], 4, $_G ['cache'] ['plugin'] ['nds_votekick'] ['bantime'] );
					$opmode = lang ( 'plugin/nds_votekick', 'vkop4' );
					break;
				case 5 :
					$movefid = $_G ['cache'] ['plugin'] ['nds_votekick'] ['votemovefid'];
					$data = array ('fid' => $movefid );
					C::t ( 'forum_thread' )->update ( $tid, $data );
					$opmode = lang ( 'plugin/nds_votekick', 'vkop9' );
					break;
				case 6 :
					$movefid = $_G ['cache'] ['plugin'] ['nds_votekick'] ['votemovefid'];
					$data = array ('fid' => $movefid );
					C::t ( 'forum_thread' )->update ( $tid, $data );
					banuser ( $vkthread ['authorid'], 4, $_G ['cache'] ['plugin'] ['nds_votekick'] ['bantime'] );
					$opmode = lang ( 'plugin/nds_votekick', 'vkop10' );
					break;
				default :
					C::t ( 'forum_thread' )->update_displayorder_by_tid_displayorder ( $tid, 0, - 2 );
					updatemoderate ( 'tid', $tid );
					$opmode = lang ( 'plugin/nds_votekick', 'vkop1' );
			}
			
			$notevars2 = array ('url1' => "forum.php?mod=viewthread&tid=" . $tid, 'subject1' => $vkthread ['subject'], 'opmod' => $opmode, 'vkuser' => '<a href=\"home.php?mod=space&uid=$_G[uid]\">' . $_G ['member'] ['username'] . "</a>", 'vkcount' => $lvotes );
			
			if ($_G ['cache'] ['plugin'] ['nds_votekick'] ['mistoauthor']) {
				notification_add ( $vkthread ['authorid'], 'votekick', lang ( 'plugin/nds_votekick', 'notice3' ), $notevars2, '', 1 );
			}
			if ($_G ['cache'] ['plugin'] ['nds_votekick'] ['mistoadmin']) {
				notification_add ( $mistoadminid, 'votekick', lang ( 'plugin/nds_votekick', 'notice4' ), $notevars2, '', 1 );
			}
			if ($_G ['cache'] ['plugin'] ['nds_votekick'] ['mistobz']) {
				foreach ( $nmoderators as $uname ) {
					$bzuid = C::t ( '#nds_votekick#common_member_nds' )->fetch_by_username ( $uname, 0 );
					notification_add ( $bzuid, 'votekick', lang ( 'plugin/nds_votekick', 'notice2' ), $notevars2, '', 1 );
				}
			}
		}
		showmessage ( 'nds_votekick:vkok', dreferer (), array (), array ('showdialog' => true, 'closetime' => true ) );
	}
} else {	
	include template ( 'nds_votekick:votekickwindow' );
}
function banuser($uid, $bangroupid = 4, $bantime = 0) {
	if ($bantime == 0) {
		$data = array ('adminid' => - 1, 'groupid' => 4 );
		C::t ( '#nds_votekick#common_member_nds' )->update_by_uid ( $uid, $data );
	} else {
		$member = C::t ( '#nds_votekick#common_member_nds' )->fetch_by_uid ( $uid );
		if ($member && $member ['groupid'] != 4) {
			$banexpiry = TIMESTAMP + $bantime * 86400;
			$groupterms = array ();
			$groupterms ['main'] = array ('time' => $banexpiry, 'adminid' => $member ['adminid'], 'groupid' => $member ['groupid'] );
			$groupterms ['ext'] [4] = $banexpiry;
			$data = array ('adminid' => - 1, 'groupid' => 4, 'groupexpiry' => $banexpiry );
			C::t ( '#nds_votekick#common_member_nds' )->update_by_uid ( $uid, $data );
			$groupterms = addslashes ( serialize ( $groupterms ) );
			C::t ( '#nds_votekick#common_member_field_forum_nds' )->update_by_uid ( $uid, $groupterms );
		}
	}
	return true;
}

?>