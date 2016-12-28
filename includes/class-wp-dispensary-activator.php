<?php
/**
 * Fired during plugin activation
 *
 * @link       http://www.wpdispensary.com
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
 * @author     Robert DeVore <me@robertdevore.com>
 */
class WP_Dispensary_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
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
	}
}
