<?php
/**
 * The file that defines the pricing functions.
 *
 * @link       https://www.wpdispensary.com
 * @since      2.5
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes/functions
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
 * Flowers Prices - Simple
 *
 * @see get_wpd_flowers_prices_simple()
 * @since 2.4
 * @return string
 */
function wpd_flowers_prices_simple( $product_id = NULL, $phrase = NULL ) {
    // Filters the displayed flowers prices.
    echo apply_filters( 'wpd_flowers_prices_simple', get_wpd_flowers_prices_simple( $product_id, $phrase ) );
}


/**
 * Concentrates Prices - Simple
 *
 * @since 2.5
 * @return string
 */
function wpd_concentrates_prices_simple( $product_id = NULL, $phrase = NULL ) {
    // Filters the displayed concentrates prices.
    echo apply_filters( 'wpd_concentrates_prices_simple', get_wpd_concentrates_prices_simple( $product_id, $phrase ) );
}

/**
 * Tinctures Prices - Simple
 *
 * @see get_wpd_tinctures_prices_simple()
 * @since 2.4
 * @return string
 */
if ( ! function_exists( 'wpd_tinctures_prices_simple' ) ) {
	function wpd_tinctures_prices_simple( $product_id = NULL, $phrase = NULL ) {
		// Filters the displayed tinctures prices.
		echo apply_filters( 'wpd_tinctures_prices_simple', get_wpd_tinctures_prices_simple( $product_id, $phrase ) );
	}
}

/**
 * Edibles Prices - Simple
 *
 * @since 2.5
 * @return string
 */
function wpd_edibles_prices_simple( $product_id = NULL, $phrase = NULL ) {
    // Filters the displayed edibless prices.
    echo apply_filters( 'wpd_edibless_prices_simple', get_wpd_edibles_prices_simple( $product_id, $phrase ) );
}


/**
 * Pre-rolls Prices - Simple
 *
 * @since 2.5
 * @return string
 */
function wpd_prerolls_prices_simple( $product_id = NULL, $phrase = NULL ) {
    // Filters the displayed prerolls prices.
    echo apply_filters( 'wpd_prerolls_prices_simple', get_wpd_prerolls_prices_simple( $product_id, $phrase ) );
}


/**
 * Topicals Prices - Simple
 *
 * @since 2.5
 * @return string
 */
function wpd_topicals_prices_simple( $product_id = NULL, $phrase = NULL ) {
    // Filters the displayed topicals prices.
    echo apply_filters( 'wpd_topicals_prices_simple', get_wpd_topicals_prices_simple( $product_id, $phrase ) );
}


/**
 * Growers Prices - Simple
 *
 * @since 2.5
 * @return string
 */
function wpd_growers_prices_simple( $product_id = NULL, $phrase = NULL ) {
    // Filters the displayed growers prices.
    echo apply_filters( 'wpd_growers_prices_simple', get_wpd_growers_prices_simple( $product_id, $phrase ) );
}

/**
 * Gear Prices - Simple
 * 
 * @see get_wpd_gear_prices_simple()
 * @since 1.6
 * @return string
 */
if ( ! function_exists( 'get_wpd_gear_prices_simple' ) ) {
	function wpd_gear_prices_simple( $gear_id = NULL, $phrase = NULL ) {
		// Filters the displayed flowers prices.
		echo apply_filters( 'wpd_gear_prices_simple', get_wpd_gear_prices_simple( $gear_id, $phrase ) );
	}
}

/**
 * All Prices - Simple
 *
 * @since 2.5
 * @return string
 */
