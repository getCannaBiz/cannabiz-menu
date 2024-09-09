<?php
/**
 * Adding the Admin Settings Page
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      4.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    wp_die();
}

/**
 * Define global constants.
 *
 * @since 2.0
 */
if ( ! defined( 'WPD_ADMIN_SETTINGS_VERSION' ) ) {
    define( 'WPD_ADMIN_SETTINGS_VERSION', WP_DISPENSARY_VERSION );
}
if ( ! defined( 'WPDS_NAME' ) ) {
    define( 'WPDS_NAME', trim( dirname( plugin_basename( __FILE__ ) ), '/' ) );
}
if ( ! defined( 'WPDS_DIR' ) ) {
    define( 'WPDS_DIR', WP_PLUGIN_DIR . '/' . WPDS_NAME );
}
if ( ! defined( 'WPDS_URL' ) ) {
    define( 'WPDS_URL', WP_PLUGIN_URL . '/' . WPDS_NAME );
}

// Required for is_plugin_active function.
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Class `WPD_ADMIN_SETTINGS`.
 *
 * @since 2.0
 */
require_once( WPDS_DIR . '/class-wp-dispensary-admin-settings.php' );

/**
 * Actions/Filters
 *
 * Related to all settings API.
 *
 * @since 2.0
 */
