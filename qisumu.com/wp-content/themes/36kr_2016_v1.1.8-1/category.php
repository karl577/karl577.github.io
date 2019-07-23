<?php if($_GET['filter'] == '1'){?>
	  <?php get_template_part( 'content', get_post_format() );?>
<?php }else{?>
<?php get_header();?>
<link href="<?php bloginfo("template_url")?>/static/css/index.css" media="all" rel="stylesheet" />
<div class="index-wrap"> 
  <?php if($options['focusenabled']) include('modules/headImage.php');?>
  <div class="main-section">
    <div class="news-list J_articleListWrap" <?php if(!$options['catmenu']) echo 'style="margin-top:-20px;"'; ?>>
      <?php if($options['catmenu']) include('modules/newsListNavBar.php');?>
      <div class="article-list">
        <div class="articles J_articleList ias_container">
          <?php get_template_part( 'content', get_post_format() );?>
        </div>
      </div>
    </div>
    <!--div class="index-side mobile-hide">
   
    </div--><?php get_sidebar();?>
  </div>
</div>
<?php if($options['ajaxpage']){?><script src="<?php bloginfo("template_url")?>/static/js/ias.min.js"></script><?php }?>
<?php get_footer();?>
<?php }?>