function wpd_all_prices_simple( $product_id = NULL, $phrase = NULL ) {

	if ( 'flowers' == get_post_meta( $product_id, 'product_type', true ) ) {
		echo apply_filters( 'wpd_flowers_prices_simple', get_wpd_flowers_prices_simple( $product_id, $phrase ) );
	}

	if ( 'concentrates' == get_post_meta( $product_id, 'product_type', true ) ) {
		echo apply_filters( 'wpd_concentrates_prices_simple', get_wpd_concentrates_prices_simple( $product_id, $phrase ) );
	}

	if ( 'edibles' == get_post_meta( $product_id, 'product_type', true ) ) {
		echo apply_filters( 'wpd_edibles_prices_simple', get_wpd_edibles_prices_simple( $product_id, $phrase ) );
	}

	if ( 'prerolls' == get_post_meta( $product_id, 'product_type', true ) ) {
		echo apply_filters( 'wpd_prerolls_prices_simple', get_wpd_prerolls_prices_simple( $product_id, $phrase ) );
	}

	if ( 'topicals' == get_post_meta( $product_id, 'product_type', true ) ) {
		echo apply_filters( 'wpd_topicals_prices_simple', get_wpd_topicals_prices_simple( $product_id, $phrase ) );
	}

	if ( 'growers' == get_post_meta( $product_id, 'product_type', true ) ) {
		echo apply_filters( 'wpd_growers_prices_simple', get_wpd_growers_prices_simple( $product_id, $phrase ) );
	}

	if ( 'gear' == get_post_meta( $product_id, 'product_type', true ) ) {
		echo apply_filters( 'wpd_gear_prices_simple', get_wpd_gear_prices_simple( $product_id, $phrase ) );
	}

	if ( 'tinctures' == get_post_meta( $product_id, 'product_type', true ) ) {
		echo apply_filters( 'wpd_tinctures_prices_simple', get_wpd_tinctures_prices_simple( $product_id, $phrase ) );
	}
}


/**
 * Pricing phrase
 *
 * @since 2.4
 * @return string
 */
function wpd_pricing_phrase( $singular ) {
	echo esc_html( apply_filters( 'wpd_pricing_phrase', get_wpd_pricing_phrase( $product_id, $phrase ) ) );
}

/**
 * Get Pricing phrase
 *
 * @since 2.4
 * @return string
 */
function get_wpd_pricing_phrase( $singular ) {
	// Access all WP Dispensary Display Settings.
	$wpd_settings = get_option( 'wpdas_display' );

	// Check pricing phrase settings.
	if ( isset ( $wpd_settings['wpd_pricing_phrase_custom'] ) && '' !== $wpd_settings['wpd_pricing_phrase_custom'] ) {
		$wpd_pricing_phrase = $wpd_settings['wpd_pricing_phrase_custom'];
	} elseif ( isset ( $wpd_settings['wpd_pricing_phrase'] ) && 'Donation' === $wpd_settings['wpd_pricing_phrase'] ) {
		if ( $singular == true ) {
			$wpd_pricing_phrase = esc_attr__( 'Donation', 'wp-dispensary' );
		} else {
			$wpd_pricing_phrase = esc_attr__( 'Donations', 'wp-dispensary' );
		}
	} else {
		if ( $singular == true ) {
			$wpd_pricing_phrase = esc_attr__( 'Price', 'wp-dispensary' );
		} else {
			$wpd_pricing_phrase = esc_attr__( 'Prices', 'wp-dispensary' );
		}
	}

	// Create filterable pricing phrase.
	$wpd_pricing_phrase = apply_filters( 'wpd_pricing_phrase', $wpd_pricing_phrase );

	// Return the pricing phrase.
	return $wpd_pricing_phrase;
}



/**
 * Flowers Prices - Get Simple
 *
 * @since 2.5
 * @return string
 */
