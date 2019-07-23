<div class="post-sidebar">
                                    <div class="sidebar-box"><?php // 如果没有使用 Widget 才显示以下内容, 否则会显示 Widget 定义的内容
if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) :
?>
                    <div class="box-title">相关文章</div>
                    <div class="box-body">
                      <ul class="related-posts">
                                               <?php
$post_tags = wp_get_post_tags($post->ID);
if ($post_tags) {
foreach ($post_tags as $tag){
$tag_list[] .= $tag->term_id;
}
$post_tag = $tag_list[ mt_rand(0, count($tag_list) - 1) ];
$args = array(
'tag__in' => array($post_tag),
'category__not_in' => array(NULL),
'post__not_in' => array($post->ID),
'showposts' => 6,
'caller_get_posts' => 1
);
query_posts($args);
if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
<li>
<a href="http://www.laozuo.org/<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
</li>
<?php endwhile; else : ?>
<?php $ashu_cats = wp_get_post_categories($post->ID);
if( $ashu_cats ){
$args = array(
'category__in' => array( $ashu_cats[0] ),
'post__not_in' => array( $post->ID ),
'showposts' => 6,
'caller_get_posts' => 1
);
query_posts($args);
if( have_posts()):while(have_posts()):the_post();update_post_caches($posts);?>
<li>
<a href="http://www.laozuo.org/<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
</li>
<?php endwhile; endif; wp_reset_query(); } ?>
<?php endif; wp_reset_query(); } ?>
                                              </ul>
                    </div>
                  </div>
                                    <div class="sidebar-box qrcode-box">
                    <div class="box-body">
                      <div class="qrcode-mxd">
                        <img src="http://mxd.tencent.com/wp-content/uploads/2013/11/mxd_qrcode.jpg" alt="">
                      </div>
                      <div class="qrcode-title">微信公众账号</div>
                    </div>
                <?php endif; ?>  </div>
                </div>