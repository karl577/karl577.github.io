<?php echo 'Theme by time';exit;?>
<!--{subtemplate common/header_common}-->
<meta name="application-name" content="$_G['setting']['bbname']" />
<meta name="msapplication-tooltip" content="$_G['setting']['bbname']" />
<!--{if $_G['setting']['portalstatus']}-->
<meta name="msapplication-task" content="name=$_G['setting']['navs'][1]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['portal']) ? 'http://'.$_G['setting']['domain']['app']['portal'] : $_G[siteurl].'portal.php'};icon-uri={$_G[siteurl]}{IMGDIR}/portal.ico" />
<!--{/if}-->
<meta name="msapplication-task" content="name=$_G['setting']['navs'][2]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['forum']) ? 'http://'.$_G['setting']['domain']['app']['forum'] : $_G[siteurl].'forum.php'};icon-uri={$_G[siteurl]}{IMGDIR}/bbs.ico" />
<!--{if $_G['setting']['groupstatus']}-->
<meta name="msapplication-task" content="name=$_G['setting']['navs'][3]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['group']) ? 'http://'.$_G['setting']['domain']['app']['group'] : $_G[siteurl].'group.php'};icon-uri={$_G[siteurl]}{IMGDIR}/group.ico" />
<!--{/if}-->
<!--{if helper_access::check_module('feed')}-->
<meta name="msapplication-task" content="name=$_G['setting']['navs'][4]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['home']) ? 'http://'.$_G['setting']['domain']['app']['home'] : $_G[siteurl].'home.php'};icon-uri={$_G[siteurl]}{IMGDIR}/home.ico" />
<!--{/if}-->
<!--{if $_G['basescript'] == 'forum' && $_G['setting']['archiver']}-->
<link rel="archives" title="$_G['setting']['bbname']" href="{$_G[siteurl]}archiver/" />
<!--{/if}-->
<!--{if !empty($rsshead)}-->
$rsshead<!--{/if}-->
<!--{if widthauto()}-->

<link rel="stylesheet" id="css_widthauto" type="text/css" href="data/cache/style_{STYLEID}_widthauto.css?{VERHASH}" />
<script type="text/javascript">HTMLNODE.className += ' widthauto'</script>
<!--{/if}-->
<!--{if $_G['basescript'] == 'forum' || $_G['basescript'] == 'group'}-->
<script type="text/javascript" src="{$_G[setting][jspath]}forum.js?{VERHASH}"></script>
<!--{elseif $_G['basescript'] == 'home' || $_G['basescript'] == 'userapp'}-->
<script type="text/javascript" src="{$_G[setting][jspath]}home.js?{VERHASH}"></script>
<!--{elseif $_G['basescript'] == 'portal'}-->
<script type="text/javascript" src="{$_G[setting][jspath]}portal.js?{VERHASH}"></script>
<!--{/if}-->
<!--{if $_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && check_diy_perm($topic)}-->
<script type="text/javascript" src="{$_G[setting][jspath]}portal.js?{VERHASH}"></script>
<!--{/if}-->
<!--{if $_GET['diy'] == 'yes' && check_diy_perm($topic)}-->
<link rel="stylesheet" type="text/css" id="diy_common" href="data/cache/style_{STYLEID}_css_diy.css?{VERHASH}" />
<!--{/if}-->
</head><body id="nv_{$_G[basescript]}" class="pg_{CURMODULE}{if $_G['basescript'] === 'portal' && CURMODULE === 'list' && !empty($cat)} {$cat['bodycss']}{/if}" onkeydown="if(event.keyCode==27) return false;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<!--{if $_GET['diy'] == 'yes' && check_diy_perm($topic)}--> 
<!--{template common/header_diy}--> 
<!--{/if}--> 
<!--{if check_diy_perm($topic)}--> 
<!--{template common/header_diynav}--> 
<!--{/if}--> 
<!--{if CURMODULE == 'topic' && $topic && empty($topic['useheader']) && check_diy_perm($topic)}--> 
$diynav 
<!--{/if}--> 
<!--{if empty($topic) || $topic['useheader']}--> 
<!--{if $_G['setting']['mobile']['allowmobile'] && (!$_G['setting']['cacheindexlife'] && !$_G['setting']['cachethreadon'] || $_G['uid']) && ($_GET['diy'] != 'yes' || !$_GET['inajax']) && ($_G['mobile'] != '' && $_G['cookie']['mobile'] == '' && $_GET['mobile'] != 'no')}-->
<div class="xi1 bm bm_c"> {lang your_mobile_browser}<a href="{$_G['siteurl']}forum.php?mobile=yes">{lang go_to_mobile}</a> <span class="xg1">|</span> <a href="$_G['setting']['mobile']['nomobileurl']">{lang to_be_continue}</a> </div>
<!--{/if}--> 
<!--{if $_G['setting']['shortcut'] && $_G['member'][credits] >= $_G['setting']['shortcut']}-->
<div id="shortcut"> <span><a href="javascript:;" id="shortcutcloseid" title="{lang close}">{lang close}</a></span> {lang shortcut_notice} <a href="javascript:;" id="shortcuttip">{lang shortcut_add}</a> </div>
<script type="text/javascript">setTimeout(setShortcut, 2000);</script> 
<!--{/if}-->

