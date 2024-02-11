<?php
/**
 * WP Dispensary Taxonomy - Vendors
 *
 * This file is used to define the product vendors taxonomy of the plugin.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/taxonomies
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    wp_die();
}

/**
 * Vendors Taxonomy
 *
 * Adds the Vendors taxonomy to all custom post types
 *
 * @since  1.9.11
 * @return void
 */
function wp_dispensary_vendors_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Vendors', 'general name', 'wp-dispensary' ),
        'singular_name'              => _x( 'Vendor', 'singular name', 'wp-dispensary' ),
        'search_items'               => esc_html__( 'Search Vendors', 'wp-dispensary' ),
        'popular_items'              => esc_html__( 'Popular Vendors', 'wp-dispensary' ),
        'all_items'                  => esc_html__( 'All Vendors', 'wp-dispensary' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => esc_html__( 'Edit Vendor', 'wp-dispensary' ),
        'update_item'                => esc_html__( 'Update Vendor', 'wp-dispensary' ),
        'add_new_item'               => esc_html__( 'Add New Vendor', 'wp-dispensary' ),
        'new_item_name'              => esc_html__( 'New Vendor Name', 'wp-dispensary' ),
        'separate_items_with_commas' => esc_html__( 'Separate vendors with commas', 'wp-dispensary' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove vendors', 'wp-dispensary' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used vendors', 'wp-dispensary' ),
        'not_found'                  => esc_html__( 'No vendors found', 'wp-dispensary' ),
        'menu_name'                  => esc_html__( 'Vendors', 'wp-dispensary' ),
    );

    register_taxonomy( 'vendors', 'products', array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_rest'          => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        'query_var'             => true,
        'update_count_callback' => '_update_post_term_count',
        'rewrite'               => array(
            'slug' => 'vendor',
        ),
    ) );

}
add_action( 'init', 'wp_dispensary_vendors_taxonomy', 0 );
