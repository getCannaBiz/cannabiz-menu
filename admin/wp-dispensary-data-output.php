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

if ( ! get_option( 'wpd-checkbox') == '1' ) { 

if ( ! function_exists( 'wpd_data_output_content' ) ) :

/**
 * Creating the menu item
 */

function wpd_data_output_content( $content ) {
	global $post;

	/**
	 * Setting up WP Dispensary menu item data
	 */
	if ( get_the_term_list( $post->ID, 'aroma', true ) ) {
		$wpdaroma = "<tr><td><span>Aromas:</span></td><td>" . get_the_term_list( $post->ID, 'aroma', '', ', ', '' ) . "</td></tr>";
	} else {
		$wpdaroma = "";
	}

	if ( get_the_term_list( $post->ID, 'flavor', true ) ) {
		$wpdflavor = "<tr><td><span>Flavors:</span></td><td>" . get_the_term_list( $post->ID, 'flavor', '', ', ', '' ) . "</td></tr>";
	} else {
		$wpdflavor = "";
	}

	if ( get_the_term_list( $post->ID, 'effect', true ) ) {
		$wpdeffect = "<tr><td><span>Effects:</span></td><td>" . get_the_term_list( $post->ID, 'effect', '', ', ', '' ) . "</td></tr>";
	} else {
		$wpdeffect = "";
	}

	if ( get_the_term_list( $post->ID, 'symptom', true ) ) {
		$wpdsymptom = "<tr><td><span>Symptoms:</span></td><td>" . get_the_term_list( $post->ID, 'symptom', '', ', ', '' ) . "</td></tr>";
	} else {
		$wpdsymptom = "";
	}
	if ( get_the_term_list( $post->ID, 'condition', true ) ) {
		$wpdcondition = "<tr><td><span>Conditions:</span></td><td>" . get_the_term_list( $post->ID, 'condition', '', ', ', '' ) . "</td></tr>";
	} else {
		$wpdcondition = "";
	}
	if ( get_the_term_list( $post->ID, 'ingredients', true ) ) {
		$wpdingredients = "<tr><td><span>Ingredients:</span></td><td>" . get_the_term_list( $post->ID, 'ingredients', '', ', ', '' ) . "</td></tr>";
	} else {
		$wpdingredients = "";
	}

	
	if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) {
		$wpdpriceeach = "<tr class='priceeach'><td><span>Price Each:</span></td><td>$" . get_post_meta(get_the_id(), '_priceeach', true) . "</td></tr>";
	} else {
		$wpdpriceeach = "";
	}		


	if ( get_post_meta( get_the_ID(), '_halfgram', true ) ) {
		$wpdhalfgram = "<td><span>1/2 gram:</span> $" . get_post_meta(get_the_id(), '_halfgram', true) ."</td>";
	} else {
		$wpdhalfgram = "";
	}
	if ( get_post_meta( get_the_ID(), '_gram', true ) ) {
		$wpdgram = "<td><span>1 gram:</span> $" . get_post_meta(get_the_id(), '_gram', true) ."</td>";
	} else {
		$wpdgram = "";
	}
	if ( get_post_meta( get_the_ID(), '_eighth', true ) ) {
		$wpdeighth = "<td><span>1/8 ounce:</span> $" . get_post_meta(get_the_id(), '_eighth', true) ."</td>";
	} else {
		$wpdeighth = "";
	}
	if ( get_post_meta( get_the_ID(), '_quarter', true ) ) {
		$wpdquarter = "<td><span>1/4 ounce:</span> $" . get_post_meta(get_the_id(), '_quarter', true) ."</td>";
	} else {
		$wpdquarter = "";
	}
	if ( get_post_meta( get_the_ID(), '_halfounce', true ) ) {
		$wpdhalfounce = "<td><span>1/2 ounce:</span> $" . get_post_meta(get_the_id(), '_halfounce', true) ."</td>";
	} else {
		$wpdhalfounce = "";
	}
	if ( get_post_meta( get_the_ID(), '_halfounce', true ) ) {
		$wpdounce = "<td><span>1 ounce:</span> $" . get_post_meta(get_the_id(), '_ounce', true) ."</td>";
	} else {
		$wpdounce = "";
	}

	if ( get_post_meta( get_the_ID(), '_thc', true ) ) {
		$wpdthc = "<tr><td><span>THC:</span></td><td>" . get_post_meta(get_the_id(), '_thc', true) ."%</td></tr>";
	} else {
		$wpdthc = "";
	}
	if ( get_post_meta( get_the_ID(), '_cbd', true ) ) {
		$wpdcbd = "<tr><td><span>CBD:</span></td><td>" . get_post_meta(get_the_id(), '_cbd', true) ."%</td></tr>";
	} else {
		$wpdcbd = "";
	}
	if ( get_post_meta( get_the_ID(), '_thcmg', true ) ) {
		$wpdthcmg = "<tr><td><span>mg per serving:</span></td><td>" . get_post_meta(get_the_id(), '_thcmg', true) ."</td></tr>";
	} else {
		$wpdthcmg = "";
	}
	if ( get_post_meta( get_the_ID(), '_thcservings', true ) ) {
		$wpdservings = "<tr><td><span>Servings:</span></td><td>" . get_post_meta(get_the_id(), '_thcservings', true) ."</td></tr>";
	} else {
		$wpdservings = "";
	}

	$post_type = get_post_type_object( get_post_type( $post ) );

	/**
	 * Adding the WP Dispensary menu item data
	 */
	if ( in_array( get_post_type(), array( 'flowers','concentrates','edibles' ) ) ) {
	$original = $content;
	}

	/**
	 * Adding Details table
	 */
	if ( in_array( get_post_type(), array( 'flowers','concentrates','edibles' ) ) ) {
	$content = "<table class='wpdispensary-table single'><tr><td class='wpdispensary-title' colspan='6'>" .  $post_type->labels->singular_name . " Details</td></tr>";
	}

	if ( in_array( get_post_type(), array( 'flowers','concentrates' ) ) ) {
	$content .= $wpdaroma . $wpdflavor . $wpdeffect . $wpdsymptom . $wpdcondition;
	}

	if ( 'edibles' === get_post_type() ) {
	$content .= $wpdingredients . $wpdthcmg . $wpdservings;
	}

	if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'prerolls','edibles' ) ) ) {
	$content .= $wpdthc . $wpdcbd;
	}

	if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'prerolls','edibles' ) ) ) {
	$content .= "</table>";
	}

	/**
	 * Adding Pricing table
	 */
	if ( in_array( get_post_type(), array( 'flowers','concentrates','prerolls','edibles' ) ) ) {
	$content .= "<table class='wpdispensary-table single pricing'><tr><td class='wpdispensary-title' colspan='6'>" .  $post_type->labels->singular_name . " Pricing</td></tr>";
	}

	if ( in_array( get_post_type(), array( 'flowers', 'concentrates' ) ) ) {
	$content .= "<tr>" . $wpdhalfgram . $wpdgram . $wpdeighth . $wpdquarter . $wpdhalfounce . $wpdounce . "</tr>";
	}

	if ( in_array( get_post_type(), array( 'prerolls', 'edibles' ) ) ) {
	$content .= $wpdpriceeach;
	}

	if ( in_array( get_post_type(), array( 'flowers', 'concentrates', 'prerolls','edibles' ) ) ) {
	$content .= "</table>";
	}

	if ( in_array( get_post_type(), array( 'flowers','concentrates','edibles' ) ) ) {
	$content .= $original;
	}
	return $content;

}
add_filter( 'the_content', 'wpd_data_output_content' );

endif;

}
