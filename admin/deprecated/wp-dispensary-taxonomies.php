<?php
/**
 * WP Dispensary Taxonomy - Deprecated Taxonomies
 *
 * This file is used to define the deprecated categories taxonomy of the plugin.
 *
 * @link       https://cannabizsoftware.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage CannaBiz_Menu/admin/deprecated
 */


/**
 * Product Taxonomies
 *
 * Adds the deprecated taxonomies to all custom post types
 *
 * @since    4.0
 */
function wp_dispensary_deprecated_taxonomies() {

    $labels = array(
        'name'              => _x( 'Taxonomies', 'taxonomy general name', 'cannabiz-menu' ),
        'singular_name'     => _x( 'Taxonomy', 'taxonomy singular name', 'cannabiz-menu' ),
        'search_items'      => esc_html__( 'Search Taxonomies', 'cannabiz-menu' ),
        'all_items'         => esc_html__( 'All Taxonomies', 'cannabiz-menu' ),
        'parent_item'       => esc_html__( 'Parent Taxonomy', 'cannabiz-menu' ),
        'parent_item_colon' => esc_html__( 'Parent Taxonomy:', 'cannabiz-menu' ),
        'edit_item'         => esc_html__( 'Edit Taxonomy', 'cannabiz-menu' ),
        'update_item'       => esc_html__( 'Update Taxonomy', 'cannabiz-menu' ),
        'add_new_item'      => esc_html__( 'Add New Taxonomy', 'cannabiz-menu' ),
        'new_item_name'     => esc_html__( 'New Taxonomy Name', 'cannabiz-menu' ),
        'not_found'         => esc_html__( 'No categories found', 'cannabiz-menu' ),
        'menu_name'         => esc_html__( 'Taxonomies', 'cannabiz-menu' ),
    );

    $taxonomies = array(
        'shelf_type',
        'strain_type',
        'vendor',
        'aroma',
        'flavor',
        'effect',
        'symptom',
        'condition'
    );

    foreach( $taxonomies as $tax ) {

        register_taxonomy( $tax, 'products', array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => false,
            'show_in_rest'      => false,
            'show_admin_column' => false,
            'show_in_nav_menus' => false,
            'query_var'         => true,
            'rewrite'           => array(
                'slug'       => $tax,
                'with_front' => true,
            ),
        ) );

    }

}
add_action( 'init', 'wp_dispensary_deprecated_taxonomies', 0 );
