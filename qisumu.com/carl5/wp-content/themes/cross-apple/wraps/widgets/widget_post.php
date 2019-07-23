<?php
/*
* ------------------------------------------------------------------------------------------------------------------------
* WIDGET FOR POSTS
* @PACKAGE BY HAWKTHEME
* ------------------------------------------------------------------------------------------------------------------------
*/

class Posts_Widget extends WP_Widget{

	/** Construction function**/
	function Posts_Widget(){
		$title_ops = esc_html__(THEME_NAME.'&raquo; 文章列表','HK');
		$widget_ops = array('classname'=>'widget-posts','description'=>esc_html__('这是一个文章列表窗口小部件.','HK'));
		$control_ops = array('width'=>250);
		$this->WP_Widget(THEME_SLUG. '_posts',$title_ops,$widget_ops,$control_ops);
	}


	/** Function defined form**/
	function form($instance){
		$instance = wp_parse_args((array)$instance,array(
			'title' => esc_html__('Posts','HK'),
			'showposts' => 3,
			'orderby' => 'date',
			'thumb' => 'true',
			'lightbox' => 'true'
		));

		$title = htmlspecialchars($instance['title']);
		$showposts = htmlspecialchars($instance['showposts']);
		$orderby = htmlspecialchars($instance['orderby']);
		$thumb = htmlspecialchars($instance['thumb']);
		$lightbox = htmlspecialchars($instance['lightbox']);

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('title').'">'; esc_html_e('Title:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap theme-shorttext">';
		echo '<label for="'.$this->get_field_id('showposts').'">'; esc_html_e('Showposts:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('showposts').'" name="'.$this->get_field_name('showposts').'" type="text" value="'.$showposts.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('orderby').'">'; esc_html_e('Orderby:','HK'); echo'</label>';
		echo '<select name="'.$this->get_field_name('orderby').'">';
		echo '<option value="date" '; selected('date', $instance['orderby']); echo '>'; esc_html_e('Date','HK'); echo '</option>';
		echo '<option value="comment_count" '; selected('comment_count', $instance['orderby']); echo '>'; esc_html_e('Comment Count','HK'); echo '</option>';
		echo '<option value="rand" '; selected('rand', $instance['orderby']); echo '>'; esc_html_e('Rand','HK'); echo '</option>';
		echo '</select>';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';

		echo '<label for="'.$this->get_field_id('thumb').'">'; 
		echo '<input type="checkbox" name="'.$this->get_field_name('thumb').'"'; 
		checked('true', $instance['thumb']); 
		echo 'value="true" />';
		echo '<em>'; esc_html_e('Display with thumbnail.','HK'); echo '</em>';
		echo'</label>';

		echo '<label for="'.$this->get_field_id('lightbox').'">'; 
		echo '<input type="checkbox" name="'.$this->get_field_name('lightbox').'"'; 
		checked('true', $instance['lightbox']); 
		echo 'value="true" />';
		echo '<em>'; esc_html_e('Display the thumbnail with lightbox.','HK'); echo '</em>';
		echo'</label>';

		echo '</div>';

	}


	/** Function defined update**/
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['showposts'] = strip_tags($new_instance['showposts']);
		$instance['orderby'] = strip_tags($new_instance['orderby']);
		$instance['thumb'] = strip_tags($new_instance['thumb']);
		$instance['lightbox'] = strip_tags($new_instance['lightbox']);

		return $instance;
	}


	/** Definition of widget function that displays a web page**/
	function widget($args,$instance){
		extract($args);
		$title = $instance['title'];
		$showposts = $instance['showposts'];
		$orderby = $instance['orderby'];
		$thumb = $instance['thumb'];
		$lightbox = $instance['lightbox'];
		$post_id = isset( $post->ID ) ? $post->ID: ''; 

		$posts_args = array( 
				'post_type' => array('post', 'portfolio', 'product'),
				'posts_per_page' => $showposts,
				'orderby' => $orderby,
				'post_status' => 'publish', 
				'ignore_sticky_posts' => 1, 
				'post__not_in' => array($post_id)
				); 
		$posts_query = new WP_Query( $posts_args );

		echo $before_widget; 
		echo $before_title . $title . $after_title;

		echo '<ul>'."\n";

		while ($posts_query->have_posts()) {
				 $posts_query->the_post();

				if($lightbox == 'true') 
				{
					$link = theme_large_image_uri();
					$rel = 'data-id="fancybox"';
				}else{
					$link = get_permalink();
					$rel = 'rel="bookmark"';
				}

				echo '<li class="clearfix">'."\n";

				if ( has_post_thumbnail() && $thumb == 'true' ) {

					echo '<figure class="alignleft post-thumb post-thumb-comment">';
					echo '<a href="'.$link.'" class="image-link" '.$rel.' title="'.get_the_title().'">';
					the_post_thumbnail('50-50');
					echo '</a>';
					echo '</figure>'."\n";

				}

				echo '<section>'."\n";
				echo '<h5><a href="'.get_permalink().'"  rel="bookmark" title="'.get_the_title().'">'.get_the_title().'</a></h5>'."\n";
				echo '<p class="post-meta">';
				printf( __('%1$s', 'HK'), get_the_time('F j, Y') );
				echo '<span></span>';
				Comments_popup_link(__('No Comment', 'HK'), __('1Comment', 'HK'), __('%评论', 'HK'), '', __('Comment Off', 'HK'));
				echo '</p>';
				echo '</section>'."\n";

				echo '</li>'."\n";

		}//END WHILE
		wp_reset_postdata();

		echo '</ul>'."\n";

		echo $after_widget; 

	}

}

?>