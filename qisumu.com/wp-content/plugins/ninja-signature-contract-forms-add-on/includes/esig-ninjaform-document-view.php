<?php
/**
 *
 * @package ESIG_NINJAYFORM_DOCUMENT_VIEW
 * @author  Abu Shoaib <abushoaib73@gmail.com>
 */



if (! class_exists('esig-ninjaform-document-view')) :
class esig_ninjaform_document_view {
    
    
            /**
        	 * Initialize the plugin by loading admin scripts & styles and adding a
        	 * settings page and menu.
        	 * @since     0.1
        	 */
        	final function __construct() {
                        
        	}
        	
        	/**
        	 *  This is add document view which is used to load content in 
        	 *  esig view document page
        	 *  @since 1.1.0
        	 */
        	
        	final function add_document_view()
        	{
        	    
        	    if(!function_exists('WP_E_Sig'))
                                return ;
                    if(!class_exists('NF_Forms'))
                                return ;
                    
                    
                    
        	    
        	    $api = WP_E_Sig();
        	    $assets_dir = ESIGN_ASSETS_DIR_URI;
        	    
                    
        	   $more_option_page = ''; 
        	   
        	    
        	    $more_option_page .= '<div id="esig-ninja-option" class="esign-form-panel" style="display:none;">
        	        
        	        
                	               <div align="center"><img src="' . $assets_dir .'/images/logo.png" width="200px" height="45px" alt="Sign Documents using WP E-Signature" width="100%" style="text-align:center;"></div>
                    			
                                    
                    				<div id="esig-ninja-form-first-step">
                        				
                                        	<h3 class="esign-form-header">'.__('What Are You Trying To Doo?', 'esig-ninja').'</h3>
                                            	
                        				<p id="create_ninja" align="center">';
                                	    
                                	    $more_option_page .=	'
                        			
                        				<p id="select-ninja-form-list" align="center">
                                	    
                        		        <select data-placeholder="Choose a Option..." class="chosen-select" tabindex="2" id="esig-ninja-form-id" name="esig_ninja_form_id">
                        			     <option value="sddelect">'.__('Select a Ninja Form', 'esig-nfds').'</option>';
                                	    
                                	    $nf_forms = new NF_Forms;
                                            $ninja_forms = $nf_forms->get_all();
                                            
                                            
                                	    foreach($ninja_forms as $form_id)
                                	    {
                                                $title = Ninja_Forms()->form( $form_id )->get_setting( 'form_title' );
                                	       
                                	        $more_option_page .=	'<option value="'. $form_id . '">'. $title .'</option>';
                                	    }
                                	    
                                	    $more_option_page .='</select>
                                	    
                        				</p>
                         	  
                                	    </p>
                                	    
                                        <p id="upload_ninja_button" align="center">
                                           <a href="#" id="esig-ninja-create" class="button-primary esig-button-large">'.__('Next Step', 'esig-nfds').'</a>
                                         </p>
                                     
                                    </div>  <!-- Frist step end here  --> ';
                            
                                    
                 $more_option_page .='<!-- Ninja form second step start here -->
                                            <div id="esig-nf-second-step" style="display:none;">
                                            
                                        	<h4 class="esign-form-header">'.__('What ninja form field data would you like to insert?', 'esig-nfds').'</h4>
                                            
                                            <p id="esig-nf-field-option" align="center"> </p>
                                            
                                            
                                             <p id="upload_ninja_button" align="center">
                                           <a href="#" id="esig-ninja-insert" class="button-primary esig-button-large">'.__('Add to Document', 'esig-nfds').'</a>
                                         </p>
                                            
                                            </div>
                                    <!-- Ninja form second step end here -->';           
                                    
                                    
        	    
        	    $more_option_page .= '</div><!--- ninja option end here -->' ;
        	    
        	    
        	    return $more_option_page ; 
        	}
        	
        	
        	final function add_document_view_modal()
        	{
                    
                    
        	    if(! function_exists('WP_E_Sig'))
        	        return ;
        	     
        	    $api = new WP_E_Api();
        	    $assets_dir = ESIGN_ASSETS_DIR_URI;
        	    
        	    $more_option_page = '' ; 
        	    
        	    // first modal button start here 
        	    
        	    // first modal start here 
        	    
        	 $more_option_page .= '   <div style="display:none;" class="modal fade esig-ninja-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        	    <div class="modal-dialog modal-md">
        	    <div class="modal-content">
        	        
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   
        	     <!--  modal content start  here -->
        	       <p>&nbsp;</p> 
        	     <div align="center"><img src="' . $assets_dir .'/images/logo.png" width="200px" height="45px" alt="Sign Documents using WP E-Signature" width="100%" style="text-align:center;"></div>
                 <h2 class="esign-form-header">'.__('What Are You Trying To Do?', 'esig-ninja').'</h2>
                            	    
        	     <p id="create_ninja" align="center">';
                            	    
                            	    $more_option_page .=	'
                    				<form id="esig_create_template" name="esig-view-document" action="" method="post" >
                    				<p id="select-ninja-form-list" align="center">
                            	    
                    		        <select data-placeholder="Choose a Option..." class="chosen-select" width="100%" tabindex="2" id="esig-ninja-form-field" name="esig_ninja_form_id">
                    			<option value="sddelect">'.__('Select Ninja Form Field', 'esig-ninja').'</option>';
                                         $form_id = $_POST['form_id'];
                            	         $all = Ninja_Forms()->form($form_id );
                                            

                                                        foreach($all->fields as $fields)
                                                    {
                                                        
                                                        $more_option_page .=	'<option value=" '.$fields['id'].' ">'. $fields['data']['label'].'</option>';
                                                    }
                                                    
                                            
                                	    
                                	    $more_option_page .='</select>
                            	    
                    				</p>
                            	    </form>
                   </p>
        	       <p>&nbsp;</p>
                           	        
                   <p id="upload_ninja_button" align="center">
                            <a href="#" id="esig-ninja-create" class="button-primary esig-button-large">'.__('Next Step', 'esig-ninja').'</a>
                    </p>
                    <p>&nbsp;</p>             
        	     <!-- modal content end here -->
        	    </div>
        	    </div>
        	    </div>';
        	    
        	    
        	    
        	    return $more_option_page ;
        	    
        	}
	   
    }
endif ; 

