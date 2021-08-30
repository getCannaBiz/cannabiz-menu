<?php
/**
 * The file that defines the general helper functions.
 *
 * @link       https://www.wpdispensary.com
 * @since      3.4
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes/functions
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * WPD Admin Settings - Details phrase
 *
 * @since 2.5
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
 * @since 4.0
 * @return array
 */
function wpd_product_types() {
	$product_types = array(
		'wpd-flowers'      => __( 'Flowers', 'wp-dispensary' ),
		'wpd-concentrates' => __( 'Concentrates', 'wp-dispensary' ),
		'wpd-tinctures'    => __( 'Tinctures', 'wp-dispensary' ),
		'wpd-edibles'      => __( 'Edibles', 'wp-dispensary' ),
		'wpd-prerolls'     => __( 'Pre-rolls', 'wp-dispensary' ),
		'wpd-topicals'     => __( 'Topicals', 'wp-dispensary' ),
		'wpd-growers'      => __( 'Growers', 'wp-dispensary' ),
		'wpd-gear'         => __( 'Gear', 'wp-dispensary' ),
	);
	return apply_filters( 'wpd_product_types', $product_types );
}

/**
 * Get product type display name
 *
 * @since 4.0
 * @param string $slug
 * @return string
 */
function wpd_product_type_display_name( $slug = '' ) {
	if ( ! $slug ) {
		return null;
	}
	$product_types = array(
		'flowers'      => __( 'Flowers', 'wp-dispensary' ),
		'concentrates' => __( 'Concentrates', 'wp-dispensary' ),
		'tinctures'    => __( 'Tinctures', 'wp-dispensary' ),
		'edibles'      => __( 'Edibles', 'wp-dispensary' ),
		'prerolls'     => __( 'Pre-rolls', 'wp-dispensary' ),
		'topicals'     => __( 'Topicals', 'wp-dispensary' ),
		'growers'      => __( 'Growers', 'wp-dispensary' ),
		'gear'         => __( 'Gear', 'wp-dispensary' ),
	);
	return apply_filters( 'wpd_product_type_display_name', $product_types[$slug] );
}

/**
 * Get product type slug
 *
 * @since 4.0
 * @param string $slug
 * @return string
 */
function wpd_product_type_display_name_to_slug( $name = '' ) {
	if ( ! $name ) {
		return null;
	}
	$product_types = array(
		__( 'Flowers', 'wp-dispensary' )      => 'flowers',
		__( 'Concentrates', 'wp-dispensary' ) => 'concentrates',
		__( 'Tinctures', 'wp-dispensary' )    => 'tinctures',
		__( 'Edibles', 'wp-dispensary' )      => 'edibles',
		__( 'Pre-rolls', 'wp-dispensary' )    => 'prerolls',
		__( 'Topicals', 'wp-dispensary' )     => 'topicals',
		__( 'Growers', 'wp-dispensary' )      => 'growers',
		__( 'Gear', 'wp-dispensary' )         => 'gear',
	);
	return apply_filters( 'wpd_product_type_display_name', $product_types[$name] );
}

/**
 * Get all product types - Simple
 *
 * @todo update this function to have $lowercase = true, and pass a second arg ($implode) set to false
 * by default. I can use the code found elsewhere in the theme to include this option.
 * 
 * @since  4.0
 * @return array
 */
function wpd_product_types_simple( $lowercase = NULL ) {

	// Get product types.
	$product_types = wpd_product_types();

	// Create simple array.
	$product_types_simple = array();

	// Loop through product types.
	foreach ( $product_types as $key=>$value ) {
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
	 * @since  4.0
	 * @param  string $details
	 * @return array  $details
	 */
	function get_wpd_vendors_details( $details = NULL ) {
		// Bail early?
		if ( ! $details ) { return NULL; }

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
	 * @since  4.0
	 * @param  string $details
	 * @return array  $details
	 */
	function get_wpd_strain_types_details( $details = NULL ) {
		// Bail early?
		if ( ! $details ) { return NULL; }

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
		$strain_type_names = array();

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
	 * @since  4.0
	 * @param  string $details
	 * @return array  $details
	 */
	function get_wpd_shelf_types_details( $details = NULL ) {
		// Bail early?
		if ( ! $details ) { return NULL; }

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
		$shelf_type_names = array();

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
	 * @since  4.0
	 * @return int
	 */
	function get_wpd_product_type_item_count( $product_type = NULL ) {
		// Bail early?
		if ( ! $product_type ) { return NULL; }
		// Build query.
		$query = new WP_Query( array( 'post_type' => 'products', 'meta_key' => 'product_type', 'meta_value' => $product_type ) );

		return $query->found_posts;
	}
}

if ( ! function_exists( 'get_wpd_product_type_details' ) ) {
	/**
	 * Get product type details
	 * 
	 * @since  4.0
	 * @return int
	 */
	function get_wpd_product_type_details( $product_type = NULL ) {
		// Bail early?
		if ( ! $product_type ) { return NULL; }
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
	 * @since  4.0
	 * @param  string $details
	 * @return array  $details
	 */
	function get_wpd_product_types_details( $details = NULL ) {

		$types = array();

		// Loop through product types.
		foreach ( wpd_product_types_simple( TRUE ) as $slug ) {
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
		$product_type_names = array();

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
