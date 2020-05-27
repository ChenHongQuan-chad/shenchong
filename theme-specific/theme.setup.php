<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0.22
 */

if (!defined("ELECTROSERV_THEME_FREE")) define("ELECTROSERV_THEME_FREE", false);

// Theme storage
$ELECTROSERV_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'					=> esc_html__('ThemeREX Addons', 'electroserv'),
			
		),

		// List of plugins for PREMIUM version only
		//-----------------------------------------------------
		ELECTROSERV_THEME_FREE ? array() : array(

			// Recommended (supported) plugins
			// If plugin not need - comment (or remove) it
			'booked'						=> esc_html__('Booked Appointments', 'electroserv'),
			'contact-form-7'				=> esc_html__('Contact Form 7', 'electroserv'),
			'js_composer'					=> esc_html__('WPBakery Page Builder', 'electroserv'),
			'essential-grid'				=> esc_html__('Essential Grid', 'electroserv'),
			'revslider'						=> esc_html__('Revolution Slider', 'electroserv'),
			'strong-testimonials'			=> esc_html__('Strong Testimonials', 'electroserv'),
			'wp-gdpr-compliance'			=> esc_html__('WP GDPR Compliance', 'electroserv')
		)
	),
	
	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url' => 'http://electroserv.ancorathemes.com/',
	'theme_doc_url' => 'http://electroserv.dv.ancorathemes.com/doc/',
	'theme_support_url' => 'https://ancorathemes.ticksy.com/',
	'theme_download_url' => 'http://themeforest.net/item/electroserv-electrical-repair-service/20762180'
);

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( !function_exists('electroserv_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'electroserv_customizer_theme_setup1', 1 );
	function electroserv_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		electroserv_storage_set('settings', array(
			
			'duplicate_options'		=> 'child',		// none  - use separate options for template and child-theme
													// child - duplicate theme options from the main theme to the child-theme only
													// both  - sinchronize changes in the theme options between main and child themes
			
			'custmize_refresh'		=> 'auto',		// Refresh method for preview area in the Appearance - Customize:
													// auto - refresh preview area on change each field with Theme Options
													// manual - refresh only obn press button 'Refresh' at the top of Customize frame
		
			'max_load_fonts'		=> 5,			// Max fonts number to load from Google fonts or from uploaded fonts
		
			'comment_maxlength'		=> 1000,		// Max length of the message from contact form

			'comment_after_name'	=> true,		// Place 'comment' field before the 'name' and 'email'
			
			'socials_type'			=> 'icons',		// Type of socials:
													// icons - use font icons to present social networks
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_type'			=> 'icons',		// Type of other icons:
													// icons - use font icons to present icons
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_selector'		=> 'internal',	// Icons selector in the shortcodes:
													// internal - internal popup with plugin's or theme's icons list (fast)
			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
			
			'tgmpa_upload'			=> true,		// Allow upload not pre-packaged plugins via TGMPA
			
			'allow_theme_layouts'	=> true		// Include theme's default headers and footers to the list after custom layouts
													// or leave in the list only custom layouts
		));


		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		electroserv_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Lato',
				'family' => 'sans-serif',
				'styles' => '400,400italic,700,700italic,900,900italic'
				),
			// Font-face packed with theme
			array(
				'name'   => 'Montserrat',
				'family' => 'sans-serif',
                'styles' => '400,400italic,500,500italic'
				)
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		electroserv_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		electroserv_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'electroserv'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'electroserv'),
				'font-family'		=> '"Lato",sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.72',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.71em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'electroserv'),
				'font-family'		=> '"Lato",sans-serif',
				'font-size' 		=> '3em',
				'font-weight'		=> '900',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '2.5em',
				'margin-bottom'		=> '1.1em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'electroserv'),
				'font-family'		=> '"Lato",sans-serif',
				'font-size' 		=> '2.118em',
				'font-weight'		=> '900',
				'font-style'		=> 'normal',
				'line-height'		=> '1.18',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '3.7em',
				'margin-bottom'		=> '1.25em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'electroserv'),
				'font-family'		=> '"Lato",sans-serif',
				'font-size' 		=> '1.765em',
				'font-weight'		=> '900',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '4.475em',
				'margin-bottom'		=> '1.4em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'electroserv'),
				'font-family'		=> '"Lato",sans-serif',
				'font-size' 		=> '1.294em',
				'font-weight'		=> '900',
				'font-style'		=> 'normal',
				'line-height'		=> '1.28',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '6.2em',
				'margin-bottom'		=> '1.75em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'electroserv'),
				'font-family'		=> '"Lato",sans-serif',
				'font-size' 		=> '1.059em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.34',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '7.6em',
				'margin-bottom'		=> '1.7em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'electroserv'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.44',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.7px',
				'margin-top'		=> '9.8em',
				'margin-bottom'		=> '1.3em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'electroserv'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'electroserv'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'electroserv'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> 'normal',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.7px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'electroserv'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'electroserv'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> 'normal',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.7px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'electroserv'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'electroserv'),
				'font-family'		=> 'inherit',
				'font-size' 		=> '14px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'electroserv'),
				'description'		=> esc_html__('Font settings of the main menu items', 'electroserv'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> 'normal',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.7px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'electroserv'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'electroserv'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> 'normal',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.7px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		electroserv_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> esc_html__('Main', 'electroserv'),
							'description'	=> esc_html__('Colors of the main content area', 'electroserv')
							),
			'alter'	=> array(
							'title'			=> esc_html__('Alter', 'electroserv'),
							'description'	=> esc_html__('Colors of the alternative blocks (sidebars, etc.)', 'electroserv')
							),
			'extra'	=> array(
							'title'			=> esc_html__('Extra', 'electroserv'),
							'description'	=> esc_html__('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'electroserv')
							),
			'inverse' => array(
							'title'			=> esc_html__('Inverse', 'electroserv'),
							'description'	=> esc_html__('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'electroserv')
							),
			'input'	=> array(
							'title'			=> esc_html__('Input', 'electroserv'),
							'description'	=> esc_html__('Colors of the form fields (text field, textarea, select, etc.)', 'electroserv')
							),
			)
		);
		electroserv_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> esc_html__('Background color', 'electroserv'),
							'description'	=> esc_html__('Background color of this block in the normal state', 'electroserv')
							),
			'bg_hover'	=> array(
							'title'			=> esc_html__('Background hover', 'electroserv'),
							'description'	=> esc_html__('Background color of this block in the hovered state', 'electroserv')
							),
			'bd_color'	=> array(
							'title'			=> esc_html__('Border color', 'electroserv'),
							'description'	=> esc_html__('Border color of this block in the normal state', 'electroserv')
							),
			'bd_hover'	=>  array(
							'title'			=> esc_html__('Border hover', 'electroserv'),
							'description'	=> esc_html__('Border color of this block in the hovered state', 'electroserv')
							),
			'text'		=> array(
							'title'			=> esc_html__('Text', 'electroserv'),
							'description'	=> esc_html__('Color of the plain text inside this block', 'electroserv')
							),
			'text_dark'	=> array(
							'title'			=> esc_html__('Text dark', 'electroserv'),
							'description'	=> esc_html__('Color of the dark text (bold, header, etc.) inside this block', 'electroserv')
							),
			'text_light'=> array(
							'title'			=> esc_html__('Text light', 'electroserv'),
							'description'	=> esc_html__('Color of the light text (post meta, etc.) inside this block', 'electroserv')
							),
			'text_link'	=> array(
							'title'			=> esc_html__('Link', 'electroserv'),
							'description'	=> esc_html__('Color of the links inside this block', 'electroserv')
							),
			'text_hover'=> array(
							'title'			=> esc_html__('Link hover', 'electroserv'),
							'description'	=> esc_html__('Color of the hovered state of links inside this block', 'electroserv')
							),
			'text_link2'=> array(
							'title'			=> esc_html__('Link 2', 'electroserv'),
							'description'	=> esc_html__('Color of the accented texts (areas) inside this block', 'electroserv')
							),
			'text_hover2'=> array(
							'title'			=> esc_html__('Link 2 hover', 'electroserv'),
							'description'	=> esc_html__('Color of the hovered state of accented texts (areas) inside this block', 'electroserv')
							),
			'text_link3'=> array(
							'title'			=> esc_html__('Link 3', 'electroserv'),
							'description'	=> esc_html__('Color of the other accented texts (buttons) inside this block', 'electroserv')
							),
			'text_hover3'=> array(
							'title'			=> esc_html__('Link 3 hover', 'electroserv'),
							'description'	=> esc_html__('Color of the hovered state of other accented texts (buttons) inside this block', 'electroserv')
							)
			)
		);
		electroserv_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'electroserv'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff',
					'bd_color'			=> '#e5e5e5',
		
					// Text and links colors
					'text'				=> '#909193',
					'text_light'		=> '#a4a4a6',
					'text_dark'			=> '#25262e',
					'text_link'			=> '#25262e',
					'text_hover'		=> '#f7b72f',
					'text_link2'		=> '#80d572',
					'text_hover2'		=> '#8be77c',
					'text_link3'		=> '#ddb837',
					'text_hover3'		=> '#eec432',
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#f6f6f6',
					'alter_bg_hover'	=> '#e6e8eb',
					'alter_bd_color'	=> '#eaeaec',
					'alter_bd_hover'	=> '#dadada',
					'alter_text'		=> '#333333',
					'alter_light'		=> '#b7b7b7',
					'alter_dark'		=> '#1d1d1d',
					'alter_link'		=> '#fe7259',
					'alter_hover'		=> '#e6a620',
					'alter_link2'		=> '#8be77c',
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#25262e',
					'extra_bg_hover'	=> '#28272e',
					'extra_bd_color'	=> '#313131',
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#808083',
					'extra_light'		=> '#afafaf',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#72cfd5',
					'extra_hover'		=> '#fe7259',
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#f6f6f6',
					'input_bg_hover'	=> '#ffffff',
					'input_bd_color'	=> '#f6f6f6',
					'input_bd_hover'	=> '#f7b72f',
					'input_text'		=> '#898a8f',
					'input_light'		=> '#898a8f',
					'input_dark'		=> '#25262e',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#67bcc1',
					'inverse_bd_hover'	=> '#5aa4a9',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#333333',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'electroserv'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#0e0d12',
					'bd_color'			=> '#1c1b1f',
		
					// Text and links colors
					'text'				=> '#808083',
					'text_light'		=> '#5f5f5f',
					'text_dark'			=> '#ffffff',
					'text_link'			=> '#f7b72f',
					'text_hover'		=> '#f7b72f',
					'text_link2'		=> '#80d572',
					'text_hover2'		=> '#8be77c',
					'text_link3'		=> '#ddb837',
					'text_hover3'		=> '#eec432',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#25262e',
					'alter_bg_hover'	=> '#28272e',
					'alter_bd_color'	=> '#363740',
					'alter_bd_hover'	=> '#3d3d3d',
					'alter_text'		=> '#a6a6a6',
					'alter_light'		=> '#5f5f5f',
					'alter_dark'		=> '#ffffff',
					'alter_link'		=> '#ffaa5f',
					'alter_hover'		=> '#fe7259',
					'alter_link2'		=> '#8be77c',
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1e1d22',
					'extra_bg_hover'	=> '#28272e',
					'extra_bd_color'	=> '#313131',
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#a6a6a6',
					'extra_light'		=> '#5f5f5f',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#ffaa5f',
					'extra_hover'		=> '#fe7259',
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#2e2d32',
					'input_bg_hover'	=> '#2e2d32',
					'input_bd_color'	=> '#2e2d32',
					'input_bd_hover'	=> '#353535',
					'input_text'		=> '#b7b7b7',
					'input_light'		=> '#5f5f5f',
					'input_dark'		=> '#ffffff',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#e36650',
					'inverse_bd_hover'	=> '#cb5b47',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#5f5f5f',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			)
		
		));
		
		// Simple schemes substitution
		electroserv_storage_set('schemes_simple', array(
			// Main color	// Slave elements and it's darkness koef.
			'text_link'		=> array('alter_hover' => 1,	'extra_link' => 1, 'inverse_bd_color' => 0.85, 'inverse_bd_hover' => 0.7),
			'text_hover'	=> array('alter_link' => 1,		'extra_hover' => 1),
			'text_link2'	=> array('alter_hover2' => 1,	'extra_link2' => 1),
			'text_hover2'	=> array('alter_link2' => 1,	'extra_hover2' => 1),
			'text_link3'	=> array('alter_hover3' => 1,	'extra_link3' => 1),
			'text_hover3'	=> array('alter_link3' => 1,	'extra_hover3' => 1)
		));
	}
}

			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('electroserv_customizer_add_theme_colors')) {
	function electroserv_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['text_06']  = electroserv_hex2rgba( $colors['text'], 0.6 );
			$colors['bg_color_0']  = electroserv_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = electroserv_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_03']  = electroserv_hex2rgba( $colors['bg_color'], 0.3 );
			$colors['bg_color_05']  = electroserv_hex2rgba( $colors['bg_color'], 0.5 );
			$colors['bg_color_07']  = electroserv_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = electroserv_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = electroserv_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['alter_bg_color_07']  = electroserv_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = electroserv_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = electroserv_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = electroserv_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['extra_bg_color_07']  = electroserv_hex2rgba( $colors['extra_bg_color'], 0.7 );
			$colors['text_hover_07']  = electroserv_hex2rgba( $colors['text_hover'], 0.7 );
			$colors['text_hover_09']  = electroserv_hex2rgba( $colors['text_hover'], 0.9 );
			$colors['text_dark_03']  = electroserv_hex2rgba( $colors['text_dark'], 0.3 );
			$colors['text_dark_06']  = electroserv_hex2rgba( $colors['text_dark'], 0.6 );
			$colors['text_dark_07']  = electroserv_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_link_02']  = electroserv_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = electroserv_hex2rgba( $colors['text_link'], 0.7 );
			$colors['text_link_blend'] = electroserv_hsb2hex(electroserv_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = electroserv_hsb2hex(electroserv_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
		} else {
			$colors['text_06'] = '{{ data.text_06 }}';
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_03'] = '{{ data.bg_color_03 }}';
			$colors['bg_color_05'] = '{{ data.bg_color_05 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['extra_bg_color_07'] = '{{ data.extra_bg_color_07 }}';
			$colors['text_hover_07'] = '{{ data.text_hover_07 }}';
			$colors['text_hover_09'] = '{{ data.text_hover_09 }}';
			$colors['text_dark_03'] = '{{ data.text_dark_03 }}';
			$colors['text_dark_06'] = '{{ data.text_dark_06 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('electroserv_customizer_add_theme_fonts')) {
	function electroserv_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !electroserv_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !electroserv_is_inherit($font['font-size'])
														? 'font-size:' . electroserv_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !electroserv_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !electroserv_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !electroserv_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !electroserv_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !electroserv_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !electroserv_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !electroserv_is_inherit($font['margin-top'])
														? 'margin-top:' . electroserv_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !electroserv_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . electroserv_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}




//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------

if ( !function_exists('electroserv_customizer_theme_setup') ) {
	add_action( 'after_setup_theme', 'electroserv_customizer_theme_setup' );
	function electroserv_customizer_theme_setup() {

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('electroserv_filter_add_thumb_sizes', array(
			'electroserv-thumb-huge'		=> array(1170, 658, true),
			'electroserv-thumb-big' 		=> array( 760, 428, true),
			'electroserv-thumb-med' 		=> array( 370, 240, true),
			'electroserv-thumb-tiny' 		=> array(  90,  90, true),
			'electroserv-thumb-related'		=> array( 148, 115, true),
			'electroserv-thumb-team'		=> array( 270, 318, true),
			'electroserv-thumb-blogger'		=> array( 585, 375, true),
			'electroserv-thumb-chess'		=> array( 640, 780, true),
			'electroserv-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'electroserv-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = electroserv_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'electroserv_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}

	}
}

if ( !function_exists('electroserv_customizer_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'electroserv_customizer_image_sizes' );
	function electroserv_customizer_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('electroserv_filter_add_thumb_sizes', array(
			'electroserv-thumb-huge'		=> esc_html__( 'Huge image', 'electroserv' ),
			'electroserv-thumb-big'			=> esc_html__( 'Large image', 'electroserv' ),
			'electroserv-thumb-med'			=> esc_html__( 'Medium image', 'electroserv' ),
			'electroserv-thumb-tiny'		=> esc_html__( 'Small square avatar', 'electroserv' ),
			'electroserv-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'electroserv' ),
			'electroserv-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'electroserv' ),
			)
		);
		$mult = electroserv_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'electroserv' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'electroserv_customizer_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'electroserv_customizer_trx_addons_add_thumb_sizes');
	function electroserv_customizer_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'electroserv_customizer_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'electroserv_customizer_trx_addons_get_thumb_size');
	function electroserv_customizer_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
                            'trx_addons-thumb-related',
							'trx_addons-thumb-related-@retina',
                            'trx_addons-thumb-team',
							'trx_addons-thumb-team-@retina',
                            'trx_addons-thumb-blogger',
							'trx_addons-thumb-blogger-@retina',
                            'trx_addons-thumb-chess',
							'trx_addons-thumb-chess-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'electroserv-thumb-huge',
							'electroserv-thumb-huge-@retina',
							'electroserv-thumb-big',
							'electroserv-thumb-big-@retina',
							'electroserv-thumb-med',
							'electroserv-thumb-med-@retina',
							'electroserv-thumb-tiny',
							'electroserv-thumb-tiny-@retina',
                            'electroserv-thumb-related',
							'electroserv-thumb-related-@retina',
                            'electroserv-thumb-team',
							'electroserv-thumb-team-@retina',
                            'electroserv-thumb-blogger',
							'electroserv-thumb-blogger-@retina',
                            'electroserv-thumb-chess',
							'electroserv-thumb-chess-@retina',
							'electroserv-thumb-masonry-big',
							'electroserv-thumb-masonry-big-@retina',
							'electroserv-thumb-masonry',
							'electroserv-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'electroserv_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'electroserv_importer_set_options', 9 );
	function electroserv_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(electroserv_get_protocol() . '://demofiles.ancorathemes.com/electroserv/');
			// Required plugins
			$options['required_plugins'] = array_keys(electroserv_storage_get('required_plugins'));
			// Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 3;
			// Default demo
			$options['files']['default']['title'] = esc_html__('BaseKit Demo', 'electroserv');
			$options['files']['default']['domain_dev'] = esc_url(electroserv_get_protocol().'://electroserv.dv.ancorathemes.com');		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(electroserv_get_protocol().'://electroserv.ancorathemes.com');		// Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
		}
		return $options;
	}
}




// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('electroserv_create_theme_options')) {

	function electroserv_create_theme_options() {

		// Message about options override. 
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __('<b>Attention!</b> Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages', 'electroserv');

		electroserv_storage_set('options', array(
		
			// 'Logo & Site Identity'
			'title_tagline' => array(
				"title" => esc_html__('Logo & Site Identity', 'electroserv'),
				"desc" => '',
				"priority" => 10,
				"type" => "section"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo in the header', 'electroserv'),
				"desc" => '',
				"priority" => 20,
				"type" => "info",
				),
			'logo_text' => array(
				"title" => esc_html__('Use Site Name as Logo', 'electroserv'),
				"desc" => wp_kses_data( __('Use the site title and tagline as a text logo if no image is selected', 'electroserv') ),
				"class" => "electroserv_column-1_2 electroserv_new_row",
				"priority" => 30,
				"std" => 1,
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_retina_enabled' => array(
				"title" => esc_html__('Allow retina display logo', 'electroserv'),
				"desc" => wp_kses_data( __('Show fields to select logo images for Retina display', 'electroserv') ),
				"class" => "electroserv_column-1_2",
				"refresh" => false,
				"std" => 0,
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo' => array(
				"title" => esc_html__('Logo', 'electroserv'),
				"desc" => wp_kses_data( __('Select or upload site logo', 'electroserv') ),
				"class" => "electroserv_column-1_2 electroserv_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'electroserv'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'electroserv') ),
				"class" => "electroserv_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile' => array(
				"title" => esc_html__('Logo mobile', 'electroserv'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile menu', 'electroserv') ),
				"class" => "electroserv_column-1_2 electroserv_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_retina' => array(
				"title" => esc_html__('Logo mobile for Retina', 'electroserv'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'electroserv') ),
				"class" => "electroserv_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'electroserv'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'electroserv') ),
				"class" => "electroserv_column-1_2 electroserv_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'electroserv'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'electroserv') ),
				"class" => "electroserv_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "image"
				),
			
		
		
			// 'General settings'
			'general' => array(
				"title" => esc_html__('General Settings', 'electroserv'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 20,
				"type" => "section",
				),

			'general_layout_info' => array(
				"title" => esc_html__('Layout', 'electroserv'),
				"desc" => '',
				"type" => "info",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'electroserv'),
				"desc" => wp_kses_data( __('Select width of the body content', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'electroserv')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => electroserv_get_list_body_styles(),
				"type" => "select"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'electroserv'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'electroserv') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'electroserv')
				),
				"std" => '',
				"hidden" => true,
				"type" => "image"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'electroserv'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'electroserv')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),

			'general_sidebar_info' => array(
				"title" => esc_html__('Sidebar', 'electroserv'),
				"desc" => '',
				"type" => "info",
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'electroserv'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'electroserv')
				),
				"std" => 'right',
				"options" => array(),
				"type" => "switch"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'electroserv'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'electroserv')
				),
				"dependency" => array(
					'sidebar_position' => array('left', 'right')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'electroserv'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'electroserv') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),


			'general_widgets_info' => array(
				"title" => esc_html__('Additional widgets', 'electroserv'),
				"desc" => '',
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "info",
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets at the top of the page', 'electroserv'),
				"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'electroserv')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'electroserv'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'electroserv')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'electroserv'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'electroserv')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets at the bottom of the page', 'electroserv'),
				"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'electroserv')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
				),

			'general_effects_info' => array(
				"title" => esc_html__('Design & Effects', 'electroserv'),
				"desc" => '',
				"type" => "info",
				),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'electroserv'),
				"desc" => wp_kses_data( __('Specify the border radius of the form fields and buttons in pixels or other valid CSS units', 'electroserv') ),
				"std" => 0,
				"type" => "text"
				),

			'general_misc_info' => array(
				"title" => esc_html__('Miscellaneous', 'electroserv'),
				"desc" => '',
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "info",
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'electroserv'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'electroserv') ),
				"std" => 0,
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "checkbox"
				),

			'privacy_text' => array(
				"title" => esc_html__("Text with Privacy Policy link", 'electroserv'),
				"desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'electroserv') ),
				"std"   => wp_kses_post( __( 'I agree that my submitted data is being collected and stored.', 'electroserv') ),
				"type"  => "text"
			),
		
		
			// 'Header'
			'header' => array(
				"title" => esc_html__('Header', 'electroserv'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 30,
				"type" => "section"
				),

			'header_style_info' => array(
				"title" => esc_html__('Header style', 'electroserv'),
				"desc" => '',
				"type" => "info"
				),
			'header_type' => array(
				"title" => esc_html__('Header style', 'electroserv'),
				"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'electroserv')
				),
				"std" => 'default',
				"options" => electroserv_get_list_header_footer_types(),
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "switch"
				),
			'header_style' => array(
				"title" => esc_html__('Select custom layout', 'electroserv'),
				"desc" => wp_kses_data( __('Select custom header from Layouts Builder', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'electroserv')
				),
				"dependency" => array(
					'header_type' => array('custom')
				),
				"std" => ELECTROSERV_THEME_FREE ? 'header-custom-sow-header-default' : 'header-custom-header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'electroserv'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'electroserv')
				),
				"std" => 'default',
				"options" => array(),
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "switch"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'electroserv'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'electroserv')
				),
				"std" => 0,
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'electroserv'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'electroserv')
				),
				"dependency" => array(
					'header_type' => array('default')
				),
				"std" => 1,
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_widgets_info' => array(
				"title" => esc_html__('Header widgets', 'electroserv'),
				"desc" => wp_kses_data( __('Here you can place a widget slider, advertising banners, etc.', 'electroserv') ),
				"type" => "info"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'electroserv'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'electroserv'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'electroserv') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'electroserv'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'electroserv')
				),
				"dependency" => array(
					'header_type' => array('default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => electroserv_get_list_range(0,6),
				"type" => "select"
				),

			'menu_info' => array(
				"title" => esc_html__('Main menu', 'electroserv'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'electroserv') ),
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'electroserv'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'electroserv')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'electroserv'),
					'left'	=> esc_html__('Left',	'electroserv'),
					'right'	=> esc_html__('Right',	'electroserv')
				),
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "switch"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'electroserv'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'electroserv')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 0,
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'electroserv'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'electroserv')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'electroserv'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'electroserv') ),
				"std" => 1,
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_image_info' => array(
				"title" => esc_html__('Header image', 'electroserv'),
				"desc" => '',
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "info"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'electroserv'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'electroserv') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'electroserv')
				),
				"std" => 0,
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "checkbox"
				),


		
			// 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'electroserv'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 50,
				"type" => "section"
				),
			'footer_type' => array(
				"title" => esc_html__('Footer style', 'electroserv'),
				"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'electroserv')
				),
				"std" => 'default',
				"options" => electroserv_get_list_header_footer_types(),
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "switch"
				),
			'footer_style' => array(
				"title" => esc_html__('Select custom layout', 'electroserv'),
				"desc" => wp_kses_data( __('Select custom footer from Layouts Builder', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'electroserv')
				),
				"dependency" => array(
					'footer_type' => array('custom')
				),
				"std" => ELECTROSERV_THEME_FREE ? 'footer-custom-sow-footer-default' : 'footer-custom-footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'electroserv'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'electroserv')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'electroserv'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'electroserv')
				),
				"dependency" => array(
					'footer_type' => array('default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => electroserv_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'electroserv'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'electroserv') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'electroserv')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'electroserv'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'electroserv') ),
				'refresh' => false,
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'electroserv'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'electroserv') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1)
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'electroserv'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'electroserv') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1),
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'electroserv'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'electroserv') ),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'electroserv'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'electroserv') ),
				"std" => esc_html__('AncoraThemes &copy; {Y}. All rights reserved.', 'electroserv'),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
			
		
		
			// 'Blog'
			'blog' => array(
				"title" => esc_html__('Blog', 'electroserv'),
				"desc" => wp_kses_data( __('Options of the the blog archive', 'electroserv') ),
				"priority" => 70,
				"type" => "panel",
				),
		
				// Blog - Posts page
				'blog_general' => array(
					"title" => esc_html__('Posts page', 'electroserv'),
					"desc" => wp_kses_data( __('Style and components of the blog archive', 'electroserv') ),
					"type" => "section",
					),
				'blog_general_info' => array(
					"title" => esc_html__('General settings', 'electroserv'),
					"desc" => '',
					"type" => "info",
					),
				'blog_style' => array(
					"title" => esc_html__('Blog style', 'electroserv'),
					"desc" => '',
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'electroserv')
					),
					"dependency" => array(
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"std" => 'excerpt',
					"options" => array(),
					"type" => "select"
					),
				'first_post_large' => array(
					"title" => esc_html__('First post large', 'electroserv'),
					"desc" => wp_kses_data( __('Make your first post stand out by making it bigger', 'electroserv') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'electroserv')
					),
					"dependency" => array(
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style' => array('classic', 'masonry')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				"blog_content" => array( 
					"title" => esc_html__('Posts content', 'electroserv'),
					"desc" => wp_kses_data( __("Display either post excerpts or the full post content", 'electroserv') ),
					"std" => "excerpt",
					"dependency" => array(
						'blog_style' => array('excerpt')
					),
					"options" => array(
						'excerpt'	=> esc_html__('Excerpt',	'electroserv'),
						'fullpost'	=> esc_html__('Full post',	'electroserv')
					),
					"type" => "switch"
					),
				'excerpt_length' => array(
					"title" => esc_html__('Excerpt length', 'electroserv'),
					"desc" => wp_kses_data( __("Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged", 'electroserv') ),
					"dependency" => array(
						'blog_style' => array('excerpt'),
						'blog_content' => array('excerpt')
					),
					"std" => 60,
					"type" => "text"
					),
				'blog_columns' => array(
					"title" => esc_html__('Blog columns', 'electroserv'),
					"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'electroserv') ),
					"std" => 2,
					"options" => electroserv_get_list_range(2,4),
					"type" => "hidden"
					),
				'post_type' => array(
					"title" => esc_html__('Post type', 'electroserv'),
					"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'electroserv') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'electroserv')
					),
					"dependency" => array(
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"linked" => 'parent_cat',
					"refresh" => false,
					"hidden" => true,
					"std" => 'post',
					"options" => array(),
					"type" => "select"
					),
				'parent_cat' => array(
					"title" => esc_html__('Category to show', 'electroserv'),
					"desc" => wp_kses_data( __('Select category to show in the blog archive', 'electroserv') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'electroserv')
					),
					"dependency" => array(
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"refresh" => false,
					"hidden" => true,
					"std" => '0',
					"options" => array(),
					"type" => "select"
					),
				'posts_per_page' => array(
					"title" => esc_html__('Posts per page', 'electroserv'),
					"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'electroserv') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'electroserv')
					),
					"dependency" => array(
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"hidden" => true,
					"std" => '',
					"type" => "text"
					),
				"blog_pagination" => array( 
					"title" => esc_html__('Pagination style', 'electroserv'),
					"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'electroserv') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'electroserv')
					),
					"std" => "pages",
					"options" => array(
						'pages'	=> esc_html__("Page numbers", 'electroserv'),
						'links'	=> esc_html__("Older/Newest", 'electroserv'),
						'more'	=> esc_html__("Load more", 'electroserv'),
						'infinite' => esc_html__("Infinite scroll", 'electroserv')
					),
					"type" => "select"
					),
				'show_filters' => array(
					"title" => esc_html__('Show filters', 'electroserv'),
					"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'electroserv') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'electroserv')
					),
					"dependency" => array(
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style' => array('portfolio', 'gallery')
					),
					"hidden" => true,
					"std" => 0,
					"type" => ELECTROSERV_THEME_FREE ? "hidden" : "checkbox"
					),
	
				'blog_sidebar_info' => array(
					"title" => esc_html__('Sidebar', 'electroserv'),
					"desc" => '',
					"type" => "info",
					),
				'sidebar_position_blog' => array(
					"title" => esc_html__('Sidebar position', 'electroserv'),
					"desc" => wp_kses_data( __('Select position to show sidebar', 'electroserv') ),
					"std" => 'right',
					"options" => array(),
					"type" => "switch"
					),
				'sidebar_widgets_blog' => array(
					"title" => esc_html__('Sidebar widgets', 'electroserv'),
					"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'electroserv') ),
					"dependency" => array(
						'sidebar_position_blog' => array('left', 'right')
					),
					"std" => 'sidebar_widgets',
					"options" => array(),
					"type" => "select"
					),
				'expand_content_blog' => array(
					"title" => esc_html__('Expand content', 'electroserv'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'electroserv') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
	
	
				'blog_widgets_info' => array(
					"title" => esc_html__('Additional widgets', 'electroserv'),
					"desc" => '',
					"type" => ELECTROSERV_THEME_FREE ? "hidden" : "info",
					),
				'widgets_above_page_blog' => array(
					"title" => esc_html__('Widgets at the top of the page', 'electroserv'),
					"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'electroserv') ),
					"std" => 'hide',
					"options" => array(),
					"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
					),
				'widgets_above_content_blog' => array(
					"title" => esc_html__('Widgets above the content', 'electroserv'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'electroserv') ),
					"std" => 'hide',
					"options" => array(),
					"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_content_blog' => array(
					"title" => esc_html__('Widgets below the content', 'electroserv'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'electroserv') ),
					"std" => 'hide',
					"options" => array(),
					"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_page_blog' => array(
					"title" => esc_html__('Widgets at the bottom of the page', 'electroserv'),
					"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'electroserv') ),
					"std" => 'hide',
					"options" => array(),
					"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
					),

				'blog_advanced_info' => array(
					"title" => esc_html__('Advanced settings', 'electroserv'),
					"desc" => '',
					"type" => "info",
					),
				'no_image' => array(
					"title" => esc_html__('Image placeholder', 'electroserv'),
					"desc" => wp_kses_data( __('Select or upload an image used as placeholder for posts without a featured image', 'electroserv') ),
					"std" => '',
					"type" => "image"
					),
				'time_diff_before' => array(
					"title" => esc_html__('Easy Readable Date Format', 'electroserv'),
					"desc" => wp_kses_data( __("For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'electroserv') ),
					"std" => 5,
					"type" => "text"
					),
				'sticky_style' => array(
					"title" => esc_html__('Sticky posts style', 'electroserv'),
					"desc" => wp_kses_data( __('Select style of the sticky posts output', 'electroserv') ),
					"std" => 'inherit',
					"options" => array(
						'inherit' => esc_html__('Decorated posts', 'electroserv'),
						'columns' => esc_html__('Mini-cards',	'electroserv')
					),
					"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
					),
				"blog_animation" => array( 
					"title" => esc_html__('Animation for the posts', 'electroserv'),
					"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'electroserv') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'electroserv')
					),
					"dependency" => array(
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"std" => "none",
					"options" => array(),
					"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
					),
				'meta_parts' => array(
					"title" => esc_html__('Post meta', 'electroserv'),
					"desc" => wp_kses_data( __("If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page.", 'electroserv') )
								. '<br>'
								. wp_kses_data( __("<b>Tip:</b> Drag items to change their order.", 'electroserv') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'electroserv')
					),
					"dependency" => array(
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=1|date=1|counters=1|author=1|share=0|edit=0',
					"options" => array(
						'categories' => esc_html__('Categories', 'electroserv'),
						'date'		 => esc_html__('Post date', 'electroserv'),
						'author'	 => esc_html__('Post author', 'electroserv'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'electroserv'),
						'share'		 => esc_html__('Share links', 'electroserv'),
						'edit'		 => esc_html__('Edit link', 'electroserv')
					),
					"type" => ELECTROSERV_THEME_FREE ? "hidden" : "checklist"
				),
				'counters' => array(
					"title" => esc_html__('Views, Likes and Comments', 'electroserv'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'electroserv') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'electroserv')
					),
					"dependency" => array(
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=0|likes=0|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'electroserv'),
						'likes' => esc_html__('Likes', 'electroserv'),
						'comments' => esc_html__('Comments', 'electroserv')
					),
					"type" => ELECTROSERV_THEME_FREE ? "hidden" : "checklist"
				),

				
				// Blog - Single posts
				'blog_single' => array(
					"title" => esc_html__('Single posts', 'electroserv'),
					"desc" => wp_kses_data( __('Settings of the single post', 'electroserv') ),
					"type" => "section",
					),
				'hide_featured_on_single' => array(
					"title" => esc_html__('Hide featured image on the single post', 'electroserv'),
					"desc" => wp_kses_data( __("Hide featured image on the single post's pages", 'electroserv') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'electroserv')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				'hide_sidebar_on_single' => array(
					"title" => esc_html__('Hide sidebar on the single post', 'electroserv'),
					"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'electroserv') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'show_post_meta' => array(
					"title" => esc_html__('Show post meta', 'electroserv'),
					"desc" => wp_kses_data( __("Display block with post's meta: date, categories, counters, etc.", 'electroserv') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'meta_parts_post' => array(
					"title" => esc_html__('Post meta', 'electroserv'),
					"desc" => wp_kses_data( __("Meta parts for single posts.", 'electroserv') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=0|date=1|author=1|counters=1|share=0|edit=0',
					"options" => array(
						'categories' => esc_html__('Categories', 'electroserv'),
						'date'		 => esc_html__('Post date', 'electroserv'),
						'author'	 => esc_html__('Post author', 'electroserv'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'electroserv'),
						'share'		 => esc_html__('Share links', 'electroserv'),
						'edit'		 => esc_html__('Edit link', 'electroserv')
					),
					"type" => ELECTROSERV_THEME_FREE ? "hidden" : "checklist"
				),
				'counters_post' => array(
					"title" => esc_html__('Views, Likes and Comments', 'electroserv'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'electroserv') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=0|likes=0|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'electroserv'),
						'likes' => esc_html__('Likes', 'electroserv'),
						'comments' => esc_html__('Comments', 'electroserv')
					),
					"type" => ELECTROSERV_THEME_FREE ? "hidden" : "checklist"
				),
				'show_share_links' => array(
					"title" => esc_html__('Show share links', 'electroserv'),
					"desc" => wp_kses_data( __("Display share links on the single post", 'electroserv') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'show_author_info' => array(
					"title" => esc_html__('Show author info', 'electroserv'),
					"desc" => wp_kses_data( __("Display block with information about post's author", 'electroserv') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'blog_single_related_info' => array(
					"title" => esc_html__('Related posts', 'electroserv'),
					"desc" => '',
					"type" => "info",
					),
				'show_related_posts' => array(
					"title" => esc_html__('Show related posts', 'electroserv'),
					"desc" => wp_kses_data( __("Show section 'Related posts' on the single post's pages", 'electroserv') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'electroserv')
					),
					"std" => 1,
					"type" => "checkbox"
					),
				'related_posts' => array(
					"title" => esc_html__('Related posts', 'electroserv'),
					"desc" => wp_kses_data( __('How many related posts should be displayed in the single post? If 0 - no related posts showed.', 'electroserv') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => electroserv_get_list_range(1,9),
					"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
					),
				'related_columns' => array(
					"title" => esc_html__('Related columns', 'electroserv'),
					"desc" => wp_kses_data( __('How many columns should be used to output related posts in the single page (from 2 to 4)?', 'electroserv') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => electroserv_get_list_range(1,4),
					"type" => ELECTROSERV_THEME_FREE ? "hidden" : "switch"
					),
				'related_style' => array(
					"title" => esc_html__('Related posts style', 'electroserv'),
					"desc" => wp_kses_data( __('Select style of the related posts output', 'electroserv') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => electroserv_get_list_styles(1,2),
					"type" => ELECTROSERV_THEME_FREE ? "hidden" : "switch"
					),
			'blog_end' => array(
				"type" => "panel_end",
				),
			
		
		
			// 'Colors'
			'panel_colors' => array(
				"title" => esc_html__('Colors', 'electroserv'),
				"desc" => '',
				"priority" => 300,
				"type" => "section"
				),

			'color_schemes_info' => array(
				"title" => esc_html__('Color schemes', 'electroserv'),
				"desc" => wp_kses_data( __('Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'electroserv') ),
				"type" => "info",
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'electroserv'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'electroserv')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'electroserv'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'electroserv')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Sidemenu Color Scheme', 'electroserv'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'electroserv')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "switch"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'electroserv'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'electroserv')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'electroserv'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'electroserv')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),

			'color_scheme_editor_info' => array(
				"title" => esc_html__('Color scheme editor', 'electroserv'),
				"desc" => wp_kses_data(__('Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'electroserv') ),
				"type" => "info",
				),
			'scheme_storage' => array(
				"title" => esc_html__('Color scheme editor', 'electroserv'),
				"desc" => '',
				"std" => '$electroserv_get_scheme_storage',
				"refresh" => false,
				"colorpicker" => "tiny",
				"type" => "scheme_editor"
				),


			// 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'electroserv'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'electroserv') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'electroserv')
				),
				"hidden" => true,
				"std" => '',
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'electroserv'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'electroserv') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'electroserv')
				),
				"hidden" => true,
				"std" => '',
				"type" => ELECTROSERV_THEME_FREE ? "hidden" : "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"type" => "hidden",
				),

			'last_option' => array(
				"title" => '',
				"desc" => '',
				"std" => 1,
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// 'Fonts'
			'fonts' => array(
				"title" => esc_html__('Typography', 'electroserv'),
				"desc" => '',
				"priority" => 200,
				"type" => "panel"
				),

			// Fonts - Load_fonts
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'electroserv'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'electroserv') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'electroserv') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'electroserv'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'electroserv') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'electroserv') ),
				"class" => "electroserv_column-1_3 electroserv_new_row",
				"refresh" => false,
				"std" => '$electroserv_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=electroserv_get_theme_setting('max_load_fonts'); $i++) {
			if (electroserv_get_value_gp('page') != 'theme_options') {
				$fonts["load_fonts-{$i}-info"] = array(
					"title" => esc_html(sprintf(__('Font %s', 'electroserv'), $i)),
					"desc" => '',
					"type" => "info",
					);
			}
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'electroserv'),
				"desc" => '',
				"class" => "electroserv_column-1_3 electroserv_new_row",
				"refresh" => false,
				"std" => '$electroserv_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'electroserv'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'electroserv') )
							: '',
				"class" => "electroserv_column-1_3",
				"refresh" => false,
				"std" => '$electroserv_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'electroserv'),
					'serif' => esc_html__('serif', 'electroserv'),
					'sans-serif' => esc_html__('sans-serif', 'electroserv'),
					'monospace' => esc_html__('monospace', 'electroserv'),
					'cursive' => esc_html__('cursive', 'electroserv'),
					'fantasy' => esc_html__('fantasy', 'electroserv')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'electroserv'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'electroserv') )
								. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'electroserv') )
							: '',
				"class" => "electroserv_column-1_3",
				"refresh" => false,
				"std" => '$electroserv_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = electroserv_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								: esc_html(sprintf(__('%s settings', 'electroserv'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'electroserv'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'electroserv'),
						'100' => esc_html__('100 (Light)', 'electroserv'), 
						'200' => esc_html__('200 (Light)', 'electroserv'), 
						'300' => esc_html__('300 (Thin)',  'electroserv'),
						'400' => esc_html__('400 (Normal)', 'electroserv'),
						'500' => esc_html__('500 (Semibold)', 'electroserv'),
						'600' => esc_html__('600 (Semibold)', 'electroserv'),
						'700' => esc_html__('700 (Bold)', 'electroserv'),
						'800' => esc_html__('800 (Black)', 'electroserv'),
						'900' => esc_html__('900 (Black)', 'electroserv')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'electroserv'),
						'normal' => esc_html__('Normal', 'electroserv'), 
						'italic' => esc_html__('Italic', 'electroserv')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'electroserv'),
						'none' => esc_html__('None', 'electroserv'), 
						'underline' => esc_html__('Underline', 'electroserv'),
						'overline' => esc_html__('Overline', 'electroserv'),
						'line-through' => esc_html__('Line-through', 'electroserv')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'electroserv'),
						'none' => esc_html__('None', 'electroserv'), 
						'uppercase' => esc_html__('Uppercase', 'electroserv'),
						'lowercase' => esc_html__('Lowercase', 'electroserv'),
						'capitalize' => esc_html__('Capitalize', 'electroserv')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"class" => "electroserv_column-1_5",
					"refresh" => false,
					"std" => '$electroserv_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters to Theme Options
		electroserv_storage_set_array_before('options', 'panel_colors', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			electroserv_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'electroserv'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'electroserv') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'electroserv')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}
	}
}


