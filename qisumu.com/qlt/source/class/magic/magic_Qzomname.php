<?php

/**
 * 改名道具
 * 改名道具 @ 微动力
 * 改名道具 完美支持好贴吧模板，好贴吧模板体验：http://www.tiebas.com
 * 模板购买、或道具卡使用问题请联系官方客服：QQ   772210120
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class magic_Qzomname {

	var $version = '1.0';
	var $name = '&#x6539;&#x540D;&#x5361;';
	var $description = '&#x7528;&#x4E8E;&#x4FEE;&#x6539;&#x3001;&#x8C03;&#x6574;&#x7528;&#x6237;&#x540D;';
	var $price = '10';
	var $weight = '5';
	var $useevent = 1;
	var $targetgroupperm = false;
	var $copyright = '<a href="http://www.Qzom.net" target="_blank">微动力</a>';
	var $magic = array();
	var $parameters = array();
	function getsetting(&$magic) {
	}

	function setsetting(&$magicnew, &$parameters) {
	}

	function usesubmit() {
		global $_G;
		if(empty($_GET['newusername'])) {
			showmessage("&#x62B1;&#x6B49;&#xFF0C;&#x4F60;&#x8FD8;&#x6CA1;&#x6709;&#x586B;&#x5199;&#x65B0;&#x7684;&#x7528;&#x6237;&#x540D;");
		}
		$newusername = trim($_GET['newusername']);
		if(strlen($newusername) < 3) {
  			showmessage('&#x62B1;&#x6B49;&#xFF0C;&#x65B0;&#x7684;&#x7528;&#x6237;&#x540D;&#x592A;&#x77ED;&#xFF0C;&#x4E0D;&#x7B26;&#x5408;&#x8981;&#x6C42;');
		}
		if(strlen($newusername) > 15) {
  			showmessage('&#x62B1;&#x6B49;&#xFF0C;&#x65B0;&#x7684;&#x7528;&#x6237;&#x540D;&#x592A;&#x957F;&#xFF0C;&#x4E0D;&#x7B26;&#x5408;&#x8981;&#x6C42;');
		}
		$guestexp = '\xA1\xA1|\xAC\xA3|^Guest|^\xD3\xCE\xBF\xCD|\xB9\x43\xAB\xC8';
		$censorexp = '/^('.str_replace(array('\\*', "\r\n", ' '), array('.*', '|', ''), preg_quote(($censoruser = trim($censoruser)), '/')).')$/i'; 
		if(preg_match("/^\s*$|^c:\\con\\con$|[%,\*\"\s\t\<\>\&]|$guestexp/is", $newusername) || ($censoruser && @preg_match($censorexp, $newusername))) {
  			showmessage('profile_username_illegal');
		}

		$query = DB::query("SELECT uid FROM ".DB::table('ucenter_members')." WHERE username ='$newusername'");
			if(DB::num_rows($query)) {
  				showmessage('&#x62B1;&#x6B49;&#xFF0C;&#x8FD9;&#x4E2A;&#x7528;&#x6237;&#x540D;&#xFF0C;&#x5DF2;&#x7ECF;&#x88AB;&#x4F7F;&#x7528;&#x4E86;');
		} else {

		$tables = array(
			'ucenter_members' => array('id' => 'uid', 'name' => 'username'),

			'common_block' => array('id' => 'uid', 'name' => 'username'),
			'common_invite' => array('id' => 'fuid', 'name' => 'fusername'),
			'common_member' => array('id' => 'uid', 'name' => 'username'),
			'common_member_security' => array('id' => 'uid', 'name' => 'username'),
			'common_mytask' => array('id' => 'uid', 'name' => 'username'),
			'common_report' => array('id' => 'uid', 'name' => 'username'),

			'forum_thread' => array('id' => 'authorid', 'name' => 'author'),
			'forum_post' => array('id' => 'authorid', 'name' => 'author'),
			'forum_activityapply' => array('id' => 'uid', 'name' => 'username'),
			'forum_groupuser' => array('id' => 'uid', 'name' => 'username'),
			'forum_pollvoter' => array('id' => 'uid', 'name' => 'username'),
			'forum_postcomment' => array('id' => 'authorid', 'name' => 'author'),
			'forum_ratelog' => array('id' => 'uid', 'name' => 'username'),

			'home_album' => array('id' => 'uid', 'name' => 'username'),
			'home_blog' => array('id' => 'uid', 'name' => 'username'),
			'home_clickuser' => array('id' => 'uid', 'name' => 'username'),
			'home_docomment' => array('id' => 'uid', 'name' => 'username'),
			'home_doing' => array('id' => 'uid', 'name' => 'username'),
			'home_feed' => array('id' => 'uid', 'name' => 'username'),
			'home_feed_app' => array('id' => 'uid', 'name' => 'username'),
			'home_friend' => array('id' => 'fuid', 'name' => 'fusername'),
			'home_friend_request' => array('id' => 'fuid', 'name' => 'fusername'),
			'home_notification' => array('id' => 'authorid', 'name' => 'author'),
			'home_pic' => array('id' => 'uid', 'name' => 'username'),
			'home_poke' => array('id' => 'fromuid', 'name' => 'fromusername'),
			'home_share' => array('id' => 'uid', 'name' => 'username'),
			'home_show' => array('id' => 'uid', 'name' => 'username'),
			'home_specialuser' => array('id' => 'uid', 'name' => 'username'),
			'home_visitor' => array('id' => 'vuid', 'name' => 'vusername'),

			'portal_article_title' => array('id' => 'uid', 'name' => 'username'),
			'portal_comment' => array('id' => 'uid', 'name' => 'username'),
			'portal_topic' => array('id' => 'uid', 'name' => 'username'),
			'portal_topic_pic' => array('id' => 'uid', 'name' => 'username'),
		);

		foreach($tables as $table => $conf) {
			DB::query("UPDATE ".DB::table($table)." SET `$conf[name]`='$newusername' WHERE `$conf[id]`='$_G[uid]'");
		}


			usemagic($this->magic['magicid'], $this->magic['num']);
			updatemagiclog($this->magic['magicid'], '2', '1', '0', 0, 'uid', $_G['uid']);
			showmessage('Hi&#xFF0C;&#x4F60;&#x5DF2;&#x7ECF;&#x6210;&#x529F;&#x7684;&#x4FEE;&#x6539;&#x4E86;&#x7528;&#x6237;&#x540D;', dreferer(), array(), array('showdialog' => 1, 'locationtime' => 1));
		}
	}

	function show() {
		magicshowtype('top');
		magicshowsetting("Hi&#xFF0C;&#x8BF7;&#x8F93;&#x5165;&#x65B0;&#x7528;&#x6237;&#x540D;:", 'newusername','', 'text');
		magicshowtype('bottom');
	}


}

?>