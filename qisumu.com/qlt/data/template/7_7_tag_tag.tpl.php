<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('tag');?><?php include template('common/header'); if($type != 'countitem') { ?>
<div id="ct" class="wp cl">
<h1 class="mt"><img class="vm" src="<?php echo IMGDIR;?>/tag.gif" alt="tag" /> ��ǩ</h1>
<div class="bm">
<div class="bm_c">
<form method="post" action="misc.php?mod=tag" class="pns">
<input type="text" name="name" class="px vm" size="30" />&nbsp;
<button type="submit" class="pn vm"><em>����</em></button>
</form>
<div class="taglist mtm mbm">
<?php if($tagarray) { if(is_array($tagarray)) foreach($tagarray as $tag) { ?><a href="misc.php?mod=tag&amp;id=<?php echo $tag['tagid'];?>" title="<?php echo $tag['tagname'];?>" target="_blank" class="xi2"><?php echo $tag['tagname'];?></a>
<?php } } else { ?>
<p class="emp">��û���κα�ǩ</p>
<?php } ?>
</div>
</div>
</div>
</div>
<?php } else { ?>
<?php echo $num;?>
<?php } include template('common/footer'); ?>