<?php
/*
* ----------------------------------------------------------------------------------------------------
* Theme Functions
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

/*------------------------------------------------------------------------
*Add theme support
------------------------------------------------------------------------*/
if ( function_exists('add_theme_support') ) {

	add_theme_support('menus');
	add_theme_support('post-thumbnails', array('post', 'portfolio', 'product'));
	add_theme_support('automatic-feed-links');
	add_editor_style( '/assets/css/style-editor.css' );

	register_nav_menus( array( 
		'top menu' => esc_html__( 'Top Navigation', 'HK' ),
		'bottom menu' => esc_html__( 'Bottom Navigation', 'HK' )
	)); 

}


/*------------------------------------------------------------------------
*Load Theme Textdomain
------------------------------------------------------------------------*/
load_theme_textdomain( 'HK', LANG_DIR );


/*------------------------------------------------------------------------
*Name < = > ID For Category Or Page
------------------------------------------------------------------------*/
function get_page_id($page_name) 
{
    $page = get_page_by_path($page_name);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}


function get_category_id($category_name, $taxonomy) 
{
	$term = get_term_by('name', $category_name, $taxonomy);
	return $term->term_id;
}


function get_category_name($category_id, $taxonomy)
{
	$term = get_term_by('id', $category_id, $taxonomy);
	return $term->name;
}



/*------------------------------------------------------------------------
*Meta boxes
------------------------------------------------------------------------*/
function get_meta_option($var, $post_id=NULL) {

	if($post_id) return get_post_meta($post_id, $var, true);
    global $post;
    return get_post_meta($post->ID, $var, true);

}



/*------------------------------------------------------------------------
*Remove Auto <p> For Shortcodes
------------------------------------------------------------------------*/
function theme_remove_autop($content) 
{ 
	$content = do_shortcode( shortcode_unautop( $content ) ); 
	$content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);
	return $content;
}


/*------------------------------------------------------------------------
*Fixed WP Title
------------------------------------------------------------------------*/
function theme_filter_wp_title( $title, $separator ) 
{
	if ( is_feed() )
		return $title;

	global $paged, $page;

	if ( is_search() ) {
		$title = sprintf( esc_html__( 'Search results for %s', 'HK' ), '"' . get_search_query() . '"' );
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( esc_html__( 'Page %s', 'HK' ), $paged );
			$title .= " $separator " . get_bloginfo( 'name', 'display' );
		return $title;
	}

	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( esc_html__( 'Page %s', 'HK' ), max( $paged, $page ) );

	return $title;
}

add_filter( 'wp_title', 'theme_filter_wp_title', 10, 2 );



/*------------------------------------------------------------------------
*Remove Gallery Css
------------------------------------------------------------------------*/
function theme_remove_gallery_css() {
	return "\n" . '<div class="gallery">';
}
add_filter( 'gallery_style', 'theme_remove_gallery_css', 9 );



/*------------------------------------------------------------------------
*Theme Comments List
------------------------------------------------------------------------*/
function theme_comment( $comment, $args, $depth ) 
{
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="pingback">
		<?php esc_html_e( 'Pingback:', 'HK' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'HK' ), '<span class="edit-link">', '</span>' ); ?>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<article id="comment-<?php comment_ID(); ?>" class="clearfix comment-wrap">
		<div class="comment-author vcard alignleft">
		<div class="post-thumb-comment">
		<?php
			$avatar_size = 64;
			if ( '0' != $comment->comment_parent ) { $avatar_size = 48; }
			echo get_avatar( $comment, $avatar_size );
		?>	
		</div>
		<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<span class="reply">Reply</span>', 'HK' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?><!-- .reply -->
		</div><!-- .comment-author .vcard -->

		<div class="comment-entry">
			<div class="comment-meta">
			<?php
			printf( __( '%1$s on %2$s <span class="says">said:</span>', 'HK' ),
			sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
			sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
				esc_url( get_comment_link( $comment->comment_ID ) ),
				get_comment_time( 'c' ),
				/* translators: 1: date, 2: time */
				sprintf( __( '%1$s at %2$s', 'HK' ), get_comment_date(), get_comment_time() )
			));
			edit_comment_link( __( '编辑', 'HK' ), '<span class="edit-link">', '</span>' ); 
			?>
			</div>
			<div class="comment-content">
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'HK' ); ?></em>
			<?php endif; ?>
			<div class="comment-text"><?php comment_text(); ?></div>
			</div>
		</div><!-- .comment-entry -->
	</article><!-- #comment-## -->
	<?php
	break;
	endswitch;
}


/*------------------------------------------------------------------------
*Theme Comments Form
------------------------------------------------------------------------*/
function theme_comment_form() 
{
	$fields =  array(
			'author' => '<dl class="comment-form-author"><dt>Name<span>*</span></dt><dd><input id="author"  name="author" type="text" value="" size="30" /></dd></dl>',
			'email'  => '<dl class="comment-form-email"><dt>Email<span>*</span></dt><dd><input id="email" name="email" type="text" value="" size="30" /></dd></dl>',
			'url'    => '<dl class="comment-form-url"><dt>Website</dt><dd><input id="url" name="url" type="text" value="" size="30" /></dd></dl>'
	);

	$args = array(
			'title_reply' =>  esc_html__( '留言', 'HK' ),
			'cancel_reply_link' =>  esc_html__( 'Cancel reply', 'HK' ),
			'comment_notes_before' => '',
			'fields' => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field' => '<textarea id="comment" class="comment-form-comment" name="comment" rows="5"></textarea>',
			'comment_notes_after' => ''
	);
	
	comment_form($args); 

}



/*-----------------------------------------------------------------------------------*/
/*	Get related posts by taxonomy
/*-----------------------------------------------------------------------------------*/

function get_posts_related_by_taxonomy($taxonomy, $column, $args=array())
{
	  global $post;
	  $post_id = $post->ID;
	  $query = new WP_Query();
	  $terms = wp_get_object_terms($post_id, $taxonomy);
	  if (count($terms)) 
	  {
			// Assumes only one term for per post in this taxonomy
			$post_ids = get_objects_in_term($terms[0]->term_id,$taxonomy);
			$post = get_post($post_id);
			$args = wp_parse_args($args,array(
			  'post_type' => $post->post_type, // The assumes the post types match
			  //'post__in' => $post_ids,
			  'post__not_in' => array($post_id),
			  'taxonomy' => $taxonomy,
			  'term' => $terms[0]->slug,
			  'exclude' => $post,
			  'posts_per_page' => $column
			));
			$query = new WP_Query($args);
	  }
	  return $query;
}

?>