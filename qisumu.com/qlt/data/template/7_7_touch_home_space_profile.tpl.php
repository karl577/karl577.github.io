<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_profile');
0
|| checktplrefresh('./template/banzhuan_weibo/touch/home/space_profile.htm', './template/banzhuan_weibo/touch/home/space_header.htm', 1538368591, '7', './data/template/7_7_touch_home_space_profile.tpl.php', './template/banzhuan_weibo', 'touch/home/space_profile')
|| checktplrefresh('./template/banzhuan_weibo/touch/home/space_profile.htm', './template/banzhuan_weibo/touch/home/space_header.htm', 1538368591, '7', './data/template/7_7_touch_home_space_profile.tpl.php', './template/banzhuan_weibo', 'touch/home/space_profile')
|| checktplrefresh('./template/banzhuan_weibo/touch/home/space_profile.htm', './template/banzhuan_weibo/touch/home/space_profile_body.htm', 1538368591, '7', './data/template/7_7_touch_home_space_profile.tpl.php', './template/banzhuan_weibo', 'touch/home/space_profile')
|| checktplrefresh('./template/banzhuan_weibo/touch/home/space_profile.htm', './template/banzhuan_weibo/touch/home/space_userabout.htm', 1538368591, '7', './data/template/7_7_touch_home_space_profile.tpl.php', './template/banzhuan_weibo', 'touch/home/space_profile')
|| checktplrefresh('./template/banzhuan_weibo/touch/home/space_profile.htm', './template/banzhuan_weibo/touch/home/space_userabout.htm', 1538368591, '7', './data/template/7_7_touch_home_space_profile.tpl.php', './template/banzhuan_weibo', 'touch/home/space_profile')
|| checktplrefresh('./template/banzhuan_weibo/touch/home/space_profile.htm', './template/banzhuan_weibo/touch/home/space_header_personalnv.htm', 1538368591, '7', './data/template/7_7_touch_home_space_profile.tpl.php', './template/banzhuan_weibo', 'touch/home/space_profile')
|| checktplrefresh('./template/banzhuan_weibo/touch/home/space_profile.htm', './template/banzhuan_weibo/touch/home/space_header_personalnv.htm', 1538368591, '7', './data/template/7_7_touch_home_space_profile.tpl.php', './template/banzhuan_weibo', 'touch/home/space_profile')
;?>
<?php if($_G['setting']['homepagestyle']) { $_G[cookie][extstyle] = false;?><?php include template('common/header'); ?><script src="<?php echo $_G['setting']['jspath'];?>home.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<body id="space" onkeydown="if(event.keyCode==27) return false;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>

<!-- header start -->
<div class="mobile">
<?php if($_G['setting']['domain']['app']['mobile']) { $nav = 'http://'.$_G['setting']['domain']['app']['mobile'];?><?php } else { $nav = "forum.php";?><?php } ?>
<div class="mobile-inner-header nav">
<div class="banzhuan-icon-back z">
<a href="javascript:history.back();"><img src="./template/banzhuan_weibo/touch/banzhuan/images/icon_back.png" /></a>
</div>
<h2>������ҳ</h2>
<div class="banzhuan-discuz-header-y">
<a href="<?php if($_GET['mod'] == 'forumdisplay' || $_GET['mod'] == 'viewthread') { ?>forum.php?mod=post&action=newthread&fid=<?php echo $_G['fid'];?><?php } else { ?>forum.php?mod=misc&action=nav<?php } ?>" class="iconfont icon-fatie"></a>
</div>		
</div>
</div>

<script>
$(window).load(function() {
$(".mobile-inner-header-icon").click(function() {
$(this).toggleClass("mobile-inner-header-icon-click mobile-inner-header-icon-out");
$(".mobile-inner-nav").slideToggle(250);
});
$(".mobile-inner-nav a").each(function(index) {
$(this).css({
'animation-delay': (index / 10) + 's'
});
});
});
</script>

<div class="banzhuan-top"></div>
<div class="banzhuan-top"></div>
<div class="banzhuan-h10"></div>
<!-- header end -->

<div id="toptb" class="cl banzhuan-userinfo banzhuan-mar">
<?php if($_G['uid']) { ?>
<div class="banzhuan-padding10">
<div id="pcd" class="bm cl"><?php $encodeusername = rawurlencode($space[username]);?><div>
<div>
<div class="banzhuan-userinfo-pic"><a><?php echo avatar($space[uid],middle);?></a></div>
<div class="banzhuan-userinfo-name">
<p><?php echo $space['username'];?><em class="color-c">UID: <?php echo $space['uid'];?><?php $isfriendinfo = 'home_friend_info_'.$space['uid'].'_'.$_G[uid];?><?php if($_G[$isfriendinfo]['note']) { ?>, <em><?php echo $_G[$isfriendinfo]['note'];?></em><?php } ?></em></p>
<p class="color-c">
                �û���&nbsp;:&nbsp;<span style="color:<?php echo $space['group']['color'];?>"<?php if($upgradecredit !== false) { ?> class="xi2" onmouseover="showTip(this)" tip="���� <?php echo $space['credits'];?>, ������һ������ <?php echo $upgradecredit;?> ����"<?php } ?>><a class="color-c"><?php echo $space['group']['grouptitle'];?></a></span> <?php echo $space['group']['icon'];?> <?php if(!empty($space['groupexpiry'])) { ?>&nbsp;��Ч����&nbsp;<?php echo dgmdate($space[groupexpiry], 'Y-m-d H:i');?><?php } ?>
                <?php if($space['extgroupids']) { ?>
                ��չ�û���&nbsp;&nbsp;<?php echo $space['extgroupids'];?>
                <?php } ?>
</p>
</div>
</div>

<ul class="cl ul_list">

<?php if($space['self']) { ?>

    <?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?>
   
    <?php if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy']|| getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3) || in_array($_G['uid'], $_G['setting']['ext_portalmanager'])) { ?>
    
    <?php } ?>
    <?php if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>
    
    <?php } ?>
    <?php if($_G['uid'] && ($_G['group']['radminid'] == 1 || getstatus($_G['member']['allowadmincp'], 1))) { ?>
    
    <?php } ?>
    <?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra2'])) echo $_G['setting']['pluginhooks']['global_usernav_extra2'];?>


<div id="hd" class="cl">
<h2 id="spaceinfoshow">
        <?php space_merge($space, 'field_home'); $space[domainurl] = space_domain($space);getuserdiydata($space);$personalnv = isset($_G['blockposition']['nv']) ? $_G['blockposition']['nv'] : '';?>        <span id="spacedescription" class="xs1 xw0 mtn"><?php echo $space['spacedescription'];?></span>
        </h2><?php if($_G['adminid'] == 1 && empty($space['self'])) { $personalnv['items'] = array(); $personalnv['banitems'] = array(); $personalnv['nvhidden'] = 0;?><?php } $nvclass = !empty($personalnv['nvhidden']) ? ' class="mininv"' : '';?><div id="nv">
<ul<?php echo $nvclass;?>>
<?php if(empty($personalnv['nvhidden'])) { if(empty($personalnv['banitems']['index'])) { if($_G['adminid'] == 1 && $_G['setting']['allowquickviewprofile'] == 1) { } else { } } if(empty($personalnv['banitems']['profile'])) { } ?>

<li class="tit_msg"><a href="home.php?mod=space&amp;do=pm" class="iconfont icon-xiaoxi">&nbsp;�ҵ���Ϣ<?php if($_G['member']['newpm']) { ?><em class="iconfont icon-dian1"></em><?php } ?></a></li>
<li><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=favorite&amp;view=me&amp;type=thread" class="iconfont icon-shoucang">&nbsp;�ҵ��ղ�</a></li>

<?php } ?>
</ul>
</div></div>

<?php } else { if(helper_access::check_module('follow') && $space['uid'] != $_G['uid']) { ?>
<div class="hd-others">
    <ul>
    <li class="ul_flw">
     <?php $follow = 0;?>     <?php $follow = C::t('home_follow')->fetch_all_by_uid_followuid($_G['uid'], $space['uid']);?>     <?php if(!$follow) { ?>
     <a id="followmod" onclick="showWindow(this.id, this.href, 'get', 0);" href="home.php?mod=spacecp&amp;ac=follow&amp;op=add&amp;hash=<?php echo FORMHASH;?>&amp;fuid=<?php echo $space['uid'];?>" class="iconfont icon-guanzhu">&nbsp;��ע</a>
     <?php } else { ?>
     <a id="followmod" onclick="showWindow(this.id, this.href, 'get', 0);" href="home.php?mod=spacecp&amp;ac=follow&amp;op=del&amp;fuid=<?php echo $space['uid'];?>" class="iconfont icon-quxiaoguanzhu">&nbsp;ȡ����ע</a>
     <?php } ?>
    </li>
<?php } require_once libfile('function/friend');$isfriend=friend_check($space[uid]);?><?php if(!$isfriend) { } else { } if(helper_access::check_module('wall')) { } ?>

<li class="ul_pm">
<a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $space['uid'];?>&amp;touid=<?php echo $space['uid'];?>&amp;pmid=0&amp;daterange=2" id="a_sendpm_<?php echo $space['uid'];?>" onclick="showWindow('showMsgBox', this.href, 'get', 0)" class="iconfont icon-comment">&nbsp;����Ϣ</a>
</li>

</ul>
</div>
<?php } ?>

