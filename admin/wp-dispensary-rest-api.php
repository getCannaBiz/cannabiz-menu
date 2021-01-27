<?php
/**
 * Adding the Custom Post Type metaboxes and taxonomies
 * to the WordPress REST API
 *
 * @link       https://www.wpdispensary.com
 * @since      1.1.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Define WPD REST API version number.
define( 'WPD_REST_API_VERSION_NUMBER', '1' );

// Define WPD REST API version.
define( 'WPD_REST_API_VERSION', 'v' . WPD_REST_API_VERSION_NUMBER );

// Define the WPD REST API namespace.
define( 'WPD_REST_API_NAMESPACE', 'wpd/' . WPD_REST_API_VERSION );

/**
 * Register 'Products' route
 * 
 * @since  4.0
 * @return void
 */
function wpd_register_rest_api_route() {
	// Register 'Products' route.
	register_rest_route( WPD_REST_API_NAMESPACE, 'products', array(
			'methods'  => 'GET',
			'callback' => 'wpd_rest_api_products_route_callback',
			'args'     => array(
				'id' => array(
				'validate_callback' => function( $param, $request, $key ) {
					return is_numeric( $param );
				}
			),
		),
	) );
}
add_action( 'rest_api_init', 'wpd_register_rest_api_route' );

/**
 * Products API Route Callback
 * 
 * @since  4.0
 * @param  array  $data
 * @return string
 */
function wpd_rest_api_products_route_callback( $data ) {
	// Get the products.
	$products_list = get_posts(
		array(
			'numberposts' => -1,
			'post_type'   => 'products',
		)
	);

	// Product data array.
	$product_data  = array();

	// Product ID.
	$product_id = '';

	// Get singular product if ID is passed.
	if ( $data['id'] ) {
		$product_id = get_post( $data['id'] );
	}

	// Loop through products.
	foreach( $products_list as $product ) {
		// Product default data.
		$product_id      = $product->ID;
		$product_title   = $product->post_title;
		$product_content = $product->post_content;
		// Product type.
		$product_type = get_post_meta( $product_id, 'product_type', true );
		// Prices.
		$product_prices  = get_wpd_all_prices_simple( $product_id );
		// Categories.
		$product_categories = wp_get_post_terms( $product_id, 'wpd_categories', array( 'fields' => 'ids' ) );
		// Vendors.
		$product_vendors = wp_get_post_terms( $product_id, 'vendor', array( 'fields' => 'ids' ) );
		// Shelf type.
		$product_shelf_type = wp_get_post_terms( $product_id, 'shelf_type', array( 'fields' => 'ids' ) );
		// Strain type.
		$product_strain_type = wp_get_post_terms( $product_id, 'strain_type', array( 'fields' => 'ids' ) );
		// Inventory amount.
		$inventory_amount = get_post_meta( $product_id, 'inventory_grams', TRUE );
		// Inventory type.
		$inventory_type = 'units';
		if ( get_post_meta( $product_id, 'inventory_grams', TRUE ) ) {
			$inventory_type = 'grams';
		}
		// Compound type.
		$compound_type = wpd_compound_type( $product_id );
		// Compound total.
		$compound_total = get_post_meta( $product_id, 'compounds_total', TRUE );
		// Compounds.
		$compounds_thc  = get_post_meta( $product_id, 'thc', TRUE );
		$compounds_thca = get_post_meta( $product_id, 'thca', TRUE );
		$compounds_cbd  = get_post_meta( $product_id, 'cbd', TRUE );
		$compounds_cba  = get_post_meta( $product_id, 'cba', TRUE );
		$compounds_cbn  = get_post_meta( $product_id, 'cbn', TRUE );
		$compounds_cbg  = get_post_meta( $product_id, 'cbg', TRUE );

		// Create individual product data endpoints.
        $product_data[$product_id]['title']        = $product_title;
        $product_data[$product_id]['content']      = $product_content;
		$product_data[$product_id]['product_type'] = $product_type;
		$product_data[$product_id]['prices']       = $product_prices;
		$product_data[$product_id]['categories']   = $product_categories;
		$product_data[$product_id]['vendors']      = $product_vendors;
		$product_data[$product_id]['shelf_type']   = $product_shelf_type;
		$product_data[$product_id]['strain_type']  = $product_strain_type;
		// Create inventory endpoints.
		$product_data[$product_id]['inventory']['type']   = $inventory_type;
		$product_data[$product_id]['inventory']['amount'] = $inventory_amount;
		// Create compounds endpoints.
		$product_data[$product_id]['compounds']['type']             = $compound_type;
		$product_data[$product_id]['compounds']['total']            = $compound_total;
		$product_data[$product_id]['compounds']['compound']['thc']  = $compounds_thc;
		$product_data[$product_id]['compounds']['compound']['thca'] = $compounds_thc;
		$product_data[$product_id]['compounds']['compound']['cbd']  = $compounds_cbd;
		$product_data[$product_id]['compounds']['compound']['cba']  = $compounds_cba;
		$product_data[$product_id]['compounds']['compound']['cbn']  = $compounds_cbn;
		$product_data[$product_id]['compounds']['compound']['cbg']  = $compounds_cbg;
    }

    wp_reset_postdata();

    return rest_ensure_response( $product_data );
}
