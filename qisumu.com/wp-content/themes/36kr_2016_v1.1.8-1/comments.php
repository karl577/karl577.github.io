<?php
defined('ABSPATH') or die('This file can not be loaded directly.');

global $comment_ids; $comment_ids = array();
foreach ( $comments as $comment ) {
	if (get_comment_type() == "comment") {
		$comment_ids[get_comment_id()] = ++$comment_i;
	}
} 

if ( !comments_open() ) return;

$my_email = get_bloginfo ( 'admin_email' );
$str = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_approved = '1' AND comment_type = '' AND comment_author_email";
$count_t = $post->comment_count;

date_default_timezone_set(PRC);
$closeTimer = (strtotime(date('Y-m-d G:i:s'))-strtotime(get_the_time('Y-m-d G:i:s')))/86400;
?>
<section class="single-post-comment" id="respond">
    <h2>参与讨论(<span class="comment_form_count"><?php echo $count_t; ?></span>)</h2>
    <div class="single-post-comment-reply" >
      <?php if ( get_option('comment_registration') && !is_user_logged_in() ) { ?>
      <div class="bottom">
        <div class="meta left cf"><a class="login_before_comment" href="#">登录</a>后参与讨论</div>
      </div>
      <?php }else{?>
      <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" class="comment_form" data-remote="true" method="post" >
          <div class="single-post-comment__form cf">
              <textarea class="textarea" data-widearea="enable" id="post" name="comment" placeholder="请登陆后参与评论？"></textarea>
              <?php comment_id_fields(); do_action('comment_form', $post->ID); ?>
          </div>
          <div class="bottom">
              <div class="meta">
                <span class="avatar" style="background-image: url('<?php echo MBT_monkey_get_avatar(get_current_user_id())?>')"></span>
                <span><a href="javascript:void(0)"><?php echo wp_get_current_user()->display_name?></a></span>
                <span id="error_msg" style="color:#f00; margin-left:15px;"></span>
              </div>
              <button type="submit" class="ladda-button comment-submit-btn right" data-style="slide-down"><span class="ladda-label">提交评论</span></button>
          </div>
      </form>
      <?php }?>
      
    </div>
    <hr>
    <div class="single-post-comment__comments" style="display: block;">
      <div class="comments_total_count" data-message="" data-total-count="<?php echo $count_t; ?>"></div>
      <ul>
      <?php wp_list_comments('type=comment&callback=monkey_comment_list') ?>
      </ul>
      <div class="comment-pagenav">
		<?php paginate_comments_links('prev_next=0');?>
      </div>
    </div>
</section>
