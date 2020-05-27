<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WPBakery Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$electroserv_content = '';
$electroserv_blog_archive_mask = '%%CONTENT%%';
$electroserv_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $electroserv_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($electroserv_content = apply_filters('the_content', get_the_content())) != '') {
		if (($electroserv_pos = strpos($electroserv_content, $electroserv_blog_archive_mask)) !== false) {
			$electroserv_content = preg_replace('/(\<p\>\s*)?'.$electroserv_blog_archive_mask.'(\s*\<\/p\>)/i', $electroserv_blog_archive_subst, $electroserv_content);
		} else
			$electroserv_content .= $electroserv_blog_archive_subst;
		$electroserv_content = explode($electroserv_blog_archive_mask, $electroserv_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) electroserv_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$electroserv_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$electroserv_args = electroserv_query_add_posts_and_cats($electroserv_args, '', electroserv_get_theme_option('post_type'), electroserv_get_theme_option('parent_cat'));
$electroserv_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($electroserv_page_number > 1) {
	$electroserv_args['paged'] = $electroserv_page_number;
	$electroserv_args['ignore_sticky_posts'] = true;
}
$electroserv_ppp = electroserv_get_theme_option('posts_per_page');
if ((int) $electroserv_ppp != 0)
	$electroserv_args['posts_per_page'] = (int) $electroserv_ppp;
// Make a new query
query_posts( $electroserv_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($electroserv_content) && count($electroserv_content) == 2) {
	set_query_var('blog_archive_start', $electroserv_content[0]);
	set_query_var('blog_archive_end', $electroserv_content[1]);
}

get_template_part('index');
?>