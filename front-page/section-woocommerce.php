<div class="front_page_section front_page_section_woocommerce<?php
			$electroserv_scheme = electroserv_get_theme_option('front_page_woocommerce_scheme');
			if (!electroserv_is_inherit($electroserv_scheme)) echo ' scheme_'.esc_attr($electroserv_scheme);
			echo ' front_page_section_paddings_'.esc_attr(electroserv_get_theme_option('front_page_woocommerce_paddings'));
		?>"<?php
		$electroserv_css = '';
		$electroserv_bg_image = electroserv_get_theme_option('front_page_woocommerce_bg_image');
		if (!empty($electroserv_bg_image)) 
			$electroserv_css .= 'background-image: url('.esc_url(electroserv_get_attachment_url($electroserv_bg_image)).');';
		if (!empty($electroserv_css))
			echo " style=\"{$electroserv_css}\"";
?>><?php
	// Add anchor
	$electroserv_anchor_icon = electroserv_get_theme_option('front_page_woocommerce_anchor_icon');	
	$electroserv_anchor_text = electroserv_get_theme_option('front_page_woocommerce_anchor_text');	
	if ((!empty($electroserv_anchor_icon) || !empty($electroserv_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_woocommerce"'
										. (!empty($electroserv_anchor_icon) ? ' icon="'.esc_attr($electroserv_anchor_icon).'"' : '')
										. (!empty($electroserv_anchor_text) ? ' title="'.esc_attr($electroserv_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner<?php
			if (electroserv_get_theme_option('front_page_woocommerce_fullheight'))
				echo ' electroserv-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$electroserv_css = '';
			$electroserv_bg_mask = electroserv_get_theme_option('front_page_woocommerce_bg_mask');
			$electroserv_bg_color = electroserv_get_theme_option('front_page_woocommerce_bg_color');
			if (!empty($electroserv_bg_color) && $electroserv_bg_mask > 0)
				$electroserv_css .= 'background-color: '.esc_attr($electroserv_bg_mask==1
																	? $electroserv_bg_color
																	: electroserv_hex2rgba($electroserv_bg_color, $electroserv_bg_mask)
																).';';
			if (!empty($electroserv_css))
				echo " style=\"{$electroserv_css}\"";
	?>>
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$electroserv_caption = electroserv_get_theme_option('front_page_woocommerce_caption');
			$electroserv_description = electroserv_get_theme_option('front_page_woocommerce_description');
			if (!empty($electroserv_caption) || !empty($electroserv_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($electroserv_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo !empty($electroserv_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($electroserv_caption);
					?></h2><?php
				}
			
				// Description (text)
				if (!empty($electroserv_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo !empty($electroserv_description) ? 'filled' : 'empty'; ?>"><?php
						echo wpautop(wp_kses_post($electroserv_description));
					?></div><?php
				}
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs"><?php 
				$electroserv_woocommerce_sc = electroserv_get_theme_option('front_page_woocommerce_products');
				if ($electroserv_woocommerce_sc == 'products') {
					$electroserv_woocommerce_sc_ids = electroserv_get_theme_option('front_page_woocommerce_products_per_page');
					$electroserv_woocommerce_sc_per_page = count(explode(',', $electroserv_woocommerce_sc_ids));
				} else {
					$electroserv_woocommerce_sc_per_page = max(1, (int) electroserv_get_theme_option('front_page_woocommerce_products_per_page'));
				}
				$electroserv_woocommerce_sc_columns = max(1, min($electroserv_woocommerce_sc_per_page, (int) electroserv_get_theme_option('front_page_woocommerce_products_columns')));
				echo do_shortcode("[{$electroserv_woocommerce_sc}"
									. ($electroserv_woocommerce_sc == 'products' 
											? ' ids="'.esc_attr($electroserv_woocommerce_sc_ids).'"' 
											: '')
									. ($electroserv_woocommerce_sc == 'product_category' 
											? ' category="'.esc_attr(electroserv_get_theme_option('front_page_woocommerce_products_categories')).'"' 
											: '')
									. ($electroserv_woocommerce_sc != 'best_selling_products' 
											? ' orderby="'.esc_attr(electroserv_get_theme_option('front_page_woocommerce_products_orderby')).'"'
											  . ' order="'.esc_attr(electroserv_get_theme_option('front_page_woocommerce_products_order')).'"' 
											: '')
									. ' per_page="'.esc_attr($electroserv_woocommerce_sc_per_page).'"' 
									. ' columns="'.esc_attr($electroserv_woocommerce_sc_columns).'"' 
									. ']');
			?></div>
		</div>
	</div>
</div>