<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

$electroserv_args = get_query_var('electroserv_logo_args');

// Site logo
$electroserv_logo_image  = electroserv_get_logo_image(isset($electroserv_args['type']) ? $electroserv_args['type'] : '');
$electroserv_logo_text   = electroserv_is_on(electroserv_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$electroserv_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($electroserv_logo_image) || !empty($electroserv_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($electroserv_logo_image)) {
			$electroserv_attr = electroserv_getimagesize($electroserv_logo_image);
			echo '<img src="'.esc_url($electroserv_logo_image).'" alt="'.esc_attr__('logo_image', 'electroserv').'"'.(!empty($electroserv_attr[3]) ? sprintf(' %s', $electroserv_attr[3]) : '').'>';
		} else {
			electroserv_show_layout(electroserv_prepare_macros($electroserv_logo_text), '<span class="logo_text">', '</span>');
			electroserv_show_layout(electroserv_prepare_macros($electroserv_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>