<?php
/**
 * Information about this theme
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0.30
 */


// Redirect to the 'About Theme' page after switch theme
if (!function_exists('electroserv_about_after_switch_theme')) {
	add_action('after_switch_theme', 'electroserv_about_after_switch_theme', 1000);
	function electroserv_about_after_switch_theme() {
		update_option('electroserv_about_page', 1);
	}
}
if ( !function_exists('electroserv_about_after_setup_theme') ) {
	add_action( 'init', 'electroserv_about_after_setup_theme', 1000 );
	function electroserv_about_after_setup_theme() {
		if (get_option('electroserv_about_page') == 1) {
			update_option('electroserv_about_page', 0);
			wp_safe_redirect(admin_url().'themes.php?page=electroserv_about');
			exit();
		}
	}
}


// Add 'About Theme' item in the Appearance menu
if (!function_exists('electroserv_about_add_menu_items')) {
	add_action( 'admin_menu', 'electroserv_about_add_menu_items' );
	function electroserv_about_add_menu_items() {
		$theme = wp_get_theme();
		$theme_name = $theme->name . (ELECTROSERV_THEME_FREE ? ' ' . esc_html__('Free', 'electroserv') : '');
		add_theme_page(
			sprintf(esc_html__('About %s', 'electroserv'), $theme_name),	//page_title
			sprintf(esc_html__('About %s', 'electroserv'), $theme_name),	//menu_title
			'manage_options',											//capability
			'electroserv_about',											//menu_slug
			'electroserv_about_page_builder',								//callback
			'dashicons-format-status',									//icon
			''															//menu position
		);
	}
}


// Load page-specific scripts and styles
if (!function_exists('electroserv_about_enqueue_scripts')) {
	add_action( 'admin_enqueue_scripts', 'electroserv_about_enqueue_scripts' );
	function electroserv_about_enqueue_scripts() {
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && $screen->id == 'appearance_page_electroserv_about') {
			// Scripts
			wp_enqueue_script( 'jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true );
			if ( ($fdir = electroserv_get_file_url('theme-specific/theme.about/theme.about.js')) != '' )
				wp_enqueue_script( 'electroserv-about', $fdir, array('jquery'), null, true );
			
			if (function_exists('electroserv_plugins_installer_enqueue_scripts'))
				electroserv_plugins_installer_enqueue_scripts();
			
			// Styles
			wp_enqueue_style( 'electroserv-icons',  electroserv_get_file_url('css/font-icons/css/fontello-embedded.css') );
			if ( ($fdir = electroserv_get_file_url('theme-specific/theme.about/theme.about.css')) != '' )
				wp_enqueue_style( 'electroserv-about',  $fdir, array(), null );
		}
	}
}


