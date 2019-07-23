<div class="row-fluid">
  <?php 
  $str = get_option('category'); 
  $display_categories = explode(",",$str);
  foreach ($display_categories as $key=>$cate)
{ 
    $args = array(
      'posts_per_page' => '7',
      'tax_query' => array(
        'relation' => 'OR',
        array(
          'taxonomy' => 'category',
          'field' => 'id',
          'terms' => $cate
        ),
      )
    );
   $query = new WP_Query( $args );
   $i=0;
?>
  <div class="<?php if($key%2==0){echo 'span6 home-reviews no-margin-left';}else{ echo 'span6 home-reviews';}?>">
    <?php 
          while ($query->have_posts()) : $query->the_post();
          if ($post->post_type == 'post') {
          	  	$taxonomy = 'category';
          }
          $term = get_term($cate,$taxonomy);
          $cat_name = $term->name;
          $cat_link = get_term_link($term,$taxonomy );
          $i++;if($i==1){
      ?>
    <div class="header">
      <div class="base">
        <h4><?php echo "$cat_name";?></h4>
        <a href="<?php echo $cat_link;?>">More....</a> </div>
    </div>
    <div class="item"> <a href="<?php the_permalink() ?>">
      <figure class="figure-hover"> <img src="<?php echo catch_first_image('m')?>" alt="<?php the_title(); ?>"> </figure>
      </a>
      <div class="content">
        <h3><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink() ?>">
          <?php the_title(); ?>
          </a></h3>
        <span> <i class="icon-time"></i>
        <?php the_time('Y-m-d') ?>
        丨 <i class="icon-eye-open"></i><?php echo getPostViews(get_the_ID());?>浏览 </span> </div>
    </div>
    <?php }else{?>
    <div class="item">
      <div class="con">
        <h3 class="pull-left"><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink() ?>">
          <?php the_title(); ?>
          </a> </h3>
        <div> <span class="pull-right">
          <?php the_time('Y-m-d') ?>
          </span> </div>
      </div>
    </div>
    <?php }if($i==7){?>
    <?php } endwhile; wp_reset_query();?>
  </div>
  <?php if($key==1)echo '<div class="clearfix ie-sep"></div>'?>
  <?php if($key==3)echo '<div class="clearfix ie-sep"></div>'?>
  <?php if($key==5)echo '<div class="clearfix ie-sep"></div>'?>
  <?php if($key==1 && get_option(ad6)!='')echo '<div class="k_ad">'.get_option(ad6).'</div>'?>
  <?php if($key==3 && get_option(ad7)!='')echo '<div class="k_ad">'.get_option(ad7).'</div>'?>
  <?php if($key==5 && get_option(ad8)!='')echo '<div class="k_ad">'.get_option(ad8).'</div>'?>
  <?php }?>
</div>
