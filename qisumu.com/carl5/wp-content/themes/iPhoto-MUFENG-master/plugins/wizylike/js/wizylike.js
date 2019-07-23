	var i = 0,
	got = -1,
	len = document.getElementsByTagName('script').length;
	while (i <= len && got == -1) {
		var js_url = document.getElementsByTagName('script')[i].src,
		got = js_url.indexOf('wizylike.js');
		i++
	}
	var edit_mode = '1',
	wizylike_url = js_url.substr(0, js_url.indexOf('/js/'));
function wizylike(post_id, type) {

  if (post_id >= 1) {
    if (type === 'like') {

      // like button clicked
      jQuery('#wizylike-post-' + post_id).children('span:first').empty().addClass('wizylike_loading');

      jQuery.post(wizylike_url + '/', {
        post_id: post_id,
        like: 'like'
      },
      function(result) {
        jQuery('#wizylike-post-' + post_id + ' .wizylike_count').text(result)

        jQuery('#wizylike-post-' + post_id + ' .wizylike_icon').removeClass('wizylike_loading').replaceWith('<span class="wizylike_icon" onclick="wizylike(' + post_id + ', \'unlike\');"></span>');
      });

    } else if (type === 'unlike') {

      // unlike button clicked
      jQuery('#wizylike-post-' + post_id).children('span:first').empty().addClass('wizylike_loading');

      jQuery.post(wizylike_url + '/', {
        post_id: post_id,
        like: 'unlike'
      },
      function(result) {
		jQuery('#wizylike-post-' + post_id + ' .wizylike_count').text(result);

        jQuery('#wizylike-post-' + post_id + ' .wizylike_icon').removeClass('wizylike_loading').replaceWith('<span class="wizylike_icon" onclick="wizylike(' + post_id + ', \'like\');"></span>');

      });

    } // end like type check
  } // end post id check
} // end wizylike
