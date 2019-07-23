<div class="post">
  <h2>相关文章</h2>
<ul class="tags_related">
<?php
global $post;
$post_tags = wp_get_post_tags($post->ID);
if ($post_tags) {
  foreach ($post_tags as $tag) {
    // 获取标签列表
    $tag_list[] .= $tag->term_id;
  }
  // 随机获取标签列表中的一个标签
  $post_tag = $tag_list[ mt_rand(0, count($tag_list) - 1) ];
  // 该方法使用 query_posts() 函数来调用相关文章，以下是参数列表
  $args = array(
        'tag__in' => array($post_tag),
        'category__not_in' => array(NULL),  // 不包括的分类ID
        'post__not_in' => array($post->ID),
        'showposts' => 3,                           // 显示相关文章数量
        'caller_get_posts' => 1
    );
  query_posts($args);
  if (have_posts()) {
    while (have_posts()) {
      the_post(); update_post_caches($posts); ?>
    <li>
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="thumbnail">
        <?php if ( has_post_thumbnail() ) { ?>
        <?php the_post_thumbnail(); ?>
        <?php } else { ?>
        <img width="150" height="150" src="<?php echo get_template_directory_uri();  ?>/images/thumbnail/<?php echo rand(1,20)?>.jpg" class="attachment-post-thumbnail wp-post-image"/>
        <?php } ?>
        </a>
      <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
<?php
    }
  }
  else {
    echo '<li><a href="" class="thumbnail"><img width="150" height="150" src="'.get_template_directory_uri().'/images/thumbnail/0.jpg" class="attachment-post-thumbnail wp-post-image"/></a></li>';
  }
  wp_reset_query();
}
else {
  echo '<li><li><a href="" class="thumbnail"><img width="150" height="150" src="'.get_template_directory_uri().'/images/thumbnail/0.jpg" class="attachment-post-thumbnail wp-post-image"/></a></li>';
}
?>
</ul>
</div>