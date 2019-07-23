<?php
/**
 * Defines customizer options
 *
 * @package Customizer Library Nikkon
 */

function customizer_library_nikkon_options() {
	
    $site_boxed_color = '#FFFFFF';
	$primary_color = '#13C76D';
	$secondary_color = '#047b40';
    
    $header_bg_color = '#FFFFFF';
    $header_font_color = '#3C3C3C';
	
	$body_font_color = '#3C3C3C';
	$heading_font_color = '#000000';

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;
    
	
	// Site Layout Options
	$section = 'nikkon-site-layout-section';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Layout Options', 'nikkon' ),
		'priority' => '30',
		'description' => __( '', 'nikkon' )
	);
	
    $choices = array(
        'nikkon-site-boxed' => __( 'Boxed Layout', 'nikkon' ),
        'nikkon-site-full-width' => __( 'Full Width Layout', 'nikkon' )
    );
    $options['nikkon-site-layout'] = array(
        'id' => 'nikkon-site-layout',
        'label'   => __( 'Site Layout', 'nikkon' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'nikkon-site-full-width'
    );
    $options['nikkon-page-remove-titlebar'] = array(
        'id' => 'nikkon-page-remove-titlebar',
        'label'   => __( 'Remove Page Titles', 'nikkon' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    
    $options['nikkon-note-layout'] = array(
        'id' => 'nikkon-note-layout',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Make Shop, Archive & Single pages full width<br />- Enable Blocks layout on any/all pages<br />- Page featured image + layout settings', 'nikkon' )
    );
	
	
	// Header Layout Options
	$section = 'nikkon-header-section';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Header Options', 'nikkon' ),
		'priority' => '30',
		'description' => __( '', 'nikkon' )
	);
    $options['nikkon-header-remove-topbar'] = array(
        'id' => 'nikkon-header-remove-topbar',
        'label'   => __( 'Remove Top Bar', 'nikkon' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $choices = array(
        'nikkon-header-layout-one' => __( 'Header Centered', 'nikkon' ),
        'nikkon-header-layout-three' => __( 'Header Standard', 'nikkon' )
    );
    $options['nikkon-header-layout'] = array(
        'id' => 'nikkon-header-layout',
        'label'   => __( 'Header Layout', 'nikkon' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'nikkon-header-layout-one'
    );
	$options['nikkon-header-menu-text'] = array(
		'id' => 'nikkon-header-menu-text',
		'label'   => __( 'Menu Button Text', 'nikkon' ),
		'section' => $section,
		'type'    => 'text',
		'default' => 'menu',
		'description' => __( 'This is the text for the mobile menu button', 'nikkon' )
	);
	$options['nikkon-header-search'] = array(
        'id' => 'nikkon-header-search',
        'label'   => __( 'Remove Search', 'nikkon' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['nikkon-header-remove-no'] = array(
        'id' => 'nikkon-header-remove-no',
        'label'   => __( 'Remove Phone Number', 'nikkon' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['nikkon-note-header'] = array(
        'id' => 'nikkon-note-header',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Extra "Split Nav" header layout<br />- Remove WooCommerce cart<br />- Add WooCommerce cart to header top bar', 'nikkon' )
    );
    
    // Slider Settings
    $section = 'nikkon-slider-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Slider Options', 'nikkon' ),
        'priority' => '35'
    );
    
    $choices = array(
        'nikkon-slider-default' => __( 'Default Slider', 'nikkon' ),
        'nikkon-meta-slider' => __( 'Meta Slider', 'nikkon' ),
        'nikkon-no-slider' => __( 'None', 'nikkon' )
    );
    $options['nikkon-slider-type'] = array(
        'id' => 'nikkon-slider-type',
        'label'   => __( 'Choose a Slider', 'nikkon' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'nikkon-slider-default'
    );
    $options['nikkon-slider-cats'] = array(
        'id' => 'nikkon-slider-cats',
        'label'   => __( 'Slider Categories', 'nikkon' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the ID\'s of the post categories you want to display in the slider. Eg: "13,17,19" (no spaces and only comma\'s)<br /><br />Get the ID at <b>Posts -> Categories</b>.<br /><br />Or <a href="https://kairaweb.com/documentation/setting-up-the-default-slider/" target="_blank"><b>See more instructions here</b></a>', 'nikkon' )
    );
    $options['nikkon-meta-slider-shortcode'] = array(
        'id' => 'nikkon-meta-slider-shortcode',
        'label'   => __( 'Slider Shortcode', 'nikkon' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the shortcode given by the slider', 'nikkon' )
    );
    $options['nikkon-slider-linkto-post'] = array(
        'id' => 'nikkon-slider-linkto-post',
        'label'   => __( 'Link Slide to post', 'nikkon' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['nikkon-slider-remove-title'] = array(
        'id' => 'nikkon-slider-remove-title',
        'label'   => __( 'Remove Slider Title', 'nikkon' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['nikkon-note-slider'] = array(
        'id' => 'nikkon-note-slider',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Set slider to full width<br />- Select slider size (small / medium / large)<br />- Change slider scroll effect<br />- Remove slider Pagination<br />- Stop slider auto-scroll', 'nikkon' )
    );
    

	// Colors
	$section = 'colors';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Colors', 'nikkon' ),
		'priority' => '80'
	);
    
    $options['nikkon-boxed-bg-color'] = array(
        'id' => 'nikkon-boxed-bg-color',
        'label'   => __( 'Site Boxed Background Color', 'nikkon' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $site_boxed_color,
    );

	$options['nikkon-primary-color'] = array(
		'id' => 'nikkon-primary-color',
		'label'   => __( 'Primary Color', 'nikkon' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
	);

	$options['nikkon-secondary-color'] = array(
		'id' => 'nikkon-secondary-color',
		'label'   => __( 'Secondary Color', 'nikkon' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $secondary_color,
	);
    $options['nikkon-note-color'] = array(
        'id' => 'nikkon-note-color',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Premium comes with advanced color settings allowing you to change the colors of the header, top bar, navigation and footers etc', 'nikkon' )
    );
    
    

	// Font Options
	$section = 'nikkon-typography-section';
	$font_choices = customizer_library_get_font_choices();

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Font Options', 'nikkon' ),
		'priority' => '80'
	);

	$options['nikkon-body-font'] = array(
		'id' => 'nikkon-body-font',
		'label'   => __( 'Body Font', 'nikkon' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => 'Open Sans'
	);
	$options['nikkon-body-font-color'] = array(
		'id' => 'nikkon-body-font-color',
		'label'   => __( 'Body Font Color', 'nikkon' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $body_font_color,
	);

	$options['nikkon-heading-font'] = array(
		'id' => 'nikkon-heading-font',
		'label'   => __( 'Heading Font', 'nikkon' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => 'Kaushan Script'
	);
	$options['nikkon-heading-font-color'] = array(
		'id' => 'nikkon-heading-font-color',
		'label'   => __( 'Heading Font Color', 'nikkon' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $heading_font_color,
	);
    
    $options['nikkon-note-font'] = array(
        'id' => 'nikkon-note-font',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Adjust Site Title font and size<br />- Adjust Site Tagline size and spacing', 'nikkon' )
    );
	
	
	// Blog Settings
    $section = 'nikkon-blog-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Blog Options', 'nikkon' ),
        'priority' => '50'
    );
    
    $choices = array(
        'blog-left-layout' => __( 'Left Layout', 'nikkon' ),
        'blog-right-layout' => __( 'Right Layout', 'nikkon' ),
        'blog-alt-layout' => __( 'Alternate Layout', 'nikkon' ),
        'blog-top-layout' => __( 'Top Layout', 'nikkon' ),
        'blog-blocks-layout' => __( 'Blocks Layout', 'nikkon' )
    );
    $options['nikkon-blog-layout'] = array(
        'id' => 'nikkon-blog-layout',
        'label'   => __( 'Blog Posts Layout', 'nikkon' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'blog-left-layout'
    );
    $options['nikkon-blog-title'] = array(
        'id' => 'nikkon-blog-title',
        'label'   => __( 'Blog Page Title', 'nikkon' ),
        'section' => $section,
        'type'    => 'text',
        'default' => 'Blog'
    );
    $options['nikkon-blog-cats'] = array(
        'id' => 'nikkon-blog-cats',
        'label'   => __( 'Exclude Blog Categories', 'nikkon' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the ID\'s of the post categories you\'d like to EXCLUDE from the Blog, enter only the ID\'s with a minus sign (-) before them, separated by a comma (,)<br />Eg: "-13, -17, -19"<br /><br />If you enter the ID\'s without the minus then it\'ll show ONLY posts in those categories.<br /><br />Get the ID at <b>Posts -> Categories</b>.', 'nikkon' )
    );
    $options['nikkon-blog-full-width'] = array(
        'id' => 'nikkon-blog-full-width',
        'label'   => __( 'Make Blog Full Width', 'nikkon' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    
    $options['nikkon-blog-cats-blocks'] = array(
        'id' => 'nikkon-blog-cats-blocks',
        'label'   => __( 'Enable blocks on Archive pages', 'nikkon' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['nikkon-note-blog'] = array(
        'id' => 'nikkon-note-blog',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Set archives & search pages to full width<br />- Single Post featured image + layout settings<br />- Set blog single pages to full width', 'nikkon' )
    );
	
    // Blog Settings
    $section = 'nikkon-blocks-layout-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Blocks Layout Options', 'nikkon' ),
        'priority' => '50'
    );
    
    $choices = array(
        'blog-post-shape-square' => __( 'Square Blocks', 'nikkon' ),
        'blog-post-shape-img' => __( 'Image Shape Blocks', 'nikkon' )
    );
    $options['nikkon-blog-post-shape'] = array(
        'id' => 'nikkon-blog-post-shape',
        'label'   => __( 'Blog Post Shape', 'nikkon' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'blog-post-shape-square'
    );
    $choices = array(
        'blog-style-imgblock' => __( 'Image/Block Style', 'nikkon' ),
        'blog-style-postblock' => __( 'Post/Block Style', 'nikkon' )
    );
    $options['nikkon-blog-blocks-style'] = array(
        'id' => 'nikkon-blog-blocks-style',
        'label'   => __( 'Blocks Styling', 'nikkon' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'blog-style-postblock'
    );
    $options['nikkon-blog-blocks-remove-meta'] = array(
        'id' => 'nikkon-blog-blocks-remove-meta',
        'label'   => __( 'Remove Meta info', 'nikkon' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['nikkon-blog-blocks-remove-content'] = array(
        'id' => 'nikkon-blog-blocks-remove-content',
        'label'   => __( 'Remove Content', 'nikkon' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['nikkon-blog-blocks-remove-tagcats'] = array(
        'id' => 'nikkon-blog-blocks-remove-tagcats',
        'label'   => __( 'Remove Tags & Categories', 'nikkon' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['nikkon-blog-blocks-greyscale'] = array(
        'id' => 'nikkon-blog-blocks-greyscale',
        'label'   => __( 'Images Grey / Color on hover', 'nikkon' ),
        'section' => $section,
        'type'    => 'checkbox',
        'description' => __( 'Select this if you\'d like the block images to show in greyscale and re-color on mouse hover', 'nikkon' ),
        'default' => 0,
    );
    $options['nikkon-note-blog-layout'] = array(
        'id' => 'nikkon-note-blog-layout',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Select Blog layout columns', 'nikkon' )
    );
    
	
	// Footer Settings
    $section = 'nikkon-footer-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Footer Layout Options', 'nikkon' ),
        'priority' => '85'
    );
    
    $choices = array(
        'nikkon-footer-layout-standard' => __( 'Standard Layout', 'nikkon' ),
        'nikkon-footer-layout-social' => __( 'Social Layout', 'nikkon' ),
        'nikkon-footer-layout-none' => __( 'None', 'nikkon' )
    );
    $options['nikkon-footer-layout'] = array(
        'id' => 'nikkon-footer-layout',
        'label'   => __( 'Footer Layout', 'nikkon' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'nikkon-footer-layout-standard'
    );
    
    $options['nikkon-footer-bottombar'] = array(
        'id' => 'nikkon-footer-bottombar',
        'label'   => __( 'Remove the Bottom Bar', 'nikkon' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['nikkon-note-footer'] = array(
        'id' => 'nikkon-note-footer',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Premium has an advanced widget footer layout where you can select the columns and manually adjust them as you want', 'nikkon' )
    );
	
	
	// Site Text Settings
    $section = 'nikkon-website-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Website Text', 'nikkon' ),
        'priority' => '50'
    );
    
    $options['nikkon-website-site-add'] = array(
        'id' => 'nikkon-website-site-add',
        'label'   => __( 'Social Footer Address', 'nikkon' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Cape Town, South Africa', 'nikkon' ),
        'description' => __( 'This is the address in the social footer', 'nikkon' )
    );
    $options['nikkon-website-head-no'] = array(
        'id' => 'nikkon-website-head-no',
        'label'   => __( 'Header Phone Number', 'nikkon' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Call Us: +2782 444 YEAH', 'nikkon' ),
        'description' => __( 'This is the phone number in the header top bar', 'nikkon' )
    );
    
    $options['nikkon-website-error-head'] = array(
        'id' => 'nikkon-website-error-head',
        'label'   => __( '404 Error Page Heading', 'nikkon' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Oops! <span>404</span>', 'nikkon'),
        'description' => __( 'Enter the heading for the 404 Error page', 'nikkon' )
    );
    $options['nikkon-website-error-msg'] = array(
        'id' => 'nikkon-website-error-msg',
        'label'   => __( 'Error 404 Message', 'nikkon' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'It looks like that page does not exist. <br />Return home or try a search', 'nikkon'),
        'description' => __( 'Enter the default text on the 404 error page (Page not found)', 'nikkon' )
    );
    $options['nikkon-website-nosearch-msg'] = array(
        'id' => 'nikkon-website-nosearch-msg',
        'label'   => __( 'No Search Results', 'nikkon' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'nikkon'),
        'description' => __( 'Enter the default text for when no search results are found', 'nikkon' )
    );
    $options['nikkon-note-website'] = array(
        'id' => 'nikkon-note-website',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Change attribution/copyright text to your own', 'nikkon' )
    );
	
	
	// Social Settings
    $section = 'nikkon-social-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Social Links', 'nikkon' ),
        'priority' => '80'
    );
    
    $options['nikkon-social-email'] = array(
        'id' => 'nikkon-social-email',
        'label'   => __( 'Email Address', 'nikkon' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['nikkon-social-skype'] = array(
        'id' => 'nikkon-social-skype',
        'label'   => __( 'Skype Name', 'nikkon' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['nikkon-social-facebook'] = array(
        'id' => 'nikkon-social-facebook',
        'label'   => __( 'Facebook', 'nikkon' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['nikkon-social-twitter'] = array(
        'id' => 'nikkon-social-twitter',
        'label'   => __( 'Twitter', 'nikkon' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['nikkon-social-linkedin'] = array(
        'id' => 'nikkon-social-linkedin',
        'label'   => __( 'LinkedIn', 'nikkon' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['nikkon-social-tumblr'] = array(
        'id' => 'nikkon-social-tumblr',
        'label'   => __( 'Tumblr', 'nikkon' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['nikkon-social-flickr'] = array(
        'id' => 'nikkon-social-flickr',
        'label'   => __( 'Flickr', 'nikkon' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['nikkon-note-social'] = array(
        'id' => 'nikkon-note-social',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Premium comes with a bunch of more social profiles to link to', 'nikkon' )
    );
	

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();

}
add_action( 'init', 'customizer_library_nikkon_options' );
