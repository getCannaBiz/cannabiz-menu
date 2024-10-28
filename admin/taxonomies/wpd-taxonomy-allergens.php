<?php
/**
 * WP Dispensary Taxonomy - Allergens
 *
 * This file is used to define the product allergens taxonomy of the plugin.
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
 * Allergens Taxonomy
 *
 * Adds the Allergens taxonomy to specific custom post types
 *
 * @since  2.3.0
 * @return void
 */
function wp_dispensary_allergens_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Allergens', 'general name', 'cannabiz-menu' ),
        'singular_name'              => _x( 'Allergen', 'singular name', 'cannabiz-menu' ),
        'search_items'               => esc_html__( 'Search Allergens', 'cannabiz-menu' ),
        'popular_items'              => esc_html__( 'Popular Allergens', 'cannabiz-menu' ),
        'all_items'                  => esc_html__( 'All Allergens', 'cannabiz-menu' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => esc_html__( 'Edit Allergen', 'cannabiz-menu' ),
        'update_item'                => esc_html__( 'Update Allergen', 'cannabiz-menu' ),
        'add_new_item'               => esc_html__( 'Add New Allergen', 'cannabiz-menu' ),
        'new_item_name'              => esc_html__( 'New Allergen Name', 'cannabiz-menu' ),
        'separate_items_with_commas' => esc_html__( 'Separate allergens with commas', 'cannabiz-menu' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove allergens', 'cannabiz-menu' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used allergens', 'cannabiz-menu' ),
        'not_found'                  => esc_html__( 'No allergens found', 'cannabiz-menu' ),
        'menu_name'                  => esc_html__( 'Allergens', 'cannabiz-menu' ),
    );

    register_taxonomy( 'allergens', 'products', array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_rest'          => true,
        'show_admin_column'     => false,
        'show_in_nav_menus'     => false,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array(
            'slug' => 'allergen',
        ),
    ) );
}
add_action( 'init', 'wp_dispensary_allergens_taxonomy', 0 );
