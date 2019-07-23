<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to tdpersona_comment() which is
 * located in the functions.php file.
 *
 * @package tdpersona
 * @since tdpersona 1.0
 */
?>

<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;
?>

	<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( _nx( '一条评论，在 &ldquo;%2$s&rdquo;', '%1$s条评论，在 &ldquo;%2$s&rdquo;', get_comments_number(), '评论标题', 'tdpersona' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3> <!-- .comments-title -->

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size'       => 96,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( '评论导航', 'tdpersona' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '<i class="fa fa-angle-double-left"></i> 较旧的评论', 'tdpersona' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( '较新的评论 <i class="fa fa-angle-double-right"></i>', 'tdpersona' ) ); ?></div>
		</nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments then let's leave a little note
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( '评论已关闭。', 'tdpersona' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments .comments-area -->
