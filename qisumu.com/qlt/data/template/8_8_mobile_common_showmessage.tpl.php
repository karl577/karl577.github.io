<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('showmessage');?><?php include template('common/header'); ?><div class="f_c">
<div id="messagetext">
<p><?php echo $show_message;?></p>
        <?php if($_G['forcemobilemessage']) { ?>
        	<p >
            	<a href="<?php echo $_G['setting']['mobile']['pageurl'];?>" class="mtn">��������</a><br />
                <a href="javascript:history.back();">������һҳ</a>
            </p>
        <?php } if($url_forward) { ?>
<p><a href="<?php echo $url_forward;?>">��������ӽ�����ת</a></p>
<?php } elseif($allowreturn) { ?>
<p><a href="javascript:history.back();">[ ������ﷵ����һҳ ]</a></p>
<?php } ?>
</div>
</div><?php include template('common/footer'); ?>