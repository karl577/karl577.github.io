/* */
JQ360(document).ready(function() {
	JQ360(window).scroll(function() {
		if (JQ360(document).scrollTop() > 0) {
			if(JQ360('#hd').is('.bgfff') == false) {
				JQ360("#hd").addClass("bgfff");
			}
		}
		else{
			if(JQ360('#hd').is('.bgfff')) {
				JQ360("#hd").removeClass("bgfff");
				JQ360("#hd").addClass("nobg");
			}
		}
	});
});
