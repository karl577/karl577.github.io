<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('register');
0
|| checktplrefresh('./template/banzhuan_weibo/touch/member/register.htm', './template/banzhuan_weibo/touch/common/seccheck.htm', 1537992905, '7', './data/template/7_7_touch_member_register.tpl.php', './template/banzhuan_weibo', 'touch/member/register')
;?><?php include template('common/header'); ?><!-- header start -->
<header class="header">
    <div class="nav">
        <div class="banzhuan-icon-back z"><a href="javascript:;" onclick="history.go(-1)"><img src="./template/banzhuan_weibo/touch/banzhuan/images/icon_back.png" /></a></div>
<div class="name z"><span>ע��</span></div>
    </div>
</header>
<!-- header end -->
<!-- registerbox start -->
<div class="loginbox registerbox">
<div class="login_from">
<form method="post" autocomplete="off" name="register" id="registerform" action="member.php?mod=<?php echo $_G['setting']['regname'];?>&amp;mobile=2">
<input type="hidden" name="regsubmit" value="yes" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" /><?php $dreferer = str_replace('&amp;', '&', dreferer());?><input type="hidden" name="referer" value="<?php echo $dreferer;?>" />
<input type="hidden" name="activationauth" value="<?php if($_GET['action'] == 'activation') { ?><?php echo $activationauth;?><?php } ?>" />
<input type="hidden" name="agreebbrule" value="<?php echo $bbrulehash;?>" id="agreebbrule" checked="checked" />
<ul>
<li><input type="text" tabindex="1" class="banzhuan-login-input" size="30" autocomplete="off" value="" name="<?php echo $_G['setting']['reginput']['username'];?>" placeholder="�û�����3-15λ" fwin="login"></li>
<li><input type="password" tabindex="2" class="banzhuan-login-input" size="30" value="" name="<?php echo $_G['setting']['reginput']['password'];?>" placeholder="����" fwin="login"></li>
<li><input type="password" tabindex="3" class="banzhuan-login-input" size="30" value="" name="<?php echo $_G['setting']['reginput']['password2'];?>" placeholder="ȷ������" fwin="login"></li>
<li class="bl_none"><input type="email" tabindex="4" class="banzhuan-login-input" size="30" autocomplete="off" value="" name="<?php echo $_G['setting']['reginput']['email'];?>" placeholder="����" fwin="login"></li>
<?php if(empty($invite) && ($_G['setting']['regstatus'] == 2 || $_G['setting']['regstatus'] == 3)) { ?>
<li><input type="text" name="invitecode" autocomplete="off" tabindex="5" class="banzhuan-login-input" size="30" value="������" placeholder="������" fwin="login"></li>
<?php } if($_G['setting']['regverify'] == 2) { ?>
<li><input type="text" name="regmessage" autocomplete="off" tabindex="6" class="banzhuan-login-input" size="30" value="ע��ԭ��" placeholder="ע��ԭ��" fwin="login"></li>
<?php } ?>
</ul>
<?php if($secqaacheck || $seccodecheck) { $sechash = 'S'.random(4);
$sectpl = !empty($sectpl) ? explode("<sec>", $sectpl) : array('<br />',': ','<br />','');	
$ran = random(5, 1);?><?php if($secqaacheck) { $message = '';
$question = make_secqaa();
$secqaa = lang('core', 'secqaa_tips').$question;?><?php } if($sectpl) { if($secqaacheck) { ?>
<p>
        ��֤�ʴ�: 
        <span class="xg2"><?php echo $secqaa;?></span>
    <input name="secqaahash" type="hidden" value="<?php echo $sechash;?>" />
        <input name="secanswer" id="secqaaverify_<?php echo $sechash;?>" type="text" class="txt" />
        </p>
<?php } if($seccodecheck) { ?>
<div class="sec_code vm">
<input name="seccodehash" type="hidden" value="<?php echo $sechash;?>" />
<input type="text" class="txt px vm" style="ime-mode:disabled;width:115px;background:white;" autocomplete="off" value="" id="seccodeverify_<?php echo $sechash;?>" name="seccodeverify" placeholder="��֤��" fwin="seccode">
        <img src="misc.php?mod=seccode&amp;update=<?php echo $ran;?>&amp;idhash=<?php echo $sechash;?>&amp;mobile=2" class="seccodeimg"/>
</div>
<?php } } ?>


<script type="text/javascript">
(function() {
$('.seccodeimg').on('click', function() {
$('#seccodeverify_<?php echo $sechash;?>').attr('value', '');
var tmprandom = 'S' + Math.floor(Math.random() * 1000);
$('.sechash').attr('value', tmprandom);
$(this).attr('src', 'misc.php?mod=seccode&update=<?php echo $ran;?>&idhash='+ tmprandom +'&mobile=2');
});
})();
</script>
<?php } ?>
</div>
<div class="btn_register">
<button tabindex="7" value="true" name="regsubmit" type="submit" class="formdialog pn pnc"><span>����ע��</span></button>
<p class="reg_link"><a href="member.php?mod=logging&amp;action=login&amp;mobile=2">�����˺ţ����ϵ�¼>></a></p>
</div>
</form>
</div>
<!-- registerbox end --><?php updatesession();?>