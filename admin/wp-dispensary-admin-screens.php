<?php
/**
 * Adding custom functions and filters for the admin dashboard screens
 *
 * @link       https://www.wpdispensary.com
 * @since      1.9.16
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

/** Creates new featured image column */
function wp_dispensary_columns( $columns ) {

$wpd_columns = array();
$title = 'cb';
foreach( $columns as $key => $value ) {
	$wpd_columns[$key] = $value;
	if ( $key==$title ) {
		$wpd_columns['featured_thumb'] = '<span class="dashicons dashicons-format-image"></span><span class="wpd-admin-screen-featured-image-title">Featured image</span>';
	}
}

return $wpd_columns; 


}
add_filter( 'wpd_manage_posts_custom_column' , 'wp_dispensary_columns' );

/** Adds the featured image to the column */
function wp_dispensary_columns_data( $column, $post_id ) {
	switch ( $column ) {
	case 'featured_thumb':
		echo '<a href="' . get_edit_post_link() . '">';
		echo the_post_thumbnail( array( 40,40 ) );
		echo '</a>';
		break;
	}
}

if( isset( $_GET['post_type'] ) ) {
    $post_type = $_GET['post_type'];

    if( in_array( $post_type, apply_filters( 'wpd_admin_screen_thumbnails', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
        add_filter( 'manage_posts_columns' , 'wp_dispensary_columns' );
        add_action( 'manage_posts_custom_column' , 'wp_dispensary_columns_data', 10, 2 );
        add_filter( 'manage_pages_columns' , 'wp_dispensary_columns' );
        add_action( 'manage_pages_custom_column' , 'wp_dispensary_columns_data', 10, 2 );
    }
}