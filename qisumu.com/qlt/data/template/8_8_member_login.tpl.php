<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('login');
0
|| checktplrefresh('./template/wic_selfmedia/member/login.htm', './template/default/common/seccheck.htm', 1487597466, '8', './data/template/8_8_member_login.tpl.php', './template/wic_selfmedia', 'member/login')
;?><?php include template('common/header'); $loginhash = 'L'.random(4);?><?php if(empty($_GET['infloat'])) { ?>
<div id="ct" class="ptm wp w cl">
<div class="nfl" id="main_succeed" style="display: none">
<div class="f_c altw">
<div class="alert_right">
<p id="succeedmessage"></p>
<p id="succeedlocation" class="alert_btnleft"></p>
<p class="alert_btnleft"><a id="succeedmessage_href">如果您的浏览器没有自动跳转，请点击此链接</a></p>
</div>
</div>
</div>
<div class="mn cl" id="main_message">
    <div class="memberbox">
<div class="bm">
<div class="bm_h cl">
<span class="y">
<?php if(!empty($_G['setting']['pluginhooks']['logging_side_top'])) echo $_G['setting']['pluginhooks']['logging_side_top'];?>

</span>
<?php if(!$secchecklogin2) { ?>
<h3>登录</h3>
<?php } else { ?>
<h3>请输入验证码后继续登录</h3>
<?php } ?>
</div>
<div>
<?php } ?>

