<?php
/**
 * Topicals post type
 *
 * This file is used to create the 'Topicals' custom post type.
 *
 * @link       http://www.wpdispensary.com
 * @since      1.4.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types
 */

/**
 * Topical post type
 *
 * Add custom type for Topicals
 *
 * @since    1.4.0
 */
function wpdispensary_topicals() {

	$labels  = array(
		'name'               => _x( 'Topicals', 'Post Type General Name', 'wp-dispensary' ),
		'singular_name'      => _x( 'Topical', 'Post Type Singular Name', 'wp-dispensary' ),
		'menu_name'          => __( 'Topicals', 'wp-dispensary' ),
		'name_admin_bar'     => __( 'Topicals', 'wp-dispensary' ),
		'parent_item_colon'  => __( 'Parent Topical:', 'wp-dispensary' ),
		'all_items'          => __( 'All Topicals', 'wp-dispensary' ),
		'add_new_item'       => __( 'Add New Topical', 'wp-dispensary' ),
		'add_new'            => __( 'Add New', 'wp-dispensary' ),
		'new_item'           => __( 'New Topical', 'wp-dispensary' ),
		'edit_item'          => __( 'Edit Topical', 'wp-dispensary' ),
		'update_item'        => __( 'Update Topical', 'wp-dispensary' ),
		'view_item'          => __( 'View Topical', 'wp-dispensary' ),
		'search_items'       => __( 'Search Topical', 'wp-dispensary' ),
		'not_found'          => __( 'Not found', 'wp-dispensary' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'wp-dispensary' ),
	);
	$rewrite = array(
		'slug'       => 'topicals',
		'with_front' => true,
		'pages'      => true,
		'feeds'      => true,
	);
	$args    = array(
		'label'               => __( 'Topicals', 'wp-dispensary' ),
		'description'         => __( 'Topical products that our dispensary offers', 'wp-dispensary' ),
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
	register_post_type( 'topicals', $args );

}
add_action( 'init', 'wpdispensary_topicals', 0 );
