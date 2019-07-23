<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}




$user = array();

$user = getuserbyuid($article['uid'], 1);

loadcache('usergroups');

$user['admingroup'] = $_G['cache']['usergroups'][$user['adminid']];

$user['admingroup']['icon'] = g_icon($user['adminid'], 1);

$user['group'] = $_G['cache']['usergroups'][$user['groupid']];

$user['group']['icon'] = g_icon($user['groupid'], 1);

$user['verify'] = _get_verify_by_author($user['uid']);

$user['count'] = C::t('common_member_count')->fetch($user['uid']);

$user['count']['articles'] = C::t('portal_article_title')->fetch_all_by_sql(array('uid'=>$user['uid']),'',0,0,1,'');

$lastarticle = C::t('portal_article_title')->fetch_all_by_sql(array('uid'=>$user['uid']),'ORDER BY dateline DESC',0,5,0,'');
	
	
		



function _get_verify_by_author($ids) {
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