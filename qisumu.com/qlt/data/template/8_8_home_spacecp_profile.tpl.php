<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_profile');
0
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/default/home/spacecp_header.htm', 1520502999, '8', './data/template/8_8_home_spacecp_profile.tpl.php', './template/wic_selfmedia', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/wic_selfmedia/home/spacecp_footer.htm', 1520502999, '8', './data/template/8_8_home_spacecp_profile.tpl.php', './template/wic_selfmedia', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/default/common/seccheck.htm', 1520502999, '8', './data/template/8_8_home_spacecp_profile.tpl.php', './template/wic_selfmedia', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/wic_selfmedia/home/spacecp_profile_nav.htm', 1520502999, '8', './data/template/8_8_home_spacecp_profile.tpl.php', './template/wic_selfmedia', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/default/common/seditor.htm', 1520502999, '8', './data/template/8_8_home_spacecp_profile.tpl.php', './template/wic_selfmedia', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/wic_selfmedia/home/spacecp_footer.htm', 1520502999, '8', './data/template/8_8_home_spacecp_profile.tpl.php', './template/wic_selfmedia', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/default/home/spacecp_header_name.htm', 1520502999, '8', './data/template/8_8_home_spacecp_profile.tpl.php', './template/wic_selfmedia', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/default/home/spacecp_header_name.htm', 1520502999, '8', './data/template/8_8_home_spacecp_profile.tpl.php', './template/wic_selfmedia', 'home/spacecp_profile')
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
<!--don't close the div here--><?php if($validate) { ?>
<p class="tbmu mbm">����Ա���������ע�����룬������ע��ԭ�������ύ����</p>
<form action="member.php?mod=regverify" method="post" autocomplete="off">
<input type="hidden" value="<?php echo FORMHASH;?>" name="formhash" />
<table summary="��������" cellspacing="0" cellpadding="0" class="tfm">
<tr>
<th>���ԭ��</th>
<td><?php echo $validate['remark'];?></td>
<td>&nbsp;</td>
</tr>
<tr>
<th>ע��ԭ��</th>
<td><input type="text" class="px" name="regmessagenew" value="" /></td>
<td>&nbsp;</td>
</tr>
<tr>
<th>&nbsp;</th>
<td colspan="2">
<button type="submit" name="verifysubmit" value="true" class="pn pnc" /><strong>�����ύ����</strong></button>
</td>
</tr>
</table>
</div></div>
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
<?php } else { if($operation == 'password') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>register.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<p class="bbda pbm mbm">
<?php if(!$_G['member']['freeze']) { if(!$_G['setting']['connect']['allow'] || !$conisregister) { ?>��������дԭ��������޸����������<?php } else { ?>��Ŀǰʹ�õ���QQ�ʺŰ󶨱�վ�����������������ö������룬ֻ�������˶��������վ��Ҫ��д�������Ӧ���ܲſ�ʹ��<?php } } elseif($_G['member']['freeze'] == 1) { ?>
<strong class="xi1">����ǰ���ʺŴ��ڰ�ȫ�����Ѿ������ᣬ���޸�����������״̬</strong>
<?php } elseif($_G['member']['freeze'] == 2) { ?>
<strong class="xi1">����ǰ���ʺ��Ѿ�̫��ʱ��δ��¼��վ�Ѿ������ᣬ������֤�������ܽ������״̬ <a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password&amp;resend=1" class="xi2">���½�����֤�ʼ�</a></strong>
<?php } ?>
</p>
<form action="home.php?mod=spacecp&amp;ac=profile" method="post" autocomplete="off">
<input type="hidden" value="<?php echo FORMHASH;?>" name="formhash" />
<table summary="��������" cellspacing="0" cellpadding="0" class="tfm">
<?php if(!$_G['setting']['connect']['allow'] || !$conisregister) { ?>
<tr>
<th><span class="rq" title="����">*</span>������</th>
<td><input type="password" name="oldpassword" id="oldpassword" class="px" /></td>
</tr>
<?php } ?>
<tr>
<th>������</th>
<td>
<input type="password" name="newpassword" id="newpassword" class="px" />
<p class="d" id="chk_newpassword">�粻��Ҫ�������룬�˴������� </p>
</td>
</tr>
<tr>
<th>ȷ��������</th>
<td>
<input type="password" name="newpassword2" id="newpassword2"class="px" />
<p class="d" id="chk_newpassword2">�粻��Ҫ�������룬�˴������� </p>
</td>
</tr>
<tr id="contact"<?php if($_GET['from'] == 'contact') { ?> style="background-color: <?php echo $_G['style']['specialbg'];?>;"<?php } ?>>
<th>Email</th>
<td>
<input type="text" name="emailnew" id="emailnew" value="<?php echo $space['email'];?>" class="px" />
<p class="d">
<?php if(empty($space['newemail'])) { ?>
<img src="<?php echo IMGDIR;?>/mail_active.png" alt="����֤" class="vm" /> <span class="xi1">��ǰ�����Ѿ���֤����</span>
<?php } else { ?>
<?php echo $acitvemessage;?>
<?php } ?>
</p>
<?php if($_G['setting']['regverify'] == 1 && (($_G['group']['grouptype'] == 'member' && $_G['adminid'] == 0) || $_G['groupid'] == 8) || $_G['member']['freeze']) { ?><p class="d">!����ĵ�ַ��ϵͳ���޸��������벢������֤����Ч�ԣ������� </p><?php } ?>
</td>
</tr>

<?php if($_G['member']['freeze'] == 2) { ?>
<tr>
<th>��������</th>
<td>
<textarea rows="3" cols="80" name="freezereson" class="pt"><?php echo $space['freezereson'];?></textarea>
<p class="d" id="chk_newpassword2">������޷�ͨ��������֤������д��������</p>
</td>
</tr>
<?php } ?>

<tr>
<th>��ȫ����</th>
<td>
<select name="questionidnew" id="questionidnew">
<option value="" selected>����ԭ�еİ�ȫ���ʺʹ�</option>
<option value="0">�ް�ȫ����</option>
<option value="1">ĸ�׵�����</option>
<option value="2">үү������</option>
<option value="3">���׳����ĳ���</option>
<option value="4">������һλ��ʦ������</option>
<option value="5">�����˼�������ͺ�</option>
<option value="6">����ϲ���Ĳ͹�����</option>
<option value="7">��ʻִ�������λ����</option>
</select>
<p class="d">��������ð�ȫ���ʣ���¼ʱ��������Ӧ����Ŀ���ܵ�¼ </p>
</td>
</tr>

<tr>
<th>�ش�</th>
<td>
<input type="text" name="answernew" id="answernew" class="px" />
<p class="d">���������µİ�ȫ���ʣ����ڴ������ </p>
</td>
</tr>					
<?php if($secqaacheck || $seccodecheck) { ?>
</table><?php $sectpl = '<table cellspacing="0" cellpadding="0" class="tfm"><tr><th><sec></th><td><sec><p class="d"><sec></p></td></tr></table>';?><?php $sechash = !isset($sechash) ? 'S'.($_G['inajax'] ? 'A' : '').$_G['sid'] : $sechash.random(3);
$sectpl = str_replace("'", "\'", $sectpl);?><?php if($secqaacheck) { ?>
<span id="secqaa_q<?php echo $sechash;?>"></span>		
<script type="text/javascript" reload="1">updatesecqaa('q<?php echo $sechash;?>', '<?php echo $sectpl;?>', '<?php echo $_G['basescript'];?>::<?php echo CURMODULE;?>');</script>
<?php } if($seccodecheck) { ?>
<span id="seccode_c<?php echo $sechash;?>"></span>		
<script type="text/javascript" reload="1">updateseccode('c<?php echo $sechash;?>', '<?php echo $sectpl;?>', '<?php echo $_G['basescript'];?>::<?php echo CURMODULE;?>');</script>
<?php } ?><table summary="��������" cellspacing="0" cellpadding="0" class="tfm">
<?php } ?>					
<tr>
<th>&nbsp;</th>
<td><button type="submit" name="pwdsubmit" value="true" class="pn pnc" /><strong>����</strong></button></td>
</tr>
</table>
<input type="hidden" name="passwordsubmit" value="true" />
</form>
<script type="text/javascript">
var strongpw = new Array();
<?php if($_G['setting']['strongpw']) { if(is_array($_G['setting']['strongpw'])) foreach($_G['setting']['strongpw'] as $key => $val) { ?>strongpw[<?php echo $key;?>] = <?php echo $val;?>;
<?php } } ?>
var pwlength = <?php if($_G['setting']['pwlength']) { ?><?php echo $_G['setting']['pwlength'];?><?php } else { ?>0<?php } ?>;
checkPwdComplexity($('newpassword'), $('newpassword2'), true);
</script>
<?php } else { ?>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_profile_top'])) echo $_G['setting']['pluginhooks']['spacecp_profile_top'];?><ul class="tb cl">
<?php if($operation != 'verify') { if(is_array($profilegroup)) foreach($profilegroup as $key => $value) { if($value['available']) { ?>
<li <?php echo $opactives[$key];?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=<?php echo $key;?>"><?php echo $value['title'];?></a></li>
<?php } } if($_G['setting']['allowspacedomain'] && $_G['setting']['domain']['root']['home'] && checkperm('domainlength')) { ?>
<li <?php echo $opactives['domain'];?>><a href="home.php?mod=spacecp&amp;ac=domain">�ҵĿռ�����</a></li>
<?php } } else { if($_G['setting']['verify']) { if(is_array($_G['setting']['verify'])) foreach($_G['setting']['verify'] as $vid => $verify) { if($verify['available'] && (empty($verify['groupid']) || in_array($_G['groupid'], $verify['groupid']))) { if($vid != 7) { ?>
<li <?php echo $opactives['verify'.$vid];?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=verify&amp;vid=<?php echo $vid;?>"><?php echo $verify['title'];?></a></li>
<?php } elseif($_G['setting']['my_app_status'] && $vid == 7) { ?>
<li <?php echo $opactives['videophoto'];?>><a href="home.php?mod=spacecp&amp;ac=videophoto">��Ƶ��֤</a></li>
<?php } } } } } if($op != 'verify' && !empty($_G['setting']['plugins']['spacecp_profile'])) { if(is_array($_G['setting']['plugins']['spacecp_profile'])) foreach($_G['setting']['plugins']['spacecp_profile'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_GET['id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;op=profile&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?>
</ul><?php if($vid) { ?>
<p class="tbms mtm <?php if(!$showbtn) { ?>tbms_r<?php } ?>"><?php if($showbtn) { ?>������Ϣͨ����˺󽫲����ٴ��޸ģ��ύ�������ĵȴ��˲� <?php } else { ?>��ϲ����������֤����Ѿ�ͨ����������������Ѿ��������޸� <?php } ?></p>
<?php } ?>
<iframe id="frame_profile" name="frame_profile" style="display: none"></iframe>
<form action="<?php if($operation != 'plugin') { ?>home.php?mod=spacecp&ac=profile&op=<?php echo $operation;?><?php } else { ?>home.php?mod=spacecp&ac=plugin&op=profile&id=<?php echo $_GET['id'];?><?php } ?>" method="post" enctype="multipart/form-data" autocomplete="off"<?php if($operation != 'plugin') { ?> target="frame_profile"<?php } ?> onsubmit="clearErrorInfo();">
<input type="hidden" value="<?php echo FORMHASH;?>" name="formhash" />
<?php if($_GET['vid']) { ?>
<input type="hidden" value="<?php echo $_GET['vid'];?>" name="vid" />
<?php } ?>
<table cellspacing="0" cellpadding="0" class="tfm" id="profilelist">
<tr>
<th>�û���</th>
<td><?php echo $_G['member']['username'];?></td>
<td>&nbsp;</td>
</tr><?php if(is_array($settings)) foreach($settings as $key => $value) { if($value['available']) { ?>
<tr id="tr_<?php echo $key;?>">
<th id="th_<?php echo $key;?>"><?php if($value['required']) { ?><span class="rq" title="����">*</span><?php } ?><?php echo $value['title'];?></th>
<td id="td_<?php echo $key;?>">
<?php echo $htmls[$key];?>
</td>
<td class="p">
<?php if($vid) { ?>
<input type="hidden" name="privacy[<?php echo $key;?>]" value="3" />
<?php } else { ?>
<select name="privacy[<?php echo $key;?>]">
<option value="0"<?php if($privacy[$key] == "0") { ?> selected="selected"<?php } ?>>����</option>
<option value="1"<?php if($privacy[$key] == "1") { ?> selected="selected"<?php } ?>>���ѿɼ�</option>
<option value="3"<?php if($privacy[$key] == "3") { ?> selected="selected"<?php } ?>>����</option>
</select>
<?php } ?>
</td>
</tr>
<?php } } if($allowcstatus && in_array('customstatus', $allowitems)) { ?>
<tr>
<th id="th_customstatus">�Զ���ͷ��</th>
<td id="td_customstatus">
<input type="text" value="<?php echo $space['customstatus'];?>" name="customstatus" id="customstatus" class="px" />
<div class="rq mtn" id="showerror_customstatus"></div>
</td>
<td>&nbsp;</td>
</tr>
<?php } if($_G['group']['maxsigsize'] && in_array('sightml', $allowitems)) { ?>
<tr>
<th id="th_sightml">����ǩ��</th>
<td id="td_sightml">
<div class="tedt">
<div class="bar">
<span class="y"><a href="javascript:;" onclick="$('signhtmlpreview').innerHTML = bbcode2html($('sightmlmessage').value)">Ԥ��</a></span>
<?php if($_G['group']['allowsigbbcode']) { if($_G['group']['allowsigimgcode']) { $seditor = array('sightml', array('bold', 'color', 'img', 'link', 'smilies'));?><?php } else { $seditor = array('sightml', array('bold', 'color', 'link', 'smilies'));?><?php } ?><script src="<?php echo $_G['setting']['jspath'];?>seditor.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<div class="fpd">
<?php if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="���ּӴ�" class="fbld"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]');doane(event);"<?php } ?>>B</a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<a href="javascript:;" title="����������ɫ" class="fclr" id="<?php echo $seditor['0'];?>forecolor"<?php if(empty($seditor['2'])) { ?> onclick="showColorBox(this.id, 2, '<?php echo $seditor['0'];?>');doane(event);"<?php } ?>>Color</a>
<?php } if(in_array('img', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="ͼƬ" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img');doane(event);"<?php } ?>>Image</a>
<?php } if(in_array('link', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>url" href="javascript:;" title="�������" class="flnk"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'url');doane(event);"<?php } ?>>Link</a>
<?php } if(in_array('quote', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>quote" href="javascript:;" title="����" class="fqt"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'quote');doane(event);"<?php } ?>>Quote</a>
<?php } if(in_array('code', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>code" href="javascript:;" title="����" class="fcd"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'code');doane(event);"<?php } ?>>Code</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>Smilies</a>
<?php if(empty($seditor['2'])) { ?>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } if(in_array('at', $seditor['1']) && $_G['group']['allowat']) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>at.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<a id="<?php echo $seditor['0'];?>at" href="javascript:;" title="@����" class="fat"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'at');doane(event);"<?php } ?>>@����</a>
<?php } ?>
<?php echo $seditor['3'];?>
</div><?php } ?>
</div>
<div class="area">
<textarea rows="3" cols="80" name="sightml" id="sightmlmessage" class="pt" onkeydown="ctrlEnter(event, 'profilesubmitbtn');"><?php echo $space['sightml'];?></textarea>
</div>
</div>
<div id="signhtmlpreview"></div>
<div id="showerror_sightml" class="rq mtn"></div>
<script src="<?php echo $_G['setting']['jspath'];?>bbcode.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">var forumallowhtml = 0,allowhtml = 0,allowsmilies = 0,allowbbcode = parseInt('<?php echo $_G['group']['allowsigbbcode'];?>'),allowimgcode = parseInt('<?php echo $_G['group']['allowsigimgcode'];?>');var DISCUZCODE = [];DISCUZCODE['num'] = '-1';DISCUZCODE['html'] = [];</script>
</td>
<td>&nbsp;</td>
</tr>
<?php } if(in_array('timeoffset', $allowitems)) { ?>
<tr>
<th id="th_timeoffset">ʱ��</th>
<td id="td_timeoffset"><?php $timeoffset = array(
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
		'12' => '(GMT +12:00) �¿���, �����, 쳼�, ���ܶ�Ⱥ��');?><select name="timeoffset"><?php if(is_array($timeoffset)) foreach($timeoffset as $key => $desc) { ?><option value="<?php echo $key;?>"<?php if($key==$space['timeoffset']) { ?> selected="selected"<?php } ?>><?php echo $desc;?></option>
<?php } ?>
</select>
<p class="mtn">��ǰʱ�� : <?php echo dgmdate($_G[timestamp]);?></p>
<p class="d">������ֵ�ǰ��ʾ��ʱ����������ʱ������Сʱ����ô����Ҫ�����Լ���ʱ������ </p>
</td>
<td>&nbsp;</td>
</tr>
<?php } if($operation == 'contact') { ?>
<tr>
<th id="th_sightml">Email</th>
<td id="td_sightml"><?php echo $space['email'];?>&nbsp;(<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password&amp;from=contact#contact">�޸�</a>)</td>
<td>&nbsp;</td>
</tr>
<?php } if($operation == 'plugin') { include(template($_GET['id']));?><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_profile_extra'])) echo $_G['setting']['pluginhooks']['spacecp_profile_extra'];?>
<?php if($showbtn) { ?>
<tr>
<th>&nbsp;</th>
<td colspan="2">
<input type="hidden" name="profilesubmit" value="true" />
<button type="submit" name="profilesubmitbtn" id="profilesubmitbtn" value="true" class="pn pnc" /><strong>����</strong></button>
<span id="submit_result" class="rq"></span>
</td>
</tr>
<?php } ?>
</table>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_profile_bottom'])) echo $_G['setting']['pluginhooks']['spacecp_profile_bottom'];?>
</form>
<script type="text/javascript">
function show_error(fieldid, extrainfo) {
var elem = $('th_'+fieldid);
if(elem) {
elem.className = "rq";
fieldname = elem.innerHTML;
extrainfo = (typeof extrainfo == "string") ? extrainfo : "";
$('showerror_'+fieldid).innerHTML = "����������� " + extrainfo;
$(fieldid).focus();
}
}
function show_success(message) {
message = message == '' ? '���ϸ��³ɹ�' : message;
showDialog(message, 'right', '��ʾ��Ϣ', function(){
top.window.location.href = top.window.location.href;
}, 0, null, '', '', '', '', 3);
}
function clearErrorInfo() {
var spanObj = $('profilelist').getElementsByTagName("div");
for(var i in spanObj) {
if(typeof spanObj[i].id != "undefined" && spanObj[i].id.indexOf("_")) {
var ids = explode('_', spanObj[i].id);
if(ids[0] == "showerror") {
spanObj[i].innerHTML = '';
$('th_'+ids[1]).className = '';
}
}
}
}
</script>
<?php } ?>
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
<?php } ?>
</div><?php include template('common/footer'); ?>