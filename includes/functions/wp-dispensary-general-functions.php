<?php
/**
 * The file that defines the general helper functions.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes/fuctions
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    wp_die();
}

/**
 * WPD Admin Settings - Details phrase
 *
 * @since  2.5
 * @return string
 */
function get_wpd_details_phrase() {
    // Access all WP Dispensary Display Settings.
    $wpd_settings = get_option( 'wpdas_display' );

    // Check details phrase settings.
    if ( isset ( $wpd_settings['wpd_details_phrase_custom'] ) && '' !== $wpd_settings['wpd_details_phrase_custom'] ) {
        $wpd_details_phrase = $wpd_settings['wpd_details_phrase_custom'];
    } elseif ( isset ( $wpd_settings['wpd_details_phrase'] ) && 'Information' === $wpd_settings['wpd_details_phrase'] ) {
        $wpd_details_phrase = esc_attr__( 'Information', 'wp-dispensary' );
    } else {
        $wpd_details_phrase = esc_attr__( 'Details', 'wp-dispensary' );
    }

    // Create filterable details phrase.
    $wpd_details_phrase = apply_filters( 'wpd_details_phrase', $wpd_details_phrase );

    // Return the details phrase.
    return $wpd_details_phrase;
}

/**
 * Get all product types
 *
 * @since  4.0
 * @return array
 */
function wpd_product_types() {
    $product_types = array(
        'wpd-flowers'      => esc_html__( 'Flowers', 'wp-dispensary' ),
        'wpd-concentrates' => esc_html__( 'Concentrates', 'wp-dispensary' ),
        'wpd-tinctures'    => esc_html__( 'Tinctures', 'wp-dispensary' ),
        'wpd-edibles'      => esc_html__( 'Edibles', 'wp-dispensary' ),
        'wpd-prerolls'     => esc_html__( 'Pre-rolls', 'wp-dispensary' ),
        'wpd-topicals'     => esc_html__( 'Topicals', 'wp-dispensary' ),
        'wpd-growers'      => esc_html__( 'Growers', 'wp-dispensary' ),
        'wpd-gear'         => esc_html__( 'Gear', 'wp-dispensary' ),
    );
    return apply_filters( 'wpd_product_types', $product_types );
}

/**
 * Get product type display name
 *
 * @param string $slug 
 * 
 * @since  4.0
 * @return string
 */
function wpd_product_type_display_name( $slug = '' ) {
    if ( ! $slug ) {
        return null;
    }
    $product_types = array(
        'flowers'      => esc_html__( 'Flowers', 'wp-dispensary' ),
        'concentrates' => esc_html__( 'Concentrates', 'wp-dispensary' ),
        'tinctures'    => esc_html__( 'Tinctures', 'wp-dispensary' ),
        'edibles'      => esc_html__( 'Edibles', 'wp-dispensary' ),
        'prerolls'     => esc_html__( 'Pre-rolls', 'wp-dispensary' ),
        'topicals'     => esc_html__( 'Topicals', 'wp-dispensary' ),
        'growers'      => esc_html__( 'Growers', 'wp-dispensary' ),
        'gear'         => esc_html__( 'Gear', 'wp-dispensary' ),
    );
    return apply_filters( 'wpd_product_type_display_name', $product_types[$slug] );
}

/**
 * Get product type slug
 *
 * @param string $name 
 * 
 * @since  4.0
 * @return string
 */
function wpd_product_type_display_name_to_slug( $name = '' ) {
    if ( ! $name ) {
        return null;
    }
    $product_types = array(
        esc_html__( 'Flowers', 'wp-dispensary' )      => 'flowers',
        esc_html__( 'Concentrates', 'wp-dispensary' ) => 'concentrates',
        esc_html__( 'Tinctures', 'wp-dispensary' )    => 'tinctures',
        esc_html__( 'Edibles', 'wp-dispensary' )      => 'edibles',
        esc_html__( 'Pre-rolls', 'wp-dispensary' )    => 'prerolls',
        esc_html__( 'Topicals', 'wp-dispensary' )     => 'topicals',
        esc_html__( 'Growers', 'wp-dispensary' )      => 'growers',
        esc_html__( 'Gear', 'wp-dispensary' )         => 'gear',
    );
    return apply_filters( 'wpd_product_type_display_name', $product_types[$name] );
}

/**
 * Get all product types - Simple
 *
 * @param string $lowercase 
 * 
 * @todo Update this function to have $lowercase = true, and pass a second
 * arg ($implode) set to false by default. I can use the code found elsewhere 
 * in the theme to include this option.
 * 
 * @since  4.0
 * @return array
 */
