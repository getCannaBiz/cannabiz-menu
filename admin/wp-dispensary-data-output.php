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
	 *
	 * @access public
	 *
	 * @return string The content to be ouput.
	 */
	function wpd_data_output_content( $content ) {

		/**
		 * Access all settings
		 */
		$wpd_settings = get_option( 'wpdas_display' );

		// Hide details.
		if ( ! isset( $wp_dispensary_options['wpd_hide_details'] ) ) {
			$wpd_hide_details = '';
		} else {
			$wpd_hide_details = $wp_dispensary_options['wpd_hide_details'];
		}

		// Hide pricing.
		if ( 'show' !== $wpd_settings['wpd_hide_pricing'] ) {
			$wpd_hide_pricing = $wpd_settings['wpd_hide_pricing'];
		} else {
			$wpd_hide_pricing = '';
		}

		if ( ! isset( $wpd_settings['wpd_content_placement'] ) ) {
			$wpd_content_placement = '';
		} else {
			$wpd_content_placement = $wpd_settings['wpd_content_placement'];
		}

		if ( null === $wpd_settings['wpd_cost_phrase'] || 'Price' === $wpd_settings['wpd_cost_phrase'] ) {
			$wpd_cost_phrase = 'Pricing';
		} else {
			$wpd_cost_phrase = 'Donation';
		}

		global $post;

		/**
		 * Adding the WP Dispensary menu item data
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

		if ( get_the_term_list( $post->ID, 'vendor', true ) ) {
			$wpdvendors = '<tr><td><span>Vendor:</span></td><td>' . get_the_term_list( $post->ID, 'vendor', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdvendors = '';
		}

		if ( get_post_meta( get_the_ID(), '_thc', true ) ) {
			$wpdthc = '<tr><td><span>THC:</span></td><td>' . get_post_meta( get_the_id(), '_thc', true ) . '%</td></tr>';
		} else {
			$wpdthc = '';
		}

		if ( get_post_meta( get_the_ID(), '_thca', true ) ) {
			$wpdthca = '<tr><td><span>THCA:</span></td><td>' . get_post_meta( get_the_id(), '_thca', true ) . '%</td></tr>';
		} else {
			$wpdthca = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbd', true ) ) {
			$wpdcbd = '<tr><td><span>CBD:</span></td><td>' . get_post_meta( get_the_id(), '_cbd', true ) . '%</td></tr>';
		} else {
			$wpdcbd = '';
		}

		if ( get_post_meta( get_the_ID(), '_cba', true ) ) {
			$wpdcba = '<tr><td><span>CBA:</span></td><td>' . get_post_meta( get_the_id(), '_cba', true ) . '%</td></tr>';
		} else {
			$wpdcba = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbn', true ) ) {
			$wpdcbn = '<tr><td><span>CBN:</span></td><td>' . get_post_meta( get_the_id(), '_cbn', true ) . '%</td></tr>';
		} else {
			$wpdcbn = '';
		}

		if ( get_post_meta( get_the_ID(), '_thcmg', true ) ) {
			$wpdthcmg = '<tr><td><span>THC mg per serving:</span></td><td>' . get_post_meta( get_the_id(), '_thcmg', true ) . '</td></tr>';
		} else {
			$wpdthcmg = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbdmg', true ) ) {
			$wpdcbdmg = '<tr><td><span>CBD mg per serving:</span></td><td>' . get_post_meta( get_the_id(), '_cbdmg', true ) . '</td></tr>';
		} else {
			$wpdcbdmg = '';
		}

		if ( get_post_meta( get_the_ID(), '_thccbdservings', true ) ) {
			$wpdservings = '<tr><td><span>Servings:</span></td><td>' . get_post_meta( get_the_id(), '_thccbdservings', true ) . '</td></tr>';
		} else {
			$wpdservings = '';
		}

		if ( get_post_meta( get_the_ID(), '_netweight', true ) ) {
			$wpdnetweight = '<tr><td><span>Net weight:</span></td><td>' . get_post_meta( get_the_id(), '_netweight', true ) . 'g</td></tr>';
		} else {
			$wpdnetweight = '';
		}

		if ( get_post_meta( get_the_ID(), '_thctopical', true ) ) {
			$wpdthctopical = '<tr><td><span>THC:</span></td><td>' . get_post_meta( get_the_id(), '_thctopical', true ) . 'mg</td></tr>';
		} else {
			$wpdthctopical = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbdtopical', true ) ) {
			$wpdcbdtopical = '<tr><td><span>CBD:</span></td><td>' . get_post_meta( get_the_id(), '_cbdtopical', true ) . 'mg</td></tr>';
		} else {
			$wpdcbdtopical = '';
		}

		if ( get_post_meta( get_the_ID(), '_sizetopical', true ) ) {
			$wpdsizetopical = '<tr><td><span>Size:</span></td><td>' . get_post_meta( get_the_id(), '_sizetopical', true ) . ' (oz)</td></tr>';
		} else {
			$wpdsizetopical = '';
		}

		if ( get_post_meta( get_the_ID(), '_seedcount', true ) ) {
			$wpdseedcount = '<tr><td><span>Seeds per unit:</span></td><td>' . get_post_meta( get_the_id(), '_seedcount', true ) . '</td></tr>';
		} else {
			$wpdseedcount = '';
		}

		if ( get_post_meta( get_the_ID(), '_clonecount', true ) ) {
			$wpdclonecount = '<tr><td><span>Clones per unit:</span></td><td>' . get_post_meta( get_the_id(), '_clonecount', true ) . '</td></tr>';
		} else {
			$wpdclonecount = '';
		}

		if ( get_post_meta( get_the_ID(), '_origin', true ) ) {
			$wpdcloneorigin = '<tr><td><span>Origin:</span></td><td>' . get_post_meta( get_the_id(), '_origin', true ) . '</td></tr>';
		} else {
			$wpdcloneorigin = '';
		}

		if ( get_post_meta( get_the_ID(), '_time', true ) ) {
			$wpdclonetime = '<tr><td><span>Grow Time:</span></td><td>' . get_post_meta( get_the_id(), '_time', true ) . '</td></tr>';
		} else {
			$wpdclonetime = '';
		}

		if ( get_post_meta( get_the_ID(), '_yield', true ) ) {
			$wpdcloneyield = '<tr><td><span>Yield:</span></td><td>' . get_post_meta( get_the_id(), '_yield', true ) . '</td></tr>';
		} else {
			$wpdcloneyield = '';
		}

		if ( get_post_meta( get_the_ID(), '_difficulty', true ) ) {
			$wpdclonedifficulty = '<tr><td><span>Difficulty:</span></td><td>' . get_post_meta( get_the_id(), '_difficulty', true ) . '</td></tr>';
		} else {
			$wpdclonedifficulty = '';
		}

		if ( get_post_meta( get_the_ID(), '_selected_flowers', true ) ) {
			$prerollflower = get_post_meta( get_the_id(), '_selected_flowers', true );
			$wpdpreroll    = '<tr><td><span>Flower:</span></td><td><a href=' . get_permalink( $prerollflower ) . '>' . get_the_title( $prerollflower ) . '</a></td></tr>';
		} else {
			$wpdpreroll = '';
		}

		if ( get_post_meta( get_the_ID(), '_selected_flowers', true ) ) {
			$growerflower = get_post_meta( get_the_id(), '_selected_flowers', true );
			$wpdgrower    = '<tr><td><span>Flower:</span></td><td><a href=' . get_permalink( $growerflower ) . '>' . get_the_title( $growerflower ) . '</a></td></tr>';
		} else {
			$wpdgrower = '';
		}

		/**
		 * Setting up WP Dispensary menu pricing data
		 */
		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$wpdpriceeach = '<tr class="priceeach"><td><span>Price Each:</span></td><td>' . wpd_currency_code() . '' . get_post_meta( get_the_id(), '_priceeach', true ) . '</td></tr>';
		} else {
			$wpdpriceeach = '';
		}

		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$wpdpriceperunit = '<tr class="priceeach"><td><span>Price Each:</span></td><td>' . wpd_currency_code() . '' . get_post_meta( get_the_id(), '_priceeach', true ) . '</td></tr>';
		} else {
			$wpdpriceperunit = '';
		}

		if ( get_post_meta( get_the_ID(), '_pricetopical', true ) ) {
			$wpdpricetopical = '<tr class="priceeach"><td><span>Price per unit:</span></td><td>' . wpd_currency_code() . '' . get_post_meta( get_the_id(), '_pricetopical', true ) . '</td></tr>';
		} else {
			$wpdpricetopical = '';
		}

		if ( get_post_meta( get_the_ID(), '_halfgram', true ) ) {
			$wpdhalfgram = '<td><span>1/2 g:</span> ' . wpd_currency_code() . '' . get_post_meta( get_the_id(), '_halfgram', true ) . '</td>';
		} else {
			$wpdhalfgram = '';
		}

		if ( get_post_meta( get_the_ID(), '_gram', true ) ) {
			$wpdgram = '<td><span>1 g:</span> ' . wpd_currency_code() . '' . get_post_meta( get_the_id(), '_gram', true ) . '</td>';
		} else {
			$wpdgram = '';
		}

		if ( get_post_meta( get_the_ID(), '_twograms', true ) ) {
			$wpdtwograms = '<td><span>2 g:</span> ' . wpd_currency_code() . '' . get_post_meta( get_the_id(), '_twograms', true ) . '</td>';
		} else {
			$wpdtwograms = '';
		}

		if ( get_post_meta( get_the_ID(), '_eighth', true ) ) {
			$wpdeighth = '<td><span>1/8 oz:</span> ' . wpd_currency_code() . '' . get_post_meta( get_the_id(), '_eighth', true ) . '</td>';
		} else {
			$wpdeighth = '';
		}

		if ( get_post_meta( get_the_ID(), '_quarter', true ) ) {
			$wpdquarter = '<td><span>1/4 oz:</span> ' . wpd_currency_code() . '' . get_post_meta( get_the_id(), '_quarter', true ) . '</td>';
		} else {
			$wpdquarter = '';
		}

		if ( get_post_meta( get_the_ID(), '_halfounce', true ) ) {
			$wpdhalfounce = '<td><span>1/2 oz:</span> ' . wpd_currency_code() . '' . get_post_meta( get_the_id(), '_halfounce', true ) . '</td>';
		} else {
			$wpdhalfounce = '';
		}

		if ( get_post_meta( get_the_ID(), '_ounce', true ) ) {
			$wpdounce = '<td><span>1 oz:</span> ' . wpd_currency_code() . '' . get_post_meta( get_the_id(), '_ounce', true ) . '</td>';
		} else {
			$wpdounce = '';
		}

		$post_type = get_post_type_object( get_post_type( $post ) );

		/**
		 * Adding the WP Dispensary menu item data
		 */
		if ( in_array( get_post_type(), apply_filters( 'wpd_original_array', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
			$original = $content;
		}

		if ( in_array( get_post_type(), apply_filters( 'wpd_content_array', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
			$content = '';
		}

		/**
		 * Adding Details table
		 */
		if ( 'on' !== $wpd_hide_details ) {

			/**
			 * Details Table Before Action Hook
			 *
			 * @since      1.9.5
			 */
			if ( in_array( get_post_type(), apply_filters( 'wpd_dataoutput_before_array', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
				ob_start();
				do_action( 'wpd_dataoutput_before' );
				$wpddatabefore = ob_get_clean();
				$content .= $wpddatabefore;
			}

			if ( in_array( get_post_type(), apply_filters( 'wpd_dataoutput_title_array', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
				$content .= '<table class="wpdispensary-table single details"><tr><td class="wpdispensary-title" colspan="6">' . $post_type->labels->singular_name . ' Details</td></tr>';
			}

			/**
			 * Details Table Top Action Hook
			 *
			 * @since      1.9.5
			 */
			if ( in_array( get_post_type(), apply_filters( 'wpd_dataoutput_top_array', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
				ob_start();
				do_action( 'wpd_dataoutput_top' );
				$wpddatatop = ob_get_clean();
				$content   .= $wpddatatop;
			}

			if ( in_array( get_post_type(), array( 'flowers', 'concentrates' ) ) ) {
				$content .= $wpdaroma . $wpdflavor . $wpdeffect . $wpdsymptom . $wpdcondition . $wpdvendors;
			}

			if ( 'prerolls' === get_post_type() ) {
				$content .= $wpdpreroll . $wpdvendors;
			}

			if ( 'growers' === get_post_type() ) {
				$content .= $wpdseedcount . $wpdclonecount . $wpdcloneorigin . $wpdclonetime . $wpdcloneyield . $wpdclonedifficulty . $wpdvendors;
			}

			if ( 'edibles' === get_post_type() ) {
				$content .= $wpdthcmg . $wpdcbdmg . $wpdservings . $wpdnetweight . $wpdingredients . $wpdvendors;
			}

			if ( 'topicals' === get_post_type() ) {
				$content .= $wpdsizetopical . $wpdthctopical . $wpdcbdtopical . $wpdingredients . $wpdvendors;
			}

			if ( in_array( get_post_type(), array( 'flowers', 'concentrates' ) ) ) {
				$content .= $wpdthc . $wpdthca . $wpdcbd . $wpdcba . $wpdcbn;
			}

			/**
			 * Details Table Bottom Action Hook
			 *
			 * @since      1.8.0
			 */
			if ( in_array( get_post_type(), apply_filters( 'wpd_dataoutput_bottom_array', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
				ob_start();
				do_action( 'wpd_dataoutput_bottom' );
				$wpddatabottom = ob_get_clean();
				$content      .= $wpddatabottom;
			}

			if ( in_array( get_post_type(), apply_filters( 'wpd_dataoutput_end_array', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
				$content .= '</table>';
			}

			/**
			 * Details Table After Action Hook
			 *
			 * @since      1.9.5
			 */
			if ( in_array( get_post_type(), apply_filters( 'wpd_dataoutput_after_array', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
				ob_start();
				do_action( 'wpd_dataoutput_after' );
				$wpddataafter = ob_get_clean();
				$content     .= $wpddataafter;
			}
		}

		/**
		 * Adding Pricing table
		 */
		if ( 'on' !== $wpd_hide_pricing ) {

			/**
			 * Pricing Table Before Action Hook
			 *
			 * @since      1.9.5
			 */
			if ( in_array( get_post_type(), apply_filters( 'wpd_pricingoutput_before_array', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
				ob_start();
				do_action( 'wpd_pricingoutput_before' );
				$wpdpricingbefore = ob_get_clean();
				$content         .= $wpdpricingbefore;
			}

			if ( null === $wpd_settings['wpd_cost_phrase'] || 'Price' === $wpd_settings['wpd_cost_phrase'] ) {
				$wpd_cost = $post_type->labels->singular_name . ' Pricing';
			} else {
				$wpd_cost = 'Donation Amount';
			}

			if ( in_array( get_post_type(), apply_filters( 'wpd_pricingoutput_title_array', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
				$content .= '<table class="wpdispensary-table single pricing"><tr><td class="wpdispensary-title" colspan="6">' . $wpd_cost . '</td></tr>';
			}

			/**
			 * Pricing Table Top Action Hook
			 *
			 * @since      1.9.5
			 */
			if ( in_array( get_post_type(), apply_filters( 'wpd_pricingoutput_top_array', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
				ob_start();
				do_action( 'wpd_pricingoutput_top' );
				$wpdpricingtop = ob_get_clean();
				$content      .= $wpdpricingtop;
			}

			if ( in_array( get_post_type(), array( 'flowers' ) ) ) {
				$content .= '<tr>' . $wpdgram . $wpdeighth . $wpdquarter . $wpdhalfounce . $wpdounce . '</tr>';
			}

			if ( in_array( get_post_type(), array( 'concentrates' ) ) ) {
				if ( empty( $wpdpriceperunit ) ) {
					$content .= '<tr>' . $wpdhalfgram . $wpdgram . $wpdtwograms . '</tr>';
				} else {
					$content .= '<tr>' . $wpdpriceperunit . '</tr>';
				}
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
			if ( in_array( get_post_type(), apply_filters( 'wpd_pricingoutput_bottom_array', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
				ob_start();
				do_action( 'wpd_pricingoutput_bottom' );
				$wpdpricingbottom = ob_get_clean();
				$content         .= $wpdpricingbottom;
			}

			if ( in_array( get_post_type(), apply_filters( 'wpd_pricingoutput_end_array', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
				$content .= '</table>';
			}

			/**
			 * Pricing Table After Action Hook
			 *
			 * @since      1.9.5
			 */
			if ( in_array( get_post_type(), apply_filters( 'wpd_pricingoutput_after_array', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
				ob_start();
				do_action( 'wpd_pricingoutput_after' );
				$wpdpricingafter = ob_get_clean();
				$content        .= $wpdpricingafter;
			}
		}

		/**
		 * Conditional statement to output menu
		 * item details above or below the_content
		 */
		if ( in_array( get_post_type(), apply_filters( 'wpd_content_placement_array', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
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
