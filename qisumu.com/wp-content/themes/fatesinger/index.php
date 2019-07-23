<?php get_header(); ?>

<article>

  <div id="content">
	<section id="home-subheroes" class="grid trackable">
	<div class="topcate">
	<section class="subheroes1 subheroes">
	<article class="story swiper-slide">
	<div class="subhero-box ">
	<a href="<?php echo dopt('fate_top_1'); ?>">
	<span class="series-tag"><?php bloginfo('name');?></span>
	<img class="poster" alt="<?php bloginfo('name');?>" src="<?php bloginfo('template_directory'); ?>/images/design.jpg">
	</a>
	</div>
	</article>
	
	</section>
	</div>
	
	
	
	<div class="topcate">
	<section class="subheroes2 subheroes">
	<article class="story swiper-slide">
	<div class="subhero-box ">
	<a href="<?php echo dopt('fate_top_2'); ?>">
	<span class="series-tag"><?php bloginfo('name');?></span>
	<img class="poster" alt="<?php bloginfo('name');?>" src="<?php bloginfo('template_directory'); ?>/images/php-screen.jpg">
	</a>
	</div>
	</article>
	
	</section>
	</div>
	
	
	
	<div class="topcate">
	<section class="subheroes3 subheroes">
	<article class="story swiper-slide">
	<div class="subhero-box ">
	
	<span class="series-tag"><?php bloginfo('name');?></span>
	<a href="<?php echo dopt('fate_top_3'); ?>">
	<img class="poster" alt="<?php bloginfo('name');?>" src="<?php bloginfo('template_directory'); ?>/images/feelgood.jpg">
	</a>
	</div>
	</article>
	
	</section>
	</div>
	
	</section>
	
	
	<div id="headersep"></div>
	<section id="primary">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="post">
	  <div class="selfthum"><?php post_thumbnail( 200,135 ); ?></div>
	  <?php if( is_sticky() ) {echo '<div class="sticky">Sticky</div>'; }
			  else {echo '<div class="hometime">'.get_bloginfo('name').'</div>'; }
	  ?> 
	  <div class="post-entry">
        <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
          <?php the_title(); ?>
          </a></h2>
        
        <div class="entry-content">
           <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 320,"……"); ?>
        </div>
        <div class="post-meta"><span><?php the_author() ?></span><span><?php the_category(', ') ?></span><span><?php the_time('d,m,Y')?></span><span><?php comments_popup_link('No Reply', '1 Reply', '% Replies'); ?></span></div>
      </div> </div>
      
      <?php endwhile; endif;?>
	  </section>
      <nav id="postnavigation"><?php par_pagenavi(6); ?></nav>
   
  </div>
  <!--#end content-->
  <?php get_sidebar(); ?>
</article>
<?php get_footer(); ?>
