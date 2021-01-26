<?php
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

