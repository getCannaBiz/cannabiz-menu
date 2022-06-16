<?php
/**
 * WP Dispensary Metabox - Product Prices
 *
 * This file is used to define the product prices metabox of the plugin.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/metaboxes
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 */


/**
 * Product Type metabox
 *
 * Adds the product type metabox to specific custom post types
 *
 * @since  4.0
 * @return void
 */
function wp_dispensary_product_type_metabox() {
    add_meta_box(
        'wp_dispensary_product_type',
        esc_html__( 'Product type', 'wp-dispensary' ),
        'wp_dispensary_product_type_metabox_content',
        'products',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'wp_dispensary_product_type_metabox' );

/**
 * Building the metabox
 * 
 * @return void
 */
function wp_dispensary_product_type_metabox_content() {
    global $post;

    // Noncename needed to verify where the data originated.
    echo '<input type="hidden" name="wpd_product_type_meta_noncename" id="wpd_product_type_meta_noncename" value="' .
    wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

    // Get the product type data if its already been entered.
    $product_type = get_post_meta( $post->ID, 'product_type', true );

    $div  = '<div class="wpd-product-type-meta">';
    $div .= '<select name="product_type" id="product_type">';
    $div .= '<option value="">--</option>';
    // Loop through product types.
    foreach ( wpd_menu_types_simple( true ) as $name ) {
        // Empty var.
        $selected = '';
        // Check if current loop item is the same as the saved product_type.
        if ( $name == $product_type ) {
            $selected = 'selected';
        }
        // Product type display name.
        $product_type_name = wpd_product_type_display_name( $name );
        $div .= '<option ' . $selected . ' value="' . $name . '">' . $product_type_name  . '</option>';
    }
    $div .= '</select>';
    $div .= '</div>';

    echo $div;
}

/**
 * Save the Metabox Data
 * 
 * @param object $post 
 * 
 * @return void
 */
function wp_dispensary_product_type_metabox_save( $post ) {

    /**
     * Verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times
     */
    if (
        null == filter_input( INPUT_POST, 'wpd_product_type_meta_noncename' ) ||
        ! wp_verify_nonce( filter_input( INPUT_POST, 'wpd_product_type_meta_noncename' ), plugin_basename( __FILE__ ) )
    ) {
        return $post->ID;
    }

    // Is the user allowed to edit the post or page?
    if ( ! current_user_can( 'edit_post', $post->ID ) ) {
        return $post->ID;
    }

    /**
     * OK, we're authenticated: we need to find and save the data
     * We'll put it into an array to make it easier to loop though.
     */

    $product_type_meta['product_type'] = filter_input( INPUT_POST, 'product_type' );

    // Save $product_type_meta as metadata.
    foreach ( $product_type_meta as $key => $value ) {
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
add_action( 'save_post', 'wp_dispensary_product_type_metabox_save', 11 );
