<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('list_6');
block_get('190,191,195,193,194,192');?><?php include template('common/header'); require TPLDIR."/php/list.php";?><?php $list = array();?><?php $wheresql = category_get_wheresql($cat);?><?php $list = category_get_wic_list($cat, $wheresql, $page);?><div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="<?php echo $_G['setting']['navs']['1']['filename'];?>"><?php echo $_G['setting']['navs']['1']['navname'];?></a> <em>&rsaquo;</em><?php if(is_array($cat['ups'])) foreach($cat['ups'] as $value) { ?> <a href="<?php echo $portalcategory[$value['catid']]['caturl'];?>"><?php echo $value['catname'];?></a><em>&rsaquo;</em><?php } ?>
<?php echo $cat['catname'];?>
</div>
</div><?php echo adshow("text/wp a_t");?><style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>

<div id="ct" class="ct2 wp cl">
<div class="mn"><?php echo adshow("articlelist/mbm hm/1");?><?php echo adshow("articlelist/mbm hm/2");?><!--[diy=listcontenttop]--><div id="listcontenttop" class="area"></div><!--[/diy]-->
        <div class="wic_article_focus cl">
            <div class="wic_article_slide">
                <!--[diy=diyarticle_slide]--><div id="diyarticle_slide" class="area"><div id="frameRhlNDo" class="frame move-span cl frame-1"><div id="frameRhlNDo_left" class="column frame-1-c"><div id="frameRhlNDo_left_temp" class="move-span temp"></div><?php block_display('190');?></div></div></div><!--[/diy]-->
            </div>
            <script type="text/javascript">
                jq(".wic_article_slide").slide({ mainCell:".bd ul",titCell:".hd li",delayTime:600,interTime:5000,triggerTime:50,effect:"leftLoop",autoPlay:true,});
                jq(".wic_article_slide").hover(
                    function(){
                        jq(".wic_article_slide .slide-nav").fadeIn();
                    },
                    function(){
                        jq(".wic_article_slide .slide-nav").fadeOut();
                    }
                )
            </script>
            <div class="wic_article_recom">
                <!--[diy=diywic_article_recom]--><div id="diywic_article_recom" class="area"><div id="framelE5e58" class="frame move-span cl frame-1"><div id="framelE5e58_left" class="column frame-1-c"><div id="framelE5e58_left_temp" class="move-span temp"></div><?php block_display('191');?></div></div></div><!--[/diy]-->
            </div>
        </div>
<div class="wic_article mt40">	
        	<h1 class="wic_article_tit"><?php echo $cat['catname'];?></h1>		
<ul class="wic_article_list"><?php if(is_array($list['list'])) foreach($list['list'] as $value) { $highlight = article_title_style($value);?><?php $article_url = fetch_article_url($value);?><li class="cl">
                	<div class="wic_article_box">
                	<?php if($value['pic']) { ?>
                	<div class="wic_article_pic">
                    	<a href="<?php echo $article_url;?>" target="_blank"><img src="<?php echo $value['pic'];?>" alt="<?php echo $value['title'];?>" /></a>
                        <?php if($value['catname'] && $cat['subs']) { ?><span class="wic_article_cate"><a href="<?php echo $portalcategory[$value['catid']]['caturl'];?>"><?php echo $value['catname'];?></a></span><?php } ?>
                    </div>
                    <?php } ?>
                    <div class="wic_articlec" style="<?php if($value['pic']) { ?>width:520px;<?php } else { ?> width:780px;<?php } ?>">
                    	<h3><a href="<?php echo $article_url;?>" target="_blank" <?php echo $highlight;?>><?php echo $value['title'];?></a> <?php if($value['status'] == 1) { ?>(待审核)<?php } ?></h3>
                        <div class="wic_article_summary">
                        	<?php echo $value['summary'];?>
                        </div>
                        <div class="wic_article_info cl">
                        	<span class="wic_article_author"><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" target="_blank"><?php echo avatar($value[uid],small);?><?php echo $value['username'];?></a></span>
                        	<span class="wic_article_time"><i></i><?php echo $value['dateline'];?></span>
                            <span class="wic_article_replies"><i></i><?php echo $value['commentnum'];?></span>
                            <span class="wic_article_views"><i></i><?php echo $value['viewnum'];?></span>
                            <?php if($_G['group']['allowmanagearticle'] || ($_G['group']['allowpostarticle'] && $value['uid'] == $_G['uid'] && (empty($_G['group']['allowpostarticlemod']) || $_G['group']['allowpostarticlemod'] && $value['status'] == 1)) || $categoryperm[$value['catid']]['allowmanage']) { ?>
                            <span class="wic_article_act">
                                <span class="pipe">|</span>
                                <label><a href="portal.php?mod=portalcp&amp;ac=article&amp;op=edit&amp;aid=<?php echo $value['aid'];?>">编辑</a></label>
                                <span class="pipe">|</span>
                                <label><a href="portal.php?mod=portalcp&amp;ac=article&amp;op=delete&amp;aid=<?php echo $value['aid'];?>" id="article_delete_<?php echo $value['aid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a></label>
                            </span>
                            <?php } ?>
                        </div>
                    </div>
                    </div>
</li>
<?php } ?>
</ul>
<!--[diy=listloopbottom]--><div id="listloopbottom" class="area"></div><!--[/diy]-->
</div><?php echo adshow("articlelist/mbm hm/3");?><?php echo adshow("articlelist/mbm hm/4");?><?php if($list['multi']) { ?><div class="pgs mt20 cl"><?php echo $list['multi'];?></div><?php } ?>

