<div id="comments">

	<?php if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>
	    <?php die('貌似你做了些不该做的……Big brother is watching you！'); ?>
	<?php endif; ?>
	<?php if(!empty($post->post_password)) : ?>
	    <?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
	    <?php endif; ?>
	<?php endif; ?>
	<?php $i++; ?> 
	
	<?php //trackbacks计数分离
	if (function_exists('wp_list_comments')) {
		$trackbacks = $comments_by_type['pings'];
	} else {
		$trackbacks = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_approved = '1' AND (comment_type = 'pingback' OR comment_type = 'trackback') ORDER BY comment_date", $post->ID));
	}?>

	
		<?php if($comments) : //如果有评论 ?>
		
			<div id="commnents" class="commentsorping">
			
				<div class="leavecom"></div>
			
				<div class="commentpart">Comment<?php echo (' (' . (count($comments)-count($trackbacks)) . ')'); ?></div>
				<div class="pingpart">Trackback<?php echo (' (' . count($trackbacks) . ')');?></div>
			</div>
	
	
			<?php if ( function_exists('wp_list_comments') ) : //嵌套评论 ?>
			<div class="commentshow">
			<div id="loading-comments"></div>
	<ul class="commentlist" >
	<?php wp_list_comments('type=comment&callback=devecomment&max_depth=10000'); ?>
	</ul>
	<nav class="commentnav">
		<?php paginate_comments_links('prev_text=«&next_text=»');?>
	</nav>
	</div>
			<?php else : ?>
					
			<?php endif; ?>
			
			
			<?php if ( ! empty($comments_by_type['pings']) ) : //嵌套ping?>
			<ul class="pingtlist">
					<?php wp_list_comments('type=pings&callback=devepings&per_page=999'); ?>
			</ul>
			<?php else : ?>
			<ul class="pingtlist">
				<li>还没有Trackback</li>
			</ul>
			<?php endif; ?>
									
	<?php else : ?>
	  
	<?php endif; ?>
	
	
	<?php if(comments_open()) : ?>
		
		<div id="respond">
		<div id="replytitle">Leave a Reply</div><div class="cancelcom"></div>
<div class="cancel_comment_reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php if ( is_user_logged_in() ) { ?>
		<div id="author-info" class="user-logged">
			<?php printf('欢迎 %s！！', '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php echo '换个马甲 &raquo;'; ?>"><?php echo '退出 &raquo;'; ?></a>
		</div>
		<?php } else { ?>
		<div id="comment-author-info" <?php if ( !empty($comment_author) ) echo 'style="display:none"'; ?>>
			<p><label for="author">签名</label><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="14" tabindex="1" /><em>*</em></p>
			<p><label for="email">邮箱</label><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="25" tabindex="2" /><em>*</em></p>
			<p class="comment-author-url"><label for="url">网址</label><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="36" tabindex="3" /></p>
		</div>
		<?php if ( !empty($comment_author) ) { ?>
		<div id="author-info">
			<span class="author-info-r"><a id="tab-author" href="javascript:;">更改用户</a></span>
			<?php echo $comment_author ?>
		</div>
		<?php } } ?>
		<div class="post-area">
			<div class="comment-editor">
			   <a id="comment-smiley" href="javascript:;">表情</a><a href="javascript:SIMPALED.Editor.code()">插代码</a>
			</div>
			<div id="smileys"><?php include('smilies.php'); ?></div>
			<textarea name="comment" id="comment" cols="100" rows="7" tabindex="4" onkeydown="if(event.ctrlKey&amp;&amp;event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
		</div>
		<div class="subcon">
			<input class="btn primary subcom" type="submit" name="submit" id="submit" tabindex="5" value="提交评论（Ctrl+Enter）" />
			
			<?php comment_id_fields(); do_action('comment_form', $post->ID); ?>
		</div>
	</form>
<?php endif; ?>
</div>
		  
		<?php endif; ?>

</div>