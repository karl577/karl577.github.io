<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: discuz_upload.php 34648 2014-06-18 02:53:07Z hypowang $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


Class extend_discuz_upload{

	var $attach = array();
	var $type = '';
	var $extid = 0;
	var $errorcode = 0;
	var $forcename = '';

	public function __construct() {

	}

	function init($attach, $type = 'temp', $extid = 0, $forcename = '') {

		if(!is_array($attach) || empty($attach)  || trim($attach['name']) == '' || $attach['size'] == 0) {
			$this->attach = array();
			$this->errorcode = -1;
			return false;
		} else {
			$this->type = $this->check_dir_type($type);
			$this->extid = intval($extid);
			$this->forcename = $forcename;

			$attach['size'] = intval($attach['size']);
			$attach['name'] =  trim($attach['name']);
			$attach['thumb'] = '';
			$attach['ext'] = $this->fileext($attach['name']);

			$attach['name'] =  dhtmlspecialchars($attach['name'], ENT_QUOTES);
			if(strlen($attach['name']) > 90) {
				$attach['name'] = cutstr($attach['name'], 80, '').'.'.$attach['ext'];
			}

			$attach['isimage'] = $this->is_image_ext($attach['ext']);
			$attach['extension'] = $this->get_target_extension($attach['ext']);
			$attach['attachdir'] = $this->get_target_dir($this->type, $extid);
			$attach['attachment'] = '7niu/'.$attach['attachdir'].$this->get_target_filename($this->type, $this->extid, $this->forcename).'.'.$attach['extension'];
			$attach['target'] = $this->type.'/'.$attach['attachment'];
			//var_dump($attach['target']);
			$this->attach = & $attach;
			$this->errorcode = 0;
			return true;
		}

	}

	function save($ignore = 0) {
		if($ignore) {
			if(!$this->save_to_local($this->attach['tmp_name'], $this->attach['target'])) {
				$this->errorcode = -103;
				return false;
			} else {
				$this->errorcode = 0;
				return true;
			}
		}
		if(empty($this->attach) || empty($this->attach['tmp_name']) || empty($this->attach['target'])) {
			$this->errorcode = -101;
		} elseif(in_array($this->type, array('group', 'album', 'category')) && !$this->attach['isimage']) {
			$this->errorcode = -102;
		} elseif(in_array($this->type, array('common')) && (!$this->attach['isimage'] && $this->attach['ext'] != 'ext')) {
			$this->errorcode = -102;
		} elseif(!$this->save_to_local($this->attach['tmp_name'], $this->attach['target'])) {
			$this->errorcode = -103;
		} elseif(($this->attach['isimage'] || $this->attach['ext'] == 'swf') && (!($this->attach['imageinfo'] = $this->get_image_info($this->attach, true)))) {
			$this->errorcode = -104;
			@unlink($this->attach['target']);
		} else {
			$this->errorcode = 0;
			return true;
		}

		return false;
	}

	function error() {
		return $this->errorcode;
	}

	function errormessage() {
		return lang('error', 'file_upload_error_'.$this->errorcode);
	}

	function fileext($filename) {
		return addslashes(strtolower(substr(strrchr($filename, '.'), 1, 10)));
	}

	function is_image_ext($ext) {
		static $imgext  = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
		return in_array($ext, $imgext) ? 1 : 0;
	}

	function get_image_info($attach, $allowswf = false) {
		$file_types = array(1=>'GIF',2=>'JPG',3=>'PNG',4=>'SWF',5=>'PSD',6=>'BMP',7=>'TIFF',8=>'TIFF',9=>'JPC',10=>'JP2',11=>'JPX',12=>'JB2',13=>'SWC',14=>'IFF',15=>'WBMP',16 => 'XBM');
		$file_types = array_flip($file_types);
		$file_types['JPEG'] = 2;
		$target = $attach['target'];
		$ext = extend_discuz_upload::fileext($target);
		$isimage = extend_discuz_upload::is_image_ext($ext);
		if(!$isimage && ($ext != 'swf' || !$allowswf)) {
			return false;
		} /*elseif(!is_readable($target)) {
			return false;
		}*/ elseif($_imageinfo =$attach['imageinfo']) {
			$imageinfo = array();
			$imageinfo[0] = $_imageinfo['width'];
			$imageinfo[1] = $_imageinfo['height'];
			$imageinfo[2] = @$file_types[strtoupper($_imageinfo['format'])];
			list($width, $height, $type) = !empty($imageinfo) ? $imageinfo : array('', '', '');
			$size = $width * $height;
			if($size > 16777216 || $size < 16 ) {
				return false;
			} elseif($ext == 'swf' && $type != 4 && $type != 13) {
				return false;
			} elseif($isimage && !in_array($type, array(1,2,3,6,13))) {
				return false;
			} elseif(!$allowswf && ($ext == 'swf' || $type == 4 || $type == 13)) {
				return false;
			}
			return $imageinfo;
		} else {
			return false;
		}
	}

	function is_upload_file($source) {
		return $source && ($source != 'none') && (is_uploaded_file($source) || is_uploaded_file(str_replace('\\\\', '\\', $source)));
	}

	function get_target_filename($type, $extid = 0, $forcename = '') {
		if($type == 'group' || ($type == 'common' && $forcename != '')) {
			$filename = $type.'_'.intval($extid).($forcename != '' ? "_$forcename" : '');
		} else {
			$filename = date('His').strtolower(random(16));
		}
		return $filename;
	}

	function get_target_extension($ext) {
		static $safeext  = array('attach', 'jpg', 'jpeg', 'gif', 'png', 'swf', 'bmp', 'txt', 'zip', 'rar', 'mp3');
		return strtolower(!in_array(strtolower($ext), $safeext) ? 'attach' : $ext);
	}

	function get_target_dir($type, $extid = '', $check_exists = true) {

		$subdir = $subdir1 = $subdir2 = '';
		if($type == 'album' || $type == 'forum' || $type == 'portal' || $type == 'category' || $type == 'profile') {
			$subdir1 = date('Ym');
			$subdir2 = date('d');
			$subdir = $subdir1.'/'.$subdir2.'/';
		} elseif($type == 'group' || $type == 'common') {
			$subdir = $subdir1 = substr(md5($extid), 0, 2).'/';
		}

		$check_exists && extend_discuz_upload::check_dir_exists($type, $subdir1, $subdir2);

		return $subdir;
	}

	function check_dir_type($type) {
		return !in_array($type, array('forum', 'group', 'album', 'portal', 'common', 'temp', 'category', 'profile')) ? 'temp' : $type;
	}

	function check_dir_exists($type = '', $sub1 = '', $sub2 = '') {

		$type = extend_discuz_upload::check_dir_type($type);

		$basedir = !getglobal('setting/attachdir') ? (DISCUZ_ROOT.'./data/attachment') : getglobal('setting/attachdir');

		$typedir = $type ? ($basedir.'/'.$type) : '';
		$subdir1  = $type && $sub1 !== '' ?  ($typedir.'/'.$sub1) : '';
		$subdir2  = $sub1 && $sub2 !== '' ?  ($subdir1.'/'.$sub2) : '';

		$res = $subdir2 ? is_dir($subdir2) : ($subdir1 ? is_dir($subdir1) : is_dir($typedir));
		if(!$res) {
			$res = $typedir && extend_discuz_upload::make_dir($typedir);
			$res && $subdir1 && ($res = extend_discuz_upload::make_dir($subdir1));
			$res && $subdir1 && $subdir2 && ($res = extend_discuz_upload::make_dir($subdir2));
		}

		return $res;
	}

	function save_to_local($source, $target) {
		global $_G;
		require_once(dirname(__FILE__)."/qiniu/rs.php");

		$bucket = $_G['cache']['plugin']["qiniuyun"]['bucket'];//'video';

		Qiniu_SetKeys($_G['cache']['plugin']["qiniuyun"]['accessKey'], $_G['cache']['plugin']["qiniuyun"]['secretKey']);
		$client = new Qiniu_MacHttpClient(null);

		$err = Qiniu_RS_Move($client,$bucket,$source,$bucket,$target);
		if ($err !== null) {
			return $err;
		} else {
			return true;
		}
	}

	function make_dir($dir, $index = true) {
		$res = true;
		if(!is_dir($dir)) {
			$res = @mkdir($dir, 0777);
			$index && @touch($dir.'/index.html');
		}
		return $res;
	}
}

?>