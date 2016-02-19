<?php

/**
 * @link              http://www.wpdispensary.com
 * @since             1.0.0
 * @package           WP_Dispensary
 *
 * Plugin Name:       WP Dispensary
 * Plugin URI:        http://www.wpdispensary.com
 * Description:       The complete medical marijuana dispensary menu solution for WordPress.
 * Version:           1.3
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
 * This action is documented in includes/class-wp-dispensary-activator.php
 */
function activate_WP_Dispensary() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-dispensary-activator.php';
	WP_Dispensary_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-dispensary-deactivator.php
 */
function deactivate_WP_Dispensary() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-dispensary-deactivator.php';
	WP_Dispensary_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_WP_Dispensary' );
register_deactivation_hook( __FILE__, 'deactivate_WP_Dispensary' );

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
 * @since    1.0.0
 */
function run_WP_Dispensary() {

	$plugin = new WP_Dispensary();
	$plugin->run();

}
run_WP_Dispensary();
