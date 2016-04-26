<?php
/**
 * Edibles post type
 *
 * This file is used to create the 'Edibles' custom post type.
 *
 * @link       http://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types
 */

/**
 * Edible post type
 *
 * Add custom type for Edibles
 *
 * @since    1.0.0
 */
function wpdispensary_edibles() {

	$labels = array(
		'name'                => _x( 'Edibles', 'Post Type General Name', 'wp-dispensary' ),
		'singular_name'       => _x( 'Edible', 'Post Type Singular Name', 'wp-dispensary' ),
		'menu_name'           => __( 'Edibles', 'wp-dispensary' ),
		'name_admin_bar'      => __( 'Edibles', 'wp-dispensary' ),
		'parent_item_colon'   => __( 'Parent Edible:', 'wp-dispensary' ),
		'all_items'           => __( 'All Edibles', 'wp-dispensary' ),
		'add_new_item'        => __( 'Add New Edible', 'wp-dispensary' ),
		'add_new'             => __( 'Add New', 'wp-dispensary' ),
		'new_item'            => __( 'New Edible', 'wp-dispensary' ),
		'edit_item'           => __( 'Edit Edible', 'wp-dispensary' ),
		'update_item'         => __( 'Update Edible', 'wp-dispensary' ),
		'view_item'           => __( 'View Edible', 'wp-dispensary' ),
		'search_items'        => __( 'Search Edible', 'wp-dispensary' ),
		'not_found'           => __( 'Not found', 'wp-dispensary' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'wp-dispensary' ),
	);
	$rewrite = array(
		'slug'                => 'edibles',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'Edibles', 'wp-dispensary' ),
		'description'         => __( 'Edible products that our dispensary offers', 'wp-dispensary' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions' ),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
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
	register_post_type( 'edibles', $args );

}
add_action( 'init', 'wpdispensary_edibles', 0 );
