<?php
/**
 * WP Dispensary Taxonomy - Strain types
 *
 * This file is used to define the product strain types taxonomy of the plugin.
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
 * Strain Types
 *
 * Adds the Strain Types taxonomy to specific custom post types
 *
 * @since  2.3.0
 * @return void
 */
function wp_dispensary_strain_types_taxonomy() {

    $labels = array(
        'name'              => _x( 'Strain Type', 'taxonomy general name', 'cannabiz-menu' ),
        'singular_name'     => _x( 'Strain Type', 'taxonomy singular name', 'cannabiz-menu' ),
        'search_items'      => esc_html__( 'Search Strain Types', 'cannabiz-menu' ),
        'all_items'         => esc_html__( 'All Strain Types', 'cannabiz-menu' ),
        'parent_item'       => esc_html__( 'Parent Strain Type', 'cannabiz-menu' ),
        'parent_item_colon' => esc_html__( 'Parent Strain Type:', 'cannabiz-menu' ),
        'edit_item'         => esc_html__( 'Edit Strain Type', 'cannabiz-menu' ),
        'update_item'       => esc_html__( 'Update Strain Type', 'cannabiz-menu' ),
        'add_new_item'      => esc_html__( 'Add New Strain Type', 'cannabiz-menu' ),
        'new_item_name'     => esc_html__( 'New Strain Type Name', 'cannabiz-menu' ),
        'not_found'         => esc_html__( 'No strain types found', 'cannabiz-menu' ),
        'menu_name'         => esc_html__( 'Strain Type', 'cannabiz-menu' ),
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
