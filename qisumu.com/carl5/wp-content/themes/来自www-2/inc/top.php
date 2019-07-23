<div class="home-galleries no-margin-left">
  <div class="header">
    <div class="base">
      <h4>置顶文章</h4>
    </div>
  </div>
  <?php
$args = array(
	'posts_per_page' => 4,
	'post__in'  => get_option( 'sticky_posts' ),
	'ignore_sticky_posts' => 1
);
query_posts( $args ); while ( have_posts() ) : the_post();?>
  <div class="item">
    <figure class="figure-overlay figure-overlay-icon"> <a href="<?php the_permalink(); ?>"> <img src="<?php echo catch_first_image('medium')?>" alt="<?php the_title_attribute(); ?>">
      <div>
        <p class="icon-plus"></p>
      </div>
      </a> </figure>
    <p><a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 28, '…'); ?></a></p>
  </div>
  <?php endwhile;wp_reset_query();?>
</div>
