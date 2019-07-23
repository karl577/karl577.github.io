<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_zqlj_toutiao {
	function __construct(){
		global $_G;
		loadcache('plugin');
		$vars = $_G['cache']['plugin']['zqlj_toutiao'];
		$this->name=trim($vars['name']);
		$this->nav=unserialize($vars['nav']);
		$this->num=intval($vars['num']);
		$this->rule=intval($vars['rule']);
		$this->start=intval($vars['start']);
		$this->forums=unserialize($vars['forums']);
		$this->cachetime=intval($vars['cachetime']);
		$this->cachetime=$this->cachetime>0? $this->cachetime:0;
	}
	
	function getThreadList(){
		global $_G;
		$list=array();
		$last=0;
		$hash=md5($this->start.serialize($this->forums).$this->rule.$this->num);
		$filepath=DISCUZ_ROOT.'./data/sysdata/cache_zqlj_toutiao.php';
		if(file_exists($filepath)){
			@include_once $filepath;
			if($this->cachetime&&TIMESTAMP-intval($last)>$this->cachetime){//缓存过期
				$list=false;
			}
			if($hash!=$check){//后台参数有修改，强制更新
				$list=false;
			}
		}
		if(!$list){
			$sql="select tid,subject,fid,author,authorid from ".DB::table('forum_thread')." where 1 ";
			if($this->start==1){//0点
				$sql.=" and dateline>='".strtotime(date('Y-m-d 00:00:00'))."'";
			}else{//24小时
				$sql.=" and dateline>='".(TIMESTAMP-86400)."'";
			}
			if($this->forums){
				$sql.=" and fid in(".implode(',',$this->forums).")";
			}
			if($this->rule==1){
				$sql.=' order by replies';
			}else{
				$sql.=' order by views';
			}
			$num=$this->num>0? $this->num:10;
			$sql.=" limit 0,$num";
			$list=DB::fetch_all($sql);
			@require_once libfile('function/cache');
			$cacheArray = "\$list=".arrayeval($list).";\n";
			$cacheArray .= "\$check='".$hash."';\n";
			$cacheArray .= "\$last=".TIMESTAMP.";\n";
			writetocache('zqlj_toutiao', $cacheArray);			
		}
		return $list;		
	}
	
	function doHighlight($highlight){
		if($highlight) {
			$forum_colorarray = array('', '#EE1B2E','#EE5023','#996600','#3C9D40','#2897C5','#2B65B7','#8F2A90','#EC1282');
			$string = sprintf('%02d', $highlight);
			$stylestr = sprintf('%03b', $string[0]);
			$highlight = ' style="';
			$highlight .= $stylestr[0] ? 'font-weight: bold;' : '';
			$highlight .= $stylestr[1] ? 'font-style: italic;' : '';
			$highlight .= $stylestr[2] ? 'text-decoration: underline;' : '';
			$highlight .= $string[1] ? 'color: '.$forum_colorarray[$string[1]].';' : '';
			if($thread['bgcolor']) {
				$highlight .= "background-color: $thread[bgcolor];";
			}
			$highlight .= '"';
		} else {
			$highlight = '';
		}	
		return $highlight;
	}
}

class plugin_zqlj_toutiao_forum extends plugin_zqlj_toutiao{
	function index_catlist_top_output(){
		global $_G;
		if(!in_array(1,$this->nav)) return '';
		$dis_3=$this->getThreadList();
		include template('zqlj_toutiao:toprank');
		return $return;	
	}
	
	function forumdisplay_top_output(){
		global $_G;
		if(!in_array(2,$this->nav)) return '';
		$dis_3=$this->getThreadList();
		include template('zqlj_toutiao:toprank');
		return $return;	
	}
	
	function viewthread_top_output(){
		global $_G;
		if(!in_array(3,$this->nav)) return '';
		$dis_3=$this->getThreadList();
		include template('zqlj_toutiao:toprank');
		return $return;	
	}	
}
?>