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
add_filter( 'rest_prepare_flowers', 'wpd_rest_featured_image_url', 10, 3 );
add_filter( 'rest_prepare_concentrates', 'wpd_rest_featured_image_url', 10, 3 );
add_filter( 'rest_prepare_edibles', 'wpd_rest_featured_image_url', 10, 3 );
add_filter( 'rest_prepare_prerolls', 'wpd_rest_featured_image_url', 10, 3 );
add_filter( 'rest_prepare_topicals', 'wpd_rest_featured_image_url', 10, 3 );
add_filter( 'rest_prepare_growers', 'wpd_rest_featured_image_url', 10, 3 );

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
add_filter( 'rest_prepare_flowers', 'wpd_rest_featured_images', 10, 3 );
add_filter( 'rest_prepare_concentrates', 'wpd_rest_featured_images', 10, 3 );
add_filter( 'rest_prepare_edibles', 'wpd_rest_featured_images', 10, 3 );
add_filter( 'rest_prepare_prerolls', 'wpd_rest_featured_images', 10, 3 );
add_filter( 'rest_prepare_topicals', 'wpd_rest_featured_images', 10, 3 );
add_filter( 'rest_prepare_growers', 'wpd_rest_featured_images', 10, 3 );


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
 * Add 'categories' endpoint for the Flowers Custom Post Type
 *
 * @since 2.0.2
 */
