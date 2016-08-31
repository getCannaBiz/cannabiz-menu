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
			$wpdpriceeach = '<tr class="priceeach"><td><span>Price Each:</span></td><td>$' . get_post_meta( get_the_id(), '_priceeach', true ) . '</td></tr>';
		} else {
			$wpdpriceeach = '';
		}

		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
			$wpdpriceperunit = '<tr class="priceeach"><td><span>Price per unit:</span></td><td>$' . get_post_meta( get_the_id(), '_priceeach', true ) . '</td></tr>';
		} else {
			$wpdpriceperunit = '';
		}

		if ( get_post_meta( get_the_ID(), '_pricetopical', true ) ) {
			$wpdpricetopical = '<tr class="priceeach"><td><span>Price per unit:</span></td><td>$' . get_post_meta( get_the_id(), '_pricetopical', true ) . '</td></tr>';
		} else {
			$wpdpricetopical = '';
		}

		if ( get_post_meta( get_the_ID(), '_halfgram', true ) ) {
			$wpdhalfgram = '<td><span>1/2 g:</span> $' . get_post_meta( get_the_id(), '_halfgram', true ) .'</td>';
		} else {
			$wpdhalfgram = '';
		}

		if ( get_post_meta( get_the_ID(), '_gram', true ) ) {
			$wpdgram = '<td><span>1 g:</span> $' . get_post_meta( get_the_id(), '_gram', true ) .'</td>';
		} else {
			$wpdgram = '';
		}

		if ( get_post_meta( get_the_ID(), '_eighth', true ) ) {
			$wpdeighth = '<td><span>1/8 oz:</span> $' . get_post_meta( get_the_id(), '_eighth', true ) .'</td>';
		} else {
			$wpdeighth = '';
		}

		if ( get_post_meta( get_the_ID(), '_quarter', true ) ) {
			$wpdquarter = '<td><span>1/4 oz:</span> $' . get_post_meta( get_the_id(), '_quarter', true ) .'</td>';
		} else {
			$wpdquarter = '';
		}

		if ( get_post_meta( get_the_ID(), '_halfounce', true ) ) {
			$wpdhalfounce = '<td><span>1/2 oz:</span> $' . get_post_meta( get_the_id(), '_halfounce', true ) .'</td>';
		} else {
			$wpdhalfounce = '';
		}

		if ( get_post_meta( get_the_ID(), '_halfounce', true ) ) {
			$wpdounce = '<td><span>1 oz:</span> $' . get_post_meta( get_the_id(), '_ounce', true ) .'</td>';
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
		if ( ! get_option( 'wpd-hidedetails' ) == '1' ) {

			if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'prerolls', 'edibles', 'topicals', 'growers' ) ) ) {
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

			if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'edibles', 'topicals', 'growers' ) ) ) {
				$content .= '</table>';
			}
		}

		/**
		 * Adding Pricing table
		 */
		if ( ! get_option( 'wpd-hidepricing' ) == '1' ) {

			if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'prerolls', 'edibles', 'topicals', 'growers' ) ) ) {
				$content .= '<table class="wpdispensary-table single pricing"><tr><td class="wpdispensary-title" colspan="6">' .  $post_type->labels->singular_name . ' Pricing</td></tr>';
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

			if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'prerolls', 'edibles', 'topicals', 'growers' ) ) ) {
				$content .= '</table>';
			}

		}

		/**
		 * Conditional statement to output menu
		 * item details above or below the_content
		 */
		if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) {
			if ( ! get_option( 'wpd-placement' ) == '1' ) {
				$content .= $original;
			} else {
				$content = $original . $content;
			}
		}

		return $content;

	}
	add_filter( 'the_content', 'wpd_data_output_content' );

}
