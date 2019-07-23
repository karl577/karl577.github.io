
<div class="breadcrumb clearfix"> <span class="base">当前位置：</span>
  <p><a href="<?php bloginfo('url'); ?>">首 页</a>&nbsp;&nbsp;&rarr;&nbsp;&nbsp;
    <?php
        if( is_single() ){
            $categorys = get_the_category();
            $category = $categorys[0];
            echo( get_category_parents($category->term_id,true,' >') );echo $s.' 查看文章';
        } elseif ( is_home() ){
            
        } elseif ( is_page() ){
            the_title();
        } elseif ( is_category() ){
            single_cat_title();
        } elseif ( is_tag() ){
            single_tag_title();
        } elseif ( is_day() ){
            the_time('Y年Fj日');
        } elseif ( is_month() ){
            the_time('Y年F');
        } elseif ( is_year() ){
            the_time('Y年');
        } elseif ( is_search() ){
            echo $s.' 的搜索结果';
        }
    ?>
</div>
