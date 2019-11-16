<?php
/**
 * Adding the functions that are used throughout
 * various areas of the plugin
 *
 * @link       https://www.wpdispensary.com
 * @since      2.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currency Code
 * 
 * @since 2.0
 * @return string
 */
function wpd_currency_code() {

	$wpd_settings = get_option( 'wpdas_general' );

	if ( ! isset ( $wpd_settings['wpd_pricing_currency_code'] ) ) {
		$wpd_currency = 'USD';
	} else {
		$wpd_currency = $wpd_settings['wpd_pricing_currency_code'];
	}

	$currency_symbols = array(
		'AED' => '&#1583;.&#1573;', // ?
		'AFN' => '&#65;&#102;',
		'ALL' => '&#76;&#101;&#107;',
		'AMD' => '',
		'ANG' => '&#402;',
		'AOA' => '&#75;&#122;', // ?
		'ARS' => '&#36;',
		'AUD' => '&#36;',
		'AWG' => '&#402;',
		'AZN' => '&#1084;&#1072;&#1085;',
		'BAM' => '&#75;&#77;',
		'BBD' => '&#36;',
		'BDT' => '&#2547;', // ?
		'BGN' => '&#1083;&#1074;',
		'BHD' => '.&#1583;.&#1576;', // ?
		'BIF' => '&#70;&#66;&#117;', // ?
		'BMD' => '&#36;',
		'BND' => '&#36;',
		'BOB' => '&#36;&#98;',
		'BRL' => '&#82;&#36;',
		'BSD' => '&#36;',
		'BTN' => '&#78;&#117;&#46;', // ?
		'BWP' => '&#80;',
		'BYR' => '&#112;&#46;',
		'BZD' => '&#66;&#90;&#36;',
		'CAD' => '&#36;',
		'CDF' => '&#70;&#67;',
		'CHF' => '&#67;&#72;&#70;',
		'CLF' => '', // ?
		'CLP' => '&#36;',
		'CNY' => '&#165;',
		'COP' => '&#36;',
		'CRC' => '&#8353;',
		'CUP' => '&#8396;',
		'CVE' => '&#36;', // ?
		'CZK' => '&#75;&#269;',
		'DJF' => '&#70;&#100;&#106;', // ?
		'DKK' => '&#107;&#114;',
		'DOP' => '&#82;&#68;&#36;',
		'DZD' => '&#1583;&#1580;', // ?
		'EGP' => '&#163;',
		'ETB' => '&#66;&#114;',
		'EUR' => '&#8364;',
		'FJD' => '&#36;',
		'FKP' => '&#163;',
		'GBP' => '&#163;',
		'GEL' => '&#4314;', // ?
		'GHS' => '&#162;',
		'GIP' => '&#163;',
		'GMD' => '&#68;', // ?
		'GNF' => '&#70;&#71;', // ?
		'GTQ' => '&#81;',
		'GYD' => '&#36;',
		'HKD' => '&#36;',
		'HNL' => '&#76;',
		'HRK' => '&#107;&#110;',
		'HTG' => '&#71;', // ?
		'HUF' => '&#70;&#116;',
		'IDR' => '&#82;&#112;',
		'ILS' => '&#8362;',
		'INR' => '&#8377;',
		'IQD' => '&#1593;.&#1583;', // ?
		'IRR' => '&#65020;',
		'ISK' => '&#107;&#114;',
		'JEP' => '&#163;',
		'JMD' => '&#74;&#36;',
		'JOD' => '&#74;&#68;', // ?
		'JPY' => '&#165;',
		'KES' => '&#75;&#83;&#104;', // ?
		'KGS' => '&#1083;&#1074;',
		'KHR' => '&#6107;',
		'KMF' => '&#67;&#70;', // ?
		'KPW' => '&#8361;',
		'KRW' => '&#8361;',
		'KWD' => '&#1583;.&#1603;', // ?
		'KYD' => '&#36;',
		'KZT' => '&#1083;&#1074;',
		'LAK' => '&#8365;',
		'LBP' => '&#163;',
		'LKR' => '&#8360;',
		'LRD' => '&#36;',
		'LSL' => '&#76;', // ?
		'LTL' => '&#76;&#116;',
		'LVL' => '&#76;&#115;',
		'LYD' => '&#1604;.&#1583;', // ?
		'MAD' => '&#1583;.&#1605;.', // ?
		'MDL' => '&#76;',
		'MGA' => '&#65;&#114;', // ?
		'MKD' => '&#1076;&#1077;&#1085;',
		'MMK' => '&#75;',
		'MNT' => '&#8366;',
		'MOP' => '&#77;&#79;&#80;&#36;', // ?
		'MRO' => '&#85;&#77;', // ?
		'MUR' => '&#8360;', // ?
		'MVR' => '.&#1923;', // ?
		'MWK' => '&#77;&#75;',
		'MXN' => '&#36;',
		'MYR' => '&#82;&#77;',
		'MZN' => '&#77;&#84;',
		'NAD' => '&#36;',
		'NGN' => '&#8358;',
		'NIO' => '&#67;&#36;',
		'NOK' => '&#107;&#114;',
		'NPR' => '&#8360;',
		'NZD' => '&#36;',
		'OMR' => '&#65020;',
		'PAB' => '&#66;&#47;&#46;',
		'PEN' => '&#83;&#47;&#46;',
		'PGK' => '&#75;', // ?
		'PHP' => '&#8369;',
		'PKR' => '&#8360;',
		'PLN' => '&#122;&#322;',
		'PYG' => '&#71;&#115;',
		'QAR' => '&#65020;',
		'RON' => '&#108;&#101;&#105;',
		'RSD' => '&#1044;&#1080;&#1085;&#46;',
		'RUB' => '&#1088;&#1091;&#1073;',
		'RWF' => '&#1585;.&#1587;',
		'SAR' => '&#65020;',
		'SBD' => '&#36;',
		'SCR' => '&#8360;',
		'SDG' => '&#163;', // ?
		'SEK' => '&#107;&#114;',
		'SGD' => '&#36;',
		'SHP' => '&#163;',
		'SLL' => '&#76;&#101;', // ?
		'SOS' => '&#83;',
		'SRD' => '&#36;',
		'STD' => '&#68;&#98;', // ?
		'SVC' => '&#36;',
		'SYP' => '&#163;',
		'SZL' => '&#76;', // ?
		'THB' => '&#3647;',
		'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
		'TMT' => '&#109;',
		'TND' => '&#1583;.&#1578;',
		'TOP' => '&#84;&#36;',
		'TRY' => '&#8356;', // New Turkey Lira (old symbol used).
		'TTD' => '&#36;',
		'TWD' => '&#78;&#84;&#36;',
		'TZS' => '',
		'UAH' => '&#8372;',
		'UGX' => '&#85;&#83;&#104;',
		'USD' => '&#36;',
		'UYU' => '&#36;&#85;',
		'UZS' => '&#1083;&#1074;',
		'VEF' => '&#66;&#115;',
		'VND' => '&#8363;',
		'VUV' => '&#86;&#84;',
		'WST' => '&#87;&#83;&#36;',
		'XAF' => '&#70;&#67;&#70;&#65;',
		'XCD' => '&#36;',
		'XDR' => '',
		'XOF' => '',
		'XPF' => '&#70;',
		'YER' => '&#65020;',
		'ZAR' => '&#82;',
		'ZMK' => '&#90;&#75;', // ?
		'ZWL' => '&#90;&#36;',
	);

	return $currency_symbols[ $wpd_currency ];
}

