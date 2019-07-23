<?php
        if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])){
            die ('请不要直接加载该页面，谢谢！');        
        }
    ?>
<?php if ( comments_open() ) : ?>

<div id="respond" class="respond">
  <div id="reply-box">
    <div class="r-inbox top">
      <div class="arrow"></div>
      <div class="r-inbox-title"><span id="reply-text">回复</span> <span id="reply-name"></span><a id="r-close" href="javascript:;">取消</a></div>
      <div class="r-inbox-content" id="reply-content"></div>
    </div>
  </div>
  <form method="post" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" id="comment_form">
    <div class="r-submit2">
      <?php if ( is_user_logged_in() ) : ?>
      <p>
        <?php _e('登录身份：'); ?>
        <?php printf(__('<a href="%1$s">%2$s</a>，'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account'); ?>">
        <?php _e('退出  &raquo;'); ?>
        </a></p>
      <?php else: ?>
      <p>
        <label for="author" class="required">
          <?php _e('昵称'); ?>
        </label>
        <input type="text" name="author" id="author" class="text" placeholder="name" value="<?php echo $comment_author; ?>" required/>
      </p>
      <p>
        <label for="mail" class="required">
          <?php _e('邮箱'); ?>
        </label>
        <input type="email" name="email" id="mail" class="text" placeholder="name@example.com" value="<?php echo $comment_author_email; ?>" required/>
      </p>
      <p>
        <label for="url">
          <?php _e('网站'); ?>
        </label>
        <input type="url" name="url" id="url" class="text" placeholder="http://example.com/" value="<?php echo $comment_author_url; ?>" />
      </p>
      <?php endif; ?>
    </div>
    <div class="r-submit1">
      <div class="comt_loading">
        <div></div>
      </div>
      <textarea rows="8" cols="50" name="comment" id="comment"class="textarea" required></textarea>
      <div class="clearfix margin-top10"></div>
      <button type="submit" name="submit" class="submit">
      <?php _e('提交评论'); ?>
      </button>
    </div>
    <div class="clear"></div>
    <?php comment_id_fields(); ?>
    <?php do_action('comment_form', $post->ID); ?>
  </form>
</div>
<?php endif; ?>
<div class="sep-border"></div>
<?php if ( have_comments() ) : ?>
<h3 class="widget-title">
  <?php comments_popup_link('暂无评论', '仅有 1 条评论', '已有 % 条评论'); ?>
</h3>
<ol class="comment-list">
  <?php wp_list_comments('type=comment&callback=inlo_comment'); ?>
</ol>
<div class="pagenav">
  <?php paginate_comments_links('prev_next=0');?>
</div>
<?php else : ?>
<?php if ('open' != $post->comment_status) : ?>
<div class="close-comt">
  <p>噢！评论已关闭。</p>
</div>
<?php endif; ?>
<?php endif; ?>
