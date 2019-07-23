<?php
/*
Template Name:内容归档
*/
?>
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
	当前位置：<?php if(function_exists('wp_breadcrumbs')){wp_breadcrumbs();} ?>
	
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
      <?php if(have_posts()):while(have_posts()):the_post(); ?>
	  <div class="list">
       
        
		<div class="contentbox">
          <div class="contenttitle">
            <h1><?php the_title(); ?></h1>
		  </div>
          <div class="clear"></div>
		  <div class="contenttxt">
            <?php the_content(); ?>
		    <div class="archivebox">
		      <h3>最近更新</h3>
              <ul>
              <?php $archive_query=new WP_Query('showposts=80');while($archive_query->have_posts()):$archive_query->the_post(); ?>
		        <li><span><?php the_time('Y-m-d') ?></span><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></li>
              <?php endwhile; ?>
		      </ul>
			  <h3><?php if(get_option('blog_article_nickname')!=""){echo get_option('blog_article_nickname');}else{ ?>内容<?php } ?>分类</h3>
              <ul>
              <?php wp_list_categories('title_li=&sort_column=name&optioncount=1&hierarchical=0&feed=RSS'); ?>
		      </ul>
			  <h3>相关页面</h3>
              <ul>
              <?php wp_list_pages("title_li=" ); ?>
		      </ul>
			  <h3>日期归档</h3>
              <ul>
              <?php wp_get_archives('type=monthly&show_post_count=true'); ?>
		      </ul>
		    </div>
          </div>
        </div>
      </div>
	  <?php endwhile; endif;?>
      <div class="sidebar">
		<?php if(is_dynamic_sidebar())dynamic_sidebar('right_sidebar'); ?>
      </div>
    </div>
  </div>
  <div class="clear"></div>
<?php get_footer(); ?>