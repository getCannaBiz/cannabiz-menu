<?php
/**
 * Adding the Custom Post Type metaboxes and taxonomies
 * to the WordPress REST API
 *
 * @link       http://www.wpdispensary.com
 * @since      1.1.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

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
function flowers_featuredimage( $data, $post, $request ) {
	$_data = $data->data;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'full' );
	$_data['featured_image_url'] = $thumbnail[0];
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_featuredimage', 10, 3 );

/**
 * Adding featured image URL's to Concentrates Custom Post Type
 */
function concentrates_featuredimage( $data, $post, $request ) {
	$_data = $data->data;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'full' );
	$_data['featured_image_url'] = $thumbnail[0];
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_featuredimage', 10, 3 );

/**
 * Adding featured image URL's to Edibles Custom Post Type
 */
function edibles_featuredimage( $data, $post, $request ) {
	$_data = $data->data;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'full' );
	$_data['featured_image_url'] = $thumbnail[0];
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_edibles', 'edibles_featuredimage', 10, 3 );

/**
 * Adding featured image URL's to Pre-rolls Custom Post Type
 */
function prerolls_featuredimage( $data, $post, $request ) {
	$_data = $data->data;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'full' );
	$_data['featured_image_url'] = $thumbnail[0];
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_prerolls', 'prerolls_featuredimage', 10, 3 );

/**
 * Adding featured image URL's to Topicals Custom Post Type
 */
function topicals_featuredimage( $data, $post, $request ) {
	$_data = $data->data;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'full' );
	$_data['featured_image_url'] = $thumbnail[0];
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_topicals', 'topicals_featuredimage', 10, 3 );

/**
 * Adding featured image URL's to Growers Custom Post Type
 */
function growers_featuredimage( $data, $post, $request ) {
	$_data = $data->data;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'full' );
	$_data['featured_image_url'] = $thumbnail[0];
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_growers', 'growers_featuredimage', 10, 3 );

/**
 * Add Category taxonomy for the Flowers Custom Post Type
 */
