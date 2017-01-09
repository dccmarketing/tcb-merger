<?php

/**
 * A class of methods using hooks in the theme.
 *
 * @package Edge_Merger
 * @author Slushman <chris@slushman.com>
 */
class edge_merger_Themehooks {

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

		add_action( 'tha_header_top', 					array( $this, 'header_wrap_start' ), 10 );
		add_action( 'tha_header_top', 					array( $this, 'site_branding_start' ), 15 );

		add_action( 'edge_merger_header_content', 		array( $this, 'site_title' ), 10 );
		add_action( 'edge_merger_header_content', 		array( $this, 'merged_logos' ), 15 );

		add_action( 'tha_header_bottom', 				array( $this, 'site_branding_end' ), 85 );
		add_action( 'tha_header_bottom', 				array( $this, 'header_wrap_end' ), 90 );

		add_action( 'tha_body_top', 					array( $this, 'analytics_code' ), 10 );
		add_action( 'tha_body_top', 					array( $this, 'add_hidden_search' ), 15 );
		add_action( 'tha_body_top', 					array( $this, 'skip_link' ), 20 );

		add_action( 'entry_content', 					array( $this, 'logo2' ), 10 );
		add_action( 'entry_content', 					array( $this, 'bold_content' ), 15, 1 );
		//add_action( 'entry_content', 					array( $this, 'pen_spacer' ), 20 );
		add_action( 'entry_content', 					array( $this, 'page_content' ), 25, 1 );
		add_action( 'entry_content', 					array( $this, 'signature' ), 30 );

		//add_action( 'entry_buttons', 					array( $this, 'banking_link' ), 10, 1 );
		//add_action( 'entry_buttons', 					array( $this, 'tcb_link' ), 15, 1 );
		add_action( 'entry_buttons', 					array( $this, 'arrow1' ), 10, 1 );
		add_action( 'entry_buttons', 					array( $this, 'arrow2' ), 15, 1 );

		add_action( 'edge_merger_footer_content', 		array( $this, 'footer_content' ) );

		add_action( 'edge_merger_404_before', 			array( $this, 'four_04_title' ), 10 );

