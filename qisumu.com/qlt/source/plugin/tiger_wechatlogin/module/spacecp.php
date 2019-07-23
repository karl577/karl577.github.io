<?php

/*
 * CopyRight  : (C)2012-2099 HaoTeam Inc.
 * Document   : spacecp.php
 * Created on : 2016-8-5 1:38:20
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

$_G['wechatuser'] = C::t('#wechat#common_member_wechat')->fetch($_G['uid']);

if (submitcheck('resetpwsubmit') && $_G['wechatuser']['isregister']) {
    if ($_G['setting']['strongpw']) {
        $strongpw_str = array();
        if (in_array(1, $_G['setting']['strongpw']) && !preg_match("/\d+/", $_GET['newpassword1'])) {
            $strongpw_str[] = lang('member/template', 'strongpw_1');
        }
        if (in_array(2, $_G['setting']['strongpw']) && !preg_match("/[a-z]+/", $_GET['newpassword1'])) {
            $strongpw_str[] = lang('member/template', 'strongpw_2');
        }
        if (in_array(3, $_G['setting']['strongpw']) && !preg_match("/[A-Z]+/", $_GET['newpassword1'])) {
            $strongpw_str[] = lang('member/template', 'strongpw_3');
        }
        if (in_array(4, $_G['setting']['strongpw']) && !preg_match("/[^a-zA-z0-9]+/", $_GET['newpassword1'])) {
            $strongpw_str[] = lang('member/template', 'strongpw_4');
        }
        if ($strongpw_str) {
            showmessage(lang('member/template', 'password_weak') . implode(',', $strongpw_str));
        }
    }
    if ($_GET['newpassword1'] !== $_GET['newpassword2']) {
        showmessage('profile_passwd_notmatch');
    }
    if (!$_GET['newpassword1'] || $_GET['newpassword1'] != addslashes($_GET['newpassword1'])) {
        showmessage('profile_passwd_illegal');
    }

    loaducenter();
    uc_user_edit(addslashes($_G['member']['username']), null, $_GET['newpassword1'], null, 1);

    C::t('common_member')->update($_G['uid'], array('password' => md5(random(10))));

    C::t('#wechat#common_member_wechat')->update($_G['uid'], array('isregister' => 0));

    showmessage('wechat:wsq_password_reset', dreferer());
} else {
    include_once template('tiger_wechatlogin:spacecp');
}