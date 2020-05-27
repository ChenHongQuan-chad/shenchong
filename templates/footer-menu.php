<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0.10
 */

// Footer menu
$electroserv_menu_footer = electroserv_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($electroserv_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php electroserv_show_layout($electroserv_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>