<?php if (post_password_required()) {
	return;
} ?>

<div class="metabar clearfix">
	<h4 class="title-5"><?php echo __('Comments', 'pinthis'); ?></h4>
</div>

<?php if (comments_open()) { ?>
	<?php if (have_comments()) { ?>
		<div class="comments">
			<ul>
				<?php wp_list_comments(array('callback' => 'pinthis_comments')); ?>
			</ul>
		</div>
		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) { ?>
		<div class="comments-nav clearfix">
			<span class="comments-nav-prev"><?php previous_comments_link(__('Older Comments', 'pinthis')); ?></span>
			<span class="comments-nav-next"><?php next_comments_link(__('Newer Comments', 'pinthis')); ?></span>
		</div>
		<?php } ?>
	<?php } ?>
	<?php
	
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$aria_req = ($req ? " aria-required='true'" : '');
	
	$args = array(
		'fields' => apply_filters(
			'comment_form_default_fields', array(
				'author' => '<p class="comment-form-author"><input id="author" placeholder="' . __('Name', 'pinthis') . ' ' . ($req ? '*' : '') . '" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . '></p>',
				'email'  => '<p class="comment-form-email"><input id="email" placeholder="' . __('Email', 'pinthis') . ' ' . ($req ? '*' : '') . '" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req . '></p>',
				'url'    => '<p class="comment-form-url"><input id="url" name="url" placeholder="' . __('Website', 'pinthis') . ' " type="text" value="' . esc_attr($commenter['comment_author_url'] ) . '"></p>'
			)
		),
		'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="' . __('Comment', 'pinthis') . ' " aria-required="true"></textarea></p>',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'title_reply' => '',
		'title_reply_to' => '',
		'logged_in_as' => '',
		'cancel_reply_link' => ''
	);
	?>
	
	<!-- <div class="comment-respond-wrapper <?php if ($GLOBALS['pinthis_show_avatars'] != 1) { echo 'no-avatar'; } ?>"> -->
		<?php comment_form($args); ?>
	<!-- </div> -->
	
<?php } else { ?>
	<p class="notification"><?php echo __('Sorry, comments are closed for this item.', 'pinthis' ); ?></p>
<?php } ?>