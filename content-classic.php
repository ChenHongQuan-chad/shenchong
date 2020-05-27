<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

$electroserv_blog_style = explode('_', electroserv_get_theme_option('blog_style'));
$electroserv_columns = empty($electroserv_blog_style[1]) ? 2 : max(2, $electroserv_blog_style[1]);
$electroserv_expanded = !electroserv_sidebar_present() && electroserv_is_on(electroserv_get_theme_option('expand_content'));
$electroserv_post_format = get_post_format();
$electroserv_post_format = empty($electroserv_post_format) ? 'standard' : str_replace('post-format-', '', $electroserv_post_format);
$electroserv_animation = electroserv_get_theme_option('blog_animation');
$electroserv_components = electroserv_is_inherit(electroserv_get_theme_option_from_meta('meta_parts')) 
							? 'categories,date,counters'.($electroserv_columns < 3 ? ',edit' : '')
							: electroserv_array_get_keys_by_value(electroserv_get_theme_option('meta_parts'));
$electroserv_counters = electroserv_is_inherit(electroserv_get_theme_option_from_meta('counters')) 
							? 'comments'
							: electroserv_array_get_keys_by_value(electroserv_get_theme_option('counters'));

?><div class="<?php echo esc_attr($electroserv_blog_style[0] == 'classic' ? 'column' : 'masonry_item masonry_item'); ?>-1_<?php echo esc_attr($electroserv_columns); ?>"><article id="post-<?php the_ID(); ?>"
	<?php post_class( 'post_item post_format_'.esc_attr($electroserv_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($electroserv_columns)
					. ' post_layout_'.esc_attr($electroserv_blog_style[0]) 
					. ' post_layout_'.esc_attr($electroserv_blog_style[0]).'_'.esc_attr($electroserv_columns)
					); ?>
	<?php echo (!electroserv_is_off($electroserv_animation) ? ' data-animation="'.esc_attr(electroserv_get_animation_classes($electroserv_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	electroserv_show_post_featured( array( 'thumb_size' => electroserv_get_thumb_size($electroserv_blog_style[0] == 'classic'
													? (strpos(electroserv_get_theme_option('body_style'), 'full')!==false 
															? ( $electroserv_columns > 2 ? 'big' : 'huge' )
															: (	$electroserv_columns > 2
																? ($electroserv_expanded ? 'med' : 'small')
																: ($electroserv_expanded ? 'big' : 'med')
																)
														)
													: (strpos(electroserv_get_theme_option('body_style'), 'full')!==false 
															? ( $electroserv_columns > 2 ? 'masonry-big' : 'full' )
															: (	$electroserv_columns <= 2 && $electroserv_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($electroserv_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('electroserv_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('electroserv_action_before_post_meta'); 

			// Post meta
			if (!empty($electroserv_components))
				electroserv_show_post_meta(apply_filters('electroserv_filter_post_meta_args', array(
					'components' => $electroserv_components,
					'counters' => $electroserv_counters,
					'seo' => false
					), $electroserv_blog_style[0], $electroserv_columns)
				);

			do_action('electroserv_action_after_post_meta'); 
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$electroserv_show_learn_more = false;
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($electroserv_post_format, array('link', 'aside', 'status'))) {
				the_content();
			} else if ($electroserv_post_format == 'quote') {
				if (($quote = electroserv_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
					electroserv_show_layout(wpautop($quote));
				else
					the_excerpt();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($electroserv_post_format, array('link', 'aside', 'status', 'quote'))) {
			if (!empty($electroserv_components))
				electroserv_show_post_meta(apply_filters('electroserv_filter_post_meta_args', array(
					'components' => $electroserv_components,
					'counters' => $electroserv_counters
					), $electroserv_blog_style[0], $electroserv_columns)
				);
		}
		// More button
		if ( $electroserv_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'electroserv'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>