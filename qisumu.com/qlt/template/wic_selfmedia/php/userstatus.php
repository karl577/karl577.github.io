<?php

if(!defined('IN_DISCUZ')) {

	exit('Access Denied');

}


getuserprofile('threads');

getuserprofile('favtimes');

getuserprofile('friends');


$taskdoings = C::t('common_mytask')->count($_G['uid'],false,0);

$favorites = C::t('home_favorite')->count_by_uid_idtype($_G['uid']) ;


function getVerifys(){
	$i=1;
	while( $i<=7 ) 
	{ 
		$verifynum += getuserprofile("verify$i"); 
	    $i++;
	}
	return $verifynum;
}

$verifynum = getVerifys();

?>