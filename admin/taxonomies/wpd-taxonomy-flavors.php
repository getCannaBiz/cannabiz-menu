<?php
/**
 * WP Dispensary Taxonomy - Flavors
 *
 * This file is used to define the product flavors taxonomy of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/taxonomies
 */


/**
 * Flavors Taxonomy
 *
 * Adds the Flavors taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wp_dispensary_flavors_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Flavors', 'general name', 'wp-dispensary' ),
        'singular_name'              => _x( 'Flavor', 'singular name', 'wp-dispensary' ),
        'search_items'               => esc_html__( 'Search Flavors', 'wp-dispensary' ),
        'popular_items'              => esc_html__( 'Popular Flavors', 'wp-dispensary' ),
        'all_items'                  => esc_html__( 'All Flavors', 'wp-dispensary' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => esc_html__( 'Edit Flavor', 'wp-dispensary' ),
        'update_item'                => esc_html__( 'Update Flavor', 'wp-dispensary' ),
        'add_new_item'               => esc_html__( 'Add New Flavor', 'wp-dispensary' ),
        'new_item_name'              => esc_html__( 'New Flavor Name', 'wp-dispensary' ),
        'separate_items_with_commas' => esc_html__( 'Separate flavors with commas', 'wp-dispensary' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove flavors', 'wp-dispensary' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used flavors', 'wp-dispensary' ),
        'not_found'                  => esc_html__( 'No flavors found', 'wp-dispensary' ),
        'menu_name'                  => esc_html__( 'Flavors', 'wp-dispensary' ),
    );

    register_taxonomy( 'flavors', 'products', array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_rest'          => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => false,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array(
            'slug' => 'flavor',
        ),
    ) );
}
add_action( 'init', 'wp_dispensary_flavors_taxonomy', 0 );