</ul>

<?php if(checkperm('allowbanuser') || checkperm('allowedituser') || $_G['adminid'] == 1) { ?>
<ul class="xl xl2 cl">
<?php if(checkperm('allowbanuser') || checkperm('allowedituser')) { if(checkperm('allowbanuser')) { } else { } } if($_G['adminid'] == 1) { } ?>
</ul>
<?php if(checkperm('allowbanuser') || checkperm('allowedituser')) { } if($_G['adminid'] == 1) { } } ?>
</div>
</div>
</div>

<script type="text/javascript">
function succeedhandle_followmod(url, msg, values) {
var fObj = $('followmod');
if(values['type'] == 'add') {
fObj.innerHTML = 'ȡ������';
fObj.href = 'home.php?mod=spacecp&ac=follow&op=del&fuid=' + values['fuid'];
} else if(values['type'] == 'del') {
fObj.innerHTML = '����TA';
fObj.href = 'home.php?mod=spacecp&ac=follow&op=add&hash=<?php echo FORMHASH;?>&fuid=' + values['fuid'];
}
}
</script></div>

<?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>

<div>
<a id="loginuser" class="xw1"><?php echo $_G['cookie']['loginuser'];?></a>
<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)">����</a>
<a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">�˳�</a>
</div>

<?php } elseif($_G['connectguest']) { ?>

<div class="y"><a href="member.php?mod=connect" target="_blank">�����ʺ���Ϣ</a> <a href="member.php?mod=connect&amp;ac=bind" target="_blank">�������ʺ�</a></div>

<?php } else { } ?>
</div>

