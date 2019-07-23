<?php
/*  nds_votekick Plugin FOR Discuz!  X2.5 X3 X3.2 
	 *	Copyright (c) 20015-2020 WWW.NWDS.CN | NDS.西域数码工作室
	 *  	$Id: nds_votekick.inc.php V3.01 20150203 by SINGCEE $
	 */


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_common_member_nds extends discuz_table_archive
{
	public function __construct() {

		$this->_table = 'common_member';
		$this->_pk    = 'uid';
		$this->_pre_cache_key = 'common_member_';

		parent::__construct();
	}

	public function fetch_by_username($username, $fetch_archive = 0) {
		$user = array();
		if($username) {
			$user = DB::fetch_first('SELECT uid FROM %t WHERE username=%s', array($this->_table, $username));
			if(isset($this->membersplit) && $fetch_archive && empty($user)) {
				$user = C::t($this->_table.'_archive')->fetch_by_username($username, 0);
			}
		}
		return $user['uid'];
	}
	public function fetch_by_uid($uid, $fetch_archive = 0) {
		$user = array();
		if($uid = intval($uid)) {
			$user = DB::fetch_first('SELECT * FROM %t WHERE uid=%d', array($this->_table, $uid));
		}
		return $user;
	}
	public function update_by_uid($uid,$data) {
		$uid = intval($uid);
		if(is_array($data) && $uid) {
			return DB::update($this->_table, $data,DB::field('uid', $uid));
		}
		return 0;
	}
	
	
}

?>