<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('type');?><?php include template('common/header'); ?><div id="pt" class="bm cl">
<div class="z"><a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a><em>&rsaquo;</em><a href="group.php"><?php echo $_G['setting']['navs']['3']['navname'];?></a><?php echo $groupnav;?></div>
</div><?php echo adshow("text/wp a_t");?><style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>
<div id="ct" class="ct2 wp cl">
<div class="mn">
<!--[diy=diycontenttop]--><div id="diycontenttop" class="area"></div><!--[/diy]-->
<div class="bm fl cl">
<div class="bm_h">
<h1 class="xs2"><?php echo $curtype['name'];?></h1>
</div>
<?php if($typelist) { ?>
<div class="bm_c pbm ptm bbs">
<p><?php if(is_array($typelist)) foreach($typelist as $fid => $type) { ?><a href="group.php?sgid=<?php echo $fid;?>"><?php echo $type['name'];?></a><?php if($type['groupnum']) { ?><span class="xg1">(<?php echo $type['groupnum'];?>)</span><?php } ?> &nbsp; <?php } ?></p>
</div>
<?php } else { ?>
<div class="bbs"></div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['index_top'])) echo $_G['setting']['pluginhooks']['index_top'];?>
<?php if($list) { ?>
<div class="tbmu cl bw0">
<span class="y">
<select title="����ʽ" onchange="location.href=this.value" class="ps">
<option value="<?php echo $url;?>" <?php echo $selectorder['default'];?>>Ĭ������</option>
<option value="<?php echo $url;?>&orderby=thread" <?php echo $selectorder['thread'];?>>������</option>
<option value="<?php echo $url;?>&orderby=membernum" <?php echo $selectorder['membernum'];?>>����</option>
<option value="<?php echo $url;?>&orderby=dateline" <?php echo $selectorder['dateline'];?>>����ʱ��</option>
<option value="<?php echo $url;?>&orderby=activity" <?php echo $selectorder['activity'];?>>��Ծ��</option>
</select>
</span>
���� <?php echo $curtype['groupnum'];?> ��<?php echo $_G['setting']['navs']['3']['navname'];?>
</div>
<?php if($curtype['forumcolumns'] > 1) { ?>
<div class="bm_c">
<table cellspacing="0" cellpadding="0" class="fl_tb">
<tr class="fl_row"><?php if(is_array($list)) foreach($list as $fid => $val) { if($val['orderid'] && ($val['orderid'] % $curtype['forumcolumns'] == 0)) { ?>
</tr>
<tr class="fl_row">
<?php } ?>
<td class="fl_g" style="width: <?php echo $curtype['forumcolwidth'];?>">
<div class="fl_icn_g"><a href="forum.php?mod=group&amp;fid=<?php echo $fid;?>" title="<?php echo $val['name'];?>"><img width="48" height="48" src="<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" /></a></div>
<dl>
<dt><a href="forum.php?mod=group&amp;fid=<?php echo $fid;?>" title="<?php echo $val['name'];?>"><?php echo $val['name'];?></a></dt>
<dd>��Ա: <?php echo $val['membernum'];?>, ����: <?php echo $val['threads'];?></dd>
<dd><a href=""><a href="forum.php?mod=group&amp;fid=<?php echo $fid;?>">������: <?php echo $val['dateline'];?></a></dd>
</dl>
</td>
<?php } ?>
<?php echo $endrows;?>
</tr>
</table>
</div>
<?php } else { ?>
<div class="bm_c">
<table cellspacing="0" cellpadding="0" class="fl_tb"><?php if(is_array($list)) foreach($list as $fid => $val) { ?><tr class="fl_row">
<td class="fl_icn"><a href="forum.php?mod=group&amp;fid=<?php echo $fid;?>" title="<?php echo $val['name'];?>"><img width="48" height="48" src="<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>" /></a></td>
<td>
<?php if(!empty($_G['setting']['pluginhooks']['index_grouplist'][$fid])) echo $_G['setting']['pluginhooks']['index_grouplist'][$fid];?>
<strong><a href="forum.php?mod=group&amp;fid=<?php echo $fid;?>" title="<?php echo $val['name'];?>"><?php echo $val['name'];?></a></strong>
<p class="xg1"><?php echo $val['description'];?></p>
</td>
<td class="fl_i">
<span class="i_z z"><strong><?php echo $val['membernum'];?></strong><em class="xg1"><?php echo $_G['setting']['navs']['3']['navname'];?>��Ա</em></span>
<span class="i_y z"><strong><?php echo $val['threads'];?></strong><em class="xg1">����</em></span>
</td>
</tr>
<?php } ?>
</table>
</div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['index_bottom'])) echo $_G['setting']['pluginhooks']['index_bottom'];?>
<?php } else { ?>
<div class="bm emp">
<h2>�÷�������ʱû��<?php echo $_G['setting']['navs']['3']['navname'];?></h2>
<p>�����ϼ���������ѡ�񣬻���[<b><a href="forum.php?mod=group&amp;action=create&amp;fupid=<?php echo $curtype['fup'];?>&amp;groupid=<?php echo $sgid;?>">����һ���µ�<?php echo $_G['setting']['navs']['3']['navname'];?></a></b>]</p>
</div>
<?php } ?>
</div>
<?php if($list) { ?>
<div class="pgs cl">
<?php echo $multipage;?>
<span class="pgb y"><a href="group.php">������ҳ</a></span>
</div>
<?php } ?>
<!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]-->
</div>
<div class="sd">
<!--[diy=diysidetop]--><div id="diysidetop" class="area"></div><!--[/diy]-->
<?php if(!empty($_G['setting']['pluginhooks']['index_side_top'])) echo $_G['setting']['pluginhooks']['index_side_top'];?>
<?php if(helper_access::check_module('group')) { if(empty($gid) && empty($sgid)) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>����<?php echo $_G['setting']['navs']['3']['navname'];?>����</h2>
</div>
<div class="bm_c">
<ul id="g_guide" class="mbm">
<li><label><strong class="xi1">����<?php echo $_G['setting']['navs']['3']['navname'];?></strong><span class="xg1">�����Լ��ĵ���</span></label></li>
<li><label><strong class="xi1">��������</strong><span class="xg1">���Ĵ���<?php echo $_G['setting']['navs']['3']['navname'];?>�ռ�</span></label></li>
<li><label><strong class="xi1">�������</strong><span class="xg1">������Ѽ����ҵ�<?php echo $_G['setting']['navs']['3']['navname'];?></span></label></li>
<li><label><strong class="xi1"><?php echo $_G['setting']['navs']['3']['navname'];?>����</strong><span class="xg1"><?php echo $_G['setting']['navs']['3']['navname'];?>��������Ӯ�������Ƽ�</span></label></li>
</ul>
<a href="forum.php?mod=group&amp;action=create" id="create_group_btn"><img src="<?php echo IMGDIR;?>/create_group.png" alt="����<?php echo $_G['setting']['navs']['3']['navname'];?>" /></a>
</div>
</div>
<div class="drag">
<!--[diy=diy2]--><div id="diy2" class="area"></div><!--[/diy]-->
</div>
<?php } else { ?>
<div class="bm bw0">
<div class="bm_c">
<a href="forum.php?mod=group&amp;action=create&amp;fupid=<?php echo $fup;?>&amp;groupid=<?php echo $sgid;?>" id="create_group_btn"><img src="<?php echo IMGDIR;?>/create_group.png" alt="����<?php echo $_G['setting']['navs']['3']['navname'];?>" /></a>
</div>
</div>
<?php } } ?>
<!--[diy=diytopgrouptop]--><div id="diytopgrouptop" class="area"></div><!--[/diy]-->
<?php if($topgrouplist) { ?>
<div id="g_top" class="bm">
<div class="bm_h cl">
<h2><?php echo $_G['setting']['navs']['3']['navname'];?>��������</h2>
</div>
<div class="bm_c">
<ol class="xl"><?php if(is_array($topgrouplist)) foreach($topgrouplist as $fid => $group) { ?><li class="top1"><span class="y xi2 xg1"> <?php echo $group['commoncredits'];?></span><a href="forum.php?mod=group&amp;fid=<?php echo $group['fid'];?>" title="<?php echo $group['name'];?>"><?php echo $group['name'];?></a></li>
<?php } ?>
</ol>
</div>
</div>
<?php } ?>
<div class="drag">
<!--[diy=diy4]--><div id="diy4" class="area"></div><!--[/diy]-->
</div>
<?php if(!empty($_G['setting']['pluginhooks']['index_side_bottom'])) echo $_G['setting']['pluginhooks']['index_side_bottom'];?>
</div>
</div>

<div class="wp mtn">
<!--[diy=diy4]--><div id="diy4" class="area"></div><!--[/diy]-->
</div><?php include template('common/footer'); ?>