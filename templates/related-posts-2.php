<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

$electroserv_link = get_permalink();
$electroserv_post_format = get_post_format();
$electroserv_post_format = empty($electroserv_post_format) ? 'standard' : str_replace('post-format-', '', $electroserv_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_'.esc_attr($electroserv_post_format) ); ?>><?php
	electroserv_show_post_featured(array(
		'thumb_size' => electroserv_get_thumb_size( (int) electroserv_get_theme_option('related_posts') == 1 ? 'huge' : 'related' ),
		'show_no_image' => false,
		'singular' => false
		)
	);
	?><div class="post_header entry-header">
		<h5 class="post_title entry-title"><a href="<?php echo esc_url($electroserv_link); ?>"><?php echo the_title(); ?></a></h5>
        <?php
        if ( in_array(get_post_type(), array( 'post', 'attachment' ) ) ) {
            ?><span class="post_date icon-calendar-light"><a href="<?php echo esc_url($electroserv_link); ?>"><?php echo electroserv_get_date(); ?></a></span><?php
        }
        ?>
	</div>
</div>