if ( class_exists( 'WPD_ADMIN_SETTINGS' ) ) {

    /**
     * Admin settings fields
     * 
     * @return void
     */
    function wpd_admin_settings_fields() {

        // Args for pages.
        $args = array(
            'sort_order'   => 'asc',
            'sort_column'  => 'post_title',
            'hierarchical' => 1,
            'exclude'      => '',
            'include'      => '',
            'meta_key'     => '',
            'meta_value'   => '',
            'authors'      => '',
            'child_of'     => 0,
            'parent'       => -1,
            'exclude_tree' => '',
            'number'       => '',
            'offset'       => 0,
            'post_type'    => 'page',
            'post_status'  => 'publish'
        );

        $args = apply_filters( 'wpd_admin_settings_fields_args', $args );

        // Get all pages.
        $pages = get_pages( $args );

        // Loop through pages.
        if ( ! empty( $pages ) ) {
            foreach ( $pages as $page ) {
                $pages_array[$page->post_name] = $page->post_title;
            }
        }

        //var_dump( $pages_array );

        /**
         * Object Instantiation.
         *
         * Object for the class `WPD_ADMIN_SETTINGS`.
         */
        $wpdas_obj = new WPD_ADMIN_SETTINGS();

        // Initialize admin menu.
        $wpdas_obj->admin_menu();

        // Section: Display.
        $wpdas_obj->add_section(
            array(
                'id'    => 'wpdas_display',
                'title' => esc_attr__( 'Display', 'wp-dispensary' ),
            )
        );

        // Section: General.
        $wpdas_obj->add_section(
            array(
                'id'    => 'wpdas_general',
                'title' => esc_attr__( 'General', 'wp-dispensary' ),
            )
        );

        // Check if WPD eCommerce is active.
        if ( is_plugin_active( 'wpd-ecommerce/wpd-ecommerce.php' ) ) {
            // Section: Payments.
            $wpdas_obj->add_section(
                array(
                    'id'    => 'wpdas_payments',
                    'title' => esc_attr__( 'Payments', 'wp-dispensary' ),
                )
            );

            // Section: Customers.
            $wpdas_obj->add_section(
                array(
                    'id'    => 'wpdas_customers',
                    'title' => esc_attr__( 'Customers', 'wp-dispensary' ),
                )
            );

            // Section: Pages.
            $wpdas_obj->add_section(
                array(
                    'id'    => 'wpdas_pages',
                    'title' => esc_attr__( 'Pages', 'wp-dispensary' ),
                )
            );
        }

        // Check if WPD Drivers is active.
        if ( is_plugin_active( 'wpd-drivers/wpd-drivers.php' ) ) {
            // Section: Drivers.
            $wpdas_obj->add_section(
                array(
                    'id'    => 'wpdas_drivers',
                    'title' => esc_attr__( 'Drivers', 'wp-dispensary' ),
                )
            );
        }

        // Section: Advanced.
        $wpdas_obj->add_section(
            array(
                'id'    => 'wpdas_advanced',
                'title' => esc_attr__( 'Advanced', 'wp-dispensary' ),
            )
        );

        /**
         * Add Field: Display a title to help separate fields
         * Field:     title
         * Section:   wpdas_advanced
         */
        $wpdas_obj->add_field(
            'wpdas_advanced',
            array(
                'id'   => 'wpd_settings_advanced_section_title',
                'type' => 'title',
                'name' => '<h1>' . esc_attr__( 'Advanced Settings', 'wp-dispensary' ) . '</h1>',
            )
        );

        /**
         * Add Field: Cookie lifetime
         * Field:     select
         * Section:   wpdas_advanced
         */
        $wpdas_obj->add_field(
            'wpdas_advanced',
            array(
                'id'      => 'wpd_settings_cookie_lifetime',
                'type'    => 'select',
                'name'    => esc_attr__( 'Cookie lifetime', 'wp-dispensary' ),
                'desc'    => esc_attr__( 'Set the amount of time the shopping cart cookie gets saved to your visitors computer', 'wp-dispensary' ),
                'options' => array(
                    'half_hour'    => esc_attr__( '1/2 hour', 'wp-dispensary' ),
                    'one_hour'     => esc_attr__( '1 hour', 'wp-dispensary' ),
                    'three_hours'  => esc_attr__( '3 hours', 'wp-dispensary' ),
                    'six_hours'    => esc_attr__( '6 hours', 'wp-dispensary' ),
                    'twelve_hours' => esc_attr__( '12 hours', 'wp-dispensary' ),
                    'one_day'      => esc_attr__( '24 hours', 'wp-dispensary' ),
                ),
            )
        );

        /**
         * Add Field: Display a title to help separate fields
         * Field:     title
         * Section:   wpdas_advanced
         */
        $wpdas_obj->add_field(
            'wpdas_advanced',
            array(
                'id'   => 'wpd_settings_export_section_title',
                'type' => 'title',
                'name' => '<h1>' . esc_attr__( 'Export Data', 'wp-dispensary' ) . '</h1>',
            )
        );

        /**
         * Add Field: Export products
         * Field:     button
         * Section:   wpdas_advanced
         */
        $wpdas_obj->add_field(
            'wpdas_advanced',
            array(
                'id'          => 'wpd_settings_export_products_button',
                'type'        => 'button',
                'name'        => esc_attr__( 'Products', 'wp-dispensary' ),
                'button_text' => esc_attr__( 'Export', 'wp-dispensary' ),
                'button_url'  => 'admin.php?page=wpd-settings&export_products&_wpnonce=' . wp_create_nonce( 'download_csv' ),
            )
        );

        /**
         * Add Field: Export orders
         * Field:     button
         * Section:   wpdas_advanced
         */
        $wpdas_obj->add_field(
            'wpdas_advanced_disabled',
            array(
                'id'          => 'wpd_settings_export_orders_button',
                'type'        => 'button',
                'name'        => esc_attr__( 'Orders', 'wp-dispensary' ),
                'button_text' => esc_attr__( 'Export', 'wp-dispensary' ),
                'button_url'  => 'admin.php?page=wpd-settings&export_orders&_wpnonce=' . wp_create_nonce( 'download_csv' ),
            )
        );

        // Check if WPD eCommerce is active.
        if ( is_plugin_active( 'wpd-ecommerce/wpd-ecommerce.php' ) ) {
            /**
             * Add Field: Export customers
             * Field:     button
             * Section:   wpdas_advanced
             */
            $wpdas_obj->add_field(
                'wpdas_advanced',
                array(
                    'id'          => 'wpd_settings_export_customersbutton',
                    'type'        => 'button',
                    'name'        => esc_attr__( 'Customers', 'wp-dispensary' ),
                    'button_text' => esc_attr__( 'Export', 'wp-dispensary' ),
                    'button_url'  => 'admin.php?page=wpd-settings&export_customers&_wpnonce=' . wp_create_nonce( 'download_csv' ),
                )
            );
        }

        // Check if WPD eCommerce is active.
        if ( ! is_plugin_active( 'wpd-ecommerce/wpd-ecommerce.php' ) ) {
            /**
             * Add Field: Display a title to help separate fields
             * Field:     title
             * Section:   wpdas_display
             */
            $wpdas_obj->add_field(
                'wpdas_display',
                array(
                    'id'   => 'wpd_settings_pricing_table_title',
                    'type' => 'title',
                    'name' => '<h1>' . esc_attr__( 'Prices table', 'wp-dispensary' ) . '</h1>',
                )
            );

            /**
             * Add Field: Pricing phrase
             * Field:     select
             * Section:   wpdas_display
             */
            $wpdas_obj->add_field(
                'wpdas_display',
                array(
                    'id'      => 'wpd_pricing_phrase',
                    'type'    => 'select',
                    'name'    => esc_attr__( 'Title', 'wp-dispensary' ),
                    'desc'    => esc_attr__( 'Choose the title you would like used', 'wp-dispensary' ),
                    'options' => array(
                        'Price'    => esc_attr__( 'Prices', 'wp-dispensary' ),
                        'Donation' => esc_attr__( 'Donations', 'wp-dispensary' ),
                    ),
                )
            );

            /**
             * Add Field: Custom title
             * Field:     text
             * Section:   wpdas_display
             */
            $wpdas_obj->add_field(
                'wpdas_display',
                array(
                    'id'          => 'wpd_pricing_phrase_custom',
                    'type'        => 'text',
                    'name'        => '',
                    'desc'        => esc_attr__( 'or add a custom title', 'wp-dispensary' ),
                    'placeholder' => '',
                )
            );

            /**
             * Add Field: Pricing table display
             * Field:     select
             * Section:   wpdas_display
             */
            $wpdas_obj->add_field(
                'wpdas_display',
                array(
                    'id'      => 'wpd_pricing_table_placement',
                    'type'    => 'select',
                    'name'    => esc_attr__( 'Display', 'wp-dispensary' ),
                    'desc'    => esc_attr__( 'Where should the pricing display on single menu items?', 'wp-dispensary' ),
                    'options' => array(
                        'above' => esc_attr__( 'Above Content', 'wp-dispensary' ),
                        'below' => esc_attr__( 'Below Content', 'wp-dispensary' ),
                    ),
                )
            );

            /**
             * Add Field: Hide pricing table
             * Field:     checkbox
             * Section:   wpdas_display
             */
            $wpdas_obj->add_field(
                'wpdas_display',
                array(
                    'id'   => 'wpd_hide_pricing',
                    'type' => 'checkbox',
                    'name' => '',
                    'desc' => esc_attr__( 'Remove the price table from data output', 'wp-dispensary' ),
                )
            );

            /**
             * Add Field: Separator between fields
             * Field:     separator
             * Section:   wpdas_display
             */
            $wpdas_obj->add_field(
                'wpdas_display',
                array(
                    'id'   => 'wpd_settings_separator',
                    'type' => 'separator',
                )
            );
        }

        /**
         * Add Field: Display a title to help separate fields
         * Field:     title
         * Section:   wpdas_display
         */
        $wpdas_obj->add_field(
            'wpdas_display',
            array(
                'id'   => 'wpd_settings_compounds_table_title',
                'type' => 'title',
                'name' => '<h1>' . esc_attr__( 'Compounds table', 'wp-dispensary' ) . '</h1>',
            )
        );

        /**
         * Add Field: Details table placement
         * Field:     select
         * Section:   wpdas_display
         */
        $wpdas_obj->add_field(
            'wpdas_display',
            array(
                'id'      => 'wpd_compounds_table_placement',
                'type'    => 'select',
                'name'    => esc_attr__( 'Display', 'wp-dispensary' ),
                'desc'    => esc_attr__( 'Where should the compounds display on single menu items?', 'wp-dispensary' ),
                'options' => apply_filters( 'wpd_compounds_table_placement_options', array(
                    'above' => esc_attr__( 'Above Content', 'wp-dispensary' ),
                    'below' => esc_attr__( 'Below Content', 'wp-dispensary' ),
                ) ),
            )
        );

        /**
         * Add Field: Display compounds table
         * Field:     checkbox
         * Section:   wpdas_display
         */
        $wpdas_obj->add_field(
            'wpdas_display',
            array(
                'id'   => 'wpd_hide_compounds',
                'type' => 'checkbox',
                'name' => '',
                'desc' => esc_attr__( 'Remove the compounds table from data output', 'wp-dispensary' ),
            )
        );

        /**
         * Add Field: Separator between fields
         * Field:     separator
         * Section:   wpdas_display
         */
        $wpdas_obj->add_field(
            'wpdas_display',
            array(
                'id'   => 'wpd_settings_separator_compounds',
                'type' => 'separator',
            )
        );

        /**
         * Add Field: Display a title to help separate fields
         * Field:     title
         * Section:   wpdas_display
         */
        $wpdas_obj->add_field(
            'wpdas_display',
            array(
                'id'   => 'wpd_settings_details_table_title',
                'type' => 'title',
                'name' => '<h1>' . esc_attr__( 'Details table', 'wp-dispensary' ) . '</h1>',
            )
        );

        /**
         * Add Field: Details phrase
         * Field:     select
         * Section:   wpdas_display
         */
        $wpdas_obj->add_field(
            'wpdas_display',
            array(
                'id'      => 'wpd_details_phrase',
                'type'    => 'select',
                'name'    => esc_attr__( 'Title', 'wp-dispensary' ),
                'desc'    => esc_attr__( 'Choose the title you would like used', 'wp-dispensary' ),
                'options' => array(
                    'Details'     => esc_attr__( 'Details', 'wp-dispensary' ),
                    'Information' => esc_attr__( 'Information', 'wp-dispensary' ),
                ),
            )
        );

        /**
         * Add Field: Custom title
         * Field:     text
         * Section:   wpdas_display
         */
        $wpdas_obj->add_field(
            'wpdas_display',
            array(
                'id'          => 'wpd_details_phrase_custom',
                'type'        => 'text',
                'name'        => '',
                'desc'        => esc_attr__( 'or add a custom title', 'wp-dispensary' ),
                'placeholder' => '',
            )
        );

        /**
         * Add Field: Details table placement
         * Field:     select
         * Section:   wpdas_display
         */
        $wpdas_obj->add_field(
            'wpdas_display',
            array(
                'id'      => 'wpd_details_table_placement',
                'type'    => 'select',
                'name'    => esc_attr__( 'Display', 'wp-dispensary' ),
                'desc'    => esc_attr__( 'Where should the details display on single menu items?', 'wp-dispensary' ),
                'options' => array(
                    'above' => esc_attr__( 'Above Content', 'wp-dispensary' ),
                    'below' => esc_attr__( 'Below Content', 'wp-dispensary' ),
                ),
            )
        );

        /**
         * Add Field: Display details table
         * Field:     checkbox
         * Section:   wpdas_display
         */
        $wpdas_obj->add_field(
            'wpdas_display',
            array(
                'id'   => 'wpd_hide_details',
                'type' => 'checkbox',
                'name' => '',
                'desc' => esc_attr__( 'Remove the details table from data output', 'wp-dispensary' ),
            )
        );

        /**
         * Add Field: Separator between fields
         * Field:     separator
         * Section:   wpdas_display
         */
        $wpdas_obj->add_field(
            'wpdas_display',
            array(
                'id'   => 'wpd_settings_separator_details',
                'type' => 'separator',
            )
        );

        /**
         * Add Field: Display a warning to help separate fields
         * Field:     title
         * Section:   wpdas_display
         */
        $wpdas_obj->add_field(
            'wpdas_display',
            array(
                'id'   => 'wpd_settings_warning_message_title',
                'type' => 'title',
                'name' => '<h1>' . esc_attr__( 'Warning message', 'wp-dispensary' ) . '</h1>',
            )
        );

        /**
         * Add Field: Custom title
         * Field:     textarea
         * Section:   wpdas_display
         */
        $wpdas_obj->add_field(
            'wpdas_display',
            array(
                'id'          => 'wpd_details_product_warning',
                'type'        => 'textarea',
                'name'        => 'Warning',
                'desc'        => esc_attr__( 'Add a warning message to the bottom of all product pages', 'wp-dispensary' ),
                'placeholder' => '',
            )
        );

        /**
         * Add Field: Display warning message
         * Field:     checkbox
         * Section:   wpdas_display
         */
        $wpdas_obj->add_field(
            'wpdas_display',
            array(
                'id'   => 'wpd_details_product_warning_image',
                'type' => 'image',
                'name' => '',
                'desc' => esc_attr__( 'Remove the warning message from data output', 'wp-dispensary' ),
            )
        );

        /**
         * Add Field: Display warning message
         * Field:     checkbox
         * Section:   wpdas_display
         */
        $wpdas_obj->add_field(
            'wpdas_display',
            array(
                'id'   => 'wpd_hide_warning',
                'type' => 'checkbox',
                'name' => '',
                'desc' => esc_attr__( 'Remove the warning message from data output', 'wp-dispensary' ),
            )
        );

        // Check if WPD eCommerce is active.
        if ( is_plugin_active( 'wpd-ecommerce/wpd-ecommerce.php' ) ) {
            /**
             * Add Field: Display a title to help separate fields
             * Field:     title
             * Section:   wpdas_general
             */
            $wpdas_obj->add_field(
                'wpdas_general',
                array(
                    'id'   => 'wpd_settings_store_general',
                    'type' => 'title',
                    'name' => '<h1>' . esc_attr__( 'General', 'wp-dispensary' ) . '</h1>',
                )
            );
        }

        /**
         * Add Field: Currency code
         * Field:     select
         * Section:   wpdas_general
         */
        $wpdas_obj->add_field(
            'wpdas_general',
            array(
                'id'      => 'wpd_pricing_currency_code',
                'type'    => 'select',
                'name'    => esc_attr__( 'Currency', 'wp-dispensary' ),
                'desc'    => esc_attr__( 'Select the currency symbol you would like to use', 'wp-dispensary' ),
                'options' => wpd_pricing_currency_codes()
            )
        );

        // Check if WPD eCommerce is active.
        if ( is_plugin_active( 'wpd-ecommerce/wpd-ecommerce.php' ) ) {
            /**
             * Add Field: Display a title to help separate fields
             * Field:     title
             * Section:   wpdas_general
             */
            $wpdas_obj->add_field(
                'wpdas_general',
                array(
                    'id'   => 'wpd_settings_store_taxes',
                    'type' => 'title',
                    'name' => '<h1>' . esc_attr__( 'Taxes', 'wp-dispensary' ) . '</h1>',
                )
            );

            /**
             * Add Field: Sales tax
             * Field:     select
             * Section:   wpdas_display
             */
            $wpdas_obj->add_field(
                'wpdas_general',
                array(
                    'id'          => 'wpd_ecommerce_sales_tax',
                    'type'        => 'text',
                    'name'        => esc_attr__( 'Sales tax', 'wp-dispensary' ),
                    'desc'        => esc_attr__( 'Apply sales tax to orders (%)', 'wp-dispensary' ),
                    'placeholder' => esc_attr__( '6', 'wp-dispensary' ),
                )
            );

            /**
             * Add Field: Excise tax
             * Field:     text
             * Section:   wpdas_display
             */
            $wpdas_obj->add_field(
                'wpdas_general',
                array(
                    'id'          => 'wpd_ecommerce_excise_tax',
                    'type'        => 'text',
                    'name'        => esc_attr__( 'Excise tax', 'wp-dispensary' ),
                    'desc'        => esc_attr__( 'Apply excise tax to orders (%)', 'wp-dispensary' ),
                    'placeholder' => esc_attr__( '10', 'wp-dispensary' ),
                )
            );

            /**
             * Add Field: Display a title to help separate fields
             * Field:     title
             * Section:   wpdas_general
             */
            $wpdas_obj->add_field(
                'wpdas_general',
                array(
                    'id'   => 'wpd_settings_cart_options',
                    'type' => 'title',
                    'name' => '<h1>' . esc_attr__( 'Cart', 'wp-dispensary' ) . '</h1>',
                )
            );

            /**
             * Add Field: Hide cart functionality for non-logged in users
             * Field:     text
             * Section:   wpdas_general
             */
            $wpdas_obj->add_field(
                'wpdas_general',
                array(
                    'id'   => 'wpd_ecommerce_cart_require_login_to_shop',
                    'type' => 'checkbox',
                    'name' => esc_attr__( 'Require login to shop', 'wp-dispensary' ),
                    'desc' => esc_attr__( 'Hide the add to cart functionality for non-logged in users', 'wp-dispensary' ),
                )
            );

            /**
             * Add Field: Display a title to help separate fields
             * Field:     title
             * Section:   wpdas_general
             */
            $wpdas_obj->add_field(
                'wpdas_general',
                array(
                    'id'   => 'wpd_settings_checkout_options',
                    'type' => 'title',
                    'name' => '<h1>' . esc_attr__( 'Checkout', 'wp-dispensary' ) . '</h1>',
                )
            );

            /**
             * Add Field: Minimum order
             * Field:     text
             * Section:   wpdas_general
             */
            $wpdas_obj->add_field(
                'wpdas_general',
                array(
                    'id'          => 'wpd_ecommerce_checkout_minimum_order',
                    'type'        => 'text',
                    'name'        => esc_attr__( 'Minimum order', 'wp-dispensary' ),
                    'desc'        => esc_attr__( 'Require a minimum order amount before checkout', 'wp-dispensary' ),
                    'placeholder' => esc_attr__( 'ex: 50', 'wp-dispensary' ),
                )
            );

            // Check if Coupons add-on is active.
            if ( is_plugin_active( 'dispensary-coupons/dispensary-coupons.php' ) ) {
                /**
                 * Add Field: Checkout coupons
                 * Field:     checkbox
                 * Section:   wpdas_general
                 */
                $wpdas_obj->add_field(
                    'wpdas_general',
                    array(
                        'id'   => 'wpd_ecommerce_checkout_coupons',
                        'type' => 'checkbox',
                        'name' => esc_attr__( 'Coupons', 'wp-dispensary' ),
                        'desc' => esc_attr__( 'Allow customers to apply a coupon to their order', 'wp-dispensary' ),
                    )
                );
            }

            /**
             * Checkout payment options
             *
             * @since 2.5
             */
            $checkout_payments = array(
                'cod'      => esc_attr__( 'Cash on delivery', 'wp-dispensary' ),
                'pop'      => esc_attr__( 'In-store pickup', 'wp-dispensary' ),
                'curbside' => esc_attr__( 'Curbside pickup', 'wp-dispensary' ),
                'ground'   => esc_attr__( 'Ground shipping', 'wp-dispensary' ),
            );

            $checkout_payment_options = apply_filters( 'wpd_ecommerce_checkout_payment_options', $checkout_payments );

            foreach ( $checkout_payment_options as $id=>$value ) {

                /**
                 * Add Field: Display a title to help separate fields
                 * Field:     title
                 * Section:   wpdas_payments
                 */
                $wpdas_obj->add_field(
                    'wpdas_payments',
                    array(
                        'id'   => 'wpd_settings_payment_options_' . $id,
                        'type' => 'title',
                        'name' => '<h1>' . $value . '</h1>',
                    )
                );

                /**
                 * Add Field: Checkout payments
                 * Field:     checkbox
                 * Section:   wpdas_payments
                 */
                $wpdas_obj->add_field(
                    'wpdas_payments',
                    array(
                        'id'   => 'wpd_ecommerce_checkout_payments_' . $id . '_checkbox',
                        'type' => 'checkbox',
                        'name' => esc_attr__( 'Enable/Disable', 'wp-dispensary' ),
                        'desc' => esc_attr__( 'Enable ' . $value, 'wp-dispensary' ),
                    )
                );

                /**
                 * Add Field: Checkout payments
                 * Field:     text
                 * Section:   wpdas_payments
                 */
                $wpdas_obj->add_field(
                    'wpdas_payments',
                    array(
                        'id'          => 'wpd_ecommerce_checkout_payments_' . $id,
                        'type'        => 'text',
                        'name'        => esc_attr__( 'Charge', 'wp-dispensary' ),
                        'placeholder' => esc_attr__( '0', 'wp-dispensary' ),
                    )
                );

            } // foreach

            /**
             * Add Field: Ground shipping instructions
             * Field:     text
             * Section:   wpdas_payments
             */
            $wpdas_obj->add_field(
                'wpdas_payments',
                array(
                    'id'   => 'wpd_ecommerce_checkout_payments_ground_textarea',
                    'type' => 'textarea',
                    'name' => esc_attr__( 'Instructions', 'wp-dispensary' ),
                    'desc' => esc_attr__( 'Let the user know how to send payment for the order.', 'wp-dispensary' ),
                )
            );

            /**
             * Add Field: Display a title to help separate fields
             * Field:     title
             * Section:   wpdas_customers
             */
            $wpdas_obj->add_field(
                'wpdas_customers',
                array(
                    'id'   => 'wpd_settings_customers_registration_title',
                    'type' => 'title',
                    'name' => '<h1>' . esc_attr__( 'Customer Registration', 'wp-dispensary' ) . '</h1>',
                )
            );

            // Update pages array.
            if ( ! empty( $pages ) ) {
                $pages_array = $pages_array;
                array_unshift( $pages_array, esc_attr__( 'Select a page', 'wp-dispensary' ) );
            } else {
                $pages_array = array( esc_attr__( 'No pages found', 'wp-dispensary' ) );
            }

            /**
             * Add Field: Redirect after registration
             * Field:     select
             * Section:   wpdas_customers
             */
            $wpdas_obj->add_field(
                'wpdas_customers',
                array(
                    'id'      => 'wpd_settings_customers_registration_redirect',
                    'type'    => 'select',
                    'name'    => esc_attr__( 'Redirect after registration', 'wp-dispensary' ),
                    'desc'    => esc_attr__( 'Choose the page customers will be redirected to when registering.', 'wp-dispensary' ),
                    'options' => $pages_array,
                )
            );

            /**
             * Add Field: Display a title to help separate fields
             * Field:     title
             * Section:   wpdas_customers
             */
            $wpdas_obj->add_field(
                'wpdas_customers',
                array(
                    'id'   => 'wpd_settings_customers_verification_title',
                    'type' => 'title',
                    'name' => '<h1>' . esc_attr__( 'Customer Verification', 'wp-dispensary' ) . '</h1>',
                )
            );

            /**
             * Add Field: Hide drivers license upload
             * Field:     checkbox
             * Section:   wpdas_customers
             */
            $wpdas_obj->add_field(
                'wpdas_customers',
                array(
                    'id'   => 'wpd_settings_customers_verification_drivers_license',
                    'type' => 'checkbox',
                    'name' => esc_attr__( 'Drivers license / Valid ID', 'wp-dispensary' ),
                    'desc' => esc_attr__( 'Hide the drivers license upload from account details', 'wp-dispensary' ),
                )
            );

            /**
             * Add Field: Hide doctor recommendation upload
             * Field:     checkbox
             * Section:   wpdas_customers
             */
            $wpdas_obj->add_field(
                'wpdas_customers',
                array(
                    'id'   => 'wpd_settings_customers_verification_recommendation_doc',
                    'type' => 'checkbox',
                    'name' => esc_attr__( 'Doctor recommendation', 'wp-dispensary' ),
                    'desc' => esc_attr__( 'Hide the doctor recommendation upload from account details', 'wp-dispensary' ),
                )
            );

            /**
             * Add Field: Hide recommendation number
             * Field:     checkbox
             * Section:   wpdas_customers
             */
            $wpdas_obj->add_field(
                'wpdas_customers',
                array(
                    'id'   => 'wpd_settings_customers_verification_recommendation_num',
                    'type' => 'checkbox',
                    'name' => esc_attr__( 'Recommendation number', 'wp-dispensary' ),
                    'desc' => esc_attr__( 'Hide the recommendation number from account details', 'wp-dispensary' ),
                )
            );

            /**
             * Add Field: Hide expiration date
             * Field:     checkbox
             * Section:   wpdas_customers
             */
            $wpdas_obj->add_field(
                'wpdas_customers',
                array(
                    'id'   => 'wpd_settings_customers_verification_recommendation_exp',
                    'type' => 'checkbox',
                    'name' => esc_attr__( 'Expiration date', 'wp-dispensary' ),
                    'desc' => esc_attr__( 'Hide the expiration date from account details', 'wp-dispensary' ),
                )
            );

            /**
             * Add Field: Display a title to help separate fields
             * Field:     title
             * Section:   wpdas_general
             */
            $wpdas_obj->add_field(
                'wpdas_pages',
                array(
                    'id'   => 'wpd_settings_checkout_options',
                    'type' => 'title',
                    'name' => '<h1>' . esc_attr__( 'Page Setup', 'wp-dispensary' ) . '</h1>',
                )
            );

            /**
             * Add Field: Menu page
             * Field:     select
             * Section:   wpdas_pages
             */
            $wpdas_obj->add_field(
                'wpdas_pages',
                array(
                    'id'      => 'wpd_pages_setup_menu_page',
                    'type'    => 'select',
                    'name'    => esc_attr__( 'Menu page', 'wp-dispensary' ),
                    'desc'    => esc_attr__( 'Page contents [wpd_menu]', 'wp-dispensary' ),
                    'options' => $pages_array,
                )
            );

            /**
             * Add Field: Cart page
             * Field:     select
             * Section:   wpdas_pages
             */
            $wpdas_obj->add_field(
                'wpdas_pages',
                array(
                    'id'      => 'wpd_pages_setup_cart_page',
                    'type'    => 'select',
                    'name'    => esc_attr__( 'Cart page', 'wp-dispensary' ),
                    'desc'    => esc_attr__( 'Page contents [wpd_cart]', 'wp-dispensary' ),
                    'options' => $pages_array,
                )
            );

            /**
             * Add Field: Checkout page
             * Field:     select
             * Section:   wpdas_pages
             */
            $wpdas_obj->add_field(
                'wpdas_pages',
                array(
                    'id'      => 'wpd_pages_setup_checkout_page',
                    'type'    => 'select',
                    'name'    => esc_attr__( 'Checkout page', 'wp-dispensary' ),
                    'desc'    => esc_attr__( 'Page contents [wpd_checkout]', 'wp-dispensary' ),
                    'options' => $pages_array,
                )
            );

            /**
             * Add Field: Account page
             * Field:     select
             * Section:   wpdas_pages
             */
            $wpdas_obj->add_field(
                'wpdas_pages',
                array(
                    'id'      => 'wpd_pages_setup_account_page',
                    'type'    => 'select',
                    'name'    => esc_attr__( 'Account page', 'wp-dispensary' ),
                    'desc'    => esc_attr__( 'Page contents [wpd_account]', 'wp-dispensary' ),
                    'options' => $pages_array,
                )
            );

            /**
             * Add Field: Dispatch phone number
             * Field:     text
             * Section:   wpdas_drivers
             */
            $wpdas_obj->add_field(
                'wpdas_drivers',
                array(
                    'id'          => 'wpd_dispatch_phone_number',
                    'type'        => 'text',
                    'name'        => esc_attr__( 'Dispatch phone number', 'wp-dispensary' ),
                    'desc'        => esc_attr__( 'Add the phone number to your dispatch center', 'wp-dispensary' ),
                    'placeholder' => ''
                )
            );

            /**
             * Add Field: Google Maps API key
             * Field:     text
             * Section:   wpdas_drivers
             */
            $wpdas_obj->add_field(
                'wpdas_drivers',
                array(
                    'id'          => 'wpd_google_maps_api_key',
                    'type'        => 'text',
                    'name'        => esc_attr__( 'Google Maps API key', 'wp-dispensary' ),
                    'desc'        => esc_attr__( 'Add a map to the order directions for your drivers', 'wp-dispensary' ),
                    'placeholder' => ''
                )
            );

            /**
             * Add Field: Google Maps Geocode
             * Field:     checkbox
             * Section:   wpdas_display
             */
            $wpdas_obj->add_field(
                'wpdas_drivers',
                array(
                    'id'   => 'wpd_google_maps_geocode',
                    'type' => 'checkbox',
                    'name' => '',
                    'desc' => esc_attr__( 'Enable Google Maps geocode for latitude and longitude', 'wp-dispensary' ),
                )
            );

        }
    }
    add_action( 'init', 'wpd_admin_settings_fields' );

} // end WPD_ADMIN_SETTINGS check
