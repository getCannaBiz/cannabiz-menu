<?php
/**
 * WP Dispensary - Deprecated Taxonomies
 *
 * This file is used to define the deprecated categories taxonomy of the plugin.
 *
 * @link       https://cannabizsoftware.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/deprecated
 */


/**
 * Product Categories Taxonomy
 *
 * Adds the default categories taxonomy to all custom post types
 *
 * @since 4.0
 */
function wp_dispensary_deprecated_categories() {

    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name', 'cannabiz-menu' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'cannabiz-menu' ),
        'search_items'      => esc_html__( 'Search Categories', 'cannabiz-menu' ),
        'all_items'         => esc_html__( 'All Categories', 'cannabiz-menu' ),
        'parent_item'       => esc_html__( 'Parent Category', 'cannabiz-menu' ),
        'parent_item_colon' => esc_html__( 'Parent Category:', 'cannabiz-menu' ),
        'edit_item'         => esc_html__( 'Edit Category', 'cannabiz-menu' ),
        'update_item'       => esc_html__( 'Update Category', 'cannabiz-menu' ),
        'add_new_item'      => esc_html__( 'Add New Category', 'cannabiz-menu' ),
        'new_item_name'     => esc_html__( 'New Category Name', 'cannabiz-menu' ),
        'not_found'         => esc_html__( 'No categories found', 'cannabiz-menu' ),
        'menu_name'         => esc_html__( 'Categories', 'cannabiz-menu' ),
    );

    register_taxonomy( 'flowers_category', 'products', array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => false,
        'show_in_rest'      => false,
        'show_admin_column' => false,
        'show_in_nav_menus' => false,
        'query_var'         => true,
        'rewrite'           => array(
            'slug'       => 'flowers-category',
            'with_front' => true,
        ),
    ) );

    register_taxonomy( 'concentrates_category', 'products', array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => false,
        'show_in_rest'      => false,
        'show_admin_column' => false,
        'show_in_nav_menus' => false,
        'query_var'         => true,
        'rewrite'           => array(
            'slug'       => 'concentrates-category',
            'with_front' => true,
        ),
    ) );

    register_taxonomy( 'edibles_category', 'products', array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => false,
        'show_in_rest'      => false,
        'show_admin_column' => false,
        'show_in_nav_menus' => false,
        'query_var'         => true,
        'rewrite'           => array(
            'slug'       => 'edibles-category',
            'with_front' => true,
        ),
    ) );

    register_taxonomy( 'topicals_category', 'products', array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => false,
        'show_in_rest'      => false,
        'show_admin_column' => false,
        'show_in_nav_menus' => false,
        'query_var'         => true,
        'rewrite'           => array(
            'slug'       => 'topicals-category',
            'with_front' => true,
        ),
    ) );

    register_taxonomy( 'growers_category', 'products', array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => false,
        'show_in_rest'      => false,
        'show_admin_column' => false,
        'show_in_nav_menus' => false,
        'query_var'         => true,
        'rewrite'           => array(
            'slug'       => 'growers-category',
            'with_front' => true,
        ),
    ) );

    register_taxonomy( 'wpd_gear_category', 'products', array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => false,
        'show_in_rest'      => false,
        'show_admin_column' => false,
        'show_in_nav_menus' => false,
        'query_var'         => true,
        'rewrite'           => array(
            'slug'       => 'gear-category',
            'with_front' => true,
        ),
    ) );

    register_taxonomy( 'wpd_tinctures_category', 'products', array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => false,
        'show_in_rest'      => false,
        'show_admin_column' => false,
        'show_in_nav_menus' => false,
        'query_var'         => true,
        'rewrite'           => array(
            'slug'       => 'tinctures-category',
            'with_front' => true,
        ),
    ) );

}
add_action( 'init', 'wp_dispensary_deprecated_categories', 0 );
