<?php get_header(); ?>
<div id="main">
<div class="dsubmain">
<div id="document">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article class="document-article">
<header class="document-header">
<h1 class="document-title"><?php the_title(); ?></h1>
<div class="document-meta">
<time class="entry-time">2014年3月12日</time> <span class="categories-links"><?php the_category(' '); ?></span>   <span class="comments-link"><?php comments_popup_link('暂无评论', '1 条评论', '% 条评论', 'commentlink', ''); ?></span><?php edit_post_link('编辑','<span class="edit-link">','</span>'); ?>
</div>
</header>
<div class="document-content">
<?php the_content(); ?>
</div>
</article>
<?php endwhile; ?>
    <!-- Blog Navigation -->
    <p class="clearfix"><?php previous_posts_link('&lt;&lt; 查看新文章', 0); ?> <span class="float right"><?php next_posts_link(' 查看旧文章 &gt;&gt;', 0); ?></span></p>
    <?php else : ?>
    <h3 class="title"><a href="#" rel="bookmark">Not Found</a></h3>
    <p>Not Found</p>
<?php endif; ?>



<div class="document-tag">
<?php
if (get_the_tags()) { ?>
	<span class="tag-link"><?php the_tags(' ', ', ', '')?></span>
<?php } ?>
</div>


<!-- <span class="tag-link"><?php the_tags(' ', ', ', '');?></span> -->




<div class="babox pull-left">


<?php
$prev_post = get_previous_post();
if (!empty( $prev_post )): ?>
  <a class="pull-left" href="<?php echo get_permalink( $prev_post->ID ); ?>">上一篇：<?php echo $prev_post->post_title; ?></a>
<?php endif; ?>

<?php
$next_post = get_next_post();
if (!empty( $next_post )): ?>
  <a class="pull-right" href="<?php echo get_permalink( $next_post->ID ); ?>">下一篇：<?php echo $next_post->post_title; ?></a>
<?php endif; ?>


</div>



</div>

<div id="comments">
<?php comments_template(); ?>  
</div>



</div>
</div>
<!-- <div class="footer-bg"></div> -->
<?php get_footer(); ?>