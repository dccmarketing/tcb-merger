<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Edge_Merger
 */

//$fields = get_fields();
$fields = get_theme_mods();

?><article id="post-<?php the_ID(); ?>" <?php post_class( array( 'row', 'merger-home' ) ); ?>><?php

	do_action( 'tha_entry_top' );

	do_action( 'tha_entry_content_before' );

	?><div class="entry-content"><?php

		/**
		 * The entry_content hook
		 *
		 * @hooked 		logo2 				10
		 * @hooked 		page_content 		15
		 */
		do_action( 'entry_content', $fields );

	?></div><!-- .entry-content -->
	<div class="entry-buttons"><?php

		/**
		 * The entry_buttons hook
		 *
		 * @hooked 		banking_link		10
		 * @hooked 		tcb_link 			15
		 */
		do_action( 'entry_buttons', $fields );

	?></div><?php

	do_action( 'tha_entry_content_after' );

	do_action( 'tha_entry_bottom' );

?></article><!-- #post-## -->