<?php

/**
 * A class of helpful theme functions
 *
 * @package Edge_Merger
 * @author Slushman <chris@slushman.com>
 */
class edge_merger_Actions_and_Filters {

	/**
	 * Constructor
	 */
	public function __construct() {

		$this->loader();

	} // __construct()

	/**
	 * Loads all filter and action calls
	 */
	private function loader() {


		add_action( 'wp_enqueue_scripts', 	array( $this, 'public_scripts_and_styles' ) );
		add_filter( 'body_class', 			array( $this, 'page_body_classes' ) );
		add_action( 'init', 				array( $this, 'disable_emojis' ) );

	} // loader()

	/**
	 * Removes WordPress emoji support everywhere
	 */
	function disable_emojis() {

		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	} // disable_emojis()

	/**
	 * Properly encode a font URLs to enqueue a Google font
	 *
	 * @return 	mixed 		A properly formatted, translated URL for a Google font
	 */
	public static function fonts_url() {

		$return 	= '';
		$families 	= '';
		$fonts[] 	= array( 'font' => 'Oswald', 'weights' => '400,700', 'translate' => esc_html_x( 'on', 'Oswald font: on or off', 'edge-merger' ) );

		foreach ( $fonts as $font ) {

			if ( 'off' == $font['translate'] ) { continue; }

			$families[] = $font['font'] . ':' . $font['weights'];

		}

		if ( ! empty( $families ) ) {

			$query_args['family'] 	= urlencode( implode( '|', $families ) );
			$query_args['subset'] 	= urlencode( 'latin,latin-ext' );
			$return 				= add_query_arg( $query_args, '//fonts.googleapis.com/css' );

		}

		return $return;

	} // fonts_url()

	/**
	 * Adds classes to the body tag.
	 *
	 * @global 	$post						The $post object
	 *
	 * @param 	array 		$classes 		Classes for the body element.
	 *
	 * @return 	array 						The modified body class array
	 */
	public function page_body_classes( $classes ) {

		global $post;

		if ( empty( $post->post_content ) ) {

			$classes[] = 'content-none';

		} else {

			$classes[] = $post->post_name;

		}

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {

			$classes[] = 'group-blog';

		}

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {

			$classes[] = 'hfeed';

		}

		return $classes;

	} // page_body_classes()

	/**
	 * Enqueue scripts and styles.
	 */
	public function public_scripts_and_styles() {

		wp_enqueue_style( 'edge-merger-style', get_stylesheet_uri() );
		wp_enqueue_style( 'dashicons' );
		wp_enqueue_style( 'gridly', 'https://cdnjs.cloudflare.com/ajax/libs/gridly/1.1.0/gridly.min.css', array(), null, true );
		wp_enqueue_style( 'edge-merger-fonts', $this->fonts_url(), array(), null );

	} // public_scripts_and_styles()

} // class

/**
 * Make an instance so its ready to be used
 */
$edge_merger_actions_and_filters = new edge_merger_Actions_and_Filters();


