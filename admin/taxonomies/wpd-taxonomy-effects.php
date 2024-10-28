<?php
/**
 * WP Dispensary Taxonomy - Effects
 *
 * This file is used to define the product effects taxonomy of the plugin.
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
 * Effect Taxonomy
 *
 * Adds the Effect taxonomy to all custom post types
 *
 * @since  1.0.0
 * @return void
 */
function wp_dispensary_effects_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Effects', 'general name', 'cannabiz-menu' ),
        'singular_name'              => _x( 'Effect', 'singular name', 'cannabiz-menu' ),
        'search_items'               => esc_html__( 'Search Effects', 'cannabiz-menu' ),
        'popular_items'              => esc_html__( 'Popular Effects', 'cannabiz-menu' ),
        'all_items'                  => esc_html__( 'All Effects', 'cannabiz-menu' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => esc_html__( 'Edit Effect', 'cannabiz-menu' ),
        'update_item'                => esc_html__( 'Update Effect', 'cannabiz-menu' ),
        'add_new_item'               => esc_html__( 'Add New Effect', 'cannabiz-menu' ),
        'new_item_name'              => esc_html__( 'New Effect Name', 'cannabiz-menu' ),
        'separate_items_with_commas' => esc_html__( 'Separate effects with commas', 'cannabiz-menu' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove effects', 'cannabiz-menu' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used effects', 'cannabiz-menu' ),
        'not_found'                  => esc_html__( 'No effects found', 'cannabiz-menu' ),
        'menu_name'                  => esc_html__( 'Effects', 'cannabiz-menu' ),
    );

    register_taxonomy( 'effects', 'products', array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_rest'          => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => false,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array(
            'slug' => 'effect',
        ),
    ) );
}
add_action( 'init', 'wp_dispensary_effects_taxonomy', 0 );
