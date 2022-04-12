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
		'search_items'               => esc_html__( 'Search Aromas', 'wp-dispensary' ),
		'popular_items'              => esc_html__( 'Popular Aromas', 'wp-dispensary' ),
		'all_items'                  => esc_html__( 'All Aromas', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => esc_html__( 'Edit Aroma', 'wp-dispensary' ),
		'update_item'                => esc_html__( 'Update Aroma', 'wp-dispensary' ),
		'add_new_item'               => esc_html__( 'Add New Aroma', 'wp-dispensary' ),
		'new_item_name'              => esc_html__( 'New Aroma Name', 'wp-dispensary' ),
		'separate_items_with_commas' => esc_html__( 'Separate aromas with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove aromas' , 'wp-dispensary'),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used aromas', 'wp-dispensary' ),
		'not_found'                  => esc_html__( 'No aromas found', 'wp-dispensary' ),
		'menu_name'                  => esc_html__( 'Aromas', 'wp-dispensary' ),
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
