<?php

/*
 * CopyRight  : (C)2012-2099 HaoTeam Inc.
 * Document   : bind.php
 * Created on : 2016-8-4 22:22:26
 * Author     : �ϻ�(Tiger)
 * Description: This is NOT a freeware, use is subject to license terms.
 *              �⼴ʹ��һ��������,ʹ��ʱҲ���������֤����,�õ���ʱ���������.
 *              δ���������,���÷���,����ؾ�;��Ȩ���� HaoTeam Inc;
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
            showmessage(HaoTeamIconv('��ת��....'), getHaoteamButtonLink($mod));
        }
        showmessage(HaoTeamIconv('�������'));
    } else {
        include_once template('tiger_wechatlogin:bind');
    }
} else {
    HbindOpenId($_G['uid'], $_GET['unionid']);
    dheader('location: ' . dreferer());
}