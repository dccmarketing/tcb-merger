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
add_action( 'customize_register', 'function_names_register_panels' );
add_action( 'customize_register', 'function_names_register_sections' );
add_action( 'customize_register', 'function_names_register_fields' );

// Output custom CSS to live site
add_action( 'wp_head', 'function_names_header_output' );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init', 'function_names_live_preview' );

// Enqueue scripts for the customizer controls
add_action( 'customize_controls_enqueue_scripts', 'function_names_control_scripts' );

/**
 * Registers custom panels for the Customizer
 *
 * @see			add_action( 'customize_register', $func )
 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * @since 		1.0.0
 *
 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
 */
function function_names_register_panels( $wp_customize ) {

	// Theme Options Panel
	$wp_customize->add_panel( 'theme_options',
		array(
			'capability'  		=> 'edit_theme_options',
			'description'  		=> esc_html__( 'Options for Replace With Theme Name', 'tcb-merger' ),
			'priority'  		=> 10,
			'theme_supports'  	=> '',
			'title'  			=> esc_html__( 'Theme Options', 'tcb-merger' ),
		)
	);

	/*
	// Theme Options Panel
	$wp_customize->add_panel( 'theme_options',
		array(
			'capability'  		=> 'edit_theme_options',
			'description'  		=> esc_html__( 'Options for Replace With Theme Name', 'tcb-merger' ),
			'priority'  		=> 10,
			'theme_supports'  	=> '',
			'title'  			=> esc_html__( 'Theme Options', 'tcb-merger' ),
		)
	);
	*/

} // function_names_register_panels()

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
function function_names_register_sections( $wp_customize ) {



	/*
	// New Section
	$wp_customize->add_section( 'new_section',
		array(
			'capability' 	=> 'edit_theme_options',
			'description' 	=> esc_html__( 'New Customizer Section', 'tcb-merger' ),
			'panel' 		=> 'theme_options',
			'priority' 		=> 10,
			'title' 		=> esc_html__( 'New Section', 'tcb-merger' )
		)
	);
	*/

} // function_names_register_sections()

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
function function_names_register_fields( $wp_customize ) {

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
			'description' 	=> esc_html__( 'Paste in the Google Tag Manager code here.', 'tcb-merger' ),
			'label' => esc_html__( 'Google Tag Manager', 'tcb-merger' ),
			'priority' => 90,
			'section' => 'title_tagline',
			'settings' => 'tag_manager',
			'type' => 'textarea'
		)
	);
	$wp_customize->get_setting( 'tag_manager' )->transport = 'postMessage';




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
			'description' 	=> esc_html__( '', 'tcb-merger' ),
			'label'  	=> esc_html__( 'Text Field', 'tcb-merger' ),
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
			'description' 	=> esc_html__( '', 'tcb-merger' ),
			'label' => esc_html__( 'URL Field', 'tcb-merger' ),
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
			'description' 	=> esc_html__( '', 'tcb-merger' ),
			'label' => esc_html__( 'Email Field', 'tcb-merger' ),
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
			'description' 	=> esc_html__( '', 'tcb-merger' ),
			'label' => esc_html__( 'Date Field', 'tcb-merger' ),
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
			'description' 	=> esc_html__( '', 'tcb-merger' ),
			'label' => esc_html__( 'Checkbox Field', 'tcb-merger' ),
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
			'description' 	=> esc_html__( '', 'tcb-merger' ),
			'label' => esc_html__( 'Password Field', 'tcb-merger' ),
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
				'choice1' => esc_html__( 'Choice 1', 'tcb-merger' ),
				'choice2' => esc_html__( 'Choice 2', 'tcb-merger' ),
				'choice3' => esc_html__( 'Choice 3', 'tcb-merger' )
			),
			'description' 	=> esc_html__( '', 'tcb-merger' ),
			'label' => esc_html__( 'Radio Field', 'tcb-merger' ),
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
				'choice1' => esc_html__( 'Choice 1', 'tcb-merger' ),
				'choice2' => esc_html__( 'Choice 2', 'tcb-merger' ),
				'choice3' => esc_html__( 'Choice 3', 'tcb-merger' )
			),
			'description' 	=> esc_html__( '', 'tcb-merger' ),
			'label' => esc_html__( 'Select Field', 'tcb-merger' ),
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
			'description' 	=> esc_html__( '', 'tcb-merger' ),
			'label' => esc_html__( 'Textarea Field', 'tcb-merger' ),
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
			'description' 	=> esc_html__( '', 'tcb-merger' ),
			'input_attrs' => array(
				'class' => 'range-field',
				'max' => 100,
				'min' => 0,
				'step' => 1,
				'style' => 'color: #020202'
			),
			'label' => esc_html__( 'Range Field', 'tcb-merger' ),
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
			'description' 	=> esc_html__( '', 'tcb-merger' ),
			'label' => esc_html__( 'Select Page', 'tcb-merger' ),
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
				'description' 	=> esc_html__( '', 'tcb-merger' ),
				'label' => esc_html__( 'Color Field', 'tcb-merger' ),
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
				'description' 	=> esc_html__( '', 'tcb-merger' ),
				'label' => esc_html__( 'File Upload', 'tcb-merger' ),
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
				'description' 	=> esc_html__( '', 'tcb-merger' ),
				'label' => esc_html__( 'Image Field', 'tcb-merger' ),
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
				'description' 	=> esc_html__( '', 'tcb-merger' ),
				'label' => esc_html__( 'Media Field', 'tcb-merger' ),
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
				'description' 	=> esc_html__( '', 'tcb-merger' ),
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
			'choices' 		=> function_names_country_list(),
			'description' 	=> esc_html__( '', 'tcb-merger' ),
			'label' 		=> esc_html__( 'Country', 'tcb-merger' ),
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
				'AL' => esc_html__( 'Alabama', 'tcb-merger' ),
				'AK' => esc_html__( 'Alaska', 'tcb-merger' ),
				'AZ' => esc_html__( 'Arizona', 'tcb-merger' ),
				'AR' => esc_html__( 'Arkansas', 'tcb-merger' ),
				'CA' => esc_html__( 'California', 'tcb-merger' ),
				'CO' => esc_html__( 'Colorado', 'tcb-merger' ),
				'CT' => esc_html__( 'Connecticut', 'tcb-merger' ),
				'DE' => esc_html__( 'Delaware', 'tcb-merger' ),
				'DC' => esc_html__( 'District of Columbia', 'tcb-merger' ),
				'FL' => esc_html__( 'Florida', 'tcb-merger' ),
				'GA' => esc_html__( 'Georgia', 'tcb-merger' ),
				'HI' => esc_html__( 'Hawaii', 'tcb-merger' ),
				'ID' => esc_html__( 'Idaho', 'tcb-merger' ),
				'IL' => esc_html__( 'Illinois', 'tcb-merger' ),
				'IN' => esc_html__( 'Indiana', 'tcb-merger' ),
				'IA' => esc_html__( 'Iowa', 'tcb-merger' ),
				'KS' => esc_html__( 'Kansas', 'tcb-merger' ),
				'KY' => esc_html__( 'Kentucky', 'tcb-merger' ),
				'LA' => esc_html__( 'Louisiana', 'tcb-merger' ),
				'ME' => esc_html__( 'Maine', 'tcb-merger' ),
				'MD' => esc_html__( 'Maryland', 'tcb-merger' ),
				'MA' => esc_html__( 'Massachusetts', 'tcb-merger' ),
				'MI' => esc_html__( 'Michigan', 'tcb-merger' ),
				'MN' => esc_html__( 'Minnesota', 'tcb-merger' ),
				'MS' => esc_html__( 'Mississippi', 'tcb-merger' ),
				'MO' => esc_html__( 'Missouri', 'tcb-merger' ),
				'MT' => esc_html__( 'Montana', 'tcb-merger' ),
				'NE' => esc_html__( 'Nebraska', 'tcb-merger' ),
				'NV' => esc_html__( 'Nevada', 'tcb-merger' ),
				'NH' => esc_html__( 'New Hampshire', 'tcb-merger' ),
				'NJ' => esc_html__( 'New Jersey', 'tcb-merger' ),
				'NM' => esc_html__( 'New Mexico', 'tcb-merger' ),
				'NY' => esc_html__( 'New York', 'tcb-merger' ),
				'NC' => esc_html__( 'North Carolina', 'tcb-merger' ),
				'ND' => esc_html__( 'North Dakota', 'tcb-merger' ),
				'OH' => esc_html__( 'Ohio', 'tcb-merger' ),
				'OK' => esc_html__( 'Oklahoma', 'tcb-merger' ),
				'OR' => esc_html__( 'Oregon', 'tcb-merger' ),
				'PA' => esc_html__( 'Pennsylvania', 'tcb-merger' ),
				'RI' => esc_html__( 'Rhode Island', 'tcb-merger' ),
				'SC' => esc_html__( 'South Carolina', 'tcb-merger' ),
				'SD' => esc_html__( 'South Dakota', 'tcb-merger' ),
				'TN' => esc_html__( 'Tennessee', 'tcb-merger' ),
				'TX' => esc_html__( 'Texas', 'tcb-merger' ),
				'UT' => esc_html__( 'Utah', 'tcb-merger' ),
				'VT' => esc_html__( 'Vermont', 'tcb-merger' ),
				'VA' => esc_html__( 'Virginia', 'tcb-merger' ),
				'WA' => esc_html__( 'Washington', 'tcb-merger' ),
				'WV' => esc_html__( 'West Virginia', 'tcb-merger' ),
				'WI' => esc_html__( 'Wisconsin', 'tcb-merger' ),
				'WY' => esc_html__( 'Wyoming', 'tcb-merger' ),
				'AS' => esc_html__( 'American Samoa', 'tcb-merger' ),
				'AA' => esc_html__( 'Armed Forces America (except Canada)', 'tcb-merger' ),
				'AE' => esc_html__( 'Armed Forces Africa/Canada/Europe/Middle East', 'tcb-merger' ),
				'AP' => esc_html__( 'Armed Forces Pacific', 'tcb-merger' ),
				'FM' => esc_html__( 'Federated States of Micronesia', 'tcb-merger' ),
				'GU' => esc_html__( 'Guam', 'tcb-merger' ),
				'MH' => esc_html__( 'Marshall Islands', 'tcb-merger' ),
				'MP' => esc_html__( 'Northern Mariana Islands', 'tcb-merger' ),
				'PR' => esc_html__( 'Puerto Rico', 'tcb-merger' ),
				'PW' => esc_html__( 'Palau', 'tcb-merger' ),
				'VI' => esc_html__( 'Virgin Islands', 'tcb-merger' )
			),
			'description' 	=> esc_html__( '', 'tcb-merger' ),
			'label' 		=> esc_html__( 'State', 'tcb-merger' ),
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
				'AB' => esc_html__( 'Alberta', 'tcb-merger' ),
				'BC' => esc_html__( 'British Columbia', 'tcb-merger' ),
				'MB' => esc_html__( 'Manitoba', 'tcb-merger' ),
				'NB' => esc_html__( 'New Brunswick', 'tcb-merger' ),
				'NL' => esc_html__( 'Newfoundland and Labrador', 'tcb-merger' ),
				'NT' => esc_html__( 'Northwest Territories', 'tcb-merger' ),
				'NS' => esc_html__( 'Nova Scotia', 'tcb-merger' ),
				'NU' => esc_html__( 'Nunavut', 'tcb-merger' ),
				'ON' => esc_html__( 'Ontario', 'tcb-merger' ),
				'PE' => esc_html__( 'Prince Edward Island', 'tcb-merger' ),
				'QC' => esc_html__( 'Quebec', 'tcb-merger' ),
				'SK' => esc_html__( 'Saskatchewan', 'tcb-merger' ),
				'YT' => esc_html__( 'Yukon', 'tcb-merger' )
			),
			'description' 	=> esc_html__( '', 'tcb-merger' ),
			'label' 		=> esc_html__( 'State', 'tcb-merger' ),
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
				'ACT' 	=> esc_html__( 'Australian Capital Territory', 'tcb-merger' ),
				'NSW' 	=> esc_html__( 'New South Wales', 'tcb-merger' ),
				'NT' 	=> esc_html__( 'Northern Territory', 'tcb-merger' ),
				'QLD' 	=> esc_html__( 'Queensland', 'tcb-merger' ),
				'SA' 	=> esc_html__( 'South Australia', 'tcb-merger' ),
				'TAS' 	=> esc_html__( 'Tasmania', 'tcb-merger' ),
				'VIC' 	=> esc_html__( 'Victoria', 'tcb-merger' ),
				'WA' 	=> esc_html__( 'Western Australia', 'tcb-merger' )
			),
			'description' 	=> esc_html__( '', 'tcb-merger' ),
			'label' 		=> esc_html__( 'State', 'tcb-merger' ),
			'priority' 		=> 230,
			'section' 		=> 'contact_info',
			'settings' 		=> 'australia_state',
			'type' 			=> 'select'
		)
	);
	$wp_customize->get_setting( 'australia_state' )->transport = 'postMessage';


	*/

} // function_names_register_fields()

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
function function_names_generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {

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

} // function_names_generate_css()

