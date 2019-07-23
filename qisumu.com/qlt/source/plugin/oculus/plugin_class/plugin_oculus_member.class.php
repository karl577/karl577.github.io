<?php
if(! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_oculus_member  extends plugin_oculus{  

    function register_input_output(){    
        if ($this->_cur_mod_is_valid()) {
            $cur_mod = "register";
            if($_GET["infloat"] == "yes"){
                $oc_oculus_id = "oc_float_register_input";
                $page_type = "register_float";
            }else{
                $oc_oculus_id = "oc_page_register_input";
                $page_type = "register";
            }
            return $this->_code_output($cur_mod, $oc_oculus_id, $page_type);
       }   

    }
        
    function logging_input_output() {
        if ($this->_cur_mod_is_valid()) {
            $cur_mod = "logging";
            if($_GET["infloat"] == "yes"){
                $oc_oculus_id = "oc_float_logging_input";
                $page_type = "logging_float";
            }else{
                $oc_oculus_id = "oc_page_logging_input";
                $page_type = "logging";
            }
            return $this->_code_output($cur_mod, $oc_oculus_id, $page_type);
        }
    }

    function lostpasswd_code(){
        global $_G;
        $cur = CURMODULE;
        if(!preg_match("/^[0-9a-z_]{1,}$/i",$_POST["_NC"])){
            $_POST["_NC"] = "lostpw_nc";
        }
        if($this->_cur_mod_is_valid() && $this->captcha_allow && $cur == "lostpasswd") {
                if(submitcheck('lostpwsubmit', 0, $seccodecheck, $secqaacheck)){
                if(( $_POST['sessionId'] == null && $_POST['sig'] == null && $_POST['app_token'] == NULL)){
                    showmessage(lang('plugin/oculus', 'seccode_slide'),'',array(),array('extrajs' => '<script type="text/javascript" reload="1">window.'.htmlspecialchars($_POST['_NC']).'.reload();</script>'));
                }
                $response = $this->oculus_validate();
                if($response != 1){
                    if($response == -1){
                        showmessage(lang('plugin/oculus', 'seccode_invalid'),'',array(),array('extrajs' => '<script type="text/javascript" reload="1">window.'.htmlspecialchars($_POST['_NC']).'.reload();</script>'));
                    }else if($response == 0){
                        showmessage( lang('plugin/oculus', 'seccode_expired'),'',array(),array('extrajs' => '<script type="text/javascript" reload="1">window.'.htmlspecialchars($_POST['_NC']).'.reload();</script>'));
                    }
                }
            } 
            
        }
    }
    function register_code(){
        global $_G;
        $cur = CURMODULE;
        if(!preg_match("/^[0-9a-z_]{1,}$/i",$_POST["_NC"])){
            $_POST["_NC"] = "nc";
        }
        if($this->_cur_mod_is_valid() && $this->captcha_allow && $cur == "register") {
            if(submitcheck('regsubmit', 0, $seccodecheck, $secqaacheck)){
                if(( $_POST['sessionId'] == null && $_POST['sig'] == null && $_POST['app_token'] == NULL)){
                    showmessage(lang('plugin/oculus', 'seccode_slide'),'',array(),array('extrajs' => '<script type="text/javascript" reload="1">window.'.htmlspecialchars($_POST['_NC']).'.reload();</script>'));
                }
                $response = $this->oculus_validate();
                if($response != 1){
                    if($response == -1){
                        showmessage(lang('plugin/oculus', 'seccode_invalid'),'',array(),array('extrajs' => '<script type="text/javascript" reload="1">window.'.htmlspecialchars($_POST['_NC']).'.reload();</script>'));
                    }else if($response == 0){
                        showmessage( lang('plugin/oculus', 'seccode_expired'),'',array(),array('extrajs' => '<script type="text/javascript" reload="1">window.'.htmlspecialchars($_POST['_NC']).'.reload();</script>'));
                    }
                }
            }       
        }
    }   
    function logging_code() {
        if($_GET['action'] == "logout"){
            return;
        }
        $cur = CURMODULE;
        if ($this->open && $this->logging_mod_valid()) {
            if($_GET['username'] != "" && $_GET['password'] != "" && $_GET['lssubmit'] == "yes"){
                if(( $_POST['sessionId'] == null && $_POST['sig'] == null && $_POST['app_token'] == NULL))
                    {
                    $this->_show();
                    return;
                }
            }
        }else{
            return;
        }

        if( ! $this->has_authority() ){
            return;
        }

        global $_G;
        if(!preg_match("/^[0-9a-z_]{1,}$/i",$_POST["_NC"])){
            $_POST["_NC"] = "nc";
        }
        if($this->_cur_mod_is_valid() && $this->captcha_allow) {
            if(submitcheck('loginsubmit', 1, $seccodestatus) && empty($_POST['lssubmit'])) {//
                if(( $_POST['sessionId'] == null && $_POST['sig'] == null && $_POST['app_token'] == NULL)){
                    showmessage(lang('plugin/oculus', 'seccode_slide'),'',array(),array('extrajs' => '<script type="text/javascript" reload="1">window.'.htmlspecialchars($_POST['_NC']).'.reload();</script>'));
                }
                $response = $this->oculus_validate();
                 if($response != 1){//
                    if($response == -1){
                        if($_POST["_NC"] == 'discuz_header_nc'){
                         showmessage(lang('plugin/oculus', 'seccode_invalid'),'',array(),array('extrajs' => $this->_show()));   
                        }
                        else{
                         showmessage(lang('plugin/oculus', 'seccode_invalid'),'',array(),array('extrajs' => '<script type="text/javascript" reload="1">window.'.htmlspecialchars($_POST['_NC']).'.reload();</script>'));                           
                        }
                    }else if($response == 0){
                        if($_POST["_NC"] == 'discuz_header_nc'){
                         showmessage( lang('plugin/oculus', 'seccode_expired'),'',array(),array('extrajs' => $this->_show()));   
                        }
                        else{
                        showmessage( lang('plugin/oculus', 'seccode_expired'),'',array(),array('extrajs' => '<script type="text/javascript" reload="1">window.'.htmlspecialchars($_POST['_NC']).'.reload();</script>'));                    
                        }
                    }
                }
            }
        }
    }

    public function _show(){
         include template('common/header_ajax');
         $js = <<<JS
        <script type="text/javascript" reload="1" defer="true">
            var btn=document.getElementById("header-loggin-btn");
            btn.click();
         </script>
JS;
        echo($js);
         include template('common/footer_ajax');
         dexit();
    }
 

     public function _init(){
         include template('common/header_ajax');
         $js = <<<JS

JS;
        echo($js);
         include template('common/footer_ajax');
         dexit();
    }


    function has_authority(){
        //针对掌上论坛不需要验证
        if( $_GET['mobile'] == 'no' && $_GET['submodule'] == 'checkpost' ){
            return false;
        }
        return true;
    }

}
