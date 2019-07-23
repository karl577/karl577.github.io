<?php
function themeoptions_admin_menu()
{add_theme_page("主题选项","主题选项",'edit_themes',basename(__FILE__),'themeoptions_page');}
if($_POST['update_themeoptions']=='true'){themeoptions_update();}
function themeoptions_update(){
    update_option('blog_title_suffix',$_POST['blog_title_suffix']);
    update_option('blog_keywords',$_POST['blog_keywords']);
    update_option('blog_description',$_POST['blog_description']);
    update_option('blog_logo_ico',$_POST['blog_logo_ico']);
    update_option('blog_article_nickname',$_POST['blog_article_nickname']);
    update_option('blog_article_unit',$_POST['blog_article_unit']);
    update_option('blog_sinaweibo',$_POST['blog_sinaweibo']);
    update_option('blog_tencentweibo',$_POST['blog_tencentweibo']);
    update_option('blog_qq',$_POST['blog_qq']);
    update_option('blog_rss',$_POST['blog_rss']);
	update_option('blog_copyright',stripslashes($_POST['blog_copyright']));
	update_option('blog_stats',stripslashes($_POST['blog_stats']));
    update_option('blog_mail_host',$_POST['blog_mail_host']);
    update_option('blog_mail_port',$_POST['blog_mail_port']);
    update_option('blog_mail_username',$_POST['blog_mail_username']);
    update_option('blog_mail_password',$_POST['blog_mail_password']);
    update_option('blog_mail_from',$_POST['blog_mail_from']);
    update_option('blog_protection_name',$_POST['blog_protection_name']);
    update_option('blog_protection_mail',$_POST['blog_protection_mail']);
    update_option('blog_slider_txt1',$_POST['blog_slider_txt1']);
    update_option('blog_slider_img1',$_POST['blog_slider_img1']);
    update_option('blog_slider_url1',$_POST['blog_slider_url1']);
    update_option('blog_slider_txt2',$_POST['blog_slider_txt2']);
    update_option('blog_slider_img2',$_POST['blog_slider_img2']);
    update_option('blog_slider_url2',$_POST['blog_slider_url2']);
    update_option('blog_slider_txt3',$_POST['blog_slider_txt3']);
    update_option('blog_slider_img3',$_POST['blog_slider_img3']);
    update_option('blog_slider_url3',$_POST['blog_slider_url3']);
    update_option('blog_slider_txt4',$_POST['blog_slider_txt4']);
    update_option('blog_slider_img4',$_POST['blog_slider_img4']);
    update_option('blog_slider_url4',$_POST['blog_slider_url4']);
    update_option('blog_slider_txt5',$_POST['blog_slider_txt5']);
    update_option('blog_slider_img5',$_POST['blog_slider_img5']);
    update_option('blog_slider_url5',$_POST['blog_slider_url5']);
    update_option('blog_slider_txt6',$_POST['blog_slider_txt6']);
    update_option('blog_slider_img6',$_POST['blog_slider_img6']);
    update_option('blog_slider_url6',$_POST['blog_slider_url6']);
	update_option('blog_slider_txt7',$_POST['blog_slider_txt7']);
	update_option('blog_slider_txt8',$_POST['blog_slider_txt8']);
	update_option('blog_slider_img9',$_POST['blog_slider_img9']);
    update_option('blog_slider_url9',$_POST['blog_slider_url9']);
	update_option('blog_slider_img10',$_POST['blog_slider_img10']);
    update_option('blog_slider_url10',$_POST['blog_slider_url10']);
	update_option('blog_slider_img11',$_POST['blog_slider_img11']);
    update_option('blog_slider_url11',$_POST['blog_slider_url11']);
	update_option('blog_slider_img12',$_POST['blog_slider_img12']);
    update_option('blog_slider_url12',$_POST['blog_slider_url12']);
   }