/**
 * Pricing Currency Codes
 * 
 * @since 2.6
 * @return array
 */
function wpd_pricing_currency_codes() {

	// Currency codes.
	$currency = array(
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
		'MXN' => '(MXN) Mexican Peso',
		'NOK' => '(NOK) Norwegian Krone',
		'NZD' => '(NZD) New Zealand Dollar',
		'PHP' => '(PHP) Philippine Peso',
		'PLN' => '(PLN) Polish Zloty',
		'GBP' => '(GBP) Pound Sterling',
		'SGD' => '(SGD) Singapore Dollar',
		'SEK' => '(SEK) Swedish Krona',
		'CHF' => '(CHF) Swiss Franc',
		'TWD' => '(TWD) Taiwan New Dollar',
		'THB' => '(THB) Thai Baht',
		'TRY' => '(TRY) Turkish Lira',
		'USD' => '(USD) U.S. Dollar',
		'ZAR' => '(ZAR) South African Rand',
	);

	// Create filterable currency codes variable.
	$currency_codes = apply_filters( 'wpd_pricing_currency_codes_new', $currency );

	return $currency_codes;
}

/**
 * WPD Admin Settings - Details phrase
 * 
 * @since 2.5
 * @return string
 */
function get_wpd_details_phrase() {
	// Access all WP Dispensary Display Settings.
	$wpd_settings = get_option( 'wpdas_display' );

	// Check details phrase settings.
	if ( isset ( $wpd_settings['wpd_details_phrase_custom'] ) && '' !== $wpd_settings['wpd_details_phrase_custom'] ) {
		$wpd_details_phrase = $wpd_settings['wpd_details_phrase_custom'];
	} elseif ( isset ( $wpd_settings['wpd_details_phrase'] ) && 'Information' === $wpd_settings['wpd_details_phrase'] ) {
		$wpd_details_phrase = __( 'Information', 'wp-dispensary' );
	} else {
		$wpd_details_phrase = __( 'Details', 'wp-dispensary' );
	}

	// Create filterable details phrase.
	$wpd_details_phrase = apply_filters( 'wpd_details_phrase', $wpd_details_phrase );

	// Return the details phrase.
	return $wpd_details_phrase;
}

