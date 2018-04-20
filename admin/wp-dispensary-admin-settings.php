<?php
/**
 * Adding the Admin Settings Page
 *
 * @link       https://www.wpdispensary.com
 * @since      2.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

/**
 * Define global constants.
 *
 * @since 2.0
 */
// Plugin version.
if ( ! defined( 'WPD_ADMIN_SETTINGS_VERSION' ) ) {
	define( 'WPD_ADMIN_SETTINGS_VERSION', '2.0' );
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
 * @since  2.0
 */
if ( class_exists( 'WPD_ADMIN_SETTINGS' ) ) {
	/**
	 * Object Instantiation.
	 *
	 * Object for the class `WPD_ADMIN_SETTINGS`.
	 */
	$wpdas_obj = new WPD_ADMIN_SETTINGS();

	// Section: Display.
	$wpdas_obj->add_section(
		array(
			'id'    => 'wpdas_display',
			'title' => __( 'Display', 'wp-dispensary' ),
		)
	);

	// Section: General.
	$wpdas_obj->add_section(
		array(
			'id'    => 'wpdas_general',
			'title' => __( 'General', 'wp-dispensary' ),
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
			'name' => '<h1>Details table</h1>',
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
			'name'    => __( 'Title', 'wp-dispensary' ),
			'desc'    => __( 'Choose the title you would like used', 'wp-dispensary' ),
			'options' => array(
				'Details'     => 'Details',
				'Information' => 'Information',
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
			'id'          => 'wpd_details_phrase_settings',
			'type'        => 'text',
			'name'        => __( '', 'wp-dispensary' ),
			'desc'        => __( 'or add a custom title', 'wp-dispensary' ),
			'placeholder' => __( '', 'wp-dispensary' ),
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
			'name'    => __( 'Display', 'wp-dispensary' ),
			'desc'    => __( 'Where should the details display on single menu items?', 'wp-dispensary' ),
			'options' => array(
				'above' => 'Above Content',
				'below' => 'Below Content',
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
			'name' => __( '', 'wp-dispensary' ),
			'desc' => __( 'Remove the details table from data output', 'wp-dispensary' ),
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
			'name' => '<h1>Prices table</h1>',
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
			'name'    => __( 'Title', 'wp-dispensary' ),
			'desc'    => __( 'Choose the title you would like used', 'wp-dispensary' ),
			'options' => array(
				'Price'    => 'Prices',
				'Donation' => 'Donations',
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
			'id'          => 'wpd_pricing_phrase_other',
			'type'        => 'text',
			'name'        => __( '', 'wp-dispensary' ),
			'desc'        => __( 'or add a custom title', 'wp-dispensary' ),
			'placeholder' => __( '', 'wp-dispensary' ),
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
			'name'    => __( 'Display', 'wp-dispensary' ),
			'desc'    => __( 'Where should the pricing display on single menu items?', 'wp-dispensary' ),
			'options' => array(
				'above' => 'Above Content',
				'below' => 'Below Content',
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
			'name' => __( '', 'wp-dispensary' ),
			'desc' => __( 'Remove the price table from data output', 'wp-dispensary' ),
		)
	);

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
			'name'    => __( 'Currency', 'wp-dispensary' ),
			'desc'    => __( 'Select the currency symbol you would like to use', 'wp-dispensary' ),
			'options' => array(
				'AUD' => '(AUD) Australian Dollar',
				'BRL' => '(BRL) Brazilian Real',
				'CAD' => '(CAD) Canadian Dollar',
				'CZK' => '(CZK) Czech Koruna',
				'DKK' => '(DKK) Danish Krone',
				'EUR' => '(EUR) Euro',
				'HKD' => '(HKD) Hong Kong Dollar',
				'HUF' => '(HUF) Hungarian Forint',
				'ILS' => '(ILS) Israeli New Sheqel',
				'JPY' => '(JPY) Japanese Yen',
				'MYR' => '(MYR) Malaysian Ringgit',
				'MYR' => '(MXN) Mexican Peso',
				'MXN' => '(NOK) Norwegian Krone',
				'NOK' => '(NZD) New Zealand Dollar',
				'NZD' => '(PHP) Philippine Peso',
				'PHP' => '(PLN) Polish Zloty',
				'PLN' => '(GBP) Pound Sterling',
				'GBP' => '(SGD) Singapore Dollar',
				'SGD' => '(SEK) Swedish Krona',
				'CHF' => '(CHF) Swiss Franc',
				'TWD' => '(TWD) Taiwan New Dollar',
				'THB' => '(THB) Thai Baht',
				'TRY' => '(TRY) Turkish Lira',
				'USD' => '(USD) U.S. Dollar',
			),
		)
	);
}
