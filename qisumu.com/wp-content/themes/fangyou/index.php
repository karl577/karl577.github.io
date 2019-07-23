<?php get_header(); ?>
<div class="position">
    <div class="common">
       <div class="weibo">
  <a href="<?php echo get_option('blog_tencentweibo'); ?>" title="腾讯微博" rel="external nofollow" target="_blank">腾讯微博</a>
       </div>
    <div class="qun">
  <a href="<?php echo get_option('blog_sinaweibo'); ?>" title="新浪微博" rel="external nofollow" target="_blank">新浪微博</a>
       </div>
    <div class="contact">
  <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo get_option('blog_qq'); ?>&site=qq&menu=yes" title="联系站长" rel="external nofollow" target="_blank">联系站长</a>
       </div>
    <div class="feed">
  <a href="<?php echo get_option('blog_rss'); ?>" title="订阅本站" rel="external nofollow" target="_blank">订阅本站</a>
       </div>
    <div class="counts">
	运行天数：<span><?php echo floor((time()-strtotime("2013-8-18"))/86400); ?></span>
	日志总数：<span><?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?> </span>
	标签总数：<span><?php echo wp_count_terms('post_tag');?></span>
	分类总数：<span><?php echo wp_count_terms('category');?></span>
	评论总数：<span><?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");?></span>
	用户总数：<span><?php $users = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users"); echo $users; ?></span>
	
	</div>
    <div class="search">
  <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <input class="searchtxt" name="s" id="s" type="text" value="请输入搜索关键词..." onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
            <button class="searchbtn" id="searchsubmit" title="站内搜索">搜索</button>
          </form>
    </div>
</div>
<div class="clear"></div>
<div class="bodybox">
  <div class="main">
    <div class="common">
      <div class="list">
        <?php if(is_home()&&!is_paged()){ ?>
		<div class="sliderbox">
          <div class="slideshow">
		    <ul>
              <?php if(get_option('blog_slider_img1')!=""){ ?>
		      <li><a href="<?php echo get_option('blog_slider_url1'); ?>" title="<?php echo get_option('blog_slider_txt1'); ?>" target="_blank"><img src="<?php echo get_option('blog_slider_img1'); ?>" alt="<?php echo get_option('blog_slider_txt1'); ?>" width="860" height="359" /></a></li>
		      <?php } ?>
              <?php if(get_option('blog_slider_img2')!=""){ ?>
		      <li><a href="<?php echo get_option('blog_slider_url2'); ?>" title="<?php echo get_option('blog_slider_txt2'); ?>" target="_blank"><img src="<?php echo get_option('blog_slider_img2'); ?>" alt="<?php echo get_option('blog_slider_txt2'); ?>" width="860" height="359" /></a></li>
		      <?php } ?>
              <?php if(get_option('blog_slider_img3')!=""){ ?>
		      <li><a href="<?php echo get_option('blog_slider_url3'); ?>" title="<?php echo get_option('blog_slider_txt3'); ?>" target="_blank"><img src="<?php echo get_option('blog_slider_img3'); ?>" alt="<?php echo get_option('blog_slider_txt3'); ?>" width="860" height="359" /></a></li>
		      <?php } ?>
              <?php if(get_option('blog_slider_img4')!=""){ ?>
		      <li><a href="<?php echo get_option('blog_slider_url4'); ?>" title="<?php echo get_option('blog_slider_txt4'); ?>" target="_blank"><img src="<?php echo get_option('blog_slider_img4'); ?>" alt="<?php echo get_option('blog_slider_txt4'); ?>" width="860" height="359" /></a></li>
		      <?php } ?>
              <?php if(get_option('blog_slider_img5')!=""){ ?>
		      <li><a href="<?php echo get_option('blog_slider_url5'); ?>" title="<?php echo get_option('blog_slider_txt5'); ?>" target="_blank"><img src="<?php echo get_option('blog_slider_img5'); ?>" alt="<?php echo get_option('blog_slider_txt5'); ?>" width="860" height="359" /></a></li>
		      <?php } ?>
              <?php if(get_option('blog_slider_img6')!=""){ ?>
		      <li><a href="<?php echo get_option('blog_slider_url6'); ?>" title="<?php echo get_option('blog_slider_txt6'); ?>" target="_blank"><img src="<?php echo get_option('blog_slider_img6'); ?>" alt="<?php echo get_option('blog_slider_txt6'); ?>" width="860" height="359" /></a></li>
		      <?php } ?>
            </ul>
		    <a href="javascript:;" class="btnprev"></a><a href="javascript:;" class="btnnext"></a>
          </div>
        </div>
		<div class="toppostbox">
		 <ul>
		    <?php
$post_num = 5; 
$args = array(
      ‘post_password’ => ”,
   ‘post_status’ => ‘publish’, // 只选公开的文章.
   ‘post__not_in’ => array($post->ID),//排除当前文章
   ‘caller_get_posts’ => 1, // 排除置頂文章.
   ‘orderby’ => ‘comment_count’, // 依評論數排序.
   ‘posts_per_page’ => $post_num
);
 $query_posts = new WP_Query();
 $query_posts->query($args);
 while( $query_posts->have_posts() ) { $query_posts->the_post(); ?>
		    <li>
			 <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><?php if(has_post_thumbnail()){ ?><?php the_post_thumbnail(‘second’); ?><?php }else{ ?><img src="<?php bloginfo('template_url'); ?>/images/nopic.jpg" alt="<?php the_title(); ?>" width="86" height="55" /><?php } ?></a>
		     <div class="toppostinfo">
			  <div class="topposttitle"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></div>
		      <div class="toppostdate">日期：<?php the_time('Y-m-d') ?></div>
              <div class="tooppostdate">浏览：<?php echo getPostViews(get_the_ID()); ?>   评论：<?php comments_number('0','1','%');?></div>
		     </div>
		    </li>	
			<?php } wp_reset_query();?>   
		 </ul>
		</div>
        <?php } ?>
		
		<div class="articlebox">
          <ul>
            <?php global $query_string;query_posts($query_string.'&ignore_sticky_posts=1');$postnun=1;if(have_posts()):while(have_posts()):the_post();?>
			<li class="articlelist">
              <div class="thumbnail"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><?php if(has_post_thumbnail()){ ?><?php the_post_thumbnail('thumbnail'); ?><?php }else{ ?><img src="<?php bloginfo('template_url'); ?>/images/nopic.jpg" alt="<?php the_title(); ?>" width="260" height="165" /><?php } ?></a></div>
			  <div class="summary">
			    <div class="summarytxt">
                <span><?php the_excerpt(); ?></span>
				<a href="<?php the_permalink() ?>" class="now">&nbsp;</a>
				</div>
              </div>
              <div class="tilte">
                <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></h2>
                <?php if(is_sticky()){ ?><span>推荐</span><?php } ?>
              </div>
			  <div class="tag"><?php the_tags('','',''); ?></div>
              <div class="info">
                
                <div class="date"><?php the_time('Y-m-d') ?></div>
                <div class="view"><?php echo getPostViews(get_the_ID()); ?></div>
                <div class="comment"><?php comments_number('0','1','%');?></div>
              </div>
              
              
            </li>
			<?php $postnun++; endwhile; else: ?>
			<li class="articlelist">
			  <div class="nothing">抱歉，暂无相关<?php if(get_option('blog_article_nickname')!=""){echo get_option('blog_article_nickname');}else{ ?>内容<?php } ?>！</div>
			</li>
			<?php endif; ?>
          </ul>
          <?php par_pagenavi(); ?>
        </div>
      </div>
      
    </div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>