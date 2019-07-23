<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('viewthread');?>
<?php $threadsort = $threadsorts = null;?><?php include template('common/header'); ?><!-- header start -->
<header class="header">
<div class="nav">
<div class="banzhuan-icon-back z">
<a href="javascript:history.back();"><img src="./template/banzhuan_weibo/touch/banzhuan/images/icon_back.png" /></a>
</div>
<div class="name z">详情</div>
<div class="banzhuan-icon-btn y"><button class="btn_pn btn_pn_blue" id="replyid"><span>回复</span></button></div>
</div>
</header>
<!-- header end -->

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_top_mobile'])) echo $_G['setting']['pluginhooks']['viewthread_top_mobile'];?>
<!-- main postlist start -->
<div class="postlist bg-fff banzhuan-view-bg">
<h2>
<?php if($threadsorts && $_G['forum_thread']['sortid']) { ?>
                [<?php echo $_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']];?>]
    <?php } ?>
    
<?php echo $_G['forum_thread']['subject'];?>

        <?php if($_G['forum_thread']['displayorder'] == -2) { ?> <span>(审核中)</span>
        <?php } elseif($_G['forum_thread']['displayorder'] == -3) { ?> <span>(已忽略)</span>
        <?php } elseif($_G['forum_thread']['displayorder'] == -4) { ?> <span>(草稿)</span>
        <?php } ?>
</h2>

<div class="banzhuan-view-bg-em">
        <?php if($_G['forum_thread']['typeid'] && $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']]) { ?>
    <em class="y grey">#<?php echo $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']];?></em>
        <?php } ?>	
        	<em class="z grey">阅读：<?php echo $_G['forum_thread']['views'];?>&nbsp;&nbsp;</em>
        <em class="z grey">回复：<?php echo $_G['forum_thread']['allreplies'];?></em>
    </div>
<div class="banzhuan-clear"></div><?php $postcount = 0;?><?php if(is_array($postlist)) foreach($postlist as $post) { $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']);?><?php if(!empty($_G['setting']['pluginhooks']['viewthread_posttop_mobile'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_posttop_mobile'][$postcount];?>
   <div class="plc<?php if(!$post['first']) { ?> replc<?php } ?> cl" id="pid<?php echo $post['pid'];?>">
   <span class="avatar"><img src="<?php if(!$post['authorid'] || $post['anonymous']) { ?><?php echo avatar(0, small, true);?><?php } else { ?><?php echo avatar($post[authorid], small, true);?><?php } ?>" style="width:32px;height:32px;" /></span>
       <div class="display pi" href="#replybtn_<?php echo $post['pid'];?>">
   <ul class="authi">
<li class="grey">
<em>
<?php if(isset($post['isstick'])) { ?>
<img src ="<?php echo IMGDIR;?>/settop.png" title="置顶回复" class="vm" /> 来自 <?php echo $post['number'];?><?php echo $postnostick;?>
<?php } elseif($post['number'] == -1) { ?>
推荐
<?php } else { if(!empty($postno[$post['number']])) { ?><?php echo $postno[$post['number']];?><?php } else { ?><?php echo $post['number'];?><?php echo $postno['0'];?><?php } } ?>
</em>
<b>
<?php if($post['authorid'] && $post['username'] && !$post['anonymous']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>&amp;do=profile&amp;mobile=2" class="blue"><?php echo $post['author'];?></a>
</b>

<?php } else { if(!$post['authorid']) { ?>
<a href="javascript:;">游客 <em><?php echo $post['useip'];?><?php if($post['port']) { ?>:<?php echo $post['port'];?><?php } ?></em></a>
<?php } elseif($post['authorid'] && $post['username'] && $post['anonymous']) { if($_G['forum']['ismoderator']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank">匿名</a><?php } else { ?>匿名<?php } } else { ?>
<?php echo $post['author'];?> <em>该用户已被删除</em>
<?php } } ?>
                    <?php if(!IS_ROBOT && !$_GET['authorid'] && !$_G['forum_thread']['archiveid']) { ?>
                        <a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;page=<?php echo $page;?>&amp;authorid=<?php echo $_G['forum_thread']['authorid'];?>" rel="nofollow" class="blue" style="font-size:12px;font-weight:normal;margin-left:10px;">只看楼主</a>
                    <?php } elseif(!$_G['forum_thread']['archiveid']) { ?>
                        <a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;page=<?php echo $page;?>" rel="nofollow" class="blue" style="font-size:12px;font-weight:normal;margin-left:10px;">看全部</a>
                    <?php } ?>
</li>
<li class="grey rela">
<?php if($_G['forum']['ismoderator']) { ?>
<!-- manage start -->
<?php if($post['first']) { ?>
<em><a href="#moption_<?php echo $post['pid'];?>" class="popup blue">管理</a></em>
<div id="moption_<?php echo $post['pid'];?>" popup="true" class="manage" style="display:none;">
<?php if(!$_G['forum_thread']['special']) { ?>
<input type="button" value="编辑" class="redirect button" href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if($_G['forum_thread']['sortid']) { if($post['first']) { ?>&amp;sortid=<?php echo $_G['forum_thread']['sortid'];?><?php } } if(!empty($_GET['modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?>">
<?php } ?>
<input type="button" value="删除" class="dialog button" href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;operation=delete&amp;optgroup=3&amp;from=<?php echo $_G['tid'];?>">
<input type="button" value="关闭" class="dialog button" href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;from=<?php echo $_G['tid'];?>&amp;optgroup=4">
<input type="button" value="屏蔽" class="dialog button" href="forum.php?mod=topicadmin&amp;action=banpost&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">
<input type="button" value="警告" class="dialog button" href="forum.php?mod=topicadmin&amp;action=warn&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">
</div>
<?php } else { ?>
<em><a href="#moption_<?php echo $post['pid'];?>" class="popup blue">管理</a></em>
<div id="moption_<?php echo $post['pid'];?>" popup="true" class="manage" style="display:none;">
<input type="button" value="编辑" class="redirect button" href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_GET['modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?>">
<?php if($_G['group']['allowdelpost']) { ?><input type="button" value="删除" class="dialog button" href="forum.php?mod=topicadmin&amp;action=delpost&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;operation=&amp;optgroup=&amp;page=&amp;topiclist[]=<?php echo $post['pid'];?>"><?php } if($_G['group']['allowbanpost']) { ?><input type="button" value="屏蔽" class="dialog button" href="forum.php?mod=topicadmin&amp;action=banpost&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;operation=&amp;optgroup=&amp;page=&amp;topiclist[]=<?php echo $post['pid'];?>"><?php } if($_G['group']['allowwarnpost']) { ?><input type="button" value="警告" class="dialog button" href="forum.php?mod=topicadmin&amp;action=warn&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;operation=&amp;optgroup=&amp;page=&amp;topiclist[]=<?php echo $post['pid'];?>"><?php } ?>
</div>
<?php } ?>
<!-- manage end -->					
<?php } if($post['first']) { ?>
<em><a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?php echo $_G['tid'];?>" class="favbtn blue" <?php if($_G['forum']['ismoderator']) { ?>style="margin-right:10px;"<?php } ?>>收藏</a></em>
<?php } ?>					
<?php echo $post['dateline'];?>
</li>
            </ul>
<div class="message">
                	<?php if($post['warned']) { ?>
                        <span class="grey quote">受到警告</span>
                    <?php } ?>
                    <?php if(!$post['first'] && !empty($post['subject'])) { ?>
                        <h2><strong><?php echo $post['subject'];?></strong></h2>
                    <?php } ?>
                    <?php if($_G['adminid'] != 1 && $_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || $post['status'] == -1 || $post['memberstatus'])) { ?>
                        <div class="grey quote">提示: <em>作者被禁止或删除 内容自动屏蔽</em></div>
                    <?php } elseif($_G['adminid'] != 1 && $post['status'] & 1) { ?>
                        <div class="grey quote">提示: <em>该帖被管理员或版主屏蔽</em></div>
                    <?php } elseif($needhiddenreply) { ?>
                        <div class="grey quote">此帖仅作者可见</div>
                    <?php } elseif($post['first'] && $_G['forum_threadpay']) { include template('forum/viewthread_pay'); } else { ?>

                    	<?php if($_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5))) { ?>
                            <div class="grey quote">提示: <em>作者被禁止或删除 内容自动屏蔽，只有管理员或有管理权限的成员可见</em></div>
                        <?php } elseif($post['status'] & 1) { ?>
                            <div class="grey quote">提示: <em>该帖被管理员或版主屏蔽，只有管理员或有管理权限的成员可见</em></div>
                        <?php } ?>
                        <?php if($_G['forum_thread']['price'] > 0 && $_G['forum_thread']['special'] == 0) { ?>
                            付费主题, 价格: <strong><?php echo $_G['forum_thread']['price'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?> </strong> <a href="forum.php?mod=misc&amp;action=viewpayments&amp;tid=<?php echo $_G['tid'];?>" >记录</a>
                        <?php } ?>

                        <?php if($post['first'] && $threadsort && $threadsortshow) { ?>
                        	<?php if($threadsortshow['optionlist'] && !($post['status'] & 1) && !$_G['forum_threadpay']) { ?>
                                <?php if($threadsortshow['optionlist'] == 'expire') { ?>
                                    该信息已经过期
                                <?php } else { ?>
                                    <div class="box_ex2 viewsort">
                                        <h4><?php echo $_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']];?></h4>
                                    <?php if(is_array($threadsortshow['optionlist'])) foreach($threadsortshow['optionlist'] as $option) { ?>                                        <?php if($option['type'] != 'info') { ?>
                                            <?php echo $option['title'];?>: <?php if($option['value']) { ?><?php echo $option['value'];?> <?php echo $option['unit'];?><?php } else { ?><span class="grey">--</span><?php } ?><br />
                                        <?php } ?>
                                    <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                        <?php if($post['first']) { ?>
                            <?php if(!$_G['forum_thread']['special']) { ?>
                                <?php echo $post['message'];?>
                            <?php } elseif($_G['forum_thread']['special'] == 1) { ?>
                                <?php include template('forum/viewthread_poll'); ?>                            <?php } elseif($_G['forum_thread']['special'] == 2) { ?>
                                <?php include template('forum/viewthread_trade'); ?>                            <?php } elseif($_G['forum_thread']['special'] == 3) { ?>
                                <?php include template('forum/viewthread_reward'); ?>                            <?php } elseif($_G['forum_thread']['special'] == 4) { ?>
                                <?php include template('forum/viewthread_activity'); ?>                            <?php } elseif($_G['forum_thread']['special'] == 5) { ?>
                                <?php include template('forum/viewthread_debate'); ?>                            <?php } elseif($threadplughtml) { ?>
                                <?php echo $threadplughtml;?>
                                <?php echo $post['message'];?>
                            <?php } else { ?>
                            	<?php echo $post['message'];?>
                            <?php } ?>
                        <?php } else { ?>
                            <?php echo $post['message'];?>
                        <?php } } ?>
</div>
<?php if($_G['setting']['mobile']['mobilesimpletype'] == 0) { if($post['attachment']) { ?>
               <div class="grey quote">
               附件: <em><?php if($_G['uid']) { ?>您所在的用户组无法下载或查看附件<?php } else { ?>您需要<a href="member.php?mod=logging&amp;action=login">登录</a>才可以下载或查看附件。没有帐号？<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" title="注册帐号"><?php echo $_G['setting']['reglinkname'];?></a><?php } ?></em>
               </div>
            <?php } elseif($post['imagelist'] || $post['attachlist']) { ?>
               <?php if($post['imagelist']) { if(count($post['imagelist']) == 1) { ?>
<ul class="img_one"><?php echo showattach($post, 1); ?></ul>
<?php } else { ?>
<ul class="img_list cl vm"><?php echo showattach($post, 1); ?></ul>
<?php } } ?>
                <?php if($post['attachlist']) { ?>
<ul><?php echo showattach($post); ?></ul>
<?php } } } ?>			


    <?php if($_G['uid'] && $allowpostreply && !$post['first']) { ?>
<div id="replybtn_<?php echo $post['pid'];?>" class="replybtn" display="true" style="display:none;position:absolute;right:30px;top:7px;">
<input type="button" class="redirect" href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $post['pid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;page=<?php echo $page;?>" value="回复">
</div>
<?php } ?>


       </div>
   </div>
   
   	<?php if(!IS_ROBOT && $post['first'] && !$_G['forum_thread']['archiveid']) { if($post['invisible'] == 0) { ?>
<div id="p_btn">
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_share_method'])) { ?>
<div class="tshare cl">
<b>分享到:&nbsp;</b>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_share_method'])) echo $_G['setting']['pluginhooks']['viewthread_share_method'];?>
</div>
<?php } ?>

<a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?php echo $_G['tid'];?>&amp;formhash=<?php echo FORMHASH;?>" id="k_favorite" onclick="showWindow(this.id, this.href, 'get', 0);" onmouseover="this.title = $('favoritenumber').innerHTML + ' 人收藏'" title="收藏本帖"><i class="iconfont icon-shoucang">&nbsp;收藏<span id="favoritenumber"<?php if(!$_G['forum_thread']['favtimes']) { ?> style="display:none"<?php } ?>><?php echo $_G['forum_thread']['favtimes'];?></span></i></a>

<?php if($_G['group']['raterange'] && $post['authorid']) { ?>
<a href="javascript:;" id="ak_rate" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?>', 'get', -1);return false;" title="评分表立场"><i><img src="<?php echo IMGDIR;?>/agree.gif" alt="评分" />评分</i></a>
<?php } if(($_G['group']['allowrecommend'] || !$_G['uid']) && $_G['setting']['recommendthread']['status']) { if(!empty($_G['setting']['recommendthread']['addtext'])) { ?>
<a id="recommend_add" href="forum.php?mod=misc&amp;action=recommend&amp;do=add&amp;tid=<?php echo $_G['tid'];?>&amp;hash=<?php echo FORMHASH;?>" <?php if($_G['uid']) { ?>onclick="ajaxmenu(this, 3000, 1, 0, '43', 'recommendupdate(<?php echo $_G['group']['allowrecommend'];?>)');return false;"<?php } else { ?> onclick="showWindow('login', this.href)"<?php } ?> onmouseover="this.title = $('recommendv_add').innerHTML + ' 人<?php echo $_G['setting']['recommendthread']['addtext'];?>'" title="顶一下"><i class="iconfont icon-appreciatelight">&nbsp;<?php echo $_G['setting']['recommendthread']['addtext'];?><span id="recommendv_add"<?php if(!$_G['forum_thread']['recommend_add']) { ?> style="display:none"<?php } ?>><?php echo $_G['forum_thread']['recommend_add'];?></span></i></a>
<?php } if(!empty($_G['setting']['recommendthread']['subtracttext'])) { } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_useraction'])) echo $_G['setting']['pluginhooks']['viewthread_useraction'];?>
</div>
<?php } } ?>
   
   
    <?php if(!empty($_G['setting']['pluginhooks']['viewthread_postbottom_mobile'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postbottom_mobile'][$postcount];?>
    <?php if($post['first']) { ?>
        <div class="replaytitle">
        <div class="rtit">
            <?php if($ordertype != 1) { ?>
                <a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;ordertype=1" class="iconfont icon-daoxu"> 倒序浏览</a>
            <?php } else { ?>
                <a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;ordertype=2" class="iconfont icon-shunxu"> 正序浏览</a>
            <?php } ?> 
        </div>
        </div>
    <?php } ?>
    <?php $postcount++;?>    <?php } include template('forum/forumdisplay_fastpost'); ?></div>
<!-- main postlist end -->

<?php echo $multipage;?>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_bottom_mobile'])) echo $_G['setting']['pluginhooks']['viewthread_bottom_mobile'];?>

<script type="text/javascript">
$('.favbtn').on('click', function() {
var obj = $(this);
$.ajax({
type:'POST',
url:obj.attr('href') + '&handlekey=favbtn&inajax=1',
data:{'favoritesubmit':'true', 'formhash':'<?php echo FORMHASH;?>'},
dataType:'xml',
})
.success(function(s) {
popup.open(s.lastChild.firstChild.nodeValue);
evalscript(s.lastChild.firstChild.nodeValue);
})
.error(function() {
window.location.href = obj.attr('href');
popup.close();
});
return false;
});

var scrolltop = {
obj : null,
init : function(obj) {
scrolltop.obj = obj;
var fixed = this.isfixed();
obj.css('opacity', '.618');
if(fixed) {
obj.css('bottom', '58px');
} else {
obj.css({'visibility':'visible', 'position':'absolute'});
}
$(window).on('resize', function() {
if(fixed) {
obj.css('bottom', '58px');
} else {
obj.css('top', ($(document).scrollTop() + $(window).height() - 40) + 'px');
}
});
obj.on('tap', function() {
$(document).scrollTop($(document).height());
});
$(document).on('scroll', function() {
if(!fixed) {
obj.css('top', ($(document).scrollTop() + $(window).height() - 40) + 'px');
}
if($(document).scrollTop() >= 400) {
obj.removeClass('bottom')
.off().on('tap', function() {
window.scrollTo('0', '1');
});
} else {
obj.addClass('bottom')
.off().on('tap', function() {
$(document).scrollTop($(document).height());
});
}
});

},
isfixed : function() {
var offset = scrolltop.obj.offset();
var scrollTop = $(window).scrollTop();
var screenHeight = document.documentElement.clientHeight;
if(offset == undefined) {
return false;
}
if(offset.top < scrollTop || (offset.top - scrollTop) > screenHeight) {
return false;
} else {
return true;
}
}
};
</script>

<a href="javascript:;" title="返回顶部" class="scrolltop bottom"></a>


<?php if(!empty($_G['setting']['pluginhooks']['global_footer_mobile'])) echo $_G['setting']['pluginhooks']['global_footer_mobile'];?><?php $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);$clienturl = ''?><?php if(strpos($useragent, 'iphone') !== false || strpos($useragent, 'ios') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=ios' : 'http://www.discuz.net/mobile.php?platform=ios';?><?php } elseif(strpos($useragent, 'android') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=android' : 'http://www.discuz.net/mobile.php?platform=android';?><?php } elseif(strpos($useragent, 'windows phone') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=windowsphone' : 'http://www.discuz.net/mobile.php?platform=windowsphone';?><?php } ?>

<div id="mask" style="display:none;"></div>
<?php if(!$nofooter) { ?>
<div class="footer">
    <div>
<a href="<?php echo $_G['setting']['mobile']['simpletypeurl']['0'];?>">标准版</a>
<a href="javascript:;" style="color:#999;">触屏版</a>
<a href="<?php echo $_G['setting']['mobile']['nomobileurl'];?>">电脑版</a>
<?php if($clienturl) { ?><a href="<?php echo $clienturl;?>">客户端</a><?php } ?>
    </div>
<p>&copy; Comsenz Inc.</p>
</div>
<?php } ?>


</body>
</html><?php updatesession();?><?php if(defined('IN_MOBILE')) { output();?><?php } else { output_preview();?><?php } ?>