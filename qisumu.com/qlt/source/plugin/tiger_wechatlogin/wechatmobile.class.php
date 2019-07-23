<?php

/*
 * CopyRight  : (C)2012-2099 HaoTeam Inc.
 * Document   : wechatmobile.class.php
 * Created on : 2016-8-4 20:50:48
 * Author     : 老虎(Tiger)
 * Description: This is NOT a freeware, use is subject to license terms.
 *              这即使是一个免费软件,使用时也请遵守许可证条款,得到当时人书面许可.
 *              未经书面许可,不得翻版,翻版必究;版权归属 HaoTeam Inc;
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class mobileplugin_tiger_wechatlogin {

    function __construct() {
        global $_G;

        if (empty($_G['cache']['plugin']['tiger_wechatlogin'])) {
            loadcache("plugin");
        }

        if (empty($_G['cache']['plugin']['tiger_wechatlogin']['radio'])) {
            return;
        }

        $this->allow = true;

        require_once DISCUZ_ROOT . './source/plugin/tiger_wechatlogin/function/function_wechatlogin.php';

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') && $this->allow) {
            $this->is_weixin = true;
        } else {
            return;
        }
    }

    /**
     * 
     * @global type $_G
     * @return type
     */
    function common() {
        global $_G;
        if (empty($this->allow)) {
            return;
        }

        if ($_G['uid']) {
            $_G['wechatuser'] = C::t('#wechat#common_member_wechat')->fetch($_G['uid']);
        }

        if (empty($_G['uid'])) {
            $_G['wechatlogin']['loginlink'] = $_G['siteurl'] . 'plugin.php?id=tiger_wechatlogin&mod=login';
        } else {
            //$_G['wechatlogin']['bindlink'] = $_G['siteurl'] . 'plugin.php?id=tiger_wechatlogin&mod=bind&referer=' . dreferer();
        }
    }

    function global_footer_mobile() {
        global $_G;

        if ($_GET['mod'] == 'register' && $this->is_weixin) {
            return '<div class="btn_login"><div class="pn pnc" onclick="window.location.href=\'' . $_G['wechatlogin']['loginlink'] . '\'"><span>' . HaoTeamIconv('微信注册') . '</span></div></div>';
        }
        
        if ($_G['wechatuser']['isregister'] && $this->is_weixin) {
            //return '<script>showWindow(\'spacecp\',\'plugin.php?id=tiger_wechatlogin&mod=spacecp&referer=' . dreferer() . '\');</script>';
        }
    }

}

class mobileplugin_tiger_wechatlogin_member extends mobileplugin_tiger_wechatlogin {

    function logging_bottom_mobile_output() {
        global $_G;
        if ($this->is_weixin) {
            return '<div class="btn_login"><div class="pn pnc" onclick="window.location.href=\'' . $_G['wechatlogin']['loginlink'] . '\'"><span>' . HaoTeamIconv('微信登录') . '</span></div></div>';
        } else {
            return '';
        }
    }

}
