<?php get_header(); ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
          <div class="span8">
            <?php if ( have_posts() ): ?>
               <?php while ( have_posts() ) : the_post(); ?>
            
            <h1 class="article-title"><?php the_title(); ?></h1>
            <footer class="content-meta">
              <time><i class="icon-calendar"></i> <?php the_date(); ?></time>
              <span><i class="icon-book"></i> <?php the_category( ' ' ); ?></span>
              <span><i class="icon-tags"></i> <?php the_tags( ' ', ' ' ); ?></span>
              <span><?php comments_popup_link( '<i class="icon-comment"></i>', '<i class="icon-comment"></i> 1', '<i class="icon-comment"></i> %' ); ?></span>
            </footer>
            <div id="content">
              <?php the_content(); ?>
            </div>
            <div class="content-meta"> 
            	<span> 
            		<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" 
            		    rel="tooltip"
            		    data-placement="left" 
            		    data-original-title="<?php echo get_the_author() ?>">
            			<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>				
            		</a>
            	</span>
              <time><?php echo get_the_date('Y-m-d'); ?></time>
              <span class="post-tool-btn btn-group pull-right"> 
              	<a class="btn btn-mini" href="<?php echo get_edit_post_link( $page->ID); ?>"> <i class="icon-wrench"></i></a> 
             	<?php comments_popup_link( '<i class="icon-comment"></i>', '<i class="icon-comment"></i> 1', '<i class="icon-comment"></i> %', 'btn btn-mini' ); ?> 
              </span>
              <?php fenikso_the_meta(); ?>
             </div> 
            <?php endwhile; ?>
            <?php endif; ?>
            <ul class="pager">
              <li class="previous">
                <?php previous_post_link( '%link', '&larr; ' . '%title' ); ?>
              </li>
              <li class="next">
                <?php next_post_link( '%link', '%title' . ' &rarr;' ); ?>
              </li>
            </ul>
            <?php if ( function_exists( 'bcn_display' ) ): ?>    
            <ul class="breadcrumb">
               <?php bcn_display(); ?>
            </ul>
            <i class="icon-bow"></i>
            <?php endif; ?>
            <?php comments_template(); ?>            
          </div>
          <?php get_sidebar( 'right' ); ?>
        </div>
      </div>
    </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>