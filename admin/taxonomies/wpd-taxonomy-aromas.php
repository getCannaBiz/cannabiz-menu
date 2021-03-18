<?php
/**
 * WP Dispensary Taxonomy - Aromas
 *
 * This file is used to define the product aromas taxonomy of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/taxonomies
 */


/**
 * Aromas Taxonomy
 *
 * Adds the Aroma taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wp_dispensary_aromas_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Aromas', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Aroma', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Aromas', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Aromas', 'wp-dispensary' ),
		'all_items'                  => __( 'All Aromas', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Aroma', 'wp-dispensary' ),
		'update_item'                => __( 'Update Aroma', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Aroma', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Aroma Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate aromas with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove aromas' , 'wp-dispensary'),
		'choose_from_most_used'      => __( 'Choose from the most used aromas', 'wp-dispensary' ),
		'not_found'                  => __( 'No aromas found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Aromas', 'wp-dispensary' ),
	);

	register_taxonomy( 'aromas', 'products', array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array(
			'slug' => 'aroma',
		),
	) );
}
add_action( 'init', 'wp_dispensary_aromas_taxonomy', 0 );
