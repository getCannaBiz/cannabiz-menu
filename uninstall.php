<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package WP_Dispensary
 * @author  WP Dispensary <contact@wpdispensary.com>
 * @link    https://www.wpdispensary.com
 * @since   1.0.0
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    wp_die();
}
