<?php
/**
 * Deprecated functions that are still able to be used, but will no longer be
 * updated with new features.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes/fuctions
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @license    GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link       https://www.wpdispensary.com
 * @since      1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    wp_die();
}

/**
 * Get all menu types
 *
 * @since  2.5
 * @return array
 */
function wpd_menu_types() {
    $menu_types = array(
        'wpd-flowers'      => esc_html__( 'Flowers', 'wp-dispensary' ),
        'wpd-concentrates' => esc_html__( 'Concentrates', 'wp-dispensary' ),
        'wpd-tinctures'    => esc_html__( 'Tinctures', 'wp-dispensary' ),
        'wpd-edibles'      => esc_html__( 'Edibles', 'wp-dispensary' ),
        'wpd-prerolls'     => esc_html__( 'Pre-rolls', 'wp-dispensary' ),
        'wpd-topicals'     => esc_html__( 'Topicals', 'wp-dispensary' ),
        'wpd-growers'      => esc_html__( 'Growers', 'wp-dispensary' ),
        'wpd-gear'         => esc_html__( 'Gear', 'wp-dispensary' ),
    );
    return apply_filters( 'wpd_menu_types', $menu_types );
}

/**
 * Get all menu types - Simple
 * 
 * @param bool $lowercase 
 *
 * @since  2.5
 * @return array
 */
function wpd_menu_types_simple( $lowercase = null ) {

    // Get menu types.
    $menu_types = wpd_menu_types();

    // Create simple array.
    $menu_types_simple = array();

    // Loop through menu types.
    foreach ( $menu_types as $value ) {
        // Add items to simple array.
        if ( $lowercase ) {
            $menu_types_simple[] = str_replace( '-', '', strtolower( $value ) );
        } else {
            $menu_types_simple[] = $value;
        }
    }

    return apply_filters( 'wpd_menu_types_simple', $menu_types_simple );
}
