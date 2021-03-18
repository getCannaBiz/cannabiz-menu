<?php
/**
 * WP Dispensary Taxonomy - Shelf types
 *
 * This file is used to define the product shelf types taxonomy of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/taxonomies
 */


/**
 * Shelf Types
 *
 * Adds the Shelf Types taxonomy to specific custom post types
 *
 * @since    2.1.0
 */
function wp_dispensary_shelf_types_taxonomy() {

	$labels = array(
		'name'              => _x( 'Shelf Type', 'taxonomy general name', 'wp-dispensary' ),
		'singular_name'     => _x( 'Shelf Type', 'taxonomy singular name', 'wp-dispensary' ),
		'search_items'      => __( 'Search Shelf Types', 'wp-dispensary' ),
		'all_items'         => __( 'All Shelf Types', 'wp-dispensary' ),
		'parent_item'       => __( 'Parent Shelf Type', 'wp-dispensary' ),
		'parent_item_colon' => __( 'Parent Shelf Type:', 'wp-dispensary' ),
		'edit_item'         => __( 'Edit Shelf Type', 'wp-dispensary' ),
		'update_item'       => __( 'Update Shelf Type', 'wp-dispensary' ),
		'add_new_item'      => __( 'Add New Shelf Type', 'wp-dispensary' ),
		'new_item_name'     => __( 'New Shelf Type Name', 'wp-dispensary' ),
		'not_found'         => __( 'No shelf types found', 'wp-dispensary' ),
		'menu_name'         => __( 'Shelf Type', 'wp-dispensary' ),
	);

	register_taxonomy( 'shelf_types', 'products', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'shelf-type',
			'with_front' => false,
		),
	) );

}
add_action( 'init', 'wp_dispensary_shelf_types_taxonomy', 0 );

