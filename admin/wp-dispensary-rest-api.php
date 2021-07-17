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
		$product_prices = wpd_product_prices_array( $product_id, $product_type );
		$price_array    = array();
		foreach ( $product_prices as $key=>$value ) {
			$name = str_replace( 'price_', '', $key );
			$price_array[$name] = $value;
		}
		$product_prices = $price_array;
		// Categories.
		$product_categories = wp_get_post_terms( $product_id, 'wpd_categories', array( 'fields' => 'ids' ) );
		// Vendors.
		$product_vendors = wp_get_post_terms( $product_id, 'vendors', array( 'fields' => 'ids' ) );
		// Shelf type.
		$product_shelf_type = wp_get_post_terms( $product_id, 'shelf_types', array( 'fields' => 'ids' ) );
		// Strain type.
		$product_strain_type = wp_get_post_terms( $product_id, 'strain_types', array( 'fields' => 'ids' ) );
		// Aromas.
		$product_aromas = wp_get_post_terms( $product_id, 'aromas', array( 'fields' => 'ids' ) );
		// Flavors.
		$product_flavors = wp_get_post_terms( $product_id, 'flavors', array( 'fields' => 'ids' ) );
		// Effects.
		$product_effects = wp_get_post_terms( $product_id, 'effects', array( 'fields' => 'ids' ) );
		// Symptoms.
		$product_symptoms = wp_get_post_terms( $product_id, 'symptoms', array( 'fields' => 'ids' ) );
		// Conditions.
		$product_conditions = wp_get_post_terms( $product_id, 'conditions', array( 'fields' => 'ids' ) );	
		// Inventory units.
		$inventory_type   = 'units';
		$inventory_amount = get_post_meta( $product_id, 'inventory_units', TRUE );
		// Inventory grams.
		if ( get_post_meta( $product_id, 'inventory_grams', TRUE ) ) {
			$inventory_type   = 'grams';
			$inventory_amount = get_post_meta( $product_id, 'inventory_grams', TRUE );
		}
		// Activation time.
		$activation_time = get_post_meta( $product_id, 'activation_time', TRUE );
		// Compound type.
		$compound_type = wpd_compound_type( $product_id );
		// Compound total.
		$compound_total = get_post_meta( $product_id, 'compounds_total', TRUE );
		// Compounds.
		$compounds_thc  = get_post_meta( $product_id, 'compounds_thc', TRUE );
		$compounds_thca = get_post_meta( $product_id, 'compounds_thca', TRUE );
		$compounds_cbd  = get_post_meta( $product_id, 'compounds_cbd', TRUE );
		$compounds_cba  = get_post_meta( $product_id, 'compounds_cba', TRUE );
		$compounds_cbn  = get_post_meta( $product_id, 'compounds_cbn', TRUE );
		$compounds_cbg  = get_post_meta( $product_id, 'compounds_cbg', TRUE );
		// Featured Product.
		$product_featured = get_post_meta( $product_id, 'product_featured', TRUE );
		// Product servings.
		$product_servings = get_post_meta( $product_id, 'product_servings', TRUE );
		// Product servings mL.
		$product_servings_ml = get_post_meta( $product_id, 'product_servings_ml', TRUE );
		// Product Net weight.
		$product_net_weight = get_post_meta( $product_id, 'product_net_weight', TRUE );
		// Product flower.
		$product_flower = get_post_meta( $product_id, 'product_flower', TRUE );
		// Product weight.
		$product_weight = get_post_meta( $product_id, 'product_weight', TRUE );
		// Product size.
		$product_size = get_post_meta( $product_id, 'product_size', TRUE );
		// Grower details.
		$product_origin     = get_post_meta( $product_id, 'product_origin', true );
		$product_yield      = get_post_meta( $product_id, 'product_yield', true );
		$product_time       = get_post_meta( $product_id, 'product_time', true );
		$product_difficulty = get_post_meta( $product_id, 'product_difficulty', true );
		$clone_count        = get_post_meta( $product_id, 'clone_count', true );
		$seed_count         = get_post_meta( $product_id, 'seed_count', true );

		// Create individual product data endpoints.
        $product_data[$product_id]['title']        = $product_title;
        $product_data[$product_id]['content']      = $product_content;
		$product_data[$product_id]['product_type'] = $product_type;
		$product_data[$product_id]['featured']     = $product_featured;
		$product_data[$product_id]['prices']       = $product_prices;
		$product_data[$product_id]['categories']   = $product_categories;
		$product_data[$product_id]['vendors']      = $product_vendors;
		$product_data[$product_id]['shelf_type']   = $product_shelf_type;
		$product_data[$product_id]['strain_type']  = $product_strain_type;
		$product_data[$product_id]['aromas']       = $product_aromas;
		$product_data[$product_id]['flavors']      = $product_flavors;
		$product_data[$product_id]['effects']      = $product_effects;
		$product_data[$product_id]['symptoms']     = $product_symptoms;
		$product_data[$product_id]['conditions']   = $product_conditions;
		// Create inventory endpoints.
		$product_data[$product_id]['inventory']['type']   = $inventory_type;
		$product_data[$product_id]['inventory']['amount'] = $inventory_amount;
		// Create compounds endpoints.
		$product_data[$product_id]['compounds']['type']             = $compound_type;
		$product_data[$product_id]['compounds']['total']            = $compound_total;
		$product_data[$product_id]['compounds']['compound']['thc']  = $compounds_thc;
		$product_data[$product_id]['compounds']['compound']['thca'] = $compounds_thca;
		$product_data[$product_id]['compounds']['compound']['cbd']  = $compounds_cbd;
		$product_data[$product_id]['compounds']['compound']['cba']  = $compounds_cba;
		$product_data[$product_id]['compounds']['compound']['cbn']  = $compounds_cbn;
		$product_data[$product_id]['compounds']['compound']['cbg']  = $compounds_cbg;
		// Create details endpoints.
		$product_data[$product_id]['details']['servings']        = $product_servings;
		$product_data[$product_id]['details']['servings_ml']     = $product_servings_ml;
		$product_data[$product_id]['details']['net_weight']      = $product_net_weight;
		$product_data[$product_id]['details']['product_flower']  = $product_flower;
		$product_data[$product_id]['details']['product_weight']  = $product_weight;
		$product_data[$product_id]['details']['activation_time'] = $activation_time;
		// Create growers endpoints.
		$product_data[$product_id]['growers']['origin']      = $product_origin;
		$product_data[$product_id]['growers']['yield']       = $product_yield;
		$product_data[$product_id]['growers']['time']        = $product_time;
		$product_data[$product_id]['growers']['difficulty']  = $product_difficulty;
		$product_data[$product_id]['growers']['clone_count'] = $clone_count;
		$product_data[$product_id]['growers']['seed_count']  = $seed_count;
	}

    wp_reset_postdata();

    return rest_ensure_response( $product_data );
}
