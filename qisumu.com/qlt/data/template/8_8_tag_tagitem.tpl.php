<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('tagitem');?><?php include template('common/header'); require TPLDIR."/php/tag.php";?><div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="misc.php?mod=tag">标签</a>
<?php if($tagname) { ?>
<em>&rsaquo;</em>
<a href="misc.php?mod=tag&amp;id=<?php echo $id;?>"><?php echo $tagname;?></a>
<?php } if($showtype == 'thread') { ?>
<em>&rsaquo;</em> 相关帖子
<?php } if($showtype == 'blog') { ?>
<em>&rsaquo;</em> 相关日志
<?php } ?>
</div>
</div>
<div id="ct" class="wp cl">
<div class="mn">
        <?php if($tagname) { ?>
        
        
            <h1 class="wic_tag_tit mb20"><em></em><?php echo $tagname;?></h1>
            <?php if(empty($showtype) || $showtype == 'thread') { ?>
                <div class="tagthread mb15 tl">
                    <div class="wic_stit cl">
                        <h2>相关帖子</h2>
                    </div>
                    <div class="tagthreadc">
                        <?php if($threadlist) { ?>
                            <table cellspacing="0" cellpadding="0">
                                <?php if(is_array($threadlist)) foreach($threadlist as $thread) { ?>                                    <tr>
                                        <td class="icn">
                                            <div class="listavt">
                                            <?php if($thread['authorid'] && $thread['author']) { ?>
                                                <a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" c="1"><?php echo avatar($thread[authorid],small);?></a>
                                            <?php } else { ?>
                                                <img src="<?php echo $_G['style']['styleimgdir'];?>/hidden.gif" title="<?php echo $_G['setting']['anonymoustext'];?>" alt="<?php echo $_G['setting']['anonymoustext'];?>" />
                                            <?php } ?>
                                            </div> 
                                        </td>
                                        <th>
                                            <div class="listt">
                                                <span class="cate"><em>[<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $thread['fid'];?>"><?php echo $thread['forumname'];?></a>]</em></span>
                                                <a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>" target="_blank" class="tit" <?php echo $thread['highlight'];?>><?php echo $thread['subject'];?></a>
                                                <?php if($thread['attachment'] == 2) { ?>
                                                    <img src="<?php echo $_G['style']['styleimgdir'];?>/fl/image_s.gif" alt="attach_img" title="!attach_img!" align="absmiddle" />
                                                <?php } elseif($thread['attachment'] == 1) { ?>
                                                    <img src="<?php echo $_G['style']['styleimgdir'];?>/fl/common.gif" alt="attachment" title="!attachment!" align="absmiddle" />
                                                <?php } ?>
                                                <?php if($thread['digest'] > 0 && $filter != 'digest') { ?>
                                                    <img src="<?php echo $_G['style']['styleimgdir'];?>/fl/digest_<?php echo $thread['digest'];?>.gif" align="absmiddle" alt="digest" title="!thread_digest! <?php echo $thread['digest'];?>" />
                                                <?php } ?>
                                                <a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?><?php if($_GET['archiveid']) { ?>&amp;archiveid=<?php echo $_GET['archiveid'];?><?php } ?>" title="新窗口打开" target="_blank">
                                                <?php if($thread['folder'] == 'lock') { ?>
                                                    <img src="<?php echo $_G['style']['styleimgdir'];?>/fl/folder_lock.gif" />
                                                <?php } elseif($thread['special'] == 1) { ?>
                                                    <img src="<?php echo $_G['style']['styleimgdir'];?>/fl/pollsmall.gif" alt="投票" />
                                                <?php } elseif($thread['special'] == 2) { ?>
                                                    <img src="<?php echo $_G['style']['styleimgdir'];?>/fl/tradesmall.gif" alt="商品" />
                                                <?php } elseif($thread['special'] == 3) { ?>
                                                    <img src="<?php echo $_G['style']['styleimgdir'];?>/fl/rewardsmall.gif" alt="悬赏" />
                                                <?php } elseif($thread['special'] == 4) { ?>
                                                    <img src="<?php echo $_G['style']['styleimgdir'];?>/fl/activitysmall.png" alt="活动" />
                                                <?php } elseif($thread['special'] == 5) { ?>
                                                    <img src="<?php echo $_G['style']['styleimgdir'];?>/fl/debatesmall.gif" alt="辩论" />
                                                <?php } elseif(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
                                                    <img src="<?php echo $_G['style']['styleimgdir'];?>/fl/pin_<?php echo $thread['displayorder'];?>.gif" alt="<?php echo $_G['setting']['threadsticky'][3-$thread['displayorder']];?>" />
                                                <?php } else { ?>
                                                    <img src="<?php echo $_G['style']['styleimgdir'];?>/fl/folder_<?php echo $thread['folder'];?>.gif" />
                                                <?php } ?>
                                                </a>
                                            </div>
                                            <div class="listb cl">
                                                <div class="listbl z"> 
                                                    <span class="user">
                                                    <?php if($thread['authorid'] && $thread['author']) { ?>
                                                        <a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" class="userauthor" c="1"><?php echo $thread['author'];?></a>
                                                    <?php } else { ?>
                                                        匿名
                                                    <?php } ?>
                                                    </span>
                                                    <span class="time<?php if($thread['istoday']) { ?> xi1<?php } ?>"> @ <?php echo $thread['dateline'];?></span>
                                                    <span class="other">
                                                        <?php if($thread['readperm']) { ?> - [阅读权限 <span class="xw1"><?php echo $thread['readperm'];?></span>]<?php } ?>
                                                        <?php if($thread['price'] > 0) { ?>
                                                            <?php if($thread['special'] == '3') { ?>
                                                            - <span style="color: #C60">[悬赏 <span class="xw1"><?php echo $thread['price'];?></span> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?>]</span>
                                                            <?php } else { ?>
                                                            - [!price! <span class="xw1"><?php echo $thread['price'];?></span> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?>]
                                                            <?php } ?>
                                                        <?php } elseif($thread['special'] == '3' && $thread['price'] < 0) { ?>
                                                            - [!reward_solved!]
                                                        <?php } ?>
                                                    </span>
                                                </div>
                                                <div class="listblr y">
                                                    <span class="lpuser"><?php if($thread['lastposter']) { ?><a href="<?php if($thread['digest'] != -2) { ?>home.php?mod=space&username=<?php echo $thread['lastposterenc'];?><?php } else { ?>forum.php?mod=viewthread&tid=<?php echo $thread['tid'];?>&page=<?php echo max(1, $thread['pages']);; } ?>" c="1"><?php echo $thread['lastposter'];?></a><?php } else { ?><?php echo $_G['setting']['anonymoustext'];?><?php } ?></span>
                                                    <span class="lptime"> @ <a href="<?php if($thread['digest'] != -2) { ?>forum.php?mod=redirect&tid=<?php echo $thread['tid'];?>&goto=lastpost<?php echo $highlight;?>#lastpost<?php } else { ?>forum.php?mod=viewthread&tid=<?php echo $thread['tid'];?>&page=<?php echo max(1, $thread['pages']);; } ?>"><?php echo $thread['lastpost'];?></a></span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="by"></td>
                                        <td class="by"></td>
                                        <td class="num"></td>
                                        <td class="by"></td>
                                    </tr>
                                <?php } ?>
                            </table>
                            <?php if(empty($showtype)) { ?>
                                <div class="ptm">
                                    <a class="tagmore" href="misc.php?mod=tag&amp;id=<?php echo $id;?>&amp;type=thread">更多...</a>
                                </div>
                            <?php } else { ?>
                                <?php if($multipage) { ?><div class="pgs mtm cl"><?php echo $multipage;?></div><?php } ?>
                            <?php } ?>
                        <?php } else { ?>
                            <p class="emp">没有相关内容</p>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        
            <?php if(helper_access::check_module('blog') && (empty($showtype) || $showtype == 'blog')) { ?>
                <div class="tagblog tagthread mb15">
                    <div class="wic_stit cl">
                        <h2>相关日志</h2>
                    </div>
                    <div class="tagthreadc">
                        <?php if($bloglist) { ?>
                            <div class="xld xlda">
                                <?php if(is_array($bloglist)) foreach($bloglist as $blog) { ?>                                    <dl class="bbda">
                                        <dd class="m">
                                            <div class="avt"><a href="home.php?mod=space&amp;uid=<?php echo $blog['uid'];?>" target="_blank" c="1"><?php echo avatar($blog[uid],small);?></a></div>
                                        </dd>
                                        <dt class="xs2">
                                            <?php if(helper_access::check_module('share')) { ?>
                                            <a href="home.php?mod=spacecp&amp;ac=share&amp;type=blog&amp;id=<?php echo $blog['blogid'];?>&amp;handlekey=lsbloghk_<?php echo $blog['blogid'];?>" id="a_share_<?php echo $blog['blogid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="oshr xs1 xw0">分享</a>
                                            <?php } ?>
                                            <a href="home.php?mod=space&amp;uid=<?php echo $blog['uid'];?>&amp;do=blog&amp;id=<?php echo $blog['blogid'];?>" target="_blank"><?php echo $blog['subject'];?></a>
                                        </dt>
                                        <dd>
                                            <?php if($blog['hot']) { ?><span class="hot">热度 <em><?php echo $blog['hot'];?></em> </span><?php } ?>
                                            <a href="home.php?mod=space&amp;uid=<?php echo $blog['uid'];?>" target="_blank"><?php echo $blog['username'];?></a> <span class="xg1"><?php echo $blog['dateline'];?></span>
                                        </dd>
                                        <dd class="cl" id="blog_article_<?php echo $blog['blogid'];?>">
                                            <?php if($blog['pic']) { ?><div class="atc"><a href="home.php?mod=space&amp;uid=<?php echo $blog['uid'];?>&amp;do=blog&amp;id=<?php echo $blog['blogid'];?>" target="_blank"><img src="<?php echo $blog['pic'];?>" alt="<?php echo $blog['subject'];?>" class="tn" /></a></div><?php } ?>
                                            <?php echo $blog['message'];?>
                                        </dd>
                                        <dd class="xg1">
                                            <?php if($blog['classname']) { ?>个人分类: <a href="home.php?mod=space&amp;uid=<?php echo $blog['uid'];?>&amp;do=blog&amp;classid=<?php echo $blog['classid'];?>&amp;view=me" target="_blank"><?php echo $blog['classname'];?></a><span class="pipe">|</span><?php } ?>
                                            <?php if($blog['viewnum']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $blog['uid'];?>&amp;do=blog&amp;id=<?php echo $blog['blogid'];?>" target="_blank"><?php echo $blog['viewnum'];?> 次阅读</a><span class="pipe">|</span><?php } ?>
                                            <a href="home.php?mod=space&amp;uid=<?php echo $blog['uid'];?>&amp;do=blog&amp;id=<?php echo $blog['blogid'];?>#comment" target="_blank"><span id="replynum_<?php echo $blog['blogid'];?>"><?php echo $blog['replynum'];?></span> 个评论</a>
                                        </dd>
                                    </dl>
                                <?php } ?>
                            </div>
                            <?php if(empty($showtype)) { ?>
                                <div class="ptm">
                                    <a class="tagmore" href="misc.php?mod=tag&amp;id=<?php echo $id;?>&amp;type=blog">更多...</a>
                                </div>
                            <?php } else { ?>
                                <?php if($multipage) { ?><div class="pgs mtm cl"><?php echo $multipage;?></div><?php } ?>
                            <?php } ?>
                        <?php } else { ?>
                            <p class="emp">没有相关内容</p>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        
        <?php } else { ?>
            <h1 class="mt">标签: <?php echo $searchtagname;?></h1>
            <div class="tag mb15">
                <form method="post" action="misc.php?mod=tag" class="pns">
                    <input type="text" name="name" class="px vm" size="30" />&nbsp;
                    <button type="submit" class="pn vm"><em>搜索</em></button>
                </form>
                <div class="taglist mtm mbm"><p>没有此标签，您可以继续搜索或者<a href="misc.php?mod=tag" title="返回标签首页">返回标签首页</a></p></div>
            </div>
        <?php } ?>
</div>
    <div class="sd">
    	<div class="wic_hottag mb15">
        	<div class="sdtit cl">
            	<h2><?php echo $tmplang['hot_tag'];?></h2>
            </div>
        	<?php if($hottag) { ?> 	
            <div class="wic_hottagc">
            	<ul>
                <?php $i=1;?>                <?php if(is_array($hottag)) foreach($hottag as $taglist) { ?>                    <li><a href="misc.php?mod=tag&amp;id=<?php echo $taglist['tagid'];?>" title="<?php echo $taglist['tagname'];?>" target="_blank" class="tag<?php echo $i;?>"><?php echo $taglist['tagname'];?></a></li>
                    <?php $i++;?>                <?php } ?>
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>
</div><?php include template('common/footer'); ?>