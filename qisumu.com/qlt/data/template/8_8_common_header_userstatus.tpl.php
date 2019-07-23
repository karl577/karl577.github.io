<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); require TPLDIR."/php/userstatus.php";?><?php if($_G['uid']) { ?>
<div id="wic_loginuser" class="wic_login_user cl"  onMouseOver="showMenu({'ctrlid':this.id,'pos':'34!','ctrlclass':'on','duration':2});">	
        <div class="wic_login_username">
        	<span class="loginuser vwmy<?php if($_G['setting']['connect']['allow'] && $_G['member']['conisbind']) { ?> qq<?php } ?>"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" class="loginname" target="_blank" title="访问我的空间"><?php echo $_G['member']['username'];?></a>(<em><a href="home.php?mod=spacecp&amp;ac=usergroup" class="logingroup"><?php echo $_G['group']['grouptitle'];?><?php if($_G['member']['freeze']) { ?><span class="xi1">(已冻结)</span><?php } ?></a></em>)</span><?php if($_G['group']['allowinvisible']) { ?>
            &nbsp;-&nbsp;
            <span id="loginstatus">
                <a id="loginstatusid" href="member.php?mod=switchstatus" title="切换在线状态" onclick="ajaxget(this.href, 'loginstatus');return false;"></a>
            </span>
            <?php } ?>
            
        </div>
    </div>
    <span class="wic_login_line">|</span>
    <span class="special_repeat"><?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?></span>
    <div class="wic_login_remind">
    	<!--<a href="home.php?mod=space&amp;do=pm" id="pm_ntc"<?php if($_G['member']['newpm']) { ?> class="new"<?php } ?>>消息</a> -->
        <a href="home.php?mod=space&amp;do=notice" id="myprompt" class="<?php if($_G['member']['newprompt']) { ?> new<?php } ?>" onmouseover="showMenu({'ctrlid':'myprompt'});" title="提醒"><?php if($_G['member']['newprompt']) { ?><em><?php echo $_G['member']['newprompt'];?></em><?php } ?></a><span id="myprompt_check"></span>
<?php if(empty($_G['cookie']['ignore_notice']) && ($_G['member']['newpm'] || $_G['member']['newprompt_num']['follower'] || $_G['member']['newprompt_num']['follow'] || $_G['member']['newprompt'])) { ?><script language="javascript">delayShow($('myprompt'), function() {showMenu({'ctrlid':'myprompt','duration':3})});</script><?php } ?>
    </div>
    
    <div id="wic_loginuser_menu" style="display:none;">
    	<div class="wic_login_avt">
        	<a href="home.php?mod=spacecp&amp;ac=avatar">
                <?php echo avatar($_G[uid],middle);?>                <div class="wic_login_avthover"><?php echo $tmplang['edit'];?><br><?php echo $tmplang['avatar'];?></div>
            </a>
        </div>
        <div class="wic_other_login">
            <?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?>
            <?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra2'])) echo $_G['setting']['pluginhooks']['global_usernav_extra2'];?>
        </div>
    	<!-- default myitem_menu -->
        <ul class="myitem_menu cl">
            <li class="my_post"><a href="forum.php?mod=guide&amp;view=my"><span class="myitem_num postnum"><?php echo $_G['member']['threads'];?></span>帖子</a></li>
            <li class="my_fav"><a href="home.php?mod=space&amp;do=favorite&amp;view=me"><span class="myitem_num favnum"><?php echo $favorites;?></span>收藏</a></li>
            <li class="my_friend"><a href="home.php?mod=space&amp;do=friend"><span class="myitem_num friendnum"><?php echo $_G['member']['friends'];?></span>好友</a></li>
            <li class="my_credits">
            	<a href="home.php?mod=spacecp&amp;ac=credit&amp;showcredit=1"><span class="myitem_num creditnum"><?php echo $_G['member']['credits'];?></span>积分</a>
            </li>
            <li class="my_task"><?php if($_G['setting']['taskon'] && !empty($_G['cookie']['taskdoing_'.$_G['uid']])) { ?><a href="home.php?mod=task&amp;item=doing"><span class="myitem_num task_doingnum"><?php echo $taskdoings;?></span>任务</a><?php } ?></li>
            <li class="my_verify"><?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=verify"><span class="myitem_num verifynum"><?php echo $verifynum;?></span><?php echo $tmplang['verify'];?></a><?php } ?></li>
            <?php if(!empty($_G['setting']['pluginhooks']['global_myitem_extra'])) echo $_G['setting']['pluginhooks']['global_myitem_extra'];?>
            <?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra3'])) echo $_G['setting']['pluginhooks']['global_usernav_extra3'];?>
            <?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra4'])) echo $_G['setting']['pluginhooks']['global_usernav_extra4'];?>
        </ul>
        <ul class="admin_menu">
        	<?php if(($_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle'] || $_G['group']['allowdiy'] || getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 6) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3))) { ?>
        	<li class="admin_portal_manage">
                <a href="portal.php?mod=portalcp"><?php if($_G['setting']['portalstatus'] ) { ?>门户管理<?php } else { ?>模块管理<?php } ?></a>
            </li>
            <?php } ?>
            <?php if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>
            <li class="admin_forum_manage">
                <a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>" target="_blank"><?php echo $_G['setting']['navs']['2']['navname'];?>管理</a>   
            </li>
            <?php } ?>
            <?php if($_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)) { ?>
            <li class="admin_admincp">
                <a href="admin.php" target="_blank">管理中心</a>               
            </li>
            <?php } ?>
            <?php if(check_diy_perm($topic)) { ?>
            <li class="wic_diy"><a href="javascript:openDiy();" title="打开 DIY 面板">DIY设置</a></li>
            <?php } ?>
        </ul>
        <ul class="wic_login_grid">
        	<li class="grid_setup"><a href="home.php?mod=spacecp"><?php echo $tmplang['modify'];?></a></li>
            <li class="grid_logout"><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出登录</a></li>
        </ul>
    </div>
    
