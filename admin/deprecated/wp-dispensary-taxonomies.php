<?php
/**
 * WP Dispensary Taxonomy - Deprecated Taxonomies
 *
 * This file is used to define the deprecated categories taxonomy of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/deprecated
 */


/**
 * Product Taxonomies
 *
 * Adds the deprecated taxonomies to all custom post types
 *
 * @since    4.0
 */
function wp_dispensary_deprecated_taxonomies() {

	$labels = array(
		'name'              => _x( 'Taxonomies', 'taxonomy general name', 'wp-dispensary' ),
		'singular_name'     => _x( 'Taxonomy', 'taxonomy singular name', 'wp-dispensary' ),
		'search_items'      => esc_html__( 'Search Taxonomies', 'wp-dispensary' ),
		'all_items'         => esc_html__( 'All Taxonomies', 'wp-dispensary' ),
		'parent_item'       => esc_html__( 'Parent Taxonomy', 'wp-dispensary' ),
		'parent_item_colon' => esc_html__( 'Parent Taxonomy:', 'wp-dispensary' ),
		'edit_item'         => esc_html__( 'Edit Taxonomy', 'wp-dispensary' ),
		'update_item'       => esc_html__( 'Update Taxonomy', 'wp-dispensary' ),
		'add_new_item'      => esc_html__( 'Add New Taxonomy', 'wp-dispensary' ),
		'new_item_name'     => esc_html__( 'New Taxonomy Name', 'wp-dispensary' ),
		'not_found'         => esc_html__( 'No categories found', 'wp-dispensary' ),
		'menu_name'         => esc_html__( 'Taxonomies', 'wp-dispensary' ),
	);

	register_taxonomy( 'shelf_type', 'products', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => false,
		'show_in_rest'      => false,
		'show_admin_column' => false,
		'show_in_nav_menus' => false,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'shelf_type',
			'with_front' => true,
		),
	) );

	register_taxonomy( 'strain_type', 'products', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => false,
		'show_in_rest'      => false,
		'show_admin_column' => false,
		'show_in_nav_menus' => false,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'strain_type',
			'with_front' => true,
		),
	) );

	register_taxonomy( 'vendor', 'products', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => false,
		'show_in_rest'      => false,
		'show_admin_column' => false,
		'show_in_nav_menus' => false,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'vendor',
			'with_front' => true,
		),
	) );

	register_taxonomy( 'aroma', 'products', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => false,
		'show_in_rest'      => false,
		'show_admin_column' => false,
		'show_in_nav_menus' => false,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'aroma',
			'with_front' => true,
		),
	) );

	register_taxonomy( 'flavor', 'products', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => false,
		'show_in_rest'      => false,
		'show_admin_column' => false,
		'show_in_nav_menus' => false,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'flavor',
			'with_front' => true,
		),
	) );

	register_taxonomy( 'effect', 'products', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => false,
		'show_in_rest'      => false,
		'show_admin_column' => false,
		'show_in_nav_menus' => false,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'effect',
			'with_front' => true,
		),
	) );

	register_taxonomy( 'symptom', 'products', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => false,
		'show_in_rest'      => false,
		'show_admin_column' => false,
		'show_in_nav_menus' => false,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'symptom',
			'with_front' => true,
		),
	) );

	register_taxonomy( 'condition', 'products', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => false,
		'show_in_rest'      => false,
		'show_admin_column' => false,
		'show_in_nav_menus' => false,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'condition',
			'with_front' => true,
		),
	) );

}
add_action( 'init', 'wp_dispensary_deprecated_taxonomies', 0 );
