jQuery(document).ready(function($) {
	
	/*	post formats */
	$(':radio[name="post_format"]').change(function() {
		// quote
		$('#pinthis_quote_settings_box').toggle(this.value == 'quote');
		$('#pinthis_external_link_box').toggle(this.value != 'quote');
		// audio
		$('#pinthis_audio_settings_box').toggle(this.value == 'audio');
		// video
		$('#pinthis_video_settings_box').toggle(this.value == 'video');
	});
	$(':radio[name="post_format"]:checked').change();
	
	/*	upload button */
	$('.event-upload-button').on('click', function() {
		inputField = $(this).parents('.postbox').find('.event-src-field');
		var fileType = $(this).attr('data-rel');
		tb_show('', 'media-upload.php?type='+ fileType +'&TB_iframe=true');
		window.send_to_editor = function(html) { 
			url = $(html).attr('href');
			inputField.val(url);
			tb_remove();
		};
		return false;
	});

});