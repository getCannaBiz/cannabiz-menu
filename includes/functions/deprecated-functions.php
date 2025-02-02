<?php
/**
 * Deprecated functions that are still able to be used, but will no longer be
 * updated with new features.
 *
 * @package    WP_Dispensary
 * @subpackage CannaBiz_Menu/includes/fuctions
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
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
        'wpd-flowers'      => esc_html__( 'Flowers', 'cannabiz-menu' ),
        'wpd-concentrates' => esc_html__( 'Concentrates', 'cannabiz-menu' ),
        'wpd-tinctures'    => esc_html__( 'Tinctures', 'cannabiz-menu' ),
        'wpd-edibles'      => esc_html__( 'Edibles', 'cannabiz-menu' ),
        'wpd-prerolls'     => esc_html__( 'Pre-rolls', 'cannabiz-menu' ),
        'wpd-topicals'     => esc_html__( 'Topicals', 'cannabiz-menu' ),
        'wpd-growers'      => esc_html__( 'Growers', 'cannabiz-menu' ),
        'wpd-gear'         => esc_html__( 'Gear', 'cannabiz-menu' ),
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
    $menu_types_simple = [];

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
