<?php
/**
 * WP Dispensary Taxonomy - Conditions
 *
 * This file is used to define the product conditions taxonomy of the plugin.
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
 * Conditions Taxonomy
 *
 * Adds the Conditions taxonomy to all custom post types
 *
 * @since  1.0.0
 * @return void
 */
function wp_dispensary_conditions_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Conditions', 'general name', 'cannabiz-menu' ),
        'singular_name'              => _x( 'Condition', 'singular name', 'cannabiz-menu' ),
        'search_items'               => esc_html__( 'Search Conditions', 'cannabiz-menu' ),
        'popular_items'              => esc_html__( 'Popular Conditions', 'cannabiz-menu' ),
        'all_items'                  => esc_html__( 'All Conditions', 'cannabiz-menu' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => esc_html__( 'Edit Condition', 'cannabiz-menu' ),
        'update_item'                => esc_html__( 'Update Condition', 'cannabiz-menu' ),
        'add_new_item'               => esc_html__( 'Add New Condition', 'cannabiz-menu' ),
        'new_item_name'              => esc_html__( 'New Condition Name', 'cannabiz-menu' ),
        'separate_items_with_commas' => esc_html__( 'Separate conditions with commas', 'cannabiz-menu' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove conditions', 'cannabiz-menu' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used conditions', 'cannabiz-menu' ),
        'not_found'                  => esc_html__( 'No conditions found', 'cannabiz-menu' ),
        'menu_name'                  => esc_html__( 'Conditions', 'cannabiz-menu' ),
    );

    register_taxonomy( 'conditions', 'products', array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_rest'          => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => false,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array(
            'slug' => 'condition',
        ),
    ) );
}
add_action( 'init', 'wp_dispensary_conditions_taxonomy', 0 );