<div id="main_messaqge_<?php echo $loginhash;?>"<?php if($auth) { ?> style="width: auto"<?php } ?>>
<div id="layer_login_<?php echo $loginhash;?>">
<h3 class="flb">
<em id="returnmessage_<?php echo $loginhash;?>" class="ml60">
<?php if(!empty($_GET['infloat'])) { if(!empty($_GET['guestmessage'])) { ?>您需要先登录才能继续本操作<?php } elseif($auth) { ?>请补充下面的登录信息<?php } else { ?>用户登录<?php } } ?>
</em>
<span><?php if(!empty($_GET['infloat']) && !isset($_GET['frommessage'])) { ?><a href="javascript:;" class="flbc" onclick="hideWindow('<?php echo $_GET['handlekey'];?>', 0, 1);" title="关闭">关闭</a><?php } ?></span>
</h3>
<?php if(!empty($_G['setting']['pluginhooks']['logging_top'])) echo $_G['setting']['pluginhooks']['logging_top'];?>
        <div class="member_logging cl">
        	
            <form method="post" autocomplete="off" name="login" id="loginform_<?php echo $loginhash;?>" class="cl" onsubmit="<?php if($this->setting['pwdsafety']) { ?>pwmd5('password3_<?php echo $loginhash;?>');<?php } ?>pwdclear = 1;ajaxpost('loginform_<?php echo $loginhash;?>', 'returnmessage_<?php echo $loginhash;?>', 'returnmessage_<?php echo $loginhash;?>', 'onerror');return false;" action="member.php?mod=logging&amp;action=login&amp;loginsubmit=yes<?php if(!empty($_GET['handlekey'])) { ?>&amp;handlekey=<?php echo $_GET['handlekey'];?><?php } if(isset($_GET['frommessage'])) { ?>&amp;frommessage<?php } ?>&amp;loginhash=<?php echo $loginhash;?>">
                <div class="member_logging_main c cl">
                    <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
                    <input type="hidden" name="referer" value="<?php echo dreferer(); ?>" />
                    <?php if($auth) { ?>
                        <input type="hidden" name="auth" value="<?php echo $auth;?>" />
                    <?php } ?>
                    <div class="member_logo">
                        <?php if(!isset($_G['setting']['navlogos'][$mnid])) { ?><a href="<?php if($_G['setting']['domain']['app']['default']) { ?>http://<?php echo $_G['setting']['domain']['app']['default'];?>/<?php } else { ?>./<?php } ?>" title="<?php echo $_G['setting']['bbname'];?>"><?php echo $_G['style']['boardlogo'];?></a><?php } else { ?><?php echo $_G['setting']['navlogos'][$mnid];?><?php } ?>
                    </div>
                    <?php if($invite) { ?>
                    <div class="rfm">
                        <table>
                            <tr>
                                <th>&nbsp;</th>
                                <td>推荐人:<a href="home.php?mod=space&amp;uid=<?php echo $invite['uid'];?>" target="_blank"><?php echo $invite['username'];?></a></td>
                            </tr>
                        </table>
                    </div>
                    <?php } ?>
    
                    <?php if(!$auth) { ?>
                    <div class="rfm">
                        <table>
                            <tr>
                                <th>
                                    <?php if($this->setting['autoidselect']) { ?><label for="username_<?php echo $loginhash;?>"></label><?php } else { ?>
                                    <?php } ?>
                                </th>
                                <td><input type="text" name="username" id="username_<?php echo $loginhash;?>" placeholder="<?php echo $tmplang['emailorname'];?>" autocomplete="off" size="30" class="px p_fre" tabindex="1" value="<?php echo $username;?>" /></td>
                            </tr>
                        </table>
                    </div>
                    <div class="rfm">
                        <table>
                            <tr>
                                <th><label for="password3_<?php echo $loginhash;?>"></label></th>
                                <td><input type="password" id="password3_<?php echo $loginhash;?>" name="password" placeholder="密码" onfocus="clearpwd()" size="30" class="px p_fre" tabindex="1" /></td>
                            </tr>
                        </table>
                    </div>
                    <?php } ?>
    
                    <?php if(empty($_GET['auth']) || $questionexist) { ?>
                    <div class="rfm">
                        <table>
                            <tr>
                                <th>&nbsp;</th>
                                <td><select id="loginquestionid_<?php echo $loginhash;?>" width="213" name="questionid"<?php if(!$questionexist) { ?> onchange="if($('loginquestionid_<?php echo $loginhash;?>').value > 0) {$('loginanswer_row_<?php echo $loginhash;?>').style.display='';} else {$('loginanswer_row_<?php echo $loginhash;?>').style.display='none';}"<?php } ?>>
                                    <option value="0"><?php if($questionexist) { ?>安全提问<?php } else { ?>安全提问(未设置请忽略)<?php } ?></option>
                                    <option value="1">母亲的名字</option>
                                    <option value="2">爷爷的名字</option>
                                    <option value="3">父亲出生的城市</option>
                                    <option value="4">您其中一位老师的名字</option>
                                    <option value="5">您个人计算机的型号</option>
                                    <option value="6">您最喜欢的餐馆名称</option>
                                    <option value="7">驾驶执照最后四位数字</option>
                                </select></td>
                            </tr>
                        </table>
                    </div>
                    <div class="rfm" id="loginanswer_row_<?php echo $loginhash;?>" <?php if(!$questionexist) { ?> style="display:none"<?php } ?>>
                        <table>
                            <tr>
                                <th>&nbsp;</th>
                                <td><input type="text" name="answer" id="loginanswer_<?php echo $loginhash;?>" placeholder="答案" autocomplete="off" size="30" class="px p_fre" tabindex="1" /></td>
                            </tr>
                        </table>
                    </div>
                    <?php } ?>
    
                    <?php if($seccodecheck) { ?>
                        <?php
$sectpl = <<<EOF
<div class="rfm"><table><tr><th></th><th style=" display:none;"><sec>: </th><td><sec><br /><sec></td></tr></table></div>
EOF;
?>
                        <?php $sechash = !isset($sechash) ? 'S'.($_G['inajax'] ? 'A' : '').$_G['sid'] : $sechash.random(3);
$sectpl = str_replace("'", "\'", $sectpl);?><?php if($secqaacheck) { ?>
<span id="secqaa_q<?php echo $sechash;?>"></span>		
<script type="text/javascript" reload="1">updatesecqaa('q<?php echo $sechash;?>', '<?php echo $sectpl;?>', '<?php echo $_G['basescript'];?>::<?php echo CURMODULE;?>');</script>
<?php } if($seccodecheck) { ?>
<span id="seccode_c<?php echo $sechash;?>"></span>		
<script type="text/javascript" reload="1">updateseccode('c<?php echo $sechash;?>', '<?php echo $sectpl;?>', '<?php echo $_G['basescript'];?>::<?php echo CURMODULE;?>');</script>
<?php } ?>                    <?php } ?>
    
                    <?php if(!empty($_G['setting']['pluginhooks']['logging_input'])) echo $_G['setting']['pluginhooks']['logging_input'];?>
    
                    <div class="rfm <?php if(!empty($_GET['infloat'])) { ?> bw0<?php } ?>">
                        <table>
                            <tr>
                                <th></th>
                                <td><label for="cookietime_<?php echo $loginhash;?>"><input type="checkbox" class="pc" name="cookietime" id="cookietime_<?php echo $loginhash;?>" tabindex="1" value="2592000" <?php echo $cookietimecheck;?> />自动登录</label></td>
                            </tr>
                        </table>
                    </div>
    
                    <div class="rfm mbw bw0">
                        <table width="100%">
                            <tr>
                                <th>&nbsp;</th>
                                <td>
                                    <button class="pn pnc" type="submit" name="loginsubmit" value="true" tabindex="1"><strong>登录</strong></button>
                                </td>
                                
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="member_logging_method">
                <?php if(!empty($_G['setting']['pluginhooks']['logging_method'])) { ?>
<div class="bw0 <?php if(empty($_GET['infloat'])) { ?> mbw<?php } ?>">
                    	<div class="member_logging_method_tit">快捷登录</div>
<table>
<tr>
<td><?php if(!empty($_G['setting']['pluginhooks']['logging_method'])) echo $_G['setting']['pluginhooks']['logging_method'];?></td>
</tr>
</table>
</div>
<?php } ?>
                </div>
                <script type="text/javascript"> 
