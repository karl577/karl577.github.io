<?php
//Cloumns shortcode
$dot_shortcodes['columns'] = array(
	'params' => array(),
	'shortcode' => ' {{child_shortcode}} ', // as there is no wrapper shortcode
	'popup_title' => esc_html__('Insert Columns Shortcode', 'HK'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => esc_html__('Column Type', 'HK'),
				'desc' => esc_html__('Select the type, ie width of the column.', 'HK'),
				'options' => array(
					'one_half' => 'One Half (1/2)',
					'one_half_last' => 'One Half Last (1/2 last)',
					'one_third' => 'One Third (1/3)',
					'one_third_last' => 'One Third Last (1/3 last)',
					'two_third' => 'Two Third (2/3)',
					'two_third_last' => 'Two Third Last (2/3 last)',
					'one_fourth' => 'One Fourth (1/4)',
					'one_fourth_last' => 'One Fourth Last (1/4 last)',
					'three_fourth' => 'Three Fourth (3/4)',
					'three_fourth_last' => 'Three Fourth Last (3/4 last)',
					'one_fifth' => 'One Fifth (1/5)',
					'one_fifth_last' => 'One Fifth Last (1/5 last)',
					'two_fifth' => 'Two Fifth (2/5)',
					'two_fifth_last' => 'One Fifth Last (2/5 last)',
					'three_fifth' => 'Three Fifth (3/5)',
					'three_fifth_last' => 'Three Fifth Last (3/5 last)',
					'four_fifth' => 'Four Fifth (4/5)',
					'four_fifth_last' => 'Four Fifth Last (4/5 last)',
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => esc_html__('Column Content', 'HK'),
				'desc' => esc_html__('Add the column content.', 'HK'),
			)
		),
		'shortcode' => '[{{column}}] {{content}} [/{{column}}] ',
		'clone_button' => esc_html__('Add Column', 'HK')
	)
);


// Buttons shortcode
$dot_shortcodes['button'] = array(
	'params' => array(
			'url' => array(
				'std' => '',
				'type' => 'text',
				'label' => esc_html__('Button URL', 'HK'),
				'desc' => esc_html__('Add the button\'s url eg http://example.com', 'HK')
			),
			'style' => array(
				'type' => 'select',
				'label' => esc_html__('Button\'s Style', 'HK'),
				'desc' => esc_html__('Select the button\'s style, ie the buttons colour', 'HK'),
				'options' => array(
					'white' => 'White',
					'grey' => 'Grey',
					'black' => 'Black',
					'yellow' => 'Yellow',
					'orange' => 'Orange',
					'red' => 'Red',
					'green' => 'Green',
					'blue' => 'Blue',
					'coffee' => 'Coffee',
					'purple' => 'Purple'
				)
			),
			'open_type' => array(
				'type' => 'select',
				'label' => esc_html__('Open Type', 'HK'),
				'desc' => esc_html__('Select the open type: in blank or self.', 'HK'),
				'options' => array(
					'self' => 'Self',
					'blank' => 'Blank'
				)
			),
			'content' => array(
				'std' => 'Button Text',
				'type' => 'text',
				'label' => esc_html__('Button\'s Text', 'HK'),
				'desc' => esc_html__('Add the button\'s text', 'HK'),
			)
	),
	'shortcode' => '[button url="{{url}}" style="{{style}}" open_type="{{open_type}}"] {{content}} [/button]',
	'popup_title' => esc_html__('Insert Button Shortcode', 'HK')
);


//Tabs shortcode
$dot_shortcodes['tabs'] = array(
	'params' => array(),
	'shortcode' => '[tabs] {{child_shortcode}}[/tabs]',
	'popup_title' => esc_html__('Insert Tabbed Content Shortcode', 'HK'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'type' => 'text',
				'label' => esc_html__('Tab Title', 'HK'),
				'desc' => esc_html__('Add the title for this tab', 'HK'),
				'std' => ''
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => esc_html__('Tab Content', 'HK'),
				'desc' => esc_html__('Add the tab content.', 'HK'),
			)
		),
		'shortcode' => '[tab title="{{title}}"] {{content}} [/tab] ',
		'clone_button' => esc_html__('Add Tab', 'HK')
	)
);


