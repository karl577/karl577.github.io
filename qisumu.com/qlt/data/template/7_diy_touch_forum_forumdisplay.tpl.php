<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('forumdisplay');?><?php include template('common/header'); ?><!-- header start -->
<header class="header">
    <div class="nav">
<div class="banzhuan-icon-back z">
<a href="javascript:history.back();"><img src="./template/banzhuan_weibo/touch/banzhuan/images/icon_back.png" /></a>
</div>
<div class="name z">主题列表</div>
<div class="banzhuan-discuz-header-y"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>" class="iconfont icon-fatie"></a></div>
    </div>
</header>
<div class="banzhuan-top"></div>
<!-- header end -->

<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_top_mobile'])) echo $_G['setting']['pluginhooks']['forumdisplay_top_mobile'];?>

<div class="banzhuan-dispaly-header">
    <a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>" title="<?php echo $_G['forum']['name'];?>" class="fhlogo"><img alt="<?php echo $_G['forum']['name'];?>" src="<?php if($_G['forum']['icon']) { ?>data/attachment/common/<?php echo $_G['forum']['icon'];?><?php } else { ?>./template/banzhuan_weibo/touch/banzhuan/images/forum.jpg<?php } ?>"></a>
    <h1><?php echo strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name'];?></h1>
    <p class="info">
      	<span>今日 <em><?php echo $_G['forum']['todayposts'];?></em></span><span>主题 <em><?php echo $_G['forum']['threads'];?></em></span>
        <br/>
        <span><?php echo $_G['forum']['description'];?></span>
    </p>
    <a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=forum&amp;id=<?php echo $_G['fid'];?>&amp;handlekey=favoriteforum&amp;formhash=<?php echo FORMHASH;?>" class="forum-fav iconfont icon-shoucang">&nbsp;收藏&nbsp;<strong id="number_favorite" <?php if(!$_G['forum']['favtimes']) { ?> style="display:none;"<?php } ?>><span id="number_favorite_num"><?php echo $_G['forum']['favtimes'];?></span></strong></a>
</div>


<!-- main threadlist start -->
<?php if(!$subforumonly) { ?>
<div class="threadlist">
<ul class="bg-fff">
<?php if($_G['forum_threadcount']) { if(is_array($_G['forum_threadlist'])) foreach($_G['forum_threadlist'] as $key => $thread) { if(!$_G['setting']['mobile']['mobiledisplayorder3'] && $thread['displayorder'] > 0) { continue;?><?php } ?>
                	<?php if($thread['displayorder'] > 0 && !$displayorder_thread) { ?>
                <?php $displayorder_thread = 1;?>                    <?php } if($thread['moved']) { $thread[tid]=$thread[closed];?><?php } ?>
<li>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_thread_mobile'][$key])) echo $_G['setting']['pluginhooks']['forumdisplay_thread_mobile'][$key];?>
                    <a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>" <?php echo $thread['highlight'];?> >
<?php echo $thread['subject'];?>
<div class="banzhuan-item-info">
<?php if(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
<span class="icon_top banner-tuijian">置顶</span>
<?php } elseif($thread['digest'] > 0) { ?>
<span class="icon_top banner-tuijian">精华</span>
<?php } elseif($thread['attachment'] == 2 && $_G['setting']['mobile']['mobilesimpletype'] == 0) { ?>
<span class="icon_tu banner-tuijian">图片</span>
<?php } ?>
<span class="by"><?php echo $thread['author'];?></span>
<span class="by iconfont icon-attention">&nbsp;<?php echo $thread['views'];?></span>
<span class="by iconfont icon-xiaoxi">&nbsp;<?php echo $thread['replies'];?></span>
</div>
</a>

</li>
                <?php } ?>
            <?php } else { ?>
<li>本版块或指定的范围内尚无主题</li>
<?php } ?>
</ul>
</div>


<?php echo $multipage;?>
<?php } ?>
<!-- main threadlist end -->
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_bottom_mobile'])) echo $_G['setting']['pluginhooks']['forumdisplay_bottom_mobile'];?>
<div class="pullrefresh" style="display:none;"></div>

<?php if(!empty($_G['setting']['pluginhooks']['global_footer_mobile'])) echo $_G['setting']['pluginhooks']['global_footer_mobile'];?><?php $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);$clienturl = ''?><?php if(strpos($useragent, 'iphone') !== false || strpos($useragent, 'ios') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=ios' : 'http://www.discuz.net/mobile.php?platform=ios';?><?php } elseif(strpos($useragent, 'android') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=android' : 'http://www.discuz.net/mobile.php?platform=android';?><?php } elseif(strpos($useragent, 'windows phone') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=windowsphone' : 'http://www.discuz.net/mobile.php?platform=windowsphone';?><?php } ?>

<div id="mask" style="display:none;"></div>
<?php if(!$nofooter) { } ?>

<!--底部导航-->


</body>
</html><?php updatesession();?><?php if(defined('IN_MOBILE')) { output();?><?php } else { output_preview();?><?php } ?>