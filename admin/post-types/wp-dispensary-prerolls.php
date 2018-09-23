<?php
/**
 * Pre-rolls post type
 *
 * This file is used to create the 'Pre-rolls' custom post type.
 *
 * @link       http://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types
 */

/**
 * Pre-rolls post type
 *
 * Add custom type for Pre-rolls
 *
 * @since    1.0.0
 */
function wpdispensary_prerolls() {

	$wpd_prerolls_slug = get_option( 'wpd_prerolls_slug' );

	if ( '' == $wpd_prerolls_slug ) {
		$wpd_prerolls_slug = 'prerolls';
	}

	$labels  = array(
		'name'               => _x( 'Pre-rolls', 'Post Type General Name', 'wp-dispensary' ),
		'singular_name'      => _x( 'Pre-roll', 'Post Type Singular Name', 'wp-dispensary' ),
		'menu_name'          => __( 'Pre-rolls', 'wp-dispensary' ),
		'name_admin_bar'     => __( 'Pre-rolls', 'wp-dispensary' ),
		'parent_item_colon'  => __( 'Parent Pre-roll:', 'wp-dispensary' ),
		'all_items'          => __( 'All Pre-rolls', 'wp-dispensary' ),
		'add_new_item'       => __( 'Add Pre-roll', 'wp-dispensary' ),
		'add_new'            => __( 'Add New', 'wp-dispensary' ),
		'new_item'           => __( 'New Pre-roll', 'wp-dispensary' ),
		'edit_item'          => __( 'Edit Pre-roll', 'wp-dispensary' ),
		'update_item'        => __( 'Update Pre-roll', 'wp-dispensary' ),
		'view_item'          => __( 'View Pre-roll', 'wp-dispensary' ),
		'search_items'       => __( 'Search Pre-rolls', 'wp-dispensary' ),
		'not_found'          => __( 'Not found', 'wp-dispensary' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'wp-dispensary' ),
	);
	$rewrite = array(
		'slug'       => $wpd_prerolls_slug,
		'with_front' => true,
		'pages'      => true,
		'feeds'      => true,
	);
	$args    = array(
		'label'               => __( 'Pre-rolls', 'wp-dispensary' ),
		'description'         => __( 'Pre-rolls that our dispensary offers', 'wp-dispensary' ),
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
	register_post_type( 'prerolls', $args );

}
add_action( 'init', 'wpdispensary_prerolls', 0 );