/**
 * Compounds details - Simple
 * 
 * @see get_wpd_compounds_simple()
 * @since 2.5
 * @return string
 */
function wpd_compounds_simple( $product_id, $type = NULL, $compound_array = NULL ) {
    // Filters the displayed compound details.
    echo esc_html( apply_filters( 'wpd_compounds_simple', get_wpd_compounds_simple( $product_id, $type, $compound_array ) ) );
}

/**
 * Compounds details - Get Simple
 * 
 * @since 2.5
 * @return string
 */
function get_wpd_compounds_simple( $product_id, $type = NULL, $compound_array = NULL ) {
	// Set compound type.
	if ( $type ) {
		$type = $type;
	} else {
		$type = NULL;
	}

	// Get post type.
	$post_type = get_post_type( $product_id );

    // Create post type variables.
    if ( $post_type ) {
        $post_type_data = get_post_type_object( $post_type );
        $post_type_name = $post_type_data->label;
        $post_type_slug = $post_type_data->rewrite['slug'];
	}

	if ( 'flowers' == $post_type || 'concentrates' == $post_type || 'prerolls' == $post_type || 'tinctures' == $post_type ) {
		$type = '%';
	}

	if ( 'edibles' == $post_type || 'topicals' == $post_type ) {
		$type = 'mg';
	}

	// Set compounds.
	$compounds = array();

	// THC.
	if ( NULL != $compound_array && in_array( 'thc', $compound_array ) ) {
		if ( get_post_meta( $product_id, '_thc', true ) ) {
			$compounds['THC'] = get_post_meta( $product_id, '_thc', true ) . $type;
		} else {
			// Do nothing.
		}
	} else {
		// Do nothing.
	}

	// THCA.
	if ( NULL != $compound_array && in_array( 'thca', $compound_array ) ) {
		if ( get_post_meta( $product_id, '_thca', true ) ) {
			$compounds['THCA'] = get_post_meta( $product_id, '_thca', true ) . $type;
		}
	} else {
		// Do nothing.
	}

	// CBD.
	if ( NULL != $compound_array && in_array( 'cbd', $compound_array ) ) {
		if ( get_post_meta( $product_id, '_cbd', true ) ) {
			$compounds['CBD'] = get_post_meta( $product_id, '_cbd', true ) . $type;
		} else {
			// Do nothing.
		}
	} else {
		// Do nothing.
	}

	// CBA.
	if ( NULL != $compound_array && in_array( 'cba', $compound_array ) ) {
		if ( get_post_meta( $product_id, '_cba', true ) ) {
			$compounds['CBA'] = get_post_meta( $product_id, '_cba', true ) . $type;
		} else {
			// Do nothing.
		}
	} else {
		// Do nothing.
	}

	// CBN.
	if ( NULL != $compound_array && in_array( 'cbn', $compound_array ) ) {
		if ( get_post_meta( $product_id, '_cbn', true ) ) {
			$compounds['CBN'] = get_post_meta( $product_id, '_cbn', true ) . $type;
		} else {
			// Do nothing.
		}
	} else {
		// Do nothing.
	}

	// CBG.
	if ( NULL != $compound_array && in_array( 'cbg', $compound_array ) ) {
		if ( get_post_meta( $product_id, '_cbg', true ) ) {
			$compounds['CBG'] = get_post_meta( $product_id, '_cbg', true ) . $type;
		} else {
			// Do nothing.
		}
	} else {
		// Do nothing.
	}

	// Create empty variable.
	$str = '';

	// Add each compound to variable.
	foreach ( $compounds as $compound=>$value ) {
		$str .= '<span class="wpd-productinfo ' . $compound . '"><strong>' . $compound . ':</strong> ' . $value . '</span>';
	}

	return $str;
}

