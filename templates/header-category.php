<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js scheme_<?php
										 // Class scheme_xxx need in the <html> as context for the <body>!
										 echo esc_attr(electroserv_get_theme_option('color_scheme'));
										 ?>">
<head>
	<link href="https://cdn.bootcss.com/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/theme.css">
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>

	<?php do_action( 'electroserv_action_before' ); ?>

	<div class="body_wrap">

		<div class="page_wrap"><?php

			/**
			 * The template to display default site header
			 *
			 * @package WordPress
			 * @subpackage ELECTROSERV
			 * @since ELECTROSERV 1.0
			 */


			$electroserv_header_css = '';
			$electroserv_header_image = get_header_image();
			$electroserv_header_video = electroserv_get_header_video();
			if (!empty($electroserv_header_image) && electroserv_trx_addons_featured_image_override(is_singular() || electroserv_storage_isset('blog_archive') || is_category())) {
				$electroserv_header_image = electroserv_get_current_mode_image($electroserv_header_image);
			}

			?><header class="top_panel top_panel_default<?php
			echo !empty($electroserv_header_image) || !empty($electroserv_header_video) ? ' with_bg_image' : ' without_bg_image';
			if ($electroserv_header_video!='') echo ' with_bg_video';
			if ($electroserv_header_image!='') echo ' '.esc_attr(electroserv_add_inline_css_class('background-image: url('.esc_url($electroserv_header_image).');'));
			if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
			if (electroserv_is_on(electroserv_get_theme_option('header_fullheight'))) echo ' header_fullheight electroserv-full-height';
			if (!electroserv_is_inherit(electroserv_get_theme_option('header_scheme')))
				echo ' scheme_' . esc_attr(electroserv_get_theme_option('header_scheme'));
			?>"><?php


				// Background video
				if (!empty($electroserv_header_video)) {
					get_template_part( 'templates/header-video' );
				}
				
				// Main menu
				if (electroserv_get_theme_option("menu_style") == 'top') {
					get_template_part( 'templates/header-navi' );
				}

				// Page title and breadcrumbs area
				get_template_part( 'templates/header-title');

				// Header widgets area
				get_template_part( 'templates/header-widgets' );


			?></header>
			<?php
			// Side menu
			if (in_array(electroserv_get_theme_option('menu_style'), array('left', 'right'))) {
				get_template_part( 'templates/header-navi-side' );
			}

			// Mobile header
			get_template_part( 'templates/header-mobile');
			?>

			<div class="page_content_wrap">

				<?php if (electroserv_get_theme_option('body_style') != 'fullscreen') { ?>
				<div class="content_wrap">
				<?php } ?>

					<?php
					// Widgets area above page content
					electroserv_create_widgets_area('widgets_above_page');
					?>				

					<div class="content product-category">
						<?php
						// Widgets area inside page content
						electroserv_create_widgets_area('widgets_above_content');
						?>				
