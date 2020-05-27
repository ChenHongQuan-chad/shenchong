<?php
/**
 * The Front Page template file.
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0.31
 */

get_header();

// If front-page is a static page
if (get_option('show_on_front') == 'page') {

	// If Front Page Builder is enabled - display sections
	if (electroserv_is_on(electroserv_get_theme_option('front_page_enabled'))) {

		if ( have_posts() ) the_post();

		$electroserv_sections = electroserv_array_get_keys_by_value(electroserv_get_theme_option('front_page_sections'), 1, false);
		if (is_array($electroserv_sections)) {
			foreach ($electroserv_sections as $electroserv_section) {
				get_template_part("front-page/section", $electroserv_section);
			}
		}
	
	// Else - display native page content
	} else
		get_template_part('page');

// Else get index template to show posts
} else
	get_template_part('index');

get_footer();
?>