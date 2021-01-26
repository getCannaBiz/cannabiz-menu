<?php
/**
 * The file that defines the general helper functions.
 *
 * @link       https://www.wpdispensary.com
 * @since      3.4
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes/functions
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * WPD Admin Settings - Details phrase
 *
 * @since 2.5
 * @return string
 */
function get_wpd_details_phrase() {
	// Access all WP Dispensary Display Settings.
	$wpd_settings = get_option( 'wpdas_display' );

	// Check details phrase settings.
	if ( isset ( $wpd_settings['wpd_details_phrase_custom'] ) && '' !== $wpd_settings['wpd_details_phrase_custom'] ) {
		$wpd_details_phrase = $wpd_settings['wpd_details_phrase_custom'];
	} elseif ( isset ( $wpd_settings['wpd_details_phrase'] ) && 'Information' === $wpd_settings['wpd_details_phrase'] ) {
		$wpd_details_phrase = esc_attr__( 'Information', 'wp-dispensary' );
	} else {
		$wpd_details_phrase = esc_attr__( 'Details', 'wp-dispensary' );
	}

	// Create filterable details phrase.
	$wpd_details_phrase = apply_filters( 'wpd_details_phrase', $wpd_details_phrase );

	// Return the details phrase.
	return $wpd_details_phrase;
}

/**
 * Get all product types
 *
 * @since 4.0
 * @return array
 */
function wpd_product_types() {
	$product_types = array(
		'wpd-flowers'      => __( 'Flowers', 'wp-dispensary' ),
		'wpd-concentrates' => __( 'Concentrates', 'wp-dispensary' ),
		'wpd-tinctures'    => __( 'Tinctures', 'wp-dispensary' ),
		'wpd-edibles'      => __( 'Edibles', 'wp-dispensary' ),
		'wpd-prerolls'     => __( 'Pre-rolls', 'wp-dispensary' ),
		'wpd-topicals'     => __( 'Topicals', 'wp-dispensary' ),
		'wpd-growers'      => __( 'Growers', 'wp-dispensary' ),
		'wpd-gear'         => __( 'Gear', 'wp-dispensary' ),
	);
	return apply_filters( 'wpd_product_types', $product_types );
}

/**
 * Get menu type display name
 *
 * @since 4.0
 * @param string $slug
 * @return string
 */
function wpd_product_type_display_name( $slug = '' ) {
	if ( ! $slug ) {
		return null;
	}
	$product_types = array(
		'flowers'      => __( 'Flowers', 'wp-dispensary' ),
		'concentrates' => __( 'Concentrates', 'wp-dispensary' ),
		'tinctures'    => __( 'Tinctures', 'wp-dispensary' ),
		'edibles'      => __( 'Edibles', 'wp-dispensary' ),
		'prerolls'     => __( 'Pre-rolls', 'wp-dispensary' ),
		'topicals'     => __( 'Topicals', 'wp-dispensary' ),
		'growers'      => __( 'Growers', 'wp-dispensary' ),
		'gear'         => __( 'Gear', 'wp-dispensary' ),
	);
	return apply_filters( 'wpd_product_type_display_name', $product_types[$slug] );
}

/**
 * Get all product types - Simple
 *
 * @todo update this function to have $lowercase = true, and pass a second arg ($implode) set to false
 * by default. I can use the code found elsewhere in the theme to include this option.
 * 
 * @since  4.0
 * @return array
 */
function wpd_product_types_simple( $lowercase = NULL ) {

	// Get product types.
	$product_types = wpd_product_types();

	// Create simple array.
	$product_types_simple = array();

	// Loop through product types.
	foreach ( $product_types as $key=>$value ) {
		// Add items to simple array.
		if ( $lowercase ) {
			$product_types_simple[] = str_replace( '-', '', strtolower( $value ) );
		} else {
			$product_types_simple[] = $value;
		}
	}

	return apply_filters( 'wpd_product_types_simple', $product_types_simple );
}
