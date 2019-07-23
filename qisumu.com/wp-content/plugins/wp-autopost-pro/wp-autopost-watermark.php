<?php
 if($_POST['saction'] == 'updateOption' || $_POST['saction'] == 'preview'){
   
   $preOption = get_option( 'wp-watermark-options' );
   $size = $_POST['size'];
   if(!preg_match("/^\+?[1-9][0-9]*$/",$size))$size=16;
   
   $transparency = $_POST['transparency'];
   if(!preg_match("/^\d+$/",$transparency))$transparency=80;
   if($transparency>100)$transparency=100;
   if($transparency<0)$transparency=0;

   $jpeg_quality = $_POST['jpeg_quality'];
   if(!preg_match("/^\+?[1-9][0-9]*$/",$jpeg_quality))$jpeg_quality=90;
   if($jpeg_quality>100)$jpeg_quality=100;

   $xadjustment = $_POST['x-adjustment'];
   if(!preg_match("/^[-]?\d+$/",$xadjustment))$xadjustment=0;
   $yadjustment = $_POST['y-adjustment'];
   if(!preg_match("/^[-]?\d+$/",$yadjustment))$yadjustment=0;
   $min_width = $_POST['min_width'];
   if(!preg_match("/^\+?[1-9][0-9]*$/",$min_width))$min_width=300;
   $min_height = $_POST['min_height'];
   if(!preg_match("/^\+?[1-9][0-9]*$/",$min_height))$min_height=300;
      

   $options = array(
	  'type' => $_POST['type'],
	  'position' => $_POST['position'],
	  'font' => $_POST['font'],
	  'text' => (trim($_POST['text'])=='')?get_bloginfo('url'):$_POST['text'],
	  'size' => $size,
	  'color' => (trim($_POST['color'])=='')?'#ffffff':$_POST['color'],
	  'x-adjustment' => $xadjustment,
	  'y-adjustment' => $yadjustment,
	  'transparency' => $transparency,
	  'upload_image' => $preOption['upload_image'],
	  'upload_image_url' => $preOption['upload_image_url'],
	  'min_width' => $min_width,
	  'min_height' => $min_height,
	  'jpeg_quality' => $jpeg_quality
   );
   update_option( 'wp-watermark-options', $options );
 }


 if($_POST['saction'] == 'uploadImg'){
   
   $wm_dir = dirname(__FILE__).'/watermark/uploads';
   $wm_url = plugins_url('/watermark/uploads', __FILE__ );
   $fileinfo = $_FILES['watermark-image'];
   $file = $fileinfo['tmp_name'];
   $des = $wm_dir.'/'.$fileinfo['name'];
   $res = move_uploaded_file( $file, $des);
   if( $res ){
	  $options = get_option( 'wp-watermark-options' );
	  $options['type'] = 1;
	  $options['upload_image'] = $des;
	  $options['upload_image_url'] = $wm_url.'/'.$fileinfo['name'];
	  update_option( 'wp-watermark-options', $options );
   }

 }
   
   
 $options = get_option( 'wp-watermark-options');

 if($_POST['saction'] == 'preview'){
   WP_Autopost_Watermark::genPreviewWaterMark($options);
   $showPreview=true;
 }

?>

<script type="text/javascript">
jQuery(document).ready(function($){

	$('#type-switch input').change(function(){
		var sSwitch = $(this).val();
		if( sSwitch == 0 ){
			$("#image_type").hide();
			$("#text_type").show();
		}
		else{
			$("#image_type").show();
			$("#text_type").hide();
		}
	});

});
function updateOption(){
  document.getElementById("saction").value='updateOption';
  document.getElementById("myform").action='admin.php?page=wp-autopost-pro/wp-autopost-watermark.php';
  document.getElementById("myform").submit();
}
function uploadImg(){
  document.getElementById("saction").value='uploadImg';
  document.getElementById("myform").action='admin.php?page=wp-autopost-pro/wp-autopost-watermark.php';
  document.getElementById("myform").submit();
}
function preview(){
  document.getElementById("saction").value='preview';
  document.getElementById("myform").action='admin.php?page=wp-autopost-pro/wp-autopost-watermark.php#preview_pic';
  document.getElementById("myform").submit();
}
</script>

