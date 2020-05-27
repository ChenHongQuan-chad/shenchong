<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0.1
 */
 
$electroserv_theme_obj = wp_get_theme();
?>
<div class="update-nag" id="electroserv_admin_notice">
	<h3 class="electroserv_notice_title"><?php echo sprintf(esc_html__('Welcome to %s v.%s', 'electroserv'), $electroserv_theme_obj->name.(ELECTROSERV_THEME_FREE ? ' '.esc_html__('Free', 'electroserv') : ''), $electroserv_theme_obj->version); ?></h3>
	<?php
	if (!electroserv_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'electroserv')); ?></p><?php
	}
	?><p>
		<a href="<?php echo esc_url(admin_url().'themes.php?page=electroserv_about'); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> <?php echo sprintf(esc_html__('About %s', 'electroserv'), $electroserv_theme_obj->name); ?></a>
		<?php
		if (electroserv_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'electroserv'); ?></a>
			<?php
		}
		if (function_exists('electroserv_exists_trx_addons') && electroserv_exists_trx_addons() && class_exists('trx_addons_demo_data_importer')) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'electroserv'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'electroserv'); ?></a>
		<span> <?php esc_html_e('or', 'electroserv'); ?> </span>
        <a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Options', 'electroserv'); ?></a>
        <a href="#" class="button electroserv_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'electroserv'); ?></a>
	</p>
</div>