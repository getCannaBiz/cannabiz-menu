<?php
/**
 * WP Dispensary Taxonomy - Flavors
 *
 * This file is used to define the product flavors taxonomy of the plugin.
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
 * Flavors Taxonomy
 *
 * Adds the Flavors taxonomy to all custom post types
 *
 * @since  1.0.0
 * @return void
 */
function wp_dispensary_flavors_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Flavors', 'general name', 'cannabiz-menu' ),
        'singular_name'              => _x( 'Flavor', 'singular name', 'cannabiz-menu' ),
        'search_items'               => esc_html__( 'Search Flavors', 'cannabiz-menu' ),
        'popular_items'              => esc_html__( 'Popular Flavors', 'cannabiz-menu' ),
        'all_items'                  => esc_html__( 'All Flavors', 'cannabiz-menu' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => esc_html__( 'Edit Flavor', 'cannabiz-menu' ),
        'update_item'                => esc_html__( 'Update Flavor', 'cannabiz-menu' ),
        'add_new_item'               => esc_html__( 'Add New Flavor', 'cannabiz-menu' ),
        'new_item_name'              => esc_html__( 'New Flavor Name', 'cannabiz-menu' ),
        'separate_items_with_commas' => esc_html__( 'Separate flavors with commas', 'cannabiz-menu' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove flavors', 'cannabiz-menu' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used flavors', 'cannabiz-menu' ),
        'not_found'                  => esc_html__( 'No flavors found', 'cannabiz-menu' ),
        'menu_name'                  => esc_html__( 'Flavors', 'cannabiz-menu' ),
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
