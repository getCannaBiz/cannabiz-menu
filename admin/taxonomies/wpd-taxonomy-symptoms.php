<?php
/**
 * WP Dispensary Taxonomy - Symptoms
 *
 * This file is used to define the product symptoms taxonomy of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/taxonomies
 */


/**
 * Symptoms Taxonomy
 *
 * Adds the Symptom taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wp_dispensary_symptoms_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Symptoms', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Symptom', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Symptoms', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Symptoms', 'wp-dispensary' ),
		'all_items'                  => __( 'All Symptoms', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Symptom', 'wp-dispensary' ),
		'update_item'                => __( 'Update Symptom', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Symptom', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Symptom Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate symptoms with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove symptoms', 'wp-dispensary' ),
		'choose_from_most_used'      => __( 'Choose from the most used symptoms', 'wp-dispensary' ),
		'not_found'                  => __( 'No symptoms found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Symptoms', 'wp-dispensary' ),
	);

	register_taxonomy( 'symptoms', 'products', array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array(
			'slug' => 'symptom',
		),
	) );
}
add_action( 'init', 'wp_dispensary_symptoms_taxonomy', 0 );

