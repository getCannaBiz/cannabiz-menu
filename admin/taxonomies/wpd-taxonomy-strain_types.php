<?php
/**
 * WP Dispensary Taxonomy - Strain types
 *
 * This file is used to define the product strain types taxonomy of the plugin.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/taxonomies
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @license    GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 */

/**
 * Strain Types
 *
 * Adds the Strain Types taxonomy to specific custom post types
 *
 * @since  2.3.0
 * @return void
 */
function wp_dispensary_strain_types_taxonomy() {

    $labels = array(
        'name'              => _x( 'Strain Type', 'taxonomy general name', 'wp-dispensary' ),
        'singular_name'     => _x( 'Strain Type', 'taxonomy singular name', 'wp-dispensary' ),
        'search_items'      => esc_html__( 'Search Strain Types', 'wp-dispensary' ),
        'all_items'         => esc_html__( 'All Strain Types', 'wp-dispensary' ),
        'parent_item'       => esc_html__( 'Parent Strain Type', 'wp-dispensary' ),
        'parent_item_colon' => esc_html__( 'Parent Strain Type:', 'wp-dispensary' ),
        'edit_item'         => esc_html__( 'Edit Strain Type', 'wp-dispensary' ),
        'update_item'       => esc_html__( 'Update Strain Type', 'wp-dispensary' ),
        'add_new_item'      => esc_html__( 'Add New Strain Type', 'wp-dispensary' ),
        'new_item_name'     => esc_html__( 'New Strain Type Name', 'wp-dispensary' ),
        'not_found'         => esc_html__( 'No strain types found', 'wp-dispensary' ),
        'menu_name'         => esc_html__( 'Strain Type', 'wp-dispensary' ),
    );

    register_taxonomy( 'strain_types', 'products', array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'query_var'         => true,
        'rewrite'           => array(
            'slug'       => 'strain-type',
            'with_front' => true,
        ),
    ) );
}
add_action( 'init', 'wp_dispensary_strain_types_taxonomy', 0 );
