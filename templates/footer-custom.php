<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0.10
 */

$electroserv_footer_scheme =  electroserv_is_inherit(electroserv_get_theme_option('footer_scheme')) ? electroserv_get_theme_option('color_scheme') : electroserv_get_theme_option('footer_scheme');
$electroserv_footer_id = str_replace('footer-custom-', '', electroserv_get_theme_option("footer_style"));
if ((int) $electroserv_footer_id == 0) {
	$electroserv_footer_id = electroserv_get_post_id(array(
												'name' => $electroserv_footer_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUT_PT') ? TRX_ADDONS_CPT_LAYOUT_PT : 'cpt_layouts'
												)
											);
} else {
	$electroserv_footer_id = apply_filters('electroserv_filter_get_translated_layout', $electroserv_footer_id);
}
$electroserv_footer_meta = get_post_meta($electroserv_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($electroserv_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($electroserv_footer_id))); 
						if (!empty($electroserv_footer_meta['margin']) != '') 
							echo ' '.esc_attr(electroserv_add_inline_css_class('margin-top: '.esc_attr(electroserv_prepare_css_value($electroserv_footer_meta['margin'])).';'));
						?> scheme_<?php echo esc_attr($electroserv_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('electroserv_action_show_layout', $electroserv_footer_id);
	?>
</footer><!-- /.footer_wrap -->
