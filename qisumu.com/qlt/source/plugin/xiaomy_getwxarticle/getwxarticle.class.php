<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_xiaomy_getwxarticle {
	
}

class plugin_xiaomy_getwxarticle_forum extends plugin_xiaomy_getwxarticle {
	
       function post_editorctrl_left() {
	   	   global $_G;
	   	   //xiaomy_groups กข xiaomy_forums
	   	   $xmlcfg = $_G['cache']['plugin']['xiaomy_getwxarticle'];
	   	   $groups = dunserialize($xmlcfg['xiaomy_groups']);
	   	   if(!in_array($_G['groupid'],$groups)){
	   	   	return $return;
	   	   }
 		   include template('xiaomy_getwxarticle:getwxarticle');
 		   return $return;
       }
}
?>