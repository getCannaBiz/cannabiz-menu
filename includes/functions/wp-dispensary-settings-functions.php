<?php
/**
 * The file that defines the admin settings helper functions.
 *
 * @link       https://www.wpdispensary.com
 * @since      3.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes
 */

/**
 * Display - Compounds table placement
 *
 * @return string|bool
 */
function wpd_settings_display_compounds_table_placement() {
    $setting = get_option( 'wpdas_display' );

    if ( isset( $setting['wpd_compounds_table_placement'] ) && '' !== $setting['wpd_compounds_table_placement'] ) {
        $placement = $setting['wpd_compounds_table_placement'];
    } else {
        $placement = 'above';
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

    if ( isset( $setting['wpd_hide_compounds'] ) && '' !== $setting['wpd_hide_compounds'] ) {
        $hide = $setting['wpd_hide_compounds'];
    } else {
        $hide = FALSE;
    }

	return apply_filters( 'wpd_settings_display_hide_compounds', $hide );
}

/**
 * Patients - Registration Redirect
 *
 * @return string|bool
 */
function wpd_settings_patients_registration_redirect() {
    $setting = get_option( 'wpdas_patients' );

    if ( isset( $setting['wpd_settings_patients_registration_redirect'] ) && 0 !== $setting['wpd_settings_patients_registration_redirect'] ) {
        $redirect_url = $setting['wpd_settings_patients_registration_redirect'];
    } else {
        $redirect_url = FALSE;
    }

	return apply_filters( 'wpd_settings_patients_registration_redirect', $redirect_url );
}
