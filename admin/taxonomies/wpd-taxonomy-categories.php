<?php
/**
 * WP Dispensary Taxonomy - Categories
 *
 * This file is used to define the product categories taxonomy of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/taxonomies
 */


/**
 * Product Categories Taxonomy
 *
 * Adds the default categories taxonomy to all custom post types
 *
 * @since    4.0
 */
function wp_dispensary_products_categories_taxonomy() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'wp-dispensary' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'wp-dispensary' ),
		'search_items'      => __( 'Search Categories', 'wp-dispensary' ),
		'all_items'         => __( 'All Categories', 'wp-dispensary' ),
		'parent_item'       => __( 'Parent Category', 'wp-dispensary' ),
		'parent_item_colon' => __( 'Parent Category:', 'wp-dispensary' ),
		'edit_item'         => __( 'Edit Category', 'wp-dispensary' ),
		'update_item'       => __( 'Update Category', 'wp-dispensary' ),
		'add_new_item'      => __( 'Add New Category', 'wp-dispensary' ),
		'new_item_name'     => __( 'New Category Name', 'wp-dispensary' ),
		'not_found'         => __( 'No categories found', 'wp-dispensary' ),
		'menu_name'         => __( 'Categories', 'wp-dispensary' ),
	);

	register_taxonomy( 'wpd_categories', 'products', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'product-category',
			'with_front' => true,
		),
	) );

}
add_action( 'init', 'wp_dispensary_products_categories_taxonomy', 0 );
