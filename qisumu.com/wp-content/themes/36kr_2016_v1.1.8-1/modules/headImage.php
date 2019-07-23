<?php if (is_home ()&&!is_paged() ) : ?>
<?php $options = get_option('monkey-options');?>

<div class="head-images J_headImages"> 
  <!--div class="scrollers"><a data-lazyload="<?php echo $options['focuspic']; ?>" href="<?php echo $options['focuslink']; ?>" id="headline_top" target="_blank"><img alt="" src="<?php echo $options['focuspic']; ?>" /><span><?php echo $options['focustitle']; ?></span></a></div-->
  
  <div id="sliderbox">
    <div id="slidebanner">
      <div class="banner-shadow"></div>
      <div style="max-width: 100%;" class="bx-wrapper">
        <div class="bx-viewport">
          <ul style="width: auto; position: relative;" id="slideshow">
           
            <?php query_posts($query_string . 'tag='. stripslashes($options['feedtag']).'&showposts=' . $limit=4)?>
    <?php while ( have_posts() ) : the_post();?>
           
           
            <li style="float: none; list-style: outside none none; position: absolute; width: 1200px; z-index: 0; display: none;"><a href="<?php the_permalink(); ?>" target="_blank"><span><?php the_title(); ?></span><img src="<?php echo MThemes_thumbnail(810,250);?>"></a></li>
          
         <?php endwhile; wp_reset_query(); ?>
         
          </ul>
        </div>
        <div class="bx-controls bx-has-pager bx-has-controls-direction">
          <div class="bx-pager bx-default-pager"> </div>
          <div class="bx-controls-direction"> </div>
        </div>
      </div>
    </div>
  </div>
  <div class="smaller-images" style=" margin-left:-15px;"> 
    <!--div class="block wider article"><a data-lazyload="<?php echo $options['focuspic2']; ?>" href="<?php echo $options['focuslink2']; ?>" id="headline_one" target="_blank"><span><?php echo $options['focustitle2']; ?></span></a></div-->
    <?php $sticky = get_option('sticky_posts'); rsort( $sticky );
		query_posts( array( 'post__in' => $sticky, 'caller_get_posts' => 1, 'showposts' => 3 ) );
		while (have_posts()) : the_post(); ?>
    <div class="block article"><a data-lazyload="<?php echo MThemes_thumbnail(260,160);?>" href="<?php the_permalink(); ?>" target="_blank"><span>
      <?php the_title(); ?>
      </span></a></div>
    <?php endwhile; wp_reset_query(); ?>
  </div>
</div>
<?php endif; ?>
