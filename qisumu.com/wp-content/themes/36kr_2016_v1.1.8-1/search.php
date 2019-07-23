<?php get_header();?>
<link href="<?php bloginfo("template_url")?>/static/css/search.css" media="all" rel="stylesheet" />
<div class="search-result-wrap">
  <div class="main-section">
    <div class="result-list J_resultListWrap">
      <div class="result-info">
        <div class="keyword"><em class="highlight">'<?php echo $_GET['s'];?>'</em>的搜索结果</div>
        <div class="count">结果数：<em class="highlight"><?php global $wp_query;echo $wp_query->found_posts; ?></em></div>
      </div>
      <div class="article-list">
        <div class="articles J_articleList ias_container">
          <?php get_template_part( 'content', get_post_format() );?>
        </div>
      </div>
    </div>
    <div class="index-side">
    <?php get_sidebar();?>
    </div>
  </div>
</div>
<?php get_footer();?>