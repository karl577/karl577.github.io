<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('post_forumselect');?><?php include template('common/header'); ?><!-- header start -->
<div class="mobile">
<?php if($_G['setting']['domain']['app']['mobile']) { $nav = 'http://'.$_G['setting']['domain']['app']['mobile'];?><?php } else { $nav = "forum.php";?><?php } ?>
<div class="mobile-inner">
<div class="mobile-inner-header nav">
    <div class="banzhuan-icon-back z">
    <a href="javascript:history.back();"><img src="./template/banzhuan_weibo/touch/banzhuan/images/icon_back.png" /></a>
    </div>			
    <h2>发新帖</h2>
</div>
</div>
</div>

<div class="banzhuan-top"></div>    
<!-- header end -->

<div class="banzhuan-post-forumselect">
<script src="static/js/common.js?g9O" type="text/javascript" type="text/javascript"></script>
<div style="display: none">
<ul id="fs_group"><?php echo $grouplist;?></ul>
<ul id="fs_forum_common"><?php echo $commonlist;?></ul><?php if(is_array($forumlist)) foreach($forumlist as $forumid => $forum) { ?><ul id="fs_forum_<?php echo $forumid;?>"><?php echo $forum;?></ul>
<?php } if(is_array($subforumlist)) foreach($subforumlist as $forumid => $forum) { ?><ul id="fs_subforum_<?php echo $forumid;?>"><?php echo $forum;?></ul>
<?php } ?>
</div>

<div class="c forumlistpbl_box">
<span class="pbnv"><?php echo $_G['setting']['bbname'];?><span id="pbnv"></span> <a id="enterbtn" class="xg1" href="javascript:;" onclick="locationforums(currentblock, currentfid)">[进入版块]</a></span>
<ul class="forumlistpbl cl">
<li id="block_group"></li>
<li id="block_forum"></li>
<li id="block_subforum"></li>
</ul>
    	<p class="cl z pbut">
<?php if($_G['group']['allowpost'] || !$_G['uid']) { if($special === null) { ?>
<button id="postbtn" class="pn pnc z" onclick="hideWindow('nav');window.location.href='forum.php?mod=post&action=newthread&fid=' + selectfid + '&mobile=2'" disabled="disabled">发新帖</button>
<?php } else { ?>
<button id="postbtn" class="pn pnc z" onclick="hideWindow('nav');window.location.href='forum.php?mod=post&action=newthread&fid=' + selectfid + '&special=<?php echo $special;?>&mobile=2'" disabled="disabled"><?php echo $actiontitle;?></button>
<?php } } ?>

</p>
</div>

<script type="text/javascript" reload="1">
var s = '<?php if($commonfids) { ?><p><a id="commonforum" href="javascript:;" onclick="switchforums(this, 1, \'common\')" class="pbsb lightlink">常用版块</a></p><?php } ?>';
var lis = $('fs_group').getElementsByTagName('LI');
for(i = 0;i < lis.length;i++) {
var gid = lis[i].getAttribute('fid');
if($('fs_forum_' + gid)) {
s += '<p><a href="javascript:;" ondblclick="locationforums(1, ' + gid + ')" onclick="switchforums(this, 1, ' + gid + ')" class="pbsb">' + lis[i].innerHTML + '</a></p>';
}

}
$('block_group').innerHTML = s;
var lastswitchobj = null;
var selectfid = 0;
var switchforum = switchsubforum = '';

switchforums($('commonforum'), 1, 'common');

function switchforums(obj, block, fid) {
if(lastswitchobj != obj) {
if(lastswitchobj) {
lastswitchobj.parentNode.className = '';
}
obj.parentNode.className = 'pbls';
}
var s = '';
if(fid != 'common') {
$('enterbtn').className = 'xi2';
currentblock = block;
currentfid = fid;
} else {
$('enterbtn').className = 'xg1';
}
if(block == 1) {
var lis = $('fs_forum_' + fid).getElementsByTagName('LI');
for(i = 0;i < lis.length;i++) {
fid = lis[i].getAttribute('fid');
if(fid != '') {
s += '<p><a href="javascript:;" ondblclick="locationforums(2, ' + fid + '\)" onclick="switchforums(this, 2, ' + fid + ')"' + ($('fs_subforum_' + fid) ?  ' class="pbsb"' : '') + '>' + lis[i].innerHTML + '</a></p>';
}
}
$('block_forum').innerHTML = s;
$('block_subforum').innerHTML = '';
switchforum = switchsubforum = '';
selectfid = 0;
$('postbtn').setAttribute("disabled", "disabled");
$('postbtn').className = 'pn xg1 y';
} else if(block == 2) {
selectfid = fid;
if($('fs_subforum_' + fid)) {
var lis = $('fs_subforum_' + fid).getElementsByTagName('LI');
for(i = 0;i < lis.length;i++) {
fid = lis[i].getAttribute('fid');
s += '<p><a href="javascript:;" ondblclick="locationforums(3, ' + fid + ')" onclick="switchforums(this, 3, ' + fid + ')">' + lis[i].innerHTML + '</a></p>';
}
$('block_subforum').innerHTML = s;
} else {
$('block_subforum').innerHTML = '';
}
switchforum = obj.innerHTML;
switchsubforum = '';
$('postbtn').removeAttribute("disabled");
$('postbtn').className = 'pn pnc y';
} else {
selectfid = fid;
switchsubforum = obj.innerHTML;
$('postbtn').removeAttribute("disabled");
$('postbtn').className = 'pn pnc y';
}
lastswitchobj = obj;
$('pbnv').innerHTML = switchforum ? '&nbsp;&gt;&nbsp;' + switchforum + (switchsubforum ? '&nbsp;&gt;&nbsp;' + switchsubforum : '') : '';
}

function locationforums(block, fid) {
location.href = block == 1 ? 'forum.php?gid=' + fid : 'forum.php?mod=forumdisplay&fid=' + fid;
}

</script>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['global_footer_mobile'])) echo $_G['setting']['pluginhooks']['global_footer_mobile'];?><?php $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);$clienturl = ''?><?php if(strpos($useragent, 'iphone') !== false || strpos($useragent, 'ios') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=ios' : 'http://www.discuz.net/mobile.php?platform=ios';?><?php } elseif(strpos($useragent, 'android') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=android' : 'http://www.discuz.net/mobile.php?platform=android';?><?php } elseif(strpos($useragent, 'windows phone') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=windowsphone' : 'http://www.discuz.net/mobile.php?platform=windowsphone';?><?php } ?>

<div id="mask" style="display:none;"></div>
<?php if(!$nofooter) { } ?>
<div class="banzhuan-bottom"></div>


</body>
</html><?php updatesession();?><?php if(defined('IN_MOBILE')) { output();?><?php } else { output_preview();?><?php } ?>
