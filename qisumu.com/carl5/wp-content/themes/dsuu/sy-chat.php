<div class="item col1">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="inner">
<a href="<?php the_permalink() ?>#replytop" title="我要评论" rel="nofollow" target="_blank"><span class="pinl"></span></a>
<div class="ttpic"><a class="gif" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><?php the_post_thumbnail('medium'); ?><span class="in_gif"></span></a></div>
<div class="title"><h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></h2><div class="ot"><?php
$posttags = get_the_tags();
$count=0;
if($posttags) {
foreach($posttags as $tag) {
$count++;
if($count<4){
echo '<a href="'.get_tag_link($tag->term_id).'" rel="tag">'.$tag->name.'</a>';
}
}
}
?><div class="d"><span class="d1" title="浏览人数"><?php the_views(); ?></span></div></div></div>
<div class="syarticle"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="outer-box-link" rel="nofollow" target="_blank"></a><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 170, "..."); ?></div>
</div>
</article>
</div>