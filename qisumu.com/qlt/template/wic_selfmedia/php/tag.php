<?php

if(!defined('IN_DISCUZ')) {

	exit('Access Denied');

}


$hottag = C::t('common_tag')->fetch_all_by_status(NULL,'',0,20,0,'');





?>