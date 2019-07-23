<?php

/*
 * CopyRight  : (C)2012-2099 HaoTeam Inc.
 * Document   : tiger_wechatlogin.inc.php
 * Created on : 2016-8-4 21:31:51
 * Author     : 老虎(Tiger)
 * Description: This is NOT a freeware, use is subject to license terms.
 *              这即使是一个免费软件,使用时也请遵守许可证条款,得到当时人书面许可.
 *              未经书面许可,不得翻版,翻版必究;版权归属 HaoTeam Inc;
 */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$mod = addslashes($_GET['mod']);

require_once DISCUZ_ROOT . './source/plugin/tiger_wechatlogin/function/function_wechatlogin.php';

require DISCUZ_ROOT . "/source/plugin/tiger_wechatlogin/module/" . $mod . ".php";
