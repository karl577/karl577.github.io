<?php
/*  nds_votekick Plugin FOR Discuz!  X2.5 X3 X3.2 
	 *	Copyright (c) 20015-2020 WWW.NWDS.CN | NDS.西域数码工作室
	 *  	$Id: nds_votekick.inc.php V3.01 20150203 by SINGCEE $
	 */
if(!defined('IN_DISCUZ')) {
		exit('Access Denied');
	}

class plugin_nds_votekick {
    function plugin_nds_votekick() {
       global $_G;
	    $this->lvotes = $_G['cache']['plugin']['nds_votekick']['lvotes'];
	    $this->vtexpired = $_G['cache']['plugin']['nds_votekick']['vtexpired'];
	    $this->voteforums = unserialize($_G['cache']['plugin']['nds_votekick']['voteforums']);
    }
}
 class plugin_nds_votekick_forum extends plugin_nds_votekick {
         function viewthread_useraction_output(){
          global $_G;
           if (!$_G['uid'])  return;
           if(in_array($_G['fid'], $this->voteforums))	return;
           if( $this->vtexpired > 0 && ($_G['timestamp'] - $_G['forum_thread']['dateline']) > $this->vtexpired *24*60*60) return;
           $votemax = $this->lvotes;
           $vks = C::t ( '#nds_votekick#plugin_nds_votekick' )->fetch_by_tid ($_G['tid']);
           if ($vks['votes'])  { 
		      $votes = $vks['votes'];
		   }else {
			  $votes = 0;
   	    }
		$votemargin =  $this->lvotes - $votes ;   
        $ndsvtreturn = '';
		include template('nds_votekick:votekick');
		return $ndsvtreturn;   
		   
         }
 }         
  
?>