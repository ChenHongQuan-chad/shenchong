<?php
/**
 * The Gallery template to display posts
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
$electroserv_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($electroserv_columns).' post_format_'.esc_attr($electroserv_post_format) ); ?>
	<?php echo (!electroserv_is_off($electroserv_animation) ? ' data-animation="'.esc_attr(electroserv_get_animation_classes($electroserv_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($electroserv_image[1]) && !empty($electroserv_image[2])) echo intval($electroserv_image[1]) .'x' . intval($electroserv_image[2]); ?>"
	data-src="<?php if (!empty($electroserv_image[0])) echo esc_url($electroserv_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$electroserv_image_hover = 'icon';
	if (in_array($electroserv_image_hover, array('icons', 'zoom'))) $electroserv_image_hover = 'dots';
	$electroserv_components = electroserv_is_inherit(electroserv_get_theme_option_from_meta('meta_parts')) 
								? 'categories,date,counters,share'
								: electroserv_array_get_keys_by_value(electroserv_get_theme_option('meta_parts'));
	$electroserv_counters = electroserv_is_inherit(electroserv_get_theme_option_from_meta('counters')) 
								? 'comments'
								: electroserv_array_get_keys_by_value(electroserv_get_theme_option('counters'));
	electroserv_show_post_featured(array(
		'hover' => $electroserv_image_hover,
		'thumb_size' => electroserv_get_thumb_size( strpos(electroserv_get_theme_option('body_style'), 'full')!==false || $electroserv_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($electroserv_components)
										? electroserv_show_post_meta(apply_filters('electroserv_filter_post_meta_args', array(
											'components' => $electroserv_components,
											'counters' => $electroserv_counters,
											'seo' => false,
											'echo' => false
											), $electroserv_blog_style[0], $electroserv_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'electroserv') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>