jq(".member_logging_method a img[alt=QQ<?php echo $tmplang['bind'];?>]").attr("src", "<?php echo $_G['style']['styleimgdir'];?>/qqlogin.png");
jq(".member_logging_method a img[alt!=QQ<?php echo $tmplang['bind'];?>]").attr("src", "<?php echo $_G['style']['styleimgdir'];?>/wxlogin.png");
</script>
          
               
            </form>
        </div>
        <div class="member_loggin_footer">
        	<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>"><?php echo $_G['setting']['reglinkname'];?></a>&nbsp;&nbsp;&bull;&nbsp;
            <a href="javascript:;" onclick="display('layer_login_<?php echo $loginhash;?>');display('layer_lostpw_<?php echo $loginhash;?>');" title="找回密码">找回密码</a>
            <?php if($this->setting['sitemessage']['login'] && empty($_GET['infloat'])) { ?><a href="javascript:;" id="custominfo_login_<?php echo $loginhash;?>" class="y">&nbsp;<img src="<?php echo IMGDIR;?>/info_small.gif" alt="帮助" class="vm" /></a><?php } ?>
            <?php if(!$this->setting['bbclosed'] && empty($_GET['infloat'])) { ?><a href="javascript:;" style=" display:none;" onclick="ajaxget('member.php?mod=clearcookies&formhash=<?php echo FORMHASH;?>', 'returnmessage_<?php echo $loginhash;?>', 'returnmessage_<?php echo $loginhash;?>');return false;" title="清除痕迹" class="y">清除痕迹</a><?php } ?>
        </div>
