<?php
/**
 * Replace With Theme Name Customizer
 *
 * Contains methods for customizing the theme customization screen.
 *
 * @link 		https://codex.wordpress.org/Theme_Customization_API
 * @since 		1.0.0
 * @package  	DocBlock
 */

// Register panels, sections, and controls
add_action( 'customize_register', 'edge_merger_register_panels' );
add_action( 'customize_register', 'edge_merger_register_sections' );
add_action( 'customize_register', 'edge_merger_register_fields' );

// Output custom CSS to live site
add_action( 'wp_head', 'edge_merger_header_output' );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init', 'edge_merger_live_preview' );

// Enqueue scripts for the customizer controls
add_action( 'customize_controls_enqueue_scripts', 'edge_merger_control_scripts' );

/**
 * Registers custom panels for the Customizer
 *
 * @see			add_action( 'customize_register', $func )
 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * @since 		1.0.0
 *
 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
 */
function edge_merger_register_panels( $wp_customize ) {

	// Theme Options Panel
	$wp_customize->add_panel( 'theme_options',
		array(
			'capability'  		=> 'edit_theme_options',
			'description'  		=> esc_html__( 'Options for Replace With Theme Name', 'edge-merger' ),
			'priority'  		=> 10,
			'theme_supports'  	=> '',
			'title'  			=> esc_html__( 'Theme Options', 'edge-merger' ),
		)
	);

	/*
	// Theme Options Panel
	$wp_customize->add_panel( 'theme_options',
		array(
			'capability'  		=> 'edit_theme_options',
			'description'  		=> esc_html__( 'Options for Replace With Theme Name', 'edge-merger' ),
			'priority'  		=> 10,
			'theme_supports'  	=> '',
			'title'  			=> esc_html__( 'Theme Options', 'edge-merger' ),
		)
	);
	*/

} // edge_merger_register_panels()

/**
 * Registers custom sections for the Customizer
 *
 * Existing sections:
 *
 * Slug 				Priority 		Title
 *
 * title_tagline 		20 				Site Identity
 * colors 				40				Colors
 * header_image 		60				Header Image
 * background_image 	80				Background Image
 * nav 					100 			Navigation
 * widgets 				110 			Widgets
 * static_front_page 	120 			Static Front Page
 * default 				160 			all others
 *
 * @see			add_action( 'customize_register', $func )
 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * @since 		1.0.0
 *
 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
 */
function edge_merger_register_sections( $wp_customize ) {

	// Arrows
	$wp_customize->add_section( 'home',
		array(
			'capability' 	=> 'edit_theme_options',
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'panel' 		=> 'theme_options',
			'priority' 		=> 10,
			'title' 		=> esc_html__( 'Homepage', 'edge-merger' )
		)
	);

	/*
	// New Section
	$wp_customize->add_section( 'new_section',
		array(
			'capability' 	=> 'edit_theme_options',
			'description' 	=> esc_html__( 'New Customizer Section', 'edge-merger' ),
			'panel' 		=> 'theme_options',
			'priority' 		=> 10,
			'title' 		=> esc_html__( 'New Section', 'edge-merger' )
		)
	);
	*/

} // edge_merger_register_sections()

/**
 * Registers controls/fields for the Customizer
 *
 * Note: To enable instant preview, we have to actually write a bit of custom
 * javascript. See live_preview() for more.
 *
 * Note: To use active_callbacks, don't add these to the selecting control, it apepars these conflict:
 * 		'transport' => 'postMessage'
 * 		$wp_customize->get_setting( 'field_name' )->transport = 'postMessage';
 *
 * @see			add_action( 'customize_register', $func )
 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * @since 		1.0.0
 *
 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
 */
