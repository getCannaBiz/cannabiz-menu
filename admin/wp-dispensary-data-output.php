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

		global $post;

		/**
		 * Access all settings
		 */
		$wpd_settings = get_option( 'wpdas_display' );

		// Get post type.
		$post_type         = get_post_type_object( get_post_type( $post ) );
		// Get menu types.
		$menu_types        = wpd_menu_types();
		// Create new menu type array.
		$menu_types_simple = array();
	
		// Loop through menu types
		foreach ( $menu_types as $key=>$value ) {
			// Strip wpd- from the menu type name.
			$name = str_replace( "wpd-", "", $key );
			// Add menu type name to new array.
			$menu_types_simple[] = $name;
		}
	
		/**
		 * Adding the WP Dispensary menu item data
		 */
		if ( in_array( get_post_type(), apply_filters( 'wpd_original_array', $menu_types_simple ) ) ) {
			$original = $content;
		}

		if ( in_array( get_post_type(), apply_filters( 'wpd_content_array', $menu_types_simple ) ) ) {
			$content = '';
		}

		/**
		 * Adding Details table
		 */

		/**
		 * Setting up WP Dispensary menu item data
		 */
		if ( get_the_term_list( $post->ID, 'shelf_type', true ) ) {
			$wpdshelftype = '<tr><td><span>' . __( 'Shelf', 'wp-dispensary' ) . '</span></td><td>' . get_the_term_list( $post->ID, 'shelf_type', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdshelftype = '';
		}

		if ( get_the_term_list( $post->ID, 'strain_type', true ) ) {
			$wpdstraintype = '<tr><td><span>' . __( 'Strain', 'wp-dispensary' ) . '</span></td><td>' . get_the_term_list( $post->ID, 'strain_type', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdstraintype = '';
		}

		 if ( get_the_term_list( $post->ID, 'aroma', true ) ) {
			$wpdaroma = '<tr><td><span>' . __( 'Aromas', 'wp-dispensary' ) . '</span></td><td>' . get_the_term_list( $post->ID, 'aroma', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdaroma = '';
		}

		if ( get_the_term_list( $post->ID, 'flavor', true ) ) {
			$wpdflavor = '<tr><td><span>' . __( 'Flavors', 'wp-dispensary' ) . '</span></td><td>' . get_the_term_list( $post->ID, 'flavor', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdflavor = '';
		}

		if ( get_the_term_list( $post->ID, 'effect', true ) ) {
			$wpdeffect = '<tr><td><span>' . __( 'Effects', 'wp-dispensary' ) . '</span></td><td>' . get_the_term_list( $post->ID, 'effect', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdeffect = '';
		}

		if ( get_the_term_list( $post->ID, 'symptom', true ) ) {
			$wpdsymptom = '<tr><td><span>' . __( 'Symptoms', 'wp-dispensary' ) . '</span></td><td>' . get_the_term_list( $post->ID, 'symptom', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdsymptom = '';
		}

		if ( get_the_term_list( $post->ID, 'condition', true ) ) {
			$wpdcondition = '<tr><td><span>' . __( 'Conditions', 'wp-dispensary' ) . '</span></td><td>' . get_the_term_list( $post->ID, 'condition', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdcondition = '';
		}

		if ( get_the_term_list( $post->ID, 'ingredients', true ) ) {
			$wpdingredients = '<tr><td><span>' . __( 'Ingredients', 'wp-dispensary' ) . '</span></td><td>' . get_the_term_list( $post->ID, 'ingredients', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdingredients = '';
		}

		if ( get_the_term_list( $post->ID, 'vendor', true ) ) {
			$wpdvendors = '<tr><td><span>' . __( 'Vendor', 'wp-dispensary' ) . '</span></td><td>' . get_the_term_list( $post->ID, 'vendor', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdvendors = '';
		}

		if ( get_the_term_list( $post->ID, 'allergens', true ) ) {
			$wpdallergens = '<tr><td><span>' . __( 'Allergens', 'wp-dispensary' ) . '</span></td><td>' . get_the_term_list( $post->ID, 'allergens', '', ', ', '' ) . '</td></tr>';
		} else {
			$wpdallergens = '';
		}

		if ( get_post_meta( get_the_ID(), '_thc', true ) ) {
			$wpdthc = '<td><span>' . __( 'THC', 'wp-dispensary' ) . '</span>' . get_post_meta( get_the_id(), '_thc', true ) . '%</td>';
		} else {
			$wpdthc = '';
		}

		if ( get_post_meta( get_the_ID(), '_thca', true ) ) {
			$wpdthca = '<td><span>' . __( 'THCA', 'wp-dispensary' ) . '</span>' . get_post_meta( get_the_id(), '_thca', true ) . '%</td>';
		} else {
			$wpdthca = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbd', true ) ) {
			$wpdcbd = '<td><span>' . __( 'CBD', 'wp-dispensary' ) . '</span>' . get_post_meta( get_the_id(), '_cbd', true ) . '%</td>';
		} else {
			$wpdcbd = '';
		}

		if ( get_post_meta( get_the_ID(), '_cba', true ) ) {
			$wpdcba = '<td><span>' . __( 'CBA', 'wp-dispensary' ) . '</span>' . get_post_meta( get_the_id(), '_cba', true ) . '%</td>';
		} else {
			$wpdcba = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbn', true ) ) {
			$wpdcbn = '<td><span>' . __( 'CBN', 'wp-dispensary' ) . '</span>' . get_post_meta( get_the_id(), '_cbn', true ) . '%</td>';
		} else {
			$wpdcbn = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbg', true ) ) {
			$wpdcbg = '<td><span>' . __( 'CBG', 'wp-dispensary' ) . '</span>' . get_post_meta( get_the_id(), '_cbg', true ) . '%</td>';
		} else {
			$wpdcbg = '';
		}

		if ( get_post_meta( get_the_ID(), '_thcmg', true ) ) {
			$wpdthcmg = '<tr><td><span>' . __( 'THC mg per serving', 'wp-dispensary' ) . '</span></td><td>' . get_post_meta( get_the_id(), '_thcmg', true ) . '</td></tr>';
		} else {
			$wpdthcmg = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbdmg', true ) ) {
			$wpdcbdmg = '<tr><td><span>' . __( 'CBD mg per serving', 'wp-dispensary' ) . '</span></td><td>' . get_post_meta( get_the_id(), '_cbdmg', true ) . '</td></tr>';
		} else {
			$wpdcbdmg = '';
		}

		if ( get_post_meta( get_the_ID(), '_thccbdservings', true ) ) {
			$wpdservings = '<tr><td><span>' . __( 'Servings', 'wp-dispensary' ) . '</span></td><td>' . get_post_meta( get_the_id(), '_thccbdservings', true ) . '</td></tr>';
		} else {
			$wpdservings = '';
		}

		if ( get_post_meta( get_the_ID(), '_netweight', true ) ) {
			$wpdnetweight = '<tr><td><span>' . __( 'Net weight', 'wp-dispensary' ) . '</span></td><td>' . get_post_meta( get_the_id(), '_netweight', true ) . 'g</td></tr>';
		} else {
			$wpdnetweight = '';
		}

		if ( get_post_meta( get_the_ID(), '_thctopical', true ) ) {
			$wpdthctopical = '<tr><td><span>' . __( 'THC', 'wp-dispensary' ) . '</span></td><td>' . get_post_meta( get_the_id(), '_thctopical', true ) . 'mg</td></tr>';
		} else {
			$wpdthctopical = '';
		}

		if ( get_post_meta( get_the_ID(), '_cbdtopical', true ) ) {
			$wpdcbdtopical = '<tr><td><span>' . __( 'CBD', 'wp-dispensary' ) . '</span></td><td>' . get_post_meta( get_the_id(), '_cbdtopical', true ) . 'mg</td></tr>';
		} else {
			$wpdcbdtopical = '';
		}

		if ( get_post_meta( get_the_ID(), '_sizetopical', true ) ) {
			$wpdsizetopical = '<tr><td><span>' . __( 'Size', 'wp-dispensary' ) . '</span></td><td>' . get_post_meta( get_the_id(), '_sizetopical', true ) . ' (oz)</td></tr>';
		} else {
			$wpdsizetopical = '';
		}

		if ( get_post_meta( get_the_ID(), '_seedcount', true ) ) {
			$wpdseedcount = '<tr><td><span>' . __( 'Seeds per unit', 'wp-dispensary' ) . '</span></td><td>' . get_post_meta( get_the_id(), '_seedcount', true ) . '</td></tr>';
		} else {
			$wpdseedcount = '';
		}

		if ( get_post_meta( get_the_ID(), '_clonecount', true ) ) {
			$wpdclonecount = '<tr><td><span>' . __( 'Clones per unit', 'wp-dispensary' ) . '</span></td><td>' . get_post_meta( get_the_id(), '_clonecount', true ) . '</td></tr>';
		} else {
			$wpdclonecount = '';
		}

		if ( get_post_meta( get_the_ID(), '_origin', true ) ) {
			$wpdcloneorigin = '<tr><td><span>' . __( 'Origin', 'wp-dispensary' ) . '</span></td><td>' . get_post_meta( get_the_id(), '_origin', true ) . '</td></tr>';
		} else {
			$wpdcloneorigin = '';
		}

		if ( get_post_meta( get_the_ID(), '_time', true ) ) {
			$wpdclonetime = '<tr><td><span>' . __( 'Grow time', 'wp-dispensary' ) . '</span></td><td>' . get_post_meta( get_the_id(), '_time', true ) . '</td></tr>';
		} else {
			$wpdclonetime = '';
		}

		if ( get_post_meta( get_the_ID(), '_yield', true ) ) {
			$wpdcloneyield = '<tr><td><span>' . __( 'Yield', 'wp-dispensary' ) . '</span></td><td>' . get_post_meta( get_the_id(), '_yield', true ) . '</td></tr>';
		} else {
			$wpdcloneyield = '';
		}

		if ( get_post_meta( get_the_ID(), '_difficulty', true ) ) {
			$wpdclonedifficulty = '<tr><td><span>' . __( 'Difficulty', 'wp-dispensary' ) . '</span></td><td>' . get_post_meta( get_the_id(), '_difficulty', true ) . '</td></tr>';
		} else {
			$wpdclonedifficulty = '';
		}

		if ( get_post_meta( get_the_ID(), '_preroll_weight', true ) ) {
			$wpdprerollweight = '<tr><td><span>' . __( 'Weight', 'wp-dispensary' ) . '</span></td><td>' . get_post_meta( get_the_id(), '_preroll_weight', true ) . 'g</td></tr>';
		} else {
			$wpdprerollweight = '';
		}

		if ( get_post_meta( get_the_ID(), '_selected_flowers', true ) ) {
			$prerollflower = get_post_meta( get_the_id(), '_selected_flowers', true );
			$wpdpreroll    = '<tr><td><span>' . __( 'Flower', 'wp-dispensary' ) . '</span></td><td><a href=' . get_permalink( $prerollflower ) . '>' . get_the_title( $prerollflower ) . '</a></td></tr>';
		} else {
			$wpdpreroll = '';
		}

		if ( get_post_meta( get_the_ID(), '_selected_flowers', true ) ) {
			$growerflower = get_post_meta( get_the_id(), '_selected_flowers', true );
			$wpdgrower    = '<tr><td><span>' . __( 'Flower', 'wp-dispensary' ) . '</span></td><td><a href=' . get_permalink( $growerflower ) . '>' . get_the_title( $growerflower ) . '</a></td></tr>';
		} else {
			$wpdgrower = '';
		}

		/**
		 * Details Table Before Action Hook
		 *
		 * @since      1.9.5
		 */
		if ( in_array( get_post_type(), apply_filters( 'wpd_dataoutput_before_array', $menu_types_simple ) ) ) {
			ob_start();
			do_action( 'wpd_dataoutput_before' );
			$wpddatabefore = ob_get_clean();
		}

		/**
		 * Details Table Top Action Hook
		 *
		 * @since      1.9.5
		 */
		if ( in_array( get_post_type(), apply_filters( 'wpd_dataoutput_top_array', $menu_types_simple ) ) ) {
			ob_start();
			do_action( 'wpd_dataoutput_top' );
			$wpddatatop = ob_get_clean();
		}

		if ( in_array( get_post_type(), apply_filters( 'wpd_dataoutput_title_array', $menu_types_simple ) ) ) {
			$wpd_details_table_top = $wpddatabefore . '<table class="wpdispensary-table single details"><thead><tr><td class="wpdispensary-title" colspan="7">' . get_wpd_details_phrase() . '</td></tr></thead><tbody class="wpdispensary-details">' . $wpddatatop;
		} else {
			$wpd_details_table_top = '';
		}

		if ( in_array( get_post_type(), array( 'flowers', 'concentrates' ) ) ) {
			$wpd_details_flowers_concentrates = $wpdaroma . $wpdflavor . $wpdeffect . $wpdsymptom . $wpdcondition . $wpdvendors;
		} else {
			$wpd_details_flowers_concentrates = '';
		}

		if ( 'edibles' === get_post_type() ) {
			$wpd_details_edibles = $wpdservings . $wpdthcmg . $wpdcbdmg . $wpdnetweight . $wpdingredients . $wpdallergens . $wpdvendors;
		} else {
			$wpd_details_edibles = '';
		}

		if ( 'prerolls' === get_post_type() ) {
			$wpd_details_prerolls = $wpdpreroll . $wpdprerollweight . $wpdvendors;
		} else {
			$wpd_details_prerolls = '';
		}

		if ( 'topicals' === get_post_type() ) {
			$wpd_details_topicals = $wpdsizetopical . $wpdthctopical . $wpdcbdtopical . $wpdingredients . $wpdvendors;
		} else {
			$wpd_details_topicals = '';
		}

		if ( 'growers' === get_post_type() ) {
			$wpd_details_growers = $wpdseedcount . $wpdclonecount . $wpdcloneorigin . $wpdclonetime . $wpdcloneyield . $wpdclonedifficulty . $wpdvendors;
		} else {
			$wpd_details_growers = '';
		}

		// Compounds table.
		if ( in_array( get_post_type(), array( 'flowers', 'concentrates' ) ) ) {
			if ( empty( $wpdthc ) && empty( $wpdthca ) && empty( $wpdcbd ) && empty( $wpdtha ) && empty( $wpdcbn ) && empty( $wpdcbg ) ) {
				$wpd_details_compounds = '';
			} else {
				// Get compounds.
				$compounds = get_wpd_compounds_array( $type = '%', array( 'thc', 'thca', 'cbd', 'cba', 'cbn', 'cbg' ) );

				//print_r( $compounds );

				// Create empty variable.
				$showcompounds = '';

				// Loop through each compound, and append it to variable.
				foreach ( $compounds as $compound=>$value ) {
					$showcompounds .= '<td><strong>' . $compound . '</strong> ' . $value . '</td>';
				}

				// Combine compounds into one variable.
				$showcompounds = $showcompounds;

				$wpd_details_compounds = '<table class="wpdispensary-table single details compound-details"><tr><td class="wpdispensary-title" colspan="6">' . __( 'Compounds', 'wp-dispensary' ) . '</td></tr><tr>' . $showcompounds . '</tr></table>';
			}
		} else {
			$wpd_details_compounds = '';
		}

		/**
		 * Details Table Bottom Action Hook
		 *
		 * @since      1.8.0
		 */
		if ( in_array( get_post_type(), apply_filters( 'wpd_dataoutput_bottom_array', $menu_types_simple ) ) ) {
			ob_start();
			do_action( 'wpd_dataoutput_bottom' );
			$wpddatabottom = ob_get_clean();
		}

		if ( in_array( get_post_type(), apply_filters( 'wpd_dataoutput_end_array', $menu_types_simple ) ) ) {
			$wpd_details_table_bottom = $wpddatabottom . '</tbody></table>';
		} else {
			$wpd_details_table_bottom = '';
		}

		/**
		 * Details table build
		 */
		if ( ! isset( $wpd_settings['wpd_hide_details'] ) ) {
			$wpd_table_details = $wpd_details_compounds . $wpd_details_table_top . $wpd_details_flowers_concentrates . $wpd_details_prerolls . $wpd_details_growers . $wpd_details_edibles . $wpd_details_topicals . $wpd_details_table_bottom;
		} elseif ( isset( $wpd_settings['wpd_hide_details'] ) && 'on' !== $wpd_settings['wpd_hide_details'] ) {
			$wpd_table_details = $wpd_details_compounds . $wpd_details_table_top . $wpd_details_flowers_concentrates . $wpd_details_prerolls . $wpd_details_growers . $wpd_details_edibles . $wpd_details_topicals . $wpd_details_table_bottom;
		} else {
			$wpd_table_details = '';
		}

		/**
		 * Setting up WP Dispensary menu pricing data
		 */
		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$wpdpriceeach = '<tr class="priceeach"><td><span>' . __( 'Price each:', 'wp-dispensary' ) . '</span></td><td>' . wpd_currency_code() . get_post_meta( get_the_id(), '_priceeach', true ) . '</td></tr>';
		} else {
			$wpdpriceeach = '';
		}

		if ( get_post_meta( get_the_ID(), '_priceperpack', true ) ) {
			$wpdpriceperpack = '<tr class="priceeach"><td><span>' . get_post_meta( get_the_ID(), '_unitsperpack', true ) . ' ' . __( 'per pack:', 'wp-dispensary' ) . '</span></td><td>' . wpd_currency_code() . get_post_meta( get_the_ID(), '_priceperpack', true ) . '</td></tr>';
		} else {
			$wpdpriceperpack = '';
		}

		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$wpdpriceperunit = '<tr class="priceeach"><td><span>' . __( 'Price each:', 'wp-dispensary' ) . '</span></td><td>' . wpd_currency_code() . get_post_meta( get_the_id(), '_priceeach', true ) . '</td></tr>';
		} else {
			$wpdpriceperunit = '';
		}

		if ( get_post_meta( get_the_ID(), '_pricetopical', true ) ) {
			$wpdpricetopical = '<tr class="priceeach"><td><span>' . __( 'Price per unit:', 'wp-dispensary' ) . '</span></td><td>' . wpd_currency_code() . get_post_meta( get_the_id(), '_pricetopical', true ) . '</td></tr>';
		} else {
			$wpdpricetopical = '';
		}

		if ( get_post_meta( get_the_ID(), '_halfgram', true ) ) {
			$wpdhalfgram = '<td><span>' . __( '1/2 g', 'wp-dispensary' ) . '</span> ' . wpd_currency_code() . get_post_meta( get_the_id(), '_halfgram', true ) . '</td>';
		} else {
			$wpdhalfgram = '';
		}

		if ( get_post_meta( get_the_ID(), '_gram', true ) ) {
			$wpdgram = '<td><span>' . __( '1 g', 'wp-dispensary' ) . '</span> ' . wpd_currency_code() . get_post_meta( get_the_id(), '_gram', true ) . '</td>';
		} else {
			$wpdgram = '';
		}

		if ( get_post_meta( get_the_ID(), '_twograms', true ) ) {
			$wpdtwograms = '<td><span>' . __( '2 g', 'wp-dispensary' ) . '</span> ' . wpd_currency_code() . get_post_meta( get_the_id(), '_twograms', true ) . '</td>';
		} else {
			$wpdtwograms = '';
		}

		if ( get_post_meta( get_the_ID(), '_eighth', true ) ) {
			$wpdeighth = '<td><span>' . __( '1/8 oz', 'wp-dispensary' ) . '</span> ' . wpd_currency_code() . get_post_meta( get_the_id(), '_eighth', true ) . '</td>';
		} else {
			$wpdeighth = '';
		}

		if ( get_post_meta( get_the_ID(), '_fivegrams', true ) ) {
			$wpdfivegrams = '<td><span>' . __( '5 g', 'wp-dispensary' ) . '</span> ' . wpd_currency_code() . get_post_meta( get_the_id(), '_fivegrams', true ) . '</td>';
		} else {
			$wpdfivegrams = '';
		}

		if ( get_post_meta( get_the_ID(), '_quarter', true ) ) {
			$wpdquarter = '<td><span>' . __( '1/4 oz', 'wp-dispensary' ) . '</span> ' . wpd_currency_code() . get_post_meta( get_the_id(), '_quarter', true ) . '</td>';
		} else {
			$wpdquarter = '';
		}

		if ( get_post_meta( get_the_ID(), '_halfounce', true ) ) {
			$wpdhalfounce = '<td><span>' . __( '1/2 oz', 'wp-dispensary' ) . '</span> ' . wpd_currency_code() . get_post_meta( get_the_id(), '_halfounce', true ) . '</td>';
		} else {
			$wpdhalfounce = '';
		}

		if ( get_post_meta( get_the_ID(), '_ounce', true ) ) {
			$wpdounce = '<td><span>' . __( '1 oz', 'wp-dispensary' ) . '</span> ' . wpd_currency_code() . get_post_meta( get_the_id(), '_ounce', true ) . '</td>';
		} else {
			$wpdounce = '';
		}

		/**
		 * Pricing Table Before Action Hook
		 *
		 * @since      1.9.5
		 */
		if ( in_array( get_post_type(), apply_filters( 'wpd_pricingoutput_before_array', $menu_types_simple ) ) ) {
			ob_start();
			do_action( 'wpd_pricingoutput_before' );
			$wpdpricingbefore = ob_get_clean();
		}

		/**
		 * Pricing Table Top Action Hook
		 *
		 * @since      1.9.5
		 */
		if ( in_array( get_post_type(), apply_filters( 'wpd_pricingoutput_top_array', $menu_types_simple ) ) ) {
			ob_start();
			do_action( 'wpd_pricingoutput_top' );
			$wpdpricingtop = ob_get_clean();
		}

		/**
		 * Starting to build the Pricing table
		 */
		if ( in_array( get_post_type(), apply_filters( 'wpd_pricingoutput_before_array', $menu_types_simple ) ) ) {
			$wpd_pricing_table_top = $wpdpricingbefore . '<table class="wpdispensary-table single pricing"><thead><tr><td class="wpdispensary-title" colspan="7">' . esc_html( get_wpd_pricing_phrase( $singular = false ) ) . '</td></tr></thead><tbody class="wpdispensary-prices">' . $wpdpricingtop;
		} else {
			$wpd_pricing_table_top = '';
		}

		if ( in_array( get_post_type(), array( 'flowers' ) ) ) {
			$wpd_pricing_table_flowers = '<tr>' . $wpdgram . $wpdtwograms . $wpdeighth . $wpdfivegrams . $wpdquarter . $wpdhalfounce . $wpdounce . '</tr>';
		} else {
			$wpd_pricing_table_flowers = '';
		}

		if ( in_array( get_post_type(), array( 'concentrates' ) ) ) {
			if ( empty( $wpdpriceperunit ) ) {
				$wpd_pricing_table_concentrates = '<tr>' . $wpdhalfgram . $wpdgram . $wpdtwograms . '</tr>';
			} else {
				$wpd_pricing_table_concentrates = '<tr>' . $wpdpriceperunit . '</tr>';
			}
		} else {
			$wpd_pricing_table_concentrates = '';
		}

		if ( in_array( get_post_type(), array( 'prerolls', 'edibles' ) ) ) {
			$wpd_pricing_table_prerolls_edibles = $wpdpriceeach . $wpdpriceperpack;
		} else {
			$wpd_pricing_table_prerolls_edibles = '';
		}

		if ( in_array( get_post_type(), array( 'topicals' ) ) ) {
			$wpd_pricing_table_topicals = $wpdpricetopical;
		} else {
			$wpd_pricing_table_topicals = '';
		}

		if ( in_array( get_post_type(), array( 'growers' ) ) ) {
			$wpd_pricing_table_growers = $wpdpriceperunit . $wpdpriceperpack;
		} else {
			$wpd_pricing_table_growers = '';
		}

		/**
		 * Pricing Table Bottom Action Hook
		 *
		 * @since      1.8.0
		 */
		if ( in_array( get_post_type(), apply_filters( 'wpd_pricingoutput_bottom_array', $menu_types_simple ) ) ) {
			ob_start();
			do_action( 'wpd_pricingoutput_bottom' );
			$wpdpricingbottom = ob_get_clean();
		}

		/**
		 * Pricing Table After Action Hook
		 *
		 * @since      1.9.5
		 */
		if ( in_array( get_post_type(), apply_filters( 'wpd_pricingoutput_after_array', $menu_types_simple ) ) ) {
			ob_start();
			do_action( 'wpd_pricingoutput_after' );
			$wpdpricingafter = ob_get_clean();
		}

		if ( in_array( get_post_type(), apply_filters( 'wpd_pricingoutput_bottom_array', $menu_types_simple ) ) ) {
			$wpd_pricing_table_bottom = $wpdpricingbottom . '</tbody></table>' . $wpdpricingafter;
		} else {
			$wpd_pricing_table_bottom = '';
		}

		/**
		 * Price table build
		 */
		if ( ! isset( $wpd_settings['wpd_hide_pricing'] ) ) {
			$wpd_table_pricing = $wpd_pricing_table_top . $wpd_pricing_table_flowers . $wpd_pricing_table_concentrates . $wpd_pricing_table_prerolls_edibles . $wpd_pricing_table_growers . $wpd_pricing_table_topicals . $wpd_pricing_table_bottom;
		} elseif ( isset( $wpd_settings['wpd_hide_pricing'] ) && 'on' !== $wpd_settings['wpd_hide_pricing'] ) {
			$wpd_table_pricing = $wpd_pricing_table_top . $wpd_pricing_table_flowers . $wpd_pricing_table_concentrates . $wpd_pricing_table_prerolls_edibles . $wpd_pricing_table_growers . $wpd_pricing_table_topicals . $wpd_pricing_table_bottom;
		} else {
			$wpd_table_pricing = '';
		}

		/**
		 * Conditional statement to output menu
		 * item pricing above or below the_content
		 */
		if ( is_singular( apply_filters( 'wpd_pricing_table_placement_array', $menu_types_simple ) ) ) {

			// Pricing Placement.
			if ( isset( $wpd_settings['wpd_pricing_table_placement'] ) && 'above' !== $wpd_settings['wpd_pricing_table_placement'] ) {
				$wpd_pricing_below = $wpd_table_pricing;
			} else {
				$wpd_pricing_below = '';
			}

			// Pricing Placement.
			if ( ! isset( $wpd_settings['wpd_pricing_table_placement'] ) ) {
				$wpd_pricing_above = $wpd_table_pricing;
			} elseif ( isset( $wpd_settings['wpd_pricing_table_placement'] ) && 'below' !== $wpd_settings['wpd_pricing_table_placement'] ) {
				$wpd_pricing_above = $wpd_table_pricing;
			} else {
				$wpd_pricing_above = '';
			}

			// Details Placement.
			if ( ! isset( $wpd_settings['wpd_details_table_placement'] ) ) {
				$wpd_details_below = $wpd_table_details;
			} elseif ( isset( $wpd_settings['wpd_details_table_placement'] ) && 'above' !== $wpd_settings['wpd_details_table_placement'] ) {
				$wpd_details_below = $wpd_table_details;
			} else {
				$wpd_details_below = '';
			}

			// Details Placement.
			if ( isset( $wpd_settings['wpd_details_table_placement'] ) && 'below' !== $wpd_settings['wpd_details_table_placement'] ) {
				$wpd_details_above = $wpd_table_details;
			} else {
				$wpd_details_above = '';
			}

			// Apply before.
			$newcontent = $wpd_pricing_above . $wpd_details_above . $original . $wpd_pricing_below . $wpd_details_below;

			return $newcontent;
		} else {
			return $content;
		}

	}
	add_filter( 'the_content', 'wpd_data_output_content' );

}