function themeoptions_page(){ ?>
<link href="<?php bloginfo('template_url'); ?>/include/admin.css" rel="stylesheet" type="text/css" />
<div class="wrap">
  <div id="icon-themes" class="icon32"><br /></div>
  <h2>主题选项</h2>
  <div class="themeoptions">
  <form method="POST" action="">
    <input type="hidden" name="update_themeoptions" value="true" />
	<br />
	<h3>基本信息</h3>
    
    
    <p><span class="txt1">ICO图标：</span><input type="text" name="blog_logo_ico" id="blog_logo_ico" value="<?php echo get_option('blog_logo_ico'); ?>"/>　如：/wp-content/themes/fangyou/images/favicon.ico</p>
    <p><span class="txt1">文章别称：</span><input type="text" name="blog_article_nickname" id="blog_article_nickname" value="<?php echo get_option('blog_article_nickname'); ?>"/>　如：文章</p>
    <p><span class="txt1">文章单位：</span><input type="text" name="blog_article_unit" id="blog_article_unit" value="<?php echo get_option('blog_article_unit'); ?>"/>　如：篇</p>
    <p><span class="txt1">新浪微博：</span><input type="text" name="blog_sinaweibo" id="blog_sinaweibo" value="<?php echo get_option('blog_sinaweibo'); ?>"/>　如：http://weibo.com/u/972363974</p>
    <p><span class="txt1">腾讯微博：</span><input type="text" name="blog_tencentweibo" id="blog_tencentweibo" value="<?php echo get_option('blog_tencentweibo'); ?>"/>　如：http://t.qq.com/youzhuti</p>
    <p><span class="txt1">联系QQ：</span><input type="text" name="blog_qq" id="blog_qq" value="<?php echo get_option('blog_qq'); ?>"/>　如：972363974</p>
    
    <p><span class="txt1">RSS地址：</span><input type="text" name="blog_rss" id="blog_rss" value="<?php echo get_option('blog_rss'); ?>"/>　如：http://www.51tiyi.com/feed</p>
    
	<p><input type="submit" class="button-primary" name="bcn_admin_options" value="保存设置" style="width:100px;margin-left:80px;"/></p>
	<br />
	<h3>SEO设置</h3>
	<p><span class="txt1">网站描述：</span><input type="text" name="blog_description" id="blog_description" value="<?php echo get_option('blog_description'); ?>"/></p>
    <p><span class="txt1">网站关键词：</span><input type="text" name="blog_keywords" id="blog_keywords" value="<?php echo get_option('blog_keywords'); ?>"/></p>
    <p><span class="txt1">标题后缀：</span><input type="text" name="blog_title_suffix" id="blog_title_suffix" value="<?php echo get_option('blog_title_suffix'); ?>"/>　首页Title标题后缀词</p>
	<p><input type="submit" class="button-primary" name="bcn_admin_options" value="保存设置" style="width:100px;margin-left:80px;"/></p>
	<h3>底部设置</h3>
	<p><span class="txt2">版权信息：<br />支持HTML</span><textarea name="blog_copyright" id="blog_copyright"><?php echo get_option('blog_copyright'); ?></textarea></p>
    <p><span class="txt2">统计代码：<br />支持HTML</span><textarea name="blog_stats" id="blog_stats"><?php echo get_option('blog_stats'); ?></textarea></p>
	<p><input type="submit" class="button-primary" name="bcn_admin_options" value="保存设置" style="width:100px;margin-left:80px;"/></p>
	<h3>评论/回复自动发送邮件</h3>
    <p><span class="txt1">邮箱主机：</span><input type="text" name="blog_mail_host" id="blog_mail_host" value="<?php echo get_option('blog_mail_host'); ?>"/>　如：hwsmtp.exmail.qq.com</p>
    <p><span class="txt1">邮箱端口：</span><input type="text" name="blog_mail_port" id="blog_mail_port" value="<?php echo get_option('blog_mail_port'); ?>"/>　如：25</p>
    <p><span class="txt1">邮箱用户：</span><input type="text" name="blog_mail_username" id="blog_mail_username" value="<?php echo get_option('blog_mail_username'); ?>"/>　如：admin@youzhuti.com</p>
    <p><span class="txt1">邮箱密码：</span><input type="text" name="blog_mail_password" id="blog_mail_password" value="<?php echo get_option('blog_mail_password'); ?>"/>　邮箱登录密码</p>
    <p><span class="txt1">来源邮箱：</span><input type="text" name="blog_mail_from" id="blog_mail_from" value="<?php echo get_option('blog_mail_from'); ?>"/>　如：admin@youzhuti.com</p>
	<p><input type="submit" class="button-primary" name="bcn_admin_options" value="保存设置" style="width:100px;margin-left:80px;"/></p>
	<br />
	<h3>防止冒充站长评论</h3>
    <p><span class="txt1">评论用户：</span><input type="text" name="blog_protection_name" id="blog_protection_name" value="<?php echo get_option('blog_protection_name'); ?>"/>　如：admin</p>
    <p><span class="txt1">评论邮箱：</span><input type="text" name="blog_protection_mail" id="blog_protection_mail" value="<?php echo get_option('blog_protection_mail'); ?>"/>　如：admin@youzhuti.com</p>
	<p><input type="submit" class="button-primary" name="bcn_admin_options" value="保存设置" style="width:100px;margin-left:80px;"/></p>
	<br />
	<h3>幻灯片<font color="#ff6600">（图片宽度：860px　图片高度：359px）</font></h3>
    <p><span class="txt1">图片名称1：</span><input type="text" name="blog_slider_txt1" id="blog_slider_txt1" value="<?php echo get_option('blog_slider_txt1'); ?>"/></p>
    <p><span class="txt1">图片路径1：</span><input type="text" name="blog_slider_img1" id="blog_slider_img1" value="<?php echo get_option('blog_slider_img1'); ?>"/></p>
    <p><span class="txt1">链接地址1：</span><input type="text" name="blog_slider_url1" id="blog_slider_url1" value="<?php echo get_option('blog_slider_url1'); ?>"/></p>
    <p><span class="txt1">图片名称2：</span><input type="text" name="blog_slider_txt2" id="blog_slider_txt2" value="<?php echo get_option('blog_slider_txt2'); ?>"/></p>
    <p><span class="txt1">图片路径2：</span><input type="text" name="blog_slider_img2" id="blog_slider_img2" value="<?php echo get_option('blog_slider_img2'); ?>"/></p>
    <p><span class="txt1">链接地址2：</span><input type="text" name="blog_slider_url2" id="blog_slider_url2" value="<?php echo get_option('blog_slider_url2'); ?>"/></p>
    <p><span class="txt1">图片名称3：</span><input type="text" name="blog_slider_txt3" id="blog_slider_txt3" value="<?php echo get_option('blog_slider_txt3'); ?>"/></p>
    <p><span class="txt1">图片路径3：</span><input type="text" name="blog_slider_img3" id="blog_slider_img3" value="<?php echo get_option('blog_slider_img3'); ?>"/></p>
    <p><span class="txt1">链接地址3：</span><input type="text" name="blog_slider_url3" id="blog_slider_url3" value="<?php echo get_option('blog_slider_url3'); ?>"/></p>
    <p><span class="txt1">图片名称4：</span><input type="text" name="blog_slider_txt4" id="blog_slider_txt4" value="<?php echo get_option('blog_slider_txt4'); ?>"/></p>
    <p><span class="txt1">图片路径4：</span><input type="text" name="blog_slider_img4" id="blog_slider_img4" value="<?php echo get_option('blog_slider_img4'); ?>"/></p>
    <p><span class="txt1">链接地址4：</span><input type="text" name="blog_slider_url4" id="blog_slider_url4" value="<?php echo get_option('blog_slider_url4'); ?>"/></p>
    <p><span class="txt1">图片名称5：</span><input type="text" name="blog_slider_txt5" id="blog_slider_txt5" value="<?php echo get_option('blog_slider_txt5'); ?>"/></p>
    <p><span class="txt1">图片路径5：</span><input type="text" name="blog_slider_img5" id="blog_slider_img5" value="<?php echo get_option('blog_slider_img5'); ?>"/></p>
    <p><span class="txt1">链接地址5：</span><input type="text" name="blog_slider_url5" id="blog_slider_url5" value="<?php echo get_option('blog_slider_url5'); ?>"/></p>
    <p><span class="txt1">图片名称6：</span><input type="text" name="blog_slider_txt6" id="blog_slider_txt6" value="<?php echo get_option('blog_slider_txt6'); ?>"/></p>
    <p><span class="txt1">图片路径6：</span><input type="text" name="blog_slider_img6" id="blog_slider_img6" value="<?php echo get_option('blog_slider_img6'); ?>"/></p>
    <p><span class="txt1">链接地址6：</span><input type="text" name="blog_slider_url6" id="blog_slider_url6" value="<?php echo get_option('blog_slider_url6'); ?>"/></p>	
	<p><input type="submit" class="button-primary" name="bcn_admin_options" value="保存设置" style="width:100px;margin-left:80px;"/></p>
	<br />
	<h3>文章下公告</h3>
	<p><span class="txt7">     公    告：</span><input type="text" name="blog_slider_txt7" id="blog_slider_txt7" value="<?php echo get_option('blog_slider_txt7'); ?>"/>    公告名称  如：特别声明</p>
	<p><span class="txt8">公告内容：</span><input type="text" name="blog_slider_txt8" id="blog_slider_txt8" value="<?php echo get_option('blog_slider_txt8'); ?>"/>    如：特别声明</p>
	<p><input type="submit" class="button-primary" name="bcn_admin_options" value="保存设置" style="width:100px;margin-left:80px;"/></p>
	<br/>
	<h3>广告设置<font color="#ff6600">（图片宽度：270px　图片高度：170px）</font></h3>
	<p><span class="txt9">图片路径1：</span><input type="text" name="blog_slider_img9" id="blog_slider_img9" value="<?php echo get_option('blog_slider_img9'); ?>"/></p>
    <p><span class="txt9">链接地址1：</span><input type="text" name="blog_slider_url9" id="blog_slider_url9" value="<?php echo get_option('blog_slider_url9'); ?>"/></p>
	<p><span class="txt10">图片路径2：</span><input type="text" name="blog_slider_img10" id="blog_slider_img10" value="<?php echo get_option('blog_slider_img10'); ?>"/></p>
    <p><span class="txt10">链接地址2：</span><input type="text" name="blog_slider_url10" id="blog_slider_url10" value="<?php echo get_option('blog_slider_url10'); ?>"/></p>
	<p><span class="txt11">图片路径3：</span><input type="text" name="blog_slider_img11" id="blog_slider_img11" value="<?php echo get_option('blog_slider_img11'); ?>"/></p>
    <p><span class="txt11">链接地址3：</span><input type="text" name="blog_slider_url11" id="blog_slider_url11" value="<?php echo get_option('blog_slider_url11'); ?>"/></p>
	<p><span class="txt12">图片路径4：</span><input type="text" name="blog_slider_img12" id="blog_slider_img12" value="<?php echo get_option('blog_slider_img12'); ?>"/></p>
    <p><span class="txt12">链接地址4：</span><input type="text" name="blog_slider_url12" id="blog_slider_url12" value="<?php echo get_option('blog_slider_url12'); ?>"/></p>
	<p><input type="submit" class="button-primary" name="bcn_admin_options" value="保存设置" style="width:100px;margin-left:80px;"/></p>
  </form>
  </div>
</div>
<?php } add_action('admin_menu','themeoptions_admin_menu'); ?>