<!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]-->

</div>
<div class="sd pph">

<div class="drag">
<!--[diy=diyrighttop]--><div id="diyrighttop" class="area"></div><!--[/diy]-->
</div>
        
        <div class="wic_article_op mb15">
        	<div class="list_ad mb30">
            	<!--[diy=diylist_ad]--><div id="diylist_ad" class="area"><div id="frameMsaAel" class="frame move-span cl frame-1"><div id="frameMsaAel_left" class="column frame-1-c"><div id="frameMsaAel_left_temp" class="move-span temp"></div><?php block_display('195');?></div></div></div><!--[/diy]-->
            </div>
            <div class="wic_article_opc">
                <?php if(($_G['group']['allowpostarticle'] || $_G['group']['allowmanagearticle'] || $categoryperm[$catid]['allowmanage'] || $categoryperm[$catid]['allowpublish']) && empty($cat['disallowpublish'])) { ?>
                <a href="portal.php?mod=portalcp&amp;ac=article&amp;catid=<?php echo $cat['catid'];?>" class="addnew">发布文章</a>
                <?php } ?>
                <?php if($_G['setting']['rssstatus'] && !$_GET['archiveid']) { ?><a href="portal.php?mod=rss&amp;catid=<?php echo $cat['catid'];?>" class="rss mt10" target="_blank" title="RSS">订阅</a><?php } ?>  
            </div>
        </div>
        
        <div class="bm mt30">
        	<div class="bm_h cl">
                <h2><?php echo $tmplang['hot_article'];?></h2>
            </div>
            <div class="wic_article_hot">
            	<div class="wic_article_hot_t">
                	<!--[diy=diywic_article_hot_t]--><div id="diywic_article_hot_t" class="area"><div id="framehwP40d" class="frame move-span cl frame-1"><div id="framehwP40d_left" class="column frame-1-c"><div id="framehwP40d_left_temp" class="move-span temp"></div><?php block_display('193');?></div></div></div><!--[/diy]-->
                </div>
                <div class="wic_article_hot_b">
                	<!--[diy=diywic_article_hot_b]--><div id="diywic_article_hot_b" class="area"><div id="frameMBJa1p" class="frame move-span cl frame-1"><div id="frameMBJa1p_left" class="column frame-1-c"><div id="frameMBJa1p_left_temp" class="move-span temp"></div><?php block_display('194');?></div></div></div><!--[/diy]-->
                </div>
            </div>
        </div>
        
        <div class="bm mt30">
            <div class="bm_h">
                <h2><?php echo $tmplang['hot_recommend'];?></h2>
            </div>
            <div class="wic_hot_recommend">
                <!--[diy=diywic_hot_recommend]--><div id="diywic_hot_recommend" class="area"><div id="frameuwGECw" class="frame move-span cl frame-1"><div id="frameuwGECw_left" class="column frame-1-c"><div id="frameuwGECw_left_temp" class="move-span temp"></div><?php block_display('192');?></div></div></div><!--[/diy]-->
            </div>
        </div>
        
        <?php if($cat['subs']) { ?>
        <div class="bm mt30">
        	<div class="bm_h cl">
                <h2>下级分类</h2>
            </div>
            <div class="wic_list_relate bm_c">
            	<ul class="cl">
                <?php if(is_array($cat['subs'])) foreach($cat['subs'] as $value) { ?><li><a href="<?php echo $portalcategory[$value['catid']]['caturl'];?>" class="xi2"><?php echo $value['catname'];?></a></li>
                <?php } ?>
                </ul>
            </div>
        </div>
        <?php } ?>

        <?php if($cat['others']) { ?>
        <div class="bm mt30">
            <div class="bm_h cl">
                <h2>相关分类</h2>
            </div>
            <div class="wic_list_relate bm_c">
                <ul class="cl">
                    <?php if(is_array($cat['others'])) foreach($cat['others'] as $value) { ?>                    <li><a href="<?php echo $portalcategory[$value['catid']]['caturl'];?>"><?php echo $value['catname'];?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php } ?>

<div class="drag">
<!--[diy=diy2]--><div id="diy2" class="area"></div><!--[/diy]-->
</div>

</div>
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div><?php include template('common/footer'); ?>