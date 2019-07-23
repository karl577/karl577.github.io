<?php get_header(); // 调用 header.php ?>
<div id="main-content">
  <div class="container">
    <?php while ( have_posts() ) : the_post(); // 循环开始 ?>
    <div class="row">
       <div class="span8">      
         <div id="post-<?php the_ID(); ?>">
          <?php
          /**
           * 获取在同一相册里所有图像附件的 ID，这样我们就可以得到相册里的当前图像的下一张图像。
           * 或第一张图像（如果我们查看相册里的最后一张图像），或，相册里只有一张图像，链接它到图像文件。
           */
          $attachments = array_values( get_children( array( 
              'post_parent'     => $post->post_parent, 
              'post_status'     => 'inherit', 
              'post_type'       => 'attachment', 
              'post_mime_type'  => 'image', 
              'order'           => 'ASC', 
              'orderby'         => 'menu_order ID' 
              ) ) );
          foreach ( $attachments as $k => $attachment ) :
               if ( $attachment->ID == $post->ID )
                  break;
          endforeach;
          $k++;
          // 如果在相册里的附件数量大于 1
          if ( count( $attachments ) > 1 ) :
             if ( isset( $attachments[ $k ] ) ) :
                // 获得下一图像附件的 URL
                $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
             else :
                // 或者获得第一个图像附件的 URL
                $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
             endif;
          else :
               // 或者，如果只有一个图像，获得图像的 URL
               $next_attachment_url = wp_get_attachment_url();
          endif;
          ?>
          <a href="<?php echo esc_url( $next_attachment_url ); ?>" 
             title="<?php the_title_attribute(); ?>">
            <?php // 显示图像附件
            $attachment_size = apply_filters( 'fenikso_attachment_size', array( 960, 960 ) );
            echo wp_get_attachment_image( $post->ID, $attachment_size );
            ?>
          </a>
          <?php if ( ! empty( $post->post_excerpt ) ) : ?>
          <div class="content-box">
            <?php the_excerpt(); // 内容摘要 ?>
          </div>
          <?php endif; ?>                  
         </div>
         <?php if ( function_exists( 'bcn_display' ) ): // 判断 bcn_display 函数是否存在 ?>    
         <ul class="breadcrumb">
            <?php bcn_display(); // 显示面包屑 ?>
         </ul>
         <i class="icon-bow"></i>
         <?php endif; ?>    
       <?php comments_template(); // 调用评论模板文件 comments.php ?> 
       </div>
       <div class="span4">       
         <h1>
           <?php the_title(); // 显示内容大标题 ?>
         </h1>
         <?php the_content(); // 显示页面内容 ?>
         <footer>
          <?php
             $metadata = wp_get_attachment_metadata();   
             printf( __( '<dl><dt>Published</dt> <dd><time class="entry-date" datetime="%1$s">%2$s</time></dd> <dt>Image Size</dt><dd><a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a></dd><dt>Belong</dt><dd><a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a></dd></dl>', 'fenikso' ),
                  esc_attr( get_the_date( 'c' ) ),
                  esc_html( get_the_date() ),
                  esc_url( wp_get_attachment_url() ),
                  $metadata['width'],
                  $metadata['height'],
                  esc_url( get_permalink( $post->post_parent ) ),
                  esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
                  get_the_title( $post->post_parent )
             );
          ?>
           <a class="btn btn-mini" href="<?php echo get_edit_post_link( $page->ID); ?>"> 
             <i class="icon-wrench"></i>
           </a>
         </footer>
         <ul class="pager">
           <li class="previous">
             <?php previous_image_link( false, __( '&larr; Previous', 'fenikso' ) ); // 向前翻页 ?>
           </li>
           <li class="next">
             <?php next_image_link( false, __( 'Next &rarr;', 'fenikso' ) ); // 向后翻页 ?>
           </li>
         </ul>
       </div>
    </div>
    <?php endwhile; // 循环结束 ?>
  </div>
</div>
<?php get_sidebar(); // 调用 sidebar.php ?>
<?php get_footer(); // 调用 footer.php ?> 