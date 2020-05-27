<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

						// Widgets area inside page content
						electroserv_create_widgets_area('widgets_below_content');
						?>	
					</div><!-- </.content> -->
					<?php get_sidebar()?>
						
					<?php
					// Show main sidebar

					//去除原文本得sidebar
					// get_sidebar();

					// Widgets area below page content
					electroserv_create_widgets_area('widgets_below_page');

					$electroserv_body_style = electroserv_get_theme_option('body_style');
					if ($electroserv_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$electroserv_footer_type = electroserv_get_theme_option("footer_type");
			if ($electroserv_footer_type == 'custom' && !electroserv_is_layouts_available())
				$electroserv_footer_type = 'default';
			get_template_part( "templates/footer-{$electroserv_footer_type}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (electroserv_is_on(electroserv_get_theme_option('debug_mode')) && electroserv_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(electroserv_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>
	<?php if (is_single()) { ?>
	<script src="https://cdn.bootcdn.net/ajax/libs/jquery-smooth-scroll/2.2.0/jquery.smooth-scroll.min.js"></script>
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/theme.js"></script>	
	<?php } ?>
	<?php if (is_category()) { ?>
	<script src="https://cdn.bootcdn.net/ajax/libs/jquery-smooth-scroll/2.2.0/jquery.smooth-scroll.min.js"></script>
	<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<?php } ?>
</body>
</html>