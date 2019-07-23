<?php
$themename = "主题";    //主题名称
$shortname = "mao10";    //主题简写，必须是英文、数字、下划线组合
$options = array (
	array("name" => "SEO设置","type" => "heading","desc" => ""),
	array("name" => "首页描述(Description)","id" => $shortname."_description","std" => "","type" => "text"),
	array("name" => "首页关键词(Keywords)","id" => $shortname."_keywords","std" => "","type" => "text"),
	array("name" => "默认封面图片设置","type" => "heading","desc" => ""),
	array("name" => "图片路径","id" => $shortname."_popimg","std" => "","type" => "text"),
	array("name" => "博客信息设置","type" => "heading","desc" => ""),
	array("name" => "首页博主标题(Description0)","id" => $shortname."_description0","std" => "","type" => "text"),
	array("name" => "首页博主描述(Description1)","id" => $shortname."_description1","std" => "","type" => "text"),
	array("name" => "网站主页大图(Fimg)","id" => $shortname."_fimg","std" => "","type" => "text"),
	
);
function mytheme_add_admin() {
    global $themename, $shortname, $options;
    if ( $_GET['page'] == basename(__FILE__) ) {
        if ( 'save' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
            update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
            foreach ($options as $value) {
            if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
            header("Location: themes.php?page=control.php&saved=true");    //这里的 control.php 就是这个文件的名称
            die;
        } else if( 'reset' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
                delete_option( $value['id'] );
                update_option( $value['id'], $value['std'] );
            }
            header("Location: themes.php?page=control.php&reset=true");    //这里的 control.php 就是这个文件的名称
            die;
        }
    }
    add_theme_page($themename." Options", "$themename 设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}
function mytheme_admin() {
    global $themename, $shortname, $options;
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 设置已保存。</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 设置已重置。</strong></p></div>';
?>
    <style type="text/css">
    th{text-align:left;}
    input{width:100%;}
    .submit{width:100px;padding:0;}
    .defaultbutton{padding-left:745px;}
    </style>
    <div class="wrap">
        <h2><b><?php echo $themename; ?> 设置</b></h2>
        <form method="post">
            <div class="submit" style="padding:0;">
                <input style="font-size:12px !important;" name="save" type="submit" value="保存设置" />   
                <input type="hidden" name="action" value="save" />
            </div>
            <table class="optiontable" >
                <?php foreach ($options as $value) {
                    if ($value['type'] == "text") { ?>
                        <tr align="left">
                            <th scope="row"><?php echo $value['name']; ?>:</th>
                            <td>
                                <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" size="40" />
                            </td>
                        </tr>
                    <?php } elseif ($value['type'] == "heading") { ?>
                        <tr valign="top">
                            <td colspan="2" style="text-align: left;"><hr />
                            <h2><?php echo $value['name']; ?></h2></td>
                            <tr><td colspan=2> <p style="color:red; margin:0 0;" > <?php echo $value['desc']; ?> </P> <hr /></td></tr>
                        </tr>
					<?php } elseif ($value['type'] == "heading2") { ?>
                        <tr valign="top">
                            <td colspan="2" style="text-align: left;"><hr />
                            <h2><?php echo $value['name']; ?></h2></td>
                            <tr><td colspan=2> <p style="color:red; margin:0 0;" > <?php echo $value['desc']; ?><select><?php $result = mysql_query("select * from wp_term_taxonomy where taxonomy = 'category' ORDER BY count DESC"); 
while ($row=mysql_fetch_array($result)) { ?>
					<option>
						<?php echo get_cat_name($row['term_id']) ?> (ID:<?php echo $row['term_id']; ?>)
					</option>
					<?php } ?></select></P> <hr /></td></tr>
                        </tr>
					<?php } ?>
                    <?php
                }
                ?>
            </table>
            <hr />
            <div class="submit">
                <input style="font-size:12px !important;" name="save" type="submit" value="保存设置" />   
                <input type="hidden" name="action" value="save" />
            </div>
        </form>
        <form method="post" class="defaultbutton">
            <div class="submit">
                <input style="font-size:12px !important;" name="reset" type="submit" value="还原默认设置" />
                <input type="hidden" name="action" value="reset" />
            </div>
        </form>
    </div>
    <?php
}
add_action('admin_menu', 'mytheme_add_admin');
?>