function edge_merger_register_fields( $wp_customize ) {

	// Enable live preview JS for default fields
	$wp_customize->get_setting( 'blogname' )->transport 		= 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport 	= 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



	// Site Identity Section Fields

	// Google Tag Manager Field
	$wp_customize->add_setting(
		'tag_manager',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'tag_manager',
		array(
			'description' 	=> esc_html__( 'Paste in the Google Tag Manager code here.', 'edge-merger' ),
			'label' => esc_html__( 'Google Tag Manager', 'edge-merger' ),
			'priority' => 90,
			'section' => 'title_tagline',
			'settings' => 'tag_manager',
			'type' => 'textarea'
		)
	);
	$wp_customize->get_setting( 'tag_manager' )->transport = 'postMessage';




	// Textarea Field
	$wp_customize->add_setting(
		'bold_content',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'bold_content',
		array(
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' => esc_html__( 'Bold Content', 'edge-merger' ),
			'priority' => 10,
			'section' => 'home',
			'settings' => 'bold_content',
			'type' => 'textarea'
		)
	);
	$wp_customize->get_setting( 'bold_content' )->transport = 'postMessage';






	// Text Field
	$wp_customize->add_setting(
		'arrow1_link_text',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'arrow1_link_text',
		array(
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label'  	=> esc_html__( 'Arrow 1 Text', 'edge-merger' ),
			'priority' => 10,
			'section'  	=> 'home',
			'settings' 	=> 'arrow1_link_text',
			'type' 		=> 'text'
		)
	);
	$wp_customize->get_setting( 'arrow1_link_text' )->transport = 'postMessage';


	// URL Field
	$wp_customize->add_setting(
		'arrow1_url',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'arrow1_url',
		array(
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' => esc_html__( 'Arrow 1 URL', 'edge-merger' ),
			'priority' => 10,
			'section' => 'home',
			'settings' => 'arrow1_url',
			'type' => 'url'
		)
	);
	$wp_customize->get_setting( 'arrow1_url' )->transport = 'postMessage';





	// Text Field
	$wp_customize->add_setting(
		'arrow2_link_text',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'arrow2_link_text',
		array(
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label'  	=> esc_html__( 'Arrow 2 Text', 'edge-merger' ),
			'priority' => 10,
			'section'  	=> 'home',
			'settings' 	=> 'arrow2_link_text',
			'type' 		=> 'text'
		)
	);
	$wp_customize->get_setting( 'arrow2_link_text' )->transport = 'postMessage';


	// URL Field
	$wp_customize->add_setting(
		'arrow2_url',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'arrow2_url',
		array(
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' => esc_html__( 'Arrow 2 URL', 'edge-merger' ),
			'priority' => 10,
			'section' => 'home',
			'settings' => 'arrow2_url',
			'type' => 'url'
		)
	);
	$wp_customize->get_setting( 'arrow2_url' )->transport = 'postMessage';








	/*
	// Fields & Controls

	// Text Field
	$wp_customize->add_setting(
		'text_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'text_field',
		array(
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label'  	=> esc_html__( 'Text Field', 'edge-merger' ),
			'priority' => 10,
			'section'  	=> 'new_section',
			'settings' 	=> 'text_field',
			'type' 		=> 'text'
		)
	);
	$wp_customize->get_setting( 'text_field' )->transport = 'postMessage';



	// URL Field
	$wp_customize->add_setting(
		'url_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'url_field',
		array(
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' => esc_html__( 'URL Field', 'edge-merger' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'url_field',
			'type' => 'url'
		)
	);
	$wp_customize->get_setting( 'url_field' )->transport = 'postMessage';



	// Email Field
	$wp_customize->add_setting(
		'email_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'email_field',
		array(
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' => esc_html__( 'Email Field', 'edge-merger' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'email_field',
			'type' => 'email'
		)
	);
	$wp_customize->get_setting( 'email_field' )->transport = 'postMessage';

	// Date Field
	$wp_customize->add_setting(
		'date_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'date_field',
		array(
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' => esc_html__( 'Date Field', 'edge-merger' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'date_field',
			'type' => 'date'
		)
	);
	$wp_customize->get_setting( 'date_field' )->transport = 'postMessage';


	// Checkbox Field
	$wp_customize->add_setting(
		'checkbox_field',
		array(
			'default'  	=> 'true',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'checkbox_field',
		array(
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' => esc_html__( 'Checkbox Field', 'edge-merger' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'checkbox_field',
			'type' => 'checkbox'
		)
	);
	$wp_customize->get_setting( 'checkbox_field' )->transport = 'postMessage';




	// Password Field
	$wp_customize->add_setting(
		'password_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'password_field',
		array(
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' => esc_html__( 'Password Field', 'edge-merger' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'password_field',
			'type' => 'password'
		)
	);
	$wp_customize->get_setting( 'password_field' )->transport = 'postMessage';



	// Radio Field
	$wp_customize->add_setting(
		'radio_field',
		array(
			'default'  	=> 'choice1',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'radio_field',
		array(
			'choices' => array(
				'choice1' => esc_html__( 'Choice 1', 'edge-merger' ),
				'choice2' => esc_html__( 'Choice 2', 'edge-merger' ),
				'choice3' => esc_html__( 'Choice 3', 'edge-merger' )
			),
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' => esc_html__( 'Radio Field', 'edge-merger' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'radio_field',
			'type' => 'radio'
		)
	);
	$wp_customize->get_setting( 'radio_field' )->transport = 'postMessage';



	// Select Field
	$wp_customize->add_setting(
		'select_field',
		array(
			'default'  	=> 'choice1',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'select_field',
		array(
			'choices' => array(
				'choice1' => esc_html__( 'Choice 1', 'edge-merger' ),
				'choice2' => esc_html__( 'Choice 2', 'edge-merger' ),
				'choice3' => esc_html__( 'Choice 3', 'edge-merger' )
			),
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' => esc_html__( 'Select Field', 'edge-merger' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'select_field',
			'type' => 'select'
		)
	);
	$wp_customize->get_setting( 'select_field' )->transport = 'postMessage';



	// Textarea Field
	$wp_customize->add_setting(
		'textarea_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'textarea_field',
		array(
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' => esc_html__( 'Textarea Field', 'edge-merger' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'textarea_field',
			'type' => 'textarea'
		)
	);
	$wp_customize->get_setting( 'textarea_field' )->transport = 'postMessage';



	// Range Field
	$wp_customize->add_setting(
		'range_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'range_field',
		array(
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'input_attrs' => array(
				'class' => 'range-field',
				'max' => 100,
				'min' => 0,
				'step' => 1,
				'style' => 'color: #020202'
			),
			'label' => esc_html__( 'Range Field', 'edge-merger' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'range_field',
			'type' => 'range'
		)
	);
	$wp_customize->get_setting( 'range_field' )->transport = 'postMessage';



	// Page Select Field
	$wp_customize->add_setting(
		'select_page_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'select_page_field',
		array(
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' => esc_html__( 'Select Page', 'edge-merger' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'select_page_field',
			'type' => 'dropdown-pages'
		)
	);
	$wp_customize->get_setting( 'dropdown-pages' )->transport = 'postMessage';



	// Color Chooser Field
	$wp_customize->add_setting(
		'color_field',
		array(
			'default'  	=> '#ffffff',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'color_field',
			array(
				'description' 	=> esc_html__( '', 'edge-merger' ),
				'label' => esc_html__( 'Color Field', 'edge-merger' ),
				'priority' => 10,
				'section' => 'new_section',
				'settings' => 'color_field'
			),
		)
	);
	$wp_customize->get_setting( 'color_field' )->transport = 'postMessage';



	// File Upload Field
	$wp_customize->add_setting( 'file_upload' );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'file_upload',
			array(
				'description' 	=> esc_html__( '', 'edge-merger' ),
				'label' => esc_html__( 'File Upload', 'edge-merger' ),
				'priority' => 10,
				'section' => 'new_section',
				'settings' => 'file_upload'
			),
		)
	);



	// Image Upload Field
	$wp_customize->add_setting(
		'image_upload',
		array(
			'default' => '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'image_upload',
			array(
				'description' 	=> esc_html__( '', 'edge-merger' ),
				'label' => esc_html__( 'Image Field', 'edge-merger' ),
				'priority' => 10,
				'section' => 'new_section',
				'settings' => 'image_upload'
			)
		)
	);
	$wp_customize->get_setting( 'image_upload' )->transport = 'postMessage';



	// Media Upload Field
	// Can be used for images
	// Returns the image ID, not a URL
	$wp_customize->add_setting(
		'media_upload',
		array(
			'default' => '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'media_upload',
			array(
				'description' 	=> esc_html__( '', 'edge-merger' ),
				'label' => esc_html__( 'Media Field', 'edge-merger' ),
				'mime_type' => '',
				'priority' => 10,
				'section' => 'new_section',
				'settings' => 'media_upload'
			)
		)
	);
	$wp_customize->get_setting( 'media_upload' )->transport = 'postMessage';




	// Cropped Image Field
	$wp_customize->add_setting(
		'cropped_image',
		array(
			'default' => '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'cropped_image',
			array(
				'description' 	=> esc_html__( '', 'edge-merger' ),
				'flex_height' => '',
				'flex_width' => '',
				'height' => '1080',
				'priority' => 10,
				'section' => 'new_section',
				'settings' => 'cropped_image',
				width' => '1920'
			)
		)
	);
	$wp_customize->get_setting( 'cropped_image' )->transport = 'postMessage';


	// Country Select Field
	$wp_customize->add_setting(
		'country',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'country',
		array(
			'choices' 		=> edge_merger_country_list(),
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' 		=> esc_html__( 'Country', 'edge-merger' ),
			'priority' 		=> 250,
			'section' 		=> 'contact_info',
			'settings' 		=> 'country',
			'type' 			=> 'select'
		)
	);
	$wp_customize->get_setting( 'country' )->transport = 'postMessage';


	// US States Select Field
	$wp_customize->add_setting(
		'us_state',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'us_state',
		array(
			'choices' => array(
				'AL' => esc_html__( 'Alabama', 'edge-merger' ),
				'AK' => esc_html__( 'Alaska', 'edge-merger' ),
				'AZ' => esc_html__( 'Arizona', 'edge-merger' ),
				'AR' => esc_html__( 'Arkansas', 'edge-merger' ),
				'CA' => esc_html__( 'California', 'edge-merger' ),
				'CO' => esc_html__( 'Colorado', 'edge-merger' ),
				'CT' => esc_html__( 'Connecticut', 'edge-merger' ),
				'DE' => esc_html__( 'Delaware', 'edge-merger' ),
				'DC' => esc_html__( 'District of Columbia', 'edge-merger' ),
				'FL' => esc_html__( 'Florida', 'edge-merger' ),
				'GA' => esc_html__( 'Georgia', 'edge-merger' ),
				'HI' => esc_html__( 'Hawaii', 'edge-merger' ),
				'ID' => esc_html__( 'Idaho', 'edge-merger' ),
				'IL' => esc_html__( 'Illinois', 'edge-merger' ),
				'IN' => esc_html__( 'Indiana', 'edge-merger' ),
				'IA' => esc_html__( 'Iowa', 'edge-merger' ),
				'KS' => esc_html__( 'Kansas', 'edge-merger' ),
				'KY' => esc_html__( 'Kentucky', 'edge-merger' ),
				'LA' => esc_html__( 'Louisiana', 'edge-merger' ),
				'ME' => esc_html__( 'Maine', 'edge-merger' ),
				'MD' => esc_html__( 'Maryland', 'edge-merger' ),
				'MA' => esc_html__( 'Massachusetts', 'edge-merger' ),
				'MI' => esc_html__( 'Michigan', 'edge-merger' ),
				'MN' => esc_html__( 'Minnesota', 'edge-merger' ),
				'MS' => esc_html__( 'Mississippi', 'edge-merger' ),
				'MO' => esc_html__( 'Missouri', 'edge-merger' ),
				'MT' => esc_html__( 'Montana', 'edge-merger' ),
				'NE' => esc_html__( 'Nebraska', 'edge-merger' ),
				'NV' => esc_html__( 'Nevada', 'edge-merger' ),
				'NH' => esc_html__( 'New Hampshire', 'edge-merger' ),
				'NJ' => esc_html__( 'New Jersey', 'edge-merger' ),
				'NM' => esc_html__( 'New Mexico', 'edge-merger' ),
				'NY' => esc_html__( 'New York', 'edge-merger' ),
				'NC' => esc_html__( 'North Carolina', 'edge-merger' ),
				'ND' => esc_html__( 'North Dakota', 'edge-merger' ),
				'OH' => esc_html__( 'Ohio', 'edge-merger' ),
				'OK' => esc_html__( 'Oklahoma', 'edge-merger' ),
				'OR' => esc_html__( 'Oregon', 'edge-merger' ),
				'PA' => esc_html__( 'Pennsylvania', 'edge-merger' ),
				'RI' => esc_html__( 'Rhode Island', 'edge-merger' ),
				'SC' => esc_html__( 'South Carolina', 'edge-merger' ),
				'SD' => esc_html__( 'South Dakota', 'edge-merger' ),
				'TN' => esc_html__( 'Tennessee', 'edge-merger' ),
				'TX' => esc_html__( 'Texas', 'edge-merger' ),
				'UT' => esc_html__( 'Utah', 'edge-merger' ),
				'VT' => esc_html__( 'Vermont', 'edge-merger' ),
				'VA' => esc_html__( 'Virginia', 'edge-merger' ),
				'WA' => esc_html__( 'Washington', 'edge-merger' ),
				'WV' => esc_html__( 'West Virginia', 'edge-merger' ),
				'WI' => esc_html__( 'Wisconsin', 'edge-merger' ),
				'WY' => esc_html__( 'Wyoming', 'edge-merger' ),
				'AS' => esc_html__( 'American Samoa', 'edge-merger' ),
				'AA' => esc_html__( 'Armed Forces America (except Canada)', 'edge-merger' ),
				'AE' => esc_html__( 'Armed Forces Africa/Canada/Europe/Middle East', 'edge-merger' ),
				'AP' => esc_html__( 'Armed Forces Pacific', 'edge-merger' ),
				'FM' => esc_html__( 'Federated States of Micronesia', 'edge-merger' ),
				'GU' => esc_html__( 'Guam', 'edge-merger' ),
				'MH' => esc_html__( 'Marshall Islands', 'edge-merger' ),
				'MP' => esc_html__( 'Northern Mariana Islands', 'edge-merger' ),
				'PR' => esc_html__( 'Puerto Rico', 'edge-merger' ),
				'PW' => esc_html__( 'Palau', 'edge-merger' ),
				'VI' => esc_html__( 'Virgin Islands', 'edge-merger' )
			),
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' 		=> esc_html__( 'State', 'edge-merger' ),
			'priority' 		=> 230,
			'section' 		=> 'contact_info',
			'settings' 		=> 'us_state',
			'type' 			=> 'select'
		)
	);
	$wp_customize->get_setting( 'us_state' )->transport = 'postMessage';


	// Canadian States Select Field
	$wp_customize->add_setting(
		'canada_state',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'canada_state',
		array(
			'choices' => array(
				'AB' => esc_html__( 'Alberta', 'edge-merger' ),
				'BC' => esc_html__( 'British Columbia', 'edge-merger' ),
				'MB' => esc_html__( 'Manitoba', 'edge-merger' ),
				'NB' => esc_html__( 'New Brunswick', 'edge-merger' ),
				'NL' => esc_html__( 'Newfoundland and Labrador', 'edge-merger' ),
				'NT' => esc_html__( 'Northwest Territories', 'edge-merger' ),
				'NS' => esc_html__( 'Nova Scotia', 'edge-merger' ),
				'NU' => esc_html__( 'Nunavut', 'edge-merger' ),
				'ON' => esc_html__( 'Ontario', 'edge-merger' ),
				'PE' => esc_html__( 'Prince Edward Island', 'edge-merger' ),
				'QC' => esc_html__( 'Quebec', 'edge-merger' ),
				'SK' => esc_html__( 'Saskatchewan', 'edge-merger' ),
				'YT' => esc_html__( 'Yukon', 'edge-merger' )
			),
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' 		=> esc_html__( 'State', 'edge-merger' ),
			'priority' 		=> 230,
			'section' 		=> 'contact_info',
			'settings' 		=> 'canada_state',
			'type' 			=> 'select'
		)
	);
	$wp_customize->get_setting( 'canada_state' )->transport = 'postMessage';


	// Australian States Select Field
	$wp_customize->add_setting(
		'australia_state',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'australia_state',
		array(
			'choices' => array(
				'ACT' 	=> esc_html__( 'Australian Capital Territory', 'edge-merger' ),
				'NSW' 	=> esc_html__( 'New South Wales', 'edge-merger' ),
				'NT' 	=> esc_html__( 'Northern Territory', 'edge-merger' ),
				'QLD' 	=> esc_html__( 'Queensland', 'edge-merger' ),
				'SA' 	=> esc_html__( 'South Australia', 'edge-merger' ),
				'TAS' 	=> esc_html__( 'Tasmania', 'edge-merger' ),
				'VIC' 	=> esc_html__( 'Victoria', 'edge-merger' ),
				'WA' 	=> esc_html__( 'Western Australia', 'edge-merger' )
			),
			'description' 	=> esc_html__( '', 'edge-merger' ),
			'label' 		=> esc_html__( 'State', 'edge-merger' ),
			'priority' 		=> 230,
			'section' 		=> 'contact_info',
			'settings' 		=> 'australia_state',
			'type' 			=> 'select'
		)
	);
	$wp_customize->get_setting( 'australia_state' )->transport = 'postMessage';


	*/

} // edge_merger_register_fields()

