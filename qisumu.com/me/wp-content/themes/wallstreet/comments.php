<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.','wallstreet' ); ?></p>
<?php return; endif; ?>	
<?php if ( have_comments() ) { ?>

<div class="comment-section">
	<div class="comment-title">
	<h3><i class="fa fa-comment-o"></i> 
		<?php
				printf( _n('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'wallstreet' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
	</h3>
	</div>
	<?php wp_list_comments( array( 'callback' => 'wallstreet_comment' ) ); ?>
</div> <!---comment_section--->

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'wallstreet' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'wallstreet' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;','wallstreet') ); ?></div>
		</nav>
		<?php }?>
		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed' ,'wallstreet' ); ?></p>
		<?php endif; ?>		
	<?php } ?>
	<?php if ('open' == $post->comment_status) { ?>
	<?php if ( get_option('comment_registration') && !$user_ID ) { ?>
	<p><?php echo sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.','wallstreet' ), site_url( 'wp-login.php' ) . '?redirect_to=' .  urlencode(get_permalink())); ?></p>
<?php } else { 
?>
<div class="comment-form-section">
	<?php  
	 $fields=array(
		'author' => '<div class="blog-form-group"><input class="blog-form-control" name="author" id="author" value="" type="name" placeholder="'.__('Name','wallstreet').'" /></div>',
		'email' => '<div class="blog-form-group"><input class="blog-form-control" name="email" id="email" value="" type="email" placeholder="'.__('Email','wallstreet').'" /></div>',
		);
		function my_fields($fields) { 
			return $fields;
		}
		add_filter('comment_form_default_fields','my_fields');
			$defaults = array(
			'fields'=> apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'=> '<div class="blog-form-group-textarea" >
			<textarea id="comments" rows="5" class="blog-form-control-textarea" name="comment" type="text" placeholder="'.__('Leave your message','wallstreet').'"></textarea></div>',		
			'logged_in_as' => '<p class="logged-in-as">' . __("Logged in as",'wallstreet' ).'<a href="'. admin_url( 'profile.php' ).'">'.$user_identity.'</a>'. '<a href="'. wp_logout_url( get_permalink() ).'" title="'.__('Log out from this Account','wallstreet').'">'.__("Logout",'wallstreet').'</a>' . '</p>',
			'id_submit'=> 'blogdetail_btn',
			'label_submit'=>__('Send Message','wallstreet'),
			'comment_notes_after'=> '',
			'comment_notes_before' => '',
			'title_reply'=> '<div class="comment-title"><h3><i class="fa fa-comment-o"></i>'.__('Leave your message','wallstreet').'</h3></div>',
			'id_form'=> 'commentform'
			);
		comment_form($defaults);
	?>
</div>	
<?php } } ?>		