// Returns a list of options that can be overridden for CPT
if (!function_exists('electroserv_options_get_list_cpt_options')) {
	function electroserv_options_get_list_cpt_options($cpt, $title='') {
		if (empty($title)) $title = ucfirst($cpt);
		return array(
					"header_info_{$cpt}" => array(
						"title" => esc_html__('Header', 'electroserv'),
						"desc" => '',
						"type" => "info",
						),
					"header_type_{$cpt}" => array(
						"title" => esc_html__('Header style', 'electroserv'),
						"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the AncoraThemes Addons is activated)', 'electroserv') ),
						"std" => 'inherit',
						"options" => electroserv_get_list_header_footer_types(true),
						"type" => ELECTROSERV_THEME_FREE ? "hidden" : "switch"
						),
					"header_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'electroserv'),
						"desc" => wp_kses_data( sprintf(__('Select custom layout to display the site header on the %s pages', 'electroserv'), $title) ),
						"dependency" => array(
							"header_type_{$cpt}" => array('custom')
						),
						"std" => 'inherit',
						"options" => array(),
						"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
						),
					"header_position_{$cpt}" => array(
						"title" => esc_html__('Header position', 'electroserv'),
						"desc" => wp_kses_data( sprintf(__('Select position to display the site header on the %s pages', 'electroserv'), $title) ),
						"std" => 'inherit',
						"options" => array(),
						"type" => ELECTROSERV_THEME_FREE ? "hidden" : "switch"
						),
					"header_image_override_{$cpt}" => array(
						"title" => esc_html__('Header image override', 'electroserv'),
						"desc" => wp_kses_data( __("Allow override the header image with the post's featured image", 'electroserv') ),
						"std" => 0,
						"type" => ELECTROSERV_THEME_FREE ? "hidden" : "checkbox"
						),
					"header_widgets_{$cpt}" => array(
						"title" => esc_html__('Header widgets', 'electroserv'),
						"desc" => wp_kses_data( sprintf(__('Select set of widgets to show in the header on the %s pages', 'electroserv'), $title) ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
						
					"sidebar_info_{$cpt}" => array(
						"title" => esc_html__('Sidebar', 'electroserv'),
						"desc" => '',
						"type" => "info",
						),
					"sidebar_position_{$cpt}" => array(
						"title" => esc_html__('Sidebar position', 'electroserv'),
						"desc" => wp_kses_data( sprintf(__('Select position to show sidebar on the %s pages', 'electroserv'), $title) ),
						"refresh" => false,
						"std" => 'left',
						"options" => array(),
						"type" => "switch"
						),
					"sidebar_widgets_{$cpt}" => array(
						"title" => esc_html__('Sidebar widgets', 'electroserv'),
						"desc" => wp_kses_data( sprintf(__('Select sidebar to show on the %s pages', 'electroserv'), $title) ),
						"dependency" => array(
							"sidebar_position_{$cpt}" => array('left', 'right')
						),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"hide_sidebar_on_single_{$cpt}" => array(
						"title" => esc_html__('Hide sidebar on the single pages', 'electroserv'),
						"desc" => wp_kses_data( __("Hide sidebar on the single page", 'electroserv') ),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"footer_info_{$cpt}" => array(
						"title" => esc_html__('Footer', 'electroserv'),
						"desc" => '',
						"type" => "info",
						),
					"footer_type_{$cpt}" => array(
						"title" => esc_html__('Footer style', 'electroserv'),
						"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'electroserv') ),
						"std" => 'inherit',
						"options" => electroserv_get_list_header_footer_types(true),
						"type" => ELECTROSERV_THEME_FREE ? "hidden" : "switch"
						),
					"footer_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'electroserv'),
						"desc" => wp_kses_data( __('Select custom layout to display the site footer', 'electroserv') ),
						"std" => 'inherit',
						"dependency" => array(
							"footer_type_{$cpt}" => array('custom')
						),
						"options" => array(),
						"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
						),
					"footer_widgets_{$cpt}" => array(
						"title" => esc_html__('Footer widgets', 'electroserv'),
						"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'electroserv') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 'footer_widgets',
						"options" => array(),
						"type" => "select"
						),
					"footer_columns_{$cpt}" => array(
						"title" => esc_html__('Footer columns', 'electroserv'),
						"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'electroserv') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default'),
							"footer_widgets_{$cpt}" => array('^hide')
						),
						"std" => 0,
						"options" => electroserv_get_list_range(0,6),
						"type" => "select"
						),
					"footer_wide_{$cpt}" => array(
						"title" => esc_html__('Footer fullwide', 'electroserv'),
						"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'electroserv') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"widgets_info_{$cpt}" => array(
						"title" => esc_html__('Additional panels', 'electroserv'),
						"desc" => '',
						"type" => ELECTROSERV_THEME_FREE ? "hidden" : "info",
						),
					"widgets_above_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the top of the page', 'electroserv'),
						"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'electroserv') ),
						"std" => 'hide',
						"options" => array(),
						"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
						),
					"widgets_above_content_{$cpt}" => array(
						"title" => esc_html__('Widgets above the content', 'electroserv'),
						"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'electroserv') ),
						"std" => 'hide',
						"options" => array(),
						"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_content_{$cpt}" => array(
						"title" => esc_html__('Widgets below the content', 'electroserv'),
						"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'electroserv') ),
						"std" => 'hide',
						"options" => array(),
						"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the bottom of the page', 'electroserv'),
						"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'electroserv') ),
						"std" => 'hide',
						"options" => array(),
						"type" => ELECTROSERV_THEME_FREE ? "hidden" : "select"
						)
					);
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('electroserv_options_get_list_choises')) {
	add_filter('electroserv_filter_options_get_list_choises', 'electroserv_options_get_list_choises', 10, 2);
	function electroserv_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = electroserv_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = electroserv_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = electroserv_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (substr($id, -7) == '_scheme')
				$list = electroserv_get_list_schemes($id!='color_scheme');
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = electroserv_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = electroserv_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = electroserv_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = electroserv_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = electroserv_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = electroserv_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = electroserv_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = electroserv_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = electroserv_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = electroserv_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = electroserv_array_merge(array(0 => esc_html__('- Select category -', 'electroserv')), electroserv_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = electroserv_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = electroserv_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = electroserv_get_list_load_fonts(true);
		}
		return $list;
	}
}
?>