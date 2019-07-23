<?php get_header(); ?>
<div id="content">
<div class="atop">
<div class="inavt clr"><div class="l"><?php get_inavt(); ?></div><div class="r"><span class="weixin" id="viewReInfo" title="DSUU微信公共帐号">添加微信</span></div></div>
<div class="ibdfx">广告</div>
<div id="receiptInfo" class="receiptInfo">
<p><img src="http://www.dsuu.cc/wp-content/themes/twentytwelve/images/wx.jpg" width="258" height="258" alt="微信"></p>
<p>使用微信“扫一扫”添加本站微信帐号</p>
<p>每天为您推送 好看的 好玩的 好笑的 优质资讯</p>
</div>
<div id="container" class="clr">
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'sy', get_post_format() ); ?>
<?php endwhile; ?>
<?php else : ?>
<p>找不到你要找的内容</p>
<?php endif; ?>
</div>
<div id="navigation" class="navigation clr"><?php pagenavi(); ?></div>
</div>
</div>
<?php get_footer(); ?>