<?php
/**
 * WP Dispensary Taxonomy - Ingredients
 *
 * This file is used to define the product ingredients taxonomy of the plugin.
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
 * Ingredients Taxonomy
 *
 * Adds the Ingredient taxonomy to all custom post types
 *
 * @since  1.0.0
 * @return void
 */
function wp_dispensary_ingredients_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Ingredients', 'general name', 'cannabiz-menu' ),
        'singular_name'              => _x( 'Ingredient', 'singular name', 'cannabiz-menu' ),
        'search_items'               => esc_html__( 'Search Ingredients', 'cannabiz-menu' ),
        'popular_items'              => esc_html__( 'Popular Ingredients', 'cannabiz-menu' ),
        'all_items'                  => esc_html__( 'All Ingredients', 'cannabiz-menu' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => esc_html__( 'Edit Ingredient', 'cannabiz-menu' ),
        'update_item'                => esc_html__( 'Update Ingredient', 'cannabiz-menu' ),
        'add_new_item'               => esc_html__( 'Add New Ingredient', 'cannabiz-menu' ),
        'new_item_name'              => esc_html__( 'New Ingredient Name', 'cannabiz-menu' ),
        'separate_items_with_commas' => esc_html__( 'Separate ingredients with commas', 'cannabiz-menu' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove ingredients', 'cannabiz-menu' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used ingredients', 'cannabiz-menu' ),
        'not_found'                  => esc_html__( 'No ingredients found', 'cannabiz-menu' ),
        'menu_name'                  => esc_html__( 'Ingredients', 'cannabiz-menu' ),
    );

    register_taxonomy( 'ingredients', 'products', array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_rest'          => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => false,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array(
            'slug' => 'ingredient',
        ),
    ) );
}
add_action( 'init', 'wp_dispensary_ingredients_taxonomy', 0 );

