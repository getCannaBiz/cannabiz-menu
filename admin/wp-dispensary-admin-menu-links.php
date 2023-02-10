<?php
/**
 * This file contains all of the admin menu specific functions
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    wp_die();
}

/**
 * Admin menu - Products.
 * 
 * @since  4.0
 * @return void
 */
function wpd_admin_menu_products() {
    // Get permalink base for Products.
    $products_slug = get_option( 'wpd_products_slug' );

    // If custom base is empty, set default.
    if ( '' == $products_slug ) {
        $products_slug = 'products';
    }

    // Capitalize first letter of new slug.
    $products_slug_cap = ucfirst( $products_slug );

    // Products submenu link.
    add_submenu_page( 'wpd-settings', $products_slug_cap, $products_slug_cap, 'manage_options', 'edit.php?post_type=products', null );
}

/**
 * Admin menu - Categories.
 * 
 * @since  4.0
 * @return void
 */
function wpd_admin_menu_categories() {
    // Categories submenu link.
    add_submenu_page( 'wpd-settings', 'Categories', 'Categories', 'manage_options', 'edit-tags.php?taxonomy=wpd_categories', null );
}

/**
 * Admin menu - Vendors.
 * 
 * @since  4.0
 * @return void
 */
function wpd_admin_menu_vendors() {
    // Vendors submenu link.
    add_submenu_page( 'wpd-settings', 'Vendors', 'Vendors', 'manage_options', 'edit-tags.php?taxonomy=vendors', null );
}

/**
 * Admin menu - Strain types.
 * 
 * @since  4.4.0
 * @return void
 */
function wpd_admin_menu_strain_types() {
    // Strain types submenu link.
    add_submenu_page( 'wpd-settings', esc_html__( 'Strain types', 'wp-dispensary' ), esc_html__( 'Strain types', 'wp-dispensary' ), 'manage_options', 'edit-tags.php?taxonomy=strain_types', null );
}

/**
 * Admin menu - Shelf types.
 * 
 * @since  4.4.0
 * @return void
 */
function wpd_admin_menu_shelf_types() {
    // Shelf types submenu link.
    add_submenu_page( 'wpd-settings', esc_html__( 'Shelf types', 'wp-dispensary' ), esc_html__( 'Shelf types', 'wp-dispensary' ), 'manage_options', 'edit-tags.php?taxonomy=shelf_types', null );
}

/**
 * Admin submenu links.
 * 
 * @since  4.0
 * @return void
 */
function wp_dispensary_admin_submenu_links() {
    // Products submenu link.
    add_action( 'admin_menu', 'wpd_admin_menu_products', 1 );
    // Categories submenu link.
    add_action( 'admin_menu', 'wpd_admin_menu_categories', 2 );
    // Vendors submenu link.
    add_action( 'admin_menu', 'wpd_admin_menu_vendors', 6 );
    // Strain types submenu link.
    add_action( 'admin_menu', 'wpd_admin_menu_strain_types', 7 );
    // Shelf types submenu link.
    add_action( 'admin_menu', 'wpd_admin_menu_shelf_types', 8 );
}
add_action( 'init', 'wp_dispensary_admin_submenu_links' );

/**
 * Keep admin menu open when viewing taxonomies.
 * 
 * @param string $parent_file 
 * 
 * @since  4.0
 * @return string
 */
function wpd_keep_taxonomy_menu_open( $parent_file ) {
    global $current_screen;

    // Get current screen taxonomy.
    $taxonomy = $current_screen->taxonomy;

    // Check taxonomies.
    $tax_check = array(
        'vendors',
        'wpd_categories',
        'shelf_types',
        'strain_types'
    );

    // Filter the taxonomies.
    $tax_check = apply_filters( 'wpd_keep_taxonomy_menu_open', $tax_check );

    // Check taxonomies.
    if ( in_array( $taxonomy, $tax_check ) ) {
        $parent_file = 'wpd-settings';
    }

    return $parent_file;
}
add_action( 'parent_file', 'wpd_keep_taxonomy_menu_open' );
