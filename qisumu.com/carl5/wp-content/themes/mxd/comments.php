<?php // Do not delete these lines

	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

		die ('Please do not load this page directly. Thanks!');



        if (!empty($post->post_password)) { // if there's a password

            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie

				?>

				

				<p class="nocomments">This post is password protected. Enter the password to view comments.<p>

				

				<?php

				return;

            }

        }



		/* This variable is for alternating comment background */

		$oddcomment = 'alt';

?>



<!-- You can start editing here. -->



<?php if ($comments) : ?>

	<h3 id="comments"><?php comments_number('没有评论', '1 条评论', '% 条评论' );?></h3> 



	<ol class="commentlist">



	<?php foreach ($comments as $comment) : ?>



		<li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
<div class="comment-author vcard">
			<?php 
   echo get_avatar( $comment->comment_author_email, $size = '32' ); 
   ?>	
			<cite class="fn"><?php comment_author_link() ?></cite>  <span class="says">说：</span></div>

			<?php if ($comment->comment_approved == '0') : ?>

			<em>Your comment is awaiting moderation.</em>

			<?php endif; ?>
<div class="comment-meta commentmetadata">	
			<span style="color:#727272"><?php comment_date('Y年m月d日') ?> 于 <?php comment_time('h:m') ?> </span></div>



			<div id="comment_text"><?php comment_text() ?></div>



		</li>



	<?php /* Changes every other comment to a different class */	

		if ('alt' == $oddcomment) $oddcomment = '';

		else $oddcomment = 'alt';

	?>



	<?php endforeach; /* end for each comment */ ?>



	</ol>



 <?php else : // this is displayed if there are no comments so far ?>



  <?php if ('open' == $post->comment_status) : ?> 

		<!-- If comments are open, but there are no comments. -->

		

	 <?php else : // comments are closed ?>

		<!-- If comments are closed. -->

		<p class="nocomments">Comments are closed.</p>

		

	<?php endif; ?>

<?php endif; ?>





<?php if ('open' == $post->comment_status) : ?>



<h3 id="respond"><span style="color:#717171;">留下回复</h3>



<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged in</a> to post a comment.</p>

<?php else : ?>



<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">



<?php if ( $user_ID ) : ?>



<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a></p>



<?php else : ?>



<p><input class="input_text name" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />

<label for="author"><small>名称<?php if ($req) echo "(必须)"; ?></small></label></p>



<p><input class="input_text email" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />

<label for="email"><small>邮件地址<?php if ($req) echo "(不会被公开) (必须)"; ?></small></label></p>



<p><input class="input_text weburl" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />

<label for="url"><small>网站</small></label></p>



<?php endif; ?>

<p><?php if ( function_exists(cs_print_smilies) ) {cs_print_smilies();} ?></p>

<p><textarea name="comment" id="comment" cols="50" rows="6" tabindex="6" class="commenttextarea"></textarea></p>  



<p><input class="input_submit" name="submit" type="submit" id="submit" tabindex="5" value="" />

<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />

</p>

<?php do_action('comment_form', $post->ID); ?>



</form>



<?php endif; // If registration required and not logged in ?>



<?php endif; // if you delete this the sky will fall on your head ?>





<p>&nbsp;</p>
<p><span style="color:#a9a9a9;">评论前请注意：</span></p>
<p><span style="color:#a9a9a9;">若您喜欢这篇文章请点击文章正下方的【喜欢】与好友共同分享，也给予我们支持及鼓励；</span></p>
<p><span style="color:#a9a9a9;">请尽量登陆后再发表评论，若未登录，请正确填写您的邮箱及网址，我们会定期回访；</span></p>
<p><span style="color:#a9a9a9;">禁止发布一切AD广告，一经发现立即删除账号并永久屏蔽您的IP；</span></p>
<p><span style="color:#a9a9a9;">如有一切有关ATT的合作，请联系@君常在 QQ408999305 (验证请说明ATT合作)；</span></p>
<p><span style="color:#a9a9a9;">请务必遵守ATT版权版规及以上1、2、3点注意事项，谢谢合作。</span></p>