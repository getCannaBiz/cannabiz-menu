<?php
/**
 * WP Dispensary Metabox - Product Prices
 *
 * This file is used to define the product prices metabox of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/partials
 */


/**
 * Product Prices metabox
 *
 * Adds a product prices metabox to all of the above custom post types
 *
 * @since    1.0.0
 */
function wp_dispensary_product_prices_metabox() {
	// Add metabox.
	add_meta_box(
		'wp_dispensary_product_prices',
		esc_html__( 'Product prices', 'wp-dispensary' ),
		'wp_dispensary_product_prices_metabox_content',
		'products',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'wp_dispensary_product_prices_metabox' );

/**
 * Product Prices
 * 
 * @return void
 */
function wp_dispensary_product_prices_metabox_content() {
	global $post;

	/** Noncename needed to verify where the data originated */
	$string = '<input type="hidden" name="wpd_product_prices_meta_noncename" id="wpd_product_prices_meta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	// Get product prices.
	$product_prices = wpd_product_prices();

	// Loop through product prices.
	foreach ( $product_prices as $key=>$value ) {
		$string .= '<div class="input-field product-price">';
		$string .= '<p>' . $value . '</p>';
		$string .= '<input type="text" name="' . $key . '" value="' . get_post_meta( $post->ID, $key, true ) . '" class="widefat" />';
		$string .= '</div>';
	}

	// Get concentrates prices.
	$concentrates_prices = wpd_product_prices( 'concentrates' );

	// Loop through concentrates prices.
	foreach ( $concentrates_prices as $key=>$value ) {
		$string .= '<div class="input-field concentrates-price">';
		$string .= '<p>' . $value . '</p>';
		$string .= '<input type="text" name="' . $key . '" value="' . get_post_meta( $post->ID, $key, true ) . '" class="widefat" />';
		$string .= '</div>';
	}

	// Get flower prices.
	$flower_prices = wpd_product_prices( 'flowers' );

	// Loop through flower prices.
	foreach ( $flower_prices as $key=>$value ) {
		$string .= '<div class="input-field flower-price">';
		$string .= '<p>' . $value . '</p>';
		$string .= '<input type="text" name="' . $key . '" value="' . get_post_meta( $post->ID, $key, true ) . '" class="widefat" />';
		$string .= '</div>';
	}

	echo $string;
}

/**
 * Save the Metabox Data
 * 
 * @param  object $post
 * @return void
 */
function wp_dispensary_product_prices_metabox_save( $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if (
		null == filter_input( INPUT_POST, 'wpd_product_prices_meta_noncename' ) ||
		! wp_verify_nonce( filter_input( INPUT_POST, 'wpd_product_prices_meta_noncename' ), plugin_basename( __FILE__ ) )
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

	$prices_meta = array();

	// @todo - wrap one of these in a foreach loop, with an array of the input names (ex: price_each).

	if ( '' != filter_input( INPUT_POST, 'price_each' ) ) {
		$prices_meta['price_each'] = esc_html( filter_input( INPUT_POST, 'price_each' ) );
	}

	if ( '' != filter_input( INPUT_POST, 'price_per_pack' ) ) {
		$prices_meta['price_per_pack'] = esc_html( filter_input( INPUT_POST, 'price_per_pack' ) );
	}

	if ( '' != filter_input( INPUT_POST, 'units_per_pack' ) ) {
		$prices_meta['units_per_pack'] = esc_html( filter_input( INPUT_POST, 'units_per_pack' ) );
	}

	if ( '' != filter_input( INPUT_POST, 'price_half_gram' ) ) {
		$prices_meta['price_half_gram'] = esc_html( filter_input( INPUT_POST, 'price_half_gram' ) );
	}

	if ( '' != filter_input( INPUT_POST, 'price_gram' ) ) {
		$prices_meta['price_gram'] = esc_html( filter_input( INPUT_POST, 'price_gram' ) );
	}

	if ( '' != filter_input( INPUT_POST, 'price_two_grams' ) ) {
		$prices_meta['price_two_grams'] = esc_html( filter_input( INPUT_POST, 'price_two_grams' ) );
	}

	if ( '' != filter_input( INPUT_POST, 'price_eighth' ) ) {
		$prices_meta['price_eighth'] = esc_html( filter_input( INPUT_POST, 'price_eighth' ) );
	}

	if ( '' != filter_input( INPUT_POST, 'price_five_grams' ) ) {
		$prices_meta['price_five_grams'] = esc_html( filter_input( INPUT_POST, 'price_five_grams' ) );
	}

	if ( '' != filter_input( INPUT_POST, 'price_quarter_ounce' ) ) {
		$prices_meta['price_quarter_ounce'] = esc_html( filter_input( INPUT_POST, 'price_quarter_ounce' ) );
	}

	if ( '' != filter_input( INPUT_POST, 'price_half_ounce' ) ) {
		$prices_meta['price_half_ounce'] = esc_html( filter_input( INPUT_POST, 'price_half_ounce' ) );
	}

	if ( '' != filter_input( INPUT_POST, 'price_ounce' ) ) {
		$prices_meta['price_ounce'] = esc_html( filter_input( INPUT_POST, 'price_ounce' ) );
	}

	// Save $prices_meta as metadata.
	foreach ( $prices_meta as $key => $value ) {
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
add_action( 'save_post', 'wp_dispensary_product_prices_metabox_save', 1, 1 );
