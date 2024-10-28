<?php
/**
 * WP Dispensary Taxonomy - Categories
 *
 * This file is used to define the product categories taxonomy of the plugin.
 *
 * @package    WP_Dispensary
 * @subpackage CannaBiz_Menu/admin/taxonomies
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      4.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    wp_die();
}


/**
 * Product Categories Taxonomy
 *
 * Adds the default categories taxonomy to all custom post types
 *
 * @since  4.0
 * @return void
 */
function wp_dispensary_products_categories_taxonomy() {

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
