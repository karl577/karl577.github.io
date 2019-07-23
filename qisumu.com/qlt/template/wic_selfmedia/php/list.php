<?php

if(!defined('IN_DISCUZ')) {

	exit('Access Denied');

}



function category_get_wic_list($cat, $wheresql, $page = 1, $perpage = 0) {
	global $_G;
	$cat['perpage'] = empty($cat['perpage']) ? 15 : $cat['perpage'];
	$cat['maxpages'] = empty($cat['maxpages']) ? 1000 : $cat['maxpages'];
	$perpage = intval($perpage);
	$page = intval($page);
	$perpage = empty($perpage) ? $cat['perpage'] : $perpage;
	$page = empty($page) ? 1 : min($page, $cat['maxpages']);
	$start = ($page-1)*$perpage;
	if($start<0) $start = 0;
	$list = array();
	$pricount = 0;
	$multi = '';
	$count = C::t('portal_article_title')->fetch_all_by_sql($wheresql, '', 0, 0, 1, 'at');
	$allpage = @ceil($count/$perpage);
	$nextpage = ($page + 1) > $allpage ? 1 : ($page + 1);
	
	if($count) {
		$wheresql = $wheresql && !is_array($wheresql) ? " WHERE $wheresql" : '';
		$query= DB::fetch_all('SELECT * FROM '.DB::table('portal_article_title').' at LEFT JOIN '.DB::table('portal_article_count').' ac on at.aid = ac.aid %i ORDER BY at.dateline DESC '.DB::limit($start, $perpage), array($wheresql));
		foreach($query as $value) {
			$value['catname'] = $value['catid'] == $cat['catid'] ? $cat['catname'] : $_G['cache']['portalcategory'][$value['catid']]['catname'];
			$value['onerror'] = '';
			if($value['pic']) {
				$value['pic'] = pic_get($value['pic'], '', $value['thumb'], $value['remote'], 1, 1);
			}
			$value['dateline'] = dgmdate($value['dateline']);
			if($value['status'] == 0 || $value['uid'] == $_G['uid'] || $_G['adminid'] == 1) {
				$list[] = $value;
			} else {
				$pricount++;
			}
		}
		if(strpos($cat['caturl'], 'portal.php') === false) {
			$cat['caturl'] .= 'index.php';
			$multipage_more = $cat['caturl'].'?page='.$nextpage;
		}else{
			$multipage_more = $cat['caturl'].'&page='.$nextpage;
			}
		$multi = multi($count, $perpage, $page, $cat['caturl'], $cat['maxpages']);
		
	}
	return $return = array('list'=>$list,'count'=>$count,'multi'=>$multi,'pricount'=>$pricount,'multipage_more'=>$multipage_more,'allpage'=>$allpage);
}












?>