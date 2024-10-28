<?php
/**
 * WP Dispensary Metabox - Compound Details
 *
 * This file is used to define the compound details metabox of the plugin.
 *
 * @package    WP_Dispensary
 * @subpackage CannaBiz_Menu/admin/metaboxes
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      4.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    wp_die();
}

/**
 * Compound Details metabox
 *
 * Adds a details metabox to the products post type.
 *
 * @since  4.0.0
 * @return void
 */
function wp_dispensary_compound_details_metabox() {
    add_meta_box(
        'wp_dispensary_compound_details',
        esc_attr__( 'Compound details', 'cannabiz-menu' ),
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

    // Noncename needed to verify where the data originated.
    echo '<input type="hidden" name="compound_details_meta_noncename" id="compound_details_meta_noncename" value="' .
    wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

    // Get the thccbd data if its already been entered.
    $thc   = get_post_meta( $post->ID, 'compounds_thc', true );
    $thca  = get_post_meta( $post->ID, 'compounds_thca', true );
    $cbd   = get_post_meta( $post->ID, 'compounds_cbd', true );
    $cba   = get_post_meta( $post->ID, 'compounds_cba', true );
    $cbn   = get_post_meta( $post->ID, 'compounds_cbn', true );
    $cbg   = get_post_meta( $post->ID, 'compounds_cbg', true );
    $total = get_post_meta( $post->ID, 'compounds_total', true );

    // Echo out the fields.
    $html  = '<div class="input-field">';
    $html .= '<p>' . esc_attr__( 'THC', 'cannabiz-menu' ) . ' %</p>';
    $html .= '<input type="text" name="compounds_thc" value="' . esc_attr( $thc ) . '" class="widefat" />';
    $html .= '</div>';
    $html .= '<div class="input-field">';
    $html .= '<p>' . esc_attr__( 'THCA', 'cannabiz-menu' ) . ' %</p>';
    $html .= '<input type="text" name="compounds_thca" value="' . esc_attr( $thca ) . '" class="widefat" />';
    $html .= '</div>';
    $html .= '<div class="input-field">';
    $html .= '<p>' . esc_attr__( 'CBD', 'cannabiz-menu' ) . ' %</p>';
    $html .= '<input type="text" name="compounds_cbd" value="' . esc_attr( $cbd ) . '" class="widefat" />';
    $html .= '</div>';
    $html .= '<div class="input-field">';
    $html .= '<p>' . esc_attr__( 'CBA', 'cannabiz-menu' ) . ' %</p>';
    $html .= '<input type="text" name="compounds_cba" value="' . esc_attr( $cba ) . '" class="widefat" />';
    $html .= '</div>';
    $html .= '<div class="input-field">';
    $html .= '<p>' . esc_attr__( 'CBN', 'cannabiz-menu' ) . ' %</p>';
    $html .= '<input type="text" name="compounds_cbn" value="' . esc_attr( $cbn ) . '" class="widefat" />';
    $html .= '</div>';
    $html .= '<div class="input-field">';
    $html .= '<p>' . esc_attr__( 'CBG', 'cannabiz-menu' ) . ' %</p>';
    $html .= '<input type="text" name="compounds_cbg" value="' . esc_attr( $cbg ) . '" class="widefat" />';
    $html .= '</div>';
    $html .= '<div class="input-field">';
    $html .= '<p>' . esc_attr__( 'Total', 'cannabiz-menu' ) . ' %</p>';
    $html .= '<input type="text" name="compounds_total" value="' . esc_attr( $total ) . '" class="widefat" />';
    $html .= '</div>';

    echo $html;

}

/**
 * Save the Metabox Data
 * 
 * @param object $post 
 * 
 * @return void
 */
function wp_dispensary_compound_details_metabox_save( $post ) {
    global $post;
    /**
     * Verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times
     */
    if (
        null == filter_input( INPUT_POST, 'compound_details_meta_noncename' ) ||
        ! wp_verify_nonce( filter_input( INPUT_POST, 'compound_details_meta_noncename' ), plugin_basename( __FILE__ ) )
    ) {
        return $post;
    }

    // Is the user allowed to edit the post or page?
    if ( ! current_user_can( 'edit_post', $post->ID ) ) {
        return $post->ID;
    }

    /**
     * OK, we're authenticated: we need to find and save the data
     * We'll put it into an array to make it easier to loop though.
     */

    $details_meta['compounds_thc']   = filter_input( INPUT_POST, 'compounds_thc' );
    $details_meta['compounds_thca']  = filter_input( INPUT_POST, 'compounds_thca' );
    $details_meta['compounds_cbd']   = filter_input( INPUT_POST, 'compounds_cbd' );
    $details_meta['compounds_cba']   = filter_input( INPUT_POST, 'compounds_cba' );
    $details_meta['compounds_cbn']   = filter_input( INPUT_POST, 'compounds_cbn' );
    $details_meta['compounds_cbg']   = filter_input( INPUT_POST, 'compounds_cbg' );
    $details_meta['compounds_total'] = filter_input( INPUT_POST, 'compounds_total' );

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
add_action( 'save_post', 'wp_dispensary_compound_details_metabox_save', 11 );
