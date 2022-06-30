<?php
/**
 * Add custom image sizes
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    wp_die();
}

/**
 * Add custom image sizes
 * 
 * @since  1.0
 * @return void
 */
function wp_dispensary_add_image_sizes() {
    // Add image sizes.
    if ( function_exists( 'add_image_size' ) ) {
        // Loop through custom image sizes.
        foreach ( wp_dispensary_custom_image_sizes() as $key=>$value ) {
            // add image size.
            add_image_size( $key, $value['width'], $value['height'], true );
        }
    }
}
add_action( 'init', 'wp_dispensary_add_image_sizes' );
