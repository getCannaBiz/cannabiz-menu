<?php
/**
 * Flowers post type
 *
 * This file is used to create the 'Flowers' custom post type.
 *
 * @link       http://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types
 */

/**
 * Flower post type
 *
 * Add custom type for Flowers
 *
 * @since    1.0.0
 */
function wpdispensary_flowers() {

	$labels = array(
		'name'                => _x( 'Flowers', 'Post Type General Name', 'wp-dispensary' ),
		'singular_name'       => _x( 'Flower', 'Post Type Singular Name', 'wp-dispensary' ),
		'menu_name'           => __( 'Flowers', 'wp-dispensary' ),
		'name_admin_bar'      => __( 'Flowers', 'wp-dispensary' ),
		'parent_item_colon'   => __( 'Parent Flower:', 'wp-dispensary' ),
		'all_items'           => __( 'All Flowers', 'wp-dispensary' ),
		'add_new_item'        => __( 'Add New Flower', 'wp-dispensary' ),
		'add_new'             => __( 'Add New', 'wp-dispensary' ),
		'new_item'            => __( 'New Flower', 'wp-dispensary' ),
		'edit_item'           => __( 'Edit Flower', 'wp-dispensary' ),
		'update_item'         => __( 'Update Flower', 'wp-dispensary' ),
		'view_item'           => __( 'View Flower', 'wp-dispensary' ),
		'search_items'        => __( 'Search Flower', 'wp-dispensary' ),
		'not_found'           => __( 'Not found', 'wp-dispensary' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'wp-dispensary' ),
	);
	$rewrite = array(
		'slug'                => 'flowers',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'Flowers', 'wp-dispensary' ),
		'description'         => __( 'Flower products that our dispensary offers', 'wp-dispensary' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions' ),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => false,
		'show_in_rest'		  => true,
		'menu_position'       => 10,
		'menu_icon'           => plugin_dir_url( __FILE__ ) . ( '../images/menu-icon.png' ),
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'			  => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'flowers', $args );

}
add_action( 'init', 'wpdispensary_flowers', 0 );
