/**
 * Custom Blocks Functionality
 *
 */
( function( $ ) {
    
    $(window).load(function() {
        // var $container = $('.body-blocks-layout .blog-blocks-wrap');
        var $container = $( '.blog-blocks-wrap-inner' );
        
        // initialize
        $container.masonry({
            columnWidth: 'article.blog-blocks-layout',
            itemSelector: 'article.blog-blocks-layout'
        });
        
        // Show layout once Masonry is complete
        $container.masonry( 'on', 'layoutComplete', onBlogGridLayout() );
    });
    
    function onBlogGridLayout() {
        $( '.blog-blocks-wrap' ).removeClass( 'blog-blocks-wrap-remove' );
    }
    
} )( jQuery );