jQuery(document).ready(function() {
   
	//Favicon Image Upload
	jQuery('#favicon_button').click(function() {		
		window.send_to_editor = function(html) 		
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#favicon').val(imgurl);
			tb_remove();
		}	 
	 
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;		
	});


	//Logo Image Upload
	jQuery('#logo_button').click(function() {		
		window.send_to_editor = function(html) 		
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#logo').val(imgurl);
			tb_remove();
		}	 
	 
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;		
	});


	//Feature Image Upload
	jQuery('#feature_image_button').click(function() {		
		window.send_to_editor = function(html) 		
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#feature_image').val(imgurl);
			tb_remove();
		}	 
	 
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;		
	});


	//Banner Upload
	jQuery('#banner_image_button').click(function() {		
		window.send_to_editor = function(html) 		
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#banner_image').val(imgurl);
			tb_remove();
		}	 
	 
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;		
	});


	//Background Upload
	jQuery('#body_bg_image_button').click(function() {		
		window.send_to_editor = function(html) 		
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#body_bg_image').val(imgurl);
			tb_remove();
		}	 
	 
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;		
	});


	//Slider Image Upload
	jQuery('#slidershow_image_button').click(function() {		
		window.send_to_editor = function(html) 		
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#slidershow_image').val(imgurl);
			tb_remove();
		}	 
	 
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;		
	});


	jQuery('#slidershow_thumbnail_button').click(function() {		
		window.send_to_editor = function(html) 		
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#slidershow_thumbnail').val(imgurl);
			tb_remove();
		}	 
	 
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;		
	});


});