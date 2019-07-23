/**
 * Custom JS Functionality
 *
 */
( function( $ ) {
    
    jQuery( document ).ready( function() {
        
        // Add button to sub-menu item to show nested pages / Only used on mobile
        $( '.main-navigation li.page_item_has_children, .main-navigation li.menu-item-has-children' ).prepend( '<span class="menu-dropdown-btn"><i class="fa fa-angle-down"></i></span>' );
        // Mobile nav button functionality
        $( '.menu-dropdown-btn' ).bind( 'click', function() {
            $(this).parent().toggleClass( 'open-page-item' );
        });
        // The menu button
        $( '.header-menu-button' ).click( function(e){
            $( 'body' ).toggleClass( 'show-main-menu' );
        });
        
        $( '.main-menu-close' ).click( function(e){
            $( '.header-menu-button' ).click();
        });
        
        // Show / Hide Search
        $( '.menu-search' ).toggle( function(){
            $( 'body').addClass( 'show-site-search' );
            $( '.site-top-bar input.search-field' ).focus();
        },function(){
            $( 'body').removeClass( 'show-site-search' );
        });
		
    });
    
    $(window).resize(function () {
        
        
        
    }).resize();
    
    $(window).load(function() {
        
        nikkon_home_slider();
        
    });
    
    // Hide Search is user clicks anywhere else
    $( document ).mouseup( function (e) {
        var container = $( '.site-top-bar .search-block' );
        if ( !container.is( e.target ) && container.has( e.target ).length === 0 ) {
            $( 'body' ).removeClass( 'show-site-search' );
        }
    });
    
    // Home Page Slider
    function nikkon_home_slider() {
        $( '.home-slider' ).carouFredSel({
            responsive: true,
            circular: true,
            infinite: false,
            width: 1200,
            height: 'variable',
            items: {
                visible: 1,
                width: 1200,
                height: 'variable'
            },
            onCreate: function(items) {
                $( '.home-slider-wrap' ).removeClass( 'home-slider-remove' );
            },
            scroll: {
                fx: 'crossfade',
                duration: 450
            },
            auto: 6500,
            pagination: '.home-slider-pager',
            prev: '.home-slider-prev',
            next: '.home-slider-next'
        });
    }
    
} )( jQuery );