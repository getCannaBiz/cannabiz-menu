<?php
/**
 * Growers post type
 *
 * This file is used to create the 'Growers' custom post type.
 *
 * @link       http://www.wpdispensary.com
 * @since      1.7.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types
 */

/**
 * Growers post type
 *
 * Add custom type for Growers
 *
 * @since    1.7.0
 */
function wpdispensary_growers() {

	$labels  = array(
		'name'               => _x( 'Growers', 'Post Type General Name', 'wp-dispensary' ),
		'singular_name'      => _x( 'Grower', 'Post Type Singular Name', 'wp-dispensary' ),
		'menu_name'          => __( 'Growers', 'wp-dispensary' ),
		'name_admin_bar'     => __( 'Growers', 'wp-dispensary' ),
		'parent_item_colon'  => __( 'Parent Grower:', 'wp-dispensary' ),
		'all_items'          => __( 'All Growers', 'wp-dispensary' ),
		'add_new_item'       => __( 'Add New Grower', 'wp-dispensary' ),
		'add_new'            => __( 'Add New', 'wp-dispensary' ),
		'new_item'           => __( 'New Grower', 'wp-dispensary' ),
		'edit_item'          => __( 'Edit Grower', 'wp-dispensary' ),
		'update_item'        => __( 'Update Grower', 'wp-dispensary' ),
		'view_item'          => __( 'View Grower', 'wp-dispensary' ),
		'search_items'       => __( 'Search Growers', 'wp-dispensary' ),
		'not_found'          => __( 'Not found', 'wp-dispensary' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'wp-dispensary' ),
	);
	$rewrite = array(
		'slug'       => 'growers',
		'with_front' => true,
		'pages'      => true,
		'feeds'      => true,
	);
	$args    = array(
		'label'               => __( 'Growers', 'wp-dispensary' ),
		'description'         => __( 'Seeds and Clones that our dispensary offers', 'wp-dispensary' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions' ),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => false,
		'show_in_rest'        => true,
		'menu_position'       => 10,
		'menu_icon'           => plugin_dir_url( __FILE__ ) . ( '../images/menu-icon.png' ),
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'growers', $args );

}
add_action( 'init', 'wpdispensary_growers', 0 );
