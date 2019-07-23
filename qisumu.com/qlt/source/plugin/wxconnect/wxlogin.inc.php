<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once dirname(__FILE__)."/class/env.class.php";
$qrid = isset($_GET['qrid']) ? $_GET['qrid'] : 0;
$landurl = isset($_GET['landurl']) ? urldecode($_GET['landurl']) : wxconnect_env::get_siteurl();
if(!$_G['uid']){
    
    $userinfo = C::m("#wxconnect#wxconnect_wxapi")->getWxUserInfo();
    $openid = $userinfo['openid'];
    $row = C::t("#wxconnect#wxconnect_member")->getByOpenid($openid);
    
    if (!empty($row)) {
        $uid = $row['uid'];
        
        $timeout = 86400;
        $dlt = time()-$row['uptime'];
        if ($dlt>$timeout) {
            C::t("#wxconnect#wxconnect_member")->updateUserinfo($uid, json_encode($userinfo));
            if (isset($userinfo['headimgurl'])) {
                C::m("#wxconnect#wxconnect_uc")->sync_avatar($uid, $userinfo['headimgurl']);
            }
        }
        C::m("#wxconnect#wxconnect_uc")->dologin($uid);
    }
    
    else {
        $nickname = diconv($userinfo['nickname'], 'UTF-8', CHARSET);
        $uid = C::m("#wxconnect#wxconnect_uc")->regist($nickname);
        C::t("#wxconnect#wxconnect_member")->save($uid,$openid,$nickname,json_encode($userinfo));
        if (isset($userinfo['headimgurl'])) {
            C::m("#wxconnect#wxconnect_uc")->sync_avatar($uid, $userinfo['headimgurl']);
        }
    }
	
	if ($qrid!=0) 
		C::t('#wxconnect#wxconnect_login_qrcode')->save($qrid,$uid,$openid);
}
else {
	if ($qrid!=0) 
		C::t('#wxconnect#wxconnect_login_qrcode')->save($qrid,$_G['uid'],'');
}
header("Location: ".$landurl);