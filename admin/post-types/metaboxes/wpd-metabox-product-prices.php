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
		__( 'Product prices', 'wp-dispensary' ),
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
	echo '<input type="hidden" name="wpd_product_prices_meta_noncename" id="wpd_product_prices_meta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	// Regular prices.
	$price_each     = get_post_meta( $post->ID, 'price_each', true );
	$price_per_pack = get_post_meta( $post->ID, 'price_per_pack', true );
	$units_per_pack = get_post_meta( $post->ID, 'units_per_pack', true );
	// Flower prices.
	$gram          = get_post_meta( $post->ID, 'price_gram', true );
	$two_grams     = get_post_meta( $post->ID, 'price_half_gram', true );
	$eighth        = get_post_meta( $post->ID, 'price_eighth', true );
	$five_grams    = get_post_meta( $post->ID, 'price_five_grams', true );
	$quarter_ounce = get_post_meta( $post->ID, 'price_quarter_ounce', true );
	$half_ounce    = get_post_meta( $post->ID, 'price_half_ounce', true );
	$ounce         = get_post_meta( $post->ID, 'price_ounce', true );
	// Concentrates prices.
	$price_each = get_post_meta( $post->ID, 'price_each', true );
	$half_gram  = get_post_meta( $post->ID, 'price_half_gram', true );
	$gram       = get_post_meta( $post->ID, 'price_gram', true );
	$two_grams  = get_post_meta( $post->ID, 'price_two_grams', true );

	// Regular prices fields.
	echo '<div class="input-field">';
	echo '<p>' . __( 'Price per unit', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="price_each" value="' . esc_html( $price_each ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . __( 'Price per pack', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="price_per_pack" value="' . esc_html( $price_per_pack ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . __( 'Units per pack', 'wp-dispensary' ) . '</p>';
	echo '<input type="number" name="units_per_pack" value="' . esc_html( $units_per_pack ) . '" class="widefat" />';
	echo '</div>';
	// Flower prices.
	echo '<div class="input-field">';
	echo '<p>' . __( '1 g', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="price_gram" value="' . esc_html( $gram ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . __( '2 g', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="price_two_grams" value="' . esc_html( $two_grams ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . __( '1/8 oz', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="price_eighth" value="' . esc_html( $eighth ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . __( '5 g', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="price_five_grams" value="' . esc_html( $five_grams ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . __( '1/4 oz', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="price_quarter_ounce" value="' . esc_html( $quarter_ounce ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . __( '1/2 oz', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="price_half_ounce" value="' . esc_html( $half_ounce ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . __( '1 oz', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_ounce" value="' . esc_html( $ounce ) . '" class="widefat" />';
	echo '</div>';
	// Concentrates prices.
	echo '<div class="input-field">';
	echo '<p>' . __( 'Price each', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="price_each" value="' . esc_html( $price_each ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . __( '1/2 g', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="price_half_gram" value="' . esc_html( $half_gram ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . __( '1 g', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="price_gram" value="' . esc_html( $gram ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . __( '2 g', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="price_two_grams" value="' . esc_html( $two_grams ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 * 
 * @param  int    $post_id
 * @param  object $post
 * @return void
 */
function wp_dispensary_product_prices_metabox_save( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if (
		! isset( $_POST['wpd_product_prices_meta_noncename'] ) ||
		! wp_verify_nonce( $_POST['wpd_product_prices_meta_noncename'], plugin_basename( __FILE__ ) )
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
	// Regular prices.
	$prices_meta['price_each']     = esc_html( $_POST['price_each'] );
	$prices_meta['price_per_pack'] = esc_html( $_POST['price_per_pack'] );
	$prices_meta['units_per_pack'] = esc_html( $_POST['units_per_pack'] );
	// Flowers prices.
	$prices_meta['price_gram']          = esc_html( $_POST['price_gram'] );
	$prices_meta['price_half_gram']     = esc_html( $_POST['price_half_gram'] );
	$prices_meta['price_eighth']        = esc_html( $_POST['price_eighth'] );
	$prices_meta['price_five_grams']    = esc_html( $_POST['price_five_grams'] );
	$prices_meta['price_quarter_ounce'] = esc_html( $_POST['price_quarter_ounce'] );
	$prices_meta['price_half_ounce']    = esc_html( $_POST['price_half_ounce'] );
	$prices_meta['price_ounce']         = esc_html( $_POST['price_ounce'] );
	// Concentrates prices.
	$prices_meta['price_each']      = esc_html( $_POST['price_each'] );
	$prices_meta['price_half_gram'] = esc_html( $_POST['price_half_gram'] );
	$prices_meta['price_gram']      = esc_html( $_POST['price_gram'] );
	$prices_meta['price_two_grams'] = esc_html( $_POST['price_two_grams'] );

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
add_action( 'save_post', 'wp_dispensary_product_prices_metabox_save', 1, 2 );
