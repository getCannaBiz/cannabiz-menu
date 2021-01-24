<?php
/**
 * WP Dispensary Taxonomy - Vendors
 *
 * This file is used to define the product vendors taxonomy of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types/taxonomies
 */


/**
 * Vendors Taxonomy
 *
 * Adds the Vendors taxonomy to all custom post types
 *
 * @since    1.9.11
 */
function wp_dispensary_vendors_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Vendors', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Vendor', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Vendors', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Vendors', 'wp-dispensary' ),
		'all_items'                  => __( 'All Vendors', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Vendor', 'wp-dispensary' ),
		'update_item'                => __( 'Update Vendor', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Vendor', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Vendor Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate vendors with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove vendors', 'wp-dispensary' ),
		'choose_from_most_used'      => __( 'Choose from the most used vendors', 'wp-dispensary' ),
		'not_found'                  => __( 'No vendors found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Vendors', 'wp-dispensary' ),
	);

	register_taxonomy( 'vendors', 'products', array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => true,
		'query_var'             => true,
		'update_count_callback' => '_update_post_term_count',
		'rewrite'               => array(
			'slug' => 'vendor',
		),
	) );

}
add_action( 'init', 'wp_dispensary_vendors_taxonomy', 0 );
