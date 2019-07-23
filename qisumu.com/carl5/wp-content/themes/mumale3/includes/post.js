jQuery(document).ready(function($) {
	var a = !-[1, ] && !window.XMLHttpRequest,
		m = $("body"),
		i = $('#tag-cloud a'),
		k = $('#sidebar textarea'),
		resetTags= function(v){
			var y = " "+v.val()+" ",
				z = $.trim(y).replace(/\s{2,}/ig, " ").split(" ");
			i.each(function() {
				var N = $.inArray($(this).text(),z);
				if(N>-1){
					$(this).addClass('selected');
				}else{
					$(this).removeClass('selected');
				}
			})
		};
	i.live('click',function(e){
		e.preventDefault();
		var k = $('#sidebar textarea').val(),
			m = $(this).text(),
			p = " ";
		$(this).addClass('selected');
		$('#sidebar textarea').val(k+m+p);
		return false;
	});
	k.keyup(function(o) {
		o.stopPropagation();
		var r = $.trim($(this).val()).replace(/\s{2,}/ig, " "),
		s = r.split(','),
		t = s.length;
		resetTags($(this));
	});
});