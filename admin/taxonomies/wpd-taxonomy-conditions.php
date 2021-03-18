<?php
/**
 * WP Dispensary Taxonomy - Conditions
 *
 * This file is used to define the product conditions taxonomy of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/taxonomies
 */


/**
 * Conditions Taxonomy
 *
 * Adds the Conditions taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wp_dispensary_conditions_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Conditions', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Condition', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Conditions', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Conditions', 'wp-dispensary' ),
		'all_items'                  => __( 'All Conditions', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Condition', 'wp-dispensary' ),
		'update_item'                => __( 'Update Condition', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Condition', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Condition Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate conditions with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove conditions', 'wp-dispensary' ),
		'choose_from_most_used'      => __( 'Choose from the most used conditions', 'wp-dispensary' ),
		'not_found'                  => __( 'No conditions found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Conditions', 'wp-dispensary' ),
	);

	register_taxonomy( 'conditions', 'products', array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array(
			'slug' => 'condition',
		),
	) );
}
add_action( 'init', 'wp_dispensary_conditions_taxonomy', 0 );

