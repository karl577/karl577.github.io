<?php

/**
 *
 * @package ESIG_NFDS_Admin
 * @author  Abu Shoaib <abushoaib73@gmail.com>
 */
if (!class_exists('ESIG_NFDS_Admin')) :

    class ESIG_NFDS_Admin {

        /**
         * Instance of this class.
         * @since    1.0.1
         * @var      object
         */
        protected static $instance = null;
        public $name;

        /**
         * Slug of the plugin screen.
         * @since    1.0.1
         * @var      string
         */
        protected $plugin_screen_hook_suffix = null;

        /**
         * Initialize the plugin by loading admin scripts & styles and adding a
         * settings page and menu.
         * @since     0.1
         */
        public function __construct() {

            /*
             * Call $plugin_slug from public plugin class.
             */
            $plugin = ESIG_NFDS::get_instance();
            $this->plugin_slug = $plugin->get_plugin_slug();
            global $wpdb;
            $this->name = __('Esignature', 'esig-nfds');
            $this->current_tab = empty($tab) ? 1 : $tab;
            $this->document_view = new esig_ninjaform_document_view();
            // Add an action link pointing to the options page.
            $plugin_basename = plugin_basename(plugin_dir_path(__FILE__) . $this->plugin_slug . '.php');
            add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));

            add_filter('nf_notification_types', array($this, 'register_action_type'));
            add_filter('esig_sif_buttons_filter', array($this, 'add_sif_ninja_buttons'), 10, 1);

            add_filter('esig_admin_more_document_contents', array($this, 'document_add_data'), 10, 1);
            // add_filter('esig_admin_more_document_contents', array($this, 'show_ninja_actions'), 10, 1);
            add_action('wp_ajax_esig_ninja_form_fields', array($this, 'esig_ninja_form_fields'));
            add_action('wp_ajax_nopriv_esig_ninja_form_fields', array($this, 'esig_ninja_form_fields'));
            
            // Ninja core checking fallback. 
            add_action('admin_notices', array($this, 'esig_ninja_contract_requirement'));
            
             add_filter('esig_notices_display', array($this, 'esig_ninja_contract_requirement_modal'),10,1);
             
            add_action('admin_init', array($this, 'esig_almost_done_ninja_settings'));
           // add_action('esig_send_daily_reminders', array($this, 'esig_send_reminder_email'));

            // rgistering shortcode 
            add_shortcode('esigninja', array($this, 'render_shortcode_esigninja'));
            // adding action
            add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'), 999);
            add_action('admin_menu', array($this, 'esig_ninja_adminmenu'));
             add_filter('show_sad_invite_link', array($this, 'show_sad_invite_link'),10, 3);
        }
        
         final function show_sad_invite_link($show,$doc,$page_id){
             if(!isset($doc->document_content)){
                return $show ; 
            }
            $document_content = $doc->document_content;
            $document_raw = WP_E_Sig()->signature->decrypt(ENCRYPTION_KEY, $document_content);

            if (has_shortcode($document_raw, 'esigninja')) {
              $show=false ; 
              return $show;
            }
            return $show;
        }

        public function esig_send_reminder_email() {


            if (!function_exists('WP_E_Sig'))
                return;

            $api = new WP_E_Api();


            // get document list by status awaiting 
            $docs = $api->document->fetchAllOnStatus('awaiting');


            // loops starts 
            foreach ($docs as $doc) {
                
            }
        }

        public function enqueue_admin_styles() {
            $screen = get_current_screen();
           
            $admin_screens = array(
                
                'admin_page_esign-ninja-about',
                'forms_page_esign-ninja-about',
                'e-signature_page_esign-ninja-about'
                
            );

            if (in_array($screen->id, $admin_screens)) {

                wp_enqueue_style($this->plugin_slug . '-admin-styles', plugins_url('assets/css/esig-ninja-about.css', __FILE__), array());
            }
        }

        public function esig_ninja_adminmenu() {

            add_submenu_page('ninja-forms', __('E-signature', 'esig'), __('E-signature', 'esig'), 'read', 'esign-ninja-about', array(&$this, 'ninja_about_page'));
            if (!function_exists('WP_E_Sig')) {

                if (empty($GLOBALS['admin_page_hooks']['esign'])) {
                    add_menu_page('E-Signature', 'E-Signature', 'read', "esign", array(&$this, 'esig_core_page'), plugins_url('assets/images/pen_icon.svg', __FILE__));
                }

                add_submenu_page("esign", "Ninja E-signature", "Ninja E-signature", 'read', "esign-ninja-about", array(&$this, 'ninja_about_page'));


                return;
            }
        }

        public function ninja_about_page() {

            include_once(dirname(__FILE__) . "/views/ninja-esign-about.php");
        }
        
        
        /**
         *  Showing fallback modal for rquirement to run this plugins. 
         * 
         */
        final function esig_ninja_contract_requirement_modal($msg) {
            if (class_exists('Ninja_Forms') && function_exists("WP_E_Sig") && class_exists('ESIG_SAD_Admin') && class_exists('ESIG_SIF_Admin'))
                return;

                ob_start();
                include_once "views/alert-modal.php";
                $msg .= ob_get_contents();
		ob_end_clean();
                
                return $msg;
        }
        
        final function esig_ninja_contract_requirement() {
            if (class_exists('Ninja_Forms') && function_exists("WP_E_Sig") && class_exists('ESIG_SAD_Admin') && class_exists('ESIG_SIF_Admin'))
                return;

                
                include_once "views/alert-modal.php";
                
        }
        
        final function render_shortcode_esigninja($atts) {

            extract(shortcode_atts(array(
                'formid' => '',
                'field_id' => '', //foo is a default value
                            ), $atts, 'esigninja'));

            if (!function_exists('WP_E_Sig'))
                return;


            // creating esignature api 
            $api = new WP_E_Api();

            $csum = isset($_GET['csum']) ? sanitize_text_field($_GET['csum']) : null;

            if (empty($csum)) {
                $document_id = get_option('esig_global_document_id');
            } else {
                $document_id = $api->document->document_id_by_csum($csum);
            }
            //echo $field_id;
            $notification_id = $api->meta->get($document_id, 'esig_ninja_notification_id');

            $form_id = $api->meta->get($document_id, 'esig_ninja_form_id');

            $post_id = $api->meta->get($document_id, 'esig_ninja_entry_id');

            if (!$notification_id) {
                return;
            }

            $underline_data = Ninja_Forms()->notification($notification_id)->get_setting('underline_data');

            $key = "_field_" . abs($field_id);

            $result = get_post_meta($post_id, $key, true); //

            if ($underline_data == "underline") {
                $value = '<u>' . $result . '</u>';
            } else {
                $value = $result;
            }

            return $value;
        }

        final function esig_almost_done_ninja_settings() {

            if (!function_exists('WP_E_Sig'))
                return;

            // getting sad document id 
            $sad_document_id = isset($_GET['doc_preview_id']) ? $_GET['doc_preview_id'] : null;


            if (!$sad_document_id) {
                return;
            }
            // creating esignature api here 
            $api = new WP_E_Api();

            $documents = $api->document->getDocument($sad_document_id);


            $document_content = $documents->document_content;

            $document_raw = $api->signature->decrypt(ENCRYPTION_KEY, $document_content);



            if (has_shortcode($document_raw, 'esigninja')) {


                preg_match_all('/' . get_shortcode_regex() . '/s', $document_raw, $matches, PREG_SET_ORDER);

                //$ninja_shortcode = $matches[0][0];
                
                $ninja_shortcode ='';
                
                foreach($matches as $match){
                   if(in_array('esigninja', $match)){
                       $ninja_shortcode = $match[0];
                   }
                }
                
                $atts = shortcode_parse_atts($ninja_shortcode);

                extract(shortcode_atts(array(
                    'formid' => '',
                    'field_id' => '', //foo is a default value
                                ), $atts, 'esigninja'));

                //admin.php?page=gf_edit_forms&view=settings&subview=esig-gf&id=2

                $data = array("form_id" => $formid);


                $display_notice = dirname(__FILE__) . '/views/alert-almost-done.php';
                $api->view->renderPartial('', $data, true, '', $display_notice);
            }
        }

        public function show_ninja_actions($more_option_page) {

            $more_option_page .= $this->document_view->add_document_view_modal();
            return $more_option_page;
        }

        public function esig_ninja_form_fields() {

            if (!function_exists('WP_E_Sig'))
                return;

            $api = new WP_E_Api();


            $html = '';

            $html .='<select name="esig_nf_field_id" class="chosen-select" style="width:250px;">';
            $form_id = $_POST['form_id'];


            //$ninja_forms = Ninja_Forms()->form( $form_id );


            $all = Ninja_Forms()->form($form_id);

            foreach ($all->fields as $fields) {
                
                if($fields['data']['label'] == 'Submit'){
                    
                    continue;
                }
                
                
                //$field_name = $fields['data']['label'];
                $html .= '<option value=" ' . $fields['id'] . ' ">' . $fields['data']['label'] . '</option>';
            }



            $html .='</select><input type="hidden" name="esig_nf_form_id" value="' . $form_id . '">';

            echo $html;

            die();
        }

        public function document_add_data($more_contents) {

            $api = new WP_E_Api();

            $more_contents .=$this->document_view->add_document_view();


            return $more_contents;
        }

        public function add_sif_ninja_buttons($sif_menu) {

            $esig_type = isset($_GET['esig_type']) ? $_GET['esig_type'] : null;

            $document_id = isset($_GET['document_id']) ? $_GET['document_id'] : null;

            if (empty($esig_type) && !empty($document_id)) {

                $api = new WP_E_Api();

                $document_type = $api->document->getDocumenttype($document_id);
                if ($document_type == "stand_alone") {
                    $esig_type = "sad";
                }
            }

            if ($esig_type != 'sad') {
                return $sif_menu;
            }

            $sif_menu .=' {text: "Ninja Form Data",value: "ninja", onclick: function () { tb_show( "+ Ninja form option", "#TB_inline?width=450&height=300&inlineId=esig-ninja-option");}},';
            //$plugins['esig_sif'] = plugin_dir_url(__FILE__) . 'assets/js/esig-ninja-sif-buttons.js';

            return $sif_menu;
            
        }

        public function register_action_type($types) {
            $types[$this->name] = $this;
            return (array) $types;
        }

        public function enqueue_admin_scripts() {



            $screen = get_current_screen();
            $admin_screens = array(
                'admin_page_esign-add-document',
                'admin_page_esign-edit-document',
                'e-signature_page_esign-view-document',
            );

            // Add/Edit Document scripts
            if (in_array($screen->id, $admin_screens)) {

                // wp_enqueue_style( $this->plugin_slug . '-admin-style', plugins_url( 'assets/css/esig_template.css', __FILE__ ));
                wp_enqueue_script('jquery');
                wp_enqueue_script($this->plugin_slug . '-admin-script', plugins_url('assets/js/esig-add-ninja.js', __FILE__), array('jquery', 'jquery-ui-dialog'), ESIG_NFDS::VERSION, true);
            }
            if ($screen->id != "plugins") {
                wp_enqueue_script($this->plugin_slug . '-admin-script', plugins_url('assets/js/esig-ninja-control.js', __FILE__), array('jquery', 'jquery-ui-dialog'), ESIG_NFDS::VERSION, true);
            }


            if ($screen->id == "toplevel_page_ninja-forms") {

                wp_enqueue_script($this->plugin_slug . '-ninja-validation', plugins_url('assets/js/esig-ninja-form-validation.js', __FILE__), array('jquery', 'jquery-ui-dialog'), ESIG_NFDS::VERSION, true);

                wp_localize_script($this->plugin_slug . '-ninja-validation', 'esig_ninja_L10n', array(
                    'valid_msg' => __("This field is required", "esig-nfds"),
                ));
            }
        }

        /**
         * Edit Screen
         *
         * @param $id
         * @return void
         */
        public function edit_screen($id = '') {
            //$settings['example'] = Ninja_Forms()->notification( $id )->get_setting( 'example' );



            $signer_name = Ninja_Forms()->notification($id)->get_setting('signer_name');
            $signer_email_address = Ninja_Forms()->notification($id)->get_setting('signer_email_address');

            $signing_logic = Ninja_Forms()->notification($id)->get_setting('signing_logic');
            $select_sad = Ninja_Forms()->notification($id)->get_setting('select_sad');
            $underline_data = Ninja_Forms()->notification($id)->get_setting('underline_data');

            $signing_reminder_email = Ninja_Forms()->notification($id)->get_setting('signing_reminder_email');

            $reminder_email = Ninja_Forms()->notification($id)->get_setting('reminder_email');
            $first_reminder_send = Ninja_Forms()->notification($id)->get_setting('first_reminder_send');
            $expire_reminder = Ninja_Forms()->notification($id)->get_setting('expire_reminder');





            include plugin_dir_path(__FILE__) . '/views/esig-ninja-action-view.php';
        }

        public function save_admin() {
            
        }

        /**
         * Process
         *
         * @param string $id
         * @return void
         */
        public function process($id = '') {

            global $ninja_forms_processing;
            
            $api = new WP_E_Api();

            $sad = new esig_sad_document();


            $form_id = $ninja_forms_processing->get_form_ID();

            $post_id = $ninja_forms_processing->get_form_setting('sub_id');

            $signing_logic = Ninja_Forms()->notification($id)->get_setting('signing_logic');

            $sad_page_id = Ninja_Forms()->notification($id)->get_setting('select_sad');

            $document_id = $sad->get_sad_id($sad_page_id);

            $signer_name_field = $this->get_ninja_field_id(Ninja_Forms()->notification($id)->get_setting('signer_name'));

            $signer_email_address_field = $this->get_ninja_field_id(Ninja_Forms()->notification($id)->get_setting('signer_email_address'));


            $signer_email = Ninja_Forms()->sub($post_id)->get_field($signer_email_address_field);
            $signer_name = Ninja_Forms()->sub($post_id)->get_field($signer_name_field);


            $signing_reminder_email = Ninja_Forms()->notification($id)->get_setting('signing_reminder_email');

            if ($signing_reminder_email == '0') {
                // saving remidner meta here 
                $reminder_email = Ninja_Forms()->notification($id)->get_setting('reminder_email');
                $first_reminder_send = Ninja_Forms()->notification($id)->get_setting('first_reminder_send');
                $expire_reminder = Ninja_Forms()->notification($id)->get_setting('expire_reminder');
                $esig_ninja_reminders_settings = array(
                    "esig_reminder_for" => $reminder_email,
                    "esig_reminder_repeat" => $first_reminder_send,
                    "esig_reminder_expire" => $expire_reminder,
                );

                $api->meta->add($document_id, "esig_reminder_settings_", json_encode($esig_ninja_reminders_settings));
                $api->meta->add($document_id, "esig_reminder_send_", "1");
            }
            // if not email address 
            if (!is_email($signer_email)) {
                return;
            }

            // sending email invitation / redirecting .
            $result = $this->esig_invite_document($document_id, $signer_email, $signer_name, $form_id, $post_id, $signing_logic, $id);
        }

        /*         * *
         *  Return a numeric field id 
         *   If field written like this field_1 
         */

        public function get_ninja_field_id($field_id) {

            $fields = explode("_", $field_id);
            if ( ! isset($fields[1])) {
               $fields[1] = null;
             }
            return $fields[1];
        }

        public function esig_invite_document($old_doc_id, $siner_email, $signer_name, $form_id, $post_id, $signing_logic, $notification_id) {

            if (!function_exists('WP_E_Sig'))
                return;

            $esig = WP_E_Sig();
            $api = new WP_E_Api();
            global $wpdb;



            /* make it a basic document and then send to sign */
            $old_doc = $api->document->getDocument($old_doc_id);

            $doc_table = $wpdb->prefix . 'esign_documents';


            // Copy the document
            $doc_id = $api->document->copy($old_doc_id);

            // settings meta key for ninja form field 
            $api->meta->add($doc_id, 'esig_ninja_notification_id', $notification_id);

            $api->meta->add($doc_id, 'esig_ninja_form_id', $form_id);

            $api->meta->add($doc_id, 'esig_ninja_entry_id', $post_id);

            // set document timezone
            $esig_common = new WP_E_Common();
            $esig_common->set_document_timezone($doc_id);
            // Create the user
            $recipient = array(
                "user_email" => $siner_email,
                "first_name" => $signer_name,
                "document_id" => $doc_id,
                "wp_user_id" => '',
                "user_title" => '',
                "last_name" => ''
            );

            $recipient['id'] = $api->user->insert($recipient);

            $document_type = 'normal';
            $document_status = 'awaiting';
            $doc_title = $old_doc->document_title . ' - ' . $signer_name;
            // Update the doc title
            $affected = $wpdb->query($wpdb->prepare(
                            "UPDATE " . $doc_table . " SET document_title = '%s',document_type ='%s' , document_status='%s' where document_id = %d", $doc_title, $document_type, $document_status, $doc_id));

            $doc = $api->document->getDocument($doc_id);

            // trigger an action after document save .
            do_action('esig_sad_document_invite_send', array(
                'document' => $doc,
                'old_doc_id' => $old_doc_id,
            ));


            // Get Owner
            $owner = $api->user->getUserByID($doc->user_id);


            // Create the invitation?
            $invitation = array(
                "recipient_id" => $recipient['id'],
                "recipient_email" => $recipient['user_email'],
                "recipient_name" => $recipient['first_name'],
                "document_id" => $doc_id,
                "document_title" => $doc->document_title,
                "sender_name" => $owner->first_name . ' ' . $owner->last_name,
                "sender_email" => $owner->user_email,
                "sender_id" => 'stand alone',
                "document_checksum" => $doc->document_checksum,
                "sad_doc_id" => $old_doc_id,
            );

            $invite_controller = new WP_E_invitationsController();
            if ($signing_logic == "email") {

                if ($invite_controller->saveThenSend($invitation, $doc)) {

                    return true;
                }
            } elseif ($signing_logic == "redirect") {
                // if used redirect then other plugin can not work properly. 
                $esign_default_page = $api->setting->get_generic('default_display_page');
                $invitation_id = $invite_controller->save($invitation);
                $invite_hash = $api->invite->getInviteHash($invitation_id);
                $invitationURL = add_query_arg(array('invite' => $invite_hash, 'csum' => $doc->document_checksum), get_permalink($esign_default_page));
                wp_redirect($invitationURL);
                exit;
            }
        }

        /**
         * Return an instance of this class.
         * @since     0.1
         * @return    object    A single instance of this class.
         */
        public static function get_instance() {

            // If the single instance hasn't been set, set it now.
            if (null == self::$instance) {
                self::$instance = new self;
            }

            return self::$instance;
        }

    }

    

    
endif;

