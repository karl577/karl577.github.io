<?php

/*
 * CopyRight  : (C)2012-2099 HaoTeam Inc.
 * Document   : login.php
 * Created on : 2016-8-4 21:34:59
 * Author     : �ϻ�(Tiger)
 * Description: This is NOT a freeware, use is subject to license terms.
 *              �⼴ʹ��һ��������,ʹ��ʱҲ���������֤����,�õ���ʱ���������.
 *              δ���������,���÷���,����ؾ�;��Ȩ���� HaoTeam Inc;
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

    //����Ƿ��Ѿ��󶨻���ע��
    if (Hcheck_openid_auth($_GET['openid'], $_GET['unionid'])) {
        dheader("location: " . dreferer());
    } else {
        _silenceregister($_GET);
    }
}

