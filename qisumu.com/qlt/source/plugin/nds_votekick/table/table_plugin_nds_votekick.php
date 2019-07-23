<?php
/*  nds_votekick Plugin FOR Discuz!  X2.5 X3 X3.2 
	 *	Copyright (c) 20015-2020 WWW.NWDS.CN | NDS.西域数码工作室
	 *  	$Id: nds_votekick.inc.php V3.01 20150203 by SINGCEE $
	 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_plugin_nds_votekick extends discuz_table
{
	public function __construct() {

		$this->_table = 'nds_votekick';
		$this->_pk    = 'tid';
		parent::__construct();
	}
	public function fetch_by_tid($tid) {
		$tid = dintval($tid, true);
		$data = array();
		$data = DB::fetch_first('SELECT *  FROM %t WHERE tid=%d ', array($this->_table, $tid));
		return $data;
	}
	

	public function update_by_tid($tid,$data,$islock=0) {
		$condition = array();
		$tid = dintval($tid, true);
		$condition[] = DB::field('tid', $tid);
		$islock = dintval($islock, true);
		$condition[] = DB::field('islock', $islock);
		if(is_array($data) && $tid) {
			return DB::update($this->_table, $data, implode(' AND ', $condition));
		}
		return 0;
	}
	public function insert($data, $return_insert_id = false, $replace = false, $silent = false) {
		if($data && is_array($data)) {
	    	return DB::insert($this->_table, $data, $return_insert_id, $replace, $silent);
		}
		return 0;
	}
}
?>