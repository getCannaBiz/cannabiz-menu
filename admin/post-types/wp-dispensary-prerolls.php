<?php
/**
 * Pre-Rolls post type
 *
 * This file is used to create the 'Pre-Rolls' custom post type.
 *
 * @link       https://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types
 */

	/**
	 * Pre-Rolls post type
	 *
	 * Add custom type for Pre-Rolls
	 *
	 * @since    1.0.0
	 */

	function wpdispensary_prerolls() {

		$labels = array(
			'name'                => _x( 'Pre-Rolls', 'Post Type General Name', 'wp-dispensary' ),
			'singular_name'       => _x( 'Pre-Roll', 'Post Type Singular Name', 'wp-dispensary' ),
			'menu_name'           => __( 'Pre-Rolls', 'wp-dispensary' ),
			'name_admin_bar'      => __( 'Pre-Rolls', 'wp-dispensary' ),
			'parent_item_colon'   => __( 'Parent Pre-Roll:', 'wp-dispensary' ),
			'all_items'           => __( 'All Pre-Rolls', 'wp-dispensary' ),
			'add_new_item'        => __( 'Add New Pre-Roll', 'wp-dispensary' ),
			'add_new'             => __( 'Add New', 'wp-dispensary' ),
			'new_item'            => __( 'New Pre-Roll', 'wp-dispensary' ),
			'edit_item'           => __( 'Edit Pre-Roll', 'wp-dispensary' ),
			'update_item'         => __( 'Update Pre-Roll', 'wp-dispensary' ),
			'view_item'           => __( 'View Pre-Roll', 'wp-dispensary' ),
			'search_items'        => __( 'Search Pre-Roll', 'wp-dispensary' ),
			'not_found'           => __( 'Not found', 'wp-dispensary' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'wp-dispensary' ),
		);
		$rewrite = array(
			'slug'                => 'prerolls',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               => __( 'Pre-Rolls', 'wp-dispensary' ),
			'description'         => __( 'Pre-Roll products that our dispensary offers', 'wp-dispensary' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', ),
			'taxonomies'          => array( ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'		  => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-arrow-right-alt2',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,		
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'			  => $rewrite,
			'capability_type'     => 'post',
		);
		register_post_type( 'prerolls', $args );

	}
	add_action( 'init', 'wpdispensary_prerolls', 0 );

?>