<?php

$themename = "Variant";
$shortname = "strive";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/css/style/';
$alt_stylesheets = array();
$alt_stylesheets[] = '';

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}
$number_entries = array("Select a Number:","1","2","3","4","5","6","7","8","9","10", "12","14", "16", "18", "20" );
$options = array (
	array(  "name" => $themename." Options",
      		"type" => "title"),

//常规设置
    array( "name" => "头部设置",
           "type" => "section"),
    array( "type" => "open"),

	array(  "name" => "logo图片地址",
			"desc" => "输入您的logo图片地址",
            "id" => $shortname."_mylogo",
            "type" => "text",
            "std" => "/wp-content/themes/Variant/images/logo.png"),				
		
	array(  "name" => "favicon图标地址",
			"desc" => "输入您的favicon图标地址，将在浏览器地址栏显示",
            "id" => $shortname."_favicon",
            "type" => "text",
            "std" => "/wp-content/themes/Variant/images/favicon.ico"),					

	array(  "name" => "随机图片地址1",
			"desc" => "首页随机显示图片地址",
            "id" => $shortname."_indexsuiji1",
            "type" => "text",
            "std" => "/wp-content/themes/Variant/images/random/1.jpg"),	
			
	array(  "name" => "随机图片地址2",
			"desc" => "首页随机显示图片地址",
            "id" => $shortname."_indexsuiji2",
            "type" => "text",
            "std" => "/wp-content/themes/Variant/images/random/2.jpg"),	
			
	array(  "name" => "随机图片地址3",
			"desc" => "首页随机显示图片地址",
            "id" => $shortname."_indexsuiji3",
            "type" => "text",
            "std" => "/wp-content/themes/Variant/images/random/3.jpg"),	
			
	array(  "name" => "随机图片地址4",
			"desc" => "首页随机显示图片地址",
            "id" => $shortname."_indexsuiji4",
            "type" => "text",
            "std" => "/wp-content/themes/Variant/images/random/4.jpg"),	
			
	array(  "name" => "随机图片地址5",
			"desc" => "首页随机显示图片地址",
            "id" => $shortname."_indexsuiji5",
            "type" => "text",
            "std" => "/wp-content/themes/Variant/images/random/5.jpg"),	


//SEO设置
    array(  "type" => "close"),
	array(  "name" => "网站SEO设置",
			"type" => "section"),
	array(  "type" => "open"),

	array(	"name" => "描述（Description）",
			"desc" => "",
			"id" => $shortname."_description",
			"type" => "textarea",
            "std" => "输入你的网站描述，一般不超过200个字符"),

	array(	"name" => "关键词（KeyWords）",
            "desc" => "",
            "id" => $shortname."_keywords",
            "type" => "textarea",
            "std" => "输入你的网站关键字，一般不超过100个字符"),				
			
//其他设置
    array(  "type" => "close"),
	array(  "name" => "其他设置",
			"type" => "section"),
	array(  "type" => "open"),

    array(  "name" => "百度异步统计代码（将添加至头部）",
            "desc" => "",
            "id" => $shortname."_tjcode",
            "type" => "textarea",
            "std" => ""),
    array(  "name" => "其他统计代码（将添加至页脚）",
            "desc" => "",
            "id" => $shortname."_yjtjcode",
            "type" => "textarea",
            "std" => ""),

//博主资料设置
    array(  "type" => "close"),
	array(  "name" => "博主资料设置",
			"type" => "section"),
	array(  "type" => "open"),

	array(  "name" => "博主头像",
			"desc" => "输入头像图片地址",
            "id" => $shortname."_zztxurl",
            "type" => "text",
            "std" => "/wp-content/themes/Variant/images/zztx.jpg"),

	array(  "name" => "博主昵称",
			"desc" => "",
            "id" => $shortname."_zznc",
            "type" => "text",
            "std" => "大胡子"),	

	array(  "name" => "博主简介",
			"desc" => "",
            "id" => $shortname."_grsm",
            "type" => "text",
            "std" => "主题猫WP建站，为草根创业提供助力！"),				

	array(  "name" => "是否显示社交图标",
			"desc" => "默认不显示",
            "id" => $shortname."_weixin",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),
			
	array(  "name" => "博主微博链接",
			"desc" => "输入你的微博链接",
            "id" => $shortname."_zzwburl",
            "type" => "text",
            "std" => "http://weibo.com/ztmao"),
	array(  "name" => "博主QQ链接",
			"desc" => "输入你的QQ链接",
            "id" => $shortname."_zzqqurl",
            "type" => "text",
            "std" => "http://ztmao.com/go/kefu"),
	array(  "name" => "博主微信二维码",
			"desc" => "输入你的微信二维码图片地址（90*90）",
            "id" => $shortname."_zzwxurl",
            "type" => "text",
            "std" => "/wp-content/themes/Variant/images/zzwx.jpg"),

	array(	"type" => "close") 			
);
function mytheme_add_admin() {
global $themename, $shortname, $options;
if ( $_GET['page'] == basename(__FILE__) ) {
	if ( 'save' == $_REQUEST['action'] ) {
		foreach ($options as $value) {
	update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
	header("Location: admin.php?page=theme_options.php&saved=true");
die;
}
else if( 'reset' == $_REQUEST['action'] ) {
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
	header("Location: admin.php?page=theme_options.php&reset=true");
die;
}
}
$file_dir=get_bloginfo('template_directory');
add_menu_page($themename." Options", "主题设置", 'edit_theme_options',basename(__FILE__), 'mytheme_admin',$file_dir."/includes/options/logo.png",61);

}
function mytheme_add_init() {
$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/includes/options/options.css", false, "1.0", "all");
}
function mytheme_admin() {
global $themename, $shortname, $options;
$i=0;
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题设置已保存</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题已重新设置</strong></p></div>';
?>

<div class="wrap rm_wrap">
  <h2><?php echo $themename; ?> 主题设置</h2>
  <div style=" margin-bottom:20px; text-align:right;"><a href="http://ztmao.com/go/qqqun" target="_blank">主题帮助</a> / <a href="http://ztmao.com" target="_blank">更多主题</a></div>
  <div class="clear"></div>
  <div class="rm_opts">
  <div class="rm_opts">
  <form method="post">
    <?php foreach ($options as $value) {
switch ( $value['type'] ) {
case "open":
?>
    <?php break;
case "close":
?>
    </div>
    </div>
    <br />
    <?php break;
case "title":
?>
    <?php break;
case 'text':
?>
    <div class="rm_input rm_text">
      <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
      <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
      <small><?php echo $value['desc']; ?></small>
      <div class="clearfix"></div>
    </div>
    <?php
break;
case 'textarea':
?>
    <div class="rm_input rm_textarea">
      <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
      <textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?>
</textarea>
      <small><?php echo $value['desc']; ?></small>
      <div class="clearfix"></div>
    </div>
    <?php
break;
case 'select':
?>
    <div class="rm_input rm_select">
      <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
      <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" >
        <?php foreach ($value['options'] as $option) { ?>
        <option value="<?php echo $option;?>" <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>>
        <?php
		if ((empty($option) || $option == '' ) && isset($value['default_option_value'])) {
			echo $value['default_option_value'];
		} else {
			echo $option; 
		}?>
        </option>
        <?php } ?>
      </select>
      <small><?php echo $value['desc']; ?></small>
      <div class="clearfix"></div>
    </div>
    <?php
break;
case "checkbox":
?>
    <div class="rm_input rm_checkbox">
      <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
      <?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
      <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
      <small><?php echo $value['desc']; ?></small>
      <div class="clearfix"></div>
    </div>
    <?php break; 
case "section":
$i++;
?>
    <div class="rm_section">
    <div class="rm_title">
      <h3><img src="<?php bloginfo('template_directory')?>/includes/options/clear.png" class="inactive" alt=""><?php echo $value['name']; ?></h3>
      <span class="submit">
      <input name="save<?php echo $i; ?>" type="submit" class="button-primary" value="保存设置" />
      </span>
      <div class="clearfix"></div>
    </div>
    <div class="rm_options">
    <?php break;}}?>
    <input type="hidden" name="action" value="save" />
  </form>
<div class="theme-info">
  	<h3>主题声明</h3>
    <blockquote>
    	<p>感谢您使用Variant主题，本主题为免费主题，集思广益才能更完善，功能才能更强大！</p>
        <p>主题使用时遇到问题，或者发现bug，可联系作者QQ1114872587寻求帮助！</p>
		<p>此主题由<a href="http://ztmao.com" target="_blank">主题猫WP建站</a>提供，官网：http://ztmao.com  技术交流群：281907514</p>
		<p style="font-size: 19px;"><a href="https://www.yuntivip.com/" target="_blank">云梯 VPN</a>，更好用的科学上网姿势，<a href="https://www.yuntivip.com/" target="_blank">点击就送！</a>（85折优惠码：ztmao.com）</p>
    </blockquote>
  </div>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="恢复默认" /> <font color=#ff0000>提示：此按钮将恢复主题初始状态，您的所有设置将消失！</font>
<input type="hidden" name="action" value="reset" />
</p>
</form>
<script type="text/javascript" src="<?php bloginfo('template_directory')?>/includes/options/rm_script.js"></script>
</div>
<div class="kg"></div>
</div>
<?php }?>
<?php
function mytheme_wp_head() { 
	$stylesheet = get_option('strive_alt_stylesheet');
	if($stylesheet != ''){?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/style/<?php echo $stylesheet; ?>" />
<?php }
} 
add_action('wp_head', 'mytheme_wp_head');
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>
