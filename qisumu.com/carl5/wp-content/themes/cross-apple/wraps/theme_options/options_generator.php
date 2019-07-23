<?php
/*
* ----------------------------------------------------------------------------------------------------
* Options Generator
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
if(!class_exists('theme_options_generator'))
{

	class theme_options_generator 
	{
		var $name;
		var $options;
		var $saved_options;

		function theme_options_generator($name, $options) 
		{
		
			$this->name = $name;
			$this->options = $options;
			
			$this->save_options();
			$this->render();

		}

		/* SAVE OPTIONS */
		function save_options() 
		{
			$options = get_option('theme_' .THEME_SLUG . '_' . $this->name);
			
			if (isset($_POST['save_theme_options'])) {
				
				foreach($this->options as $value) {
					if (isset($value['id']) && ! empty($value['id'])) {
						if (isset($_POST[$value['id']])) {
							if ($value['type'] == 'multidropdown') {
								if(empty($_POST[$value['id']])){
									$options[$value['id']] = array();
								}else{
									$options[$value['id']] = array_unique(explode(',', $_POST[$value['id']]));
								}
							} else {
								$options[$value['id']] = $_POST[$value['id']];
							}
						} else {
							$options[$value['id']] = false;
						}
					}
				}

				if ($options != $this->options) {
					update_option('theme_' .THEME_SLUG . '_' . $this->name, $options);
				}
				echo '<div id="message" class="updated fade"><p><strong>Updated Successfully</strong></p></div>';					
			}
			
			$this->saved_options = $options;

		}


		/*render*/
		function render() {
			echo '<div class="wrap theme-options-page">';
			echo '<form method="post" action="">';
			
			foreach($this->options as $option) {
				if (method_exists($this, $option['type'])) {
					$this->$option['type']($option);
				}
			
			}

			echo '<p class="submit"><input type="submit" name="save_theme_options" class="button-primary" value="保存修改" /></p>';
			echo '</form>';
			echo '</div>';
		}


		/*prints the options page title*/
		function title($value) {
			echo '<div class="icon32" id="icon-options-general"><br/></div>';
			echo '<h2>' . $value['name'] . '<span>version ' .THEME_VERSION. '</span></h2>';
			if (isset($value['desc'])) {
				echo '<p>' . $value['desc'] . '</p>';
			}
		}


		/*prints the options page sub title*/
		function sub_title($value) {
			echo '<div class="theme-options-subtitle">';
			echo '<h3>' . $value['name'] . '</h3>';
			if (isset($value['desc'])) {
				echo '<p>' . $value['desc'] . '</p>';
			}
			echo '</div>';
		}


	  /**
	   * begins the group section
	  */
		function head($value) {
			echo '<table class="form-table theme-options-table">';
		}


	 /**
	 * end the group section
	 */
		function foot($value) {
			echo '</table>';
		}


	  /* displays a upload*/
		function upload($value) {
			$size = isset($value['size']) ? $value['size'] : '10';
			$button = isset($value['button']) ? $value['button'] : 'Upload Image';

			echo '<tr valign="top"><th scope="row"><label for="'.$value['id'].'">' . $value['name'] . '</label></th><td>';
			
			if(isset($value['title'])){
				echo '<label for="' . $value['id'] . '">'. $value['title'] .'</label><br />';
			}

			echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" value="';
			if (isset($this->saved_options[$value['id']])) {
				echo stripslashes($this->saved_options[$value['id']]);
			} else {
				echo $value['std'];
			}
			echo '" />';

			echo '<input id="' . $value['id'] . '_button" name="' . $value['id'] . '_button" type="button" value="'.$button.'" class="button-secondary" />';

			if(isset($value['desc'])){
				echo '<p class="description">' . $value['desc'] . '</p>';
			}
			echo '</td></tr>';
		}


	 /**
	 * displays a color input
	 */
		function color($value) {
			$size = isset($value['size']) ? $value['size'] : '10';

			if (isset($this->saved_options[$value['id']])) {
				$val = stripslashes($this->saved_options[$value['id']]);
			} else {
				$val = $value['std'];
			}
			
			echo '<tr valign="top"><th scope="row"><label for="'.$value['id'].'">' . $value['name'] . '</label></th><td>';
			echo '<div class="fixed">';
			echo '<div id="colorSelector_'. $value['id'] .'" class="colorSelector"><div></div></div>';
			echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" class="color-text" value="'. $val .'" />';
			
			if(isset($value['desc'])){
				echo '<span class="description">' . $value['desc'] . '</span>';
			}

			echo '</div>';

			echo '</td></tr>';

			echo '<script type="text/javascript">'."\n";
			echo '//<![CDATA['."\n";
			echo 'jQuery(document).ready(function(){'."\n";
			echo 'jQuery("#colorSelector_'. $value['id'] .'").children("div").css("backgroundColor", "#'. $val .'");'."\n";    
			echo '    jQuery("#colorSelector_'. $value['id'] .'").ColorPicker({'."\n";
			echo '       color: "'. $value['id'] .'",'."\n";
			echo '       onShow: function (colpkr) {'."\n";
			echo '			  jQuery(colpkr).fadeIn(500);'."\n";
			echo '			  return false;'."\n";
			echo '		   },'."\n";
			echo '		   onHide: function (colpkr) {'."\n";
			echo '				jQuery(colpkr).fadeOut(500);'."\n";
			echo '				return false;'."\n";
			echo '			},'."\n";
			echo '			onChange: function (hsb, hex, rgb) {'."\n";
			echo '				jQuery("#colorSelector_'. $value['id'] .'").children("div").css("backgroundColor", "#" + hex);'."\n";
			echo '				jQuery("#colorSelector_'. $value['id'] .'").next("input").attr("value", hex);'."\n";
			echo '			}'."\n";
			echo '		});'."\n";
			echo '	});'."\n";
			echo '//]]>'."\n";
			echo '</script>'."\n";
		}


		/**
		 * displays a text input
		*/
		function text($value) {
			$size = isset($value['size']) ? $value['size'] : '10';
			
			echo '<tr valign="top"><th scope="row"><label for="'.$value['id'].'">' . $value['name'] . '</label></th><td>';
			echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" value="';
			if (isset($this->saved_options[$value['id']])) {
				echo stripslashes($this->saved_options[$value['id']]);
			} else {
				echo $value['std'];
			}
			echo '" />';
			if(isset($value['unit'])){ echo '<em class="unit">' . $value['unit'] . '</em>'; }
			if(isset($value['desc'])){
				echo '<p class="description">' . $value['desc'] . '</p>';
			}
			echo '</td></tr>';
		}


		/* displays a textarea*/
		function textarea($value) {
			$rows = isset($value['rows']) ? $value['rows'] : '5';
			
			echo '<tr valign="top"><th scope="row"><label for="'.$value['id'].'">' . $value['name'] . '</label></th><td>';
			echo '<textarea id="'.$value['id'].'" rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">';
			if (isset($this->saved_options[$value['id']])) {
				echo stripslashes($this->saved_options[$value['id']]);
			} else {
				echo $value['std'];
			}
			echo '</textarea>';
			if(isset($value['desc'])){
				echo '<p class="description">' . $value['desc'] . '</p>';
			}
			echo '</td></tr>';
		}


		/**
	 * displays a select
	 */
		function select($value) {
			if (isset($value['target'])) {
				if (isset($value['options'])) {
					$value['options'] = $value['options'] + $this->get_select_target_options($value['target']);
				} else {
					$value['options'] = $this->get_select_target_options($value['target']);
				}
			}
			echo '<tr valign="top"><th scope="row"><label for="'.$value['id'].'">' . $value['name'] . '</label></th><td>';
			echo '<select name="' . $value['id'] . '" id="' . $value['id'] . '">';
			
			if(isset($value['prompt'])){
				echo '<option value="">'.$value['prompt'].'</option>';
			}
			
			foreach($value['options'] as $key => $option) {
				echo "<option value='" . $key . "'";
				if (isset($this->saved_options[$value['id']])) {
					if (stripslashes($this->saved_options[$value['id']]) == $key) {
						echo ' selected="selected"';
					}
				} else if ($key == $value['std']) {
					echo ' selected="selected"';
				}
				
				echo '>' . $option . '</option>';
			}
			
			echo '</select>';

			if(isset($value['desc'])){
				echo '<p class="description">' . $value['desc'] . '</p>';
			}

			echo '</td></tr>';
		}


		/* displays a radio*/
		function radio($value) {
			
			if (isset($this->saved_options[$value['id']])) {
				$checked_key = $this->saved_options[$value['id']];
			} else {
				$checked_key = $value['std'];
			}
			echo '<tr valign="top"><th scope="row">' . $value['name'] . '</th><td>';
			$i = 0;
			foreach($value['options'] as $key => $option) {
				$i++;
				$checked = '';
				if ($key == $checked_key) {
					$checked = ' checked="checked"';
				}
				
				echo '<input type="radio" id="' . $value['id'] . '_' . $i . '" name="' . $value['id'] . '" value="' . $key . '" ' . $checked . ' />';
				echo '<label for="' . $value['id'] . '_' . $i . '" class="radio">' . $option . '</label><br/>';
			}

			if(isset($value['desc'])){
				echo '<p class="description">' . $value['desc'] . '</p>';
			}
			
			echo '</td></tr>';
		}


		/* displays a checkbox*/
		function checkbox($value) {
			$checked = '';
			if (isset($this->saved_options[$value['id']])) {
				if ($this->saved_options[$value['id']] == true) {
					$checked = 'checked="checked"';
				}
			} elseif ($value['std'] == true) {
				$checked = 'checked="checked"';
			}
			
			echo '<tr valign="top"><th scope="row">' . $value['name'] . '</th><td>';
			echo '<input type="checkbox" name="' . $value['id'] . '" id="' . $value['id'] . '" value="true" ' . $checked . ' />';
			if(isset($value['desc'])){
				echo '<span class="checkbox-description">' . $value['desc'] . '</span>';
			}
			echo '</td></tr>';
		}



		/* select target*/
		function get_select_target_options($type) {
			$options = array();
			switch($type){
				case 'page':
					$entries = get_pages('title_li=&orderby=name');
					foreach($entries as $key => $entry) {
						$options[$entry->ID] = $entry->post_title;
					}
					break;
				case 'category':
					$entries = get_categories('orderby=name&hide_empty=0');
					foreach($entries as $key => $entry) {
						$options[$entry->term_id] = $entry->name;
					}
					break;
				case 'post':
					$entries = get_posts('orderby=title&numberposts=-1&order=ASC');
					foreach($entries as $key => $entry) {
						$options[$entry->ID] = $entry->post_title;
					}
					break;
			}
			
			return $options;
		}


	}//END CLASS

}


?>