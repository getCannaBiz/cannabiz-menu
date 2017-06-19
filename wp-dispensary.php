<?php
/**
 * WordPress Dispensary
 *
 * Plugin details
 *
 * @link              http://www.wpdispensary.com
 * @since             1.0.0
 * @package           WP_Dispensary
 *
 * Plugin Name:       WP Dispensary
 * Plugin URI:        http://www.wpdispensary.com
 * Description:       The complete marijuana dispensary menu solution for WordPress
 * Version:           1.9.8
 * Author:            WP Dispensary
 * Author URI:        http://www.wpdispensary.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-dispensary
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 *
 * This action is documented in includes/class-wp-dispensary-activator.php
 *
 * @access public
 *
 * @return void
 */
function activate_wp_dispensary() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-dispensary-activator.php';
	wp_dispensary_activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 *
 * This action is documented in includes/class-wp-dispensary-deactivator.php
 *
 * @access public
 *
 * @return void
 */
function deactivate_wp_dispensary() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-dispensary-deactivator.php';
	wp_dispensary_deactivator::deactivate();
}

// Registers the plugin activation hook.
register_activation_hook( __FILE__, 'activate_wp_dispensary' );
// Registers the plugin deactivation hook.
register_deactivation_hook( __FILE__, 'deactivate_wp_dispensary' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-dispensary.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 *
 * @return void
 */
function run_wp_dispensary() {

	$plugin = new wp_dispensary();
	$plugin->run();

}

// Runs WPDispensary
run_wp_dispensary();

// Add settings link on plugin page
function wpd_settings_link($links) { 
  $settings_link = '<a href="admin.php?page=wpd-settings">Settings</a>'; 
  array_unshift( $links, $settings_link ); 
  return $links; 
}
 
$pluginname = plugin_basename(__FILE__); 
add_filter( "plugin_action_links_$pluginname", 'wpd_settings_link' );