/**
 * Compounds details - Array
 * 
 * @see get_wpd_compounds_array()
 * @since 2.5
 * @return string
 */
function wpd_compounds_array( $product_id, $type = NULL, $compound_array = NULL ) {
    // Filters the displayed compounds.
    echo esc_html( apply_filters( 'wpd_compounds_array', get_wpd_compounds_array( $product_id, $type, $compound_array ) ) );
}


/**
 * Compounds details - Get Array
 * 
 * @since 2.5
 * @return string
 */
function get_wpd_compounds_array( $product_id, $type = NULL, $compound_array = NULL ) {
	// Set compound type.
	if ( $type ) {
		$type = $type;
	} else {
		$type = NULL;
	}

	// Get post type.
	$post_type = get_post_type();

    // Create post type variables.
    if ( $post_type ) {
        $post_type_data = get_post_type_object( $post_type );
        $post_type_name = $post_type_data->label;
        $post_type_slug = $post_type_data->rewrite['slug'];
	}

	if ( 'flowers' == $post_type || 'concentrates' == $post_type || 'prerolls' == $post_type || 'tinctures' == $post_type ) {
		$type = '%';
	}

	if ( 'edibles' == $post_type || 'topicals' == $post_type ) {
		$type = 'mg';
	}

	// Set compounds.
	$compounds = array();

	// THC.
	if ( in_array( 'thc', $compound_array ) ) {
		if ( get_post_meta( $product_id, '_thc', true ) ) {
			$compounds['THC'] = get_post_meta( $product_id, '_thc', true ) . $type;
		} else {
			// Do nothing.
		}
	} else {
		// Do nothing.
	}

	// THCA.
	if ( in_array( 'thca', $compound_array ) ) {
		if ( get_post_meta( $product_id, '_thca', true ) ) {
			$compounds['THCA'] = get_post_meta( $product_id, '_thca', true ) . $type;
		}
	} else {
		// Do nothing.
	}

	// CBD.
	if ( in_array( 'cbd', $compound_array ) ) {
		if ( get_post_meta( $product_id, '_cbd', true ) ) {
			$compounds['CBD'] = get_post_meta( $product_id, '_cbd', true ) . $type;
		} else {
			// Do nothing.
		}
	} else {
		// Do nothing.
	}

	// CBA.
	if ( in_array( 'cba', $compound_array ) ) {
		if ( get_post_meta( $product_id, '_cba', true ) ) {
			$compounds['CBA'] = get_post_meta( $product_id, '_cba', true ) . $type;
		} else {
			// Do nothing.
		}
	} else {
		// Do nothing.
	}

	// CBN.
	if ( in_array( 'cbn', $compound_array ) ) {
		if ( get_post_meta( $product_id, '_cbn', true ) ) {
			$compounds['CBN'] = get_post_meta( $product_id, '_cbn', true ) . $type;
		} else {
			// Do nothing.
		}
	} else {
		// Do nothing.
	}

	// CBG.
	if ( in_array( 'cbg', $compound_array ) ) {
		if ( get_post_meta( $product_id, '_cbg', true ) ) {
			$compounds['CBG'] = get_post_meta( $product_id, '_cbg', true ) . $type;
		} else {
			// Do nothing.
		}
	} else {
		// Do nothing.
	}

	return $compounds;
}

