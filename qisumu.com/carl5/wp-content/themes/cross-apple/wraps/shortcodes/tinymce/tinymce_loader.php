<?php

/*-----------------------------------------------------------------------------------*/
/*	Paths Defenitions
/*-----------------------------------------------------------------------------------*/

define('TINYMCE_PATH', WRAPS_DIR . '/shortcodes/tinymce');
define('TINYMCE_URI', WRAPS_URI . '/shortcodes/tinymce');


/*-----------------------------------------------------------------------------------*/
/*	Load Simple Buttons
/*-----------------------------------------------------------------------------------*/
require_once( TINYMCE_PATH . '/simple_buttons.php' );

/*-----------------------------------------------------------------------------------*/
/*	Load TinyMCE dialog
/*-----------------------------------------------------------------------------------*/

require_once( TINYMCE_PATH . '/tinymce_class.php' );		// TinyMCE wrapper class
new dot_tinymce();											// do the magic

?>