/**
 * This will generate a line of CSS for use in header output. If the setting
 * ($mod_name) has no defined value, the CSS will not be output.
 *
 * @access 		public
 * @since 		1.0.0
 *
 * @param 		string 		$selector 		CSS selector
 * @param 		string 		$style 			The name of the CSS *property* to modify
 * @param 		string 		$mod_name 		The name of the 'theme_mod' option to fetch
 * @param 		string 		$prefix 		Optional. Anything that needs to be output before the CSS property
 * @param 		string 		$postfix 		Optional. Anything that needs to be output after the CSS property
 * @param 		bool 		$echo 			Optional. Whether to print directly to the page (default: true).
 *
 * @return 		string 						Returns a single line of CSS with selectors and a property.
 */
function edge_merger_generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {

	$return = '';
	$mod 	= get_theme_mod( $mod_name );

	if ( ! empty( $mod ) ) {

		$return = sprintf('%s { %s:%s; }',
			$selector,
			$style,
			$prefix . $mod . $postfix
		);

		if ( $echo ) {

			echo $return;

		}

	}

	return $return;

} // edge_merger_generate_css()

/**
 * This will output the custom WordPress settings to the live theme's WP head.
 *
 * Used by hook: 'wp_head'
 *
 * @access 		public
 * @see 		add_action( 'wp_head', $func )
 * @since 		1.0.0
 */