function get_wpd_flowers_prices_simple( $product_id = NULL, $phrase = NULL ) {

    global $post;

    // Get currency code.
	$currency_code = wpd_currency_code();

	// Get prices.
	$price_half_gram     = get_post_meta( $product_id, 'price_half_gram', true );
	$price_one_gram      = get_post_meta( $product_id, 'price_gram', true );
	$price_two_grams     = get_post_meta( $product_id, 'price_two_grams', true );
	$price_eighth        = get_post_meta( $product_id, 'price_eighth', true );
	$price_five_grams    = get_post_meta( $product_id, 'price_five_grams', true );
	$price_quarter_ounce = get_post_meta( $product_id, 'price_quarter_ounce', true );
	$price_half_ounce    = get_post_meta( $product_id, 'price_half_ounce', true );
	$price_one_ounce     = get_post_meta( $product_id, 'price_ounce', true );

	/**
	 * Price output - if only one price has been added
	 */
	if ( '' === $price_two_grams && '' === $price_eighth && '' === $price_five_grams && '' === $price_quarter_ounce && '' === $price_half_ounce && '' === $price_one_ounce ) {
		$pricing = $currency_code . $price_one_gram;
	} elseif ( '' === $price_one_gram && '' === $price_eighth && '' === $price_five_grams && '' === $price_quarter_ounce && '' === $price_half_ounce && '' === $price_one_ounce ) {
		$pricing = $currency_code . $price_two_grams;
	} elseif ( '' === $price_one_gram && '' === $price_two_grams && '' === $price_five_grams && '' === $price_quarter_ounce && '' === $price_half_ounce && '' === $price_one_ounce ) {
		$pricing = $currency_code . $price_eighth;
	} elseif ( '' === $price_one_gram && '' === $price_two_grams && '' === $price_eighth && '' === $price_quarter_ounce && '' === $price_half_ounce && '' === $price_one_ounce ) {
		$pricing = $currency_code . $price_five_grams;
	} elseif ( '' === $price_one_gram && '' === $price_two_grams && '' === $price_eighth && '' === $price_five_grams && '' === $price_half_ounce && '' === $price_one_ounce ) {
		$pricing = $currency_code . $price_quarter_ounce;
	} elseif ( '' === $price_one_gram && '' === $price_two_grams && '' === $price_eighth && '' === $price_five_grams && '' === $price_quarter_ounce && '' === $price_one_ounce ) {
		$pricing = $currency_code . $price_half_ounce;
	} elseif ( '' === $price_one_gram && '' === $price_two_grams && '' === $price_eighth && '' === $price_five_grams && '' === $price_quarter_ounce && '' === $price_half_ounce ) {
		$pricing = $currency_code . $price_one_ounce;
	} else {
		$pricing = '';
	}

	/**
	 * Price output - if no prices have been added
	 */
	if ( '' === $price_one_gram && '' === $price_two_grams && '' === $price_eighth && '' === $price_five_grams && '' === $price_quarter_ounce && '' === $price_half_ounce && '' === $price_one_ounce ) {
		$pricing = ' ';
	}

	/**
	 * Price output - low amount
	 */
	$pricinglow = '';

	if ( get_post_meta( $product_id, 'price_gram', true ) ) {
		$pricinglow = $currency_code . $price_one_gram;
	} elseif ( get_post_meta( $product_id, 'price_two_grams', true ) ) {
		$pricinglow = $currency_code . $price_two_grams;
	} elseif ( get_post_meta( $product_id, 'price_eighth', true ) ) {
		$pricinglow = $currency_code . $price_eighth;
	} elseif ( get_post_meta( $product_id, 'price_five_grams', true ) ) {
		$pricinglow = $currency_code . $price_five_grams;
	} elseif ( get_post_meta( $product_id, 'price_quarter_ounce', true ) ) {
		$pricinglow = $currency_code . $price_quarter_ounce;
	} elseif ( get_post_meta( $product_id, 'price_half_ounce', true ) ) {
		$pricinglow = $currency_code . $price_half_ounce;
	} else {
		//Do nothing.
	}

	// Filter the low prices.
	$pricinglow = apply_filters( 'wpd_flowers_pricing_low', $pricinglow );

	// Separator.
	$pricingsep = '-';

	/**
	 * Price output - high amount
	 */
	$pricinghigh = '';

	if ( get_post_meta( $product_id, 'price_ounce', true ) ) {
		$pricinghigh = $currency_code . $price_one_ounce;
	} elseif ( get_post_meta( $product_id, 'price_half_ounce', true ) ) {
		$pricinghigh = $currency_code . $price_half_ounce;
	} elseif ( get_post_meta( $product_id, 'price_quarter_ounce', true ) ) {
		$pricinghigh = $currency_code . $price_quarter_ounce;
	} elseif ( get_post_meta( $product_id, 'price_five_grams', true ) ) {
		$pricinghigh = $currency_code . $price_five_grams;
	} elseif ( get_post_meta( $product_id, 'price_eighth', true ) ) {
		$pricinghigh = $currency_code . $price_eighth;
	} elseif ( get_post_meta( $product_id, 'price_two_grams', true ) ) {
		$pricinghigh = $currency_code . $price_two_grams;
	} elseif ( get_post_meta( $product_id, 'price_gram', true ) ) {
		$pricinghigh = $currency_code . $price_one_gram;
	} else {
		// Do nothing.
	}

	// Filter the high prices.
	$pricinghigh = apply_filters( 'wpd_flowers_pricing_high', $pricinghigh );

	if ( TRUE == $phrase ) {
		$pricing_phrase = '<strong>' . get_wpd_pricing_phrase( TRUE ) . ':</strong> ';
	} else {
		$pricing_phrase = '';
	}

	$phrase_lowhigh = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricinglow . $pricingsep . $pricinghigh . '</span>';
	$phrase_single  = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

	$phrase_final        = $phrase_lowhigh;
	$phrase_single_final = $phrase_single;

	/**
	 * Return Pricing Prices.
	 */
	if ( empty( $pricing ) ) {
		return $phrase_final;
	} elseif ( ' ' === $pricing ) {
		return '';
	} else {
		return $phrase_single_final;
	}

}


