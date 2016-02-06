<?php
/**
 * Concentrates post type
 *
 * This file is used to create the 'Concentrates' custom post type.
 *
 * @link       http://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types
 */

	/**
	 * Concentrate post type
	 *
	 * Add custom type for Concentrates
	 *
	 * @since    1.0.0
	 */

	function wpdispensary_concentrates() {

		$labels = array(
			'name'                => _x( 'Concentrates', 'Post Type General Name', 'wp-dispensary' ),
			'singular_name'       => _x( 'Concentrate', 'Post Type Singular Name', 'wp-dispensary' ),
			'menu_name'           => __( 'Concentrates', 'wp-dispensary' ),
			'name_admin_bar'      => __( 'Concentrates', 'wp-dispensary' ),
			'parent_item_colon'   => __( 'Parent Concentrate:', 'wp-dispensary' ),
			'all_items'           => __( 'All Concentrates', 'wp-dispensary' ),
			'add_new_item'        => __( 'Add New Concentrate', 'wp-dispensary' ),
			'add_new'             => __( 'Add New', 'wp-dispensary' ),
			'new_item'            => __( 'New Concentrate', 'wp-dispensary' ),
			'edit_item'           => __( 'Edit Concentrate', 'wp-dispensary' ),
			'update_item'         => __( 'Update Concentrate', 'wp-dispensary' ),
			'view_item'           => __( 'View Concentrate', 'wp-dispensary' ),
			'search_items'        => __( 'Search Concentrate', 'wp-dispensary' ),
			'not_found'           => __( 'Not found', 'wp-dispensary' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'wp-dispensary' ),
		);
		$rewrite = array(
			'slug'                => 'concentrates',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               => __( 'Concentrates', 'wp-dispensary' ),
			'description'         => __( 'Concentrate products that our dispensary offers', 'wp-dispensary' ),
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
		register_post_type( 'concentrates', $args );

	}
	add_action( 'init', 'wpdispensary_concentrates', 0 );

?>