</div>
<?php if($_G['setting']['pwdsafety']) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>md5.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>
<?php } ?>
<div id="layer_lostpw_<?php echo $loginhash;?>" style="display: none;">	
<h3 class="flb">
<em id="returnmessage3_<?php echo $loginhash;?>" class="ml10">找回密码</em>
<span><?php if(!empty($_GET['infloat']) && !isset($_GET['frommessage'])) { ?><a href="javascript:;" class="flbc" onclick="hideWindow('login')" title="关闭">关闭</a><?php } ?></span>
</h3>
<form method="post" autocomplete="off" id="lostpwform_<?php echo $loginhash;?>" class="cl" onsubmit="ajaxpost('lostpwform_<?php echo $loginhash;?>', 'returnmessage3_<?php echo $loginhash;?>', 'returnmessage3_<?php echo $loginhash;?>', 'onerror');return false;" action="member.php?mod=lostpasswd&amp;lostpwsubmit=yes&amp;infloat=yes">
<div class="c cl">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="handlekey" value="lostpwform" />
<div class="rfm">
<table>
<tr>
<th><span class="rq">*</span><label for="lostpw_email"></label></th>
<td><input type="text" name="email" placeholder="Email" id="lostpw_email" size="30" value=""  tabindex="1" class="px p_fre" /></td>
</tr>
</table>
</div>
<div class="rfm">
<table>
<tr>
<th><label for="lostpw_username"></label></th>
<td><input type="text" name="username" placeholder="用户名" id="lostpw_username" size="30" value=""  tabindex="1" class="px p_fre" /></td>
</tr>
</table>
</div>

<div class="rfm mbw bw0">
<table>
<tr>
<th></th>
<td><button class="pn pnc" type="submit" name="lostpwsubmit" value="true" tabindex="100"><span>提交</span></button></td>
</tr>
</table>
</div>
</div>
</form>
        <div class="member_loggin_footer">
            <a href="member.php?mod=<?php echo $_G['setting']['regname'];?>"><?php echo $_G['setting']['reglinkname'];?></a>       
        </div>
</div>
</div>

<div id="layer_message_<?php echo $loginhash;?>"<?php if(empty($_GET['infloat'])) { ?> class="f_c blr nfl"<?php } ?> style="display: none;">
<h3 class="flb" id="layer_header_<?php echo $loginhash;?>">
<?php if(!empty($_GET['infloat']) && !isset($_GET['frommessage'])) { ?>
<em>用户登录</em>
<span><a href="javascript:;" class="flbc" onclick="hideWindow('login')" title="关闭">关闭</a></span>
<?php } ?>
</h3>
<div class="c"><div class="alert_right">
<div id="messageleft_<?php echo $loginhash;?>"></div>
<p class="alert_btnleft" id="messageright_<?php echo $loginhash;?>"></p>
</div>
</div>

<script type="text/javascript" reload="1">
<?php if(!isset($_GET['viewlostpw'])) { ?>
var pwdclear = 0;
function initinput_login() {
document.body.focus();
<?php if(!$auth) { ?>
if($('loginform_<?php echo $loginhash;?>')) {
$('loginform_<?php echo $loginhash;?>').username.focus();
}
<?php if(!$this->setting['autoidselect']) { ?>
simulateSelect('loginfield_<?php echo $loginhash;?>');
<?php } } elseif($seccodecheck && !(empty($_GET['auth']) || $questionexist)) { ?>
if($('loginform_<?php echo $loginhash;?>')) {
safescript('seccodefocus', function() {$('loginform_<?php echo $loginhash;?>').seccodeverify.focus()}, 500, 10);
}			
<?php } ?>
}
initinput_login();
<?php if($this->setting['sitemessage']['login']) { ?>
showPrompt('custominfo_login_<?php echo $loginhash;?>', 'mouseover', '<?php echo trim($this->setting['sitemessage']['login'][array_rand($this->setting['sitemessage']['login'])]); ?>', <?php echo $this->setting['sitemessage']['time'];?>);
<?php } ?>

function clearpwd() {
if(pwdclear) {
$('password3_<?php echo $loginhash;?>').value = '';
}
pwdclear = 0;
}
<?php } else { ?>
display('layer_login_<?php echo $loginhash;?>');
display('layer_lostpw_<?php echo $loginhash;?>');
$('lostpw_email').focus();
<?php } ?>
</script><?php updatesession();?><?php if(empty($_GET['infloat'])) { ?>
</div></div></div></div></div>
</div>
<?php } include template('common/footer'); ?>