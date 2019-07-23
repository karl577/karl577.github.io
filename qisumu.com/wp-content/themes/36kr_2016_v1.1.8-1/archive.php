<?php get_header();$options = get_option('monkey-options');?>
<link href="<?php bloginfo("template_url")?>/static/css/index.css" media="all" rel="stylesheet" />
<div class="index-wrap"><?php get_sidebar();?>
  <div class="main-section">
  	<?php if($options['archivead']){?><div class="ad mobile-hide"><?php echo $options['archivead'];?></div><?php }?>
    <div class="news-list J_articleListWrap" style="margin-top:-20px;">
      <div class="article-list">
        <div class="articles J_articleList ias_container">
          <?php get_template_part( 'content', get_post_format() );?>
        </div>
      </div>
    </div>
    <!--div class="index-side mobile-hide">
    
    </div-->
  </div>
</div>
<?php if($options['ajaxpage']){?><script src="<?php bloginfo("template_url")?>/static/js/ias.min.js"></script><?php }?>
<?php get_footer();?>

