<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('guide');
0
|| checktplrefresh('./template/wic_selfmedia/forum/guide.htm', './template/wic_selfmedia/forum/guide_list_row.htm', 1487706857, '8', './data/template/8_8_forum_guide.tpl.php', './template/wic_selfmedia', 'forum/guide')
;?><?php include template('common/header'); ?><style type="text/css">
.xl2 { background: url(<?php echo IMGDIR;?>/vline.png) repeat-y 50% 0; }
.xl2 li { width: 49.9%; }
.xl2 li em { padding-right: 10px; }
.xl2 .xl2_r em { padding-right: 0; }
.xl2 .xl2_r i { padding-left: 10px; }
</style>
<div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a><?php if(helper_access::check_module('guide')) { ?><em>&raquo;</em><a href="forum.php?mod=guide&amp;view=index">����</a><?php } ?><?php echo $navigation;?>
</div>
</div>
<div class="boardnav">
<div id="ct" class="wp cl<?php if($_G['forum']['allowside']) { ?> ct2<?php } ?>"<?php if($leftside) { ?> style="margin-left:<?php echo $_G['leftsidewidth_mwidth'];?>px"<?php } ?>>
<div class="mn">
<div class="guide pbn mb15">
<div class="wic_stit cl">
<?php if($view != 'index' && $view != 'my') { ?>
<span class="y">
<a href="forum.php?mod=guide&amp;view=<?php echo $view;?>&amp;rss=1" class="fa_rss" target="_blank" title="RSS">����</a>
</span>
<?php } ?>
<h2>
<?php echo $lang['guide_'.$view];?>
</h2>
</div>
<?php if($view != 'my') { ?>
<div class="bm_c cl pbn">
<div style=";" id="forum_rules_1163">
<div class="ptn xg2"><?php echo $lang['guide_'.$view.'_description'];?></div>
</div>
</div>
<?php } ?>
</div>
<?php if($view != 'index') { ?>
            <a onclick="showWindow('nav', this.href, 'get', 0)" href="forum.php?mod=misc&amp;action=nav" class="wic_newpost mb20"><em></em>������</a>
<div id="pgt" class="pgs cl">
<?php echo $multipage;?>
</div>
<?php } ?>
<ul id="thread_types" class="ttp bm cl">
<li <?php echo $currentview['hot'];?>><a href="forum.php?mod=guide&amp;view=hot">��������<em></em></a></li>
<li <?php echo $currentview['digest'];?>><a href="forum.php?mod=guide&amp;view=digest">���¾���<em></em></a></li>
<li <?php echo $currentview['new'];?>><a href="forum.php?mod=guide&amp;view=new">���»ظ�<em></em></a></li>
<li <?php echo $currentview['newthread'];?>><a href="forum.php?mod=guide&amp;view=newthread">���·���<em></em></a></li>
<li <?php echo $currentview['sofa'];?>><a href="forum.php?mod=guide&amp;view=sofa">��ɳ��<em></em></a></li>
<li <?php echo $currentview['my'];?>><a id="filter_special" href="forum.php?mod=guide&amp;view=my" onmouseover="showMenu(this.id)">�ҵ�����<em></em></a></li>
<?php if(!empty($_G['setting']['pluginhooks']['guide_nav_extra'])) echo $_G['setting']['pluginhooks']['guide_nav_extra'];?>
</ul>
<?php if(!empty($_G['setting']['pluginhooks']['guide_top'])) echo $_G['setting']['pluginhooks']['guide_top'];?>
<?php if($view == 'index') { if(is_array($data)) foreach($data as $key => $list) { ?><div class="bm bmw">
<div class="bm_h">
<a href="forum.php?mod=guide&amp;view=<?php echo $key;?>" class="y xi2">���� &raquo;</a>
<h2>
<?php if($key == 'hot') { ?>��������<?php } elseif($key == 'digest') { ?>���¾���<?php } elseif($key == 'newthread') { ?>���·���<?php } elseif($key == 'new') { ?>���»ظ�<?php } elseif($key == 'my') { ?>�ҵ�����<?php } ?>
</h2>
</div>
 <div class="bm_c">
 	<div class="xl xl2 cl">
 		<?php if($list['threadcount']) { ?>
 <?php $i=0;?> <?php if(is_array($list['threadlist'])) foreach($list['threadlist'] as $thread) { ?> <?php $i++;$newtd=$i%2;?> 			<li<?php if(!$newtd) { ?> class="xl2_r"<?php } ?>>
 			<em>
 			<?php if($key == 'hot') { ?><span class="xi1"><?php echo $thread['heats'];?>�˲���</span><?php } ?>
 			<?php if($key == 'new') { ?><?php echo $thread['lastpost'];?><?php } ?>
 			</em>
 			
 			<i>&middot; <a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;<?php if($_GET['archiveid']) { ?>archiveid=<?php echo $_GET['archiveid'];?>&amp;<?php } ?>extra=<?php echo $extra;?>"<?php echo $thread['highlight'];?> target="_blank"><?php echo $thread['subject'];?></a></i>&nbsp;<span class="xg1"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $thread['fid'];?>" target="_blank"><?php echo $list['forumnames'][$thread['fid']]['name'];?></a></span>
 			</li>
 			<?php } ?>
 		<?php } else { ?>
 				<p class="emp">��ʱ��û������</p>
 		<?php } ?>
 	</div>
</div>
</div>
<?php } } else { if(is_array($data)) foreach($data as $key => $list) { ?><div id="threadlist" class="tl bm bmw"<?php if($_G['uid']) { ?> style="position: relative;"<?php } ?>>
<div class="threadthumb">
                       <div class="threadthumbtit">
                            <?php if($view == 'my') { ?>
                                <a href="forum.php?mod=guide&amp;view=my&amp;type=thread" <?php echo $orderactives['thread'];?>>����</a><span class="pipe">|</span>
                                <a href="forum.php?mod=guide&amp;view=my&amp;type=reply" <?php echo $orderactives['reply'];?>>�ظ�</a><span class="pipe">|</span>
                                <a href="forum.php?mod=guide&amp;view=my&amp;type=postcomment" <?php echo $orderactives['postcomment'];?>>����</a><span class="pipe">|</span>
                                <?php if($viewtype != 'postcomment') { ?>
                                    <a href="#" onclick="var displayvalue = $('searchbody').style.display == 'none' ? '' : 'none';$('searchbody').style.display=displayvalue; return false;">ɸѡ</a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <?php if($view == 'my') { ?>
                        <div class="threadthumbc" id="searchbody"<?php if(!$searchbody) { ?> style="display: none"<?php } ?>>
                            <form method="get" action="forum.php">
                                <input type="hidden" name="mod" value="guide">
                                <input type="hidden" name="view" value="my">
                                <input type="hidden" name="type" value="<?php echo $viewtype;?>">
                            <?php if($viewtype != 'postcomment') { ?>
                                    ״̬:
                                    <select name="filter" id="filter">
                                        <option value="">ȫ��</option>
                                    <?php if(is_array($filter_array)) foreach($filter_array as $fkey => $name) { ?>                                        <option value="<?php echo $fkey;?>" <?php if($fkey == $_GET['filter']) { ?>selected<?php } ?>><?php echo $name;?></option>
                                    <?php } ?>
                                    </select>
                                    ѡ����:
                                    <select name="fid" id="forumlist">
                                    <option value="0">ȫ��</option>
                                        <?php echo $forumlist;?>
                                    </select>
                            <?php } ?>
                            <?php if($viewtype == 'thread') { ?>
                            &nbsp; �ؼ���: <input type="text" id="searchmypost" class="px vm" name="searchkey" size="20" value="<?php echo $searchkey;?>" >
                            <?php } ?><button class="pn vm"><em>����</em></button>
                            </form>
                        </div>
                        <?php } ?>
</div>
<div class="bm_c">
<div id="forumnew" style="display:none"></div>
<table cellspacing="0" cellpadding="0">				<?php if($list['threadcount']) { if(is_array($list['threadlist'])) foreach($list['threadlist'] as $key => $thread) { ?><tbody id="<?php echo $thread['id'];?>">
<tr>
<td class="icn">
                                    	<div class="listavt">
<?php if($thread['authorid'] && $thread['author']) { ?>
                                            <a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" c="1"><?php echo avatar($thread[authorid],small);?></a>
                                        <?php } else { ?>
                                            <img src="<?php echo $_G['style']['styleimgdir'];?>/hidden.gif" title="<?php echo $_G['setting']['anonymoustext'];?>" alt="<?php echo $_G['setting']['anonymoustext'];?>" />
                                        <?php } ?>
                                        </div> 
</td>
<th class="<?php echo $thread['folder'];?>">
                                    	<div class="listt">
<?php if(!$thread['forumstick'] && $thread['closed'] > 1 && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])) { $thread[tid]=$thread[closed];?><?php } ?>
<span class="cate"><?php if($list['forumnames'][$thread['fid']]['name']) { ?><em>[<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $thread['fid'];?>" target="_blank"><?php echo $list['forumnames'][$thread['fid']]['name'];?></a>]</em><?php } ?><em><?php echo $thread['typehtml'];?> <?php echo $thread['sorthtml'];?></em></span>
<?php if($thread['moved']) { ?>
�ƶ�:<?php $thread[tid]=$thread[closed];?><?php } ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;<?php if($_GET['archiveid']) { ?>archiveid=<?php echo $_GET['archiveid'];?>&amp;<?php } ?>extra=<?php echo $extra;?>" target="_blank" class="tit" ><?php echo $thread['subject'];?></a><?php if($_G['setting']['threadhidethreshold'] && $thread['hidden'] >= $_G['setting']['threadhidethreshold']) { ?>&nbsp;<span class="xg1">����</span>&nbsp;<?php } if($view == 'hot') { ?>&nbsp;<span class="xi1"><?php echo $thread['heats'];?>�˲���</span>&nbsp;<?php } if($thread['icon'] >= 0) { ?>
<img src="<?php echo STATICURL;?>image/stamp/<?php echo $_G['cache']['stamps'][$thread['icon']]['url'];?>" alt="<?php echo $_G['cache']['stamps'][$thread['icon']]['text'];?>" align="absmiddle" />
<?php } if($thread['rushreply']) { ?>
<img src="<?php echo $_G['style']['styleimgdir'];?>/fl/rushreply_s.png" alt="��¥" align="absmiddle" />
<?php } if($stemplate && $sortid) { ?><?php echo $stemplate[$sortid][$thread['tid']];?><?php } if($thread['attachment'] == 2) { ?>
<img src="<?php echo $_G['style']['styleimgdir'];?>/fl/image_s.gif" alt="attach_img" title="ͼƬ����" align="absmiddle" />
<?php } elseif($thread['attachment'] == 1) { ?>
<img src="<?php echo $_G['style']['styleimgdir'];?>/fl/common.gif" alt="attachment" title="����" align="absmiddle" />
<?php } if($thread['digest'] > 0 && $filter != 'digest') { ?>
<img src="<?php echo $_G['style']['styleimgdir'];?>/fl/digest_<?php echo $thread['digest'];?>.gif" align="absmiddle" alt="digest" title="���� <?php echo $thread['digest'];?>" />
<?php } if($thread['displayorder'] == 0) { if($thread['recommendicon'] && $filter != 'recommend') { ?>
<img src="<?php echo IMGDIR;?>/recommend_<?php echo $thread['recommendicon'];?>.gif" align="absmiddle" alt="recommend" title="����ָ�� <?php echo $thread['recommends'];?>" />
<?php } if($thread['heatlevel']) { ?>
<img src="<?php echo $_G['style']['styleimgdir'];?>/fl/hot_<?php echo $thread['heatlevel'];?>.gif" align="absmiddle" alt="heatlevel" title="<?php echo $thread['heatlevel'];?> �ȶ�" />
<?php } if($thread['rate'] > 0) { ?>
<img src="<?php echo $_G['style']['styleimgdir'];?>/fl/agree.gif" align="absmiddle" alt="agree" title="���ӱ��ӷ�" />
<?php } elseif($thread['rate'] < 0) { ?>
<img src="<?php echo $_G['style']['styleimgdir'];?>/fl/disagree.gif" align="absmiddle" alt="disagree" title="���ӱ�����" />
<?php } } ?>

                                        <a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['icontid'];?>&amp;<?php if($_GET['archiveid']) { ?>archiveid=<?php echo $_GET['archiveid'];?>&amp;<?php } ?>extra=<?php echo $extra;?>" title="<?php if($thread['displayorder'] == 1) { ?>�����ö����� - <?php } if($thread['displayorder'] == 2) { ?>�����ö����� - <?php } if($thread['displayorder'] == 3) { ?>ȫ���ö����� - <?php } if($thread['displayorder'] == 4) { ?>����ö����� - <?php } if($thread['folder'] == 'lock') { ?>�رյ����� - <?php } if($thread['special'] == 1) { ?>ͶƱ - <?php } if($thread['special'] == 2) { ?>��Ʒ - <?php } if($thread['special'] == 3) { ?>���� - <?php } if($thread['special'] == 4) { ?>� - <?php } if($thread['special'] == 5) { ?>���� - <?php } if($thread['folder'] == "new") { ?>���»ظ� - <?php } ?>
�´��ڴ�" target="_blank">
<?php if($thread['folder'] == 'lock') { ?>
<img src="<?php echo $_G['style']['styleimgdir'];?>/fl/folder_lock.gif" />
<?php } elseif($thread['special'] == 1) { ?>
<img src="<?php echo $_G['style']['styleimgdir'];?>/fl/pollsmall.gif" alt="ͶƱ" />
<?php } elseif($thread['special'] == 2) { ?>
<img src="<?php echo $_G['style']['styleimgdir'];?>/fl/tradesmall.gif" alt="��Ʒ" />
<?php } elseif($thread['special'] == 3) { ?>
<img src="<?php echo $_G['style']['styleimgdir'];?>/fl/rewardsmall.gif" alt="����" />
<?php } elseif($thread['special'] == 4) { ?>
<img src="<?php echo $_G['style']['styleimgdir'];?>/fl/activitysmall.png" alt="�" />
<?php } elseif($thread['special'] == 5) { ?>
<img src="<?php echo $_G['style']['styleimgdir'];?>/fl/debatesmall.gif" alt="����" />
<?php } elseif(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
<img src="<?php echo $_G['style']['styleimgdir'];?>/fl/pin_<?php echo $thread['displayorder'];?>.gif" alt="<?php echo $_G['setting']['threadsticky'][3-$thread['displayorder']];?>" />
<?php } else { } ?>
</a>
<?php if($thread['multipage']) { ?>
<span class="tps"><?php echo $thread['multipage'];?></span>
<?php } if($thread['weeknew']) { ?>
<a href="forum.php?mod=redirect&amp;tid=<?php echo $thread['tid'];?>&amp;goto=lastpost#lastpost" class="xi1">New</a>
<?php } if(!$thread['forumstick'] && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])) { if($thread['related_group'] == 0 && $thread['closed'] > 1) { $thread[tid]=$thread[closed];?><?php } } ?>
                                        </div>
                                        <div class="listb cl">
                                            <div class="listbl z"> 
                                                <span class="user">
                                                <?php if($thread['authorid'] && $thread['author']) { ?>
                                                    <a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" c="1"><?php echo $thread['author'];?></a><?php if(!empty($verify[$thread['authorid']])) { ?> <?php echo $verify[$thread['authorid']];?><?php } ?>
                                                <?php } else { ?>
                                                    <?php echo $_G['setting']['anonymoustext'];?>
                                                <?php } ?>
                                                </span>
                                                <span class="time<?php if($thread['istoday']) { ?> xi1<?php } ?>"> @ <?php echo $thread['dateline'];?></span>
                                                <span class="other">
                                                	<?php if($thread['readperm']) { ?> - [�Ķ�Ȩ�� <span class="xw1"><?php echo $thread['readperm'];?></span>]<?php } ?>
                                                    <?php if($thread['price'] > 0) { ?>
                                                        <?php if($thread['special'] == '3') { ?>
                                                        - <span class="xi1">[���� <span class="xw1"><?php echo $thread['price'];?></span> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?>]</span>
                                                        <?php } else { ?>
                                                        - [�ۼ� <span class="xw1"><?php echo $thread['price'];?></span> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?>]
                                                        <?php } ?>
                                                    <?php } elseif($thread['special'] == '3' && $thread['price'] < 0) { ?>
                                                        - [�ѽ��]
                                                    <?php } ?>
                                                    <?php if($thread['replycredit'] > 0) { ?>
                                                        - <span class="xi1">[�������� <strong> <?php echo $thread['replycredit'];?></strong> ]</span>
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
</tbody>
<?php if($view == 'my' && $viewtype=='reply' && !empty($tids[$thread['tid']])) { ?>
<tbody class="bw0_all">
<tr>
<td class="icn">&nbsp;</td>
<td colspan="5"><?php if(is_array($tids[$thread['tid']])) foreach($tids[$thread['tid']] as $pid) { $post = $posts[$pid];?><div class="tl_reply xg1"><a href="forum.php?mod=redirect&amp;goto=findpost&amp;ptid=<?php echo $thread['tid'];?>&amp;pid=<?php echo $pid;?>" target="_blank"><?php if($post['message']) { ?><?php echo $post['message'];?><?php } else { ?>...<?php } ?></a></div>
<?php } ?>
</td>
</tr>
</tbody>
<?php } if($view == 'my' && $viewtype=='postcomment') { ?>
<tr>
<td class="icn">&nbsp;</td>
<td colspan="5" class="xg1"><div class="tl_comment"><?php echo $thread['comment'];?></div></td>
</tr>
<?php } } } else { ?>
<tbody class="bw0_all"><tr><th colspan="5"><p class="emp">��ʱ��û������</p></th></tr></tbody>
<?php } ?></table>
</div>
</div>
<?php } ?>
<div class="bm bw0 pgs cl">
<?php echo $multipage;?>
<span class="pgb y"><a href="forum.php?mod=guide">������ҳ</a></span>
</div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['guide_bottom'])) echo $_G['setting']['pluginhooks']['guide_bottom'];?>
</div>
</div>
</div>
<?php if(!IS_ROBOT) { ?>
<div id="filter_special_menu" class="p_pop" style="display:none">
<ul>
<li><a href="home.php?mod=space&amp;do=poll&amp;view=me" target="_blank">ͶƱ</a></li>
<li><a href="home.php?mod=space&amp;do=trade&amp;view=me" target="_blank">��Ʒ</a></li>
<li><a href="home.php?mod=space&amp;do=reward&amp;view=me" target="_blank">����</a></li>
<li><a href="home.php?mod=space&amp;do=activity&amp;view=me" target="_blank">�</a></li>
</ul>
</div>
<?php } include template('common/footer'); ?>