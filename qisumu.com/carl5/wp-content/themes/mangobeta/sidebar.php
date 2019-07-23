<div id="sidebar">

<!-- 搜索表单 -->
<form role="search" method="get" id="searchform" action="<?php echo home_url( "/" ); ?>">
<div class="entry-search">
<input class="searchtext" type="text" placeholder="输入关键字" value="" name="s" id="s" />
<input class="searchsubmit" type="submit"  value="搜索" id="searchsubmit" />
</div>
</form>
<!-- 获取分类目录 -->
<h3 class="pull-left clearfix">分类目录</h3>
<ul class="catlist pull-left clearfix">     
  <?php
    // 获取分类
    $terms = get_terms('category', 'orderby=name&hide_empty=0' );
    // 获取到的分类数量
    $count = count($terms);
    if($count > 0){
       // 循环输出所有分类信息
        foreach ($terms as $term) {
                echo '<li><a href="'.get_term_link($term, $term->slug).'" title="'.$term->name.'">'.$term->name.'</a></li>';
        }
     }
    ?>     
</ul>
<!-- 存档页 -->
<h3 class="pull-left clearfix">存档</h3>
<ul class="catlist pull-left clearfix">  
<?php wp_get_archives('type=monthly&format=html&show_post_count=1&limit=100'); ?>
</ul>

<!-- 获取友情链接 -->
<h3 class="pull-left clearfix">友情链接</h3>
<ul class="catlist pull-left clearfix">  
<?php get_links('-1', '<li>', '</li>', '', 0, 'name', 0, 0, -1, 0); ?>
</ul>






</div>