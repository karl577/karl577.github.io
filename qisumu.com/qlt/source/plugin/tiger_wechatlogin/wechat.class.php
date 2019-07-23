<?php

/*
 * CopyRight  : (C)2012-2099 HaoTeam Inc.
 * Document   : wechat.class.php
 * Created on : 2016-8-4 20:49:17
 * Author     : 老虎(Tiger)
 * Description: This is NOT a freeware, use is subject to license terms.
 *              这即使是一个免费软件,使用时也请遵守许可证条款,得到当时人书面许可.
 *              未经书面许可,不得翻版,翻版必究;版权归属 HaoTeam Inc;
 */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_tiger_wechatlogin {

    var $allow;

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
            $_G['wechatlogin']['loginlink'] = $_G['siteurl'] . 'plugin.php?id=tiger_wechatlogin&mod=login&referer=' . urlencode(dreferer());
        } else {
            $_G['wechatlogin']['bindlink'] = $_G['siteurl'] . 'plugin.php?id=tiger_wechatlogin&mod=bind&referer=' . urlencode(dreferer());
        }

        if ($this->allow && !$_G['uid'] && !defined('IN_MOBILE')) {
            $_G['setting']['pluginhooks']['global_login_text'] = $this->tpl_login_bar();
        }
    }

    /**
     * 
     * @global type $_G
     * @return type
     */
    function global_footer() {
        global $_G;
        if ($_G['wechatuser']['isregister']) {
            return '<script>showWindow(\'spacecp\',\'plugin.php?id=tiger_wechatlogin&mod=spacecp&referer=' . dreferer() . '\');</script>';
        }
        return;
    }

    /**
     * 
     * @global type $_G
     * @return type
     */
    function tpl_login_bar() {
        global $_G;
        if (empty($this->allow) || $_G['uid']) {
            return;
        }
        return '<a href="' . $_G['wechatlogin']['loginlink'] . '" target="_top" rel="nofollow"><img src="./source/plugin/wechat/image/wechat_login.png" class="vm" /></a>';
    }

    /**
     * 头部登录
     * @global type $_G
     * @return type
     */
    function global_login_extra() {
        global $_G;
        if (empty($this->allow) || $_G['uid']) {
            return;
        }
        $return = '<div class="fastlg_fm y" style="margin-right: 10px; padding-right: 10px">
		<p><a href="' . $_G['wechatlogin']['loginlink'] . '"><img src="./source/plugin/wechat/image/wechat_login.png" class="vm" /></a></p>
		<p class="hm xg1" style="padding-top: 2px;">' . HaoTeamIconv('只需一步，快速开始') . '</p>
	</div>';
        return $return;
    }

    /**
     * 头部绑定
     * @global type $_G
     * @return type
     */
    function global_usernav_extra1() {
        global $_G;
        if (empty($this->allow) || empty($_G['uid'])) {
            return;
        }
        if ($_G['wechatuser']['openid']) {
            return;
        }
        return '<a href="javascript:;" onclick="showWindow(\'bind\', \'' . $_G['wechatlogin']['bindlink'] . '\')"><img src="source/plugin/wechat/image/wechat_bind.png" class="qq_bind" align="absmiddle"></a>';
    }

}
