<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      2.2.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    wp_die();
}

/**
 * The Class responsible for defining the custom permalink settings.
 * 
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      2.2.0
 */
class WP_Dispensary_Permalink_Settings {
    /**
     * Initialize class.
     * 
     * @return void
     */
    public function __construct() {
        $this->init();
        $this->settings_save();
    }

    /**
     * Call register fields.
     * 
     * @return void
     */
    public function init() {
        add_filter( 'admin_init', array( &$this, 'register_wpd_settings_fields' ) );
    }

    /**
     * Add Products setting to permalinks page.
     * 
     * @return void
     */
    public function register_wpd_settings_fields() {
        // Register Products slug.
        register_setting( 'permalink', 'wpd_products_slug', 'esc_attr' );
        add_settings_field( 'wpd_products_slug', '<label for="wpd_products_slug">' . esc_html__( 'Products Base', 'cannabiz-menu' ) . '</label>', array( &$this, 'wpd_products_fields_html' ), 'permalink', 'optional' );
    }

    /**
     * HTML for Products permalink setting.
     * 
     * @return string
     */
    public function wpd_products_fields_html() {
        $wpd_products_slug = get_option( 'wpd_products_slug' );
        echo '<input type="text" class="regular-text code" id="wpd_products_slug" name="wpd_products_slug" placeholder="products" value="' . esc_attr( $wpd_products_slug ) . '" />';
    }

    /**
     * Save permalink settings.
     * 
     * @return void
     */
    public function settings_save() {
        if ( ! is_admin() ) {
            return;
        }

        // Empty variable.
        $permalinks_nonce = '';

        // Permalinks nonce.
        if ( null !== filter_input( INPUT_POST, 'wpd_permalinks_nonce' ) ) {
            $permalinks_nonce = filter_input( INPUT_POST, 'wpd_permalinks_nonce' );
        }

        // Save settings - Products.
        if ( null !== filter_input( INPUT_POST, 'permalink_structure' ) ||
            null !== filter_input( INPUT_POST, 'wpd_products_slug' ) &&
            wp_verify_nonce( wp_unslash( $permalinks_nonce ), 'cannabiz-menu' ) ) {
              $wpd_products_slug = sanitize_title( wp_unslash( filter_input( INPUT_POST, 'wpd_products_slug' ) ) );
              update_option( 'wpd_products_slug', $wpd_products_slug );
        }
    }
}

$wpd_permalink_settings = new WP_Dispensary_Permalink_Settings();
