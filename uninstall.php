<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package WP_Dispensary
 * @author  WP Dispensary <contact@wpdispensary.com>
 * @license GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link    https://www.wpdispensary.com
 * @since   1.0.0
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    wp_die();
}

// Get comments.
$comments = get_comments();
// Loop through comments.
foreach( $comments as $comment ) {
    // Delete product reviews comment metadata.
    delete_comment_meta( $comment->comment_ID, 'phone' );
    delete_comment_meta( $comment->comment_ID, 'title' );
    delete_comment_meta( $comment->comment_ID, 'rating' );
}