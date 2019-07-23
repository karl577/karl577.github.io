<section class="single-post-share">
  <ul class="actions">
    <li>
      <?php if(function_exists('wp_collect')) wp_collect();?>
    </li>
    <!--li><a class="comment-btn J_addCommentBtn" href="javascript:void(0)"><i class="icon icon-comment"></i><span class="comment_total_count"><?php echo $post->comment_count; ?></span></a></li-->
  </ul>
  <div class="single-post-share-list "><span class="mobile-hide">分享到</span><!--hide-external-->
    <div class="share-group"> <a class="weixin mobile-hide" href="javascript:void(0)" ref="nofollow" target="_blank"><i class="icon-weixin"></i>
      <div class="panel-weixin">
        <section class="weixin-section">
          <p><img alt="分享到微信" src="http://s.jiathis.com/qrcode.php?url=<?php the_permalink(); ?>?via=wechat_qr"></p>
        </section>
        <h3>打开微信“扫一扫”，打开网页后点击屏幕右上角分享按钮</h3>
      </div>
      </a> <a class="weibo" href="http://share.baidu.com/s?type=text&amp;searchPic=0&amp;sign=on&amp;to=tsina&amp;url=<?php echo $shareurl; ?>&amp;title=<?php the_title(); ?>" ref="nofollow" target="_blank"><i class="icon-weibo"></i></a> <a class="qq" href="http://connect.qq.com/widget/shareqq/index.html?url=<?php echo get_permalink();?>&amp;title=<?php the_title(); ?>&amp;source=shareqq&amp;desc=刚看到这篇文章不错，推荐给你看看～" ref="nofollow" target="_blank"><i class="icon-qq"></i></a> <a class="twitter external mobile-hide" href="http://share.baidu.com/s?type=text&amp;searchPic=0&amp;sign=on&amp;to=twi&amp;url=<?php echo $shareurl; ?>&amp;title=<?php the_title(); ?>" ref="nofollow" target="_blank"><i class="icon-twitter"></i></a>  <a class="icon-add J_showAllShareBtn" href=""></a></div>
  </div>
</section>
