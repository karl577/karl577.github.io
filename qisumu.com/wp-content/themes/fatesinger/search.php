<?php get_header(); ?>
	<article>      
							
						
				<div id="content">
					 			
					<div class="Search_title">搜索&nbsp;“<?php the_search_query(); ?>”&nbsp;的结果</div>       
					<section id="primary">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="post">
	  <div class="selfthum"><?php post_thumbnail( 200,135 ); ?></div>
	  <div class="hometime">Fatesinger</div>
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
				</div><!--#end content-->	
			<?php get_sidebar(); ?>
		</article> 
		<?php get_footer(); ?>
	