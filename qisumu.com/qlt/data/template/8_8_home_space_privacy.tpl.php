<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_privacy');?>
<?php $_G['home_tpl_titles'] = array('����');?><?php include template('common/header'); $space['isfriend'] = $space['self'];
if(in_array($_G['uid'], (array)$space['friends'])) $space['isfriend'] = 1;
space_merge($space, 'count');
space_merge($space, 'field_home');?><div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="home.php"><?php echo $_G['setting']['navs']['4']['navname'];?></a> <em>&rsaquo;</em> 
��˽����
</div>
</div>
<div id="ct" class="wp cl">
<div class="nfl">
<div class="f_c mtw mbw">
<table cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
<tr>
<td valign="top" width="140" class="hm">
<div class="avt avtm"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>"><?php echo avatar($space[uid],middle);?></a></div>
<p class="mtm xw1 xi2 xs2"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>"><?php echo $space['username'];?></a></p>
</td>
<td width="14"></td>
<td valign="top" class="xs1">
<h2 class="xs2">
��Ǹ������ <?php echo $space['username'];?> ����˽���ã������ܷ��ʵ�ǰ���� 
</h2>
<p class="mtm mbm">
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=friend">�鿴�����б�</a>
<?php if($isfriend) { ?>
<span class="pipe">|</span><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?php echo $space['uid'];?>&amp;handlekey=ignorefriendhk_<?php echo $space['uid'];?>" id="a_ignore" onclick="showWindow(this.id, this.href, 'get', 0);">�������</a>
<?php } else { ?>
<span class="pipe">|</span><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $space['uid'];?>&amp;handlekey=addfriendhk_<?php echo $space['uid'];?>" id="a_friend" onclick="showWindow(this.id, this.href, 'get', 0);">��Ϊ����</a>
<?php } ?>
<span class="pipe">|</span><a href="home.php?mod=spacecp&amp;ac=poke&amp;op=send&amp;uid=<?php echo $space['uid'];?>&amp;handlekey=propokehk_<?php echo $space['uid'];?>" id="a_poke" onclick="showWindow(this.id, this.href, 'get', 0);">����к�</a>
<span class="pipe">|</span><a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $space['uid'];?>&amp;touid=<?php echo $space['uid'];?>&amp;pmid=0&amp;daterange=4" id="a_pm" onclick="showWindow(this.id, this.href, 'get', 0);">������Ϣ</a>
<!--span class="pipe">|</span><a href="home.php?mod=spacecp&amp;ac=common&amp;op=report&amp;idtype=uid&amp;id=<?php echo $space['uid'];?>&amp;handlekey=reportbloghk_<?php echo $space['uid'];?>" id="a_report" onclick="showWindow(this.id, this.href, 'get', 0);">�ٱ�</a-->
<?php if($_G['group']['allowedituser']) { ?>
<span class="pipe">|</span><a id="a_manage" href="admin.php?action=members&amp;operation=search&amp;uid=<?php echo $space['uid'];?>&amp;submit=1&amp;frames=yes">�����û�</a>
<?php } ?>
</p>
<?php if($space['spacenote']) { ?>
<p><?php echo $space['spacenote'];?></p>
<?php } ?>

<div class="mtm pbm mbm bbda cl">
<h2 class="mbn">��Ծ�ſ�</h2>
<ul class="xl xl2 cl">
<?php if($space['adminid']) { ?><li>������: <span style="color:<?php echo $space['admingroup']['color'];?>"><?php echo $space['admingroup']['grouptitle'];?></span> <?php echo $space['admingroup']['icon'];?></li><?php } ?>
<li>�û���: <span style="color:<?php echo $space['group']['color'];?>"><?php echo $space['group']['grouptitle'];?></span> <?php echo $space['group']['icon'];?></li>
<?php if($space['extgroupids']) { ?><li>��չ�û���: <?php echo $space['extgroupids'];?></li><?php } ?>
<li>ע��ʱ��: <?php echo $space['regdate'];?></li>
<li>������: <?php echo $space['lastvisit'];?></li>
<?php if($_G['uid'] == $space['uid'] || $_G['group']['allowviewip']) { ?>
<li>ע�� IP: <?php echo $space['regip'];?> - <?php echo $space['regip_loc'];?></li>
<li>�ϴη��� IP: <?php echo $space['lastip'];?> - <?php echo $space['lastip_loc'];?></li>
<?php } ?>
<li>�ϴλʱ��: <?php echo $space['lastactivity'];?></li>
<li>�ϴη���ʱ��: <?php echo $space['lastpost'];?></li>
<li>�ϴ��ʼ�֪ͨ: <?php echo $space['lastsendmail'];?></li>
<li>����ʱ��: <?php $timeoffset = array(
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
		'12' => '(GMT +12:00) �¿���, �����, 쳼�, ���ܶ�Ⱥ��');?><?php echo $timeoffset[$space['timeoffset']];?>
