<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0.10
 */

// Footer sidebar
$electroserv_footer_name = electroserv_get_theme_option('footer_widgets');
$electroserv_footer_present = !electroserv_is_off($electroserv_footer_name) && is_active_sidebar($electroserv_footer_name);
if ($electroserv_footer_present) { 
	electroserv_storage_set('current_sidebar', 'footer');
	$electroserv_footer_wide = electroserv_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($electroserv_footer_name) ) {
		dynamic_sidebar($electroserv_footer_name);
	}
	$electroserv_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($electroserv_out)) {
		$electroserv_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $electroserv_out);
		$electroserv_need_columns = true;
		if ($electroserv_need_columns) {
			$electroserv_columns = max(0, (int) electroserv_get_theme_option('footer_columns'));
			if ($electroserv_columns == 0) $electroserv_columns = min(4, max(1, substr_count($electroserv_out, '<aside ')));
			if ($electroserv_columns > 1)
				$electroserv_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($electroserv_columns).' widget ', $electroserv_out);
			else
				$electroserv_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($electroserv_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$electroserv_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($electroserv_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'electroserv_action_before_sidebar' );
				electroserv_show_layout($electroserv_out);
				do_action( 'electroserv_action_after_sidebar' );
				if ($electroserv_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$electroserv_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>