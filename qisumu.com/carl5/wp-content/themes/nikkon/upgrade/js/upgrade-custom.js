/**
 * Nikkon Custom JS Functionality
 *
 */
( function( $ ) {
    
    jQuery( document ).ready( function() {
        
        
        
    });
    
    $(window).resize(function () {
        
        
        
    }).resize();
    
    $(window).load(function() {
        
        nikkon_upgrade_ratings_slider();
        
    });
    
    // Upgrade Ratings Slider
    function nikkon_upgrade_ratings_slider() {
        $( '.upgrade-rating-slider' ).carouFredSel({
            responsive: true,
            circular: true,
            infinite: false,
            width: 280,
            height: 'variable',
            items: {
                visible: 1,
                start: 'random',
                width: 280,
                height: 'variable'
            },
            onCreate: function(items) {
                $( '.upgrade-rating-slider-wrap' ).removeClass( 'upgrade-rating-slider-wrap-remove' );
            },
            scroll: {
                fx: 'crossfade',
                duration: 450
            },
            auto: 10000,
            prev: '.upgrade-rating-slider-prev',
            next: '.upgrade-rating-slider-next'
        });
    }
    
} )( jQuery );