function edge_merger_header_output() {

	?><!-- Customizer CSS -->
	<style type="text/css"><?php

		// pattern:
		// edge_merger_generate_css( 'selector', 'style', 'mod_name', 'prefix', 'postfix', true );
		//
		// background-image example:
		// edge_merger_generate_css( '.class', 'background-image', 'background_image_example', 'url(', ')' );


	?></style><!-- Customizer CSS --><?php

} // edge_merger_header_output()

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * Used by hook: 'customize_preview_init'
 *
 * @access 		public
 * @see 		add_action( 'customize_preview_init', $func )
 * @since 		1.0.0
 */
function edge_merger_live_preview() {

	wp_enqueue_script( 'edge_merger_customizer', get_template_directory_uri() . '/js/customizer.min.js', array( 'jquery', 'customize-preview' ), '', true );

} // edge_merger_live_preview()

/**
 * Used by customizer controls, mostly for active callbacks.
 *
 * @hook		customize_controls_enqueue_scripts
 *
 * @access 		public
 * @see 		add_action( 'customize_preview_init', $func )
 * @since 		1.0.0
 */
function edge_merger_control_scripts() {

	wp_enqueue_script( 'edge_merger_customizer_controls', get_template_directory_uri() . '/js/customizer-controls.min.js', array( 'jquery', 'customize-controls' ), false, true );

} // edge_merger_control_scripts()

/**
 * Returns TRUE based on which link type is selected, otherwise FALSE
 *
 * @param 	object 		$control 			The control object
 * @return 	bool 							TRUE if conditions are met, otherwise FALSE
 */
function edge_merger_states_of_country_callback( $control ) {

	$country_setting = $control->manager->get_setting('country')->value();

	//wp_die( print_r( $radio_setting ) );
	//wp_die( print_r( $control->id ) );

	if ( 'us_state' === $control->id && 'US' === $country_setting ) { return true; }
	if ( 'canada_state' === $control->id && 'CA' === $country_setting ) { return true; }
	if ( 'australia_state' === $control->id && 'AU' === $country_setting ) { return true; }
	if ( 'default_state' === $control->id && ! edge_merger_custom_countries( $country_setting ) ) { return true; }

	return false;

} // edge_merger_states_of_country_callback()

