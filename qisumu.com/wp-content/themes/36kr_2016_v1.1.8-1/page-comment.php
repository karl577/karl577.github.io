<?php 
/*
	template name: 我的评论
	description: template for wazhuti.com Monkey theme 
*/
if(!is_user_logged_in()){
	echo "<script>window.location.href='".get_permalink(get_page_id_from_template('page-login.php'))."';</script>";
}
get_header();
global $wpdb;
?>
<link rel="stylesheet" href="<?php bloginfo("template_url")?>/static/css/user.css">
<div class="content main-content-wrap ng-scope">
  <div class="user-center-wrapper ng-scope">
    <div class="container">
      <div class="row">
        <?php include('modules/pageUserSide.php');?>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
          <div class="favorite-wrapper ng-scope">
            <?php 
				$counts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE user_id=" . get_current_user_id());
				$perpage = 10;
				$pages = ceil($counts / $perpage);
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				
				$args = array('user_id' => get_current_user_id(), 'number' => 10, 'offset' => ($paged - 1) * 10);
				$lists = get_comments($args);
				
			?>
            <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a>我的评论<span class="badge ng-binding ng-scope"><?php echo $counts;?></span></a></li>
            </ul>
            <div class="ng-isolate-scope loading-content-wrap loading-show loading-show-active">
              <?php
              	if($lists) {
			  ?>
              <div class="list-group ng-scope">
                <div class="list-group-item content-list-item ng-scope">
                  <?php foreach($lists as $value){ ?>
                  <section class="news-item"> <a class="pic" target="_blank" href="<?php echo get_permalink($value->comment_post_ID);?>"> <img alt="<?php echo get_post($value->comment_post_ID)->post_title;?>" src="<?php echo MThemes_thumbnail_custom(95,63,$value->comment_post_ID)?>"> </a>
                    <div class="actions"> <span class="time ng-binding"><?php echo $value->comment_date; ?> 评论</span> </div>
                    <div class="desc"> <a class="title ng-binding" target="_blank" href="<?php echo get_permalink($value->comment_post_ID);?>"><?php echo get_post($value->comment_post_ID)->post_title;?></a> <span class="brief ng-binding">评论内容：<?php echo mb_strimwidth( mbthemes_strip_tags( $value->comment_content ), 0, 50,"...");?></span> </div>
                  </section>
                  <?php }?>
                </div>
              </div>
              <div class="text-center">
                <nav class="text-center comp-pagination">
                  <?php MBT_monkey_page_pagination($paged,$pages);?>
                </nav>
              </div>
			  <?php }?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<?php get_footer();?>