/**
 * This will output the custom WordPress settings to the live theme's WP head.
 *
 * Used by hook: 'wp_head'
 *
 * @access 		public
 * @see 		add_action( 'wp_head', $func )
 * @since 		1.0.0
 */
function function_names_header_output() {

	?><!-- Customizer CSS -->
	<style type="text/css"><?php

		// pattern:
		// function_names_generate_css( 'selector', 'style', 'mod_name', 'prefix', 'postfix', true );
		//
		// background-image example:
		// function_names_generate_css( '.class', 'background-image', 'background_image_example', 'url(', ')' );


	?></style><!-- Customizer CSS --><?php

} // function_names_header_output()

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * Used by hook: 'customize_preview_init'
 *
 * @access 		public
 * @see 		add_action( 'customize_preview_init', $func )
 * @since 		1.0.0
 */
function function_names_live_preview() {

	wp_enqueue_script( 'function_names_customizer', get_template_directory_uri() . '/js/customizer.min.js', array( 'jquery', 'customize-preview' ), '', true );

} // function_names_live_preview()

/**
 * Used by customizer controls, mostly for active callbacks.
 *
 * @hook		customize_controls_enqueue_scripts
 *
 * @access 		public
 * @see 		add_action( 'customize_preview_init', $func )
 * @since 		1.0.0
 */
