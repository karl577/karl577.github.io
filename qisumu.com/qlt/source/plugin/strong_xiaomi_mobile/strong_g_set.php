<?php
	if (!defined('IN_DISCUZ')) {
		exit('Access Denied');
	}

	global $_G;
	$strong_setting = $_G['cache']['plugin']['strong_xiaomi_mobile'];
	$homeset = $strong_setting['homeset'];
	$homeid = $strong_setting['homeid'];
	$homeurl = 'forum.php?mod=forumdisplay&fid='.$homeid;
	$tophdcolor = $strong_setting['dh_bg_color'];
	$buttoncolor = $strong_setting['buttoncolor'];
	$fontcolor = $strong_setting['fontcolor'];	
	$linkcolor = $strong_setting['linkcolor'];	
	$dianjingcolor = $strong_setting['dianjingcolor'];		
	$cbl_color_l = $strong_setting['cbl_bg_l'];
	$cbl_color_r = $strong_setting['cbl_bg_r'];	
	$titledescribe = $strong_setting['titledescribe'];
	$titlepic = $strong_setting['titlepic'];
	$titledescribepic = $strong_setting['titledescribepic'];
	$titledescribelen = $strong_setting['titledescribelen'];
	$piclist = $strong_setting['pic'];
	$truepic = $strong_setting['truepic'];
	$leftmenu = $strong_setting['leftmenu'];


	loadcache('plugin');


		function isfidtd($fid,$titledescribepic,$titledescribe){
			$titledescribepic = explode (',',$titledescribepic);
			$titledescribe = explode (',',$titledescribe);
			$returntrue = in_array($fid,$titledescribepic)? 1 : 0;
				if ($returntrue){return $returntrue; break; }
			$returntrue = in_array($fid,$titledescribe)? 1 : 0;
				if ($returntrue){return $returntrue; break; }
				return 0;
	}

		function isfidtp($fid,$titledescribepic,$titlepic){
			$titledescribepic = explode (',',$titledescribepic);
			$titlepic = explode (',',$titlepic);
			$returntrue = in_array($fid,$titledescribepic)? 1 : 0;
				if ($returntrue){return $returntrue; break; }
			$returntrue = in_array($fid,$titlepic)? 1 : 0;
				if ($returntrue){return $returntrue; break; }
				return 0;
	}

		function ispic($fid,$piclist){
			$piclist = explode (',',$piclist);
			$returntrue = in_array($fid,$piclist)? 1 : 0;
				if ($returntrue){return $returntrue; break; }

				return 0;
	}



	function setthreadpic($tid){
		foreach (DB::fetch_all('SELECT tableid FROM '.DB::table('forum_attachment').' WHERE tid = '.$tid) as $setthread){
			foreach ($getdata = DB::fetch_all('SELECT * FROM '.DB::table('forum_attachment_'.$setthread['tableid'].'').' WHERE tid = '.$tid . ' and isimage=1  LIMIT  0 , 3 ') as $setthreadpic){
					//$setthreadpicarray[$setthreadpic['aid']] = 'data/attachment/forum/'.$setthreadpic['attachment'];
						if (count($getdata) == '1'){$setthreadpicarray[$setthreadpic['aid']] = getforumimg($setthreadpic['aid'],'0','500','250');
						}elseif(count($getdata) == '2'){
							$setthreadpicarray[$setthreadpic['aid']] = getforumimg($setthreadpic['aid'],'0','400','260');
							
						}elseif(count($getdata) == '3'){
							$setthreadpicarray[$setthreadpic['aid']] = getforumimg($setthreadpic['aid'],'0','300','220');
							}
		}
	}
	return $setthreadpicarray;
	}


	function tagsreplace($tid,$titledescribelen){

		foreach ($postmessage= DB::fetch_all('SELECT message FROM '.DB::table('forum_post').' WHERE tid = ' . $tid . ' and first = 1 ') as $value){

			$postmessagearray =$value['message'];
		}
		$tagsreplace[0] = $postmessagearray;
		$tagsreplace = preg_replace('/\[\/?.{0,12}\=?(\w*\-?\/*\.?\,?\s?)*\]/','',$tagsreplace);
		$tagsreplace = preg_replace('/\[\/?.{0,12}\=?\W\]/','',$tagsreplace);
		
		$tagsreplace = implode('',$tagsreplace);

		return cutstr(strip_tags($tagsreplace),$titledescribelen);
	}

		function wei_sortpic($weiv){
			if(strstr($weiv,'<a')!= false and strstr($weiv,'data/attachment') != false ){
				$weivs = explode('href="',$weiv);				
				$weivs = explode('" target="_blank"',$weivs[1]);				
				$weiv = '<img src="'.$weivs[0].'"style="max-width: 60%;max-height: 60%;">'; 				
				return $weiv;
				}else{
				return $weiv;	
					}			
			
			
			
			}

?>
