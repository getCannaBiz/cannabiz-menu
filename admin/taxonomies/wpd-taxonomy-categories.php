<?php
/**
 * WP Dispensary Taxonomy - Categories
 *
 * This file is used to define the product categories taxonomy of the plugin.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/taxonomies
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
        'name'              => _x( 'Categories', 'taxonomy general name', 'wp-dispensary' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'wp-dispensary' ),
        'search_items'      => esc_html__( 'Search Categories', 'wp-dispensary' ),
        'all_items'         => esc_html__( 'All Categories', 'wp-dispensary' ),
        'parent_item'       => esc_html__( 'Parent Category', 'wp-dispensary' ),
        'parent_item_colon' => esc_html__( 'Parent Category:', 'wp-dispensary' ),
        'edit_item'         => esc_html__( 'Edit Category', 'wp-dispensary' ),
        'update_item'       => esc_html__( 'Update Category', 'wp-dispensary' ),
        'add_new_item'      => esc_html__( 'Add New Category', 'wp-dispensary' ),
        'new_item_name'     => esc_html__( 'New Category Name', 'wp-dispensary' ),
        'not_found'         => esc_html__( 'No categories found', 'wp-dispensary' ),
        'menu_name'         => esc_html__( 'Categories', 'wp-dispensary' ),
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
