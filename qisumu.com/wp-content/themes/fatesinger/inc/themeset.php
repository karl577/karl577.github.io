<?php
$themename = $dname.'主题';

$options = array (

	//基本设置
	array( "name" => "基本设置","type" => "section","desc" => "主题的基本设置，包括模块是否开启等"),
	array( "name" => "顶部slogan","type" => "tit"),
	array( "id" => "fate_tui","type" => "text","std" => "我感觉我是个优雅的人~"),
	array( "name" => "网站描述","type" => "tit"),
	array( "id" => "fate_description","type" => "text","std" => "输入你的网站描述，一般不超过200个字符"),
	array( "name" => "阻止站内文章Pingback","type" => "tit"),	
	array( "id" => "fate_pingback_b","type" => "checkbox" ),
	array( "type" => "endtag"),


	//SNS设置
	array( "name" => "SNS设置","type" => "section" ),	
	array( "name" => "RSS订阅地址","type" => "tit"),
	array( "id" => "fate_rss","type" => "text","class" => "fate_inp_short","std" => "www.igaming888.com/feed"),
    array( "name" => "SNS页站点描述","type" => "tit"),
	array( "id" => "fate_rss_des","type" => "text","class" => "fate_inp_short","std" => "Thought is already is late, exactly is the earliest time. "),
	
	array( "name" => "推荐文章1","type" => "tit"),	
	array( "id" => "fate_top_1","type" => "text","class" => "fate_inp_short","std" => "www.igaming888.com/dafa"),

	array( "name" => "推荐文章2","type" => "tit"),	
	array( "id" => "fate_top_2","type" => "text","class" => "fate_inp_short","std" => "www.igaming888.com/dafa"),
	
	array( "name" => "推荐文章3","type" => "tit"),
	array( "id" => "fate_top_3","type" => "text","class" => "fate_inp_short","std" => "www.igaming888.com/dafa"),

	array( "name" => "赞助链接","type" => "tit"),
	array( "id" => "fate_pay","type" => "text","class" => "fate_inp_short","std" => "www.igaming888.com/dafa"),

	array( "type" => "endtag"),


	//首尾代码
	array( "name" => "首尾代码","type" => "section" ),	
	
	array( "name" => "流量统计代码","type" => "tit"),	
	array( "id" => "fate_track_b","type" => "checkbox" ),
	array( "id" => "fate_track","type" => "textarea","std" => "贴入百度统计、CNZZ、51啦、量子统计代码等等"),

	array( "name" => "头部公共代码","type" => "tit"),	
	array( "id" => "fate_headcode_b","type" => "checkbox" ),
	array( "id" => "fate_headcode","type" => "textarea","std" => "这部分代码显示在head标签内，可以是css，js等代码"),

	array( "name" => "底部公共代码","type" => "tit"),	
	array( "id" => "fate_footcode_b","type" => "checkbox" ),
	array( "id" => "fate_footcode","type" => "textarea","std" => "这部分代码显示在页面最底部，可以是js等代码"),

	array( "type" => "endtag"),


	//广告系统
	array( "name" => "广告系统","type" => "section" ),	
	
	array( "name" => "首页头部banner 468x60","type" => "tit"),
	array( "id" => "fate_adpost_01_b","type" => "checkbox" ),
	array( "id" => "fate_adpost_01","type" => "textarea"),

	array( "name" => "文章页右边栏 250x250","type" => "tit"),
	array( "id" => "fate_adpost_02_b","type" => "checkbox" ),
	array( "id" => "fate_adpost_02","type" => "textarea"),

	array( "name" => "文章页左分享条 120x160","type" => "tit"),
	array( "id" => "fate_adpost_03_b","type" => "checkbox" ),
	array( "id" => "fate_adpost_03","type" => "textarea"),

	array( "name" => "首页边栏 120x240","type" => "tit"),
	array( "id" => "fate_adpost_04_b","type" => "checkbox" ),
	array( "id" => "fate_adpost_04","type" => "textarea"),
	
	array( "name" => "首页边栏 250x250","type" => "tit"),
	array( "id" => "fate_adpost_05_b","type" => "checkbox" ),
	array( "id" => "fate_adpost_05","type" => "textarea"),
	
	array( "type" => "endtag"),
	
	
);

