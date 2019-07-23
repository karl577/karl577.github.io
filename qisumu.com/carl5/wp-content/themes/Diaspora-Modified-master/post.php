<div class="post">
    <a data-id="<?php the_ID() ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <img width="680" height="440" src="<?php echo mmimg(get_the_ID()) ?>" class="cover" />
    </a>
    <div class="else">
        <p><?php the_time('F j, Y'); ?></p>
        <h3><a data-id="<?php the_ID() ?>" class="posttitle" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 100,"..."); ?></p>
        <p class="here">
            <span class="icon-letter"><?php echo count_words(); ?></span>
            <span class="icon-view"><?php echo getPostViews(get_the_ID()); ?></span>
            <?php tz_printLikes(get_the_ID()); ?>
        </p>
    </div>
</div>
