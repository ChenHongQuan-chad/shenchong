<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0.10
 */


// Socials
if ( electroserv_is_on(electroserv_get_theme_option('socials_in_footer')) && ($electroserv_output = electroserv_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php electroserv_show_layout($electroserv_output); ?>
		</div>
	</div>
	<?php
}
?>