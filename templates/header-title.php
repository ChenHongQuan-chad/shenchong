<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

// Page (category, tag, archive, author) title

if ( electroserv_need_page_title() ) {
	electroserv_sc_layouts_showed('title', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal scheme_dark">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$electroserv_blog_title = electroserv_get_blog_title();
							$electroserv_blog_title_text = $electroserv_blog_title_class = $electroserv_blog_title_link = $electroserv_blog_title_link_text = '';
							if (is_array($electroserv_blog_title)) {
								$electroserv_blog_title_text = $electroserv_blog_title['text'];
								$electroserv_blog_title_class = !empty($electroserv_blog_title['class']) ? ' '.$electroserv_blog_title['class'] : '';
								$electroserv_blog_title_link = !empty($electroserv_blog_title['link']) ? $electroserv_blog_title['link'] : '';
								$electroserv_blog_title_link_text = !empty($electroserv_blog_title['link_text']) ? $electroserv_blog_title['link_text'] : '';
							} else	
								$electroserv_blog_title_text = $electroserv_blog_title;
							?>
							<h1 itemprop="headline" class="dddddsc_layouts_title_caption<?php echo esc_attr($electroserv_blog_title_class); ?>"><?php
								$electroserv_top_icon = electroserv_get_category_icon();
								if (!empty($electroserv_top_icon)) {
									$electroserv_attr = electroserv_getimagesize($electroserv_top_icon);
									?><img src="<?php echo esc_url($electroserv_top_icon); ?>" alt="'.esc_attr__('top_icon', 'electroserv').'" <?php if (!empty($electroserv_attr[3])) electroserv_show_layout($electroserv_attr[3]);?>><?php
								}
								echo wp_kses_post($electroserv_blog_title_text);
							?></h1>
							<?php
							if (!empty($electroserv_blog_title_link) && !empty($electroserv_blog_title_link_text)) {
								?><a href="<?php echo esc_url($electroserv_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($electroserv_blog_title_link_text); ?></a><?php
							}
		
						?></div>
						<div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'electroserv_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>