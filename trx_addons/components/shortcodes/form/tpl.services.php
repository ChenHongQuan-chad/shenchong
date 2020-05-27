<?php
/**
 * The style "services" of the Contact form
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_form');
?><div
	<?php if (!empty($args['id'])) echo ' id="'.esc_attr($args['id']).'"'; ?>
	class="sc_form sc_form_<?php 
		echo esc_attr($args['type']);
		if (!empty($args['class'])) echo ' '.esc_attr($args['class']);
		if (!empty($args['align']) && !trx_addons_is_off($args['align'])) echo ' sc_align_'.esc_attr($args['align']);
		?>"<?php
	if (!empty($args['css'])) echo ' style="'.esc_attr($args['css']).'"'; 
?>>
	<?php
	trx_addons_sc_show_titles('sc_form', $args);
	do_action('trx_addons_action_fields_start', $args);
	?>
	<div class="sc_form_details <?php echo esc_attr(trx_addons_get_columns_wrap_class()); ?>"><?php
		// Contact form. Attention! Column's tags can't start with new line
		?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, 2)); ?>"><?php
			do_action('trx_addons_action_field_name', $args);
		?></div><div class="<?php echo esc_attr(trx_addons_get_column_class(1, 2)); ?>"><?php
            do_action('trx_addons_action_field_custom', array_merge($args, array('field_name' => 'phone',
                'field_type' => 'text',
                'field_value' => '',
                'field_req' => false,
                'field_icon' => '',
                'field_title' => esc_html__('Phone', 'electroserv'),
                'field_placeholder' => esc_html__('Phone', 'electroserv'))));
            ?></div><div class="<?php echo esc_attr(trx_addons_get_column_class(1, 2)); ?>"><?php
            do_action('trx_addons_action_field_email', $args);
            ?></div><div class="<?php echo esc_attr(trx_addons_get_column_class(1, 2)); ?>"><?php
            do_action('trx_addons_action_field_custom', array_merge($args, array('field_name' => 'services',
                'field_type' => 'select',
                'field_value' => '',
                'field_req' => false,
                'field_icon' => '',
                'field_title' => esc_html__('Phone', 'electroserv'),
                'field_placeholder' => esc_html__('Phone', 'electroserv'),
                'field_options' => array('electrical_installations' => esc_html__('Electrical Installations', 'electroserv'),
                    'lighting' => esc_html__('Lighting', 'electroserv'),
                    'home_generators' => esc_html__('Home Generators', 'electroserv'),
                    'electrical_repairs' => esc_html__('Electrical Repairs', 'electroserv'),
                    'security_systems' => esc_html__('Security Systems', 'electroserv'),
                    'electrical_troubleshooting' => esc_html__('Electrical Troubleshooting', 'electroserv'),
                    'panel_upgrades' => esc_html__('Panel Upgrades', 'electroserv')))));

            ?></div><?php
	?></div><div class="services_form_info_wrap"><span class="services_form_info icon-untitled-3"><?php esc_html_e('Your personal info is safe with us.','electroserv');?></span> <?php
	do_action('trx_addons_action_field_send', $args);
        ?></div><?php
	do_action('trx_addons_action_fields_end', $args);
	?>
</div><!-- /.sc_form -->