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
	<link rel="shortcut icon" href="/wp-content/uploads/2020/05/shenchong-icon.ico" type="image/x-icon">
	<link rel="apple-touch-icon-precomposed" type="image/png" href="/wp-content/uploads/2020/05/shenchong-apple-icon.png" sizes="114x114">
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>

	<?php do_action( 'electroserv_action_before' ); ?>

	<div class="body_wrap">

		<div class="page_wrap"><?php

			// Desktop header
			$electroserv_header_type = electroserv_get_theme_option("header_type");
			if ($electroserv_header_type == 'custom' && !electroserv_is_layouts_available())
				$electroserv_header_type = 'default';
			get_template_part( "templates/header-{$electroserv_header_type}");

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

					<div class="content">
						<?php
						// Widgets area inside page content
						electroserv_create_widgets_area('widgets_above_content');
						?>				