function function_names_control_scripts() {

	wp_enqueue_script( 'function_names_customizer_controls', get_template_directory_uri() . '/js/customizer-controls.min.js', array( 'jquery', 'customize-controls' ), false, true );

} // function_names_control_scripts()

/**
 * Returns TRUE based on which link type is selected, otherwise FALSE
 *
 * @param 	object 		$control 			The control object
 * @return 	bool 							TRUE if conditions are met, otherwise FALSE
 */
function function_names_states_of_country_callback( $control ) {

	$country_setting = $control->manager->get_setting('country')->value();

	//wp_die( print_r( $radio_setting ) );
	//wp_die( print_r( $control->id ) );

	if ( 'us_state' === $control->id && 'US' === $country_setting ) { return true; }
	if ( 'canada_state' === $control->id && 'CA' === $country_setting ) { return true; }
	if ( 'australia_state' === $control->id && 'AU' === $country_setting ) { return true; }
	if ( 'default_state' === $control->id && ! function_names_custom_countries( $country_setting ) ) { return true; }

	return false;

} // function_names_states_of_country_callback()

/**
 * Returns true if a country has a custom select menu
 *
 * @param 		string 		$country 			The country code to check
 *
 * @return 		bool 							TRUE if the code is in the array, FALSE otherwise
 */
