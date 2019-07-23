<?php get_header();?>

<div class="row-fluid">
  <div id="main" class="span12 blog-posts search-page image-preloader">
    <div class="row-fluid">
      <table width="90%" height="100%">
        <tr>
          <td><img src="<?php bloginfo('template_directory'); ?>/images/pic1.png"></td>
          <td width="80%"><center>
              <img src="<?php bloginfo('template_directory'); ?>/images/404.gif">
            </center>
            <center>
            <h1><u>404 错误: 您所请求的页面不存在！</u></h1>
            <font face="Arial">您之所以看到这一个页面,是因为您请求的链接不存在。请检查网址是否正确或通知我们不正确的链接。当然，您也可以通过下面的搜索栏搜索您想要看得内容 <br>
            <br>
            <a href="<?php bloginfo('url'); ?>">进入首页</a></font><br>
            <br>
            <br></td>
            </td>
        </tr>
      </table>
    </div>
    <div class="row-fluid">
      <h2>在这里搜索您想要看的内容吧</h2>
      <form name="form-search" method="post" action="<?php bloginfo('home'); ?>">
        <input type="text" name="s" id="s" value="输入关键字搜索吧" />
        <input type="submit" name="submit" value="搜索" />
      </form>
    </div>
  </div>
</div>
</div>
<?php get_footer();?>
