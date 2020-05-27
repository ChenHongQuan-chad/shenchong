<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('electroserv_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'electroserv_revslider_theme_setup9', 9 );
	function electroserv_revslider_theme_setup9() {
		if (electroserv_exists_revslider()) {
			add_action( 'wp_enqueue_scripts', 					'electroserv_revslider_frontend_scripts', 1100 );
			add_filter( 'electroserv_filter_merge_styles',			'electroserv_revslider_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'electroserv_filter_tgmpa_required_plugins','electroserv_revslider_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'electroserv_revslider_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('electroserv_filter_tgmpa_required_plugins',	'electroserv_revslider_tgmpa_required_plugins');
	function electroserv_revslider_tgmpa_required_plugins($list=array()) {
		if (electroserv_storage_isset('required_plugins', 'revslider')) {
			$path = electroserv_get_file_dir('plugins/revslider/revslider.zip');
			if (!empty($path) || electroserv_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> electroserv_storage_get_array('required_plugins', 'revslider'),
					'slug' 		=> 'revslider',
					'version'	=> '6.1.0',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'electroserv_exists_revslider' ) ) {
	function electroserv_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'electroserv_revslider_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'electroserv_revslider_frontend_scripts', 1100 );
	function electroserv_revslider_frontend_scripts() {
		if (electroserv_is_on(electroserv_get_theme_option('debug_mode')) && electroserv_get_file_dir('plugins/revslider/revslider.css')!='')
			wp_enqueue_style( 'revslider',  electroserv_get_file_url('plugins/revslider/revslider.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'electroserv_revslider_merge_styles' ) ) {
	//Handler of the add_filter('electroserv_filter_merge_styles', 'electroserv_revslider_merge_styles');
	function electroserv_revslider_merge_styles($list) {
		$list[] = 'plugins/revslider/revslider.css';
		return $list;
	}
}
?>