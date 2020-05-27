<div class="front_page_section front_page_section_contacts<?php
			$electroserv_scheme = electroserv_get_theme_option('front_page_contacts_scheme');
			if (!electroserv_is_inherit($electroserv_scheme)) echo ' scheme_'.esc_attr($electroserv_scheme);
			echo ' front_page_section_paddings_'.esc_attr(electroserv_get_theme_option('front_page_contacts_paddings'));
		?>"<?php
		$electroserv_css = '';
		$electroserv_bg_image = electroserv_get_theme_option('front_page_contacts_bg_image');
		if (!empty($electroserv_bg_image)) 
			$electroserv_css .= 'background-image: url('.esc_url(electroserv_get_attachment_url($electroserv_bg_image)).');';
		if (!empty($electroserv_css))
			echo " style=\"{$electroserv_css}\"";
?>><?php
	// Add anchor
	$electroserv_anchor_icon = electroserv_get_theme_option('front_page_contacts_anchor_icon');	
	$electroserv_anchor_text = electroserv_get_theme_option('front_page_contacts_anchor_text');	
	if ((!empty($electroserv_anchor_icon) || !empty($electroserv_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_contacts"'
										. (!empty($electroserv_anchor_icon) ? ' icon="'.esc_attr($electroserv_anchor_icon).'"' : '')
										. (!empty($electroserv_anchor_text) ? ' title="'.esc_attr($electroserv_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_contacts_inner<?php
			if (electroserv_get_theme_option('front_page_contacts_fullheight'))
				echo ' electroserv-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$electroserv_css = '';
			$electroserv_bg_mask = electroserv_get_theme_option('front_page_contacts_bg_mask');
			$electroserv_bg_color = electroserv_get_theme_option('front_page_contacts_bg_color');
			if (!empty($electroserv_bg_color) && $electroserv_bg_mask > 0)
				$electroserv_css .= 'background-color: '.esc_attr($electroserv_bg_mask==1
																	? $electroserv_bg_color
																	: electroserv_hex2rgba($electroserv_bg_color, $electroserv_bg_mask)
																).';';
			if (!empty($electroserv_css))
				echo " style=\"{$electroserv_css}\"";
	?>>
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$electroserv_caption = electroserv_get_theme_option('front_page_contacts_caption');
			$electroserv_description = electroserv_get_theme_option('front_page_contacts_description');
			if (!empty($electroserv_caption) || !empty($electroserv_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($electroserv_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo !empty($electroserv_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($electroserv_caption);
					?></h2><?php
				}
			
				// Description
				if (!empty($electroserv_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo !empty($electroserv_description) ? 'filled' : 'empty'; ?>"><?php
						echo wpautop(wp_kses_post($electroserv_description));
					?></div><?php
				}
			}

			// Content (text)
			$electroserv_content = electroserv_get_theme_option('front_page_contacts_content');
			$electroserv_layout = electroserv_get_theme_option('front_page_contacts_layout');
			if ($electroserv_layout == 'columns' && (!empty($electroserv_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ((!empty($electroserv_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo !empty($electroserv_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses_post($electroserv_content);
				?></div><?php
			}

			if ($electroserv_layout == 'columns' && (!empty($electroserv_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div><div class="column-2_3"><?php
			}
		
			// Shortcode output
			$electroserv_sc = electroserv_get_theme_option('front_page_contacts_shortcode');
			if (!empty($electroserv_sc) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo !empty($electroserv_sc) ? 'filled' : 'empty'; ?>"><?php
					electroserv_show_layout(do_shortcode($electroserv_sc));
				?></div><?php
			}

			if ($electroserv_layout == 'columns' && (!empty($electroserv_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>