function flowers_category( $data, $post, $request ) {
	$_data = $data->data;
	$_data['flowers_category'] = get_the_term_list( $post->ID, 'flowers_category', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_category', 10, 3 );

/**
 * Add Aroma taxonomy for the Flowers Custom Post Type
 */
function flowers_aroma( $data, $post, $request ) {
	$_data = $data->data;
	$_data['aromas'] = get_the_term_list( $post->ID, 'aroma', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_aroma', 10, 3 );

/**
 * Add Flavor taxonomy for the Flowers Custom Post Type
 */
function flowers_flavor( $data, $post, $request ) {
	$_data = $data->data;
	$_data['flavors'] = get_the_term_list( $post->ID, 'flavor', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_flavor', 10, 3 );

/**
 * Add Effect taxonomy for the Flowers Custom Post Type
 */
function flowers_effect( $data, $post, $request ) {
	$_data = $data->data;
	$_data['effects'] = get_the_term_list( $post->ID, 'effect', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_effect', 10, 3 );

/**
 * Add Symptom taxonomy for the Flowers Custom Post Type
 */
function flowers_symptom( $data, $post, $request ) {
	$_data = $data->data;
	$_data['symptoms'] = get_the_term_list( $post->ID, 'symptom', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_symptom', 10, 3 );

/**
 * Add Condition taxonomy for the Flowers Custom Post Type
 */
function flowers_condition( $data, $post, $request ) {
	$_data = $data->data;
	$_data['conditions'] = get_the_term_list( $post->ID, 'condition', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_condition', 10, 3 );

/**
 * Add Category taxonomy for the Concentrates Custom Post Type
 */
function concentrates_category( $data, $post, $request ) {
	$_data = $data->data;
	$_data['concentrates_category'] = get_the_term_list( $post->ID, 'concentrates_category', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_category', 10, 3 );

/**
 * Add Aroma taxonomy for the Concentrates Custom Post Type
 */
function concentrates_aroma( $data, $post, $request ) {
	$_data = $data->data;
	$_data['aromas'] = get_the_term_list( $post->ID, 'aroma', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_aroma', 10, 3 );

/**
 * Add Flavor taxonomy for the Concentrates Custom Post Type
 */
function concentrates_flavor( $data, $post, $request ) {
	$_data = $data->data;
	$_data['flavors'] = get_the_term_list( $post->ID, 'flavor', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_flavor', 10, 3 );

/**
 * Add Effect taxonomy for the Concentrates Custom Post Type
 */
function concentrates_effect( $data, $post, $request ) {
	$_data = $data->data;
	$_data['effects'] = get_the_term_list( $post->ID, 'effect', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_effect', 10, 3 );

/**
 * Add Symptom taxonomy for the Concentrates Custom Post Type
 */
function concentrates_symptom( $data, $post, $request ) {
	$_data = $data->data;
	$_data['symptoms'] = get_the_term_list( $post->ID, 'symptom', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_symptom', 10, 3 );

/**
 * Add Condition taxonomy for the Concentrates Custom Post Type
 */
function concentrates_condition( $data, $post, $request ) {
	$_data = $data->data;
	$_data['conditions'] = get_the_term_list( $post->ID, 'condition', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_condition', 10, 3 );

/**
 * Add Category taxonomy for the Edibles Custom Post Type
 */
function edibles_category( $data, $post, $request ) {
	$_data = $data->data;
	$_data['edibles_category'] = get_the_term_list( $post->ID, 'edibles_category', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_edibles', 'edibles_category', 10, 3 );

/**
 * Add Ingredients taxonomy for the Edibles Custom Post Type
 */
function edibles_ingredients( $data, $post, $request ) {
	$_data = $data->data;
	$_data['ingredients'] = get_the_term_list( $post->ID, 'ingredients', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_edibles', 'edibles_ingredients', 10, 3 );

/**
 * Add Category taxonomy for the Topicals Custom Post Type
 */
function topicals_category( $data, $post, $request ) {
	$_data = $data->data;
	$_data['topicals_category'] = get_the_term_list( $post->ID, 'topicals_category', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_topicals', 'topicals_category', 10, 3 );

/**
 * This adds the wpdispensary_prices metafields to the
 * API callback for flowers
 *
 * @since    1.1.0
 */

add_action( 'rest_api_init', 'slug_register_prices' );

/**
 * Registering Prices
 */
function slug_register_prices() {
	$productsizes = array( '_halfgram', '_gram', '_eighth', '_quarter', '_halfounce', '_ounce' );
	foreach ( $productsizes as $size ) {
		register_rest_field(
			array( 'flowers' ),
			$size,
			array(
				'get_callback'    => 'slug_get_prices',
				'update_callback' => null,
				'schema'          => null,
			)
		);
	} /** /foreach */
}

/**
 * Get Prices
 */
function slug_get_prices( $object, $field_name, $request ) {
	return get_post_meta( $object['id'], $field_name, true );
}

/**
 * This adds the wpdispensary_prices metafields to the
 * API callback for concentrates
 *
 * @since    1.9.6
 */

add_action( 'rest_api_init', 'slug_register_concentrateprices' );

/**
 * Registering Prices
 */
function slug_register_concentrateprices() {
	$productsizes = array( '_priceeach', '_halfgram', '_gram', '_twograms' );
	foreach ( $productsizes as $size ) {
		register_rest_field(
			array( 'concentrates' ),
			$size,
			array(
				'get_callback'    => 'slug_get_concentrateprices',
				'update_callback' => null,
				'schema'          => null,
			)
		);
	} /** /foreach */
}

/**
 * Get Prices
 */
function slug_get_concentrateprices( $object, $field_name, $request ) {
	return get_post_meta( $object['id'], $field_name, true );
}

/**
 * This adds the metafields to the API
 * callback for edibles
 *
 * @since    1.1.0
 */

add_action( 'rest_api_init', 'slug_register_edibleinfo' );

/**
 * Register Edible information
 */
function slug_register_edibleinfo() {
	$edibleinformation = array( '_thcmg', '_thcservings', '_priceeach' );
	foreach ( $edibleinformation as $edibleinfo ) {
		register_rest_field(
			'edibles',
			$edibleinfo,
			array(
				'get_callback'    => 'slug_get_edibleinfo',
				'update_callback' => null,
				'schema'          => null,
			)
		);
	} /** /foreach */
}

/**
 * Get Edible info
 */
function slug_get_edibleinfo( $object, $field_name, $request ) {
	return get_post_meta( $object['id'], $field_name, true );
}

/**
 * This adds the metafields to the API
 * callback for pre-rolls
 *
 * @since    1.1.0
 */

add_action( 'rest_api_init', 'slug_register_prerollinfo' );

/**
 * Register Pre-roll info
 */
function slug_register_prerollinfo() {
	$prerollinformation = array( '_priceeach', '_selected_flowers' );
	foreach ( $prerollinformation as $prerollinfo ) {
		register_rest_field(
			'prerolls',
			$prerollinfo,
			array(
				'get_callback'    => 'slug_get_prerollinfo',
				'update_callback' => null,
				'schema'          => null,
			)
		);
	} /** /foreach */
}

/**
 * Get Pre-roll info
 */
function slug_get_prerollinfo( $object, $field_name, $request ) {
	return get_post_meta( $object['id'], $field_name, true );
}

/**
 * This adds the wpdispensary_compounds metafields to the
 * API callback for flowers & concentrates
 *
 * @since    1.9.9
 */

add_action( 'rest_api_init', 'slug_register_compounds' );

/**
 * Register compound details info
 */
function slug_register_compounds() {
	$compounds = array( '_thc', '_thca', '_cbd', '_cba', '_cbn' );
	foreach ( $compounds as $compound ) {
		register_rest_field(
			array( 'flowers', 'concentrates' ),
			$size,
			array(
				'get_callback'    => 'slug_get_compounds',
				'update_callback' => null,
				'schema'          => null,
			)
		);
	} /** /foreach */
}

/**
 * Get Compound info
 */
function slug_get_compounds( $object, $field_name, $request ) {
	return get_post_meta( $object['id'], $field_name, true );
}

/**
 * This adds the metafields to the API
 * callback for topicals
 *
 * @since    1.4.0
 */

add_action( 'rest_api_init', 'slug_register_topicalinfo' );

/**
 * Register Topical info
 */
function slug_register_topicalinfo() {
	$topicalinformation = array( '_pricetopical', '_thctopical', '_cbdtopical', '_sizetopical' );
	foreach ( $topicalinformation as $topicalinfo ) {
		register_rest_field(
			'topicals',
			$topicalinfo,
			array(
				'get_callback'    => 'slug_get_topicalinfo',
				'update_callback' => null,
				'schema'          => null,
			)
		);
	} /** /foreach */
}

/**
 * Get Topical info
 */
function slug_get_topicalinfo( $object, $field_name, $request ) {
	return get_post_meta( $object['id'], $field_name, true );
}

/**
 * This adds the metafields to the API
 * callback for growers
 *
 * @since    1.7.0
 */

add_action( 'rest_api_init', 'slug_register_growerinfo' );

/**
 * Register Grower info
 */
function slug_register_growerinfo() {
	$growerinformation = array( '_priceeach', '_selected_flowers', '_seedcount', '_clonecount' , '_time' , '_origin' );
	foreach ( $growerinformation as $growerinfo ) {
		register_rest_field(
			'growers',
			$growerinfo,
			array(
				'get_callback'    => 'slug_get_growerinfo',
				'update_callback' => null,
				'schema'          => null,
			)
		);
	} /** /foreach */
}

/**
 * Get Grower info
 */
function slug_get_growerinfo( $object, $field_name, $request ) {
	return get_post_meta( $object['id'], $field_name, true );
}

