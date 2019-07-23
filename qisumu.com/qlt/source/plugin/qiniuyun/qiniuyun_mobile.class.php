<?php
/**
 *	[ÆßÅ£ÔÆÂÛÌ³ÔÆ´æ´¢(qiniuyun.{modulename})] (C)2016-2099 Powered by Å¶»í.
 *	Version: 1
 *	Date: 2016-3-16 13:46
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class mobileplugin_qiniuyun {
	//TODO - Insert your code here
	/*function post_upload_extend($c){
		global $_G;
		require_once libfile('function/upload');
		$swfconfig = getuploadconfig($_G['uid'], $_G['fid']);
		$imgexts = str_replace(array(';', '*.'), array(', ', ''), $swfconfig['imageexts']['ext']);
		$allowpostimg = $_G['group']['allowpostimage'] && $imgexts;
		//ob_start();
		include template('qiniuyun:upload');
		//$return = ob_get_contents();
		//@ob_end_clean();
		return $return;
	}
	function forumdisplay_fastpost_upload_extend(){
		global $_G;
		require_once libfile('function/upload');
		$swfconfig = getuploadconfig($_G['uid'], $_G['fid']);
		$imgexts = str_replace(array(';', '*.'), array(', ', ''), $swfconfig['imageexts']['ext']);
		$allowpostimg = $_G['group']['allowpostimage'] && $imgexts;
		//ob_start();
		include template('qiniuyun:fast_upload');
		//$return = ob_get_contents();
		//@ob_end_clean();
		return $return;
	}
	*/
}
class mobileplugin_qiniuyun_forum extends mobileplugin_qiniuyun {
	function image(){
		global $_G;
		$nocache = !empty($_GET['nocache']) ? 1 : 0;
		$daid = intval($_GET['aid']);
		$type = !empty($_GET['type']) ? $_GET['type'] : 'fixwr';
		list($w, $h) = explode('x', $_GET['size']);
		$dw = intval($w);
		$dh = intval($h);
		$thumbfile = 'image/'.helper_attach::makethumbpath($daid, $dw, $dh);$attachurl = helper_attach::attachpreurl();
		if(!$nocache) {
			if(file_exists($_G['setting']['attachdir'].$thumbfile)) {
				dheader('location: '.$attachurl.$thumbfile);
			}
		}

		define('NOROBOT', TRUE);

		$id = !empty($_GET['atid']) ? $_GET['atid'] : $daid;
		if(dsign($id.'|'.$dw.'|'.$dh) != $_GET['key']) {
			dheader('location: '.$_G['siteurl'].'static/image/common/none.gif');
		}

		if($attach = C::t('forum_attachment_n')->fetch('aid:'.$daid, $daid, array(1, -1))) {
			if(!$dw && !$dh && $attach['tid'] != $id) {
				dheader('location: '.$_G['siteurl'].'static/image/common/none.gif');
			}
			dheader('Expires: '.gmdate('D, d M Y H:i:s', TIMESTAMP + 3600).' GMT');
			if($attach['remote']) {
				$filename = $_G['setting']['ftp']['attachurl'].'forum/'.$attach['attachment'];
			} else {
				$filename = $_G['setting']['attachdir'].'forum/'.$attach['attachment'];
			}
			if(strpos($attach['attachment'],'7niu/')===0){
				require_once(dirname(__FILE__)."/qiniu/rs.php");
				$bucket = $_G['cache']['plugin']["qiniuyun"]['bucket'];
				//global $_G;
				$base_url = $_G['cache']['plugin']["qiniuyun"]['url'].'/';
				$attach_url = $_G['setting']['attachurl'];
				Qiniu_SetKeys($_G['cache']['plugin']["qiniuyun"]['accessKey'], $_G['cache']['plugin']["qiniuyun"]['secretKey']);
				$client = new Qiniu_RS_GetPolicy();
				$types = array('fixnone'=>1,'fixwr'=>2);
				$type = isset($types[$type])?$types[$type]:1;
				$file = $base_url.'forum/'.$attach['attachment']."?imageView/{$type}/w/{$w}/h/{$h}";
				$file = $client->MakeRequest($file);
				dheader('location: '.$file);
			}
			else{
				require_once libfile('class/image');
				$img = new image;
				if($img->Thumb($filename, $thumbfile, $w, $h, $type)) {
					if($nocache) {
						dheader('Content-Type: image');
						@readfile($_G['setting']['attachdir'].$thumbfile);
						@unlink($_G['setting']['attachdir'].$thumbfile);
					} else {
						dheader('location: '.$attachurl.$thumbfile);
					}
				} else {
					dheader('Content-Type: image');
					@readfile($filename);
				}
			}
		}
		exit;
	}
	function attachment(){
		global $_G;
		@list($_GET['aid'], $_GET['k'], $_GET['t'], $_GET['uid'], $_GET['tableid']) = daddslashes(explode('|', base64_decode($_GET['aid'])));

		$requestmode = !empty($_GET['request']) && empty($_GET['uid']);
		$aid = intval($_GET['aid']);
		$k = $_GET['k'];
		$t = $_GET['t'];
		$authk = !$requestmode ? substr(md5($aid.md5($_G['config']['security']['authkey']).$t.$_GET['uid']), 0, 8) : md5($aid.md5($_G['config']['security']['authkey']).$t);

		if($k != $authk) {
			if(!$requestmode) {
				showmessage('attachment_nonexistence');
			} else {
				exit;
			}
		}

		if(!empty($_GET['findpost']) && ($attach = C::t('forum_attachment')->fetch($aid))) {
			dheader('location: forum.php?mod=redirect&goto=findpost&pid='.$attach['pid'].'&ptid='.$attach['tid']);
		}

		if($_GET['uid'] != $_G['uid'] && $_GET['uid']) {
			$_G['uid'] = $_GET['uid'] = intval($_GET['uid']);
			$member = getuserbyuid($_GET['uid']);
			loadcache('usergroup_'.$member['groupid']);
			$_G['group'] = $_G['cache']['usergroup_'.$member['groupid']];
			$_G['group']['grouptitle'] = $_G['cache']['usergroup_'.$_G['groupid']]['grouptitle'];
			$_G['group']['color'] = $_G['cache']['usergroup_'.$_G['groupid']]['color'];
		}


		$tableid = 'aid:'.$aid;

		if($_G['setting']['attachexpire']) {

			if(TIMESTAMP - $t > $_G['setting']['attachexpire'] * 3600) {
				$aid = intval($aid);
				if($attach = C::t('forum_attachment_n')->fetch($tableid, $aid)) {
					if($attach['isimage']) {
						dheader('location: '.$_G['siteurl'].'static/image/common/none.gif');
					} else {
						if(!$requestmode) {
							showmessage('attachment_expired', '', array('aid' => aidencode($aid, 0, $attach['tid']), 'pid' => $attach['pid'], 'tid' => $attach['tid']));
						} else {
							exit;
						}
					}
				} else {
					if(!$requestmode) {
						showmessage('attachment_nonexistence');
					} else {
						exit;
					}
				}
			}
		}

		$readmod = getglobal('config/download/readmod');
		$readmod = $readmod > 0 && $readmod < 5 ? $readmod : 2;

		$refererhost = parse_url($_SERVER['HTTP_REFERER']);
		$serverhost = $_SERVER['HTTP_HOST'];
		if(($pos = strpos($serverhost, ':')) !== FALSE) {
			$serverhost = substr($serverhost, 0, $pos);
		}

		if(!$requestmode && $_G['setting']['attachrefcheck'] && $_SERVER['HTTP_REFERER'] && !($refererhost['host'] == $serverhost)) {
			showmessage('attachment_referer_invalid', NULL);
		}

		periodscheck('attachbanperiods');

		loadcache('threadtableids');
		$threadtableids = !empty($_G['cache']['threadtableids']) ? $_G['cache']['threadtableids'] : array();
		if(!in_array(0, $threadtableids)) {
			$threadtableids = array_merge(array(0), $threadtableids);
		}
		$archiveid = in_array($_GET['archiveid'], $threadtableids) ? intval($_GET['archiveid']) : 0;


		$attachexists = FALSE;
		if(!empty($aid) && is_numeric($aid)) {
			$attach = C::t('forum_attachment_n')->fetch($tableid, $aid);
			if(strpos($attach['attachment'],'7niu/')===0){
				$attach['is_7niu'] = true;
			}
			$thread = C::t('forum_thread')->fetch_by_tid_displayorder($attach['tid'], 0, '>=', null, $archiveid);
			if($_G['uid'] && $attach['uid'] != $_G['uid']) {
				if($attach) {
					$attachpost = C::t('forum_post')->fetch($thread['posttableid'], $attach['pid'], false);
					$attach['invisible'] = $attachpost['invisible'];
					unset($attachpost);
				}
				if($attach && $attach['invisible'] == 0) {
					$thread && $attachexists = TRUE;
				}
			} else {
				$attachexists = TRUE;
			}
		}

		if(!$attachexists) {
			if(!$requestmode) {
				showmessage('attachment_nonexistence');
			} else {
				exit;
			}
		}
		if(!$requestmode) {
			$forum = C::t('forum_forumfield')->fetch_info_for_attach($thread['fid'], $_G['uid']);

			$_GET['fid'] = $forum['fid'];

			if($attach['isimage']) {
				$allowgetattach = !empty($forum['allowgetimage']) || (($_G['group']['allowgetimage'] || $_G['uid'] == $attach['uid']) && !$forum['getattachperm']) || forumperm($forum['getattachperm']);
			} else {
				$allowgetattach = !empty($forum['allowgetattach']) || (($_G['group']['allowgetattach']  || $_G['uid'] == $attach['uid']) && !$forum['getattachperm']) || forumperm($forum['getattachperm']);
			}
			if($allowgetattach && ($attach['readperm'] && $attach['readperm'] > $_G['group']['readaccess']) && $_G['adminid'] <= 0 && !($_G['uid'] && $_G['uid'] == $attach['uid'])) {
				showmessage('attachment_forum_nopermission', NULL, array(), array('login' => 1));
			}

			$ismoderator = in_array($_G['adminid'], array(1, 2)) ? 1 : ($_G['adminid'] == 3 ? C::t('forum_moderator')->fetch_uid_by_tid($attach['tid'], $_G['uid'], $archiveid) : 0);

			$ispaid = FALSE;
			$exemptvalue = $ismoderator ? 128 : 16;
			if(!$thread['special'] && $thread['price'] > 0 && (!$_G['uid'] || ($_G['uid'] != $attach['uid'] && !($_G['group']['exempt'] & $exemptvalue)))) {
				if(!$_G['uid'] || $_G['uid'] && !($ispaid = C::t('common_credit_log')->count_by_uid_operation_relatedid($_G['uid'], 'BTC', $attach['tid']))) {
					showmessage('attachment_payto', 'forum.php?mod=viewthread&tid='.$attach['tid']);
				}
			}

			$exemptvalue = $ismoderator ? 64 : 8;
			if($attach['price'] && (!$_G['uid'] || ($_G['uid'] != $attach['uid'] && !($_G['group']['exempt'] & $exemptvalue)))) {
				$payrequired = $_G['uid'] ? !C::t('common_credit_log')->count_by_uid_operation_relatedid($_G['uid'], 'BAC', $attach['aid']) : 1;
				$payrequired && showmessage('attachement_payto_attach', 'forum.php?mod=misc&action=attachpay&aid='.$attach['aid'].'&tid='.$attach['tid']);
			}
		}

		$isimage = $attach['isimage'];
		$_G['setting']['ftp']['hideurl'] = $_G['setting']['ftp']['hideurl'] || ($isimage && !empty($_GET['noupdate']) && $_G['setting']['attachimgpost'] && strtolower(substr($_G['setting']['ftp']['attachurl'], 0, 3)) == 'ftp');

		//var_dump($attach['is_7niu']);exit;
		if(empty($_GET['nothumb']) && $attach['isimage'] && $attach['thumb']) {
			$db = DB::object();
			$db->close();
			!$_G['config']['output']['gzip'] && ob_end_clean();
			dheader('Content-Disposition: inline; filename='.getimgthumbname($attach['filename']));
			dheader('Content-Type: image/pjpeg');
			if(isset($attach['is_7niu'])&&$attach['is_7niu']){
				getqiniufile($attach['attachment']);
			}
			else if($attach['remote']) {
				$_G['setting']['ftp']['hideurl'] ? getremotefile(getimgthumbname($attach['attachment'])) : dheader('location:'.$_G['setting']['ftp']['attachurl'].'forum/'.getimgthumbname($attach['attachment']));
			} else {
				getlocalfile($_G['setting']['attachdir'].'/forum/'.getimgthumbname($attach['attachment']));
			}
			exit();
		}
		if(isset($attach['is_7niu'])&&$attach['is_7niu']){
			//getqiniufile($attach['attachment']);
			$filename = $_G['cache']['plugin']["qiniuyun"]['url'].'/forum/'.$attach['attachment'];
		}
		else{
			$filename = $_G['setting']['attachdir'].'/forum/'.$attach['attachment'];
		}
		if(!$attach['remote'] &&!isset($attach['is_7niu'])&& !is_readable($filename)) {
			$storageService = Cloud::loadClass('Service_Storage');
			$storageService->checkAttachment($attach);
			if(!$requestmode) {
				showmessage('attachment_nonexistence');
			} else {
				exit;
			}
		}


		if(!$requestmode) {
			if(!$ispaid && !$forum['allowgetattach']) {
				if(!$forum['getattachperm'] && !$allowgetattach) {
					showmessage('getattachperm_none_nopermission', NULL, array(), array('login' => 1));
				} elseif(($forum['getattachperm'] && !forumperm($forum['getattachperm'])) || ($forum['viewperm'] && !forumperm($forum['viewperm']))) {
					showmessagenoperm('getattachperm', $forum['fid']);
				}
			}

			$exemptvalue = $ismoderator ? 32 : 4;
			if(!$isimage && !($_G['group']['exempt'] & $exemptvalue)) {
				$creditlog = updatecreditbyaction('getattach', $_G['uid'], array(), '', 1, 0, $thread['fid']);
				if($creditlog['updatecredit']) {
					if($_G['uid']) {
						$k = $_GET['ck'];
						$t = $_GET['t'];
						if(empty($k) || empty($t) || $k != substr(md5($aid.$t.md5($_G['config']['security']['authkey'])), 0, 8) || TIMESTAMP - $t > 3600) {
							dheader('location: forum.php?mod=misc&action=attachcredit&aid='.$attach['aid'].'&formhash='.FORMHASH);
							exit();
						}
					} else {
						showmessage('attachment_forum_nopermission', NULL, array(), array('login' => 1));
					}
				}
			}

		}

		$range = 0;
		if($readmod == 4 && !empty($_SERVER['HTTP_RANGE'])) {
			list($range) = explode('-',(str_replace('bytes=', '', $_SERVER['HTTP_RANGE'])));
		}

		if(!$requestmode && !$range && empty($_GET['noupdate'])) {
			if($_G['setting']['delayviewcount']) {
				$_G['forum_logfile'] = './data/cache/forum_attachviews_'.intval(getglobal('config/server/id')).'.log';
				if(substr(TIMESTAMP, -1) == '0') {
					attachment_updateviews($_G['forum_logfile']);
				}

				if(@$fp = fopen(DISCUZ_ROOT.$_G['forum_logfile'], 'a')) {
					fwrite($fp, "$aid\n");
					fclose($fp);
				} elseif($_G['adminid'] == 1) {
					showmessage('view_log_invalid', '', array('logfile' => $_G['forum_logfile']));
				}
			} else {
				C::t('forum_attachment')->update_download($aid);
			}
		}

		$db = DB::object();
		$db->close();
		!$_G['config']['output']['gzip'] && ob_end_clean();


		if($attach['remote'] && !$_G['setting']['ftp']['hideurl'] && $isimage) {
			dheader('location:'.$_G['setting']['ftp']['attachurl'].'forum/'.$attach['attachment']);
		}

		$filesize = (!$attach['remote']&&!$attach['is_7niu']) ? filesize($filename) : $attach['filesize'];
		$attach['filename'] = '"'.(strtolower(CHARSET) == 'utf-8' && strexists($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? urlencode($attach['filename']) : $attach['filename']).'"';

		dheader('Date: '.gmdate('D, d M Y H:i:s', $attach['dateline']).' GMT');
		dheader('Last-Modified: '.gmdate('D, d M Y H:i:s', $attach['dateline']).' GMT');
		dheader('Content-Encoding: none');

		if($isimage && !empty($_GET['noupdate']) || !empty($_GET['request'])) {
			dheader('Content-Disposition: inline; filename='.$attach['filename']);
		} else {
			dheader('Content-Disposition: attachment; filename='.$attach['filename']);
		}
		if($isimage) {
			dheader('Content-Type: image');
		} else {
			dheader('Content-Type: application/octet-stream');
		}

		dheader('Content-Length: '.$filesize);

		$xsendfile = getglobal('config/download/xsendfile');
		if(!empty($xsendfile)) {
			$type = intval($xsendfile['type']);
			$cmd = '';
			switch ($type) {
				case 1: $cmd = 'X-Accel-Redirect'; $url = $xsendfile['dir'].$attach['attachment']; break;
				case 2: $cmd = $_SERVER['SERVER_SOFTWARE'] <'lighttpd/1.5' ? 'X-LIGHTTPD-send-file' : 'X-Sendfile'; $url = $filename; break;
				case 3: $cmd = 'X-Sendfile'; $url = $filename; break;
			}
			if($cmd) {
				dheader("$cmd: $url");
				exit();
			}
		}

		if($readmod == 4) {
			dheader('Accept-Ranges: bytes');
			if(!empty($_SERVER['HTTP_RANGE'])) {
				$rangesize = ($filesize - $range) > 0 ?  ($filesize - $range) : 0;
				dheader('Content-Length: '.$rangesize);
				dheader('HTTP/1.1 206 Partial Content');
				dheader('Content-Range: bytes='.$range.'-'.($filesize-1).'/'.($filesize));
			}
		}
		if(isset($attach['is_7niu'])&&$attach['is_7niu']){
			getqiniufile($attach['attachment']);
		}
		else{
			$attach['remote'] ? getremotefile($attach['attachment']) : getlocalfile($filename, $readmod, $range);

		}
		exit;
	}

	function viewthread_bottom_output($a) {
		global $postlist;
		global $_G;
		$base_url = rtrim($_G['cache']['plugin']["qiniuyun"]['url'],'/').'/';
		$base_url = trim($base_url);
		if(strpos($base_url,'http')!==0){
			$base_url = 'http://'.$base_url;
		}
		$attach_url = rtrim($_G['setting']['attachurl'],'/').'/';
		foreach($postlist as $k=>$post){
			foreach($post['attachments'] as $a_key=>$attach){
				if(strpos($attach['attachment'],'7niu')===0){
					$post['attachments'][$a_key]['url'] = str_replace($attach_url,$base_url,$attach['url']);
				}
			}

			$message = $post['message'];
			$ereg = '/(\"'.str_replace('/','\/',$attach_url).'[^\"]*\/7niu\/[^\"]*\")/';
			preg_match_all($ereg,$message,$code);
			if(!empty($code) &&!empty($code[0])){
				foreach($code[0] as $_code){
					$message = str_replace($_code,'"'.$base_url.str_replace(array('"',$attach_url),'',$_code).'"',$message);
				}
			}
			$post['message'] = $message;
			$postlist[$k] = $post;
		}
		return '';
	}
	/*function viewthread_attach_extra_output(){
		global $postlist;
		global $_G;

		$base_url = $_G['cache']['plugin']["qiniuyun"]['url'].'/';
		$attach_url = $_G['setting']['attachurl'];
		foreach($postlist as $k=>$post){
			foreach($post['attachments'] as $a_key=>$attach){
				if(strpos($attach['attachment'],'7niu')===0){
					$post['attachments'][$a_key]['url'] = str_replace($attach_url,$base_url,$attach['url']);
				}
			}

			$message = $post['message'];
			$ereg = '/(\"'.str_replace('/','\/',$attach_url).'[^\"]*\/7niu\/[^\"]*\")/';
			preg_match_all($ereg,$message,$code);
			if(!empty($code) &&!empty($code[0])){
				foreach($code[0] as $_code){
					$message = str_replace($_code,'"'.$base_url.'/'.str_replace(array('"',$attach_url),'',$_code).'"',$message);
				}
			}
			$post['message'] = $message;
			$postlist[$k] = $post;
		}
		return array();
	}*/

}
if(!function_exists('getqiniufile')){
	function getqiniufile($attach_file){
		global $_G;
		require_once(dirname(__FILE__)."/qiniu/rs.php");
		$bucket = $_G['cache']['plugin']["qiniuyun"]['bucket'];
		//global $_G;
		$base_url = $_G['cache']['plugin']["qiniuyun"]['url'].'/';
		$attach_url = $_G['setting']['attachurl'];
		Qiniu_SetKeys($_G['cache']['plugin']["qiniuyun"]['accessKey'], $_G['cache']['plugin']["qiniuyun"]['secretKey']);
		$client = new Qiniu_RS_GetPolicy();
		$file = $base_url.'/forum/'.$attach_file;
		$file = $client->MakeRequest($file);
		getlocalfile($file);
		//echo $file;exit;
		//dheader('location:'.$file);
		//readfile($file);
	}
}

if(!function_exists('getremotefile')){
	function getremotefile($file) {
		global $_G;
		@set_time_limit(0);
		if(!@readfile($_G['setting']['ftp']['attachurl'].'forum/'.$file)) {
			$ftp = ftpcmd('object');
			$tmpfile = @tempnam($_G['setting']['attachdir'], '');
			if($ftp->ftp_get($tmpfile, 'forum/'.$file, FTP_BINARY)) {
				@readfile($tmpfile);
				@unlink($tmpfile);
			} else {
				@unlink($tmpfile);
				return FALSE;
			}
		}
		return TRUE;
	}
}


if(!function_exists('getlocalfile')){
	function getlocalfile($filename, $readmod = 2, $range = 0) {
		if($readmod == 1 || $readmod == 3 || $readmod == 4) {
			if($fp = @fopen($filename, 'rb')) {
				@fseek($fp, $range);
				if(function_exists('fpassthru') && ($readmod == 3 || $readmod == 4)) {
					@fpassthru($fp);
				} else {
					echo @fread($fp, filesize($filename));
				}
			}
			@fclose($fp);
		} else {
			@readfile($filename);
		}
		@flush(); @ob_flush();
	}
}

if(!function_exists('attachment_updateviews')){
	function attachment_updateviews($logfile) {
		$viewlog = $viewarray = array();
		$newlog = DISCUZ_ROOT.$logfile.random(6);
		if(@rename(DISCUZ_ROOT.$logfile, $newlog)) {
			$viewlog = file($newlog);
			unlink($newlog);
			if(is_array($viewlog) && !empty($viewlog)) {
				$viewlog = array_count_values($viewlog);
				foreach($viewlog as $id => $views) {
					if($id > 0) {
						$viewarray[$views][] = intval($id);
					}
				}
				foreach($viewarray as $views => $ids) {
					C::t('forum_attachment')->update_download($ids, $views);
				}
			}
		}
	}
}