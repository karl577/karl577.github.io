<?php 
	if(!defined('IN_DISCUZ')) {
		exit('Access Denied');
	}

	if(empty($_GET['formhash']) || $_GET['formhash'] != formhash() ){
		$contents['subject'] = "";
		$contents['message'] = "";
		echo json_encode($contents);
		exit;
	}
		
   $xmlcfg = $_G['cache']['plugin']['xiaomy_getwxarticle'];

   if(!$_G['uid']){
   		showmessage("uid error");
   }
   
   $groups = dunserialize($xmlcfg['xiaomy_groups']);
   
   if(!in_array($_G['groupid'],$groups)){
   		showmessage(lang('plugin/xiaomy_getwxarticle','grouptips'));
   }
	
   $wxurl = dhtmlspecialchars($_GET['wechaturl']);
   //判断url是否合法
   if(!check_url($wxurl)){
		$contents['subject'] = "";
		$contents['message'] = "";
		echo json_encode($contents);
		exit;
	}
	
	//使用dz自带函数dfsockopen获取内容
	$urlcontent = dfsockopen($wxurl);
	
	//获取不到内容直接返回空
	if(!$urlcontent){
		$contents['subject'] = "";
		$contents['message'] = "";
		echo json_encode($contents);
		exit;
	}

	$title = get_title($urlcontent);
	//如果匹配不到 返回空数据报错
	if(!$title){
		$contents['subject'] = "";
		$contents['message'] = "";
		echo json_encode($contents);
		exit;
	}
	
	$pattstr = '/<div class="rich_media_content " id="js_content">(.*)<\/div>/iUs';
	preg_match($pattstr, $urlcontent,$bodycontent);
	//如果匹配不到 返回空数据报错
	if(!$bodycontent){
		$contents['subject'] = "";
		$contents['message'] = "";
		echo json_encode($contents);
		exit;
	}
	
	$bodycontent=$bodycontent[1];
	
	$attachcontent = get_contents($bodycontent);

	$contents['subject'] = $title;
	
	$contents['message'] = $attachcontent;
	
	//包装成json格式
	echo json_encode($contents);
		
	function get_title($content){
		$patternstr = '/<title>(.*)<\/title>/iUs';
		preg_match($patternstr, $content,$title);
		$title =  trim(dhtmlspecialchars($title[1]));
		return $title;
	}

	function get_contents($content){
		global $_G;
		$imgurl=array();
		$upload = new discuz_upload();
		$pimg="/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/";
		preg_match_all($pimg,$content,$imgurl);
		foreach ($imgurl[1] as  $ik=>$iv){
				$im ="";
				$minfo = $attach= array();
				//过滤图片地址url
				$iv = dhtmlspecialchars($iv);
				
				$im = dfsockopen($iv);
				if(empty($im)){
					continue;
				}
				$minfo =getimagesize("data://text/plain;base64," . base64_encode($im));
				if($minfo['mime']=='image/jpeg'){
					$attach['ext']='jpg';
				}elseif($minfo['mime']=='image/gif'){
					$attach['ext']='gif';
				}elseif($minfo['mime']=='image/png'){
					$attach['ext']='png';
				}elseif($minfo['mime']=='image/bmp'){
					$attach['ext']='bmp';
				}
				
				if(empty($attach['ext'])) continue;

				//参考form.ajax 写法		
				$attach['name'] =  md5($iv).'.'.$attach['ext'];
				$attach['thumb'] = '';
				$attach['isimage'] = $upload -> is_image_ext($attach['ext']);
				$attach['extension'] = $upload -> get_target_extension($attach['ext']);
				$attach['attachdir'] = $upload -> get_target_dir('forum');
				$attach['attachment'] = $attach['attachdir'] . $upload->get_target_filename('forum').'.'.$attach['extension'];
				$attach['target'] = getglobal('setting/attachdir').'./forum/'.$attach['attachment'];
				
				if (!@$fp = fopen($attach['target'], 'wb'))
				{
					continue;
				} else{
					flock($fp, 2);
					fwrite($fp, $im);
					fclose($fp);
				}
				
				if(!$upload->get_image_info($attach['target'])) {
					@unlink($attach['target']);
					continue;
				}
				$attach['size'] = filesize($attach['target']);
				
				$upload->attach = $attach;
				$width = 0;
				$aids[] = $aid = getattachnewaid();
				$setarr = array(
						'aid' => $aid,
						'dateline' => $_G['timestamp'],
						'filename' => dhtmlspecialchars($upload->attach['name']),
						'filesize' => intval($upload->attach['size']),
						'attachment' => dhtmlspecialchars($upload->attach['attachment']),
						'isimage' => intval($upload->attach['isimage']),
						'uid' => $_G['uid'],
						'width' => intval($minfo['0'])
				);
				$attachimgstr = '<br />[attachimg]'.$aid.'[/attachimg]';
				$content = str_replace($imgurl[0][$ik], $attachimgstr, $content);
				C::t("forum_attachment_unused")->insert($setarr);
		}
	return $content;

}
	
	
function check_url($url){
	if(!preg_match('/http|https:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is',$url)){
		return false;
	}
	return true;
}
?>