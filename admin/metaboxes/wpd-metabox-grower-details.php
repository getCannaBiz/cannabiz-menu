<?php
/**
 * WP Dispensary Metabox - Grower Details
 *
 * This file is used to define the grower details metabox of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/partials
 */


/**
 * Growers Clone Details metabox
 *
 * Adds a clone details metabox to the products post type.
 *
 * @since    1.9.5
 */
function wp_dispensary_grower_details_metabox() {
    // Add metabox.
	add_meta_box(
		'wp_dispensary_grower_details',
		esc_html__( 'Grow details', 'wp-dispensary' ),
		'wp_dispensary_grower_details_metabox_content',
		'products',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'wp_dispensary_grower_details_metabox' );

/**
 * Building the metabox
 */
function wp_dispensary_grower_details_metabox_content() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="wpd_grower_details_meta_noncename" id="wpd_grower_details_meta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the origin data if its already been entered */
	$origin     = get_post_meta( $post->ID, 'product_origin', true );
	$time       = get_post_meta( $post->ID, 'product_time', true );
	$yield      = get_post_meta( $post->ID, 'product_yield', true );
	$difficulty = get_post_meta( $post->ID, 'product_difficulty', true );

	/** Echo out the fields */
	echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Origin', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="product_origin" value="' . esc_html( $origin ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Grow time', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="product_time" value="' . esc_html( $time ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Yield', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="product_yield" value="' . esc_html( $yield ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Difficulty', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="product_difficulty" value="' . esc_html( $difficulty ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 * 
 * @return void
 */
function wp_dispensary_grower_details_metabox_save( $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if (
		null == filter_input( INPUT_POST, 'wpd_grower_details_meta_noncename' ) ||
		! wp_verify_nonce( filter_input( INPUT_POST, 'wpd_grower_details_meta_noncename' ), plugin_basename( __FILE__ ) )
	) {
		return $post->ID;
	}

	/** Is the user allowed to edit the post or page? */
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	/**
	 * OK, we're authenticated: we need to find and save the data
	 * We'll put it into an array to make it easier to loop though.
	 */

	$details_meta['product_origin']     = esc_html( filter_input( INPUT_POST, 'product_origin' ) );
	$details_meta['product_time']       = esc_html( filter_input( INPUT_POST, 'product_time' ) );
	$details_meta['product_yield']      = esc_html( filter_input( INPUT_POST, 'product_yield' ) );
	$details_meta['product_difficulty'] = esc_html( filter_input( INPUT_POST, 'product_difficulty' ) );

	// Save $details_meta as metadata.
	foreach ( $details_meta as $key => $value ) {
		// Bail on post revisions.
		if ( 'revision' === $post->post_type ) {
			return;
		}
		$value = implode( ',', (array) $value );
		// Check for meta value and either update or add the metadata.
		if ( get_post_meta( $post->ID, $key, false ) ) {
			update_post_meta( $post->ID, $key, $value );
		} else {
			add_post_meta( $post->ID, $key, $value );
		}
		// Delete the metavalue if blank.
		if ( ! $value ) {
			delete_post_meta( $post->ID, $key );
		}
	}
}
add_action( 'save_post', 'wp_dispensary_grower_details_metabox_save', 1, 1 );