/**
 * Concentrates Prices - Get Simple
 *
 * @since 2.5
 * @return string
 */
function get_wpd_concentrates_prices_simple( $product_id = NULL, $phrase = NULL ) {

  global $post;

	// Get currency code.
	$currency_code = wpd_currency_code();

	// Get prices.
	$price_each      = get_post_meta( $product_id, 'price_each', true );
	$price_half_gram = get_post_meta( $product_id, 'price_half_gram', true );
	$price_one_gram  = get_post_meta( $product_id, 'price_gram', true );
	$price_two_grams = get_post_meta( $product_id, 'price_two_grams', true );

	/**
	 * Price output - if only one price has been added
	 */
	if ( '' === $price_one_gram && '' === $price_two_grams ) {
		$pricing = $currency_code . $price_half_gram;
	} elseif ( '' === $price_half_gram && '' === $price_two_grams ) {
		$pricing = $currency_code . $price_one_gram;
	} elseif ( '' === $price_half_gram && '' === $price_one_gram ) {
		$pricing = $currency_code . $price_two_grams;
	} else {
		$pricing = '';
	}

	/**
	 * Price output - if no prices have been added
	 */
	if ( '' === $price_half_gram && '' === $price_one_gram && '' === $price_two_grams ) {
		$pricing = ' ';
	}

	/**
	 * Price output - low amount
	 */
	$pricinglow = '';

	if ( get_post_meta( $product_id, 'price_half_gram', true ) ) {
		$pricinglow = $currency_code . $price_half_gram;
	} elseif ( get_post_meta( $product_id, 'price_gram', true ) ) {
		$pricinglow = $currency_code . $price_one_gram;
	} elseif ( get_post_meta( $product_id, 'price_two_grams', true ) ) {
		$pricinglow = $currency_code . $price_two_grams;
	} else {
		//Do nothing.
	}

	// Filter the low prices.
	$pricinglow = apply_filters( 'wpd_concentrates_pricing_low', $pricinglow );

	// Separator.
	$pricingsep = '-';

	/**
	 * Price output - high amount
	 */
	$pricinghigh = '';

	if ( get_post_meta( $product_id, 'price_two_grams', true ) ) {
		$pricinghigh = $currency_code . $price_two_grams;
	} elseif ( get_post_meta( $product_id, 'price_gram', true ) ) {
		$pricinghigh = $currency_code . $price_one_gram;
	} elseif ( get_post_meta( $product_id, 'price_half_gram', true ) ) {
		$pricinghigh = $currency_code . $price_half_gram;
	} else {
		// Do nothing.
	}

	// Filter the high prices.
	$pricinghigh = apply_filters( 'wpd_concentrates_pricing_high', $pricinghigh );

	/**
	 * Price output - if price each is filled in
	 */
	if ( '' != $price_each ) {
		$pricing = $currency_code . $price_each;
	}

	if ( TRUE == $phrase ) {
		$pricing_phrase = '<strong>' . get_wpd_pricing_phrase( TRUE ) . ':</strong> ';
	} else {
		$pricing_phrase = '';
	}

	$phrase_lowhigh = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricinglow . $pricingsep . $pricinghigh . '</span>';
	$phrase_single  = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

	$phrase_final        = $phrase_lowhigh;
	$phrase_single_final = $phrase_single;

	/**
	 * Return Pricing Prices.
	 */
	if ( empty( $pricing ) ) {
		return $phrase_final;
	} elseif ( ' ' === $pricing ) {
		return '';
	} else {
		return $phrase_single_final;
	}

}

