<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('viewthread');
0
|| checktplrefresh('./template/default/mobile/forum/viewthread.htm', './template/default/mobile/forum/forumdisplay_fastpost.htm', 1534267570, 'diy', './data/template/1_diy_mobile_forum_viewthread.tpl.php', './template/banzhuan_weibo', 'mobile/forum/viewthread')
|| checktplrefresh('./template/default/mobile/forum/viewthread.htm', './template/default/mobile/common/seccheck.htm', 1534267570, 'diy', './data/template/1_diy_mobile_forum_viewthread.tpl.php', './template/banzhuan_weibo', 'mobile/forum/viewthread')
;?><?php include template('common/header'); if($_G['forum']['type'] != 'sub') { ?>
<div class="box"><a href="forum.php"><?php echo $_G['setting']['navs']['2']['navname'];?></a> <em> &gt; </em> <a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>"><?php echo strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name'];?></a></div>
<?php } else { if($_G['forum']['status'] != 3) { ?>
<div class="box"><a href="forum.php"><?php echo $_G['setting']['navs']['2']['navname'];?></a> <em> &gt; </em> <a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $fup;?>"><?php echo strip_tags($_G['cache']['forums'][$fup]['name'])?></a> <em> &gt; </em> <a href="<?php echo $upnavlink;?>"><?php echo strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name'];?></a></div>
<?php } else { ?>
<div class="box"><a href="group.php"><?php echo $_G['setting']['navs']['3']['navname'];?></a> <?php echo $nav['nav'];?></div>
    <?php } } ?>