<?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>
<div class="wic_login_cookie">
<a id="loginuser" class="noborder"><?php echo dhtmlspecialchars($_G['cookie']['loginuser']); ?></a>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)">激活</a>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
</div>
<?php } elseif(!$_G['connectguest']) { ?>
<div id="wic_nologin" class="wic_login_no" onMouseOver="showMenu({'ctrlid':this.id,'pos':'34!','ctrlclass':'on','duration':2});">	
    	<img src="<?php echo $_G['style']['styleimgdir'];?>/noLogin.png" /> 
    </div>
    <div id="wic_nologin_menu" style="display:none;">
    	<ul>
        	<li class="normal_login"><a href="member.php?mod=logging&amp;action=login"><em></em>登录</a></li>
        	<li class="normal_reg"><a href="member.php?mod=<?php echo $_G['setting']['regname'];?>"><em></em><?php echo $_G['setting']['reglinkname'];?></a></li>
        	<li class="qqlogin"><a href="connect.php?mod=login&amp;op=init&amp;referer=index.php&amp;statfrom=login_simple" title="<?php echo $tmplang['qq_login'];?>"><?php echo $tmplang['qq_login'];?></a></li>
            <li class="wxlogin"><a href="plugin.php?id=wechat:login" title="<?php echo $tmplang['wx_login'];?>"><?php echo $tmplang['wx_login'];?></a></li>
        </ul>
    </div>
<?php } else { ?>
<div id="wic_loginuser" class="wic_login_user cl"  onMouseOver="showMenu({'ctrlid':this.id,'pos':'34!','ctrlclass':'on','duration':2});">	
    <div class="wic_login_username">
    	<span class="vwmy qq"><a href="javascript:void(0);" class="loginname"><?php echo $_G['member']['username'];?>(<em><?php echo $_G['group']['grouptitle'];?></em>)</a></span>
    </div>
    <div id="wic_loginuser_menu" style="display:none;">
    	<div class="wic_login_avt">
        <?php echo avatar(0,middle);?>        </div>
        <div class="wic_other_login">
            <?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?>
        </div>
    	<!-- default myitem_menu -->
        <ul class="myitem_menu cl">
            <li class="my_credits">
            	<a href="home.php?mod=spacecp&amp;ac=credit&amp;showcredit=1"><span class="myitem_num creditnum">0</span>积分</a>
            </li>

        </ul>

        <ul class="wic_login_grid">
            <li class="grid_logout"><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出登录</a></li>
        </ul>
    </div>
</div>
<?php } ?>
<script type="text/javascript"> 
jq(".wic_other_login a img.qq_bind[alt=QQ<?php echo $tmplang['bind'];?>]").attr("src", "<?php echo $_G['style']['styleimgdir'];?>/qqbind.png");
jq(".wic_other_login a img.qq_bind[alt!=QQ<?php echo $tmplang['bind'];?>]").attr("src", "<?php echo $_G['style']['styleimgdir'];?>/wxbind.png");
</script>