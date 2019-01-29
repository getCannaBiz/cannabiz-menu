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
 * @author     Robert DeVore <deviodigital@gmail.com>
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
		 * Custom Post Types
		 */
		wpdispensary_flowers();
		wpdispensary_edibles();
		wpdispensary_concentrates();
		wpdispensary_prerolls();
		wpdispensary_topicals();
		wpdispensary_growers();

		/**
		 * Taxonomies
		 */
		wpdispensary_aroma();
		wpdispensary_flavor();
		wpdispensary_effect();
		wpdispensary_symptom();
		wpdispensary_condition();
		wpdispensary_ingredient();
		wpdispensary_vendor();
		wpdispensary_shelf_type();
		wpdispensary_strain_type();
		wpdispensary_allergens();

		/**
		 * Custom Categories
		 */
		wpdispensary_flowercategory();
		wpdispensary_ediblecategory();
		wpdispensary_concentratecategory();
		wpdispensary_topicalcategory();
		wpdispensary_growerscategory();

		/**
		 * Flush Rewrite Rules
		 */
		global $wp_rewrite;
		$wp_rewrite->init();
		$wp_rewrite->flush_rules();

		/**
		 * Create "Dispensary Menu" page with shortcodes
		 *
		 * @since 2.0
		 */
		if ( ! current_user_can( 'activate_plugins' ) ) return;
		global $wpdb;
		if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'dispensary-menu'", 'ARRAY_A' ) ) {
			$current_user = wp_get_current_user();
			// create post object.
			$page = array(
				'post_title'   => __( 'Dispensary Menu' ),
				'post_status'  => 'publish',
				'post_author'  => $current_user->ID,
				'post_type'    => 'page',
				'post_content' => '[wpd-flowers]<br /><br />[wpd-concentrates]<br /><br />[wpd-edibles]<br /><br />[wpd-prerolls]<br /><br />[wpd-topicals]<br /><br />[wpd-growers]',
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
