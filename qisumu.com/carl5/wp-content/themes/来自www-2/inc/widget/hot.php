<div class="widget clearfix">
  <div class="enews-tab">
    <ul class="nav nav-tabs" id="enewsTabs">
      <li class="active"><a href="#tab-populars" data-toggle="tab">最新文章</a></li>
      <li><a href="#tab-recents" data-toggle="tab">随机文章</a></li>
      <li><a href="#tab-comments" data-toggle="tab">热门文章</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab-populars">
        <?php $rand_posts = get_posts('numberposts=5&orderby=date');foreach($rand_posts as $post) : ?>
        <div class="item">
          <figure class="pull-left"><img src="<?php echo catch_first_image('medium')?>" alt="<?php the_title_attribute(); ?>" /></figure>
          <div class="pull-right content">
            <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
              <?php the_title(); ?>
              </a></h4>
            <p class="meta"><?php echo getPostViews(get_the_ID());?>&nbsp;<i class="icon-eye-open"></i>&nbsp;|&nbsp;
              <?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?>
              &nbsp;<i class="icon-comment"></i></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="tab-pane" id="tab-recents">
        <?php $rand_posts = get_posts('numberposts=5&orderby=rand');foreach($rand_posts as $post) : ?>
        <div class="item">
          <figure class="pull-left"><img src="<?php echo catch_first_image('medium')?>" alt="<?php the_title_attribute(); ?>" /></figure>
          <div class="pull-right content">
            <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
              <?php the_title(); ?>
              </a></h4>
            <p class="meta"><?php echo getPostViews(get_the_ID());?>&nbsp;<i class="icon-eye-open"></i>&nbsp;|&nbsp;
              <?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?>
              &nbsp;<i class="icon-comment"></i></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="tab-pane" id="tab-comments">
        <?php
$post_num = 5; // 设置调用条数
$args = array(
      'post_password' => '',
          'post_status' => 'publish', // 只选公开的文章.
          'post__not_in' => array($post->ID),//排除当前文章
          'caller_get_posts' => 1, // 排除置頂文章.
          'orderby' => 'comment_count', // 依評論數排序.
          'posts_per_page' => $post_num
);
        $query_posts = new WP_Query();
        $query_posts->query($args);
        while( $query_posts->have_posts() ) { $query_posts->the_post(); ?>
        <div class="item">
          <figure class="pull-left"><img src="<?php echo catch_first_image('medium')?>" alt="<?php the_title_attribute(); ?>" /></figure>
          <div class="pull-right content">
            <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
              <?php the_title(); ?>
              </a></h4>
            <p class="meta"><?php echo getPostViews(get_the_ID());?>&nbsp;<i class="icon-eye-open"></i>&nbsp;|&nbsp;
              <?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?>
              &nbsp;<i class="icon-comment"></i></p>
          </div>
        </div>
        <?php } wp_reset_query();?>
      </div>
    </div>
  </div>
</div>