/**
 * Get all menu types
 *
 * @since 2.5
 * @return array
 */
function wpd_menu_types() {
	$menu_types = array(
		'wpd-flowers'      => __( 'Flowers', 'wp-dispensary' ),
		'wpd-concentrates' => __( 'Concentrates', 'wp-dispensary' ),
		'wpd-edibles'      => __( 'Edibles', 'wp-dispensary' ),
		'wpd-prerolls'     => __( 'Pre-rolls', 'wp-dispensary' ),
		'wpd-topicals'     => __( 'Topicals', 'wp-dispensary' ),
		'wpd-growers'      => __( 'Growers', 'wp-dispensary' ),
	);
	return apply_filters( 'wpd_menu_types', $menu_types );
}

/**
 * Get all menu types - Simple
 *
 * @since 2.5
 * @return array
 */
function wpd_menu_types_simple( $lowercase = NULL ) {

	// Get menu types.
	$menu_types = wpd_menu_types();

	// Create simple array.
	$menu_types_simple = array();

	// Loop through menu types.
	foreach ( $menu_types as $key=>$value ) {
		// Add items to simple array.
		if ( $lowercase ) {
			$menu_types_simple[] = str_replace( '-', '', strtolower( $value ) );
		} else {
			$menu_types_simple[] = $value;
		}
	}

	return apply_filters( 'wpd_menu_types_simple', $menu_types_simple );
}

/**
 * Update messages for product types.
 * 
 * @since 2.5
 */
