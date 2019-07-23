jQuery(document).ready(function($){
$.fn.myHoverTip = function(divId) {  
    var div = $("#" + divId); 
    div.css("position", "absolute");  
    var self = $(this); 
    self.hover(function() {  
        div.css("display", "block");  
        var p = self.position(); 
        var x = p.left + self.width();  
        var docWidth = $(document).width(); 
        if (x > docWidth - div.width() - 20) {  
            x = p.left - div.width();  
        }  
        div.css("left", x);  
        div.css("top", p.top);  
        div.show();  
    },  
    function() {  
        div.css("display", "none");  
    }  
    );  
    return this;  
}
});