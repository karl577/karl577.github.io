<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('discuz');?>
<?php if($_G['setting']['mobile']['mobilehotthread'] && $_GET['forumlist'] != 1) { dheader('Location:forum.php?mod=guide&view=hot');exit;?><?php } include template('common/header'); ?><script type="text/javascript">
function getvisitclienthref() {
var visitclienthref = '';
if(ios) {
visitclienthref = 'https://itunes.apple.com/cn/app/zhang-shang-lun-tan/id489399408?mt=8';
} else if(andriod) {
visitclienthref = 'http://www.discuz.net/mobile.php?platform=android';
}
return visitclienthref;
}
</script>

<?php if($_GET['visitclient']) { ?>

<header class="header">
    <div class="nav">
<span>温馨提示</span>
    </div>
</header>
<div class="cl">
<div class="clew_con">
<h2 class="tit">掌上论坛手机客户端</h2>
<p>随时随地上论坛<input class="redirect button" id="visitclientid" type="button" value="点击下载" href="" /></p>
<h2 class="tit">iPhone,Andriod等智能手机</h2>
<p>直接登录手机版，阅读体验更佳<input class="redirect button" type="button" value="访问手机版" href="<?php echo $_GET['visitclient'];?>" /></p>
</div>
</div>
<script type="text/javascript">
var visitclienthref = getvisitclienthref();
if(visitclienthref) {
$('#visitclientid').attr('href', visitclienthref);
} else {
window.location.href = '<?php echo $_GET['visitclient'];?>';
}
</script>

<?php } else { ?>

<!-- header start -->
<?php if($showvisitclient) { ?>

<div class="visitclienttip vm" style="display:block;">
<a href="javascript:;" id="visitclientid" class="btn_download">立即下载</a>	
<p>
下载新版掌上论坛客户端，尊享多项看帖特权!
</p>
</div>
<script type="text/javascript">
var visitclienthref = getvisitclienthref();
if(visitclienthref) {
$('#visitclientid').attr('href', visitclienthref);
$('.visitclienttip').css('display', 'block');
}
</script>

<?php } ?>

<!-- header start -->
<div class="mobile">
<?php if($_G['setting']['domain']['app']['mobile']) { $nav = 'http://'.$_G['setting']['domain']['app']['mobile'];?><?php } else { $nav = "forum.php";?><?php } ?>
<div class="mobile-inner">
<div class="mobile-inner-header nav">
<div class="banzhuan-icon-back z">
<a href="javascript:history.back();"><img src="./template/banzhuan_weibo/touch/banzhuan/images/icon_back.png" /></a>
</div>
<h2>版块圈子</h2>
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

<?php if(!empty($_G['setting']['pluginhooks']['index_top_mobile'])) echo $_G['setting']['pluginhooks']['index_top_mobile'];?>
<!-- main forumlist start -->
<div class="wp wm" id="wp"><?php if(is_array($catlist)) foreach($catlist as $key => $cat) { ?><div class="bm bmw fl banzhuan-mar">
<div class="subforumshow bm_h cl" href="#sub_forum_<?php echo $cat['fid'];?>">
<span class="o"><img src="./template/banzhuan_weibo/touch/banzhuan/images/collapsed_<?php if(!$_G['setting']['mobile']['mobileforumview']) { ?>yes<?php } else { ?>no<?php } ?>.png"></span>
<h2><a href="javascript:;"><?php echo $cat['name'];?></a></h2>
</div>
<div id="sub_forum_<?php echo $cat['fid'];?>" class="sub_forum bm_c">
<ul><?php if(is_array($cat['forums'])) foreach($cat['forums'] as $forumid) { $forum=$forumlist[$forumid];?><?php $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forum['fid'];?><li>
<div class="fl_icn_g">
                    <?php if($forum['icon']) { ?>
                        <?php echo $forum['icon'];?>
                    <?php } else { ?>
                        <a href="<?php echo $forumurl;?>"<?php if($forum['redirect']) { ?> target="_blank"<?php } ?>>
                        	<img src="./template/banzhuan_weibo/touch/banzhuan/images/forum.jpg" alt="<?php echo $forum['name'];?>" />
                        </a>
                    <?php } ?>
                    </div>
                    <div class="fl_icn_g_info">
                    	    <div class="fl_icn_g_info_title">
        <a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $forum['fid'];?>">
        <?php if($forum['todayposts'] > 0) { ?>
    <span class="num"><?php echo $forum['todayposts'];?></span>
    <?php } ?>
    <?php echo $forum['name'];?>
    </a>
    </div>
    <?php if($forum['description']) { ?>
    <div class="fl_icn_g_info_info">
        <span><?php echo $forum['description'];?></span>
    </div>
    <?php } ?>
</div>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } ?>
</div>
<!-- main forumlist end -->
<?php if(!empty($_G['setting']['pluginhooks']['index_middle_mobile'])) echo $_G['setting']['pluginhooks']['index_middle_mobile'];?>
<script type="text/javascript">
(function() {
<?php if(!$_G['setting']['mobile']['mobileforumview']) { ?>
$('.sub_forum').css('display', 'block');
<?php } else { ?>
$('.sub_forum').css('display', 'none');
<?php } ?>
$('.subforumshow').on('click', function() {
var obj = $(this);
var subobj = $(obj.attr('href'));
if(subobj.css('display') == 'none') {
subobj.css('display', 'block');
obj.find('img').attr('src', './template/banzhuan_weibo/touch/banzhuan/images/collapsed_yes.png');
} else {
subobj.css('display', 'none');
obj.find('img').attr('src', './template/banzhuan_weibo/touch/banzhuan/images/collapsed_no.png');
}
});
 })();
</script>
<?php } include template('common/footer'); ?>