/**
 * Returns true if a country has a custom select menu
 *
 * @param 		string 		$country 			The country code to check
 *
 * @return 		bool 							TRUE if the code is in the array, FALSE otherwise
 */
function edge_merger_custom_countries( $country ) {

	$countries = array( 'US', 'CA', 'AU' );

	return in_array( $country, $countries );

} // edge_merger_custom_countries()


/**
 * Returns an array of countries or a country name.
 *
 * @param 		string 		$country 		Country code to return (optional)
 *
 * @return 		array|string 				Array of countries or a single country name
 */
function edge_merger_country_list( $country = '' ) {

	$countries = array();

	$countries['AF'] = esc_html__( 'Afghanistan (‫افغانستان‬‎)', 'edge-merger' );
	$countries['AX'] = esc_html__( 'Åland Islands (Åland)', 'edge-merger' );
	$countries['AL'] = esc_html__( 'Albania (Shqipëri)', 'edge-merger' );
	$countries['DZ'] = esc_html__( 'Algeria (‫الجزائر‬‎)', 'edge-merger' );
	$countries['AS'] = esc_html__( 'American Samoa', 'edge-merger' );
	$countries['AD'] = esc_html__( 'Andorra', 'edge-merger' );
	$countries['AO'] = esc_html__( 'Angola', 'edge-merger' );
	$countries['AI'] = esc_html__( 'Anguilla', 'edge-merger' );
	$countries['AQ'] = esc_html__( 'Antarctica', 'edge-merger' );
	$countries['AG'] = esc_html__( 'Antigua and Barbuda', 'edge-merger' );
	$countries['AR'] = esc_html__( 'Argentina', 'edge-merger' );
	$countries['AM'] = esc_html__( 'Armenia (Հայաստան)', 'edge-merger' );
	$countries['AW'] = esc_html__( 'Aruba', 'edge-merger' );
	$countries['AC'] = esc_html__( 'Ascension Island', 'edge-merger' );
	$countries['AU'] = esc_html__( 'Australia', 'edge-merger' );
	$countries['AT'] = esc_html__( 'Austria (Österreich)', 'edge-merger' );
	$countries['AZ'] = esc_html__( 'Azerbaijan (Azərbaycan)', 'edge-merger' );
	$countries['BS'] = esc_html__( 'Bahamas', 'edge-merger' );
	$countries['BH'] = esc_html__( 'Bahrain (‫البحرين‬‎)', 'edge-merger' );
	$countries['BD'] = esc_html__( 'Bangladesh (বাংলাদেশ)', 'edge-merger' );
	$countries['BB'] = esc_html__( 'Barbados', 'edge-merger' );
	$countries['BY'] = esc_html__( 'Belarus (Беларусь)', 'edge-merger' );
	$countries['BE'] = esc_html__( 'Belgium (België)', 'edge-merger' );
	$countries['BZ'] = esc_html__( 'Belize', 'edge-merger' );
	$countries['BJ'] = esc_html__( 'Benin (Bénin)', 'edge-merger' );
	$countries['BM'] = esc_html__( 'Bermuda', 'edge-merger' );
	$countries['BT'] = esc_html__( 'Bhutan (འབྲུག)', 'edge-merger' );
	$countries['BO'] = esc_html__( 'Bolivia', 'edge-merger' );
	$countries['BA'] = esc_html__( 'Bosnia and Herzegovina (Босна и Херцеговина)', 'edge-merger' );
	$countries['BW'] = esc_html__( 'Botswana', 'edge-merger' );
	$countries['BV'] = esc_html__( 'Bouvet Island', 'edge-merger' );
	$countries['BR'] = esc_html__( 'Brazil (Brasil)', 'edge-merger' );
	$countries['IO'] = esc_html__( 'British Indian Ocean Territory', 'edge-merger' );
	$countries['VG'] = esc_html__( 'British Virgin Islands', 'edge-merger' );
	$countries['BN'] = esc_html__( 'Brunei', 'edge-merger' );
	$countries['BG'] = esc_html__( 'Bulgaria (България)', 'edge-merger' );
	$countries['BF'] = esc_html__( 'Burkina Faso', 'edge-merger' );
	$countries['BI'] = esc_html__( 'Burundi (Uburundi)', 'edge-merger' );
	$countries['KH'] = esc_html__( 'Cambodia (កម្ពុជា)', 'edge-merger' );
	$countries['CM'] = esc_html__( 'Cameroon (Cameroun)', 'edge-merger' );
	$countries['CA'] = esc_html__( 'Canada', 'edge-merger' );
	$countries['IC'] = esc_html__( 'Canary Islands (islas Canarias)', 'edge-merger' );
	$countries['CV'] = esc_html__( 'Cape Verde (Kabu Verdi)', 'edge-merger' );
	$countries['BQ'] = esc_html__( 'Caribbean Netherlands', 'edge-merger' );
	$countries['KY'] = esc_html__( 'Cayman Islands', 'edge-merger' );
	$countries['CF'] = esc_html__( 'Central African Republic (République centrafricaine)', 'edge-merger' );
	$countries['EA'] = esc_html__( 'Ceuta and Melilla (Ceuta y Melilla)', 'edge-merger' );
	$countries['TD'] = esc_html__( 'Chad (Tchad)', 'edge-merger' );
	$countries['CL'] = esc_html__( 'Chile', 'edge-merger' );
	$countries['CN'] = esc_html__( 'China (中国)', 'edge-merger' );
	$countries['CX'] = esc_html__( 'Christmas Island', 'edge-merger' );
	$countries['CP'] = esc_html__( 'Clipperton Island', 'edge-merger' );
	$countries['CC'] = esc_html__( 'Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))', 'edge-merger' );
	$countries['CO'] = esc_html__( 'Colombia', 'edge-merger' );
	$countries['KM'] = esc_html__( 'Comoros (‫جزر القمر‬‎)', 'edge-merger' );
	$countries['CD'] = esc_html__( 'Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)', 'edge-merger' );
	$countries['CG'] = esc_html__( 'Congo (Republic) (Congo-Brazzaville)', 'edge-merger' );
	$countries['CK'] = esc_html__( 'Cook Islands', 'edge-merger' );
	$countries['CR'] = esc_html__( 'Costa Rica', 'edge-merger' );
	$countries['CI'] = esc_html__( 'Côte d’Ivoire', 'edge-merger' );
	$countries['HR'] = esc_html__( 'Croatia (Hrvatska)', 'edge-merger' );
	$countries['CU'] = esc_html__( 'Cuba', 'edge-merger' );
	$countries['CW'] = esc_html__( 'Curaçao', 'edge-merger' );
	$countries['CY'] = esc_html__( 'Cyprus (Κύπρος)', 'edge-merger' );
	$countries['CZ'] = esc_html__( 'Czech Republic (Česká republika)', 'edge-merger' );
	$countries['DK'] = esc_html__( 'Denmark (Danmark)', 'edge-merger' );
	$countries['DG'] = esc_html__( 'Diego Garcia', 'edge-merger' );
	$countries['DJ'] = esc_html__( 'Djibouti', 'edge-merger' );
	$countries['DM'] = esc_html__( 'Dominica', 'edge-merger' );
	$countries['DO'] = esc_html__( 'Dominican Republic (República Dominicana)', 'edge-merger' );
	$countries['EC'] = esc_html__( 'Ecuador', 'edge-merger' );
	$countries['EG'] = esc_html__( 'Egypt (‫مصر‬‎)', 'edge-merger' );
	$countries['SV'] = esc_html__( 'El Salvador', 'edge-merger' );
	$countries['GQ'] = esc_html__( 'Equatorial Guinea (Guinea Ecuatorial)', 'edge-merger' );
	$countries['ER'] = esc_html__( 'Eritrea', 'edge-merger' );
	$countries['EE'] = esc_html__( 'Estonia (Eesti)', 'edge-merger' );
	$countries['ET'] = esc_html__( 'Ethiopia', 'edge-merger' );
	$countries['FK'] = esc_html__( 'Falkland Islands (Islas Malvinas)', 'edge-merger' );
	$countries['FO'] = esc_html__( 'Faroe Islands (Føroyar)', 'edge-merger' );
	$countries['FJ'] = esc_html__( 'Fiji', 'edge-merger' );
	$countries['FI'] = esc_html__( 'Finland (Suomi)', 'edge-merger' );
	$countries['FR'] = esc_html__( 'France', 'edge-merger' );
	$countries['GF'] = esc_html__( 'French Guiana (Guyane française)', 'edge-merger' );
	$countries['PF'] = esc_html__( 'French Polynesia (Polynésie française)', 'edge-merger' );
	$countries['TF'] = esc_html__( 'French Southern Territories (Terres australes françaises)', 'edge-merger' );
	$countries['GA'] = esc_html__( 'Gabon', 'edge-merger' );
	$countries['GM'] = esc_html__( 'Gambia', 'edge-merger' );
	$countries['GE'] = esc_html__( 'Georgia (საქართველო)', 'edge-merger' );
	$countries['DE'] = esc_html__( 'Germany (Deutschland)', 'edge-merger' );
	$countries['GH'] = esc_html__( 'Ghana (Gaana)', 'edge-merger' );
	$countries['GI'] = esc_html__( 'Gibraltar', 'edge-merger' );
	$countries['GR'] = esc_html__( 'Greece (Ελλάδα)', 'edge-merger' );
	$countries['GL'] = esc_html__( 'Greenland (Kalaallit Nunaat)', 'edge-merger' );
	$countries['GD'] = esc_html__( 'Grenada', 'edge-merger' );
	$countries['GP'] = esc_html__( 'Guadeloupe', 'edge-merger' );
	$countries['GU'] = esc_html__( 'Guam', 'edge-merger' );
	$countries['GT'] = esc_html__( 'Guatemala', 'edge-merger' );
	$countries['GG'] = esc_html__( 'Guernsey', 'edge-merger' );
	$countries['GN'] = esc_html__( 'Guinea (Guinée)', 'edge-merger' );
	$countries['GW'] = esc_html__( 'Guinea-Bissau (Guiné Bissau)', 'edge-merger' );
	$countries['GY'] = esc_html__( 'Guyana', 'edge-merger' );
	$countries['HT'] = esc_html__( 'Haiti', 'edge-merger' );
	$countries['HM'] = esc_html__( 'Heard & McDonald Islands', 'edge-merger' );
	$countries['HN'] = esc_html__( 'Honduras', 'edge-merger' );
	$countries['HK'] = esc_html__( 'Hong Kong (香港)', 'edge-merger' );
	$countries['HU'] = esc_html__( 'Hungary (Magyarország)', 'edge-merger' );
	$countries['IS'] = esc_html__( 'Iceland (Ísland)', 'edge-merger' );
	$countries['IN'] = esc_html__( 'India (भारत)', 'edge-merger' );
	$countries['ID'] = esc_html__( 'Indonesia', 'edge-merger' );
	$countries['IR'] = esc_html__( 'Iran (‫ایران‬‎)', 'edge-merger' );
	$countries['IQ'] = esc_html__( 'Iraq (‫العراق‬‎)', 'edge-merger' );
	$countries['IE'] = esc_html__( 'Ireland', 'edge-merger' );
	$countries['IM'] = esc_html__( 'Isle of Man', 'edge-merger' );
	$countries['IL'] = esc_html__( 'Israel (‫ישראל‬‎)', 'edge-merger' );
	$countries['IT'] = esc_html__( 'Italy (Italia)', 'edge-merger' );
	$countries['JM'] = esc_html__( 'Jamaica', 'edge-merger' );
	$countries['JP'] = esc_html__( 'Japan (日本)', 'edge-merger' );
	$countries['JE'] = esc_html__( 'Jersey', 'edge-merger' );
	$countries['JO'] = esc_html__( 'Jordan (‫الأردن‬‎)', 'edge-merger' );
	$countries['KZ'] = esc_html__( 'Kazakhstan (Казахстан)', 'edge-merger' );
	$countries['KE'] = esc_html__( 'Kenya', 'edge-merger' );
	$countries['KI'] = esc_html__( 'Kiribati', 'edge-merger' );
	$countries['XK'] = esc_html__( 'Kosovo (Kosovë)', 'edge-merger' );
	$countries['KW'] = esc_html__( 'Kuwait (‫الكويت‬‎)', 'edge-merger' );
	$countries['KG'] = esc_html__( 'Kyrgyzstan (Кыргызстан)', 'edge-merger' );
	$countries['LA'] = esc_html__( 'Laos (ລາວ)', 'edge-merger' );
	$countries['LV'] = esc_html__( 'Latvia (Latvija)', 'edge-merger' );
	$countries['LB'] = esc_html__( 'Lebanon (‫لبنان‬‎)', 'edge-merger' );
	$countries['LS'] = esc_html__( 'Lesotho', 'edge-merger' );
	$countries['LR'] = esc_html__( 'Liberia', 'edge-merger' );
	$countries['LY'] = esc_html__( 'Libya (‫ليبيا‬‎)', 'edge-merger' );
	$countries['LI'] = esc_html__( 'Liechtenstein', 'edge-merger' );
	$countries['LT'] = esc_html__( 'Lithuania (Lietuva)', 'edge-merger' );
	$countries['LU'] = esc_html__( 'Luxembourg', 'edge-merger' );
	$countries['MO'] = esc_html__( 'Macau (澳門)', 'edge-merger' );
	$countries['MK'] = esc_html__( 'Macedonia (FYROM) (Македонија)', 'edge-merger' );
	$countries['MG'] = esc_html__( 'Madagascar (Madagasikara)', 'edge-merger' );
	$countries['MW'] = esc_html__( 'Malawi', 'edge-merger' );
	$countries['MY'] = esc_html__( 'Malaysia', 'edge-merger' );
	$countries['MV'] = esc_html__( 'Maldives', 'edge-merger' );
	$countries['ML'] = esc_html__( 'Mali', 'edge-merger' );
	$countries['MT'] = esc_html__( 'Malta', 'edge-merger' );
	$countries['MH'] = esc_html__( 'Marshall Islands', 'edge-merger' );
	$countries['MQ'] = esc_html__( 'Martinique', 'edge-merger' );
	$countries['MR'] = esc_html__( 'Mauritania (‫موريتانيا‬‎)', 'edge-merger' );
	$countries['MU'] = esc_html__( 'Mauritius (Moris)', 'edge-merger' );
	$countries['YT'] = esc_html__( 'Mayotte', 'edge-merger' );
	$countries['MX'] = esc_html__( 'Mexico (México)', 'edge-merger' );
	$countries['FM'] = esc_html__( 'Micronesia', 'edge-merger' );
	$countries['MD'] = esc_html__( 'Moldova (Republica Moldova)', 'edge-merger' );
	$countries['MC'] = esc_html__( 'Monaco', 'edge-merger' );
	$countries['MN'] = esc_html__( 'Mongolia (Монгол)', 'edge-merger' );
	$countries['ME'] = esc_html__( 'Montenegro (Crna Gora)', 'edge-merger' );
	$countries['MS'] = esc_html__( 'Montserrat', 'edge-merger' );
	$countries['MA'] = esc_html__( 'Morocco (‫المغرب‬‎)', 'edge-merger' );
	$countries['MZ'] = esc_html__( 'Mozambique (Moçambique)', 'edge-merger' );
	$countries['MM'] = esc_html__( 'Myanmar (Burma) (မြန်မာ)', 'edge-merger' );
	$countries['NA'] = esc_html__( 'Namibia (Namibië)', 'edge-merger' );
	$countries['NR'] = esc_html__( 'Nauru', 'edge-merger' );
	$countries['NP'] = esc_html__( 'Nepal (नेपाल)', 'edge-merger' );
	$countries['NL'] = esc_html__( 'Netherlands (Nederland)', 'edge-merger' );
	$countries['NC'] = esc_html__( 'New Caledonia (Nouvelle-Calédonie)', 'edge-merger' );
	$countries['NZ'] = esc_html__( 'New Zealand', 'edge-merger' );
	$countries['NI'] = esc_html__( 'Nicaragua', 'edge-merger' );
	$countries['NE'] = esc_html__( 'Niger (Nijar)', 'edge-merger' );
	$countries['NG'] = esc_html__( 'Nigeria', 'edge-merger' );
	$countries['NU'] = esc_html__( 'Niue', 'edge-merger' );
	$countries['NF'] = esc_html__( 'Norfolk Island', 'edge-merger' );
	$countries['MP'] = esc_html__( 'Northern Mariana Islands', 'edge-merger' );
	$countries['KP'] = esc_html__( 'North Korea (조선 민주주의 인민 공화국)', 'edge-merger' );
	$countries['NO'] = esc_html__( 'Norway (Norge)', 'edge-merger' );
	$countries['OM'] = esc_html__( 'Oman (‫عُمان‬‎)', 'edge-merger' );
	$countries['PK'] = esc_html__( 'Pakistan (‫پاکستان‬‎)', 'edge-merger' );
	$countries['PW'] = esc_html__( 'Palau', 'edge-merger' );
	$countries['PS'] = esc_html__( 'Palestine (‫فلسطين‬‎)', 'edge-merger' );
	$countries['PA'] = esc_html__( 'Panama (Panamá)', 'edge-merger' );
	$countries['PG'] = esc_html__( 'Papua New Guinea', 'edge-merger' );
	$countries['PY'] = esc_html__( 'Paraguay', 'edge-merger' );
	$countries['PE'] = esc_html__( 'Peru (Perú)', 'edge-merger' );
	$countries['PH'] = esc_html__( 'Philippines', 'edge-merger' );
	$countries['PN'] = esc_html__( 'Pitcairn Islands', 'edge-merger' );
	$countries['PL'] = esc_html__( 'Poland (Polska)', 'edge-merger' );
	$countries['PT'] = esc_html__( 'Portugal', 'edge-merger' );
	$countries['PR'] = esc_html__( 'Puerto Rico', 'edge-merger' );
	$countries['QA'] = esc_html__( 'Qatar (‫قطر‬‎)', 'edge-merger' );
	$countries['RE'] = esc_html__( 'Réunion (La Réunion)', 'edge-merger' );
	$countries['RO'] = esc_html__( 'Romania (România)', 'edge-merger' );
	$countries['RU'] = esc_html__( 'Russia (Россия)', 'edge-merger' );
	$countries['RW'] = esc_html__( 'Rwanda', 'edge-merger' );
	$countries['BL'] = esc_html__( 'Saint Barthélemy (Saint-Barthélemy)', 'edge-merger' );
	$countries['SH'] = esc_html__( 'Saint Helena', 'edge-merger' );
	$countries['KN'] = esc_html__( 'Saint Kitts and Nevis', 'edge-merger' );
	$countries['LC'] = esc_html__( 'Saint Lucia', 'edge-merger' );
	$countries['MF'] = esc_html__( 'Saint Martin (Saint-Martin (partie française))', 'edge-merger' );
	$countries['PM'] = esc_html__( 'Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)', 'edge-merger' );
	$countries['WS'] = esc_html__( 'Samoa', 'edge-merger' );
	$countries['SM'] = esc_html__( 'San Marino', 'edge-merger' );
	$countries['ST'] = esc_html__( 'São Tomé and Príncipe (São Tomé e Príncipe)', 'edge-merger' );
	$countries['SA'] = esc_html__( 'Saudi Arabia (‫المملكة العربية السعودية‬‎)', 'edge-merger' );
	$countries['SN'] = esc_html__( 'Senegal (Sénégal)', 'edge-merger' );
	$countries['RS'] = esc_html__( 'Serbia (Србија)', 'edge-merger' );
	$countries['SC'] = esc_html__( 'Seychelles', 'edge-merger' );
	$countries['SL'] = esc_html__( 'Sierra Leone', 'edge-merger' );
	$countries['SG'] = esc_html__( 'Singapore', 'edge-merger' );
	$countries['SX'] = esc_html__( 'Sint Maarten', 'edge-merger' );
	$countries['SK'] = esc_html__( 'Slovakia (Slovensko)', 'edge-merger' );
	$countries['SI'] = esc_html__( 'Slovenia (Slovenija)', 'edge-merger' );
	$countries['SB'] = esc_html__( 'Solomon Islands', 'edge-merger' );
	$countries['SO'] = esc_html__( 'Somalia (Soomaaliya)', 'edge-merger' );
	$countries['ZA'] = esc_html__( 'South Africa', 'edge-merger' );
	$countries['GS'] = esc_html__( 'South Georgia & South Sandwich Islands', 'edge-merger' );
	$countries['KR'] = esc_html__( 'South Korea (대한민국)', 'edge-merger' );
	$countries['SS'] = esc_html__( 'South Sudan (‫جنوب السودان‬‎)', 'edge-merger' );
	$countries['ES'] = esc_html__( 'Spain (España)', 'edge-merger' );
	$countries['LK'] = esc_html__( 'Sri Lanka (ශ්‍රී ලංකාව)', 'edge-merger' );
	$countries['VC'] = esc_html__( 'St. Vincent & Grenadines', 'edge-merger' );
	$countries['SD'] = esc_html__( 'Sudan (‫السودان‬‎)', 'edge-merger' );
	$countries['SR'] = esc_html__( 'Suriname', 'edge-merger' );
	$countries['SJ'] = esc_html__( 'Svalbard and Jan Mayen (Svalbard og Jan Mayen)', 'edge-merger' );
	$countries['SZ'] = esc_html__( 'Swaziland', 'edge-merger' );
	$countries['SE'] = esc_html__( 'Sweden (Sverige)', 'edge-merger' );
	$countries['CH'] = esc_html__( 'Switzerland (Schweiz)', 'edge-merger' );
	$countries['SY'] = esc_html__( 'Syria (‫سوريا‬‎)', 'edge-merger' );
	$countries['TW'] = esc_html__( 'Taiwan (台灣)', 'edge-merger' );
	$countries['TJ'] = esc_html__( 'Tajikistan', 'edge-merger' );
	$countries['TZ'] = esc_html__( 'Tanzania', 'edge-merger' );
	$countries['TH'] = esc_html__( 'Thailand (ไทย)', 'edge-merger' );
	$countries['TL'] = esc_html__( 'Timor-Leste', 'edge-merger' );
	$countries['TG'] = esc_html__( 'Togo', 'edge-merger' );
	$countries['TK'] = esc_html__( 'Tokelau', 'edge-merger' );
	$countries['TO'] = esc_html__( 'Tonga', 'edge-merger' );
	$countries['TT'] = esc_html__( 'Trinidad and Tobago', 'edge-merger' );
	$countries['TA'] = esc_html__( 'Tristan da Cunha', 'edge-merger' );
	$countries['TN'] = esc_html__( 'Tunisia (‫تونس‬‎)', 'edge-merger' );
	$countries['TR'] = esc_html__( 'Turkey (Türkiye)', 'edge-merger' );
	$countries['TM'] = esc_html__( 'Turkmenistan', 'edge-merger' );
	$countries['TC'] = esc_html__( 'Turks and Caicos Islands', 'edge-merger' );
	$countries['TV'] = esc_html__( 'Tuvalu', 'edge-merger' );
	$countries['UM'] = esc_html__( 'U.S. Outlying Islands', 'edge-merger' );
	$countries['VI'] = esc_html__( 'U.S. Virgin Islands', 'edge-merger' );
	$countries['UG'] = esc_html__( 'Uganda', 'edge-merger' );
	$countries['UA'] = esc_html__( 'Ukraine (Україна)', 'edge-merger' );
	$countries['AE'] = esc_html__( 'United Arab Emirates (‫الإمارات العربية المتحدة‬‎)', 'edge-merger' );
	$countries['GB'] = esc_html__( 'United Kingdom', 'edge-merger' );
	$countries['US'] = esc_html__( 'United States', 'edge-merger' );
	$countries['UY'] = esc_html__( 'Uruguay', 'edge-merger' );
	$countries['UZ'] = esc_html__( 'Uzbekistan (Oʻzbekiston)', 'edge-merger' );
	$countries['VU'] = esc_html__( 'Vanuatu', 'edge-merger' );
	$countries['VA'] = esc_html__( 'Vatican City (Città del Vaticano)', 'edge-merger' );
	$countries['VE'] = esc_html__( 'Venezuela', 'edge-merger' );
	$countries['VN'] = esc_html__( 'Vietnam (Việt Nam)', 'edge-merger' );
	$countries['WF'] = esc_html__( 'Wallis and Futuna', 'edge-merger' );
	$countries['EH'] = esc_html__( 'Western Sahara (‫الصحراء الغربية‬‎)', 'edge-merger' );
	$countries['YE'] = esc_html__( 'Yemen (‫اليمن‬‎)', 'edge-merger' );
	$countries['ZM'] = esc_html__( 'Zambia', 'edge-merger' );
	$countries['ZW'] = esc_html__( 'Zimbabwe', 'edge-merger' );

	if ( ! empty( $country ) ) {

		return $countries[$country];

	}

	return $countries;

} // edge_merger_country_list()

