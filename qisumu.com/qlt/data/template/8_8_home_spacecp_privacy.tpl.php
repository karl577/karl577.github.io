<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_privacy');
0
|| checktplrefresh('./template/default/home/spacecp_privacy.htm', './template/default/home/spacecp_header.htm', 1520503000, '8', './data/template/8_8_home_spacecp_privacy.tpl.php', './template/wic_selfmedia', 'home/spacecp_privacy')
|| checktplrefresh('./template/default/home/spacecp_privacy.htm', './template/wic_selfmedia/home/spacecp_footer.htm', 1520503000, '8', './data/template/8_8_home_spacecp_privacy.tpl.php', './template/wic_selfmedia', 'home/spacecp_privacy')
|| checktplrefresh('./template/default/home/spacecp_privacy.htm', './template/default/home/spacecp_header_name.htm', 1520503000, '8', './data/template/8_8_home_spacecp_privacy.tpl.php', './template/wic_selfmedia', 'home/spacecp_privacy')
|| checktplrefresh('./template/default/home/spacecp_privacy.htm', './template/default/home/spacecp_header_name.htm', 1520503000, '8', './data/template/8_8_home_spacecp_privacy.tpl.php', './template/wic_selfmedia', 'home/spacecp_privacy')
;?><?php include template('common/header'); ?><div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="home.php?mod=spacecp">����</a> <em>&rsaquo;</em><?php if($actives['profile']) { ?>
��������
<?php } elseif($actives['verify']) { ?>
��֤
<?php } elseif($actives['avatar']) { ?>
�޸�ͷ��
<?php } elseif($actives['credit']) { ?>
����
<?php } elseif($actives['usergroup']) { ?>
�û���
<?php } elseif($actives['privacy']) { ?>
��˽ɸѡ
<?php } elseif($actives['sendmail']) { ?>
�ʼ�����
<?php } elseif($actives['password']) { ?>
���밲ȫ
<?php } elseif($actives['promotion']) { ?>
�����ƹ�
<?php } elseif($actives['plugin']) { ?>
<?php echo $_G['setting']['plugins'][$pluginkey][$_GET['id']]['name'];?>
<?php } ?></div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<h1 class="mt"><?php if($actives['profile']) { ?>
��������
<?php } elseif($actives['verify']) { ?>
��֤
<?php } elseif($actives['avatar']) { ?>
�޸�ͷ��
<?php } elseif($actives['credit']) { ?>
����
<?php } elseif($actives['usergroup']) { ?>
�û���
<?php } elseif($actives['privacy']) { ?>
��˽ɸѡ
<?php } elseif($actives['sendmail']) { ?>
�ʼ�����
<?php } elseif($actives['password']) { ?>
���밲ȫ
<?php } elseif($actives['promotion']) { ?>
�����ƹ�
<?php } elseif($actives['plugin']) { ?>
<?php echo $_G['setting']['plugins'][$pluginkey][$_GET['id']]['name'];?>
<?php } ?></h1>
<!--don't close the div here--><?php if(!empty($_G['setting']['pluginhooks']['spacecp_privacy_top'])) echo $_G['setting']['pluginhooks']['spacecp_privacy_top'];?>
<ul class="tb cl">
<li<?php echo $opactives['base'];?>><a href="home.php?mod=spacecp&amp;ac=privacy&amp;op=base">������˽����</a></li>
<?php if(helper_access::check_module('feed')) { ?>
<li<?php echo $opactives['feed'];?>><a href="home.php?mod=spacecp&amp;ac=privacy&amp;op=feed">���˶�̬��������</a></li>
<li<?php echo $opactives['filter'];?>><a href="home.php?mod=spacecp&amp;ac=privacy&amp;op=filter">��̬ɸѡ</a></li>
<?php } ?>
</ul>
<form method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=privacy&amp;op=<?php echo $operation;?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />

