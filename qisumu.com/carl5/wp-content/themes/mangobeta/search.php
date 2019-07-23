<?php get_header(); ?>
<div id="main">
<div class="submain">
<div id="content">
<h4 class="searchh4">"<?php echo $s ?>"搜索结果：</h4>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article class="entry-article">
<header class="entry-header">
<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<div class="entry-meta"> <time class="entry-time">2014年3月12日</time> <span class="categories-links"><?php the_category(' '); ?></span>   <span class="comments-link"><?php comments_popup_link('暂无评论', '1 条评论', '% 条评论', 'commentlink', ''); ?></span><span class="edit-link"><?php edit_post_link('编辑','<span class="editlink">','</span>'); ?></span> </div>
</header>
<div class="entry-content">
<?php ($post->post_excerpt != "")? the_excerpt() : the_content(); ?>
</div>



</article>
<?php endwhile; ?>
    <?php else : ?>
    <h3 class="title"><a href="#" rel="bookmark">Not Found</a></h3>
    <p>Not Found</p>
<?php endif; ?>


</div>

<?php get_sidebar(); ?>
<div class="pagenext">

<?php
//检测pagenavi插件是否存在
if (function_exists('wp_pagenavi')) {
    wp_pagenavi();
} else { ?>
    
        <span class="next pull-left"><?php previous_posts_link('<< 上一页') ?></span>
        <span class="previous pull-right"><?php next_posts_link('下一页 >>') ?></span>
    
    <? } ?>

</div>


</div>

</div>
<!-- <div class="footer-bg"></div> -->
<?php get_footer(); ?>