<div class="wrap">
  <div class="icon32" id="icon-wp-autopost"><br/></div>
  <h2><?php echo __('Watermark Options','wp-autopost'); ?></h2>
  <form action="" method="post" id="myform" enctype="multipart/form-data">
  <input type="hidden" name="saction" id="saction" value="" />
  <table class="form-table">
   <tr>
      <th scope="row"><label><?php _e( 'Watermark Type', 'wp-autopost' );?>:</label></th>
	  <td>
	   <div id="type-switch">
	    <input type="radio" name="type" value="0" <?php checked( '0', $options['type'] ); if( empty( $options['type'] ) ) echo 'checked'; ?> /><?php _e( 'Text', 'wp-autopost' );?>
	    &nbsp;&nbsp;&nbsp;
	    <input type="radio" name="type" value="1" <?php checked( '1', $options['type'] ); ?> /><?php _e( 'Image', 'wp-autopost' );?>
	   </div>
	  </td>
   </tr>
  </table>
  
  <table id="text_type" class="form-table" <?php if($options['type']==1) echo 'style="display:none;"'; ?> >
   <tr>
      <th scope="row"><label><?php _e( 'Text', 'wp-autopost' );?>:</label></th>
	  <td>
	   <input type="text" name="text" value="<?php echo $options['text']; ?>" size="60" />
	  </td>
   </tr>
   <tr>
      <th scope="row"><label><?php _e( 'Fonts', 'wp-autopost' );?>:</label></th>
	  <td>
	    <select id="fonts" name="font">
    <?php 
		 $default_fonts = WP_Autopost_Watermark::get_fonts(); 
		 foreach( $default_fonts as $key=>$default_font ){ ?>
          <option value="<?php echo $default_font ?>" <?php selected( $default_font, stripslashes($options['font']) ); ?>><?php echo $key; ?></option>
     <?php } ?>
		</select>
		<br/>
        <span class="gray">
		<?php $fontsDirectory = dirname(__FILE__).'/watermark/fonts/'; ?>
	       <?php echo __( 'you can upload the <b>xxx.ttf</b> font files to the ','wp-autopost').'<i><b>'.$fontsDirectory.'</b></i>'.__(' directory', 'wp-autopost' );?>
           <?php if(get_bloginfo('language')=='zh-CN'): 
                   echo '<br/>(若水印文本为中文，需要使用中文字体)';
		         endif; ?>
		</span>
	  </td>
   </tr>
   <tr>
      <th scope="row"><label><?php _e( 'Fonts Size', 'wp-autopost' );?>:</label></th>
	  <td>
	   <input type="text" name="size" value="<?php echo $options['size']; ?>" /> px
	  </td>
   </tr>
   <tr>
      <th scope="row"><label><?php _e( 'Fonts Color', 'wp-autopost' );?>:</label></th>
	  <td>
	   <input type="text" name="color" value="<?php echo $options['color']; ?>" />&nbsp;<span class="gray">( <?php _e( 'eg. #ffffff', 'wp-autopost' );?> )</span>
	  </td>
   </tr>
  </table>


  <table id="image_type" class="form-table" <?php if($options['type']==0||empty( $options['type']) ) echo 'style="display:none;"'; ?>>
   <tr>
      <th scope="row"><label><?php _e( 'Upload Image', 'wp-autopost' );?>:</label></th>
	  <td>
	   <input type="file" class="button" name="watermark-image" id="watermark-image" size="60" />
	   <input type="button" class="button" value="<?php _e( 'Upload Image', 'wp-autopost' );?>"  onclick="uploadImg()"/>
	  </td>
   </tr>
   <tr>
      <th></th>
	  <td>
         <?php if($options['upload_image_url']!=''){ ?>
		 <div class="watermark_preview_pic" ><img src="<?php echo $options['upload_image_url'];  ?>" alt="" /></div>
		 <?php } ?>
	  </td>
   </tr>
  </table>

  <table class="form-table">
   <tr>
      <th scope="row"><label><?php _e( 'Transparency', 'wp-autopost' );?>:</label></th>
	  <td>
	   <input type="text" name="transparency" value="<?php echo $options['transparency']; ?>" />&nbsp;<span class="gray">( <?php _e( 'from 0 to 100', 'wp-autopost' );?> )</span>
	  </td>
   </tr>
   <tr>
      <th scope="row"><label><?php _e( 'Jpeg quality', 'wp-autopost' );?>:</label></th>
	  <td>
	   <input type="text" name="jpeg_quality" value="<?php echo $options['jpeg_quality']; ?>" />&nbsp;<span class="gray"><?php _e( 'ranges from 1 (worst quality, smaller file) to 100 (best quality, biggest file)', 'wp-autopost' );?></span>
	  </td>
   </tr>
   <tr>
      <th scope="row"><label><?php _e( 'Watermark Position', 'wp-autopost' );?>:</label></th>
	  <td>
	    <table border="1" cellpadding="5" bordercolor="#ccc" id="dw-position">
		<tr>
			<td>&nbsp;&nbsp;<input type="radio" name="position" value="1" <?php checked( '1', $options['position'] );?>/></td>
			<td>&nbsp;&nbsp;<input type="radio" name="position" value="2" <?php checked( '2', $options['position'] );?>/></td>
			<td>&nbsp;&nbsp;<input type="radio" name="position" value="3" <?php checked( '3', $options['position'] );?>/></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;<input type="radio" name="position" value="4" <?php checked( '4', $options['position'] );?>/></td>
			<td>&nbsp;&nbsp;<input type="radio" name="position" value="5" <?php checked( '5', $options['position'] );?>/></td>
			<td>&nbsp;&nbsp;<input type="radio" name="position" value="6" <?php checked( '6', $options['position'] );?>/></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;<input type="radio" name="position" value="7" <?php checked( '7', $options['position'] );?>/></td>
			<td>&nbsp;&nbsp;<input type="radio" name="position" value="8" <?php checked( '8', $options['position'] );?>/></td>
			<td>&nbsp;&nbsp;<input type="radio" name="position" value="9" <?php checked( '9', $options['position'] ); if( empty($options['position']) ) echo 'checked'; ?>/></td>
		</tr>					
	    </table>
	  </td>
   </tr>
   <tr>
      <th scope="row"><label><?php _e( 'Level Adjustment', 'wp-autopost' );?>:</label></th>
	  <td>
	   <input type="text" name="x-adjustment" value="<?php echo $options['x-adjustment']; ?>" /> px&nbsp;<span class="gray">(<?php _e( 'eg. 5 or -5', 'wp-autopost' );?>)</span>
	  </td>
   </tr>
   <tr>
      <th scope="row"><label><?php _e( 'Vertical Adjustment', 'wp-autopost' );?>:</label></th>
	  <td>
	   <input type="text" name="y-adjustment" value="<?php echo $options['y-adjustment']; ?>" /> px&nbsp;<span class="gray">(<?php _e( 'eg. 5 or -5', 'wp-autopost' );?>)</span>
	  </td>
   </tr>
   <tr>
      <th scope="row"><label><?php _e( 'Can add a watermark image size', 'wp-autopost' );?>:</label></th>
	  <td>
	    <?php _e( 'Min Width', 'wp-autopost' );?>:<input type="text" name="min_width" value="<?php echo $options['min_width']; ?>" />
		&nbsp;&nbsp;
		<?php _e( 'Min Height', 'wp-autopost' );?>:<input type="text" name="min_height" value="<?php echo $options['min_height']; ?>" />
	  </td>
   </tr>
  </table>
  
  <table class="form-table">
   <tr>
    <td> 
	  <div id="preview_pic" class="watermark_preview_pic" ><img width="610" height="377" src="<?php  echo plugins_url('/watermark/preview_img.jpg', __FILE__ ).'?random='.time(); ?>" alt="" /></div>
	</td>
   </tr>
   <tr>
     <td>
	    <input type="button" class="button-primary"  value="<?php echo __('Save Changes'); ?>" onclick="updateOption()"/>&nbsp;
        <input type="button" class="button"   value="<?php echo __('Preview'); ?>"  onclick="preview()" />
	 </td>
   </tr>
  </table>
 </form>
</div>