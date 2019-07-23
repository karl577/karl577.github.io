<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Author
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
function theme_post_author()
{
	$desc = get_the_author_meta( 'description' );
	$author = theme_get_option('blog','enable_author_info');

	if($author == true && $desc != '')
	{
		echo '<!--BEGIN AUTHOR-->'."\n";
		echo '<div class="author-info">'."\n";
		echo '<h3>';
		esc_html_e('About the Author','HK');
		echo '</h3>';
		echo '<dl class="clearfix">'."\n";
		echo '<dt class="post-thumb-comment">'.get_avatar( get_the_author_meta('email'), 64 ).'</dt>'."\n";
		echo '<dd>'."\n";
		echo '<h5>'; the_author_posts_link(); echo '</h5>'."\n";
		echo '<p>'; the_author_meta('description'); echo '</p>'."\n";
		echo '</dd>'."\n";
		echo '</dl>'."\n";
		echo '</div>'."\n";
		echo '<!--END AUTHOR-->'."\n";
	}
}

?>