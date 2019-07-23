<div class="item col1">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="title"><h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2><div class="ot"><?php the_author_posts_link(); ?> 于 <?php the_time('Y-m-j a g:i');?> 发布在 <?php the_category(', ')?> 栏目中</div></div>
<div class="inner">
<p><?php the_post_thumbnail('medium'); ?></p>
<p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 160, "..."); ?></p>
<div class="tag">TAG: <?php the_tags('', ' ' , ''); ?><div class="oall"><a href="<?php the_permalink() ?>" class="yc">阅读全文</a><div class="d"><span class="d1" title="浏览人数"><?php get_post_views($post -> ID); ?></span><span class="d2" title="讨论人数"><?php comments_number('0', '1', '%'); ?></span></div></div></div>
</div>
</article>
</div>