function wpd_product_types_simple( $lowercase = null ) {

    // Get product types.
    $product_types = wpd_product_types();

    // Create simple array.
    $product_types_simple = array();

    // Loop through product types.
    foreach ( $product_types as $value ) {
        // Add items to simple array.
        if ( $lowercase ) {
            $product_types_simple[] = str_replace( '-', '', strtolower( $value ) );
        } else {
            $product_types_simple[] = $value;
        }
    }

    return apply_filters( 'wpd_product_types_simple', $product_types_simple );
}

/**
 * Custom image sizes
 * 
 * @since  4.0
 * @return array
 */
function wp_dispensary_custom_image_sizes() {
    $sizes = array(
        'dispensary-image' => array(
            'width'  => 360,
            'height' => 250
        ),
        'wpd-large' => array(
            'width'  => 1200,
            'height' => 1200
        ),
        'wpd-medium' => array(
            'width'  => 800,
            'height' => 800
        ),
        'wpd-small' => array(
            'width'  => 400,
            'height' => 400
        ),
        'wpd-thumbnail' => array(
            'width'  => 50,
            'height' => 50
        ),
        'wpdispensary-widget' => array(
            'width'  => 312,
            'height' => 156
        )
    );
    // Filter the sizes.
    $sizes = apply_filters( 'wp_dispensary_custom_image_sizes', $sizes );

    return $sizes;
}

if ( ! function_exists( 'get_wpd_vendors_details' ) ) {
    /**
     * Get vendors details
     * 
     * Retrieve details about all current vendors
     * 
     * @param string $details 
     * 
     * @since  4.0
     * @return array|null
     */
    function get_wpd_vendors_details( $details = null ) {
        // Bail early?
        if ( ! $details ) { return null; }

        // Create vendors list.
        $vendor_list = array();

        // Get vendors.
        $vendors = get_categories( [
            'taxonomy' => 'vendors',
            'orderby'  => 'title',
            'order'    => 'ASC'
        ] );

        // Build vendor list.
        foreach ( $vendors as $vendor ) {
            $vendor_list[] = array(
                'name'  => $vendor->name,
                'count' => $vendor->count,
            );
        }

        // Create list of vendor names.
        $vendor_names = array();

        // Loop through vendor names.
        foreach ( $vendor_list as $vendor ) {
            $vendor_names[] = $vendor['name'];
        }

        // Create list of vendor counts.
        $vendor_counts = array();

        // Loop through vendor counts.
        foreach ( $vendor_list as $vendor ) {
            $vendor_counts[] = $vendor['count'];
        }

        // Vendor counts.
        if ( 'counts' == $details ) {
            return $vendor_counts;
        }

        // Vendor names.
        if ( 'names' == $details ) {
            return $vendor_names;
        }
    }
}

if ( ! function_exists( 'get_wpd_strain_types_details' ) ) {
    /**
     * Get strain types details
     * 
     * Retrieve details about all current strain types
     * 
     * @param string $details 
     * 
     * @since  4.0
     * @return array|null $details
     */
    function get_wpd_strain_types_details( $details = null ) {
        // Bail early?
        if ( ! $details ) { return null; }

        // Create strain types list.
        $strain_types_list = array();

        // Get strain types.
        $strain_types = get_categories( [
            'taxonomy' => 'strain_types',
            'orderby'  => 'title',
            'order'    => 'ASC'
        ] );

        // Build strain list.
        foreach ( $strain_types as $strain ) {
            $strain_types_list[] = array(
                'name'  => $strain->name,
                'count' => $strain->count,
            );
        }

        // Create list of strain types names.
        $strain_names = array();

        // Loop through strain types.
        foreach ( $strain_types_list as $strain ) {
            $strain_names[] = $strain['name'];
        }

        // Create list of strain types counts.
        $strain_counts = array();

        // Loop through strain types.
        foreach ( $strain_types_list as $strain ) {
            $strain_counts[] = $strain['count'];
        }

        // Strain counts.
        if ( 'counts' == $details ) {
            return $strain_counts;
        }

        // Strain names.
        if ( 'names' == $details ) {
            return $strain_names;
        }
    }
}

