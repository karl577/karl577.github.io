<?php

if(!defined('IN_DISCUZ')) {

	exit('Access Denied');

}


$hottag = C::t('common_tag')->fetch_all_by_status(NULL,'',0,40,0,'');

if (in_array('dsu_paulsign',$_G['setting']['plugins']['available'])){
/*dsu签到  每天签到人数*/
$sign_num = DB::result_first("select todayq from %t ",array('dsu_paulsignset'));

}

?>