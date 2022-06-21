<?php
/**
 * These functions are run conditionally during plugin upgrade
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    wp_die();
}

/**
 * Create product reviews comment type
 * 
 * @param object $default 
 * 
 * @since  4.2.0
 * @return object $default
 */
function wpd_product_reviews_form( $default ) {

    if ( 'products' == get_post_type() ) {
        $default['title_reply'] = esc_attr__( 'Leave a Review', 'wp-dispensary' );
    }

    return $default;       
}
add_filter( 'comment_form_defaults', 'wpd_product_reviews_form' );

/**
 * Pre-process comment data
 * 
 * @param object $commentdata 
 * 
 * @since  4.2.0
 * @return object $commentdata
 */
function wpd_preprocess_comment_handler( $commentdata ) {
    // Only save the data if it has been posted by a comment being published.
    if ( ( isset( $_POST['comment_type'] ) ) && ( $_POST['comment_type'] != '' ) ) {
        $commentdata['comment_type'] = wp_filter_nohtml_kses( $_POST['comment_type'] );
    }

    return $commentdata;    
} 
add_filter( 'preprocess_comment', 'wpd_preprocess_comment_handler', 12, 1 );

/**
 * Remove reviews from comments loop
 * 
 * @param object $query 
 * 
 * @since  4.2.0
 * @return void
 */
function wpd_remove_reviews_from_comments_loop( \WP_Comment_Query $query ) {
    // Only allow 'wpd_product_reviews' when is required explicitly.
    if ( $query->query_vars['type'] !== 'wpd_product_reviews' ) {
        $query->query_vars['type__not_in'] = array_merge(
            (array) $query->query_vars['type__not_in'],
            array( 'wpd_product_reviews' )
        );
    }
}
add_action( 'pre_get_comments', 'wpd_remove_reviews_from_comments_loop' );

/**
 * Pre-approve product reviews
 * 
 * @param int   $approved 
 * @param array $data 
 * 
 * @since  4.2.0
 * @return int
 */
function wpd_pre_approve_product_reviews( $approved, $data ) {
    return isset( $data['comment_type'] ) && $data['comment_type'] === 'wpd_product_reviews'
       ? 1
       : $approved;
}
add_filter( 'pre_comment_approved', 'wpd_pre_approve_product_reviews', 10, 2 );

/**
 * Add custom comment form fields
 * 
 * @param object $fields 
 * 
 * @since  4.2.0
 * @return object $fields 
 */
function wpd_add_product_review_comment_fields( $fields ) {
    // Variables.
    $commenter   = wp_get_current_commenter();
    $req         = get_option( 'require_name_email' );
    $aria_req    = ( $req ? " aria-required='true'" : ’ );
    $ratings_box = '';

    // Add author field.
    $fields[ 'author' ] = '<p class="comment-form-author">'.
        '<label for="author">' . esc_attr__( 'Name', 'wp-dispensary' ) .
        ( $req ? '<span class="required">*</span>' : ’ ). '</label>'.
        '<input id="author" name="author" type="text" value="'. esc_attr( $commenter['comment_author'] ) .
        '" size="30" tabindex="1"' . $aria_req . ' /></p>';

    // Add email field.
    $fields[ 'email' ] = '<p class="comment-form-email">'.
        '<label for="email">' . esc_attr__( 'Email', 'wp-dispensary' ) .
        ( $req ? '<span class="required">*</span>' : ’ ). '</label>'.
        '<input id="email" name="email" type="text" value="'. esc_attr( $commenter['comment_author_email'] ) .
        '" size="30"  tabindex="2"' . $aria_req . ' /></p>';

    if ( 'products' == get_post_type() ) {
        // Add phone field.
        $fields[ 'phone' ] = '<p class="comment-form-phone">'.
            '<label for="phone">' . esc_attr__( 'Phone' ) . '</label>'.
            '<input id="phone" name="phone" type="text" size="30"  tabindex="4" /></p>
            <input type="hidden" name="comment_type" value="wpd_ratings" id="comment_type" />';

        // Remove URL field.
        unset( $fields[ 'url' ] );
        // Remove cookies field.
        unset( $fields['cookies'] );

        $fields['cookies'] = '<p class="comment-form-cookies-consent">
                                <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
                                '<label for="wp-comment-cookies-consent">' . esc_attr__( 'Remember Me!', 'wp-dispensary' ) . '</label>
                              </p>';
    }

    return $fields;
}
add_filter( 'comment_form_default_fields', 'wpd_add_product_review_comment_fields' );


