<?php
/**
 * Adding the Admin Settings Page
 *
 * @link       https://www.wpdispensary.com
 * @since      1.6.0
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
if ( ! defined('WPDS_DIR' ) ) {
    define( 'WPDS_DIR', WP_PLUGIN_DIR . '/' . WPDS_NAME );
}
if ( ! defined('WPDS_URL' ) ) {
    define( 'WPDS_URL', WP_PLUGIN_URL . '/' . WPDS_NAME );
}

/**
 * WP-OOP-Settings-API Initializer
 *
 * Initializes the WP-OOP-Settings-API.
 *
 * @since 	2.0
 */
/**
 * Class `WPD_ADMIN_SETTINGS`.
 *
 * @since 2.0
 */
// if ( file_exists( WPDS_DIR . '/admin/class-wp-dispensary-admin-settings.php' ) ) {
    require_once( WPDS_DIR . '/class-wp-dispensary-admin-settings.php' );
// }
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

    // Section: Display Settings.
    $wpdas_obj->add_section(
    	array(
			'id'    => 'wpdas_display',
			'title' => __( 'Display Settings', 'wp-dispensary' ),
		)
    );

    // Section: Other Settings.
    $wpdas_obj->add_section(
    	array(
			'id'    => 'wpdas_other',
			'title' => __( 'Other Settings', 'wp-dispensary' ),
		)
    );


	/**
	 * Add Field: Details table
	 * Field:     checkbox
	 * Section:   wpdas_display
	 */
	$wpdas_obj->add_field(
		'wpdas_display',
		array(
			'id'   => 'wpd_hide_details',
			'type' => 'checkbox',
			'name' => __( 'Details table', 'wp-dispensary' ),
			'desc' => __( 'hide the details table from data output', 'wp-dispensary' ),
		)
	);



    // Field: Text.
	$wpdas_obj->add_field(
		'wpdas_display',
		array(
			'id'      => 'text',
			'type'    => 'text',
			'name'    => __( 'Text Input', 'wp-dispensary' ),
			'desc'    => __( 'Text input description', 'wp-dispensary' ),
			'default' => 'Default Text',
		)
	);
	$wpdas_obj->add_field(
		'wpdas_display',
		array(
			'id'                => 'text_no',
			'type'              => 'number',
			'name'              => __( 'Number Input', 'wp-dispensary' ),
			'desc'              => __( 'Number field with validation callback `intval`', 'wp-dispensary' ),
			'default'           => 1,
			'sanitize_callback' => 'intval'
		)
	);
	$wpdas_obj->add_field(
		'wpdas_display',
		array(
			'id'      => 'password',
			'type'    => 'password',
			'name'    => __( 'Password Input', 'wp-dispensary' ),
			'desc'    => __( 'Password field description', 'wp-dispensary' ),
		)
	);
	$wpdas_obj->add_field(
		'wpdas_display',
		array(
			'id'   => 'textarea',
			'type' => 'textarea',
			'name' => __( 'Textarea Input', 'wp-dispensary' ),
			'desc' => __( 'Textarea description', 'wp-dispensary' ),
		)
	);
	$wpdas_obj->add_field(
		'wpdas_display',
		array(
			'id'   => 'checkbox',
			'type' => 'checkbox',
			'name' => __( 'Checkbox', 'wp-dispensary' ),
			'desc' => __( 'Checkbox Label', 'wp-dispensary' ),
		)
	);
	$wpdas_obj->add_field(
		'wpdas_display',
		array(
			'id'   => 'radio',
			'type' => 'radio',
			'name' => __( 'Radio', 'wp-dispensary' ),
			'desc' => __( 'Radio Button', 'wp-dispensary' ),
			'options' => array(
				'yes' => 'Yes',
				'no'  => 'No'
			)
		)
	);
	$wpdas_obj->add_field(
		'wpdas_display',
		array(
			'id'   => 'multicheck',
			'type' => 'multicheck',
			'name' => __( 'Multile checkbox', 'wp-dispensary' ),
			'desc' => __( 'Multile checkbox description', 'wp-dispensary' ),
			'options' => array(
				'yes' => 'Yes',
				'no'  => 'No'
			)
		)
	);
	$wpdas_obj->add_field(
		'wpdas_display',
		array(
			'id'   => 'select',
			'type' => 'select',
			'name' => __( 'A Dropdown', 'wp-dispensary' ),
			'desc' => __( 'A Dropdown description', 'wp-dispensary' ),
			'options' => array(
				'yes' => 'Yes',
				'no'  => 'No'
			)
		)
	);
	$wpdas_obj->add_field(
		'wpdas_other',
		array(
			'id'   => 'image',
			'type' => 'image',
			'name' => __( 'Image', 'wp-dispensary' ),
			'desc' => __( 'Image description', 'wp-dispensary' ),
			'options' => array(
				'button_label' => 'Choose Image'
			)
		)
	);
	$wpdas_obj->add_field(
		'wpdas_other',
		array(
			'id'   => 'file',
			'type' => 'file',
			'name' => __( 'File', 'wp-dispensary' ),
			'desc' => __( 'File description', 'wp-dispensary' ),
			'options' => array(
				'button_label' => 'Choose file'
			)
		)
	);
	$wpdas_obj->add_field(
		'wpdas_other',
		array(
			'id'   => 'color',
			'type' => 'color',
			'name' => __( 'Color', 'wp-dispensary' ),
			'desc' => __( 'Color description', 'wp-dispensary' ),
		)
	);
	$wpdas_obj->add_field(
		'wpdas_other',
		array(
			'id'   => 'wysiwyg',
			'type' => 'wysiwyg',
			'name' => __( 'WP_Editor', 'wp-dispensary' ),
			'desc' => __( 'WP_Editor description', 'wp-dispensary' ),
		)
	);
}