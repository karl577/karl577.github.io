<?php
class zlphp_new_article extends WP_Widget{
  function zlphp_new_article(){parent::WP_Widget(false,$name='最新文章');}
  function widget($args,$instance){extract($args);
  echo $before_widget;
  if($instance['title']!=""){
  echo $before_title.$instance['title'].$after_title;}
  else{
  echo $before_title."最新文章".$after_title;}
  if($instance['boxheight']!=""){
  echo"<ul style=\"height:";
  echo $instance['boxheight'];
  echo"px\">";}
  else{
  echo"<ul>";}
  if($instance['Num']!=""){
  $archive_query=new WP_Query('showposts='.$instance['Num'].'');}
  else{
  $archive_query=new WP_Query('showposts=8');}
  while($archive_query->have_posts()):$archive_query->the_post();?>
  <li class="article">
    <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></h2>
    <span>日期：<?php the_time('Y-m-d') ?>　评论：<?php comments_number('0','1','%');?>　浏览：<?php echo getPostViews(get_the_ID()); ?></span>
  </li>
<?php
  endwhile;
  echo"</ul>";
  echo $after_widget;}
  function update($new_instance,$old_instance){return $new_instance;}
  function form($instance){$title=esc_attr($instance['title']);$Num=esc_attr($instance['Num']);$boxheight=esc_attr($instance['boxheight']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">标题：
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('Num'); ?>">数量：<font color="#ff6600">（填写阿拉伯数字）</font></label>
  <input class="widefat" id="<?php echo $this->get_field_id('Num'); ?>" name="<?php echo $this->get_field_name('Num'); ?>" type="text"  value="<?php echo $Num; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('boxheight'); ?>">高度：<font color="#ff6600">（填写阿拉伯数字）</font></label>
  <input class="widefat" id="<?php echo $this->get_field_id('boxheight'); ?>" name="<?php echo $this->get_field_name('boxheight'); ?>" type="text"  value="<?php echo $boxheight; ?>" />
</p>
<?php
}}
add_action('widgets_init',create_function('','return register_widget("zlphp_new_article");'));
class zlphp_hot_article extends WP_Widget{
  function zlphp_hot_article(){parent::WP_Widget(false,$name='热门文章');}
  function widget($args,$instance){extract($args);
  echo $before_widget;
  if($instance['title']!=""){
  echo $before_title.$instance['title'].$after_title;}
  else{
  echo $before_title."热门文章".$after_title;}
  if($instance['boxheight']!=""){
  echo"<ul style=\"height:";
  echo $instance['boxheight'];
  echo"px\">";}
  else{
  echo"<ul>";}
  if($instance['Num']!=""){
  $popular=new WP_Query('orderby=comment_count&showposts='.$instance['Num'].'');}
  else{
  $popular=new WP_Query('orderby=comment_count&showposts=8');}
  while($popular->have_posts()):$popular->the_post();?>
  <li class="article">
    <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></h2>
    <span>日期：<?php the_time('Y-m-d') ?>　评论：<?php comments_number('0','1','%');?>　浏览：<?php echo getPostViews(get_the_ID()); ?></span>
  </li>
<?php
  endwhile;
  echo"</ul>";
  echo $after_widget;}
  function update($new_instance,$old_instance){return $new_instance;}
  function form($instance){$title=esc_attr($instance['title']);$Num=esc_attr($instance['Num']);$boxheight=esc_attr($instance['boxheight']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">标题：
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('Num'); ?>">数量：<font color="#ff6600">（填写阿拉伯数字）</font></label>
  <input class="widefat" id="<?php echo $this->get_field_id('Num'); ?>" name="<?php echo $this->get_field_name('Num'); ?>" type="text"  value="<?php echo $Num; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('boxheight'); ?>">高度：<font color="#ff6600">（填写阿拉伯数字）</font></label>
  <input class="widefat" id="<?php echo $this->get_field_id('boxheight'); ?>" name="<?php echo $this->get_field_name('boxheight'); ?>" type="text"  value="<?php echo $boxheight; ?>" />
</p>
<?php
}}
add_action('widgets_init',create_function('','return register_widget("zlphp_hot_article");'));
class zlphp_new_comments extends WP_Widget{
  function zlphp_new_comments(){parent::WP_Widget(false,$name='最新评论');}
  function widget($args,$instance){extract($args);
  echo $before_widget;
  if($instance['title']!=""){
  echo $before_title.$instance['title'].$after_title;}
  else{
  echo $before_title."最新评论".$after_title;}
  if($instance['boxheight']!=""){
  echo"<ul style=\"height:";
  echo $instance['boxheight'];
  echo"px\">";}
  else{
  echo"<ul>";}
  if($instance['Num']!=""){
  global$wpdb;$sql="SELECT DISTINCT ID,post_title,post_password,comment_ID,comment_post_ID,comment_author,comment_date,comment_approved,comment_type,comment_author_url,SUBSTRING(comment_content,1,300) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved='1' AND comment_type='' AND comment_author!='admin' AND post_password='' ORDER BY comment_date DESC LIMIT ".$instance['Num']."";}
  else{
  global$wpdb;$sql="SELECT DISTINCT ID,post_title,post_password,comment_ID,comment_post_ID,comment_author,comment_date,comment_approved,comment_type,comment_author_url,SUBSTRING(comment_content,1,300) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved='1' AND comment_type='' AND comment_author!='admin' AND post_password='' ORDER BY comment_date DESC LIMIT 8";}
  $comments=$wpdb->get_results($sql);$output=$pre_HTML;foreach($comments as $comment){$output.="\n<li class=\"article\"><h2><a href=\"".get_permalink($comment->ID)."#comment-".$comment->comment_ID."\" title=\"".strip_tags($comment->comment_author)."在《".$comment->post_title."》上发表的评论：".strip_tags($comment->com_excerpt)." [".strip_tags($comment->comment_date)."]\" target=\"_blank\">".strip_tags($comment->com_excerpt)."</a></h2><span>".strip_tags($comment->comment_author)."　".strip_tags($comment->comment_date)."</span></li>";}$output.= $post_HTML;echo $output;
  echo"</ul>";
  echo $after_widget;}
  function update($new_instance,$old_instance){return $new_instance;}
  function form($instance){$title=esc_attr($instance['title']);$Num=esc_attr($instance['Num']);$boxheight=esc_attr($instance['boxheight']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">标题：
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('Num'); ?>">数量：<font color="#ff6600">（填写阿拉伯数字）</font></label>
  <input class="widefat" id="<?php echo $this->get_field_id('Num'); ?>" name="<?php echo $this->get_field_name('Num'); ?>" type="text"  value="<?php echo $Num; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('boxheight'); ?>">高度：<font color="#ff6600">（填写阿拉伯数字）</font></label>
  <input class="widefat" id="<?php echo $this->get_field_id('boxheight'); ?>" name="<?php echo $this->get_field_name('boxheight'); ?>" type="text"  value="<?php echo $boxheight; ?>" />
</p>
<?php
}}
add_action('widgets_init',create_function('','return register_widget("zlphp_new_comments");'));
class zlphp_hot_tags extends WP_Widget{
  function zlphp_hot_tags(){parent::WP_Widget(false,$name='热门标签');}
  function widget($args,$instance){extract($args);
  echo $before_widget;
  if($instance['title']!=""){
  echo $before_title.$instance['title'].$after_title;}
  else{
  echo $before_title."热门标签".$after_title;}
  if($instance['boxheight']!=""){
  echo"<div class=\"tagcloud\" style=\"height:";
  echo $instance['boxheight'];
  echo"px\">";}
  else{
  echo"<div class=\"tagcloud\">";}
  if($instance['Num']!=""){
  wp_tag_cloud('smallest=12&largest=12&unit=px&number='.$instance['Num'].'&orderby=count&order=DESC');}
  else{
  wp_tag_cloud('smallest=12&largest=12&unit=px&number=30&orderby=count&order=DESC');}
  echo"</div><div class=\"line\"></div>";
  echo $after_widget;}
  function update($new_instance,$old_instance){return $new_instance;}
  function form($instance){$title=esc_attr($instance['title']);$Num=esc_attr($instance['Num']);$boxheight=esc_attr($instance['boxheight']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">标题：
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('Num'); ?>">数量：<font color="#ff6600">（填写阿拉伯数字）</font></label>
  <input class="widefat" id="<?php echo $this->get_field_id('Num'); ?>" name="<?php echo $this->get_field_name('Num'); ?>" type="text"  value="<?php echo $Num; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('boxheight'); ?>">高度：<font color="#ff6600">（填写阿拉伯数字）</font></label>
  <input class="widefat" id="<?php echo $this->get_field_id('boxheight'); ?>" name="<?php echo $this->get_field_name('boxheight'); ?>" type="text"  value="<?php echo $boxheight; ?>" />
</p>
<?php
}}
add_action('widgets_init',create_function('','return register_widget("zlphp_hot_tags");'));
class zlphp_txt_html extends WP_Widget{
  function zlphp_txt_html(){parent::WP_Widget(false,$name='文本HTML');}
  function widget($args,$instance){extract($args);
  echo $before_widget;
  if($instance['title']!=""){
  echo $before_title.$instance['title'].$after_title;}
  if($instance['boxheight']!=""){
  echo"<div class=\"txthtml\" style=\"height:";
  echo $instance['boxheight'];
  echo"px\">";}
  else{
  echo"<div class=\"txthtml\">";}
  if($instance['zlphp_txt_txt']!=""){
  echo $instance['zlphp_txt_txt'];}
  else{
  echo"暂无任何内容！";}
  echo"</div>";
  echo $after_widget;}
  function update($new_instance,$old_instance){return $new_instance;}
  function form($instance){$title=esc_attr($instance['title']);$boxheight=esc_attr($instance['boxheight']);$zlphp_txt_txt=esc_attr($instance['zlphp_txt_txt']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">标题：
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('boxheight'); ?>">高度：<font color="#ff6600">（填写阿拉伯数字）</font></label>
  <input class="widefat" id="<?php echo $this->get_field_id('boxheight'); ?>" name="<?php echo $this->get_field_name('boxheight'); ?>" type="text"  value="<?php echo $boxheight; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('zlphp_txt_txt'); ?>">内容：<font color="#ff6600">（支持普通文本以及HTML代码）</font></label>
  <textarea class="widefat" rows="12" cols="20" id="<?php echo $this->get_field_id('zlphp_txt_txt'); ?>" name="<?php echo $this->get_field_name('zlphp_txt_txt'); ?>"><?php echo $zlphp_txt_txt; ?></textarea>
</p>
<?php
}} 
add_action('widgets_init',create_function('','return register_widget("zlphp_txt_html");'));
?>