/**
 * Add custom comment form fields
 * 
 * @param array $defaults 
 * 
 * @since  4.2.0
 * @return array
 */
function wpd_comment_form_defaults( $defaults ) {

    if ( 'products' == get_post_type() ) {
        $comment_field = $defaults['comment_field'];

        unset( $defaults['comment_field'] );

        // Add to ratings box.
        for ( $i=1; $i <= 5; $i++ ) {
            $ratings_box .= '<span class="wpd-rating"><input class="star" type="checkbox" name="product_rating" id="product_rating" value="' . $i . '"/></span>';
        }

        $defaults['comment_field'] = '<p class="comment-form-rating">
            <span class="commentratingbox">' . $ratings_box . '</span></p>';
        $defaults['comment_field'] .= '<p class="comment-form-title">'.
            '<label for="title">' . esc_attr__( 'Review Title', 'wp-dispensary' ) . '</label>'.
            '<input id="title" name="title" type="text" size="30"  tabindex="5" /></p>';

        $defaults['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_attr__( 'Your Review', 'wp-dispensary' ) . ' <span class="required" aria-hidden="true">*</span></label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required></textarea></p>';
    }

    return $defaults;
}
add_filter( 'comment_form_defaults', 'wpd_comment_form_defaults' );

/**
 * Save product review metadata
 * 
 * @param int $comment_id 
 * 
 * @since  4.2.0
 * @return void
 */
function save_comment_meta_data( $comment_id ) {
    if ( ( isset( $_POST['phone'] ) ) && ( '' != $_POST['phone'] ) ) {
        $phone = wp_filter_nohtml_kses( $_POST['phone'] );
        add_comment_meta( $comment_id, 'phone', $phone );
    }

    if ( ( isset( $_POST['title'] ) ) && ( '' != $_POST['title'] ) ) {
        $title = wp_filter_nohtml_kses( $_POST['title'] );
        add_comment_meta( $comment_id, 'title', $title );
    }

    if ( ( isset( $_POST['product_rating'] ) ) && ( '' != $_POST['product_rating'] ) ) {
        $rating = wp_filter_nohtml_kses( $_POST['product_rating'] );
        add_comment_meta( $comment_id, 'product_rating', $rating );
    }
}
add_action( 'comment_post', 'save_comment_meta_data' );

/**
 * Verify comment metadata
 * 
 * @param string $commentdata 
 * 
 * @since  4.2.0
 * @return string $commentdata
 */
function wpd_verify_comment_meta_data( $commentdata ) {
    if ( 'products' == get_post_type() ) {
        if ( ! isset( $_POST['product_rating'] ) ) {
            wp_die( esc_attr__( 'Error: You did not add a rating. Please hit the Back button on your browser and resubmit your review with a rating.', 'wp-dispensary' ) );
        }
    }
    return $commentdata;
}
add_filter( 'preprocess_comment', 'wpd_verify_comment_meta_data' );

/**
 * Modify comment output
 * 
 * @param string $text 
 * 
 * @since  4.2.0
 * @return string $text
 */
function wpd_modify_comment( $text ) {

    $plugin_url_path = WP_PLUGIN_URL;

    if ( $title = get_comment_meta( get_comment_ID(), 'title', true ) ) {
        $title = '<p class="wpd-rating-title"><strong>' . esc_attr( $title ) . '</strong></p>';
        $text  = $title . $text;
    }

    $star = '<i class="fas fa-star"></i>';

    // Check if there's a product rating saved.
    if ( $commentrating = get_comment_meta( get_comment_ID(), 'product_rating', true ) ) {
        $commentrating = '<p class="comment-rating">' . str_repeat( $star, $commentrating ) . '</p>';
        $text = $commentrating . $text;
        return $text;
    } else {
        return $text;
    }
}
add_filter( 'comment_text', 'wpd_modify_comment' );

/**
 * Add extend comment meta box
 * 
 * @since  4.2.0
 * @return void
 */
function extend_comment_add_meta_box() {
    // Add metabox.
    add_meta_box( 'title', esc_attr__( 'WP Dispensary - Product Reviews', 'wp-dispensary' ), 'wpd_extend_comment_meta_box', 'comment', 'normal', 'high' );
}
add_action( 'add_meta_boxes_comment', 'extend_comment_add_meta_box' );

/**
 * Extend comment metabox
 * 
 * @param string $comment 
 * 
 * @since  4.2.0
 * @return string $comment
 */
function wpd_extend_comment_meta_box( $comment ) {
    // Get vars.
    $phone  = get_comment_meta( $comment->comment_ID, 'phone', true );
    $title  = get_comment_meta( $comment->comment_ID, 'title', true );
    $rating = get_comment_meta( $comment->comment_ID, 'product_rating', true );
    wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false );
    ?>
    <p>
        <label for="title"><?php esc_attr_e( 'Review Title', 'wp-dispensary' ); ?></label>
        <input type="text" name="title" value="<?php esc_attr_e( $title ); ?>" class="widefat" />
    </p>
    <p>
        <label for="product_rating"><?php esc_attr_e( 'Review Rating', 'wp-dispensary' ); ?>: </label>
        <div class="commentratingbox">
        <?php
        for ( $i=1; $i <= 5; $i++ ) {
            echo '<span class="commentrating"><input type="radio" name="product_rating" id="product_rating" value="' . $i . '"';
            if ( $rating == $i ) echo ' checked="checked"';
            echo ' />' . $i . ' </span>';
        }
        ?>
        </div>
    </p>
    <p>
        <label for="phone"><?php esc_attr_e( 'Phone', 'wp-dispensary' ); ?></label>
        <input type="text" name="phone" value="<?php echo esc_attr( $phone ); ?>" class="widefat" />
    </p>
    <?php
}