		add_action( 'edge_merger_404_content', 			array( $this, 'add_search' ), 10 );
		add_action( 'edge_merger_404_content', 			array( $this, 'four_04_posts_widget' ), 15 );
		add_action( 'edge_merger_404_content', 			array( $this, 'four_04_categories' ), 20 );
		add_action( 'edge_merger_404_content', 			array( $this, 'four_04_archives' ), 25 );
		add_action( 'edge_merger_404_content', 			array( $this, 'four_04_tag_cloud' ), 30 );

	} // loader()

	/**
	 * Adds a hidden search field
	 *
	 * @hooked 		tha_body_top 		15
	 *
	 * @return 		mixed 				The HTML markup for a search field
	 */
	public function add_hidden_search() {

		?><div aria-hidden="true" class="hidden-search-top" id="hidden-search-top">
			<div class="wrap"><?php

			get_search_form();

			?></div>
		</div><?php

	} // add_hidden_search()

	/**
	 * Adds a search form
	 *
	 * @hooked 		edge_merger_404_content 		15
	 *
	 * @return 		mixed 		Search form markup
	 */
	public function add_search() {

		get_search_form();

	} // add_search()

	/**
	 * Inserts Google Tag manager code after body tag
	 *
	 * @hooked 		tha_body_top 		10
	 *
	 * @return 		mixed 				The inserted Google Tag Manager code
	 */
	public function analytics_code() {

		$tag = get_theme_mod( 'tag_manager' );

		if ( ! empty( $tag ) ) {

			echo $tag;

		}

	} // analytics_code()

	/**
	 * Adds the page title to an archive page
	 *
	 * @hooked 		tha_content_while_before
	 *
	 * @return 		mixed 							The archive page title
	 */
	public function archive_title() {

		if ( ! is_archive() ) { return; }

		?><header class="page-header"><?php

			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );

		?></header><!-- .page-header --><?php

	} // archive_title()

	/**
	 * Adds the TCB arrow link
	 *
	 * @param 		array 		$fields 			The ACF fields
	 *
	 * @return 		mixed 							HTML markup for the TCB arrow
	 */
	public function arrow1( $fields ) {

		if ( ! is_front_page() ) { return; }

		if ( ! empty( $fields['arrow1_link_text'] ) ) {

			?><div class="btn">
				<a href="<?php echo esc_url( $fields['arrow1_url'] ); ?>" id="arrow1_text" target="_blank"><?php

					esc_html_e( $fields['arrow1_link_text'] );

				?><span class="dashicons dashicons-arrow-right"></span></a>
			</div><?php

		}

	} // arrow1()

	/**
	 * Adds the TCB arrow link
	 *
	 * @param 		array 		$fields 			The ACF fields
	 *
	 * @return 		mixed 							HTML markup for the TCB arrow
	 */
	public function arrow2( $fields ) {

		if ( ! is_front_page() ) { return; }

		if ( ! empty( $fields['arrow2_link_text'] ) ) {

			?><div class="btn">
				<a href="<?php echo esc_url( $fields['arrow2_url'] ); ?>" id="arrow_text" target="_blank"><?php

					esc_html_e( $fields['arrow2_link_text'] );

				?><span class="dashicons dashicons-arrow-right"></span></a>
			</div><?php

		}

	} // arrow2()

	/**
	 * Adds the bold content block
	 *
	 * @return 		mixed 			HTML markup
	 */
	public function bold_content( $fields ) {

		?><div class="bold-content"><?php

			echo apply_filters( 'the_content', $fields['bold_content'] );

		?></div><!-- .bold-content --><?php

	} // bold_content()

	/**
	 * Adds the copyright and credits to the footer content.
	 *
	 * @hooked 		edge_merger_footer_content
	 *
	 * @return 		mixed 									The footer markup
	 */
	public function footer_content() {

		if ( ! is_front_page() ) { return; }

		?><div class="wrap wrap-footer">
			<div class="container row">
				<div class="fdic">
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/EHL-and-FDIC-Logos-mini.png' ) ?>">
				</div>
				<div class="col">
					<div class="row addresses">
						<div>
							#10 Terra Verde<br>
							Edwardsville, IL 62025<br>
							Phone: <a href="tel:6186590991">(618) 659-0991</a><br>
							Fax: (618) 659-0768
						</div>
						<div>
							1604 West Morton Avenue<br>
							Jacksonville, IL 62650<br>
							Phone: <a href="tel:2172430660">(217) 243-0660</a><br>
							Fax: (217) 245-7057
						</div>
						<div>
							203 S. Miller St.<br>
							Waverly, IL 62692<br>
							Phone: <a href="tel:2174353000">(217) 435-3000</a><br>
							Fax: (217) 435-3333
						</div>
						<div>
							300 Third Avenue North<br>
							White Hall, IL 62092<br>
							Phone: <a href="tel:2173742233">(217) 374-2233</a><br>
							Fax: (217) 374-6728
						</div>
					</div>
					<div class="site-info">
						<p>&copy <?php echo date( 'Y' ); ?>  Town and Country Financial Corporation. All Rights Reserved.<br>
						An Illinois State chartered banking organization.<br>
						<a href="<?php echo esc_url( 'http://townandcountrybank.com/sites/default/files/u14/December2013Final.pdf' ); ?>" target="_blank">Financial Privacy Disclosure</a> | <a href="<?php echo esc_url( 'http://townandcountrybank.com/webform/financial-privacy-opt-out-form' ); ?>" target="_blank">Financial Privacy Opt-Out Form</a> | <a href="<?php echo esc_url( 'http://townandcountrybank.com/disclosures' ); ?>" target="_blank">Other Disclosures</a></p>

						<p>Town and Country Bank is regulated by the Federal Reserve Bank of Chicago. For accolades or complaints, please contact the Federal Reserve Bank directly. Please also send us a copy to: Customer Relations Officer, 3601 Wabash Ave. Springfield, Illinois, 62711.</p>
						<p>If there is no sensitive customer information you can send to the following email address: <a href="mailto:customerrelations@townandcountrybank.com">customerrelations@townandcountrybank.com</a></p>
						<p>Please note that Investments are not a deposit, not FDIC Insured, not insured by any federal government agency, not guaranteed by the bank and may go down in value.</p>
						<p>Questions? Call <a href="tel:8667703100">866.770.3100</a> to reach our Solution Center to be connected to any of our branches.</p>
					</div><!-- .site-info -->
				</div>
			</div><!-- .container -->
		</div><!-- .wrap-footer --><?php

	} // footer_content()

	/**
	 * Adds the  to the 404 page content.
	 *
	 * @hooked 		edge_merger_404_content		25
	 *
	 * @return 		mixed 							Markup for the archives
	 */
	public function four_04_archives() {

		/* translators: %1$s: smiley */
		$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'edge-merger' ), convert_smilies( ':)' ) ) . '</p>';

		the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

	} // four_04_archives()

	/**
	 * Adds the  to the 404 page content.
	 *
	 * @hooked 		edge_merger_404_content		20
	 *
	 * @return 		mixed 							The categories widget
	 */
	public function four_04_categories() {

		if ( ! edge_merger_categorized_blog() ) { return; }

		?><div class="widget widget_categories">
			<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'edge-merger' ); ?></h2>
			<ul><?php

				wp_list_categories( array(
					'orderby'    => 'count',
					'order'      => 'DESC',
					'show_count' => 1,
					'title_li'   => '',
					'number'     => 10,
				) );

			?></ul>
		</div><!-- .widget --><?php

	} // four_04_categories()

	/**
	 * Adds the Recent Posts widget to the 404 page.
	 *
	 * @hooked 		edge_merger_404_content 		15
	 *
	 * @return 		mixed 							The Recent Posts widget
	 */
	public function four_04_posts_widget() {

		the_widget( 'WP_Widget_Recent_Posts' );

	} // four_04_posts_widget()

	/**
	 * Adds the  to the 404 page content.
	 *
	 * @hooked 		edge_merger_404_content		30
	 *
	 * @return 		mixed 							The tag cloud widget
	 */
	public function four_04_tag_cloud() {

		the_widget( 'WP_Widget_Tag_Cloud' );

	} // four_04_tag_cloud()

	/**
	 * The 404 page title markup
	 *
	 * @hooked 		edge_merger_404_content 		10
	 *
	 * @return 		mixed 							The 440 page title
	 */
	public function four_04_title() {

		if ( ! is_404() ) { return; }

		?><header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'edge-merger' ); ?></h1>
		</header><!-- .page-header -->
		<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'edge-merger' ); ?></p><?php

	} // four_04_title()

	/**
	 * The header wrap markup
	 *
	 * @hooked  	tha_header_bottom 		90
	 *
	 * @return 		mixed 					The header wrap markup
	 */
	public function header_wrap_end() {

		?></div><!-- .wrap-header --><?php

	} // header_wrap_end()

	/**
	 * The header wrap markup
	 *
	 * @hooked 		tha_header_top 		10
	 *
	 * @return 		mixed 				The header wrap markup
	 */
	public function header_wrap_start() {

		?><div class="wrap wrap-header"><?php

	} // header_wrap_start()

	/**
	 * Adds the second logo markup
	 *
	 * @return 		mixed 		HTML markup
	 */
	public function logo2() {

		?><img class="logo2" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/logo2.png' ); ?>" alt="logo2" width="203" height="75" /><?php

	} // logo2()

	/**
	 * Logos of all merged banks
	 *
	 * @return 		mixed 			HTML markup
	 */
	public function merged_logos() {

		?><p class="merged-logos">
			<img class="merged" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/merged.jpg' ); ?>" alt="Premier Bank and The EDGE Bank Logos" />
		</p><?php

	} // merged_logos()

	/**
	 * Adds the page content
	 *
	 * @return 		mixed 		HTML markup
	 */
	public function page_content( $fields ) {

		?><div class="regular-content"><?php

			the_content();

		?></div><!-- .regular-content --><?php

	} // page_content()

	/**
	 * Adds the pen spacer
	 *
	 * @return 		mixed 		HTML markup
	 */
	public function pen_spacer() {

		?><img class="pen spacer alignright" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/spacer.gif' ); ?>" alt="spacer" /><?php

	} // pen_spacer()

	/**
	 * The search title markup
	 *
	 * @hooked 		tha_content_while_before
	 *
	 * @return 		mixed 							Search title markup
	 */
	public function search_title() {

		if ( ! is_search() ) { return; }

		?><header class="page-header">
			<h1 class="page-title"><?php

				printf( esc_html__( 'Search Results for: %s', 'edge-merger' ), '<span>' . get_search_query() . '</span>' );

			?></h1>
		</header><!-- .page-header --><?php

	} // search_title()

	/**
	 * Adds the Barlett letter signature
	 *
	 * @return 		mixed 		HTML markup
	 */
	public function signature() {

		if ( ! is_front_page() ) { return; }

		?><p>
			<img class="bartlett alignleft" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/Micah-BartlettPhoto.png' ); ?>" alt="Micah-BartlettPhoto" /><?php
			esc_html_e( 'All the best,', 'edge-merger' ); ?><br />
			<img class="signature alignnone wp-image-18" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/MicahSignature.png' ); ?>" alt="MicahSignature" /><br /><?php
			esc_html_e( 'Micah R. Bartlett', 'edge-merger' ); ?><br>
			<em><?php esc_html_e( 'President and CEO', 'edge-merger' ); ?></em>
		</p><?php

	} // signature()

	/**
	 * Adds the single post title to the index
	 *
	 * @hooked 		tha_content_while_before
	 *
	 * @return 		mixed 							The single post title
	 */
	public function single_post_title() {

		if ( ! is_home() && is_front_page() ) { return; }

		?><header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header><?php

	} // single_post_title()

	/**
	 * Adds the starting site branding markup
	 *
	 * @hooked 		tha_header_bottom			85
	 *
	 * @return 		mixed 						HTML markup
	 */
	public function site_branding_end() {

		?></div><!-- .site-branding --><?php

	} // site_branding_end()

	/**
	 * Adds the starting site branding markup
	 *
	 * @hooked 		tha_header_top				15
	 *
	 * @return 		mixed 						HTML markup
	 */
	public function site_branding_start() {

		?><div class="site-branding"><?php

	} // site_branding_start()

	/**
	 * Adds the site description markup
	 *
	 * @hooked 		edge_merger_header_content 		15
	 *
	 * @return 		mixed 								The site description markup
	 */
	public function site_description() {

		$description = get_bloginfo( 'description', 'display' );

		if ( $description || is_customize_preview() ) {

			?><p class="site-description"><?php $description; /* WPCS: xss ok. */ ?></p><?php

		}

	} // site_description()

	/**
	 * Adds the site title markup
	 *
	 * @hooked 		edge_merger_header_content 		10
	 *
	 * @return 		mixed 								The site title markup
	 */
	public function site_title() {

		$logo = get_stylesheet_directory_uri() . '/images/logo.jpg';

		if ( is_front_page() && is_home() ) {

			?><h1 class="site-title"><a href="<?php echo esc_url( 'http://townandcountrybank.com/' ); ?>" rel="home" target="_blank"><img src="<?php echo esc_url( $logo ); ?>"><span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span></a></h1><?php

		} else {

			?><p class="site-title"><a href="<?php echo esc_url( 'http://townandcountrybank.com/' ); ?>" rel="home" target="_blank"><img src="<?php echo esc_url( $logo ); ?>"><span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span></a></p><?php

		}

	} // site_title()

	/**
	 * Adds the a11y skip link markup
	 *
	 * @hooked 		tha_body_top 		20
	 *
	 * @return 		mixed 				Skip link markup
	 */
	public function skip_link() {

		?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'edge-merger' ); ?></a><?php

	} // skip_link()

} // class

$edge_merger_Themehooks = new edge_merger_Themehooks();


