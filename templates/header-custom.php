<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0.06
 */

$electroserv_header_css = '';
$electroserv_header_image = get_header_image();
$electroserv_header_video = electroserv_get_header_video();
if (!empty($electroserv_header_image) && electroserv_trx_addons_featured_image_override(is_singular() || electroserv_storage_isset('blog_archive') || is_category())) {
	$electroserv_header_image = electroserv_get_current_mode_image($electroserv_header_image);
}

$electroserv_header_id = str_replace('header-custom-', '', electroserv_get_theme_option("header_style"));
if ((int) $electroserv_header_id == 0) {
	$electroserv_header_id = electroserv_get_post_id(array(
			'name' => $electroserv_header_id,
			'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
		)
	);
} else {
	$electroserv_header_id = apply_filters('electroserv_filter_get_translated_layout', $electroserv_header_id);
}
$electroserv_header_meta = get_post_meta($electroserv_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($electroserv_header_id);
?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($electroserv_header_id)));
echo !empty($electroserv_header_image) || !empty($electroserv_header_video)
	? ' with_bg_image'
	: ' without_bg_image';
if ($electroserv_header_video!='')
	echo ' with_bg_video';
if ($electroserv_header_image!='')
	echo ' '.esc_attr(electroserv_add_inline_css_class('background-image: url('.esc_url($electroserv_header_image).');'));
if (!empty($electroserv_header_meta['margin']) != '')
	echo ' '.esc_attr(electroserv_add_inline_css_class('margin-bottom: '.esc_attr(electroserv_prepare_css_value($electroserv_header_meta['margin'])).';'));
if (is_single() && has_post_thumbnail())
	echo ' with_featured_image';
if (electroserv_is_on(electroserv_get_theme_option('header_fullheight')))
	echo ' header_fullheight electroserv-full-height';
if (!electroserv_is_inherit(electroserv_get_theme_option('header_scheme')))
	echo ' scheme_' . esc_attr(electroserv_get_theme_option('header_scheme'));
?>"><?php


	// Background video
	if (!empty($electroserv_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('electroserv_action_show_layout', $electroserv_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>