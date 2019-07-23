<?php



// Do not delete these lines

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

		die ('Please do not load this page directly. Thanks!');



	if ( post_password_required() ) { ?>

		<p class="nocomments">非管理员请输入密码查看评论.</p>

	<?php

		return;

	}

?>



<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>



	<h2 class="h2comments"><?php comments_number('竟然有沙发', '只能坐板凳咯', '被% 次践踏' );?> <a href="#respond" class="add Comment">+ 评勒个论</a></h2>



	<ul class="commentlist">

	<?php wp_list_comments('callback=mytheme_comment'); ?>

	</ul>

 <?php else : // this is displayed if there are no comments so far ?>



	<?php if ('open' == $post->comment_status) : ?>

		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>

		<!-- If comments are closed. -->

		<p class="nocomments">Comments are closed.</p>



	<?php endif; ?>

<?php endif; ?>





<?php if ('open' == $post->comment_status) : ?>



<div id="respond">



<h2 id="commentsForm"><?php comment_form_title( '这里好空呀，你可以放点什么的!', 'Leave a comment to %s' ); ?></h2>



<div class="cancel-comment-reply">

	<small><?php cancel_comment_reply_link(); ?></small>

</div>



<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>

<?php else : ?>



<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">



<?php if ( $user_ID ) : ?>



<p>以 <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>身份登录. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">注销登录 &raquo;</a></p>



<?php else : ?>



<p><label for="author">昵称 <?php if ($req) echo "(required)"; ?></label>

<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />

</p>



<p><label for="email">邮箱 (比有关部门还保密的哦！) <?php if ($req) echo "(required)"; ?></label>

<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />

</p>



<p><label for="url">主页</label>

<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />

</p>



<?php endif; ?>





<p><label for="comment">激动践踏中...</label>

<a href='#' onclick='comment_image(); return false;'>貼圖</a>

<?php include(TEMPLATEPATH . '/smiley.php'); ?>

<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"

onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea></p>



<p><input name="submit" type="submit" id="submit" tabindex="5" value="放评论（Ctrl+Enter）" />

<?php comment_id_fields(); ?>

</p>

<?php do_action('comment_form', $post->ID); ?>



</form>



<?php endif; // If registration required and not logged in ?>

</div>



<?php endif; // if you delete this the sky will fall on your head ?>

