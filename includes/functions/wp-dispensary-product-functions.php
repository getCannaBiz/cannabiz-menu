<?php
/**
 * The file that defines the product helper functions.
 *
 * @link       https://www.wpdispensary.com
 * @since      2.6
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes
 */

if ( ! function_exists( 'is_product' ) ) {
	/**
	 * Is_product - Returns true when viewing a single product.
	 *
	 * @return bool
	 */
	function is_product() {
		return is_singular( wpd_menu_types_simple( TRUE ) );
	}
}

/**
 * Product Details
 * 
 * Get the details of products based on specific paramaters
 *
 * @param  string $product_id
 * @param  array  $product_details
 * @return void
 */
function get_wpd_product_details( $product_id, $product_details ) {

    $str = '';

    $compounds_new = array();

    // Loop through required product details.
    foreach ( $product_details as $product=>$value ) {

		if ( 'show' === $value && 'thc' === $product ) {
			$compounds_new[] = 'thc';
		}

		if ( 'show' === $value && 'cbd' === $product ) {
			$compounds_new[] = 'cbd';
		}

		if ( 'show' === $value && 'thca' === $product ) {
			$compounds_new[] = 'thca';
		}

		if ( 'show' === $value && 'cba' === $product ) {
			$compounds_new[] = 'cba';
		}

		if ( 'show' === $value && 'cbn' === $product ) {
			$compounds_new[] = 'cbn';
		}

		if ( 'show' === $value && 'cbg' === $product ) {
			$compounds_new[] = 'cbg';
		}

    }

    // Get compounds.
	$compounds = get_wpd_compounds_simple( $product_id, NULL, $compounds_new );

    // Add compounds.
    $str .= $compounds;

    // Loop through required product details.
    foreach ( $product_details as $product=>$value ) {
	
		// Total THC (Servings X THC).
		if ( 'show' === $value && 'total_thc' === $product ) {
			if ( '' != get_post_meta( $product_id, '_thcmg', true ) && '' != get_post_meta( $product_id, '_thccbdservings', true ) ) {
				$str .= '<span class="wpd-productinfo thc"><strong>' . __( 'THC: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( $product_id, '_thcmg', true ) * get_post_meta( $product_id, '_thccbdservings', true ) . 'mg</span>';
			} else {
				// Do nothing.
			}
		} else {
            // Do nothing.
		}

		// Seed count.
		if ( 'show' === $value && 'seed_count' === $product ) {
            if ( get_post_meta( $product_id, '_seedcount', true ) ) {
                $str .= '<span class="wpd-productinfo seeds"><strong>' . __( 'Seeds:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( $product_id, '_seedcount', true ) . '</span>';
			} else {
				// Do nothing.
			}
		} else {
            // Do nothing.
		}

		// Clone count.
		if ( 'show' === $value && 'clone_count' === $product ) {
            if ( get_post_meta( $product_id, '_clonecount', true ) ) {
                $str .= '<span class="wpd-productinfo clones"><strong>' . __( 'Clones:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( $product_id, '_clonecount', true ) . '</span>';
			} else {
				// Do nothing.
			}
		} else {
            // Do nothing.
		}

		// Size oz (Topicals).
		if ( 'show' === $value && 'size' === $product ) {
            if ( get_post_meta( $product_id, '_sizetopical', true ) ) {
                $str .= '<span class="wpd-productinfo size"><strong>' . __( 'Size:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( $product_id, '_sizetopical', true ) . 'oz</span>';
			} else {
				// Do nothing.
			}
		} else {
            // Do nothing.
		}

		// THC mg (Topicals).
		if ( 'show' === $value && 'thc_topical' === $product ) {
            if ( get_post_meta( $product_id, '_thctopical', true ) ) {
                $str .= '<span class="wpd-productinfo thc"><strong>' . __( 'THC:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( $product_id, '_thctopical', true ) . 'mg</span>';
			} else {
				// Do nothing.
			}
		} else {
            // Do nothing.
		}

        // CBD mg (Topicals).
		if ( 'show' === $value && 'cbd' === $product ) {
            if ( get_post_meta( $product_id, '_cbdtopical', true ) ) {
                $str .= '<span class="wpd-productinfo cbd"><strong>' . __( 'CBD:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( $product_id, '_cbdtopical', true ) . 'mg</span>';
			} else {
				// Do nothing.
			}
		} else {
            // Do nothing.
		}

        // Pre-roll weight.
		if ( 'show' === $value && 'weight' === $product ) {
			if ( get_post_meta( $product_id, '_preroll_weight', true ) ) {
				$str .= '<span class="wpd-productinfo weight"><strong>' . __( 'Weight:', 'wp-dispensary' ) . '</strong> ' . get_post_meta( $product_id, '_preroll_weight', true ) . 'g</span>';
			} else {
				// Do nothing.
			}
		} else {
            // Do nothing.
		}

        // THC mg (Edibles).
		if ( 'show' === $value && 'thcmg' === $product ) {
            if ( get_post_meta( $product_id, '_thcmg', true ) ) {
                $str .= '<span class="wpd-productinfo thc"><strong>' . __( 'THC: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( $product_id, '_thcmg', true ) . 'mg</span>';
			} else {
				// Do nothing.
			}
		} else {
            // Do nothing.
		}

        // Servings (Edibles).
		if ( 'show' === $value && 'servings' === $product ) {
            if ( get_post_meta( $product_id, '_thccbdservings', true ) ) {
                $str .= '<span class="wpd-productinfo servings"><strong>' . __( 'Servings: ', 'wp-dispensary' ) . '</strong>' . get_post_meta( $product_id, '_thccbdservings', true ) . '</span>';
			} else {
				// Do nothing.
			}
		} else {
            // Do nothing.
		}

    }

    return $str;

}

/**
 * Product Details
 * 
 * Get the details of products based on specific paramaters
 *
 * @param  string $product_id
 * @param  array  $product_details
 * @return void
 */
function wpd_product_details( $product_id, $product_details ) {
    echo apply_filters( 'wpd_product_details', get_wpd_product_details( $product_id, $product_details ) );
}

/**
 * Product Image
 * 
 * Get the featured image of the product
 *
 * @param  string $product_id
 * @param  string  $image_size
 * @return void
 */
function get_wpd_product_image( $product_id = NULL, $image_size ) {

    // Set product ID.
    if ( NULL === $product_id ) {
        $prod_id = get_the_ID();
    } else {
        $prod_id = $product_id;
    }

    // Set image size.
    if ( NULL === $image_size ) {
        $img_size = 'dispensary-image';
    } else {
        $img_size = $image_size;
    }

	$thumbnail_id        = get_post_thumbnail_id( $prod_id );
    $thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, $img_size, false );
    $thumbnail_url       = $thumbnail_url_array[0];

    // Show Image.
    if ( null === $thumbnail_url && 'full' === $image_size ) {
        $default_url = site_url() . '/wp-content/plugins/wp-dispensary/public/images/wpd-large.jpg';
        $default_img = apply_filters( 'wpd_shortcodes_default_image', $default_url );
        $show_image  = '<a href="' . get_permalink( $product_id ) . '"><img src="' . $default_img . '" alt="' . get_the_title() . '" /></a>';
    } elseif ( null !== $thumbnail_url ) {
        $show_image = '<a href="' . get_permalink( $product_id ) . '"><img src="' . $thumbnail_url . '" alt="' . get_the_title() . '" /></a>';
    } else {
        $default_url = site_url() . '/wp-content/plugins/wp-dispensary/public/images/' . $image_size . '.jpg';
        $default_img = apply_filters( 'wpd_shortcodes_default_image', $default_url );
        $show_image  = '<a href="' . get_permalink( $product_id ) . '"><img src="' . $default_img . '" alt="' . get_the_title() . '" /></a>';
    }

    return $show_image;

}

/**
 * Product image
 * 
 * @since 2.6
 * @return string
 */
function wpd_product_image( $product_id, $image_size ) {
    echo apply_filters( 'wpd_product_image', get_wpd_product_image( $product_id, $image_size ) );
}
