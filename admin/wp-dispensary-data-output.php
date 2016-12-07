<?php
/**
 * Adding metaboxes and taxonomy data output in the_content
 *
 * @link       http://www.wpdispensary.com
 * @since      1.6.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

/**
 * Checking WP Dispensary option to
 * see if the user checked to hide the
 * data from the_content()
 */
if ( ! function_exists( 'wpd_data_output_content' ) ) {

	/**
	 * Creating the menu item
	 */
	function wpd_data_output_content( $content ) {

		$wp_dispensary_options = get_option( 'wp_dispensary_option_name' );
		$wpd_hide_details = $wp_dispensary_options['wpd_hide_details'];
		$wpd_hide_pricing = $wp_dispensary_options['wpd_hide_pricing'];
		$wpd_content_placement = $wp_dispensary_options['wpd_content_placement'];
		if ( null === $wp_dispensary_options['wpd_currency'] ) {
			$wpd_currency = 'USD';
		} else {
			$wpd_currency = $wp_dispensary_options['wpd_currency'];
		}
		if ( null === $wp_dispensary_options['wpd_cost_phrase'] || 'Price' === $wp_dispensary_options['wpd_cost_phrase'] ) {
			$wpd_cost_phrase = 'Pricing';
		} else {
			$wpd_cost_phrase = 'Donation' ;
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

		global $post;

		/**
		 * Setting up WP Dispensary menu item data
		 */
		if ( get_the_term_list( $post->ID, 'aroma', true ) ) {
			$wpdaroma = '<tr><td><span>Aromas:</span></td><td>' . get_the_term_list( $post->ID, 'aroma', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdaroma = '';
		}

		if ( get_the_term_list( $post->ID, 'flavor', true ) ) {
			$wpdflavor = '<tr><td><span>Flavors:</span></td><td>' . get_the_term_list( $post->ID, 'flavor', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdflavor = '';
		}

		if ( get_the_term_list( $post->ID, 'effect', true ) ) {
			$wpdeffect = '<tr><td><span>Effects:</span></td><td>' . get_the_term_list( $post->ID, 'effect', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdeffect = '';
		}

		if ( get_the_term_list( $post->ID, 'symptom', true ) ) {
			$wpdsymptom = '<tr><td><span>Symptoms:</span></td><td>' . get_the_term_list( $post->ID, 'symptom', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdsymptom = '';
		}

		if ( get_the_term_list( $post->ID, 'condition', true ) ) {
			$wpdcondition = '<tr><td><span>Conditions:</span></td><td>' . get_the_term_list( $post->ID, 'condition', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdcondition = '';
		}

		if ( get_the_term_list( $post->ID, 'ingredients', true ) ) {
			$wpdingredients = '<tr><td><span>Ingredients:</span></td><td>' . get_the_term_list( $post->ID, 'ingredients', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdingredients = '';
		}

		if ( get_post_meta( get_the_ID(), '_thc', true ) ) {
			$wpdthc = '<tr><td><span>THC:</span></td><td>' . get_post_meta( get_the_id(), '_thc', true ) .'%</td></tr>';
		} else {
			$wpdthc = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbd', true ) ) {
			$wpdcbd = '<tr><td><span>CBD:</span></td><td>' . get_post_meta( get_the_id(), '_cbd', true ) .'%</td></tr>';
		} else {
			$wpdcbd = '';
		}

		if ( get_post_meta( get_the_ID(), '_thcmg', true ) ) {
			$wpdthcmg = '<tr><td><span>THC mg per serving:</span></td><td>' . get_post_meta( get_the_id(), '_thcmg', true ) .'</td></tr>';
		} else {
			$wpdthcmg = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbdmg', true ) ) {
			$wpdcbdmg = '<tr><td><span>CBD mg per serving:</span></td><td>' . get_post_meta( get_the_id(), '_cbdmg', true ) .'</td></tr>';
		} else {
			$wpdcbdmg = '';
		}

		if ( get_post_meta( get_the_ID(), '_thccbdservings', true ) ) {
			$wpdservings = '<tr><td><span>Servings:</span></td><td>' . get_post_meta( get_the_id(), '_thccbdservings', true ) .'</td></tr>';
		} else {
			$wpdservings = '';
		}

		if ( get_post_meta( get_the_ID(), '_thctopical', true ) ) {
			$wpdthctopical = '<tr><td><span>THC:</span></td><td>' . get_post_meta( get_the_id(), '_thctopical', true ) .'%</td></tr>';
		} else {
			$wpdthctopical = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbdtopical', true ) ) {
			$wpdcbdtopical = '<tr><td><span>CBD:</span></td><td>' . get_post_meta( get_the_id(), '_cbdtopical', true ) .'%</td></tr>';
		} else {
			$wpdcbdtopical = '';
		}

		if ( get_post_meta( get_the_ID(), '_sizetopical', true ) ) {
			$wpdsizetopical = '<tr><td><span>Size:</span></td><td>' . get_post_meta( get_the_id(), '_sizetopical', true ) .' (oz)</td></tr>';
		} else {
			$wpdsizetopical = '';
		}

		if ( get_post_meta( get_the_ID(), '_seedcount', true ) ) {
			$wpdseedcount = '<tr><td><span>Seeds per unit:</span></td><td>' . get_post_meta( get_the_id(), '_seedcount', true ) .'</td></tr>';
		} else {
			$wpdseedcount = '';
		}

		if ( get_post_meta( get_the_ID(), '_clonecount', true ) ) {
			$wpdclonecount = '<tr><td><span>Clones per unit:</span></td><td>' . get_post_meta( get_the_id(), '_clonecount', true ) .'</td></tr>';
		} else {
			$wpdclonecount = '';
		}

		if ( get_post_meta( get_the_ID(), '_selected_flowers', true ) ) {
			$prerollflower = get_post_meta( get_the_id(), '_selected_flowers', true );
			$wpdpreroll = '<tr><td><span>Flower:</span></td><td><a href='. get_permalink( $prerollflower ) .'>'. get_the_title( $prerollflower ) .'</a></td></tr>';
		} else {
			$wpdpreroll = '';
		}

		if ( get_post_meta( get_the_ID(), '_selected_flowers', true ) ) {
			$growerflower = get_post_meta( get_the_id(), '_selected_flowers', true );
			$wpdgrower = '<tr><td><span>Flower:</span></td><td><a href='. get_permalink( $growerflower ) .'>'. get_the_title( $growerflower ) .'</a></td></tr>';
		} else {
			$wpdgrower = '';
		}

		/**
		 * Setting up WP Dispensary menu pricing data
		 */
		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$wpdpriceeach = '<tr class="priceeach"><td><span>Price Each:</span></td><td>'. $currency_symbols[ $wpd_currency ] .'' . get_post_meta( get_the_id(), '_priceeach', true ) . '</td></tr>';
		} else {
			$wpdpriceeach = '';
		}

		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$wpdpriceperunit = '<tr class="priceeach"><td><span>Price per unit:</span></td><td>'. $currency_symbols[ $wpd_currency ] .'' . get_post_meta( get_the_id(), '_priceeach', true ) . '</td></tr>';
		} else {
			$wpdpriceperunit = '';
		}

		if ( get_post_meta( get_the_ID(), '_pricetopical', true ) ) {
			$wpdpricetopical = '<tr class="priceeach"><td><span>Price per unit:</span></td><td>'. $currency_symbols[ $wpd_currency ] .'' . get_post_meta( get_the_id(), '_pricetopical', true ) . '</td></tr>';
		} else {
			$wpdpricetopical = '';
		}

		if ( get_post_meta( get_the_ID(), '_halfgram', true ) ) {
			$wpdhalfgram = '<td><span>1/2 g:</span> '. $currency_symbols[ $wpd_currency ] .'' . get_post_meta( get_the_id(), '_halfgram', true ) .'</td>';
		} else {
			$wpdhalfgram = '';
		}

		if ( get_post_meta( get_the_ID(), '_gram', true ) ) {
			$wpdgram = '<td><span>1 g:</span> '. $currency_symbols[ $wpd_currency ] .'' . get_post_meta( get_the_id(), '_gram', true ) .'</td>';
		} else {
			$wpdgram = '';
		}

		if ( get_post_meta( get_the_ID(), '_eighth', true ) ) {
			$wpdeighth = '<td><span>1/8 oz:</span> '. $currency_symbols[ $wpd_currency ] .'' . get_post_meta( get_the_id(), '_eighth', true ) .'</td>';
		} else {
			$wpdeighth = '';
		}

		if ( get_post_meta( get_the_ID(), '_quarter', true ) ) {
			$wpdquarter = '<td><span>1/4 oz:</span> '. $currency_symbols[ $wpd_currency ] .'' . get_post_meta( get_the_id(), '_quarter', true ) .'</td>';
		} else {
			$wpdquarter = '';
		}

		if ( get_post_meta( get_the_ID(), '_halfounce', true ) ) {
			$wpdhalfounce = '<td><span>1/2 oz:</span> '. $currency_symbols[ $wpd_currency ] .'' . get_post_meta( get_the_id(), '_halfounce', true ) .'</td>';
		} else {
			$wpdhalfounce = '';
		}

		if ( get_post_meta( get_the_ID(), '_halfounce', true ) ) {
			$wpdounce = '<td><span>1 oz:</span> '. $currency_symbols[ $wpd_currency ] .'' . get_post_meta( get_the_id(), '_ounce', true ) .'</td>';
		} else {
			$wpdounce = '';
		}

		$post_type = get_post_type_object( get_post_type( $post ) );

		/**
		 * Adding the WP Dispensary menu item data
		 */
		if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'edibles', 'topicals', 'prerolls', 'growers' ) ) ) {
			$original = $content;
		}

		if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'edibles', 'topicals', 'prerolls', 'growers' ) ) ) {
			$content = '';
		}

		/**
		 * Adding Details table
		 */
		if ( 'wpd_hide_details' !== $wpd_hide_details ) {

			if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) {
				$content .= '<table class="wpdispensary-table single"><tr><td class="wpdispensary-title" colspan="6">' .  $post_type->labels->singular_name . ' Details</td></tr>';
			}

			if ( in_array( get_post_type(), array( 'flowers', 'concentrates' ) ) ) {
				$content .= $wpdaroma . $wpdflavor . $wpdeffect . $wpdsymptom . $wpdcondition;
			}

			if ( 'prerolls' === get_post_type() ) {
				$content .= $wpdpreroll;
			}

			if ( 'growers' === get_post_type() ) {
				$content .= $wpdseedcount . $wpdclonecount;
			}

			if ( 'edibles' === get_post_type() ) {
				$content .= $wpdingredients . $wpdthcmg . $wpdcbdmg . $wpdservings;
			}

			if ( 'topicals' === get_post_type() ) {
				$content .= $wpdsizetopical . $wpdthctopical . $wpdcbdtopical;
			}

			if ( in_array( get_post_type(), array( 'flowers', 'concentrates' ) ) ) {
				$content .= $wpdthc . $wpdcbd;
			}

			/**
			 * Details Table Bottom Action Hook
			 *
			 * @since      1.8.0
			 */
			if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) {
				ob_start();
				do_action( 'wpd_dataoutput_bottom' );
				$wpddatabottom = ob_get_clean();
				$content .= $wpddatabottom;
			}

			if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) {
				$content .= '</table>';
			}
		}

		/**
		 * Adding Pricing table
		 */
		if ( 'wpd_hide_pricing' !== $wpd_hide_pricing ) {

			if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) {
				$content .= '<table class="wpdispensary-table single pricing"><tr><td class="wpdispensary-title" colspan="6">' .  $post_type->labels->singular_name . ' '. $wpd_cost_phrase .'</td></tr>';
			}

			if ( in_array( get_post_type(), array( 'flowers', 'concentrates' ) ) ) {
				$content .= '<tr>' . $wpdhalfgram . $wpdgram . $wpdeighth . $wpdquarter . $wpdhalfounce . $wpdounce . '</tr>';
			}

			if ( in_array( get_post_type(), array( 'prerolls', 'edibles' ) ) ) {
				$content .= $wpdpriceeach;
			}

			if ( in_array( get_post_type(), array( 'growers' ) ) ) {
				$content .= $wpdpriceperunit;
			}

			if ( in_array( get_post_type(), array( 'topicals' ) ) ) {
				$content .= $wpdpricetopical;
			}

			/**
			 * Pricing Table Bottom Action Hook
			 *
			 * @since      1.8.0
			 */
			if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) {
				ob_start();
				do_action( 'wpd_pricingoutput_bottom' );
				$wpdpricingbottom = ob_get_clean();
				$content .= $wpdpricingbottom;
			}

			if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) {
				$content .= '</table>';
			}
		}

		/**
		 * Conditional statement to output menu
		 * item details above or below the_content
		 */
		if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) {
			if ( 'wpd_content_placement' !== $wpd_content_placement ) {
				$content .= $original;
			} else {
				$content = $original . $content;
			}
		}

		return $content;

	}
	add_filter( 'the_content', 'wpd_data_output_content' );

}
