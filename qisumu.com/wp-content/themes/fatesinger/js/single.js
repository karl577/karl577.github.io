$(document).ready(function() {
var secondleft;
function init() {
secondleft = $('#sharebar').offset().left;

}
init();
$(window).resize(function () {
	init();
});

$(window).scroll(function() {				
					var top = $(window).scrollTop();
				
				if (top > 100) {
                    $('#sharebar').css({
						position: 'fixed',
						top: '40px',
						left: secondleft
					});
				}else if (top < 100) {
					$('#sharebar').css({
						position: 'absolute',
						top: '',
						left:''
					})
				}
				
			});
$('#sharebar ul').lavaLamp({target:'li',autoResize:true,autoReturn:false,speed:500});
$("#sharebar ul").hover(function(){$("#sharebar ul li.backLava").stop(true,true).animate({opacity:'1'},0);},function(){$("#sharebar ul li.backLava").stop(true,true).animate({opacity:'0'},0);});
$('.Related_Posts ul').lavaLamp({target:'li',autoResize:true,autoReturn:false,speed:500});
$(".Related_Posts ul").hover(function(){$(".Related_Posts ul li.backLava").stop(true,true).animate({opacity:'1'},0);},function(){$(".Related_Posts ul li.backLava").stop(true,true).animate({opacity:'0'},0);});			
});



