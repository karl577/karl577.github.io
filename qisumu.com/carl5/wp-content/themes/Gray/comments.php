<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ('open' == $post->comment_status) : ?>

<div class="media">
	<h4 class="ztbd">发表新的回复</h4>
	<a class="pull-left" href="#">
		<?php echo get_avatar(wt_get_user_id(),$size='50',$default='' ); ?>
	</a>
	<div class="media-body">
	
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<div class="panel panel-default">
	<div class="panel-body">你必须<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">登录</a>才能发表评论.
	</div>
</div>
<?php else : ?>

<form role="form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="comment-form">

<div class="form-group" id="bianxian">
	<textarea name="comment" id="comment-content" class="form-control" rows="3" placeholder="请在此输入评论内容."></textarea>
</div>
<div class="form-inline">
<?php if ( $user_ID ) : ?>

<p><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">登出 &rarr;</a></p>

<?php else : ?>

<div class="form-group">
    <input type="text" class="form-control" id="comment-author" placeholder="名字">
</div>
<div class="form-group">
    <input type="text" class="form-control" id="comment-email" placeholder="Email">
</div>

<?php endif; ?>

<button type="submit" class="btn pinglinanniu">评论</button>
<?php cancel_comment_reply_link('<span class="btn btn-default">取消回复</span>'); ?>
</div>
<?php comment_id_fields(); ?>

<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

</div></div>

<?php if ( have_comments() ) : ?>

	<?php wp_list_comments('type=comment&callback=cleanr_theme_comment'); ?>

	<ul class="pager">
		<li class="previous"><?php previous_comments_link('&larr; 下一页') ?></li>
		<li class="next"><?php next_comments_link('上一页 &rarr;') ?></li>
	</ul>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<div class="panel panel-default">
			<div class="panel-body">
				评论已经关闭.
			</div>
		</div>

	<?php endif; ?>
<?php endif; ?>

<?php endif; // if you delete this the sky will fall on your head ?>