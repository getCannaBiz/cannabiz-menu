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
		$wpdingredients = "<tr><td><span>Ingredients</span></td><td></td></tr>";
	}
		if ( in_array( get_post_type(), array( 'flowers','concentrates','edibles' ) ) ) {
		$original = $content;
		}
		if ( in_array( get_post_type(), array( 'flowers','concentrates','edibles' ) ) ) {
		$content = "<table class='wpdispensary-table single'><tr><td class='wpdispensary-title' colspan='6'>Item Information</td></tr>";
		}
		if ( in_array( get_post_type(), array( 'flowers','concentrates' ) ) ) {
		$content .= $wpdaroma . $wpdflavor . $wpdeffect . $wpdsymptom . $wpdcondition;
		}
		if ( 'edibles' === get_post_type() ) {
		$content .= $wpdingredients;
		}
		if ( in_array( get_post_type(), array( 'flowers','concentrates','edibles' ) ) ) {
		$content .= "</table>";
		}

		if ( in_array( get_post_type(), array( 'flowers','concentrates','edibles' ) ) ) {
		$content .= $original;
		}
		return $content;
}
add_filter( 'the_content', 'wpd_data_output_content' );

endif;
