<?php
/**
 * WP Dispensary Metabox - Compound Details
 *
 * This file is used to define the compound details metabox of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/partials
 */

/**
 * Compound Details metabox
 *
 * Adds a details metabox to the products post type.
 *
 * @since    4.0.0
 */
function wp_dispensary_compound_details_metabox() {
	add_meta_box(
		'wp_dispensary_compound_details',
		esc_html__( 'Compound details', 'wp-dispensary' ),
		'wp_dispensary_compound_details_metabox_content',
		'products',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'wp_dispensary_compound_details_metabox' );

/**
 * Building the metabox
 * 
 * @return void
 */
function wp_dispensary_compound_details_metabox_content() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="compound_detailsmeta_noncename" id="compound_detailsmeta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the thccbd data if its already been entered */
	$thc   = get_post_meta( $post->ID, 'compounds_thc', true );
	$thca  = get_post_meta( $post->ID, 'compounds_thca', true );
	$cbd   = get_post_meta( $post->ID, 'compounds_cbd', true );
	$cba   = get_post_meta( $post->ID, 'compounds_cba', true );
	$cbn   = get_post_meta( $post->ID, 'compounds_cbn', true );
	$cbg   = get_post_meta( $post->ID, 'compounds_cbg', true );
	$total = get_post_meta( $post->ID, 'compounds_total', true );

	/** Echo out the fields */
	echo '<div class="compoundbox">';
	echo '<p>' . esc_html__( 'THC', 'wp-dispensary' ) . ' %</p>';
	echo '<input type="text" name="compounds_thc" value="' . esc_html( $thc ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="compoundbox">';
	echo '<p>' . esc_html__( 'THCA', 'wp-dispensary' ) . ' %</p>';
	echo '<input type="text" name="compounds_thca" value="' . esc_html( $thca ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="compoundbox">';
	echo '<p>' . esc_html__( 'CBD', 'wp-dispensary' ) . ' %</p>';
	echo '<input type="text" name="compounds_cbd" value="' . esc_html( $cbd ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="compoundbox">';
	echo '<p>' . esc_html__( 'CBA', 'wp-dispensary' ) . ' %</p>';
	echo '<input type="text" name="compounds_cba" value="' . esc_html( $cba ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="compoundbox">';
	echo '<p>' . esc_html__( 'CBN', 'wp-dispensary' ) . ' %</p>';
	echo '<input type="text" name="compounds_cbn" value="' . esc_html( $cbn ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="compoundbox">';
	echo '<p>' . esc_html__( 'CBG', 'wp-dispensary' ) . ' %</p>';
	echo '<input type="text" name="compounds_cbg" value="' . esc_html( $cbg ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="compoundbox">';
	echo '<p>' . esc_html__( 'Total', 'wp-dispensary' ) . ' %</p>';
	echo '<input type="text" name="compounds_total" value="' . esc_html( $total ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 * 
 * @param  int    $post_id
 * @param  object $post
 * @return void
 */
function wp_dispensary_compound_details_metabox_save( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if (
		! isset( $_POST['compound_detailsmeta_noncename' ] ) ||
		! wp_verify_nonce( $_POST['compound_detailsmeta_noncename'], plugin_basename( __FILE__ ) )
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

	$details_meta['compounds_thc']   = $_POST['compounds_thc'];
	$details_meta['compounds_thca']  = $_POST['compounds_thca'];
	$details_meta['compounds_cbd']   = $_POST['compounds_cbd'];
	$details_meta['compounds_cba']   = $_POST['compounds_cba'];
	$details_meta['compounds_cbn']   = $_POST['compounds_cbn'];
	$details_meta['compounds_cbg']   = $_POST['compounds_cbg'];
	$details_meta['compounds_total'] = $_POST['compounds_total'];

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
add_action( 'save_post', 'wp_dispensary_compound_details_metabox_save', 1, 2 );
