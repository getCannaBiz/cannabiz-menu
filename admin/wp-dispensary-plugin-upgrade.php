<?php
/**
 * These functions are run conditionally during plugin upgrade
 *
 * @package    WP_Dispensary
 * @subpackage CannaBiz_Menu/admin
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      4.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    wp_die();
}

/**
 * Deactivate old WPD plugins
 * 
 * This function will deactivate old add-on's to allow for the new version
 * of WPD eCommerce to control these features.
 * 
 * @return void
 */
function wpd_ecommerce_deactivate_plugins() {
    // Plugins to deactivate.
    $plugins_to_deactivate = array(
        'wpd-heavyweights/wpd-heavyweights.php',
        'wpd-inventory/wpd-inventory.php',
        'wpd-locations/wpd-locations.php',
        'wpd-topsellers/wpd-topsellers.php',
        'dispensary-gear/wpd-gear.php',
        'dispensary-tinctures/wpd-tinctures.php'
    );

    // Loop throgh plugins.
    foreach ( $plugins_to_deactivate as $plugin ) {
        // Check if the plugin is active.
        if ( is_plugin_active( $plugin ) ) {
            deactivate_plugins( $plugin );
        }
    }

    /**
     * Flush Rewrite Rules
     */
    global $wp_rewrite;
    $wp_rewrite->init();
    $wp_rewrite->flush_rules();
}
add_action( 'init', 'wpd_ecommerce_deactivate_plugins' );

/**
 * Unregister old post types
 * 
 * @return void
 */
function wpd_unregister_post_types() {
    unregister_post_type( 'flowers' );
    unregister_post_type( 'concentrates' );
    unregister_post_type( 'edibles' );
    unregister_post_type( 'prerolls' );
    unregister_post_type( 'topicals' );
    unregister_post_type( 'growers' );
    unregister_post_type( 'tinctures' );
    unregister_post_type( 'gear' );
}

/**
 * Unregister old taxonomies
 * 
 * @return void
 */
function wpd_unregister_taxonomies() {
    // Categories.
    unregister_taxonomy( 'flowers_category' );
    unregister_taxonomy( 'edibles_category' );
    unregister_taxonomy( 'concentrates_category' );
    unregister_taxonomy( 'topicals_category' );
    unregister_taxonomy( 'growers_category' );
    unregister_taxonomy( 'wpd_gear_category' );
    unregister_taxonomy( 'wpd_tinctures_category' );
    // Additional taxonomies.
    unregister_taxonomy( 'shelf_type' );
    unregister_taxonomy( 'strain_type' );
    unregister_taxonomy( 'vendor' );
    unregister_taxonomy( 'aroma' );
    unregister_taxonomy( 'flavor' );
    unregister_taxonomy( 'effect' );
    unregister_taxonomy( 'symptom' );
    unregister_taxonomy( 'condition' );
}

/**
 * Convert Product Data during Version 4.0 upgrade.
 * 
 * @since  4.0
 * @return void
 */
function wpd_convert_product_data() {
    // Update category taxonomies.
    convert_taxonomies( 'flowers', 'flowers_category', 'wpd_categories' );
    convert_taxonomies( 'concentrates', 'concentrates_category', 'wpd_categories' );
    convert_taxonomies( 'edibles', 'edibles_category', 'wpd_categories' );
    convert_taxonomies( 'prerolls', 'flowers_category', 'wpd_categories' );
    convert_taxonomies( 'topicals', 'topicals_category', 'wpd_categories' );
    convert_taxonomies( 'growers', 'growers_category', 'wpd_categories' );
    convert_taxonomies( 'gear', 'wpd_gear_category', 'wpd_categories' );
    convert_taxonomies( 'tinctures', 'wpd_tinctures_category', 'wpd_categories' );

    // Update additional taxonomies and post type metadata.
    foreach ( wpd_product_types_simple( true ) as $key=>$value ) {
        // Update taxonomies.
        convert_taxonomies( $value, 'allergen', 'allergens' );
        convert_taxonomies( $value, 'aromas', 'aromas' );
        convert_taxonomies( $value, 'conditions', 'conditions' );
        convert_taxonomies( $value, 'effects', 'effects' );
        convert_taxonomies( $value, 'flavors', 'flavors' );
        convert_taxonomies( $value, 'ingredients', 'ingredients' );
        convert_taxonomies( $value, 'shelf_type', 'shelf_types' );
        convert_taxonomies( $value, 'strain_type', 'strain_types' );
        convert_taxonomies( $value, 'symptom', 'symptoms' );
        convert_taxonomies( $value, 'vendor', 'vendors' );
        // Update metadata.
        convert_metadata( $value );
    }

    // Update post types.
    convert_post_types();

    // Update taxonomy counts.
    wpd_update_taxonomy_count();

    // Update user roles.
    convert_user_roles();

}