<?php if($space['status'] == -1 && $_G['adminid'] == 1 ) { ?>
<p class="ptw xw1 xi1 hm"><img src="<?php echo IMGDIR;?>/locked.gif" alt="Locked" class="vm" /> ��ʾ: ���߱���ֹ��ɾ�� �����Զ����Σ�ֻ�й���Ա�ɼ�</p>
<?php } if(!empty($_G['setting']['plugins']['jsmenu'])) { ?>
<ul class="p_pop h_pop" id="plugin_menu" style="display: none"><?php if(is_array($_G['setting']['plugins']['jsmenu'])) foreach($_G['setting']['plugins']['jsmenu'] as $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?>
<li><?php echo $module['url'];?></li>
<?php } } ?>
</ul>
<?php } $mnid = getcurrentnav();?><div id="ct" class="ct2 wp cl">
<div class="mn">

<?php } else { $_G[cookie][extstyle] = false;?><?php include template('common/header'); ?><script src="<?php echo $_G['setting']['jspath'];?>home.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<body id="space" onkeydown="if(event.keyCode==27) return false;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>

<!-- header start -->
<div class="mobile">
<?php if($_G['setting']['domain']['app']['mobile']) { $nav = 'http://'.$_G['setting']['domain']['app']['mobile'];?><?php } else { $nav = "forum.php";?><?php } ?>
<div class="mobile-inner-header nav">
<div class="banzhuan-icon-back z">
<a href="javascript:history.back();"><img src="./template/banzhuan_weibo/touch/banzhuan/images/icon_back.png" /></a>
</div>
<h2>������ҳ</h2>
<div class="banzhuan-discuz-header-y">
<a href="<?php if($_GET['mod'] == 'forumdisplay' || $_GET['mod'] == 'viewthread') { ?>forum.php?mod=post&action=newthread&fid=<?php echo $_G['fid'];?><?php } else { ?>forum.php?mod=misc&action=nav<?php } ?>" class="iconfont icon-fatie"></a>
</div>		
</div>
</div>

<script>
$(window).load(function() {
$(".mobile-inner-header-icon").click(function() {
$(this).toggleClass("mobile-inner-header-icon-click mobile-inner-header-icon-out");
$(".mobile-inner-nav").slideToggle(250);
});
$(".mobile-inner-nav a").each(function(index) {
$(this).css({
'animation-delay': (index / 10) + 's'
});
});
});
</script>

<div class="banzhuan-top"></div>
<div class="banzhuan-top"></div>
<div class="banzhuan-h10"></div>
<!-- header end -->

<div id="toptb" class="cl banzhuan-userinfo banzhuan-mar">
<?php if($_G['uid']) { ?>
<div class="banzhuan-padding10">
<div id="pcd" class="bm cl"><?php $encodeusername = rawurlencode($space[username]);?><div>
<div>
<div class="banzhuan-userinfo-pic"><a><?php echo avatar($space[uid],middle);?></a></div>
<div class="banzhuan-userinfo-name">
<p><?php echo $space['username'];?><em class="color-c">UID: <?php echo $space['uid'];?><?php $isfriendinfo = 'home_friend_info_'.$space['uid'].'_'.$_G[uid];?><?php if($_G[$isfriendinfo]['note']) { ?>, <em><?php echo $_G[$isfriendinfo]['note'];?></em><?php } ?></em></p>
<p class="color-c">
                �û���&nbsp;:&nbsp;<span style="color:<?php echo $space['group']['color'];?>"<?php if($upgradecredit !== false) { ?> class="xi2" onmouseover="showTip(this)" tip="���� <?php echo $space['credits'];?>, ������һ������ <?php echo $upgradecredit;?> ����"<?php } ?>><a class="color-c"><?php echo $space['group']['grouptitle'];?></a></span> <?php echo $space['group']['icon'];?> <?php if(!empty($space['groupexpiry'])) { ?>&nbsp;��Ч����&nbsp;<?php echo dgmdate($space[groupexpiry], 'Y-m-d H:i');?><?php } ?>
                <?php if($space['extgroupids']) { ?>
                ��չ�û���&nbsp;&nbsp;<?php echo $space['extgroupids'];?>
                <?php } ?>
</p>
</div>
</div>

<ul class="cl ul_list">

<?php if($space['self']) { ?>

    <?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?>
   
    <?php if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy']|| getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3) || in_array($_G['uid'], $_G['setting']['ext_portalmanager'])) { ?>
    
    <?php } ?>
    <?php if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>
    
    <?php } ?>
    <?php if($_G['uid'] && ($_G['group']['radminid'] == 1 || getstatus($_G['member']['allowadmincp'], 1))) { ?>
    
    <?php } ?>
    <?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra2'])) echo $_G['setting']['pluginhooks']['global_usernav_extra2'];?>


<div id="hd" class="cl">
<h2 id="spaceinfoshow">
        <?php space_merge($space, 'field_home'); $space[domainurl] = space_domain($space);getuserdiydata($space);$personalnv = isset($_G['blockposition']['nv']) ? $_G['blockposition']['nv'] : '';?>        <span id="spacedescription" class="xs1 xw0 mtn"><?php echo $space['spacedescription'];?></span>
        </h2><?php if($_G['adminid'] == 1 && empty($space['self'])) { $personalnv['items'] = array(); $personalnv['banitems'] = array(); $personalnv['nvhidden'] = 0;?><?php } $nvclass = !empty($personalnv['nvhidden']) ? ' class="mininv"' : '';?><div id="nv">
<ul<?php echo $nvclass;?>>
<?php if(empty($personalnv['nvhidden'])) { if(empty($personalnv['banitems']['index'])) { if($_G['adminid'] == 1 && $_G['setting']['allowquickviewprofile'] == 1) { } else { } } if(empty($personalnv['banitems']['profile'])) { } ?>

<li class="tit_msg"><a href="home.php?mod=space&amp;do=pm" class="iconfont icon-xiaoxi">&nbsp;�ҵ���Ϣ<?php if($_G['member']['newpm']) { ?><em class="iconfont icon-dian1"></em><?php } ?></a></li>
<li><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=favorite&amp;view=me&amp;type=thread" class="iconfont icon-shoucang">&nbsp;�ҵ��ղ�</a></li>

<?php } ?>
</ul>
</div></div>

<?php } else { if(helper_access::check_module('follow') && $space['uid'] != $_G['uid']) { ?>
<div class="hd-others">
    <ul>
    <li class="ul_flw">
     <?php $follow = 0;?>     <?php $follow = C::t('home_follow')->fetch_all_by_uid_followuid($_G['uid'], $space['uid']);?>     <?php if(!$follow) { ?>
     <a id="followmod" onclick="showWindow(this.id, this.href, 'get', 0);" href="home.php?mod=spacecp&amp;ac=follow&amp;op=add&amp;hash=<?php echo FORMHASH;?>&amp;fuid=<?php echo $space['uid'];?>" class="iconfont icon-guanzhu">&nbsp;��ע</a>
     <?php } else { ?>
     <a id="followmod" onclick="showWindow(this.id, this.href, 'get', 0);" href="home.php?mod=spacecp&amp;ac=follow&amp;op=del&amp;fuid=<?php echo $space['uid'];?>" class="iconfont icon-quxiaoguanzhu">&nbsp;ȡ����ע</a>
     <?php } ?>
    </li>
<?php } require_once libfile('function/friend');$isfriend=friend_check($space[uid]);?><?php if(!$isfriend) { } else { } if(helper_access::check_module('wall')) { } ?>

<li class="ul_pm">
<a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $space['uid'];?>&amp;touid=<?php echo $space['uid'];?>&amp;pmid=0&amp;daterange=2" id="a_sendpm_<?php echo $space['uid'];?>" onclick="showWindow('showMsgBox', this.href, 'get', 0)" class="iconfont icon-comment">&nbsp;����Ϣ</a>
</li>

</ul>
</div>
<?php } ?>