/**
 * Tinctures Prices - Get Simple
 * 
 * @since 4.0
 */
if ( ! function_exists( 'get_wpd_tinctures_prices_simple' ) ) {
	function get_wpd_tinctures_prices_simple( $product_id, $phrase = NULL ) {

		global $post;

		// Get currency code.
		$currency_code = wpd_currency_code();

		// Get prices.
		$price_each     = get_post_meta( $product_id, 'price_each', true );
		$price_per_pack = get_post_meta( $product_id, 'price_per_pack', true );
		$pricingsep     = '-';

		// Check if phrase is set in function.
		if ( TRUE == $phrase ) {
			$pricing_phrase = '<strong>' . get_wpd_pricing_phrase( TRUE ) . ':</strong> ';
		} else {
			$pricing_phrase = '';
		}

		/**
		 * Price output - if only one price has been added
		 */
		if ( '' != $price_each && '' != $price_per_pack ) {

			$pricing = $currency_code . $price_each . $pricingsep . $price_per_pack;
			$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

		} elseif ( '' === $price_each && '' != $price_per_pack ) {

			$pricing = $currency_code . $price_per_pack;
			$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

		} elseif ( '' != $price_each && '' === $price_per_pack ) {

			$pricing = $currency_code . $price_each;
			$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

		} else {
			$phrase_final = '';
		}

		/**
		 * Return Pricing Prices.
		 */
		return $phrase_final;
	}
}

/**
 * Edibles Prices - Get Simple
 *
 * @since 2.5
 * @return string
 */
function get_wpd_edibles_prices_simple( $product_id = NULL, $phrase = NULL ) {

  global $post;

	// Get currency code.
	$currency_code = wpd_currency_code();

	// Get prices.
	$price_each     = get_post_meta( $product_id, 'price_each', true );
	$price_per_pack = get_post_meta( $product_id, 'price_per_pack', true );
	$pricingsep     = '-';

	// Set empty variables.
	$pricing_phrase = '';
	$phrase_final   = '';

	// Check if phrase is set in function.
	if ( TRUE == $phrase ) {
		$pricing_phrase = '<strong>' . get_wpd_pricing_phrase( TRUE ) . ':</strong> ';
	}

	/**
	 * Price output
	 */
	if ( '' != $price_each && '' != $price_per_pack ) {

		$pricing = $currency_code . $price_each . $pricingsep . $price_per_pack;
		$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

	} elseif ( '' === $price_each && '' != $price_per_pack ) {

		$pricing = $currency_code . $price_per_pack;
		$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

	} elseif ( '' != $price_each && '' === $price_per_pack ) {

		$pricing = $currency_code . $price_each;
		$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

	} else {
		// Do nothing.
	}

	/**
	 * Return Pricing Prices.
	 */
	return $phrase_final;

}


/**
 * Pre-rolls Prices - Get Simple
 *
 * @since 2.5
 * @return string
 */
function get_wpd_prerolls_prices_simple( $product_id = NULL, $phrase = NULL ) {

	global $post;

	// Get currency code.
	$currency_code = wpd_currency_code();

	// Get prices.
	$price_each     = get_post_meta( $product_id, 'price_each', true );
	$price_per_pack = get_post_meta( $product_id, 'price_per_pack', true );
	$pricingsep     = '-';

	// Check if phrase is set in function.
	if ( TRUE == $phrase ) {
		$pricing_phrase = '<strong>' . get_wpd_pricing_phrase( TRUE ) . ':</strong> ';
	} else {
		$pricing_phrase = '';
	}

	/**
	 * Price output - if only one price has been added
	 */
	if ( '' != $price_each && '' != $price_per_pack ) {

		$pricing = $currency_code . $price_each . $pricingsep . $price_per_pack;
		$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

	} elseif ( '' === $price_each && '' != $price_per_pack ) {

		$pricing = $currency_code . $price_per_pack;
		$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

	} elseif ( '' != $price_each && '' === $price_per_pack ) {

		$pricing = $currency_code . $price_each;
		$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

	} else {
		$phrase_final = '';
	}

	/**
	 * Return Pricing Prices.
	 */
	return $phrase_final;

}


/**
 * Topicals Prices - Get Simple
 *
 * @since 2.5
 * @return string
 */
