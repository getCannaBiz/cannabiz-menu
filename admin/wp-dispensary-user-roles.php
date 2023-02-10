<?php

/**
 * Add shop manager user role
 * 
 * @since  4.4.0
 * @return string
 */
function wp_dispensary_add_user_roles() {
    add_role(
        'shop_owner',
        esc_html__( 'Shop Owner', 'wp-dispensary' ),
        array(
            'read'                   => true,
            'edit_posts'             => true,
            'delete_posts'           => true,
            'publish_posts'          => true,
            'upload_files'           => true,
            'manage_categories'      => true,
            'edit_others_posts'      => true,
            'edit_published_posts'   => true,
            'delete_published_posts' => true,
            'delete_others_posts'    => true,
            'manage_links'           => true,
            'moderate_comments'      => true,
            'manage_options'         => true,
        )
    );
    
    // Remove the ability to edit plugins and themes.
    $shop_owner = get_role( 'shop_owner' );
    $shop_owner->remove_cap( 'edit_plugins' );
    $shop_owner->remove_cap( 'edit_themes' );
    // Remove the ability to create users.
    $shop_owner->remove_cap( 'create_users' );
    // Add custom capability to check before creating new user.
    $shop_owner->add_cap( 'create_non_admin_users' );

    add_role(
        'shop_manager',
        esc_html__( 'Shop Manager', 'wp-dispensary' ),
        array(
            'read'                     => true,
            'edit_posts'               => true,
            'delete_posts'             => true,
            'publish_posts'            => true,
            'upload_files'             => true,
            'manage_categories'        => true,
            'edit_others_posts'        => true,
            'edit_published_posts'     => true,
            'delete_published_posts'   => true,
            'delete_others_posts'      => true,
            'manage_woocommerce'       => true,
            'view_woocommerce_reports' => true,
        )
    );
}
add_action( 'init', 'wp_dispensary_add_user_roles' );

/**
 * Create user restrictions
 * 
 * @param int $user_id - the user ID.
 * 
 * @since  4.4.0
 * @return void
 */
function wp_dispensary_check_user_role_before_creating_new_user( $user_id ) {
    $current_user = wp_get_current_user();
    if ( ! in_array( 'administrator', $current_user->roles ) && ! $current_user->has_cap( 'create_non_admin_users' ) ) {
        wp_die( esc_html__( 'You do not have sufficient permissions to add new users.', 'wp-dispensary' ) );
    }
}
add_action( 'user_new_form', 'wp_dispensary_check_user_role_before_creating_new_user' );

/**
 * Add custom capabilities for wpd_orders post type
 * 
 * @since  4.4.0
 * @return void
 */
function wp_dispensary_add_custom_post_type_capabilities() {
    $roles = array( 'administrator', 'shop_owner', 'shop_manager' );
    foreach( $roles as $role ) {
        $role = get_role( $role );
        $role->add_cap( 'edit_shop_order' );
        $role->add_cap( 'read_shop_order' );
        $role->add_cap( 'delete_shop_order' );
        $role->add_cap( 'edit_shop_orders' );
        $role->add_cap( 'edit_others_shop_orders' );
        $role->add_cap( 'publish_shop_orders' );
        $role->add_cap( 'read_private_shop_orders' );
        $role->add_cap( 'create_shop_orders' );
    }
}
add_action( 'admin_init', 'wp_dispensary_add_custom_post_type_capabilities' );

/**
 * Remove admin menu pages for new user roles
 * 
 * @since  4.4.0
 * @return void
 */
function wp_dispensary_remove_tools_menu() {
    // Check user roles and remove menu pages.
    if ( current_user_can( 'shop_manager' ) || current_user_can( 'shop_owner' ) ) {
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'edit.php' );
        remove_menu_page( 'edit-comments.php' );
    }
}
add_action( 'admin_menu', 'wp_dispensary_remove_tools_menu', 999 );

/**
 * Restrict pages for new user roles
 * 
 * @since  4.4.0
 * @return void
 */
function wp_dispensary_restrict_pages_by_user_role() {
    if ( current_user_can( 'shop_manager' ) || current_user_can( 'shop_owner' ) ) {
        wp_die( 'You are not allowed to access this page.' );
    }
}
add_action( 'load-tools.php', 'wp_dispensary_restrict_pages_by_user_role' );
add_action( 'load-edit-comments.php', 'wp_dispensary_restrict_pages_by_user_role' );
