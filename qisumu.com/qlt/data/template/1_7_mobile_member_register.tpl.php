<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('register');
0
|| checktplrefresh('./template/default/mobile/member/register.htm', './template/default/mobile/common/seccheck.htm', 1543443462, '7', './data/template/1_7_mobile_member_register.tpl.php', './template/banzhuan_weibo', 'mobile/member/register')
;?><?php include template('common/header'); ?><div class="box"><a href="<?php if($forcefid) { ?>forum.php?mod=forumdisplay<?php echo $forcefid;?><?php } else { ?>forum.php<?php } ?>" title="返回论坛">返回论坛</a><span class="pipe">|</span><a href="javascript:history.back();" onclick="javascript:history.back();" title="返回上一页" >返回上一页</a></div>
<form method="post" autocomplete="off" name="register" id="registerform" enctype="multipart/form-data" action="member.php?mod=<?php echo $_G['setting']['regname'];?>&amp;mobile=yes">
<input type="hidden" name="regsubmit" value="yes" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" /><?php $dreferer = str_replace('&amp;', '&', dreferer());?><input type="hidden" name="referer" value="<?php echo $dreferer;?>" />
<input type="hidden" name="activationauth" value="<?php if($_GET['action'] == 'activation') { ?><?php echo $activationauth;?><?php } ?>" />
<input type="hidden" name="agreebbrule" value="<?php echo $bbrulehash;?>" id="agreebbrule" checked="checked" />
<div class="bm mtn">
<div class="bm_h"><?php echo $_G['setting']['reglinkname'];?></div>
<div class="bm_c">
<label><strong>用户名*</strong><input type="text" id="username" name="<?php echo $_G['setting']['reginput']['username'];?>" autocomplete="off" size="25" maxlength="15" value="" class="txt" /></label>
<span class="xg1">用户名必须为大于3位小于15位</span><br />
<label><strong>密码*</strong><input type="password" name="<?php echo $_G['setting']['reginput']['password'];?>" size="25" id="password" class="txt" /></label>
<label><strong>确认密码*</strong><input type="password" name="<?php echo $_G['setting']['reginput']['password2'];?>" size="25" id="password2" value="" class="txt" /></label>
<label><strong>Email*</strong><input type="text" name="<?php echo $_G['setting']['reginput']['email'];?>" autocomplete="off" size="25" id="email" class="txt" /> </label>
<?php if(empty($invite) && ($_G['setting']['regstatus'] == 2 || $_G['setting']['regstatus'] == 3)) { ?>
<label><strong>邀请码<?php if($_G['setting']['regstatus'] == 2 && !$invitestatus) { ?>*<?php } ?></strong><input type="text" name="invitecode" autocomplete="off" size="25" id="invitecode" class="txt" /></label>
<?php } if($_G['setting']['regverify'] == 2) { ?>
<label><strong>注册原因*:</strong><input type="text" id="regmessage" name="regmessage" autocomplete="off" size="25" tabindex="1" class="txt" /> </label>
<p class="xg1">您填写的注册原因会被当作申请注册的重要参考依据，请认真填写。</p>
<?php } ?>
<!--<?php if(is_array($_G['cache']['fields_register'])) foreach($_G['cache']['fields_register'] as $field) { if($htmls[$field['fieldid']]) { ?>
<p><strong><?php echo $field['title'];?>*</strong>
<br />
<?php echo $htmls[$field['fieldid']];?><?php if($field['required']) { } ?></p>
<?php } } ?>
-->

<?php if($secqaacheck || $seccodecheck) { $sechash = 'S'.random(4);
$sectpl = !empty($sectpl) ? explode("<sec>", $sectpl) : array('<br />',': ','<br />','');
    $ran = random(5, 1);?><?php if($secqaacheck) { $message = '';
$question = make_secqaa();
$secqaa = lang('core', 'secqaa_tips').$question;?><?php } if($sectpl) { if($secqaacheck) { ?>
<p>
        
        <strong>验证问答</strong>
        <br />
        <span class="xg2"><?php echo $secqaa;?></span>
<input name="secqaahash" type="hidden" value="<?php echo $sechash;?>" />
        <input name="secanswer" id="secqaaverify_<?php echo $sechash;?>" type="text" class="txt" />
        </p>
<?php } if($seccodecheck) { ?>
    	<p>
<strong>验证码</strong><br />
        <img src="misc.php?mod=seccode&amp;update=<?php echo $ran;?>&amp;idhash=<?php echo $sechash;?>&amp;mobile=yes&amp;modid=<?php echo $_G['basescript'];?>::<?php echo CURMODULE;?>" />
        <br />
<input name="seccodehash" type="hidden" value="<?php echo $sechash;?>" />
        <input name="seccodeverify" id="seccodeverify_<?php echo $sechash;?>" type="text" autocomplete="off" class="txt" />
        </p>
<?php } } } ?>
<p class="mtn">
<input type="submit" name="regsubmit" id="registerformsubmit" value="提交" />
</p>
</div>
</div>
</form><?php updatesession();?><?php include template('common/footer'); ?>