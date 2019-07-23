<?php if(!defined('ABSPATH'))exit;
if(is_attachment()){
	$parent = get_post($post->post_parent);
	$parent_comment_status = $parent->comment_status;
}else{
	$parent_comment_status = 'open';
}
if('open' == $post->comment_status && $parent_comment_status == 'open') : ?>
<div id="comments">
<?php if(have_comments()) : ?>
	<div class="comments-title"><h4>评论<i><?php comments_number('目前还没评论','已有 1 条评论','已有 % 条评论'); ?> <a href="#respond" class="jpl" id="to-quick-respond" title="添加一条评论">+1</a></i></h4></div>
	<ol id="comments-lists">
	<?php wp_list_comments(array('callback' => 'mytheme_comment'));?>
	</ol>
	<?php if(get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
	<div id="comment-navi">
		<div class="prev"><?php previous_comments_link('<< 旧的评论'); ?></div>
		<div class="next"><?php next_comments_link('近期评论 >>'); ?></div>
		<div class="clear"></div>
	</div>
	<?php endif; // check for comment navigation ?>
	<script>
	//<![CDATA[
	jQuery(document).ready(function($) {
	var $window_hash = window.location.hash,$respond = $('#respond'),$comments = $('#comments');
	if($window_hash.indexOf('comment-') >= 0 || $window_hash == '#respond' || $window_hash == '#comments'){
		$($window_hash).parent().addClass('current');
		setTimeout(function(){
			$scroll_top = $(window).scrollTop();
			$('html,body').animate({scrollTop:$scroll_top - 100},200);
		},500);
	}
	$('#to-quick-respond').click(function(e){
		e.preventDefault();
		var $comments = $('#comments'),$respond = $('#respond');
		$comments.find('li').removeClass('current');
		$comments.find('li span.reply a').text('回复');
		$comments.append($respond);
		$('#comment_parent').val('0');
		$('#reply-mean,#cancel-reply').remove();
		$respond.find('div.respond-info span.reply').remove();
		$('#respond-line').show();
		$('html,body').animate({scrollTop:$respond.offset().top - 200},200);
	});
	$('#comments li span.reply a').click(function(e){
		e.preventDefault();
		var $this = $(this),$reply_text = $this.text(),$comment_id = $this.attr('data-comment-id'),
			$respond = $('#respond'),$comment = $this.parent().parent().parent().parent(),$comments = $('#comments');
		if($reply_text == '回复'){
			$('#comments li span.reply a').text('回复');
			$this.text('取消');
			$('#comment_parent').val($comment_id);
			$('#reply-mean,#cancel-reply').remove();
			$respond.find('div.respond-info').prepend('<span id="reply-mean" style="color:#f00">回复@' + $comment_id + '楼</span> ');
			$('#respond-line').hide();
			$('#comments li').removeClass('current');
			$comment.addClass('current');
			$comment.append($respond);
			$('#comment').focus();
			$('html,body').animate({scrollTop:$('#comment-' + $comment_id).offset().top - 200},200);
		}else{
			$this.text('回复');
			$('#comment_parent').val('0');
			$('#reply-mean,#cancel-reply').remove();
			$('#respond-line').show();
			$comment.removeClass('current');
			$comments.append($respond);
			$('html,body').animate({scrollTop:$(document).scrollTop() + 100},200);
		}
	});
	$('#comments span.reply-to a').live('click',function(e){
		e.preventDefault();
		var $comment_to = $(this).attr('href');
		$('#comments li').removeClass('current');
		$($comment_to).parent().addClass('current');
		$('html,body').animate({scrollTop:$($comment_to).offset().top - 200},200);
	});
	});
	//]]>
	</script>
<?php endif; // end of comment list ?>
<div id="respond-line" class="line"></div>
<div id="respond">
	<?php if(get_option('comment_registration') && !is_user_logged_in()) : //如果文章设置了必须登录才能评论 ?>
		<p>你必须<a href="<?php wp_login_url(get_permalink()); ?>">登录</a>才能评论！</p>
	<?php else : //文章不用登录就能评论 ?>
	<form action="<?php bloginfo('url'); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php if(isset($_GET['current']) && $_GET['current'] != '') : ?>
			<div class="reply-info">
				您正在回复<?php echo comment_author($_GET['current']); ?>
				<a href="#comment-<?php echo $_GET['current']; ?>" style="color:#f00;" rel="nofollow">@<?php echo $_GET['current']; ?>楼</a>
				<a href="<?php the_permalink(); ?>#comment-<?php echo $_GET['current']; ?>" rel="nofollow">取消</a>
			</div>
		<?php endif; ?>
		<?php if(is_user_logged_in()) : //如果用户已经登录 ?>
			<div class="respond-info">
				亲爱的 <strong><?php echo $user_identity; ?></strong> 您已经登录啦！
				<a href="<?php echo admin_url('profile.php'); ?>">修改信息</a>
				<a href="<?php echo wp_logout_url(get_permalink()); ?>">注销</a>
				赶快评论啊！
			</div>
		<?php elseif($comment_author != ''): //如果用户没有登录，而之前又已经进行了评论，被记录的email信息 ?>
			<div class="respond-info">
				亲爱的 <strong><?php echo $comment_author; ?></strong> 欢迎回来！
				<a href="javascript:toggleCommentAuthorInfo();" id="toggle-comment-author-info"><?php _e('修改信息'); ?></a>
				留下您的回复吧
			</div>
			<div id="comment-author-info" style="display:none;">
			<label for="author"><?php _e('昵称'); ?><?php if ($req) echo " *"; ?></label>
			<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" />
			<label for="email"><?php _e('邮箱'); ?><?php if ($req) echo " *"; ?></label>
			<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" />
			<label for="url"><?php _e('个人主页'); ?></label>
			<input type="text" class="weburl" name="url" id="url" value="<?php echo $comment_author_url; ?>" />
			</div>
			<script>
			//<![CDATA[
			var changeMsg = '修改信息';
			var closeMsg = '隐藏信息';
			function toggleCommentAuthorInfo(){
				var $info_box = $('#comment-author-info'),$tog_btn = $('#toggle-comment-author-info');
				$info_box.slideToggle('slow', function(){
					if($info_box.css('display') == 'none'){
						$tog_btn.text(changeMsg);
					}else{
						$tog_btn.text(closeMsg);
					}
				});
			}
			//]]>
			</script>
		<?php else : //既没登录，也没之前留言情况下 ?>
			<div class="respond-info">我要评论！( 游客填写「昵称」「邮箱」后即可回复 )</div>
			<div id="comment-author-info">
			<label for="author"><?php _e('昵称'); ?><?php if ($req) echo " *"; ?></label>
			<input type="text" name="author" id="author" value="" />
			<label for="email"><?php _e('邮箱'); ?><?php if ($req) echo " *"; ?></label>
			<input type="text" name="email" id="email" value="" />
			<label for="url"><?php _e('个人主页'); ?></label>
			<input type="text" class="weburl" name="url" id="url" value="" />
			</div>
		<?php endif; ?>
		<div id="comment-text"><textarea name="comment" id="comment"></textarea></div>
		<div class="reply-sub">
		<a class="abtn abtn-s l" href="javascript:;" title="提交评论[Ctrl+Enter]"><button name="submit" type="submit" id="submit"><u>评论</u></button></a>
			<?php if(function_exists('add_mail_to_comment_checkbox'))add_mail_to_comment_checkbox(); ?>
			<input type="hidden" name="redirect_to" value="<?php the_permalink(); ?>" />
			<?php do_action('comment_form', $post->ID); ?>
			<?php comment_id_fields(); ?>
			<div class="clear"></div>
		</div>
		<script>
		//<![CDATA[
		// Ctrl+Enter提交评论
		jQuery(document).ready(function($) {
		$(document).keypress(function(e){
			if(e.ctrlKey && e.which == 13 || e.which == 10) {
				$("#submit").click();
				document.body.focus();
			} else if (e.shiftKey && e.which==13 || e.which == 10) {
				$("#submit").click();
			}
		});
		});
		//]]>
		</script>
	</form>
	<?php endif; //end of respond ?>
</div><!--//end of respond-->
</div><!--  // end of comments -->
<?php endif; //如果文章允许评论的话，到这里结束