</ul>

<?php if(checkperm('allowbanuser') || checkperm('allowedituser') || $_G['adminid'] == 1) { ?>
<ul class="xl xl2 cl">
<?php if(checkperm('allowbanuser') || checkperm('allowedituser')) { if(checkperm('allowbanuser')) { } else { } } if($_G['adminid'] == 1) { } ?>
</ul>
<?php if(checkperm('allowbanuser') || checkperm('allowedituser')) { } if($_G['adminid'] == 1) { } } ?>
</div>
</div>
</div>

<script type="text/javascript">
function succeedhandle_followmod(url, msg, values) {
var fObj = $('followmod');
if(values['type'] == 'add') {
fObj.innerHTML = 'ȡ������';
fObj.href = 'home.php?mod=spacecp&ac=follow&op=del&fuid=' + values['fuid'];
} else if(values['type'] == 'del') {
fObj.innerHTML = '����TA';
fObj.href = 'home.php?mod=spacecp&ac=follow&op=add&hash=<?php echo FORMHASH;?>&fuid=' + values['fuid'];
}
}
</script></div>

<?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>

<div>
<a id="loginuser" class="xw1"><?php echo $_G['cookie']['loginuser'];?></a>
<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)">����</a>
<a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">�˳�</a>
</div>

<?php } elseif($_G['connectguest']) { ?>

<div class="y"><a href="member.php?mod=connect" target="_blank">�����ʺ���Ϣ</a> <a href="member.php?mod=connect&amp;ac=bind" target="_blank">�������ʺ�</a></div>

<?php } else { } ?>
</div>