function mytheme_add_admin() {
	global $themename, $options;
	if ( $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
			}
			/*
			foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); }
				else { delete_option( $value['id'] ); } 
			}
			*/
			header("Location: admin.php?page=themeset.php&saved=true");
			die;
		}
		else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($options as $value) {delete_option( $value['id'] ); }
			header("Location: admin.php?page=themeset.php&reset=true");
			die;
		}
	}
	add_theme_page($themename." Options", $themename."设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin() {
	global $themename, $options;
	$i=0;
	if ( $_REQUEST['saved'] ) echo '<div class="fate_message">'.$themename.'修改已保存</div>';
	if ( $_REQUEST['reset'] ) echo '<div class="fate_message">'.$themename.'已恢复设置</div>';
?>

 
 <style type="text/css">
a,input,button,select,textarea{outline:none}

.fate_wrap{position: relative;font-family:'microsoft yahei';}
.fate_wrap h2{font-family:'microsoft yahei';border-bottom: double 3px #e1e1e1;padding-bottom: 25px;background:url(../wp-content/themes/fatesinger/images/h2.png) no-repeat left center;text-indent:-9999px}

.fate_message{position:absolute;top:5px;right:5px;background-color: #FDEBAE;padding:6px 20px 8px 20px;color: #333;border: 1px solid #E6C555;}

.fate_themedesc{font-size:12px;margin-left:20px;}

.fate_desc:after{content:".";display:block;height:0;clear:both;visibility:hidden}
.fate_desc{height:1%}

.fate_formwrap{padding-left: 140px;position: relative;border-radius: 3px;}
.fate_tab{width: 140px;text-align: right;position: absolute;top: 0;left: 0;border-right: solid 1px #ddd;height: 100%;box-shadow:inset -2px 0 0 #f9f9f9;}
.fate_tab ul{margin: 7px 0;}
.fate_tab ul li{padding: 8px 25px 8px 0;cursor: pointer;color: #444;}
.fate_tab ul li:hover{color:#222}
.fate_tab ul li.fate_tab_on{background:#f5f5f5;border-left:#C62627 3px solid;color:#222;font-weight: bold;border-radius:30px 0 0 0}

.fate_mainbox{display:none;}

.fate_desc{margin: 10px 5px 0 25px;}
.fate_desc .button-primary{}


.fate_inner{padding:0 0 10px 25px}
.fate_inner .fate_li{}
.fate_inner h4{font-size:12px;color:#333;position:relative;margin: 0 0 10px;padding-top: 15px}

.fate_line{background:#e4e4e4;height:1px;overflow:hidden;display:block;clear:both;margin:15px 15px 20px -115px}

#wpcontent .fate_inner select{border:#BED1DD 1px solid;padding:4px;height:29px;line-height:24px;border-radius:2px;width:100px;margin-right:5px;color:#444}

.fate_tip{display: none;}
.fate_tips{color: #bbb;}

.fate_inner input[type="text"] {border: solid 1px #dadada;
	border-left-color: #ccc;
	border-top-color: #ccc;
	box-shadow: inset 0 1px 0 #eee;
	background-color: #fff;
	padding: 4px 6px;
	height: 30px;
	line-height: 20px;
	color: #888;
	font-size: 12px;margin-bottom:6px;margin-right:5px;width:98%;border-radius:1px;font-family:'microsoft yahei';}
.fate_inner input[type="text"].fate_inp_short{width:360px;display:inline}
.fate_inner input[type="text"].fate_inp_four{width:100px;display:inline}

.fate_check{padding:4px 6px;display: inline-block;width:44px;margin:0 20px -2px 1px;color: #666;}
.fate_check input{vertical-align: -3px;margin-right:3px;}

.fate_number{color: #444;}
.fate_num{width:60px;border-color:#BED1DD;}

.fate_tarea{width:98%;min-height:64px;border: solid 1px #dadada;
	border-left-color: #ccc;
	border-top-color: #ccc;
	box-shadow: inset 0 1px 0 #eee;
	background-color: #fff;padding:5px 6px;border-radius:2px;line-height:18px;color:#444;display:block;font-family:microsoft yahei;font-size:12px}

.fate_inner input,.fate_inner textarea{color:#888;}
.fate_inner input:focus,.fate_inner textarea:focus{border-color: #95C8F1;
	box-shadow: 0 0 4px #95C8F1;color: #444;}

.fate_inner .fate_inp, .fate_inner .fate_tarea{display: block;}

#fate_quicker{height:600px;position:;margin:20px 0 -10px 0;font-family:"Courier New", Courier, monospace;color: #444;}
#fate_quicker:focus{border-color:#BED1DD;color: #333;}
.fate_quicker_menu{float: left;margin:40px 0 0 -140px;width:130px;color: #666;text-align: center;}
.fate_quicker_menu li{border:solid 1px #BED1DD;border-radius:2px;padding:6px 10px;background-image:-moz-linear-gradient(top,#f7fcfe,#eff8ff);background-image:-webkit-linear-gradient(top,#f7fcfe,#eff8ff);background-image:linear-gradient(top,#f7fcfe,#eff8ff);cursor: pointer;}
.fate_quicker_menu li:hover{background: #F1F9FF;font-weight:bold;color: #21759B;}

.fate_port_btn{font-size:12px;font-weight:normal; display:inline-block}
.fate_port_btn a{margin-left:12px;cursor:pointer}

.fate_popup_mask{width:100%;height:100%;background:#000;opacity:.3;position:fixed;top:0;left:0;z-index:99998}
.fate_popup{position:fixed;top:50%;left:50%;margin:-200px 0 0 -300px;width:600px;height:400px;border:#4E7D9A 1px solid;background:#fff;padding:12px;display:none;z-index:99999;box-shadow:0 0 10px #666}
.fate_popup h3{border-bottom:#D1E5EE 1px solid;box-shadow:inset 1px 1px 1px #298CBA;background:#23769D;height:32px;font:bold 14px/32px microsoft yahei;margin:-12px -12px 0;color:#fff;position:relative;padding-left:12px;text-shadow:0 0 2px #195571}
.fate_popup h3 input{float:right;margin:4px 12px 0 0}
.fate_popup h4{margin:10px 0;font-weight:normal;font-size:12px}
.fate_popup textarea{width:99%;min-height:330px;border:#D1E5EE 1px solid;border-left-color:#BED1DD;border-top-color:#BED1DD;background:#fff;padding:8px 10px;border-radius:2px;line-height:18px;color:#444}
.fate_popup textarea:focus{border:#EDC97F 2px solid;background:#fff;padding:7px 9px}
.fate_btn_this{text-align:center}

.fate_the_desc{background:#EFF8FF;border:#BED1DD 1px solid;border-bottom-color:#D1E5EE;border-top-left-radius:3px;border-bottom-left-radius:3px;padding:5px 8px;color:#21759B;margin-right:-3px;position:relative;z-index:10;vertical-align:middle;top:-2px}

.fate_adviewcon{width:96%;padding-top:5px;overflow:hidden}

</style>


<script type="text/javascript">
jQuery(document).ready(function($) {
	//tab tit
	$('.fate_mainbox:eq(0)').show();
	$('.fate_tab ul li').each(function(i) {
		$(this).click(function(){
			$(this).addClass('fate_tab_on').siblings().removeClass('fate_tab_on');
			$($('.fate_mainbox')[i]).show().siblings('.fate_mainbox').hide();
		})
	});

	var avatar_txt = '<div style="padding-top:10px;color:#390;">请确保网站根目录有“avatar”文件夹，并设置权限为777，地址：http://你的网站/avatar</div>';
	if( $('#fate_avatar_b')[0].checked == true ){
		$('#fate_avatar_b').parent().parent().append(avatar_txt);
	}
	$('#fate_avatar_b').parent().click(function(){
		if( $('#fate_avatar_b')[0].checked == true ){
			
			$('#fate_avatar_b').parent().parent().append(avatar_txt);
			
		}else{
			$('#fate_avatar_b').parent().parent().find('div').remove();
		}
	})

	//quicker
	$('#fate_quicker').before('<ul class="fate_quicker_menu"><li class="fate_quicker_adfate_tit">添加标题</li><li class="fate_quicker_adfate_list">添加列表</li><li class="fate_quicker_adfate_li">添加列表条目</li><li class="fate_quicker_adfate_img">插图</li></ul>');

	$('.fate_quicker_adfate_tit').click(function(){
		$('#fate_quicker').insertAtCaret('<h3 class="base-tit">标题</h3>\n');
	})
	$('.fate_quicker_adfate_list').click(function(){
		$('#fate_quicker').insertAtCaret('<ul class="base-list">\n    <li><a href="http://www.daqianduan.com/">大前端</a></li>\n</ul>\n');
	})
	$('.fate_quicker_adfate_li').click(function(){
		$('#fate_quicker').insertAtCaret('\n    <li><a href="http://www.daqianduan.com/">大前端</a></li>');
	})
	$('.fate_quicker_adfate_img').click(function(){
		$('#fate_quicker').insertAtCaret('<img src="http://" alt="" width="" />');
	})

	
	
	//ad preview
	$('.fate_mainbox:last .fate_tarea').each(function(i) {
		$(this).bind('keyup',function(){
			$(this).next().html( $(this).val() );
		}).bind('change',function(){
			$(this).next().html( $(this).val() );
		}).bind('click',function(){
			$(this).next().html( $(this).val() );
			if( $(this).next().attr('class') != 'fate_adviewcon' ){
				$(this).after('<div class="fate_adviewcon">' + $(this).val() + '</div>');
			}else{
				$(this).next().slideDown();
			}
		})
		
	});


	$.fn.extend({
		insertAtCaret: function(myValue){
			var $t=$(this)[0];
			if (document.selection) {
				this.focus();
				sel = document.selection.createRange();
				sel.text = myValue;
				this.focus();
			}
			else 
			if ($t.selectionStart || $t.selectionStart == '0') {
				var startPos = $t.selectionStart;
				var endPos = $t.selectionEnd;
				var scrollTop = $t.scrollTop;
				$t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos, $t.value.length);
				this.focus();
				$t.selectionStart = startPos + myValue.length;
				$t.selectionEnd = startPos + myValue.length;
				$t.scrollTop = scrollTop;
			}
			else {
				this.value += myValue;
				this.focus();
			}
		}
	}) 

	
	
})
</script>



<div class="wrap fate_wrap">
	
	<h2><?php echo $themename; ?>设置
		
	</h2>
	
	<form method="post" class="fate_formwrap">
		<div class="fate_tab">
			<ul>
				<li class="fate_tab_on">基本设置</li>
				<li>综合设置</li>
				<li>统计代码</li>
				<li>广告设置</li>
				
			</ul>
		</div>
		<?php foreach ($options as $value) { switch ( $value['type'] ) { case "": ?>
			<?php break; case "tit": ?>
			</li><li class="fate_li">
			<h4><?php echo $value['name']; ?>：</h4>
			<div class="fate_tip"><?php echo $value['tip']; ?></div>
			
			<?php break; case 'text': ?>
			<input class="fate_inp <?php echo $value['class']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />

			<?php break; case 'number': ?>
			<label class="fate_number"><?php echo $value['txt']; ?><input class="fate_num <?php echo $value['class']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" /></label>
			
			<?php break; case 'textarea': ?>
			<textarea class="fate_tarea" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
			
			<?php break; case 'select': ?>
			<?php if ( $value['desc'] != "") { ?><span class="fate_the_desc" id="<?php echo $value['id']; ?>_desc"><?php echo $value['desc']; ?></span><?php } ?><select class="fate_sel" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
				<?php foreach ($value['options'] as $option) { ?>
				<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected" class="fate_sel_opt"'; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
			
			<?php break; case "checkbox": ?>
			<?php if(get_settings($value['id']) != ""){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
			<label class="fate_check"><input type="checkbox" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>" <?php echo $checked; ?> />开启</label>
			
			<?php break; case "section": $i++; ?>
			<div class="fate_mainbox" id="fate_mainbox_<?php echo $i; ?>">
				<ul class="fate_inner">
					<li class="fate_li">
				
			<?php break; case "endtag": ?>
			</li></ul>
			<div class="fate_desc"><input class="button-primary" name="save<?php echo $i; ?>" type="submit" value="保存设置" /></div>
			</div>
			
		<?php break; }} ?>
				
		<input type="hidden" name="action" value="save" />

	</form>

</div>
 
<?php } ?>
<?php add_action('admin_menu', 'mytheme_add_admin');?>