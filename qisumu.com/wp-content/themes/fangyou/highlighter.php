<?php
/*
Template Name:高亮代码
*/
?>
<?php get_header(); ?>
<div class="position">
    <div class="common">
       <div class="weibo">
  <a href="<?php echo get_option('blog_tencentweibo'); ?>" title="腾讯微博" rel="external nofollow" target="_blank">腾讯微博</a>
       </div>
    <div class="qun">
  <a href="<?php echo get_option('blog_sinaweibo'); ?>" title="新浪微博" rel="external nofollow" target="_blank">新浪微博</a>
       </div>
    <div class="contact">
  <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo get_option('blog_qq'); ?>&site=qq&menu=yes" title="联系站长" rel="external nofollow" target="_blank">联系站长</a>
       </div>
    <div class="feed">
  <a href="<?php echo get_option('blog_rss'); ?>" title="订阅本站" rel="external nofollow" target="_blank">订阅本站</a>
       </div>
    <div class="counts">
	当前位置：<?php if(function_exists('wp_breadcrumbs')){wp_breadcrumbs();} ?>
	
	</div>
    <div class="search">
  <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <input class="searchtxt" name="s" id="s" type="text" value="请输入搜索关键词..." onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
            <button class="searchbtn" id="searchsubmit" title="站内搜索">搜索</button>
          </form>
    </div>
</div>
<div class="clear"></div>
<div class="bodybox">
  <div class="main">
    <div class="common">
      <?php if(have_posts()):while(have_posts()):the_post(); ?>
	  <div class="list">
        		<div class="contentbox">
          <div class="contenttitle">
            <h1><?php the_title(); ?></h1>
		  </div>
		  <div class="clear"></div>
          <div class="contenttxt">
            <?php the_content(); ?>
		    <script type="text/javascript">document.write("<scr"+"ipt src=\"<?php bloginfo('template_url'); ?>/include/highlighter.js\"></sc"+"ript>")</script>
		    <div class="highlighterbox">
		      <h3>输入源代码</h3>
			  <textarea class="php" id="sourceCode" name="sourceCode"></textarea>
			  <span class="options">选择语言：
		  	  <select onchange="document.getElementById('sourceCode').className=this.value">
              <option value="java">java</option>
              <option value="xml">xml</option>
              <option value="sql">sql</option>
              <option value="jscript">jscript</option>
              <option value="groovy">groovy</option>
              <option value="css">css</option>
              <option value="cpp">cpp</option>
              <option value="c#">c#</option>
              <option value="python">python</option>
              <option value="vb">vb</option>
              <option value="perl">perl</option>
              <option value="php" selected>php</option>
              <option value="ruby">ruby</option>
              <option value="delphi">delphi</option>
              </select>
              </span>
		  	  <span class="options">
			  <span class="options_no">
			  <input id="showGutter" type="checkbox" checked="checked">显示行号
              <input id="firstLine" type="checkbox" checked="checked">起始为1
              <input id="showControls" type="checkbox">工具栏
              <input id="collapseAll" type="checkbox">折叠
              <input id="showColumns" type="checkbox">显示列数
		  	  </span>
			  </span>
			  <span class="render">
			  <button onclick="generateCode()">转换</button>
              <button onclick="clearText()">清除</button>
              </span>
			  <h3>HTML代码</h3>
              <textarea id="htmlCode" name="htmlCode"></textarea>
		  	  <h3>HTML预览</h3>
              <div id="preview"></div>
		    </div>
          </div>
        </div>
      </div>
	  <?php endwhile; endif;?>
      <div class="sidebar">
		<?php if(is_dynamic_sidebar())dynamic_sidebar('right_sidebar'); ?>
      </div>
    </div>
  </div>
  <div class="clear"></div>
<?php get_footer(); ?>