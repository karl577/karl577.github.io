<?php get_header();?>

<div class="row-fluid">
  <div id="main" class="span8 image-preloader">
    <?php include('inc/location.php');?>
    <div class="single single-post">
    <div class="row-fluid">
    <div class="post-author clearfix">
        <figure><?php echo enews_avatar($post->post_author,'140');?></figure>
        <div class="content">
          <h5><?php the_author_posts_link(); ?></h5>
          <p>
            <?php 
		 			if(get_the_author_meta("description") != ""){
		 				the_author_meta("description");
		 			}else{
		 				echo "这家伙很懒，什么都没写！";
		 			}
		 		?>
          </p>
        </div>
      </div>
      </div>
    </div>
    <div class="sep-border margin-top10 margin-bottom10"></div>
    
    <div class="row-fluid blog-posts">
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
      <div class="post clearfix">
        <figure> <img src="<?php echo catch_first_image('medium')?>" alt="<?php the_title_attribute(); ?>" class="enews" /> </figure>
        <div class="content">
          <h2><a href="<?php the_permalink() ?>" title="详细阅读 <?php the_title_attribute(); ?>">
            <?php the_title(); ?>
            </a></h2>
          <div class="meta"> <span class="pull-left"> <i class="icon-user"></i>
            <?php the_author_posts_link(); ?>
            - <i class="icon-time"></i>
            <?php the_time('Y年n月j日') ?>
            - <i class="icon-list"></i>
            <?php the_category(', ') ?>
            - <i class="icon-comment"></i>
            <?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?>
            - <i class="icon-eye-open"></i><?php echo getPostViews(get_the_ID());?>浏览</span> <span class="pull-right label label-info"><a href="<?php the_permalink(); ?>">阅读更多...</a></span> </div>
          <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 290,"...","utf-8"); ?></p>
          <?php if(the_tags()){?>
          <div class="meta"> <span class="info-tag-icon">
            <?php the_tags('标签：', ', ', ''); ?>
            </span> </div>
          <?php }?>
        </div>
        <div class="sep-border"></div>
      </div>
      <?php endwhile; ?>
      <?php else : ?>
      <?php endif; ?>
      <div class="clearfix ie-sep"></div>
      <div class="clearfix ie-sep"></div>
      <?php
	 	 $ad3_close = get_option('ad3_close');
	 	 if ($ad3_close == 'open') {
	?>
      <div  class="k_ad"> <?php echo get_option('ad3');?> </div>
      <?php } ?>
      <nav class="nav-pagination">
        <?php pagination($query_string); ?>
      </nav>
    </div>
  </div>
  <?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>