function wpd_product_updated_messages( $messages ) {
	global $post;

	// Product ID.
	$product_id = $post->ID;

    if ( 'flowers' === get_post_type() ) {
        $messages['post'] = array(
            0 => '', // Unused. Messages start at index 1.
            1 => sprintf( __( 'Flower updated. <a href="%s">View flower</a>' ), esc_url( get_permalink( $product_id ) ) ),
            2 => __( 'Flower updated.', 'wp-dispensary' ),
            3 => __( 'Flower deleted.', 'wp-dispensary' ),
            4 => __( 'Flower updated.', 'wp-dispensary' ),
            5 => isset( $_GET['revision'] ) ? sprintf( __( 'Flower restored to revision from %s' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6 => sprintf( __( 'Flower published. <a href="%s">View flower</a>' ), esc_url( get_permalink( $product_id ) ) ),
            7 => __( 'Flower saved.', 'wp-dispensary' ),
            8 => sprintf( __( 'Flower submitted. <a target="_blank" href="%s">Preview flower</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $product_id ) ) ) ),
            9 => sprintf( __( 'Flower scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview flower</a>' ),
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $product_id ) ) ),
            10 => sprintf( __( 'Flower draft updated. <a target="_blank" href="%s">Preview flower</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $product_id ) ) ) ),
        );
    } elseif ( 'concentrates' === get_post_type() ) {
        $messages['post'] = array(
            0 => '', // Unused. Messages start at index 1.
            1 => sprintf( __( 'Concentrate updated. <a href="%s">View concentrate</a>' ), esc_url( get_permalink( $product_id ) ) ),
            2 => __( 'Concentrate updated.', 'wp-dispensary' ),
            3 => __( 'Concentrate deleted.', 'wp-dispensary' ),
            4 => __( 'Concentrate updated.', 'wp-dispensary' ),
            5 => isset( $_GET['revision'] ) ? sprintf( __( 'Concentrate restored to revision from %s' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6 => sprintf( __( 'Concentrate published. <a href="%s">View concentrate</a>' ), esc_url( get_permalink( $product_id ) ) ),
            7 => __( 'Concentrate saved.', 'wp-dispensary' ),
            8 => sprintf( __( 'Concentrate submitted. <a target="_blank" href="%s">Preview concentrate</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $product_id ) ) ) ),
            9 => sprintf( __( 'Concentrate scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview concentrate</a>' ),
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $product_id ) ) ),
            10 => sprintf( __( 'Concentrate draft updated. <a target="_blank" href="%s">Preview concentrate</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $product_id ) ) ) ),
        );
    } elseif ( 'edibles' === get_post_type() ) {
        $messages['post'] = array(
            0 => '', // Unused. Messages start at index 1.
            1 => sprintf( __( 'Edible updated. <a href="%s">View edible</a>' ), esc_url( get_permalink( $product_id ) ) ),
            2 => __( 'Edible updated.', 'wp-dispensary' ),
            3 => __( 'Edible deleted.', 'wp-dispensary' ),
            4 => __( 'Edible updated.', 'wp-dispensary' ),
            5 => isset( $_GET['revision'] ) ? sprintf( __( 'Edible restored to revision from %s' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6 => sprintf( __( 'Edible published. <a href="%s">View edible</a>' ), esc_url( get_permalink( $product_id ) ) ),
            7 => __( 'Edible saved.', 'wp-dispensary' ),
            8 => sprintf( __( 'Edible submitted. <a target="_blank" href="%s">Preview edible</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $product_id ) ) ) ),
            9 => sprintf( __( 'Edible scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview edible</a>' ),
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $product_id ) ) ),
            10 => sprintf( __( 'Edible draft updated. <a target="_blank" href="%s">Preview edible</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $product_id ) ) ) ),
        );
    } elseif ( 'prerolls' === get_post_type() ) {
        $messages['post'] = array(
            0 => '', // Unused. Messages start at index 1.
            1 => sprintf( __( 'Pre-roll updated. <a href="%s">View pre-roll</a>' ), esc_url( get_permalink( $product_id ) ) ),
            2 => __( 'Pre-roll updated.', 'wp-dispensary' ),
            3 => __( 'Pre-roll deleted.', 'wp-dispensary' ),
            4 => __( 'Pre-roll updated.', 'wp-dispensary' ),
            5 => isset( $_GET['revision'] ) ? sprintf( __( 'Pre-roll restored to revision from %s' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6 => sprintf( __( 'Pre-roll published. <a href="%s">View pre-roll</a>' ), esc_url( get_permalink( $product_id ) ) ),
            7 => __( 'Pre-roll saved.', 'wp-dispensary' ),
            8 => sprintf( __( 'Pre-roll submitted. <a target="_blank" href="%s">Preview pre-roll</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $product_id ) ) ) ),
            9 => sprintf( __( 'Pre-roll scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview pre-roll</a>' ),
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $product_id ) ) ),
            10 => sprintf( __( 'Pre-roll draft updated. <a target="_blank" href="%s">Preview pre-roll</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $product_id ) ) ) ),
        );
    } elseif ( 'topicals' === get_post_type() ) {
        $messages['post'] = array(
            0 => '', // Unused. Messages start at index 1.
            1 => sprintf( __( 'Topical updated. <a href="%s">View topical</a>' ), esc_url( get_permalink( $product_id ) ) ),
            2 => __( 'Topical updated.', 'wp-dispensary' ),
            3 => __( 'Topical deleted.', 'wp-dispensary' ),
            4 => __( 'Topical updated.', 'wp-dispensary' ),
            5 => isset( $_GET['revision'] ) ? sprintf( __( 'Topical restored to revision from %s' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6 => sprintf( __( 'Topical published. <a href="%s">View topical</a>' ), esc_url( get_permalink( $product_id ) ) ),
            7 => __( 'Topical saved.', 'wp-dispensary' ),
            8 => sprintf( __( 'Topical submitted. <a target="_blank" href="%s">Preview topical</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $product_id ) ) ) ),
            9 => sprintf( __( 'Topical scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview topical</a>' ),
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $product_id ) ) ),
            10 => sprintf( __( 'Topical draft updated. <a target="_blank" href="%s">Preview topical</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $product_id ) ) ) ),
        );
    } elseif ( 'growers' === get_post_type() ) {
        $messages['post'] = array(
            0 => '', // Unused. Messages start at index 1.
            1 => sprintf( __( 'Item updated. <a href="%s">View item</a>' ), esc_url( get_permalink( $product_id ) ) ),
            2 => __( 'Item updated.', 'wp-dispensary' ),
            3 => __( 'Item deleted.', 'wp-dispensary' ),
            4 => __( 'Item updated.', 'wp-dispensary' ),
            5 => isset( $_GET['revision'] ) ? sprintf( __( 'Item restored to revision from %s' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6 => sprintf( __( 'Item published. <a href="%s">View item</a>' ), esc_url( get_permalink( $product_id ) ) ),
            7 => __( 'Item saved.', 'wp-dispensary' ),
            8 => sprintf( __( 'Item submitted. <a target="_blank" href="%s">Preview item</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $product_id ) ) ) ),
            9 => sprintf( __( 'Item scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview item</a>' ),
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $product_id ) ) ),
            10 => sprintf( __( 'Item draft updated. <a target="_blank" href="%s">Preview item</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $product_id ) ) ) ),
        );
    } else {
		// Do nothing.
	}
    return $messages;
}
add_filter( 'post_updated_messages', 'wpd_product_updated_messages' );

/**
 * Get all flower weights.
 *
 * @since 2.5.2
 * @return array
 */
function wpd_flowers_weights_array() {
	$flowers_weights = array(
		'1 g'    => '_gram',
		'2 g'    => '_twograms',
		'1/8 oz' => '_eighth',
		'5 g'    => '_fivegrams',
		'1/4 oz' => '_quarter',
		'1/2 oz' => '_halfounce',
		'1 oz'   => '_ounce',
	);
	return apply_filters( 'wpd_flowers_weights_array', $flowers_weights );
}

/**
 * Get all concentrate weights.
 *
 * @since 2.5.2
 * @return array
 */
function wpd_concentrates_weights_array() {
	$concentrates_weights = array(
		'1/2 g' => '_halfgram',
		'1 g'   => '_gram',
		'2 g'   => '_twograms',
	);
	return apply_filters( 'wpd_concentrates_weights_array', $concentrates_weights );
}

/**
 * Get all featured image sizes
 *
 * @since    3.0
 * @return   array
 */
function wpd_featured_image_sizes() {
	$image_sizes = array(
		'wpdispensary-widget',
		'dispensary-image',
		'wpd-thumbnail',
		'wpd-small',
		'wpd-medium',
		'wpd-large',
	);
	return apply_filters( 'wpd_featured_image_sizes', $image_sizes );
}
