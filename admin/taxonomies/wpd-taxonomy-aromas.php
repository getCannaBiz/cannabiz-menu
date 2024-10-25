<?php
/**
 * WP Dispensary Taxonomy - Aromas
 *
 * This file is used to define the product aromas taxonomy of the plugin.
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
 * Aromas Taxonomy
 *
 * Adds the Aroma taxonomy to all custom post types
 *
 * @since  1.0.0
 * @return void
 */
function wp_dispensary_aromas_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Aromas', 'general name', 'cannabiz-menu' ),
        'singular_name'              => _x( 'Aroma', 'singular name', 'cannabiz-menu' ),
        'search_items'               => esc_html__( 'Search Aromas', 'cannabiz-menu' ),
        'popular_items'              => esc_html__( 'Popular Aromas', 'cannabiz-menu' ),
        'all_items'                  => esc_html__( 'All Aromas', 'cannabiz-menu' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => esc_html__( 'Edit Aroma', 'cannabiz-menu' ),
        'update_item'                => esc_html__( 'Update Aroma', 'cannabiz-menu' ),
        'add_new_item'               => esc_html__( 'Add New Aroma', 'cannabiz-menu' ),
        'new_item_name'              => esc_html__( 'New Aroma Name', 'cannabiz-menu' ),
        'separate_items_with_commas' => esc_html__( 'Separate aromas with commas', 'cannabiz-menu' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove aromas' , 'wp-dispensary'),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used aromas', 'cannabiz-menu' ),
        'not_found'                  => esc_html__( 'No aromas found', 'cannabiz-menu' ),
        'menu_name'                  => esc_html__( 'Aromas', 'cannabiz-menu' ),
    );

    register_taxonomy( 'aromas', 'products', array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_rest'          => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => false,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array(
            'slug' => 'aroma',
        ),
    ) );
}
add_action( 'init', 'wp_dispensary_aromas_taxonomy', 0 );
