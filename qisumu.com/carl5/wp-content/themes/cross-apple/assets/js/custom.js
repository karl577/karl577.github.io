/*-----------------------------------------------------------------------------------*/
//	Common
/*-----------------------------------------------------------------------------------*/
jQuery.noConflict();
jQuery(document).ready(function(){

		//Hover Fade
		hover();
		fancybox();

		//External links
		jQuery('a[rel*=external]').click( function() {
			window.open(this.href);
			return false;
		});

		//mobile menu
		jQuery('#menu-top-menu').mobileMenu();
		jQuery('#menu-bottom-menu').mobileMenu();

		//Placeholder
		jQuery('[placeholder]').focus(function() {
		  var input = jQuery(this);
		  if (input.val() == input.attr('placeholder')) {
			input.val('');
			input.removeClass('placeholder');
		  }
		}).blur(function() {
		  var input = jQuery(this);
		  if (input.val() == '' || input.val() == input.attr('placeholder')) {
			input.addClass('placeholder');
			input.val(input.attr('placeholder'));
		  }
		}).blur();
		jQuery('[placeholder]').parents('form').submit(function() {
		  jQuery(this).find('[placeholder]').each(function() {
			var input = jQuery(this);
			if (input.val() == input.attr('placeholder')) {
			  input.val('');
			}
		  })
		});


		//Go Top
		jQuery('.sc-gotop a').click(function(){
			jQuery('html, body').animate({scrollTop:0}, 'slow');
			return false;
		});


		//Hide Message Box
		jQuery('.message-box .close').click( function() {
			jQuery(this).parent('.message-box').fadeTo(400, 0.001).slideUp();
		});


		//Flickr
		jQuery('.flickr_badge_image').hover(function(){
			jQuery('img',this).stop().fadeTo(500, 0.5);
			}, function() {
			jQuery('img',this).stop().fadeTo(300, 1.0);
		});


		//Gallery
		jQuery('.gallery .gallery-item').hover(function(){
			jQuery('img',this).stop().fadeTo(500, 0.5);
			}, function() {
			jQuery('img',this).stop().fadeTo(300, 1.0);
		});

		//Tabs
		jQuery(".sc-tab").click(function () {
			jQuery(".sc-tab-active").removeClass("sc-tab-active");
			jQuery(this).addClass("sc-tab-active");
			jQuery(".pane").hide();
			var change_content=  jQuery(this).attr("id");
			jQuery("."+change_content).fadeIn();
			return false;
		});


		//Toggle
		jQuery(".sc-toggle").each(function(){		
			jQuery(this).find(".inner").hide();		
		});
			
		jQuery(".sc-toggle").each(function(){			
			 jQuery(this).find(".title").click(function() {
				jQuery(this).toggleClass("toggled").next().stop(true, true).slideToggle(100);
				return false;
			 });		
		});


		//Cycle
		jQuery('#cycle-prev, #cycle-next').css({opacity: '0'});
		jQuery('.cycleslider-wrap').hover(function(){
			jQuery('#cycle-prev',this).stop().animate({left: '-31', opacity: '1'},200,'easeOutCubic');
			jQuery('#cycle-next',this).stop().animate({right: '-31', opacity: '1'},200,'easeOutCubic');	 
		}, function() {
			jQuery('#cycle-prev',this).stop().animate({left: '-50', opacity: '0'},400,'easeInCubic');
			jQuery('#cycle-next',this).stop().animate({right: '-50', opacity: '0'},400,'easeInCubic');		
		});


		//Portfolio Slider
		jQuery(window).load(function() {
			jQuery('.wp-post-image').css('opacity','1');
			jQuery('.sc-flexslider').flexslider({
				animation: 'slide',
				slideshow: false,                
				slideshowSpeed: 6000,           
				animationDuration: 1000,         
				directionNav: true,             
				controlNav: false,
				controlsContainer: '.sc-slider-list'    
			});
		});



		//Scroll to top
		jQuery(window).scroll(function() {
			if(jQuery(this).scrollTop() != 0) {
				jQuery('#toTop').fadeIn();	
			} else {
				jQuery('#toTop').fadeOut();
			}
		});
		jQuery('#toTop').click(function() {
			jQuery('body,html').animate({scrollTop:0},300);
		});

});



