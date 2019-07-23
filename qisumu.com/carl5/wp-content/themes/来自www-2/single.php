<?php get_header();?>
  
  <div class="row-fluid">
   <div id="main" class="span8 single single-post image-preloader">
  
    <div class="row-fluid">
    
     <?php include('inc/location.php');?> 
     <?php if(have_posts()) : while (have_posts()) : the_post();setPostViews(get_the_ID()); ?>
     <div class="head-section-content">
       <h1><?php the_title(); ?></h1>
       <p class="meta">
       <i class="icon-user"></i>&nbsp;<?php the_author_posts_link(); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
       <i class="icon-time"></i>&nbsp;<?php the_time('Y年n月j日') ?>&nbsp;&nbsp;|&nbsp;&nbsp;
	   <i class="icon-list-alt"></i><?php the_category(', ') ?>&nbsp;&nbsp;|&nbsp;&nbsp;
       <i class="icon-comment"></i>&nbsp;<?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
       <i class="icon-eye-open"></i>&nbsp;<?php echo getPostViews(get_the_ID());?><?php edit_post_link('[编辑]', '  ', '  '); ?></p>
      </div>
     <?php
	 	 $ad4_close = get_option('ad4_close');
	 	 if ($ad4_close == 'open') {
	?>
	<div  class="k_ad">
	 	<?php echo get_option('ad4');?>
	</div>
	<?php } ?>
     <div class="content">
     
      <?php the_content(); ?>
      
      <?php
	 	 $copyright_close = get_option('copyright_close');
	 	 if ($copyright_close == 'open') {
	?>
	<?php deel_copyright(); ?>
	<?php } ?>
	  <div class="tags">
       <?php the_tags('<div class="article-tags">本文Tags： ','','</div>'); ?>
          
      </div> 
      <?php
	 	 $share_close = get_option('share_close');
	 	 if ($share_close == 'open') {
	?>
	<?php deel_share(); ?>
	<?php } ?>
      
     </div> 
     

     
     <?php
	 	 $author_close = get_option('author_close');
	 	 if ($author_close == 'open') {
	?>
    <div class="sep-border"></div>
	<div class="post-author clearfix">
      
      <figure><?php echo enews_avatar($post->post_author,'140');?></figure>
      <div class="content">
       <h5><?php the_author_posts_link(); ?></h5>
       <p><?php 
		 			if(get_the_author_meta("description") != ""){
		 				the_author_meta("description");
		 			}else{
		 				echo "这家伙很懒，什么都没写！";
		 			}
		 		?></p>
      </div>
     </div>
	<?php } ?>

     
     <div class="sep-border no-margin-bottom"></div> 
     
     <div class="prevnext-posts clearfix">
      <span class="prev"><?php if (get_previous_post()) { previous_post_link('<p>上一篇：</p> %link');} else {echo "<p>没有了</p>已经是最后文章";} ?></span>
      <span class="next"><?php if (get_next_post()) { next_post_link('<p>下一篇：</p> %link');} else {echo "<p>没有了</p>已经是最新文章";} ?></span>
      


     </div> 
     
     <div class="sep-border no-margin-top"></div> 
     
     
      
<?php  
	 	$tag = get_the_terms($post->ID,'post_tag');
	 	if(!empty($tag)){
	 		foreach ($tag as $tags) {
           		$arr[] = $tags->term_id;
         	}
         	$args = array(
          		'posts_per_page' => 4,
          		'post__not_in' => array($post->ID),
          		'orderby' => 'rand',
          		'tax_query' => array(
		            array(
		              'taxonomy' => 'post_tag',
		              'terms' => $arr,
		            )
          		)
         	);
         	$query = new WP_Query( $args );
	 		if ($query->have_posts()) {
	?>
    <div class="related-posts">
	<h3>你可能也喜欢</h3>
	<div class="related">
	 	<?php
         	$i = 1;
         	while ( $query->have_posts() ) : $query->the_post();
         	$i == 6?$pdn = "class='pdn'" : $pdn = "";
          	echo "<div class='item span3'><a href=".get_permalink()."> <figure class='figure-hover'>
         <img alt='".get_the_title()."' src='".catch_first_image('m')."'/>
         <div class='figure-hover-masked'>
          <p class='icon-plus'></p>
         </div>
        </figure>
       </a>
       <p>".get_the_title()."</p>
      </div>";
          	$i++;
         	endwhile;wp_reset_query();
        ?>
	</div>
    </div>
    <div class="sep-border"></div>
	<?php }}?>
      

      <?php
	 	 $ad5_close = get_option('ad5_close');
	 	 if ($ad5_close == 'open') {
	?>
	<div  class="k_ad">
	 	<?php echo get_option('ad5');?>
	</div>
	<?php } ?>
     
     <div id="comments">

      <?php comments_template(); ?>

     </div> 
   
    </div> 
   </div> 
  
   <?php endwhile; endif; ?>
	<?php get_sidebar(); ?> 
  
  </div> 
 </div> 
 <script>
	window._bd_share_config = {
        common: {
            "bdText": "",
            "bdMini": "2",
            "bdMiniList": false,
            "bdPic": "",
            "bdStyle": "0"
        },
        share: [{
            bdCustomStyle: '<?php bloginfo('template_url');?>/css/share.css'
        }]
    }
    with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion=' + ~(-new Date() / 36e5)];
    </script>
 <?php get_footer(); ?>