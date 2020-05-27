<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0.10
 */

// Logo
if (electroserv_is_on(electroserv_get_theme_option('logo_in_footer'))) {
	$electroserv_logo_image = '';
	if (electroserv_is_on(electroserv_get_theme_option('logo_retina_enabled')) && electroserv_get_retina_multiplier(2) > 1)
		$electroserv_logo_image = electroserv_get_theme_option( 'logo_footer_retina' );
	if (empty($electroserv_logo_image)) 
		$electroserv_logo_image = electroserv_get_theme_option( 'logo_footer' );
	$electroserv_logo_text   = get_bloginfo( 'name' );
	if (!empty($electroserv_logo_image) || !empty($electroserv_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($electroserv_logo_image)) {
					$electroserv_attr = electroserv_getimagesize($electroserv_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($electroserv_logo_image).'" class="logo_footer_image" alt="'.esc_attr__('logo_footer', 'electroserv').'"'.(!empty($electroserv_attr[3]) ? sprintf(' %s', $electroserv_attr[3]) : '').'></a>' ;
				} else if (!empty($electroserv_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($electroserv_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>