<div id="headnav" {if $_GET['diy'] == 'yes' && check_diy_perm($topic)}class="hides"{/if}>
  <!--{hook/global_cpnav_top}-->
  <div id="topbar" class="cl"> 
    <div class="wp cl">
      <!-- 站点LOGO -->
      <div class="hd_logo"> 
         <!--{eval $mnid = getcurrentnav();}-->
		 <h2><a href="portal.php"><img src="template/time_1702_chuang/src/logo.png" /></a></h2>
      </div>
      <!-- 导航 -->
      <div class="nav">
        <ul>
          <!--{loop $_G['setting']['navs'] $nav}--> 
          <!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}-->
          <li {if $mnid == $nav[navid]}class="a" {/if}
        {if !empty($subnavs)}class="b" {/if}
        $nav[nav]>
          </li>
          <!--{/if}--> 
          <!--{/loop}-->
        </ul>
        <!--{hook/global_nav_extra}--> 
      </div>
      <!-- 用户信息 --> 
      <!--{if $_G['uid']}-->
      <div class="yp-header-user-box logined">
        <div class="yp-header-user">
          <div class="user-main ">
            <div class="avatar"> <a href="home.php?mod=space&uid=$_G[uid]" target="_blank" title="{lang visit_my_space}" id="umnav" onMouseOver="showMenu({'ctrlid':this.id,'ctrlclass':'a'})"> 
              <!--{avatar($_G[uid],small)}--> 
              </a></div>
            <span class="nickname">{$_G[member][username]}</span><span class="arrow"></span></div>
          <div class="user-link">
            <ul>
              <li><a id="nte_menu" href="home.php?mod=space&do=notice" class="notification">提醒<!--{if $_G[member][newprompt]}--><span class="unread_num png">$_G[member][newprompt]</span><!--{/if}--></a></li>
              <li><a id="msg_menu" href="home.php?mod=space&do=pm" class="msg">消息<!--{if $_G[member][newpm]}--><span class="unread_num png">{$_G[member][newpm]}</span><!--{/if}--></a></li>
              <!--{if check_diy_perm($topic)}-->
              <li><a href="javascript:openDiy();" title="{lang open_diy}">打开DIY</a></li>
              <!--{/if}--> 
              <!--{hook/global_usernav_extra3}-->
              <li><a href="home.php?mod=spacecp">{lang setup}</a></li>
              <!--{if ($_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle'] || $_G['group']['allowdiy'] || getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 6) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3))}-->
              <li><a href="portal.php?mod=portalcp"><!--{if $_G['setting']['portalstatus'] }-->{lang portal_manage}<!--{else}-->{lang portal_block_manage}<!--{/if}--></a></li>
              <!--{/if}--> 
              <!--{if $_G['uid'] && $_G['group']['radminid'] > 1}-->
              <li><a href="forum.php?mod=modcp&fid=$_G[fid]" target="_blank">{lang forum_manager}</a></li>
              <!--{/if}--> 
              <!--{if $_G['uid'] && $_G['adminid'] == 1 && $_G['setting']['cloud_status']}-->
              <li><a href="admin.php?frames=yes&action=cloud&operation=applist" target="_blank">{lang cloudcp}</a></li>
              <!--{/if}--> 
              <!--{if $_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)}-->
              <li><a href="admin.php" target="_blank">{lang admincp}</a></li>
              <!--{/if}-->
              <li><!--{hook/global_usernav_extra1}--></li>
              <li class="l4"><a href="member.php?mod=logging&action=logout&formhash={FORMHASH}">{lang logout}</a></li>
			  <!--{hook/global_myitem_extra}-->
            </ul>
          </div>
        </div>
      </div>
      <ul class="usernav">
      </ul>
      <!--{elseif !empty($_G['cookie']['loginuser'])}-->
      <div class="yp-header-user-box">
        <div class="yp-header-user">
          <div class="user-main ">
            <div class="avatar"> <img src="template/time_1702_chuang/src/noLogin.jpg" alt="" height="32" width="32" style="width: 32px; height: 32px; margin: 0;"></div>
            <span class="nickname">{$_G[member][username]}</span><span class="arrow"></span></div>
          <div class="user-link">
            <ul>
              <li><a id="loginuser"><!--{echo dhtmlspecialchars($_G['cookie']['loginuser'])}--></a></li>
              <li><a href="member.php?mod=logging&action=login" onClick="showWindow('login', this.href)">{lang activation}</a></li>
              <li><a href="member.php?mod=logging&action=logout&formhash={FORMHASH}">{lang logout}</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!--{elseif !$_G[connectguest]}-->
      <div class="yp-header-user-box">
        <div class="yp-header-user">
          <div class="user-main ">
            <div class="avatar"> <img src="template/time_1702_chuang/src/noLogin.jpg" alt="" height="32" width="32" style="width: 32px; height: 32px; margin: 0;"></div>
            <span class="nickname">login</span><span class="arrow"></span></div>
          <div class="user-link">
            <ul>
              <li class="l1"><a href="member.php?mod=logging&action=login"><i></i>帐号登录</a></li>
              <li class="l2"><a href="member.php?mod={$_G[setting][regname]}" ><i></i>注册会员</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div style="display:none"><!--{template member/login_simple}--></div>
      <!--{else}-->
      <div class="yp-header-user-box">
        <div class="yp-header-user">
          <div class="user-main ">
            <div class="avatar"> <img src="template/time_1702_chuang/src/noLogin.jpg" alt="" height="32" width="32" style="width: 32px; height: 32px; margin: 0;"></div>
            <span class="nickname">login</span><span class="arrow"></span></div>
          <div class="user-link">
            <ul>
              <li class="l1"><a href="home.php?mod=spacecp&ac=usergroup"><i></i>{$_G[member][username]}</a></li>
              <li class="l2"><a href="member.php?mod=logging&action=logout&formhash={FORMHASH}">{lang logout}</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!--{/if}-->
      <!--{subtemplate common/pubsearchform}-->
    </div>
  </div>
</div>
<!--{ad/headerbanner/wp a_h}-->
<!--{ad/subnavbanner/a_mu}-->

<div class="mus_box cl">
  <div id="mus" class="wp cl"> 
    <!--{if $_G['setting']['subnavs']}--> 
    <!--{loop $_G[setting][subnavs] $navid $subnav}--> 
    <!--{if $_G['setting']['navsubhover'] || $mnid == $navid}-->
    <ul class="cl {if $mnid == $navid}current{/if}" id="snav_$navid" style="display:{if $mnid != $navid}none{/if}">
      $subnav
    </ul>
    <!--{/if}--> 
    <!--{/loop}--> 
    <!--{/if}--> 
  </div>
</div>

<!--{if !IS_ROBOT}--> 
<!--{if $_G['uid']}-->
<ul id="myprompt_menu" class="p_pop" style="display: none;">
  <li><a href="home.php?mod=space&do=pm" id="pm_ntc" style="background-repeat: no-repeat; background-position: 0 50%;"><em class="prompt_news{if empty($_G[member][newpm])}_0{/if}"></em>{lang pm_center}</a></li>
  <li><a href="home.php?mod=follow&do=follower"><em class="prompt_follower{if empty($_G[member][newprompt_num][follower])}_0{/if}"></em><!--{lang notice_interactive_follower}-->{if $_G[member][newprompt_num][follower]}($_G[member][newprompt_num][follower]){/if}</a></li>
  
  <!--{if $_G[member][newprompt] && $_G[member][newprompt_num][follow]}-->
  <li><a href="home.php?mod=follow"><em class="prompt_concern"></em><!--{lang notice_interactive_follow}-->($_G[member][newprompt_num][follow])</a></li>
  <!--{/if}--> 
  <!--{if $_G[member][newprompt]}--> 
  <!--{loop $_G['member']['category_num'] $key $val}-->
  <li><a href="home.php?mod=space&do=notice&view=$key"><em class="notice_$key"></em><!--{echo lang('template', 'notice_'.$key)}-->(<span class="rq">$val</span>)</a></li>
  <!--{/loop}--> 
  <!--{/if}--> 
  <!--{if empty($_G['cookie']['ignore_notice'])}-->
  <li class="ignore_noticeli"><a href="javascript:;" onClick="setcookie('ignore_notice', 1);hideMenu('myprompt_menu')" title="{lang temporarily_to_remind}"><em class="ignore_notice"></em></a></li>
  <!--{/if}-->
</ul>
<!--{/if}--> 
<!--{if $_G['uid'] && !empty($_G['style']['extstyle'])}-->
<div id="sslct_menu" class="cl p_pop" style="display: none;"> 
  <!--{if !$_G[style][defaultextstyle]}--><span class="sslct_btn" onClick="extstyle('')" title="{lang default}"><i></i></span><!--{/if}--> 
  <!--{loop $_G['style']['extstyle'] $extstyle}--> 
  <span class="sslct_btn" onClick="extstyle('$extstyle[0]')" title="$extstyle[1]"><i style='background:$extstyle[2]'></i></span> 
  <!--{/loop}--> 
</div>
<!--{/if}--> 
<!--{subtemplate common/header_qmenu}--> 
<!--{/if}--> 

<!--{if !empty($_G['setting']['plugins']['jsmenu'])}-->
<ul class="p_pop h_pop" id="plugin_menu" style="display: none">
  <!--{loop $_G['setting']['plugins']['jsmenu'] $module}--> 
  <!--{if !$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])}-->
  <li>$module[url]</li>
  <!--{/if}--> 
  <!--{/loop}-->
