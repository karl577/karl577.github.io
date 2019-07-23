<?php
 /*
* ----------------------------------------------------------------------------------------------------
* The template for displaying Comments.
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
?>

<?php if ( post_password_required() ) : ?>
<div id="comments">
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'HK' ); ?></p>
</div><!-- #comments -->
<?php return; endif; 
/* Stop the rest of comments.php from being processed,
* but don't kill the script entirely -- we still have
* to fully load the template.
*/
?>


<?php 
	/*if (function_exists('wp_list_comments')) {
		$trackbacks = $comments_by_type['pings'];
	} else {
		$trackbacks = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_approved = '1' AND (comment_type = 'pingback' OR comment_type = 'trackback') ORDER BY comment_date", $post->ID));
	}
	*/
?>

<?php if ( have_comments() ) : ?>

<div id="comments">

	<h2 id="comments-title"><?php echo get_comments_number();  esc_html_e('评论', 'HK');  ?></h2>

	<ol class="commentlist">
		<?php
			/* Loop through and list the comments. Tell wp_list_comments()*/
			wp_list_comments( array( 'callback' => 'theme_comment') );
		?>
	</ol>

	<?php 
	if (get_comment_pages_count() > 1 && get_option('page_comments')) 
	{
		$comment_pages = paginate_comments_links('echo=0');
		if ($comment_pages) 
		{
			echo '<div  class="comment-pagination clearfix">'.$comment_pages.'</div>';
		}
	}
	?>

</div><!-- #comments -->

<?php endif; // end have_comments() ?>

<?php theme_comment_form(); ?>
