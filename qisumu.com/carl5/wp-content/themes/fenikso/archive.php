<?php get_header(); ?>
<div id="main-content">
  <div class="container">
    <h4 class="archives-title">
    <?php
    	/* 查询第一个文章，这样我们就知道整个页面的作者是谁。
    	 * 在下面我们使用 rewind_posts() 重置了一下，这样一会儿我们才能正确运行循环。
    	 */
    	the_post();
    ?>
    <?php
    	if ( is_day() ) :
    		printf( __( 'Daily Archives: %s', 'fenikso' ), '<span>' . get_the_date() . '</span>' );
    	elseif ( is_month() ) :
    		printf( __( 'Monthly Archives: %s', 'fenikso' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'fenikso' ) ) . '</span>' );
    	elseif ( is_year() ) :
    		printf( __( 'Yearly Archives: %s', 'fenikso' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'fenikso' ) ) . '</span>' );
    	elseif ( is_category() ) :
    	  printf( __( 'Category Archives: %s', 'fenikso' ), '<span>' . single_cat_title( '', false ) . '</span>' );
    	elseif ( is_tag() ) :
    	  printf( __( 'Tag Archives: %s', 'fenikso' ), '<span>' . single_tag_title( '', false ) . '</span>' );
    	elseif ( is_author() ) :
    	  printf( __( 'Author Archives: %s', 'fenikso' ), '<span>' . get_the_author() . '</span>' );
    	else :
    		_e( 'Archives', 'fenikso' );
    	endif;
    ?>
    <?php 
      /* 把循环恢复到开始，
       * 这样下面的循环才能正常运行。
       */
      rewind_posts(); 
    ?>
    </h4>
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