</li>
</ul>
</div>

<ul class="pbm mbm bbda cl xl xl2 ">
<li>�ռ������: <?php echo $space['views'];?></li>
<li>������: <?php echo $space['friends'];?></li>
<li>������: <?php echo $space['posts'];?></li>
<li>������: <?php echo $space['threads'];?></li>
<li>������: <?php echo $space['digestposts'];?></li>
<li>��¼��: <?php echo $space['doings'];?></li>
<li>��־��: <?php echo $space['blogs'];?></li>
<li>�����: <?php echo $space['albums'];?></li>
<li>������: <?php echo $space['sharings'];?></li>

<li>���ÿռ�: <?php echo formatsize($space['attachsize'])?></li>
</ul>

<ul class="pbm mbm bbda cl xl xl2 ">
<li>����: <?php echo $space['credits'];?></li><?php if(is_array($_G['setting']['extcredits'])) foreach($_G['setting']['extcredits'] as $key => $value) { if($value['title']) { ?>
<li><?php echo $value['title'];?>: <?php echo $space["extcredits$key"];?> <?php echo $value['unit'];?></li>
<?php } } ?>

<li>�������: <?php echo $space['buyercredit'];?></li>
<li>��������: <?php echo $space['sellercredit'];?></li>
</ul>

<?php if($space['medals']) { ?>
<div class="pbm mbm bbda cl">
<h2 class="mbn">ѫ��</h2><?php if(is_array($space['medals'])) foreach($space['medals'] as $medal) { ?><img src="<?php echo STATICURL;?>/image/common/<?php echo $medal['image'];?>" border="0" alt="<?php echo $medal['name'];?>" title="<?php echo $medal['name'];?>" /> &nbsp;
<?php } ?>
</div>
<?php } if($_G['setting']['verify']['enabled']) { $showverify = true;?><?php if(is_array($_G['setting']['verify'])) foreach($_G['setting']['verify'] as $vid => $verify) { if($verify['available'] && $space['verify'.$vid] == 1) { if($showverify) { ?>
<div class="pbm mbm bbda cl">
<h2 class="mbn">�û���֤</h2><?php $showverify = false;?><?php } ?>
<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=verify&amp;vid=<?php echo $vid;?>" target="_blank"><?php if($verify['icon']) { ?><img src="<?php echo $verify['icon'];?>" class="vm" alt="<?php echo $verify['title'];?>" title="<?php echo $verify['title'];?>" /><?php } else { ?><?php echo $verify['title'];?><?php } ?></a>&nbsp;
<?php } } if(!$showverify) { ?></div><?php } } if($manage_forum) { ?>
<div class="pbm mbm bbda cl">
<h2 class="mbn">�������°��</h2><?php if(is_array($manage_forum)) foreach($manage_forum as $key => $value) { ?><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $key;?>" target="_blank"><?php echo $value;?></a> &nbsp;
<?php } ?>
</div>
<?php } if(!$isfriend) { ?>
<p class="mtw xg1">����뵽�ҵĺ����У����Ϳ����˽��ҵĽ���������һ��������ʱ���ұ�����ϵ </p>
<p class="mtm cl"><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $space['uid'];?>" id="add_friend" onclick="showWindow(this.id, this.href, 'get', 0);" class="pn z" style="text-decoration: none;"><strong class="z">��Ϊ����</strong></a></p>
<?php } ?>
</td>
</tr>
</table>
</div>
</div>
</div><?php include template('common/footer'); ?>