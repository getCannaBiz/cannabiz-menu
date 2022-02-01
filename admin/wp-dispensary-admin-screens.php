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

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Creates new featured image column */
function wp_dispensary_columns( $columns ) {

	$wpd_columns = array();
	$title       = 'cb';

	foreach ( $columns as $key => $value ) {
		$wpd_columns[$key] = $value;
		if ( $key == $title ) {
			$wpd_columns['featured_thumb'] = '<span class="dashicons dashicons-format-image"></span><span class="wpd-admin-screen-featured-image-title">' . __( 'Featured image', 'wp-dispenary' ) . '</span>';
		}
	}

	return $wpd_columns;
}
add_filter( 'wpd_manage_posts_custom_column', 'wp_dispensary_columns' );

/**
 * Adds the featured image to the column
 * 
 * @return void
 */
function wp_dispensary_columns_data( $column ) {
	switch ( $column ) {
		case 'featured_thumb':
			echo '<a href="' . get_edit_post_link() . '">' . the_post_thumbnail( array( 40, 40 ) ) . '</a>';
			break;
	}
}

/**
 * Add thumbnails to post_type screen for WPD menu types.
 * 
 * @return void
 */
if ( isset( $_GET['post_type'] ) ) {
	// Get post type.
	$post_type = esc_html( $_GET['post_type'] );
	// Get post types.
	$post_types = wpd_menu_types_simple( true );
	// Add products to post types array.
	$post_types[] = 'products';

	// Add actions and filters if post type is a WPD Menu type.
	if ( in_array( $post_type, apply_filters( 'wpd_admin_screen_thumbnails', $post_types ) ) ) {
		add_filter( 'manage_posts_columns', 'wp_dispensary_columns' );
		add_action( 'manage_posts_custom_column', 'wp_dispensary_columns_data', 10, 1 );
		add_filter( 'manage_pages_columns', 'wp_dispensary_columns' );
		add_action( 'manage_pages_custom_column', 'wp_dispensary_columns_data', 10, 1 );
	}
}

/**
 * Hide specific metaboxes by default.
 * 
 * @return void
 */
function hide_meta_box( $hidden, $screen ) {
	//make sure we are dealing with the correct screen.
	if ( ( 'post' == $screen->base ) && ( 'products' == $screen->id ) ) {
		$hidden = array( 'postexcerpt', 'slugdiv', 'postcustom', 'trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'revisionsdiv' );
		$hidden = apply_filters( 'wpd_hide_meta_box', $hidden );
	}
	return $hidden;
}
add_filter( 'default_hidden_meta_boxes', 'hide_meta_box', 10, 2 );

/**
 * Remove specific taxonomies from columns on menu type screen.
 * 
 * @since 2.3 - updated 4.0
 */
function wpd_remove_taxonomies_from_admin_columns( $columns ) {
	// remove aroma taxonomy column.
	unset( $columns['taxonomy-aroma'] );
	unset( $columns['taxonomy-aromas'] );
	// remove flavor taxonomy column.
	unset( $columns['taxonomy-flavor'] );
	unset( $columns['taxonomy-flavors'] );
	// remove effect taxonomy column.
	unset( $columns['taxonomy-effect'] );
	unset( $columns['taxonomy-effects'] );
	// remove symptom taxonomy column.
	unset( $columns['taxonomy-symptom'] );
	unset( $columns['taxonomy-symptoms'] );
	// remove condition taxonomy column.
	unset( $columns['taxonomy-condition'] );
	unset( $columns['taxonomy-conditions'] );
	// remove ingredients taxonomy column.
	unset( $columns['taxonomy-ingredients'] );
	// remove allergens taxonomy column.
	unset( $columns['taxonomy-allergens'] );
	// remove vendor taxonomy column.
	unset( $columns['taxonomy-vendor'] );
	// remove shelf type taxonomy column.
	unset( $columns['taxonomy-shelf_type'] );
	// remove strain type taxonomy column.
	unset( $columns['taxonomy-strain_type'] );
	// remove flowers category taxonomy column.
	unset( $columns['taxonomy-flowers_category'] );
	// remove edibles category taxonomy column.
	unset( $columns['taxonomy-edibles_category'] );
	// remove concentrates category taxonomy column.
	unset( $columns['taxonomy-concentrates_category'] );
	// remove topicals category taxonomy column.
	unset( $columns['taxonomy-topicals_category'] );
	// remove growers category taxonomy column.
	unset( $columns['taxonomy-growers_category'] );
	// remove gear category taxonomy column.
	unset( $columns['taxonomy-wpd_gear_category'] );
	// remove tinctures category taxonomy column.
	unset( $columns['taxonomy-wpd_tinctures_category'] );

	return $columns;
}
add_filter( 'manage_edit-products_columns', 'wpd_remove_taxonomies_from_admin_columns' );

/**
 * Sort products on archive page
 * 
 * @since  4.0
 * @param  object $query
 * @return void
 */
function wpd_products_archive_sort_order( $query ) {
	if ( is_post_type_archive( 'products' ) ):
		// Set the order ASC or DESC.
		$query->set( 'order', 'ASC' );
		// Set the orderby.
		$query->set( 'orderby', 'title' );
		// Set the amount of products to show.
		$query->set( 'posts_per_page', -1 );
	endif;
};
add_action( 'pre_get_posts', 'wpd_products_archive_sort_order' ); 

/**
 * Add filter to All Products admin screen
 * 
 * @since  4.0
 * @return void
 */
function wp_dispensary_admin_posts_filter_restrict_manage_posts() {
    $type = 'products';
	// Set post type.
	if ( isset( $_GET['post_type'] ) ) {
        $type = $_GET['post_type'];
    }

    // Only add filter to post type you want
    if ( 'products' == $type ) {
		// Create array.
		$values = array();
		// Loop through product types.
		foreach ( wpd_product_types() as $key=>$value ) {
			// Add product type to array.
			$values[$value] = wpd_product_type_display_name_to_slug( $value );
		}
        ?>
        <select name="PRODUCT_TYPE_FIELD_VALUE">
        <option value=""><?php _e( 'All Types', 'wp-dispensary' ); ?></option>
        <?php
            $current_v = isset( $_GET['PRODUCT_TYPE_FIELD_VALUE'] ) ? $_GET['PRODUCT_TYPE_FIELD_VALUE'] : '';
            foreach ( $values as $label => $value ) {
                printf
                    (
                        '<option value="%s"%s>%s</option>',
                        $value,
                        $value == $current_v ? ' selected="selected"':'',
                        $label
                    );
                }
        ?>
        </select>
        <?php
    }
}
add_action( 'restrict_manage_posts', 'wp_dispensary_admin_posts_filter_restrict_manage_posts' );

/**
 * Filter products by post meta
 * 
 * @since  4.0
 * @return void
 */
function wp_dispensary_posts_filter( $query ) {
    global $pagenow;
    $type = 'post';
    if ( isset($_GET['post_type'] ) ) {
        $type = $_GET['post_type'];
    }
    if ( 'products' == $type && is_admin() && $pagenow=='edit.php' && isset( $_GET['PRODUCT_TYPE_FIELD_VALUE'] ) && '' != $_GET['PRODUCT_TYPE_FIELD_VALUE'] ) {
        $query->query_vars['meta_key']   = 'product_type';
        $query->query_vars['meta_value'] = $_GET['PRODUCT_TYPE_FIELD_VALUE'];
    }
}
add_filter( 'parse_query', 'wp_dispensary_posts_filter' );