// Build 'About Theme' page
if (!function_exists('electroserv_about_page_builder')) {
	function electroserv_about_page_builder() {
		$theme = wp_get_theme();
		?>
		<div class="electroserv_about">
			<div class="electroserv_about_header">
				<?php if (ELECTROSERV_THEME_FREE) { ?>
					<a href="<?php echo esc_url(electroserv_storage_get('theme_download_url')); ?>"
										   target="_blank"
										   class="electroserv_about_pro_link button button-primary"><?php
											esc_html_e('Get PRO version', 'electroserv');
										?></a>
				<?php } ?>
				<h1 class="electroserv_about_title"><?php
					echo sprintf(esc_html__('Welcome to %s %s v.%s', 'electroserv'),
								$theme->name,
								ELECTROSERV_THEME_FREE ? __('Free', 'electroserv') : '',
								$theme->version
								);
				?></h1>
				<div class="electroserv_about_description">
					<?php
					if (ELECTROSERV_THEME_FREE) {
						?><p><?php
							echo wp_kses_data(sprintf(__('Now you are using Free version of <a href="%s">%s Pro Theme</a>.', 'electroserv'),
														esc_url(electroserv_storage_get('theme_download_url')),
														$theme->name
														)
												);
							echo '<br>' . wp_kses_data(sprintf(__('This version is SEO- and Retina-ready. It also has a built-in support for parallax and slider with swipe gestures. %s Free is compatible with many popular plugins, such as %s', 'electroserv'),
														$theme->name,
														electroserv_about_get_supported_plugins()
														)
												);
						?></p>
						<p><?php
							echo wp_kses_data(sprintf(__('We hope you have a great acquaintance with our themes. If you are looking for a fully functional website, you can get the <a href="%s">Pro Version here</a>', 'electroserv'),
														esc_url(electroserv_storage_get('theme_download_url'))
														)
												);
						?></p><?php
					} else {
						?><p><?php
							echo wp_kses_data(sprintf(__('%s is a Premium WordPress theme. It has a built-in support for parallax, slider with swipe gestures, and is SEO- and Retina-ready', 'electroserv'),
														$theme->name
														)
												);
						?></p>
						<p><?php
							echo wp_kses_data(sprintf(__('The Premium Theme is compatible with many popular plugins, such as %s', 'electroserv'),
														electroserv_about_get_supported_plugins()
														)
												);
						?></p><?php
					}
					?>
				</div>
			</div>
			<div id="electroserv_about_tabs" class="electroserv_tabs electroserv_about_tabs">
				<ul>
					<li><a href="#electroserv_about_section_start"><?php esc_html_e('Getting started', 'electroserv'); ?></a></li>
					<li><a href="#electroserv_about_section_actions"><?php esc_html_e('Recommended actions', 'electroserv'); ?></a></li>
					<?php if (ELECTROSERV_THEME_FREE) { ?>
						<li><a href="#electroserv_about_section_pro"><?php esc_html_e('Free vs PRO', 'electroserv'); ?></a></li>
					<?php } ?>
				</ul>
				<div id="electroserv_about_section_start" class="electroserv_tabs_section electroserv_about_section"><?php
				
					// Install required plugins
					if (!electroserv_exists_trx_addons()) {
						?><div class="electroserv_about_block"><div class="electroserv_about_block_inner">
							<h2 class="electroserv_about_block_title">
								<i class="dashicons dashicons-admin-plugins"></i>
								<?php esc_html_e('ThemeREX Addons', 'electroserv'); ?>
							</h2>
							<div class="electroserv_about_block_description"><?php
								echo esc_html(sprintf(__('It is highly recommended that you install the companion plugin "ThemeREX Addons" to have access to the layouts builder, awesome shortcodes, team and testimonials, services and slider, and many other features ...', 'electroserv'), $theme->name));
							?></div>
							<?php electroserv_plugins_installer_get_button_html('trx_addons'); ?>
						</div></div><?php
					}
					
					// Install recommended plugins
					?><div class="electroserv_about_block"><div class="electroserv_about_block_inner">
						<h2 class="electroserv_about_block_title">
							<i class="dashicons dashicons-admin-plugins"></i>
							<?php esc_html_e('Recommended plugins', 'electroserv'); ?>
						</h2>
						<div class="electroserv_about_block_description"><?php
							echo esc_html(sprintf(__('Theme %s is compatible with a large number of popular plugins. You can install only those that are going to use in the near future.', 'electroserv'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>"
						   class="electroserv_about_block_link button button-primary"><?php
							esc_html_e('Install plugins', 'electroserv');
						?></a>
					</div></div><?php
					
					// Customizer or Theme Options
					?><div class="electroserv_about_block"><div class="electroserv_about_block_inner">
						<h2 class="electroserv_about_block_title">
							<i class="dashicons dashicons-admin-appearance"></i>
							<?php esc_html_e('Setup Theme options', 'electroserv'); ?>
						</h2>
						<div class="electroserv_about_block_description"><?php
							esc_html_e('Using the WordPress Customizer you can easily customize every aspect of the theme. If you want to use the standard theme settings page - open Theme Options and follow the same steps there.', 'electroserv');
						?></div>
						<a href="<?php echo esc_url(admin_url().'customize.php'); ?>"
						   class="electroserv_about_block_link button button-primary"><?php
							esc_html_e('Customizer', 'electroserv');
						?></a>
						<?php esc_html_e('or', 'electroserv'); ?>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>"
						   class="electroserv_about_block_link button"><?php
							esc_html_e('Theme Options', 'electroserv');
						?></a>
					</div></div><?php
					
					// Documentation
					?><div class="electroserv_about_block"><div class="electroserv_about_block_inner">
						<h2 class="electroserv_about_block_title">
							<i class="dashicons dashicons-book"></i>
							<?php esc_html_e('Read full documentation', 'electroserv');	?>
						</h2>
						<div class="electroserv_about_block_description"><?php
							echo esc_html(sprintf(__('Need more details? Please check our full online documentation for detailed information on how to use %s.', 'electroserv'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(electroserv_storage_get('theme_doc_url')); ?>"
						   target="_blank"
						   class="electroserv_about_block_link button button-primary"><?php
							esc_html_e('Documentation', 'electroserv');
						?></a>
					</div></div><?php
					
					// Support
					if (!ELECTROSERV_THEME_FREE) {
						?><div class="electroserv_about_block"><div class="electroserv_about_block_inner">
							<h2 class="electroserv_about_block_title">
								<i class="dashicons dashicons-sos"></i>
								<?php esc_html_e('Support', 'electroserv'); ?>
							</h2>
							<div class="electroserv_about_block_description"><?php
								echo esc_html(sprintf(__('We want to make sure you have the best experience using %s and that is why we gathered here all the necessary informations for you.', 'electroserv'), $theme->name));
							?></div>
							<a href="<?php echo esc_url(electroserv_storage_get('theme_support_url')); ?>"
							   target="_blank"
							   class="electroserv_about_block_link button button-primary"><?php
								esc_html_e('Support', 'electroserv');
							?></a>
						</div></div><?php
					}
					
					// Online Demo
					?><div class="electroserv_about_block"><div class="electroserv_about_block_inner">
						<h2 class="electroserv_about_block_title">
							<i class="dashicons dashicons-images-alt2"></i>
							<?php esc_html_e('On-line demo', 'electroserv'); ?>
						</h2>
						<div class="electroserv_about_block_description"><?php
							echo esc_html(sprintf(__('Visit the Demo Version of %s to check out all the features it has', 'electroserv'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(electroserv_storage_get('theme_demo_url')); ?>"
						   target="_blank"
						   class="electroserv_about_block_link button button-primary"><?php
							esc_html_e('View demo', 'electroserv');
						?></a>
					</div></div>
					
				</div>



				<div id="electroserv_about_section_actions" class="electroserv_tabs_section electroserv_about_section"><?php
				
					// Install required plugins
					if (!electroserv_exists_trx_addons()) {
						?><div class="electroserv_about_block"><div class="electroserv_about_block_inner">
							<h2 class="electroserv_about_block_title">
								<i class="dashicons dashicons-admin-plugins"></i>
								<?php esc_html_e('ThemeREX Addons', 'electroserv'); ?>
							</h2>
							<div class="electroserv_about_block_description"><?php
								echo esc_html(sprintf(__('It is highly recommended that you install the companion plugin "ThemeREX Addons" to have access to the layouts builder, awesome shortcodes, team and testimonials, services and slider, and many other features ...', 'electroserv'), $theme->name));
							?></div>
							<?php electroserv_plugins_installer_get_button_html('trx_addons'); ?>
						</div></div><?php
					}
					
					// Install recommended plugins
					?><div class="electroserv_about_block"><div class="electroserv_about_block_inner">
						<h2 class="electroserv_about_block_title">
							<i class="dashicons dashicons-admin-plugins"></i>
							<?php esc_html_e('Recommended plugins', 'electroserv'); ?>
						</h2>
						<div class="electroserv_about_block_description"><?php
							echo esc_html(sprintf(__('Theme %s is compatible with a large number of popular plugins. You can install only those that are going to use in the near future.', 'electroserv'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>"
						   class="electroserv_about_block_link button button button-primary"><?php
							esc_html_e('Install plugins', 'electroserv');
						?></a>
					</div></div><?php
					
					// Customizer or Theme Options
					?><div class="electroserv_about_block"><div class="electroserv_about_block_inner">
						<h2 class="electroserv_about_block_title">
							<i class="dashicons dashicons-admin-appearance"></i>
							<?php esc_html_e('Setup Theme options', 'electroserv'); ?>
						</h2>
						<div class="electroserv_about_block_description"><?php
							esc_html_e('Using the WordPress Customizer you can easily customize every aspect of the theme. If you want to use the standard theme settings page - open Theme Options and follow the same steps there.', 'electroserv');
						?></div>
						<a href="<?php echo esc_url(admin_url().'customize.php'); ?>"
						   target="_blank"
						   class="electroserv_about_block_link button button-primary"><?php
							esc_html_e('Customizer', 'electroserv');
						?></a>
						<?php esc_html_e('or', 'electroserv'); ?>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>"
						   class="electroserv_about_block_link button"><?php
							esc_html_e('Theme Options', 'electroserv');
						?></a>
					</div></div>
					
				</div>



				<?php if (ELECTROSERV_THEME_FREE) { ?>
					<div id="electroserv_about_section_pro" class="electroserv_tabs_section electroserv_about_section">
						<table class="electroserv_about_table" cellpadding="0" cellspacing="0" border="0">
							<thead>
								<tr>
									<td class="electroserv_about_table_info">&nbsp;</td>
									<td class="electroserv_about_table_check"><?php echo esc_html(sprintf(__('%s Free', 'electroserv'), $theme->name)); ?></td>
									<td class="electroserv_about_table_check"><?php echo esc_html(sprintf(__('%s PRO', 'electroserv'), $theme->name)); ?></td>
								</tr>
							</thead>
							<tbody>
	
	
								<?php
								// Responsive layouts
								?>
								<tr>
									<td class="electroserv_about_table_info">
										<h2 class="electroserv_about_table_info_title">
											<?php esc_html_e('Mobile friendly', 'electroserv'); ?>
										</h2>
										<div class="electroserv_about_table_info_description"><?php
											esc_html_e('Responsive layout. Looks great on any device.', 'electroserv');
										?></div>
									</td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Built-in slider
								?>
								<tr>
									<td class="electroserv_about_table_info">
										<h2 class="electroserv_about_table_info_title">
											<?php esc_html_e('Built-in posts slider', 'electroserv'); ?>
										</h2>
										<div class="electroserv_about_table_info_description"><?php
											esc_html_e('Allows you to add beautiful slides using the built-in shortcode/widget "Slider" with swipe gestures support.', 'electroserv');
										?></div>
									</td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Revolution slider
								if (electroserv_storage_isset('required_plugins', 'revslider')) {
								?>
								<tr>
									<td class="electroserv_about_table_info">
										<h2 class="electroserv_about_table_info_title">
											<?php esc_html_e('Revolution Slider Compatibility', 'electroserv'); ?>
										</h2>
										<div class="electroserv_about_table_info_description"><?php
											esc_html_e('Our built-in shortcode/widget "Slider" is able to work not only with posts, but also with slides created  in "Revolution Slider".', 'electroserv');
										?></div>
									</td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// SiteOrigin Panels
								if (electroserv_storage_isset('required_plugins', 'siteorigin-panels')) {
								?>
								<tr>
									<td class="electroserv_about_table_info">
										<h2 class="electroserv_about_table_info_title">
											<?php esc_html_e('Free PageBuilder', 'electroserv'); ?>
										</h2>
										<div class="electroserv_about_table_info_description"><?php
											esc_html_e('Full integration with a nice free page builder "SiteOrigin Panels".', 'electroserv');
										?></div>
									</td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<tr>
									<td class="electroserv_about_table_info">
										<h2 class="electroserv_about_table_info_title">
											<?php esc_html_e('Additional widgets pack', 'electroserv'); ?>
										</h2>
										<div class="electroserv_about_table_info_description"><?php
											esc_html_e('A number of useful widgets to create beautiful homepages and other sections of your website with SiteOrigin Panels.', 'electroserv');
										?></div>
									</td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// WPBakery Page Builder
								?>
								<tr>
									<td class="electroserv_about_table_info">
										<h2 class="electroserv_about_table_info_title">
											<?php esc_html_e('WPBakery Page Builder', 'electroserv'); ?>
										</h2>
										<div class="electroserv_about_table_info_description"><?php
											esc_html_e('Full integration with a very popular page builder "WPBakery Page Builder". A number of useful shortcodes and widgets to create beautiful homepages and other sections of your website.', 'electroserv');
										?></div>
									</td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<tr>
									<td class="electroserv_about_table_info">
										<h2 class="electroserv_about_table_info_title">
											<?php esc_html_e('Additional shortcodes pack', 'electroserv'); ?>
										</h2>
										<div class="electroserv_about_table_info_description"><?php
											esc_html_e('A number of useful shortcodes to create beautiful homepages and other sections of your website with WPBakery Page Builder.', 'electroserv');
										?></div>
									</td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Layouts builder
								?>
								<tr>
									<td class="electroserv_about_table_info">
										<h2 class="electroserv_about_table_info_title">
											<?php esc_html_e('Headers and Footers builder', 'electroserv'); ?>
										</h2>
										<div class="electroserv_about_table_info_description"><?php
											esc_html_e('Powerful visual builder of headers and footers! No manual code editing - use all the advantages of drag-and-drop technology.', 'electroserv');
										?></div>
									</td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// WooCommerce
								if (electroserv_storage_isset('required_plugins', 'woocommerce')) {
								?>
								<tr>
									<td class="electroserv_about_table_info">
										<h2 class="electroserv_about_table_info_title">
											<?php esc_html_e('WooCommerce Compatibility', 'electroserv'); ?>
										</h2>
										<div class="electroserv_about_table_info_description"><?php
											esc_html_e('Ready for e-commerce. You can build an online store with this theme.', 'electroserv');
										?></div>
									</td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// Easy Digital Downloads
								if (electroserv_storage_isset('required_plugins', 'easy-digital-downloads')) {
								?>
								<tr>
									<td class="electroserv_about_table_info">
										<h2 class="electroserv_about_table_info_title">
											<?php esc_html_e('Easy Digital Downloads Compatibility', 'electroserv'); ?>
										</h2>
										<div class="electroserv_about_table_info_description"><?php
											esc_html_e('Ready for digital e-commerce. You can build an online digital store with this theme.', 'electroserv');
										?></div>
									</td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// Other plugins
								?>
								<tr>
									<td class="electroserv_about_table_info">
										<h2 class="electroserv_about_table_info_title">
											<?php esc_html_e('Many other popular plugins compatibility', 'electroserv'); ?>
										</h2>
										<div class="electroserv_about_table_info_description"><?php
											esc_html_e('PRO version is compatible (was tested and has built-in support) with many popular plugins.', 'electroserv');
										?></div>
									</td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Support
								?>
								<tr>
									<td class="electroserv_about_table_info">
										<h2 class="electroserv_about_table_info_title">
											<?php esc_html_e('Support', 'electroserv'); ?>
										</h2>
										<div class="electroserv_about_table_info_description"><?php
											esc_html_e('Our premium support is going to take care of any problems, in case there will be any of course.', 'electroserv');
										?></div>
									</td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="electroserv_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Get PRO version
								?>
								<tr>
									<td class="electroserv_about_table_info">&nbsp;</td>
									<td class="electroserv_about_table_check" colspan="2">
										<a href="<?php echo esc_url(electroserv_storage_get('theme_download_url')); ?>"
										   target="_blank"
										   class="electroserv_about_block_link electroserv_about_pro_link button button-primary"><?php
											esc_html_e('Get PRO version', 'electroserv');
										?></a>
									</td>
								</tr>
	
							</tbody>
						</table>
					</div>
				<?php } ?>
				
			</div>
		</div>
		<?php
	}
}


// Utils
//------------------------------------

// Return supported plugin's names
if (!function_exists('electroserv_about_get_supported_plugins')) {
	function electroserv_about_get_supported_plugins() {
		return '"' . join('", "', array_values(electroserv_storage_get('required_plugins'))) . '"';
	}
}

require_once ELECTROSERV_THEME_DIR . 'includes/plugins.installer/plugins.installer.php';
?>