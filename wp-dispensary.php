<?php
/**
 * WP Dispensary
 *
 * Plugin details
 *
 * @link              https://www.wpdispensary.com
 * @since             1.0.0
 * @package           WP_Dispensary
 *
 * Plugin Name:       WP Dispensary
 * Plugin URI:        https://www.wpdispensary.com
 * Description:       The complete marijuana menu solution for dispensaries and delivery services
 * Version:           2.5.5
 * Author:            WP Dispensary
 * Author URI:        https://www.wpdispensary.com
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
 * Current plugin version.
 */
define( 'WP_DISPENSARY_VERSION', '2.5.5' );

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

/** Runs WP Dispensary */
run_wp_dispensary();

/**
 * Add settings link on plugin page
 *
 * @since 1.9.8
 * @param array $links an array of links related to the plugin.
 * @return array updatead array of links related to the plugin.
 */
function wpd_settings_link( $links ) {
	$pro_link      = '<a href="https://www.wpdispensary.com/product/pro-package/" target="_blank" style="font-weight:700;">' . __( 'Go Pro', 'wp-dispensary' ) . '</a>';
	$settings_link = '<a href="admin.php?page=wpd-settings">' . __( 'Settings', 'wp-dispensary' ) . '</a>';
	array_unshift( $links, $settings_link );
	array_unshift( $links, $pro_link );
	return $links;
}

$pluginname = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$pluginname", 'wpd_settings_link' );

/**
 * Returns the custom excerpt for oEmbeds.
 *
 * @since 2.0
 * @param  string $output Default embed output.
 * @return string         Customize embed output.
 */
function wpd_excerpt_embed( $output ) {
	return the_content();
	// NOTE: the code below can never execute???
	return $output;
}
add_filter( 'the_excerpt_embed', 'wpd_excerpt_embed' );

/**
 * Filter to add a wrapper to embeds.
 *
 * @param  string $html    string of html of the embed.
 * @param  string $url     url that the embed is generated from.
 * @param  string $attr    attributes to apply to the embed markup.
 * @param  int    $post_id id of the attached post.
 * @return string          string with updated markup with a wrapper added.
 */
function wpd_embed_oembed_html( $html, $url, $attr, $post_id ) {
	return '<div id="wpd-oembed-wrap">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'wpd_embed_oembed_html', 99, 4 );
