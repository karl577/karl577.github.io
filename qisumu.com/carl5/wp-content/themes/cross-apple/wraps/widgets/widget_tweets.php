<?php
/*
* ------------------------------------------------------------------------------------------------------------------------
* WIDGET FOR TWEETS
* @PACKAGE BY HAWKTHEME
* ------------------------------------------------------------------------------------------------------------------------
*/

class Tweets_Widget extends WP_Widget{

	/** Construction function**/
	function Tweets_Widget(){
		$title_ops = esc_html__(THEME_NAME.'&raquo; Tweets','HK');
		$widget_ops = array('classname'=>'widget-tweets','description'=>esc_html__('这个小工具将显示一个Tweets账号','HK'));
		$control_ops = array('width'=>450);
		$this->WP_Widget(THEME_SLUG. '_tweets',$title_ops,$widget_ops,$control_ops);
	}


	/** Function defined form**/
	function form($instance){
		$instance = wp_parse_args((array)$instance,array(
			'title'=> esc_html__('Twitter','HK'),
			'account' => 'twitter',
			'showposts'=> 3,
			'refresh' => '30',
			'autolinks' => 'true',
			'userlinks' => 'true',
			'date' => 'true'
		));

		$title = htmlspecialchars($instance['title']);
		$account = htmlspecialchars($instance['account']);
		$showposts = htmlspecialchars($instance['showposts']);
		$refresh = htmlspecialchars($instance['refresh']);
		$autolinks = htmlspecialchars($instance['autolinks']);
		$userlinks = htmlspecialchars($instance['userlinks']);
		$date = htmlspecialchars($instance['date']);

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('title').'">'; esc_html_e('Title:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap theme-shorttext">';
		echo '<label for="'.$this->get_field_id('account').'">'; esc_html_e('Account:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('account').'" name="'.$this->get_field_name('account').'" type="text" value="'.$account.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap theme-shorttext">';
		echo '<label for="'.$this->get_field_id('showposts').'">'; esc_html_e('Showposts:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('showposts').'" name="'.$this->get_field_name('showposts').'" type="text" value="'.$showposts.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap theme-shorttext">';
		echo '<label for="'.$this->get_field_id('refresh').'">'; esc_html_e('Refresh:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('refresh').'" name="'.$this->get_field_name('refresh').'" type="text" value="'.$refresh.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';

		echo '<label for="'.$this->get_field_id('autolinks').'">'; 
		echo '<input type="checkbox" name="'.$this->get_field_name('autolinks').'"'; 
		checked('true', $instance['autolinks']); 
		echo 'value="true" />';
		echo '<em>'; esc_html_e('Convert URLs to links','HK'); echo '</em>';
		echo'</label>';

		echo '<label for="'.$this->get_field_id('userlinks').'">'; 
		echo '<input type="checkbox" name="'.$this->get_field_name('userlinks').'"'; 
		checked('true', $instance['userlinks']); 
		echo 'value="true" />';
		echo '<em>'; esc_html_e('Convert @users to links','HK'); echo '</em>';
		echo'</label>';

		echo '<label for="'.$this->get_field_id('date').'">'; 
		echo '<input type="checkbox" name="'.$this->get_field_name('date').'"'; 
		checked('true', $instance['date']); 
		echo 'value="true" />';
		echo '<em>'; esc_html_e('Show the date/time','HK'); echo '</em>';
		echo'</label>';

		echo '</div>';

	}


	/** Function defined update**/
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['account'] = strip_tags($new_instance['account']);
		$instance['showposts'] = strip_tags($new_instance['showposts']);
		$instance['refresh'] = strip_tags($new_instance['refresh']);
		$instance['autolinks'] = strip_tags($new_instance['autolinks']);
		$instance['userlinks'] = strip_tags($new_instance['userlinks']);
		$instance['date'] = strip_tags($new_instance['date']);
		return $instance;
	}


	/** Definition of widget function that displays a web page**/
	function widget($args,$instance){
		extract($args);
		$title = $instance['title'];
		$account = $instance['account'];
		$showposts = $instance['showposts'];
		$refresh = $instance['refresh'];
		$autolinks = $instance['autolinks'] == 'true';
		$userlinks = $instance['userlinks'] == 'true';
		$date = $instance['date'] == 'true';
		$twitterFeed = $this->loadTwitterFeed($account, $refresh);
		if (!is_wp_error( $twitterFeed ) ) {
            $maxitems = $twitterFeed->get_item_quantity($showposts); 
            $rss_items = $twitterFeed->get_items(0, $maxitems); 
            if($maxitems > 0) {

				echo $before_widget; 
				echo $before_title . $title . $after_title;
				echo '<ul>';

						foreach($rss_items as $item) { 

							echo '<li>';
							$output_msg = substr(strstr($item->get_description(),': '), 2, strlen($item->get_description()));
							if ($autolinks) {
								$output_msg = $this->conver_hyperlinks($output_msg);
							}
							if ($userlinks) {
								$output_msg = $this->conver_twitter_users($output_msg);
							}

							if ($date) {
								$time = strtotime($item->get_date());

								if ( ( abs( time() - $time) ) < 86400 ) {
									$human_time = sprintf( __('%s ago', 'HAWK_FRONT'), human_time_diff( $time ) );
								} else {
									$human_time = date(__('F j, Y', 'HAWK_FRONT'), $time);
								}

							$output_msg = $output_msg . sprintf( __('%s', 'HAWK_FRONT'),' <a href="'.$item->get_permalink().'" class="tweets-widget-time" title="' . date(__('h:i A F j, Y', 'HAWK_FRONT'), $time) . '" target="_blank">'.$human_time.'</a>' );
							}

							echo $output_msg;
							echo '</li>';

						}//foreach

				echo '</ul>';
				echo $after_widget;

			}

		}//end is_wp_error

	}//function

	/*--------------------------------------------------------------------------End Tweets Loop-------------------------------------------------------------------------------*/

	/*loadTwitterFeed*/
	function loadTwitterFeed($account, $refresh) {   
		require_once (ABSPATH . WPINC . '/class-feed.php');
		$url = 'http://twitter.com/statuses/user_timeline/' . $account .'.rss';
		$cache_duration = $refresh * 60;
		
		$feed = new SimplePie();
		$feed->set_feed_url($url);
		$feed->set_cache_class('WP_Feed_Cache');
		$feed->set_file_class('WP_SimplePie_File');
		$feed->set_cache_duration($cache_duration);
		$feed->init();
		$feed->handle_content_type();

		if ( $feed->error() ) {
			return new WP_Error('simplepie-error', $feed->error());
		}
		return $feed;
	}


	/*conver_hyperlinks*/
	 function conver_hyperlinks($text) {
		$text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
		$text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);    
		$text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
		$text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
		return $text;
	}


	 /*conver_twitter_users*/
	function conver_twitter_users($text) {
		$text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
		return $text;
	} 

}

?>