function function_names_custom_countries( $country ) {

	$countries = array( 'US', 'CA', 'AU' );

	return in_array( $country, $countries );

} // function_names_custom_countries()


/**
 * Returns an array of countries or a country name.
 *
 * @param 		string 		$country 		Country code to return (optional)
 *
 * @return 		array|string 				Array of countries or a single country name
 */
function function_names_country_list( $country = '' ) {

	$countries = array();

	$countries['AF'] = esc_html__( 'Afghanistan (‫افغانستان‬‎)', 'tcb-merger' );
	$countries['AX'] = esc_html__( 'Åland Islands (Åland)', 'tcb-merger' );
	$countries['AL'] = esc_html__( 'Albania (Shqipëri)', 'tcb-merger' );
	$countries['DZ'] = esc_html__( 'Algeria (‫الجزائر‬‎)', 'tcb-merger' );
	$countries['AS'] = esc_html__( 'American Samoa', 'tcb-merger' );
	$countries['AD'] = esc_html__( 'Andorra', 'tcb-merger' );
	$countries['AO'] = esc_html__( 'Angola', 'tcb-merger' );
	$countries['AI'] = esc_html__( 'Anguilla', 'tcb-merger' );
	$countries['AQ'] = esc_html__( 'Antarctica', 'tcb-merger' );
	$countries['AG'] = esc_html__( 'Antigua and Barbuda', 'tcb-merger' );
	$countries['AR'] = esc_html__( 'Argentina', 'tcb-merger' );
	$countries['AM'] = esc_html__( 'Armenia (Հայաստան)', 'tcb-merger' );
	$countries['AW'] = esc_html__( 'Aruba', 'tcb-merger' );
	$countries['AC'] = esc_html__( 'Ascension Island', 'tcb-merger' );
	$countries['AU'] = esc_html__( 'Australia', 'tcb-merger' );
	$countries['AT'] = esc_html__( 'Austria (Österreich)', 'tcb-merger' );
	$countries['AZ'] = esc_html__( 'Azerbaijan (Azərbaycan)', 'tcb-merger' );
	$countries['BS'] = esc_html__( 'Bahamas', 'tcb-merger' );
	$countries['BH'] = esc_html__( 'Bahrain (‫البحرين‬‎)', 'tcb-merger' );
	$countries['BD'] = esc_html__( 'Bangladesh (বাংলাদেশ)', 'tcb-merger' );
	$countries['BB'] = esc_html__( 'Barbados', 'tcb-merger' );
	$countries['BY'] = esc_html__( 'Belarus (Беларусь)', 'tcb-merger' );
	$countries['BE'] = esc_html__( 'Belgium (België)', 'tcb-merger' );
	$countries['BZ'] = esc_html__( 'Belize', 'tcb-merger' );
	$countries['BJ'] = esc_html__( 'Benin (Bénin)', 'tcb-merger' );
	$countries['BM'] = esc_html__( 'Bermuda', 'tcb-merger' );
	$countries['BT'] = esc_html__( 'Bhutan (འབྲུག)', 'tcb-merger' );
	$countries['BO'] = esc_html__( 'Bolivia', 'tcb-merger' );
	$countries['BA'] = esc_html__( 'Bosnia and Herzegovina (Босна и Херцеговина)', 'tcb-merger' );
	$countries['BW'] = esc_html__( 'Botswana', 'tcb-merger' );
	$countries['BV'] = esc_html__( 'Bouvet Island', 'tcb-merger' );
	$countries['BR'] = esc_html__( 'Brazil (Brasil)', 'tcb-merger' );
	$countries['IO'] = esc_html__( 'British Indian Ocean Territory', 'tcb-merger' );
	$countries['VG'] = esc_html__( 'British Virgin Islands', 'tcb-merger' );
	$countries['BN'] = esc_html__( 'Brunei', 'tcb-merger' );
	$countries['BG'] = esc_html__( 'Bulgaria (България)', 'tcb-merger' );
	$countries['BF'] = esc_html__( 'Burkina Faso', 'tcb-merger' );
	$countries['BI'] = esc_html__( 'Burundi (Uburundi)', 'tcb-merger' );
	$countries['KH'] = esc_html__( 'Cambodia (កម្ពុជា)', 'tcb-merger' );
	$countries['CM'] = esc_html__( 'Cameroon (Cameroun)', 'tcb-merger' );
	$countries['CA'] = esc_html__( 'Canada', 'tcb-merger' );
	$countries['IC'] = esc_html__( 'Canary Islands (islas Canarias)', 'tcb-merger' );
	$countries['CV'] = esc_html__( 'Cape Verde (Kabu Verdi)', 'tcb-merger' );
	$countries['BQ'] = esc_html__( 'Caribbean Netherlands', 'tcb-merger' );
	$countries['KY'] = esc_html__( 'Cayman Islands', 'tcb-merger' );
	$countries['CF'] = esc_html__( 'Central African Republic (République centrafricaine)', 'tcb-merger' );
	$countries['EA'] = esc_html__( 'Ceuta and Melilla (Ceuta y Melilla)', 'tcb-merger' );
	$countries['TD'] = esc_html__( 'Chad (Tchad)', 'tcb-merger' );
	$countries['CL'] = esc_html__( 'Chile', 'tcb-merger' );
	$countries['CN'] = esc_html__( 'China (中国)', 'tcb-merger' );
	$countries['CX'] = esc_html__( 'Christmas Island', 'tcb-merger' );
	$countries['CP'] = esc_html__( 'Clipperton Island', 'tcb-merger' );
	$countries['CC'] = esc_html__( 'Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))', 'tcb-merger' );
	$countries['CO'] = esc_html__( 'Colombia', 'tcb-merger' );
	$countries['KM'] = esc_html__( 'Comoros (‫جزر القمر‬‎)', 'tcb-merger' );
	$countries['CD'] = esc_html__( 'Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)', 'tcb-merger' );
	$countries['CG'] = esc_html__( 'Congo (Republic) (Congo-Brazzaville)', 'tcb-merger' );
	$countries['CK'] = esc_html__( 'Cook Islands', 'tcb-merger' );
	$countries['CR'] = esc_html__( 'Costa Rica', 'tcb-merger' );
	$countries['CI'] = esc_html__( 'Côte d’Ivoire', 'tcb-merger' );
	$countries['HR'] = esc_html__( 'Croatia (Hrvatska)', 'tcb-merger' );
	$countries['CU'] = esc_html__( 'Cuba', 'tcb-merger' );
	$countries['CW'] = esc_html__( 'Curaçao', 'tcb-merger' );
	$countries['CY'] = esc_html__( 'Cyprus (Κύπρος)', 'tcb-merger' );
	$countries['CZ'] = esc_html__( 'Czech Republic (Česká republika)', 'tcb-merger' );
	$countries['DK'] = esc_html__( 'Denmark (Danmark)', 'tcb-merger' );
	$countries['DG'] = esc_html__( 'Diego Garcia', 'tcb-merger' );
	$countries['DJ'] = esc_html__( 'Djibouti', 'tcb-merger' );
	$countries['DM'] = esc_html__( 'Dominica', 'tcb-merger' );
	$countries['DO'] = esc_html__( 'Dominican Republic (República Dominicana)', 'tcb-merger' );
	$countries['EC'] = esc_html__( 'Ecuador', 'tcb-merger' );
	$countries['EG'] = esc_html__( 'Egypt (‫مصر‬‎)', 'tcb-merger' );
	$countries['SV'] = esc_html__( 'El Salvador', 'tcb-merger' );
	$countries['GQ'] = esc_html__( 'Equatorial Guinea (Guinea Ecuatorial)', 'tcb-merger' );
	$countries['ER'] = esc_html__( 'Eritrea', 'tcb-merger' );
	$countries['EE'] = esc_html__( 'Estonia (Eesti)', 'tcb-merger' );
	$countries['ET'] = esc_html__( 'Ethiopia', 'tcb-merger' );
	$countries['FK'] = esc_html__( 'Falkland Islands (Islas Malvinas)', 'tcb-merger' );
	$countries['FO'] = esc_html__( 'Faroe Islands (Føroyar)', 'tcb-merger' );
	$countries['FJ'] = esc_html__( 'Fiji', 'tcb-merger' );
	$countries['FI'] = esc_html__( 'Finland (Suomi)', 'tcb-merger' );
	$countries['FR'] = esc_html__( 'France', 'tcb-merger' );
	$countries['GF'] = esc_html__( 'French Guiana (Guyane française)', 'tcb-merger' );
	$countries['PF'] = esc_html__( 'French Polynesia (Polynésie française)', 'tcb-merger' );
	$countries['TF'] = esc_html__( 'French Southern Territories (Terres australes françaises)', 'tcb-merger' );
	$countries['GA'] = esc_html__( 'Gabon', 'tcb-merger' );
	$countries['GM'] = esc_html__( 'Gambia', 'tcb-merger' );
	$countries['GE'] = esc_html__( 'Georgia (საქართველო)', 'tcb-merger' );
	$countries['DE'] = esc_html__( 'Germany (Deutschland)', 'tcb-merger' );
	$countries['GH'] = esc_html__( 'Ghana (Gaana)', 'tcb-merger' );
	$countries['GI'] = esc_html__( 'Gibraltar', 'tcb-merger' );
	$countries['GR'] = esc_html__( 'Greece (Ελλάδα)', 'tcb-merger' );
	$countries['GL'] = esc_html__( 'Greenland (Kalaallit Nunaat)', 'tcb-merger' );
	$countries['GD'] = esc_html__( 'Grenada', 'tcb-merger' );
	$countries['GP'] = esc_html__( 'Guadeloupe', 'tcb-merger' );
	$countries['GU'] = esc_html__( 'Guam', 'tcb-merger' );
	$countries['GT'] = esc_html__( 'Guatemala', 'tcb-merger' );
	$countries['GG'] = esc_html__( 'Guernsey', 'tcb-merger' );
	$countries['GN'] = esc_html__( 'Guinea (Guinée)', 'tcb-merger' );
	$countries['GW'] = esc_html__( 'Guinea-Bissau (Guiné Bissau)', 'tcb-merger' );
	$countries['GY'] = esc_html__( 'Guyana', 'tcb-merger' );
	$countries['HT'] = esc_html__( 'Haiti', 'tcb-merger' );
	$countries['HM'] = esc_html__( 'Heard & McDonald Islands', 'tcb-merger' );
	$countries['HN'] = esc_html__( 'Honduras', 'tcb-merger' );
	$countries['HK'] = esc_html__( 'Hong Kong (香港)', 'tcb-merger' );
	$countries['HU'] = esc_html__( 'Hungary (Magyarország)', 'tcb-merger' );
	$countries['IS'] = esc_html__( 'Iceland (Ísland)', 'tcb-merger' );
	$countries['IN'] = esc_html__( 'India (भारत)', 'tcb-merger' );
	$countries['ID'] = esc_html__( 'Indonesia', 'tcb-merger' );
	$countries['IR'] = esc_html__( 'Iran (‫ایران‬‎)', 'tcb-merger' );
	$countries['IQ'] = esc_html__( 'Iraq (‫العراق‬‎)', 'tcb-merger' );
	$countries['IE'] = esc_html__( 'Ireland', 'tcb-merger' );
	$countries['IM'] = esc_html__( 'Isle of Man', 'tcb-merger' );
	$countries['IL'] = esc_html__( 'Israel (‫ישראל‬‎)', 'tcb-merger' );
	$countries['IT'] = esc_html__( 'Italy (Italia)', 'tcb-merger' );
	$countries['JM'] = esc_html__( 'Jamaica', 'tcb-merger' );
	$countries['JP'] = esc_html__( 'Japan (日本)', 'tcb-merger' );
	$countries['JE'] = esc_html__( 'Jersey', 'tcb-merger' );
	$countries['JO'] = esc_html__( 'Jordan (‫الأردن‬‎)', 'tcb-merger' );
	$countries['KZ'] = esc_html__( 'Kazakhstan (Казахстан)', 'tcb-merger' );
	$countries['KE'] = esc_html__( 'Kenya', 'tcb-merger' );
	$countries['KI'] = esc_html__( 'Kiribati', 'tcb-merger' );
	$countries['XK'] = esc_html__( 'Kosovo (Kosovë)', 'tcb-merger' );
	$countries['KW'] = esc_html__( 'Kuwait (‫الكويت‬‎)', 'tcb-merger' );
	$countries['KG'] = esc_html__( 'Kyrgyzstan (Кыргызстан)', 'tcb-merger' );
	$countries['LA'] = esc_html__( 'Laos (ລາວ)', 'tcb-merger' );
	$countries['LV'] = esc_html__( 'Latvia (Latvija)', 'tcb-merger' );
	$countries['LB'] = esc_html__( 'Lebanon (‫لبنان‬‎)', 'tcb-merger' );
	$countries['LS'] = esc_html__( 'Lesotho', 'tcb-merger' );
	$countries['LR'] = esc_html__( 'Liberia', 'tcb-merger' );
	$countries['LY'] = esc_html__( 'Libya (‫ليبيا‬‎)', 'tcb-merger' );
	$countries['LI'] = esc_html__( 'Liechtenstein', 'tcb-merger' );
	$countries['LT'] = esc_html__( 'Lithuania (Lietuva)', 'tcb-merger' );
	$countries['LU'] = esc_html__( 'Luxembourg', 'tcb-merger' );
	$countries['MO'] = esc_html__( 'Macau (澳門)', 'tcb-merger' );
	$countries['MK'] = esc_html__( 'Macedonia (FYROM) (Македонија)', 'tcb-merger' );
	$countries['MG'] = esc_html__( 'Madagascar (Madagasikara)', 'tcb-merger' );
	$countries['MW'] = esc_html__( 'Malawi', 'tcb-merger' );
	$countries['MY'] = esc_html__( 'Malaysia', 'tcb-merger' );
	$countries['MV'] = esc_html__( 'Maldives', 'tcb-merger' );
	$countries['ML'] = esc_html__( 'Mali', 'tcb-merger' );
	$countries['MT'] = esc_html__( 'Malta', 'tcb-merger' );
	$countries['MH'] = esc_html__( 'Marshall Islands', 'tcb-merger' );
	$countries['MQ'] = esc_html__( 'Martinique', 'tcb-merger' );
	$countries['MR'] = esc_html__( 'Mauritania (‫موريتانيا‬‎)', 'tcb-merger' );
	$countries['MU'] = esc_html__( 'Mauritius (Moris)', 'tcb-merger' );
	$countries['YT'] = esc_html__( 'Mayotte', 'tcb-merger' );
	$countries['MX'] = esc_html__( 'Mexico (México)', 'tcb-merger' );
	$countries['FM'] = esc_html__( 'Micronesia', 'tcb-merger' );
	$countries['MD'] = esc_html__( 'Moldova (Republica Moldova)', 'tcb-merger' );
	$countries['MC'] = esc_html__( 'Monaco', 'tcb-merger' );
	$countries['MN'] = esc_html__( 'Mongolia (Монгол)', 'tcb-merger' );
	$countries['ME'] = esc_html__( 'Montenegro (Crna Gora)', 'tcb-merger' );
	$countries['MS'] = esc_html__( 'Montserrat', 'tcb-merger' );
	$countries['MA'] = esc_html__( 'Morocco (‫المغرب‬‎)', 'tcb-merger' );
	$countries['MZ'] = esc_html__( 'Mozambique (Moçambique)', 'tcb-merger' );
	$countries['MM'] = esc_html__( 'Myanmar (Burma) (မြန်မာ)', 'tcb-merger' );
	$countries['NA'] = esc_html__( 'Namibia (Namibië)', 'tcb-merger' );
	$countries['NR'] = esc_html__( 'Nauru', 'tcb-merger' );
	$countries['NP'] = esc_html__( 'Nepal (नेपाल)', 'tcb-merger' );
	$countries['NL'] = esc_html__( 'Netherlands (Nederland)', 'tcb-merger' );
	$countries['NC'] = esc_html__( 'New Caledonia (Nouvelle-Calédonie)', 'tcb-merger' );
	$countries['NZ'] = esc_html__( 'New Zealand', 'tcb-merger' );
	$countries['NI'] = esc_html__( 'Nicaragua', 'tcb-merger' );
	$countries['NE'] = esc_html__( 'Niger (Nijar)', 'tcb-merger' );
	$countries['NG'] = esc_html__( 'Nigeria', 'tcb-merger' );
	$countries['NU'] = esc_html__( 'Niue', 'tcb-merger' );
	$countries['NF'] = esc_html__( 'Norfolk Island', 'tcb-merger' );
	$countries['MP'] = esc_html__( 'Northern Mariana Islands', 'tcb-merger' );
	$countries['KP'] = esc_html__( 'North Korea (조선 민주주의 인민 공화국)', 'tcb-merger' );
	$countries['NO'] = esc_html__( 'Norway (Norge)', 'tcb-merger' );
	$countries['OM'] = esc_html__( 'Oman (‫عُمان‬‎)', 'tcb-merger' );
	$countries['PK'] = esc_html__( 'Pakistan (‫پاکستان‬‎)', 'tcb-merger' );
	$countries['PW'] = esc_html__( 'Palau', 'tcb-merger' );
	$countries['PS'] = esc_html__( 'Palestine (‫فلسطين‬‎)', 'tcb-merger' );
	$countries['PA'] = esc_html__( 'Panama (Panamá)', 'tcb-merger' );
	$countries['PG'] = esc_html__( 'Papua New Guinea', 'tcb-merger' );
	$countries['PY'] = esc_html__( 'Paraguay', 'tcb-merger' );
	$countries['PE'] = esc_html__( 'Peru (Perú)', 'tcb-merger' );
	$countries['PH'] = esc_html__( 'Philippines', 'tcb-merger' );
	$countries['PN'] = esc_html__( 'Pitcairn Islands', 'tcb-merger' );
	$countries['PL'] = esc_html__( 'Poland (Polska)', 'tcb-merger' );
	$countries['PT'] = esc_html__( 'Portugal', 'tcb-merger' );
	$countries['PR'] = esc_html__( 'Puerto Rico', 'tcb-merger' );
	$countries['QA'] = esc_html__( 'Qatar (‫قطر‬‎)', 'tcb-merger' );
	$countries['RE'] = esc_html__( 'Réunion (La Réunion)', 'tcb-merger' );
	$countries['RO'] = esc_html__( 'Romania (România)', 'tcb-merger' );
	$countries['RU'] = esc_html__( 'Russia (Россия)', 'tcb-merger' );
	$countries['RW'] = esc_html__( 'Rwanda', 'tcb-merger' );
	$countries['BL'] = esc_html__( 'Saint Barthélemy (Saint-Barthélemy)', 'tcb-merger' );
	$countries['SH'] = esc_html__( 'Saint Helena', 'tcb-merger' );
	$countries['KN'] = esc_html__( 'Saint Kitts and Nevis', 'tcb-merger' );
	$countries['LC'] = esc_html__( 'Saint Lucia', 'tcb-merger' );
	$countries['MF'] = esc_html__( 'Saint Martin (Saint-Martin (partie française))', 'tcb-merger' );
	$countries['PM'] = esc_html__( 'Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)', 'tcb-merger' );
	$countries['WS'] = esc_html__( 'Samoa', 'tcb-merger' );
	$countries['SM'] = esc_html__( 'San Marino', 'tcb-merger' );
	$countries['ST'] = esc_html__( 'São Tomé and Príncipe (São Tomé e Príncipe)', 'tcb-merger' );
	$countries['SA'] = esc_html__( 'Saudi Arabia (‫المملكة العربية السعودية‬‎)', 'tcb-merger' );
	$countries['SN'] = esc_html__( 'Senegal (Sénégal)', 'tcb-merger' );
	$countries['RS'] = esc_html__( 'Serbia (Србија)', 'tcb-merger' );
	$countries['SC'] = esc_html__( 'Seychelles', 'tcb-merger' );
	$countries['SL'] = esc_html__( 'Sierra Leone', 'tcb-merger' );
	$countries['SG'] = esc_html__( 'Singapore', 'tcb-merger' );
	$countries['SX'] = esc_html__( 'Sint Maarten', 'tcb-merger' );
	$countries['SK'] = esc_html__( 'Slovakia (Slovensko)', 'tcb-merger' );
	$countries['SI'] = esc_html__( 'Slovenia (Slovenija)', 'tcb-merger' );
	$countries['SB'] = esc_html__( 'Solomon Islands', 'tcb-merger' );
	$countries['SO'] = esc_html__( 'Somalia (Soomaaliya)', 'tcb-merger' );
	$countries['ZA'] = esc_html__( 'South Africa', 'tcb-merger' );
	$countries['GS'] = esc_html__( 'South Georgia & South Sandwich Islands', 'tcb-merger' );
	$countries['KR'] = esc_html__( 'South Korea (대한민국)', 'tcb-merger' );
	$countries['SS'] = esc_html__( 'South Sudan (‫جنوب السودان‬‎)', 'tcb-merger' );
	$countries['ES'] = esc_html__( 'Spain (España)', 'tcb-merger' );
	$countries['LK'] = esc_html__( 'Sri Lanka (ශ්‍රී ලංකාව)', 'tcb-merger' );
	$countries['VC'] = esc_html__( 'St. Vincent & Grenadines', 'tcb-merger' );
	$countries['SD'] = esc_html__( 'Sudan (‫السودان‬‎)', 'tcb-merger' );
	$countries['SR'] = esc_html__( 'Suriname', 'tcb-merger' );
	$countries['SJ'] = esc_html__( 'Svalbard and Jan Mayen (Svalbard og Jan Mayen)', 'tcb-merger' );
	$countries['SZ'] = esc_html__( 'Swaziland', 'tcb-merger' );
	$countries['SE'] = esc_html__( 'Sweden (Sverige)', 'tcb-merger' );
	$countries['CH'] = esc_html__( 'Switzerland (Schweiz)', 'tcb-merger' );
	$countries['SY'] = esc_html__( 'Syria (‫سوريا‬‎)', 'tcb-merger' );
	$countries['TW'] = esc_html__( 'Taiwan (台灣)', 'tcb-merger' );
	$countries['TJ'] = esc_html__( 'Tajikistan', 'tcb-merger' );
	$countries['TZ'] = esc_html__( 'Tanzania', 'tcb-merger' );
	$countries['TH'] = esc_html__( 'Thailand (ไทย)', 'tcb-merger' );
	$countries['TL'] = esc_html__( 'Timor-Leste', 'tcb-merger' );
	$countries['TG'] = esc_html__( 'Togo', 'tcb-merger' );
	$countries['TK'] = esc_html__( 'Tokelau', 'tcb-merger' );
	$countries['TO'] = esc_html__( 'Tonga', 'tcb-merger' );
	$countries['TT'] = esc_html__( 'Trinidad and Tobago', 'tcb-merger' );
	$countries['TA'] = esc_html__( 'Tristan da Cunha', 'tcb-merger' );
	$countries['TN'] = esc_html__( 'Tunisia (‫تونس‬‎)', 'tcb-merger' );
	$countries['TR'] = esc_html__( 'Turkey (Türkiye)', 'tcb-merger' );
	$countries['TM'] = esc_html__( 'Turkmenistan', 'tcb-merger' );
	$countries['TC'] = esc_html__( 'Turks and Caicos Islands', 'tcb-merger' );
	$countries['TV'] = esc_html__( 'Tuvalu', 'tcb-merger' );
	$countries['UM'] = esc_html__( 'U.S. Outlying Islands', 'tcb-merger' );
	$countries['VI'] = esc_html__( 'U.S. Virgin Islands', 'tcb-merger' );
	$countries['UG'] = esc_html__( 'Uganda', 'tcb-merger' );
	$countries['UA'] = esc_html__( 'Ukraine (Україна)', 'tcb-merger' );
	$countries['AE'] = esc_html__( 'United Arab Emirates (‫الإمارات العربية المتحدة‬‎)', 'tcb-merger' );
	$countries['GB'] = esc_html__( 'United Kingdom', 'tcb-merger' );
	$countries['US'] = esc_html__( 'United States', 'tcb-merger' );
	$countries['UY'] = esc_html__( 'Uruguay', 'tcb-merger' );
	$countries['UZ'] = esc_html__( 'Uzbekistan (Oʻzbekiston)', 'tcb-merger' );
	$countries['VU'] = esc_html__( 'Vanuatu', 'tcb-merger' );
	$countries['VA'] = esc_html__( 'Vatican City (Città del Vaticano)', 'tcb-merger' );
	$countries['VE'] = esc_html__( 'Venezuela', 'tcb-merger' );
	$countries['VN'] = esc_html__( 'Vietnam (Việt Nam)', 'tcb-merger' );
	$countries['WF'] = esc_html__( 'Wallis and Futuna', 'tcb-merger' );
	$countries['EH'] = esc_html__( 'Western Sahara (‫الصحراء الغربية‬‎)', 'tcb-merger' );
	$countries['YE'] = esc_html__( 'Yemen (‫اليمن‬‎)', 'tcb-merger' );
	$countries['ZM'] = esc_html__( 'Zambia', 'tcb-merger' );
	$countries['ZW'] = esc_html__( 'Zimbabwe', 'tcb-merger' );

	if ( ! empty( $country ) ) {

		return $countries[$country];

	}

	return $countries;

} // function_names_country_list()