<?php if($space['status'] == -1 && $_G['adminid'] == 1 ) { ?>
<p class="ptw xw1 xi1 hm"><img src="<?php echo IMGDIR;?>/locked.gif" alt="Locked" class="vm" /> ��ʾ: ���߱���ֹ��ɾ�� �����Զ����Σ�ֻ�й���Ա�ɼ�</p>
<?php } if(!empty($_G['setting']['plugins']['jsmenu'])) { ?>
<ul class="p_pop h_pop" id="plugin_menu" style="display: none"><?php if(is_array($_G['setting']['plugins']['jsmenu'])) foreach($_G['setting']['plugins']['jsmenu'] as $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?>
<li><?php echo $module['url'];?></li>
<?php } } ?>
</ul>
<?php } $mnid = getcurrentnav();?><div id="ct" class="ct1 wp cl">
<div class="mn">
<div class="bm bw0">
<div>
<?php } ?><div class="u_profile">

<div class="cl banzhuan-padding10 banzhuan-mar banzhuan-userinfo-li">
<h2 class="h2-name"><?php echo $space['username'];?>&nbsp;�Ŀռ�</h2>

<?php if($space['customstatus']) { ?>
<li>
<div class="banzhuan-userinfo-li-left"><em>�Զ���ͷ��</em></div>
<div class="banzhuan-userinfo-li-right"><?php echo $space['customstatus'];?></div>
</li>
<?php } if($space['group']['maxsigsize'] && $space['sightml']) { ?>
<li>
<div class="banzhuan-userinfo-li-left"><em>����ǩ��</em></div>
<div class="banzhuan-userinfo-li-right"><table><tr><td><?php echo $space['sightml'];?></td></tr></table></div>
</li>
<?php } ?>	
</div>

   	<div class="cl banzhuan-padding10 banzhuan-mar banzhuan-userinfo-li">
   		<?php if($_G['setting']['allowviewuserthread'] !== false) { $space['posts'] = $space['posts'] - $space['threads'];?><a href="<?php if(CURMODULE != 'follow') { ?>home.php?mod=space&uid=<?php echo $space['uid'];?>&do=thread&view=me&type=reply&from=space<?php } else { ?>home.php?mod=space&uid=<?php echo $space['uid'];?>&view=thread&type=reply<?php } ?>">
<div class="banzhuan-made-more" style="border-bottom: 1px solid #F5F5F5;">&nbsp;������&nbsp;<em class="color-c">��<?php echo $space['posts'];?>��</em><span class="y" style="padding-right: 15px; color: #999;">></span></div>
</a>
<a href="<?php if(CURMODULE != 'follow') { ?>home.php?mod=space&uid=<?php echo $space['uid'];?>&do=thread&view=me&type=thread&from=space<?php } else { ?>home.php?mod=space&uid=<?php echo $space['uid'];?>&view=thread<?php } ?>">
<div class="banzhuan-made-more">&nbsp;������&nbsp;<em class="color-c">��<?php echo $space['threads'];?>��</em><span class="y" style="padding-right: 15px; color: #999;">></span></div>
</a>
<?php } ?>
   	</div>	

<div id="psts" class="<?php if($clist) { ?> <?php } ?>cl banzhuan-padding10 banzhuan-mar">
    <ul class="banzhuan-userinfo-li">
<?php if($space['buyercredit']) { ?>
    <li>
       	<div class="banzhuan-userinfo-li-left"><em>��������</em></div>
      	<div><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=trade&amp;view=eccredit#sellcredit"><?php echo $space['buyercredit'];?> <img src="<?php echo STATICURL;?>image/traderank/buyer/<?php echo $space['buyerrank'];?>.gif" border="0" class="vm" /></a></div>
    </li>
<?php } if($space['sellercredit']) { ?>
    <li>
     	<div class="banzhuan-userinfo-li-left"><em>�������</em></div>
     	<div><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=trade&amp;view=eccredit#buyercredit"><?php echo $space['sellercredit'];?> <img src="<?php echo STATICURL;?>image/traderank/seller/<?php echo $space['sellerrank'];?>.gif" border="0" class="vm" /></a></div>
    </li>
<?php } ?>
    <li>
     	<div class="banzhuan-userinfo-li-left"><em>����</em></div>
      	<div><?php echo $space['credits'];?></div>
    </li><?php if(is_array($_G['setting']['extcredits'])) foreach($_G['setting']['extcredits'] as $key => $value) { if($value['title']) { ?>
    <li>
      	<div class="banzhuan-userinfo-li-left"><em><?php echo $value['title'];?></em></div>
      	<div><?php echo $space["extcredits$key"];?> <?php echo $value['unit'];?></div>
    </li>
<?php } } ?>
    </ul>
  </div>

