<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

electroserv_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'masonry' );
wp_enqueue_script( 'classie', electroserv_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'electroserv-gallery-script', electroserv_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$electroserv_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$electroserv_sticky_out = electroserv_get_theme_option('sticky_style')=='columns' 
							&& is_array($electroserv_stickies) && count($electroserv_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$electroserv_cat = electroserv_get_theme_option('parent_cat');
	$electroserv_post_type = electroserv_get_theme_option('post_type');
	$electroserv_taxonomy = electroserv_get_post_type_taxonomy($electroserv_post_type);
	$electroserv_show_filters = electroserv_get_theme_option('show_filters');
	$electroserv_tabs = array();
	if (!electroserv_is_off($electroserv_show_filters)) {
		$electroserv_args = array(
			'type'			=> $electroserv_post_type,
			'child_of'		=> $electroserv_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $electroserv_taxonomy,
			'pad_counts'	=> false
		);
		$electroserv_portfolio_list = get_terms($electroserv_args);
		if (is_array($electroserv_portfolio_list) && count($electroserv_portfolio_list) > 0) {
			$electroserv_tabs[$electroserv_cat] = esc_html__('All', 'electroserv');
			foreach ($electroserv_portfolio_list as $electroserv_term) {
				if (isset($electroserv_term->term_id)) $electroserv_tabs[$electroserv_term->term_id] = $electroserv_term->name;
			}
		}
	}
	if (count($electroserv_tabs) > 0) {
		$electroserv_portfolio_filters_ajax = true;
		$electroserv_portfolio_filters_active = $electroserv_cat;
		$electroserv_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters electroserv_tabs electroserv_tabs_ajax">
			<ul class="portfolio_titles electroserv_tabs_titles">
				<?php
				foreach ($electroserv_tabs as $electroserv_id=>$electroserv_title) {
					?><li><a href="<?php echo esc_url(electroserv_get_hash_link(sprintf('#%s_%s_content', $electroserv_portfolio_filters_id, $electroserv_id))); ?>" data-tab="<?php echo esc_attr($electroserv_id); ?>"><?php echo esc_html($electroserv_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$electroserv_ppp = electroserv_get_theme_option('posts_per_page');
			if (electroserv_is_inherit($electroserv_ppp)) $electroserv_ppp = '';
			foreach ($electroserv_tabs as $electroserv_id=>$electroserv_title) {
				$electroserv_portfolio_need_content = $electroserv_id==$electroserv_portfolio_filters_active || !$electroserv_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $electroserv_portfolio_filters_id, $electroserv_id)); ?>"
					class="portfolio_content electroserv_tabs_content"
					data-blog-template="<?php echo esc_attr(electroserv_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(electroserv_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($electroserv_ppp); ?>"
					data-post-type="<?php echo esc_attr($electroserv_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($electroserv_taxonomy); ?>"
					data-cat="<?php echo esc_attr($electroserv_id); ?>"
					data-parent-cat="<?php echo esc_attr($electroserv_cat); ?>"
					data-need-content="<?php echo (false===$electroserv_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($electroserv_portfolio_need_content) 
						electroserv_show_portfolio_posts(array(
							'cat' => $electroserv_id,
							'parent_cat' => $electroserv_cat,
							'taxonomy' => $electroserv_taxonomy,
							'post_type' => $electroserv_post_type,
							'page' => 1,
							'sticky' => $electroserv_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		electroserv_show_portfolio_posts(array(
			'cat' => $electroserv_cat,
			'parent_cat' => $electroserv_cat,
			'taxonomy' => $electroserv_taxonomy,
			'post_type' => $electroserv_post_type,
			'page' => 1,
			'sticky' => $electroserv_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>