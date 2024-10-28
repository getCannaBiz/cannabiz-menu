<?php
/**
 * WP Dispensary Metabox - Product Details
 *
 * This file is used to define the product details metabox of the plugin.
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
 * Product Details metabox
 *
 * Adds a details metabox to the products post type.
 *
 * @since  4.0.0
 * @return void
 */
function wp_dispensary_product_details_metabox() {
    // Add Metabox.
    add_meta_box(
        'wp_dispensary_product_details',
        esc_attr__( 'Product Details', 'cannabiz-menu' ),
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

    // Noncename needed to verify where the data originated.
    echo '<input type="hidden" name="wpd_product_details_meta_noncename" id="wpd_product_details_meta_noncename" value="' .
    wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

    // Flowers fields.
    $str  = '<div class="flowers-fields">';
    $str .= wp_dispensary_product_details_array( array( 'activation_time', 'product_sku', 'harvest_date', 'test_date', 'test_lab', 'package_id' ) );
    $str .= '</div>';
    // Concentrates fields.
    $str .= '<div class="concentrates-fields">';
    $str .= wp_dispensary_product_details_array( array( 'activation_time', 'product_sku', 'harvest_date', 'test_date', 'test_lab', 'package_id' ) );
    $str .= '</div>';
    // Tinctures fields.
    $str .= '<div class="tinctures-fields">';
    $str .= wp_dispensary_product_details_array( array( 'product_servings', 'compounds_thc', 'compounds_cbd', 'product_servings_ml', 'product_net_weight', 'activation_time', 'product_sku', 'package_id' ) );
    $str .= '</div>';
    // Pre-roll fields.
    $str .= '<div class="prerolls-fields">';
    $str .= wp_dispensary_product_details_array( array( 'product_weight', 'activation_time', 'product_sku', 'harvest_date', 'test_date', 'test_lab', 'package_id' ) );
    $str .= '</div>';
    // Topicals fields.
    $str .= '<div class="topicals-fields">';
    $str .= wp_dispensary_product_details_array( array( 'product_size', 'compounds_thc', 'compounds_cbd', 'activation_time', 'product_sku', 'package_id' ) );
    $str .= '</div>';
    // Edibles fields.
    $str .= '<div class="edibles-fields">';
    $str .= wp_dispensary_product_details_array( array( 'compounds_thc', 'compounds_cbd', 'product_servings', 'product_net_weight', 'activation_time', 'product_sku', 'package_id' ) );
    $str .= '</div>';
    // Grower fields.
    $str .= '<div class="growers-fields">';
    $str .= wp_dispensary_product_details_array( array( 'seed_count', 'clone_count', 'product_sku', 'package_id' ) );
    $str .= '</div>';

    echo $str;
}

/**
 * Save the Metabox Data
 * 
 * @return void
 */
function wp_dispensary_product_details_metabox_save() {
    global $post;

    /**
     * Verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times
     */
    if ( null == filter_input( INPUT_POST, 'wpd_product_details_meta_noncename' ) || ! wp_verify_nonce( filter_input( INPUT_POST, 'wpd_product_details_meta_noncename' ), plugin_basename( __FILE__ ) ) ) {
        return $post;
    }

    /**
     * Is the user allowed to edit the post or page?
     */
    if ( ! current_user_can( 'edit_post', $post->ID ) ) {
        return $post->ID;
    }

    /**
     * OK, we're authenticated: we need to find and save the data
     * We'll put it into an array to make it easier to loop though.
     */

    $details_meta = [];
    $detail_keys  = array(
        'activation_time',
        'product_sku',
        'harvest_date',
        'test_date',
        'test_lab',
        'package_id',
        'compounds_thc',
        'compounds_cbd',
        'product_size',
        'product_servings',
        'product_servings_ml',
        'product_net_weight',
        'product_weight',
        'seed_count',
        'clone_count',
    );

    $detail_keys = apply_filters( 'wp_dispensary_details_metabox_save_detail_keys', $detail_keys );

    foreach ( $detail_keys as $key ) {
        $details_meta[$key] = filter_input( INPUT_POST, $key );
    }

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
add_action( 'save_post', 'wp_dispensary_product_details_metabox_save', 11 );

/**
 * Product details array
 * 
 * @param array $details - the details that can be selected for each product type
 * 
 * @since  4.4.0
 * @return string
 */
function wp_dispensary_product_details_array( $product_details = [] ) {
    global $post;

    // Activation time.
    $activation_time = get_post_meta( $post->ID, 'activation_time', true );
    // Product SKU.
    $product_sku = get_post_meta( $post->ID, 'product_sku', true );
    // Harvest date.
    $harvest_date = get_post_meta( $post->ID, 'harvest_date', true );
    // Test date.
    $test_date = get_post_meta( $post->ID, 'test_date', true );
    // Test lab.
    $test_lab = get_post_meta( $post->ID, 'test_lab', true );
    // Package ID.
    $package_id = get_post_meta( $post->ID, 'package_id', true );
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

    // Details array.
    $details = array(
        'activation_time'     => '<div class="input-field"><p>' . esc_html__( 'Activation time', 'cannabiz-menu' ) . '</p><input type="text" name="activation_time" value="' . esc_html( $activation_time ) . '" class="widefat" /></div>',
        'product_sku'         => '<div class="input-field"><p>' . esc_html__( 'SKU', 'cannabiz-menu' ) . '</p><input type="text" name="product_sku" value="' . esc_html( $product_sku ) . '" class="widefat" /></div>',
        'harvest_date'        => '<div class="input-field"><p>' . esc_html__( 'Harvest date', 'cannabiz-menu' ) . '</p><input type="date" name="harvest_date" value="' . esc_html( $harvest_date ) . '" class="widefat" /></div>',
        'test_date'           => '<div class="input-field"><p>' . esc_html__( 'Test date', 'cannabiz-menu' ) . '</p><input type="date" name="test_date" value="' . esc_html( $test_date ) . '" class="widefat" /></div>',
        'test_lab'            => '<div class="input-field"><p>' . esc_html__( 'Test lab', 'cannabiz-menu' ) . '</p><input type="text" name="test_lab" value="' . esc_html( $test_lab ) . '" class="widefat" /></div>',
        'package_id'          => '<div class="input-field"><p>' . esc_html__( 'Package ID', 'cannabiz-menu' ) . '</p><input type="text" name="package_id" value="' . esc_html( $package_id ) . '" class="widefat" /></div>',
        'compounds_thc'       => '<div class="input-field"><p>' . esc_html__( 'THC per serving', 'cannabiz-menu' ) . '</p><input type="text" name="compounds_thc" value="' . esc_html( $thcmg ) . '" class="widefat" /></div>',
        'compounds_cbd'       => '<div class="input-field"><p>' . esc_html__( 'CBD per serving', 'cannabiz-menu' ) . '</p><input type="text" name="compounds_cbd" value="' . esc_html( $cbdmg ) . '" class="widefat" /></div>',
        'product_size'        => '<div class="input-field"><p>' . esc_html__( 'Size (oz)', 'cannabiz-menu' ) . '</p><input type="text" name="product_size" value="' . esc_html( $product_size ) . '" class="widefat" /></div>',
        'product_servings'    => '<div class="input-field"><p>' . esc_html__( 'Servings', 'cannabiz-menu' ) . '</p><input type="text" name="product_servings" value="' . esc_html( $thccbdservings ) . '" class="widefat" /></div>',
        'product_servings_ml' => '<div class="input-field"><p>' . esc_attr__( 'mL per serving', 'cannabiz-menu' ) . '</p><input type="text" name="product_servings_ml" value="' . esc_html( $mlserving ) . '" class="widefat" /></div>',
        'product_net_weight'  => '<div class="input-field"><p>' . esc_html__( 'Net weight', 'cannabiz-menu' ) . '</p><input type="text" name="product_net_weight" value="' . esc_html( $netweight ) . '" class="widefat" /></div>',
        'product_weight'      => '<div class="input-field"><p>' . esc_html__( 'Weight (g)', 'cannabiz-menu' ) . '</p><input type="text" name="product_weight" value="' . esc_html( $product_weight ) . '" class="widefat" /></div>',
        'seed_count'          => '<div class="input-field"><p>' . esc_html__( 'Seeds per unit', 'cannabiz-menu' ) . '</p><input type="text" name="seed_count" value="' . esc_html( $seedcount ) . '" class="widefat" /></div>',
        'clone_count'         => '<div class="input-field"><p>' . esc_html__( 'Clones per unit', 'cannabiz-menu' ) . '</p><input type="text" name="clone_count" value="' . esc_html( $clonecount ) . '" class="widefat" /></div>',
    );

    // Create empty string.
    $details_html = '';

    // Loop through provided details.
    foreach ( $product_details as $detail ) {
        // Add detail to details HTML.
        $details_html .= $details[$detail];
    }

    return apply_filters( 'wp_dispensary_product_details_array', $details_html );
}
