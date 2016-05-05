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

function wpd_settings_page() {
    add_settings_section( "wpd_section", "Display options", null, "wpd" );
    add_settings_field( "wpd-checkbox", "Hide menu item details from the_content?", "wpd_checkbox_display", "wpd", "wpd_section" );
    register_setting( "wpd_section", "wpd-checkbox" );
}

function wpd_checkbox_display() {
   ?>
        <!-- Here we are comparing stored value with 1. Stored value is 1 if user checks the checkbox otherwise empty string. -->
        <input type="checkbox" name="wpd-checkbox" value="1" <?php checked(1, get_option('wpd-checkbox'), true); ?> />
   <?php
}

add_action("admin_init", "wpd_settings_page");

function wpd_page() {
	?>
	<div class="wrap">
		<h1>WP Dispensary Settings</h1>

		<form method="post" action="options.php">
		<?php
			settings_fields("wpd_section");

			do_settings_sections("wpd");
			 
			submit_button();
		?>
		</form>
	</div>
	<?php
}

function menu_item() {
  add_submenu_page("options-general.php", "WP Dispensary", "WP Dispensary", "manage_options", "wp-dispensary", "wpd_page");
}

add_action("admin_menu", "menu_item");

?>