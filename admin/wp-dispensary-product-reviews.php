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
        $default['title_reply'] = esc_attr__( 'Leave a Review' );
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

    // Add to ratings box.
    for ( $i=1; $i <= 5; $i++ ) {
        $ratings_box .= '<span class="commentrating"><input class="star" type="radio" name="rating" id="rating" value="' . $i . '"/> ' . $i . ' </span>';
    }

    // Add author field.
    $fields[ 'author' ] = '<p class="comment-form-author">'.
        '<label for="author">' . esc_attr__( 'Name' ) .
        ( $req ? '<span class="required">*</span>' : ’ ). '</label>'.
        '<input id="author" name="author" type="text" value="'. esc_attr( $commenter['comment_author'] ) .
        '" size="30" tabindex="1"' . $aria_req . ' /></p>';

    // Add email field.
    $fields[ 'email' ] = '<p class="comment-form-email">'.
        '<label for="email">' . esc_attr__( 'Email' ) .
        ( $req ? '<span class="required">*</span>' : ’ ). '</label>'.
        '<input id="email" name="email" type="text" value="'. esc_attr( $commenter['comment_author_email'] ) .
        '" size="30"  tabindex="2"' . $aria_req . ' /></p>';

    if ( 'products' == get_post_type() ) {
        // Add phone field.
        $fields[ 'phone' ] = '<p class="comment-form-phone">'.
            '<label for="phone">' . esc_attr__( 'Phone' ) . '</label>'.
            '<input id="phone" name="phone" type="text" size="30"  tabindex="4" /></p>';

        $fields['title'] = '<p class="comment-form-title">'.
            '<label for="title">' . esc_attr__( 'Comment Title', 'wp-dispensary' ) . '</label>'.
            '<input id="title" name="title" type="text" size="30"  tabindex="5" /></p>';

        $fields['rating'] = '<p class="comment-form-rating">
            <label for="rating">'. esc_attr__( 'Rating', 'wp-dispensary' ) . '<span class="required">*</span></label>
            <span class="commentratingbox">' . $ratings_box . '</span></p>';

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

    if ( ( isset( $_POST['rating'] ) ) && ( '' != $_POST['rating'] ) ) {
        $rating = wp_filter_nohtml_kses( $_POST['rating'] );
        add_comment_meta( $comment_id, 'rating', $rating );
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
        if ( ! isset( $_POST['rating'] ) ) {
            wp_die( esc_attr__( 'Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your review with a rating.', 'wp-dispensary' ) );
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
        $title = '<strong>' . esc_attr( $title ) . '</strong><br/>';
        $text  = $title . $text;
    }

    $star = '<i class="fas fa-star"></i>';

    if ( $commentrating = get_comment_meta( get_comment_ID(), 'rating', true ) ) {
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
    add_meta_box( 'title', esc_attr__( 'Comment Metadata - Extend Comment', 'wp-dispensary' ), 'wpd_extend_comment_meta_box', 'comment', 'normal', 'high' );
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
    $rating = get_comment_meta( $comment->comment_ID, 'rating', true );
    wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false );
    ?>
    <p>
        <label for="phone"><?php esc_attr_e( 'Phone' ); ?></label>
        <input type="text" name="phone" value="<?php echo esc_attr( $phone ); ?>" class="widefat" />
    </p>
    <p>
        <label for="title"><?php esc_attr_e( 'Comment Title' ); ?></label>
        <input type="text" name="title" value="<?php echo esc_attr( $title ); ?>" class="widefat" />
    </p>
    <p>
        <label for="rating"><?php esc_attr_e( 'Rating: ' ); ?></label>
        <span class="commentratingbox">
        <?php for( $i=1; $i <= 5; $i++ ) {
            echo '<span class="commentrating"><input type="radio" name="rating" id="rating" value="'. $i .'"';
            if ( $rating == $i ) echo ' checked="checked"';
            echo ' />'. $i .' </span>';
            }
        ?>
        </span>
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

    if ( ( isset( $_POST['rating'] ) ) && ( '' != filter_input( INPUT_POST, 'rating' ) ) ):
        $rating = wp_filter_nohtml_kses( filter_input( INPUT_POST, 'rating' ) );
        update_comment_meta( $comment_id, 'rating', $rating );
    else :
        delete_comment_meta( $comment_id, 'rating');
    endif;

}
add_action( 'edit_comment', 'wpd_extend_comment_edit_metafields' );