//Toggle shortcode
$dot_shortcodes['toggle'] = array(
	'params' => array(
		'title' => array(
			'type' => 'text',
			'label' => esc_html__('Toggle Content Title', 'HK'),
			'desc' => esc_html__('Add the title that will go above the toggle content', 'HK'),
			'std' => 'Title'
		),
		'content' => array(
			'std' => 'Content',
			'type' => 'textarea',
			'label' => esc_html__('Toggle Content', 'HK'),
			'desc' => esc_html__('Add the toggle content.', 'HK'),
		)
		
	),
	'shortcode' => '[toggle title="{{title}}"] {{content}} [/toggle]',
	'popup_title' => esc_html__('Insert Toggle Content Shortcode', 'HK')
);


//Icon List shortcode
$dot_shortcodes['icon_list'] = array(
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => esc_html__('Style', 'HK'),
			'desc' => esc_html__('Select the style for list.', 'HK'),
			'options' => array(
				'download' => 'Download',
				'image' => 'Image',
				'settings' => 'Settings',
				'people' => 'People',
				'favicon' => 'Favicon',
				'arrow' => 'Arrow',
				'love' => 'Love',
				'check' => 'Check',
				'light' => 'Light',
				'time' => 'Time'
			)
		),
		'content' => array(
			'std' => 'Content',
			'type' => 'textarea',
			'label' => esc_html__('List Content', 'HK'),
			'desc' => esc_html__('Add the list content with ul, li.', 'HK'),
		)
		
	),
	'no_preview' => true,
	'shortcode' => '[icon_list style="{{style}}"] {{content}} [/icon_list]',
	'popup_title' => esc_html__('Insert Icon List Content Shortcode', 'HK')
);


//Icon Box shortcode
$dot_shortcodes['icon_box'] = array(
	'params' => array(
		'title' => array(
			'type' => 'text',
			'label' => esc_html__('Title', 'HK'),
			'desc' => esc_html__('Add the title for boxes', 'HK'),
			'std' => 'Title'
		),
		'icon' => array(
			'type' => 'select',
			'label' => esc_html__('Icon', 'HK'),
			'desc' => esc_html__('Select icons for the box.', 'HK'),
			'options' => array(
				'icon-calculater.png' => 'Calculater',
				'icon-computer.png' => 'Computer',
				'icon-email.png' => 'Email',
				'icon-music.png' => 'Music',
				'icon-network.png' => 'Network',
				'icon-note.png' => 'Note',
				'icon-people.png' => 'People',
				'icon-printer.png' => 'Printer',
				'icon-settings.png' => 'Settings',
				'icon-time.png' => 'Time'
			)
		),
		'content' => array(
			'std' => 'Content',
			'type' => 'textarea',
			'label' => esc_html__('Content', 'HK'),
			'desc' => esc_html__('Add the content for boxes.', 'HK'),
		)
		
	),
	'no_preview' => true,
	'shortcode' => '[icon_box title="{{title}}" icon="{{icon}}"] {{content}} [/icon_box]',
	'popup_title' => esc_html__('Insert Icon Box Content Shortcode', 'HK')
);


//Message box shortcode
$dot_shortcodes['message_box'] = array(
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => esc_html__('Style', 'HK'),
			'desc' => esc_html__('Select the style for message box.', 'HK'),
			'options' => array(
				'error' => 'Error',
				'info' => 'Info',
				'success' => 'Success',
				'warning' => 'Warning'
			)
		),
		'icon' => array(
				'type' => 'select',
				'label' => esc_html__('Display Icon', 'HK'),
				'desc' => esc_html__('Disable or enable the icon.', 'HK'),
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No'
			)
		),
		'hide' => array(
				'type' => 'select',
				'label' => esc_html__('Hide Link', 'HK'),
				'desc' => esc_html__('You can click the hide link to disable message box.', 'HK'),
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No'
			)
		),
		'width' => array(
			'type' => 'text',
			'label' => esc_html__('Width', 'HK'),
			'desc' => esc_html__('Set the width for message box. The unit is px.', 'HK'),
			'std' => '500'
		),
		'content' => array(
			'std' => 'Content',
			'type' => 'textarea',
			'label' => esc_html__('List Content', 'HK'),
			'desc' => esc_html__('Add the list content with ul, li.', 'HK'),
		)
	),
	'shortcode' => '[message_box style="{{style}}" icon="{{icon}}" hide="{{hide}}" width="{{width}}"] {{content}} [/message_box]',
	'popup_title' => esc_html__('Insert Message Box Content Shortcode', 'HK')
);


