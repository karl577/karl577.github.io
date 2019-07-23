$(document).ready(function() {
    "use strict";
    // jQuery tooltips
    $('#top-navigation ul.social li a, .widget ul.social-subscribers li a').tooltip();
    /* Highlight posts */
    $('#highlight-posts ul li a').hover(function() {
        $(this).parent().children('.masked-color').show();
        $(this).parent().children('.masked-base').hide();
    }, function() {
        $(this).parent().children('.masked-base').show();
        $(this).parent().children('.masked-color').hide();
    });
    /* End Highlight posts */
    /* jQuery slider */
    // Highlight posts image rotate
    $('#highlight-posts .flexslider.highlight-one').flexslider({
        controlNav: false,
        directionNav: false,
        slideshowSpeed: 10000,
        start: function() {
            $('#highlight-posts .flexslider.highlight-one').removeClass('loading');
        }
    });
    $('#highlight-posts .flexslider.highlight-two').flexslider({
        controlNav: false,
        directionNav: false,
        slideshowSpeed: 3500,
        start: function() {
            $('#highlight-posts .flexslider.highlight-two').removeClass('loading');
        }
    });
    $('#highlight-posts .flexslider.highlight-three').flexslider({
        controlNav: false,
        directionNav: false,
        slideshowSpeed: 8000,
        start: function() {
            $('#highlight-posts .flexslider.highlight-three').removeClass('loading');
        }
    });
    $('#highlight-posts .flexslider.highlight-four').flexslider({
        controlNav: false,
        directionNav: false,
        slideshowSpeed: 6000,
        start: function() {
            $('#highlight-posts .flexslider.highlight-four').removeClass('loading');
        }
    });
    // Homepage thumb slider
    $('#home-slider.home-slider .flexslider.home-slider-carousel').flexslider({
        animation: "slide",
        controlNav: false,
        directionNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 1,
        asNavFor: '#home-slider.home-slider .flexslider.home-slider-gallery'
    });
    // Homepage slider
    $('#home-slider.home-slider .flexslider.home-slider-gallery').flexslider({
        animationSpeed: 1000,
        controlNav: false,
        sync: "#home-slider.home-slider .flexslider.home-slider-carousel",
        start: function() {
            $('#home-slider.home-slider .flexslider.home-slider-gallery').removeClass('loading');
        }
    });
    // Homepage slider 2
    $('#home-slider.home-slider2 .flexslider').flexslider({
        animationSpeed: 1000,
        start: function() {
            $('#home-slider.home-slider2 .flexslider').removeClass('loading');
        }
    });
    // Homepage thumb slider 3
    $('#home-slider.home-slider3 .flexslider.home-slider3-carousel').flexslider({
        animation: "slide",
        controlNav: false,
        directionNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 1,
        asNavFor: '#home-slider.home-slider3 .flexslider.home-slider3-gallery'
    });
    // Homepage slider 3
    $('#home-slider.home-slider3 .flexslider.home-slider3-gallery').flexslider({
        animationSpeed: 1000,
        controlNav: false,
        sync: "#home-slider.home-slider3 .flexslider.home-slider3-carousel",
        start: function() {
            $('#home-slider.home-slider3 .flexslider.home-slider3-gallery').removeClass('loading');
        }
    });
    // Single gallery thumb slider
    $('#main .flexslider.slider-carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 120,
        asNavFor: '#main .flexslider.slider-gallery'
    });
    // Single gallery slider
    $('#main .flexslider.slider-gallery').flexslider({
        animationSpeed: 1000,
        animationLoop: false,
        slideshow: false,
        controlNav: false,
        sync: "#main .flexslider.slider-carousel",
        start: function() {
            $('#main .flexslider.slider-gallery').removeClass('loading');
        }
    });
    // General slider
    $('#main .flexslider, #sidebar .flexslider').flexslider({
        animationSpeed: 1000,
        animationLoop: false,
        slideshow: false,
        start: function() {
            $('#main .flexslider, #sidebar .flexslider').removeClass('loading');
        }
    });
    /* End jQuery slider */
    // Headline news text rotator
    $(".headlines .text-rotator").show().ticker({
        rate: 50,
        delay: 5000
    }).trigger("play");
    /* Responsive menu */
    $('#top-navigation ul.nav-menu').mobileMenu({ // Create a top navigation menu for the responsive navigation
        defaultText: '菜单列表....',
        className: 'select-top-nav',
        subMenuDash: '&mdash;'
    });
    $('#main-navigation > ul').mobileMenu({ // Create a main navigation menu for the responsive navigation
        defaultText: '菜单列表....',
        className: 'slect-main-nav',
        subMenuDash: '&mdash;'
    });
    $("#top-navigation select, #main-navigation select").change(function() { // Make the drop-down work
        window.location = $(this).find("option:selected").val();
    });
    /* End responsive menu */
    // Portofolio filter
    $(window).load(function() {
        var $container = $('.portofolio .portofolio-items');
        var $filter = $('.portofolio .portofolio-filter');
        // Initialize
        $container.isotope({
            filter: '*',
            layoutMode: 'fitRows',
            animationOptions: {
                duration: 400
            }
        });
        // Trigger item lists filter when link clicked
        $filter.find('a').click(function() {
            var selector = $(this).attr('data-filter');
            $filter.find('a').removeClass('active');
            $(this).addClass('active');
            $container.isotope({
                filter: selector,
                animationOptions: {
                    animationDuration: 400,
                    queue: false
                }
            });
            return false;
        });
    });
    // jQuery placeholder for IE
    $("input, textarea").placeholder();
    /* Back to top scroll */
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').slideDown();
        } else {
            $('.scrollup').slideUp();
        }
    });
    $('.scrollup').click(function() {
        $("html, body").stop().animate({
            scrollTop: 0
        }, 2000, 'easeInOutExpo');
        return false;
    });
    /* End Back to top scroll */
    // Flickr gallery
    $('.widget #flickr-gallery').jflickrfeed({
        limit: 12,
        qstrings: {
            id: '36587311@N08' // Your flickr id
        },
        itemTemplate: '<li class="photo">' + '<a href="{{image_b}}" target="_blank"><img src="{{image_s}}" alt="{{title}}" /></a>' + '</li>'
    });
    // Image preloader
    $("#main.image-preloader figure > img, #main.image-preloader figure.figure-overlay img, #main.image-preloader figure.figure-hover img, #main.image-preloader p img, #main.image-preloader div > a > img").lazyload({
        placeholder: "images/grey.gif",
        effect: "fadeIn"
    });
    /* Customizer */
    $("#customize h5").click(function() {
        $("#customize .wrapper").slideToggle();
    });
    $("#customize .colors a").click(function(e) {
        var $color = $(this).attr('class');
        $('head').append('<link rel="stylesheet" type="text/css" href="css/customizer/' + $color + '.css">');
        $('#header .logo img').attr('src', 'css/customizer/images/' + $color + '/logo.png');
        e.preventDefault();
    });
    /* End customizer */
    /* Figure overlay & hover */
    $('figure.figure-hover').hover( // Figure hover effect
        function() {
            $(this).children(".figure-hover-masked").fadeIn();
        }, function() {
            $(this).children(".figure-hover-masked").fadeOut();
        });
    $('figure.figure-overlay').each(function() {
        $(this).hoverdir({ // Figure overlay effect
            hoverParent: $(this).children('a'),
            hoverElement: $(this).children('a').children('div').children('p')
        });
    });
    /* End figure overlay & hover */
});