function get_wpd_topicals_prices_simple( $product_id = NULL, $phrase = NULL ) {

	global $post;

	// Get currency code.
	$currency_code = wpd_currency_code();

	// Get prices.
	$price_each     = get_post_meta( $product_id, 'price_each', true );
	$price_per_pack = get_post_meta( $product_id, 'price_per_pack', true );
	$pricingsep     = '-';

	// Check if phrase is set in function.
	if ( TRUE == $phrase ) {
		$pricing_phrase = '<strong>' . get_wpd_pricing_phrase( TRUE ) . ':</strong> ';
	} else {
		$pricing_phrase = '';
	}

	/**
	 * Price output - if only one price has been added
	 */
	if ( '' != $price_each && '' != $price_per_pack ) {

		$pricing = $currency_code . $price_each . $pricingsep . $price_per_pack;
		$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

	} elseif ( '' === $price_each && '' != $price_per_pack ) {

		$pricing = $currency_code . $price_per_pack;
		$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

	} elseif ( '' != $price_each && '' === $price_per_pack ) {

		$pricing = $currency_code . $price_each;
		$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

	} else {
		$phrase_final = '';
	}

	/**
	 * Return Pricing Prices.
	 */
	return $phrase_final;

}


/**
 * Growers Prices - Get Simple
 *
 * @since 2.5
 * @return string
 */
function get_wpd_growers_prices_simple( $product_id = NULL, $phrase = NULL ) {

	global $post;

	// Get currency code.
	$currency_code = wpd_currency_code();

	// Get prices.
	$price_each     = get_post_meta( $product_id, 'price_each', true );
	$price_per_pack = get_post_meta( $product_id, 'price_per_pack', true );
	$pricingsep     = '-';

	// Check if phrase is set in function.
	if ( TRUE == $phrase ) {
		$pricing_phrase = '<strong>' . get_wpd_pricing_phrase( TRUE ) . ':</strong> ';
	} else {
		$pricing_phrase = '';
	}

	/**
	 * Price output - if only one price has been added
	 */
	if ( '' != $price_each && '' != $price_per_pack ) {

		$pricing = $currency_code . $price_each . $pricingsep . $price_per_pack;
		$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

	} elseif ( '' === $price_each && '' != $price_per_pack ) {

		$pricing = $currency_code . $price_per_pack;
		$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

	} elseif ( '' != $price_each && '' === $price_per_pack ) {

		$pricing = $currency_code . $price_each;
		$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

	} else {
		$phrase_final = '';
	}

	/**
	 * Return Pricing Prices.
	 */
	return $phrase_final;

}

/**
 * Gear Prices - Get Simple
 * 
 * @since 4.0
 */
if ( ! function_exists( 'get_wpd_gear_prices_simple' ) ) {
	function get_wpd_gear_prices_simple( $product_id, $phrase = NULL ) {
		// Get currency code.
		$currency_code = wpd_currency_code();

		// Get prices.
		$price_each     = get_post_meta( $product_id, 'price_each', TRUE );
		$price_per_pack = get_post_meta( $product_id, 'price_per_pack', TRUE );
		$pricingsep     = '-';

		// Check if phrase is set in function.
		if ( TRUE == $phrase ) {
			$pricing_phrase = '<strong>' . get_wpd_pricing_phrase( TRUE ) . ':</strong> ';
		} else {
			$pricing_phrase = '';
		}

		/**
		 * Price output - if only one price has been added
		 */
		if ( '' != $price_each && '' != $price_per_pack ) {

			$pricing      = $currency_code . $price_each . $pricingsep . $price_per_pack;
			$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

		} elseif ( '' === $price_each && '' != $price_per_pack ) {

			$pricing      = $currency_code . $price_per_pack;
			$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

		} elseif ( '' != $price_each && '' === $price_per_pack ) {

			$pricing      = $currency_code . $price_each;
			$phrase_final = '<span class="wpd-productinfo pricing">' . $pricing_phrase . $pricing . '</span>';

		} else {
			$phrase_final = '';
		}

		/**
		 * Return Pricing Prices.
		 */
		return $phrase_final;
	}
}

/**
 * All Prices - Simple
 *
 * @since  2.5
 * @return string
 */
