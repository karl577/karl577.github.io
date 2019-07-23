<?php get_header();?>
<div class="article-detail-wrap">
  <div class="main-section" style="position: relative;">
    <div class="content-wrapper">
      <?php while (have_posts()) : the_post(); ?>
      <article class="single-post">
      
        <div class="post-share">
	<a href="#top" class="read-clean show"> <i class="icon2-read" title="阅读模式"></i> </a>
   <a href="http://service.weibo.com/share/share.php?url=<?php echo get_permalink();?>&title=【<?php the_title(); ?>】<?php echo mb_strimwidth( mbthemes_strip_tags( $post->post_content ), 0, "150","...")?>&type=button&language=zh_cn&appkey=<?php echo $options['weiboappkey'] ? $options['weiboappkey'] : '3743008804'?>&searchPic=true&style=number" class="long-weibo" target="_blank"><i class="icon icon-article icon-article-wb js-weibo js-share-article" data-location="article" data-f="pc-weibo-article" aid="138204"></i><i class="icon-weibo"></i></a>
   
    <a href="javascript:;" class="btn-weixin"  title="打开微信"扫一扫"" data-src="http://s.jiathis.com/qrcode.php?url=<?php echo get_permalink();?>?via=wechat_qr"> 
    	<i class="icon-weixin"></i> 
    	<div class="weixin-share">
    		<img src="http://s.jiathis.com/qrcode.php?url=<?php the_permalink(); ?>?via=wechat_qr" id="wx-share">
    		<p>扫一扫，分享到微信</p>
    	</div>
    </a>
    <a target="_blank" rel="nofollow" href="http://connect.qq.com/widget/shareqq/index.html?url=<?php echo get_permalink();?>&amp;title=<?php the_title(); ?>&amp;source=shareqq&amp;desc=刚看到这篇文章不错，推荐给你看看～"><i class="icon-qq"></i></a>
    <a href="#tops" class="return-top"> <i class="icon2-up" title="返回顶部"></i> </a>
</div>

        <section class="single-post-header">
          <header class="single-post-header__meta">
            <h1 class="single-post__title"><?php the_title(); ?></h1>
          </header>
          <div class="author single-post-meta">
          	<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><span class="avatar before-fade-in after-fade-in" style="background-image: url(<?php echo MBT_monkey_get_avatar(get_the_author_meta( 'ID' ));?>);"></span><span class="name"><?php echo get_the_author() ?></span></a>
          	<span class="item"><?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ) ?></span>
            <span class="item"><?php monkey_views('浏览') ?></span>
			<?php edit_post_link('[编辑]'); ?>
          </div>
        </section>
        <br>
        <section class="article">
          <?php the_content(); ?>
        </section>
        <section class="ad">
          
        </section>
        <?php if($options['share']) include('modules/singlePostShare.php');?>
         <div class="article_tags">
                	
                    <div class="tagcloud">
                    	<?php the_tags('',' ','');?>
                    </div>
      </article>
      <?php endwhile;  ?>
     
      <?php if($options['singlead']){?><section class="ad ad-single mobile-hide"><?php echo $options['singlead'];?></section><?php }?>
      <?php if($options['relate']) include('modules/singlePostRelate.php');?>
      <?php comments_template('', true); ?><a name="top"></a>
    </div>
  
  </div>	  <?php get_sidebar();?>

</div>
<?php get_footer();?>
