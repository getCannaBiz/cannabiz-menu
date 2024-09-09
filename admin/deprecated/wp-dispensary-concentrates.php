<?php
/**
 * Concentrates post type
 *
 * This file is used to create the 'Concentrates' custom post type.
 *
 * @link       https://cannabizsoftware.com
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

    // Get permalink base for Concentrates.
    $concentrates_slug = get_option( 'wpd_concentrates_slug' );

    // If custom base is empty, set default.
    if ( '' == $concentrates_slug ) {
        $concentrates_slug = 'concentrates';
    }

    // Capitalize first letter of new slug.
    $concentrates_slug_uc = ucfirst( $concentrates_slug );

    $rewrite = array(
        'slug'       => $concentrates_slug,
        'with_front' => true,
        'pages'      => true,
        'feeds'      => true,
    );

    $labels = array(
        'name'                  => sprintf( esc_html__( '%s', 'Post Type General Name', 'wp-dispensary' ), $concentrates_slug_uc ),
        'singular_name'         => sprintf( esc_html__( '%s', 'Post Type Singular Name', 'wp-dispensary' ), $concentrates_slug_uc ),
        'menu_name'             => sprintf( esc_html__( '%s', 'wp-dispensary' ), $concentrates_slug_uc ),
        'name_admin_bar'        => sprintf( esc_html__( '%s', 'wp-dispensary' ), $concentrates_slug_uc ),
        'archives'              => sprintf( esc_html__( '%s Archives', 'wp-dispensary' ), $concentrates_slug_uc ),
        'parent_item_colon'     => sprintf( esc_html__( 'Parent %s:', 'wp-dispensary' ), $concentrates_slug_uc ),
        'all_items'             => sprintf( esc_html__( 'All %s', 'wp-dispensary' ), $concentrates_slug_uc ),
        'add_new_item'          => sprintf( esc_html__( 'Add New %s', 'wp-dispensary' ), $concentrates_slug_uc ),
        'add_new'               => esc_html__( 'Add New', 'wp-dispensary' ),
        'new_item'              => sprintf( esc_html__( 'New %s', 'wp-dispensary' ), $concentrates_slug_uc ),
        'edit_item'             => sprintf( esc_html__( 'Edit %s', 'wp-dispensary' ), $concentrates_slug_uc ),
        'update_item'           => sprintf( esc_html__( 'Update %s', 'wp-dispensary' ), $concentrates_slug_uc ),
        'view_item'             => sprintf( esc_html__( 'View %s', 'wp-dispensary' ), $concentrates_slug_uc ),
        'search_items'          => sprintf( esc_html__( 'Search %s', 'wp-dispensary' ), $concentrates_slug_uc ),
        'not_found'             => esc_html__( 'Not found', 'wp-dispensary' ),
        'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'wp-dispensary' ),
        'featured_image'        => esc_html__( 'Featured Image', 'wp-dispensary' ),
        'set_featured_image'    => esc_html__( 'Set featured image', 'wp-dispensary' ),
        'remove_featured_image' => esc_html__( 'Remove featured image', 'wp-dispensary' ),
        'use_featured_image'    => esc_html__( 'Use as featured image', 'wp-dispensary' ),
        'insert_into_item'      => sprintf( esc_html__( 'Insert into %s', 'wp-dispensary' ), $concentrates_slug_uc ),
        'uploaded_to_this_item' => sprintf( esc_html__( 'Uploaded to this %s', 'wp-dispensary' ), $concentrates_slug_uc ),
        'items_list'            => sprintf( esc_html__( '%s list', 'wp-dispensary' ), $concentrates_slug_uc ),
        'items_list_navigation' => sprintf( esc_html__( '%s list navigation', 'wp-dispensary' ), $concentrates_slug_uc ),
        'filter_items_list'     => sprintf( esc_html__( 'Filter %s list', 'wp-dispensary' ), $concentrates_slug ),
    );

    $args = array(
        'label'               => sprintf( esc_html__( '%s', 'wp-dispensary' ), $concentrates_slug_uc ),
        'description'         => sprintf( esc_html__( 'Display the %s from your menu', 'wp-dispensary' ), $concentrates_slug ),
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

    register_post_type( 'concentrates', $args );
}
add_action( 'init', 'wpdispensary_concentrates', 0 );
