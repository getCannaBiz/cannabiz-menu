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

// Adding featured image URL's to each Custom Post Type

function flowers_featuredimage( $data, $post, $request ) {
	$_data = $data->data;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'full' );
	$_data['featured_image_url'] = $thumbnail[0];
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_featuredimage', 10, 3 );

function concentrates_featuredimage( $data, $post, $request ) {
	$_data = $data->data;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'full' );
	$_data['featured_image_url'] = $thumbnail[0];
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_featuredimage', 10, 3 );

function edibles_featuredimage( $data, $post, $request ) {
	$_data = $data->data;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'full' );
	$_data['featured_image_url'] = $thumbnail[0];
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_edibles', 'edibles_featuredimage', 10, 3 );

function prerolls_featuredimage( $data, $post, $request ) {
	$_data = $data->data;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'full' );
	$_data['featured_image_url'] = $thumbnail[0];
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_prerolls', 'prerolls_featuredimage', 10, 3 );

// Add Category taxonomy for the Flowers Custom Post Type

function flowers_category( $data, $post, $request ) {
	$_data = $data->data;
	$_data['flowers_category'] = get_the_term_list( $post->ID, 'flowers_category', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_category', 10, 3 );

// Add Aroma taxonomy for the Flowers Custom Post Type

function flowers_aroma( $data, $post, $request ) {
	$_data = $data->data;
	$_data['aromas'] = get_the_term_list( $post->ID, 'aroma', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_aroma', 10, 3 );

// Add Flavor taxonomy for the Flowers Custom Post Type

function flowers_flavor( $data, $post, $request ) {
	$_data = $data->data;
	$_data['flavors'] = get_the_term_list( $post->ID, 'flavor', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_flavor', 10, 3 );

// Add Effect taxonomy for the Flowers Custom Post Type

function flowers_effect( $data, $post, $request ) {
	$_data = $data->data;
	$_data['effects'] = get_the_term_list( $post->ID, 'effect', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_effect', 10, 3 );

// Add Symptom taxonomy for the Flowers Custom Post Type

function flowers_symptom( $data, $post, $request ) {
	$_data = $data->data;
	$_data['symptoms'] = get_the_term_list( $post->ID, 'symptom', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_symptom', 10, 3 );

// Add Condition taxonomy for the Flowers Custom Post Type

function flowers_condition( $data, $post, $request ) {
	$_data = $data->data;
	$_data['conditions'] = get_the_term_list( $post->ID, 'condition', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'flowers_condition', 10, 3 );

// Add Category taxonomy for the Concentrates Custom Post Type

function concentrates_category( $data, $post, $request ) {
	$_data = $data->data;
	$_data['concentrates_category'] = get_the_term_list( $post->ID, 'concentrates_category', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_category', 10, 3 );

// Add Aroma taxonomy for the Concentrates Custom Post Type

function concentrates_aroma( $data, $post, $request ) {
	$_data = $data->data;
	$_data['aromas'] = get_the_term_list( $post->ID, 'aroma', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_aroma', 10, 3 );

// Add Flavor taxonomy for the Concentrates Custom Post Type

function concentrates_flavor( $data, $post, $request ) {
	$_data = $data->data;
	$_data['flavors'] = get_the_term_list( $post->ID, 'flavor', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_flavor', 10, 3 );

// Add Effect taxonomy for the Concentrates Custom Post Type

function concentrates_effect( $data, $post, $request ) {
	$_data = $data->data;
	$_data['effects'] = get_the_term_list( $post->ID, 'effect', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_effect', 10, 3 );

// Add Symptom taxonomy for the Concentrates Custom Post Type

function concentrates_symptom( $data, $post, $request ) {
	$_data = $data->data;
	$_data['symptoms'] = get_the_term_list( $post->ID, 'symptom', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_symptom', 10, 3 );

// Add Condition taxonomy for the Concentrates Custom Post Type

function concentrates_condition( $data, $post, $request ) {
	$_data = $data->data;
	$_data['conditions'] = get_the_term_list( $post->ID, 'condition', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'concentrates_condition', 10, 3 );

// Add Category taxonomy for the Edibles Custom Post Type

function edibles_category( $data, $post, $request ) {
	$_data = $data->data;
	$_data['edibles_category'] = get_the_term_list( $post->ID, 'edibles_category', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_edibles', 'edibles_category', 10, 3 );

// Add Ingredients taxonomy for the Edibles Custom Post Type

function edibles_ingredients( $data, $post, $request ) {
	$_data = $data->data;
	$_data['ingredients'] = get_the_term_list( $post->ID, 'ingredients', '', ' ', '' );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_edibles', 'edibles_ingredients', 10, 3 );

/**
 * This adds the wpdispensary_prices metafields to the
 * API callback for flowers and concentrates
 *
 * @since    1.1.0
 */

add_action( 'rest_api_init', 'slug_register_prices' );
function slug_register_prices() {
	$productsizes = array( '_halfgram', '_gram', '_eighth', '_quarter', '_halfounce', '_ounce' );
	foreach ( $productsizes as $size ) {
		register_api_field(
			array( 'flowers', 'concentrates'),
			$size,
			array(
				'get_callback'    => 'slug_get_prices',
				'update_callback' => null,
				'schema'          => null,
			)
		);
	} // /foreach
}
function slug_get_prices( $object, $field_name, $request ) {
    return get_post_meta( $object[ 'id' ], $field_name, true );
}

/**
 * This adds the metafields to the API
 * callback for edibles
 *
 * @since    1.1.0
 */

add_action( 'rest_api_init', 'slug_register_edibleinfo' );
function slug_register_edibleinfo() {
	$edibleinformation = array( '_thcmg', '_thcservings', '_priceeach' );
	foreach ( $edibleinformation as $edibleinfo ) {
		register_api_field(
			'edibles',
			$edibleinfo,
			array(
				'get_callback'    => 'slug_get_edibleinfo',
				'update_callback' => null,
				'schema'          => null,
			)
		);
	} // /foreach
}
function slug_get_edibleinfo( $object, $field_name, $request ) {
    return get_post_meta( $object[ 'id' ], $field_name, true );
}

/**
 * This adds the metafields to the API
 * callback for pre-rolls
 *
 * @since    1.1.0
 */

add_action( 'rest_api_init', 'slug_register_prerollinfo' );
function slug_register_prerollinfo() {
	$prerollinformation = array( '_priceeach', '_selected_flowers' );
	foreach ( $prerollinformation as $prerollinfo ) {
		register_api_field(
			'prerolls',
			$prerollinfo,
			array(
				'get_callback'    => 'slug_get_prerollinfo',
				'update_callback' => null,
				'schema'          => null,
			)
		);
	} // /foreach
}
function slug_get_prerollinfo( $object, $field_name, $request ) {
    return get_post_meta( $object[ 'id' ], $field_name, true );
}




/**
 * Add the subtitle to the API callback
 * for all custom post types
 *
 * @since    1.1.0
 */

function subtitles_flowers( $data, $post, $request ) {
	$_data = $data->data;
	$_data['subtitle'] = get_the_subtitle( $post->ID );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_flowers', 'subtitles_flowers', 10, 3 );

function subtitles_concentrates( $data, $post, $request ) {
	$_data = $data->data;
	$_data['subtitle'] = get_the_subtitle( $post->ID );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_concentrates', 'subtitles_concentrates', 10, 3 );

function subtitles_edibles( $data, $post, $request ) {
	$_data = $data->data;
	$_data['subtitle'] = get_the_subtitle( $post->ID );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_edibles', 'subtitles_edibles', 10, 3 );

function subtitles_prerolls( $data, $post, $request ) {
	$_data = $data->data;
	$_data['subtitle'] = get_the_subtitle( $post->ID );
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_prerolls', 'subtitles_prerolls', 10, 3 );
