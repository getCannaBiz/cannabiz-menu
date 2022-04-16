<?php
/**
 * WP Dispensary Metabox - Product Details
 *
 * This file is used to define the product details metabox of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/partials
 */


/**
 * Product Details metabox
 *
 * Adds a details metabox to the products post type.
 *
 * @since    4.0.0
 */
function wp_dispensary_product_details_metabox() {
    // Add Metabox.
	add_meta_box(
		'wp_dispensary_product_details',
		esc_attr__( 'Product Details', 'wp-dispensary' ),
		'wp_dispensary_product_details_metabox_content',
		'products',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'wp_dispensary_product_details_metabox' );

/**
 * Build the Product Details metabox
 * 
 * @return void
 */
function wp_dispensary_product_details_metabox_content() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="wpd_product_details_meta_noncename" id="wpd_product_details_meta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	// Activation time.
	$activation_time = get_post_meta( $post->ID, 'activation_time', true );
	// Tinctures data.
	$thcmg          = get_post_meta( $post->ID, 'compounds_thc', true );
	$cbdmg          = get_post_meta( $post->ID, 'compounds_cbd', true );
	$mlserving      = get_post_meta( $post->ID, 'product_servings_ml', true );
	$thccbdservings = get_post_meta( $post->ID, 'product_servings', true );
    $netweight      = get_post_meta( $post->ID, 'product_net_weight', true );
    // Pre-rolls data.
    $product_weight = get_post_meta( $post->ID, 'product_weight', true );
    // Topicals data.
	$compounds_thc = get_post_meta( $post->ID, 'compounds_thc', true );
	$compounds_cbd = get_post_meta( $post->ID, 'compounds_cbd', true );
    $product_size  = get_post_meta( $post->ID, 'product_size', true );
    // Edibles data.
	$thcmg          = get_post_meta( $post->ID, 'compounds_thc', true );
	$cbdmg          = get_post_meta( $post->ID, 'compounds_cbd', true );
	$thccbdservings = get_post_meta( $post->ID, 'product_servings', true );
    $netweight      = get_post_meta( $post->ID, 'product_net_weight', true );
    // Growers data.
	$clonecount = get_post_meta( $post->ID, 'clone_count', true );
	$seedcount  = get_post_meta( $post->ID, 'seed_count', true );

	// Flowers fields.
	echo '<div class="flowers-fields">';
    echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Activation time', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="activation_time" value="' . esc_html( $activation_time ) . '" class="widefat" />';
    echo '</div>';
    echo '</div>';
 
	// Concentrates fields.
	echo '<div class="concentrates-fields">';
    echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Activation time', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="activation_time" value="' . esc_html( $activation_time ) . '" class="widefat" />';
    echo '</div>';
    echo '</div>';
 
	// Tinctures fields.
	echo '<div class="tinctures-fields">';
	echo '<div class="input-field">';
	echo '<p>' . esc_attr__( 'Servings', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="product_servings" value="' . esc_html( $thccbdservings ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . esc_attr__( 'THC mg per serving', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="compounds_thc" value="' . esc_html( $thcmg ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . esc_attr__( 'CBD mg per serving', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="compounds_cbd" value="' . esc_html( $cbdmg ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . esc_attr__( 'mL per serving', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="product_servings_ml" value="' . esc_html( $mlserving ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . esc_attr__( 'Net weight (ounces)', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="product_net_weight" value="' . esc_html( $netweight ) . '" class="widefat" />';
	echo '</div>';
    echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Activation time', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="activation_time" value="' . esc_html( $activation_time ) . '" class="widefat" />';
    echo '</div>';
	echo '</div>';

    // Pre-roll weight.
	echo '<div class="prerolls-fields">';
    echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Weight (g)', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="product_weight" value="' . esc_html( $product_weight ) . '" class="widefat" />';
    echo '</div>';
    echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Activation time', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="activation_time" value="' . esc_html( $activation_time ) . '" class="widefat" />';
    echo '</div>';
    echo '</div>';

    // Topicals fields.
	echo '<div class="topicals-fields">';
	echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Size (oz)', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="product_size" value="' . esc_html( $product_size ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'THC mg', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="compounds_thc" value="' . esc_html( $compounds_thc ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'CBD mg', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="compounds_cbd" value="' . esc_html( $compounds_cbd ) . '" class="widefat" />';
    echo '</div>';
    echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Activation time', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="activation_time" value="' . esc_html( $activation_time ) . '" class="widefat" />';
    echo '</div>';
    echo '</div>';

    // Edibles fields.
	echo '<div class="edibles-fields">';
	echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'THC mg per serving', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="compounds_thc" value="' . esc_html( $thcmg ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'CBD mg per serving', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="compounds_cbd" value="' . esc_html( $cbdmg ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Servings', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="product_servings" value="' . esc_html( $thccbdservings ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Net weight (grams)', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="product_net_weight" value="' . esc_html( $netweight ) . '" class="widefat" />';
    echo '</div>';
    echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Activation time', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="activation_time" value="' . esc_html( $activation_time ) . '" class="widefat" />';
    echo '</div>';
    echo '</div>';

    // Grower fields.
	echo '<div class="growers-fields">';
	echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Seeds per unit', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="seed_count" value="' . esc_html( $seedcount ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="input-field">';
	echo '<p>' . esc_html__( 'Clones per unit', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="clone_count" value="' . esc_html( $clonecount ) . '" class="widefat" />';
	echo '</div>';
    echo '</div>';

}

/**
 * Save the Metabox Data
 * 
 * @param  int    $post_id
 * @param  object $post
 * @return void
 */
function wp_dispensary_product_details_metabox_save( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if ( null == filter_input( INPUT_POST, 'wpd_product_details_meta_noncename' ) || ! wp_verify_nonce( filter_input( INPUT_POST, 'wpd_product_details_meta_noncename' ), plugin_basename( __FILE__ ) ) ) {
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
    // Product data.
	$details_meta['activation_time']     = esc_html( filter_input( INPUT_POST, 'activation_time' ) );
	$details_meta['compounds_thc']       = esc_html( filter_input( INPUT_POST, 'compounds_thc' ) );
	$details_meta['compounds_cbd']       = esc_html( filter_input( INPUT_POST, 'compounds_cbd' ) );
	$details_meta['product_size']        = esc_html( filter_input( INPUT_POST, 'product_size' ) );
	$details_meta['product_servings']    = esc_html( filter_input( INPUT_POST, 'product_servings' ) );
	$details_meta['product_servings_ml'] = esc_html( filter_input( INPUT_POST, 'product_servings_ml' ) );
    $details_meta['product_net_weight']  = esc_html( filter_input( INPUT_POST, 'product_net_weight' ) );
    $details_meta['product_weight']      = esc_html( filter_input( INPUT_POST, 'product_weight' ) );
	$details_meta['seed_count']          = esc_html( filter_input( INPUT_POST, 'seed_count' ) );
	$details_meta['clone_count']         = esc_html( filter_input( INPUT_POST, 'clone_count' ) );

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
add_action( 'save_post', 'wp_dispensary_product_details_metabox_save', 1, 2 );
