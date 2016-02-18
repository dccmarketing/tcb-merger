<?php
/**
 * WordPress.com-specific functions and definitions.
 *
 * This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package DocBlock
 */

/**
 * Adds support for wp.com-specific theme functions.
 *
 * @global array $themecolors
 */
function edge_merger_wpcom_setup() {

	global $themecolors;

	// Set theme colors for third party services.
	if ( ! isset( $themecolors ) ) {

		$themecolors = array(
			'bg'     => '',
			'border' => '',
			'text'   => '',
			'link'   => '',
			'url'    => '',
		);

	}

} // edge_merger_wpcom_setup()
add_action( 'after_setup_theme', 'edge_merger_wpcom_setup' );
