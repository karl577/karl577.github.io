<footer class="common-footer"><?php $options = get_option('monkey-options');?>
  <div class="sections">
  	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-footer')) : endif; ?>
    <section class="qr-section"> <img class="qr" src="<?php if($options['weixin']){ echo $options['weixin'];} else{ echo get_bloginfo("template_url").'/static/img/qrcode.jpg'; }?>" alt="微信">
      <div>奇书目微信公众平台</div>
    </section>
  </div>
  <div class="bottom">
    <div class="container">
        <div style="color: #5d5c60; position: absolute; top:1px;">
        Copyright © 2016 奇书目个人收集网站 | 蒙ICP备16003498号 | 联系邮箱：wuhongliang@carl5.com
        </div>
    </div>
      <div class="share"> 
      <?php if($options['sinawb']){?>
      <a class="icon-weibo" rel="nofollow" href="<?php echo $options['sinawb'];?>"></a> 
      <?php }?>
      <?php if($options['twitter']){?>
      <a class="icon-twitter" rel="nofollow" href="<?php echo $options['twitter'];?>"></a> 
      <?php }?>
      <?php if($options['facebook']){?>
      <a class="icon-facebook" rel="nofollow" href="<?php echo $options['facebook'];?>"></a>
      <?php }?>
      <?php if($options['feedrrs']){?> 
      <a class="icon-rss" rel="nofollow" href="<?php echo $options['feedrrs'];?>"></a> 
      <?php }?>
      </div>
    </div>
  </div>
</footer>
<div class="fixed-tools J_fixedTools show">
	<?php if($options['weixin']){?><a class="icon-qr" href="javascript:void(0)"><span class="qr"><img alt="微信" src="<?php if($options['weixin']){ echo $options['weixin'];} else{ echo get_bloginfo("template_url").'/static/img/qrcode.jpg'; }?>" /></span></a><?php }?>
	<a class="icon-arrow-up J_up" href="javascript:void(0)"></a>
</div>
<?php if(!is_user_logged_in()) get_template_part('modules/loginBox');?>
<?php wp_footer();?>
<div style="display:none"><?php echo $options['analysis'];?></div>
</body>
</html>
