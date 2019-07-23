<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('tag');?><?php include template('common/header'); require TPLDIR."/php/tag.php";?><div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a><em>&raquo;</em>标签
</div>
</div>
<?php if($type != 'countitem') { ?>
<div id="ct" class="wp cl">
<div class="mn">
        <div class="tag mb15">
            <form method="post" action="misc.php?mod=tag" class="tag_search">
                <input type="text" name="name" class="px vm" size="30" />&nbsp;
                <button type="submit" class="pn vm"><em>搜索</em></button>
            </form>
            <div class="taglist mtm mbm cl">
                <?php if($tagarray) { ?>
                	<ul>
                    <?php if(is_array($tagarray)) foreach($tagarray as $tag) { ?>                        <li><a href="misc.php?mod=tag&amp;id=<?php echo $tag['tagid'];?>" title="<?php echo $tag['tagname'];?>" target="_blank"><?php echo $tag['tagname'];?></a></li>
                    <?php } ?>
                    </ul>
                <?php } else { ?>
                    <p class="emp">还没有任何标签</p>
                <?php } ?>
            </div>
        </div>
</div>
    <div class="sd">
    	<div class="wic_hottag mb15">
        	<div class="wic_stit cl">
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
</div>
<?php } else { ?>
<?php echo $num;?>
<?php } include template('common/footer'); ?>