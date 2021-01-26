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

