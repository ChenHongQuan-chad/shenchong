<?php
/* WPBakery Page Builder support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('electroserv_vc_theme_setup9')) {
	add_action( 'after_setup_theme', 'electroserv_vc_theme_setup9', 9 );
	function electroserv_vc_theme_setup9() {
		if (electroserv_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 				'electroserv_vc_frontend_scripts', 1100 );
			add_filter( 'electroserv_filter_merge_styles',		'electroserv_vc_merge_styles' );
	
			// Add/Remove params in the standard VC shortcodes
			//-----------------------------------------------------
			add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,	'electroserv_vc_add_params_classes', 10, 3 );
			add_filter( 'vc_iconpicker-type-fontawesome',	'electroserv_vc_iconpicker_type_fontawesome' );
			
			// Color scheme
			$scheme = array(
				"param_name" => "scheme",
				"heading" => esc_html__("Color scheme", 'electroserv'),
				"description" => wp_kses_data( __("Select color scheme to decorate this block", 'electroserv') ),
				"group" => esc_html__('Colors', 'electroserv'),
				"admin_label" => true,
				"value" => array_flip(electroserv_get_list_schemes(true)),
				"type" => "dropdown"
			);
			$sc_list = apply_filters('electroserv_filter_add_scheme_in_vc', array('vc_section', 'vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner', 'vc_column_text'));
			foreach ($sc_list as $sc)
				vc_add_param($sc, $scheme);

			// Alter height and hide on mobile for Empty Space
			vc_add_param("vc_empty_space", array(
				"param_name" => "alter_height",
				"heading" => esc_html__("Alter height", 'electroserv'),
				"description" => wp_kses_data( __("Select alternative height instead value from the field above", 'electroserv') ),
				"admin_label" => true,
				"value" => array(
					esc_html__('Tiny', 'electroserv') => 'tiny',
					esc_html__('Small', 'electroserv') => 'small',
					esc_html__('Medium', 'electroserv') => 'medium',
					esc_html__('Large', 'electroserv') => 'large',
					esc_html__('Huge', 'electroserv') => 'huge',
					esc_html__('From the value above', 'electroserv') => 'none'
				),
				"type" => "dropdown"
			));
			
			// Add Narrow style to the Progress bars
			vc_add_param("vc_progress_bar", array(
				"param_name" => "narrow",
				"heading" => esc_html__("Narrow", 'electroserv'),
				"description" => wp_kses_data( __("Use narrow style for the progress bar", 'electroserv') ),
				"std" => 0,
				"value" => array(esc_html__("Narrow style", 'electroserv') => "1" ),
				"type" => "checkbox"
			));
			
			// Add param 'Closeable' to the Message Box
			vc_add_param("vc_message", array(
				"param_name" => "closeable",
				"heading" => esc_html__("Closeable", 'electroserv'),
				"description" => wp_kses_data( __("Add 'Close' button to the message box", 'electroserv') ),
				"std" => 0,
				"value" => array(esc_html__("Closeable", 'electroserv') => "1" ),
				"type" => "checkbox"
			));
		}
		if (is_admin()) {
			add_filter( 'electroserv_filter_tgmpa_required_plugins', 'electroserv_vc_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'electroserv_vc_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('electroserv_filter_tgmpa_required_plugins',	'electroserv_vc_tgmpa_required_plugins');
	function electroserv_vc_tgmpa_required_plugins($list=array()) {
		if (electroserv_storage_isset('required_plugins', 'js_composer')) {
			$path = electroserv_get_file_dir('plugins/js_composer/js_composer.zip');
			if (!empty($path) || electroserv_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> electroserv_storage_get_array('required_plugins', 'js_composer'),
					'slug' 		=> 'js_composer',
					'version'	=> '6.0.5',
					'source'	=> !empty($path) ? $path : 'upload://js_composer.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if WPBakery Page Builder installed and activated
if ( !function_exists( 'electroserv_exists_visual_composer' ) ) {
	function electroserv_exists_visual_composer() {
		return class_exists('Vc_Manager');
	}
}

// Check if WPBakery Page Builder in frontend editor mode
if ( !function_exists( 'electroserv_vc_is_frontend' ) ) {
	function electroserv_vc_is_frontend() {
		return (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true')
			|| (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline');
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'electroserv_vc_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'electroserv_vc_frontend_scripts', 1100 );
	function electroserv_vc_frontend_scripts() {
		if (electroserv_exists_visual_composer()) {
			if (electroserv_is_on(electroserv_get_theme_option('debug_mode')) && electroserv_get_file_dir('plugins/js_composer/js_composer.css')!='')
				wp_enqueue_style( 'js-composer',  electroserv_get_file_url('plugins/js_composer/js_composer.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'electroserv_vc_merge_styles' ) ) {
	//Handler of the add_filter('electroserv_filter_merge_styles', 'electroserv_vc_merge_styles');
	function electroserv_vc_merge_styles($list) {
		$list[] = 'plugins/js_composer/js_composer.css';
		return $list;
	}
}
	
// Add theme icons to the VC iconpicker list
if ( !function_exists( 'electroserv_vc_iconpicker_type_fontawesome' ) ) {
	//Handler of the add_filter( 'vc_iconpicker-type-fontawesome',	'electroserv_vc_iconpicker_type_fontawesome' );
	function electroserv_vc_iconpicker_type_fontawesome($icons) {
		$list = electroserv_get_list_icons();
		if (!is_array($list) || count($list) == 0) return $icons;
		$rez = array();
		foreach ($list as $icon)
			$rez[] = array($icon => str_replace('icon-', '', $icon));
		return array_merge( $icons, array(esc_html__('Theme Icons', 'electroserv') => $rez) );
	}
}



// Shortcodes support
//------------------------------------------------------------------------

// Add params to the standard VC shortcodes
if ( !function_exists( 'electroserv_vc_add_params_classes' ) ) {
	//Handler of the add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'electroserv_vc_add_params_classes', 10, 3 );
	function electroserv_vc_add_params_classes($classes, $sc, $atts) {
		// Add color scheme
		if (in_array($sc, apply_filters('electroserv_filter_add_scheme_in_vc', array('vc_section', 'vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner', 'vc_column_text')))) {
			if (!empty($atts['scheme']) && !electroserv_is_inherit($atts['scheme']))
				$classes .= ($classes ? ' ' : '') . 'scheme_' . $atts['scheme'];
		}
		// Add other specific classes
		if (in_array($sc, array('vc_empty_space'))) {
			if (!empty($atts['alter_height']) && !electroserv_is_off($atts['alter_height']))
				$classes .= ($classes ? ' ' : '') . 'height_' . $atts['alter_height'];
		} else if (in_array($sc, array('vc_progress_bar'))) {
			if (!empty($atts['narrow']) && (int) $atts['narrow']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_progress_bar_narrow';
		} else if (in_array($sc, array('vc_message'))) {
			if (!empty($atts['closeable']) && (int) $atts['closeable']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_message_box_closeable';
		}
		return $classes;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (electroserv_exists_visual_composer()) { require_once ELECTROSERV_THEME_DIR . 'plugins/js_composer/js_composer.styles.php'; }
?>