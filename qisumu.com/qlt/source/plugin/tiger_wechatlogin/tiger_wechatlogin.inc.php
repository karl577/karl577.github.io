<?php

/*
 * CopyRight  : (C)2012-2099 HaoTeam Inc.
 * Document   : tiger_wechatlogin.inc.php
 * Created on : 2016-8-4 21:31:51
 * Author     : �ϻ�(Tiger)
 * Description: This is NOT a freeware, use is subject to license terms.
 *              �⼴ʹ��һ��������,ʹ��ʱҲ���������֤����,�õ���ʱ���������.
 *              δ���������,���÷���,����ؾ�;��Ȩ���� HaoTeam Inc;
 */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$mod = addslashes($_GET['mod']);

require_once DISCUZ_ROOT . './source/plugin/tiger_wechatlogin/function/function_wechatlogin.php';

require DISCUZ_ROOT . "/source/plugin/tiger_wechatlogin/module/" . $mod . ".php";
