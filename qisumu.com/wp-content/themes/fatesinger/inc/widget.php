<?php
class fatesinger_widget extends WP_Widget {
    function fatesinger_widget() {
        $widget_ops = array('description' => '自定义google搜索');
        $this->WP_Widget('fatesinger_widget', 'Fatesinger-google', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
		
?>
	<form role="search" onsubmit="return q.value!=''" method="GET" name="gs" action="/google">
		<div class="search-container"><div class="search-inner clearfix">
		<input class="google-input" type="search" style="outline: none;" spellcheck="false" dir="ltr" size="38" title="" value="" maxlength="2048" name="q"><button class="google-submit" value="" type="submit" name="submit">
<span class="sbico">Google</span>
</button></div></div></form>
<?php	
	 
   }
    function form($instance) {
        global $wpdb;
?>
    <p>该工具没有选项!</p>
<?php
    }
}
add_action('widgets_init', 'fatesinger_widget_init');
function fatesinger_widget_init() {
    register_widget('fatesinger_widget');
}

 /////////////随机文章////////////

class fatesinger_widget2 extends WP_Widget {
     function fatesinger_widget2() {
         $widget_ops = array('description' => '配合主题样式');
         $this->WP_Widget('fatesinger_widget2', 'Fatesinger-随机文章', $widget_ops);
     }
     function widget($args, $instance) {
         extract($args);
         
         $limit = strip_tags($instance['limit']);
         echo $before_widget;
?> <h3>Random posts</h3>
		<ul class="ulstyle">
		<?php $posts = query_posts($query_string . "orderby=rand&showposts=$limit()" ); ?>  
				<?php while(have_posts()) : the_post(); ?> 
                <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a><span class="sidebaraction"></span></li> 
        <?php endwhile; ?> 
		</ul>
		 
<?php		 
         echo $after_widget;
     }
     function update($new_instance, $old_instance) {
         if (!isset($new_instance['submit'])) {
             return false;
         }
         $instance = $old_instance;
        
         $instance['limit'] = strip_tags($new_instance['limit']);
         return $instance;
     }
     function form($instance) {
         global $wpdb;
         $instance = wp_parse_args((array) $instance, array('limit' => ''));
        
         $limit = strip_tags($instance['limit']);
 ?>
        
         <p>
             <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
         </p>
         <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
 <?php
     }
 }
 add_action('widgets_init', 'fatesinger_widget2_init');
 function fatesinger_widget2_init() {
     register_widget('fatesinger_widget2');
 }
 /////////////////
 
 
 /////////////友情链接/////////
class  fatesinger_widget3 extends WP_Widget {
     function fatesinger_widget3() {
         $widget_ops = array('description' => '双栏的友情链接，只支持一级目录');
         $this->WP_Widget('fatesinger_widget3', 'Fatesinger-友情链接', $widget_ops);
     }
     function widget($args, $instance) {
         extract($args);
        
         $limit = strip_tags($instance['limit']);
		 $orderby = strip_tags($instance['orderby']);
		 $cats = strip_tags($instance['cats']);
        echo $before_widget;
?> 
<h3>友情链接</h3>
         <ul  class="tworow clearfix">
			<?php wp_list_bookmarks( array(
			'limit' => $limit,
			'hide_empty' => 1,
			'category'  => $cats,
			'categorize' => 0,
			'title_li' => '',
			'orderby' => $orderby,
			'order' => 'ASC',
			'echo' => 1
			)
			);
		?>
		</ul>		
		 
<?php		 
         echo $after_widget;
     }
     function update($new_instance, $old_instance) {
         if (!isset($new_instance['submit'])) {
             return false;
         }
         $instance = $old_instance;          
         $instance['limit'] = strip_tags($new_instance['limit']);
		 $instance['orderby'] = strip_tags($new_instance['orderby']);
		 $instance['cats'] = strip_tags($new_instance['cats']);
         return $instance;
     }
     function form($instance) {
         global $wpdb;
         $instance = wp_parse_args((array) $instance, array('limit' => '-1', 'cats' => '', 'orderby' => 'name'));        
         $limit = strip_tags($instance['limit']);
		 $orderby = strip_tags($instance['orderby']);
		 $cats = strip_tags($instance['cats']);
 ?>
         
         <p>
             <label for="<?php echo $this->get_field_id('limit'); ?>">数量：默认“-1”为全部显示。<br>如果需要限时数量，输入具体数值<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
         </p>
		  <p>
             <label for="<?php echo $this->get_field_id('cats'); ?>">显示分类：<br>● 默认不填写即显示所有分类里的链接<br>● 填写某分类的ID，显示此分类下的链接<input class="widefat" id="<?php echo $this->get_field_id('cats'); ?>" name="<?php echo $this->get_field_name('cats'); ?>" type="text" value="<?php echo $cats; ?>" /></label>
         </p>
		 <p>
             <label for="<?php echo $this->get_field_id('orderby'); ?>">排序：<br>● 默认“name”按名称排列<br>● 如果需要其他排列，输入相应的排序形式。<a target="_blank" href="http://codex.wordpress.org/Function_Reference/wp_list_bookmarks">查看orderby排序参数</a><input class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" type="text" value="<?php echo $orderby; ?>" /></label>
         </p>
         <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
 <?php
     }
 }
 add_action('widgets_init', 'fatesinger_widget_init3');
 function fatesinger_widget_init3() {
     register_widget('fatesinger_widget3');
 }
 //////////////////////////////////////////////////////////


class fatesinger_widget4 extends WP_Widget {
    function fatesinger_widget4() {
        $widget_ops = array('description' => '主题自带的热门文章小工具');
        $this->WP_Widget('fatesinger_widget4', 'Fatesinger-热门文章', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $limit = strip_tags($instance['limit']);
		$poptime = strip_tags($instance['poptime']);
        echo $before_widget;	
?>
		<h3>热门文章</h3>

		<ul class="ulstyle">
			<?php if(function_exists('most_comm_posts')) most_comm_posts( $poptime , $limit ); ?>
		</ul>
<?php	
        echo $after_widget;
    }
	
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['limit'] = strip_tags($new_instance['limit']);
		$instance['poptime'] = strip_tags($new_instance['poptime']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('limit' => ''));
        $limit = strip_tags($instance['limit']);
		$poptime = strip_tags($instance['poptime']);
?>
        
    <p><label for="<?php echo $this->get_field_id('limit'); ?>">文章数量：<input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('poptime'); ?>" >热评文章时间范围:<br>（例如希望Popular栏目显示90天内评论最多的文章，则输入“90”）<input id="<?php echo $this->get_field_id('poptime'); ?>" name="<?php echo $this->get_field_name('poptime'); ?>" type="text" value="<?php echo $poptime; ?>" /></label></p>
    <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
    }
}
add_action('widgets_init', 'fatesinger_widget4_init');
function fatesinger_widget4_init() {
    register_widget('fatesinger_widget4');
}


class fatesinger_widget8 extends WP_Widget {
     function fatesinger_widget8() {
         $widget_ops = array('description' => '主题自带的最近评论小工具');
         $this->WP_Widget('fatesinger_widget8', 'Fatesinger-最近评论', $widget_ops);
     }
     function widget($args, $instance) {
         extract($args);
         $limit = strip_tags($instance['limit']);
         echo $before_widget;
?> 
         <h3>最近评论</h3>
		 <div class="recentcommentcontrol">
		 <ul class="recentcomments clearfix">
			<?php
				global $wpdb;
				$limit_num = $limit;
				$my_email = "'" . get_bloginfo ('admin_email') . "'";
				$rc_comms = $wpdb->get_results("SELECT ID, post_title, comment_ID, comment_author,comment_author_email,comment_date,comment_content FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID  = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND comment_author_email != $my_email ORDER BY comment_date_gmt DESC LIMIT $limit_num ");
				$rc_comments = '';
				foreach ($rc_comms as $rc_comm) { $rc_comments .= "<li><span class='recentcommentsavatar'>" . get_avatar($rc_comm,$size='32') ."</span><a href='". get_permalink($rc_comm->ID) . "#comment-" . $rc_comm->comment_ID. "' title='在 " . $rc_comm->post_title .  " 发表的评论'>".cut_str(strip_tags($rc_comm->comment_content),16)."</a><br><span class='recentcomments_author'>".$rc_comm->comment_author."</span><span class='recentcomments_date'>" .$rc_comm->comment_date."</span></li>\n";}
				
				echo $rc_comments;
			?>
		</ul></div>
		<div class="new-comments">New</div><div class="old-comments">Old</div>
<?php		 
         echo $after_widget;
     }
     function update($new_instance, $old_instance) {
         if (!isset($new_instance['submit'])) {
             return false;
         }
         $instance = $old_instance;
         $instance['limit'] = strip_tags($new_instance['limit']);
         return $instance;
     }
     function form($instance) {
         global $wpdb;
         $instance = wp_parse_args((array) $instance, array('limit' => ''));
         $limit = strip_tags($instance['limit']);
 ?>
         <p><label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label></p>
         <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
 <?php
     }
 }
 add_action('widgets_init', 'fatesinger_widget8_init');
 function fatesinger_widget8_init() {
     register_widget('fatesinger_widget8');
 }
 

class fatesinger_widget18 extends WP_Widget {
    function fatesinger_widget18() {
        $widget_ops = array('description' => '主题自带的边栏网站统计小工具');
        $this->WP_Widget('fatesinger_widget18', 'Fatesinger-tab', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
		
?> <div class="widgit-area">
   <div class="widget-tab">
   <ul class="tab-title"><li class="selected">随机文章</li><li>标签云</li><li>最近文章</li><li>文章分类</li></ul><div class="tab-inner">
  <ul class="ulstyle">
		<?php $posts = query_posts($query_string . "orderby=rand&showposts=5" ); ?>  
				<?php while(have_posts()) : the_post(); ?> 
                <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a><span class="sidebaraction"></span></li> 
        <?php endwhile; ?> 
		</ul>
						<ul class="ulstyle widget_tag_cloud hide">
							<?php $tags_list = get_tags('orderby=count&order=DESC');
		if ($tags_list) { 
			foreach($tags_list as $tag) {
				echo '<li><a class="tag-link" href="'.get_tag_link($tag).'">'. $tag->name .'</a></li>';
			} 
		} 
		?>
						</ul>
						<ul class="ulstyle hide">
							<?php $posts = query_posts($query_string . "orderby=date&showposts=5" ); ?>  
				<?php while(have_posts()) : the_post(); ?> 
                <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a><span class="sidebaraction"></span></li> 
        <?php endwhile; ?>
						</ul>
						<ul class="ulstyle hide">
							<?php wp_list_categories('show_count=1&title_li='); ?>
						</ul>
   </div></div></div>
<?php	
	  
   }
    function form($instance) {
        global $wpdb;
?>
    <p>该工具没有选项!</p>
<?php
    }
}
add_action('widgets_init', 'fatesinger_widget18_init');
function fatesinger_widget18_init() {
    register_widget('fatesinger_widget18');
}
?>