<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('forum');
0
|| checktplrefresh('./template/banzhuan_weibo/touch/search/forum.htm', './template/banzhuan_weibo/touch/search/pubsearch.htm', 1487640172, '7', './data/template/7_7_touch_search_forum.tpl.php', './template/banzhuan_weibo', 'touch/search/forum')
|| checktplrefresh('./template/banzhuan_weibo/touch/search/forum.htm', './template/banzhuan_weibo/touch/search/thread_list.htm', 1487640172, '7', './data/template/7_7_touch_search_forum.tpl.php', './template/banzhuan_weibo', 'touch/search/forum')
;?><?php include template('common/header'); ?><!-- header start -->
<div class="mobile">
<?php if($_G['setting']['domain']['app']['mobile']) { $nav = 'http://'.$_G['setting']['domain']['app']['mobile'];?><?php } else { $nav = "forum.php";?><?php } ?>
<div class="mobile-inner">
<div class="mobile-inner-header nav">
<div class="banzhuan-icon-back z">
                <a href="javascript:history.back();"><img src="./template/banzhuan_weibo/touch/banzhuan/images/icon_back.png" /></a>
            </div>
<h2>搜索帖子</h2>
<div class="banzhuan-discuz-header-y"><a href="<?php if($_GET['mod'] == 'forumdisplay' || $_GET['mod'] == 'viewthread') { ?>forum.php?mod=post&action=newthread&fid=<?php echo $_G['fid'];?><?php } else { ?>forum.php?mod=misc&action=nav<?php } ?>" class="iconfont icon-fatie"></a></div>
</div>
</div>		
</div>


    <script>
$(window).load(function () {
  $(".mobile-inner-header-icon").click(function(){
  	$(this).toggleClass("mobile-inner-header-icon-click mobile-inner-header-icon-out");
  	$(".mobile-inner-nav").slideToggle(250);
  });
  $(".mobile-inner-nav a").each(function( index ) {
  	$( this ).css({'animation-delay': (index/10)+'s'});
  });
});
   </script>
<div class="banzhuan-top"></div>
<div class="banzhuan-top"></div>
<!-- header end -->


<div class="banzhuan-search-bg">
<div>
        <form id="searchform" class="searchform" method="post" autocomplete="off" action="search.php?mod=forum&amp;mobile=2">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" /><?php if(!empty($srchtype)) { ?><input type="hidden" name="srchtype" value="<?php echo $srchtype;?>" /><?php } ?>
<div class="search">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>
<input value="<?php echo $keyword;?>" autocomplete="off" class="input" name="srchtxt" id="scform_srchtxt" value="" placeholder="搜索帖子">
</td>
<td width="66" align="center" class="scbar_btn_td">
<div><input type="hidden" name="searchsubmit" value="yes"><input type="submit" value="搜索" class="button2" id="scform_submit"></div>
</td>
</tr>
</tbody>
</table>
</div><?php $policymsgs = $p = '';?><?php if(is_array($_G['setting']['creditspolicy']['search'])) foreach($_G['setting']['creditspolicy']['search'] as $id => $policy) { ?><?php
$policymsg = <<<EOF

EOF;
 if($_G['setting']['extcredits'][$id]['img']) { 
$policymsg .= <<<EOF
{$_G['setting']['extcredits'][$id]['img']} 
EOF;
 } 
$policymsg .= <<<EOF
{$_G['setting']['extcredits'][$id]['title']} {$policy} {$_G['setting']['extcredits'][$id]['unit']}
EOF;
?><?php $policymsgs .= $p.$policymsg;$p = ', ';?><?php } if($policymsgs) { ?><p>每进行一次搜索将扣除 <?php echo $policymsgs;?></p><?php } ?>
        </form>
</div>

