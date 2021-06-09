<?php
/**
 * Fired during plugin activation
 *
 * @link       https://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes
 * @author     WP Dispensary <contact@wpdispensary.com>
 */
class WP_Dispensary_Activator {

	/**
	 * Activatior.
	 *
	 * The following codes are run on plugin activation.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @global $wp_rewrite
	 *
	 * @return void
	 */
	public static function activate() {
		/**
		 * Custom Post Type
		 */
		wp_dispensary_products_post_type();

		/**
		 * Taxonomies
		 */
		wp_dispensary_aromas_taxonomy();
		wp_dispensary_flavors_taxonomy();
		wp_dispensary_effects_taxonomy();
		wp_dispensary_symptoms_taxonomy();
		wp_dispensary_conditions_taxonomy();
		wp_dispensary_ingredients_taxonomy();
		wp_dispensary_vendors_taxonomy();
		wp_dispensary_shelf_types_taxonomy();
		wp_dispensary_strain_types_taxonomy();
		wp_dispensary_allergens_taxonomy();

		/**
		 * Custom Categories
		 */
		wp_dispensary_products_categories_taxonomy();

		/**
		 * Flush Rewrite Rules
		 */
		global $wp_rewrite;
		$wp_rewrite->init();
		$wp_rewrite->flush_rules();

		/**
		 * Create "Menu" page with shortcodes
		 *
		 * @since 2.0 - last updated 2.6
		 */
		if ( ! current_user_can( 'activate_plugins' ) ) return;

		global $wpdb;

		if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'dispensary-menu'", 'ARRAY_A' ) ) {
			$current_user = wp_get_current_user();
			// create post object.
			$page = array(
				'post_title'   => __( 'Menu' ),
				'post_status'  => 'publish',
				'post_author'  => $current_user->ID,
				'post_type'    => 'page',
				'post_content' => '[wpd_menu]',
			);

			// insert the page into the database.
			wp_insert_post( $page );		
		}

		// Set default currency code.
		$wpdas_general = array(
			'wpd_pricing_currency_code' => 'USD',
		);

		// Update default currency code in settings.
		update_option( 'wpdas_general', $wpdas_general );

	}
}
