<?php
/**
 * WP Dispensary Taxonomy - Strain types
 *
 * This file is used to define the product strain types taxonomy of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types/taxonomies
 */


/**
 * Strain Types
 *
 * Adds the Strain Types taxonomy to specific custom post types
 *
 * @since    2.3.0
 */
function wp_dispensary_strain_types_taxonomy() {

	$labels = array(
		'name'              => _x( 'Strain Type', 'taxonomy general name', 'wp-dispensary' ),
		'singular_name'     => _x( 'Strain Type', 'taxonomy singular name', 'wp-dispensary' ),
		'search_items'      => __( 'Search Strain Types', 'wp-dispensary' ),
		'all_items'         => __( 'All Strain Types', 'wp-dispensary' ),
		'parent_item'       => __( 'Parent Strain Type', 'wp-dispensary' ),
		'parent_item_colon' => __( 'Parent Strain Type:', 'wp-dispensary' ),
		'edit_item'         => __( 'Edit Strain Type', 'wp-dispensary' ),
		'update_item'       => __( 'Update Strain Type', 'wp-dispensary' ),
		'add_new_item'      => __( 'Add New Strain Type', 'wp-dispensary' ),
		'new_item_name'     => __( 'New Strain Type Name', 'wp-dispensary' ),
		'not_found'         => __( 'No strain types found', 'wp-dispensary' ),
		'menu_name'         => __( 'Strain Type', 'wp-dispensary' ),
	);

	register_taxonomy( 'strain_types', 'products', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'strain-type',
			'with_front' => false,
		),
	) );
}
add_action( 'init', 'wp_dispensary_strain_types_taxonomy', 0 );