function get_wpd_all_prices_simple( $product_id = NULL, $phrase = NULL ) {

	$str = '';

	if ( 'flowers' == get_post_meta( $product_id, 'product_type', true ) ) {
		$str .= apply_filters( 'wpd_flowers_prices_simple', get_wpd_flowers_prices_simple( $product_id, $phrase ) );
	}

	if ( 'concentrates' == get_post_meta( $product_id, 'product_type', true ) ) {
		$str .= apply_filters( 'wpd_concentrates_prices_simple', get_wpd_concentrates_prices_simple( $product_id, $phrase ) );
	}

	if ( 'edibles' == get_post_meta( $product_id, 'product_type', true ) ) {
		$str .= apply_filters( 'wpd_edibles_prices_simple', get_wpd_edibles_prices_simple( $product_id, $phrase ) );
	}

	if ( 'prerolls' == get_post_meta( $product_id, 'product_type', true ) ) {
		$str .= apply_filters( 'wpd_prerolls_prices_simple', get_wpd_prerolls_prices_simple( $product_id, $phrase ) );
	}

	if ( 'topicals' == get_post_meta( $product_id, 'product_type', true ) ) {
		$str .= apply_filters( 'wpd_topicals_prices_simple', get_wpd_topicals_prices_simple( $product_id, $phrase ) );
	}

	if ( 'growers' == get_post_meta( $product_id, 'product_type', true ) ) {
		$str .= apply_filters( 'wpd_growers_prices_simple', get_wpd_growers_prices_simple( $product_id, $phrase ) );
	}

	if ( 'gear' == get_post_meta( $product_id, 'product_type', true ) ) {
		$str .= apply_filters( 'wpd_gear_prices_simple', get_wpd_gear_prices_simple( $product_id, $phrase ) );
	}

	if ( 'tinctures' == get_post_meta( $product_id, 'product_type', true ) ) {
		$str .= apply_filters( 'wpd_tinctures_prices_simple', get_wpd_tinctures_prices_simple( $product_id, $phrase ) );
	}

	return apply_filters( 'get_wpd_all_prices_simple', $str );
}

/**
 * Get all flower prices.
 *
 * @since  2.5
 * @return array
 */
function wpd_flowers_prices_array( $product_id, $flower_prices = NULL ) {
	$flower_prices = array(
		'1 g'    => esc_html( get_post_meta( $product_id, 'price_gram', true ) ),
		'2 g'    => esc_html( get_post_meta( $product_id, 'price_two_grams', true ) ),
		'1/8 oz' => esc_html( get_post_meta( $product_id, 'price_eighth', true ) ),
		'5 g'    => esc_html( get_post_meta( $product_id, 'price_five_grams', true ) ),
		'1/4 oz' => esc_html( get_post_meta( $product_id, 'price_quarter_ounce', true ) ),
		'1/2 oz' => esc_html( get_post_meta( $product_id, 'price_half_ounce', true ) ),
		'1 oz'   => esc_html( get_post_meta( $product_id, 'price_ounce', true ) ),
	);
	return apply_filters( 'wpd_flowers_prices_array', $flower_prices );
}


/**
 * Get all concentrates prices.
 *
 * @since  3.4
 * @return array
 */
function wpd_concentrates_prices_array( $product_id, $concentrates_prices = NULL ) {
	$concentrates_prices = array(
		'1/2 g' => esc_html( get_post_meta( $product_id, 'price_half_gram', true ) ),
		'1 g'   => esc_html( get_post_meta( $product_id, 'price_gram', true ) ),
		'2 g'   => esc_html( get_post_meta( $product_id, 'price_two_grams', true ) ),
	);
	return apply_filters( 'wpd_concentrates_prices_array', $concentrates_prices );
}

/**
 * Product prices.
 * 
 * @since  4.0
 * @param  string $product_type
 * @return array
 */
