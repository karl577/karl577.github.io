<?php
/**
 *      A plugin for user to get a article from weixin
 *      version: 1.1.2
 *      author: Kim.L, email: pxbeta@qq.com
 *      $Id: wxart.class.php 2017/01/09 $
 */
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
class plugin_wxart{
	function plugin_wxart(){
	}
}

class plugin_wxart_forum extends plugin_wxart{
	function post_editorctrl_left(){
		global $_G;
		$wxart_usergroups = unserialize($_G['cache']['plugin']['wxart']['wxart_usergroups']);
		$ret = in_array($_G['groupid'], $wxart_usergroups) && (checkperm('allowpost')||checkperm('allowreply'))? '<link rel="stylesheet" type="text/css" href="source/plugin/wxart/source/wxart.css"/><script type="text/javascript">var wxlang={\'title\':\''.lang('plugin/wxart', 'bbcode_prompt') .'\',\'btn_text\':\''.lang('plugin/wxart', 'btn_text') .'\',\'error\':\''.lang('plugin/wxart', 'done_url_error').'\',\'catching\':\''.lang('plugin/wxart', 'done_catching').'\',\'catch_error\':\''.lang('plugin/wxart', 'done_catch_error').'\',\'no_right\':\''.lang('plugin/wxart', 'done_catch_no_right').'\'};</script><script type="text/javascript" src="source/plugin/wxart/source/wxart.js"></script><a id="ex_wxart" onclick="bindWxart()" title="'.lang('plugin/wxart', 'e_wxart_title') .'" href="javascript:;">'.lang('plugin/wxart', 'e_wxart') .'</a>' : '';
		return $ret;
	}
}
