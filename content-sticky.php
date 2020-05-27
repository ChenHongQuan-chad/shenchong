<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

$electroserv_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$electroserv_post_format = get_post_format();
$electroserv_post_format = empty($electroserv_post_format) ? 'standard' : str_replace('post-format-', '', $electroserv_post_format);
$electroserv_animation = electroserv_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($electroserv_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($electroserv_post_format) ); ?>
	<?php echo (!electroserv_is_off($electroserv_animation) ? ' data-animation="'.esc_attr(electroserv_get_animation_classes($electroserv_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	electroserv_show_post_featured(array(
		'thumb_size' => electroserv_get_thumb_size($electroserv_columns==1 ? 'big' : ($electroserv_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($electroserv_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			electroserv_show_post_meta(apply_filters('electroserv_filter_post_meta_args', array(), 'sticky', $electroserv_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>