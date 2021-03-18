<?php
/**
 * WP Dispensary Taxonomy - Flavors
 *
 * This file is used to define the product flavors taxonomy of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/taxonomies
 */


/**
 * Flavors Taxonomy
 *
 * Adds the Flavors taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wp_dispensary_flavors_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Flavors', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Flavor', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Flavors', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Flavors', 'wp-dispensary' ),
		'all_items'                  => __( 'All Flavors', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Flavor', 'wp-dispensary' ),
		'update_item'                => __( 'Update Flavor', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Flavor', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Flavor Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate flavors with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove flavors', 'wp-dispensary' ),
		'choose_from_most_used'      => __( 'Choose from the most used flavors', 'wp-dispensary' ),
		'not_found'                  => __( 'No flavors found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Flavors', 'wp-dispensary' ),
	);

	register_taxonomy( 'flavors', 'products', array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array(
			'slug' => 'flavor',
		),
	) );
}
add_action( 'init', 'wp_dispensary_flavors_taxonomy', 0 );
