<?php
/**
 * Adding custom functions and filters for the admin dashboard screens
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      1.9.16
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    wp_die();
}

/**
 * Add Product Ratings stars to Products admin screen
 * 
 * @since  4.3.0
 * @return void
 */
function wpd_add_custom_html_column_to_admin_screen() {
    // Create an instance.
    $product_columns = new CPT_Columns( 'products' );

    // Add thumb column.
    $product_columns->add_column( 'featured_thumb',
        array(
            'label' => esc_html__( 'Image', 'cannabiz-menu' ),
            'type'  => 'thumb',
            'order' => '-13',
            'size'  => array( '36', '36' )
        )
    );

    // Add thumb column.
    $product_columns->add_column( 'custom_html',
        array(
            'label' => esc_html__( 'Ratings', 'cannabiz-menu' ),
            'type'  => 'custom_html',
            'order' => '12',
            'html'  => '' // pass empty to utilize filter below
        )
    );
}
add_action( 'admin_init', 'wpd_add_custom_html_column_to_admin_screen' );

/**
 * Add ‘Ratings’ column to Products admin screen
 * 
 * @since  4.3.0
 * @return string
 */
function wpd_add_custom_html_column_to_admin_screen_filter( $post_id, $column, $column_name ) {
    // Create variable of custom HTML that we'll add to the column.
    $custom_html = get_wpd_product_ratings_stars( $column );

    return $custom_html;
}
add_filter( 'columns_custom_html_custom_html', 'wpd_add_custom_html_column_to_admin_screen_filter', 20, 3 );

/**
 * Hide specific metaboxes by default.
 * 
 * @param array  $hidden 
 * @param object $screen 
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
 * @param object $columns 
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
 * @param object $query 
 * 
 * @since  4.0
 * @return object
 */
function wpd_products_archive_sort_order( $query ) {
    if ( ! is_admin() && $query->is_search() ) {
        $query->set( 'post_type', array( 'products' ) );
    }
    // Only run if we're in the products post type archive.
    if ( ! is_admin() && $query->is_main_query() && ! $query->is_search() && is_post_type_archive( 'products' ) ) {
        // Set the order ASC or DESC.
        $query->set( 'order', apply_filters( 'wpd_products_archive_sort_order', 'ASC' ) );
        // Set the orderby.
        $query->set( 'orderby', apply_filters( 'wpd_products_archive_sort_orderby', 'title' ) );
        // Set the amount of products to show.
        $query->set( 'posts_per_page', apply_filters( 'wpd_products_archive_sort_posts_per_page', -1 ) );
    }

    return $query;
}
add_action( 'pre_get_posts', 'wpd_products_archive_sort_order' ); 

/**
 * Add filter to All Products admin screen
 * 
 * @since  4.0
 * @return void
 */
function wp_dispensary_admin_posts_filter_restrict_manage_posts() {
    // Set default type.
    $type = 'products';
    // Set custom post type.
    if ( null !== filter_input( INPUT_GET, 'post_type' ) ) {
        $type = filter_input( INPUT_GET, 'post_type' );
    }

    // Only add filter to post type you want
    if ( 'products' == $type && is_admin() ) {
        // Create array.
        $values = [];
        // Loop through product types.
        foreach ( wpd_product_types() as $value ) {
            // Add product type to array.
            $values[$value] = wpd_product_type_display_name_to_slug( $value );
        }
        ?>
        <select name="PRODUCT_TYPE_FIELD_VALUE">
        <option value=""><?php esc_html_e( 'All Types', 'cannabiz-menu' ); ?></option>
        <?php
        $current_v = null !== filter_input( INPUT_GET, 'PRODUCT_TYPE_FIELD_VALUE' ) ? filter_input( INPUT_GET, 'PRODUCT_TYPE_FIELD_VALUE' ) : '';
        foreach ( $values as $label => $value ) {
            printf(
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
 * @param object $query 
 * 
 * @since  4.0
 * @return void
 */
function wp_dispensary_posts_filter( $query ) {
    global $pagenow;
    $type = 'post';
    if ( null !== filter_input( INPUT_GET, 'post_type' )  ) {
        $type = filter_input( INPUT_GET, 'post_type' );
    }
    if ( 'products' == $type && is_admin() && $pagenow == 'edit.php' && null !== filter_input( INPUT_GET, 'PRODUCT_TYPE_FIELD_VALUE' ) && '' != filter_input( INPUT_GET, 'PRODUCT_TYPE_FIELD_VALUE' ) ) {
        $query->query_vars['meta_key']   = 'product_type';
        $query->query_vars['meta_value'] = filter_input( INPUT_GET, 'PRODUCT_TYPE_FIELD_VALUE' );
    }
}
add_filter( 'parse_query', 'wp_dispensary_posts_filter' );
