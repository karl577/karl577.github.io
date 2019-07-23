<?php get_header(); ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
          <div class="span8">
            <?php if ( have_posts() ): ?>
               <?php while ( have_posts() ) : the_post(); ?>
            
            <h1 class="article-title"><?php the_title(); ?></h1>
              <div id="content">
              <?php the_content(); ?>
            </div>
             <?php endwhile; ?>
            <?php endif; ?>
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