<div class="cl banzhuan-padding10 banzhuan-mar ">
<?php if(CURMODULE == 'space') { ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_profile_baseinfo_top'])) echo $_G['setting']['pluginhooks']['space_profile_baseinfo_top'];?>
<?php } elseif(CURMODULE == 'follow') { ?>
<?php if(!empty($_G['setting']['pluginhooks']['follow_profile_baseinfo_top'])) echo $_G['setting']['pluginhooks']['follow_profile_baseinfo_top'];?>
<?php } ?>
<ul class="cl banzhuan-userinfo-li">

<?php if($_G['setting']['allowspacedomain'] && $_G['setting']['domain']['root']['home'] && checkperm('domainlength') && !empty($space['domain'])) { $spaceurl = 'http://'.$space['domain'].'.'.$_G['setting']['domain']['root']['home'];?><li>
<div class="banzhuan-userinfo-li-left"><em>��������</em></div>
<div><a href="<?php echo $spaceurl;?>" onclick="setCopy('<?php echo $spaceurl;?>', '�ռ��ַ���Ƴɹ�');return false;"><?php echo $spaceurl;?></a></div>
</li>
<?php } if($_G['setting']['homepagestyle']) { ?>
<li>
<div class="banzhuan-userinfo-li-left"><em>�ռ������</em></div>
<div><strong><?php echo $space['views'];?></strong></div>
</li>
<?php } if(in_array($_G['adminid'], array(1, 2))) { ?>
<li>
<div class="banzhuan-userinfo-li-left"><em>Email</em></div>
<div><?php echo $space['email'];?></div>
</li>
<?php } ?>
<li>
<div class="banzhuan-userinfo-li-left"><em>����״̬</em></div>	
<div><?php if($space['emailstatus'] > 0) { ?>����֤<?php } else { ?>δ��֤<?php } ?></div>
</li>
<li>
<div class="banzhuan-userinfo-li-left"><em>��Ƶ��֤</em></div>	
<div><?php if($space['videophotostatus'] > 0) { ?>����֤ <?php if($showvideophoto) { ?>(<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=videophoto" id="viewphoto" onclick="showWindow(this.id, this.href, 'get', 0)">�鿴��֤��Ƭ</a>)<?php } } else { ?>δ��֤<?php } ?></div>
</li><?php if(is_array($profiles)) foreach($profiles as $value) { ?><li>
<div class="banzhuan-userinfo-li-left"><em><?php echo $value['title'];?></em></div>
<div class="banzhuan-userinfo-li-right"><?php echo $value['value'];?></div>
</li>
<?php } ?>

</ul>
<?php if(CURMODULE == 'space') { ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_profile_baseinfo_middle'])) echo $_G['setting']['pluginhooks']['space_profile_baseinfo_middle'];?>
<?php } elseif(CURMODULE == 'follow') { ?>
<?php if(!empty($_G['setting']['pluginhooks']['follow_profile_baseinfo_middle'])) echo $_G['setting']['pluginhooks']['follow_profile_baseinfo_middle'];?>
<?php } ?>
</div>


<?php if(CURMODULE == 'space') { ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_profile_baseinfo_bottom'])) echo $_G['setting']['pluginhooks']['space_profile_baseinfo_bottom'];?>
<?php } elseif(CURMODULE == 'follow') { ?>
<?php if(!empty($_G['setting']['pluginhooks']['follow_profile_baseinfo_bottom'])) echo $_G['setting']['pluginhooks']['follow_profile_baseinfo_bottom'];?>
<?php } if($space['medals']) { ?>
<div class="cl banzhuan-padding10 banzhuan-mar">
<p class="md_ctrl">
<a href="home.php?mod=medal"><?php if(is_array($space['medals'])) foreach($space['medals'] as $medal) { ?><img src="<?php echo STATICURL;?>/image/common/<?php echo $medal['image'];?>" alt="<?php echo $medal['name'];?>" id="md_<?php echo $medal['medalid'];?>" onmouseover="showMenu({'ctrlid':this.id, 'menuid':'md_<?php echo $medal['medalid'];?>_menu', 'pos':'12!'});" />
<?php } ?>
</a>
</p>
</div><?php if(is_array($space['medals'])) foreach($space['medals'] as $medal) { ?><div id="md_<?php echo $medal['medalid'];?>_menu" class="tip tip_4" style="display: none;">
<div class="tip_horn"></div>
<div class="tip_c">
<h4><?php echo $medal['name'];?></h4>
<p><?php echo $medal['description'];?></p>
</div>
</div>
<?php } } if($_G['setting']['verify']['enabled']) { $showverify = true;?><?php if(is_array($_G['setting']['verify'])) foreach($_G['setting']['verify'] as $vid => $verify) { if($verify['available']) { if($showverify) { $showverify = false;?><?php } if($space['verify'.$vid] == 1) { } elseif(!empty($verify['unverifyicon'])) { } } } if(!$showverify) { } } if($count) { ?>
<div class="cl banzhuan-padding10 banzhuan-mar"><?php if(is_array($manage_forum)) foreach($manage_forum as $key => $value) { ?><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $key;?>"><?php echo $value;?></a> &nbsp;
<?php } ?>
</div>
<?php } if($groupcount) { ?>
<div class="cl banzhuan-padding10 banzhuan-mar"><?php if(is_array($usergrouplist)) foreach($usergrouplist as $key => $value) { ?><a href="forum.php?mod=group&amp;fid=<?php echo $value['fid'];?>"><?php echo $value['name'];?></a> &nbsp;
<?php } ?>
</div>
<?php } ?>

<div class="cl banzhuan-padding10 banzhuan-mar">
<ul id="pbbs" class="banzhuan-userinfo-li">
<?php if($space['oltime']) { ?>
<li>
<div class="banzhuan-userinfo-li-left"><em>����ʱ��</em></div>
<div><?php echo $space['oltime'];?> Сʱ</div>
</li>
<?php } ?>
<li>
<div class="banzhuan-userinfo-li-left"><em>ע��ʱ��</em></div>
<div><?php echo $space['regdate'];?></div>
</li>
<li>
<div class="banzhuan-userinfo-li-left"><em>������</em></div>
<div><?php echo $space['lastvisit'];?></div>
</li>
<?php if($_G['uid'] == $space['uid'] || $_G['group']['allowviewip']) { ?>
<li>
<div class="banzhuan-userinfo-li-left"><em>ע�� IP</em></div>
<div><?php echo $space['regip'];?> - <?php echo $space['regip_loc'];?></div>
</li>
<li>
<div class="banzhuan-userinfo-li-left"><em>�ϴη��� IP</em></div>
<div><?php echo $space['lastip'];?>:<?php echo $space['port'];?> - <?php echo $space['lastip_loc'];?></div>
</li>
<?php } if($space['lastactivity']) { ?>
<li>
<div class="banzhuan-userinfo-li-left"><em>�ϴλʱ��</em></div>
<div><?php echo $space['lastactivity'];?></div>
</li>
<?php } if($space['lastpost']) { ?>
<li>
<div class="banzhuan-userinfo-li-left"><em>�ϴη���ʱ��</em></div>
<div><?php echo $space['lastpost'];?></div>
</li>
<?php } if($space['lastsendmail']) { ?>
<li>
<div class="banzhuan-userinfo-li-left"><em>�ϴ��ʼ�֪ͨ</em></div>
<div><?php echo $space['lastsendmail'];?></div>
</li>
<?php } ?>
<li>
<div class="banzhuan-userinfo-li-left"><em>����ʱ��</em></div><?php $timeoffset = array(
		'9999' => 'ʹ��ϵͳĬ��',
		'-12' => '(GMT -12:00) �������п˵�, ����ֻ���',
		'-11' => '(GMT -11:00) ��;��, ��Ħ��Ⱥ��',
		'-10' => '(GMT -10:00) ������',
		'-9' => '(GMT -09:00) ����˹��',
		'-8' => '(GMT -08:00) ̫ƽ��ʱ��(�����ͼ��ô�), �Ừ��',
		'-7' => '(GMT -07:00) ɽ��ʱ��(�����ͼ��ô�), ����ɣ��',
		'-6' => '(GMT -06:00) �в�ʱ��(�����ͼ��ô�), ī�����',
		'-5' => '(GMT -05:00) ����ʱ��(�����ͼ��ô�), �����, ����, ����',
		'-4' => '(GMT -04:00) ������ʱ��(���ô�), ������˹, ����˹',
		'-3.5' => '(GMT -03:30) Ŧ����',
		'-3' => '(GMT -03:00) ��������, ����ŵ˹����˹, ���ζ�, ������Ⱥ��',
		'-2' => '(GMT -02:00) �д�����, ��ɭ��Ⱥ��, ʥ�����õ�',
		'-1' => '(GMT -01:00) ����Ⱥ��, ��ý�Ⱥ�� [�������α�׼ʱ��] ������, �׶�, ��˹��, ����������',
		'0' => '(GMT) �����������������֣����������׶أ���˹��������ά��',
		'1' => '(GMT +01:00) ����, ��³����, �籾����, �����, ����, ����',
		'2' => '(GMT +02:00) �ն�����, ����������, �Ϸ�, ��ɳ',
		'3' => '(GMT +03:00) �͸��, ���ŵ�, Ī˹��, �����',
		'3.5' => '(GMT +03:30) �º���',
		'4' => '(GMT +04:00) ��������, �Ϳ�, ��˹����, �ر���˹',
		'4.5' => '(GMT +04:30) ������',
		'5' => '(GMT +05:00) Ҷ�����ձ�, ��˹����, ������, ��ʲ��',
		'5.5' => '(GMT +05:30) ����, �Ӷ�����, �����˹, �µ���',
		'5.75' => '(GMT +05:45) �ӵ�����',
		'6' => '(GMT +06:00) ����ľͼ, ������, �￨, ����������',
		'6.5' => '(GMT +06:30) ����',
		'7' => '(GMT +07:00) ����, ����, �żӴ�',
		'8' => '(GMT +08:00) ����, ���, ��˹, �¼���, ̨��',
		'9' => '(GMT +09:00) ����, ����, �׶�, ����, �ſ�Ŀ�',
		'9.5' => '(GMT +09:30) ��������, �����',
		'10' => '(GMT +10:00) ������, �ص�, ī����, Ϥ��, ������',
		'11' => '(GMT +11:00) ��ӵ�, �¿��������, ������Ⱥ��',
		'12' => '(GMT +12:00) �¿���, �����, 쳼�, ���ܶ�Ⱥ��');?><div><?php echo $timeoffset[$space['timeoffset']];?></div>
</li>
</ul>
</div>

<?php if($clist) { } if(CURMODULE == 'space') { ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_profile_extrainfo'])) echo $_G['setting']['pluginhooks']['space_profile_extrainfo'];?>
<?php } elseif(CURMODULE == 'follow') { ?>
<?php if(!empty($_G['setting']['pluginhooks']['follow_profile_extrainfo'])) echo $_G['setting']['pluginhooks']['follow_profile_extrainfo'];?>
<?php } ?>

</div></div>
</div>
<?php if($_G['setting']['homepagestyle']) { ?>
</div>
<?php } ?>
</div>

<div id="toptb" class="cl banzhuan-userinfo">
<?php if($_G['uid']) { ?>
<div>
<div id="pcd" class="bm cl"><?php $encodeusername = rawurlencode($space[username]);?><ul class="xl xl2 cl banzhuan-made">

<?php if($space['self']) { ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?>

<li>
<a href="home.php?mod=spacecp">
<div class="banzhuan-made-more" style="border-bottom: 1px solid #F5F5F5;"><em class="iconfont icon-shezhi2"></em>&nbsp;����<span class="y" style="padding-right: 15px; color: #999;">></span></div>
</a>

<span id="myprompt_check"></span>

<?php if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy']|| getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3) || in_array($_G['uid'], $_G['setting']['ext_portalmanager'])) { } if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>

<a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>">
<div class="banzhuan-made-more" style="border-bottom: 1px solid #F5F5F5;"><em class="iconfont icon-shezhi2"></em>&nbsp;<?php echo $_G['setting']['navs']['2']['navname'];?>����<span class="y" style="padding-right: 15px; color: #999">></span></div>
</a>

<?php } if($_G['uid'] && ($_G['group']['radminid'] == 1 || getstatus($_G['member']['allowadmincp'], 1))) { } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra2'])) echo $_G['setting']['pluginhooks']['global_usernav_extra2'];?>

<a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">
<div class="banzhuan-made-more"><em class="iconfont icon-tuichu2"></em>&nbsp;�˳�<span class="y" style="padding-right: 15px; color: #999">></span></div>
</a>

<?php } else { if(helper_access::check_module('follow') && $space['uid'] != $_G['uid']) { } require_once libfile('function/friend');$isfriend=friend_check($space[uid]);?><?php if(!$isfriend) { } else { } if(helper_access::check_module('wall')) { } ?>
</li>
<?php } ?>

</ul>
<?php if(checkperm('allowbanuser') || checkperm('allowedituser') || $_G['adminid'] == 1) { if(checkperm('allowbanuser') || checkperm('allowedituser')) { } if($_G['adminid'] == 1) { } } ?>
</div>
</div>

<script type="text/javascript">
function succeedhandle_followmod(url, msg, values) {
var fObj = $('followmod');
if(values['type'] == 'add') {
fObj.innerHTML = 'ȡ������';
fObj.href = 'home.php?mod=spacecp&ac=follow&op=del&fuid=' + values['fuid'];
} else if(values['type'] == 'del') {
fObj.innerHTML = '����TA';
fObj.href = 'home.php?mod=spacecp&ac=follow&op=add&hash=<?php echo FORMHASH;?>&fuid=' + values['fuid'];
}
}
</script>

</div>

<?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>

<div class="y">
<a id="loginuser" class="xw1"><?php echo $_G['cookie']['loginuser'];?></a>
<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)">����</a>
<a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">�˳�</a>
</div>

<?php } elseif($_G['connectguest']) { ?>

<div class="y">
<a href="member.php?mod=connect" target="_blank">�����ʺ���Ϣ</a> <a href="member.php?mod=connect&amp;ac=bind" target="_blank">�������ʺ�</a>
</div>

<?php } else { ?>

<div class="banzhuan-userinfo-nologin">
<div class="banzhuan-userinfo-nologin-title">��¼��鿴����</div>
<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)" class="a-2">��¼</a>
<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" class="a-1"><?php echo $_G['setting']['reglinkname'];?></a>
</div>

<?php } include template('common/footer'); ?>