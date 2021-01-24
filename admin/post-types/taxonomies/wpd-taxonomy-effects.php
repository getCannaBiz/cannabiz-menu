<?php
/**
 * WP Dispensary Taxonomy - Effects
 *
 * This file is used to define the product effects taxonomy of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types/taxonomies
 */


/**
 * Effect Taxonomy
 *
 * Adds the Effect taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wp_dispensary_effect_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Effects', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Effect', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Effects', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Effects', 'wp-dispensary' ),
		'all_items'                  => __( 'All Effects', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Effect', 'wp-dispensary' ),
		'update_item'                => __( 'Update Effect', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Effect', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Effect Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate effects with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove effects', 'wp-dispensary' ),
		'choose_from_most_used'      => __( 'Choose from the most used effects', 'wp-dispensary' ),
		'not_found'                  => __( 'No effects found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Effects', 'wp-dispensary' ),
	);

	register_taxonomy( 'effects', 'products', array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array(
			'slug' => 'effect',
		),
	) );
}
add_action( 'init', 'wp_dispensary_effect_taxonomy', 0 );
