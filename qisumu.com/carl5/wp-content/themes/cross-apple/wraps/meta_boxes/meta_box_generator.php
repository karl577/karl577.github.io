<?php 
/*
* ----------------------------------------------------------------------------------------------------
* META BOXES GENERATOR
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
if(!class_exists('meta_boxes_generator'))
{

	class meta_boxes_generator 
	{
		var $config;
		var $options;
		var $saved_options;

		 /**
		 * Constructor
		 * 
		 * @param string $name
		 * @param array $options
		*/
		function meta_boxes_generator($config, $options) {
			$this->config = $config;
			$this->options = $options;
			
			add_action('admin_menu', array(&$this, 'create_meta_box'));
			add_action('save_post', array(&$this, 'save_meta_box'));
		}

		/*create meta box*/
		function create_meta_box() {
			if (function_exists('add_meta_box')) {
				if (! empty($this->config['callback']) && function_exists($this->config['callback'])) {
					$callback = $this->config['callback'];
				} else {
					$callback = array(&$this, 'render');
				}
				foreach($this->config['pages'] as $page) {
					add_meta_box($this->config['id'], $this->config['title'], $callback, $page, $this->config['context'], $this->config['priority']);
				}
			}
		}

		/*save meta box*/
		function save_meta_box($post_id) {
			if (! isset($_POST[$this->config['id'] . '_noncename'])) {
				return $post_id;
			}
			
			if (! wp_verify_nonce($_POST[$this->config['id'] . '_noncename'], plugin_basename(__FILE__))) {
				return $post_id;
			}
			
			if ('page' == $_POST['post_type']) {
				if (! current_user_can('edit_page', $post_id)) {
					return $post_id;
				}
			} else {
				if (! current_user_can('edit_post', $post_id)) {
					return $post_id;
				}
			}
			
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return $post_id;
			}
			add_post_meta($post_id, 'textfalse', false, true);
			
			foreach($this->options as $option) {
				if (isset($option['id']) && ! empty($option['id'])) {
					
					if (isset($_POST[$option['id']])) {
						if ($option['type'] == 'multidropdown') {
							$value = array_unique(explode(',', $_POST[$option['id']]));
						} else {
							$value = $_POST[$option['id']];
						}
					} else if ($option['type'] == 'toggle') {
						$value = - 1;
					} else {
						$value = false;
					}
					
					if (get_post_meta($post_id, $option['id']) == "") {
						add_post_meta($post_id, $option['id'], $value, true);
					} elseif ($value != get_post_meta($post_id, $option['id'], true)) {
						update_post_meta($post_id, $option['id'], $value);
					} elseif ($value == "") {
						delete_post_meta($post_id, $option['id'], get_post_meta($post_id, $option['id'], true));
					}

				}
			}
		}//END SAVE


		/*Render*/
		function render() {
			global $post;
			
			foreach($this->options as $option) {
				if (method_exists($this, $option['type'])) {
					if (isset($option['id'])) {
						$std = get_post_meta($post->ID, $option['id'], true);
						if ($std != "") {
							$option['std'] = $std;
						}
					}
					echo '<table class="theme-metabox-table">';
					$this->$option['type']($option);
					echo '</table>';
				}
			}
			
			echo '<input type="hidden" name="' . $this->config['id'] . '_noncename" id="' . $this->config['id'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		}


		/**
	     * prints the title and desc
		*/
		function title($value) {

			echo '<div class="theme-metabox-title">';

			if (isset($value['name'])) {
				echo '<h4>' . $value['name'] . '</h4>';
			}
			if (isset($value['desc'])) {
				echo '<span class="theme-metabox-desc">'.$value['desc'].'</span>';
			}

			echo '</div>';
		}


		/**
	    * displays a text input
		*/
		function text($value) {
			$size = isset($value['size']) ? $value['size'] : '10';
			$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';

			echo '<tr valign="top"'.$class.'>';
			echo '<th class="theme-metabox-name"><label for="' . $value['name'] . '">' . $value['name'] . '</label></th>';

			echo '<td>';
			echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" value="' . $value['std'] . '" />';
			if(isset($value['unit'])){ echo '<em class="unit">' . $value['unit'] . '</em>'; }

			if(isset($value['desc']))
			{
				echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
			}
			echo '</td>';
			echo '</tr>';

		}


		/**
	    * displays a textarea
	   */
		function textarea($value) {
			$rows = isset($value['rows']) ? $value['rows'] : '7';
			$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
			
			echo '<tr valign="top"'.$class.'>';
			echo '<th class="theme-metabox-name"><label for="' . $value['name'] . '">' . $value['name'] . '</label></th>';

			echo '<td>';
			echo '<textarea rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">' . $value['std'] . '</textarea>';

			if(isset($value['desc']))
			{
				echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
			}
			echo '</td>';
			echo '</tr>';
		
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

			$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
			
			echo '<tr valign="top"'.$class.'>';

			echo '<th class="theme-metabox-name"><label for="' . $value['name'] . '">' . $value['name'] . '</label></th>';

			echo '<td>';
			echo '<select name="' . $value['id'] . '" id="' . $value['id'] . '">';
			echo '<option value="">Choose one...</option>';
			
			foreach($value['options'] as $key => $option) {
				echo '<option value="' . $key . '"';
				if ($key == $value['std']) {
					echo ' selected="selected"';
				}
				
				echo '>' . $option . '</option>';
			}
			
			echo '</select>';

			if(isset($value['desc']))
			{
				echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
			}

			echo '</td>';

			echo '</tr>';
		
		}


		/**
	    * displays a checkbox
	    */
		function checkbox($value) {

			$checked = '';
			if (isset($this->saved_options[$value['id']])) {
				if ($this->saved_options[$value['id']] == true) {
					$checked = 'checked="checked"';
				}
			} elseif ($value['std'] == true) {
				$checked = 'checked="checked"';
			}

			$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
			
			echo '<tr valign="top"'.$class.'>';

			echo '<th class="theme-metabox-name"><label for="' . $value['name'] . '">' . $value['name'] . '</label></th>';

			echo '<td>';
			echo '<input type="checkbox" name="' . $value['id'] . '" id="' . $value['id'] . '" value="true" ' . $checked . ' />';

			if(isset($value['desc']))
			{
				echo '<span class="theme-metabox-desc">'.$value['desc'].'</span>';
			}

			echo '</td>';

			echo '</tr>';
		
		}



		/* displays a upload*/
		function upload($value) {
			$size = isset($value['size']) ? $value['size'] : '10';
			$button = isset($value['button']) ? $value['button'] : 'Upload Image';
			$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
			
			echo '<tr valign="top"'.$class.'>';

			echo '<th class="theme-metabox-name"><label for="' . $value['name'] . '">' . $value['name'] . '</label></th>';

			echo '<td>';
			echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" value="';
			if (isset($this->saved_options[$value['id']])) {
				echo stripslashes($this->saved_options[$value['id']]);
			} else {
				echo $value['std'];
			}
			echo '" />';

			echo '<input id="' . $value['id'] . '_button" name="' . $value['id'] . '_button" type="button" value="'.$button.'" class="button-secondary" />';

			if(isset($value['desc']))
			{
				echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
			}

			echo '</td>';

			echo '</tr>';


		}


		/**
	   * displays a radio
	   */
		function radio($value) {
			
			$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
			
			echo '<tr valign="top"'.$class.'>';

			echo '<th class="theme-metabox-name"><label for="' . $value['name'] . '">' . $value['name'] . '</label></th>';

			echo '<td>';

			$i = 0;
			foreach($value['options'] as $key => $option) {
				$i++;
				$checked = '';
				if ($key == $value['std']) {
					$checked = ' checked="checked"';
				}
				
				echo '<input type="radio" id="' . $value['id'] . '_' . $i . '" name="' . $value['id'] . '" value="' . $key . '" ' . $checked . ' />';
				echo '<label for="' . $value['id'] . '_' . $i . '">' . $option . '</label><br />';
			}

			if(isset($value['desc']))
			{
				echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
			}

			echo '</td>';

			echo '</tr>';

		
		}


		/**
	    * displays a target options
	    */
		function get_select_target_options($type) {
			$options = array();
			switch($type){
				case 'page':
					$entries = get_pages('title_li=&orderby=name');
					foreach($entries as $key => $entry) {
						$options[$entry->ID] = $entry->post_title;
					}
					break;
				case 'cat':
					$entries = get_categories('title_li=&orderby=name&hide_empty=0');
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
				case 'portfolio':
					$entries = get_posts('post_type=portfolio&orderby=title&numberposts=-1&order=ASC');
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