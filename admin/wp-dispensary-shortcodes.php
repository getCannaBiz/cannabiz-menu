<?php
/**
 * Adding the Shortcodes for easy output of content
 * within any theme
 *
 * @link       https://www.wpdispensary.com
 * @since      1.2.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

/**
 * Shortcode images
 */
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'dispensary-image', 360, 250, true );
	add_image_size( 'wpd-large', 1200, 1200, true );
	add_image_size( 'wpd-medium', 800, 800, true );
	add_image_size( 'wpd-small', 400, 400, true );
}

/**
 * Flowers Shortcode Fuction
 *
 * @access public
 *
 * @return string HTML markup.
 */
function wpdispensary_flowers_shortcode( $atts ) {

	/* Attributes */
	extract( shortcode_atts(
		array(
			'posts'     => '100',
			'class'     => '',
			'name'      => 'show',
			'info'      => 'show',
			'thc'       => 'show',
			'thca'      => '',
			'cbd'       => 'show',
			'cba'       => '',
			'cbn'       => '',
			'title'     => 'Flowers',
			'category'  => '',
			'aroma'     => '',
			'flavor'    => '',
			'effect'    => '',
			'symptom'   => '',
			'condition' => '',
			'vendor'    => '',
			'orderby'   => '',
			'image'     => 'show',
			'imgsize'   => 'dispensary-image',
		),
		$atts,
		'wpd_flowers'
	) );

	/**
	 * Code to create shortcode for Flowers
	 */
	$tax_query = array(
		'relation' => 'AND',
	);
	if ( '' !== $aroma ) {
			$tax_query[] = array(
				'taxonomy' => 'aroma',
				'field'    => 'slug',
				'terms'    => $aroma,
			);
	}
	if ( '' !== $flavor ) {
			$tax_query[] = array(
				'taxonomy' => 'flavor',
				'field'    => 'slug',
				'terms'    => $flavor,
			);
	}
	if ( '' !== $effect ) {
			$tax_query[] = array(
				'taxonomy' => 'effect',
				'field'    => 'slug',
				'terms'    => $effect,
			);
	}
	if ( '' !== $symptom ) {
			$tax_query[] = array(
				'taxonomy' => 'symptom',
				'field'    => 'slug',
				'terms'    => $symptom,
			);
	}
	if ( '' !== $condition ) {
			$tax_query[] = array(
				'taxonomy' => 'condition',
				'field'    => 'slug',
				'terms'    => $condition,
			);
	}
	if ( '' !== $vendor ) {
			$tax_query[] = array(
				'taxonomy' => 'vendor',
				'field'    => 'slug',
				'terms'    => $vendor,
			);
	}
	if ( '' !== $orderby ) {
			$order    = $orderby;
			$ordernew = 'ASC';
	}
	$args = apply_filters( 'wpd_flowers_shortcode_args', array(
		'post_type'        => 'flowers',
		'posts_per_page'   => $posts,
		'flowers_category' => $category,
		'tax_query'        => $tax_query,
		'orderby'          => $order,
		'order'            => $ordernew,
	) );

	$wpdquery = new WP_Query( $args );

	$wpdposts = '<div class="wpdispensary"><h2 class="wpd-title">' . $title . '</h2>';

	while ( $wpdquery->have_posts() ) :
		$wpdquery->the_post();

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		$thumbnail_id        = get_post_thumbnail_id();
		$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $imagesize, false );
		$thumbnail_url       = $thumbnail_url_array[0];
		$querytitle          = get_the_title();

		/** Get the pricing for Flowers */

		$priceGram      = get_post_meta( get_the_ID(), '_gram', true );
		$priceEighth    = get_post_meta( get_the_ID(), '_eighth', true );
		$priceQuarter   = get_post_meta( get_the_ID(), '_quarter', true );
		$priceHalfOunce = get_post_meta( get_the_ID(), '_halfounce', true );
		$priceOunce     = get_post_meta( get_the_ID(), '_ounce', true );

		$wp_dispensary_options = get_option( 'wp_dispensary_option_name' ); // Array of All Options.
		if ( ! isset( $wp_dispensary_options['wpd_hide_details'] ) ) {
			$wpd_hide_details = '';
		} else {
			$wpd_hide_details = $wp_dispensary_options['wpd_hide_details'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_hide_pricing'] ) ) {
			$wpd_hide_pricing = '';
		} else {
			$wpd_hide_pricing = $wp_dispensary_options['wpd_hide_pricing'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_content_placement'] ) ) {
			$wpd_content_placement = '';
		} else {
			$wpd_content_placement = $wp_dispensary_options['wpd_content_placement'];
		}
		if ( null === $wp_dispensary_options['wpd_currency'] ) {
			$wpd_currency = 'USD';
		} else {
			$wpd_currency = $wp_dispensary_options['wpd_currency'];
		}
		if ( null === $wp_dispensary_options['wpd_cost_phrase'] ) {
			$wpd_cost_phrase = 'Price';
		} else {
			$wpd_cost_phrase = $wp_dispensary_options['wpd_cost_phrase']; // costphrase.
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

		if ( '' === $priceEighth && '' === $priceQuarter && '' === $priceHalfOunce && '' === $priceOunce ) {
			$pricing = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_gram', true ) . ' per gram';
		} elseif ( '' === $priceGram && '' === $priceQuarter && '' === $priceHalfOunce && '' === $priceOunce ) {
			$pricing = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_eighth', true ) . ' per eighth';
		} elseif ( '' === $priceGram && '' === $priceEighth && '' === $priceHalfOunce && '' === $priceOunce ) {
			$pricing = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_quarter', true ) . ' per quarter ounce';
		} elseif ( '' === $priceGram && '' === $priceEighth && '' === $priceQuarter && '' === $priceOunce ) {
			$pricing = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_halfounce', true ) . ' per half ounce';
		} elseif ( '' === $priceGram && '' === $priceEighth && '' === $priceQuarter && '' === $priceHalfOunce ) {
			$pricing = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_ounce', true ) . ' per ounce';
		} else {
			$pricing = '';
		}

		if ( '' === $priceGram && '' === $priceEighth && '' === $priceQuarter && '' === $priceHalfOunce && '' === $priceOunce ) {
			$pricing = ' ';
		}

		if ( get_post_meta( get_the_ID(), '_gram', true ) ) {
			$pricinglow = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_gram', true );
		} elseif ( get_post_meta( get_the_ID(), '_eighth', true ) ) {
			$pricinglow = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_eighth', true );
		} elseif ( get_post_meta( get_the_ID(), '_quarter', true ) ) {
			$pricinglow = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_quarter', true );
		} elseif ( get_post_meta( get_the_ID(), '_halfounce', true ) ) {
			$pricinglow = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_halfounce', true );
		}

		$pricingsep = ' - ';

		if ( get_post_meta( get_the_ID(), '_ounce', true ) ) {
			$pricinghigh = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_ounce', true );
		} elseif ( get_post_meta( get_the_ID(), '_halfounce', true ) ) {
			$pricinghigh = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_halfounce', true );
		} elseif ( get_post_meta( get_the_ID(), '_quarter', true ) ) {
			$pricinghigh = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_quarter', true );
		} elseif ( get_post_meta( get_the_ID(), '_eighth', true ) ) {
			$pricinghigh = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_eighth', true );
		} elseif ( get_post_meta( get_the_ID(), '_gram', true ) ) {
			$pricinghigh = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_gram', true );
		}

		if ( get_post_meta( get_the_ID(), '_thc', true ) ) {
			$thcinfo = '<span class="wpd-productinfo thc"><strong>THC: </strong>' . get_post_meta( get_the_id(), '_thc', true ) . '%</span>';
		} else {
			$thcinfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_thca', true ) ) {
			$thcainfo = '<span class="wpd-productinfo thca"><strong>THCA: </strong>' . get_post_meta( get_the_id(), '_thca', true ) . '%</span>';
		} else {
			$thcainfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbd', true ) ) {
			$cbdinfo = '<span class="wpd-productinfo cbd"><strong>CBD: </strong>' . get_post_meta( get_the_id(), '_cbd', true ) . '%</span>';
		} else {
			$cbdinfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_cba', true ) ) {
			$cbainfo = '<span class="wpd-productinfo cba"><strong>CBA: </strong>' . get_post_meta( get_the_id(), '_cba', true ) . '%</span>';
		} else {
			$cbainfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbn', true ) ) {
			$cbninfo = '<span class="wpd-productinfo cbn"><strong>CBN: </strong>' . get_post_meta( get_the_id(), '_cbn', true ) . '%</span>';
		} else {
			$cbninfo = '';
		}

		/** Check shortcode options input by user */

		if ( 'show' === $name ) {
			$showname = '<p class="wpd-producttitle"><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( 'show' === $info ) {
			if ( empty( $pricing ) ) {
				$showinfo = '<span class="wpd-productinfo pricing"><strong>' . $wpd_cost_phrase . ':</strong> ' . $pricinglow . '' . $pricingsep . '' . $pricinghigh . '</span>';
			} elseif ( ' ' === $pricing ) {
				$showinfo = ' ';
			} else {
				$showinfo = '<span class="wpd-productinfo pricing"><strong>' . $wpd_cost_phrase . ':</strong> ' . $pricing . '</span>';
			}
		} else {
			$showinfo = '';
		}

		if ( 'show' === $thc ) {
			$showthc = $thcinfo;
		} else {
			$showthc = '';
		}

		if ( 'show' === $thca ) {
			$showthca = $thcainfo;
		} else {
			$showthca = '';
		}

		if ( 'show' === $cbd ) {
			$showcbd = $cbdinfo;
		} else {
			$showcbd = '';
		}

		if ( 'show' === $cba ) {
			$showcba = $cbainfo;
		} else {
			$showcba = '';
		}

		if ( 'show' === $cbn ) {
			$showcbn = $cbninfo;
		} else {
			$showcbn = '';
		}

		if ( 'show' === $image ) {
			if ( null !== $thumbnail_url ) {
				$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="Menu - Flower" /></a>';
			} else {
				$wpd_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
				$defaultimg        = apply_filters( 'wpd_default_image', $wpd_default_image );
				$showimage         = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="Menu - Flower" /></a>';
			}
		} else {
			$showimage = '';
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_shortcode_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_flowers' );
			$wpd_shortcode_top_flowers = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-flowers ' . $class . '">' . $wpd_shortcode_top_flowers . '' . $wpd_shortcode_inside_top . '' . $showimage;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_flowers' );
			$wpd_shortcode_bottom_flowers = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . '' . $showinfo . '' . $showthc . '' . $showthca . '' . $showcbd . '' . $showcba . '' . $showcbn . '' . $wpd_shortcode_inside_bottom . '' . $wpd_shortcode_bottom_flowers . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';

}
add_shortcode( 'wpd-flowers', 'wpdispensary_flowers_shortcode' );

/**
 * Concentrates Shortcode Function
 */
function wpdispensary_concentrates_shortcode( $atts ) {

	/** Attributes */
	extract( shortcode_atts(
		array(
			'posts'     => '100',
			'class'     => '',
			'name'      => 'show',
			'info'      => 'show',
			'thc'       => 'show',
			'thca'      => '',
			'cbd'       => 'show',
			'cba'       => '',
			'cbn'       => '',
			'title'     => 'Concentrates',
			'category'  => '',
			'aroma'     => '',
			'flavor'    => '',
			'effect'    => '',
			'symptom'   => '',
			'condition' => '',
			'vendor'    => '',
			'orderby'   => '',
			'image'     => 'show',
			'imgsize'   => 'dispensary-image',
		),
		$atts,
		'wpd_concentrates'
	) );

	/**
	 * Code to create shortcode for Concentrates
	 */
	$tax_query = array(
		'relation' => 'AND',
	);
	if ( '' !== $aroma ) {
			$tax_query[] = array(
				'taxonomy' => 'aroma',
				'field'    => 'slug',
				'terms'    => $aroma,
			);
	}
	if ( '' !== $flavor ) {
			$tax_query[] = array(
				'taxonomy' => 'flavor',
				'field'    => 'slug',
				'terms'    => $flavor,
			);
	}
	if ( '' !== $effect ) {
			$tax_query[] = array(
				'taxonomy' => 'effect',
				'field'    => 'slug',
				'terms'    => $effect,
			);
	}
	if ( '' !== $symptom ) {
			$tax_query[] = array(
				'taxonomy' => 'symptom',
				'field'    => 'slug',
				'terms'    => $symptom,
			);
	}
	if ( '' !== $condition ) {
			$tax_query[] = array(
				'taxonomy' => 'condition',
				'field'    => 'slug',
				'terms'    => $condition,
			);
	}
	if ( '' !== $vendor ) {
			$tax_query[] = array(
				'taxonomy' => 'vendor',
				'field'    => 'slug',
				'terms'    => $vendor,
			);
	}
	if ( '' !== $orderby ) {
			$order    = $orderby;
			$ordernew = 'ASC';
	}

	$args = apply_filters( 'wpd_concentrates_shortcode_args', array(
		'post_type'             => 'concentrates',
		'posts_per_page'        => $posts,
		'concentrates_category' => $category,
		'tax_query'             => $tax_query,
		'orderby'               => $order,
		'order'                 => $ordernew,
	) );

	$wpdquery = new WP_Query( $args );

	$wpdposts = '<div class="wpdispensary"><h2 class="wpd-title">' . $title . '</h2>';

	while ( $wpdquery->have_posts() ) :
		$wpdquery->the_post();

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		$thumbnail_id        = get_post_thumbnail_id();
		$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $imagesize, false );
		$thumbnail_url       = $thumbnail_url_array[0];
		$querytitle          = get_the_title();

		$wp_dispensary_options = get_option( 'wp_dispensary_option_name' ); // Array of All Options.
		if ( ! isset( $wp_dispensary_options['wpd_hide_details'] ) ) {
			$wpd_hide_details = '';
		} else {
			$wpd_hide_details = $wp_dispensary_options['wpd_hide_details'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_hide_pricing'] ) ) {
			$wpd_hide_pricing = '';
		} else {
			$wpd_hide_pricing = $wp_dispensary_options['wpd_hide_pricing'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_content_placement'] ) ) {
			$wpd_content_placement = '';
		} else {
			$wpd_content_placement = $wp_dispensary_options['wpd_content_placement'];
		}
		if ( null === $wp_dispensary_options['wpd_currency'] ) {
			$wpd_currency = 'USD';
		} else {
			$wpd_currency = $wp_dispensary_options['wpd_currency'];
		}
		if ( null === $wp_dispensary_options['wpd_cost_phrase'] ) {
			$wpd_cost_phrase = 'Price';
		} else {
			$wpd_cost_phrase = $wp_dispensary_options['wpd_cost_phrase']; // costphrase.
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

		/** Get the pricing for Concentrates */

		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$pricingeach = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_priceeach', true );
			$pricingname = '<strong>Price: </strong>';
		} else {
			$pricingeach = '';
		}

		if ( get_post_meta( get_the_ID(), '_halfgram', true ) ) {
			$halfgram = '<span class="wpd-productinfo"><strong>1/2g: </strong>' . $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_halfgram', true ) . '</span>';
		} else {
			$halfgram = '';
		}

		if ( get_post_meta( get_the_ID(), '_gram', true ) ) {
			$gram = '<span class="wpd-productinfo"><strong>1g: </strong>' . $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_gram', true ) . '</span>';
		} else {
			$gram = '';
		}

		if ( get_post_meta( get_the_ID(), '_twograms', true ) ) {
			$twograms = '<span class="wpd-productinfo"><strong>2g: </strong>' . $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_twograms', true ) . '</span>';
		} else {
			$twograms = '';
		}

		$pricingsep = ' - ';

		if ( get_post_meta( get_the_ID(), '_thc', true ) ) {
			$thcinfo = '<span class="wpd-productinfo thc"><strong>THC: </strong>' . get_post_meta( get_the_id(), '_thc', true ) . '%</span>';
		} else {
			$thcinfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_thca', true ) ) {
			$thcainfo = '<span class="wpd-productinfo thca"><strong>THCA: </strong>' . get_post_meta( get_the_id(), '_thca', true ) . '%</span>';
		} else {
			$thcainfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbd', true ) ) {
			$cbdinfo = '<span class="wpd-productinfo cbd"><strong>CBD: </strong>' . get_post_meta( get_the_id(), '_cbd', true ) . '%</span>';
		} else {
			$cbdinfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_cba', true ) ) {
			$cbainfo = '<span class="wpd-productinfo cba"><strong>CBA: </strong>' . get_post_meta( get_the_id(), '_cba', true ) . '%</span>';
		} else {
			$cbainfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbn', true ) ) {
			$cbninfo = '<span class="wpd-productinfo cbn"><strong>CBN: </strong>' . get_post_meta( get_the_id(), '_cbn', true ) . '%</span>';
		} else {
			$cbninfo = '';
		}

		/** Check shortcode options input by user */

		if ( 'show' === $name ) {
			$showname = '<p class="wpd-producttitle"><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( 'show' === $info ) {
			if ( empty( $pricingeach ) ) {
				$showinfo = $halfgram . '' . $gram . '' . $twograms;
			} else {
				$showinfo = '<span class="wpd-productinfo pricing">' . $pricingname . '' . $pricingeach . '</span>';
			}
		} else {
			$showinfo = '';
		}

		if ( 'show' === $thc ) {
			$showthc = $thcinfo;
		} else {
			$showthc = '';
		}

		if ( 'show' === $thca ) {
			$showthca = $thcainfo;
		} else {
			$showthca = '';
		}

		if ( 'show' === $cbd ) {
			$showcbd = $cbdinfo;
		} else {
			$showcbd = '';
		}

		if ( 'show' === $cbda ) {
			$showcbda = $cbdainfo;
		} else {
			$showcbda = '';
		}

		if ( 'show' === $cbn ) {
			$showcbn = $cbninfo;
		} else {
			$showcbn = '';
		}

		if ( 'show' === $image ) {
			if ( null !== $thumbnail_url ) {
				$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="Menu - Concentrate" /></a>';
			} else {
				$wpd_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
				$defaultimg        = apply_filters( 'wpd_default_image', $wpd_default_image );
				$showimage         = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="Menu - Concentrate" /></a>';

			}
		} else {
			$showimage = '';
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_shortcode_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_concentrates' );
			$wpd_shortcode_top_concentrates = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-concentrates ' . $class . '">' . $wpd_shortcode_top_concentrates . '' . $wpd_shortcode_inside_top . '' . $showimage;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_concentrates' );
			$wpd_shortcode_bottom_concentrates = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . '' . $showinfo . '' . $showthc . '' . $showthca . '' . $showcbd . '' . $showcba . '' . $showcbn . '' . $wpd_shortcode_inside_bottom . '' . $wpd_shortcode_bottom_concentrates . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';

}
add_shortcode( 'wpd-concentrates', 'wpdispensary_concentrates_shortcode' );

/**
 * Edibles Shortcode Function
 */
function wpdispensary_edibles_shortcode( $atts ) {

	/** Attributes */
	extract( shortcode_atts(
		array(
			'posts'      => '100',
			'class'      => '',
			'name'       => 'show',
			'info'       => 'show',
			'title'      => 'Edibles',
			'category'   => '',
			'ingredient' => '',
			'vendor'     => '',
			'orderby'    => '',
			'image'      => 'show',
			'imgsize'    => 'dispensary-image',
		),
		$atts,
		'wpd_edibles'
	) );

	/**
	 * Code to create shortcode for Edibles
	 */
	$tax_query = array(
		'relation' => 'AND',
	);
	if ( '' !== $ingredient ) {
			$tax_query[] = array(
				'taxonomy' => 'ingredients',
				'field'    => 'slug',
				'terms'    => $ingredient,
			);
	}
	if ( '' !== $vendor ) {
			$tax_query[] = array(
				'taxonomy' => 'vendor',
				'field'    => 'slug',
				'terms'    => $vendor,
			);
	}
	if ( '' !== $orderby ) {
			$order    = $orderby;
			$ordernew = 'ASC';
	}
	$args = apply_filters( 'wpd_edibles_shortcode_args', array(
		'post_type'        => 'edibles',
		'posts_per_page'   => $posts,
		'edibles_category' => $category,
		'tax_query'        => $tax_query,
		'orderby'          => $order,
		'order'            => $ordernew,
	) );

	$wpdquery = new WP_Query( $args );

	$wpdposts = '<div class="wpdispensary"><h2 class="wpd-title">' . $title . '</h2>';

	while ( $wpdquery->have_posts() ) :
		$wpdquery->the_post();

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		$thumbnail_id        = get_post_thumbnail_id();
		$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $imagesize, false );
		$thumbnail_url       = $thumbnail_url_array[0];
		$querytitle          = get_the_title();

		$wp_dispensary_options = get_option( 'wp_dispensary_option_name' ); // Array of All Options.
		if ( ! isset( $wp_dispensary_options['wpd_hide_details'] ) ) {
			$wpd_hide_details = '';
		} else {
			$wpd_hide_details = $wp_dispensary_options['wpd_hide_details'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_hide_pricing'] ) ) {
			$wpd_hide_pricing = '';
		} else {
			$wpd_hide_pricing = $wp_dispensary_options['wpd_hide_pricing'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_content_placement'] ) ) {
			$wpd_content_placement = '';
		} else {
			$wpd_content_placement = $wp_dispensary_options['wpd_content_placement'];
		}
		if ( null === $wp_dispensary_options['wpd_currency'] ) {
			$wpd_currency = 'USD';
		} else {
			$wpd_currency = $wp_dispensary_options['wpd_currency'];
		}
		if ( null === $wp_dispensary_options['wpd_cost_phrase'] ) {
			$wpd_cost_phrase = 'Price';
		} else {
			$wpd_cost_phrase = $wp_dispensary_options['wpd_cost_phrase']; // costphrase.
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
			'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
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

		/*
		 * Get the pricing for Edibles
		 */

		if ( get_post_meta( get_the_ID(), '_thcmg', true ) ) {
			$thcmg = ' - <strong>THC: </strong>' . get_post_meta( get_the_id(), '_thcmg', true ) . 'mg';
		} else {
			$thcmg = '';
		}
		$thcsep = ' - ';
		if ( get_post_meta( get_the_ID(), '_thccbdservings', true ) ) {
			$servingcount = ' - <strong>Servings: </strong>' . get_post_meta( get_the_id(), '_thccbdservings', true );
		} else {
			$servingcount = '';
		}
		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$priceeach = '<strong>' . $wpd_cost_phrase . ':</strong> ' . $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_priceeach', true );
		}

		/** Check shortcode options input by user */

		if ( 'show' === $name ) {
			$showname = '<p class="wpd-producttitle"><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( 'show' === $info ) {
			$showinfo = '<span class="wpd-productinfo">' . $priceeach . '' . $thcmg . '' . $servingcount . '</span>';
		} else {
			$showinfo = '';
		}

		if ( 'show' === $image ) {
			if ( null !== $thumbnail_url ) {
				$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="Menu - Edible" /></a>';
			} else {
				$wpd_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
				$defaultimg        = apply_filters( 'wpd_default_image', $wpd_default_image );
				$showimage         = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="Menu - Edible" /></a>';
			}
		} else {
			$showimage = '';
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_shortcode_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_edibles' );
			$wpd_shortcode_top_edibles = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-edibles ' . $class . '">' . $wpd_shortcode_top_edibles . '' . $wpd_shortcode_inside_top . '' . $showimage;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_edibles' );
			$wpd_shortcode_bottom_edibles = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . '' . $showinfo . '' . $wpd_shortcode_inside_bottom . '' . $wpd_shortcode_bottom_edibles . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';

}
add_shortcode( 'wpd-edibles', 'wpdispensary_edibles_shortcode' );

/**
 * Pre-rolls Shortcode Function
 */
function wpdispensary_prerolls_shortcode( $atts ) {

	/** Attributes */
	extract( shortcode_atts(
		array(
			'posts'   => '100',
			'class'   => '',
			'name'    => 'show',
			'info'    => 'show',
			'title'   => 'Pre-rolls',
			'vendor'  => '',
			'orderby' => '',
			'image'   => 'show',
			'imgsize' => 'dispensary-image',
		),
		$atts,
		'wpd_prerolls'
	) );

	/**
	 * Code to create shortcode for Pre-rolls
	 */
	$tax_query = array(
		'relation' => 'AND',
	);
	if ( '' !== $vendor ) {
			$tax_query[] = array(
				'taxonomy' => 'vendor',
				'field'    => 'slug',
				'terms'    => $vendor,
			);
	}
	if ( '' !== $orderby ) {
			$order    = $orderby;
			$ordernew = 'ASC';
	}
	$args = apply_filters( 'wpd_prerolls_shortcode_args', array(
		'post_type'      => 'prerolls',
		'posts_per_page' => $posts,
		'tax_query'      => $tax_query,
		'orderby'        => $order,
		'order'          => $ordernew,
	) );

	$wpdquery = new WP_Query( $args );

	$wpdposts = '<div class="wpdispensary"><h2 class="wpd-title">' . $title . '</h2>';

	while ( $wpdquery->have_posts() ) :
		$wpdquery->the_post();

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		$thumbnail_id        = get_post_thumbnail_id();
		$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $imagesize, false );
		$thumbnail_url       = $thumbnail_url_array[0];
		$querytitle          = get_the_title();

		$wp_dispensary_options = get_option( 'wp_dispensary_option_name' ); // Array of All Options.
		if ( ! isset( $wp_dispensary_options['wpd_hide_details'] ) ) {
			$wpd_hide_details = '';
		} else {
			$wpd_hide_details = $wp_dispensary_options['wpd_hide_details'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_hide_pricing'] ) ) {
			$wpd_hide_pricing = '';
		} else {
			$wpd_hide_pricing = $wp_dispensary_options['wpd_hide_pricing'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_content_placement'] ) ) {
			$wpd_content_placement = '';
		} else {
			$wpd_content_placement = $wp_dispensary_options['wpd_content_placement'];
		}
		if ( null === $wp_dispensary_options['wpd_currency'] ) {
			$wpd_currency = 'USD';
		} else {
			$wpd_currency = $wp_dispensary_options['wpd_currency'];
		}
		if ( null === $wp_dispensary_options['wpd_cost_phrase'] ) {
			$wpd_cost_phrase = 'Price';
		} else {
			$wpd_cost_phrase = $wp_dispensary_options['wpd_cost_phrase']; // costphrase.
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

		/*
		 * Get the pricing for Pre-rolls
		 */

		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$pricingeach = '<strong>' . $wpd_cost_phrase . ':</strong> ' . $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_priceeach', true ) . ' each';
		} else {
			$pricingeach = '';
		}

		/** Check shortcode options input by user */

		if ( 'show' === $name ) {
			$showname = '<p class="wpd-producttitle"><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( 'show' === $info ) {
			$showinfo = '<span class="wpd-productinfo pricing">' . $pricingeach . '</span>';
		} else {
			$showinfo = '';
		}

		if ( 'show' === $image ) {
			if ( null !== $thumbnail_url ) {
				$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="Menu - Pre-roll" /></a>';
			} else {
				$wpd_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
				$defaultimg        = apply_filters( 'wpd_default_image', $wpd_default_image );
				$showimage         = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="Menu - Pre-roll" /></a>';
			}
		} else {
			$showimage = '';
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_shortcode_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_prerolls' );
			$wpd_shortcode_top_prerolls = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-prerolls ' . $class . '">' . $wpd_shortcode_top_prerolls . '' . $wpd_shortcode_inside_top . '' . $showimage;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_prerolls' );
			$wpd_shortcode_bottom_prerolls = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . '' . $showinfo . '' . $wpd_shortcode_inside_bottom . '' . $wpd_shortcode_bottom_prerolls . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';

}
add_shortcode( 'wpd-prerolls', 'wpdispensary_prerolls_shortcode' );


/**
 * Topicals Shortcode Fuction
 */
function wpdispensary_topicals_shortcode( $atts ) {

	/* Attributes */
	extract( shortcode_atts(
		array(
			'posts'      => '100',
			'class'      => '',
			'name'       => 'show',
			'info'       => 'show',
			'title'      => 'Topicals',
			'category'   => '',
			'ingredient' => '',
			'vendor'     => '',
			'orderby'    => '',
			'image'      => 'show',
			'imgsize'    => 'dispensary-image',
		),
		$atts,
		'wpd_topicals'
	) );

	/**
	 * Code to create shortcode for Topicals
	 */

	$tax_query = array(
		'relation' => 'AND',
	);
	if ( '' !== $ingredient ) {
			$tax_query[] = array(
				'taxonomy' => 'ingredients',
				'field'    => 'slug',
				'terms'    => $ingredient,
			);
	}
	if ( '' !== $vendor ) {
			$tax_query[] = array(
				'taxonomy' => 'vendor',
				'field'    => 'slug',
				'terms'    => $vendor,
			);
	}
	if ( '' !== $orderby ) {
			$order    = $orderby;
			$ordernew = 'ASC';
	}
	$args = array(
		'post_type'         => 'topicals',
		'posts_per_page'    => $posts,
		'topicals_category' => $category,
		'tax_query'         => $tax_query,
		'orderby'           => $order,
		'order'             => $ordernew,
	);

	$wpdquery = new WP_Query( $args );

	$wpdposts = '<div class="wpdispensary"><h2 class="wpd-title">' . $title . '</h2>';

	while ( $wpdquery->have_posts() ) :
		$wpdquery->the_post();

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		$thumbnail_id        = get_post_thumbnail_id();
		$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $imagesize, false );
		$thumbnail_url       = $thumbnail_url_array[0];
		$querytitle          = get_the_title();

		$wp_dispensary_options = get_option( 'wp_dispensary_option_name' ); // Array of All Options.
		if ( ! isset( $wp_dispensary_options['wpd_hide_details'] ) ) {
			$wpd_hide_details = '';
		} else {
			$wpd_hide_details = $wp_dispensary_options['wpd_hide_details'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_hide_pricing'] ) ) {
			$wpd_hide_pricing = '';
		} else {
			$wpd_hide_pricing = $wp_dispensary_options['wpd_hide_pricing'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_content_placement'] ) ) {
			$wpd_content_placement = '';
		} else {
			$wpd_content_placement = $wp_dispensary_options['wpd_content_placement'];
		}
		if ( null === $wp_dispensary_options['wpd_currency'] ) {
			$wpd_currency = 'USD';
		} else {
			$wpd_currency = $wp_dispensary_options['wpd_currency'];
		}
		if ( null === $wp_dispensary_options['wpd_cost_phrase'] ) {
			$wpd_cost_phrase = 'Price';
		} else {
			$wpd_cost_phrase = $wp_dispensary_options['wpd_cost_phrase']; // costphrase.
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
			'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
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

		/** Get the pricing for Topicals */

		if ( get_post_meta( get_the_ID(), '_pricetopical', true ) ) {
			$topicalprice = '<strong>' . $wpd_cost_phrase . ':</strong> ' . $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_pricetopical', true ) . '';
		} else {
			$topicalprice = '';
		}
		if ( get_post_meta( get_the_ID(), '_sizetopical', true ) ) {
			$topicalsize = ' - <strong>Size:</strong> ' . get_post_meta( get_the_id(), '_sizetopical', true ) . 'oz';
		} else {
			$topicalsize = '';
		}
		if ( get_post_meta( get_the_ID(), '_thctopical', true ) ) {
			$topicalthc = ' - <strong>THC:</strong> ' . get_post_meta( get_the_id(), '_thctopical', true ) . 'mg';
		} else {
			$topicalthc = '';
		}
		if ( get_post_meta( get_the_ID(), '_cbdtopical', true ) ) {
			$topicalcbd = ' - <strong>CBD:</strong> ' . get_post_meta( get_the_id(), '_cbdtopical', true ) . 'mg';
		} else {
			$topicalcbd = '';
		}

		/** Check shortcode options input by user */

		if ( 'show' === $name ) {
			$showname = '<p class="wpd-producttitle"><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( 'show' === $info ) {
			$showinfo = '<span class="wpd-productinfo">' . $topicalprice . '' . $topicalsize . '' . $topicalthc . '' . $topicalcbd . '</span>';
		} else {
			$showinfo = '';
		}

		if ( 'show' === $image ) {
			if ( null !== $thumbnail_url ) {
				$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="Menu - Topical" /></a>';
			} else {
				$wpd_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
				$defaultimg        = apply_filters( 'wpd_default_image', $wpd_default_image );
				$showimage         = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="Menu - Topical" /></a>';
			}
		} else {
			$showimage = '';
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_shortcode_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_topicals' );
			$wpd_shortcode_top_topicals = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-topicals ' . $class . '">' . $wpd_shortcode_top_topicals . '' . $wpd_shortcode_inside_top . '' . $showimage;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_topicals' );
			$wpd_shortcode_bottom_topicals = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . '' . $showinfo . '' . $wpd_shortcode_inside_bottom . '' . $wpd_shortcode_bottom_topicals . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';

}
add_shortcode( 'wpd-topicals', 'wpdispensary_topicals_shortcode' );


/**
 * Growers Shortcode Function
 */
function wpdispensary_growers_shortcode( $atts ) {

	/** Attributes */
	extract( shortcode_atts(
		array(
			'posts'    => '100',
			'class'    => '',
			'name'     => 'show',
			'info'     => 'show',
			'title'    => 'Growers',
			'category' => '',
			'vendor'   => '',
			'orderby'  => '',
			'image'    => 'show',
			'imgsize'  => 'dispensary-image',
		),
		$atts,
		'wpd_growers'
	) );

	/**
	 * Code to create shortcode for Growers
	 */
	$tax_query = array(
		'relation' => 'AND',
	);
	if ( '' !== $vendor ) {
			$tax_query[] = array(
				'taxonomy' => 'vendor',
				'field'    => 'slug',
				'terms'    => $vendor,
			);
	}
	if ( '' !== $orderby ) {
		$order    = $orderby;
		$ordernew = 'ASC';
	}
	$args = apply_filters( 'wpd_growers_shortcode_args', array(
		'post_type'        => 'growers',
		'tax_query'        => $tax_query,
		'posts_per_page'   => $posts,
		'growers_category' => $category,
		'orderby'          => $order,
		'order'            => $ordernew,
	) );

	$wpdquery = new WP_Query( $args );

	$wpdposts = '<div class="wpdispensary"><h2 class="wpd-title">' . $title . '</h2>';

	while ( $wpdquery->have_posts() ) :
		$wpdquery->the_post();

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		$thumbnail_id        = get_post_thumbnail_id();
		$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $imagesize, false );
		$thumbnail_url       = $thumbnail_url_array[0];
		$querytitle          = get_the_title();

		$wp_dispensary_options = get_option( 'wp_dispensary_option_name' ); // Array of All Options.
		if ( ! isset( $wp_dispensary_options['wpd_hide_details'] ) ) {
			$wpd_hide_details = '';
		} else {
			$wpd_hide_details = $wp_dispensary_options['wpd_hide_details'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_hide_pricing'] ) ) {
			$wpd_hide_pricing = '';
		} else {
			$wpd_hide_pricing = $wp_dispensary_options['wpd_hide_pricing'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_content_placement'] ) ) {
			$wpd_content_placement = '';
		} else {
			$wpd_content_placement = $wp_dispensary_options['wpd_content_placement'];
		}
		if ( null === $wp_dispensary_options['wpd_currency'] ) {
			$wpd_currency = 'USD';
		} else {
			$wpd_currency = $wp_dispensary_options['wpd_currency'];
		}
		if ( null === $wp_dispensary_options['wpd_cost_phrase'] ) {
			$wpd_cost_phrase = 'Price';
		} else {
			$wpd_cost_phrase = $wp_dispensary_options['wpd_cost_phrase']; // costphrase.
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

		/*
		 * Get the pricing for Growers
		 */

		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$pricingperunit = '<strong>' . $wpd_cost_phrase . ':</strong> ' . $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_priceeach', true );
		} else {
			$pricingperunit = '';
		}

		/*
		 * Get the seed count for Growers
		 */

		if ( get_post_meta( get_the_ID(), '_seedcount', true ) ) {
			$wpdseedcount = ' - <strong>Seeds:</strong> ' . get_post_meta( get_the_id(), '_seedcount', true );
		} else {
			$wpdseedcount = '';
		}

		/*
		 * Get the clone count for Growers
		 */

		if ( get_post_meta( get_the_ID(), '_clonecount', true ) ) {
			$wpdclonecount = ' - <strong>Clones:</strong> ' . get_post_meta( get_the_id(), '_clonecount', true );
		} else {
			$wpdclonecount = '';
		}

		/** Check shortcode options input by user */

		if ( 'show' === $name ) {
			$showname = '<p class="wpd-producttitle"><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		if ( 'show' === $info ) {
			$showinfo = '<span class="wpd-productinfo">' . $pricingperunit . '' . $wpdseedcount . '' . $wpdclonecount . '</span>';
		} else {
			$showinfo = '';
		}

		if ( 'show' === $image ) {
			if ( null !== $thumbnail_url ) {
				$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="Menu - Grower" /></a>';
			} else {
				$wpd_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
				$defaultimg        = apply_filters( 'wpd_default_image', $wpd_default_image );
				$showimage         = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="Menu - Grower" /></a>';
			}
		} else {
			$showimage = '';
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_shortcode_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_growers' );
			$wpd_shortcode_top_growers = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-growers ' . $class . '">' . $wpd_shortcode_top_growers . '' . $wpd_shortcode_inside_top . '' . $showimage;

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_growers' );
			$wpd_shortcode_bottom_growers = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . '' . $showinfo . '' . $wpd_shortcode_inside_bottom . '' . $wpd_shortcode_bottom_growers . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';

}
add_shortcode( 'wpd-growers', 'wpdispensary_growers_shortcode' );


/**
 * Carousel Shortcode Fuction
 *
 * @access public
 *
 * @return string HTML markup.
 */
function wpdispensary_carousel_shortcode( $atts ) {

	/* Attributes */
	extract( shortcode_atts(
		array(
			'posts'     => '100',
			'class'     => '',
			'name'      => 'show',
			'info'      => 'show',
			'thc'       => 'show',
			'thca'      => '',
			'cbd'       => 'show',
			'cba'       => '',
			'cbn'       => '',
			'title'     => 'Dispensary Menu',
			'category'  => '',
			'aroma'     => '',
			'flavor'    => '',
			'effect'    => '',
			'symptom'   => '',
			'condition' => '',
			'vendor'    => '',
			'orderby'   => '',
			'type'      => "flowers', 'concentrates', 'edibles', 'topicals', 'prerolls', 'growers'",
			'imgsize'   => 'dispensary-image',
		),
		$atts,
		'wpd_carousel'
	) );

	/**
	 * Code to create shortcode
	 */
	$tax_query = array(
		'relation' => 'AND',
	);
	if ( '' !== $aroma ) {
			$tax_query[] = array(
				'taxonomy' => 'aroma',
				'field'    => 'slug',
				'terms'    => $aroma,
			);
	}
	if ( '' !== $flavor ) {
			$tax_query[] = array(
				'taxonomy' => 'flavor',
				'field'    => 'slug',
				'terms'    => $flavor,
			);
	}
	if ( '' !== $effect ) {
			$tax_query[] = array(
				'taxonomy' => 'effect',
				'field'    => 'slug',
				'terms'    => $effect,
			);
	}
	if ( '' !== $symptom ) {
			$tax_query[] = array(
				'taxonomy' => 'symptom',
				'field'    => 'slug',
				'terms'    => $symptom,
			);
	}
	if ( '' !== $condition ) {
			$tax_query[] = array(
				'taxonomy' => 'condition',
				'field'    => 'slug',
				'terms'    => $condition,
			);
	}
	if ( '' !== $vendor ) {
			$tax_query[] = array(
				'taxonomy' => 'vendor',
				'field'    => 'slug',
				'terms'    => $vendor,
			);
	}
	if ( '' !== $orderby ) {
			$order    = $orderby;
			$ordernew = 'ASC';
	}
	$args = apply_filters( 'wpd_carousel_shortcode_args', array(
		'post_type'        => explode( ', ', $type ),
		'posts_per_page'   => $posts,
		'flowers_category' => $category,
		'tax_query'        => $tax_query,
		'orderby'          => $order,
		'order'            => $ordernew,
	) );

	$wpdquery = new WP_Query( $args );

	if ( '' === $title ) {
		$showtitle = '';
	} else {
		$showtitle = '<h2 class="wpd-title">' . $title . '</h2>';
	}

	$wpdposts = '<div class="wpdispensary">' . $showtitle . '<div class="wpd-carousel">';

	while ( $wpdquery->have_posts() ) :
		$wpdquery->the_post();

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		$thumbnail_id        = get_post_thumbnail_id();
		$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $imagesize, false );
		$thumbnail_url       = $thumbnail_url_array[0];
		$querytitle          = get_the_title();

		/** Get the pricing for Flowers and Concentrates */

		$priceGram      = get_post_meta( get_the_ID(), '_gram', true );
		$priceEighth    = get_post_meta( get_the_ID(), '_eighth', true );
		$priceQuarter   = get_post_meta( get_the_ID(), '_quarter', true );
		$priceHalfOunce = get_post_meta( get_the_ID(), '_halfounce', true );
		$priceOunce     = get_post_meta( get_the_ID(), '_ounce', true );

		$wp_dispensary_options = get_option( 'wp_dispensary_option_name' ); // Array of All Options.
		if ( ! isset( $wp_dispensary_options['wpd_hide_details'] ) ) {
			$wpd_hide_details = '';
		} else {
			$wpd_hide_details = $wp_dispensary_options['wpd_hide_details'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_hide_pricing'] ) ) {
			$wpd_hide_pricing = '';
		} else {
			$wpd_hide_pricing = $wp_dispensary_options['wpd_hide_pricing'];
		}
		if ( ! isset( $wp_dispensary_options['wpd_content_placement'] ) ) {
			$wpd_content_placement = '';
		} else {
			$wpd_content_placement = $wp_dispensary_options['wpd_content_placement'];
		}
		if ( null === $wp_dispensary_options['wpd_currency'] ) {
			$wpd_currency = 'USD';
		} else {
			$wpd_currency = $wp_dispensary_options['wpd_currency'];
		}
		if ( null === $wp_dispensary_options['wpd_cost_phrase'] ) {
			$wpd_cost_phrase = 'Price';
		} else {
			$wpd_cost_phrase = $wp_dispensary_options['wpd_cost_phrase']; // costphrase.
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

		if ( '' === $priceEighth && '' === $priceQuarter && '' === $priceHalfOunce && '' === $priceOunce ) {
			$pricing = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_gram', true ) . ' per gram';
		} elseif ( '' === $priceGram && '' === $priceQuarter && '' === $priceHalfOunce && '' === $priceOunce ) {
			$pricing = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_eighth', true ) . ' per eighth';
		} elseif ( '' === $priceGram && '' === $priceEighth && '' === $priceHalfOunce && '' === $priceOunce ) {
			$pricing = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_quarter', true ) . ' per quarter ounce';
		} elseif ( '' === $priceGram && '' === $priceEighth && '' === $priceQuarter && '' === $priceOunce ) {
			$pricing = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_halfounce', true ) . ' per half ounce';
		} elseif ( '' === $priceGram && '' === $priceEighth && '' === $priceQuarter && '' === $priceHalfOunce ) {
			$pricing = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_ounce', true ) . ' per ounce';
		} else {
			$pricing = '';
		}

		if ( get_post_meta( get_the_ID(), '_gram', true ) ) {
			$pricinglow = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_gram', true );
		} elseif ( get_post_meta( get_the_ID(), '_eighth', true ) ) {
			$pricinglow = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_eighth', true );
		} elseif ( get_post_meta( get_the_ID(), '_quarter', true ) ) {
			$pricinglow = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_quarter', true );
		} elseif ( get_post_meta( get_the_ID(), '_halfounce', true ) ) {
			$pricinglow = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_halfounce', true );
		}

		$pricingsep = ' - ';

		if ( get_post_meta( get_the_ID(), '_ounce', true ) ) {
			$pricinghigh = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_ounce', true );
		} elseif ( get_post_meta( get_the_ID(), '_halfounce', true ) ) {
			$pricinghigh = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_halfounce', true );
		} elseif ( get_post_meta( get_the_ID(), '_quarter', true ) ) {
			$pricinghigh = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_quarter', true );
		} elseif ( get_post_meta( get_the_ID(), '_eighth', true ) ) {
			$pricinghigh = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_eighth', true );
		} elseif ( get_post_meta( get_the_ID(), '_gram', true ) ) {
			$pricinghigh = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_gram', true );
		}

		if ( get_post_meta( get_the_ID(), '_thc', true ) ) {
			$thcinfo = '<span class="wpd-productinfo thc"><strong>THC: </strong>' . get_post_meta( get_the_id(), '_thc', true ) . '%</span>';
		} else {
			$thcinfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_thca', true ) ) {
			$thcainfo = '<span class="wpd-productinfo thca"><strong>THCA: </strong>' . get_post_meta( get_the_id(), '_thca', true ) . '%</span>';
		} else {
			$thcainfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbd', true ) ) {
			$cbdinfo = '<span class="wpd-productinfo cbd"><strong>CBD: </strong>' . get_post_meta( get_the_id(), '_cbd', true ) . '%</span>';
		} else {
			$cbdinfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_cba', true ) ) {
			$cbainfo = '<span class="wpd-productinfo cba"><strong>CBA: </strong>' . get_post_meta( get_the_id(), '_cba', true ) . '%</span>';
		} else {
			$cbainfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbn', true ) ) {
			$cbninfo = '<span class="wpd-productinfo cbn"><strong>CBN: </strong>' . get_post_meta( get_the_id(), '_cbn', true ) . '%</span>';
		} else {
			$cbninfo = '';
		}

		/*
		 * Get the pricing for Growers
		 */

		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$pricingperunit = '<strong>' . $wpd_cost_phrase . ':</strong> ' . $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_priceeach', true );
		}

		/*
		 * Get the seed count for Growers
		 */

		if ( get_post_meta( get_the_ID(), '_seedcount', true ) ) {
			$wpdseedcount = ' - <strong>Seeds:</strong> ' . get_post_meta( get_the_id(), '_seedcount', true );
		} else {
			$wpdseedcount = '';
		}

		/*
		 * Get the clone count for Growers
		 */

		if ( get_post_meta( get_the_ID(), '_clonecount', true ) ) {
			$wpdclonecount = ' - <strong>Clones:</strong> ' . get_post_meta( get_the_id(), '_clonecount', true );
		} else {
			$wpdclonecount = '';
		}

		/** Get the pricing for Topicals */

		if ( get_post_meta( get_the_ID(), '_pricetopical', true ) ) {
			$topicalprice = '<strong>' . $wpd_cost_phrase . ':</strong> ' . $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_pricetopical', true ) . '';
		}
		if ( get_post_meta( get_the_ID(), '_sizetopical', true ) ) {
			$topicalsize = ' - <strong>Size:</strong> ' . get_post_meta( get_the_id(), '_sizetopical', true ) . 'oz';
		}
		if ( get_post_meta( get_the_ID(), '_thctopical', true ) ) {
			$topicalthc = ' - <strong>THC:</strong> ' . get_post_meta( get_the_id(), '_thctopical', true ) . 'mg';
		}
		if ( get_post_meta( get_the_ID(), '_cbdtopical', true ) ) {
			$topicalcbd = ' - <strong>CBD:</strong> ' . get_post_meta( get_the_id(), '_cbdtopical', true ) . 'mg';
		}

		/*
		 * Get the pricing for Pre-rolls
		 */

		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$pricingprerolls = '<strong>' . $wpd_cost_phrase . ':</strong> ' . $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_priceeach', true ) . ' each';
		}

		/*
		 * Get the pricing for Edibles
		 */

		if ( get_post_meta( get_the_ID(), '_thcmg', true ) ) {
			$thcmg = ' - <strong>THC: </strong>' . get_post_meta( get_the_id(), '_thcmg', true ) . 'mg';
		}
		$thcsep = ' - ';
		if ( get_post_meta( get_the_ID(), '_thccbdservings', true ) ) {
			$servingcount = ' - <strong>Servings: </strong>' . get_post_meta( get_the_id(), '_thccbdservings', true );
		}
		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$priceeach = '<strong>' . $wpd_cost_phrase . ':</strong> ' . $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_priceeach', true );
		}

		/** Get the pricing for Concentrates */

		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$pricingeach = $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_priceeach', true );
			$pricingname = '<strong>' . $wpd_cost_phrase . ':</strong> ';
		} else {
			$pricingeach = '';
		}

		if ( get_post_meta( get_the_ID(), '_halfgram', true ) ) {
			$halfgram = '<span class="wpd-productinfo"><strong>1/2g: </strong>' . $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_halfgram', true ) . '</span>';
		} else {
			$halfgram = '';
		}

		if ( get_post_meta( get_the_ID(), '_gram', true ) ) {
			$gram = '<span class="wpd-productinfo"><strong>1g: </strong>' . $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_gram', true ) . '</span>';
		} else {
			$gram = '';
		}

		if ( get_post_meta( get_the_ID(), '_twograms', true ) ) {
			$twograms = '<span class="wpd-productinfo"><strong>2g: </strong>' . $currency_symbols[ $wpd_currency ] . '' . get_post_meta( get_the_id(), '_twograms', true ) . '</span>';
		} else {
			$twograms = '';
		}

		/** Check shortcode options input by user */

		if ( 'show' === $name ) {
			$showname = '<p class="wpd-producttitle"><strong><a href="' . get_permalink() . '">' . $querytitle . '</a></strong></p>';
		} else {
			$showname = '';
		}

		/** Growers */
		if ( in_array( get_post_type(), array( 'growers' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo">' . $pricingperunit . '' . $wpdseedcount . '' . $wpdclonecount . '</span>';
			} else {
				$showinfo = '';
			}
		}
		/** Topicals */
		if ( in_array( get_post_type(), array( 'topicals' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo">' . $topicalprice . '' . $topicalsize . '' . $topicalthc . '' . $topicalcbd . '</span>';
			} else {
				$showinfo = '';
			}
		}

		/** Pre-rolls */
		if ( in_array( get_post_type(), array( 'prerolls' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo">' . $pricingprerolls . '</span>';
			} else {
				$showinfo = '';
			}
		}
		/** Edibles */
		if ( in_array( get_post_type(), array( 'edibles' ) ) ) {
			if ( 'show' === $info ) {
				$showinfo = '<span class="wpd-productinfo">' . $priceeach . '' . $thcmg . '' . $servingcount . '</span>';
			} else {
				$showinfo = '';
			}
		}
		/** Concentrates */
		if ( in_array( get_post_type(), array( 'concentrates' ) ) ) {
			if ( empty( $pricingeach ) ) {
				$showinfo = $halfgram . '' . $gram . '' . $twograms;
			} else {
				$showinfo = '<span class="wpd-productinfo pricing">' . $pricingname . '' . $pricingeach . '</span>';
			}
		}
		/** Flowers */
		if ( in_array( get_post_type(), array( 'flowers' ) ) ) {
			if ( 'show' === $info ) {
				if ( empty( $pricing ) ) {
					$showinfo = '<span class="wpd-productinfo"><strong>' . $wpd_cost_phrase . ':</strong> ' . $pricinglow . '' . $pricingsep . '' . $pricinghigh . '</span>';
				} else {
					$showinfo = '<span class="wpd-productinfo"><strong>' . $wpd_cost_phrase . ':</strong> ' . $pricing . '</span>';
				}
			} else {
				$showinfo = '';
			}
		}

		if ( get_post_meta( get_the_ID(), '_thc', true ) ) {
			$thcinfo = '<span class="wpd-productinfo thc"><strong>THC: </strong>' . get_post_meta( get_the_id(), '_thc', true ) . '%</span>';
		} else {
			$thcinfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_thca', true ) ) {
			$thcainfo = '<span class="wpd-productinfo thca"><strong>THCA: </strong>' . get_post_meta( get_the_id(), '_thca', true ) . '%</span>';
		} else {
			$thcainfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbd', true ) ) {
			$cbdinfo = '<span class="wpd-productinfo cbd"><strong>CBD: </strong>' . get_post_meta( get_the_id(), '_cbd', true ) . '%</span>';
		} else {
			$cbdinfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_cba', true ) ) {
			$cbainfo = '<span class="wpd-productinfo cba"><strong>CBA: </strong>' . get_post_meta( get_the_id(), '_cba', true ) . '%</span>';
		} else {
			$cbainfo = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbn', true ) ) {
			$cbninfo = '<span class="wpd-productinfo cbn"><strong>CBN: </strong>' . get_post_meta( get_the_id(), '_cbn', true ) . '%</span>';
		} else {
			$cbninfo = '';
		}

		if ( null !== $thumbnail_url ) {
			$showimage = '<a href="' . get_permalink() . '"><img src="' . $thumbnail_url . '" alt="Menu item" /></a>';
		} else {
			$wpd_default_image = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $imagesize . '.jpg';
			$defaultimg        = apply_filters( 'wpd_default_image', $wpd_default_image );
			$showimage         = '<a href="' . get_permalink() . '"><img src="' . $defaultimg . '" alt="Menu item" /></a>';
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_shortcode_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_carousel' );
			$wpd_shortcode_top_carousel = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="carousel-item ' . $class . '">' . $wpd_shortcode_top_carousel . '' . $wpd_shortcode_inside_top . '' . $showimage . '';

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_shortcode_inside_bottom = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_bottom_carousel' );
			$wpd_shortcode_bottom_carousel = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . '' . $showinfo . '' . $thcinfo . '' . $thcainfo . '' . $cbdinfo . '' . $cbainfo . '' . $cbninfo . '' . $wpd_shortcode_inside_bottom . '' . $wpd_shortcode_bottom_carousel . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div></div>';

}
add_shortcode( 'wpd-carousel', 'wpdispensary_carousel_shortcode' );
