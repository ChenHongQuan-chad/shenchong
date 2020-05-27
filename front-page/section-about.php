<div class="front_page_section front_page_section_about<?php
			$electroserv_scheme = electroserv_get_theme_option('front_page_about_scheme');
			if (!electroserv_is_inherit($electroserv_scheme)) echo ' scheme_'.esc_attr($electroserv_scheme);
			echo ' front_page_section_paddings_'.esc_attr(electroserv_get_theme_option('front_page_about_paddings'));
		?>"<?php
		$electroserv_css = '';
		$electroserv_bg_image = electroserv_get_theme_option('front_page_about_bg_image');
		if (!empty($electroserv_bg_image)) 
			$electroserv_css .= 'background-image: url('.esc_url(electroserv_get_attachment_url($electroserv_bg_image)).');';
		if (!empty($electroserv_css))
			echo " style=\"{$electroserv_css}\"";
?>><?php
	// Add anchor
	$electroserv_anchor_icon = electroserv_get_theme_option('front_page_about_anchor_icon');	
	$electroserv_anchor_text = electroserv_get_theme_option('front_page_about_anchor_text');	
	if ((!empty($electroserv_anchor_icon) || !empty($electroserv_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_about"'
										. (!empty($electroserv_anchor_icon) ? ' icon="'.esc_attr($electroserv_anchor_icon).'"' : '')
										. (!empty($electroserv_anchor_text) ? ' title="'.esc_attr($electroserv_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_about_inner<?php
			if (electroserv_get_theme_option('front_page_about_fullheight'))
				echo ' electroserv-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$electroserv_css = '';
			$electroserv_bg_mask = electroserv_get_theme_option('front_page_about_bg_mask');
			$electroserv_bg_color = electroserv_get_theme_option('front_page_about_bg_color');
			if (!empty($electroserv_bg_color) && $electroserv_bg_mask > 0)
				$electroserv_css .= 'background-color: '.esc_attr($electroserv_bg_mask==1
																	? $electroserv_bg_color
																	: electroserv_hex2rgba($electroserv_bg_color, $electroserv_bg_mask)
																).';';
			if (!empty($electroserv_css))
				echo " style=\"{$electroserv_css}\"";
	?>>
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$electroserv_caption = electroserv_get_theme_option('front_page_about_caption');
			if (!empty($electroserv_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo !empty($electroserv_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($electroserv_caption); ?></h2><?php
			}
		
			// Description (text)
			$electroserv_description = electroserv_get_theme_option('front_page_about_description');
			if (!empty($electroserv_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo !empty($electroserv_description) ? 'filled' : 'empty'; ?>"><?php echo wpautop(wp_kses_post($electroserv_description)); ?></div><?php
			}
			
			// Content
			$electroserv_content = electroserv_get_theme_option('front_page_about_content');
			if (!empty($electroserv_content) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo !empty($electroserv_content) ? 'filled' : 'empty'; ?>"><?php
					$electroserv_page_content_mask = '%%CONTENT%%';
					if (strpos($electroserv_content, $electroserv_page_content_mask) !== false) {
						$electroserv_content = preg_replace(
									'/(\<p\>\s*)?'.$electroserv_page_content_mask.'(\s*\<\/p\>)/i',
									sprintf('<div class="front_page_section_about_source">%s</div>',
												apply_filters('the_content', get_the_content())),
									$electroserv_content
									);
					}
					electroserv_show_layout($electroserv_content);
				?></div><?php
			}
			?>
		</div>
	</div>
</div>