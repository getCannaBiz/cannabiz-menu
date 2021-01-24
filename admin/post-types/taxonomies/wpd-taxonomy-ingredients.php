<?php
/**
 * WP Dispensary Taxonomy - Ingredients
 *
 * This file is used to define the product ingredients taxonomy of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types/taxonomies
 */


/**
 * Ingredients Taxonomy
 *
 * Adds the Ingredient taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wp_dispensary_ingredients_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Ingredients', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Ingredient', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Ingredients', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Ingredients', 'wp-dispensary' ),
		'all_items'                  => __( 'All Ingredients', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Ingredient', 'wp-dispensary' ),
		'update_item'                => __( 'Update Ingredient', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Ingredient', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Ingredient Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate ingredients with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove ingredients', 'wp-dispensary' ),
		'choose_from_most_used'      => __( 'Choose from the most used ingredients', 'wp-dispensary' ),
		'not_found'                  => __( 'No ingredients found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Ingredients', 'wp-dispensary' ),
	);

	register_taxonomy( 'ingredients', 'products', array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array(
			'slug' => 'ingredient',
		),
	) );
}
add_action( 'init', 'wp_dispensary_ingredients_taxonomy', 0 );

