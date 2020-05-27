<?php
/* Strong Testimonials support functions
------------------------------------------------------------------------------- */
// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('electroserv_strong_testimonials_theme_setup9')) {
	add_action( 'after_setup_theme', 'electroserv_strong_testimonials_theme_setup9', 9 );
	function electroserv_strong_testimonials_theme_setup9() {
		if (is_admin()) {
			add_filter( 'electroserv_filter_tgmpa_required_plugins','electroserv_strong_testimonials_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'electroserv_strong_testimonials_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('electroserv_filter_tgmpa_required_plugins',	'electroserv_strong_testimonials_tgmpa_required_plugins');
	function electroserv_strong_testimonials_tgmpa_required_plugins($list=array()) {
		if (electroserv_storage_isset('required_plugins', 'strong-testimonials')) {
            if (electroserv_get_theme_setting('tgmpa_upload')) {
                $list[] = array(
					'name' 		=> electroserv_storage_get_array('required_plugins', 'strong-testimonials'),
					'slug' 		=> 'strong-testimonials',
					'required' 	=> false
				);

            }
		}
		return $list;
	}
}

?>