<?php

/*
 * CopyRight  : (C)2012-2099 HaoTeam Inc.
 * Document   : login.php
 * Created on : 2016-8-4 21:34:59
 * Author     : 老虎(Tiger)
 * Description: This is NOT a freeware, use is subject to license terms.
 *              这即使是一个免费软件,使用时也请遵守许可证条款,得到当时人书面许可.
 *              未经书面许可,不得翻版,翻版必究;版权归属 HaoTeam Inc;
 */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

if ($_GET['ac'] == 'regcallback') {

    list($unionid, $openidsign, $qrreferer) = explode("\t", authcode(base64_decode($_GET['auth']), 'DECODE'));

    if (!$unionid) {
        showmessage('wechat:wechat_member_auth_fail');
    }

    if (!empty($_G['uid'])) {
        HbindOpenId($_G['uid'], $unionid);
    }

    dheader('location: ' . $qrreferer);
}

if (empty($_GET['unionid'])) {
    dheader("location: " . getHaoteamButtonLink($mod));
} else {

    //检查是否已经绑定或者注册
    if (Hcheck_openid_auth($_GET['openid'], $_GET['unionid'])) {
        dheader("location: " . dreferer());
    } else {
        _silenceregister($_GET);
    }
}

