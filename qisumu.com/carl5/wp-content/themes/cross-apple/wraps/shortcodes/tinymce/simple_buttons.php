<?php 

// Simple Buttons

add_action('admin_init', 'action_admin_init');
function action_admin_init()
{
	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
		if ( in_array(basename($_SERVER['PHP_SELF']), array('post-new.php', 'page-new.php', 'post.php', 'page.php') ) ) {
			add_action('admin_head','add_simple_buttons');
		}
	}
}



function add_simple_buttons()
{
	
	wp_print_scripts( 'quicktags' );
	$output = '<script type="text/javascript">'."\n";
	$output .= ' /* <![CDATA[ */ '."\n";

	$buttons = array();

	//Clear
	$buttons[] = array('name' => 'clear',
									'options' => array('display_name' => 'clear', 'open_tag' => '\n[clear]', 'close_tag' => '', 'key' => ''
					));

	//Box
	$buttons[] = array('name' => 'box',
									'options' => array('display_name' => 'box', 'open_tag' => '\n[box]', 'close_tag' => '[/box]', 'key' => ''
					));

	//Hr
	$buttons[] = array('name' => 'hr',
									'options' => array('display_name' => 'hr', 'open_tag' => '\n[hr top="0" bottom="0"]', 'close_tag' => '', 'key' => ''
					));

	//Br
	$buttons[] = array('name' => 'br',
									'options' => array('display_name' => 'br', 'open_tag' => '\n[br top="0"]', 'close_tag' => '', 'key' => ''
					));

	//Gotop
	$buttons[] = array('name' => 'gotop',
									'options' => array('display_name' => 'gotop', 'open_tag' => '\n[gotop top="0" bottom="0"]', 'close_tag' => '', 'key' => ''
					));


	//For
	for ($i=0; $i <= (count($buttons)-1); $i++) {
		$output .= "edButtons[edButtons.length] = new edButton('ed_{$buttons[$i]['name']}'
			,'{$buttons[$i]['options']['display_name']}'
			,'{$buttons[$i]['options']['open_tag']}'
			,'{$buttons[$i]['options']['close_tag']}'
			,'{$buttons[$i]['options']['key']}'
		); \n";
	}

	$output .= '  /* ]]> */'."\n";
	$output .= '</script>'."\n";
	echo $output;

}

?>