<?php if($operation == 'base') { ?>
<p class="tbmu mbm">��������ȫ������Щ�˿��Կ���������ҳ���������</p>
<table cellspacing="0" cellpadding="0" class="tfm">

<tr>
<th>�����б�</th>
<td>
<select name="privacy[view][friend]">
<option value="0"<?php echo $sels['view']['friend']['0'];?>>����</option>
<option value="1"<?php echo $sels['view']['friend']['1'];?>>���ѿɼ�</option>
<option value="2"<?php echo $sels['view']['friend']['2'];?>>����</option>
<option value="3"<?php echo $sels['view']['friend']['3'];?>>��ע���û��ɼ�</option>
</select>
</td>
</tr>
<?php if(helper_access::check_module('wall')) { ?>
<tr>
<th>���԰�</th>
<td>
<select name="privacy[view][wall]">
<option value="0"<?php echo $sels['view']['wall']['0'];?>>����</option>
<option value="1"<?php echo $sels['view']['wall']['1'];?>>���ѿɼ�</option>
<option value="2"<?php echo $sels['view']['wall']['2'];?>>����</option>
<option value="3"<?php echo $sels['view']['wall']['3'];?>>��ע���û��ɼ�</option>
</select>
</td>
</tr>
<?php } if(helper_access::check_module('feed')) { ?>
<tr>
<th>��̬</th>
<td>
<select name="privacy[view][home]">
<option value="0"<?php echo $sels['view']['home']['0'];?>>����</option>
<option value="1"<?php echo $sels['view']['home']['1'];?>>���ѿɼ�</option>
<option value="3"<?php echo $sels['view']['home']['3'];?>>��ע���û��ɼ�</option>
</select>
</td>
</tr>
<?php } if(helper_access::check_module('doing')) { ?>
<tr>
<th>��¼</th>
<td>
<select name="privacy[view][doing]">
<option value="0"<?php echo $sels['view']['doing']['0'];?>>����</option>
<option value="1"<?php echo $sels['view']['doing']['1'];?>>���ѿɼ�</option>
<option value="3"<?php echo $sels['view']['doing']['3'];?>>��ע���û��ɼ�</option>
</select>
<p class="d">����˽���ý��������û��鿴����ҳʱ��Ч<br />��ȫվ�ļ�¼�б��п��ܻ�������ļ�¼</p>
</td>
</tr>
<?php } if(helper_access::check_module('blog')) { ?>
<tr>
<th>��־</th>
<td>
<select name="privacy[view][blog]">
<option value="0"<?php echo $sels['view']['blog']['0'];?>>����</option>
<option value="1"<?php echo $sels['view']['blog']['1'];?>>���ѿɼ�</option>
<option value="3"<?php echo $sels['view']['blog']['3'];?>>��ע���û��ɼ�</option>
</select>
<p class="d">����˽���ý��������û��鿴����ҳʱ��Ч<br />������Ȩ����Ҫ�ڷ���ʱ�������÷�����ȫ��Ч</p>
</td>
</tr>
<?php } if(helper_access::check_module('album')) { ?>
<tr>
<th>���</th>
<td>
<select name="privacy[view][album]">
<option value="0"<?php echo $sels['view']['album']['0'];?>>����</option>
<option value="1"<?php echo $sels['view']['album']['1'];?>>���ѿɼ�</option>
<option value="3"<?php echo $sels['view']['album']['3'];?>>��ע���û��ɼ�</option>
</select>
<p class="d">����˽���ý��������û��鿴����ҳʱ��Ч<br />������Ȩ����Ҫ�ڷ���ʱ�������÷�����ȫ��Ч</p>
</td>
</tr>
<?php } if(helper_access::check_module('share')) { ?>
<tr>
<th>����</th>
<td>
<select name="privacy[view][share]">
<option value="0"<?php echo $sels['view']['share']['0'];?>>����</option>
<option value="1"<?php echo $sels['view']['share']['1'];?>>���ѿɼ�</option>
<option value="3"<?php echo $sels['view']['share']['3'];?>>��ע���û��ɼ�</option>
</select>
<p class="d">����˽���ý��������û��鿴����ҳʱ��Ч<br />������Ȩ����Ҫ�ڷ���ʱ�������÷�����ȫ��Ч</p>
</td>
</tr>
<?php } if($_G['setting']['videophoto'] && $space['videophotostatus']) { ?>
<tr>
<th>&nbsp;</th>
<td><img src="<?php echo IMGDIR;?>/videophoto.gif" alt="" class="vm" /> ���Ѿ�ͨ����Ƶ��֤������û��ͨ����Ƶ��֤���û�����������������Ȩ�� :</td>
</tr>
<tr>
<th>�鿴��֤��Ƭ</th>
<td>
<select name="privacy[view][videoviewphoto]">
<option value="0"<?php echo $sels['view']['videoviewphoto']['0'];?>>վ��Ĭ������</option>
<option value="1"<?php echo $sels['view']['videoviewphoto']['1'];?>>���� </option>
<option value="2"<?php echo $sels['view']['videoviewphoto']['2'];?>>��ֹ</option>
</select>
</td>
</tr>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_privacy_base_extra'])) echo $_G['setting']['pluginhooks']['spacecp_privacy_base_extra'];?>
<tr>
<th>&nbsp;</th>
<td><button type="submit" name="privacysubmit" value="true" class="pn pnc" /><strong>����</strong></button></td>
</tr>
</table>

<?php } elseif($operation == 'feed') { ?>
<p class="tbmu mbm">ϵͳ�Ὣ���ĸ������ӳ�����˶�̬����������˽����Ķ�̬��<br />�����Կ����Ƿ������ж�������ʱ���ڸ��˶�̬�﷢�������Ϣ </p>
<table cellspacing="0" cellpadding="0" id="feed" class="tfm">
<tr>
<th>&nbsp;</th>
<td class="pcl">
<label><input type="checkbox" class="pc" name="privacy[feed][doing]" value="1"<?php echo $sels['feed']['doing'];?> />��¼</label>
<label><input type="checkbox" class="pc" name="privacy[feed][blog]" value="1"<?php echo $sels['feed']['blog'];?> />׫д��־</label>
<label><input type="checkbox" class="pc" name="privacy[feed][upload]" value="1"<?php echo $sels['feed']['upload'];?> />�ϴ�ͼƬ</label>
<label><input type="checkbox" class="pc" name="privacy[feed][share]" value="1"<?php echo $sels['feed']['share'];?> />��ӷ���</label>
<label><input type="checkbox" class="pc" name="privacy[feed][friend]" value="1"<?php echo $sels['feed']['friend'];?> />��Ӻ���</label>
<label><input type="checkbox" class="pc" name="privacy[feed][comment]" value="1"<?php echo $sels['feed']['comment'];?> />��������/����</label>
<label><input type="checkbox" class="pc" name="privacy[feed][show]" value="1"<?php echo $sels['feed']['show'];?> />��������</label>
<label><input type="checkbox" class="pc" name="privacy[feed][credit]" value="1"<?php echo $sels['feed']['credit'];?> />��������</label>
<label><input type="checkbox" class="pc" name="privacy[feed][invite]" value="1"<?php echo $sels['feed']['invite'];?> />�������</label>
<label><input type="checkbox" class="pc" name="privacy[feed][task]" value="1"<?php echo $sels['feed']['task'];?> />�������</label>
<label><input type="checkbox" class="pc" name="privacy[feed][profile]" value="1"<?php echo $sels['feed']['profile'];?> />���¸�������</label>
<label><input type="checkbox" class="pc" name="privacy[feed][click]" value="1"<?php echo $sels['feed']['click'];?> />����־/ͼƬ��̬</label>
<label><input type="checkbox" class="pc" name="privacy[feed][newthread]" value="1"<?php echo $sels['feed']['newthread'];?> />��̳����</label>
<label><input type="checkbox" class="pc" name="privacy[feed][newreply]" value="1"<?php echo $sels['feed']['newreply'];?> />��̳����</label>
</td>
</tr>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_privacy_feed_extra'])) echo $_G['setting']['pluginhooks']['spacecp_privacy_feed_extra'];?>
<tr>
<th>&nbsp;</th>
<td><button type="submit" name="privacysubmit" value="true" class="pn pnc" /><strong>����</strong></button></td>
</tr>
</table>

<?php } else { $iconnames['wall'] = '���԰�';
$iconnames['piccomment'] = 'ͼƬ����';
$iconnames['blogcomment'] = '��־����';
$iconnames['sharecomment'] = '��������';
$iconnames['magic'] = '����';
$iconnames['sharenotice'] = '����֪ͨ';
$iconnames['clickblog'] = '��־��̬';
$iconnames['clickpic'] = 'ͼƬ��̬';
$iconnames['credit'] = '����';
$iconnames['doing'] = '��¼';
$iconnames['pcomment'] = '�������';
$iconnames['post'] = '����ظ�';
$iconnames['show'] = '���а�';
$iconnames['task'] = '����';
$iconnames['goods'] = '��Ʒ';
$iconnames['group'] = $_G[setting][navs][3][navname];
$iconnames['thread'] = '����';
$iconnames['system'] = 'ϵͳ';
$iconnames['friend'] = '����';
$iconnames['debate'] = '����';
$iconnames['album'] = '���';
$iconnames['blog'] = '��־';
$iconnames['poll'] = 'ͶƱ';
$iconnames['activity'] = '�';
$iconnames['reward'] = '����';
$iconnames['share'] = '����';
$iconnames['profile'] = '���¸�������';
$iconnames['pusearticle'] = '��������';?><table cellspacing="0" cellpadding="0" class="tfm bbda">
<caption>
<h2 class="ptw pbn xs2">ɸѡ����һ������ָ���û���Ķ�̬</h2>
<p class="xg1">�����Ծ���������Щ�û���Ķ�̬�������û����ڵ���Ա�������Ķ�̬���������ε�(���޲鿴���ѵĶ�̬ʱ��Ч) </p>
</caption>
<tr>
<th>&nbsp;</th>
<td class="pcl"><?php if(is_array($groups)) foreach($groups as $key => $value) { ?><label><input type="checkbox" class="pc" name="privacy[filter_gid][<?php echo $key;?>]" value="<?php echo $key;?>"<?php if(isset($space['privacy']['filter_gid'][$key])) { ?> checked="checked"<?php } ?> /><?php echo $value;?></label>
<?php } ?>
</td>
</tr>
<tr>
<th>&nbsp;</th>
<td>
<button type="submit" name="privacy2submit" value="true" class="pn pnc" /><strong>����</strong></button>
<p class="d">���������Լ���<a href="home.php?mod=space&amp;do=friend">�����б�</a>�У��Ժ��ѽ��з��飬�����Զ��û�����и��� </span>
</td>
</tr>
</table>

<table cellspacing="0" cellpadding="0" class="tfm bbda">
<caption>
<h2 class="ptw pbn xs2">ɸѡ�����������ָ������ָ�����͵Ķ�̬</h2>
<p class="xg1">���һ����ҳ���Ѷ�̬�б��������α�־���Ϳ�������ָ������ָ�����͵Ķ�̬�ˡ�<br />�����г��������Ѿ����εĶ�̬����ʶ�����ͺ�������������ѡ���Ƿ�ȡ������ </p>
</caption>
<?php if($icons) { ?>
<tr>
<th>&nbsp;</th>
<td class="pcl"><?php if(is_array($icons)) foreach($icons as $key => $icon) { $uid = $uids[$key];$icon_uid="$icon|$uid";?><label>
<?php if(is_numeric($icon)) { ?>
<img src="http://appicon.manyou.com/icons/<?php echo $icon;?>" alt="" class="vm" />
<?php } else { ?>
<img src="<?php echo STATICURL;?>image/feed/<?php echo $icon;?>.gif" alt="" class="vm" />
<?php } ?>
<input type="checkbox" class="pc" name="privacy[filter_icon][<?php echo $icon_uid;?>]" value="1" checked="checked" /> 
<?php if(isset($iconnames[$icon])) { ?><?php echo $iconnames[$icon];?><?php } else { ?><?php echo $icon;?><?php } ?> (<?php if($users[$uid]) { ?><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank"><?php echo $users[$uid];?></a><?php } else { ?>ȫ������<?php } ?>)
</label>
<?php } ?>
</td>
</tr>
<tr>
<th>&nbsp;</th>
<td><button type="submit" name="privacy2submit" value="true" class="pn pnc" /><strong>����</strong></button></td>
</tr>
<?php } else { ?>
<tr>
<th>&nbsp;</th>
<td class="d">���ڻ�û�����εĶ�̬����</td>
</tr>
<?php } ?>
</table>

<table cellspacing="0" cellpadding="0" class="tfm">
<caption>
<h2 class="ptw pbn xs2">ɸѡ������������ָ������ָ�����͵�����</h2>
<p class="xg1">���һ��֪ͨ�б��������α�־���Ϳ�������ָ������ָ�����͵�֪ͨ�ˡ�<br />�����г��������Ѿ����ε�֪ͨ���ͺͺ�������������ѡ���Ƿ�ȡ������ </p>
</caption>
<?php if($types) { ?>
<tr>
<th>&nbsp;</th>
<td><?php if(is_array($types)) foreach($types as $key => $type) { $uid = $uids[$key];$type_uid="$type|$uid";?><label>
<input type="checkbox" class="pc" name="privacy[filter_note][<?php echo $type_uid;?>]" value="1" checked="checked" />
<?php if(isset($iconnames[$type])) { ?><?php echo $iconnames[$type];?><?php } else { ?><?php echo $type;?><?php } ?> (<?php if($users[$uid]) { ?><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank"><?php echo $users[$uid];?></a><?php } else { ?>ȫ������<?php } ?>)
</label>
<?php } ?>
</td>
</tr>
<tr>
<th>&nbsp;</th>
<td><button type="submit" name="privacy2submit" value="true" class="pn pnc" /><strong>����</strong></button></td>
</tr>
<?php } else { ?>
<tr>
<th>&nbsp;</th>
<td class="d">���ڻ�û�����εĶ�̬����</td>
</tr>
<?php } ?>
</table>
<?php } ?>
</form>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_privacy_bottom'])) echo $_G['setting']['pluginhooks']['spacecp_privacy_bottom'];?>
</div>
</div>
<div class="appl"><div class="tbn">
<h2 class="mt bbda">����</h2>
<ul>
<li<?php echo $actives['avatar'];?>><em></em><i></i><a href="home.php?mod=spacecp&amp;ac=avatar">�޸�ͷ��</a></li>
<li<?php echo $actives['profile'];?>><em></em><i></i><a href="home.php?mod=spacecp&amp;ac=profile">��������</a></li>
<?php if($_G['setting']['verify']['enabled'] && allowverify() || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li<?php echo $actives['verify'];?>><em></em><i></i><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">��֤</a></li>
<?php } ?>
<li<?php echo $actives['credit'];?>><em></em><i></i><a href="home.php?mod=spacecp&amp;ac=credit">����</a></li>
<li<?php echo $actives['usergroup'];?>><em></em><i></i><a href="home.php?mod=spacecp&amp;ac=usergroup">�û���</a></li>
<li<?php echo $actives['privacy'];?>><em></em><i></i><a href="home.php?mod=spacecp&amp;ac=privacy">��˽ɸѡ</a></li>

<?php if($_G['setting']['sendmailday']) { ?><li<?php echo $actives['sendmail'];?>><em></em><i></i><a href="home.php?mod=spacecp&amp;ac=sendmail">�ʼ�����</a></li><?php } ?>
<li<?php echo $actives['password'];?>><em></em><i></i><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">���밲ȫ</a></li>

<?php if($_G['setting']['creditspolicy']['promotion_visit'] || $_G['setting']['creditspolicy']['promotion_register']) { ?>
<li<?php echo $actives['promotion'];?>><em></em><i></i><a href="home.php?mod=spacecp&amp;ac=promotion">�����ƹ�</a></li>
<?php } if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_GET['id'] == $id) { ?> class="a"<?php } ?>><em></em><i></i><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?>
</ul>
</div></div>
</div><?php include template('common/footer'); ?>