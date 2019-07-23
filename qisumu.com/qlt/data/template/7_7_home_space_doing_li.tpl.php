<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if($list) { ?>
<ul><?php if(is_array($list)) foreach($list as $value) { if($value['uid']) { ?>
<li class="ptn pbn<?php echo $value['class'];?>" style="<?php echo $value['style'];?>">
<a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" class="lit"><?php echo $value['username'];?></a>: <?php echo $value['message'];?> <span class="xg1">(<?php echo dgmdate($value['dateline'], 'n-j H:i');?>)</span>
<?php if($_G['uid'] && helper_access::check_module('doing')) { ?>
<a href="javascript:;" onclick="docomment_form(<?php echo $value['doid'];?>, <?php echo $value['id'];?>, '<?php echo $_GET['key'];?>');">»Ø¸´</a>
<?php } if($value['uid']==$_G['uid'] || $dv['uid']==$_G['uid'] || checkperm('managedoing')) { ?>
 <a href="home.php?mod=spacecp&amp;ac=doing&amp;op=delete&amp;doid=<?php echo $value['doid'];?>&amp;id=<?php echo $value['id'];?>&amp;handlekey=doinghk_<?php echo $value['doid'];?>_<?php echo $value['id'];?>" id="<?php echo $_GET['key'];?>_doing_delete_<?php echo $value['doid'];?>_<?php echo $value['id'];?>" onclick="showWindow(this.id, this.href, 'get', 0);">É¾³ý</a>
<?php } if(checkperm('managedoing')) { ?>
<span class="xg1 xw0">IP: <?php echo $value['ip'];?></span>
<?php } ?>
<div id="<?php echo $_GET['key'];?>_form_<?php echo $value['doid'];?>_<?php echo $value['id'];?>"></div>
</li>
<?php } } ?>
</ul>
<?php } ?>
<div class="tri"></div>