<?php if(!empty($searchid) && submitcheck('searchsubmit', 1)) { ?><div class="threadlist bg-fff">
<h2 class="thread_tit"><?php if($keyword) { ?>结果: <em>找到 “<span class="emfont"><?php echo $keyword;?></span>” 相关内容 <?php echo $index['num'];?> 个</em> <?php if($modfid) { } } else { ?>结果: <em>找到相关主题 <?php echo $index['num'];?> 个</em><?php } ?></h2>
<?php if(empty($threadlist)) { ?>
<ul><li><a href="javascript:;">对不起，没有找到匹配结果。</a></li></ul>
<?php } else { ?>
<ul><?php if(is_array($threadlist)) foreach($threadlist as $thread) { ?><li>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['realtid'];?>&amp;highlight=<?php echo $index['keywords'];?>" <?php echo $thread['highlight'];?>><?php echo $thread['subject'];?></a>
</li>
<?php } ?>
</ul>
<?php } ?>
<?php echo $multipage;?>
</div>
<?php } ?>

<div class="search-hot bg-fff">
<div id="scbar_hot">
<?php if($_G['setting']['srchhotkeywords']) { ?>
<div class="tab-title">
<a>热门搜索</a>
</div>
<div class="scbar-hot-title"><?php if(is_array($_G['setting']['srchhotkeywords'])) foreach($_G['setting']['srchhotkeywords'] as $val) { if($val=trim($val)) { $valenc=rawurlencode($val);?><?php
$__FORMHASH = FORMHASH;$srchhotkeywords[] = <<<EOF


EOF;
 if(!empty($searchparams['url'])) { 
$srchhotkeywords[] .= <<<EOF

<a href="{$searchparams['url']}?q={$valenc}&source=hotsearch{$srchotquery}" sc="1">{$val}</a>

EOF;
 } else { 
$srchhotkeywords[] .= <<<EOF

<a href="search.php?mod=forum&amp;srchtxt={$valenc}&amp;formhash={$__FORMHASH}&amp;searchsubmit=true&amp;source=hotsearch" sc="1">{$val}</a>

EOF;
 } 
$srchhotkeywords[] .= <<<EOF


EOF;
?>
<?php } } echo implode('', $srchhotkeywords);; ?></div>
<?php } ?>
</div>
</div>
</div>


<?php if(!empty($_G['setting']['pluginhooks']['global_footer_mobile'])) echo $_G['setting']['pluginhooks']['global_footer_mobile'];?><?php $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);$clienturl = ''?><?php if(strpos($useragent, 'iphone') !== false || strpos($useragent, 'ios') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=ios' : 'http://www.discuz.net/mobile.php?platform=ios';?><?php } elseif(strpos($useragent, 'android') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=android' : 'http://www.discuz.net/mobile.php?platform=android';?><?php } elseif(strpos($useragent, 'windows phone') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=windowsphone' : 'http://www.discuz.net/mobile.php?platform=windowsphone';?><?php } ?>
<div id="mask" style="display:none;"></div>
<?php if(!$nofooter) { } ?>

<!--底部导航-->
<div id="footbar">
    <div class="fbc">
        <ul>
            <li class="<?php if($_GET['mod'] == 'guide') { ?> a<?php } ?>"><a href="forum.php">首页</a></li>
            <li class="<?php if($_GET['mod'] !== 'guide' && $_GET['mod'] !== 'space' && $_GET['mod'] !== 'forum' && $_GET['mod'] !== 'logging' && $_GET['mod'] !== 'post' && $_GET['action'] !== 'nav') { ?> a<?php } ?>"><a href="forum.php?forumlist=1">圈子</a></li>
            <li class="<?php if($_GET['mod'] == 'forum') { ?> a<?php } ?>"><a href="search.php?mod=forum">搜索</a></li>
            <li class="<?php if($_GET['mod'] == 'space' && $_GET['type'] != 'forum') { ?> a<?php } ?>"><a href="<?php if($_G['uid']) { ?>home.php?mod=space&uid=<?php echo $_G['uid'];?>&do=profile&mycenter=1<?php } else { ?>member.php?mod=logging&action=login<?php } ?>">我<?php if($_G['member']['newpm']) { ?><em class="iconfont icon-dian1"></em><?php } ?></a></li>
        </ul>
    </div>
</div>
</body>
</html><?php updatesession();?><?php if(defined('IN_MOBILE')) { output();?><?php } else { output_preview();?><?php } ?>