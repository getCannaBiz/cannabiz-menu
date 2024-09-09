<?php
/**
 * WP Dispensary Taxonomy - Shelf types
 *
 * This file is used to define the product shelf types taxonomy of the plugin.
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
 * Shelf Types
 *
 * Adds the Shelf Types taxonomy to specific custom post types
 *
 * @since  2.1.0
 * @return void
 */
function wp_dispensary_shelf_types_taxonomy() {

    $labels = array(
        'name'              => _x( 'Shelf Type', 'taxonomy general name', 'wp-dispensary' ),
        'singular_name'     => _x( 'Shelf Type', 'taxonomy singular name', 'wp-dispensary' ),
        'search_items'      => esc_html__( 'Search Shelf Types', 'wp-dispensary' ),
        'all_items'         => esc_html__( 'All Shelf Types', 'wp-dispensary' ),
        'parent_item'       => esc_html__( 'Parent Shelf Type', 'wp-dispensary' ),
        'parent_item_colon' => esc_html__( 'Parent Shelf Type:', 'wp-dispensary' ),
        'edit_item'         => esc_html__( 'Edit Shelf Type', 'wp-dispensary' ),
        'update_item'       => esc_html__( 'Update Shelf Type', 'wp-dispensary' ),
        'add_new_item'      => esc_html__( 'Add New Shelf Type', 'wp-dispensary' ),
        'new_item_name'     => esc_html__( 'New Shelf Type Name', 'wp-dispensary' ),
        'not_found'         => esc_html__( 'No shelf types found', 'wp-dispensary' ),
        'menu_name'         => esc_html__( 'Shelf Type', 'wp-dispensary' ),
    );

    register_taxonomy( 'shelf_types', 'products', array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'query_var'         => true,
        'rewrite'           => array(
            'slug'       => 'shelf-type',
            'with_front' => true,
        ),
    ) );

}
add_action( 'init', 'wp_dispensary_shelf_types_taxonomy', 0 );

