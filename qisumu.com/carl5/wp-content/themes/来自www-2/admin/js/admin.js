jQuery(document).ready(function() {   
        jQuery('input.upbottom').click(function() {   
             targetfield = jQuery(this).prev('textarea');   
             tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');   
             return false;   
        });   
          
          
        jQuery('input.upbottom1').click(function() {   
             targetfield = $('.hdt1');   
             tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');   
             return false;   
        });   
         

        jQuery('input.upbottom2').click(function() {   
             targetfield = $('.hdt2');   
             tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');   
             return false;   
        });   
        

        jQuery('input.upbottom3').click(function() {   
             targetfield = $('.hdt3');   
             tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');   
             return false;   
        });   
        

        jQuery('input.upbottom4').click(function() {   
             targetfield = $('.hdt4');   
             tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');   
             return false;   
        });   
        window.send_to_editor = function(html) {   
             imgurl = jQuery('img',html).attr('src');   
             jQuery(targetfield).val(imgurl);   
             tb_remove();   
        } 
        jQuery('button.album_btn').click(function() {   
            var a = jQuery('.album_area').val();
            var u = location.href;
            if (a != "") {
                jQuery(".enews_load").css('display','block');
                jQuery.post(u, {album:a,action:"album"}, function(e) {
                    jQuery(".enews_load").css('display','none');
                    if (e != "0") {
                        jQuery("#album_field").html(e);
                    };
                });
            };
            return false;   
        });   
});