//Highlight Text shortcode
$dot_shortcodes['highlight_text'] = array(
	'params' => array(
		'text_color' => array(
			'type' => 'text',
			'label' => esc_html__('Text Color', 'HK'),
			'desc' => esc_html__('Set the text color.', 'HK'),
			'std' => '#FFFFFF'
		),
		'bg_color' => array(
			'type' => 'text',
			'label' => esc_html__('Background Color', 'HK'),
			'desc' => esc_html__('Set the background color.', 'HK'),
			'std' => '#333333'
		),
		'content' => array(
			'std' => 'Content',
			'type' => 'textarea',
			'label' => esc_html__('Content', 'HK'),
			'desc' => esc_html__('Add the content for highlight text.', 'HK'),
		)
	),
	'shortcode' => '[highlight_text text_color="{{text_color}}" bg_color="{{bg_color}}"] {{content}} [/highlight_text]',
	'popup_title' => esc_html__('Insert Highlight Content Shortcode', 'HK')
);



//Style image shortcode
$dot_shortcodes['style_image'] = array(
	'params' => array(
		'width' => array(
			'type' => 'text',
			'label' => esc_html__('Width', 'HK'),
			'desc' => esc_html__('Set the width for the image.', 'HK'),
			'std' => ''
		),
		'height' => array(
			'type' => 'text',
			'label' => esc_html__('Height', 'HK'),
			'desc' => esc_html__('Set the height for the image.', 'HK'),
			'std' => ''
		),
		'image' => array(
			'type' => 'text',
			'label' => esc_html__('Image', 'HK'),
			'desc' => esc_html__('Enter your image file url here.', 'HK'),
			'std' => ''
		),
		'alt' => array(
			'type' => 'text',
			'label' => esc_html__('Alt', 'HK'),
			'desc' => esc_html__('Image description or alternate text.', 'HK'),
			'std' => 'Image description or alternate text.'
		),
		'url' => array(
			'type' => 'text',
			'label' => esc_html__('Url', 'HK'),
			'desc' => esc_html__('URL for the image link.', 'HK'),
			'std' => 'http://yourwebsite.com/'
		),
		'align' => array(
			'type' => 'select',
			'label' => esc_html__('Align', 'HK'),
			'desc' => esc_html__('Set the align for the image.', 'HK'),
			'options' => array(
				'alignleft' => 'AlignLeft',
				'aligncenter' => 'AlignCenter',
				'alignright' => 'AlignRight'
			)
		),
		'border' => array(
			'type' => 'select',
			'label' => esc_html__('Border', 'HK'),
			'desc' => esc_html__('Set the border for the image.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		'lightbox' => array(
			'type' => 'select',
			'label' => esc_html__('Lightbox', 'HK'),
			'desc' => esc_html__('Open link to image in a lightbox.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		'fade' => array(
			'type' => 'select',
			'label' => esc_html__('Fade', 'HK'),
			'desc' => esc_html__('Show the image with fade effect.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		)
	),
	'no_preview' => true,
	'shortcode' => '[style_image width="{{width}}" height="{{height}}" image="{{image}}" align="{{align}}" alt="{{alt}}" url="{{url}}" border="{{border}}" lightbox="{{lightbox}}" fade="{{fade}}"]',
	'popup_title' => esc_html__('Insert Style Image Content Shortcode', 'HK')
);


//Testimonials shortcode
$dot_shortcodes['testimonials'] = array(
	'params' => array(
		'avatar' => array(
			'type' => 'select',
			'label' => esc_html__('Avatar', 'HK'),
			'desc' => esc_html__('Display the avatar for the testimonials.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		'image' => array(
			'type' => 'text',
			'label' => esc_html__('Image', 'HK'),
			'desc' => esc_html__('Enter your avatar image file url here. The image size is 64px*64px.', 'HK'),
			'std' => 'http://yourwebsite.com/avatar.jpg'
		),
		'title' => array(
			'type' => 'text',
			'label' => esc_html__('Title', 'HK'),
			'desc' => esc_html__('Add the title for testimonials.', 'HK'),
			'std' => 'Title'
		),
		'content' => array(
			'type' => 'textarea',
			'label' => esc_html__('Content', 'HK'),
			'desc' => esc_html__('Add the content for highlight text.', 'HK'),
			'std' => 'Content'
		),
		'name' => array(
			'type' => 'text',
			'label' => esc_html__('Name', 'HK'),
			'desc' => esc_html__('Add the name for testimonials.', 'HK'),
			'std' => 'Name'
		),
		'desc' => array(
			'type' => 'text',
			'label' => esc_html__('Description', 'HK'),
			'desc' => esc_html__('Add the description for testimonials.', 'HK'),
			'std' => 'The desc for name.'
		),
	),
	'no_preview' => true,
	'shortcode' => '[testimonials avatar="{{avatar}}" image="{{image}}" title="{{title}}" name="{{name}}" desc="{{desc}}"] {{content}} [/testimonials]',
	'popup_title' => esc_html__('Insert Testimonials Content Shortcode', 'HK')
);


//Portfolio slider shortcode
$dot_shortcodes['portfolio_slider_list'] = array(
	'params' => array(
		'category_slug_name' => array(
			'type' => 'text',
			'label' => esc_html__('Category Slug', 'HK'),
			'desc' => esc_html__('Enter the slug name of portfolio categories here. Separate categories with commas.', 'HK'),
			'std' => ''
		),
		'show_posts' => array(
			'type' => 'text',
			'label' => esc_html__('Show Posts', 'HK'),
			'desc' => esc_html__('Enter the posts number that you want to display.', 'HK'),
			'std' => '8'
		),
		'show_title' => array(
			'type' => 'select',
			'label' => esc_html__('Show Title', 'HK'),
			'desc' => esc_html__('Enable the title for lists.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		'show_desc' => array(
			'type' => 'select',
			'label' => esc_html__('Show Description', 'HK'),
			'desc' => esc_html__('Enable the description for lists.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		'desc_length' => array(
			'type' => 'text',
			'label' => esc_html__('Description Length', 'HK'),
			'desc' => esc_html__('Enter the number for the desc length.', 'HK'),
			'std' => '60'
		),
		'lightbox' => array(
			'type' => 'select',
			'label' => esc_html__('Lightbox', 'HK'),
			'desc' => esc_html__('Open link to image in a lightbox.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		'fade' => array(
			'type' => 'select',
			'label' => esc_html__('Fade', 'HK'),
			'desc' => esc_html__('Show the image with fade effect.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		)
	),
	'no_preview' => true,
	'shortcode' => '[portfolio_slider_list category_slug_name="{{category_slug_name}}" show_posts="{{show_posts}}" show_title="{{show_title}}" show_desc="{{show_desc}}" desc_length="{{desc_length}}" lightbox="{{lightbox}}" fade="{{fade}}"]',
	'popup_title' => esc_html__('Insert a portfolio slider list Shortcode', 'HK')
);


//Portfolio category shortcode
$dot_shortcodes['portfolio_category_list'] = array(
	'params' => array(
		'title' => array(
			'type' => 'text',
			'label' => esc_html__('Title', 'HK'),
			'desc' => esc_html__('Enter the title for this list.', 'HK'),
			'std' => 'Your Title'
		),
		'content' => array(
			'type' => 'textarea',
			'label' => esc_html__('Description', 'HK'),
			'desc' => esc_html__('Enter the description for this list.', 'HK'),
			'std' => 'Your description text'
		),
		'category_slug_name' => array(
			'type' => 'text',
			'label' => esc_html__('Category Slug', 'HK'),
			'desc' => esc_html__('Enter the slug name of portfolio categories here. Separate categories with commas.', 'HK'),
			'std' => ''
		),
		'show_posts' => array(
			'type' => 'text',
			'label' => esc_html__('Show Posts', 'HK'),
			'desc' => esc_html__('Enter the posts number that you want to display.', 'HK'),
			'std' => '8'
		),
		'lightbox' => array(
			'type' => 'select',
			'label' => esc_html__('Lightbox', 'HK'),
			'desc' => esc_html__('Open link to image in a lightbox.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		'fade' => array(
			'type' => 'select',
			'label' => esc_html__('Fade', 'HK'),
			'desc' => esc_html__('Show the image with fade effect.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		)
	),
	'no_preview' => true,
	'shortcode' => '[portfolio_category_list title="{{title}}" category_slug_name="{{category_slug_name}}" show_posts="{{show_posts}}" lightbox="{{lightbox}}" fade="{{fade}}"]{{content}}[/portfolio_category_list]',
	'popup_title' => esc_html__('Insert a portfolio category list Shortcode', 'HK')
);


//Blog slider shortcode
$dot_shortcodes['blog_slider_list'] = array(
	'params' => array(
		'category_slug_name' => array(
			'type' => 'text',
			'label' => esc_html__('Category Slug', 'HK'),
			'desc' => esc_html__('Enter the slug name of blog categories here. Separate categories with commas.', 'HK'),
			'std' => ''
		),
		'show_posts' => array(
			'type' => 'text',
			'label' => esc_html__('Show Posts', 'HK'),
			'desc' => esc_html__('Enter the posts number that you want to display.', 'HK'),
			'std' => '8'
		),
		'show_title' => array(
			'type' => 'select',
			'label' => esc_html__('Show Title', 'HK'),
			'desc' => esc_html__('Enable the title for lists.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		'show_meta' => array(
			'type' => 'select',
			'label' => esc_html__('Show Meta', 'HK'),
			'desc' => esc_html__('Enable the meta for lists.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		'show_desc' => array(
			'type' => 'select',
			'label' => esc_html__('Show Description', 'HK'),
			'desc' => esc_html__('Enable the description for lists.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		'desc_length' => array(
			'type' => 'text',
			'label' => esc_html__('Description Length', 'HK'),
			'desc' => esc_html__('Enter the number for the desc length.', 'HK'),
			'std' => '60'
		),
		'lightbox' => array(
			'type' => 'select',
			'label' => esc_html__('Lightbox', 'HK'),
			'desc' => esc_html__('Open link to image in a lightbox.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		'fade' => array(
			'type' => 'select',
			'label' => esc_html__('Fade', 'HK'),
			'desc' => esc_html__('Show the image with fade effect.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		)
	),
	'no_preview' => true,
	'shortcode' => '[blog_slider_list category_slug_name="{{category_slug_name}}" show_posts="{{show_posts}}" show_title="{{show_title}}" show_desc="{{show_desc}}" desc_length="{{desc_length}}" lightbox="{{lightbox}}" fade="{{fade}}"]',
	'popup_title' => esc_html__('Insert a blog slider list Shortcode', 'HK')
);


//Product slider shortcode
$dot_shortcodes['product_slider_list'] = array(
	'params' => array(
		'category_slug_name' => array(
			'type' => 'text',
			'label' => esc_html__('Category Slug', 'HK'),
			'desc' => esc_html__('Enter the slug name of product categories here. Separate categories with commas.', 'HK'),
			'std' => ''
		),
		'show_posts' => array(
			'type' => 'text',
			'label' => esc_html__('Show Posts', 'HK'),
			'desc' => esc_html__('Enter the posts number that you want to display.', 'HK'),
			'std' => '8'
		),
		'show_title' => array(
			'type' => 'select',
			'label' => esc_html__('Show Title', 'HK'),
			'desc' => esc_html__('Enable the title for lists.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		'show_desc' => array(
			'type' => 'select',
			'label' => esc_html__('Show Description', 'HK'),
			'desc' => esc_html__('Enable the description for lists.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		'desc_length' => array(
			'type' => 'text',
			'label' => esc_html__('Description Length', 'HK'),
			'desc' => esc_html__('Enter the number for the desc length.', 'HK'),
			'std' => '60'
		),
		'show_price' => array(
			'type' => 'select',
			'label' => esc_html__('Show Price', 'HK'),
			'desc' => esc_html__('Enable the price for lists.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		'lightbox' => array(
			'type' => 'select',
			'label' => esc_html__('Lightbox', 'HK'),
			'desc' => esc_html__('Open link to image in a lightbox.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		'fade' => array(
			'type' => 'select',
			'label' => esc_html__('Fade', 'HK'),
			'desc' => esc_html__('Show the image with fade effect.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		)
	),
	'no_preview' => true,
	'shortcode' => '[product_slider_list category_slug_name="{{category_slug_name}}" show_posts="{{show_posts}}" show_title="{{show_title}}" show_desc="{{show_desc}}" desc_length="{{desc_length}}" show_price="{{show_price}}" lightbox="{{lightbox}}" fade="{{fade}}"]',
	'popup_title' => esc_html__('Insert a product slider list Shortcode', 'HK')
);


//Latest news shortcode
$dot_shortcodes['latest_news_list'] = array(
	'params' => array(
		'category_slug_name' => array(
			'type' => 'text',
			'label' => esc_html__('Category Slug', 'HK'),
			'desc' => esc_html__('Enter the slug name of blog categories here. Separate categories with commas. If you want to display all, just leave it blank.', 'HK'),
			'std' => ''
		),
		'show_posts' => array(
			'type' => 'text',
			'label' => esc_html__('Show Posts', 'HK'),
			'desc' => esc_html__('Enter the posts number that you want to display.', 'HK'),
			'std' => '3'
		),
		'lightbox' => array(
			'type' => 'select',
			'label' => esc_html__('Lightbox', 'HK'),
			'desc' => esc_html__('Open link to image in a lightbox.', 'HK'),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		)
	),
	'no_preview' => true,
	'shortcode' => '[latest_news_list category_slug_name="{{category_slug_name}}" show_posts="{{show_posts}}" lightbox="{{lightbox}}"]',
	'popup_title' => esc_html__('Insert a latest news list Shortcode', 'HK')
);


//Pricing Table
$dot_shortcodes['pricing_table'] = array(
	'params' => array(
		'title' => array(
			'type' => 'text',
			'label' => esc_html__('Title', 'HK'),
			'desc' => esc_html__('Enter the title for pricing table.', 'HK'),
			'std' => 'Your Title'
		),
		'content' => array(
			'type' => 'textarea',
			'label' => esc_html__('Description', 'HK'),
			'desc' => esc_html__('Enter the description for this list, add the content with ul, li.', 'HK'),
			'std' => 'Your description text'
		),
		'price' => array(
			'type' => 'text',
			'label' => esc_html__('Price', 'HK'),
			'desc' => esc_html__('Enter the price for your list.', 'HK'),
			'std' => '$168.00'
		),
		'time' => array(
			'type' => 'text',
			'label' => esc_html__('Time', 'HK'),
			'desc' => esc_html__('Enter the time for your list.', 'HK'),
			'std' => '3 month'
		),
		'image' => array(
			'type' => 'text',
			'label' => esc_html__('Image', 'HK'),
			'desc' => esc_html__('Enter your image file url here. It will be display in the right of list.', 'HK'),
			'std' => ''
		)
	),
	'no_preview' => true,
	'shortcode' => '[pricing_table title="{{title}}" price="{{price}}" time="{{time}}" image="{{image}}"]{{content}}[/pricing_table]',
	'popup_title' => esc_html__('Insert a Pricing Table Shortcode', 'HK')
);

?>