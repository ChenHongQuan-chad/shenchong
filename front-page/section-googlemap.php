<div class="front_page_section front_page_section_googlemap<?php
			$electroserv_scheme = electroserv_get_theme_option('front_page_googlemap_scheme');
			if (!electroserv_is_inherit($electroserv_scheme)) echo ' scheme_'.esc_attr($electroserv_scheme);
			echo ' front_page_section_paddings_'.esc_attr(electroserv_get_theme_option('front_page_googlemap_paddings'));
		?>"<?php
		$electroserv_css = '';
		$electroserv_bg_image = electroserv_get_theme_option('front_page_googlemap_bg_image');
		if (!empty($electroserv_bg_image)) 
			$electroserv_css .= 'background-image: url('.esc_url(electroserv_get_attachment_url($electroserv_bg_image)).');';
		if (!empty($electroserv_css))
			echo " style=\"{$electroserv_css}\"";
?>><?php
	// Add anchor
	$electroserv_anchor_icon = electroserv_get_theme_option('front_page_googlemap_anchor_icon');	
	$electroserv_anchor_text = electroserv_get_theme_option('front_page_googlemap_anchor_text');	
	if ((!empty($electroserv_anchor_icon) || !empty($electroserv_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_googlemap"'
										. (!empty($electroserv_anchor_icon) ? ' icon="'.esc_attr($electroserv_anchor_icon).'"' : '')
										. (!empty($electroserv_anchor_text) ? ' title="'.esc_attr($electroserv_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_googlemap_inner<?php
			if (electroserv_get_theme_option('front_page_googlemap_fullheight'))
				echo ' electroserv-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$electroserv_css = '';
			$electroserv_bg_mask = electroserv_get_theme_option('front_page_googlemap_bg_mask');
			$electroserv_bg_color = electroserv_get_theme_option('front_page_googlemap_bg_color');
			if (!empty($electroserv_bg_color) && $electroserv_bg_mask > 0)
				$electroserv_css .= 'background-color: '.esc_attr($electroserv_bg_mask==1
																	? $electroserv_bg_color
																	: electroserv_hex2rgba($electroserv_bg_color, $electroserv_bg_mask)
																).';';
			if (!empty($electroserv_css))
				echo " style=\"{$electroserv_css}\"";
	?>>
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap<?php
			$electroserv_layout = electroserv_get_theme_option('front_page_googlemap_layout');
			if ($electroserv_layout != 'fullwidth')
				echo ' content_wrap';
		?>">
			<?php
			// Content wrap with title and description
			$electroserv_caption = electroserv_get_theme_option('front_page_googlemap_caption');
			$electroserv_description = electroserv_get_theme_option('front_page_googlemap_description');
			if (!empty($electroserv_caption) || !empty($electroserv_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($electroserv_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
					// Caption
					if (!empty($electroserv_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo !empty($electroserv_caption) ? 'filled' : 'empty'; ?>"><?php
							echo wp_kses_post($electroserv_caption);
						?></h2><?php
					}
				
					// Description (text)
					if (!empty($electroserv_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo !empty($electroserv_description) ? 'filled' : 'empty'; ?>"><?php
							echo wpautop(wp_kses_post($electroserv_description));
						?></div><?php
					}
				if ($electroserv_layout == 'fullwidth') {
					?></div><?php
				}
			}

			// Content (text)
			$electroserv_content = electroserv_get_theme_option('front_page_googlemap_content');
			if (!empty($electroserv_content) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($electroserv_layout == 'columns') {
					?><div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} else if ($electroserv_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
	
				?><div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo !empty($electroserv_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses_post($electroserv_content);
				?></div><?php
	
				if ($electroserv_layout == 'columns') {
					?></div><div class="column-2_3"><?php
				} else if ($electroserv_layout == 'fullwidth') {
					?></div><?php
				}
			}
			
			// Widgets output
			?><div class="front_page_section_output front_page_section_googlemap_output"><?php 
				if (is_active_sidebar('front_page_googlemap_widgets')) {
					dynamic_sidebar( 'front_page_googlemap_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!electroserv_exists_trx_addons())
						electroserv_customizer_need_trx_addons_message();
					else
						electroserv_customizer_need_widgets_message('front_page_googlemap_caption', 'ThemeREX Addons - Google map');
				}
			?></div><?php

			if ($electroserv_layout == 'columns' && (!empty($electroserv_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>