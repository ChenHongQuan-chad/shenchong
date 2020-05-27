<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('electroserv_cf7_theme_setup9')) {
	add_action( 'after_setup_theme', 'electroserv_cf7_theme_setup9', 9 );
	function electroserv_cf7_theme_setup9() {
		
		if (electroserv_exists_cf7()) {
			add_action( 'wp_enqueue_scripts', 								'electroserv_cf7_frontend_scripts', 1100 );
			add_filter( 'electroserv_filter_merge_styles',						'electroserv_cf7_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'electroserv_filter_tgmpa_required_plugins',			'electroserv_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'electroserv_cf7_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('electroserv_filter_tgmpa_required_plugins',	'electroserv_cf7_tgmpa_required_plugins');
	function electroserv_cf7_tgmpa_required_plugins($list=array()) {
		if (electroserv_storage_isset('required_plugins', 'contact-form-7')) {
			// CF7 plugin
			$list[] = array(
					'name' 		=> electroserv_storage_get_array('required_plugins', 'contact-form-7'),
					'slug' 		=> 'contact-form-7',
					'required' 	=> false
			);
		}
		return $list;
	}
}


// Check if cf7 installed and activated
if ( !function_exists( 'electroserv_exists_cf7' ) ) {
	function electroserv_exists_cf7() {
		return class_exists('WPCF7');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'electroserv_cf7_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'electroserv_cf7_frontend_scripts', 1100 );
	function electroserv_cf7_frontend_scripts() {
		if (electroserv_is_on(electroserv_get_theme_option('debug_mode')) && electroserv_get_file_dir('plugins/contact-form-7/contact-form-7.css')!='')
			wp_enqueue_style( 'contact-form-7',  electroserv_get_file_url('plugins/contact-form-7/contact-form-7.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'electroserv_cf7_merge_styles' ) ) {
	//Handler of the add_filter('electroserv_filter_merge_styles', 'electroserv_cf7_merge_styles');
	function electroserv_cf7_merge_styles($list) {
		$list[] = 'plugins/contact-form-7/contact-form-7.css';
		return $list;
	}
}
?>