function wpd_product_prices( $product_type = '' ) {
	// General prices.
	if ( empty( $product_type ) || in_array( $product_type, apply_filters( 'wpd_general_product_prices', array( 'edibles', 'prerolls', 'topicals', 'growers', 'gear', 'tinctures' ) ) ) ) {
		// Product prices array.
		$product_prices = array(
			'price_each'          => __( 'Price per unit', 'wp-dispensary' ),
			'price_per_pack'      => __( 'Price per pack', 'wp-dispensary' ),
			'units_per_pack'      => __( 'Units per pack', 'wp-dispensary' ),
		);
	}
	// Flowers prices.
	if ( 'flowers' == $product_type ) {
		// Product prices array.
		$product_prices = array(
			'price_gram'          => __( '1 g', 'wp-dispensary' ),
			'price_two_grams'     => __( '2 g', 'wp-dispensary' ),
			'price_eighth'        => __( '1/8 oz', 'wp-dispensary' ),
			'price_five_grams'    => __( '5 g', 'wp-dispensary' ),
			'price_quarter_ounce' => __( '1/4 oz', 'wp-dispensary' ),
			'price_half_ounce'    => __( '1/2 oz', 'wp-dispensary' ),
			'price_ounce'         => __( '1 oz', 'wp-dispensary' )
		);
		// Filter flower prices.
		$product_prices = apply_filters( 'wpd_flowers_product_prices', $product_prices );
	}
	// Concentrates prices.
	if ( 'concentrates' == $product_type ) {
		// Product prices array.
		$product_prices = array(
			'price_each'          => __( 'Price per unit', 'wp-dispensary' ),
			'price_per_pack'      => __( 'Price per pack', 'wp-dispensary' ),
			'units_per_pack'      => __( 'Units per pack', 'wp-dispensary' ),
			'price_half_gram'     => __( '1/2 gram', 'wp-dispensary' ),
			'price_gram'          => __( '1 g', 'wp-dispensary' ),
			'price_two_grams'     => __( '2 g', 'wp-dispensary' ),
		);
		// Filter concentrates prices.
		$product_prices = apply_filters( 'wpd_concentrates_product_prices', $product_prices );
	}
	// Filter the product prices.
	$product_prices = apply_filters( 'wpd_product_prices', $product_prices );

	return $product_prices;
}

/**
 * Product prices array
 * 
 * @since  4.0
 * @param  int    $product_id
 * @param  string $product_type
 * @return array
 */
function wpd_product_prices_array( $product_id = NULL, $product_type = '' ) {
	// Bail early?
	if ( ! $product_id ) { return; }

	// General prices.
	if ( empty( $product_type ) || in_array( $product_type, apply_filters( 'wpd_general_product_prices', array( 'edibles', 'prerolls', 'topicals', 'growers', 'gear', 'tinctures' ) ) ) ) {
		// Product prices array.
		$product_prices = array(
			'price_per_unit' => esc_html( get_post_meta( $product_id, 'price_per_unit', true ) ),
			'price_per_pack' => esc_html( get_post_meta( $product_id, 'price_per_pack', true ) ),
			'units_per_pack' => esc_html( get_post_meta( $product_id, 'units_per_pack', true ) ),
		);
	}
	// Flowers prices.
	if ( 'flowers' == $product_type ) {
		// Product prices array.
		$product_prices = array(
			'price_gram'          => esc_html( get_post_meta( $product_id, 'price_gram', true ) ),
			'price_two_grams'     => esc_html( get_post_meta( $product_id, 'price_two_grams', true ) ),
			'price_eighth'        => esc_html( get_post_meta( $product_id, 'price_eighth', true ) ),
			'price_five_grams'    => esc_html( get_post_meta( $product_id, 'price_five_grams', true ) ),
			'price_quarter_ounce' => esc_html( get_post_meta( $product_id, 'price_quarter_ounce', true ) ),
			'price_half_ounce'    => esc_html( get_post_meta( $product_id, 'price_half_ounce', true ) ),
			'price_ounce'         => esc_html( get_post_meta( $product_id, 'price_ounce', true ) ),
		);
		// Filter flower prices.
		$product_prices = apply_filters( 'wpd_flowers_product_prices', $product_prices );
	}
	// Concentrates prices.
	if ( 'concentrates' == $product_type ) {
		// Product prices array.
		$product_prices = array(
			'price_half_gram' => esc_html( get_post_meta( $product_id, 'price_half_gram', true ) ),
			'price_gram'      => esc_html( get_post_meta( $product_id, 'price_gram', true ) ),
			'price_two_grams' => esc_html( get_post_meta( $product_id, 'price_two_grams', true ) ),
		);
		// Filter concentrates prices.
		$product_prices = apply_filters( 'wpd_concentrates_product_prices', $product_prices );
	}
	// Filter the product prices.
	$product_prices = apply_filters( 'wpd_product_prices', $product_prices );

	return $product_prices;
}