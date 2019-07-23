<?php get_header(); ?>

<div id="main-content">
  <div class="container">
    <div class="thumbnails">
    <?php if ( have_posts() ): ?>
       <?php while ( have_posts() ) : the_post(); ?>
        <article class="span6">
          <div class="media-box">
            <?php the_post_thumbnail(); ?>
          </div>
          <div class="content-box">
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <footer class="content-meta">
              <span>
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="tooltip" data-placement="left" data-original-title="<?php echo esc_attr( get_the_author() ); ?> ">
                  <?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
                </a>
              </span> 
              <time><?php echo get_the_date( 'Y-m-d' ); ?></time>
              <span><?php the_category( ' ' ); ?></span>
              <div class="btn-group pull-right">
                <a href="#" class="btn btn-mini" rel="popover" data-original-title="<?php esc_attr_e( 'Summary', 'fenikso ' ); ?>" data-content="<?php echo esc_attr( get_the_excerpt() ); ?>" data-placement="top" data-trigger="hover"><i class="icon-info-sign"></i></a>
               <?php comments_popup_link( '<i class="icon-comment"></i>', '<i class="icon-comment"></i> 1', '<i class="icon-comment"></i> %', 'btn btn-mini' ); ?>
              </div>
            </footer>
          </div>
        </article>
       <?php endwhile; ?>
     <?php endif; ?>
    </div>
    <ul class="pager">
      <li class="previous">
        <?php previous_posts_link( __( '&larr; Previous', 'fenikso' ) ); ?>
      </li>
      <li class="next">
        <?php next_posts_link( __( 'Next &rarr;', 'fenikso' ) ); ?>
      </li>
    </ul>
    <?php if ( function_exists( 'bcn_display' ) ): ?>    
    <ul class="breadcrumb">
       <?php bcn_display(); ?>
    </ul>
    <i class="icon-bow"></i>
    <?php endif; ?>
  </div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>


