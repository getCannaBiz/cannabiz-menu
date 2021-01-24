<?php
/**
 * WP Dispensary Taxonomy - Allergens
 *
 * This file is used to define the product allergens taxonomy of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types/taxonomies
 */


/**
 * Allergens Taxonomy
 *
 * Adds the Allergens taxonomy to specific custom post types
 *
 * @since    2.3.0
 */
function wp_dispensary_allergens_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Allergens', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Allergen', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Allergens', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Allergens', 'wp-dispensary' ),
		'all_items'                  => __( 'All Allergens', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Allergen', 'wp-dispensary' ),
		'update_item'                => __( 'Update Allergen', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Allergen', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Allergen Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate allergens with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove allergens', 'wp-dispensary' ),
		'choose_from_most_used'      => __( 'Choose from the most used allergens', 'wp-dispensary' ),
		'not_found'                  => __( 'No allergens found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Allergens', 'wp-dispensary' ),
	);

	register_taxonomy( 'allergens', 'products', array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => false,
		'show_in_nav_menus'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array(
			'slug' => 'allergen',
		),
	) );
}
add_action( 'init', 'wp_dispensary_allergens_taxonomy', 0 );
