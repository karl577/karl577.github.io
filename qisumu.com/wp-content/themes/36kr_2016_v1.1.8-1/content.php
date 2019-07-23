<?php $list_a = 1;while ( have_posts() ) : the_post();$list_a ++;?>
<article class="excerpt ias_excerpt">
	<a class="pic info_flow_news_image badge-MBT" data-fit-mobile="true" data-lazyload="<?php echo MThemes_thumbnail(260,160);?>" href="<?php the_permalink(); ?>"></a>
   
    <?php $category = get_the_category();if($category[0]){$color = get_option('cat-color-'.$category[0]->term_id); echo '<a href="'.get_category_link($category[0]->term_id ).'"><span class="info_cat" style="background:'.get_option('cat-color-'.$category[0]->term_id).';">'.$category[0]->cat_name.'</span></a>';}?>
    
    <div class="desc"><a class="title info_flow_news_title" href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a>
      <div class="author">文 /<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"> <span class="name"><?php echo get_the_author() ?></span></a><span class="time">&nbsp;&nbsp;
        <time class="timeago" datetime="<?php echo get_gmt_from_date(get_the_time('Y-m-d G:i:s') ) ?>"><?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ) ?></time>&nbsp;&nbsp;
        <span class="tageo"><?php the_tags('<i class="fa fa-tag" aria-hidden="true"></i>',' ','');?></span>

        </span></div>
      <div class="brief">  <?php if (has_excerpt()) {
                                    echo $description = get_the_excerpt();
                                }else {
                                    echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 150,"...","utf-8");
                                } ?></div>
    </div>
</article>
<?php $options = get_option('monkey-options');if($options['listad'] && $list_a == 3){?>
<article class="ad-wrapper">
<?php echo $options['adlist'];?>
</article>
<?php }?>
<?php endwhile; wp_reset_query();?> 
<?php MBT_monkey_pagination();?>