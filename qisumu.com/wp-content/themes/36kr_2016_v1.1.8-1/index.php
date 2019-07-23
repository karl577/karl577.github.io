<?php get_header();$options = get_option('monkey-options');?>
<link href="<?php bloginfo("template_url")?>/static/css/index.css" media="all" rel="stylesheet" />
<div class="index-wrap">

  <?php if($options['focusenabled']) include('modules/headImage.php');?>
  
  <div class="main-section">
    <div class="news-list J_articleListWrap" <?php if(!$options['catmenu']) echo 'style="margin-top:-20px;"'; ?>>
    <?php if($options['catmenu']) include('modules/newsListNavBar.php');?>
      <div class="article-list">
        <div class="articles J_articleList ias_container">
          <?php 
		    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		  	$args = array(
				'caller_get_posts' => 1,
				'paged' => $paged
			);
			query_posts($args);
			get_template_part( 'content', get_post_format() );
		  ?>
        </div>
      </div>
    </div>    <?php get_sidebar();?>
    <!--div class="index-side mobile-hide">
    </div-->
  </div>
</div>
<?php if($options['ajaxpage']){?><script src="<?php bloginfo("template_url")?>/static/js/ias.min.js"></script><?php }?>
<?php get_footer();?>
