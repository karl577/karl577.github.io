<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portalcp_index');
0
|| checktplrefresh('./template/default/portal/portalcp_index.htm', './template/default/portal/portalcp_nav.htm', 1548722634, '7', './data/template/7_7_portal_portalcp_index.tpl.php', './template/banzhuan_weibo', 'portal/portalcp_index')
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

<div class="c" style="width:260px; height: 300px; overflow: hidden; overflow-y: scroll;">
<p>ѡ��һ��Ƶ�����ࣺ</p>
<?php if($categorytree) { ?>
<table class="mtw dt">
<?php echo $categorytree;?>
</table>
<?php } else { ?>
<p>����û�пɹ����Ƶ����Ŀ</p>
<?php } ?>
</div>
<script language="javascript">
function toggle_group(oid, obj, conf) {
obj = obj ? obj : $('a_'+oid);
if(!conf) {
var conf = {'show':'[-]','hide':'[+]'};
}
var obody = $(oid);
if(obody.style.display == 'none') {
obody.style.display = '';
obj.innerHTML = conf.show;
} else {
obody.style.display = 'none';
obj.innerHTML = conf.hide;
}
}
</script>

<?php } else { ?>
<div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="portal.php"><?php echo $_G['setting']['navs']['1']['navname'];?></a> <em>&rsaquo;</em>
<a href="portal.php?mod=portalcp">�Ż�����</a> <em>&rsaquo;</em>
Ƶ����Ŀ
</div>
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<?php if($categorytree) { ?>
<table class="dt">
<tr>
<th>��������</th>
<th width="80">������</th>
<th width="120">����</th>
</tr>
<?php echo $categorytree;?>
</table>
<?php } elseif(empty($_G['cache']['portalcategory'])) { ?>
<p>����û�д����κ�Ƶ����Ŀ</p>
<?php } else { ?>
<p>����û�пɹ����Ƶ����Ŀ</p>
<?php } ?>
</div>
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