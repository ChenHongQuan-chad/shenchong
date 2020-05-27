<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

if (electroserv_sidebar_present()) {
	ob_start();
	$electroserv_sidebar_name = electroserv_get_theme_option('sidebar_widgets');
	electroserv_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($electroserv_sidebar_name) ) {
		dynamic_sidebar($electroserv_sidebar_name);
	}
	$electroserv_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($electroserv_out)) {
		$electroserv_sidebar_position = electroserv_get_theme_option('sidebar_position');
		?>
		<div class="sidebar <?php echo esc_attr($electroserv_sidebar_position); ?> widget_area<?php if (!electroserv_is_inherit(electroserv_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(electroserv_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'electroserv_action_before_sidebar' );
				electroserv_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $electroserv_out));
				do_action( 'electroserv_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>