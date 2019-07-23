<?php

if(!defined('IN_DISCUZ')) {

	exit('Access Denied');

}

$userverify=$userinfo=$usermedalids=$usermedals=$usertheads=array();

$userverify=get_verify_author($_G['forum_thread']['authorid']);

$userinfo=getuserbyuid($_G['forum_thread']['authorid']);

loadcache('usergroups');
	
$userinfo['group'] = $_G['cache']['usergroups'][$userinfo['groupid']];

$userinfo['count'] = C::t('common_member_count')->fetch($_G['forum_thread']['authorid']);


$usermedal = C::t('common_member_medal')->fetch_all_by_uid($_G['forum_thread']['authorid']);

foreach( $usermedal as $key => $value){
	
	$usermedalids[] = $value['medalid'];
	
}

$usermedals = C::t('forum_medal')->fetch_all_by_id($usermedalids);


$usertheads = C::t('forum_thread')->fetch_all_by_authorid_displayorder($_G['forum_thread']['authorid'],0,'>=',null,'',0,10);

function get_verify_author($ids) {
	global $_G;
    $verify = array();
	foreach(C::t('common_member_verify')->fetch_all($ids) as $value) {
		foreach($_G['setting']['verify'] as $vid => $vsetting) {
			if($vsetting['available'] && $vsetting['showicon'] && $value['verify'.$vid] == 1) {
				$srcurl = !empty($vsetting['icon']) ? $vsetting['icon'] : '';
				$verify[$value['uid']] .= "<a href=\"home.php?mod=spacecp&ac=profile&op=verify&vid=$vid\" target=\"_blank\">".(!empty($srcurl) ? '<img src="'.$srcurl.'" class="vm" alt="'.$vsetting['title'].'" title="'.$vsetting['title'].'" />' : $vsetting['title']).'</a>';
			}
		}

	}
	return $verify;
}

?>