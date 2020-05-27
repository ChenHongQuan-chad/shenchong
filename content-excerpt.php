<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

$electroserv_post_format = get_post_format();
$electroserv_post_format = empty($electroserv_post_format) ? 'standard' : str_replace('post-format-', '', $electroserv_post_format);
$electroserv_animation = electroserv_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($electroserv_post_format) ); ?>
	<?php echo (!electroserv_is_off($electroserv_animation) ? ' data-animation="'.esc_attr(electroserv_get_animation_classes($electroserv_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}
    // Title and post meta
    if (get_the_title() != '') {
        ?>
        <div class="post_header entry-header">
            <?php
            do_action('electroserv_action_before_post_title');

            // Post title
            the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );

            do_action('electroserv_action_before_post_meta');

            // Post meta
            $electroserv_components = electroserv_is_inherit(electroserv_get_theme_option_from_meta('meta_parts'))
                ? 'date,author,counters'
                : electroserv_array_get_keys_by_value(electroserv_get_theme_option('meta_parts'));
            $electroserv_counters = electroserv_is_inherit(electroserv_get_theme_option_from_meta('counters'))
                ? 'comments'
                : electroserv_array_get_keys_by_value(electroserv_get_theme_option('counters'));

            if (!empty($electroserv_components))
                electroserv_show_post_meta(apply_filters('electroserv_filter_post_meta_args', array(
                        'components' => $electroserv_components,
                        'counters' => $electroserv_counters,
                        'seo' => false
                    ), 'excerpt', 1)
                );
            ?>
        </div><!-- .post_header --><?php
    }

	// Featured image
	electroserv_show_post_featured(array( 'thumb_size' => electroserv_get_thumb_size( strpos(electroserv_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));

	// Post content
	?><div class="post_content entry-content"><?php
		if (electroserv_get_theme_option('blog_content') == 'fullpost') {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'electroserv' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'electroserv' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$electroserv_show_learn_more = !in_array($electroserv_post_format, array('link', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
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
			?></div><?php
			// More button
			if ( $electroserv_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'electroserv'); ?></a></p><?php
			}

		}
	?></div><!-- .entry-content -->
</article>