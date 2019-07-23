<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('showmessage');?>
<?php if($param['login']) { if($_G['inajax']) { dheader('Location:member.php?mod=logging&action=login&inajax=1&infloat=1');exit;?><?php } else { dheader('Location:member.php?mod=logging&action=login');exit;?><?php } } include template('common/header'); if($_G['inajax']) { ?>
<div class="tip" style="height:150px;">
<dt id="messagetext">
<p><?php echo $show_message;?></p>
        <?php if($_G['forcemobilemessage']) { ?>
        	<p >
            	<a href="<?php echo $_G['setting']['mobile']['pageurl'];?>" class="mtn">继续访问</a><br />
            <a href="javascript:history.back();">返回上一页</a>
        </p>
        <?php } if($url_forward && !$_GET['loc']) { ?>
<!--<p><a class="grey" href="<?php echo $url_forward;?>">点击此链接进行跳转</a></p>-->
<script type="text/javascript">
setTimeout(function() {
window.location.href = '<?php echo $url_forward;?>';
}, '3000');
</script>
<?php } elseif($allowreturn) { ?>
<p><input type="button" class="button" onclick="popup.close();" value="关闭"></p>
<?php } ?>
</dt>
</div>
<?php } else { ?>

<!-- header start -->
<div class="mobile">
<?php if($_G['setting']['domain']['app']['mobile']) { $nav = 'http://'.$_G['setting']['domain']['app']['mobile'];?><?php } else { $nav = "forum.php";?><?php } ?>
<div class="mobile-inner">
<div class="mobile-inner-header" style="background: #F5F5F5;">
<div class="mobile-inner-header-icon mobile-inner-header-icon-out"></div>
<h2>跳转提示</h2>
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
<!-- header end -->

<!-- main jump start -->
<div class="jump_c">
<p><?php echo $show_message;?></p>
    <?php if($_G['forcemobilemessage']) { ?>
<p>
            <a href="<?php echo $_G['setting']['mobile']['pageurl'];?>" class="mtn">继续访问</a><br />
            <a href="javascript:history.back();">返回上一页</a>
        </p>
    <?php } if($url_forward) { ?>
<p><a class="grey" href="<?php echo $url_forward;?>">点击此链接进行跳转</a></p>
<?php } elseif($allowreturn) { ?>
<p><a class="grey" href="javascript:history.back();">[ 点击这里返回上一页 ]</a></p>
<?php } ?>
</div>
<!-- main jump end -->

<?php } include template('common/footer'); ?>