function flowers_category_numbers( $data, $post, $request ) {

	$_data = $data->data;
	$items = wp_get_post_terms( $post->ID, 'flowers_category' );

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
add_filter( 'rest_prepare_flowers', 'flowers_category_numbers', 10, 3 );

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
add_filter( 'rest_prepare_flowers', 'wpd_product_prices_all', 10, 3 );
add_filter( 'rest_prepare_concentrates', 'wpd_product_prices_all', 10, 3 );
add_filter( 'rest_prepare_edibles', 'wpd_product_prices_all', 10, 3 );
add_filter( 'rest_prepare_prerolls', 'wpd_product_prices_all', 10, 3 );
add_filter( 'rest_prepare_topicals', 'wpd_product_prices_all', 10, 3 );
add_filter( 'rest_prepare_growers', 'wpd_product_prices_all', 10, 3 );

/**
 * Add Aroma taxonomy for the Flowers Custom Post Type
 */
function flowers_aroma( $data, $post, $request ) {
	$_data           = $data->data;
	$_data['aromas'] = get_the_term_list( $post->ID, 'aroma', '', ' ', '' );
	$data->data      = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_aroma', 10, 3 );

/**
 * Add Flavor taxonomy for the Flowers Custom Post Type
 */
function flowers_flavor( $data, $post, $request ) {
	$_data            = $data->data;
	$_data['flavors'] = get_the_term_list( $post->ID, 'flavor', '', ' ', '' );
	$data->data       = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_flavor', 10, 3 );

/**
 * Add Effect taxonomy for the Flowers Custom Post Type
 */
function flowers_effect( $data, $post, $request ) {
	$_data            = $data->data;
	$_data['effects'] = get_the_term_list( $post->ID, 'effect', '', ' ', '' );
	$data->data       = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_effect', 10, 3 );

/**
 * Add Symptom taxonomy for the Flowers Custom Post Type
 */
function flowers_symptom( $data, $post, $request ) {
	$_data             = $data->data;
	$_data['symptoms'] = get_the_term_list( $post->ID, 'symptom', '', ' ', '' );
	$data->data        = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_symptom', 10, 3 );

/**
 * Add Condition taxonomy for the Flowers Custom Post Type
 */
function flowers_condition( $data, $post, $request ) {
	$_data               = $data->data;
	$_data['conditions'] = get_the_term_list( $post->ID, 'condition', '', ' ', '' );
	$data->data          = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_condition', 10, 3 );

/**
 * Add 'details' endpoint for the Custom Post Types
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
add_filter( 'rest_prepare_flowers', 'wpd_product_details_all', 10, 3 );
add_filter( 'rest_prepare_concentrates', 'wpd_product_details_all', 10, 3 );
add_filter( 'rest_prepare_edibles', 'wpd_product_details_all', 10, 3 );
add_filter( 'rest_prepare_prerolls', 'wpd_product_details_all', 10, 3 );
add_filter( 'rest_prepare_topicals', 'wpd_product_details_all', 10, 3 );
add_filter( 'rest_prepare_growers', 'wpd_product_details_all', 10, 3 );

/**
 * Add 'categories' endpoint for the Concentrates Custom Post Type
 *
 * @since 2.0.2
 */
function concentrates_category_numbers( $data, $post, $request ) {

	$_data = $data->data;
	$items = wp_get_post_terms( $post->ID, 'concentrates_category' );

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
add_filter( 'rest_prepare_concentrates', 'concentrates_category_numbers', 10, 3 );

/**
 * Add Aroma taxonomy for the Concentrates Custom Post Type
 */
function concentrates_aroma( $data, $post, $request ) {
	$_data           = $data->data;
	$_data['aromas'] = get_the_term_list( $post->ID, 'aroma', '', ' ', '' );
	$data->data      = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_aroma', 10, 3 );

/**
 * Add Flavor taxonomy for the Concentrates Custom Post Type
 */
function concentrates_flavor( $data, $post, $request ) {
	$_data            = $data->data;
	$_data['flavors'] = get_the_term_list( $post->ID, 'flavor', '', ' ', '' );
	$data->data       = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_flavor', 10, 3 );

/**
 * Add Effect taxonomy for the Concentrates Custom Post Type
 */
function concentrates_effect( $data, $post, $request ) {
	$_data            = $data->data;
	$_data['effects'] = get_the_term_list( $post->ID, 'effect', '', ' ', '' );
	$data->data       = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_effect', 10, 3 );

/**
 * Add Symptom taxonomy for the Concentrates Custom Post Type
 */
function concentrates_symptom( $data, $post, $request ) {
	$_data             = $data->data;
	$_data['symptoms'] = get_the_term_list( $post->ID, 'symptom', '', ' ', '' );
	$data->data        = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_symptom', 10, 3 );

/**
 * Add Condition taxonomy for the Concentrates Custom Post Type
 */
function concentrates_condition( $data, $post, $request ) {
	$_data               = $data->data;
	$_data['conditions'] = get_the_term_list( $post->ID, 'condition', '', ' ', '' );
	$data->data          = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_condition', 10, 3 );

/**
 * Add 'categories' endpoint for the Edibles Custom Post Type
 *
 * @since 2.0.2
 */
function edibles_category_numbers( $data, $post, $request ) {

	$_data = $data->data;
	$items = wp_get_post_terms( $post->ID, 'edibles_category' );

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
add_filter( 'rest_prepare_edibles', 'edibles_category_numbers', 10, 3 );

/**
 * Add 'categories' endpoint for the Topicals Custom Post Type
 *
 * @since 2.0.2
 */
function topicals_category_numbers( $data, $post, $request ) {

	$_data = $data->data;
	$items = wp_get_post_terms( $post->ID, 'topicals_category' );

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
add_filter( 'rest_prepare_topicals', 'topicals_category_numbers', 10, 3 );

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
	$productsizes = apply_filters( 'wpd_rest_api_register_flowers_prices', array( '_gram', '_twograms', '_eighth', '_fivegrams', '_quarter', '_halfounce', '_ounce' ) );
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
	$productsizes = apply_filters( 'wpd_rest_api_register_concentrates_prices', array( '_priceeach', '_halfgram', '_gram', '_twograms' ) );
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
	$edibleinformation = apply_filters( 'wpd_rest_api_register_edibles_info', array( '_thcmg', '_thcservings', '_priceeach', '_unitsperpack', 'priceperpack' ) );
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
	$prerollinformation = apply_filters( 'wpd_rest_api_register_prerolls_info', array( '_priceeach', '_selected_flowers', '_unitsperpack', 'priceperpack', '_preroll_weight' ) );
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
	$compounds = array( '_thc', '_thca', '_cbd', '_cba', '_cbn', '_cbg' );
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
	$topicalinformation = apply_filters( 'wpd_rest_api_register_topicals_info', array( '_pricetopical', '_unitsperpack', 'priceperpack', '_thctopical', '_cbdtopical', '_sizetopical' ) );
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
	$growerinformation = apply_filters( 'wpd_rest_api_register_growers_info', array( '_priceeach', '_unitsperpack', 'priceperpack', '_selected_flowers', '_seedcount', '_clonecount', '_time', '_origin', '_yield', '_difficulty' ) );
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

/**
 * Add 'categories' endpoint for the Growers Custom Post Type
 *
 * @since 2.0.2
 */
function growers_category_numbers( $data, $post, $request ) {

	$_data = $data->data;
	$items = wp_get_post_terms( $post->ID, 'growers_category' );

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
add_filter( 'rest_prepare_growers', 'growers_category_numbers', 10, 3 );


/**
 * Add Vendors taxonomy for all Custom Post Types
 */
function wpd_vendor( $data, $post, $request ) {
	$_data            = $data->data;
	$_data['vendors'] = get_the_term_list( $post->ID, 'vendor', '', ' ', '' );
	$data->data       = $_data;
	return $data;
}
add_filter( 'rest_prepare_products', 'wpd_vendor', 10, 3 );
add_filter( 'rest_prepare_flowers', 'wpd_vendor', 10, 3 );
add_filter( 'rest_prepare_concentrates', 'wpd_vendor', 10, 3 );
add_filter( 'rest_prepare_edibles', 'wpd_vendor', 10, 3 );
add_filter( 'rest_prepare_prerolls', 'wpd_vendor', 10, 3 );
add_filter( 'rest_prepare_topicals', 'wpd_vendor', 10, 3 );
add_filter( 'rest_prepare_growers', 'wpd_vendor', 10, 3 );

/**
 * Add Shelf Type taxonomy for specific Custom Post Types
 *
 * @since 3.1
 */
function wpd_rest_shelf_type( $data, $post, $request ) {
	$_data                = $data->data;
	$_data['shelf_types'] = get_the_term_list( $post->ID, 'shelf_type', '', ' ', '' );
	$data->data           = $_data;
	return $data;
}
add_filter( 'rest_prepare_products', 'wpd_rest_shelf_type', 10, 3 );
add_filter( 'rest_prepare_flowers', 'wpd_rest_shelf_type', 10, 3 );
add_filter( 'rest_prepare_concentrates', 'wpd_rest_shelf_type', 10, 3 );
add_filter( 'rest_prepare_edibles', 'wpd_rest_shelf_type', 10, 3 );
add_filter( 'rest_prepare_prerolls', 'wpd_rest_shelf_type', 10, 3 );
add_filter( 'rest_prepare_growers', 'wpd_rest_shelf_type', 10, 3 );

/**
 * Add Strain Type taxonomy for specific Custom Post Types
 *
 * @since 3.1
 */
function wpd_rest_strain_type( $data, $post, $request ) {
	$_data                 = $data->data;
	$_data['strain_types'] = get_the_term_list( $post->ID, 'strain_type', '', ' ', '' );
	$data->data            = $_data;
	return $data;
}
add_filter( 'rest_prepare_products', 'wpd_rest_strain_type', 10, 3 );
add_filter( 'rest_prepare_concentrates', 'wpd_rest_strain_type', 10, 3 );
add_filter( 'rest_prepare_edibles', 'wpd_rest_strain_type', 10, 3 );
add_filter( 'rest_prepare_prerolls', 'wpd_rest_strain_type', 10, 3 );
add_filter( 'rest_prepare_growers', 'wpd_rest_strain_type', 10, 3 );
