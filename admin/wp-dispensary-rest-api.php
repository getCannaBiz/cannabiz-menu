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

/**
 * Register 'Products' route
 * 
 * @since  4.0
 * @return void
 */
function wpd_register_rest_api_route() {
	// Register 'Products' route.
	register_rest_route( 'wpd/v1', 'products', array(
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
		if ( get_post_meta( $product_id, 'inventory_grams', TRUE ) ) {
			$inventory_type = 'grams';
		} else {
			$inventory_type = 'units';
		}
		// Compound type.
		$compound_type = wpd_compound_type( $product_id );
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
		$product_data[$product_id]['compound_type']     = $compound_type;
		$product_data[$product_id]['compounds']['thc']  = $compounds_thc;
		$product_data[$product_id]['compounds']['thca'] = $compounds_thc;
		$product_data[$product_id]['compounds']['cbd']  = $compounds_cbd;
		$product_data[$product_id]['compounds']['cba']  = $compounds_cba;
		$product_data[$product_id]['compounds']['cbn']  = $compounds_cbn;
		$product_data[$product_id]['compounds']['cbg']  = $compounds_cbg;
    }

    wp_reset_postdata();

    return rest_ensure_response( $product_data );
}

/**
 * Adding featured image URL's to REST API endpoint.
 *
 * @access public
 *
 * @param object  $data
 * @param WP_Post $post    The WordPress post object.
 * @param null    $request Unused.
 *
 * @return object The featured image data.
 */
function wpd_rest_featured_image_url( $data, $post, $request ) {
	$_data                       = $data->data;
	$thumbnail_id                = get_post_thumbnail_id( $post->ID );
	$thumbnail                   = wp_get_attachment_image_src( $thumbnail_id, 'full' );
	$_data['featured_image_url'] = $thumbnail[0];
	$data->data                  = $_data;
	return $data;
}
add_filter( 'rest_prepare_products', 'wpd_rest_featured_image_url', 10, 3 );

/**
 * Adding featured image URL's to Flowers Custom Post Type
 *
 * @access public
 *
 * @param object  $data
 * @param WP_Post $post    The WordPress post object.
 * @param null    $request Unused.
 *
 * @return object The featured image data.
 */
function wpd_rest_featured_images( $data, $post, $request ) {
	$_data                             = $data->data;
	$thumbnail_id                      = get_post_thumbnail_id( $post->ID );
	$wpd_default                       = wp_get_attachment_image_src( $thumbnail_id, 'dispensary-image' );
	$wpd_thumbnail                     = wp_get_attachment_image_src( $thumbnail_id, 'wpd-thumbnail' );
	$wpd_small                         = wp_get_attachment_image_src( $thumbnail_id, 'wpd-small' );
	$wpd_medium                        = wp_get_attachment_image_src( $thumbnail_id, 'wpd-medium' );
	$wpd_large                         = wp_get_attachment_image_src( $thumbnail_id, 'wpd-large' );
	$_data['featured_image_default']   = $wpd_default[0];
	$_data['featured_image_thumbnail'] = $wpd_thumbnail[0];
	$_data['featured_image_small']     = $wpd_small[0];
	$_data['featured_image_medium']    = $wpd_medium[0];
	$_data['featured_image_large']     = $wpd_large[0];
	$data->data                        = $_data;
	return $data;
}
add_filter( 'rest_prepare_products', 'wpd_rest_featured_images', 10, 3 );

/**
 * Add 'categories' endpoint for the Products Custom Post Type
 *
 * @since 4.0
 */
function products_category_numbers( $data, $post, $request ) {

	$_data = $data->data;
	$items = wp_get_post_terms( $post->ID, 'product_category' );

	foreach ( $items as $item=>$value ) {
		$_data['categories'][$item]['id']          = $value->term_id;
		$_data['categories'][$item]['slug']        = $value->slug;
		$_data['categories'][$item]['title']       = $value->name;
		$_data['categories'][$item]['description'] = $value->description;
		$_data['categories'][$item]['count']       = $value->count;
	}

	$data->data = $_data;

	return $data;
}
add_filter( 'rest_prepare_products', 'products_category_numbers', 10, 3 );

/**
 * Add 'prices' endpoint for the Custom Post Types
 *
 * @since 2.7
 */
function wpd_product_prices_all( $data, $post, $request ) {
	$_data           = $data->data;
	$_data['prices'] = get_wpd_all_prices_simple( $post->ID, TRUE );
	$data->data      = $_data;
	return $data;
}
add_filter( 'rest_prepare_products', 'wpd_product_prices_all', 10, 3 );

/**
 * Add custom taxonomies to Products
 * 
 * @since 4.0
 */
function products_taxonomies( $data, $post, $request ) {
	$_data                 = $data->data;
	$_data['aromas']       = get_the_term_list( $post->ID, 'aroma', '', ' ', '' );
	$_data['flavors']      = get_the_term_list( $post->ID, 'flavor', '', ' ', '' );
	$_data['effects']      = get_the_term_list( $post->ID, 'effect', '', ' ', '' );
	$_data['symptoms']     = get_the_term_list( $post->ID, 'symptom', '', ' ', '' );
	$_data['conditions']   = get_the_term_list( $post->ID, 'condition', '', ' ', '' );
	$_data['shelf_types']  = get_the_term_list( $post->ID, 'shelf_type', '', ' ', '' );
	$_data['strain_types'] = get_the_term_list( $post->ID, 'strain_type', '', ' ', '' );
	$_data['vendors']      = get_the_term_list( $post->ID, 'vendor', '', ' ', '' );
	$data->data            = $_data;
	return $data;
}
add_filter( 'rest_prepare_products', 'products_taxonomies', 10, 3 );

/**
 * Add 'details' endpoint to Products
 *
 * @since 2.7
 */
function wpd_product_details_all( $data, $post, $request ) {

	// Display product details.
	$product_details = array(
		'thc'         => 'show',
		'thca'        => '',
		'cbd'         => '',
		'cba'         => '',
		'cbn'         => '',
		'cbg'         => '',
		'seed_count'  => 'show',
		'clone_count' => 'show',
		'total_thc'   => 'show',
		'size'        => 'show',
		'servings'    => 'show',
		'weight'      => 'show'
	);

	$details = apply_filters( 'wpd_product_details_all', $product_details );

	$_data            = $data->data;
	$_data['details'] = get_wpd_product_details( $post->ID, $details, 'span' );
	$data->data       = $_data;
	return $data;

}
add_filter( 'rest_prepare_products', 'wpd_product_details_all', 10, 3 );

/**
 * This adds the wpdispensary_prices metafields to the
 * API callback for flowers
 *
 * @since    1.1.0
 */

/**
 * Registering Prices
 */
function slug_register_prices() {
	$productsizes = apply_filters( 'wpd_rest_api_register_flowers_prices', array( 'price_gram', 'price_two_grams', 'price_eighth', 'price_five_grams', 'price_quarter_ounce', 'price_half_ounce', 'price_ounce' ) );
	foreach ( $productsizes as $size ) {
		register_rest_field(
			array( 'flowers' ),
			$size,
			array(
				'get_callback'    => 'slug_get_prices',
				'update_callback' => 'slug_update_prices',
				'schema'          => null,
			)
		);
	} /** /foreach */
}
add_action( 'rest_api_init', 'slug_register_prices' );

/**
 * Get Prices
 */
function slug_get_prices( $object, $field_name, $request ) {
	return get_post_meta( $object->ID, $field_name, true );
}

/**
 * Update Prices
 */
function slug_update_prices( $value, $object, $field_name ) {
	return update_post_meta( $object->ID, $field_name, $value );
}

/**
 * This adds the wpdispensary_prices metafields to the
 * API callback for concentrates
 *
 * @since    1.9.6
 */

/**
 * Registering Prices
 */
function slug_register_concentrateprices() {
	$productsizes = apply_filters( 'wpd_rest_api_register_concentrates_prices', array( 'price_each', 'price_half_gram', 'price_gram', 'price_two_grams' ) );
	foreach ( $productsizes as $size ) {
		register_rest_field(
			array( 'concentrates' ),
			$size,
			array(
				'get_callback'    => 'slug_get_concentrateprices',
				'update_callback' => 'slug_update_concentrateprices',
				'schema'          => null,
			)
		);
	} /** /foreach */
}
add_action( 'rest_api_init', 'slug_register_concentrateprices' );

/**
 * Get Prices
 */
function slug_get_concentrateprices( $object, $field_name, $request ) {
	return get_post_meta( $object->ID, $field_name, true );
}

/**
 * Update Prices
 */
function slug_update_concentrateprices( $value, $object, $field_name ) {
	return update_post_meta( $object->ID, $field_name, $value );
}

/**
 * This adds the metafields to the API
 * callback for edibles
 *
 * @since    1.1.0
 */

/**
 * Register Edible information
 */
function slug_register_edibleinfo() {
	$edibleinformation = apply_filters( 'wpd_rest_api_register_edibles_info', array( 'compounds_thc', 'product_servings', 'price_each', 'units_per_pack', 'price_per_pack' ) );
	foreach ( $edibleinformation as $edibleinfo ) {
		register_rest_field(
			'edibles',
			$edibleinfo,
			array(
				'get_callback'    => 'slug_get_edibleinfo',
				'update_callback' => 'slug_update_edibleinfo',
				'schema'          => null,
			)
		);
	} /** /foreach */
}
add_action( 'rest_api_init', 'slug_register_edibleinfo' );

/**
 * Get Edible info
 */
function slug_get_edibleinfo( $object, $field_name, $request ) {
	return get_post_meta( $object->ID, $field_name, true );
}

/**
 * Update Edible info
 */
function slug_update_edibleinfo( $value, $object, $field_name ) {
	return update_post_meta( $object->ID, $field_name, $value );
}

/**
 * This adds the metafields to the API
 * callback for pre-rolls
 *
 * @since    1.1.0
 */

/**
 * Register Pre-roll info
 */
function slug_register_prerollinfo() {
	$prerollinformation = apply_filters( 'wpd_rest_api_register_prerolls_info', array( 'price_each', 'product_flower', 'units_per_pack', 'price_per_pack', 'product_weight' ) );
	foreach ( $prerollinformation as $prerollinfo ) {
		register_rest_field(
			'prerolls',
			$prerollinfo,
			array(
				'get_callback'    => 'slug_get_prerollinfo',
				'update_callback' => 'slug_update_prerollinfo',
				'schema'          => null,
			)
		);
	} /** /foreach */
}
add_action( 'rest_api_init', 'slug_register_prerollinfo' );

/**
 * Get Pre-roll info
 */
function slug_get_prerollinfo( $object, $field_name, $request ) {
	return get_post_meta( $object->ID, $field_name, true );
}

/**
 * Update Pre-roll info
 */
function slug_update_prerollinfo( $value, $object, $field_name ) {
	return update_post_meta( $object->ID, $field_name, $value );
}

/**
 * This adds the wpdispensary_compounds metafields to the
 * API callback for flowers & concentrates
 *
 * @since    1.9.9
 */

/**
 * Register compound details info
 */
function slug_register_compounds() {
	/**
	 * @todo add function instead of array.
	 */
	$compounds = array( 'compound_thc', 'compound_thca', 'compound_cbd', 'compound_cba', 'compound_cbn', 'compound_cbg' );
	foreach ( $compounds as $compound ) {
		register_rest_field(
			array( 'flowers', 'concentrates' ),
			$compound,
			array(
				'get_callback'    => 'slug_get_compounds',
				'update_callback' => 'slug_update_compounds',
				'schema'          => null,
			)
		);
	} /** /foreach */
}
add_action( 'rest_api_init', 'slug_register_compounds' );

/**
 * Get Compound info
 */
function slug_get_compounds( $object, $field_name, $request ) {
	return get_post_meta( $object->ID, $field_name, true );
}

/**
 * Update Compound info
 */
function slug_update_compounds( $value, $object, $field_name ) {
	return update_post_meta( $object->ID, $field_name, $value );
}

/**
 * This adds the metafields to the API
 * callback for topicals
 *
 * @since    1.4.0
 */

/**
 * Register Topical info
 */
function slug_register_topicalinfo() {
	$topicalinformation = apply_filters( 'wpd_rest_api_register_topicals_info', array( 'price_each', 'units_per_pack', 'price_per_pack', 'compound_thc', 'compound_cbd', 'product_size' ) );
	foreach ( $topicalinformation as $topicalinfo ) {
		register_rest_field(
			'topicals',
			$topicalinfo,
			array(
				'get_callback'    => 'slug_get_topicalinfo',
				'update_callback' => 'slug_update_topicalinfo',
				'schema'          => null,
			)
		);
	} /** /foreach */
}
add_action( 'rest_api_init', 'slug_register_topicalinfo' );

/**
 * Get Topical info
 */
function slug_get_topicalinfo( $object, $field_name, $request ) {
	return get_post_meta( $object->ID, $field_name, true );
}

/**
 * Update Topical info
 */
function slug_update_topicalinfo( $value, $object, $field_name ) {
	return update_post_meta( $object->ID, $field_name, $value );
}

/**
 * This adds the metafields to the API
 * callback for growers
 *
 * @since    1.7.0
 */

/**
 * Register Grower info
 */
function slug_register_growerinfo() {
	$growerinformation = apply_filters( 'wpd_rest_api_register_growers_info', array( 'price_each', 'units_per_pack', 'price_per_pack', 'product_flower', 'seed_count', 'clone_count', 'product_time', 'product_origin', 'product_yield', 'product_difficulty' ) );
	foreach ( $growerinformation as $growerinfo ) {
		register_rest_field(
			'growers',
			$growerinfo,
			array(
				'get_callback'    => 'slug_get_growerinfo',
				'update_callback' => 'slug_update_growerinfo',
				'schema'          => null,
			)
		);
	} /** /foreach */
}
add_action( 'rest_api_init', 'slug_register_growerinfo' );

/**
 * Get Grower info
 */
function slug_get_growerinfo( $object, $field_name, $request ) {
	return get_post_meta( $object->ID, $field_name, true );
}

/**
 * Update Grower info
 */
function slug_update_growerinfo( $value, $object, $field_name ) {
	return update_post_meta( $object->ID, $field_name, $value );
}
