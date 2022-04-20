<?php
/**
 * The file that defines the admin settings helper functions.
 *
 * @link       https://www.wpdispensary.com
 * @since      3.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes/functions
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	wp_die();
}

/**
 * Display - Compounds table placement
 *
 * @return string|bool
 */
function wpd_settings_display_compounds_table_placement() {
    $setting   = get_option( 'wpdas_display' );
    $placement = 'above';

    if ( isset( $setting['wpd_compounds_table_placement'] ) && '' !== $setting['wpd_compounds_table_placement'] ) {
        $placement = $setting['wpd_compounds_table_placement'];
    }

    return apply_filters( 'wpd_settings_display_compounds_table_placement', $placement );
}

/**
 * Display - Compounds table display
 *
 * @return string|bool
 */
function wpd_settings_display_hide_compounds() {
    $setting = get_option( 'wpdas_display' );
    $hide    = FALSE;

    if ( isset( $setting['wpd_hide_compounds'] ) && 'off' !== $setting['wpd_hide_compounds'] ) {
        $hide = TRUE;
    }

    return apply_filters( 'wpd_settings_display_hide_compounds', $hide );
}

/**
 * Display - Details table placement
 *
 * @return string|bool
 */
function wpd_settings_display_details_table_placement() {
    $setting   = get_option( 'wpdas_display' );
    $placement = 'above';

    if ( isset( $setting['wpd_details_table_placement'] ) && '' !== $setting['wpd_details_table_placement'] ) {
        $placement = $setting['wpd_details_table_placement'];
    }

    return apply_filters( 'wpd_settings_display_details_table_placement', $placement );
}

/**
 * Display - Details table display
 *
 * @return string|bool
 */
function wpd_settings_display_hide_details() {
    $setting = get_option( 'wpdas_display' );
    $hide    = FALSE;

    if ( isset( $setting['wpd_hide_details'] ) && 'off' !== $setting['wpd_hide_details'] ) {
        $hide = TRUE;
    }

    return apply_filters( 'wpd_settings_display_hide_details', $hide );
}

/**
 * Display - Details phrase
 *
 * @return string|bool
 */
function wpd_settings_display_details_phrase() {
    $setting = get_option( 'wpdas_display' );

    if ( isset( $setting['wpd_details_phrase_custom'] ) && '' !== $setting['wpd_details_phrase_custom'] ) {
        // Custom title phrase.
        $phrase = $setting['wpd_details_phrase_custom'];
    } elseif ( isset( $setting['wpd_details_phrase'] ) && '' !== $setting['wpd_details_phrase'] ) {
        // Select title phrase.
        $phrase = $setting['wpd_details_phrase'];
    } else {
        // Default title phrase.
        $phrase = esc_attr__( 'Details', 'wp-dispensary' );
    }

    return apply_filters( 'wpd_settings_display_details_phrase', $phrase );
}

/**
 * Customers - Registration Redirect
 *
 * @return string|bool
 */
function wpd_settings_customers_registration_redirect() {
    $setting      = get_option( 'wpdas_customers' );
    $redirect_url = FALSE;

    if ( isset( $setting['wpd_settings_customers_registration_redirect'] ) && 0 !== $setting['wpd_settings_customers_registration_redirect'] ) {
        $redirect_url = home_url() . '/' . $setting['wpd_settings_customers_registration_redirect'];
    }

	return apply_filters( 'wpd_settings_customers_registration_redirect', $redirect_url );
}
