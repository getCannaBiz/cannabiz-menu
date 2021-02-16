<?php
/**
 * This file contains all of the admin menu specific functions
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Admin menu - Products.
 * 
 * @since  4.0
 * @return void
 */
function wpd_admin_menu_products() {
	// Get permalink base for Products.
	$wpd_products_slug = get_option( 'wpd_products_slug' );

	// If custom base is empty, set default.
	if ( '' == $wpd_products_slug ) {
		$wpd_products_slug = 'products';
	}

	// Capitalize first letter of new slug.
	$wpd_products_slug_cap = ucfirst( $wpd_products_slug );

	// Products submenu link.
	add_submenu_page( 'wpd-settings', $wpd_products_slug_cap, $wpd_products_slug_cap, 'manage_options', 'edit.php?post_type=products', null );
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
}
add_action( 'init', 'wp_dispensary_admin_submenu_links' );

/**
 * Keep admin menu open when viewing taxonomies.
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
		'vendor',
		'wpd_categories',
		'shelf_types',
		'strain_types'
	);

	// Check taxonomies.
	if ( in_array( $taxonomy, $tax_check ) ) {
		$parent_file = 'wpd-settings';
	}

	return $parent_file;
}
add_action( 'parent_file', 'wpd_keep_taxonomy_menu_open' );
