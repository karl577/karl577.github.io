        $(function() {
            var state = true;
            $("#web_btn").click(function(){
                if (state == true) {
                    $("#oculus_appkey").removeAttr("disabled");
                    $("#oculus_appsecret").removeAttr("disabled");
                    $("#oculus_accesskeyid").removeAttr("disabled");
                    $("#oculus_accesskeysecret").removeAttr("disabled");
                    $(".web_set2").show();
                    $(".web_set1").hide();
                    $(".txt").attr("style","border:#999 solid 1px;");
                    state = false;
                }else{
                    $.ajax({
                        type:'POST',
                        url:'admin.php?action=plugins&operation=config&do=$do&identifier=oculus&pmod=oculuscloud',
                        data: 'web_keyset='+$("#oculus_appkey").val()+'/'+$("#oculus_appsecret").val()+'/'+$("#oculus_accesskeyid").val()+'/'+$("#oculus_accesskeysecret").val(),

                        success:function(data){
                                  document.write(data);
                        }
                        
                    });
                    
                };
            });     
        });
        