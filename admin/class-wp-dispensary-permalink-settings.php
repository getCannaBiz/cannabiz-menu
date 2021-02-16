<?php
/**
 * The Class responsible for defining the custom permalink settings.
 *
 * @link       https://www.wpdispensary.com
 * @since      2.2
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */
class WP_Dispensary_Permalink_Settings {
	/**
	 * Initialize class.
	 */
	public function __construct() {
		$this->init();
		$this->settings_save();
	}

	/**
	 * Call register fields.
	 */
	public function init() {
		add_filter( 'admin_init', array( &$this, 'register_wpd_settings_fields' ) );
	}

	/**
	 * Add Flowers setting to permalinks page.
	 */
	public function register_wpd_settings_fields() {
		// Register Flowers slug.
		register_setting( 'permalink', 'wpd_products_slug', 'esc_attr' );
		add_settings_field( 'wpd_products_slug', '<label for="wpd_products_slug">' . esc_html__( 'Products Base', 'wp-dispensary' ) . '</label>', array( &$this, 'wpd_products_fields_html' ), 'permalink', 'optional' );
	}

	/**
	 * HTML for Products permalink setting.
	 */
	public function wpd_products_fields_html() {
		$wpd_products_slug = get_option( 'wpd_products_slug' );
		echo '<input type="text" class="regular-text code" id="wpd_products_slug" name="wpd_products_slug" placeholder="products" value="' . esc_attr( $wpd_products_slug ) . '" />';
	}

	/**
	 * Save permalink settings.
	 */
	public function settings_save() {
		if ( ! is_admin() ) {
			return;
		}

		// Save settings - Products.
		if ( isset( $_POST['permalink_structure'] ) ||
			 isset( $_POST['wpd_products_slug'] ) &&
			 wp_verify_nonce( wp_unslash( $_POST['wpd_permalinks_nonce'] ), 'wp-dispensary' ) ) {
				$wpd_products_slug = sanitize_title( wp_unslash( $_POST['wpd_products_slug'] ) );
				update_option( 'wpd_products_slug', $wpd_products_slug );
		}
	}
}
$wp_dispensary_permalink_settings = new WP_Dispensary_Permalink_Settings();
