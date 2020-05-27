<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

$electroserv_post_id    = get_the_ID();
$electroserv_post_date  = electroserv_get_date();
$electroserv_post_title = get_the_title();
$electroserv_post_link  = get_permalink();
$electroserv_post_author_id   = get_the_author_meta('ID');
$electroserv_post_author_name = get_the_author_meta('display_name');
$electroserv_post_author_url  = get_author_posts_url($electroserv_post_author_id, '');

$electroserv_args = get_query_var('electroserv_args_widgets_posts');
$electroserv_show_date = isset($electroserv_args['show_date']) ? (int) $electroserv_args['show_date'] : 1;
$electroserv_show_image = isset($electroserv_args['show_image']) ? (int) $electroserv_args['show_image'] : 1;
$electroserv_show_author = isset($electroserv_args['show_author']) ? (int) $electroserv_args['show_author'] : 1;
$electroserv_show_counters = isset($electroserv_args['show_counters']) ? (int) $electroserv_args['show_counters'] : 1;
$electroserv_show_categories = isset($electroserv_args['show_categories']) ? (int) $electroserv_args['show_categories'] : 1;

$electroserv_output = electroserv_storage_get('electroserv_output_widgets_posts');

$electroserv_post_counters_output = '';
if ( $electroserv_show_counters ) {
	$electroserv_post_counters_output = '<span class="post_info_item post_info_counters">'
								. electroserv_get_post_counters('comments')
							. '</span>';
}


$electroserv_output .= '<article class="post_item with_thumb">';

if ($electroserv_show_image) {
	$electroserv_post_thumb = get_the_post_thumbnail($electroserv_post_id, electroserv_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($electroserv_post_thumb) $electroserv_output .= '<div class="post_thumb">' . ($electroserv_post_link ? '<a href="' . esc_url($electroserv_post_link) . '">' : '') . ($electroserv_post_thumb) . ($electroserv_post_link ? '</a>' : '') . '</div>';
}

$electroserv_output .= '<div class="post_content">'
			. ($electroserv_show_categories 
					? '<div class="post_categories">'
						. electroserv_get_post_categories()
						. $electroserv_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($electroserv_post_link ? '<a href="' . esc_url($electroserv_post_link) . '">' : '') . ($electroserv_post_title) . ($electroserv_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('electroserv_filter_get_post_info', 
								'<div class="post_info">'
									. ($electroserv_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($electroserv_post_link ? '<a href="' . esc_url($electroserv_post_link) . '" class="post_info_date">' : '') 
											. esc_html($electroserv_post_date) 
											. ($electroserv_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($electroserv_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'electroserv') . ' ' 
											. ($electroserv_post_link ? '<a href="' . esc_url($electroserv_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($electroserv_post_author_name) 
											. ($electroserv_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$electroserv_show_categories && $electroserv_post_counters_output
										? $electroserv_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
electroserv_storage_set('electroserv_output_widgets_posts', $electroserv_output);
?>