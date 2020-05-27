<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

// Header sidebar
$electroserv_header_name = electroserv_get_theme_option('header_widgets');
$electroserv_header_present = !electroserv_is_off($electroserv_header_name) && is_active_sidebar($electroserv_header_name);
if ($electroserv_header_present) { 
	electroserv_storage_set('current_sidebar', 'header');
	$electroserv_header_wide = electroserv_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($electroserv_header_name) ) {
		dynamic_sidebar($electroserv_header_name);
	}
	$electroserv_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($electroserv_widgets_output)) {
		$electroserv_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $electroserv_widgets_output);
		$electroserv_need_columns = strpos($electroserv_widgets_output, 'columns_wrap')===false;
		if ($electroserv_need_columns) {
			$electroserv_columns = max(0, (int) electroserv_get_theme_option('header_columns'));
			if ($electroserv_columns == 0) $electroserv_columns = min(6, max(1, substr_count($electroserv_widgets_output, '<aside ')));
			if ($electroserv_columns > 1)
				$electroserv_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($electroserv_columns).' widget ', $electroserv_widgets_output);
			else
				$electroserv_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($electroserv_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$electroserv_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($electroserv_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'electroserv_action_before_sidebar' );
				electroserv_show_layout($electroserv_widgets_output);
				do_action( 'electroserv_action_after_sidebar' );
				if ($electroserv_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$electroserv_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>