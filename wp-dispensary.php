<?php
/**
 * WP Dispensary
 *
 * Plugin details
 *
 * @package WP_Dispensary
 * @author  CannaBiz Software <contact@cannabizsoftware.com>
 * @license GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link    https://cannabizsoftware.com
 * @since   1.0
 *
 * Plugin Name:       CannaBiz Menu
 * Plugin URI:        https://cannabizsoftware.com/menu/
 * Description:       The complete marijuana menu solution for dispensaries and delivery services
 * Version:           4.5.0
 * Author:            CannaBiz Software
 * Author URI:        https://cannabizsoftware.com
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       wp-dispensary
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    wp_die();
}

// Define the plugin version.
define( 'WP_DISPENSARY_VERSION', '4.5.0' );

// Define the plugin base name.
$plugin_name = plugin_basename( __FILE__ );

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
 * @since  1.0.0
 * @return void
 */
function run_wp_dispensary() {

    $plugin = new wp_dispensary();
    $plugin->run();

}

// Runs WP Dispensary.
run_wp_dispensary();

/**
 * Add settings link on plugin page
 * 
 * @param array $links an array of links related to the plugin.
 * 
 * @since  1.9.8
 * @return array
 */
function wpd_plugin_links( $links ) {
    $pro_link      = '<a href="https://cannabizsoftware.com/product/pro-package/" target="_blank" style="font-weight:700;">' . esc_attr__( 'Go Pro', 'wp-dispensary' ) . '</a>';
    $settings_link = '<a href="admin.php?page=wpd-settings">' . esc_attr__( 'Settings', 'wp-dispensary' ) . '</a>';
    // Updated links.
    array_unshift( $links, $settings_link );
    // Updated links (Pro).
    if ( ! function_exists( 'wpd_ecommerce' ) ) {
        array_unshift( $links, $pro_link );
    }
    return $links;
}
add_filter( "plugin_action_links_$plugin_name", 'wpd_plugin_links' );