if ( ! function_exists( 'get_wpd_shelf_types_details' ) ) {
    /**
     * Get shelf types details
     * 
     * Retrieve details about all current shelf types
     * 
     * @param string $details 
     * 
     * @since  4.0
     * @return array  $details
     */
    function get_wpd_shelf_types_details( $details = null ) {
        // Bail early?
        if ( ! $details ) { return null; }

        // Create shelf types list.
        $shelf_types_list = array();

        // Get shelf types.
        $shelf_types = get_categories( [
            'taxonomy' => 'shelf_types',
            'orderby'  => 'title',
            'order'    => 'ASC'
        ] );

        // Build shelf list.
        foreach ( $shelf_types as $shelf ) {
            $shelf_types_list[] = array(
                'name'  => $shelf->name,
                'count' => $shelf->count,
            );
        }

        // Create list of shelf types names.
        $shelf_names = array();

        // Loop through shelf types.
        foreach ( $shelf_types_list as $shelf ) {
            $shelf_names[] = $shelf['name'];
        }

        // Create list of shelf types counts.
        $shelf_counts = array();

        // Loop through shelf types.
        foreach ( $shelf_types_list as $shelf ) {
            $shelf_counts[] = $shelf['count'];
        }

        // Strain counts.
        if ( 'counts' == $details ) {
            return $shelf_counts;
        }

        // Strain names.
        if ( 'names' == $details ) {
            return $shelf_names;
        }
    }
}

if ( ! function_exists( 'get_wpd_product_type_item_count' ) ) {
    /**
     * Get item (post) count by product type
     * 
     * @param string $product_type 
     * 
     * @since  4.0
     * @return int|null
     */
    function get_wpd_product_type_item_count( $product_type = null ) {
        // Bail early?
        if ( ! $product_type ) { return null; }
        // Build query.
        $query = new WP_Query( array( 'post_type' => 'products', 'meta_key' => 'product_type', 'meta_value' => $product_type, 'wp_query_id' => 'wpd_product_count_by_type' ) );

        return $query->found_posts;
    }
}

if ( ! function_exists( 'get_wpd_product_type_details' ) ) {
    /**
     * Get product type details
     * 
     * @param string $product_type 
     * 
     * @since  4.0
     * @return int
     */
    function get_wpd_product_type_details( $product_type = null ) {
        // Bail early?
        if ( ! $product_type ) { return null; }
        // Build details array.
        $details = array();
        // Loop through product types.
        foreach ( wpd_product_types_simple() as $slug=>$name ) {
            // Create the product type slug.
            $slug = wpd_product_type_display_name_to_slug( $name );
            // Add product type details to array.
            $details[wpd_product_type_display_name_to_slug( $name )] = array(
                'name'  => $name,
                'count' => get_wpd_product_type_item_count( $slug ),
            );
        }
        // Return details.
        return $details[$product_type];
    }
}

if ( ! function_exists( 'get_wpd_product_types_details' ) ) {
    /**
     * Get shelf types details
     * 
     * Retrieve details about all current shelf types
     * 
     * @param string $details 
     * 
     * @since  4.0
     * @return array  $details
     */
    function get_wpd_product_types_details( $details = null ) {

        $types = array();

        // Loop through product types.
        foreach ( wpd_product_types_simple( true ) as $slug ) {
            // Add product type details to array.
            $types[] = get_wpd_product_type_details( $slug );
        }

        // Build product type list.
        foreach ( $types as $product_type ) {
            $details_list[] = array(
                'name'  => $product_type['name'],
                'count' => $product_type['count'],
            );
        }

        // Create list of product types names.
        $product_names = array();

        // Loop through product types.
        foreach ( $details_list as $product_type ) {
            $product_names[] = $product_type['name'];
        }

        // Create list of product types counts.
        $product_counts = array();

        // Loop through product types.
        foreach ( $details_list as $product_type ) {
            $product_counts[] = $product_type['count'];
        }

        // Strain counts.
        if ( 'counts' == $details ) {
            return $product_counts;
        }

        // Strain names.
        if ( 'names' == $details ) {
            return $product_names;
        }
    }
}

if ( ! function_exists( 'get_wpd_all_image_sizes' ) ) {
    /**
     * Get all the registered image sizes along with their dimensions
     *
     * @global array $_wp_additional_image_sizes
     * @since  4.2.0
     * @return array $image_sizes
     */
    function get_wpd_all_image_sizes() {
        global $_wp_additional_image_sizes;

        $default_image_sizes = get_intermediate_image_sizes();

        foreach ( $default_image_sizes as $size ) {
            $image_sizes[ $size ][ 'width' ]  = intval( get_option( "{$size}_size_w" ) );
            $image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
            $image_sizes[ $size ][ 'crop' ]   = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
        }

        if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
            $image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
        }

        return $image_sizes;
    }
}