/**
 * Edit comment meta fields
 * 
 * @param int $comment_id 
 * 
 * @since  4.2.0
 * @return string
 */
function wpd_extend_comment_edit_metafields( $comment_id ) {
    if ( ! isset( $_POST['extend_comment_update'] ) || ! wp_verify_nonce( filter_input( INPUT_POST, 'extend_comment_update' ), 'extend_comment_update' ) ) return;

    if ( ( isset( $_POST['phone'] ) ) && ( '' != filter_input( INPUT_POST, 'phone' ) ) ) :
        $phone = wp_filter_nohtml_kses( filter_input( INPUT_POST, 'phone' ) );
        update_comment_meta( $comment_id, 'phone', $phone );
    else :
        delete_comment_meta( $comment_id, 'phone');
    endif;

    if ( ( isset( $_POST['title'] ) ) && ( '' != filter_input( INPUT_POST, 'title' ) ) ):
        $title = wp_filter_nohtml_kses( filter_input( INPUT_POST, 'title' ) );
        update_comment_meta( $comment_id, 'title', $title );
    else :
        delete_comment_meta( $comment_id, 'title');
    endif;

    if ( ( isset( $_POST['product_rating'] ) ) && ( '' != filter_input( INPUT_POST, 'product_rating' ) ) ):
        $rating = wp_filter_nohtml_kses( filter_input( INPUT_POST, 'product_rating' ) );
        update_comment_meta( $comment_id, 'product_rating', $rating );
    else :
        delete_comment_meta( $comment_id, 'product_rating' );
    endif;

}
add_action( 'edit_comment', 'wpd_extend_comment_edit_metafields' );

/**
 * Add star ratings to wpd_menu shortcode
 * 
 * @param string $show_name 
 * @param int    $product_id 
 * 
 * @since  4.2.0
 * @return string
 */
function wpd_add_star_ratings_to_shortcode( $show_name, $product_id ) {
    // Do something.
    $ratings  = '<span class="product-ratings">' . get_wpd_product_ratings_stars( $product_id )  . '</span>';
    $ratings .= $show_name;

    return $ratings;
}
add_filter( 'wpd_shortcodes_product_title', 'wpd_add_star_ratings_to_shortcode', 10, 2 );