/*-----------------------------------------------------------------------------------*/
//	Preload
/*-----------------------------------------------------------------------------------*/
jQuery(window).bind('load', function() {
     var i = 1;
     var imgs = jQuery('.post-thumb .wp-post-image').length;
     var int = setInterval(function() {

     if(i >= imgs) clearInterval(int);
     jQuery('img.wp-post-image:not(.image-loaded)').eq(0).animate({ top: "0", opacity: "1"},150,"easeInQuart").addClass('image-loaded');
     i++;
     
     }, 100);     
});


/*-----------------------------------------------------------------------------------*/
//	Preload - images - Quicksand
/*-----------------------------------------------------------------------------------*/
function preload_images(){
	  	jQuery('a.image-link').removeClass('image-loaded');
	  	jQuery('.wp-post-image').css('opacity','1');
};



/*-----------------------------------------------------------------------------------*/
//	Image - Hover
/*
	jQuery("a.image-link").hover(function () {						 
	jQuery(this).find("img").stop(true, true).animate({ opacity: 0.5 }, 500);
	jQuery(this).find(".wp-post-image").fadeIn(500);
	}, function() {
		jQuery(this).find("img").stop(true, true).animate({ opacity: 1.0 }, 300);
		jQuery(this).find(".wp-post-image").fadeOut(300);
	});
*/
/*-----------------------------------------------------------------------------------*/
function hover(){
	jQuery('a.image-link').hover(function(){
	    jQuery('.wp-post-image, .avatar',this).stop().fadeTo(500, 0.5);
	    jQuery('a.image-link').css('background', 'none');
		}, function() {
		jQuery('.wp-post-image, .avatar',this).stop().fadeTo(300, 1.0);
	});
};


function fancybox() {
	jQuery('a[data-id^="fancybox"]').fancybox({
		'overlayShow'	: true,
		'overlayColor'		: '#000',
		'autoScale'		:	true,
		'titleShow'		: 	false,
		'speedIn'		:	300, 
		'speedOut'		:	300, 
		'transitionIn'	: 'fade',
		'transitionOut'	: 'fade'			
	});

	jQuery('.gallery .gallery-item a').fancybox({
		'overlayShow'	: true,
		'overlayColor'		: '#000',
		'autoScale'		:	true,
		'titleShow'		: 	false,
		'speedIn'		:	300, 
		'speedOut'		:	300, 
		'transitionIn'	: 'fade',
		'transitionOut'	: 'fade'			
	});
}



/*-----------------------------------------------------------------------------------*/
// jQuery Quicksand project categories filtering 
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function(){
 	// Clone applications to get a second collection
	var $data = jQuery(".portfolio-sortable-grid").clone();
	
	jQuery('.portfolio-sortable-menu li').click(function(e) {
		jQuery(".filter li").removeClass("active");	
		var filterClass=jQuery(this).attr('class').split(' ').slice(-1)[0];
		
		if (filterClass == 'all-items') {
			var $filteredData = $data.find('.item');
		} else {
			var $filteredData = $data.find('.item.' + filterClass );
		}
		jQuery(".portfolio-sortable-grid").quicksand($filteredData, {
			duration: 500,
			useScaling: false,
			easing: 'swing',
			adjustHeight: 'dynamic',
			enhancement: function() {
			            //jQuery('.wp-post-image:hidden').fadeIn(300);
			           	preload_images();
						hover();
						fancybox();
			}		
		});
		jQuery(this).addClass("active");			
		return false;
	});
	
});