<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_home');
0
|| checktplrefresh('./template/banzhuan_weibo/touch/home/space_home.htm', './template/banzhuan_weibo/touch/home/space_header.htm', 1499298148, 'diy', './data/template/7_diy_touch_home_space_home.tpl.php', './template/banzhuan_weibo', 'touch/home/space_home')
|| checktplrefresh('./template/banzhuan_weibo/touch/home/space_home.htm', './template/banzhuan_weibo/touch/home/space_userabout.htm', 1499298148, 'diy', './data/template/7_diy_touch_home_space_home.tpl.php', './template/banzhuan_weibo', 'touch/home/space_home')
|| checktplrefresh('./template/banzhuan_weibo/touch/home/space_home.htm', './template/banzhuan_weibo/touch/home/space_userabout.htm', 1499298148, 'diy', './data/template/7_diy_touch_home_space_home.tpl.php', './template/banzhuan_weibo', 'touch/home/space_home')
|| checktplrefresh('./template/banzhuan_weibo/touch/home/space_home.htm', './template/banzhuan_weibo/touch/home/space_header_personalnv.htm', 1499298148, 'diy', './data/template/7_diy_touch_home_space_home.tpl.php', './template/banzhuan_weibo', 'touch/home/space_home')
|| checktplrefresh('./template/banzhuan_weibo/touch/home/space_home.htm', './template/banzhuan_weibo/touch/home/space_header_personalnv.htm', 1499298148, 'diy', './data/template/7_diy_touch_home_space_home.tpl.php', './template/banzhuan_weibo', 'touch/home/space_home')
;?>
<?php if(empty($diymode)) { include template('common/header'); ?><!-- header start -->
<div class="mobile">
<?php if($_G['setting']['domain']['app']['mobile']) { $nav = 'http://'.$_G['setting']['domain']['app']['mobile'];?><?php } else { $nav = "forum.php";?><?php } ?>
<div class="mobile-inner-header nav">
<div class="banzhuan-icon-back z">
<a href="home.php?mod=space&amp;do=home" id="navs" class="showmenu" onmouseover="showMenu(this.id);"><img src="./template/banzhuan_weibo/touch/banzhuan/images/icon_back.png" /></a>
</div>
<div class="y mobile-banzhuan-fatie">
<a href="search.php?mod=forum" class="iconfont icon-sousuo1"></a>
<a href="<?php if($_GET['mod'] == 'forumdisplay' || $_GET['mod'] == 'viewthread') { ?>forum.php?mod=post&action=newthread&fid=<?php echo $_G['fid'];?><?php } else { ?>forum.php?mod=misc&action=nav<?php } ?>" class="iconfont icon-fatie"></a>
<a class="color-c" style="margin-right: 30px;">���˿ռ�</a>
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
<!-- header end -->


<div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<?php if($_G['setting']['homestyle']) { ?><a href="home.php"><?php echo $_G['setting']['navs']['4']['navname'];?></a><?php } else { ?>��̬</a><?php } ?>
</div>
</div>


<div id="ct" class="<?php if($_G['setting']['homestyle']) { ?>ct3_a<?php } else { ?>ct2_a<?php } ?> wp cl">

<div class="appl">
<?php if($_G['setting']['homestyle']) { include template('common/userabout'); } else { ?>
<div class="tbn">
<h2 class="mt bbda">��̬</h2>
<ul>
<li<?php echo $actives['we'];?>><a href="home.php?mod=space&amp;do=home&amp;view=we">���ѵĶ�̬</a></li>
<li<?php echo $actives['me'];?>><a href="home.php?mod=space&amp;do=home&amp;view=me">�ҵĶ�̬</a></li>
<li<?php echo $actives['all'];?>><a href="home.php?mod=space&amp;do=home&amp;view=all">��㿴��</a></li>
<?php if($_G['setting']['my_app_status']) { ?>
<li<?php echo $actives['app'];?>><a href="home.php?mod=space&amp;do=home&amp;view=app">Ӧ�ö�̬</a></li>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_home_navlink'])) echo $_G['setting']['pluginhooks']['space_home_navlink'];?>
</ul>
</div>
<?php } ?>
</div>
<!--/sidebar-->
<?php if($_G['setting']['homestyle']) { ?>
<div class="sd ptm">
<?php if(!empty($_G['setting']['pluginhooks']['space_home_side_top'])) echo $_G['setting']['pluginhooks']['space_home_side_top'];?>

<?php if($_G['uid'] ) { if($space['profileprogress'] != 100) { ?>
<div class="bm">
<div class="bm_c">
<div class="pbg mbn"><div class="pbr" style="width: <?php if($space['profileprogress'] < 2) { ?>2<?php } else { ?><?php echo $space['profileprogress'];?><?php } ?>%;"></div></div>
<p>������������� <?php echo $space['profileprogress'];?>%, <a href="home.php?mod=spacecp&amp;ac=profile" class="xi2">�������</a></p>
</div>
</div>
<?php } if($_G['setting']['taskon'] && !empty($task) && is_array($task)) { ?>
<div class="bm">
<div class="bm_h cl">
<span class="y">
<a href="home.php?mod=task">ȫ��</a>
</span>
<h2>����</h2>
</div>
<div class="bm_c">
<p class="pbm">���ã�<?php echo $_G['username'];?>����ӭ�������ǡ����������������ͦ�򵥵ģ��Ͽ����μӰ�</p>
<hr class="da m0" />
<dl class="xld cl">
<dd class="m mbw"><img src="<?php echo $task['icon'];?>" width="64" height="64" alt="Icon" /></dd>
<dt><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>"><?php echo $task['name'];?></a></dt>
<dd>
<p><?php echo $task['description'];?></p>
<?php if(in_array($task['reward'], array('credit', 'magic', 'medal', 'invite', 'group'))) { ?>
<p class="mtn">
<?php if($task['reward'] == 'credit') { ?>
���Ի��<?php echo $_G['setting']['extcredits'][$task['prize']]['title'];?> <strong class="xi1"><?php echo $task['bonus'];?></strong> <?php echo $_G['setting']['extcredits'][$task['prize']]['unit'];?>
<?php } elseif($task['reward'] == 'magic') { ?>
���Ի�õ��� <?php echo $listdata[$task['prize']];?> <strong class="xi1"><?php echo $task['bonus'];?></strong> ��
<?php } elseif($task['reward'] == 'medal') { ?>
���Ի��ѫ�� <strong class="xi1">1</strong> ��
<?php } elseif($task['reward'] == 'invite') { ?>
���Ի�������� <strong class="xi1"><?php echo $task['prize'];?></strong> ��
<?php } elseif($task['reward'] == 'group') { ?>
���������û���ȼ�
<?php } ?>
</p>
<?php } ?>
</dd>
</dl>
</div>
</div>
<?php } if(!empty($magic) && is_array($magic)) { ?>
<div class="bm">
<div class="bm_h cl">
<span class="y">
<a href="home.php?mod=magic">ȫ��</a>
</span>
<h2>����</h2>
</div>
<div class="bm_c">
<dl class="xld cl">
<dd class="m mbw"><img src="<?php echo STATICURL;?>/image/magic/<?php echo $magic['pic'];?>" alt="<?php echo $magic['name'];?>" title="<?php echo $magic['description'];?>" /></dd>
<dt><?php echo $magic['name'];?></dt>
<dd>
<p><?php echo $magic['description'];?></p>
<p class="mtn">�ۼ�
<?php if($_G['setting']['extcredits'][$magic['credit']]['unit']) { ?>
<?php echo $_G['setting']['extcredits'][$magic['credit']]['title'];?> <strong class="xi1"><?php echo $magic['price'];?></strong> <?php echo $_G['setting']['extcredits'][$magic['credit']]['unit'];?>/��
<?php } else { ?>
<strong class="xi1"><?php echo $magic['price'];?></strong> <?php echo $_G['setting']['extcredits'][$magic['credit']]['title'];?>/��
<?php } ?>
</p>
<p class="mtn">
<?php if($magic['num'] > 0) { ?>
<a href="home.php?mod=magic&amp;action=shop&amp;operation=buy&amp;mid=<?php echo $magic['identifier'];?>" onclick="showWindow('magics', this.href);return false;" class="xi2 xw1">����</a>
<?php if($_G['group']['allowmagics'] > 1) { ?>
<span class="pipe">|</span>
<a href="home.php?mod=magic&amp;action=shop&amp;operation=give&amp;mid=<?php echo $magic['identifier'];?>" onclick="showWindow('magics', this.href);return false;" class="xi2">����</a>
<?php } } else { ?>
<span class="xg1">�˵���ȱ��</span>
<?php } ?>
</p>
</dd>
</dl>
</div>
</div>
<?php } } if($defaultusers) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>�����Ƽ�</h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><?php if(is_array($defaultusers)) foreach($defaultusers as $key => $value) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" title="<?php if($ols[$value['uid']]) { ?>����<?php } ?>" class="avt">
<?php if($ols[$value['uid']]) { ?><em class="gol"></em><?php } ?><?php echo avatar($value[uid],small);?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" title="<?php echo $value['username'];?>"><?php echo $value['username'];?></a></p>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } if($showusers) { ?>
<div class="bm">
<div class="bm_h cl">
<span class="y">
<a href="misc.php?mod=ranklist&amp;type=member">ȫ��</a>
</span>
<h2>��������</h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><?php if(is_array($showusers)) foreach($showusers as $key => $value) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" title="<?php if($ols[$value['uid']]) { ?>����<?php } ?>" class="avt">
<?php if($ols[$value['uid']]) { ?><em class="gol"></em><?php } ?><?php echo avatar($value[uid],small);?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" title="<?php echo $value['username'];?>"><?php echo $value['username'];?></a></p>
<!--span><span title="<?php echo $value['credit'];?>"><?php echo $value['credit'];?></span></span-->
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } if($newusers) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>�¼����Ա</h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><?php if(is_array($newusers)) foreach($newusers as $key => $value) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" title="<?php if($ols[$value['uid']]) { ?>����<?php } ?>" class="avt">
<?php if($ols[$value['uid']]) { ?><em class="gol"></em><?php } ?><?php echo avatar($value[uid],small);?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" title="<?php echo $value['username'];?>"><?php echo $value['username'];?></a></p>
<span><?php echo $value['regdate'];?></span>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } if($visitorlist) { ?>
<div class="bm">
<div class="bm_h cl">
<span class="y">
<?php if($_G['setting']['magicstatus'] && $_G['setting']['magics']['visit']) { ?>
<a id="a_magic_visit" href="home.php?mod=magic&amp;mid=visit" onclick="showWindow('magics',this.href,'get', 0)" class="xg1" style="display: inline-block; padding-left: 18px; background: url(<?php echo STATICURL;?>image/magic/visit.small.gif) no-repeat 0 50%;"><?php echo $_G['setting']['magics']['visit'];?></a>
<?php } ?>
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=friend&amp;view=visitor">ȫ��</a>
</span>
<h2>�������</h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><?php if(is_array($visitorlist)) foreach($visitorlist as $key => $value) { ?><li>
<?php if($value['vusername'] == '') { ?>
<div class="avt"><img src="<?php echo STATICURL;?>image/magic/hidden.gif" alt="����" /></div>
<p>����</p>
<span><?php echo dgmdate($value[dateline], 'u', 9999, $_G[setting][dateformat]);?></span>
<?php } else { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $value['vuid'];?>" title="<?php if($ols[$value['vuid']]) { ?>����<?php } ?>" class="avt" c="1">
<?php if($ols[$value['vuid']]) { ?><em class="gol"></em><?php } ?><?php echo avatar($value[vuid],small);?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $value['vuid'];?>" title="<?php echo $value['vusername'];?>"><?php echo $value['vusername'];?></a></p>
<span><?php echo dgmdate($value[dateline], 'u', 9999, $_G[setting][dateformat]);?></span>
<?php } ?>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } if($olfriendlist) { ?>
<div class="bm">
<div class="bm_h cl">
<span class="y">
<?php if($_G['setting']['magicstatus'] && $_G['setting']['magics']['detector']) { ?>
<a id="a_magic_detector" href="home.php?mod=magic&amp;mid=detector" onclick="showWindow('magics',this.href,'get', 0)" class="xg1" style="display: inline-block; padding-left: 18px; background: url(<?php echo STATICURL;?>image/magic/detector.small.gif) no-repeat 0 50%;"><?php echo $_G['setting']['magics']['detector'];?></a>
<?php } ?>
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=friend">ȫ��</a>
</span>
<h2>�ҵĺ���</h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><?php if(is_array($olfriendlist)) foreach($olfriendlist as $key => $value) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" title="<?php if($ols[$value['uid']]) { ?>����<?php } ?>" class="avt" c="1">
<?php if($ols[$value['uid']]) { ?><em class="gol"></em><?php } ?><?php echo avatar($value[uid],small);?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" title="<?php echo $value['username'];?>"><?php echo $value['username'];?></a></p>
<span><?php if($value['lastactivity']) { ?><?php echo dgmdate($value[lastactivity], 'u', 9999, $_G[setting][dateformat]);?><?php } else { ?>�ȶ�(<?php echo $value['num'];?>)<?php } ?></span>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } if($birthlist) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>������������</h2>
</div>
<div class="bm_c">
<table cellpadding="2" cellspacing="4"><?php if(is_array($birthlist)) foreach($birthlist as $key => $values) { ?><tr>
<td align="right" valign="top">
<?php if($values['0']['istoday']) { ?>����<?php } else { ?><?php echo $values['0']['birthmonth'];?>-<?php echo $values['0']['birthday'];?><?php } ?>
</td>
<td style="padding-left:10px;">
<ul><?php if(is_array($values)) foreach($values as $value) { ?><li><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>"><?php echo $value['username'];?></a></li>
<?php } ?>
</ul>
</td>
</tr>
<?php } ?>
</table>
</div>
</div>
<?php } ?>


<?php if(!empty($_G['setting']['pluginhooks']['space_home_side_bottom'])) echo $_G['setting']['pluginhooks']['space_home_side_bottom'];?>
</div>
<?php } ?>
<div class="mn ptm pbm">
<!--[diy=diycontenttop]--><div id="diycontenttop" class="area"></div><!--[/diy]-->
<?php if($space['uid'] && $space['self']) { if($_G['setting']['homestyle']) { ?>
<div class="bm bw0">
<table cellpadding="0" cellspacing="0" class="mi mbm">
<tr>
<th>
<div class="avatar mbn cl">
<a href="home.php?mod=spacecp&amp;ac=avatar" title="�޸�ͷ��" id="edit_avt"><span id="edit_avt_tar">�޸�ͷ��</span><?php echo avatar($_G[uid],middle);?></a>
</div>
<p><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>" target="_blank" class="o xi2">�����ҵĿռ�</a></p>
</th>
<td>
<h3 class="xs2">
<span class="y xw0 xs1">���� <em class="xi1"><?php echo $space['views'];?></em> �˴η���</span>
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>"<?php g_color($space[groupid]);?>><?php echo $space['username'];?></a><?php g_icon($space[groupid]);?></h3><?php include template('home/space_status'); ?></td>
</tr>
</table>
<!--[diy=diycontentmiddle]--><div id="diycontentmiddle" class="area"></div><!--[/diy]-->
<?php if(!empty($_G['setting']['pluginhooks']['space_home_top'])) echo $_G['setting']['pluginhooks']['space_home_top'];?>

</div><?php echo adshow("feed/bm");?><div class="bm bw0">
<ul class="tb cl">
<li<?php echo $actives['we'];?>><a href="home.php?mod=space&amp;do=home&amp;view=we">���ѵĶ�̬</a></li>
<li<?php echo $actives['me'];?>><a href="home.php?mod=space&amp;do=home&amp;view=me">�ҵĶ�̬</a></li>
<li<?php echo $actives['all'];?>><a href="home.php?mod=space&amp;do=home&amp;view=all">��㿴��</a></li>
<?php if($_G['setting']['my_app_status']) { ?>
<li<?php echo $actives['app'];?>><a href="home.php?mod=space&amp;do=home&amp;view=app">Ӧ�ö�̬</a></li>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_home_navlink'])) echo $_G['setting']['pluginhooks']['space_home_navlink'];?>
<?php if($_G['setting']['magicstatus'] && $_G['setting']['magics']['thunder']) { ?>
<li class="y"><a id="a_magic_thunder" href="home.php?mod=magic&amp;mid=thunder" onclick="showWindow('magics', this.href, 'get', 0)" style="padding-left: 18px; background: url(<?php echo STATICURL;?>image/magic/thunder.small.gif) no-repeat 0 50%;"><?php echo $_G['setting']['magics']['thunder'];?></a></li>
<?php } ?>
</ul>
<?php } } else { ?>
<div class="bm bw0"><?php $_G['home_tpl_spacemenus'][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=home&amp;view=me\">TA �Ľ��ڶ�̬</a>";?><?php include template('home/space_menu'); } if($_GET['view'] == 'all') { ?>
<p class="tbmu">
<?php if(!$_G['setting']['homestyle'] && $_G['setting']['magicstatus'] && $_G['setting']['magics']['thunder']) { ?>
<a id="a_magic_thunder" href="home.php?mod=magic&amp;mid=thunder" onclick="showWindow('magics', this.href, 'get', 0)" style="padding-left: 18px; background: url(<?php echo STATICURL;?>image/magic/thunder.small.gif) no-repeat 0 50%;" class="y"><?php echo $_G['setting']['magics']['thunder'];?></a>
<?php } ?>
<a href="home.php?mod=space&amp;do=home&amp;view=all&amp;order=dateline"<?php echo $orderactives['dateline'];?>>���¶�̬</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=home&amp;view=all&amp;order=hot"<?php echo $orderactives['hot'];?>>�ȵ㶯̬</a>
</p>
<?php } elseif($_GET['view'] == 'app' && $_G['setting']['my_app_status']) { ?>
<p class="tbmu">
<a href="home.php?mod=space&amp;do=home&amp;view=app&amp;type=we"<?php echo $typeactives['we'];?>>��������ʲô</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=home&amp;view=app&amp;type=me"<?php echo $typeactives['me'];?>>�������</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=home&amp;view=app&amp;type=all"<?php echo $typeactives['all'];?>>�������ʲô</a>
</p>
<?php } elseif($groups) { ?>
<p class="tbmu">
<?php if(!$_G['setting']['homestyle'] && $_G['setting']['magicstatus'] && $_G['setting']['magics']['thunder']) { ?>
<a id="a_magic_thunder" href="home.php?mod=magic&amp;mid=thunder" onclick="showWindow('magics', this.href, 'get', 0)" style="padding-left: 18px; background: url(<?php echo STATICURL;?>image/magic/thunder.small.gif) no-repeat 0 50%;" class="y"><?php echo $_G['setting']['magics']['thunder'];?></a>
<?php } ?>
<a href="home.php?mod=space&amp;do=home&amp;view=we"<?php echo $gidactives['-1'];?>>ȫ������</a><?php if(is_array($groups)) foreach($groups as $key => $value) { ?><span class="pipe">|</span><a href="home.php?mod=space&amp;do=home&amp;view=we&amp;gid=<?php echo $key;?>"<?php echo $gidactives[$key];?>><?php echo $value;?></a><?php } ?>
</p>
<?php } elseif(!$_G['setting']['homestyle'] && $_G['setting']['magicstatus'] && $_G['setting']['magics']['thunder']) { ?>
<p class="tbmu cl">
<a id="a_magic_thunder" href="home.php?mod=magic&amp;mid=thunder" onclick="showWindow('magics', this.href, 'get', 0)" style="padding-left: 18px; background: url(<?php echo STATICURL;?>image/magic/thunder.small.gif) no-repeat 0 50%;" class="y"><?php echo $_G['setting']['magics']['thunder'];?></a>
</p>
<?php } } else { if($_G['setting']['homepagestyle']) { $_G[cookie][extstyle] = false;?><?php include template('common/header'); ?><script src="<?php echo $_G['setting']['jspath'];?>home.js?<?php echo VERHASH;?>" type="text/javascript"></script>

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
<div class="bm">
<div class="bm_h">
<h1 class="mt">��̬</h1>
</div>
<div class="bm_c">
<?php } else { include template('common/header'); ?><div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>"><?php echo $space['username'];?></a> <em>&rsaquo;</em>
��������
</div>
</div>
<style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div><?php include template('home/space_menu'); ?><div id="ct" class="ct1 wp cl">
<div class="mn">
<!--[diy=diycontenttop]--><div id="diycontenttop" class="area"></div><!--[/diy]-->
<div class="bm bw0">
<div class="bm_c">
<?php } } ?>

<div id="feed_div" class="e">
<?php if($hotlist) { ?>
<h4 class="et"><a href="home.php?mod=space&amp;do=home&amp;view=all&amp;order=hot" class="y xw0">�鿴�����ȵ� <em>&rsaquo;</em></a>�����ȵ��Ƽ�</h4>
<ul class="el"><?php if(is_array($hotlist)) foreach($hotlist as $value) { $value = mkfeed($value);?><?php include template('home/space_feed_li'); } ?>
</ul>
<?php } if($list) { if($_GET['view'] == 'app' && $_G['setting']['my_app_status']) { include template('home/space_home_feed_app'); } else { if(is_array($list)) foreach($list as $day => $values) { if($_GET['view']!='hot') { ?>
<h4 class="et">
<?php if($day=='yesterday') { ?>����<?php } elseif($day=='today') { ?>����<?php } else { ?><?php echo $day;?><?php } ?>
</h4>
<?php } ?>

<ul class="el"><?php if(is_array($values)) foreach($values as $value) { include template('home/space_feed_li'); } ?>
</ul>
<?php } } } elseif($feed_users) { ?>
<div class="xld xlda mtm"><?php if(is_array($feed_users)) foreach($feed_users as $day => $users) { ?><h4 class="et">
<?php if($day=='yesterday') { ?>����<?php } elseif($day=='today') { ?>����<?php } else { ?><?php echo $day;?><?php } ?>
</h4><?php if(is_array($users)) foreach($users as $user) { $daylist = $feed_list[$day][$user[uid]];?><?php $morelist = $more_list[$day][$user[uid]];?><dl class="bbda cl">
<dd class="m avt">
<?php if($user['uid']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>" target="_blank" c="1"><?php echo avatar($user[uid],small);?></a>
<?php } else { ?>
<img src="<?php echo IMGDIR;?>/systempm.png" alt="" />
<?php } ?>
</dd>
<dd class="cl">
<ul class="el"><?php if(is_array($daylist)) foreach($daylist as $value) { include template('home/space_feed_li'); } ?>
</ul>

<?php if($morelist) { ?>
<p class="xg1 cl"><span onclick="showmore('<?php echo $day;?>', '<?php echo $user['uid'];?>', this);" class="unfold">չ��</span></p>
<div id="feed_more_div_<?php echo $day;?>_<?php echo $user['uid'];?>" style="display:none;">
<ul class="el"><?php if(is_array($morelist)) foreach($morelist as $value) { include template('home/space_feed_li'); } ?>
</ul>
</div>
<?php } ?>
</dd>
</dl>
<?php } } ?>
</div>
<?php } else { ?>
<p class="emp"><?php if($_GET['view'] == 'app' && $_G['setting']['my_app_status']) { ?>��û�����Ӧ�ö�̬��<a href="home.php?mod=space&amp;do=friend">��Ӻ�����Ϊ����������Ϸʱ��������Ļ���</a><?php } else { ?>��û����ض�̬<?php } ?></p>
<?php } if($filtercount) { ?>
<div class="i" id="feed_filter_notice_<?php echo $start;?>">
��������<a href="home.php?mod=spacecp&amp;ac=privacy&amp;op=filter" target="_blank" class="xi2 xw1">ɸѡ����</a>,�� <?php echo $filtercount;?> ����̬������ (<a href="javascript:;" onclick="filter_more(<?php echo $start;?>);" id="a_feed_privacy_more" class="xi2">����鿴</a>)
</div>
<div id="feed_filter_div_<?php echo $start;?>" style="display:none;">
<h4 class="et">�����Ǳ����εĶ�̬</h4>
<ul class="el"><?php if(is_array($filter_list)) foreach($filter_list as $value) { include template('home/space_feed_li'); } ?>
<li><a href="javascript:;" onclick="filter_more(<?php echo $start;?>);">&laquo; ����</a></li>
</ul>
</div>
<?php } ?>

</div>
<!--/id=feed_div-->

<?php if(empty($diymode)) { if($multi) { ?>
<div class="pgs cl mtm"><?php echo $multi;?></div>
<?php } ?>

<?php if(!empty($_G['setting']['pluginhooks']['space_home_bottom'])) echo $_G['setting']['pluginhooks']['space_home_bottom'];?>
<div id="ajax_wait"></div>
</div>

<!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]-->
</div>
<!--/content-->
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>

<?php } else { ?>

</div>
</div>
<?php if($_G['setting']['homepagestyle']) { ?>
</div>
<div class="sd">
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
</script><?php } ?>
</div>
<?php } helper_manyou::checkupdate();?><script type="text/javascript">
function filter_more(id) {
if($('feed_filter_div_'+id).style.display == '') {
$('feed_filter_div_'+id).style.display = 'none';
$('feed_filter_notice_'+id).style.display = '';
} else {
$('feed_filter_div_'+id).style.display = '';
$('feed_filter_notice_'+id).style.display = 'none';
}
}

function close_feedbox() {
var x = new Ajax();
x.get('home.php?mod=spacecp&ac=common&op=closefeedbox', function(s){
$('feed_box').style.display = 'none';
});
}

function showmore(day, uid, e) {
var obj = 'feed_more_div_'+day+'_'+uid;
$(obj).style.display = $(obj).style.display == ''?'none':'';
if(e.className == 'unfold'){
e.innerHTML = '����';
e.className = 'fold';
} else if(e.className == 'fold') {
e.innerHTML = 'չ��';
e.className = 'unfold';
}
}

var elems = selector('li[class~=magicthunder]', $('feed_div'));
for(var i=0; i<elems.length; i++){
magicColor(elems[i]);
}

function showEditAvt(id) {
$(id).style.display = $(id).style.display == '' ? 'block' : '';
}
if($('edit_avt') && BROWSER.ie && BROWSER.ie == 6) {
_attachEvent($('edit_avt'), 'mouseover', function () { showEditAvt('edit_avt_tar'); });
_attachEvent($('edit_avt'), 'mouseout', function () { showEditAvt('edit_avt_tar'); });
}
</script><?php include template('common/footer'); ?>