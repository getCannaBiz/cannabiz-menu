<?php
/**
 * deprecated functions that are still able to be used, but will no longer be
 * updated with new features.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get all menu types
 *
 * @since 2.5
 * @return array
 */
function wpd_menu_types() {
	$menu_types = array(
		'wpd-flowers'      => __( 'Flowers', 'wp-dispensary' ),
		'wpd-concentrates' => __( 'Concentrates', 'wp-dispensary' ),
		'wpd-tinctures'    => __( 'Tinctures', 'wp-dispensary' ),
		'wpd-edibles'      => __( 'Edibles', 'wp-dispensary' ),
		'wpd-prerolls'     => __( 'Pre-rolls', 'wp-dispensary' ),
		'wpd-topicals'     => __( 'Topicals', 'wp-dispensary' ),
		'wpd-growers'      => __( 'Growers', 'wp-dispensary' ),
		'wpd-gear'         => __( 'Gear', 'wp-dispensary' ),
	);
	return apply_filters( 'wpd_menu_types', $menu_types );
}

/**
 * Get all menu types - Simple
 *
 * @todo update this function to have $lowercase = true, and pass a second arg ($implode) set to false
 * by default. I can use the code found elsewhere in the theme to include this option.
 * 
 * @since 2.5
 * @return array
 */
function wpd_menu_types_simple( $lowercase = NULL ) {

	// Get menu types.
	$menu_types = wpd_menu_types();

	// Create simple array.
	$menu_types_simple = array();

	// Loop through menu types.
	foreach ( $menu_types as $key=>$value ) {
		// Add items to simple array.
		if ( $lowercase ) {
			$menu_types_simple[] = str_replace( '-', '', strtolower( $value ) );
		} else {
			$menu_types_simple[] = $value;
		}
	}

	return apply_filters( 'wpd_menu_types_simple', $menu_types_simple );
}
