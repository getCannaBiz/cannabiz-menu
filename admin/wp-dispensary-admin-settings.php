<?php
/**
 * Adding the Admin Settings Page
 *
 * @link       http://www.wpdispensary.com
 * @since      1.6.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

/**
 * Function adds the WP Dispensary Setting Page
 */
function wpd_settings_page() {
	add_settings_section( 'wpd_section', 'Display options', null, 'wpd' );
	add_settings_field( 'wpd-hidedetails', 'Hide menu item details from the_content?', 'wpd_checkbox_displaydetails', 'wpd', 'wpd_section' );
	add_settings_field( 'wpd-hidepricing', 'Hide menu item pricing from the_content?', 'wpd_checkbox_displaypricing', 'wpd', 'wpd_section' );
	add_settings_field( 'wpd-placement', 'Move all menu info below the_content?', 'wpd_checkbox_placement', 'wpd', 'wpd_section' );
	register_setting( 'wpd_section', 'wpd-hidedetails' );
	register_setting( 'wpd_section', 'wpd-hidepricing' );
	register_setting( 'wpd_section', 'wpd-placement' );
}

/**
 * Here we are comparing stored value with 1.
 * Stored value is 1 if user checks the checkbox, otherwise it will be an empty string.
 */
function wpd_checkbox_displaydetails() {
	?>
	<input type='checkbox' name='wpd-hidedetails' value='1' <?php checked( 1, get_option( 'wpd-hidedetails' ), true ); ?> />
	<?php
}

/**
 * Here we are comparing stored value with 1.
 * Stored value is 1 if user checks the checkbox, otherwise it will be an empty string.
 */
function wpd_checkbox_displaypricing() {
	?>
	<input type='checkbox' name='wpd-hidepricing' value='1' <?php checked( 1, get_option( 'wpd-hidepricing' ), true ); ?> />
	<?php
}

/**
 * Here we are comparing stored value with 1.
 * Stored value is 1 if user checks the checkbox, otherwise it will be an empty string.
 */
function wpd_checkbox_placement() {
	?>
	<input type='checkbox' name='wpd-placement' value='1' <?php checked( 1, get_option( 'wpd-placement' ), true ); ?> />
	<?php
}

add_action( 'admin_init', 'wpd_settings_page' );

/**
 * Here we are adding the code that displays on our Settings page
 */
function wpd_page() {
	?>
	<div class='wrap'>
		<h1>WP Dispensary Settings</h1>

		<form method='post' action='options.php'>
		<?php
			settings_fields( 'wpd_section' );

			do_settings_sections( 'wpd' );

			submit_button();
		?>
		</form>
	</div>
	<?php
}

/**
 * Here we are adding the 'WP Dispensary' page under Settings in the admin dashboard
 */
function menu_item() {
	add_submenu_page( 'options-general.php', 'WP Dispensary', 'WP Dispensary', 'manage_options', 'wp-dispensary', 'wpd_page' );
}

add_action( 'admin_menu', 'menu_item' );
