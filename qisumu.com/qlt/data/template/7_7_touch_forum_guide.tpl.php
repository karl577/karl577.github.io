<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('guide');
0
|| checktplrefresh('./template/banzhuan_weibo/touch/forum/guide.htm', './template/banzhuan_weibo/touch/forum/guide_list_row.htm', 1487640175, '7', './data/template/7_7_touch_forum_guide.tpl.php', './template/banzhuan_weibo', 'touch/forum/guide')
;
block_get('196');?><?php include template('common/header'); ?><!-- header start -->
<div class="mobile">
<?php if($_G['setting']['domain']['app']['mobile']) { $nav = 'http://'.$_G['setting']['domain']['app']['mobile'];?><?php } else { $nav = "forum.php";?> 
<?php } ?>
<div class="mobile-inner">
<div class="mobile-inner-header">
<div class="mobile-inner-header-icon mobile-inner-header-icon-out"><a><span></span><span></span></a></div>
<h2>����Ŀ</h2>
<div class="banzhuan-discuz-header-y"><a href="<?php if($_GET['mod'] == 'forumdisplay' || $_GET['mod'] == 'viewthread') { ?>forum.php?mod=post&action=newthread&fid=<?php echo $_G['fid'];?><?php } else { ?>forum.php?mod=misc&action=nav<?php } ?>" class="iconfont icon-fatie"></a></div>
</div>
<div class="mobile-inner-nav">
<div class="mobile-inner-nav-authi"></div>
<div class="mobile-inner-nav-list">
    <a href="forum.php?mod=guide&amp;view=hot" style="animation-delay: 0s;">����Ŀ��ҳ</a>
    <a href="<?php if($_G['uid']) { ?>home.php?mod=space&uid=<?php echo $_G['uid'];?>&do=profile&mycenter=1<?php } else { ?>member.php?mod=logging&action=login<?php } ?>" style="animation-delay: 0.1s;"><?php if($_G['uid']) { ?>���˿ռ�<?php } else { ?>��¼�������<?php } ?></a>
    	<a href="http://qisumu.com/qlt/home.php?mod=space&amp;do=doing" style="animation-delay: 0.2s;">���˵��</a>
    	<a href="http://qisumu.com/qlt/home.php?mod=follow" style="animation-delay: 0.3s;">�㲥</a>
    	<a href="http://qisumu.com/qlt/home.php#" style="animation-delay: 0.4s;">��̬</a>
    	<a href="http://qisumu.com/qlt/forum.php" style="animation-delay: 0.5s;">��̳</a>
</div>
</div>
</div>
</div>
<script>
$(window).load(function () {
  $(".mobile-inner-header-icon").click(function(){
  	$(this).toggleClass("mobile-inner-header-icon-click mobile-inner-header-icon-out");
  	$(".mobile-inner-nav").slideToggle(250);
  });
  $(".mobile-inner-nav a").each(function( index ) {
  	$( this ).css({'animation-delay': (index/10)+'s'});
  });
});
</script>
<div class="banzhuan-top"></div>
<div class="banzhuan-top"></div>
<div class="banzhuan-h10"></div>
<!-- header end -->

<!-- ΢����Ϣ��ģ��/��ѡ --><?php block_display('196');?><!-- ���100���ַ�����ʾΪ�� -->
<script>
 function cutString(str, len) {
 //length���Զ������ĺ��ֳ���Ϊ1
 if(str.length*2 <= len) {
  return str;
 }
 var strlen = 0;
 var s = "";
 for(var i = 0;i < str.length; i++) {
  s = s + str.charAt(i);
  if (str.charCodeAt(i) > 128) {
   strlen = strlen + 2;
   if(strlen >= len){
    return s.substring(0,s.length-1) + "...";
   }
  } else {
   strlen = strlen + 1;
   if(strlen >= len){
    return s.substring(0,s.length-2) + "...";
   }
  }
 }
 return s;
}
window.onload=function(){
  var str = document.getElementById('cut_str').innerHTML;
  var s=cutString(str,100);
  document.getElementById('cut_str').innerHTML=s;
}
</script>

<div class="banzhuan-clear"></div>
<!-- main threadlist start -->
<div class="threadlist bg-fff">
<h2 class="thread_tit">��������</h2><?php if(is_array($data)) foreach($data as $key => $list) { if($list['threadcount']) { ?>
<ul class="hotlist"><?php if(is_array($list['threadlist'])) foreach($list['threadlist'] as $key => $thread) { ?><li>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;fromguid=hot&amp;<?php if($_GET['archiveid']) { ?>archiveid=<?php echo $_GET['archiveid'];?>&amp;<?php } ?>extra=<?php echo $extra;?>">
<?php if(!$thread['forumstick'] && $thread['closed'] > 1 && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])) { $thread[tid]=$thread[closed];?><?php } ?>
<?php echo $thread['typehtml'];?> <?php echo $thread['sorthtml'];?>
<?php echo $thread['subject'];?>

<div class="banzhuan-item-info">
<?php if($thread['digest'] > 0) { ?>
<span class="icon_top banner-tuijian">�ö�</span>
<?php } elseif($thread['attachment'] == 2 && $_G['setting']['mobile']['mobilesimpletype'] == 0) { ?>
<span class="icon_tu banner-tuijian">ͼƬ</span>
<?php } ?>
<span class="by"><?php echo $thread['author'];?></span>
<span class="by">
<?php if($thread['isgroup'] != 1) { ?>�ظ�:
<?php echo $thread['replies'];?>
<?php } else { ?>�ظ�:
<?php echo $groupnames[$thread['tid']]['replies'];?>
<?php } ?>
</span>

</div>
</a>
</li>
<?php } ?>
</ul>
<?php } else { ?>
<p>��ʱ��û������</p>
<?php } } ?>
</div>
<!-- main threadlist end -->
<?php echo $multipage;?>
<div class="pullrefresh" style="display:none;"></div><?php include template('common/footer'); ?>