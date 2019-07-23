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

<?php if ( have_comments() ) : ?>
	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=cleanr_theme_comment'); ?>
	</ol>

	<div class="comment-navigation">
		<div class="alignleft"><?php previous_comments_link('&larr; Older Comments') ?></div>
		<div class="alignright"><?php next_comments_link('Newer Comments &rarr;') ?></div>
		<div style="clear:both;"></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">评论已经关闭.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h3><?php comment_form_title( '发表评论', 'Leave your reply to %s' ); ?></h3>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>你必须<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">登录</a>才能发表评论.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>当前账户： <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">登出 &rarr;</a></p>

<?php else : ?>

<p class="ng"><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /><label for="author">名字 <?php if ($req) echo "<span>*</span>"; ?></label>
</p>

<p class="ng"><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /><label for="email">Email <?php if ($req) echo "<span>*</span>"; ?></label>
</p>

<p class="ng"><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /><label for="url">网址</label>
</p>

<?php endif; ?>

<div class="c"></div>

<p><label for="comments"></label><textarea name="comment" id="commentarea" class="inpcom" cols="70" rows="10" tabindex="4"></textarea></p>

<input name="submit" type="submit" id="submit" class="cbg alinfoc<?php echo(rand(1,9)); ?>" tabindex="5" value="提 交" />
<?php comment_id_fields(); ?>

<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>