<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0.10
 */

// Copyright area
$electroserv_footer_scheme =  electroserv_is_inherit(electroserv_get_theme_option('footer_scheme')) ? electroserv_get_theme_option('color_scheme') : electroserv_get_theme_option('footer_scheme');
$electroserv_copyright_scheme = electroserv_is_inherit(electroserv_get_theme_option('copyright_scheme')) ? $electroserv_footer_scheme : electroserv_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($electroserv_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$electroserv_copyright = electroserv_prepare_macros(electroserv_get_theme_option('copyright'));
				if (!empty($electroserv_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $electroserv_copyright, $electroserv_matches)) {
						$electroserv_copyright = str_replace($electroserv_matches[1], date(str_replace(array('{', '}'), '', $electroserv_matches[1])), $electroserv_copyright);
						$electroserv_copyright = str_replace(array('{{Y}}', '{Y}'), date('Y'), $electroserv_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($electroserv_copyright));
				}
			?></div>
		</div>
	</div>
</div>
