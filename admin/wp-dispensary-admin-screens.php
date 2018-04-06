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
	$title       = 'cb';
	foreach ( $columns as $key => $value ) {
		$wpd_columns[$key] = $value;
		if ( $key == $title ) {
			$wpd_columns['featured_thumb'] = '<span class="dashicons dashicons-format-image"></span><span class="wpd-admin-screen-featured-image-title">Featured image</span>';
		}
	}

	return $wpd_columns;

}
add_filter( 'wpd_manage_posts_custom_column', 'wp_dispensary_columns' );

/** Adds the featured image to the column */
function wp_dispensary_columns_data( $column, $post_id ) {
	switch ( $column ) {
		case 'featured_thumb':
			echo '<a href="' . get_edit_post_link() . '">';
			echo the_post_thumbnail( array( 40, 40 ) );
			echo '</a>';
			break;
	}
}

if ( isset( $_GET['post_type'] ) ) {
	$post_type = $_GET['post_type'];
	if ( in_array( $post_type, apply_filters( 'wpd_admin_screen_thumbnails', array( 'flowers', 'concentrates', 'edibles', 'prerolls', 'topicals', 'growers' ) ) ) ) {
		add_filter( 'manage_posts_columns', 'wp_dispensary_columns' );
		add_action( 'manage_posts_custom_column', 'wp_dispensary_columns_data', 10, 2 );
		add_filter( 'manage_pages_columns', 'wp_dispensary_columns' );
		add_action( 'manage_pages_custom_column', 'wp_dispensary_columns_data', 10, 2 );
	}
}

// Hide specific metaboxes by default.
add_filter( 'default_hidden_meta_boxes', 'hide_meta_box', 10, 2 );
function hide_meta_box( $hidden, $screen ) {
	//make sure we are dealing with the correct screen.
	if ( ( 'post' == $screen->base ) && ( 'flowers' == $screen->id ) ) {
		$hidden = array( 'postexcerpt','slugdiv','postcustom','trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'authordiv', 'revisionsdiv', 'tagsdiv-aroma', 'tagsdiv-flavor', 'tagsdiv-effect', 'tagsdiv-condition', 'tagsdiv-symptom', 'tagsdiv-vendor' );
		$hidden[] ='my_custom_meta_box';//for custom meta box, enter the id used in the add_meta_box() function.
	} elseif ( ( 'post' == $screen->base ) && ( 'concentrates' == $screen->id ) ) {
		$hidden = array( 'postexcerpt','slugdiv','postcustom','trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'authordiv', 'revisionsdiv', 'tagsdiv-aroma', 'tagsdiv-flavor', 'tagsdiv-effect', 'tagsdiv-condition', 'tagsdiv-symptom', 'tagsdiv-vendor' );
		$hidden[] ='my_custom_meta_box';//for custom meta box, enter the id used in the add_meta_box() function.
	} elseif ( ( 'post' == $screen->base ) && ( 'edibles' == $screen->id ) ) {
		$hidden = array( 'postexcerpt','slugdiv','postcustom','trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'authordiv', 'revisionsdiv', 'tagsdiv-aroma', 'tagsdiv-flavor', 'tagsdiv-effect', 'tagsdiv-condition', 'tagsdiv-symptom', 'tagsdiv-vendor' );
		$hidden[] ='my_custom_meta_box';//for custom meta box, enter the id used in the add_meta_box() function.
	} elseif ( ( 'post' == $screen->base ) && ( 'prerolls' == $screen->id ) ) {
		$hidden = array( 'slugdiv', 'trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'tagsdiv-vendor', 'flowers_categorydiv' );
		$hidden[] ='my_custom_meta_box';//for custom meta box, enter the id used in the add_meta_box() function.
	} elseif ( ( 'post' == $screen->base ) && ( 'topicals' == $screen->id ) ) {
		$hidden = array( 'slugdiv', 'trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'tagsdiv-ingredients', 'tagsdiv-effect', 'tagsdiv-condition', 'tagsdiv-symptom', 'tagsdiv-vendor', 'flowers_categorydiv' );
		$hidden[] ='my_custom_meta_box';//for custom meta box, enter the id used in the add_meta_box() function.
	} elseif ( ( 'post' == $screen->base ) && ( 'growers' == $screen->id ) ) {
		$hidden = array( 'slugdiv', 'trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'tagsdiv-vendor', 'flowers_categorydiv' );
		$hidden[] ='my_custom_meta_box';//for custom meta box, enter the id used in the add_meta_box() function.
	} else {}
	return $hidden;
}

// Rearrange metabox order on Flowers edit screen.
add_filter( 'get_user_option_meta-box-order_flowers', 'flowers_metabox_order' );
function flowers_metabox_order( $order ) {
	return array(
		'normal' => join(
			",",
			array(
				'wpdispensary_prices',
				'wpdispensary_compounds',
			)
		),
	);
}

// Rearrange metabox order on Edibles edit screen.
add_filter( 'get_user_option_meta-box-order_edibles', 'edibles_metabox_order' );
function edibles_metabox_order( $order ) {
	return array(
		'side' => join(
			",",
			array(
				'submitdiv',
				'wpdispensary_singleprices',
			)
		),
	);
}

// Rearrange metabox order on Pre-rolls edit screen.
add_filter( 'get_user_option_meta-box-order_prerolls', 'prerolls_metabox_order' );
function prerolls_metabox_order( $order ) {
	return array(
		'side' => join(
			",",
			array(
				'submitdiv',
				'wpdispensary_singleprices',
				'select-flowers-metabox',
			)
		),
	);
}

// Rearrange metabox order on Growers edit screen.
add_filter( 'get_user_option_meta-box-order_growers', 'growers_metabox_order' );
function growers_metabox_order( $order ) {
	return array(
		'side' => join(
			",",
			array(
				'submitdiv',
				'wpdispensary_singleprices',
				'select-flowers-metabox',
			)
		),
	);
}
