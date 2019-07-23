<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_footer_mobile'])) echo $_G['setting']['pluginhooks']['global_footer_mobile'];?><?php $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);$clienturl = ''?><?php if(strpos($useragent, 'iphone') !== false || strpos($useragent, 'ios') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=ios' : 'http://www.discuz.net/mobile.php?platform=ios';?><?php } elseif(strpos($useragent, 'android') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=android' : 'http://www.discuz.net/mobile.php?platform=android';?><?php } elseif(strpos($useragent, 'windows phone') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=windowsphone' : 'http://www.discuz.net/mobile.php?platform=windowsphone';?><?php } ?>

<div id="mask" style="display:none;"></div>
<?php if(!$nofooter) { ?>
<!--<div class="footer">
    <div>
<a href="<?php echo $_G['setting']['mobile']['simpletypeurl']['0'];?>">标准版</a>
<a href="javascript:;" style="color:#999;">触屏版</a>
<a href="<?php echo $_G['setting']['mobile']['nomobileurl'];?>">电脑版</a>
<?php if($clienturl) { ?><a href="<?php echo $clienturl;?>">客户端</a><?php } ?>
    <!--</div>
<p>&copy; Comsenz Inc.</p>
</div>-->
<?php } ?>

<!--底部导航-->

<div id="footbar">
    <div class="fbc">
        <ul>
            <li class="<?php if($_GET['mod'] == 'guide') { ?> a<?php } ?>"><a href="forum.php">首页</a></li>
            <li class="<?php if($_GET['mod'] !== 'guide' && $_GET['mod'] !== 'space' && $_GET['mod'] !== 'forum' && $_GET['mod'] !== 'logging' && $_GET['mod'] !== 'post' && $_GET['action'] !== 'nav') { ?> a<?php } ?>"><a href="forum.php?forumlist=1">奇坛</a></li>
            <li class="<?php if($_GET['mod'] == 'forum') { ?> a<?php } ?>"><a href="search.php?mod=forum">搜索</a></li>
            <li class="<?php if($_GET['mod'] == 'space' && $_GET['type'] != 'forum') { ?> a<?php } ?>"><a href="<?php if($_G['uid']) { ?>home.php?mod=space&uid=<?php echo $_G['uid'];?>&do=profile&mycenter=1<?php } else { ?>member.php?mod=logging&action=login<?php } ?>">我<?php if($_G['member']['newpm']) { ?><em class="iconfont icon-dian1"></em><?php } ?></a></li>
        </ul>
    </div>
</div>

</body>
</html><?php updatesession();?><?php if(defined('IN_MOBILE')) { output();?><?php } else { output_preview();?><?php } ?>
