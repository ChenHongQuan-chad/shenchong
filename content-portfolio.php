<?php
/**
 * The Portfolio template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

$electroserv_blog_style = explode('_', electroserv_get_theme_option('blog_style'));
$electroserv_columns = empty($electroserv_blog_style[1]) ? 2 : max(2, $electroserv_blog_style[1]);
$electroserv_post_format = get_post_format();
$electroserv_post_format = empty($electroserv_post_format) ? 'standard' : str_replace('post-format-', '', $electroserv_post_format);
$electroserv_animation = electroserv_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($electroserv_columns).' post_format_'.esc_attr($electroserv_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!electroserv_is_off($electroserv_animation) ? ' data-animation="'.esc_attr(electroserv_get_animation_classes($electroserv_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$electroserv_image_hover = electroserv_get_theme_option('image_hover');
	// Featured image
	electroserv_show_post_featured(array(
		'thumb_size' => electroserv_get_thumb_size(strpos(electroserv_get_theme_option('body_style'), 'full')!==false || $electroserv_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $electroserv_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $electroserv_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>