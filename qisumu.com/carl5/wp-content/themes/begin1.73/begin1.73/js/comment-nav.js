/**
 * ∆¿¬€∑÷“≥
 */

$(document).ready(function(){
$body=(window.opera)?(document.compatMode=="CSS1Compat"?$('html'):$('body')):$('html,body');
$(document).on('click', '.comment-navigation a', function(e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: $(this).attr('href'),
        beforeSend: function(){
            $('.comment-navigation').remove();
            $('.comment-list').remove();
            $('.loading-comments').slideDown();
            $body.animate({ scrollTop: $('.comments-title').offset().top - 65 }, 1200 );
        },
        dataType: "html",
        success: function(out){
            result = $(out).find('.comment-list');
            nextlink = $(out).find('.comment-navigation');
            $('.loading-comments').slideUp('fast');
            $('.loading-comments').after(result.fadeIn(500));
            $('.comment-list').after(nextlink);
        }
    });
});
});