<div class="tz mtn">
<?php if(!$_G['forum']['allowspecialonly']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>" title="����" >����</a><span class="pipe">|</span><?php } if($_G['group']['allowpostpoll']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=1">��ͶƱ</a><span class="pipe">|</span><?php } if($_G['group']['allowpostreward']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=3">������</a> <span class="pipe">|</span><?php } if($_G['group']['allowpostdebate']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=5">������</a><span class="pipe">|</span><?php } if($_G['setting']['threadplugins']) { if(is_array($_G['forum']['threadplugin'])) foreach($_G['forum']['threadplugin'] as $tpid) { if(array_key_exists($tpid, $_G['setting']['threadplugins']) && @in_array($tpid, $_G['group']['allowthreadplugin'])) { ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;specialextra=<?php echo $tpid;?>"><?php echo $_G['setting']['threadplugins'][$tpid]['name'];?></a><span class="pipe">|</span>
<?php } } } ?>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_top_mobile'])) echo $_G['setting']['pluginhooks']['viewthread_top_mobile'];?>
<div class="vt">
    <div class="bm">
        <div class="bm_h">
        	<?php if($_G['forum_thread']['typeid'] && $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']]) { ?>
                <?php if(!IS_ROBOT && ($_G['forum']['threadtypes']['listable'] || $_G['forum']['status'] == 3)) { ?>
                    <a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=typeid&amp;typeid=<?php echo $_G['forum_thread']['typeid'];?>" >[<?php echo $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']];?>]</a>
                <?php } else { ?>
                    [<?php echo $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']];?>]
                <?php } ?>
            <?php } ?>
            <?php if($threadsorts && $_G['forum_thread']['sortid']) { ?>
                <a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=sortid&amp;sortid=<?php echo $_G['forum_thread']['sortid'];?>" >[<?php echo $_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']];?>]</a>
            <?php } ?>

            <a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_GET['extra'];?>" id="thread_subject" ><?php echo $_G['forum_thread']['subject'];?></a>
            <?php if($_G['forum_thread']['displayorder'] == -2) { ?> <span class="xg1">(�����)</span>
            <?php } elseif($_G['forum_thread']['displayorder'] == -3) { ?> <span class="xg1">(�Ѻ���)</span>
            <?php } elseif($_G['forum_thread']['displayorder'] == -4) { ?> <span class="xg1">(�ݸ�)</span>
            <?php } ?>
        </div>
        <?php if($_G['forum']['ismoderator']) { ?>
        <div class="box"><a href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;operation=delete&amp;optgroup=3&amp;from=<?php echo $_G['tid'];?>">ɾ��</a><span class="pipe">|</span><a href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;from=<?php echo $_G['tid'];?>&amp;optgroup=4">�ر�</a><span class="pipe">|</span><a href="forum.php?mod=topicadmin&amp;action=banpost&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">����</a><span class="pipe">|</span><a href="forum.php?mod=topicadmin&amp;action=warn&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">����</a>
        </div>
        <?php } ?>
  <?php if(!$_G['setting']['mobile']['mobilesimpletype']) { ?>
  <div class="bm_inf">
<?php if($_G['forum_thread']['digest'] > 0) { ?>
     <span class="xi1">����</span>
<?php } ?>
<font class="xg1">��<?php echo $_G['forum_thread']['views'];?><span class="pipe">|</span>��<?php echo $_G['forum_thread']['replies'];?></font><span class="pipe">|</span><?php if($_G['tid']) { ?><a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?php echo $_G['tid'];?>">�ղ�</a><?php } ?>
  </div>
  <?php } ?>
        <?php $postcount = 0;?>        <?php if(is_array($postlist)) foreach($postlist as $post) { ?>        <?php $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']);?>        	<?php if(!empty($_G['setting']['pluginhooks']['viewthread_posttop_mobile'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_posttop_mobile'][$postcount];?>
            <div id="post_<?php echo $post['pid'];?>" class="bm_c bm_c_bg">
            	<div class="bm_user" id="pid<?php echo $post['pid'];?>">
                	<?php if(!IS_ROBOT) { ?>
                        <?php if(!empty($postno[$post['number']])) { ?><?php echo $postno[$post['number']];?><?php } else { ?><em><?php echo $post['number'];?></em><?php echo $postno['0'];?><?php } ?>
                    <?php } ?>
                	<?php if($post['authorid'] && $post['username'] && !$post['anonymous']) { ?>
                    	<a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" ><?php echo $post['author'];?></a>
                        <?php if($post['authorid'] != $_G['uid'] && $_G['uid']) { ?>
                        <a href="home.php?mod=spacecp&amp;ac=pm&amp;touid=<?php echo $post['authorid'];?>&amp;pmid=0&amp;daterange=2&amp;pid=<?php echo $post['pid'];?>" class="xg1" title="����Ϣ">����Ϣ</a>
                        <?php } if($_G['group']['allowbanuser']) { ?><a href="forum.php?mod=modcp&amp;action=member&amp;op=ban&amp;uid=<?php echo $post['authorid'];?>" class="xg1">��ֹ</a><?php } ?>
                    <?php } else { ?>
                    	<?php if(!$post['authorid']) { ?>
                            <a href="javascript:;">�ο� <em><?php echo $post['useip'];?><?php if($post['port']) { ?>:<?php echo $post['port'];?><?php } ?></em></a>
                        <?php } elseif($post['authorid'] && $post['username'] && $post['anonymous']) { ?>
                            <?php if($_G['forum']['ismoderator']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank">����</a><?php } else { ?>����<?php } ?>
                        <?php } else { ?>
                            <?php echo $post['author'];?> <em>���û��ѱ�ɾ��</em>
                        <?php } ?>
                   	<?php } ?>
                <?php if(!$_G['setting']['mobile']['mobilesimpletype']) { ?>
                    <?php if($post['authorid'] && !$post['anonymous']) { ?>
                        <?php if($post['invisible'] == 0) { ?>
                            <?php if(!IS_ROBOT && !$_GET['authorid'] && !$_G['forum_thread']['archiveid']) { ?>
                                <a href="forum.php?mod=viewthread&amp;tid=<?php echo $post['tid'];?>&amp;page=<?php echo $page;?>&amp;authorid=<?php echo $post['authorid'];?>" rel="nofollow" class="xg1">ֻ����</a>
                            <?php } elseif(!$_G['forum_thread']['archiveid']) { ?>
                                <a href="forum.php?mod=viewthread&amp;tid=<?php echo $post['tid'];?>&amp;page=<?php echo $page;?>" rel="nofollow" class="xg1">��ȫ��</a>
                            <?php } ?>
                        <?php } ?>
                        <br /><em id="authorposton<?php echo $post['pid'];?>"><font class="xs0 xg1"><?php echo $post['dateline'];?></font></em>
                    <?php } elseif($post['authorid'] && $post['username'] && $post['anonymous']) { ?>
                        ����
                        <br /><em id="authorposton<?php echo $post['pid'];?>"><font class="xs0 xg1"><?php echo $post['dateline'];?></font></em>
                    <?php } elseif(!$post['authorid'] && !$post['username']) { ?>
                        �ο�
                        <br /><em id="authorposton<?php echo $post['pid'];?>"><font class="xs0 xg1"><?php echo $post['dateline'];?></font></em>
                    <?php } ?>
                <?php } ?>
                </div>
            </div>
            <div>
                <div class="pbody">
                	<?php if($post['warned']) { ?>
                        <span class="y xi1">�ܵ�����</span>
                    <?php } ?>
                    <?php if(!$post['first'] && !empty($post['subject'])) { ?>
                        <h2><strong><?php echo $post['subject'];?></strong></h2>
                    <?php } ?>
                    <div class="mes">
                    <?php if($_G['adminid'] != 1 && $_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || $post['status'] == -1 || $post['memberstatus'])) { ?>
                        <div class="xi1">��ʾ: <em>���߱���ֹ��ɾ�� �����Զ�����</em></div>
                    <?php } elseif($_G['adminid'] != 1 && $post['status'] & 1) { ?>
                        <div class="xi1">��ʾ: <em>����������Ա���������</em></div>
                    <?php } elseif($needhiddenreply) { ?>
                        <div class="xi1">���������߿ɼ�</div>
                    <?php } elseif($post['first'] && $_G['forum_threadpay']) { ?>
                        <?php include template('forum/viewthread_pay'); ?>                    <?php } else { ?>

                    	<?php if($_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5))) { ?>
                            <div class="xi1">��ʾ: <em>���߱���ֹ��ɾ�� �����Զ����Σ�ֻ�й���Ա���й���Ȩ�޵ĳ�Ա�ɼ�</em></div>
                        <?php } elseif($post['status'] & 1) { ?>
                            <div class="xi1">��ʾ: <em>����������Ա��������Σ�ֻ�й���Ա���й���Ȩ�޵ĳ�Ա�ɼ�</em></div>
                        <?php } ?>
                        <?php if($_G['forum_thread']['price'] > 0 && $_G['forum_thread']['special'] == 0) { ?>
                            ��������, �۸�: <strong><?php echo $_G['forum_thread']['price'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?> </strong> <a href="forum.php?mod=misc&amp;action=viewpayments&amp;tid=<?php echo $_G['tid'];?>" >��¼</a>
                        <?php } ?>

                        <?php if($post['first'] && $threadsort && $threadsortshow) { ?>
                        	<?php if($threadsortshow['optionlist'] && !($post['status'] & 1) && !$_G['forum_threadpay']) { ?>
                                <?php if($threadsortshow['optionlist'] == 'expire') { ?>
                                    ����Ϣ�Ѿ�����
                                <?php } else { ?>
                                    <div class="box box_ex2 viewsort">
                                        <h4><?php echo $_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']];?></h4>
                                    <?php if(is_array($threadsortshow['optionlist'])) foreach($threadsortshow['optionlist'] as $option) { ?>                                        <?php if($option['type'] != 'info') { ?>
                                            <?php echo $option['title'];?>: <?php if($option['value']) { ?><?php echo $option['value'];?> <?php echo $option['unit'];?><?php } else { ?><span class="xg1">--</span><?php } ?><br />
                                        <?php } ?>
                                    <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>


                        <?php if($post['first']) { ?>
                            <?php if(!$_G['forum_thread']['special']) { ?>
                                <div id="postmessage_<?php echo $post['pid'];?>" class="postmessage"><?php echo $post['message'];?></div>
                            <?php } elseif($_G['forum_thread']['special'] == 1) { ?>
                                <?php include template('forum/viewthread_poll'); ?>                            <?php } elseif($_G['forum_thread']['special'] == 2) { ?>
                                <?php include template('forum/viewthread_trade'); ?>                            <?php } elseif($_G['forum_thread']['special'] == 3) { ?>
                                <?php include template('forum/viewthread_reward'); ?>                            <?php } elseif($_G['forum_thread']['special'] == 4) { ?>
                                <?php include template('forum/viewthread_activity'); ?>                            <?php } elseif($_G['forum_thread']['special'] == 5) { ?>
                                <?php include template('forum/viewthread_debate'); ?>                            <?php } elseif($threadplughtml) { ?>
                                <?php echo $threadplughtml;?>
                                <div id="postmessage_<?php echo $post['pid'];?>" class="postmessage"><?php echo $post['message'];?></div>
                            <?php } else { ?>
                            	<div id="postmessage_<?php echo $post['pid'];?>" class="postmessage"><?php echo $post['message'];?></div>
                            <?php } ?>
                        <?php } else { ?>
                            <div id="postmessage_<?php echo $post['pid'];?>" class="postmessage"><?php echo $post['message'];?></div>
                        <?php } if($_G['setting']['mobile']['mobilesimpletype'] == 0) { ?>
                        <?php if($post['attachment']) { ?>
                        	<div class="warning">
                            ����: <em><?php if($_G['uid']) { ?>�����ڵ��û����޷����ػ�鿴����<?php } else { ?>����Ҫ<a href="member.php?mod=logging&amp;action=login">��¼</a>�ſ������ػ�鿴������û���ʺţ�<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" title="ע���ʺ�"><?php echo $_G['setting']['reglinkname'];?></a><?php } ?></em>
                            </div>
                        <?php } elseif($post['imagelist'] || $post['attachlist']) { ?>
                        	<div class="bm_h attach_h">�����б�</div>
                            <?php if($post['imagelist']) { ?>
                                <?php echo showattach($post, 1); ?>                            <?php } ?>
                            <?php if($post['attachlist']) { ?>
                                <?php echo showattach($post); ?>                            <?php } ?>
                        <?php } } ?>
                    <?php } ?>
                    </div>
                </div>

    <?php
$fastreply = <<<EOF


EOF;
 if($_G['uid'] && $allowpostreply) { if($post['first']) { 
$fastreply .= <<<EOF

<a href="forum.php?mod=post&amp;action=reply&amp;fid={$_G['fid']}&amp;tid={$_G['tid']}&amp;reppost={$post['pid']}&amp;page={$page}">�ظ�</a>

EOF;
 } else { 
$fastreply .= <<<EOF

<a href="forum.php?mod=post&amp;action=reply&amp;fid={$_G['fid']}&amp;tid={$_G['tid']}&amp;repquote={$post['pid']}&amp;page={$page}">�ظ�</a>

EOF;
 } } 
$fastreply .= <<<EOF

    
EOF;
?>
    <?php
$modeditpost = <<<EOF


EOF;
 if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid']))) { if($_G['forum_thread']['special'] != 2 || $_G['forum_thread']['special'] != 4 || !$post['first']) { 
$modeditpost .= <<<EOF
<a class="editp" href="forum.php?mod=post&amp;action=edit&amp;fid={$_G['fid']}&amp;tid={$_G['tid']}&amp;pid={$post['pid']}
EOF;
 if($_G['forum_thread']['sortid']) { if($post['first']) { 
$modeditpost .= <<<EOF
&amp;sortid={$_G['forum_thread']['sortid']}
EOF;
 } } if(!empty($_GET['modthreadkey'])) { 
$modeditpost .= <<<EOF
&amp;modthreadkey={$_GET['modthreadkey']}
EOF;
 } 
$modeditpost .= <<<EOF
&amp;page={$page}">�༭</a>
EOF;
 } } 
$modeditpost .= <<<EOF

    
EOF;
?>
    <?php
$modmanage = <<<EOF


EOF;
 if(!$post['first'] && $_G['forum']['ismoderator']) { if($_G['group']['allowwarnpost']) { 
$modmanage .= <<<EOF
<a href="forum.php?mod=topicadmin&amp;action=warn&amp;fid={$_G['fid']}&amp;tid={$_G['tid']}&amp;operation=&amp;optgroup=&amp;page=&amp;topiclist[]={$post['pid']}">����</a><span class="pipe">|</span>
EOF;
 } if($_G['group']['allowbanpost']) { 
$modmanage .= <<<EOF
<a href="forum.php?mod=topicadmin&amp;action=banpost&amp;fid={$_G['fid']}&amp;tid={$_G['tid']}&amp;operation=&amp;optgroup=&amp;page=&amp;topiclist[]={$post['pid']}">����</a><span class="pipe">|</span>
EOF;
 } if($_G['group']['allowdelpost']) { 
$modmanage .= <<<EOF
<a href="forum.php?mod=topicadmin&amp;action=delpost&amp;fid={$_G['fid']}&amp;tid={$_G['tid']}&amp;operation=&amp;optgroup=&amp;page=&amp;topiclist[]={$post['pid']}">ɾ��</a>
EOF;
 } } 
$modmanage .= <<<EOF

    
EOF;
?>
    <?php if(trim($fastreply) || trim($modeditpost) || trim($modmanage)) { ?>
    <div class="box pd2 mbn">
<?php echo $fastreply;?>
<?php echo $modeditpost;?>
<?php echo $modmanage;?>
    </div>
    <?php } ?>
                <!--// postslist end-->
          </div>
        <?php if(!empty($_G['setting']['pluginhooks']['viewthread_postbottom_mobile'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postbottom_mobile'][$postcount];?>
        <?php $postcount++;?>        <?php } ?>
        <?php echo $multipage;?>
    </div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_bottom_mobile'])) echo $_G['setting']['pluginhooks']['viewthread_bottom_mobile'];?>

<?php if($allowfastpost) { ?><div class="mtn editor_box">
  <form method="post" autocomplete="off" id="fastpostform" action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;replysubmit=yes&amp;mobile=yes">
   	  <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
      <?php if($_G['forum_thread']['special'] == 5 && empty($firststand)) { ?>
        <div class="inbox">
        <select id="stand" name="stand" >
            <option value="">ѡ��۵�</option>
            <option value="0">����</option>
            <option value="1">����</option>
            <option value="2">����</option>
        </select>
      </div>
      <?php } ?>
      <div class="inbox"><textarea name="message" id="fastpostmessage" cols="25" rows="3" class="txt"></textarea></div>
      <?php if($secqaacheck || $seccodecheck) { ?>
      <div class="inbox"><?php $sechash = 'S'.random(4);
$sectpl = !empty($sectpl) ? explode("<sec>", $sectpl) : array('<br />',': ','<br />','');
    $ran = random(5, 1);?><?php if($secqaacheck) { $message = '';
$question = make_secqaa();
$secqaa = lang('core', 'secqaa_tips').$question;?><?php } if($sectpl) { if($secqaacheck) { ?>
<p>
        
        <strong>��֤�ʴ�</strong>
        <br />
        <span class="xg2"><?php echo $secqaa;?></span>
<input name="secqaahash" type="hidden" value="<?php echo $sechash;?>" />
        <input name="secanswer" id="secqaaverify_<?php echo $sechash;?>" type="text" class="txt" />
        </p>
<?php } if($seccodecheck) { ?>
    	<p>
<strong>��֤��</strong><br />
        <img src="misc.php?mod=seccode&amp;update=<?php echo $ran;?>&amp;idhash=<?php echo $sechash;?>&amp;mobile=yes&amp;modid=<?php echo $_G['basescript'];?>::<?php echo CURMODULE;?>" />
        <br />
<input name="seccodehash" type="hidden" value="<?php echo $sechash;?>" />
        <input name="seccodeverify" id="seccodeverify_<?php echo $sechash;?>" type="text" autocomplete="off" class="txt" />
        </p>
<?php } } ?></div>
      <?php } ?>
      <div class="inbox"><input type="submit" name="replysubmit" id="fastpostsubmit" value="�ظ�" /></div>
    </form>
</div><?php } include template('common/footer'); ?>