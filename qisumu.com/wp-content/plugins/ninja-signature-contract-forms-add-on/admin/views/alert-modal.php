



        <?php if(!class_exists('Ninja_Forms')) : ?>
        
        
        <div class="error"><span class="icon-esig-alert"></span><h4>Ninja Forms plugin is not installed. Please install Ninja Forms version 2.0 or greater - <a href="https://wordpress.org/plugins/ninja-forms/">Get it here now</a></h4></div>
        
        
        <?php endif ; 
        
        if(!function_exists("WP_E_Sig")):

        ?>
        
          <div class="error"> <h4>WP E-Signature is not installed. &nbsp; It is required to run the Gravity Forms Signature add-on. &nbsp;Get your business license now  - <a href="http://aprv.me">http://aprv.me</a></h4></div>
        
        <?php 
        endif; 
        
        if(!class_exists('ESIG_SAD_Admin')) :
        
        ?>
        <div class="error"><span class="icon-esig-alert"></span><h4>WP E-Signature <a href="https://www.approveme.me/downloads/stand-alone-documents/" target="_blank">"Stand Alone Documents"</a> Add-on is not installed. Please install WP E-Signature Stand Alone Documents - version 1.2.5 or greater.  </h4></div>
        
        <?php endif; 
        
        if(!class_exists('ESIG_SIF_Admin')) :
        
        ?>
        
        <div class="error"><span class="icon-esig-alert"></span><h4>WP E-signature <a href="https://www.approveme.me/downloads/signer-input-fields" target="_blank">"Custom Fields/Signer Input Fields"</a> is not installed. Please install WP E-Signature Custom Fields/Signer Input Fields Version 1.2.5 or greater.</h4></div>
         
        <?php endif ; ?>

