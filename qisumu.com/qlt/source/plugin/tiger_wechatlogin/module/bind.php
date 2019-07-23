<?php

/*
 * CopyRight  : (C)2012-2099 HaoTeam Inc.
 * Document   : bind.php
 * Created on : 2016-8-4 22:22:26
 * Author     : 老虎(Tiger)
 * Description: This is NOT a freeware, use is subject to license terms.
 *              这即使是一个免费软件,使用时也请遵守许可证条款,得到当时人书面许可.
 *              未经书面许可,不得翻版,翻版必究;版权归属 HaoTeam Inc;
 */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

if (!$_G['uid']) {
    showmessage('not_loggedin', NULL, array(), array('login' => 1));
}

if (empty($_GET['unionid'])) {
    if ($_G['uid'] && submitcheck('confirmsubmit')) {
        loaducenter();
        list($result) = uc_user_login(intval($_G['uid']), $_GET['passwordconfirm'], 1, 0);
        if ($result >= 0) {
            showmessage(HaoTeamIconv('跳转绑定....'), getHaoteamButtonLink($mod));
        }
        showmessage(HaoTeamIconv('密码错误'));
    } else {
        include_once template('tiger_wechatlogin:bind');
    }
} else {
    HbindOpenId($_G['uid'], $_GET['unionid']);
    dheader('location: ' . dreferer());
}