</ul>
<!--{/if}--> 
<!-- 二级导航 -->
<div class="sub_nav"> $_G[setting][menunavs] </div>


<!-- 用户菜单 -->
<ul class="sub_menu" id="m_menu" style="display: none;">
  <!--{if check_diy_perm($topic)}-->
  <li><a href="javascript:openDiy();" title="{lang open_diy}">打开DIY</a></li>
  <!--{/if}--> 
  <!--{loop $_G['setting']['mynavs'] $nav}--> 
  <!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}-->
  <li style="display: none;">$nav[code]</li>
  <!--{/if}--> 
  <!--{/loop}--> 
  <!--{hook/global_usernav_extra3}-->
  <li><a href="home.php?mod=spacecp">{lang setup}</a></li>
  <!--{if ($_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle'] || $_G['group']['allowdiy'] || getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 6) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3))}-->
  <li><a href="portal.php?mod=portalcp"><!--{if $_G['setting']['portalstatus'] }-->{lang portal_manage}<!--{else}-->{lang portal_block_manage}<!--{/if}--></a></li>
  <!--{/if}--> 
  <!--{if $_G['uid'] && $_G['group']['radminid'] > 1}-->
  <li><a href="forum.php?mod=modcp&fid=$_G[fid]" target="_blank">{lang forum_manager}</a></li>
  <!--{/if}-->
  <li><a href="home.php?mod=space&do=favorite&view=me">我的收藏</a></li>
  <!--{if $_G['uid'] && $_G['adminid'] == 1 && $_G['setting']['cloud_status']}-->
  <li><a href="admin.php?frames=yes&action=cloud&operation=applist" target="_blank">{lang cloudcp}</a></li>
  <!--{/if}--> 
  <!--{if $_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)}-->
  <li><a href="admin.php" target="_blank">{lang admincp}</a></li>
  <!--{/if}-->
  <li><!--{hook/global_usernav_extra1}--></li>
  <li><!--{hook/global_usernav_extra2}--></li>
  <li><!--{hook/global_usernav_extra3}--></li>
  <li><!--{hook/global_usernav_extra4}--></li>
  <li><a href="member.php?mod=logging&action=logout&formhash={FORMHASH}">{lang logout}</a></li>
</ul>
<ul class="sub_menu" id="l_menu" style="display: none;">
  
  <!-- 第三方登录 -->
  <li class="user_list app_login"><a href="connect.php?mod=login&amp;op=init&amp;referer=forum.php&amp;statfrom=login"><i class="i_qq"></i>腾讯QQ</a></li>
  <li class="user_list app_login"><a href="plugin.php?id=wechat:login"><i class="i_wb"></i>微信登录</a></li>
</ul>

<!--{hook/global_header}--> 
<!--{/if}-->

<div id="wp" class="wp time_wp cl">