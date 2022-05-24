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
        'search_items'               => esc_html__( 'Search Conditions', 'wp-dispensary' ),
        'popular_items'              => esc_html__( 'Popular Conditions', 'wp-dispensary' ),
        'all_items'                  => esc_html__( 'All Conditions', 'wp-dispensary' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => esc_html__( 'Edit Condition', 'wp-dispensary' ),
        'update_item'                => esc_html__( 'Update Condition', 'wp-dispensary' ),
        'add_new_item'               => esc_html__( 'Add New Condition', 'wp-dispensary' ),
        'new_item_name'              => esc_html__( 'New Condition Name', 'wp-dispensary' ),
        'separate_items_with_commas' => esc_html__( 'Separate conditions with commas', 'wp-dispensary' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove conditions', 'wp-dispensary' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used conditions', 'wp-dispensary' ),
        'not_found'                  => esc_html__( 'No conditions found', 'wp-dispensary' ),
        'menu_name'                  => esc_html__( 'Conditions', 'wp-dispensary' ),
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