/**
 * Plugin Upgrader
 * 
 * This will convert all product data to WPD v4.0 setup
 * 
 * @return void
 */
function wpd_plugin_upgrader() {
    if ( isset( $_REQUEST['do_update_wpd'] ) ) {
        // Remove the upgrade admin notice.
        remove_action( 'admin_notices', 'wp_dispensary_upgrade_admin_notice' );
        // Start the data conversion.
        wpd_convert_product_data();
        // Set an option when the upgrade is complete.
        add_option( 'wpd_upgrade_complete', 'true' );
    }
}
add_action( 'admin_init', 'wpd_plugin_upgrader' );

/**
 * Add admin notice for upgrade.
 * 
 * @since  4.0
 * @return string
 */
function wp_dispensary_upgrade_admin_notice() {
    $update_url = wp_nonce_url(
        add_query_arg( 'do_update_wpd', 'true', admin_url( 'admin.php?page=wpd-settings' ) ),
        'wpd_db_update',
        'wpd_db_update_nonce'
    );

    echo '<div class="notice notice-info">
            <p><strong>' . esc_html__( 'WP Dispensary database update required', 'cannabiz-menu' ) . '</strong></p>
            <p>' . esc_html__( 'WP Dispensary has been updated! To keep things running smoothly, we have to update your database to the newest version. The database update process may take a little while, so please be patient.', 'cannabiz-menu' ) . '</p>
            <p><a href="' . esc_url( $update_url ) . '" class="button button-primary">' . esc_html__( 'Upgrade Now', 'cannabiz-menu' ) . '</a></p>
        </div>';
}

if ( ! get_option( 'wpd_upgrade_complete' ) ) {
    add_action( 'admin_notices', 'wp_dispensary_upgrade_admin_notice' );
}

/**
 * Unregister stuff
 * 
 * This will unregister old post types and taxonomies after the version 4.0
 * upgrade is complete
 * 
 * @since  4.0
 * @return void
 */
function wpd_unregister_stuff() {
    // Deactivate old post types.
    wpd_unregister_post_types();
    // Deacrtivate old taxonomies.
    wpd_unregister_taxonomies();
}

if ( get_option( 'wpd_upgrade_complete' ) ) {
    add_action( 'init', 'wpd_unregister_stuff' );
}

/**
 * Update taxonomy counts
 * 
 * This will update the taxonomy counts after the version 4.0 upgrade is complete
 * 
 * @since  4.0
 * @return void
 */
function wpd_update_taxonomy_count() {
    $taxonomies = array(
        'allergens',
        'aromas',
        'conditions',
        'effects',
        'flavors',
        'ingredients',
        'shelf_types',
        'strain_types',
        'symptoms',
        'vendors',
        'wpd_categories'
    );

    foreach ( $taxonomies as $tax ) {
        $get_terms_args = array(
            'taxonomy'   => $tax,
            'fields'     => 'ids',
            'hide_empty' => false,
        );    
        $update_terms = get_terms( $get_terms_args );
        wp_update_term_count_now( $update_terms, $tax );
    }
}
