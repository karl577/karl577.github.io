<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portalcp_login');
0
|| checktplrefresh('./template/default/portal/portalcp_login.htm', './template/default/portal/portalcp_nav.htm', 1487815614, '8', './data/template/8_8_portal_portalcp_login.tpl.php', './template/wic_selfmedia', 'portal/portalcp_login')
;?><?php include template('common/header'); ?><style type="text/css">
.parentcat {}
.cat { margin-left: 20px; }
.lastchildcat, .childcat { margin-left: 40px; }
</style>
<?php if($op == 'push') { ?>
<h3 class="flb">
<em>��������</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_GET['handlekey'];?>');" class="flbc" title="�ر�">�ر�</a></span><?php } ?>
</h3>

<div class="c" style="width:220px; height: 300px; overflow: hidden; overflow-y: scroll;">
<p>ѡ��һ��Ƶ�����ࣺ</p>
<table class="mtw dt">
<?php echo $categorytree;?>
</table>
</div>

<?php } else { ?>
<div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<?php if($_G['setting']['portalstatus'] ) { ?><a href="portal.php"><?php echo $_G['setting']['navs']['1']['navname'];?></a> <em>&rsaquo;</em><?php } ?>
<a href="portal.php?mod=portalcp"><?php if($_G['setting']['portalstatus'] ) { ?>�Ż�����<?php } else { ?>ģ�����<?php } ?></a> <em>&rsaquo;</em>
��¼
</div>
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0 mdcp">
<h1 class="mt">��¼�������</h1>
<div class="mbw">�״ν�������������ʱ�����, ������������ܽ��롣�������������󳬹� 5 �Σ�������彫������ 15 ���ӡ�</div>
<form method="post" autocomplete="off" action="portal.php?mod=portalcp" class="exfm">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>">
<input type="hidden" name="submit" value="yes">
<input type="hidden" name="login_panel" value="yes">
<table cellspacing="0" cellpadding="5">
<tr>
<th width="60">�û���:</th><td><?php echo $_G['member']['username'];?></td>
</tr>
<tr>
<th>����:</th><td><input id="cppwd" type="password" name="cppwd" class="px" /></td>
</tr>
<tr>
<th></th><td><button type="submit" class="pn" name="submit" id="submit" value="true"><strong>�ύ</strong></button></td>
</tr>
</table>
</form>
</div>
<script type="text/javascript">
$("cppwd").focus();
</script>
</div>
<div class="appl"><div class="tbn">
<h2 class="mt bbda"><?php if($_G['setting']['portalstatus'] ) { ?>�Ż�����<?php } else { ?>ģ�����<?php } ?></h2>
<ul>
<?php if($_G['setting']['portalstatus'] ) { if($admincp2 || $_G['group']['allowmanagearticle']) { ?><li<?php if($ac == 'index') { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=index">Ƶ����Ŀ</a></li><?php } if($admincp2 || $admincp3 || $_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle']) { ?><li<?php if($ac == 'category') { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=category">���¹���</a></li><?php } } if($admincp4 || $admincp6 || $_G['group']['allowdiy']) { ?>
<li<?php if($ac == 'portalblock' || $ac=='block') { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=portalblock">ģ�����</a></li>
<?php } if(!$_G['inajax'] && !empty($_G['setting']['plugins']['portalcp'])) { if(is_array($_G['setting']['plugins']['portalcp'])) foreach($_G['setting']['plugins']['portalcp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_GET['id'] == $id) { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } if(!empty($modsession->islogin)) { ?>
<li><a href="portal.php?mod=portalcp&amp;ac=logout">�˳�</a></li>
<?php } ?>
</ul>
</div></div>
</div>
<?php } include template('common/footer'); ?>